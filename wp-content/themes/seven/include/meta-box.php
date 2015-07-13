<?php
/*-----------------------------------------------------------------------------------*/
/*	Add Menu Item Price Metabox
/*-----------------------------------------------------------------------------------*/	
	add_action( 'add_meta_boxes', 'menu_item_meta_box_add' );
	
	function menu_item_meta_box_add()
	{
		add_meta_box( 'menu-item-meta-box', __('Additional Information', 'framework'), 'menu_item_meta_box', 'menu-item', 'side', 'high' );
	}
	
	function menu_item_meta_box( $post )
	{
		$values = get_post_custom( $post->ID );
		
		$menu_price = isset( $values['menu_price'] ) ? esc_attr( $values['menu_price'][0] ) : '';
		$featured = isset( $values['featured'] ) ? esc_attr( $values['featured'][0] ) : '';
		
		wp_nonce_field( 'menu_item_meta_box_nonce', 'meta_box_nonce_menu_item' );
		?>
		<table style="width:100%;">			
        	<tr>
				<td style="width:40%;">
					<label for="menu_price"><strong><?php _e('Menu Item Price','framework');?></strong></label>					
				</td>
				<td style="width:60%;">
					<input type="text" name="menu_price" id="menu_price" value="<?php echo $menu_price; ?>" style="width:90%;" />                    
				</td>
			</tr>		
			<tr>
				<td colspan="2"><span style="color:#666; padding-bottom:10px; display:block; "><?php _e('Please add Menu Item price with related currency sign. Example: <strong>15.50$</strong> ','framework'); ?></span></td>
			</tr>	
			<tr>
				<td style="width:40%;">
					<label for="featured"><strong><?php _e('Featured','framework');?></strong></label>
				</td>
				<td style="width:60%;">
					<?php 
					if(!empty($featured) && $featured == "Yes")
					{
						?>
						<input type="checkbox" name="featured" id="featured" value="Yes" checked="checked" />                   
						<?php
					}
					else
					{
						?>
						<input type="checkbox" name="featured" id="featured" value="Yes" />
						<?php
					}
					?>
				</td>				
			</tr>
			<tr>
				<td colspan="2"><span style="color:#666; "><?php _e('Mark this Menu Item as Featured if you want to display it on homepage.','framework'); ?></span></td>
			</tr>
		</table>		        		
		<?php
	}
	
	
	add_action( 'save_post', 'menu_item_meta_box_save' );
	
	function menu_item_meta_box_save( $post_id )
	{
		
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		
		if( !isset( $_POST['meta_box_nonce_menu_item'] ) || !wp_verify_nonce( $_POST['meta_box_nonce_menu_item'], 'menu_item_meta_box_nonce' ) ) return;
		
		if( !current_user_can( 'edit_post' ) ) return;				
		
		if( isset( $_POST['menu_price'] ) )
			update_post_meta( $post_id, 'menu_price', $_POST['menu_price']  );
		
		if( isset( $_POST['featured'] ) )
		{
			update_post_meta( $post_id, 'featured', $_POST['featured']  );
		}
		else
		{
			delete_post_meta( $post_id, 'featured' );
		}
		

	}

/*-----------------------------------------------------------------------------------*/
/*	Add Team Member Metabox
/*-----------------------------------------------------------------------------------*/
add_action( 'add_meta_boxes', 'team_member_meta_box_add' );

function team_member_meta_box_add()
{
    add_meta_box( 'team-member-meta-box', __('Additional Information', 'framework'), 'team_member_meta_box', 'team-member', 'side', 'high' );
}

function team_member_meta_box( $post )
{
    $values = get_post_custom( $post->ID );

    $designation = isset( $values['designation'] ) ? esc_attr( $values['designation'][0] ) : '';
    $special = isset( $values['special'] ) ? esc_attr( $values['special'][0] ) : '';

    wp_nonce_field( 'team_member_meta_box_nonce', 'meta_box_nonce_team_member' );
    ?>
<table style="width:100%;">
    <tr>
        <td style="width:40%;">
            <label for="designation"><strong><?php _e('Designation','framework');?></strong></label>
        </td>
        <td style="width:60%;">
            <input type="text" name="designation" id="designation" value="<?php echo $designation; ?>" style="width:90%;" />
        </td>
    </tr>
    <tr>
        <td colspan="2"><span style="color:#666; padding-bottom:10px; display:block; "><?php _e('Provide Team Member Designation Here.','framework'); ?></span></td>
    </tr>
    <tr>
        <td style="width:40%;">
            <label for="special"><strong><?php _e('Special','framework');?></strong></label>
        </td>
        <td style="width:60%;">
            <?php
            if(!empty($special) && $special == "Yes")
            {
                ?>
                <input type="checkbox" name="special" id="special" value="Yes" checked="checked" />
                <?php
            }
            else
            {
                ?>
                <input type="checkbox" name="special" id="special" value="Yes" />
                <?php
            }
            ?>
        </td>
    </tr>
    <tr>
        <td colspan="2"><span style="color:#666; "><?php _e('Mark this Team Member as Special if you want to display it on top of the team page with big image.','framework'); ?></span></td>
    </tr>
</table>
<?php
}


