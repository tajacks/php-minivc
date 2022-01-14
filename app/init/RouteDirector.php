<?php

    class RouteDirector {

        // Default Controller and Method
        protected $currentController = 'Home';
        protected $currentMethod     = 'index';
        protected $params            = [];

        public function __construct() {
            $urlRoute = $this->getURLRoute();

            // Check if there is a controller matching the first section of the array.
            // e.x. If the url was example.com/blog/Coffee, check if there is a 'Blog' Controller.
            // Always uppercase the first letter to match class name.
            if ( ! empty($urlRoute)) {
                if (file_exists(APP_ROOT . '/controller/' . ucwords($urlRoute[0]) . '.php')) {

                    $this->currentController = ucwords($urlRoute[0]);

                    // Remove the first part of the URL from the route array for easier downstream processing.
                    unset($urlRoute[0]);
                }
            }

            // Require the controller. If not explicitly set, use the default value.
            require_once(APP_ROOT . '/controller/' . $this->currentController . '.php');

            $this->currentController = new $this->currentController();

            // Handle all additional parameters. Check if there is a second parameter in the URL.
            // e.x. If the url was example.com/blog/Coffee, check if there is a 'Coffee' method.
            // case-insensitive as per the language spec.
            if (isset($urlRoute[1])) {
                if (method_exists($this->currentController, $urlRoute[1])) {
                    $this->currentMethod = $urlRoute[1];
                    unset($urlRoute[1]);
                }
            }

            // The data parameters are all the remaining data past the method
            $this->params = $urlRoute ? array_values($urlRoute) : [];

            call_user_func_array([
                $this->currentController,
                $this->currentMethod
            ], $this->params);
        }

        /**
         * Trims and sanitizes the parameters set in $_GET from
         * Apache URL rewrite.
         * Used to route information to the correct
         * controller.
         * $_GET key must match Apache redirect target (i.e. route)
         *
         * @return array|false|string[] - An array of URL parameters, seperated by '/'.
         */
        public function getURLRoute() {
            if (isset($_GET['route'])) {

                $url = rtrim($_GET['route'], '/');

                $url = filter_var($url, FILTER_SANITIZE_URL);

                return explode('/', $url);
            } else
                return array();
        }
    }
