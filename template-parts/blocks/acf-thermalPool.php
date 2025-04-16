<?php
/**
 * Block template file: /baden/template-parts/blocks/acf-thermalPool.php
 *
 * Thermalpool Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'thermalpool-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>

<?php if ( have_rows( 'block_termalnyj_bassejn' ) ) : ?>
    <?php while ( have_rows( 'block_termalnyj_bassejn' ) ) : the_row(); ?>
    <div id="<?php echo esc_attr( $id ); ?>" class="thermalPool">
        <div class="container thermalPool__container">
            <div class="titleBlock">
                <h2><?php the_sub_field( 'zagolovok' ); ?></h2>
            </div>
            <div class="thermalPool__wrapper">
                <div class="thermalPool__attrs">
                    <?php if ( have_rows( 'parametry' ) ) : ?>
                    <ul>
                    <?php while ( have_rows( 'parametry' ) ) : the_row(); ?>
                        <li>
                            <?php $ikonka = get_sub_field( 'ikonka' ); ?>
                            <?php if ( $ikonka ) : ?>
                                <picture>
                                    <img src="<?php echo esc_url( $ikonka['url'] ); ?>" alt="<?php echo esc_attr( $ikonka['alt'] ); ?>" />
                                </picture>
                            <?php endif; ?>
                            <span><?php the_sub_field( 'tekst' ); ?></span>
                        </li>                
                    <?php endwhile; ?>
                    </ul>
                <?php endif; ?>
                </div>
                <div class="thermalPool__images">
                    <?php $izobrazhenie = get_sub_field( 'izobrazhenie' ); ?>
                    <?php if ( $izobrazhenie ) : ?>
                        <img src="<?php echo esc_url( $izobrazhenie['url'] ); ?>" alt="<?php echo esc_attr( $izobrazhenie['alt'] ); ?>" />
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endwhile; ?>
<?php endif; ?>