<?php

    class Home extends Controller {

        public function __construct() {
        }

        public function index() {
            $data = array(
                'title' => "Title"
            );

            $this->view('home/index', $data);
        }
    }
