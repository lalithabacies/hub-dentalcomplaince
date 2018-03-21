<?php
global $wpc_client; $wpc_private_post_types = $wpc_client->cc_get_settings( 'private_post_types' ); if ( isset( $_POST['update_settings'] ) ) { if ( isset( $_POST['wpc_private_post_types'] ) ) { $settings = $_POST['wpc_private_post_types']; } else { $settings = array(); } do_action( 'wp_client_settings_update', $settings, 'private_post_types' ); $wpc_capabilities = $wpc_client->cc_get_settings( 'capabilities' ); if ( isset( $wpc_capabilities[ 'wpc_admin' ]['view_privat_post_type'] ) && $wpc_capabilities[ 'wpc_admin' ]['view_privat_post_type'] ) { $this->added_capability_for_post_type( 'wpc_admin', $settings ) ; } if ( isset( $wpc_capabilities[ 'wpc_manager' ]['view_privat_post_type'] ) && $wpc_capabilities[ 'wpc_manager' ]['view_privat_post_type'] ) { $this->added_capability_for_post_type( 'wpc_manager', $settings ) ; } do_action( 'wp_client_redirect', admin_url() . 'admin.php?page=wpclients_settings&tab=private_post_types&msg=u' ); exit; } $post_types = get_post_types(); $exclude_types = $this->get_excluded_post_types(); ?>


<form action="" method="post" name="wpc_settings" id="wpc_settings" >

    <div class="postbox">
        <h3 class='hndle'><span><?php  _e( 'Private Post Types Settings', WPC_PPT_TEXT_DOMAIN ) ?></span></h3>
        <div class="inside">
            <span class="description"><?php printf( __( "The majority of %s related uses can be accomplished using Portal Pages, but in special cases where you might need a similar functionality on a special post type provided by another plugin, you may use the settings below", WPC_PPT_TEXT_DOMAIN ), $wpc_client->plugin['title'] ) ?></span>
            <hr />

            <br>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_private_post_types"><?php _e( 'Private Post Types', WPC_PPT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                    <?php if ( is_array( $post_types ) && count( $post_types ) ) { foreach( $post_types as $key => $value ) { if ( in_array( $key, $exclude_types ) ) continue; $checked = (isset( $wpc_private_post_types['types'][$key] ) && 1 == $wpc_private_post_types['types'][$key] ) ? 'checked="checked"' : ''; ?>
                            <label>
                                <input type="checkbox" name="wpc_private_post_types[types][<?php echo $key ?>]" id="private_post_types_<?php echo $key ?>" value="1" <?php echo $checked ?> />
                                <?php echo $value ?>
                            </label>
                            &nbsp;&nbsp;&nbsp;
                        <?php } } ?>
                    <br />
                    <span class="description"><?php printf( __( 'Select which post types to which you would like to add %s meta box. These meta box can be used to assign these assets to %s portal.', WPC_PPT_TEXT_DOMAIN ), $wpc_client->plugin['title'], $wpc_client->custom_titles['client']['p'] ) ?></span>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="wpc_private_post_types_action"><?php printf( __( 'Action for %s without access', WPC_PPT_TEXT_DOMAIN ), $wpc_client->custom_titles['client']['p'] ) ?>:</label>
                    </th>
                    <td>
                        <select id="wpc_private_post_types_action" name="wpc_private_post_types[action]">
                            <option value="redirect" <?php if( !isset( $wpc_private_post_types['action'] ) || 'redirect' == $wpc_private_post_types['action'] ) { ?> selected="selected"<?php } ?>><?php _e( 'Redirect to Error page', WPC_PPT_TEXT_DOMAIN ) ?></option>
                            <option value="exclude" <?php if( isset( $wpc_private_post_types['action'] ) && 'exclude' == $wpc_private_post_types['action'] ) { ?> selected="selected"<?php } ?>><?php _e( 'Exclude (not show) protected items', WPC_PPT_TEXT_DOMAIN ) ?></option>
                            <option value="leave_on_search" <?php if( isset( $wpc_private_post_types['action'] ) && 'leave_on_search' == $wpc_private_post_types['action'] ) { ?> selected="selected"<?php } ?>><?php _e( 'Exclude (not show) protected items, but show preview in site Search', WPC_PPT_TEXT_DOMAIN ) ?></option>
                        </select>
                        <br />
                        <span class="description"><?php printf( __( 'Select action for %s without access when it shows list of private posts', WPC_PPT_TEXT_DOMAIN ), $wpc_client->custom_titles['client']['p'] ) ?></span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <input type="submit" name="update_settings" class="button-primary" value="<?php _e( 'Update Settings', WPC_PPT_TEXT_DOMAIN ) ?>" />
</form>