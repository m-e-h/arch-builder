<?php
/**
 * Cards Component Template.
 *
 * @package abraham
 */

$video = hybrid_media_grabber(
	array(
		'type'        => 'video',
		'split_media' => true,
	)
);
?>
<article <?php hybrid_attr( 'post' ); ?>>

	<?php
	get_the_image(array(
			'size'               => 'thumbnail',
			'image_class'        => 'u-1of3 u-1of4-md u-of-cover',
			'link_to_post'		=> false,
		));
	?>
	<div class="flag-body u-flexed-auto">
		<?php arch_title(); ?>

		<?php arch_excerpt(); ?>
	</div>

	<?php edit_post_link(); ?>

</article>

<?php
