<?php
/**
 * Tile Component Template.
 *
 * @package abraham
 */
$post_id = get_the_ID();
$svg_icon = get_post_meta( get_the_ID(), 'arch_svg', true );
?>

<article <?php hybrid_attr( 'post' ); ?> style="background-color:<?= doc_post_color_rgb( $post_id, '0.8' ) ?>;color:<?= doc_post_color_rgb( $post_id, '0.2' ) ?>">

	<?php get_template_part( 'components/img', 'hd' ); ?>

	<a href="<?php the_permalink(); ?>" class="tile-link u-z1 u-br u-flex-col u-flex-jc u-text-center" style="color:<?= doc_post_color_text( $post_id ) ?>;">
		<div class="tiled-icon" style="color:<?= doc_post_color_comp( $post_id, '0.8' ) ?>">
			<?= html_entity_decode($svg_icon); ?>
		</div>

		<div class="u-abs tile-title u-left0 u-top0 u-bottom0 u-flex-center u-1of1 u-text-shadow u-text-center u-flex"><h2 class="u-h2 u-text-display u-1of1"><?php the_title(); ?></h2></div>
	</a>

</article>
<?php
