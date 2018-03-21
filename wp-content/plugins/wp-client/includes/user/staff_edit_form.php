<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<div class="wpc_staff_form" style="float:left;width: 100%;margin: 0;padding: 0;">
    <div id="message" class="wpc_notice wpc_error" <?php echo ( empty( $error ) )? 'style="display: none;" ' : '' ?> >
        <?php echo $error; ?>
    </div>

    <form id="wpc_add_staff" class="wpc_form <?php if( isset( $wpc_pages['edit_staff_page_id'] ) && $post->ID == $wpc_pages['edit_staff_page_id'] ) { ?>wpc_edit_staff<?php } ?>" name="wpc_add_staff" method="post" >
        <?php if( isset( $wpc_pages['edit_staff_page_id'] ) && $post->ID == $wpc_pages['edit_staff_page_id'] ) { ?>
            <input type="hidden" id="user_ID" name="user_data[ID]" value="<?php echo ( isset( $user_data['ID'] ) ) ? $user_data['ID'] : '' ?>" />
            <input type="hidden" id="user_login" name="user_data[user_login]" value="<?php echo ( isset( $user_data['user_login'] ) ) ? $user_data['user_login'] : '' ?>" />
        <?php } ?>

        <div class="wpc_form_line">
            <div class="wpc_form_label">
                <label data-title="<?php printf( __( '%s Login', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) ?>" for="wpc_user_login">
                    <?php printf( __( '%s Login', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) ?>
                    <?php if( !( isset( $wpc_pages['edit_staff_page_id'] ) && $post->ID == $wpc_pages['edit_staff_page_id'] ) ) { ?>
                        <span style="color: red;" title="<?php _e( 'This field is marked as required by the administrator', WPC_CLIENT_TEXT_DOMAIN ) ?>.">*</span>
                    <?php } ?>
                </label>
            </div>
            <div class="wpc_form_field">
                <input type="text" id="wpc_user_login" name="user_data[user_login]" <?php if( isset( $wpc_pages['edit_staff_page_id'] ) && $post->ID == $wpc_pages['edit_staff_page_id'] ) { ?>disabled="disabled" <?php } else { ?> data-required_field="1" <?php } ?>value="<?php echo ( isset( $user_data['user_login'] ) ) ? $user_data['user_login'] : '' ?>" />
                <?php if( isset( $wpc_pages['edit_staff_page_id'] ) && $post->ID == $wpc_pages['edit_staff_page_id'] ) { ?>
                    <span class="wpc_description"><?php _e( 'Username cannot be changed.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                <?php } else {?>
                    <div class="wpc_field_validation">
                        <span class="wpc_field_required"><?php _e( 'Username is required', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="wpc_form_line">
            <div class="wpc_form_label">
                <label data-title="<?php _e( 'E-mail', WPC_CLIENT_TEXT_DOMAIN ) ?>" for="wpc_email"><?php _e( 'E-mail', WPC_CLIENT_TEXT_DOMAIN ) ?>&nbsp;<span style="color: red;" title="<?php _e( 'This field is marked as required by the administrator', WPC_CLIENT_TEXT_DOMAIN ) ?>.">*</span></label>
            </div>
            <div class="wpc_form_field">
                <input type="email" id="wpc_email" name="user_data[email]" data-required_field="1" value="<?php echo ( isset( $user_data['email'] ) ) ? $user_data['email'] : '' ?>" />
                <div class="wpc_field_validation">
                    <span class="wpc_field_wrong"><?php _e( 'Invalid Email, proper format "name@something.com"', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    <span class="wpc_field_required"><?php _e( 'Email is required', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                </div>
            </div>
        </div>

        <div class="wpc_form_line">
            <div class="wpc_form_label">
                <label for="wpc_first_name"><?php _e( 'First Name', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
            </div>
            <div class="wpc_form_field">
                <input type="text" id="wpc_first_name" name="user_data[first_name]" value="<?php echo ( isset( $user_data['first_name'] ) ) ? $user_data['first_name'] : '' ?>" />
            </div>
        </div>

        <div class="wpc_form_line">
            <div class="wpc_form_label">
                <label for="wpc_last_name"><?php _e( 'Last Name', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
            </div>
            <div class="wpc_form_field">
                <input type="text" id="wpc_last_name" name="user_data[last_name]" value="<?php echo ( isset( $user_data['last_name'] ) ) ? $user_data['last_name'] : '' ?>" />
            </div>
        </div>

        <?php
 $user_id = ( isset( $user_data['ID'] ) ) ? $user_data['ID'] : 0 ; if( $user_id ) $custom_fields = $this->get_custom_fields( 'user_edit', $user_id, false, 'staff' ); else $custom_fields = $this->get_custom_fields( 'user_add', $user_id, false, 'staff' ); $custom_field = array(); if ( is_array( $custom_fields ) && 0 < count( $custom_fields ) ) { $this->add_custom_fields_scripts(); foreach( $custom_fields as $key => $value ) { if ( 'hidden' == $value['type'] ) { echo $value['field']; } elseif ( 'checkbox' == $value['type'] || 'radio' == $value['type'] ) { echo '<div class="wpc_form_line"><div class="wpc_form_label">'; echo ( !empty( $value['label'] ) ) ? $value['label'] . '<label class="opt">&nbsp;</label>' : ''; echo '</div><div class="wpc_form_field">'; if ( !empty( $value['field'] ) ) { foreach ( $value['field'] as $field ) { echo $field ; } } echo ( !empty( $value['description'] ) ) ? '<span class="wpc_description">' . $value['description'] . '</span>' : ''; if ( !empty( $value['required'] ) ) { echo '<div class="wpc_field_validation">' . '<span class="wpc_field_required">' . $value['title'] . __( ' is required', WPC_CLIENT_TEXT_DOMAIN ) . '</span></div>'; } echo '</div></div>'; } else { echo '<div class="wpc_form_line"><div class="wpc_form_label">'; echo ( !empty( $value['label'] ) ) ? $value['label'] : ''; echo '</div><div class="wpc_form_field">'; echo ( !empty( $value['field'] ) ) ? $value['field'] : ''; echo ( !empty( $value['description'] ) ) ? '<span class="wpc_description">' . $value['description'] . '</span>' : ''; if ( !empty( $value['required'] ) ) { echo '<div class="wpc_field_validation">' . '<span class="wpc_field_required">' . $value['title'] . __( ' is required', WPC_CLIENT_TEXT_DOMAIN ) . '</span></div>'; } echo '</div></div>'; } } } ?>

        <div class="wpc_form_line">
            <div class="wpc_form_label">
                <label data-title="<?php _e( 'Password', WPC_CLIENT_TEXT_DOMAIN ) ?>" for="wpc_pass1">
                    <?php _e( 'Password', WPC_CLIENT_TEXT_DOMAIN ) ?>&nbsp;
                    <?php if( !( isset( $wpc_pages['edit_staff_page_id'] ) && $post->ID == $wpc_pages['edit_staff_page_id'] ) ) { ?>
                        <span style="color: red;" title="<?php _e( 'This field is marked as required by the administrator', WPC_CLIENT_TEXT_DOMAIN ) ?>.">*</span>
                    <?php } ?>
                </label>
            </div>
            <div class="wpc_form_field">
                <input type="password" id="wpc_pass1" <?php if( !( isset( $wpc_pages['edit_staff_page_id'] ) && $post->ID == $wpc_pages['edit_staff_page_id'] ) ) { ?>data-required_field="1"<?php } ?> name="user_data[pass1]" autocomplete="off" value="" />
                <?php if( !( isset( $wpc_pages['edit_staff_page_id'] ) && $post->ID == $wpc_pages['edit_staff_page_id'] ) ) { ?>
                    <div class="wpc_field_validation">
                        <span class="wpc_field_required"><?php _e( 'Password is required', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    </div>
                <?php } ?>
            </div>
        </div>

        <div class="wpc_form_line">
            <div class="wpc_form_label">
                <label data-title="<?php _e( 'Confirm Password', WPC_CLIENT_TEXT_DOMAIN ) ?>" for="wpc_pass2">
                    <?php _e( 'Confirm Password', WPC_CLIENT_TEXT_DOMAIN ) ?>&nbsp;
                    <?php if( !( isset( $wpc_pages['edit_staff_page_id'] ) && $post->ID == $wpc_pages['edit_staff_page_id'] ) ) { ?>
                        <span style="color: red;" title="<?php _e( 'This field is marked as required by the administrator', WPC_CLIENT_TEXT_DOMAIN ) ?>.">*</span>
                    <?php } ?>
                </label>
            </div>
            <div class="wpc_form_field">
                <input type="password" id="wpc_pass2" name="user_data[pass2]" autocomplete="off" value="" <?php if( !( isset( $wpc_pages['edit_staff_page_id'] ) && $post->ID == $wpc_pages['edit_staff_page_id'] ) ) { ?>data-required_field="1"<?php } ?> />
                <?php if( !( isset( $wpc_pages['edit_staff_page_id'] ) && $post->ID == $wpc_pages['edit_staff_page_id'] ) ) { ?>
                    <div class="wpc_field_validation">
                        <span class="wpc_field_required"><?php _e( 'Password confirmation is required', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    </div>
                <?php } ?>
                <div id="pass-strength-result" style="display: none;"><?php _e( 'Strength indicator', WPC_CLIENT_TEXT_DOMAIN ) ?></div>
                <span class="description indicator-hint"><?php _e( 'Hint: The password should be at least seven characters long. To make it stronger, use upper and lower case letters, numbers and symbols like ! " ? $ % ^ &amp; ).', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
            </div>
        </div>

        <div class="wpc_form_line">
            <div class="wpc_form_label">&nbsp;</div>
            <div class="wpc_form_field">
                <label>
                    <input type="checkbox" name="user_data[send_password]" id="wpc_send_password" value="1" />
                    &nbsp;<?php printf( __( 'Send this password to the %s by email.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ); ?>
                </label>
                <span class="wpc_description"><?php _e( 'Check to Enable', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
            </div>
        </div>

        <div class="wpc_form_line">
            <div class="wpc_form_label">&nbsp;</div>
            <div class="wpc_form_field">
                <?php if( isset( $wpc_pages['edit_staff_page_id'] ) && $post->ID == $wpc_pages['edit_staff_page_id'] ) { ?>
                    <input type="submit" value="<?php printf( __( 'Save %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ); ?>" class="button-primary wpc_submit" id="wpc_update_staff" name="wpc_update_staff">
                <?php } else { ?>
                    <input type="submit" value="<?php printf( __( 'Add new %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ); ?>" class="button-primary wpc_submit" id="wpc_update_staff" name="wpc_update_staff">
                <?php } ?>
                <input type="button" class="wpc_button" value="<?php _e( 'Back', WPC_CLIENT_TEXT_DOMAIN ) ?>" onclick="window.history.back();" />
            </div>
        </div>
        <div class="wpc_form_line">
            <div class="wpc_form_label">&nbsp;</div>
            <div class="wpc_form_field">
                <div class="wpc_submit_info" style="float: left;width: 100%;"></div>
            </div>
        </div>
    </form>
</div>