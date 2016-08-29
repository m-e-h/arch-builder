<?php
/**
 * Template for post rows.
 *
 * @package arch-builder
 */
?>

<div <?php hybrid_attr( 'post' ); ?>>
	<?php $query = new WP_Query(
		array(
			'post_type' => get_post_type(),
			'post_parent' => get_the_ID(),
			'orderby' => 'menu_order',
			'order'   => 'ASC',
		)
	); ?>
	<div class="row-inner u-max-center u-flexed-stretch u-flex u-flex-wrap u-flexed-auto">
<?php while ( $query->have_posts() ) : $query->the_post(); ?>

	<?php hybrid_get_content_template(); ?>

<?php endwhile; ?>
</div>
<?php wp_reset_postdata(); ?>

</div>
