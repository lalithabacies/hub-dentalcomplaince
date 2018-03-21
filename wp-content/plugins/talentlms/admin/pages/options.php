<div class="wrap">

    <h2><i class="fa fa-check-square-o"></i>&nbsp;<?php _e('Options', 'talentlms'); ?></h2>
	
	<div id='action-message' class='<?php echo $action_status; ?> fade'>
		<p><?php echo $action_message ?></p>
	</div>		

	
	<form id="talentlms-options-form" name="talentlms-options-form" method="post" action="<?php echo admin_url('admin.php?page=talentlms-options'); ?>">
		<input type="hidden" name="action" value="tl-options" />


        <h3><?php _e('Catalog', 'talentlms'); ?></h3>


        <hr />


        <table class="form-table">
		<tr>
        	<th scope="row" class="form-field">
				<label for="tl-catalog-categories"><?php _e("Show categories on", 'talentlms'); ?>...</label>
			</th>
			<td class="form-field">
	        	<select id="tl-catalog-categories" name="tl-catalog-categories">
		        	<?php if (get_option('tl-catalog-categories') == 'left') : ?>
		            	<option selected="selected" value="left"><?php _e('Left', 'talentlms'); ?></option>
					<?php else: ?>
		            	<option value="left"><?php _e('Left', 'talentlms'); ?></option>
					<?php endif; ?>
		                			
					<?php if (get_option('tl-catalog-categories') == 'right') : ?>
		            	<option selected="selected" value="right"><?php _e('Right', 'talentlms'); ?></option>
					<?php else: ?>
		            	<option value="right"><?php _e('Right', 'talentlms'); ?></option>
					<?php endif; ?>
				</select>
			</td>
		</tr>
		<tr>                
        	<th scope="row" class="form-field form-required <?php echo $form_validation; ?>">
            	<label for="tl-catalog-per-page"><?php _e("Courses per page", 'talentlms'); ?></label>
			</th>
			<td class="form-field form-required <?php echo $form_validation; ?>">
				<input type="text" id="tl-catalog-per-page" name="tl-catalog-per-page" value="<?php echo get_option('tl-catalog-per-page'); ?>" style="width: 2.5em;" />                   
			</td>
		</tr>
	</table>	
	

        <h3><?php _e('Signup', 'talentlms'); ?></h3>


        <hr />

        <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery('#tl-signup-sync').change(function(){
                    if(jQuery('#tl-signup-sync').is(':checked')) {
                        jQuery('#tl-signup-admin-options').show();
                    } else {
                        jQuery('#tl-signup-admin-options').hide();
                    }

                });
            });
        </script>

        <table class="form-table">
            <tr>
                <th scope="row" class="form-field">
                    <label for="tl-signup-sync"><?php _e('Signup integration', 'talentlms'); ?></label>
                </th>
                <td class="form-field">
                    <?php if(get_option('tl-signup-sync')) : ?>
                        <input type="checkbox" id="tl-signup-sync" name="tl-signup-sync" checked="checked" value="1"
                        <br /><br />
                        <span class="description"><?php _e("Signing up with TalentLMS (using the signup shortcode), creates a user in WP and vice versa", 'talentlms'); ?></span>
                    <?php else : ?>
                        <input type="checkbox" id="tl-signup-sync" name="tl-signup-sync" value="1">
                        <br /><br />
                        <span class="description"><?php _e("Signing up with TalentLMS (using the signup shortcode), creates a user in WP and vice versa", 'talentlms'); ?></span>
                    <?php endif; ?>
                </td>
            </tr>

            <tr id="tl-signup-admin-options" style="<?php echo (get_option('tl-signup-sync')) ? 'display: table-row;' : 'display: none;'; ?>">

                <th scope="row" class="form-field">
                    <label for="tl-signup-redirect"><?php _e('On signup redirect user to', 'talentlms'); ?>...</label>
                </th>
                <td class="form-field">
                    <select id="tl-signup-redirect" name="tl-signup-redirect">
                        <?php if (get_option('tl-signup-redirect') == 'wordpress') : ?>
                            <option selected="selected" value="wordpress"><?php _e('WordPress members area', 'talentlms'); ?></option>
                        <?php else: ?>
                            <option value="wordpress"><?php _e('WordPress members area', 'talentlms'); ?></option>
                        <?php endif; ?>

                        <?php if (get_option('tl-signup-redirect') == 'talentlms') : ?>
                            <option selected="selected" value="talentlms"><?php _e('TalentLMS', 'talentlms'); ?></option>
                        <?php else: ?>
                            <option value="talentlms"><?php _e('TalentLMS', 'talentlms'); ?></option>
                        <?php endif; ?>
                    </select>
                </td>
            </tr>
	    </table>
	


        <h3><?php _e('Login/Logout', 'talentlms'); ?></h3>

        <hr />

        <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery('#tl-login-sync').change(function(){
                    if(jQuery('#tl-login-sync').is(':checked')) {
                        jQuery('.tl-login-admin-options').show();
                    } else {
                        jQuery('.tl-login-admin-options').hide();
                    }

                });
            });
        </script>


	    <table class="form-table">

            <tr>
                <th scope="row" class="form-field">
                    <label for="tl-login-action"><?php _e('Log in integration', 'talentlms'); ?></label>
                </th>
                <td class="form-field">
                    <?php if(get_option('tl-login-sync')) : ?>
                        <input type="checkbox" id="tl-login-sync" name="tl-login-sync" checked="checked" value="1"
                        <br /><br />
                        <span class="description"><?php _e("Log in with TalentLMS WP plugin shortcode or widget attempts to log in users to WordPress also", 'talentlms'); ?></span>
                    <?php else : ?>
                        <input type="checkbox" id="tl-login-sync" name="tl-login-sync" value="1">
                        <br /><br />
                        <span class="description"><?php _e("Log in with TalentLMS WP plugin shortcode or widget attempts to log in users to WordPress also", 'talentlms'); ?></span>
                    <?php endif; ?>

                </td>
            </tr>


            <tr class="tl-login-admin-options" style="<?php echo (get_option('tl-login-sync')) ? 'display: table-row;' : 'display: none;'; ?>">
                <th scope="row" class="form-field">
                    <label for="tl-login-action"><?php _e('On login redirect user to...', 'talentlms'); ?></label>
                </th>
                <td class="form-field">
                    <select id="tl-login-action" name="tl-login-action">
                        <?php if (get_option('tl-login-action') == 'wordpress') : ?>
                            <option selected="selected" value="wordpress"><?php _e('WordPress members area', 'talentlms'); ?></option>
                        <?php else: ?>
                            <option value="wordpress"><?php _e('WordPress', 'talentlms'); ?></option>
                        <?php endif; ?>
                        <?php if (get_option('tl-login-action') == 'talentlms') : ?>
                            <option selected="selected" value="talentlms"><?php _e('TalentLMS', 'talentlms'); ?></option>
                        <?php else: ?>
                            <option value="talentlms"><?php _e('TalentLMS', 'talentlms'); ?></option>
                        <?php endif; ?>
                    </select>
                </td>
            </tr>

            <tr class="tl-login-admin-options" style="<?php echo (get_option('tl-login-sync')) ? 'display: table-row;' : 'display: none;'; ?>">
                <th scope="row" class="form-field">
                    <label for="tl-logout"><?php _e('On logout redirect user to...', 'talentlms'); ?></label>
                </th>
                <td class="form-field">
                    <select id="tl-logout" name="tl-logout">
                        <?php if (get_option('tl-logout') == 'wordpress') : ?>
                            <option selected="selected" value="wordpress"><?php _e('WordPress', 'talentlms'); ?></option>
                        <?php else: ?>
                            <option value="wordpress"><?php _e('WordPress', 'talentlms'); ?></option>
                        <?php endif; ?>
                        <?php if (get_option('tl-logout') == 'talentlms') : ?>
                            <option selected="selected" value="talentlms"><?php _e('TalentLMS', 'talentlms'); ?></option>
                        <?php else: ?>
                            <option value="talentlms"><?php _e('TalentLMS', 'talentlms'); ?></option>
                        <?php endif; ?>
                    </select>
                </td>
		    </tr>
		
            <tr class="tl-login-admin-options" style="<?php echo (get_option('tl-login-sync')) ? 'display: table-row;' : 'display: none;'; ?>">
                <th scope="row" class="form-field">
                    <label for="tl-logoutfromTL"><?php _e('On logout from TalentLMS redirect user to...', 'talentlms'); ?></label>
                </th>
                <td class="form-field">
                    <select id="tl-logoutfromTL" name="tl-logoutfromTL">
                        <?php if (get_option('tl-logoutfromTL') == 'wordpress') : ?>
                            <option selected="selected" value="wordpress"><?php _e('WordPress', 'talentlms'); ?></option>
                        <?php else: ?>
                            <option value="wordpress"><?php _e('WordPress', 'talentlms'); ?></option>
                        <?php endif; ?>
                        <?php if (get_option('tl-logoutfromTL') == 'talentlms') : ?>
                            <option selected="selected" value="talentlms"><?php _e('TalentLMS', 'talentlms'); ?></option>
                        <?php else: ?>
                            <option value="talentlms"><?php _e('TalentLMS', 'talentlms'); ?></option>
                        <?php endif; ?>
                    </select>
                    <span class="description"><?php _e("This option sets the action to be taken when a user logs in to TalentLMS through the WP plugin and get redirected to TalentLMS.", 'talentlms'); ?></span>
                </td>
            </tr>
	    </table>

	<p class="submit">
    	<input class="button-primary" type="submit" name="Submit" value="<?php _e('Submit', 'talentlms') ?>" />
	</p> 	
	
	</form>
	
</div>
