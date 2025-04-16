<?php
/**
 * Block template file: /baden/template-parts/blocks/acf-aboutInNumbers.php
 *
 * Aboutinnumbers Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'aboutinnumbers-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>

<?php if ( have_rows( 'block_o_komplekse_v_czifrah' ) ) : ?>
    <?php while ( have_rows( 'block_o_komplekse_v_czifrah' ) ) : the_row(); ?>
    <section id="<?php echo esc_attr( $id ); ?>" class="aboutInNumbers">
        <div class="container">
            <div class="aboutInNumbers__wrapper">
                <div class="aboutInNumbers__numbers">
                <?php if ( have_rows( 'czifry' ) ) : ?>
                    <?php while ( have_rows( 'czifry' ) ) : the_row(); ?>
                        <?php $numbers = array (
                            'value' => get_sub_field( 'znachenie' ),
                            'label' => get_sub_field( 'yarlyk' ),
                            'pos_x' => get_sub_field( 'pozicziya_po_x' ),
                            'pos_y' => get_sub_field( 'pozicziya_po_y' )
                            );
                        ?>
                        <div class="aboutInNumbers__item" style="top: <?php echo $numbers['pos_y'] ?>%; left: <?php echo $numbers['pos_x'] ?>%;">
                            <span><?php echo $numbers['value'] ?></span>
                            <sup><?php echo $numbers['label'] ?></sup>
                        </div>
                    <?php endwhile; ?>
                <?php endif; ?>

                </div>
                <div class="aboutInNumbers__text">
                    <h2><?php the_sub_field( 'zagolovok' ); ?></h2>
                    <div class="aboutInNumbers__text--subtitle">
                        <?php the_sub_field( 'podzagolovok' ); ?>
                    </div>
                    <div class="aboutInNumbers__text--description">
                        <?php the_sub_field( 'opisanie' ); ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php endwhile; ?>
<?php endif; ?>