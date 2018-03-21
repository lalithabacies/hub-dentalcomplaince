<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } if ( isset( $_POST['update_settings'] ) ) { if ( isset( $_POST['wpc_private_messages'] ) ) { $settings = $_POST['wpc_private_messages']; $settings['front_end_admins'] = ( isset( $settings['front_end_admins'] ) ) ? $settings['front_end_admins'] : array(); } else { $settings = array(); } do_action( 'wp_client_settings_update', $settings, 'private_messages' ); do_action( 'wp_client_redirect', admin_url() . 'admin.php?page=wpclients_settings&tab=private_messages&msg=u' ); exit; } $wpc_private_messages = $this->cc_get_settings( 'private_messages' ); $selected_admins = ( isset( $wpc_private_messages['front_end_admins'] ) && !empty( $wpc_private_messages['front_end_admins'] ) ) ? $wpc_private_messages['front_end_admins'] : array(); $args = array( 'role' => 'wpc_admin', 'orderby' => 'user_login', 'order' => 'ASC', ); $wpc_admins = get_users( $args ); $args = array( 'role' => 'administrator', 'orderby' => 'user_login', 'order' => 'ASC', ); $administrators = get_users( $args ); ?>

<style type="text/css">
    .wpc_selector_wrapper {
        width: 60%;
    }
    .wpc_drop_search {
        width:100% !important;
    }
</style>

<script type="text/javascript">
    jQuery( document ).ready( function() {
        jQuery( '#wpc_private_messages_front_end_admins' ).wpc_select({
            search:true,
            opacity:'0.2'
        });
    });
