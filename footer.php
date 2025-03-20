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
<section class="footer">
    <div class="container footer__container">
        <div class="col-md-3">
            <div class="footer__logo">
                <img src="<?php the_badden_assets('img', 'logo-footer_white.svg'); ?>" alt="">
            </div>
            <div class="footer__text">
            </div>
        </div>
        <div class="col-md-6">
            <ul class="nav flex-column">
                <li class="nav-item"><a href="#" class="nav-link">Еткуль</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Реж</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Уктус</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Курган</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Тургояк</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Cuba-Cuba</a></li>
                <li class="nav-item"><a href="#" class="nav-link">Шарташ пляж</a></li>
            </ul>
        </div>
        <div class="col-md-3">
            <a href="https://baden-apart.ru/" target="_blank" class="btn_apparts">Купить апартаменты</a>
        </div>
    </div>
    <div class="container footer__container footer__container-2">
        <p class="copyright">2025 &copy; Баден-Баден</p>
        <ul class="nav">
            <li class="nav-item"><a class="nav-link" href="#">Реквизиты</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Правила посещения «Фабрика отдыха»</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Правила оплаты</a></li>
        </ul>
    </div>
</section>
<?php wp_footer(); ?>

</body>
</html>
