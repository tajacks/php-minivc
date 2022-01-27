<?php

    // Define common constants
    // 'APP_ROOT'. The directory which is two directories down from the current file.
    define('APP_ROOT', dirname(__FILE__, 2));

    // Base ini File
    $credentials = parse_ini_file(APP_ROOT . '/credentials.ini');

    // Database Credentials
    // For production deployments, ensure that this variable is changed to safely reference passwords outside the web root!
    define("DB_HOST", $credentials['db_host']);
    define("DB_USER", $credentials['db_user']);
    define("DB_PASS", $credentials['db_pass']);
    define("DB_NAME", $credentials['db_name']);
    define("DB_CHAR", $credentials['db_char']);

    unset($credentials);