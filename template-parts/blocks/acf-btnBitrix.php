<?php

/**
 * Block template file: /var/www/u2782092/data/www/baden-sysert.ru/wp-content/themes/Baden-Baden---WordPress/template-parts/blocks/acf-btnBitrix.php
 *
 * Btnbitrix Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'btnbitrix-' . $block['id'];
if (! empty($block['anchor'])) {
    $id = $block['anchor'];
}
?>
<style>
    .btn__bitrixForm .b24-form-sign {
        display: none;
    }

    .btn__bitrixForm .b24-form-wrapper.b24-form-border-bottom {
        border-bottom: none;
    }

    .btn__bitrixForm .btn-close {
        right: 12px;
        left: auto;
        position: absolute;
        z-index: 20;
    }

    .btn__bitrixForm {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 20px;
    }

    .btn__bitrixForm button {
        margin: 0 auto;
    }
</style>
<div id="<?php echo esc_attr($id); ?>" class="btn__bitrixForm">
    <?php if (have_rows('knopka_bitrix')) : ?>
        <?php while (have_rows('knopka_bitrix')) : the_row(); ?>
            <button class="btn btn--blue" data-bs-toggle="modal" data-bs-target="#bitrix__<?php the_sub_field('id_okna'); ?>">
                <?php the_sub_field('tekst_knopki'); ?>
            </button>

            <div class="modal fade" id="bitrix__<?php the_sub_field('id_okna'); ?>" tabindex="-1" aria-labelledby="bitrix__<?php the_sub_field('id_okna'); ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <?php echo get_sub_field('kod_formy'); ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</div>