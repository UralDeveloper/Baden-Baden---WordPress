<?php
/**
 * Block template file: /baden/template-parts/blocks/acf-galleryCarousel.php
 *
 * Gallery Carousel Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'gallery-carousel-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>
<section id="<?php echo esc_attr( $id ); ?>" class="galleryCarousel">
	<?php if ( have_rows( 'block_galereya_karusel' ) ) : ?>
		<?php while ( have_rows( 'block_galereya_karusel' ) ) : the_row(); ?>
        <div class="container">
            <?php if ( get_sub_field( 'nazvanie_bloka' ) ) : ?>
                <div class="gallerySlider__header">
                    <div class="gallerySlider__header--title"><h2><?php the_sub_field( 'nazvanie_bloka' ); ?></h2></div>
                    <div class="gallerySlider__header--description">
                        <div class="gallerySlider__header--promo"><?php the_sub_field( 'promo' ); ?></div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="swiper galleryCarousel-carousel">
                <div class="swiper-wrapper">
                <?php $galereya_karusel_images = get_sub_field( 'galereya_karusel' ); ?>
                <?php if ( $galereya_karusel_images ) : ?>
                    <?php foreach ( $galereya_karusel_images as $galereya_karusel_image ): ?>
                        <div class="swiper-slide"
                                data-fancybox="spaGallery__<?php echo esc_attr( $id ); ?>"
                                data-src="<?php echo esc_url( $galereya_karusel_image['url'] ); ?>"
                            >
                            <img
                                src="<?php echo esc_url( $galereya_karusel_image['url'] ); ?>"
                                alt="<?php echo esc_attr( $galereya_karusel_image['alt'] ); ?>" />
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                </div>
            </div>
        </div>
		<?php endwhile; ?>
	<?php endif; ?>
</section>