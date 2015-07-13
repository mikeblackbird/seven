<?php
/*
*	Template Name: Home Template
*/ 
get_header(); 
?>

                        <!-- Start Container -->		
                        <div id="container">           

                                <!-- Content -->
                                <div class="content full-width clearfix">

                                        <div class="container-top"></div>
												
												<div id="main-content">

                                                    <?php
                                                    if ( have_posts() ) :
                                                        while ( have_posts() ) :

                                                            the_post();

                                                            the_content();

                                                        endwhile;
                                                    endif;


                                                    /*  Three Columns Section Homepage */
                                                    $theme_display_three_columns = get_option('theme_display_three_columns');
                                                    if($theme_display_three_columns == 'true')
                                                    {
                                                        echo '<hr class="separator">';
                                                        echo '<section id="template-items"><ul class="template-items clearfix">';

                                                        for($i=1; $i<=3; $i++)
                                                        {
                                                            $column_heading = stripslashes(get_option('theme_'.$i.'_column_heading'));
                                                            $column_img = get_option('theme_'.$i.'_column_img');
                                                            $column_sub_heading = stripslashes(get_option('theme_'.$i.'_column_sub_heading'));
                                                            $column_text = stripslashes(get_option('theme_'.$i.'_column_text'));
                                                            $column_link_txt = get_option('theme_'.$i.'_column_link_txt');
                                                            $column_link = get_option('theme_'.$i.'_column_link');

                                                            echo '<li><h2>'.$column_heading.'</h2><figure><a href="'.$column_link.'"><img src="'.$column_img.'" alt=""></a></figure>';
                                                            echo '<h3>'.$column_sub_heading.'</h3>';
                                                            echo '<p>'.$column_text.'</p>';
                                                            echo '<a href="'.$column_link.'" class="readmore">'.$column_link_txt.'</a></li>';

                                                        }

                                                        echo '</ul></section>';
                                                    }



                                                    /*  Featured Menu Items Carousel for Homepage */
                                                    $theme_display_menu_items = get_option('theme_display_menu_items');
                                                    if($theme_display_menu_items == 'true')
                                                    {
                                                        echo '<hr class="separator">';
                                                        echo '<section class="flexcarousel"><div class="carousel es-carousel-wrapper clearfix"><div class="es-carousel"><ul>';

                                                        $menu_query = new WP_Query(array(
                                                            'post_type' => 'menu-item',
                                                            'posts_per_page' => -1,
                                                            'meta_query' => array(
                                                                array(
                                                                    'key' => 'featured',
                                                                    'value' => 'Yes',
                                                                    'compare' => '='
                                                                )
                                                            )
                                                        ));

                                                        if($menu_query->have_posts()):
                                                            while($menu_query->have_posts()):
                                                                $menu_query->the_post();

                                                                $temp_id = get_the_ID();
                                                                $price = get_post_meta( $temp_id, 'menu_price', true);

                                                                if ( has_post_thumbnail($temp_id) )
                                                                {
                                                                    echo '<li><figure class="the-tooltip top center full-width sienna">';
                                                                    echo '<a href="'. get_permalink($temp_id) .'">';
                                                                    echo get_the_post_thumbnail( $temp_id, 'square-menu-thumbnail') ;
                                                                    echo '</a>';
                                                                    echo '<figcaption>'. get_custom_title($temp_id) .'</figcaption>';
                                                                    echo '</figure><div class="price"><span>';
                                                                    echo $price;
                                                                    echo '</span></div></li>';
                                                                }
                                                            endwhile;
                                                        endif;

                                                        echo '</ul></div></div></section>';

                                                    }



                                                    /*  Testimonial */
                                                    $theme_testimonial_text = stripslashes(get_option('theme_testimonial_text'));
                                                    $theme_testimonial_author = stripslashes(get_option('theme_testimonial_author'));

                                                    if(!empty($theme_testimonial_text))
				                                    {
                                                        echo '<hr class="separator">';
                                                        echo '<blockquote><p>'.$theme_testimonial_text.'</p><p class="author">'.$theme_testimonial_author.'</p></blockquote>';
                                                    }
                                                    ?>

												</div>
                                                <!-- End of Main Content-->

                                        <div class="container-bottom"></div>

                                </div>
                                <!-- End Content-->
                                                						
                        </div>
                        <!-- End Container -->
						                        
<?php get_footer(); ?>