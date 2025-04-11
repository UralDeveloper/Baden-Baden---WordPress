<?php
/**
 * Block template file: /baden/template-parts/blocks/acf-priceList.php
 *
 * Price Block Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'price-block-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>

<?php if ( have_rows( 'block_prajs' ) ) : ?>
    <?php while ( have_rows( 'block_prajs' ) ) : the_row(); ?>
    <section id="<?php echo esc_attr( $id ); ?>" class="pricing">
        <div class="titleBlock">
            <h2><?php the_sub_field( 'zagolovok' ); ?></h2>
        </div>
        <?php if ( have_rows( 'prajs-list' ) ) : ?>
            <?php while ( have_rows( 'prajs-list' ) ) : the_row(); ?>
            <div class="container pricing__container">
                <h3><?php the_sub_field( 'tip_uslugi' ); ?></h3>
                <div class="pricing__wrapper">
                    <?php if ( have_rows( 'prajs-row' ) ) : ?>
                        <?php while ( have_rows( 'prajs-row' ) ) : the_row(); ?>
                        <div class="pricing__row">
                            <div class="pricing__title">
                                <h3><?php the_sub_field( 'kategoriya' ); ?></h3>
                                <p><?php the_sub_field( 'opisanie' ); ?></p>
                            </div>
                            <div class="pricing__content">
                                <?php if ( have_rows( 'czeny' ) ) : ?>
                                    <?php while ( have_rows( 'czeny' ) ) : the_row(); ?>
                                    <div class="pricing__content--col">
                                        <span class="pricing__content--title">
                                            <?php the_sub_field( 'nazvanie' ); ?>
                                        </span>
                                        <ul class="pricing__content--priceList">
                                            <li><?php the_sub_field( 'czena_1' ); ?></li>
                                            <li><?php the_sub_field( 'czena_2' ); ?></li>
                                        </ul>
                                    </div>
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    <?php endif; ?>   
                    <div class="pricing__runningTitle">
                        <?php the_sub_field( 'disklejmer' ); ?>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </section>
    <?php endwhile; ?>
<?php endif; ?>