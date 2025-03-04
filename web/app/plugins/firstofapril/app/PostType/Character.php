<?php

namespace FOA\PostType;

class Character {

    public const KEY = 'character';
    public const PARAMS = [
        "label" => 'Character',
        "public" => true,
        "has_archive" => true,
        "menu_icon" => 'dashicons-admin-users',
        "supports" => ['title', 'thumbnail'],
    ];

    public static function register() {
        register_post_type(self::KEY, self::PARAMS);
    }
}