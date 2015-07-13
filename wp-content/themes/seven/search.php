<?php get_header(); ?>

            <!-- Start Container -->
            <div id="container">

                    <!-- Content -->
                    <div class="content right news clearfix">

                            <div class="container-top"></div>

                            <section class="page-head">
                                    <h1>
                                        <span><?php _e('Search results for', 'framework'); ?> <?php the_search_query(); ?></span>
                                    </h1>
                            </section>

                            <!-- Main -->
                            <div id="main-content">
                                <?php
                                if ( have_posts() ) :
                                    while ( have_posts() ) :
                                        the_post();

                                        $post_type = get_post_type( $post->ID );
                                        if($post_type == 'post')
                                        {
                                            get_template_part("template-parts/blog_post_for_list");
                                        }
                                        elseif($post_type == 'event')
                                        {
                                            get_template_part("template-parts/event_for_list");
                                        }
                                        else
                                        {
                                            get_template_part("template-parts/post_for_search");
                                        }

                                    endwhile;
                                    theme_pagination( $wp_query->max_num_pages);
                                else :
                                    ?>
                                    <h2><?php _e('No Posts Found, Please try another search term!', 'framework'); ?></h2>
                                    <?php
                                endif;
                                ?>
                            </div><!-- End Main -->

                            <?php get_sidebar(); ?>

                            <div class="container-bottom"></div>

                    </div> <!-- End Content-->

            </div><!-- End Container -->


<?php get_footer(); ?>