<?php
/**
 * General fallback template for post archives.
 *
 * @package abraham
 */
$query = new WP_Query( array( 'post_type' => get_post_type(),'post_parent' => get_the_ID() ) ); ?>
<div class="o-cell u-1of2-md u-br row__tabs mdl-tabs mdl-js-tabs">
  <div class="mdl-tabs__tab-bar">

    <?php while ($query->have_posts()) : $query->the_post(); ?>

      <a href="#tab<?php the_ID(); ?>" class="mdl-tabs__tab u-f-plus"><?php the_title(); ?></a>
    <?php endwhile; ?>

        <?php $query->rewind_posts(); ?>
  </div>


  <?php while ($query->have_posts()) : $query->the_post(); ?>

  <div class="mdl-tabs__panel u-p2 u-f-plus tab<?php the_ID(); ?>" id="tab<?php the_ID(); ?>">
    <?php the_content(); ?>
  </div>

  <?php endwhile; ?>
<?php wp_reset_postdata(); ?>
</div>
