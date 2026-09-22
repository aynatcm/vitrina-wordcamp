<?php
get_header();
?>
<section class="page-shell">
	<div class="site-wrap">
		<p class="eyebrow">Vitrina</p>
		<h1 class="page-title">Productos</h1>
		<div class="product-grid product-grid--spaced">
			<?php while ( have_posts() ) : the_post(); ?>
				<?php $data = vitrina_wordcamp_product_data( get_the_ID() ); ?>
				<article class="product-card">
					<a class="product-card__media" href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail() ) : the_post_thumbnail( 'vitrina-card' ); else : ?><span class="product-card__placeholder">✦</span><?php endif; ?>
					</a>
					<div class="product-card__body">
						<div class="product-card__meta"><h3><?php the_title(); ?></h3><span class="product-card__price"><?php echo esc_html( $data['price'] ); ?></span></div>
						<p><?php echo esc_html( $data['summary'] ); ?></p>
						<a class="text-link" href="<?php the_permalink(); ?>">Ver detalles →</a>
					</div>
				</article>
			<?php endwhile; ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>
