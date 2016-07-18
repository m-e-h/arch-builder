<?php
/**
 * Tile Component Template.
 *
 * @package abraham
 */
?>

<article <?php hybrid_attr( 'post' ); ?>>

	<?php get_template_part( 'components/img', 'hd' ); ?>

	<?php arch_title(); ?>
	<?php arch_excerpt(); ?>
<a class="u-1of1 u-height100 u-abs u-left0 u-top0" href="<?php the_permalink(); ?>"></a>
</article>
<?php
