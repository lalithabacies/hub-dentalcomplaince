<?php
global $wpdb, $wpc_client, $wp_query; $wizard_id = ''; if ( isset( $wp_query->query_vars['wpc_page_value'] ) && 0 < $wp_query->query_vars['wpc_page_value'] ) { $wizard_id = $wp_query->query_vars['wpc_page_value']; } $wizard_data = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}wpc_client_feedback_wizards WHERE wizard_id = %d", $wizard_id ), ARRAY_A ); $access = false; $clients_id = $wpc_client->cc_get_assign_data_by_object( 'feedback_wizard', $wizard_id, 'client' ); if ( is_array( $clients_id ) && in_array( $user_id, $clients_id) ) { $access = true; } else { $groups_id = $wpc_client->cc_get_assign_data_by_object( 'feedback_wizard', $wizard_id, 'circle' ); if (is_array( $groups_id ) && 0 < count( $groups_id ) ) { foreach( $groups_id as $group_id ) { $clients_id = $wpc_client->cc_get_group_clients_id( $group_id ); if ( is_array( $clients_id ) && in_array( $user_id, $clients_id) ) { $access = true; break; } } } } if ( !$access ) return 'err'; $sql = "SELECT result_id FROM {$wpdb->prefix}wpc_client_feedback_results WHERE wizard_id = %d AND client_id = %d AND wizard_version = '%s' "; $result_id = $wpdb->get_var( $wpdb->prepare( $sql, $wizard_data['wizard_id'], $user_id, $wizard_data['version'] ) ); if ( !empty( $result_id ) && 0 < $result_id ) { do_action( 'wp_client_redirect', $wpc_client->cc_get_slug( 'hub_page_id' ) ); exit; } $item_ids = $wpdb->get_col( $wpdb->prepare( "SELECT item_id FROM {$wpdb->prefix}wpc_client_feedback_wizard_items WHERE wizard_id = %d ORDER BY id ASC", $wizard_id ) ); if ( is_array( $wizard_data ) && 0 < count( $item_ids ) ) { foreach( $item_ids as $item_id ) { $wizard_data['items'][] = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}wpc_client_feedback_items WHERE item_id = %d", $item_id ), ARRAY_A ); } $uploads = wp_upload_dir(); } $wpnonce = wp_create_nonce( 'wpc_feedback_wizard' . $wizard_id ); $wpc_feedback_types = get_option( 'wpc_feedback_types' ); ob_start(); ?>

