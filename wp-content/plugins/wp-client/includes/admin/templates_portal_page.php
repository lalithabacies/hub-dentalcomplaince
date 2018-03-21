<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } if ( !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) ) { do_action( 'wp_client_redirect', get_admin_url( 'index.php' ) ); } if ( isset($_POST['update_templates'] ) ) { if ( isset( $_POST['client_template'] ) ) { $client_template = $_POST['client_template']; } else { $client_template = ''; } do_action( 'wp_client_settings_update', $client_template, 'templates_clientpage' ); do_action( 'wp_client_redirect', admin_url() . 'admin.php?page=wpclients_templates&tab=portal_page&msg=u' ); exit; } $wpc_templates_clientpage = $this->cc_get_settings( 'templates_clientpage', '' ); ?>

<style type="text/css">
    .wrap input[type=text] {
        width:400px;
    }
    .wrap input[type=password] {
        width:400px;
    }
</style>


<div class="icon32" id="icon-link-manager"></div>
<h2><?php printf( __( '%s Template', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal_page']['s'] ) ?></h2>
<p><?php printf( __( 'From here you can edit the template of the newly created %s.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal_page']['p'] ) ?></p>

<form action="" method="post" class="wpc_portal_page_content">
    <div class="wpc_clear"></div>

    <?php wp_editor( stripslashes( $wpc_templates_clientpage ), 'client_template', array( 'wpautop' => false ) ); ?>
    <br />

    <input type='submit' name='update_templates' id="update_templates" class='button-primary' value='<?php _e( 'Update', WPC_CLIENT_TEXT_DOMAIN ) ?>' />
</form>