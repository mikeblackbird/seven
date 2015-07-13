<?php
// Event Custom Post Type
add_action( 'init', 'create_event_postype' );

function create_event_postype() {

    $labels = array(
        'name' => __( 'Events','framework'),
        'singular_name' => __( 'Event','framework' ),
        'add_new' => __('Add New','framework'),
        'add_new_item' => __('Add New Event','framework'),
        'edit_item' => __('Edit Event','framework'),
        'new_item' => __('New Event','framework'),
        'view_item' => __('View Event','framework'),
        'search_items' => __('Search Event','framework'),
        'not_found' =>  __('No Events found','framework'),
        'not_found_in_trash' => __('No Events found in Trash','framework'),
        'parent_item_colon' => ''
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'menu_icon' => 'dashicons-calendar',
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 5,
        'supports' => array('title','editor', 'thumbnail','comments'),
        'rewrite' => array( 'slug' => __('events', 'framework') )
    );

    register_post_type( 'event', $args);

}



/*-----------------------------------------------------------------------------------*/
/*	Add Custom Columns
/*-----------------------------------------------------------------------------------*/
function event_edit_columns($columns)
{

    $columns = array(
        "cb" => '<input type="checkbox" >',
        "title" => __( 'Event Title','framework' ),
        "event_dates" => __('Event Date','framework'),
        "event_times" => __('Event Time','framework'),
        "event_thumb" => __( 'Event Thumbnail','framework' ),
        "date" => __( 'Date','framework' )
    );

    return $columns;
}
add_filter("manage_edit-event_columns", "event_edit_columns");


function event_custom_columns($column){

    global $post;
    switch ($column)
    {
        case 'event_thumb':
            if(has_post_thumbnail($post->ID))
            {
                the_post_thumbnail('square-menu-thumbnail');
            }
            else
            {
                _e('No Image','framework');
            }
            break;
        case 'event_dates':

            $startd = get_post_meta($post->ID,'event_startdate',true);
            $endd = get_post_meta($post->ID,'event_enddate',true);

            $date_format = get_option('date_format');

            $startdate = date($date_format, $startd);
            $enddate = date($date_format, $endd);

            echo $startdate . '<br/><strong><em>To</em></strong><br/>' . $enddate;

            break;
        case 'event_times':

            $startt = get_post_meta($post->ID,'event_startdate',true);
            $endt = get_post_meta($post->ID,'event_enddate',true);

            $time_format = get_option('time_format');

            $starttime = date($time_format, $startt);
            $endtime = date($time_format, $endt);

            echo $starttime . '<br/><strong><em>To</em></strong><br/>' .$endtime;

            break;
    }
}
add_action("manage_posts_custom_column", "event_custom_columns");



