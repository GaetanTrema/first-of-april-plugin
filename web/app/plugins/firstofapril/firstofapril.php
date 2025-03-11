<?php
/*
Plugin Name: First of April
*/

if (!defined('ABSPATH')) {
    exit;
}

use FOA\App;

require(__DIR__ . '/vendor/autoload.php');

define('FOA_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('FOA_PLUGIN_FILE', __FILE__);

App::init();
