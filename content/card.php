<?php
/**
 * Cards Component Template.
 *
 * @package arch
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
	} elseif ( locate_template( 'components/img-hd.php' ) != '' ) {
		// yep, load the page template
		get_template_part( 'components/img', 'hd' );
	} else {
		get_the_image(array(
			'size' 				=> 'large',
			'image_class' 		=> 'u-1of1 o-crop__content',
			'before'   			=> '<div class="card-img u-overflow-hidden o-crop o-crop--16x9">',
			'after' 			=> '</div>',
			'attachment' 		=> false,
			'link_to_post' 		=> false,
		));
	}
	?>

	<?php arch_title(); ?>
	<?php arch_excerpt(); ?>
	<?php edit_post_link( '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>' ); ?>

</article>
<?php
