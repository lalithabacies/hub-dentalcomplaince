<?php

function register_admininstartion_pages() {
	global $admin_panel, $setup_page, $options_page, $css_page, $sync_page, $tl_subscriber_page, $integrations_page;

	/* admin pages */
	$admin_panel  = add_menu_page(__('TalentLMS', 'talentlms'), __('TalentLMS', 'talentlms'), 'manage_options', 'talentlms', 'admin_panel');
	$setup_page   = add_submenu_page('talentlms', __('Dashboard', 'talentlms'), __('Dashboard', 'talentlms'), 'manage_options', 'talentlms', 'admin_panel');
	$setup_page   = add_submenu_page('talentlms', __('TalentLMS Setup', 'talentlms'), __('Setup', 'talentlms'), 'manage_options', 'talentlms-setup', 'setupPage');
	$options_page = add_submenu_page('talentlms', __('TalentLMS Options', 'talentlms'), __('Options', 'talentlms'), 'manage_options', 'talentlms-options', 'optionsPage');
	$sync_page 	  = add_submenu_page('talentlms', __('TalentLMS Sync', 'talentlms'), __('Sync', 'talentlms'), 'manage_options', 'talentlms-sync', 'syncPage');
	$integrations_page = add_submenu_page('talentlms', __('TalentLMS Integrations', 'talentlms'), __('Integrations', 'talentlms'), 'manage_options', 'talentlms-integrations', 'integrationsPage');
	$css_page 	  = add_submenu_page('talentlms', __('TalentLMS Edit CSS', 'talentlms'), __('Edit CSS', 'talentlms'), 'manage_options', 'talentlms-css', 'cssPage');


	$tl_subscriber_page = add_menu_page(__('TalentLMS', 'talentlms'), __('TalentLMS', 'talentlms'), 'subscriber', 'talentlms-subscriber', 'talentlms_subscriber');
	//if(get_option('tl-integrate-woocommerce')) {
	//	$tl_customer_page = add_menu_page(__('TalentLMS'), __('TalentLMS'), 'manage_woocommerce', 'talentlms-subscriber', 'talentlms_subscriber');
	//}
	add_action("admin_print_scripts-$admin_panel", 'enqueueCssScripts');

	add_action("admin_print_scripts-$setup_page", 'enqueueCssScripts');
	add_action("admin_print_scripts-$options_page", 'enqueueCssScripts');
	add_action("admin_print_scripts-$sync_page", 'enqueueCssScripts');
	add_action("admin_print_scripts-$integrations_page", 'enqueueCssScripts');
	add_action("admin_print_scripts-$css_page", 'enqueueCssScripts');
	add_action("admin_print_scripts-$css_page", 'enqueueJsScripts');

}

add_action('admin_menu', 'register_admininstartion_pages');


function enqueueJsScripts() {
	// JS required for edit CSS page
	wp_enqueue_script('tl-codemirror-js', _BASEURL_ . 'utils/codemirror-4.8/codemirror.js');
	wp_enqueue_script('tl-codemirror-css-js', _BASEURL_ . 'utils/codemirror-4.8/css.js');

	wp_enqueue_script('tl-admin', _BASEURL_ . 'js/tl-admin.js', false, '1.0');

}

function enqueueCssScripts() {
	wp_enqueue_style("talentlms-admin-style", _BASEURL_ . 'css/talentlms-admin-style.css', false, 1.0);
	wp_enqueue_style('tl-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');
	wp_enqueue_style("tl-codemirror-css", _BASEURL_ . 'utils/codemirror-4.8/codemirror.css');
}

function talentlms_help($contextual_help, $screen_id, $screen) {
	global $admin_panel, $setup_page, $options_page, $css_page, $sync_page, $tl_subscriber_page, $integrations_page;
	include (_BASEPATH_ . '/admin/pages/help.php');
}

add_filter('contextual_help', 'talentlms_help', 10, 3);

function admin_panel() {
	include (_BASEPATH_ . '/admin/pages/admin_panel.php');
}

