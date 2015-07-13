<?php
/**
 * File Name: blog_post_for_list.php
 * Programmer : Saqib Sarwar
 * Date: 12/1/12
 * Time: 8:55 PM
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>

    <header class="clearfix">

        <div class="article-date">
            <?php the_time('M'); ?>
            <span><?php the_time('j'); ?></span>
        </div>

        <div class="post-head">
            <h2 class="post-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            <small>
                <span><?php// _e('Posted in:', 'framework'); ?> </span>
                <?php// the_category(', '); ?>
            </small>
        </div>

        <?php if ( comments_open() ){ ?>
        <div class="comment-count">
            <span><?php comments_popup_link(__('0 Комментариев', 'framework'), __('1 Комментарий', 'framework'), __('% Comments', 'framework')); ?></span>
        </div>
        <?php } ?>

    </header>

    <?php
    if ( has_post_thumbnail() )
    {
        ?>
        <div class="post-thumb clearfix">
            <?php
            $image_id = get_post_thumbnail_id();
            $featured_image = wp_get_attachment_image_src( $image_id,'std-blog-thumbnail' );

            $theme_use_lightbox = get_option('theme_use_lightbox');
            if($theme_use_lightbox == 'true')
            {
                $full_image_url = wp_get_attachment_url($image_id);
                echo '<a href="'.$full_image_url.'" title="'.get_the_title().'" class="pretty-photo">';
                echo '<img src="'.$featured_image[0].'" alt="'.get_the_title().'">';
                echo '</a>';
            }
            else
            {
                echo '<a href="'.get_permalink().'" title="'.get_the_title().'" >';
                echo '<img src="'.$featured_image[0].'" alt="'.get_the_title().'">';
                echo '</a>';
            }
            ?>
        </div><!-- end of post thumb -->
        <?php
    }
    ?>

    <?php the_content(''); ?>

    <a href="<?php the_permalink(); ?>"  class="read-more"><?php _e('Читать далее', 'framework'); ?></a>

</article>