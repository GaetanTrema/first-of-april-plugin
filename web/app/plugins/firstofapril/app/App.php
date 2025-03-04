<?php

namespace FOA;

class App {

    public static function init() {
        add_action('wp_enqueue_scripts', [__CLASS__, 'onEnqueueScripts']);
        add_action('wp_footer', [__CLASS__, 'onFooter']);
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
        echo '<img src="http://localhost:8093/app/uploads/2025/02/1444x920_monde-jamy-removebg-preview-1.png" class="first-of-april" id="jamy">';
        echo '<img src="http://localhost:8093/app/uploads/2025/03/pngimg.com-chuck_norris_PNG14.png" class="first-of-april" id="chuck">';
    }
}
