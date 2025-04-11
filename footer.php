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
                        <img src="<?php the_badden_assets('img', 'phone.svg'); ?>" alt="">
                        <span><a href="tel:<?php the_field( 'op_telefon', 'option' ); ?>"><?php the_field( 'op_telefon', 'option' ); ?></a></span>
                    </div>
                </div>
                <div class="contacts__contacts__item">
                    <div>
                        <img src="<?php the_badden_assets('img', 'mail.svg'); ?>" alt="">
                        <span><a href="mailto:<?php the_field( 'op_email', 'option' ); ?>"><?php the_field( 'op_email', 'option' ); ?></a></span>
                    </div>
                </div>
            </div>
            <div class="contacts__contacts__items">
                <div class="contacts__contacts__item">
                    <span class="location_name">Фабрика отдыха</span>
                    <div>
                        <img src="<?php the_badden_assets('img', 'flag.svg'); ?>" alt="">
                        <span class="location_address"><?php the_field( 'op_adres_1', 'option' ); ?></span>
                    </div>
                </div>
                <div class="contacts__contacts__item">
                    <span class="location_name">Эко деревня</span>
                    <div>
                        <img src="<?php the_badden_assets('img', 'flag.svg'); ?>" alt="">
                        <span class="location_address"><?php the_field( 'op_adres_2', 'option' ); ?></span>
                    </div>
                </div>
            </div>
            <div class="contacts__contacts__items">
                <div class="contacts__contacts__item">
                    <span class="location_name">Режим работы</span>
                    <div>
                        <img src="<?php the_badden_assets('img', 'time.svg'); ?>" alt="">
                        <span><?php the_field( 'op_rezhim_raboty', 'option' ); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="footer">
    <div class="container footer__container">
        <div class="footer__copyright">
            <a href="<?php home_url('/')?>"><img src="<?php the_badden_assets('img', 'logo-footer.svg'); ?>" alt=""></a>
            <ul>
                <li><?php echo date('Y');?> &copy; Баден-Баден</li>
                <li><a href="#">Реквизиты</a></li>
                <li><a href="#">Правила посещения «Фабрика отдыха»</a></li>
                <li><a href="#">Правила оплаты</a></li>
            </ul>
        </div>
        <div class="footer__nav">
            <ul>
                <li><a href="#">Еткуль</a></li>
                <li><a href="#">Уктус</a></li>
                <li><a href="#">Тургояк</a></li>
                <li><a href="#">Шарташ пляж</a></li>
            </ul>
            <ul>
                <li><a href="#">Реж</a></li>
                <li><a href="#">Курган</a></li>
                <li><a href="#">Cuba-Cuba</a></li>
            </ul>
        </div>
        <div class="footer__booking">
            <a href="https://baden-apart.ru/" target="_blank" class="btn btn--hoverBlue btn--border-black">Купить апартаменты</a>
        </div>
    </div>
</section>

<?php wp_footer(); ?>

</body>
</html>
