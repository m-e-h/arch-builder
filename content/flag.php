<?php
/**
 * Flag Component Template.
 *
 * @package abraham
 */

?>
<article <?php hybrid_attr( 'post' ); ?>>

	<?php
	if ( locate_template( 'components/img-thumb.php' ) != '' ) {

		get_template_part( 'components/img', 'thumb' );

	} else {

		get_the_image(array(
			'image_class'       => 'u-of-cover',
			'attachment' 		=> false,
			'link_to_post' 		=> false,
		));
	}
	?>

	<div class="flag-body u-flex u-flex-wrap u-flexed-auto">

		<?php arch_title(); ?>
		<?php arch_excerpt(); ?>

	</div>

	<?php edit_post_link( '<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/></svg>' ); ?>

</article>
