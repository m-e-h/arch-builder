<?php
/**
 * Tile Component Template.
 *
 * @package abraham
 */
?>

<article <?php hybrid_attr( 'post' ); ?>>

	<?php get_template_part( 'components/img', 'hd' ); ?>



<a class="tile-link u-z1 u-br u-flex-col u-flex-jc u-text-center" href="<?php the_permalink(); ?>"><div class="tiled-icon"><?php include locate_template( 'images/icons/shield.svg' ); ?></div><div class="u-abs tile-title u-left0 u-top0 u-bottom0 u-flex-center u-1of1 u-text-shadow u-text-center u-flex"><h2 class="u-h2 u-text-display u-1of1"><?php the_title(); ?></h2></div></a>
</article>
<?php
