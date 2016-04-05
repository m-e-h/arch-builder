<?php
/**
 * Cards Component Template.
 *
 * @package abraham
 */

?>
<article <?php hybrid_attr( 'post' ); ?>>

		<header <?php hybrid_attr( 'entry-header' ); ?>>
			<?php
				get_the_image(array(
					'size'               => 'large',
					'image_class'        => 'u-1of1 o-crop__content',
					'before'             => '<div class="card-img u-overflow-hidden o-crop o-crop--16x9">',
					'after'              => '</div>',
				));
			?>

			<?php arch_title(); ?>

		</header>

		<?php arch_excerpt(); ?>

</article>

<?php
