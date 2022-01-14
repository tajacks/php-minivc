<?php

    // Load the configuration file containing constant definitions.
    require_once('config/config.php');

    // Autoload init classes by defining the matching pattern in an anonymous function.
    // Classes to be auto loaded will be found under init.
    // Prevents multiple require statements.
    spl_autoload_register(function ($initClass) {
        require_once('init/' . $initClass . '.php');
    });
