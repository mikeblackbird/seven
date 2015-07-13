<?php

/* Create the Menu Item Custom Post Type */
function create_menu_post_type() 
{
	$labels = array(
		'name' => __( 'Food Menu','framework'),
		'singular_name' => __( 'Menu Item','framework' ),
		'add_new' => __('Add New','framework'),
		'add_new_item' => __('Add New Menu Item','framework'),
		'edit_item' => __('Edit Menu Item','framework'),
		'new_item' => __('New Menu Item','framework'),
		'view_item' => __('View Menu Item','framework'),
		'search_items' => __('Search Menu Items','framework'),
		'not_found' =>  __('No Menu Item found','framework'),
		'not_found_in_trash' => __('No Menu Item found in Trash','framework'), 
		'parent_item_colon' => ''
	  );
	  
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'menu_icon' => 'dashicons-exerpt-view',
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => array('title','editor','thumbnail'),
		'rewrite' => array( 'slug' => __('menu-item', 'framework') )
	  ); 
	  
	  register_post_type('menu-item',$args);
}
add_action( 'init', 'create_menu_post_type' );



/* Create Menu Item Type Taxonomy */
function create_menu_item_type_taxonomy(){
    
	$labels = array(
        'name' => __( 'Menu Item Types', 'framework' ),
        'singular_name' => __( 'Menu Item Type', 'framework' ),
        'search_items' =>  __( 'Search Menu Item Types', 'framework' ),
        'popular_items' => __( 'Popular Menu Item Types', 'framework' ),
        'all_items' => __( 'All Menu Item Types', 'framework' ),
        'parent_item' => __( 'Parent Menu Item Type', 'framework' ),
        'parent_item_colon' => __( 'Parent Menu Item Type:', 'framework' ),
        'edit_item' => __( 'Edit Menu Item Type', 'framework' ), 
        'update_item' => __( 'Update Menu Item Type', 'framework' ),
        'add_new_item' => __( 'Add New Menu Item Type', 'framework' ),
        'new_item_name' => __( 'New Menu Item Type Name', 'framework' ),
        'separate_items_with_commas' => __( 'Separate Menu Item Types with commas', 'framework' ),
        'add_or_remove_items' => __( 'Add or Remove Menu Item Types', 'framework' ),
        'choose_from_most_used' => __( 'Choose from the most used Menu Item Types', 'framework' ),
        'menu_name' => __( 'Menu Item Types', 'framework' )
    );
    
	register_taxonomy(
	    'menu-item-type', 
	    array( 'menu-item' ), 
	    array(
	        'hierarchical' => true, 
	        'labels' => $labels,
	        'show_ui' => true,
	        'query_var' => true,
	        'rewrite' => array('slug' => __('menu-item-type', 'framework'))
	    )
	); 
}

add_action( 'init', 'create_menu_item_type_taxonomy', 0 );


/* Add Custom Columns */
function menu_edit_columns($columns){  

        $columns = array(  
            "cb" => "<input type=\"checkbox\" />",  
            "title" => __('Menu Item Title','framework'),
			"menu-thumb" => __('Pic','framework'),
            "type" => __('Type','framework'),
			"price" => __('Price','framework'),
			"featured" => __('Featured','framework'),
			"date" => __('Publish Time', 'framework')
        );
  
        return $columns;  
}  
  
function menu_custom_columns($column){  
        global $post;  
        switch ($column)  
        {    
            case 'menu-thumb': 			 
				if(has_post_thumbnail($post->ID)) 
				{
					?>
					<a href="<?php the_permalink(); ?>" target="_blank">
						<?php the_post_thumbnail( 'square-menu-thumbnail' ); ?>
					</a>
					<?php
				}
				else
				{
					_e('No Thumbnail','framework');
				}
                break;
			
			case 'type':  
                echo get_the_term_list($post->ID, 'menu-item-type', '', ', ','');  
                break;
			case 'price':  
                echo get_post_meta( $post->ID, 'menu_price', true  );  
                break;
			case 'featured':  
                echo get_post_meta( $post->ID, 'featured', true  );  
                break;
        }  
} 
add_filter("manage_edit-menu-item_columns", "menu_edit_columns");  
add_action("manage_posts_custom_column",  "menu_custom_columns");

?>