function setupPage() {

	if ($_POST['action'] == "tl-setup") {

		if ($_POST['tl-domain'] && $_POST['tl-api-key']) {
			$set = true;

			if (!tl_is_domain($_POST['tl-domain'])) {
				$action_status = "error";
				$action_message = $_POST['tl-domain'] . ': ' . __('is not a valid TalentLMS domain','talentlms');
				$set = false;
			}

			if (!tl_is_api_key($_POST['tl-api-key'])) {
				$action_status = "error";
				$action_message = __('API key seems to be invalid', 'talentlms');
				$set = false;
			}

			if ($set) {
				TalentLMS::setDomain($_POST['tl-domain']);
				TalentLMS::setApiKey($_POST['tl-api-key']);

				try {
					$site_info = TalentLMS_Siteinfo::get();
					if ($site_info['domain_map']) {
						update_option('talentlms-domain-map', $site_info['domain_map']);
					} else {
						update_option('talentlms-domain-map', '');
					}
				} catch(Exception $e) {
					if ($e instanceof TalentLMS_ApiError) {
						$action_status = "error";
						$action_message = $e -> getMessage() . " " . $e -> getHttpStatus() . " " . $e -> getHttpBody() . " " . $e -> getJsonBody();
					}
				}

				update_option('talentlms-domain', $_POST['tl-domain']);
				update_option('talentlms-api-key', $_POST['tl-api-key']);

				tl_empty_cache();

				$action_status = "updated";
				$action_message = __('Details edited successfully', 'talentlms');
			}
		} else {
			$action_status = "error";

			if (!$_POST['talentlms_domain']) {
				$domain_validation = 'form-invalid';
				$action_message = __('TalentLMS Domain required', 'talentlms') . "<br />";
				update_option('talentlms-domain', '');
			}

			if (!$_POST['api_key']) {
				$api_validation = 'form-invalid';
				$action_message .= __('TalentLMS API key required', 'talentlms') . "<br />";
				update_option('talentlms-api-key', '');
			}
		}
	}

	include (_BASEPATH_ . '/admin/pages/setup.php');
}


function optionsPage() {

	if($_POST['action'] == 'tl-options') {
		update_option('tl-catalog-categories', $_POST['tl-catalog-categories']);
		//update_option('tl-catalog-view-mode', $_POST['tl-catalog-view-mode']);
		update_option('tl-catalog-view-mode', 'list');
		if($_POST['tl-catalog-per-page'] > 0) {
			update_option('tl-catalog-per-page', $_POST['tl-catalog-per-page']);
		} else {
			$action_status = "error";
			$action_message = " " . __('Per page must be a positive integer.', 'talentlms');
			//$form_validation = 'form-invalid';
			update_option('tl-catalog-per-page', '');
		}
		update_option('tl-signup-redirect', $_POST['tl-signup-redirect']);
		update_option('tl-signup-sync', $_POST['tl-signup-sync']);
		update_option('tl-login-sync', $_POST['tl-login-sync']);
		update_option('tl-login-action', $_POST['tl-login-action']);
		update_option('tl-logout', $_POST['tl-logout']);
		update_option('tl-logoutfromTL', $_POST['tl-logoutfromTL']);
	}

	include (_BASEPATH_ . '/admin/pages/options.php');
}

