<?php
/**
 * General fallback template for post archives.
 *
 * @package abraham
 */
?>
<article <?php hybrid_attr('post'); ?>>
AAACCCOOORRRDDDIIIOOOONNNNNNNNN

		<header <?php hybrid_attr('entry-header'); ?>>
			<?php
				get_the_image(array(
					'size' => 'abe-card-md',
					'image_class' => 'u-br-t u-1of1',
					'before'             => '<div class="card-img u-overflow-hidden">',
					'after'              => '</div>',
				));
			?>
			<h2 <?php hybrid_attr('entry-title'); ?>>
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>
		</header>

		<div <?php hybrid_attr('entry-summary'); ?>>
			<?php arch_excerpt(); ?>
		</div>

</article>
