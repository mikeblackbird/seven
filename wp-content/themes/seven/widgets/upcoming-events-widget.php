<?php
class Upcoming_Events_Widget extends WP_Widget {

	function Upcoming_Events_Widget()
	{
		$widget_ops = array( 'classname' => 'Upcoming_Events_Widget', 'description' => __('Displays list of Upcoming Events.','framework') );
		$this->WP_Widget( 'Upcoming_Events_Widget', __('Elegantia: Upcoming Events','framework'), $widget_ops );
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

        // hide events that are older than 6am today (because some parties go past your bedtime)

        $today6am = strtotime('today 6:00') + ( get_option( 'gmt_offset' ) * 3600 );

        // - query -
        global $wpdb;

        $querystr =    "SELECT * FROM $wpdb->posts wposts, $wpdb->postmeta metastart, $wpdb->postmeta metaend
                                                            WHERE (wposts.ID = metastart.post_id AND wposts.ID = metaend.post_id)
                                                            AND (metaend.meta_key = 'event_enddate' AND metaend.meta_value > $today6am )
                                                            AND metastart.meta_key = 'event_enddate'
                                                            AND wposts.post_type = 'event'
                                                            AND wposts.post_status = 'publish'
                                                            ORDER BY metastart.meta_value ASC LIMIT $number";

        $events = $wpdb->get_results($querystr, OBJECT);

        if ($events):
            global $post;
            foreach ($events as $post):
                setup_postdata($post);
                ?>
                <div class="sidebar-menu-item clearfix">
                    <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <?php
                    if(has_post_thumbnail())
                    {
                        ?>
                        <figure>
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail('square-menu-thumbnail',array('class'=> "sidebar-menu-thumb")); ?>
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
            endforeach;
        endif;

		echo $after_widget;
	}
	

	function form($instance) 
	{	
		$instance = wp_parse_args( (array) $instance, array('number' => 3, 'title' => 'Upcoming Events' ) );
		
        $title= esc_attr($instance['title']);		
		$number = absint( $instance['number'] );
		
		?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','framework');?>:</label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number'); ?>">
               <?php _e('Number of Upcoming Events to display','framework');  ?>:
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