function syncPage() {

	extract(tl_list_wp_tl_users());

	if ($_POST['action'] == 'tl-sync') {
		$action_status = "updated";
		$action_message = __('Operation completed successfully', 'talentlms');

		foreach ($tl_users as $user) {
			$wp_users[$user['login']]['login'] = $user['login'];
			$wp_users[$user['login']]['email'] = $user['email'];
			$wp_users[$user['login']]['first_name'] = $user['first_name'];
			$wp_users[$user['login']]['last_name'] = $user['last_name'];
		}

		$all_users =  array_merge($tl_users, $wp_users);
		$sync_errors = tl_sync_wp_tl_users($tl_users_to_wp, $wp_users_to_tl, $_POST['tl-hard-sync'], $all_users);

		extract(tl_list_wp_tl_users());

		if(is_array($sync_errors) && !empty($sync_errors)) {
			$action_status = "error";
			$action_message = __('Operation completed but some errors have occured', 'talentlms');
			foreach ($sync_errors as $error) {
				$action_message .= "</p>" . $error . "</p>";
			}
		}
	}

	if($_POST['tl-sync-periodicaly']) {
		update_option('tl-sync-periodicaly', 1);
	}

	$tl_content = TalentLMS_Course::all();
	$wp_content = trim(tl_get_cache_value('courses'));
	$wp_content = preg_replace('!s:(\d+):"(.*?)";!e', "'s:'.strlen('$2').':\"$2\";'", $wp_content);
	$wp_content = unserialize($wp_content);

	if ($_POST['action'] == "tl-cache") {

		tl_empty_cache();

		$tl_content = TalentLMS_Course::all();
		$wp_content = tl_get_courses();


		$action_status = "updated";
		$action_message = __('TalentLMS content synced', 'talentlms');
	}



	include (_BASEPATH_ . '/admin/pages/sync.php');
}

if(get_option('tl-sync-periodicaly')) {
	function syncContent() {
		tl_empty_cache();
		/* add sync of users if sakis says so...*/
	}
	add_action('my_periodic_action','syncContent');



	add_action('after_setup_theme', 'tl_setup_events');
	function tl_setup_events() {
		if (!wp_next_scheduled('my_periodic_action') ) {
			wp_schedule_event(time(), 'twicedaily', 'my_periodic_action');
			//wp_schedule_event(current_time( 'timestamp' ), 'twicedaily', 'my_periodic_action');
			//wp_schedule_event(time(), 'twomin', 'my_periodic_action');
		}
	}
}

function cssPage() {
	if ($_POST['action'] == 'edit-css') {
		file_put_contents(_BASEPATH_ . '/css/talentlms-style.css', stripslashes($_POST['tl-edit-css']));
		$action_status = "updated";
		$action_message = __('Details edited successfully', 'talentlms');
	}
	include (_BASEPATH_ . '/admin/pages/css.php');

}

function integrationsPage() {

	$courses = tl_get_courses();
	$integrated_courses = unserialize(tl_get_cache_value('tl_woocom_integrated_courses'));

	if($_POST['action'] == 'tl-woocommerce') {

		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( is_plugin_active( 'woocommerce/woocommerce.php' )) {

			update_option('tl-integrate-woocommerce', 1);

			//if($_POST['tl-integrate-woocommerce-sync']) {
			if($_POST['tl-integrate-courses']) {
				$courses_to_integrate = $_POST['tl-integrate-courses'];
				require_once (_BASEPATH_ . '/admin/integrations/woocommerce.php');
				update_option('tl-integrate-woocommerce-sync', $_POST['tl-integrate-woocommerce-sync']);
			}

			if($_POST['tl-integrate-woocommerce-signup']) {

				update_option('tl-integrate-woocommerce-signup', $_POST['tl-integrate-woocommerce-signup']);

				$custom_fields = tl_get_custom_fields();
				if(is_array($custom_fields)) {
					foreach($custom_fields as $custom_field) {
						update_option('tl-woocom-'.$custom_field['key'], $_POST['tl-woocom-'.$custom_field['key']]);
					}
				}
			} else {
				update_option('tl-integrate-woocommerce-signup', 0);
			}

			$action_status = "updated";
			$action_message .= __('WooCommerce integration was successful.', 'talentlms');
		} else {
			$action_status = "error";
			$action_message .= " " . __('WooCommerce in not installed or may not be active. Please check your Plugin Manager', 'talentlms');

			update_option('tl-integrate-woocommerce', 0);
			update_option('tl-integrate-woocommerce-signup', 0);
			update_option('tl-integrate-woocommerce-sync', 0);
		}
	}

	include (_BASEPATH_ . '/admin/pages/integrations.php');
}


