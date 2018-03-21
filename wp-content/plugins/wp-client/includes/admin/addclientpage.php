<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } global $wpdb, $post; $client_page_name = ( isset( $_POST['client_page_name'] ) ) ? $_POST['client_page_name'] : ''; $client_page_tags = ( isset( $_POST['client_page_tags'] ) ) ? $_POST['client_page_tags'] : ''; if ( isset( $_POST['change_page'] ) && 'page' == $_POST['change_page'] ) { $selected_page_name = ( isset( $_POST['selected_page_name'] ) ) ? $_POST['selected_page_name'] : 'wp-default'; } else if ( isset( $_POST['change_page'] ) && 'portal_page' == $_POST['change_page'] ) { $selected_page_name = ( isset( $_POST['selected_portal_page_name'] ) ) ? $_POST['selected_portal_page_name'] : 'wp-default'; } else $selected_page_name = 'wp-default'; $page_name_id = $wpdb->get_var( $wpdb->prepare( "SELECT ID
    FROM $wpdb->posts
    WHERE post_name = %s", $selected_page_name ) ); $error = ''; if ( $selected_page_name == 'wp-default' ) { $wpc_templates_clientpage = $this->cc_get_settings( 'templates_clientpage', '' ); $wpc_templates_clientpage = html_entity_decode( $wpc_templates_clientpage ); } else { $wpc_templates_clientpage = $wpdb->get_var( $wpdb->prepare( "SELECT post_content FROM $wpdb->posts WHERE post_name = %s", $selected_page_name ) ); } if ( isset( $_POST['create_clientpage'] ) ) { if ( $client_page_name != '' ) { $my_post = array( 'post_title' => esc_html( $client_page_name ), 'post_content' => $wpc_templates_clientpage, 'post_status' => 'publish', 'post_author' => get_current_user_id(), 'post_type' => 'clientspage', 'comment_status' => 'closed' ); $my_post = apply_filters( 'wpc_client_insert_portal_page_args', $my_post ); $client_page_id = wp_insert_post( $my_post, true ); if( !is_wp_error( $client_page_id ) ) { $tags = preg_replace( '/^\[|\]$/', '', stripcslashes( $client_page_tags ) ) ; $tags = explode( ",", $tags ) ; foreach ( $tags as $key => $tag ) { $temp_tag = preg_replace( '/^\"|\"$/', '', $tag ); $tags[ $key ] = stripcslashes( $temp_tag ) ; } wp_set_object_terms( $client_page_id, $tags, 'wpc_tags' ); $clients = array(); if ( isset( $_POST['wpc_clients'] ) && '' != $_POST['wpc_clients'] ) { $clients = explode( ',', $_POST['wpc_clients'] ); } $this->cc_set_assigned_data( 'portal_page', $client_page_id, 'client', $clients ); $selected_circles = array(); if ( isset( $_POST['wpc_circles'] ) && '' != $_POST['wpc_circles'] ) { $selected_circles = explode( ',', $_POST['wpc_circles'] ); } $auto_assign_circles = $wpdb->get_col( "SELECT group_id FROM {$wpdb->prefix}wpc_client_groups WHERE auto_add_pps = 1 " ) ; $add_circles = array_merge( $selected_circles, $auto_assign_circles ) ; $add_circles = array_unique( $add_circles ) ; $this->cc_set_assigned_data( 'portal_page', $client_page_id, 'circle', $add_circles ); if ( isset( $_POST['clientpage_template'] ) && 'default' != $_POST['clientpage_template'] ) { update_post_meta( $client_page_id, '_wp_page_template', $_POST['clientpage_template'] ); } if ( isset( $_POST['wpc_use_page_settings'] ) && '1' == $_POST['wpc_use_page_settings'] ) update_post_meta( $client_page_id, '_wpc_use_page_settings', 1 ); else update_post_meta( $client_page_id, '_wpc_use_page_settings', 0 ); if ( isset( $_POST['clientpage_category'] ) && '' != $_POST['clientpage_category'] ) { update_post_meta( $client_page_id, '_wpc_category_id', $_POST['clientpage_category'] ); } if ( isset( $_POST['clientpage_order'] ) && '' != (int) $_POST['clientpage_order'] && 0 <= (int) $_POST['clientpage_order'] ) { update_post_meta( $client_page_id, '_wpc_order_id', $_POST['clientpage_order'] ); } else { update_post_meta( $client_page_id, '_wpc_order_id', 0 ); } do_action( 'wpc_client_insert_portal_page', $client_page_id ); do_action( 'wp_client_redirect', get_admin_url(). 'admin.php?page=wpclients_content&tab=add_client_page&msg=a' ); exit; } else { $error .= $client_page_id->get_error_message(); } } else { $error .= sprintf( __( 'You must enter %s Title.<br/>', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal_page']['s'] ); } } ?>

<style type="text/css">
    .wrap input[type=text] {
        width:200px;
    }
</style>

<div class='wrap'>

    <?php echo $this->get_plugin_logo_block() ?>

    <div class="wpc_clear"></div>

        <div id="wpc_container">

            <?php
 if ( isset( $_GET['msg'] ) ) { switch( $_GET['msg'] ) { case 'a': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s is added.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal_page']['s'] ) . '</p></div>'; break; } } ?>

            <?php echo $this->gen_tabs_menu( 'content' ) ?>

            <span class="wpc_clear"></span>

            <div class="wpc_tab_container_block">

                <div id="message" class="updated wpc_notice fade" <?php echo ( empty( $error ) ) ? 'style="display: none;" ' : '' ?>><?php echo $error ?></div>

                <form action="admin.php?page=wpclients_content&tab=add_client_page" method="post">
                    <table>
                        <tr>
                            <td style="border-right:#666 solid 2px; width:220px; height:400px; vertical-align:top;">
                                <p>
                                    <label for="client_page_name"><?php printf( __( '%s Title', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal_page']['s'] ) ?>:</label> <br/>
                                    <input type="text" id="client_page_name" name="client_page_name" value="<?php echo esc_html( $client_page_name ) ?>" />
                                </p>
                                <p>
                                    <label for="client_page_tags"><?php printf( __( '%s Tags', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal_page']['s'] ) ?>:</label> <br/>
                                    <textarea id="client_page_tags" name="client_page_tags" rows="1" style="width: 220px;"></textarea><br />
                                    <span class="description"><?php _e( 'Note: Press Enter for add tag.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                                </p>
                                <p>
                                    <select name="change_page" id="change_page">
                                        <?php $all_filter_page = array( 'page' => 'page', 'portal' => 'portal_page'); ?>
                                        <option value="-1" <?php if( !isset( $_POST['change_page'] ) || !in_array( $_POST['change_page'], $all_filter_page ) ) echo 'selected'; ?>><?php _e( 'Select Page', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                                        <?php
 foreach ( $all_filter_page as $type_filter ) { $selected = ( isset( $_POST['change_page'] ) && $type_filter == $_POST['change_page'] ) ? ' selected' : '' ; echo '<option value="' . $type_filter . '"' . $selected . ' >'; if ( 'page' == $type_filter ) _e( 'Page', WPC_CLIENT_TEXT_DOMAIN ); else if ( 'portal_page' == $type_filter ) echo $this->custom_titles['portal_page']['s']; echo '</option>'; } ?>
                                    </select>
                                </p>
                                <p id="p_page">
                                    <span id="span_page"><?php _e( 'Page Content', WPC_CLIENT_TEXT_DOMAIN ) ?>:</span><br>
                                    <select name="selected_page_name" class="chzn-select" id="select_page" style="width: 250px;">
                                        <option value="wp-default"><?php printf( __( 'Default %s Template', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal_page']['s'] ) ?></option>
                                        <?php
 $args = array( 'post_type' => 'page', 'posts_per_page' => -1, ); $myposts = get_posts( $args ); foreach( $myposts as $post ) { setup_postdata( $post ); ?>
                                                <option><?php echo ucwords( $post->post_name ); ?></option>
                                            <?php } ?>
                                    </select>
                                </p>
                                <p id="p_portal">
                                    <span id="span_page"><?php printf( __( '%s Content', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal_page']['s'] ) ?>:</span><br>
                                    <select name="selected_portal_page_name" class="chzn-select" id="select_portal_page" style="width: 250px;" >
                                        <option value="wp-default"><?php printf( __( 'Default %s Template', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal_page']['s'] ) ?></option>
                                        <?php
 $args = array( 'post_type' => 'clientspage', 'posts_per_page' => -1, ); $myposts = get_posts( $args ); foreach( $myposts as $post ) { setup_postdata( $post ); ?>
                                                <option><?php echo ucwords( $post->post_name ); ?></option>
                                            <?php } ?>
                                    </select>
                                </p>
                                <p>
                                    <?php if ( 0 != count( get_page_templates() ) ) { ?>
                                        <label for="clientpage_template"><?php _e( 'Template', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label> <br/>
                                        <select name="clientpage_template" id="clientpage_template">
                                            <option value='__use_same_as_portal_page'><?php _e( 'Use same as /portal-page', WPC_CLIENT_TEXT_DOMAIN ); ?></option>
                                            <option value='default'><?php _e( 'Default Template', WPC_CLIENT_TEXT_DOMAIN ); ?></option>
                                            <?php page_template_dropdown( false ); ?>
                                        </select>
                                    <?php } else { _e( "Didn't find any page templates", WPC_CLIENT_TEXT_DOMAIN ); } ?>
                                </p>
                                <p>
                                    <input type="checkbox" name="wpc_use_page_settings" id="wpc_use_page_settings" value="1">
                                    <strong>
                                        <label for="wpc_use_page_settings"><?php _e( 'Ignore Theme Link Page options', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                                    </strong>
                                    <br>
                                    <span class="description" style="margin: 0 0 0 15px; display: block;"><?php _e( 'This will allow you to use options provided by your framework theme on an individual page level', WPC_CLIENT_TEXT_DOMAIN ) ?>.</span>
                                </p>
                                <p>
                                    <label for="clientpage_category"><?php _e( 'Category', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label> <br/>
                                    <select name="clientpage_category" id="clientpage_category" style="width:238px !important;">
                                        <option value='' selected>(<?php _e( 'None' , WPC_CLIENT_TEXT_DOMAIN ); ?>)</option>
                                        <?php
 $categories = $this->acc_get_clientspage_categories(); if ( 0 != count( $categories ) ) { foreach( $categories as $value ) { ?>
                                                <option value='<?php echo $value['id'] ?>'><?php _e( $value['name'] , WPC_CLIENT_TEXT_DOMAIN ); ?></option>
                                            <?php } } ?>
                                    </select>
                                </p>
                                <p>
                                    <label for="clientpage_order"><?php _e( 'Order', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label> <br/>
                                    <input type="number" name="clientpage_order" id="clientpage_order" size="4" />
                                </p>
                            </td>

                            <td style="vertical-align:top; width:500px; padding-left:10px;">
                                <br />
                                <strong><?php printf( __( 'Select %s who will have permissions for this %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'], $this->custom_titles['portal_page']['s'] ) ?></strong>
                                <br />
                                <span style="color: #800000; font-size: x-small;"><em><?php printf( __( 'This can be changed later in the editing interface for the appropriate %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal_page']['s'] ) ?></em></span>
                                <br />
                                <?php
 $link_array = array( 'title' => sprintf( __( 'Assign %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ), 'text' => sprintf( __( 'Assign %s ', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) ); $input_array = array( 'name' => 'wpc_clients', 'id' => 'wpc_clients', 'value' => '' ); $additional_array = array( 'counter_value' => 0 ); $this->acc_assign_popup('client', 'add_client_page', $link_array, $input_array, $additional_array ); ?>
                                <br />
                                <br />
                                <strong><?php printf( __( 'Select %s who will have permissions for this %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'], $this->custom_titles['portal_page']['s'] ) ?></strong>
                                <br />
                                <span style="color: #800000; font-size: x-small;"><em><?php printf( __( 'This can be changed later in the editing interface for the appropriate %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal_page']['s'] ) ?></em></span>
                                <br />

                                <?php
 $groups = $this->cc_get_groups(); $selected_groups = array(); foreach ( $groups as $group ) { if( '1' == $group['auto_select'] ) { $selected_groups[] = $group['group_id']; } } $link_array = array( 'title' => sprintf( __( 'Assign %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'] ), 'text' => sprintf( __( 'Assign %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'] ) ); $input_array = array( 'name' => 'wpc_circles', 'id' => 'wpc_circles', 'value' => implode( ',', $selected_groups ) ); $additional_array = array( 'counter_value' => count( $selected_groups ) ); $this->acc_assign_popup('circle', 'add_client_page', $link_array, $input_array, $additional_array ); ?>

                            </td>
                        </tr>
                        <tr>
                            <td>
                                <hr /><br />
                                <input type="submit" name="create_clientpage" id="submit" class='button-primary' value="<?php printf( __( 'Create New %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal_page']['s'] ) ?>"  />
                            </td>
                            <td>
                            </td>
                        </tr>
                    </table>
                  </form>

            </div>
        </div>
</div>



<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery( '#p_page' ).css( 'display', 'none' );
        jQuery( '#p_portal' ).css( 'display', 'none' );

        jQuery('#client_page_tags').textext({
            plugins : 'tags prompt focus autocomplete ajax arrow',
            prompt : 'Add tag...',
            ajax : {
                url : '<?php echo get_admin_url() ?>admin-ajax.php?action=wpc_get_all_tags',
                dataType : 'json',
                cacheResults : true
            }
        });

        //submit message
        jQuery( "#submit" ).click( function() {
            if ( '' == jQuery( "#client_page_name" ).val() ) {
                jQuery( '#client_page_name' ).parent().attr( 'class', 'wpc_error' );
                jQuery( '#client_page_name' ).focus();
                return false;
            }
            return true;
        });


        jQuery( '.chzn-select' ).chosen({
            no_results_text: '<?php echo esc_js( __( 'No results matched', WPC_CLIENT_TEXT_DOMAIN ) ) ?>',
            allow_single_deselect: true
        });


        //change filter
        jQuery( '#change_page' ).change( function() {
            if ( 'page' == jQuery( '#change_page' ).val() ) {
                jQuery( '#p_page' ).css( 'display', 'block' );
                jQuery( '#p_portal' ).css( 'display', 'none' );
            } else if ( 'portal_page' == jQuery( '#change_page' ).val() ) {
                jQuery( '#p_page' ).css( 'display', 'none' );
                jQuery( '#p_portal' ).css( 'display', 'block' );
            } else if ( '-1' == jQuery( '#change_page' ).val() ) {
                jQuery( '#p_page' ).css( 'display', 'none' );
                jQuery( '#p_portal' ).css( 'display', 'none' );
            }
            return false;
        });

});
</script>