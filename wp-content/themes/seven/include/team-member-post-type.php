<?php
/* Create Custom Post Type : Team Member */
function create_team_member_post_type()
{
	$labels = array(
		'name' => __( 'Team Members','framework'),
		'singular_name' => __( 'Team Member','framework' ),
		'add_new' => __('Add New','framework'),
		'add_new_item' => __('Add New Team Member','framework'),
		'edit_item' => __('Edit Team Member','framework'),
		'new_item' => __('New Team Member','framework'),
		'view_item' => __('View Team Member','framework'),
		'search_items' => __('Search Team Member','framework'),
		'not_found' =>  __('No Team Member found','framework'),
		'not_found_in_trash' => __('No Team Member found in Trash','framework'),
		'parent_item_colon' => ''
	  );
	  
	  $args = array(
		'labels' => $labels,
		'public' => true,
		'exclude_from_search' => false,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		  'menu_icon' => 'dashicons-businessman',
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => 5,
		'supports' => array('title','editor','thumbnail'),
		'rewrite' => array( 'slug' => __('team-member', 'framework') )
	  ); 
	  
	  register_post_type('team-member',$args);
}
add_action( 'init', 'create_team_member_post_type' );


/* Add Custom Columns */
function team_member_edit_columns($columns)
{

	$columns = array(
		  "cb" => '<input type="checkbox" >',
		  "title" => __( 'Team Member Name','framework' ),
		  "team_thumb" => __( 'Thumbnail','framework' ),
		  "designation" => __('Designation','framework'),
		  "date" => __( 'Date','framework' )
	);
	
	return $columns;
}
add_filter("manage_edit-team-member_columns", "team_member_edit_columns");


function team_member_custom_columns($column){
	global $post;
	switch ($column)
	{
		case 'team_thumb':
			if(has_post_thumbnail($post->ID))
			{
				the_post_thumbnail('thumbnail');
			}
			else
			{
				_e('No Image','framework');
			}
			break;		
		case 'designation':

            $designation = get_post_meta($post->ID,'designation',true);

			if(!empty($designation))
			{
				echo $designation;
			}
			else
			{
				_e('NA','framework');
			}			
			break;
	}
}
add_action("manage_posts_custom_column", "team_member_custom_columns");

?>