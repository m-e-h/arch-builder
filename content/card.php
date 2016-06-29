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
	if ( $video ) {
		echo $video;

	} else {
		get_the_image(array(
			'size'               => 'large',
			'image_class'        => 'arch-1of1 o-crop__content',
			'before'             => '<div class="card-img arch-overflow-hidden o-crop o-crop--16x9">',
			'after'              => '</div>',
		));
	}
	?>

	<?php arch_title(); ?>

	<?php arch_excerpt(); ?>

	<?php edit_post_link(); ?>

</article>

<?php
