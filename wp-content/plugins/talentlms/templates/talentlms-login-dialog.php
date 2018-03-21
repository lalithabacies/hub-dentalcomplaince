<div id="tl-dialog-form" title="<?php _e('Login', 'talentlms'); ?>">
    <form id="tl-dialog-login-form" name="tl-dialog-login-form" method="post" action="<?php echo add_query_arg( 'tlcourse', $_GET['tlcourse'], get_page_link(get_option('tl_courses_page_id')));?>">


        <input type="hidden" name="action" value="tl-dialog-post"/>
        <fieldset>
            <div class="tl-form-group">
                <label for="tl-dialog-login"><?php _e('Login', 'talentlms');?></label>
                <input type="text" class="tl-form-control" id="tl-dialog-login" name="tl-dialog-login" value="<?php echo $_POST['tl-dialog-login']; ?>"/>
            </div>

            <div class="tl-form-group">
                <label for="tl-dialog-password"><?php _e('Password', 'talentlms');?></label>
                <input type="password" class="tl-form-control" id="tl-dialog-password" name="tl-dialog-password" value="<?php echo $_POST['tl-dialog-password']; ?>"/>
            </div>
        </fieldset>
    </form>

    <script type="text/javascript">
        jQuery(document).ready(function() {
            jQuery('#tl-dialog-form').dialog({
                width : 350,
                modal : true,
                responsive : true,
                autoOpen : false,
                buttons : {
                    'Login' : function() {
                        jQuery('#tl-dialog-login-form').submit();
                    },
                    Cancel : function() {
                        jQuery(this).dialog('close');
                    }
                },
            });
        });
        jQuery('#tl-login-dialog-opener').click(function() {
            jQuery('#tl-dialog-form').dialog('open');
            return false;
        });
    </script>
</div>