function talentlms_subscriber() {

	if ($_POST['action'] == 'tl-subscriber-login') {
		if(!$_POST['tl-login']) {
			$action_status = "error";
			$login_validation = 'form-invalid';
			$action_message = __('Login is required', 'talentlms') . "<br />";
		}
		if(!$_POST['tl-password']) {
			$action_status = "error";
			$password_validation = 'form-invalid';
			$action_message .= __('Password required', 'talentlms') . "<br />";
		}
		if($_POST['tl-login'] && $_POST['tl-password']) {
			try {
				$login = TalentLMS_User::login(array('login' => $_POST['tl-login'], 'password' => $_POST['tl-password'], 'logout_redirect' => (get_option('tl-logoutfromTL') == 'wordpress') ? get_bloginfo('wpurl') : 'http://'.get_option('talentlms-domain')));
				session_start();
				$_SESSION['talentlms_user_id'] = $login['user_id'];
				$_SESSION['talentlms_user_login'] = $_POST['tl-login'];
				$_SESSION['talentlms_user_pass'] = $_POST['tl-password'];

				unset($GLOBALS['talentlms_error_msg']);
			} catch (Exception $e) {
				if ($e instanceof TalentLMS_ApiError) {
					$action_status = "error";
					$action_message = $e -> getMessage();;
				}
			}
		}
	}

	include (_BASEPATH_ . '/admin/pages/talentlms_subscriber.php');
}


if ((!get_option('talentlms-domain') && !$_POST['talentlms_domain']) || (!get_option('talentlms-api-key') && !$_POST['api_key'])) {
	function talentlms_warning() {
		echo "<div id='talentlms-warning' class='error fade'><p><strong>" . __('You need to specify a TalentLMS domain and a TalentLMS API key.', 'talentlms') . "</strong> " . sprintf(__('You must <a href="%1$s">enter your domain and API key</a> for it to work.', 'talentlms'), "admin.php?page=talentlms") . "</p></div>";
	}

	add_action('admin_notices', 'talentlms_warning');
} else {
	try{
		TalentLMS::setApiKey(get_option('talentlms-api-key'));
		TalentLMS::setDomain(get_option('talentlms-domain'));
	} catch(Exception $e) {
		if ($e instanceof TalentLMS_ApiError) {
			echo "<div class='alert alert-error'>";
			echo $e -> getMessage();
			echo "</div>";
		}
	}

	function add_those_scripts () {
		wp_enqueue_script('jquery');
		wp_enqueue_style('talentlms-css', _BASEURL_ . '/css/talentlms-style.css', false, '1.0');
	}
	add_action( 'wp_enqueue_scripts', 'add_those_scripts' );

	include (_BASEPATH_ . '/shortcodes/reg_shortcodes.php');

	if(get_option('tl-signup-sync')) {
		include (_BASEPATH_ . '/admin/registration_form/tl-custom-registration-form.php');
	}

}


/*********************************************************************************
 * Logout process
 */
function tl_logout() {
	$tl_user_id =  $_SESSION['talentlms_user_id'];

	unset($_SESSION['talentlms_user_id']);
	unset($_SESSION['talentlms_user_login']);
	unset($_SESSION['talentlms_user_pass']);

	try{
		TalentLMS_User::logout(array('user_id' => $tl_user_id));
	} catch (Exception $e) {
	}

	if(get_option('tl-logout') == 'wordpress') {
		wp_redirect(home_url());
		exit();
	} else {
		wp_redirect('http://'.get_option('talentlms-domain'));
		exit();
	}
}
add_action('wp_logout', 'tl_logout');

function tl_login() {
	try{
		$login = TalentLMS_User::login(array('login' => $_POST['log'], 'password' => $_POST['pwd'], 'logout_redirect' => (get_option('tl-logoutfromTL') == 'wordpress') ? get_bloginfo('wpurl') : 'http://'.get_option('talentlms-domain')));
		session_start();
		$_SESSION['talentlms_user_id'] = $login['user_id'];
		$_SESSION['talentlms_user_login'] = $_POST['log'];
		$_SESSION['talentlms_user_pass'] = $_POST['pwd'];

	} catch (Exception $e) {}
}
add_action('wp_login', 'tl_login');




