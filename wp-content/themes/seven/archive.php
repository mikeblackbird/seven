<?php get_header(); ?>

            <!-- Start Container -->
            <div id="container">

                <!-- Content -->
                <div class="content right news clearfix">

                    <div class="container-top"></div>

                    <section class="page-head">
                        <?php
                        $post = $posts[0]; // Hack. Set $post so that the_date() works.
                        if (is_category())
                        {
                            ?>
                            <h1><span><?php _e('All posts in', 'framework'); echo ' '.single_cat_title('',false); ?></span></h1>
                            <?php
                        }
                        elseif( is_tag() )
                        {
                            ?>
                            <h1><span><?php _e('All posts tagged ', 'framework'); echo ' '.single_tag_title('',false); ?></span></h1>
                            <?php
                        }
                        elseif (is_day())
                        {
                            ?>
                            <h1><span><?php _e('Archive for', 'framework'); echo ' '.get_the_date(); ?></span></h1>
                            <?php
                        }
                        elseif (is_month())
                        {
                            ?>
                            <h1><span><?php _e('Archive for', 'framework'); echo ' '.get_the_date('F Y'); ?></span></h1>
                            <?php
                        }
                        elseif (is_year())
                        {
                            ?>
                            <h1><span><?php _e('Archive for', 'framework'); echo ' '.get_the_date('Y'); ?></span></h1>
                            <?php
                        }
                        elseif (is_author())
                        {
                            $curauth = $wp_query->get_queried_object();
                            ?>
                            <h1><span><?php _e('All posts by', 'framework'); echo ' '.$curauth->display_name; ?></span></h1>
                            <?php
                        }
                        elseif (isset($_GET['paged']) && !empty($_GET['paged']))
                        {
                            ?>
                            <h1><span><?php _e('Blog Archives', 'framework'); ?></span></h1>
                            <?php
                        }
                        ?>
                    </section>


                    <!-- Main -->
                    <div id="main-content">
                        <?php
                        if ( have_posts() ) :
                            while ( have_posts() ) :
                                the_post();
                                get_template_part("template-parts/blog_post_for_list");
                            endwhile;
                            theme_pagination( $wp_query->max_num_pages);
                        else :
                            ?>
                                <h2><?php _e('No Posts Found', 'framework'); ?></h2>
                            <?php
                        endif;
                        ?>
                    </div><!-- End Main -->

                    <?php get_sidebar(); ?>

                    <div class="container-bottom"></div>

                </div> <!-- End Content-->

            </div><!-- End Container -->


<?php get_footer(); ?>