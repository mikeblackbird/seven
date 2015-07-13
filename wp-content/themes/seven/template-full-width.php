<?php
/*
*  Template Name: Full Width Template
*/ 

get_header(); ?>

<!-- Start Container -->
<div id="container">

    <!-- Content -->
    <div class="content full-width clearfix">

        <div class="container-top"></div>

        <section class="page-head">
            <h1>
                <span><?php the_title(); ?></span>
            </h1>
        </section>

        <!-- Main -->
        <div id="main-content">

            <?php
            if ( have_posts() ) :
                while ( have_posts() ) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>
                        <?php the_content(); ?>
                    </article>

                    <?php wp_link_pages(array('before' => '<div class="pages-nav clearfix"><strong>'.__('Pages', 'framework').'</strong> ', 'after' => '</div>', 'next_or_number' => 'number')); ?>

                    <?php
                endwhile;
                comments_template();
            endif;
            ?>

        </div><!-- End Main -->

        <div class="container-bottom"></div>

    </div> <!-- End Content-->

</div><!-- End Container -->


<?php get_footer(); ?>