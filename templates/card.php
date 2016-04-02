<?php
/**
 * General fallback template for post archives.
 *
 * @package abraham
 */
?>
<article <?php hybrid_attr('post'); ?>>

        <header <?php hybrid_attr('entry-header'); ?>>
            <?php
                get_the_image(array(
                    //'size'               => 'abe-card-md',
                    'image_class'        => 'u-1of1',
                    'before'             => '<div class="card-img u-overflow-hidden">',
                    'after'              => '</div>',
                ));
            ?>
            
                <?php arch_title(); ?>

        </header>

        <div <?php hybrid_attr('entry-summary'); ?>>
            <?php arch_excerpt(); ?>
        </div>

</article>
