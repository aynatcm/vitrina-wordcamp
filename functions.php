<?php
/**
 * Funciones del theme Vitrina WordCamp.
 * Todo vive aquí a propósito: código fácil de explicar durante la charla.
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

/**
 * Tres campos nativos. Sin ACF y sin plugin de e-commerce.
 */
function vitrina_wordcamp_add_product_meta_box() {
	add_meta_box(
		'vitrina_product_details',
		'Datos del producto',
		'vitrina_wordcamp_render_product_meta_box',
		'producto',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'vitrina_wordcamp_add_product_meta_box' );

function vitrina_wordcamp_render_product_meta_box( $post ) {
	wp_nonce_field( 'vitrina_save_product', 'vitrina_product_nonce' );

	$price       = get_post_meta( $post->ID, '_vitrina_price', true );
	$summary     = get_post_meta( $post->ID, '_vitrina_summary', true );
	$contact_url = get_post_meta( $post->ID, '_vitrina_contact_url', true );
	?>
	<p>
		<label for="vitrina_price"><strong>Precio</strong></label><br>
		<input class="widefat" id="vitrina_price" name="vitrina_price" type="text" value="<?php echo esc_attr( $price ); ?>" placeholder="Ej. C$ 650">
	</p>
	<p>
		<label for="vitrina_summary"><strong>Descripción corta</strong></label><br>
		<textarea class="widefat" id="vitrina_summary" name="vitrina_summary" rows="3" placeholder="Una frase para la tarjeta del catálogo."><?php echo esc_textarea( $summary ); ?></textarea>
	</p>
	<p>
		<label for="vitrina_contact_url"><strong>Enlace de contacto</strong></label><br>
		<input class="widefat" id="vitrina_contact_url" name="vitrina_contact_url" type="url" value="<?php echo esc_attr( $contact_url ); ?>" placeholder="https://wa.me/505...">
	</p>
	<?php
}

function vitrina_wordcamp_save_product_meta( $post_id ) {
	if (
		! isset( $_POST['vitrina_product_nonce'] ) ||
		! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['vitrina_product_nonce'] ) ), 'vitrina_save_product' ) ||
		( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) ||
		! current_user_can( 'edit_post', $post_id )
	) {
		return;
	}

	$fields = array(
		'vitrina_price'       => array( '_vitrina_price', 'sanitize_text_field' ),
		'vitrina_summary'     => array( '_vitrina_summary', 'sanitize_textarea_field' ),
		'vitrina_contact_url' => array( '_vitrina_contact_url', 'esc_url_raw' ),
	);

	foreach ( $fields as $field => $config ) {
		if ( isset( $_POST[ $field ] ) ) {
			$value = call_user_func( $config[1], wp_unslash( $_POST[ $field ] ) );
			update_post_meta( $post_id, $config[0], $value );
		}
	}
}
add_action( 'save_post_producto', 'vitrina_wordcamp_save_product_meta' );

function vitrina_wordcamp_product_data( $post_id ) {
	return array(
		'price'       => get_post_meta( $post_id, '_vitrina_price', true ),
		'summary'     => get_post_meta( $post_id, '_vitrina_summary', true ),
		'contact_url' => get_post_meta( $post_id, '_vitrina_contact_url', true ),
	);
}

function vitrina_wordcamp_activate() {
	vitrina_wordcamp_register_product_type();
	flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'vitrina_wordcamp_activate' );
