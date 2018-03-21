<?php
/**
 * Fix for Hearders already sent
 * checkout: https://tommcfarlin.com/wp_redirect-headers-already-sent/
 */
function app_output_buffer() {
	ob_start();
}
add_action('init', 'app_output_buffer');

function talentlms_course_list($atts) {
	wp_enqueue_style('tl-font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css');
	wp_enqueue_style('tl-datatables-css', 'https://cdn.datatables.net/1.10.11/css/dataTables.jqueryui.min.css');
	wp_enqueue_style("jquery-ui-css", "http://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css");

	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-dialog');
	wp_enqueue_script('tl-datatables-js', 'https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js');
	wp_enqueue_script('tl-datatables-bootstrap-js', 'https://cdn.datatables.net/1.10.11/js/dataTables.jqueryui.min.js');
	wp_enqueue_script('tl-course-list', _BASEURL_ . 'js/tl-course-list.js', false, '1.0');
	wp_enqueue_script('tl-jquery-dialogOptions', _BASEURL_ . 'utils/jquery.dialogOptions.js');

	if ($_POST['action'] == "tl-dialog-post") {
		// login user to TalentLMS
		if ($_POST['tl-dialog-login'] && $_POST['tl-dialog-password']) {
			try {
				$login = TalentLMS_User::login(array(
					'login' => $_POST['tl-dialog-login'],
					'password' => $_POST['tl-dialog-password'],
					'logout_redirect' => (get_option('tl-logoutfromTL') == 'wordpress') ? get_bloginfo('wpurl') : 'http://'.get_option('talentlms-domain')));

				session_start();
				$_SESSION['talentlms_user_id'] = $login['user_id'];
				$_SESSION['talentlms_user_login'] = $_POST['tl-dialog-login'];
				$_SESSION['talentlms_user_pass'] = $_POST['tl-dialog-password'];

				// if so, login user to WP
				if(get_option('tl-signup-sync') || get_option('tl-login-action') == 'wordpress') {
					$creds = array();
					$creds['user_login'] = $_SESSION['talentlms_user_login'];

					$userdata = get_user_by( 'login', $_SESSION['talentlms_user_login'] );

					if(wp_check_password(trim($_SESSION['talentlms_user_pass']), trim($userdata->data->user_pass), $userdata->ID)) {
						$creds['user_password'] = $_SESSION['talentlms_user_pass'];
					} else {
						$creds['user_password'] = $_SESSION['talentlms_user_login'];
					}

					$wpuser = wp_signon( $creds, false );

					if(is_wp_error($wpuser) && get_option('tl-signup-sync')) {
						unset($_SESSION['talentlms_user_id']);
						unset($_SESSION['talentlms_user_login']);
						unset($_SESSION['talentlms_user_pass']);

						$tl_login_failed = true;
						$tl_login_fail_message[] = $wpuser->get_error_message() . " (" . __('WordPress authentication', 'talentlms') . ")";
					} else {
						wp_set_current_user($wpuser->data->ID);
						wp_set_auth_cookie($wpuser->data->ID);
						do_action('wp_login', $wpuser->data->user_login, $wpuser);

						if(get_option('tl-login-action') == 'talentlms') {
							//echo "<script>window.location.href='".tl_talentlms_url($login['login_key'])."';</script>";
							//wp_redirect(tl_talentlms_url($login['login_key']));
						} else {
							//echo "<script>window.location.href='".admin_url('admin.php?page=talentlms-subscriber')."';</script>";
							//wp_redirect(admin_url('admin.php?page=talentlms-subscriber'));
						}
					}
				}
			} catch (Exception $e) {
				if ($e instanceof TalentLMS_ApiError) {
					unset($_SESSION['talentlms_user_id']);
					unset($_SESSION['talentlms_user_login']);
					unset($_SESSION['talentlms_user_pass']);

					$tl_login_failed = true;
					$tl_login_fail_message[] = $e -> getMessage()  . " (" . __('TalentLMS authentication', 'talentlms') . ")";;
				}
			}
		} else {
			$tl_login_failed = true;
			if (!$_POST['tl-dialog-login']) {
				$tl_login_fail_message[] = __('Username cannot be empty', 'talentlms');
			}
			if (!$_POST['tl-dialog-password']) {
				$tl_login_fail_message[] .= __('Password cannot be empty', 'talentlms');
			}
		}
	}


	if ($_POST['talentlms-get-course']) {
		session_start();
		$talentlms_info = tl_get_siteinfo();
		if (preg_replace("/\D+/", "", html_entity_decode($_POST['talentlms-course-price'])) > 0 && $talentlms_info['paypal_email']) {
			$buyCourse = TalentLMS_Course::buyCourse(array('user_id' => $_SESSION['talentlms_user_id'], 'course_id' => $_POST['talentlms-get-course']));
			wp_redirect(tl_talentlms_url($buyCourse['redirect_url']));
			exit ;
		} else {
			$addUserToCourse = TalentLMS_Course::addUser(array('user_id' => $_SESSION['talentlms_user_id'], 'course_id' => $_POST['talentlms-get-course']));
		}
	}
	ob_start();
	include (_BASEPATH_ . '/shortcodes/talentlms_courses.php');
	$output = ob_get_clean();
	return $output;
}

