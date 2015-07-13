<?php get_header(); ?>

<!-- Start Container -->
<div id="container">

    <!-- Content -->
    <div class="content full-width clearfix">

        <div class="container-top"></div>

        <section class="page-head">
            <?php
            if(is_tax( 'gallery-item-type' ) )
            {
                $current_term = get_term_by( 'slug', get_query_var('term') ,'gallery-item-type' );
                ?>
                <h1>
                    <span><?php _e('Gallery Items with Type ', 'framework') ?> <?php echo $current_term->name; ?></span>
                </h1>
                <?php
            }
            else
            {
                ?>
                <h1>
                    <span><?php the_title(); ?></span>
                </h1>
                <?php
            }
            ?>
        </section>

        <!-- Main -->
        <div id="main-content">

            <?php
            if(!is_tax( 'gallery-item-type' ) )
            {
                if ( have_posts() ) :
                    while ( have_posts() ) :
                        the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>
                            <?php the_content(); ?>
                        </article>
                        <?php
                    endwhile;
                endif;
            }
            ?>

        </div><!-- End Main -->


        <!-- Gallery Filter -->
        <ul id="filter-by" class="clearfix">
            <?php
            if(!is_tax( 'gallery-item-type' ) )
            {
                ?>
                <li><a href="" data-filter="gallery-item" class="active"><?php _e('Интерьер', 'framework'); ?></a></li>
                <?php
            }
            $terms = get_terms('gallery-item-type');
            $count = count($terms);
            if ( $count > 0 )
            {
                foreach ($terms as $term)
                {
                    echo '<li><a href="' . get_term_link( $term->slug, $term->taxonomy ) . '" data-filter="'.$term->slug.'" title="' . sprintf(__('View all Gallery Items filed under %s', 'framework'), $term->name) . '">' . $term->name . '</a></li>';
                }
            }
            ?>
        </ul>


        <!-- Gallery Container -->
        <div id="gallery-container" class="<?php global $gallery_name; echo $gallery_name; ?> isotope clearfix">
            <?php

            $query_args = array(
                'post_type' => 'gallery-item',
                'posts_per_page' => -1
            );

            if(is_tax( 'gallery-item-type' ) )
            {
                $current_term = get_term_by( 'slug', get_query_var('term') ,'gallery-item-type' );
                $query_args['tax_query'] =  array(
                                                array(
                                                    'taxonomy' => 'gallery-item-type',
                                                    'field' => 'slug',
                                                    'terms' => $current_term->slug
                                                )
                                            );
            }

            $gallery_query = new WP_Query( $query_args );

            while ( $gallery_query->have_posts() ) :

                $gallery_query->the_post();
                $term_list = '';
                $terms =  get_the_terms( $post->ID, 'gallery-item-type' );

                if ( $terms && !is_wp_error( $terms ) ) :
                    foreach( $terms as $term )
                    {
                        $term_list .= $term->slug;
                        $term_list .= ' ';
                    }
                endif;

                if(has_post_thumbnail()):
                    ?>
                    <div <?php post_class("gallery-item isotope-item $term_list"); ?> >
                        <?php
                        $image_id = get_post_thumbnail_id();
                        global $gallery_image_size;
                        $full_image_url = wp_get_attachment_url($image_id);
                        $featured_image = wp_get_attachment_image_src( $image_id, $gallery_image_size );
                        ?>
                        <figure>
                            <div class="media_container">
                                <a class="zoom" data-rel="prettyPhoto[gallery]" href="<?php echo $full_image_url; ?>" title="<?php the_title(); ?>"></a>
                                <a class="link" href="<?php the_permalink(); ?>"></a>
                            </div>
                            <?php echo '<img class="img-border" src="'.$featured_image[0].'" alt="'.get_the_title().'">'; ?>
                        </figure>

                        <h5 class="item-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title();?></a></h5>

                    </div>
                    <?php
                endif;
            endwhile;
            ?>
        </div>
        <!-- end of gallery container -->

        <div class="container-bottom"></div>

    </div> <!-- End Content-->

</div><!-- End Container -->


<?php get_footer(); ?>