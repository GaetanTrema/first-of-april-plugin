<div>
    <select id="foa-interaction-list" name="foa_interaction_list">
    <?php
    foreach ($interactionList as $interaction => $characterId) {
        $selected = in_array($post->ID, $interactionList) ? 'selected' : '';
        echo '<option value="'.$interaction.'" "'. $selected . '>' . $interaction .'</option>';
    }
    ?>
        <option value="off">Not used</option>
    </select>
</div>