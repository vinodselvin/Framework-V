<?php

define('DEV', 'development');
define('TESTING', 'testing');
define('PROD', 'production');

/* Set the environment
  There are three Environments:
  development, testing, production
 */
define('ENV', DEV);

switch (ENV) {

    case PROD:
        break;

    case TESTING:
        break;

    case DEV:
    default:
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        break;
}
