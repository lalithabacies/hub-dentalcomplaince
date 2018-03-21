<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } if ( !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) ) { if ( current_user_can( 'wpc_view_hub_templates' ) || current_user_can( 'wpc_edit_hub_templates' ) ) $adress = get_admin_url() . 'admin.php?page=wpclients_templates&tab=hubpage'; else if ( current_user_can( 'wpc_view_email_templates' ) || current_user_can( 'wpc_edit_email_templates' ) ) $adress = get_admin_url() . 'admin.php?page=wpclients_templates&tab=emails'; else if ( current_user_can( 'wpc_view_shortcode_templates' ) || current_user_can( 'wpc_edit_shortcode_templates' ) ) $adress = get_admin_url() . 'admin.php?page=wpclients_templates&tab=shortcodes'; else $adress = get_admin_url( 'index.php' ); do_action( 'wp_client_redirect', $adress ); } if ( isset($_POST['update_templates'] ) ) { if ( isset( $_POST['hub_template'] ) ) { $hub_template = $_POST['hub_template']; } else { $hub_template = ''; } do_action( 'wp_client_settings_update', $hub_template, 'templates_hubpage' ); if ( isset( $_POST['wpc_update_all_hub_pages'] ) && 'yes' == $_POST['wpc_update_all_hub_pages'] ) { global $wpdb; $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->posts} SET post_content='%s' WHERE post_type='hubpage'", stripslashes( html_entity_decode( $hub_template ) ) ) ); do_action( 'wp_client_redirect', admin_url() . 'admin.php?page=wpclients_templates&msg=hub_updated' ); exit; } do_action( 'wp_client_redirect', admin_url() . 'admin.php?page=wpclients_templates&msg=u' ); exit; } $wpc_templates_hubpage = $this->cc_get_settings( 'templates_hubpage', '' ); ?>

<style type="text/css">

    .wrap input[type=text] {
        width:400px;
    }
    .wrap input[type=password] {
        width:400px;
    }
</style>

<script type="text/javascript">
    jQuery(document).ready(function(){

        jQuery( "#update_hub_preset" ).submit( function(){
            if ( jQuery( "#wpc_update_all_hub_pages" ).attr( 'checked' ) ) {
                return confirm( "<?php echo esc_js( __( 'Are you sure to Update content for all HUB pages?', WPC_CLIENT_TEXT_DOMAIN ) ) ?>" );
            }
            return true;
        });

    });

</script>

<div class="icon32" id="icon-link-manager"></div>
<h2><?php _e( 'HUB Content', WPC_CLIENT_TEXT_DOMAIN ) ?></h2>

<div style="float: left;width:100%;margin:10px 0;padding:0;">
    <div class="wpc_notice"  style="background: #fff;border-left: 4px solid #fff;-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);border-left-color: #46b450;float: right; width: 360px; text-align: right; padding: 7px 7px 7px 7px; margin: 0 0 15px 0;box-sizing: border-box;-moz-box-sizing: border-box;-webkit-box-sizing: border-box;">
        <div style="float: left; margin: 0 20px 0 0;" class="validate_page_icon_attention"></div>
        <span class="description">
        <?php printf ( __( '<b>NOTE:</b> To use the HUB templates, be sure to use the following shortcode in the HUB Content field: %s', WPC_CLIENT_TEXT_DOMAIN ), '<b>[wpc_client_hub_page_template /]</b>' ) ?>
        </span>
    </div>
    <div style="float:left; width: calc( 100% - 360px );margin: 0;padding:0;">
        <p style="margin-top: 0;">
            <?php _e( 'All newly created HUB pages will be populated with the content in the HUB Content tab.', WPC_CLIENT_TEXT_DOMAIN ) ?>
        </p>
        <p>
            <?php _e( 'You can use custom HTML here, or you can use the shortcode for EZ HUB and Advanced HUB templates.', WPC_CLIENT_TEXT_DOMAIN ) ?>
        </p>
        <p>
            <?php printf( __( 'If you use the HUB template shortcode, each %s/Member will see the custom template that is assigned to them.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ) ?>
        </p>
        <p>
            <?php printf( __( 'They will see the default HUB template if no custom template is assigned to them.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ) ?>
        </p>
    </div>
</div>
<form action="" id="update_hub_preset" method="post">
    <div class="wpc_clear"></div>

    <?php wp_editor( stripslashes( $wpc_templates_hubpage ), 'hub_template' ); ?>
    <br />

    <label>
        <input type="checkbox" name="wpc_update_all_hub_pages" id="wpc_update_all_hub_pages" value="yes" />
        <b><?php _e( 'Update all existing HUB pages', WPC_CLIENT_TEXT_DOMAIN ) ?></b>
        <span class="description"> <?php _e( '(check this box to instantly update all HUB pages to the content above)', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
    </label>
    <br />
    <br />
    <input type='submit' name='update_templates' id="update_templates" class='button-primary' value='<?php _e( 'Update', WPC_CLIENT_TEXT_DOMAIN ) ?>' />
</form>