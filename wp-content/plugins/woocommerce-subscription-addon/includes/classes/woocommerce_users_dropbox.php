<?php 
class WooUserDropbox{
	public function display_user_dropbox(){
		global $wpdb,$woocommerce;
		//store folders in user meta
		if(isset($_POST['update_user']) && $_POST['update_user'] == "Update"){
			$user_id = $_POST['site_admins'];
			$users_folder = $_POST['_users_folder'];
			update_user_meta($user_id,'dropbox_folders',$users_folder);
			echo "<h3>User Updated Successfully</h3>";
			echo "<script>location.reload();</script>";
		}
		$blogs = $wpdb->get_results($wpdb->prepare("
			SELECT blog_id
			FROM {$wpdb->blogs}
			WHERE site_id = '{$wpdb->siteid}'
			AND spam = '0'
			AND deleted = '0'
			AND archived = '0'
			AND mature = '0' 
			AND public = '1'
		"));
		$site_admins = array();
		$html = '';
		$html.='<style>
		/* style added by Prabrisha Roy for dropbox users page*/
		.container_user_drop{
			width:67%;
		}
		.select_user{
			width: 25%;
			margin-right: 30px;
		}
		.select_dropbox{
			width: 25%;
			margin-right: 30px;
		}
		</style>';
		$html.='<form method="post">';
		$html.='<div class="container_user_drop">';
		$html.='<h3>Users</h3>';
		foreach ($blogs as $blog) 
		{
			if ( !is_main_site($blog->blog_id) ) {
				switch_to_blog( $blog->blog_id );
				$users_query = new WP_User_Query( array( 
				'role' => 'administrator', 
				'orderby' => 'display_name'
				) );
				$results = $users_query->get_results();

				foreach($results as $result){
					if(!is_super_admin($result->ID)){
						array_push($site_admins,$result->ID);
					}

				}

			}
		}
		$unique_site_admins = array_unique($site_admins);
		restore_current_blog();
		$html.= '<select name="site_admins" class="select_user">';
		$html.='<option>Select a Site Admin</option>';
		foreach($unique_site_admins as $user){
			$user_id = $user;
			$user_info = get_userdata($user_id);
			$user_login =  $user_info->user_login;
			$html.='<option value="'.$user_id.'">'.$user_login.'</option>';
		}
		$html.= '</select>';
		$html.='<img src="'.WSA_URL.'/images/loading.gif" height="27px" style="display:none;" class="loader"/>';
		$html.='<span id="response"></span>';
		$html.='<input type="submit" name="update_user" id="update_user" value="Update" class=" button-primary"/>';
		$html.='</div>';
		$html.='</form>';
		echo $html;
	}
	
	/* ajax callback function to show all the dropbox folders*/
	function get_dropbox_userspage(){
		$user_id = $_REQUEST['user_id'];
		$dropbox_api = new Dropboxapi();
		$folders_dropbox = $dropbox_api->display_folder_list();
		$folders_stored = get_user_meta($user_id,'dropbox_folders',true);
		?>
			<h3>Add folder access</h3>
			<div class='options_group'></div>
			<p class='form-field _folders_in_dropbox'>
			<label for='_folders_in_dropbox'><?php _e( 'Select Dropbox Folders', 'woocommerce' ); ?></label>
			<select name='_users_folder[]' class='wc-enhanced-select' multiple='multiple' style='width: 80%;' id='folders_select'>
			<?php 
			if(count($folders_dropbox['contents'])>0){
				for($i=0;$i<count($folders_dropbox['contents']);$i++){
					$path=substr($folders_dropbox['contents'][$i]['path'],1);
					if(!empty($folders_stored)){?>
						<option value='<?php echo $path;?>' <?php selected( in_array( $path, $folders_stored ) ); ?>><?php echo $path;?></option>
					<?php }else{?>
						<option value='<?php echo $path;?>'><?php echo $path;?></option>
					<?php }
					} }?>
			</select>
			<img class='help_tip' data-tip="<?php _e( 'Select the folders from dropbox to map them with subscription product.', 'woocommerce' ); ?>" src='<?php echo esc_url( WC()->plugin_url() ); ?>/assets/images/help.png' height='16' width='16'>
			</p>
		<?php die();
	}
	
}

?>