</script>
<form action="" method="post" name="wpc_settings" id="wpc_settings" >

    <div class="postbox">
        <h3 class="hndle"><span><?php _e( 'Private Messages Settings', WPC_CLIENT_TEXT_DOMAIN ) ?></span></h3>
        <div class="inside">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_private_messages_first_new_chains"><?php _e( 'Show NEW message chains first', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_private_messages[first_new_chains]" id="wpc_private_messages_first_new_chains" style="width: 100px;">
                            <option value="yes" <?php echo ( isset( $wpc_private_messages['first_new_chains'] ) && 'yes' == $wpc_private_messages['first_new_chains'] ) ? 'selected' : '' ?>><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="no" <?php echo ( !isset( $wpc_private_messages['first_new_chains'] ) || 'yes' != $wpc_private_messages['first_new_chains'] ) ? 'selected' : '' ?>><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                        <span class="description"></span>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_private_messages_front_end_admins"><?php _e( 'Allow frontend Members to see these Admins', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_private_messages[front_end_admins][]" id="wpc_private_messages_front_end_admins" style="width: 100px;" multiple>
                            <?php if( isset( $wpc_admins ) && !empty( $wpc_admins ) ) { ?>
                                <optgroup label="<?php echo $this->custom_titles['admin']['p'] ?>" data-single_title="<?php echo $this->custom_titles['admin']['s'] ?>" data-color="#dc832d">
                                    <?php foreach( $wpc_admins as $user ) { ?>
                                        <option value="<?php echo $user->ID ?>" <?php selected( in_array( $user->ID, $selected_admins ) ) ?>><?php echo $user->user_login ?></option>
                                    <?php } ?>
                                </optgroup>
                            <?php } if( isset( $administrators ) && !empty( $administrators ) ) { ?>
                                <optgroup label="<?php _e( 'Administrators', WPC_CLIENT_TEXT_DOMAIN ) ?>" data-single_title="<?php _e( 'Administrator', WPC_CLIENT_TEXT_DOMAIN ) ?>" data-color="#b63ad0">
                                    <?php foreach( $administrators as $user ) { ?>
                                        <option value="<?php echo $user->ID ?>" <?php selected( in_array( $user->ID, $selected_admins ) ) ?>><?php echo $user->user_login ?></option>
                                    <?php } ?>
                                </optgroup>
                            <?php } ?>
                        </select>
                        <span class="description"></span>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_private_messages_relate_client_staff"><?php printf( __( 'Allow %s to message their assigned %s and back?', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'], $this->custom_titles['staff']['p'] ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_private_messages[relate_client_staff]" id="wpc_private_messages_relate_client_staff" style="width: 100px;">
                            <option value="yes" <?php echo ( !( isset( $wpc_private_messages['relate_client_staff'] ) ) || 'yes' == $wpc_private_messages['relate_client_staff'] ) ? 'selected' : '' ?>><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="no" <?php echo ( isset( $wpc_private_messages['relate_client_staff'] ) && 'no' == $wpc_private_messages['relate_client_staff'] ) ? 'selected' : '' ?>><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                        <span class="description"></span>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_private_messages_relate_client_manager"><?php printf( __( 'Allow %s to message their assigned %s?', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'], $this->custom_titles['manager']['p'] ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_private_messages[relate_client_manager]" id="wpc_private_messages_relate_client_manager" style="width: 100px;">
                            <option value="yes" <?php echo ( !( isset( $wpc_private_messages['relate_client_manager'] ) ) || 'yes' == $wpc_private_messages['relate_client_manager'] ) ? 'selected' : '' ?>><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="no" <?php echo ( isset( $wpc_private_messages['relate_client_manager'] ) && 'no' == $wpc_private_messages['relate_client_manager'] ) ? 'selected' : '' ?>><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                        <span class="description"></span>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_private_messages_relate_staff_manager"><?php printf( __( 'Allow %s to message their assigned %s %s?', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['p'], $this->custom_titles['client']['p'], $this->custom_titles['manager']['p'] ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_private_messages[relate_staff_manager]" id="wpc_private_messages_relate_staff_manager" style="width: 100px;">
                            <option value="yes" <?php echo ( !( isset( $wpc_private_messages['relate_staff_manager'] ) ) || 'yes' == $wpc_private_messages['relate_staff_manager'] ) ? 'selected' : '' ?>><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="no" <?php echo ( isset( $wpc_private_messages['relate_staff_manager'] ) && 'no' == $wpc_private_messages['relate_staff_manager'] ) ? 'selected' : '' ?>><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                        <span class="description"></span>
                    </td>
                </tr>



                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_private_messages_add_cc_email"><?php _e( 'Show CC Email field for messages', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_private_messages[add_cc_email]" id="wpc_private_messages_add_cc_email" style="width: 100px;">
                            <option value="yes" <?php echo ( isset( $wpc_private_messages['add_cc_email'] ) && 'yes' == $wpc_private_messages['add_cc_email'] ) ? 'selected' : '' ?>><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="no" <?php echo ( !isset( $wpc_private_messages['add_cc_email'] ) || 'yes' != $wpc_private_messages['add_cc_email'] ) ? 'selected' : '' ?>><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                        <span class="description"></span>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_private_messages_send_to_site_admin"><?php _e( 'Send messaging email notifications to Site Email', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_private_messages[send_to_site_admin]" id="wpc_private_messages_send_to_site_admin" style="width: 100px;">
                            <option value="yes" <?php echo ( isset( $wpc_private_messages['send_to_site_admin'] ) && 'yes' == $wpc_private_messages['send_to_site_admin'] ) ? 'selected' : '' ?>><?php _e( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="no" <?php echo ( !isset( $wpc_private_messages['send_to_site_admin'] ) || 'no' == $wpc_private_messages['send_to_site_admin'] ) ? 'selected' : '' ?>><?php _e( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select><br/>
                        <span class="description"><?php echo __( 'Current Email is', WPC_CLIENT_TEXT_DOMAIN ) . ' <strong>' . get_option('admin_email') . '</strong>' ?></span>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">
                        <label for="wpc_private_messages_display_name"><?php _e( 'Display Member names in message chain as', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                    </th>
                    <td>
                        <select name="wpc_private_messages[display_name]" id="wpc_private_messages_display_name" style="width: 100px;">
                            <option value="user_login" <?php echo ( !isset( $wpc_private_messages['display_name'] ) || 'user_login' == $wpc_private_messages['display_name'] ) ? 'selected' : '' ?>><?php _e( 'User Login', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                            <option value="display_name" <?php echo ( isset( $wpc_private_messages['display_name'] ) && 'display_name' == $wpc_private_messages['display_name'] ) ? 'selected' : '' ?>><?php _e( 'Display Name', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <input type="submit" name="update_settings" id="update_settings" class="button-primary" value="<?php _e( 'Update Settings', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
</form>