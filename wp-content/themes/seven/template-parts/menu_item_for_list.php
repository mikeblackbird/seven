<?php
/**
 * File Name: menu_item_for_list.php
 * Programmer : Saqib Sarwar
 * Date: 12/3/12
 * Time: 10:45 AM
 */
?>
<article class="clearfix">
    <?php
    if(has_post_thumbnail())
    {
        ?>
        <figure>
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail('std-menu-thumbnail',array('class'=> "alignleft")); ?>
            </a>
        </figure>
        <?php
    }
    ?>
    <div class="post-content">
        <h3 class="post-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        <p><?php framework_excerpt(15); ?></p>
        <a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read More', 'framework'); ?></a>
    </div>
    <div class="price"><span><?php echo get_post_meta( $post->ID, 'menu_price', true); ?></span></div>
</article>