add_shortcode('talentlms-courses', 'talentlms_course_list');

function talentlms_forgot_credentials($atts) {
	wp_enqueue_script('tl-forgot', _BASEURL_ . 'js/tl-forgot.js', false, '1.0');

	if ($_POST['tl-forgot-credentials']) {
		if ($_POST['tl-reset-password']) {
			try {
				TalentLMS_User::forgotPassword(array('username' => $_POST['tl-forgot-login']));
				$tl_forgot_succeed = true;
				$tl_fogot_success_message = __('An email for password reset has been sent to your account\'s email.', 'talentlms');
			} catch(Exception $e) {
				if ($e instanceof TalentLMS_ApiError) {
					$tl_forgot_failed = true;
					$tl_fogot_fail_message = "<strong>" . __('Something is wrong!', 'talentlms') . "</strong> " . $e -> getMessage();
				}
			}
		}

		if ($_POST['tl-send-login']) {
			try {
				TalentLMS_User::forgotUsername(array('email' => $_POST['tl-forgot-email']));
				$tl_forgot_succeed = true;
				$tl_fogot_success_message = __('An email with your username has been sent to your account\'s email.', 'talentlms');
			} catch(Exception $e) {
				if ($e instanceof TalentLMS_ApiError) {
					$tl_forgot_failed = true;
					$tl_fogot_fail_message = "<strong>" . __('Something is wrong!', 'talentlms') . "</strong> " . $e -> getMessage();
				}
			}
		}
	}

	ob_start();
	include (_BASEPATH_ . '/shortcodes/talentlms_forgot_credentials.php');
	$output = ob_get_clean();
	return $output;

}

add_shortcode('talentlms-forgot-credentials', 'talentlms_forgot_credentials');

function talentlms_login($atts) {

	// if logout form posted
	if ($_POST['talentlms-logout']) {
		wp_logout();
	}

	// if login form posted
	if ($_POST['talentlms-login'] && $_POST['talentlms-password']) {
		try{
			// login user to TalentLMS
			$login = TalentLMS_User::login(array(
				'login' => $_POST['talentlms-login'],
				'password' => $_POST['talentlms-password'],
				'logout_redirect' => (get_option('tl-logoutfromTL') == 'wordpress') ? get_bloginfo('wpurl') : 'http://'.get_option('talentlms-domain')
			));

			session_start();
			$_SESSION['talentlms_user_id'] = $login['user_id'];
			$_SESSION['talentlms_user_login'] = $_POST['talentlms-login'];
			$_SESSION['talentlms_user_pass'] = $_POST['talentlms-password'];

			// if so, login user to WP
			if(get_option('tl-login-sync')) {
				//if(get_option('tl-signup-sync') || get_option('tl-login-action') == 'wordpress') {
				$creds = array();
				$creds['user_login'] = $_SESSION['talentlms_user_login'];

				$userdata = get_user_by( 'login', $_SESSION['talentlms_user_login'] );

				if(wp_check_password(trim($_SESSION['talentlms_user_pass']), trim($userdata->data->user_pass), $userdata->ID)) {
					$creds['user_password'] = $_SESSION['talentlms_user_pass'];
				} else {
					$creds['user_password'] = $_SESSION['talentlms_user_login'];
				}

				$wpuser = wp_signon( $creds, false );

				if(is_wp_error($wpuser) && get_option('tl-signup-sync')) {
					unset($_SESSION['talentlms_user_id']);
					unset($_SESSION['talentlms_user_login']);
					unset($_SESSION['talentlms_user_pass']);

					$tl_login_failed = true;
					$tl_login_fail_message[] = $wpuser->get_error_message() . " (" . __('WordPress authentication', 'talentlms') . ")";
				} else {
					wp_set_current_user($wpuser->data->ID);
					wp_set_auth_cookie($wpuser->data->ID);
					do_action('wp_login', $wpuser->data->user_login, $wpuser);

					if(get_option('tl-login-action') == 'talentlms') {
						wp_redirect(tl_talentlms_url($login['login_key']));
					} else {
						if(get_option('tl-integrate-woocommerce') && get_option('tl-integrate-woocommerce-signup')) {
							wp_redirect( wc_get_page_permalink( 'myaccount' ) );
						} else {
							wp_redirect(admin_url('admin.php?page=talentlms-subscriber'));
						}
					}
				}
			}
		} catch (Exception $e) {
			if ($e instanceof TalentLMS_ApiError) {
				unset($_SESSION['talentlms_user_id']);
				unset($_SESSION['talentlms_user_login']);
				unset($_SESSION['talentlms_user_pass']);

				$tl_login_failed = true;
				$tl_login_fail_message[] = $e -> getMessage()  . " (" . __('TalentLMS authentication', 'talentlms') . ")";;
			}
		}
	}

	// in case user is already logged in (either in TalentLMS or WP)
	if(isset($_SESSION['talentlms_user_id'])) {
		$login = TalentLMS_User::login(array(
			'login' => $_SESSION['talentlms_user_login'],
			'password' => $_SESSION['talentlms_user_pass'],
			'logout_redirect' => (get_option('tl-logoutfromTL') == 'wordpress') ? get_bloginfo('wpurl') : 'http://'.get_option('talentlms-domain')
		));
		$tluser = TalentLMS_User::retrieve($_SESSION['talentlms_user_id']);
		$user_name = $tluser['first_name'] . " ". $tluser['last_name'];
	}

	if (is_user_logged_in() ){
		$wpuser = wp_get_current_user();
		$user_name = $wpuser->data->display_name;
	}

	ob_start();
	include (_BASEPATH_ . '/shortcodes/talentlms_login.php');
	$output = ob_get_clean();
	return $output;

}
add_shortcode('talentlms-login', 'talentlms_login');

