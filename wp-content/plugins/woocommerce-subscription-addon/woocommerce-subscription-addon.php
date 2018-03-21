<?php
/**
 * Plugin Name:Woocommerce Subscription Addon
 * Plugin URI: http://abacies.com
 * Description: Adds option to extend woocommerce subscription functionality
 * Version: 1.1.0
 * Author: Abacies
 * Author URI: http://abacies.com
 * License: Abacies
 */
 
//defines path
define( 'WSA_URL',     plugin_dir_url( __FILE__ )  );
define( 'WSA_PATH',    plugin_dir_path( __FILE__ ) );
class WooSubsAddon
{
	protected $core_settings = array(
		'enabled'	=> true,
		'auto_complete_status' => true
		);
	public static $_instance = null;
	/** construct method */
	function __construct ()
	{
		add_action('init', array( __CLASS__, 'wsa_includes'));
		
		add_action( 'admin_enqueue_scripts',  array( $this,'load_woo_subs_js_admin') );
		
		add_action('wp_enqueue_scripts', array( $this, 'load_woo_subs_styles_front'));
		
		add_filter( 'woocommerce_product_data_tabs', array('woocommerce_addondata','custom_product_tabs') );
		add_action( 'woocommerce_product_data_panels', array('woocommerce_addondata', 'dropbox_options_product_tab_content') );
		
		add_action( 'woocommerce_process_product_meta', array('woocommerce_addondata','save_dropbox_option_fields' ) );

		add_filter( 'woocommerce_product_data_tabs', array('woocommerce_subscription_page_restrict','custom_product_tabs') );
		
		add_action( 'woocommerce_product_data_panels', array('woocommerce_subscription_page_restrict', 'dropbox_options_product_tab_content') );
		
		add_action( 'woocommerce_process_product_meta', array('woocommerce_subscription_page_restrict','save_dropbox_option_fields' ) );
        // course tab in subscription product
		add_filter( 'woocommerce_product_data_tabs', array('woocommerce_subscription_course_restrict','custom_product_tabs_course') );
		
		add_action( 'woocommerce_product_data_panels', array('woocommerce_subscription_course_restrict', 'course_options_product_tab_content') );
		
		add_action( 'woocommerce_process_product_meta', array('woocommerce_subscription_course_restrict','save_course_option_fields' ) );

		
		add_action( 'admin_menu', array('WooSubsAddon','wpdocs_register_my_custom_menu_page') );
		
		add_shortcode('folders-display',array('Dropboxapi','show_template'));
		
		add_action( 'admin_menu', array( $this, 'option_page_callback_func' ) );
		
		//add_action( 'wpmu_new_blog', array('BlogCopierSite', 'copy_blog_callback'), 99, 2 );
		
		add_filter( 'blog_templates-templates_table_custom_column', array('BlogCopierSite','add_extra_field_blogtemplate') );
		
		add_action( 'wp_ajax_get_dropbox_userspage', array('WooUserDropbox','get_dropbox_userspage') );
		add_action( 'wp_ajax_nopriv_get_dropbox_userspage', array('WooUserDropbox','get_dropbox_userspage') );
		
		/** activation hook for the server */
		register_activation_hook(__FILE__, array($this, 'setup'));
	}

	/**
	 * Load the instance of the plugin
	 */
	public static function wsa_instance(){
		if ( is_null( self::$_instance ) ) 
			self::$_instance = new self();

		return self::$_instance;
	}
	public function setup (){
	}
	
	/**
	 * Includes the required files
	*/
	public function wsa_includes(){
		require_once( dirname(__FILE__) .'/includes/classes/woocommerce_addondata.php');
		require_once( dirname(__FILE__) .'/includes/classes/woocommerce_order.php');
		require_once( dirname(__FILE__) .'/includes/classes/woocommerce_subscription_page_restrict.php');
		require_once( dirname(__FILE__) .'/includes/classes/woocommerce_subscription_course_restrict.php');
		require_once( dirname(__FILE__) .'/includes/classes/dropboxapi.php');  
		require_once( dirname(__FILE__) .'/includes/classes/BlogCopierSite.php');
		require_once( dirname(__FILE__) .'/includes/classes/woocommerce_users_dropbox.php');require_once( dirname(__FILE__) .'/includes/restriction_functions.php');		
		include_once( WP_CONTENT_DIR . '/plugins/blogtemplates/nbt-api.php' );
		nbt_load_api();
	}
	/**
	 * Includes the required files
	*/
	public static function load_actions(){
		add_action( 'woocommerce_order_status_completed', array('woocommerce_order','subscription_new_order_received'));
		add_action( 'updated_users_subscriptions_for_order', array('woocommerce_order','manually_complete_subscription_order'));		
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
			array('WooSubsAddon','display_folders'),
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
				$drpbox_settings = array("dropbox_key"=>$dropbox_key,"dropbox_secret"=>$dropbox_secret,"dropbox_appname"=>$dropbox_appname);
				update_option("drpbox_settings",$drpbox_settings);
			}
			$get_settings = get_option("drpbox_settings",true);
			if(is_array($get_settings)){
				$get_dropbox_key = $get_settings['dropbox_key'];
				$get_dropbox_secret = $get_settings['dropbox_secret'];
				$get_dropbox_appname = $get_settings['dropbox_appname'];
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
					<td><input type="submit" name="submit_settings" value="Submit" class="button button-primary" /></td>
				</tr>
			</table>

		</form>
	<?php }
	public function display_folders(){
		echo do_shortcode('[folders-display]');		
		
	}
		
}
add_action( 'plugins_loaded', 'wsa_init' );
function wsa_init() {
	WooSubsAddon::wsa_instance();
	WooSubsAddon::load_actions();
	// call blog copier manually
	//require_once( dirname(__FILE__) .'/includes/classes/BlogCopierSite.php');
	//$instance_copier = new BlogCopierSite();
	//$instance_copier->wpmu_blog_copier(3,2,$_passed_domain=false, $_passed_path=false, $_passed_site_id=false, $_passed_meta=false);
}

