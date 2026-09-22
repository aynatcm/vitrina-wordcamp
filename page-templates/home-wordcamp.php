<?php
/**
 * Template Name: Home WordCamp
 * Template Post Type: page
 */

get_header();

$products = new WP_Query(
	array(
		'post_type'      => 'producto',
		'post_status'    => 'publish',
		'posts_per_page' => 6,
		'orderby'        => 'menu_order date',
		'order'          => 'ASC',
	)
);
?>

<section class="hero">
	<div class="site-wrap hero__grid">
		<div>
			<p class="eyebrow">WordCamp Managua 2026</p>
			<h1>No todo lo que vende necesita <em>WooCommerce.</em></h1>
			<p class="hero__copy">Una vitrina clara, productos editables y contacto directo pueden resolverse con WordPress, un post type y tres campos.</p>
			<div class="hero__actions">
				<a class="button" href="#catalogo">Ver catálogo</a>
				<a class="button button--ghost" href="#como-funciona">Ver cómo funciona</a>
			</div>
		</div>
		<div class="hero__visual" aria-hidden="true">
			<div class="demo-card">
				<div class="demo-card__top">
					<span class="demo-card__tag">Producto destacado</span>
					<span class="demo-price">C$ 680</span>
				</div>
				<h2>Un catálogo pequeño también merece buena experiencia.</h2>
				<p>Sin carrito, checkout, impuestos ni complejidad innecesaria.</p>
			</div>
		</div>
	</div>
</section>

<section class="section section--white" id="catalogo">
	<div class="site-wrap">
		<div class="section-heading">
			<h2>Productos administrados desde WordPress.</h2>
			<p>Cada tarjeta nace del CPT <strong>Producto</strong>. Cambiás título, imagen, precio, descripción y enlace desde el panel.</p>
		</div>

		<?php if ( $products->have_posts() ) : ?>
			<div class="product-grid">
				<?php while ( $products->have_posts() ) : $products->the_post(); ?>
					<?php $data = vitrina_wordcamp_product_data( get_the_ID() ); ?>
					<article class="product-card">
						<a class="product-card__media" href="<?php the_permalink(); ?>" aria-label="Ver <?php the_title_attribute(); ?>">
							<?php if ( has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( 'vitrina-card' ); ?>
							<?php else : ?>
								<span class="product-card__placeholder" aria-hidden="true">✦</span>
							<?php endif; ?>
						</a>
						<div class="product-card__body">
							<div class="product-card__meta">
								<h3><?php the_title(); ?></h3>
								<?php if ( $data['price'] ) : ?><span class="product-card__price"><?php echo esc_html( $data['price'] ); ?></span><?php endif; ?>
							</div>
							<?php if ( $data['summary'] ) : ?><p><?php echo esc_html( $data['summary'] ); ?></p><?php endif; ?>
							<a class="text-link" href="<?php the_permalink(); ?>">Ver detalles →</a>
						</div>
					</article>
				<?php endwhile; ?>
			</div>
		<?php else : ?>
			<div class="empty-state">Agregá productos desde <strong>Productos → Agregar producto</strong>.</div>
		<?php endif; ?>
		<?php wp_reset_postdata(); ?>
	</div>
</section>

<section class="section section--dark" id="como-funciona">
	<div class="site-wrap">
		<div class="section-heading">
			<h2>Tres piezas. Ningún plugin.</h2>
			<p>Solución intencionalmente pequeña para explicar decisiones técnicas sin ocultarlas detrás de una herramienta.</p>
		</div>
		<div class="steps">
			<article class="step">
				<h3>Post type</h3>
				<p><code>register_post_type()</code> convierte productos en contenido administrable.</p>
			</article>
			<article class="step">
				<h3>Campos nativos</h3>
				<p>Meta boxes guardan precio, descripción corta y enlace de contacto.</p>
			</article>
			<article class="step">
				<h3>Template</h3>
				<p><code>WP_Query</code> muestra catálogo. Theme controla diseño y experiencia.</p>
			</article>
		</div>
	</div>
</section>

<section class="cta">
	<div class="site-wrap cta__box">
		<h2>Elegí complejidad según negocio, no según costumbre.</h2>
		<p>Si necesitás carrito, pagos, inventario e impuestos, WooCommerce tiene sentido. Si solo necesitás mostrar y conversar, una vitrina puede bastar.</p>
		<a class="button" href="<?php echo esc_url( admin_url( 'post-new.php?post_type=producto' ) ); ?>">Agregar producto</a>
	</div>
</section>

<?php get_footer(); ?>