add_action( 'save_post', 'team_member_meta_box_save' );

function team_member_meta_box_save( $post_id )
{

    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    if( !isset( $_POST['meta_box_nonce_team_member'] ) || !wp_verify_nonce( $_POST['meta_box_nonce_team_member'], 'team_member_meta_box_nonce' ) ) return;

    if( !current_user_can( 'edit_post' ) ) return;

    if( isset( $_POST['designation'] ) )
        update_post_meta( $post_id, 'designation', $_POST['designation']  );

    if( isset( $_POST['special'] ) )
    {
        update_post_meta( $post_id, 'special', $_POST['special']  );
    }
    else
    {
        update_post_meta( $post_id,'special', 'No' );
    }


}


/*-----------------------------------------------------------------------------------*/
/*	Add Testimonial Metabox
/*-----------------------------------------------------------------------------------*/	
	add_action( 'add_meta_boxes', 'testimonial_meta_box_add' );
	
	function testimonial_meta_box_add()
	{
		add_meta_box( 'testimonial-meta-box', __('Testimonial Settings', 'framework'), 'testimonial_meta_box', 'testimonial', 'normal', 'high' );
	}
	
	function testimonial_meta_box( $post )
	{
		$values = get_post_custom( $post->ID );
		
		$theTestimonial = isset( $values['the_testimonial'] ) ? esc_attr( $values['the_testimonial'][0] ) : '';
		$testimonialAuthor = isset( $values['testimonial_author'] ) ? esc_attr( $values['testimonial_author'][0] ) : '';
		$testimonialAuthorLink = isset( $values['testimonial_author_link'] ) ? esc_attr( $values['testimonial_author_link'][0] ) : '';
		$testimonial_department = isset( $values['testimonial_department'] ) ? esc_attr( $values['testimonial_department'][0] ) : '';
		
		wp_nonce_field( 'testimonial_meta_box_nonce', 'meta_box_nonce_testimonial' );
		?>
		<table style="width:100%;">			
			<tr>
				<td style="width:25%; vertical-align:top;">
					<label for="the_testimonial"><strong><?php _e('Testimonial','framework');?></strong></label>					
				</td>
				<td style="width:75%; ">
					<textarea name="the_testimonial" id="the_testimonial" cols="30" rows="10" style="width:75%; margin-right:4%; " ><?php echo $theTestimonial; ?></textarea>
                    <span style="color:#999; display:block;"><?php _e('Provide Testimonial Text','framework'); ?></span>
				</td>
			</tr>
			<tr>
				<td style="width:25%;">
					<label for="testimonial_author"><strong><?php _e('Author Name','framework');?></strong></label>					
				</td>
				<td style="width:75%; ">
					<input type="text" name="testimonial_author" id="testimonial_author" value="<?php echo $testimonialAuthor; ?>" style="width:35%; margin-right:4%;" />
                    <span style="color:#999; display:block;"><?php _e('Provide Name of Author','framework'); ?></span>
				</td>
			</tr>
			<tr>
				<td style="width:25%;">
					<label for="testimonial_author_link"><strong><?php _e('Testimonial Author Link','framework');?></strong></label>					
				</td>
				<td style="width:75%;">
					<input type="text" name="testimonial_author_link" id="testimonial_author_link" value="<?php echo $testimonialAuthorLink; ?>" style="width:75%; margin-right:4%;" />
                    <span style="color:#999; display:block;"><?php _e('Provide The URL to author website or page.','framework'); ?></span>
				</td>
			</tr>
            <tr>
				<td style="width:25%;">
					<label for="testimonial_department"><strong><?php _e('Related Department','framework');?></strong></label>					
				</td>
				<td style="width:75%;">
					<input type="text" name="testimonial_department" id="testimonial_department" value="<?php echo $testimonial_department; ?>" style="width:35%; margin-right:4%;" />
                    <span style="color:#999; display:block;"><?php _e('Provide the name of related department.','framework'); ?></span>
				</td>
			</tr>            
		</table>		        		
		<?php
	}
	
	
	add_action( 'save_post', 'testimonial_meta_box_save' );
	
	function testimonial_meta_box_save( $post_id )
	{
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
		if( !isset( $_POST['meta_box_nonce_testimonial'] ) || !wp_verify_nonce( $_POST['meta_box_nonce_testimonial'], 'testimonial_meta_box_nonce' ) ) return;
		if( !current_user_can( 'edit_post' ) ) return;


		if( isset( $_POST['the_testimonial'] ) )
			update_post_meta( $post_id, 'the_testimonial', $_POST['the_testimonial'] );

		if( isset( $_POST['testimonial_author'] ) )
			update_post_meta( $post_id, 'testimonial_author', $_POST['testimonial_author'] );

		if( isset( $_POST['testimonial_author_link'] ) )
			update_post_meta( $post_id, 'testimonial_author_link', $_POST['testimonial_author_link'] );

		if( isset( $_POST['testimonial_department'] ) )
			update_post_meta( $post_id, 'testimonial_department', $_POST['testimonial_department'] );

	}

?>