/* Filter the single_template with our custom function*/
add_filter('single_template', 'my_custom_template');

function my_custom_template($single) {

    global $wp_query, $post;

    /* Checks for single template by post type */
    if ( $post->post_type == 'sfwd-courses' ) {
        if ( file_exists( WSA_PATH . 'includes/templates/single-sfwd-courses.php' ) ) {
            return WSA_PATH . 'includes/templates/single-sfwd-courses.php';
        }
    }
    if ( $post->post_type == 'sfwd-lessons' ) {
        if ( file_exists( WSA_PATH . 'includes/templates/single-sfwd-lessons.php' ) ) {
            return WSA_PATH . 'includes/templates/single-sfwd-lessons.php';
        }
    }
	if ( $post->post_type == 'sfwd-topic' ) {
        if ( file_exists( WSA_PATH . 'includes/templates/single-sfwd-topic.php' ) ) {
            return WSA_PATH . 'includes/templates/single-sfwd-topic.php';
        }
    }
	if ( $post->post_type == 'sfwd-quiz' ) {
        if ( file_exists( WSA_PATH . 'includes/templates/single-sfwd-quiz.php' ) ) {
            return WSA_PATH . 'includes/templates/single-sfwd-quiz.php';
        }
    }
    return $single;

}
function apply_course_restriction($current_post_id){
	global $wpdb;
	//return if user is not logged in
	if(!is_user_logged_in()){
		return die('<div style="center;margin-top:20px;">Please login to access Courses</div>');
	}
	//execute the below code only if not super admin
	if(!is_super_admin()){
		//get current user id
		$user_id = get_current_user_id();
		$user_blogs = get_blogs_of_user( $user_id );
		foreach ($user_blogs AS $user_blog) {
			 if ( $user_blog->userblog_id != 1 ) {
				$users_blog = $user_blog->userblog_id;
				$subscription_details = get_blog_option($users_blog,'subscription_details',true);
				$subscription_id = $subscription_details['subscription_id'];
				//go to primary blog and take subscription meta
				switch_to_blog(1);
				$accessed_courses = get_post_meta($subscription_id,'_subscription_courses',true);
				restore_current_blog();
				if(is_array($accessed_courses)){
					if(in_array($current_post_id,$accessed_courses)){

							
					}else{
						return die('<div style="center;margin-top:20px;">Access do this page not allowed</div>');
					}

				}else{
					return die('<div style="center;margin-top:20px;">Access do this page not allowed</div>');
				}
			 }
		}
	}

}


// shortcode function to display the list of courses available for students and site admins
function course_list_with_restriction(){
	global $wpdb,$blog_id,$post;
	$html = '';
	//return if user is not logged in
	if(!is_user_logged_in()){
		return die('<div style="center;margin-top:20px;">Please login to access Courses</div>');
	}
	//execute the below code only if not super admin
		//get current user id
	$user_id = get_current_user_id();
	$users_blog = $blog_id;
	if( is_blog_user( $users_blog ) ){
		$subscription_details = get_blog_option($users_blog,'subscription_details',true);
		$subscription_id = $subscription_details['subscription_id'];
		//go to primary blog and take subscription meta
		switch_to_blog(1);
		$accessed_courses = get_post_meta($subscription_id,'_subscription_courses',true);
		
		if(is_array($accessed_courses)){
			//error_reporting(0);
			$flag = 0;
			foreach ( $accessed_courses as $course_id ) {
				$course_data = get_post( $course_id);
				$title = $course_data->post_title;
				$content = $course_data->post_content;
				$excerpt = substr($content, 0, 155);
				$permalink =  get_permalink($course_id);
				$featured_image = wp_get_attachment_url( get_post_thumbnail_id($course_id, 'thumbnail') );
				if($featured_image){
					$html.='<a href="'.$permalink.'" target="_blank"><div class="available-ct"><img src="'.$featured_image.'" height="40px" width="40px"/></div></a>';
				}							
				$html.='<a href="'.$permalink.'" target="_blank"><div class="available-ct"><span>Course Title : </span>'.$title.'</div></a>';
				$html.='<div class="available-cc">'.$excerpt.'</h3>';
				//$html.=do_shortcode('[course_content course_id='.$course_id.']');
				$html.='<hr>';			
			}

		}else{
			 $html.='<div class="doc_not_found">No course found</div>';
		}
		restore_current_blog();
	}else{
		$html.='<div class="doc_not_found">Not a User of this website!</div>';
	}
	echo $html;
	
}
add_shortcode('available-course-restricted','course_list_with_restriction');
?>
