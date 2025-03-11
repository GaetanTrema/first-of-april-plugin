<?php

namespace FOA;

use FOA\PostType\Character;
use FOA\Render\Image;

class App {

    public const DEFAULT_INTERACTION_LIST = [
        'link-hover' => 0,
        'form-input-focus' => 0,
    ];

    public const INTERACTION_LIST_OPTION = 'foa_interaction_list';

    public static function init()
    {
        add_action('init', [__CLASS__, 'onInit']);
        add_action('wp_enqueue_scripts', [__CLASS__, 'onEnqueueScripts']);
        add_action('wp_footer', [__CLASS__, 'onFooter']);
        add_action('add_meta_boxes', [__CLASS__, 'onAddMetaBoxes']);
        add_action('save_post', [__CLASS__, 'onSavePost']);

        register_activation_hook(
            FOA_PLUGIN_FILE,
            [__CLASS__, 'onActivation']
        );
    }

    public static function onActivation()
    {
        add_option(self::INTERACTION_LIST_OPTION, self::DEFAULT_INTERACTION_LIST);
        flush_rewrite_rules();
    }

    /**
     * Trigger actions on init
     * @return void
     */
    public static function onInit()
    {
        Character::register();
    }

    /**
     * Enqueue scripts and styles
     */
    public static function onEnqueueScripts()
    {
        wp_enqueue_style('foa-style', plugin_dir_url(__FILE__) . '../assets/css/style.css');
        wp_enqueue_script('gsap', "https://cdn.jsdelivr.net/npm/gsap@3.12.7/dist/gsap.min.js", []);
        wp_enqueue_script('foa-script', plugin_dir_url(__FILE__) . '../assets/js/script.js',['gsap'], false, [ 'in_footer' => true ]);
    }

    /**
     * Trigger actions before footer is rendered
     * @return void
     */
    public static function onFooter()
    {
        // TODO: get character id dynamically
        // render character for each interaction
        foreach (get_option(self::INTERACTION_LIST_OPTION) as $interaction => $characterId) {
            Image::render($characterId, $interaction);
        }
    }

    /**
     * Trigger actions on add meta boxes
     * @return void
     */
    public static function onAddMetaBoxes()
    {
        add_meta_box(
            'foa-interaction-list',
            'Interaction List',
            [__CLASS__, 'renderInteractionList'],
            Character::KEY,
            'normal',
            'default'
        );
    }

    /**
     * Render interaction list meta box
     * @return void
     */
    public static function renderInteractionList()
    {
        global $post;
        $interactionList = get_option(self::INTERACTION_LIST_OPTION);
        require FOA_PLUGIN_DIR . 'templates/interaction-list.php';
    }

    /**
     * Trigger actions on save post
     * @param int $postId
     * @return void
     */
    public static function onSavePost($postId)
    {
        if (array_key_exists(self::INTERACTION_LIST_OPTION, $_POST)) {
            $interactionList = get_option(self::INTERACTION_LIST_OPTION);

            // s'assurer que le personnage n'est associé à aucune autre interaction
            // s'assurer que l'interaction n'est associée à aucun autre personnage
            foreach ($interactionList as $interaction => $characterId) {
                if ($characterId == $postId) {
                    $interactionList[$interaction] = 0;
                }
                if ($interaction == $_POST[self::INTERACTION_LIST_OPTION]) {
                    $interactionList[$interaction] = 0;
                }
            }

            $interactionList[$_POST[self::INTERACTION_LIST_OPTION]] = $postId;
            update_option(self::INTERACTION_LIST_OPTION, $interactionList);
        }
    }
}
