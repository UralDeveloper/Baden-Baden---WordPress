<?php
/**
 * Block template file: E:\Program Files (x86)\Local_Sites\baden-sysert\app\public/wp-content/themes/baden/template-parts/blocks/acf-additionalServicesCard.php
 *
 * Additional Services Card Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'additional-services-card-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>

<section id="<?php echo esc_attr( $id ); ?>" class="additionalServicesCard">
	<?php if ( have_rows( 'block_dopolnitelnye_uslugi' ) ) : ?>
		<?php while ( have_rows( 'block_dopolnitelnye_uslugi' ) ) : the_row(); ?>
        <div class="container">
            <div class="titleBlock">
                <h2><?php the_sub_field( 'zagolovok' ); ?></h2>
            </div>
            <div class="titleWrapper">
                <p><?php the_sub_field( 'opisanie' ); ?></p>
            </div>
            <div class="additionalServicesCard__wrapper">
                <?php if ( have_rows( 'kartochki' ) ) : ?>
                    <?php while ( have_rows( 'kartochki' ) ) : the_row(); ?>
                    <div class="additionalServicesCard__item">
                        <p class="additionalServicesCard__item--title"><?php the_sub_field( 'zagolovok' ); ?></p>
                        <p class="additionalServicesCard__item--text"><?php the_sub_field( 'opisanie' ); ?></p>
                    </div>
                    <?php endwhile; ?>
                <?php endif; ?>
            </div>
        </div>
		<?php endwhile; ?>
	<?php endif; ?>
</section>