<div class="wrap">
    <div class="feedback_wizard">
        <?php if ( isset( $wizard_data['items'] ) && 0 < count( $wizard_data['items'] ) ) { ?>

            <h1 class="wizard_title"><?php _e( 'Feedback for:', WPC_FW_TEXT_DOMAIN ) ?> <?php echo $wizard_data['name'] ?></h1>

            <form method="post" name="feedback_wizard_form" class="wpc_form" id="feedback_wizard_form" >
                <input type="hidden" name="wpc_wpnonce" value="<?php echo $wpnonce ?>" />
                <input type="hidden" name="feedback[wizard_id]" value="<?php echo $wizard_id ?>" />
                <input type="hidden" name="wpc_save_feedback_wizard" id="wpc_save_feedback_wizard" value="save" />

                <div id="steps">
                    <h2>Step <span id="cur_step">1</span> of <span id="total_steps"><?php echo count( $wizard_data['items'] ) + 1 ?></span></h2>
                </div>
                <div id="wizard" style="min-height: 400px;">
                    <?php foreach( $wizard_data['items'] as $item ) { $code = md5( $user_id . 'item_file' . $item['item_id'] ); ?>

                        <fieldset class="sectionwrap">
                            <h3 class="item_name"><?php echo $item['name'] ?></h3>
                            <div class="postbox">
                                <div class="inside">
                                    <?php if ( 'img' == $item['type'] ) { ?>
                                        <div class="img_preview">
                                            <a id="single_1" href="<?php echo get_admin_url() ?>admin-ajax.php?action=wpc_get_fw_item_file&id=<?php echo $item['item_id'] ?>&c=<?php echo $code ?>&.png" title="">
                                                <img src="<?php echo get_admin_url() ?>admin-ajax.php?action=wpc_get_fw_item_file&id=<?php echo $item['item_id'] ?>&c=<?php echo $code ?>&thumbnail=1&.png" width="400" alt="" />
                                            </a>
                                        </div>
                                    <?php } elseif ( 'pdf' == $item['type'] ) { ?>
                                        <div class="pdf_preview">
                                            <a class="various" href="<?php echo get_admin_url() ?>admin-ajax.php?action=wpc_get_fw_item_file&id=<?php echo $item['item_id'] ?>&c=<?php echo $code ?>&t=pdf" >
                                                <?php echo $item['file_name'] ?>
                                            </a>
                                        </div>
                                    <?php } elseif ( 'att' == $item['type'] ) { ?>
                                        <div class="att_preview">
                                            <a href="<?php echo get_admin_url() ?>admin-ajax.php?action=wpc_get_fw_item_file&id=<?php echo $item['item_id'] ?>&c=<?php echo $code ?>&d=true" target="_blank" >
                                                <?php echo $item['file_name'] ?>
                                            </a>
                                        </div>
                                    <?php } ?>

                                    <div class="wizard_description">
                                        <p><?php echo $item['description'] ?></p>
                                    </div>

                                    <div class="wizard_comment">
                                        <label style="width: 100%; float:left;">
                                            <?php _e( 'Your Comment:', WPC_FW_TEXT_DOMAIN ) ?>
                                            <textarea name="feedback[items][<?php echo $item['item_id'] ?>][item_comment]" style="width: 100%; float:left;margin-bottom:10px;height: 100px;"></textarea>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="action_buttons" id="action_buttons_<?php echo $item['item_id'] ?>" >
                                <?php $wizard_feedback_type = ( isset( $wizard_data['feedback_type'] ) && '' != $wizard_data['feedback_type'] && '-1' != $wizard_data['feedback_type'] ) ? $wizard_data['feedback_type'] : '-1'; if ( isset( $wpc_feedback_types[$wizard_feedback_type] ) ) $wizard_feedback_type = $wpc_feedback_types[$wizard_feedback_type]; else $wizard_feedback_type = '-1'; if ( '-1' != $wizard_feedback_type ) { if ( is_array( $wizard_feedback_type['options'] ) && 0 < count( $wizard_feedback_type['options'] ) ) { switch( $wizard_feedback_type['sort_order'] ) { case 'default': break; case 'asc': asort( $wizard_feedback_type['options'] ); break; case 'desc': arsort ( $wizard_feedback_type['options'] ); break; } } switch( $wizard_feedback_type['type'] ) { case 'radio': if ( is_array( $wizard_feedback_type['options'] ) && 0 < count( $wizard_feedback_type['options'] ) ) { foreach( $wizard_feedback_type['options'] as $num=>$name ) { $checked = ''; if ( isset( $wizard_feedback_type['default_option'] ) && $wizard_feedback_type['default_option'] == $num ) { $checked = 'checked'; } echo '<label><input type="radio" class="wpc_fw_radio" name="feedback[items][' . $item['item_id'] . '][item_feedback]" value="' . $name . '" ' . $checked . ' /> ' . $name . '</label>'; } echo '<br><input type="button" onclick="jQuery(this).FeedbackClick( \'' . $item['item_id'] . '\', \'radio\', \'\' );" value="Submit" />'; } break; case 'checkbox': if ( is_array( $wizard_feedback_type['options'] ) && 0 < count( $wizard_feedback_type['options'] ) ) { foreach( $wizard_feedback_type['options'] as $num=>$name ) { $checked = ''; if ( isset( $wizard_feedback_type['default_option'] ) && $wizard_feedback_type['default_option'] == $num ) { $checked = 'checked'; } $align = ''; if ( isset( $wizard_feedback_type['align'] ) && 'ver' == $wizard_feedback_type['align'] ) { $align = '<br />'; } echo '<label><input type="checkbox" class="wpc_fw_checkbox" name="feedback[items][' . $item['item_id'] . '][item_feedback][]" value="' . $name . '" ' . $checked . ' /> ' . $name . '</label>' . $align; } echo '<br><input type="button" onclick="jQuery(this).FeedbackClick( \'' . $item['item_id'] . '\', \'checkbox\', \'\' );" value="Submit" />'; } break; case 'selectbox': if ( is_array( $wizard_feedback_type['options'] ) && 0 < count( $wizard_feedback_type['options'] ) ) { echo '<select class="wpc_fw_selectbox" name="feedback[items][' . $item['item_id'] . '][item_feedback]" >'; foreach( $wizard_feedback_type['options'] as $num=>$name ) { $selected = ''; if ( isset( $wizard_feedback_type['default_option'] ) && $wizard_feedback_type['default_option'] == $num ) { $selected = 'selected'; } echo '<option value="' . $name . '" ' . $selected . ' /> ' . $name . ' </option>'; } echo '</select>'; echo '<br><input type="button" onclick="jQuery(this).FeedbackClick( \'' . $item['item_id'] . '\', \'selectbox\', \'\' );" value="Submit" />'; } break; case 'button': if ( is_array( $wizard_feedback_type['options'] ) && 0 < count( $wizard_feedback_type['options'] ) ) { foreach( $wizard_feedback_type['options'] as $num=>$name ) { echo '<label><input type="button" class="wpc_fw_button" name="feedback[items][' . $item['item_id'] . '][item_feedback]" onclick="jQuery(this).FeedbackClick( \'' . $item['item_id'] . '\', \'button\', \' ' . $name . ' \' );" value="' . $name . '" /></label>'; } echo '<input type="hidden" name="feedback[items][' . $item['item_id'] . '][item_feedback]" id="item_feedback_' . $item['item_id'] . '" value="" />'; } break; } } else { ?>
                                    <input type="hidden" name="feedback[items][<?php echo $item['item_id'] ?>][item_feedback]" id="item_feedback_<?php echo $item['item_id'] ?>" value="" />
                                    <input type="button" class="wpc_button wpc_fw_approve" name="approve" onclick="jQuery(this).FeedbackClick( '<?php echo $item['item_id'] ?>', 'button', 'Approve' );" value="<?php _e( 'Approve', WPC_FW_TEXT_DOMAIN ) ?>" />
                                    <input type="button" class="wpc_button wpc_fw_not_sure" name="not_sure" onclick="jQuery(this).FeedbackClick( '<?php echo $item['item_id'] ?>', 'button', 'Not sure' );" value="<?php _e( 'Not sure', WPC_FW_TEXT_DOMAIN ) ?>" />
                                    <input type="button" class="wpc_button wpc_fw_not_approve" name="not_approved" onclick="jQuery(this).FeedbackClick( '<?php echo $item['item_id'] ?>', 'button', 'Not approved' );" value="<?php _e( 'Not approved', WPC_FW_TEXT_DOMAIN ) ?>" />
                                <?php } ?>
                            </div>
                        </fieldset>
                    <?php } ?>

                    <fieldset class="sectionwrap">
                        <h3 class="item_name"><label for="wpc_feedback_final_comment"><?php _e( 'Final comment', WPC_FW_TEXT_DOMAIN ) ?></label></h3>
                        <div class="postbox">
                            <div class="inside">
                                <textarea id="wpc_feedback_final_comment" style="width: 100%; float:left;margin-bottom:10px;height: 100px;" name="feedback[final_comment]"></textarea>
                            </div>
                         </div>
                    </fieldset>

                    <div class="wizard_buttons">
                        <input type="submit" name="send" id="send" class="wpc_submit" value="<?php _e( 'Send Your Feedback', WPC_FW_TEXT_DOMAIN ) ?>" style="display: none;" />
                        <input type="button" name="close" id="close" class="wpc_button" value="<?php _e( 'Close', WPC_FW_TEXT_DOMAIN ) ?>" />
                    </div>
                </div>
            </form>
        <?php } ?>
    </div>
