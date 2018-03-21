<?php if (isset($_SESSION['talentlms_user_id'])) : ?>
    <span><?php _e('Welcome back', 'talentlms'); ?> <strong><?php echo $user_name; ?></strong> </span> &nbsp;
    <span><?php _e('Go to your learning portal', 'talentlms'); ?> <a href="<?php echo tl_talentlms_url($login['login_key'])?>"><?php _e('here', 'talentlms'); ?></a></span>

    <form class="tl-form-horizontal" method="post" action="<?php echo get_page_link(get_option('tl_login_talentlms_page_id')); ?>">
        <input type="hidden" name="talentlms-logout" value="1">
        <input class="btn" type="submit" value="<?php _e('Logout', 'talentlms'); ?>">
    </form>
<?php else: ?>
    <?php if ($tl_login_failed) :?>
        <div class="alert alert-error">
            <?php echo implode('<br />', $tl_login_fail_message); ?>
        </div>
    <?php endif; ?>
	<form id="tl-login-form" role="form" method="post" action="<?php echo get_page_link(get_option('tl_login_talentlms_page_id')); ?>">
		<div class="tl-form-group">
			<label for="talentlms-login"><?php _e('Login', 'talentlms'); ?></label>
			<input class="tl-form-control" id="talentlms-login" name="talentlms-login" type="text" />
		</div>
		<div class="tl-form-group">
			<label for="talentlms-password"><?php _e('Password', 'talentlms'); ?></label>
			<input class="tl-form-control" id="talentlms-password" name="talentlms-password" type="password"/>
		</div>

		<input class="btn" type="submit" value="<?php _e('Login', 'talentlms'); ?>"/> &nbsp;
		<a href="<?php echo get_page_link(get_option('tl_forgot_page_id'))?>"><?php _e('Forgot login/password?', 'talentlms'); ?></a>
	</form>
<?php endif; ?>