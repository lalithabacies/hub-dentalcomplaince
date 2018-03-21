<?php
/**
 * Plugin Name: Share Document
 * Plugin URI: http://abacies.com
 * Description: Super Admin can upload document network wide.
 * Version: 1.0
 * Author: Abacies
 * Author URI: http://abacies.com
 * License: Abacies
 */
 
define( 'SHD_URL',     plugin_dir_url( __FILE__ )  );
define( 'SHD_PATH',    plugin_dir_path( __FILE__ ) );
class ShareDocument
{

	protected $core_settings = array(
		'enabled'	=> true,
		'auto_complete_status' => true
		);
	public static $_instance = null;
	/** construct method */
	function __construct ()
	{
		add_action('init', array( __CLASS__, 'shd_includes'));
		add_action( 'admin_enqueue_scripts', array($this, 'share_document_scripts') );
		/** activation hook for the server */
		register_activation_hook(__FILE__, array($this, 'setup'));
	}

	/**
	 * Load the instance of the plugin
	 */
	public static function shd_instance (){
		if ( is_null( self::$_instance ) ) 
			self::$_instance = new self();

		return self::$_instance;
	}

	public static function shd_includes(){
		//include_once(dirname(__FILE__) . '/includes/templates/custom_document_form.php');
		include_once(dirname(__FILE__) . '/includes/shd_functions.php');
	}
	public function share_document_scripts() {
		wp_enqueue_style( 'shd-style', plugin_dir_url( __FILE__ ) . 'assets/css/shd_style.css');
		wp_enqueue_script( 'shd_script', plugin_dir_url( __FILE__ ) . 'assets/js/shd_script.js');
		$translation_array = array(
			'typeahead' => plugin_dir_url( __FILE__ ),
			'shdajaxurl' => admin_url('admin-ajax.php')
		);
		wp_localize_script('jquery', 'shd_script', $translation_array);
	}

	
	public function setup (){

	}
}
add_action( 'plugins_loaded', 'share_doc_init' );
function share_doc_init() {
	$agcnctr = ShareDocument::shd_instance();
}