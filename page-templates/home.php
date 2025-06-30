<?php

/**
 * Template Name: Home
 */
get_header(); ?>
<?php if ( have_rows( 'tpl_home_settings' ) ) : ?>
	<?php while ( have_rows( 'tpl_home_settings' ) ) : the_row(); ?>
    <section class="firstScreen">
        <div class="firstScreen__videoBackground">
        <?php $izobrazhenie = get_sub_field( 'izobrazhenie' ); ?>
        <?php if ( $izobrazhenie ) : ?>
            <video poster="<?php echo esc_url( $izobrazhenie['url'] ); ?>" muted autoplay loop>
                <?php if ( get_sub_field( 'video_mp4' ) ) : ?>
                    <source src="<?php the_sub_field( 'video_mp4' ); ?>" type="video/mp4">
                <?php endif; ?>
                <?php if ( get_sub_field( 'video_webm' ) ) : ?>
                    <source src="<?php the_sub_field( 'video_webm' ); ?>" type="video/webm">
                <?php endif; ?>
            </video>
        <?php endif; ?>
        </div>
        <div class="container firstScreen__container">
            <?php if ( get_sub_field( 'logotip_na_pervom_ekrane' ) == 1 ) : ?>
                <div class="firstScreen__logo">
					<?php if (get_sub_field('logotip_na_pervom_ekrane_logo')) { ?>
						<img src="<?php the_sub_field('logotip_na_pervom_ekrane_logo'); ?>" alt="<?php the_title(); ?>"  title="<?php the_title(); ?>">
					<?php } else { ?>
                    	<img src="<?php the_badden_assets('img', 'logotip-main.svg') ?>"  title="<?php the_title(); ?>" alt="<?php the_title(); ?>">
					<?php } ?>
                </div>
            <?php endif; ?>
            <div class="firstScreen__description">
                <?php the_sub_field( 'opisanie' ); ?>
            </div>
        </div>
    </section>
    <?php endwhile; ?>
<?php endif; ?>

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