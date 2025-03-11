<?php

namespace FOA;

use FOA\PostType\Character;
use FOA\Render\Image;

class App {

    public const DEFAULT_INTERACTION_LIST = [
        'link-hover' => 0,
        'form-input-focus' => 0,
    ];

    public static function init() {
        add_action('init', [__CLASS__, 'onInit']);
        add_action('wp_enqueue_scripts', [__CLASS__, 'onEnqueueScripts']);
        add_action('wp_footer', [__CLASS__, 'onFooter']);

        register_activation_hook(
            FOA_PLUGIN_FILE,
            [__CLASS__, 'onActivation']
        );
    }

    public static function onActivation() {
        add_option('foa_interaction_list', self::DEFAULT_INTERACTION_LIST);
        flush_rewrite_rules();
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
        // TODO: get character id dynamically
        // render character for each interaction
        foreach (get_option('foa_interaction_list') as $interaction => $characterId) {
            Image::render($characterId, $interaction);
        }
    }
}
