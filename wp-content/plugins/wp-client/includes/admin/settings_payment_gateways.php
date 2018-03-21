<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } global $wpdb, $wpc_gateway_plugins, $wpc_gateway_active_plugins, $wpc_client; $wpc_gateways = $wpc_client->cc_get_settings( 'gateways' ); if ( isset( $_POST['gateway_settings'] ) ) { if ( isset( $_POST['wpc_gateway'] ) ) { $wpc_gateways = array_merge( $wpc_gateways, apply_filters('wpc_gateway_settings_filter', $_POST['wpc_gateway'] ) ); } do_action( 'wp_client_settings_update', $wpc_gateways, 'gateways' ); echo '<div class="updated wpc_notice fade"><p>' . __('Settings saved.', WPC_CLIENT_TEXT_DOMAIN) . '</p></div>'; } if ( '' == $wpc_client->cc_get_slug( 'payment_process_page_id' ) ) { $wpc_client->get_install_page_notice(); } ?>

<!--<style>
    #wpc_gateways_tabs .ui-tabs-vertical {
        width: 100%;
    }
    #wpc_gateways_tabs .ui-tabs-vertical .ui-tabs-nav {
        float: left;
        width: 16em;
    }
    #wpc_gateways_tabs .ui-tabs-vertical .ui-tabs-nav li {
        clear: left;
        width: 100%;
        border-bottom-width: 1px !important;
        border-right-width: 0 !important;
        margin: 0 -1px .2em 0;
    }
    #wpc_gateways_tabs .ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active {
        padding-bottom: 0;
        padding-right: .1em;
        border-right-width: 1px;
        background: none;
        background-color: #fff;
        border: none;
    }
    #wpc_gateways_tabs .ui-tabs-vertical .ui-tabs-panel {
        padding: 1em;
        float: right;
        width: 75%;
        padding-top: 0;
    }

    #wpc_gateways_tabs .ui-tabs-nav li.ui-state-active {
        background: none;
    }

    #wpc_gateways_tabs .ui-tabs-vertical .ui-tabs-nav li.ui-tabs-active {
        background: none;
    }

    .ui-tabs-nav {
        border-style: solid;
        border-width: 1px;
        border-color: #DFDFDF;
        border-radius: 3px 3px 3px 3px;
        box-shadow: 0 1px 0 #FFFFFF inset;
        padding: 5px 5px 5px 8px;
        margin: 0px 0px 0px 0px;
    }

    .ui-tabs-nav li.ui-state-active {
        background-color: #DFDFDF;
        font-weight: bold;
        border-radius: 0px 3px 3px 0px;
    }

    .ui-tabs-nav li.ui-state-active a {
        color: #d76741;
    }
</style>-->



<div class="wpc_clear"></div>

<h3><?php _e( 'Payment Settings', WPC_CLIENT_TEXT_DOMAIN ) ?></h3>
<p><?php _e( 'From here, you can manage payment gateways.', WPC_CLIENT_TEXT_DOMAIN ) ?></p>

<div id="wpc_gateways_tabs">
    <form id="wpc-gateways-form" method="post" action="" style="width: 100%" >
        <input type="hidden" name="gateway_settings" value="1" />

        <?php $tabs = array(); $i = 0; foreach( (array)$wpc_gateway_plugins as $code => $plugin ) { $checked = ( isset( $wpc_gateways['allowed'] ) && in_array( $code, (array) $wpc_gateways['allowed'] ) ) ? 'checked' : ''; $tabs[] = array( 'before_label' => '<div style="float:left;width: 25px;margin: 0;padding:8px 0 0 5px;line-height:18px;box-sizing: border-box;"><span id="wpc_ajax_loading_' . $code . '" style="float: left;"></span><input type="checkbox" class="wpc_allowed_gateways" name="wpc_gateway[allowed][]" value="' . $code .'" ' . $checked . ' data-tab_id="' . $i . '" /></div>', 'label' => esc_attr($plugin[1]), 'href' => get_admin_url() . "admin-ajax.php?action=wpc_get_gateway_setting&plugin=$code", 'active' => false, 'disabled' => ( !empty( $checked ) ) ? false : true, ); $i++; } $args = array( 'width' => '21%', 'ajax_response' => "jQuery('.wpc_ibutton').iButton();" ); echo $wpc_client->gen_vertical_tabs( $tabs, $args ); ?>

        <div id="tab-container" style="width: 78%;">
            <?php
 $i = 0; foreach( (array)$wpc_gateway_plugins as $code => $plugin ) { ?>
                <div id="wpc_tab_<?php echo $i ?>" class="tab-content"></div>
                <?php $i++; } ?>
        </div>

        <?php if ( !isset( $GLOBALS['wpc_external_gateways'] ) ) { ?>
            <span style="margin: 15px 0 0 15px; float: left; clear: left; "><a href="https://webportalhq.com/link/payment-gateways-extension/" target="_blank" ><?php _e( 'Get More Gateways >>', WPC_CLIENT_TEXT_DOMAIN ) ?></a></span>
        <?php } ?>

    </form>
</div>

<script type="text/javascript">

    var site_url = '<?php echo site_url();?>';

    jQuery(document).ready(function () {

        //remove settings for not active gateways
        jQuery( '#wpc-gateways-form' ).submit( function() {
            jQuery( '.ui-tabs-panel:hidden' ).each( function() {
                jQuery( this ).remove();
            });

            return true;
        });


        jQuery(".wpc_allowed_gateways").click( function( event ) {
            var value    = 0;
            if ( 'checked' == jQuery( this ).attr( 'checked' ) ) {
                value    = 1;
            }

            var name        = jQuery(this).val();
            var checkbox    = jQuery( this );
            var tab_id    = jQuery( this ).attr( 'data-tab_id' );

            checkbox.hide();
            jQuery( '#wpc_ajax_loading_' + name ).addClass( 'wpc_ajax_loading' );

            jQuery.ajax({
                type: "POST",
                url: '<?php echo get_admin_url() ?>admin-ajax.php',
                data: "action=wpc_save_allow_gateways&name=" + name + "&enable=" + value,
                dataType: "json",
                success: function(data){
                    jQuery( '#wpc_ajax_loading_' + name ).removeClass( 'wpc_ajax_loading' );
                    checkbox.show();

                    if ( 1 == value ) {
                        checkbox.parents('li').removeClass('disabled');
                        checkbox.prop('checked', true).attr('checked', true);
                        checkbox.parents('li').trigger('click');
                    } else {
                        checkbox.parents('li').addClass('disabled');
                        checkbox.prop('checked', false).attr('checked', false);
                        if( checkbox.parents('ul').find('li:not(.disabled)').length > 0 ) {
                            checkbox.parents('ul').find('li:not(.disabled)').first().trigger('click');
                        } else {
                            jQuery(".tab-content").addClass('invisible');
                        }
                    }

                }
            });
            event.stopPropagation();
        });

        jQuery('#wpc_gateways_tabs #tab-headers').find('li:not(.disabled)').first().trigger('click');
    });
</script>


<div class="wpc_clear"></div>