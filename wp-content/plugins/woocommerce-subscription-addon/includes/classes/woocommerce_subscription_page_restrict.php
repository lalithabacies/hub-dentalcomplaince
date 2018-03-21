<?php
class woocommerce_subscription_page_restrict extends woocommerce_addondata{

	public function __construct(){
		$this->data_id = 'page';
	}

	public function custom_product_tabs( $tabs) {
		$tabs['page'] = array(
			'label'		=> __( 'Blog Template', 'woocommerce' ),
			'target'	=> 'page_options',
			'class'		=> array( 'show_if_subscription', 'show_if_variable-subscription'  ),
		);
		return $tabs;
	}
	/**
	 * Contents of the page options product tab.
	 */
	public function dropbox_options_product_tab_content() {
		global $post;
		//$page_ids=get_all_page_ids();
		$existing_template = (array) get_post_meta( $post->ID, '_blogtemplate', true );
		global $wpdb, $current_site;
		$current_site_id = ! empty ( $current_site ) ? $current_site->id : 1;
		$table = $wpdb->base_prefix . 'nbt_templates';
		$blog_list = 
		$wpdb->get_results( "SELECT * FROM ".$table." WHERE network_id = '".$current_site_id."' " , ARRAY_A );
		// Note the 'id' attribute needs to match the 'target' parameter set above
		?><div id='page_options' class='panel woocommerce_options_panel'><?php
			?>
			<h3>Add folder access to this subscription</h3>
			<div class='options_group'></div>
			<p class='form-field _blogtemplate'>
			<label for='_blogtemplate'><?php _e( 'Select Blog Template from List', 'woocommerce' ); ?></label>
			<select name='_blogtemplate' class='wc-enhanced-select' style='width: 80%;'>
			<?php 
			if(is_array($blog_list)){
			foreach($blog_list as $blog){?>
				<option value='<?php echo $blog['ID'];?>' <?php selected( in_array( $blog['ID'], $existing_template ) ); ?>><?php echo $blog['name'];?></option>
			<?php } }?>
			</select>
			<img class='help_tip' data-tip="<?php _e( 'Select the pages from dropdown to map them with subscription product.', 'woocommerce' ); ?>" src='<?php echo esc_url( WC()->plugin_url() ); ?>/assets/images/help.png' height='16' width='16'>
			</p>

		</div><?php
	}
	/**
	 * Save the custom fields.
	 */
	public function save_dropbox_option_fields( $post_id ) {
		
		update_post_meta( $post_id, '_blogtemplate', $_POST['_blogtemplate'] );
		
	}

}

?>