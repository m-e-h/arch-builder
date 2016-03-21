<?php
/**
 * General fallback template for post archives.
 *
 * @package abraham
 */
?>
<?php $query = new WP_Query( array( 'post_type' => get_post_type(), 'post_parent' => get_the_ID() ) ); ?>

<div <?php hybrid_attr('post'); ?>>
  <div data-tabs class="tabs tab-bar u-flex u-flex-wrap">

    <?php while ($query->have_posts()) : $query->the_post(); ?>

      <a data-tab href="#tab<?php the_ID(); ?>" class="tabs-tab u-p2 u-text-center u-flexed-auto" data-behaviour="tab"><?php the_title(); ?></a>

    <?php endwhile; ?>

        <?php $query->rewind_posts(); ?>
  </div>
<div data-tabs-content>
    <?php while ($query->have_posts()) : $query->the_post(); ?>

    <div data-tabs-pane class="tabs-pane u-p2 u-f-plus tab<?php the_ID(); ?>" id="tab<?php the_ID(); ?>">
    <?php arch_excerpt(); ?>
    </div>

    <?php endwhile; ?>
</div>
<?php wp_reset_postdata(); ?>
</div>
