<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Baden_Baden
 */

?>

<section class="contacts" id="contacts_section">
    <div id="map"></div>
    <div class="container">
        <div class="contacts__contacts">
            <div class="contacts__contacts__title">
                <h2>Контакты</h2>
            </div>
            <div class="contacts__contacts__items">
                <div class="contacts__contacts__item">
                    <div>
                        <img src="<?php the_badden_assets('img', 'phone.svg'); ?>" title="Телефон" alt="Телефон">
                        <span><a href="tel:<?php the_field( 'op_telefon', 'option' ); ?>"><?php the_field( 'op_telefon', 'option' ); ?></a></span>
                    </div>
                </div>
                <div class="contacts__contacts__item">
                    <div>
                        <img src="<?php the_badden_assets('img', 'mail.svg'); ?>" title="Email" alt="Email">
                        <span><a href="mailto:<?php the_field( 'op_email', 'option' ); ?>"><?php the_field( 'op_email', 'option' ); ?></a></span>
                    </div>
                </div>
            </div>
            <div class="contacts__contacts__items">
                <div class="contacts__contacts__item">
                    <?php if (get_field('op_adres_1', 'option' ) && get_field('op_nazvanie_kompleksa_1', 'option')) { ?>
                    <span class="location_name"><?php the_field( 'op_nazvanie_kompleksa_1', 'option' ); ?></span>
                    <div>
                        <img src="<?php the_badden_assets('img', 'flag.svg'); ?>" title="<?php the_field( 'op_adres_1', 'option' ); ?>" alt="<?php the_field( 'op_adres_1', 'option' ); ?>">
                        <span class="location_address"><?php the_field( 'op_adres_1', 'option' ); ?></span>
                    </div>
                    <?php } ?>
                </div>
                <div class="contacts__contacts__item">
                    <?php if (get_field('op_adres_2', 'option' ) && get_field('op_nazvanie_kompleksa_2', 'option')) { ?>
                    <span class="location_name"><?php the_field( 'op_nazvanie_kompleksa_2', 'option' ); ?></span>
                    <div>
                        <img src="<?php the_badden_assets('img', 'flag.svg'); ?>" title="<?php the_field( 'op_adres_2', 'option' ); ?>" alt="<?php the_field( 'op_adres_2', 'option' ); ?>">
                        <span class="location_address"><?php the_field( 'op_adres_2', 'option' ); ?></span>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="contacts__contacts__items">
                <div class="contacts__contacts__item">
                    <span class="location_name">Режим работы</span>
                    <div>
                        <img src="<?php the_badden_assets('img', 'time.svg'); ?>" title="Режим работы: <?php the_field( 'op_rezhim_raboty', 'option' ); ?>" alt="Режим работы">
                        <span><?php the_field( 'op_rezhim_raboty', 'option' ); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
<section class="footer">
    <div class="container footer__container">
        <div class="footer__copyright">
            <style>
                .footer__copyright ul li:has(a) {
                    padding: 4px 0px;
                }
                .footer__copyright ul li a {
                    font-size: 16px;
                    line-height: 1.3em;
                }
            </style>
            <a href="<?php home_url('/')?>" title="<?php echo get_bloginfo( 'name' )?>">
                <img src="<?php the_badden_assets('img', 'logo-footer.svg'); ?>" title="Баден баден" alt="Баден баден">
            </a>
            <?php 
                $args = array(
                    'theme_location'    => 'footer-1',
                    'depth'	            => 1,
                    'container'         => false,
                    'fallback_cb'       => false,
                    'items_wrap'        => '<ul id="%1$s" class="%2$s"><li>' . date('Y') .' &copy; Баден-Баден</li>%3$s</ul>',
                );
                
                wp_nav_menu( $args );
            ?>
        </div>
        <div class="footer__nav">
            <ul>
                <li><a href="https://baden74.ru">Еткуль</a></li>
                <li><a href="https://baden-uktus.ru">Уктус</a></li>
                <li><a href="https://baden-turgoyak.ru">Тургояк</a></li>
                <li><a href="https://шарташ-пляж.рф">Шарташ пляж</a></li>
            </ul>
            <ul>
                <li><a href="https://уральский-источник.рф">Реж</a></li>
                <li><a href="https://baden45.ru">Курган</a></li>
                <li><a href="https://cubacuba.ru">Cuba-Cuba</a></li>
            </ul>
        </div>
        <div class="footer__booking">
            <a href="https://baden-apart.ru/" target="_blank" class="btn btn--hoverBlue btn--border-black">Купить апартаменты</a>
        </div>
    </div>
</section>
<?php if ( have_rows( 'op_integraczii', 'option' ) ) : ?>
	<?php while ( have_rows( 'op_integraczii', 'option' ) ) : the_row(); ?>
		<?php echo get_sub_field( 'kod_integraczii' ); ?>
	<?php endwhile; ?>
<?php endif; ?>
<?php if ( get_field( 'cookies_vkl_vykl', 'option' ) == 1 ) : ?>
    <div class="cookies">
        <div class="cookies__wrapper">
            <div class="cookies__text">Оставаясь на сайте я выражаю согласие на обработку моих персональных данных, с использованием <a href="<?php the_field( 'cookies_ssylka_na_obrabotku_personalnyh_dannyh', 'option' ); ?>">файлов cookie</a></div>
            <button class="cookies__btn">Хорошо</button>
        </div>
    </div>
<?php endif; ?>

<?php wp_footer(); ?>
<!-- <script src="<?//php echo get_template_directory(); ?>/assets/js/spa-init.js" type="module"></script> -->

</body>
</html>
