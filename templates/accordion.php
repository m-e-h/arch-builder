<?php
/**
 *
 * @package arch-builder
 */
wp_enqueue_script('arch-toggle'); ?>

<?php $query = new WP_Query( array( 'post_type' => get_post_type(), 'post_parent' => get_the_ID() ) ); ?>

<div <?php hybrid_attr('post'); ?>>

<?php while ($query->have_posts()) : $query->the_post(); ?>

	<a class="collapse-toggle u-f-plus u-px2 u-py1 u-1of1 u-flex u-flex-justify-between" data-collapse="#toggle<?php the_ID(); ?>" data-group="accordion" href="#"><?php the_title(); ?> <svg class="chevron-toggle" viewBox="0 0 24 24" width="24" height="24" fill="currentcolor"><path fill="none" d="M0 0h24v24H0z"/><path d="M20 9l-8 8-8-8 1.414-1.414L12 14.172l6.586-6.586"/></svg>
	</a>

	<div class="collapse" id="toggle<?php the_ID(); ?>">
		<div class="collapse-wrap u-px2 u-pt1 u-pb3">
	    	<?php arch_excerpt(); ?>
		</div>
	</div>

<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
</div>
