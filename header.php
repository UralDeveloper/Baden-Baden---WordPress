<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Baden_Baden
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<section class="header">
		<div class="container header__container">
			<div class="header__logo">
				<a href="<?php echo home_url('/'); ?>">
					<img src="<?php the_badden_assets('img', 'logo-main.svg'); ?>" alt="">
				</a>
			</div>
			<div class="header__menu navbar">
				<?php
				wp_nav_menu([
					'theme_location' => 'menu-1', // Указываем место в теме
					'container'      => false, // Без обертки <div>
					'menu_class'     => 'nav', // Класс для <ul>
					'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
					'depth'          => 2, // Глубина вложенности
					'walker'         => new Custom_Walker_Nav_Menu(), // Кастомный Walker
				]);
				?>
			</div>

			<div class="header__social">
				<a href="<?php the_field( 'op_ssylka_na_whatsapp', 'option' ); ?>"><img src="<?php the_badden_assets('img', 'whatsapp.svg'); ?>" alt="Связаться с нами в WhatsApp"></a>
				<a href="<?php the_field( 'op_ssylka_na_vk', 'option' ); ?>"><img src="<?php the_badden_assets('img', 'vk.svg'); ?>" alt="Мы в ВКонтакте"></a>
			</div>
			<div class="header__mobile">
                <button class="header__menu-btn" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                    <i class="fa-sharp fa-solid fa-bars"></i>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
                    aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasRightLabel">
                            <a href="/"><img src="@img/logo-menu.svg" alt=""></a>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
						<?php
							wp_nav_menu([
								'theme_location' => 'menu-1', // Указываем место в теме
								'container'      => false, // Без обертки <div>
								'menu_class'     => 'nav', // Класс для <ul>
								'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
								'depth'          => 2, // Глубина вложенности
								'walker'         => new Custom_Walker_Nav_Menu(), // Кастомный Walker
							]);
						?>
                        <ul class="subNav">
                            <li class="nav-item">
                                <a href="https://baden-baden.ru/" class="nav-link" target="_blank">Баден-Баден</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://baden-apart.ru/" class="nav-link" target="_blank">Купить апартамент</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
		</div>
	</section>