<?php

/**
 * Block template file: baden/template-parts/blocks/acf-advantages.php
 *
 * Advantages Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'advantages-' . $block['id'];
if (! empty($block['anchor'])) {
    $id = $block['anchor'];
}
?>

<section id="<?php echo esc_attr($id); ?>" class="advantages">
    <?php if (have_rows('block_preimushhestva')) : ?>
        <div class="container advantages__container">
            <div class="advantages__list">
                <?php while (have_rows('block_preimushhestva')) : the_row(); ?>
                    <div class="advantages__item">
                        <?php $izobrazhenie = get_sub_field('izobrazhenie'); ?>
                        <?php if ($izobrazhenie) : ?>
                            <div class="advantages__item-icon">
                                <img src="<?php echo esc_url($izobrazhenie['url']); ?>" alt="<?php echo esc_attr($izobrazhenie['alt']); ?>" />
                            </div>
                        <?php endif; ?>
                        <div class="advantages__item-text">
                            <p><?php the_sub_field('tekst'); ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php endif; ?>
</section>