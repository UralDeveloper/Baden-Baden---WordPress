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
		<div class="container-fluid header__container">
			<div class="header__logo">
				<a href="<?php home_url('/'); ?>">
					<img src="<?php the_badden_assets('img', 'logo-main.svg'); ?>" alt="">
				</a>
			</div>
			<div class="header__menu">
				<ul class="nav">
					<li class="nav-item"><a href="#" class="nav-link active">Проживание</a></li>
					<li class="nav-item"><a href="#" class="nav-link">Прайсы</a></li>
					<li class="nav-item"><a href="#" class="nav-link">Бассейны</a></li>
					<li class="nav-item"><a href="#" class="nav-link">Бани</a></li>
					<li class="nav-item"><a href="#" class="nav-link">СПА</a></li>
					<li class="nav-item"><a href="#" class="nav-link">Акции</a></li>
					<li class="nav-item"><a href="#" class="nav-link">Сертификаты</a></li>
					<li class="nav-item"><a href="#" class="nav-link">Лента</a></li>
					<li class="nav-item"><a href="#" class="nav-link">Контакты</a></li>
				</ul>
			</div>
			<div class="header__social">
				<a href="#"><img src="<?php the_badden_assets('img', 'whatsapp.svg'); ?>" alt="Связаться с нами в WhatsApp"></a>
				<a href="#"><img src="<?php the_badden_assets('img', 'vk.svg'); ?>" alt="Мы в ВКонтакте"></a>
			</div>
		</div>
	</section>