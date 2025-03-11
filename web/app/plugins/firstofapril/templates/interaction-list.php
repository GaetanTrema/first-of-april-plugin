<div>
    <select id="foa-interaction-list" name="<?= FOA\App::INTERACTION_LIST_OPTION ?>">
    <?php
    foreach ($interactionList as $interaction => $characterId) {
        $selected = $post->ID == $characterId ? 'selected' : '';
        echo '<option value="'.$interaction.'" '. $selected . '>' . $interaction .'</option>';
    }
    ?>
        <option value="off">Not used</option>
    </select>
</div>