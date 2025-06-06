<?php

/**
 * Template Name: Пустой шаблон страницы
 */

get_header(); ?>
<section class="firstScreen_singlePage">
    <div class="firstScreen_singlePage__bg">
		<picture>
			<?php if ( have_rows( 'dopolnitelnye_foto' ) ) : ?>
				<?php while ( have_rows( 'dopolnitelnye_foto' ) ) : the_row(); ?>
					<?php $dlya_telefona = get_sub_field( 'dlya_telefona' ); ?>
					<?php if ( $dlya_telefona ) : ?>
						<source media="(max-width: 767px)" srcset="<?php echo esc_url( $dlya_telefona['url'] ); ?>" />
					<?php endif; ?>
					
					<?php $dlya_plansheta = get_sub_field( 'dlya_plansheta' ); ?>
					<?php if ( $dlya_plansheta ) : ?>
						<source media="(min-width: 768px) and (max-width: 1024px)" srcset="<?php echo esc_url( $dlya_plansheta['url'] ); ?>" />
					<?php endif; ?>
				<?php endwhile; ?>
			<?php endif; ?>
			<img src="<?php the_post_thumbnail_url(); ?>" alt="">
		</picture>
    </div>
    <div class="firstScreen_singlePage__content container">
        <div class="firstScreen_singlePage__title">
            <h1><?php the_title(); ?></h1>
        </div>
    </div>
</section>

<section id="travelline" class="container" data-travelLine="<?php the_field( 'travelline_id', 'option' ); ?>">
    <div class="grid">
        <div class="travel-script">
            <!-- start TL Search form script -->
            <div id="block-search">
                <div id="tl-search-form" class="tl-container">
                    <!-- <noindex><a href="https://www.travelline.ru/products/tl-hotel/" rel="nofollow" target="_blank">TravelLine</a></noindex> -->
                </div>
            </div>
            <!-- end TL Search form script -->
        </div>
    </div>
</section>

<?php the_content(); ?>

<?php get_footer(); ?>