</div>

<script type="text/javascript">

    jQuery( document ).ready( function(){

        var wizard_id = jQuery( '#wizard' );
        var current = 0;
        var count_items = jQuery( '#wizard fieldset.sectionwrap' ).length;
        wizard_id.find( 'fieldset.sectionwrap' ).hide();
        wizard_id.find( 'fieldset.sectionwrap:eq(' + current + ')' ).show();

        jQuery( '#total_steps' ).html( count_items );
        jQuery( '#cur_step' ).html( current + 1 );


        //write feedback for item
        jQuery.fn.FeedbackClick = function ( item_id, type, val ) {
            var next = false;

            if ( 'radio' == type ) {
                var elem = jQuery( 'input[name="feedback[items][' + item_id + '][item_feedback]"]:checked' );
                if ( elem.length ) {
                    next = true;
                } else {
                    jQuery( '#action_buttons_' + item_id + ' label' ).prop( 'class', 'wpc_feedback_error' );
                }

            } else if ( 'checkbox' == type ) {
                var elem = jQuery( 'input[name="feedback[items][' + item_id + '][item_feedback][]"]:checked' );
                if ( elem.length ) {
                    next = true;
                } else {
                    jQuery( '#action_buttons_' + item_id + ' label' ).prop( 'class', 'wpc_feedback_error' );
                }

            } else if ( 'selectbox' == type ) {
                var elem = jQuery( 'select[name="feedback[items][' + item_id + '][item_feedback]"] option:selected' );
                if ( elem.length ) {
                    next = true;
                } else {
                    jQuery( '#action_buttons_' + item_id + ' label' ).prop( 'class', 'wpc_feedback_error' );
                }

            } else if ( 'button' == type ) {
                jQuery( '#item_feedback_' + item_id ).val( val );
                next = true;
            }

            //next step
            if ( next ) {
                if ( current < count_items - 1 ) {
                    wizard_id.find( 'fieldset.sectionwrap:eq(' + current + ')' ).fadeOut( 'fast', function() {
                        current++;

                        jQuery( '#cur_step' ).html( current + 1 );
                        wizard_id.find( 'fieldset.sectionwrap:eq(' + current + ')' ).fadeIn( 'slow' );
                    });
                }
            }

            //last step
            if ( current == count_items - 2 ) {
                jQuery( '#send' ).show();
            }
        };


        //show image in shutterbox
        jQuery( "#single_1" ).shutter_box({
            type        : 'gallery',
            show_nav    : false
        });

        //show pdf in shutterbox
        jQuery( ".various").each( function() {
            var title = jQuery(this).html();

            jQuery( this ).shutter_box({
                view_type   : 'lightbox',
                type        : 'iframe',
                title       : title,
                width       : '800px',
                height      : '450px'
            });
        });


        jQuery( '#close' ).click( function() {
            window.location = '<?php echo $wpc_client->cc_get_slug( 'hub_page_id' ) ?>';
            return false;
        });
    });

</script>

<?php $out2 = ob_get_contents(); if( ob_get_length() ) { ob_end_clean(); } return $out2; ?>