/*-----------------------------------------------------------------------------------*/
/*	Event Related Metabox
/*-----------------------------------------------------------------------------------*/

    add_action( 'admin_init', 'events_metabox' );

    function events_metabox() {
        add_meta_box('events_meta', __('Event Date and Time', 'framework'), 'events_meta', 'event', 'side', 'high');
    }

    function events_meta () {

        // - grab data -

        global $post;
        $custom = get_post_custom($post->ID);
        $meta_sd = $custom["event_startdate"][0];
        $meta_ed = $custom["event_enddate"][0];
        $meta_st = $meta_sd;
        $meta_et = $meta_ed;

        // - grab wp time format -

        $date_format = get_option('date_format');
        $time_format = get_option('time_format');

        // - populate today if empty, 00:00 for time -

        if ($meta_sd == null) { $meta_sd = time(); $meta_ed = $meta_sd; $meta_st = 0; $meta_et = 0;}

        // - convert to pretty formats -

        $clean_sd = date($date_format, $meta_sd);
        $clean_ed = date($date_format, $meta_ed);
        $clean_st = date($time_format, $meta_st);
        $clean_et = date($time_format, $meta_et);

        // - security -

        echo '<input type="hidden" name="event-nonce" id="event-nonce" value="' . wp_create_nonce( 'event-nonce' ) . '" />';

        // - output -

        ?>

        <table style="width:100%;">

            <tr>
                <td style="width:30%;">
                    <label for="event_startdate"><strong><?php _e('Start Date','framework');?></strong></label>
                </td>
                <td style="width:70%;">
                    <input type="text" name="event_startdate" id="event_startdate" class="event_date" value="<?php echo $clean_sd; ?>" style="width:95%;" />
                </td>
            </tr>

            <tr>
                <td style="width:30%;">
                    <label for="event_starttime"><strong><?php _e('Start Time','framework');?></strong></label>
                </td>
                <td style="width:70%;">
                    <input type="text" name="event_starttime" id="event_starttime" value="<?php echo $clean_st; ?>" style="width:95%;" />
                    <br/>
                    <em><?php _e('Use 24h format (7pm = 19:00)','framework');?></em>
                </td>
            </tr>

            <tr>
                <td style="width:30%;">
                    <label for="event_enddate"><strong><?php _e('End Date','framework');?></strong></label>
                </td>
                <td style="width:70%;">
                    <input type="text" name="event_enddate" id="event_enddate" class="event_date" value="<?php echo $clean_ed; ?>" style="width:95%;" />
                </td>
            </tr>

            <tr>
                <td style="width:30%;">
                    <label for="event_endtime"><strong><?php _e('End Time','framework');?></strong></label>
                </td>
                <td style="width:70%;">
                    <input type="text" name="event_endtime" id="event_endtime" value="<?php echo $clean_et; ?>" style="width:95%;" />
                    <br/>
                    <em><?php _e('Use 24h format (7pm = 19:00)','framework');?></em>
                </td>
            </tr>

        </table>

        <script type="text/javascript">
            jQuery(document).ready(function()
            {
                /*jQuery.datepicker.regional['fr'] = {
                    clearText: 'Effacer',
                    clearStatus: '',
                    closeText: 'Fermer',
                    closeStatus: 'Fermer sans modifier',
                    prevText: '',
                    nextStatus: 'Voir le mois suivant',
                    currentText: 'Courant',
                    currentStatus: 'Voir le mois courant',
                    monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin', 'Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
                    monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun', 'Jul','Aoû','Sep','Oct','Nov','Déc'],
                    monthStatus: 'Voir un autre mois',
                    yearStatus: 'Voir un autre année',
                    weekHeader: 'Sm',
                    weekStatus: '',
                    dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
                    dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
                    dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
                    dayStatus: 'Utiliser DD comme premier jour de la semaine',
                    dateStatus: 'Choisir le DD, MM d',
                    dateFormat: 'mm/dd/yy',
                    firstDay: 0,
                    initStatus: 'Choisir la date',
                    isRTL: false
                };

                jQuery.datepicker.setDefaults(jQuery.datepicker.regional['fr']);*/

                jQuery(".event_date").datepicker();
            });
        </script>
        <?php
    }

    // Save Post
    add_action ('save_post', 'save_event');

    function save_event(){

        global $post;

        // - still require nonce

        if ( !wp_verify_nonce( $_POST['event-nonce'], 'event-nonce' )) {
            return $post->ID;
        }

        if ( !current_user_can( 'edit_post', $post->ID ))
            return $post->ID;

        // - convert back to unix & update post

        if(!isset($_POST["event_startdate"])):
            return $post;
        endif;

        $updatestartd = strtotime ( $_POST["event_startdate"] . $_POST["event_starttime"] );
        update_post_meta($post->ID, "event_startdate", $updatestartd );

        if(!isset($_POST["event_enddate"])):
            return $post;
        endif;

        $updateendd = strtotime ( $_POST["event_enddate"] . $_POST["event_endtime"]);
        update_post_meta($post->ID, "event_enddate", $updateendd );

    }


/*-----------------------------------------------------------------------------------*/
/*	Load Event Related CSS and JS on Admin Side
/*-----------------------------------------------------------------------------------*/

    function event_css($hook)
    {
        if ($hook == 'post.php' || $hook == 'post-new.php')
        {
            global $post_type;
            if( 'event' != $post_type )
                return;

            wp_enqueue_style('jquery-ui-css',  'http://code.jquery.com/ui/1.9.2/themes/redmond/jquery-ui.css', array(), '1.9.1', 'all');
        }
    }
    add_action('admin_enqueue_scripts','event_css');



    function event_js($hook)
    {
        if ($hook == 'post.php' || $hook == 'post-new.php')
        {
            global $post_type;
            if( 'event' != $post_type )
                return;
            wp_enqueue_script('jquery-ui-core');
            wp_enqueue_script('jquery-ui-datepicker');
        }
    }
    add_action('admin_enqueue_scripts','event_js');

?>