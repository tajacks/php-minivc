<?php

    class Persons extends Controller {
        private $personModel;

        public function __construct() {
            $this->personModel = $this->model('Person');
        }

        /**
         * Sets the current view to the index page. If URL params are passed from RouteController,
         * demonstrate doing something different.
         * @param $params - This optional value is passed from RouteController in a callback.
         *
         * @return void
         */
        public function index ($params = '') {
            
            if (! empty($params)) {
                $note = 'There was a URL Parameter';
            } else $note = 'There was not a URL Parameter';
            
            $people = $this->personModel->getPeople();

            $data = array(
                'title' => 'People',
                'people' => $people,
                'note' => $note
            );
            $this->view('persons/index', $data);
        }
    }
