<?php

    class Controller {

        protected $model;

        public function model($model) {
            require_once(APP_ROOT . '/model/' . $model . '.php');
            return new $model();
        }

        public function view($view, $data = []) {
            (file_exists(APP_ROOT . '/view/' . $view . '.php')) ?
                require_once APP_ROOT . '/view/' . $view . '.php' :
                die('404');
        }
    }
