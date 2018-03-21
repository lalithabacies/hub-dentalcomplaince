<?php
class woocommerce_addondata{
	private $data_id;
	public function __construct() {
        $this->data_id = 'dropbox';
    }
 
	public function custom_product_tabs( $tabs) {
		$tabs['dropbox'] = array(
			'label'		=> __( 'Dropbox', 'woocommerce' ),
			'target'	=> 'dropbox_options',
			'class'		=> array( 'show_if_subscription', 'show_if_variable-subscription'  ),
		);
		return $tabs;
	}
	/**
	 * Contents of the dropbox options product tab.
	 */
	public function dropbox_options_product_tab_content() {
		global $post;
		$stored_folders = (array) get_post_meta( $post->ID, '_folders_in_dropbox', true );
		$dropbox_api = new Dropboxapi();
		$folders_dropbox = $dropbox_api->display_folder_list();
		?><div id='dropbox_options' class='panel woocommerce_options_panel'><?php
			?>
			<h3>Add folder access to this subscription</h3>
			<div class='options_group'></div>
			<p class='form-field _folders_in_dropbox'>
			<label for='_folders_in_dropbox'><?php _e( 'Select Dropbox Folders', 'woocommerce' ); ?></label>
			<select name='_folders_in_dropbox[]' class='wc-enhanced-select' multiple='multiple' style='width: 80%;'>
			<?php 
			if(count($folders_dropbox)>0){
				for($i=0;$i<count($folders_dropbox);$i++){
                    $objects = $folders_dropbox[$i];
                    if(empty(trim($objects->client_modified))){
                    $path=$objects->name;
				?>
				<option value='<?php echo $path;?>' <?php selected( in_array( $path, $stored_folders ) ); ?>><?php echo $path;?></option>
			<?php } } }?>
			</select>
			<img class='help_tip' data-tip="<?php _e( 'Select the folders from dropbox to map them with subscription product.', 'woocommerce' ); ?>" src='<?php echo esc_url( WC()->plugin_url() ); ?>/assets/images/help.png' height='16' width='16'>
			</p>

		</div><?php
	}
	/**
	 * Save the custom fields.
	 */
	public function save_dropbox_option_fields( $post_id ) {
		
		update_post_meta( $post_id, '_folders_in_dropbox', (array) $_POST['_folders_in_dropbox'] );
		
	}
}
?>