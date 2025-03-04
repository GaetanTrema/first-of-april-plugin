<?php
/*
Plugin Name: First of April
*/

if (!defined('ABSPATH')) {
    exit;
}

use FOA\App;

require(__DIR__ . '/vendor/autoload.php');

App::init();