if(get_option('tl-integrate-woocommerce')) {

	function my_new_customer_data($new_customer_data){
		$new_customer_data['role'] = 'subscriber';
		return $new_customer_data;
	}
	add_filter( 'woocommerce_new_customer_data', 'my_new_customer_data');


	function tl_wc_login() {
		$wp_user = get_user_by('login', $_POST['username']);

		$login = TalentLMS_User::login(array('login' => $wp_user->data->user_login, 'password' => $_POST['password'], 'logout_redirect' => (get_option('tl-logoutfromTL') == 'wordpress') ? get_bloginfo('wpurl') : 'http://'.get_option('talentlms-domain')));
		session_start();
		$_SESSION['talentlms_user_id'] = $login['user_id'];
		$_SESSION['talentlms_user_login'] = $wp_user->data->user_login;
		$_SESSION['talentlms_user_pass'] = $_POST['password'];
		wp_redirect( wc_get_page_permalink( 'myaccount' ) );
	}
	add_filter('woocommerce_login_redirect', 'tl_wc_login');

	if(get_option('tl-integrate-woocommerce-signup')) {

		function tl_wc_signup($customer_id, $new_customer_data, $password_generated ) {
			try {
				$username = explode("@", $_POST['billing_email']);
				$username = $username[0];

				$signup_arguments = array(
					'first_name' => $_POST['billing_first_name'],
					'last_name' => $_POST['billing_last_name'],
					'email' => $_POST['billing_email'],
					'login' => $username,
					'password' => $_POST['account_password']
				);

				$user = get_user_by( 'email', $_POST['billing_email'] );
				$custom_fields = tl_get_custom_fields();
				if (is_array($custom_fields)) {
					foreach ($custom_fields as $custom_field) {
						$signup_arguments[$custom_field['key']] = $_POST[get_option('tl-woocom-'.$custom_field['key'])];
						update_user_meta($user->data->ID, $custom_field['key'], $_POST[get_option('tl-woocom-'.$custom_field['key'])]);
					}
				}
				try{
					$newUser = TalentLMS_User::signup($signup_arguments);
					$login = TalentLMS_User::login(array('login' => $signup_arguments['login'], 'password' => $signup_arguments['password'], 'logout_redirect' => (get_option('tl-logoutfromTL') == 'wordpress') ? get_bloginfo('wpurl') : 'http://'.get_option('talentlms-domain')));
				} catch (Exception $e){
					wp_delete_user( $customer_id );
					wc_add_notice($e->getMessage(),'error');
				}


				session_start();
				$_SESSION['talentlms_user_id'] = $login['user_id'];
				$_SESSION['talentlms_user_login'] = $signup_arguments['login'];
				$_SESSION['talentlms_user_pass'] = $signup_arguments['password'];


			} catch (Exception $e){}
		}
		add_action('woocommerce_created_customer', 'tl_wc_signup');
		//add_action('user_register', 'tl_wc_signup');


	}


	function tl_wc_order_status_completed($order_id) {
		$order = new WC_Order($order_id);
		foreach($order->get_items() as $items) {
			$result = get_post_meta($items['product_id'], '_talentlms_course_id');
			try{
				TalentLMS_Course::addUser(array('user_email' => $order->billing_email, 'course_name' => $items['name']));
			} catch (Exception $e){
				try{
					TalentLMS_Course::addUser(array('user_email' => $order->billing_email, 'course_id' => $result[0]));
				}catch (Exception $e){
					do_action('woocommerce_add_error', array($e->getMessage()));
				}
			}
		}
	}
	add_filter('woocommerce_order_status_completed', 'tl_wc_order_status_completed');


	add_action( 'woocommerce_thankyou', 'custom_woocommerce_auto_complete_order' );
	function custom_woocommerce_auto_complete_order( $order_id ) {
		if ( ! $order_id ) {
			return;
		}

		$order = wc_get_order( $order_id );
		$order->update_status( 'completed' );
	}

	function talentlms_woocommerce_error( $error ) {
		return $error;
	}
	add_filter( 'woocommerce_add_error', 'talentlms_woocommerce_error' );

}

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( !is_plugin_active( 'woocommerce/woocommerce.php' )) {
	update_option('tl-integrate-woocommerce', 0);
}
?>