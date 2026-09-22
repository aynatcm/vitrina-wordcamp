<?php get_header(); ?>
<section class="page-shell">
	<div class="site-wrap entry">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<p class="eyebrow">Contenido</p>
				<h1 class="page-title"><?php the_title(); ?></h1>
				<div class="entry-content"><?php the_content(); ?></div>
			<?php endwhile; ?>
		<?php else : ?>
			<div class="empty-state">No hay contenido todavía.</div>
		<?php endif; ?>
	</div>
</section>
<?php get_footer(); ?>
