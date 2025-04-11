<?php
/**
 * Block template file: /baden/template-parts/blocks/acf-spaGallery.php
 *
 * Spagallery Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'spagallery-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>
<?php if ( have_rows( 'block_spa_massazh_galereya' ) ) : ?>
<section id="<?php echo esc_attr( $id ); ?>" class="spaGrid">
    <?php while ( have_rows( 'block_spa_massazh_galereya' ) ) : the_row(); ?>
    <div class="container">
        <div class="titleBlock">
            <h2><?php the_sub_field( 'nazvanie_bloka' ); ?></h2>
        </div>
        <div class="spaGrid__wrapper">
            <div class="titleWrapper">
                <?php the_sub_field( 'opisanie' ); ?>
                <?php if ( have_rows( 'knopka' ) ) : ?>
                    <?php while ( have_rows( 'knopka' ) ) : the_row(); ?>
                        <?php $ssylka = get_sub_field( 'ssylka' ); ?>
                        <?php if ( $ssylka ) : ?>
                            <?php $post = $ssylka; ?>
                            <?php setup_postdata( $post ); ?> 
                            <a class="btn btn--blue" href="<?php the_permalink( $post->ID ) ?>">
                            <?php the_sub_field( 'tekst_knopki' ); ?></a>
                            <?php wp_reset_postdata(); ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
            <?php $galereya_images = get_sub_field( 'galereya' ); ?>
            <?php if ( $galereya_images ) : ?>
            <div class="spaGrid__grid">
                <?php foreach ( $galereya_images as $galereya_image ): ?>
                <div class="spaGrid__photo">
                    <img src="<?php echo esc_url( $galereya_image['url'] ); ?>" alt="<?php echo esc_attr( $galereya_image['alt'] ); ?>" />
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php endwhile; ?>
</section>
<?php endif; ?>