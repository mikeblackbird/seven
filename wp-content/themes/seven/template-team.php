<?php
/*
*	Template Name: Team Template
*/
get_header();
?>

        <!-- Start Container -->
        <div id="container">

            <!-- Content -->
            <div class="content team-page full-width clearfix">

                    <div class="container-top"></div>

                    <section class="page-head">
                        <h1>
                            <span><?php the_title(); ?></span>
                        </h1>
                    </section>

                    <div id="main-content">

                        <?php
                        if ( have_posts() ) :
                            while ( have_posts() ) :

                                the_post();

                                the_content();

                            endwhile;
                        endif;
                        ?>

                    </div>
                    <!-- End of Main Content-->

                    <?php
                    /*
                     *  Custom Query for Only Special Team Members
                     */
                    $team_special_query = new WP_Query(array(
                        'post_type' => 'team-member',
                        'posts_per_page' => -1,
                        'meta_query' => array(
                            array(
                                'key' => 'special',
                                'value' => 'Yes',
                                'compare' => '='
                            )
                        )
                    ));

                    if($team_special_query->have_posts()):
                        while($team_special_query->have_posts()):
                                $team_special_query->the_post();
                                ?>
                                <!-- separator -->
                                <hr class="separator">

                                <section class="team-member clearfix" >
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('team-special-thumbnail',array('class'=>'alignleft')); ?>
                                    </a>
                                    <hgroup>
                                        <h2><?php the_title(); ?></h2>
                                        <h3 class="designation"><?php echo get_post_meta($post->ID,'designation',true); ?></h3>
                                    </hgroup>
                                    <?php the_content(); ?>
                                </section>
                                <?php
                        endwhile;
                    endif;
                    ?>

                <?php
                /*
                 *  Custom Query for Only Standard (Excluding Special) Team Members
                 */
                $team_special_query = new WP_Query(array(
                    'post_type' => 'team-member',
                    'posts_per_page' => -1,
                    'meta_query' => array(
                        array(
                            'key' => 'special',
                            'value' => 'No',
                            'compare' => '='
                        )
                    )
                ));

                if($team_special_query->have_posts()):
                    while($team_special_query->have_posts()):
                        $team_special_query->the_post();
                        ?>
                        <!-- separator -->
                        <hr class="separator">

                        <section class="team-member clearfix" >
                            <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('team-member-thumbnail',array('class'=>'alignleft')); ?>
                            </a>
                            <hgroup>
                                <h2><?php the_title(); ?></h2>
                                <h3 class="designation"><?php echo get_post_meta($post->ID,'designation',true); ?></h3>
                            </hgroup>
                            <?php the_content(); ?>
                        </section>
                        <?php
                    endwhile;
                endif;
                ?>


                <div class="container-bottom"></div>


                </div> <!-- End Content-->

            </div><!-- End Container -->

<?php get_footer(); ?>