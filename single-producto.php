<?php get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
	<?php $data = vitrina_wordcamp_product_data( get_the_ID() ); ?>
	<section class="page-shell">
		<div class="site-wrap single-product">
			<div class="single-product__media">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'large' ); ?>
				<?php else : ?>
					<span class="product-card__placeholder" aria-hidden="true">✦</span>
				<?php endif; ?>
			</div>
			<div class="single-product__details">
				<p class="eyebrow">Producto</p>
				<h1><?php the_title(); ?></h1>
				<?php if ( $data['price'] ) : ?><p class="single-product__price"><?php echo esc_html( $data['price'] ); ?></p><?php endif; ?>
				<?php if ( $data['summary'] ) : ?><p class="single-product__summary"><?php echo esc_html( $data['summary'] ); ?></p><?php endif; ?>
				<div class="entry-content"><?php the_content(); ?></div>
				<?php if ( $data['contact_url'] ) : ?>
					<a class="button" href="<?php echo esc_url( $data['contact_url'] ); ?>" target="_blank" rel="noopener noreferrer">Consultar producto</a>
				<?php endif; ?>
			</div>
		</div>
	</section>
<?php endwhile; ?>

<?php get_footer(); ?>
