<?php if ($tl_forgot_failed) :?>
    <div class="alert alert-error">
        <?php echo $tl_fogot_fail_message; ?>
    </div>
<?php endif; ?>

<?php if ($tl_forgot_succeed) :?>
    <div class="alert alert-success">
        <?php echo $tl_fogot_success_message; ?>
    </div>
<?php endif; ?>


<form id="tl-forgot-credentials-form" action="<?php echo get_page_link(get_option('tl_forgot_page_id')); ?>" method="post">
    <input type="hidden" name="tl-forgot-credentials" value="1" />

    <div class="tl-form-group">
        <label for="tl-reset-password"><?php _e('Check this box if you have forgotten your Password', 'talentlms'); ?></label>
        <input type="checkbox" value="1" name="tl-reset-password" id="tl-reset-password">
    </div>

    <div id="tl-forgot-email-div" class="tl-form-group" style="display: none;">
        <label for="tl-forgot-login"><?php _e('Login', 'talentlms')?></label>
        <input type="text" name="tl-forgot-login" id="tl-forgot-login"/>
    </div>

    <div class="tl-form-group">
        <label for="tl-send-login"><?php _e('Check this box if you have forgotten your Login', 'talentlms'); ?></label>
        <input type="checkbox" value="2" name="tl-send-login" id="tl-send-login">
    </div>

    <div id="tl-forgot-login-div" class="tl-form-group" style="display: none;">
        <label for="tl-forgot-email"><?php _e('Registered Email Address', 'talentlms')?></label>
        <input type="text" name="tl-forgot-email" id="tl-forgot-email"/>
    </div>

    <input class="btn" type="submit" value="<?php _e('Submit', 'talentlms'); ?>">
</form>