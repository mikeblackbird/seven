<?php
class Menu_Item_Types_Widget extends WP_Widget {
  
  	function Menu_Item_Types_Widget() {
  		$widget_ops = array( 'classname' => 'Menu_Item_Types_Widget', 'description' => __("Displays List of Menu Types with links to their archive pages.", 'framework') );
  		$this->WP_Widget( 'Menu_Item_Types_Widget', 'Elegantia: Menu Types List', $widget_ops);
  	}
  	
  	function form($instance)
    {
  		$instance = wp_parse_args( (array) $instance, array( 'title' => 'Menu Types' ));
		$title= esc_attr($instance['title']);
            ?>
            <p>
                    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'framework'); ?></label>
                    <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
            </p>
            <?php
    }
  
  	function update($new_instance, $old_instance) 
  	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;  
	}
  
  	function widget($args, $instance) {
  	
  		extract($args);
        
		$title = apply_filters('widget_title', $instance['title']);

        if ( empty($title) )
                $title = false;
		
  		echo $before_widget;		
		
		if($title):
			echo $before_title;
				echo $title;
			echo $after_title;	
		endif;
		
        ?>
        <ul>
            <?php
            wp_list_categories( array(
                                'taxonomy' => "menu-item-type",
                                'title_li' => ""
                                ));
            ?>
        </ul>
        <?php

        echo $after_widget;		  
  	}
	  
}


?>