<?php
class Featured_Menu_Items_Widget extends WP_Widget {

	function Featured_Menu_Items_Widget()
	{
		$widget_ops = array( 'classname' => 'Featured_Menu_Items_Widget', 'description' => __('Displays list of featured menu items.','framework') );
		$this->WP_Widget( 'Featured_Menu_Items_Widget', __('Elegantia: Featured Menu Items','framework'), $widget_ops );
	}
	
	
	function widget($args, $instance) 
	{ 
		extract($args);
						
		$title = apply_filters('widget_title', $instance['title']);

		if ( empty($title) ) 
		  $title = false;
		
		$number = absint( $instance['number'] );
		
		echo $before_widget;		
		
		if($title):
			echo $before_title;
				echo $title;
			echo $after_title;	
		endif;

        $menu_query = new WP_Query(array(
            'post_type' => 'menu-item',
            'posts_per_page' => $number,
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

                ?>
                <div class="sidebar-menu-item clearfix">
                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <?php
                    if(has_post_thumbnail())
                    {
                        ?>
                        <figure>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('small-menu-thumbnail',array('class'=> "sidebar-menu-thumb")); ?>
                            </a>
                        </figure>
                        <?php
                    }
                    ?>
                    <p>
                        <?php framework_excerpt(10); ?>
                    </p>
                    <a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read More', 'framework'); ?></a>
                </div>
                <?php

            endwhile;
        endif;
		
		echo $after_widget;
	}
	

	function form($instance) 
	{	
		$instance = wp_parse_args( (array) $instance, array('number' => 3, 'title' => 'Featured Menu Items' ) );
		
        $title= esc_attr($instance['title']);		
		$number = absint( $instance['number'] );
		
		?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','framework');?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>">
               <?php _e('Number of Menu Items to display','framework');  ?>:
            </label>
            <input class="widefat" id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" />
        </p>
		<?php

    }

	function update($new_instance, $old_instance) 
	{
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = absint( $new_instance['number'] );
        return $instance;
    }
	
}

?>