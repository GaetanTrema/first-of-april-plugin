<?php

namespace FOA\Render;

class Image {

    public static function render($mediaId, $id) {
        $mediaUrl = get_the_post_thumbnail_url($mediaId, 'full');
        echo "<img src='$mediaUrl' class='first-of-april' id='$id'>";
    }
}