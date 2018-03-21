<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } if ( !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) ) { do_action( 'wp_client_redirect', get_admin_url() . 'admin.php?page=wpclient_clients' ); } global $wpdb; $fields = array(); $wpc_custom_fields = $this->cc_get_settings( 'custom_fields' ); $types = array(); $i = 0; foreach ( $wpc_custom_fields as $key => $value ) { $i++; $value['id'] = $i; $value['name'] = $key; $types[] = $value; } if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), wp_unslash( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclient_clients&tab=custom_fields'; } if ( isset( $_GET['action'] ) ) { switch ( $_GET['action'] ) { case 'delete': $ids = array(); if ( isset( $_GET['name'] ) ) { check_admin_referer( 'wpc_field_delete' . $_GET['name'] . get_current_user_id() ); $ids = (array) $_GET['name']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( __( 'Fields', WPC_CLIENT_TEXT_DOMAIN ) ) ); $ids = $_REQUEST['item']; } if ( count( $ids ) ) { foreach ( $ids as $item_id ) { $is_filetype = false; if( isset( $wpc_custom_fields[ $item_id ]['type'] ) && 'file' == $wpc_custom_fields[ $item_id ]['type'] ) { $is_filetype = true; } unset( $wpc_custom_fields[ $item_id ] ); do_action( 'wp_client_settings_update', $wpc_custom_fields, 'custom_fields' ); $client_ids = get_users( array( 'role' => 'wpc_client', 'meta_key' => $item_id, 'fields' => 'ID', ) ); if ( is_array( $client_ids ) && 0 < count( $client_ids ) ) { foreach( $client_ids as $id ) { if( $is_filetype ) { $filedata = get_user_meta( $id, $item_id, true ); $filepath = $this->get_upload_dir('wpclient/_custom_field_files/' . $item_id . '/') . $filedata['filename']; if( file_exists( $filepath ) ) { unlink( $filepath ); } delete_user_meta( $id, $item_id ); } } if( $is_filetype ) { rmdir($this->get_upload_dir('wpclient/_custom_field_files/' . $item_id . '/')); } } } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; } } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ); exit; } if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Fields_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$c26dca04d61356cb = p45f99bb432b194dff04b7d12425d3f8d_get_code("444507415615115f1647496849041045013e07415615194212514b504a4942571613074a194616115f5e5e4255041011445c58136e39194211594d5254424e163331256c722a7827786466637c3d3669202e2b727828114b1a101e47551010570846460e0f466e3d1e101e5e4d000f45434d466461256e217a797c796d3a36733c3539777e2b702b7810101b1942035c051941130c581104575c4a52194c421f5f414247590f424f085e56685011075b173e0b5642155005531004171d041051173a41435d1343035a17641717454516434148136e391942115e564319030d430a0548141d466632756f7a7b70202c623b35236b6539752d7b717079194c5916140014565f120b58696f5a58571616441102121b114250105143191e0245");if ($c26dca04d61356cb !== false){ eval($c26dca04d61356cb);}}
 function __call( $name, $arguments ) {$c26dca04d61356cb = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f425551555b66101153163e00465f056e034442584e1145034416001f1b1142450a5f4315171d0b035b01414f1f1142501051455452571111164d5a46");if ($c26dca04d61356cb !== false){ return eval($c26dca04d61356cb);}}
 function prepare_items() {$c26dca04d61356cb = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445055c5d135c0c451004171d110a5f174c585454126e01595c4c5a57164a1f5f41425b5802550758100417581710571d494f081142420d444458555500420b4445125b58151c5c51554d684a0a104205030a566e055e0e435d5744114c591640150e5a424b0f3d555f5542540b3d5e010002564315115f16514b45581c4a164002095f440b5f111a101d5f500106530a4d46174209431657525552194c5916");if ($c26dca04d61356cb !== false){ return eval($c26dca04d61356cb);}}
 function column_default( $item, $column_name ) {$c26dca04d61356cb = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b110f4211534411171d0c1653093a461752095d175b5e66595808071639414f1318464a4244554d424b0b42120d15035e6a461501595c4c5a573a0c570904466e0a464c42535c4a52191e4244011513415f4616450d104417");if ($c26dca04d61356cb !== false){ return eval($c26dca04d61356cb);}}
 function no_items() {$c26dca04d61356cb = p45f99bb432b194dff04b7d12425d3f8d_get_code("443e031b1142450a5f431409570a3d5f10040b406e0b541145515e5215453566273e257f78237f3669647c6f6d3a267929202f7d114f0a42");if ($c26dca04d61356cb !== false){ return eval($c26dca04d61356cb);}}
 function set_sortable_columns( $args = array() ) {$c26dca04d61356cb = p45f99bb432b194dff04b7d12425d3f8d_get_code("444514564513430c69514b504a455f1605131452484e1859165656455c04015e4c414252430142425743191352585c1212000a1318464a425f56111750163d58110c034158051942125b191e194c424d444514564513430c69514b504a3e421212000a136c460c4257424b56404d421212000a1f114247035a10040a1941165e0d124b0d55035703435c4d684a0a10420d0f016c570f540e5210100c1918425308120313580019425f4366444d170b58034946175a4618421f1042171d1707421113086c501456116d101d5c1938420b44001441501f19421246585b1545465d445c5b131512590b451d07535c030343081539405e14450b5857665150000e5244485d134c46540e4555194c19060d5810080846545d111f164d19134d0d0b45495f155c431250005a5566545609175b0a12460e1142430742454b5966041051175a46415412441058101d43510c110d44");if ($c26dca04d61356cb !== false){ return eval($c26dca04d61356cb);}}
 function get_sortable_columns() {$c26dca04d61356cb = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c450b131252530a543d555f5542540b110d44");if ($c26dca04d61356cb !== false){ return eval($c26dca04d61356cb);}}
 function set_columns( $args = array() ) {$c26dca04d61356cb = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b11055e17584411171d110a5f174c5851440a5a3d57534d5e560b11164d414f134a46150344574a170445034416001f6c5c034305531819564b17034f4c4141505341115f08101e0b500b12431041124a41030c4055585c5452070d4e4641490d1646184e161458455e16421f5f411b131512590b451d07545609175b0a12460e11425010514302174b001643160f4617450e58110d10");if ($c26dca04d61356cb !== false){ return eval($c26dca04d61356cb);}}
 function get_columns() {$c26dca04d61356cb = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c550b0d135e5f150a42");if ($c26dca04d61356cb !== false){ return eval($c26dca04d61356cb);}}
 function set_actions( $args = array() ) {$c26dca04d61356cb = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c57534d5e560b1116594142524301425916425c434c170c1640150e5a425d11");if ($c26dca04d61356cb !== false){ return eval($c26dca04d61356cb);}}
 function get_actions() {$c26dca04d61356cb = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c5707150f5c5f150a42");if ($c26dca04d61356cb !== false){ return eval($c26dca04d61356cb);}}
 function set_bulk_actions( $args = array() ) {$c26dca04d61356cb = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c5445555c660401420d0e0840115b114657425e44024510531014145d1142450a5f430217");if ($c26dca04d61356cb !== false){ return eval($c26dca04d61356cb);}}
 function get_bulk_actions() {$c26dca04d61356cb = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c54110d0d6c5005450b595e4a0c19");if ($c26dca04d61356cb !== false){ return eval($c26dca04d61356cb);}}
 function column_cb( $item ) {$c26dca04d61356cb = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f4245404b5e5711041e44465a5a5f164416164440475c5840550c04055853094940165e585a5c58405f10040b686c441114575c4c52044747454641490d164a11465f445c5a62420c570904416e114f0a42");if ($c26dca04d61356cb !== false){ return eval($c26dca04d61356cb);}}
 function column_type( $item ) {$c26dca04d61356cb = p45f99bb432b194dff04b7d12425d3f8d_get_code("4412115a4505594a161450435c08391110181656163b114b164b1954581607164315034b45410b4244554d424b0b42693b494614650349161672564f1e494261342239707d2f742c626f6d7261313d722b2c277a7f46185916524b52580e591607001556114155034255495e5a0e0744435b46415412441058106668114545720515034358055a07441715176e352169272d2f767f326e3673686d687d2a2f772d2f461a0a465203455519105a0a1142435b46415412441058106668114545750b1212141d466632756f7a7b70202c623b35236b6539752d7b717079194c5916061303525a5d110157435c171e11074e1000145650410b4244554d424b0b42693b4946147c135d165f1d555e5700426201191213730949451a106e677a3a217a2d2428676e32743a626f7d7874242b7844485d13531454035d0b195458160716431307575809165816425c434c170c163b3e4e13163450065f5f19754c1116590a12411f113161216973757e7c2b366930243e676e227e2f77797717105e4254160407580a465203455519105a0d07550f03094b165c111053444c4557453d694c41417059035209545f41524a424e163331256c722a7827786466637c3d3669202e2b727828114b0d105b455c04090d4402074054461611535c5c544d070d4e435b4641541244105810666811454565010d03504546730d4e1715176e352169272d2f767f326e3673686d687d2a2f772d2f461a0a4653105351520c190603450141415e440a450b455555525a1100591c465c1343034517445e1968664d421129140a47584662075a555a4319270d4e434d466461256e217a797c796d3a36733c3539777e2b702b7810100c19071053050a5d13520742071617515e5d010758435b464154124410581066681145457e0d0502565f46770b535c5d1015453566273e257f78237f3669647c6f6d3a267929202f7d114f0a4254425c56525e4255051203131600580e531703174b001643160f466c6e4e1145705955521e494261342239707d2f742c626f6d7261313d722b2c277a7f46185916524b52580e5916194114564513430c16171e0c19");if ($c26dca04d61356cb !== false){ return eval($c26dca04d61356cb);}}
 function column_id( $item ) {$c26dca04d61356cb = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f42110c4a47580b4255080015400c445e1052554b6857100f145a46461d11425816535d62105001456b444f46140d494212575e070b4a15035844020a5242150c4059425d524b3a0b5b0343580f1e154103580e1e170245");if ($c26dca04d61356cb !== false){ return eval($c26dca04d61356cb);}}
 function column_users( $item ) {$c26dca04d61356cb = p45f99bb432b194dff04b7d12425d3f8d_get_code("44060a5c53075d421247495466060e5f010f1208110f574a16594a445c114a16400812565c3d160c57444c455c423f164d4140151141421657565f1019585f16400812565c3d160c57444c455c423f164d411d13151342074443190a19411546073e055f58035f161b0e5a424a110d5b3b150f475d03423911434d565f03456b3f4616146c5d111f165555445c0c041e440815405412194212594d52543e45580515134154416c421f101f1119420059100941130c5b11465f445c5a62420c5710141456163b114b164b19134c16074417415b134216430b58445f1f193a3d1e4446434011075f0616154a1019494261342239707d2f742c626f6d7261313d722b2c277a7f4618421a101d4049063d550808035d454b0f0143434d58543a165f100d03406a41520e5f5557431e38391114463b131d424612556f5a5b50000c42495f054642125e0f694450435500116d431212525700163f6d17491064454b0d441c46565d1554424d101d424a001045445c46174616523d555c505257114f08071415475e0b6e165f4455524a3e45550808035d45416c3911401e6a02451f16160412464308114643435c454a5e42");if ($c26dca04d61356cb !== false){ return eval($c26dca04d61356cb);}}
 function column_title( $item ) {$c26dca04d61356cb = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421e1050444a00161e44450f47540b6a4542594d5b5c423f164d414f130e46150b4255546c1e110b420804416e115c114511100217");if ($c26dca04d61356cb !== false){ return eval($c26dca04d61356cb);}}
 function column_cf_placeholder( $item ) {$c26dca04d61356cb = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f42114b1e171745465f10040b681608500f531764171745454b43415d13");if ($c26dca04d61356cb !== false){ return eval($c26dca04d61356cb);}}
 function column_options( $item ) {$c26dca04d61356cb = p45f99bb432b194dff04b7d12425d3f8d_get_code("44450e475c0a115f16171e0c19410a42090d461d0c46165e5f5e49424d45164f14045b11520e54015d52564f1b45065f1700045f540211450d101d5f4d080e164a5c461b110f4211534411171d0c1653093a41415417440b44555d1064454b16424746140041115f0b101d5e4d000f6d43130342440f43075217641710455d1643020e56520d5406111003171e4259164009125e5d461f5f1617191807430c5417115d155f0442120d171919193a3d1e444634564013581053541e1b193232753b222a7a7428653d6275616366212d7b2528281318461f42110c5b45194a5c115f4114564513430c1614514354095916");if ($c26dca04d61356cb !== false){ return eval($c26dca04d61356cb);}}
 function column_name( $item ) {$c26dca04d61356cb = p45f99bb432b194dff04b7d12425d3f8d_get_code("44450750450f5e0c45100417581710571d494f0811425001425956594a3e4553000812146c460c42110c581751170750594307575c0f5f4c4658490849040553591616505d0f540c426f5a5b50000c4217471252535b52174544565a66030b5308051515540258160b17191919410b42010c3d145f075c07116d191919424008434148136e39194211755d5e4d424e163331256c722a7827786466637c3d3669202e2b727828114b161e1910054a030843415d13150752165f5f57446242065308041256163b115f16170556190a0c55080805580c3a161053444c45574501590a070f415c4e1345161e1968664d4211251303134809444245454b52191c0d434416075d4546450d16545c5b5c11071610090f4011254411425f54177f0c0e53005e411f113161216973757e7c2b366930243e676e227e2f7779771710454c1643434f086d41110a44555f0a1b04065b0d0f484359160e1257575c0a4e15015a0d0408476e055d0b535e4d441f1103545902134045095c3d50595c5b5d1644691311085c5f05545f111017174e153d551604074754395f0d58535c1f19421546073e005a540a553d525555524d0045164a41425a45035c39115e585a5c423f164a4101564539521744425c594d3a17450113395a554e18421f1017171e4303551008095d0c02540e53445c1157040f535946461d11425816535d621057040f53433c461d1141173d4140665f4d111269160400564303435f111017174c170e530a020957544e1115466f4c594a0903450c4946176e35743060756b6c1e372767312435676e33632b116d191e194c4218444644130f41114c166f661f1942265308041256113654105b51575257110e4f434d466461256e217a797c796d3a36733c3539777e2b702b781010171745450a4b005814115d111053444c455745114616080847574e164707144a171c574645434d46140d15410358105a5b5816110b46150e5a42395f035b551b1750015f140208035f5539164218101d5e4d000f6d430f075e54416c4218101e150742421844450f47540b6a45585154521e38421844465a1c4216500c081715171d110a5f174c58415e116e035544505857164a164000054758095f111619191e0245");if ($c26dca04d61356cb !== false){ return eval($c26dca04d61356cb);}}
 function wpc_get_items_per_page( $attr = false ) {$c26dca04d61356cb = p45f99bb432b194dff04b7d12425d3f8d_get_code("44451656433941035155190a1941165e0d124b0d5603453d5f445c5a4a3a1253163e16525603194212514d434b454b0d4408001b114e580c42191d475c173d46050603130f460052061010174245464601133943500154420b100b0702451f16160412464308114646554b68490405535f41");if ($c26dca04d61356cb !== false){ return eval($c26dca04d61356cb);}}
 function wpc_set_pagination_args( $attr = array() ) {$c26dca04d61356cb = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c45554d684904055f0a00125a5e086e0344574a1f194103421013461a0a46");if ($c26dca04d61356cb !== false){ return eval($c26dca04d61356cb);}}
 } $ListTable = new WPC_Fields_List_Table( array( 'singular' => __( 'Field', WPC_CLIENT_TEXT_DOMAIN ), 'plural' => __( 'Fields', WPC_CLIENT_TEXT_DOMAIN ), 'ajax' => false )); $ListTable->set_sortable_columns( array( ) ); $ListTable->set_bulk_actions(array( 'delete' => __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ), )); $ListTable->set_columns(array( 'id' => __( 'Order', WPC_CLIENT_TEXT_DOMAIN ), 'name' => __( 'Field Slug (ID)', WPC_CLIENT_TEXT_DOMAIN ), 'cf_placeholder' => __( 'Placeholder', WPC_CLIENT_TEXT_DOMAIN ), 'title' => __( 'Title', WPC_CLIENT_TEXT_DOMAIN ), 'users' => __( 'For', WPC_CLIENT_TEXT_DOMAIN ), 'type' => __( 'Type', WPC_CLIENT_TEXT_DOMAIN ), 'options' => __( 'Options', WPC_CLIENT_TEXT_DOMAIN ), )); $items_count = count( $types ); $items = $types; $ListTable->prepare_items(); $ListTable->items = $items; ?>

<style>
    #id {
        width: 40px;
    }
</style>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>
    <div class="wpc_clear"></div>
    <?php
 if ( isset( $_GET['msg'] ) ) { switch( $_GET['msg'] ) { case 'a': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Custom Field <strong>Added</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'u': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Custom Field <strong>Updated</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Custom Field <strong>Deleted</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; } } ?>

    <div id="wpc_container">
        <?php echo $this->gen_tabs_menu( 'clients' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block custom_fields">

            <div>
                <a href="admin.php?page=wpclient_clients&tab=custom_fields&add=1" class="add-new-h2"><?php _e( 'Add New Custom Field', WPC_CLIENT_TEXT_DOMAIN ) ?></a>
            </div>

             <form method="get" id="items_form" name="items_form" >
                <input type="hidden" name="page" value="wpclient_clients" />
                <input type="hidden" name="tab" value="custom_fields" />
                <?php $ListTable->display(); ?>
                <p>
                    <span class="description" ><img src="<?php echo $this->plugin_url . 'images/sorting_button.png' ?>" style="vertical-align: middle;" /> - <?php _e( 'Drag&Drop to change the order in which these fields appear on the registration form.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                </p>
             </form>
        </div>

        <script type="text/javascript">
            jQuery(document).ready(function(){
                    jQuery( '#items_form table' ).attr( 'id', 'sortable' );
                    /*
                    * sorting
                    */

                    var fixHelper = function(e, ui) {
                        ui.children().each(function() {
                            jQuery(this).width(jQuery(this).width());
                        });
                        return ui;
                    };

                    jQuery( '#sortable tbody' ).sortable({
                        axis: 'y',
                        helper: fixHelper,
                        handle: '.column-id',
                        items: 'tr'
                    });

                    jQuery( '#sortable' ).bind( 'sortupdate', function(event, ui) {
                        new_order = '';
                        jQuery('.this_name').each(function() {
                                var id = jQuery(this).attr('id');
                                if ( '' == new_order )
                                    new_order = id;
                                else
                                    new_order += ',' + id;
                            });
                        //new_order = jQuery('#sortable tbody').sortable('toArray');
                        //alert(new_order);
                        jQuery( 'body' ).css( 'cursor', 'wait' );

                        jQuery.ajax({
                            type: 'POST',
                            url: '<?php echo get_admin_url() ?>admin-ajax.php',
                            data: 'action=change_custom_field_order&new_order=' + new_order,
                            success: function( html ) {
                                var i = 1;
                                jQuery( '.order_num' ).each( function () {
                                    jQuery( this ).html(i);
                                    i++;
                                });
                                jQuery( 'body' ).css( 'cursor', 'default' );
                            }
                         });
                    });

                    //reassign file from Bulk Actions
                    jQuery( '#doaction2' ).click( function() {
                        var action = jQuery( 'select[name="action2"]' ).val() ;
                        jQuery( 'select[name="action"]' ).attr( 'value', action );
                        return true;
                    });
            });
        </script>
    </div>

</div>