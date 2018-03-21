<?php
/**
 * Plugin Name:Dropbox
 * Plugin URI: http://abacies.com
 * Description: Adds Dropbox features
 * Version: 1.1.0
 * Author: Abacies
 * Author URI: http://abacies.com
 * License: Abacies
 */
 
//defines path
define( 'WSA_URL',     plugin_dir_url( __FILE__ )  );
define( 'WSA_PATH',    plugin_dir_path( __FILE__ ) );
class DropBox_Setting
{
	public static $_instance = null;
	/** construct method */
	function __construct ()
	{
		add_action('init', array( __CLASS__, 'db_includes'));
		
		add_action( 'admin_enqueue_scripts',  array( $this,'load_woo_subs_js_admin') );
		
		add_action('wp_enqueue_scripts', array( $this, 'load_woo_subs_styles_front'));
		
		//add_action( 'admin_menu', array('DropBox_Setting','wpdocs_register_my_custom_menu_page') );
		
		add_shortcode('folders-display',array('Dropboxapi','show_template'));
		
		add_action( 'admin_menu', array( $this, 'option_page_callback_func' ) );
		
		add_action( 'wp_ajax_get_dropbox_userspage', array('WooUserDropbox','get_dropbox_userspage') );
        
		add_action( 'wp_ajax_nopriv_get_dropbox_userspage', array('WooUserDropbox','get_dropbox_userspage') );
		
		/** activation hook for the server */
		register_activation_hook(__FILE__, array($this, 'setup'));
	}

	/**
	 * Load the instance of the plugin
	 */
	public static function db_instance(){
		if ( is_null( self::$_instance ) ) 
			self::$_instance = new self();

		return self::$_instance;
	}
	public function setup (){
	}
	
	/**
	 * Includes the required files
	*/
	public function db_includes(){
		require_once( dirname(__FILE__) .'/includes/classes/dropboxapi.php');  
		require_once( dirname(__FILE__) .'/includes/classes/users_dropbox.php');
	}

