<?php
/**
 * Funciones del theme Vitrina WordCamp.
 * Código pequeño para explicar catálogo con CPT y ACF durante la charla.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function vitrina_wordcamp_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_image_size( 'vitrina-card', 720, 540, true );
}
add_action( 'after_setup_theme', 'vitrina_wordcamp_setup' );

function vitrina_wordcamp_assets() {
	wp_enqueue_style(
		'vitrina-wordcamp',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'vitrina_wordcamp_assets' );

/**
 * Post type nativo: suficiente para un catálogo sin carrito ni checkout.
 */
function vitrina_wordcamp_register_product_type() {
	$labels = array(
		'name'               => 'Productos',
		'singular_name'      => 'Producto',
		'add_new'            => 'Agregar producto',
		'add_new_item'       => 'Agregar producto',
		'edit_item'          => 'Editar producto',
		'new_item'           => 'Nuevo producto',
		'view_item'          => 'Ver producto',
		'search_items'       => 'Buscar productos',
		'not_found'          => 'No hay productos',
		'not_found_in_trash' => 'No hay productos en papelera',
		'menu_name'          => 'Productos',
	);

	register_post_type(
		'producto',
		array(
			'labels'       => $labels,
			'public'       => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-store',
			'has_archive'  => true,
			'rewrite'      => array( 'slug' => 'productos' ),
			'supports'     => array( 'title', 'editor', 'thumbnail' ),
		)
	);
}
add_action( 'init', 'vitrina_wordcamp_register_product_type' );

function vitrina_wordcamp_product_data( $post_id ) {
	if ( ! function_exists( 'get_field' ) ) {
		return array( 'price' => '', 'summary' => '', 'contact_url' => '' );
	}

	return array(
		'price'       => get_field( 'precio', $post_id ),
		'summary'     => get_field( 'resumen', $post_id ),
		'contact_url' => get_field( 'enlace_contacto', $post_id ),
	);
}
