<?php

/**
 * TalentLMS login widget
 *
 * @since 1.0
 */
class TalentLMS_login extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'widget_talentlms_login', 'description' => __('Login form to TalentLMS', 'talentlms'));
		parent::__construct('talentlms-login', __('Login to TalentLMS', 'talentlms'), $widget_ops);
	}

	function form($instance) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';

		echo "<p>";
		echo "<label for='" . $this -> get_field_id('title') . "'>" . __('Title', 'talentlms') . "</label>";
		echo "<input class='widefat' id='" . $this -> get_field_id('title') . "' name='" . $this -> get_field_name('title') . "' type='text' value='" . $title . "' />";
		echo "</p>";

	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = absint($new_instance['number']);
		return $instance;
	}

	function widget($args, $instance) {
		global $wpdb;
		extract($args, EXTR_SKIP);
		$loggin_error = false;
		$title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);

		$output = '';

		$output .= $before_widget;
		if ($title)
			$output .= $before_title . $title . $after_title;

		if ($_POST['talentlms-logout']) {
			try{
				TalentLMS_User::logout(array('user_id' => $_SESSION['talentlms_user_id']));
				wp_logout();
			} catch (Exception $e) {}
			session_start();
			unset($_SESSION['talentlms_user_id']);
			unset($_SESSION['talentlms_user_login']);
			unset($GLOBALS['talentlms_error_msg']);
			
			wp_redirect(home_url());
		}

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
						$tl_login_fail_message = $wpuser->get_error_message() . " (" . __('WordPress authentication', 'talentlms') . ")";
					} else {
						wp_set_current_user($wpuser->data->ID);
						wp_set_auth_cookie($wpuser->data->ID);
						do_action('wp_login', $wpuser->data->user_login, $wpuser);

						if(get_option('tl-login-action') == 'talentlms') {
							wp_redirect(tl_talentlms_url($login['login_key']));
						} else {
							wp_redirect(admin_url('admin.php?page=talentlms-subscriber'));
						}
					}
				}
			} catch (Exception $e) {
				if ($e instanceof TalentLMS_ApiError) {
					unset($_SESSION['talentlms_user_id']);
					unset($_SESSION['talentlms_user_login']);
					unset($_SESSION['talentlms_user_pass']);

					$tl_login_failed = true;
					$tl_login_fail_message = $e -> getMessage()  . " (" . __('TalentLMS authentication', 'talentlms') . ")";;
				}
			}
		}

		if (isset($_SESSION['talentlms_user_id'])) {
			if(!isset($login)){
				$login = TalentLMS_User::login(array('login' => $_SESSION['talentlms_user_login'], 'password' => $_SESSION['talentlms_user_pass'], 'logout_redirect' => (get_option('tl-logoutfromTL') == 'wordpress') ? get_bloginfo('wpurl') : 'http://'.get_option('talentlms-domain')));
				$wpuser = wp_signon( array('user_login' => $_SESSION['talentlms_user_login'], 'user_password' => $_SESSION['talentlms_user_pass']), false );
			}			

			if(get_option('tl-login-action') == 'talentlms') {
				wp_redirect(tl_talentlms_url($login['login_key']));
			}
				
			$output .= "<span style='display:block'>" . __('Welcome back', 'talentlms') . " <b>" . $wpuser->data->display_name . "</b></span>";
			$output .= "<span style='display:block'>" . __('Goto to your learning portal','talentlms') . " <a target='_blank' href='" . tl_talentlms_url($login['login_key']) . "'>" . __('here','talentlms') . "</a></span>";
			$output .= "<form class='tl-form-horizontal' method='post' action='" . tl_current_page_url() . "'>";
			$output .= "<input id='talentlms-login' name='talentlms-logout' type='hidden' value='logout'>";
			$output .= "<button class='btn' type='submit'>" . __('Logout', 'talentlms') . "</button>";
			$output .= "</form>";
		} else {
			if ($tl_login_failed) {
				$output .= "<div class=\"alert alert-error\">";
				$output .= $tl_login_fail_message;
				$output .= "</div>";
			}

			$output .= "<form class='tl-form-horizontal' method='post' action='" . tl_current_page_url() . "'>";
			$output .= "<div>";
			$output .= "<label for='talentlms-login'>" . __('Login', 'talentlms') . "</label>";
			$output .= "<div >";
			$output .= "<input class='span' id='talentlms-login' name='talentlms-login' type='text'>";
			$output .= "</div>";
			$output .= "</div>";
			$output .= "<div>";
			$output .= "<label for='talentlms-password'>" . __('Password', 'talentlms') . "</label>";
			$output .= "<div >";
			$output .= "<input class='span' id='talentlms-password' name='talentlms-password' type='password'>";
			$output .= "</div>";
			$output .= "</div>";
			$output .= "<div class='form-actions' style='text-align:right;'>";
			$output .= "<button class='btn' type='submit'>" . __('Login', 'talentlms') . "</button>";
			$output .= "</div>";
			$output .= "</form>";
			$output .= "<div>";
			$output .= "<a href='" . get_page_link(get_option("tl_forgot_page_id")) . "'>".__('Forgot login/password?', 'talentlms')."</a>";
			$output .= "</div>";
		}
		$output .= $after_widget;
		echo $output;

	}

}
?>