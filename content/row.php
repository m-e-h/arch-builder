<?php
/**
 * Template for post rows.
 *
 * @package arch-builder
 */
?>

<div <?php hybrid_attr( 'post' ); ?>>

	<?php arch_title(); ?>

	<?php arch_excerpt(); ?>

	<?php $query = new WP_Query(
		array(
			'post_type' => get_post_type(),
			'post_parent' => get_the_ID(),
			'orderby' => 'menu_order',
			'order'   => 'ASC',
		)
	); ?>

<?php while ( $query->have_posts() ) : $query->the_post(); ?>

	<?php hybrid_get_content_template(); ?>

<?php endwhile; ?>

<?php wp_reset_postdata(); ?>

<?php edit_post_link('<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>'); ?>

</div>
