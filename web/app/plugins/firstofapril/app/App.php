<?php

namespace FOA;

use FOA\PostType\Character;
use FOA\Render\Image;

class App {

    public static function init() {
        add_action('init', [__CLASS__, 'onInit']);
        add_action('wp_enqueue_scripts', [__CLASS__, 'onEnqueueScripts']);
        add_action('wp_footer', [__CLASS__, 'onFooter']);

    }

    /**
     * Trigger actions on init
     * @return void
     */
    public static function onInit() {
        Character::register();
    }

    /**
     * Enqueue scripts and styles
     */
    public static function onEnqueueScripts() {
        wp_enqueue_style('foa-style', plugin_dir_url(__FILE__) . '../assets/css/style.css');
        wp_enqueue_script('gsap', "https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js", []);
        wp_enqueue_script('foa-script', plugin_dir_url(__FILE__) . '../assets/js/script.js',['gsap'], false, [ 'in_footer' => true ]);
    }

    /**
     * Trigger actions before footer is rendered
     * @return void
     */
    public static function onFooter() {
        Image::render(18, 'jamy');
        Image::render(17, 'chuck');
    }
}