function talentlms_signup($atts) {
	$custom_fields = tl_get_custom_fields();

	if ($_POST['tl-signup-post']) {

		$post = true;

		if (!$_POST['first-name']) {
			$first_name_error = __('First Name is mandatory', 'talentlms');
			$first_name_error_class = 'tl-singup-error';
			$post = false;
		}
		if (!$_POST['last-name']) {
			$last_name_error = __('Last Name is mandatory', 'talentlms');
			$last_name_error_class = 'tl-singup-error';
			$post = false;
		}
		if (!$_POST['email']) {
			$email_error = __('Email is mandatory', 'talentlms');
			$email_error_class = 'tl-singup-error';
			$post = false;
		}
		if (!$_POST['login']) {
			$login_error = __('Username is mandatory', 'talentlms');
			$login_error_class = 'tl-singup-error';
			$post = false;
		}
		if (!$_POST['password']) {
			$password_error = __('Password is mandatory', 'talentlms');
			$password_error_class = 'tl-singup-error';
			$post = false;
		}
		if (is_array($custom_fields)) {
			foreach ($custom_fields as $key => $custom_field) {
				if ($custom_field['mandatory'] == 'yes' && !$_POST[$custom_field['key']]) {
					$custom_fields[$key]['error'] = $custom_field['name'] . " " . __('is mandatory', 'talentlms');
					$custom_fields[$key]['error_class'] = 'tl-singup-error';
					$post = false;
				}
			}
		}

		if($post) {
			try {
				$signup_arguments = array('first_name' => $_POST['first-name'], 'last_name' => $_POST['last-name'], 'email' => $_POST['email'], 'login' => $_POST['login'], 'password' => $_POST['password']);
				if (is_array($custom_fields)) {
					foreach ($custom_fields as $custom_field) {
						$signup_arguments[$custom_field['key']] = $_POST[$custom_field['key']];
					}
				}
				$newUser = TalentLMS_User::signup($signup_arguments);
				$tl_signup_failed = false;
			} catch (Exception $e){
				if ($e instanceof TalentLMS_ApiError) {
					$tl_signup_failed = true;
					$tl_signup_fail_message = $e -> getMessage();
				}
			}

			if (get_option('tl-signup-sync') && !$tl_signup_failed) {
				$new_wp_user_id = wp_insert_user(array('user_login' => $_POST['login'], 'user_pass' => $_POST['password'], 'user_email' => $_POST['email'], 'first_name' => $_POST['first-name'], 'last_name' => $_POST['last-name']));
				if (is_array($custom_fields)) {
					foreach($custom_fields as $custom_field) {
						update_user_meta($new_wp_user_id, $custom_field['key'], $_POST[$custom_field['key']]);
					}
				}
				if (is_wp_error($new_wp_user_id)) {
					$tl_signup_fail_message .= $new_wp_user_id->get_error_message();
				}
			}

			if(!$tl_signup_failed) {
				if (get_option('tl-signup-redirect') == 'talentlms') {
					$login = TalentLMS_User::login(array('login' => $_POST['login'], 'password' => $_POST['password'], 'logout_redirect' => (get_option('tl-logoutfromTL') == 'wordpress') ? get_bloginfo('wpurl') : 'http://'.get_option('talentlms-domain')));
					wp_redirect(tl_talentlms_url($login['login_key']));
				} else {
					$login = TalentLMS_User::login(array('login' => $_POST['login'], 'password' => $_POST['password'], 'logout_redirect' => (get_option('tl-logoutfromTL') == 'wordpress') ? get_bloginfo('wpurl') : 'http://'.get_option('talentlms-domain')));
					session_start();
					$_SESSION['talentlms_user_id'] = $login['user_id'];
					$_SESSION['talentlms_user_login'] = $_POST['login'];
					$_SESSION['talentlms_user_pass'] = $_POST['password'];
					$creds = array();
					$creds['user_login'] = $_SESSION['talentlms_user_login'];
					$creds['user_password'] = $_SESSION['talentlms_user_pass'];
					$wpuser = wp_signon($creds, false);
					wp_redirect(admin_url('admin.php?page=talentlms-subscriber'));
				}
			}
		}

	}

	ob_start();
	include (_BASEPATH_ . '/shortcodes/talentlms_signup.php');
	$output = ob_get_clean();
	return $output;
}
add_shortcode('talentlms-signup', 'talentlms_signup');
?>