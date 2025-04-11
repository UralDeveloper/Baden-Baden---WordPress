<?php
/**
 * Block template file: /baden/template-parts/blocks/acf-additionalServices.php
 *
 * Additional Services Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'additional-services-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>

<section id="<?php echo esc_attr( $id ); ?>" class="additionalServices">
	<?php if ( have_rows( 'block_dopolnitelnye_uslugi_spisok' ) ) : ?>
		<?php while ( have_rows( 'block_dopolnitelnye_uslugi_spisok' ) ) : the_row(); ?>
        <div class="container additionalServices__container">
            <div class="additionalServices__title titleBlock">
                <h2><?php the_sub_field( 'zagolovok' ); ?></h2>
            </div>
            <div class="additionalServices__content">
                <?php the_sub_field( 'spisok' ); ?>
            </div>
        </div>
		<?php endwhile; ?>
	<?php endif; ?>
</section>