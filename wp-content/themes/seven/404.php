<?php get_header(); ?>

<!-- Start Container -->
<div id="container">

    <!-- Content -->
    <div class="content right clearfix">

        <div class="container-top"></div>

        <section class="page-head">
            <h1>
                <span><?php _e("404: Page Not Found", 'framework'); ?></span>
            </h1>
        </section>

        <!-- Main -->
        <div id="main-content">

                    <article id="post-<?php the_ID(); ?>" <?php post_class("clearfix"); ?>>

                        <h3><?php _e('The page you are looking for is not here!', 'framework'); ?></h3>
                        <p><?php _e('Please try top navigation for what you are looking for!', 'framework'); ?></p>

                    </article>

        </div><!-- End Main -->

        <?php get_sidebar('page'); ?>

        <div class="container-bottom"></div>

    </div> <!-- End Content-->

</div><!-- End Container -->


<?php get_footer(); ?>