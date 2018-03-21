<?php
class woocommerce_subscription_course_restrict extends woocommerce_addondata{

	public function __construct(){
		$this->data_id = 'course';
	}

	public function custom_product_tabs_course( $tabs) {
		$tabs['course'] = array(
			'label'		=> __( 'Courses', 'woocommerce' ),
			'target'	=> 'course_options',
			'class'		=> array( 'show_if_subscription', 'show_if_variable-subscription'  ),
		);
		return $tabs;
	}
	/**
	 * Contents of the page options product tab.
	 */
	public function course_options_product_tab_content() {
		global $post;
		//$page_ids=get_all_page_ids();
		$existing_courses = (array) get_post_meta( $post->ID, '_subscription_courses', true );
		global $wpdb, $current_site;
		$args = array(
		'post_type'=> 'sfwd-courses',
		'post_status'    => 'publish',
		'order'    => 'ASC'
		);              

		$site_courses = get_posts( $args );
		// Note the 'id' attribute needs to match the 'target' parameter set above
		?><div id='course_options' class='panel woocommerce_options_panel'><?php
			?>
			<h3>Add course access to this subscription</h3>
			<div class='options_group'></div>
			<p class='form-field _subscription_courses'>
			<label for='_subscription_courses'><?php _e( 'Select Courses from List', 'woocommerce' ); ?></label>
			<select name='_subscription_courses[]' class='wc-enhanced-select' style='width: 80%;' multiple='multiple'>
			<?php 
			if(!empty($site_courses) && is_array($site_courses)){
			foreach($site_courses as $courses){?>
				<option value='<?php echo $courses->ID;?>' <?php selected( in_array( $courses->ID, $existing_courses ) ); ?>><?php echo $courses->post_title;?></option>
			<?php } }?>
			</select>
			<img class='help_tip' data-tip="<?php _e( 'Select the courses from dropdown to map them with subscription product.', 'woocommerce' ); ?>" src='<?php echo esc_url( WC()->plugin_url() ); ?>/assets/images/help.png' height='16' width='16'>
			</p>

		</div><?php
	}
	/**
	 * Save the custom fields.
	 */
	public function save_course_option_fields( $post_id ) {
		
		update_post_meta( $post_id, '_subscription_courses', $_POST['_subscription_courses'] );
		
	}

}

?>