<?php
/**
 * File Name: event_for_list.php
 * Programmer : Saqib Sarwar
 * Date: 11/28/12
 * Time: 1:22 PM
 */

global $post;

$startd = get_post_meta($post->ID,'event_startdate',true);
$endd = get_post_meta($post->ID,'event_enddate',true);

$date_format = get_option('date_format');
$time_format = get_option('time_format');

$startdate = date($date_format, $startd);
$enddate = date($date_format, $endd);

$starttime = date($time_format, $startd);
$endtime = date($time_format, $endd);

?>
<article id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>

    <div class="article-date">
        <?php echo date('M',$startd);  ?>
        <span><?php echo date('j',$startd); ?></span>
    </div>

    <div class="post-content">

        <h3 class="post-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <p>
            <small>
                <?php
                if($startdate == $enddate):
                    ?>
                    <span><?php _e('Start Date:', 'framework'); ?> </span> <?php echo $startdate; ?>
                    <?php
                else:
                    ?>
                    <span><?php _e('Dates:', 'framework'); ?> </span> <?php echo $startdate; ?> <span><?php _e('-', 'framework'); ?></span> <?php echo $enddate; ?>
                    <?php
                endif;
                ?>
                <br/>
                <span><?php _e('Time:', 'framework'); ?> </span> <?php echo $starttime; ?>  <span><?php _e('-', 'framework'); ?></span>  <?php echo $endtime; ?>
            </small>
        </p>

        <?php
        if ( has_post_thumbnail() )
        {
            ?>
            <div class="post-thumb clearfix event-thumb">
                <?php
                $image_id = get_post_thumbnail_id();
                $featured_image = wp_get_attachment_image_src( $image_id,'std-menu-thumbnail' );

                $theme_event_use_lightbox = get_option('theme_event_use_lightbox');
                if($theme_event_use_lightbox == 'true')
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
            </div>
            <!-- end of post thumb -->
            <?php
        }
        ?>

        <p><?php framework_excerpt(25); ?></p>

        <a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read More', 'framework'); ?></a>

    </div>

</article>