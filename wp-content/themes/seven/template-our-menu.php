<?php
/*
*	Template Name: Our Menu Template
*/ 
get_header(); 
?>
                <!-- Start Container -->
                <div id="container">

                        <!-- Content -->
                        <div class="content our-menu clearfix">

                            <div class="container-top"></div>

                            <?php
                            // Menu Heading
                            get_template_part("template-parts/menu_head");
                            ?>

                            <!-- Main -->
                            <div id="main-content">

                                    <?php
                                    /* show menu items those are direct child of given parent term */
                                    function show_menu_items($parent_term)
                                    {
                                        $menu_query = new WP_Query(array(
                                            'post_type' => 'menu-item',
                                            'posts_per_page' => -1,
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'menu-item-type',
                                                    'field' => 'slug',
                                                    'include_children' => false,
                                                    'terms' => $parent_term->slug
                                                )
                                            )
                                        ));

                                        if($menu_query->have_posts()):
                                            while($menu_query->have_posts()):
                                                $menu_query->the_post();
                                                get_template_part("template-parts/menu_item_for_list");
                                            endwhile;
                                        endif;

                                        /*** Child Terms ***/
                                        $child_terms = get_terms('menu-item-type',array( 'hide_empty' => false , 'parent' => $parent_term->term_id, 'child_of' => $parent_term->term_id ));

                                        if(!empty($child_terms)){
                                            foreach ($child_terms as $child_term){
                                                ?><h3 class="title-heading"><?php echo $child_term->name; ?></h3><?php
                                                show_menu_items($child_term);
                                            }
                                        }
                                    }

                                    // Show top level terms - there child terms and related menu items will be displayed automatically
                                    $terms = get_terms('menu-item-type',array( 'hide_empty' => false, 'parent' => 0));

                                    if ( !empty($terms) ){
                                        foreach ($terms as $term){
                                            ?><h2 class="title-heading"><?php echo $term->name; ?></h2><?php
                                            show_menu_items($term);
                                        }
                                    }
                                    ?>
                            </div><!-- End Main -->

                            <?php get_sidebar('menu'); ?>

                            <div class="container-bottom"></div>

                        </div> <!-- End Content-->

                </div><!-- End Container -->
						                        
<?php get_footer(); ?>