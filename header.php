<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
	<div class="site-wrap site-header__inner">
		<a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<span class="brand__mark">VW</span>
			<span>Vitrina WordCamp</span>
		</a>
		<nav class="site-nav" aria-label="Navegación principal">
			<a href="<?php echo esc_url( home_url( '/#catalogo' ) ); ?>">Catálogo</a>
			<a href="<?php echo esc_url( home_url( '/#como-funciona' ) ); ?>">Cómo funciona</a>
			<a class="button" href="<?php echo esc_url( admin_url( 'edit.php?post_type=producto' ) ); ?>">Administrar</a>
		</nav>
	</div>
</header>
<main id="contenido">