	/*include admin js */
	public function load_woo_subs_js_admin() {	
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-dialog' );
		wp_enqueue_style( 'wp-jquery-ui-dialog' );	
		if($_GET['page'] && $_GET['page'] == 'user-dropbox'){
			wp_register_style( 'select2css', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css', false, '1.0', 'all' );
			wp_register_script( 'select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js', array( 'jquery' ), '1.0', true );
			wp_enqueue_style( 'select2css' );
			wp_enqueue_script( 'select2' );
		}
	    //wp_enqueue_script( 'bootstrap-js', WSA_URL . 'js/bootstrap.min.js', array('jquery'), '3.3.4', true );
		wp_enqueue_script( 'woo_addon_script', WSA_URL . 'js/subs_addon_script.js' );
		//wp_enqueue_style('bootstrap', WSA_URL . '/css/bootstrap.min.css');
		if($_GET['page'] && $_GET['page'] == 'folders'){
			wp_enqueue_style( 'woo_addon_css', WSA_URL . 'css/customstyle.css');
		}
		$translation_array = array(
		'typeahead' => plugin_dir_url( __FILE__ ),
		'ajax_url' => admin_url('admin-ajax.php')
		);
		wp_localize_script( 'jquery', 'addon_script', $translation_array );
		
	}
	
	/*include front end js css files */
	public function load_woo_subs_styles_front(){
		wp_enqueue_style( 'woo_addon_css_front', WSA_URL . 'css/customstyle_front.css' );
	}

	/**
	* Register a custom menu page in backend.
	*/
	public function wpdocs_register_my_custom_menu_page() {
		add_menu_page(
			__( 'Documents', 'textdomain' ),
			'Documents',
			'read',
			'folders',
			array('DropBox_Setting','display_folders'),
			'dashicons-media-document',
			6
		);
		add_submenu_page( 'null', 'submenu', 'My Custom Page',
		'read', 'Documents',array('Dropboxapi','finish_page'));
		add_users_page( 'Map Dropbox Folders', 'Map Dropbox Folders', 'manage-option', 'user-dropbox', array('WooUserDropbox' , 'display_user_dropbox' ));
	}
	
	/**
	* Register a settings page
	**/
	public function option_page_callback_func(){
		add_options_page(
			'Dropbox API',
			'dropbox_api',
			'manage_options',
			'dropbox_api',
			array(
				$this,
				'settings_page_content'
			)
		);
	}
	function  settings_page_content() {
			global $wpdb;
			if(isset($_POST['submit_settings']) && $_POST['submit_settings'] == "Submit"){
				$dropbox_key     = $_POST['dropbox_key'];
				$dropbox_secret  = $_POST['dropbox_secret'];
				$dropbox_appname = $_POST['dropbox_appname'];
				$dropbox_accesstoken = $_POST['dropbox_accesstoken'];
				$drpbox_settings = array("dropbox_key"=>$dropbox_key,"dropbox_secret"=>$dropbox_secret,"dropbox_appname"=>$dropbox_appname);
				update_option("drpbox_settings",$drpbox_settings);
                
                $access_details = array("id"=>1,"userid"=>1,"dropboxKey"=>$dropbox_key,"dropboxSecret"=>$dropbox_secret,"appName"=>$dropbox_appname,"accessToken"=>$dropbox_accesstoken,"username"=>"","dropbox_token"=>"");
                update_option('drop_box_api',$access_details);
			}
			$get_settings = get_option("drpbox_settings",true);
			$get_drop_box_api = get_option("drop_box_api",true);
			if(is_array($get_settings)){
				$get_dropbox_key = $get_settings['dropbox_key'];
				$get_dropbox_secret = $get_settings['dropbox_secret'];
				$get_dropbox_appname = $get_settings['dropbox_appname'];
				$get_dropbox_accesstoken = $get_drop_box_api['accessToken'];
			}
	?>
		<form method="post">
			<table class="form-table">
				<tr valign="top">
					<th scope="row">DropBox Key</th>
					<td><input type="text" name="dropbox_key" value="<?php if(isset($get_dropbox_key) && $get_dropbox_key!="") echo $get_dropbox_key;?>" required /></td>
				</tr>

				<tr valign="top">
					<th scope="row">DropBox Secret</th>
					<td><input type="text" name="dropbox_secret" value="<?php if(isset($get_dropbox_secret) && $get_dropbox_secret!="") echo $get_dropbox_secret;?>" required/></td>
				</tr>

				<tr valign="top">
					<th scope="row">DropBox Appname</th>
					<td><input type="text" name="dropbox_appname" value="<?php if(isset($get_dropbox_appname) && $get_dropbox_appname!="") echo $get_dropbox_appname;?>" required/></td>
				</tr>
                
                <tr valign="top">
					<th scope="row">DropBox AccessToken</th>
					<td><input type="text" name="dropbox_accesstoken" value="<?php if(isset($get_dropbox_accesstoken) && $get_dropbox_accesstoken!="") echo $get_dropbox_accesstoken;?>" required/></td>
				</tr>
				<tr valign="top">
					<td><input type="submit" name="submit_settings" value="Submit" class="button button-primary" /></td>
				</tr>
			</table>

		</form>
	<?php }
	public function display_folders(){
		echo do_shortcode('[folders-display]');		
		
	}
}

Class DropBoxMetaBox{
    
    function __construct(){
        add_action( 'add_meta_boxes', array($this,'cd_meta_box_add') );
        add_action('save_post', array($this,'dropbox_save_postdata'));
    }
    
    public function cd_meta_box_add()
    {
        $screens = array( 'post', 'page' );
        foreach ( $screens as $screen ) {
            add_meta_box( 'dropbox_boxes', 'Dropbox Folders', array($this,'dropbox_build_meta_box'), $screen, 'side', 'core');
        }
    }
    
    public function dropbox_build_meta_box($post){
        $value = get_post_meta($post->ID, '_dropbox_meta_key', true);
        $dropbox_api = new Dropboxapi();
        $folders_dropbox = $dropbox_api->display_folder_list();
        $stored_folders  = array();
        if(count($folders_dropbox)>0){
            for($i=0;$i<count($folders_dropbox);$i++){ 
                $objects = $folders_dropbox[$i];
                if(empty(trim($objects->client_modified))){
                $path=$objects->name;
                $checked = is_array($value)?(in_array($path,$value)?"checked":""):"";
                ?>
                <label class=""><input type="checkbox" name="_dropbox_folder[]" value="<?php echo $path?>" <?php echo $checked?>><span class="pp-access-level-label"><?php echo $path?></span></label></br>
                <?php
                }
            }
        }
    }
    
    function dropbox_save_postdata($post_id)
    {
        if (array_key_exists('_dropbox_folder', $_POST)) {
            update_post_meta(
                $post_id,
                '_dropbox_meta_key',
                $_POST['_dropbox_folder']
            );
        }
    }
}

add_action( 'plugins_loaded', 'dropbox_init' );
function dropbox_init() {
	DropBox_Setting::db_instance();
    new DropBoxMetaBox();
}




?>
