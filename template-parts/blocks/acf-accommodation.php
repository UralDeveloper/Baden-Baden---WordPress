<?php

/**
 * Block template file: /baden/template-parts/blocks/acf-accommodation.php
 *
 * Accommodation Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'accommodation-' . $block['id'];
if (! empty($block['anchor'])) {
    $id = $block['anchor'];
}
?>

<section class="accommodation">
    <?php if ( have_rows( 'block_prozhivanie' ) ) : ?>
    <div class="container">
        <?php while ( have_rows( 'block_prozhivanie' ) ) : the_row(); ?>
            <div class="titleBlock">
                <h2><?php the_sub_field( 'zagolovok' ); ?></h2>
            </div>
            <?php if ( have_rows( 'napolnenie' ) ): ?>
            <div class="accommodation__wrapper">
                <div class="titleWrapper">
                    <ul>
                        <?php while ( have_rows( 'napolnenie' ) ) : the_row(); ?>
                            <?php if ( get_row_layout() == 'carousel' ) : ?>
                                <li><?php the_sub_field( 'nazvanie' ); ?></li>
                            <?php elseif ( get_row_layout() == 'link' ) : ?>
                                <?php $ssylka_na_straniczu = get_sub_field( 'ssylka_na_straniczu' ); ?>
                                <?php if ( $ssylka_na_straniczu ) : ?>
                                    <li>
                                        <a href="<?php echo get_permalink( $ssylka_na_straniczu ); ?>">
                                            <?php echo get_the_title( $ssylka_na_straniczu ); ?>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </ul>
                    <?php while ( have_rows( 'napolnenie' ) ) : the_row(); ?>
                        <?php if ( get_row_layout() == 'carousel' ) : ?>
                            <p><?php the_sub_field( 'opisanie' ); ?></p>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>

                <?php while ( have_rows( 'napolnenie' ) ) : the_row(); ?>
                    <?php if ( get_row_layout() == 'carousel' ) : ?>
                        <div class="swiper accommodation-slider">
                            <div class="swiper-wrapper">
                                <?php $zapisi = get_sub_field( 'zapisi' ); ?>
                                <?php if ( $zapisi ) : ?>
                                    <?php foreach ( $zapisi as $post_ids ) : 
                                        $post_object = get_post( $post_ids );
                                        setup_postdata( $post_object ); ?>
                                        <div class="swiper-slide accommodation__item">
                                            <div class="accommodation__image">
                                                <img src="<?php echo get_the_post_thumbnail_url( $post_ids, 'full' ); ?>" alt="<?php echo get_the_title( $post_ids ); ?>">
                                            </div>
                                            <div class="accommodation__text">
                                                <div class="price"><?php the_field('accommodation-price', $post_ids); ?> ₽</div>
                                                <h3><?php echo get_the_title( $post_ids ); ?></h3>
                                                <p><?php echo get_the_excerpt( $post_ids ); ?></p>
                                                <a href="<?php echo get_permalink( $post_ids ); ?>" class="accommodation__button btn btn--border btn--hoverBlue">Забронировать</a>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                    <?php wp_reset_postdata(); ?>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
            <?php endif; ?>
        <?php endwhile; ?>
    </div>
    <?php endif; ?>
</section>
