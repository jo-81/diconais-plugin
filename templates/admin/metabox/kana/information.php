<?php

use Diconais\Core\Flash\MessageFlash;

    $vPosition = get_post_meta($post->ID, 'dn_kana_position', true);
    $vRomaji = get_post_meta($post->ID, 'dn_kana_romaji', true);
    $vKunrei = get_post_meta($post->ID, 'dn_kana_kunrei', true);
    $vCombinaison = get_post_meta($post->ID, 'dn_kana_is_combinaison', true);
    $vAccent = get_post_meta($post->ID, 'dn_kana_is_accent', true);

    $messages = MessageFlash::get();
?>

<div>
    <div class="dn-form-group">
        <label class="dn-form-label" for="dn_kana_position"><?php echo esc_html("Position"); ?></label>
        <input 
            type="number" 
            min="0" 
            id="dn_kana_position" 
            name="dn_kana_position" 
            value="<?php if(!empty($vPosition)) : echo esc_attr($vPosition); endif; ?>" 
        />
        <span class="dn-form-help">
            <?php echo esc_html("Ce numéro sert pour organaniser les kana par ordre alphabétique Japonais.") ?>
        </span>
        <?php 
            if(isset($messages['dn_kana_position'])) :
                foreach($messages['dn_kana_position'] as $message) : ?>
                    <span class="dn-form-error"><?php echo esc_html($message['text']); ?></span>
                <?php endforeach;
            endif;
        ?>
    </div>

    <div class="dn-form-group">
        <label class="dn-form-label" for="dn_kana_romaji"><?php echo esc_html("Romaji"); ?></label>
        <input 
            type="text" 
            id="dn_kana_romaji" 
            name="dn_kana_romaji" 
            value="<?php if(!empty($vRomaji)) : echo esc_attr($vRomaji); endif; ?>"
        />
        <?php 
            if(isset($messages['dn_kana_romaji'])) :
                foreach($messages['dn_kana_romaji'] as $message) : ?>
                    <span class="dn-form-error"><?php echo esc_html($message['text']); ?></span>
                <?php endforeach;
            endif;
        ?>
    </div>

    <div class="dn-form-group">
        <label class="dn-form-label" for="dn_kana_kunrei"><?php echo esc_html("Kunrei"); ?></label>
        <input 
            type="text" 
            id="dn_kana_kunrei" 
            name="dn_kana_kunrei" 
            value="<?php if(!empty($vKunrei)) : echo esc_attr($vKunrei); endif; ?>"
        />
        <span class="dn-form-help"><?php echo esc_html("Pour afficher la lecture kunrei Japonaise.") ?></span>
    </div>

    <div class="dn-form-group">
        <input type="hidden" name="dn_kana_is_combinaison" value="0">
        <input 
            type="checkbox" 
            id="dn_kana_is_combinaison" 
            name="dn_kana_is_combinaison" 
            value="1"
            <?php if ($vCombinaison) : echo esc_attr("checked"); endif; ?>
        />
        <label for="dn_kana_is_combinaison"><?php echo esc_html("Combinaison ?"); ?></label>
        <span class="dn-form-help"><?php echo esc_html("Si le kana est une combinaison.") ?></span>
    </div>

    <div class="dn-form-group">
        <input type="hidden" name="dn_kana_is_accent" value="0">
        <input 
            type="checkbox" 
            id="dn_kana_is_accent" 
            name="dn_kana_is_accent" 
            value="1"
            <?php if ($vAccent) : echo esc_attr("checked"); endif; ?>
        />
        <label for="dn_kana_is_accent"><?php echo esc_html("Accent ?"); ?></label>
        <span class="dn-form-help"><?php echo esc_html("Si le kana à un accent.") ?></span>
    </div>
</div>

<?php
$data = isset($metabox['args']) ? $metabox['args'] : [];

if (isset($data['action'], $data['nonce'])) {
    wp_nonce_field($data['action'], $data['nonce']);
}