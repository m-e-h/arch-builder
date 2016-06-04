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
			'image_class'        => 'u-1of1 u-of-cover',
			'before'             => '<div class="card-img arch-overflow-hidden u-flexed-s0 u-1of3 u-1of4-lg">',
			'after'              => '</div>',
		));
	?>
	<div class="flag-body u-flexed-auto">
		<header <?php hybrid_attr( 'entry-header' ); ?>>

			<?php arch_title(); ?>

		</header>

		<?php arch_excerpt(); ?>
	</div>
</article>

<?php
