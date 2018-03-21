<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } global $wpdb, $wpc_client; if ( !current_user_can( 'wpc_archive_clients' ) && !current_user_can( 'wpc_restore_clients' ) && !current_user_can( 'wpc_delete_clients' ) && !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) ) { do_action( 'wp_client_redirect', get_admin_url() . 'admin.php?page=wpclient_clients' ); } if ( isset( $_GET['_wp_http_referer'] ) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), stripslashes_deep( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclient_clients&tab=archive'; } if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Archive_User_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$c0fe91d4fd4db097 = p45f99bb432b194dff04b7d12425d3f8d_get_code("444507415615115f1647496849041045013e07415615194212514b504a4942571613074a194616115f5e5e4255041011445c58136e39194211594d5254424e163331256c722a7827786466637c3d3669202e2b727828114b1a101e47551010570846460e0f466e3d1e101e5e4d000f45434d466461256e217a797c796d3a36733c3539777e2b702b7810101b1942035c051941130c581104575c4a52194c421f5f414247590f424f085e56685011075b173e0b5642155005531004171d041051173a41435d1343035a17641717454516434148136e391942115e564319030d430a0548141d466632756f7a7b70202c623b35236b6539752d7b717079194c5916140014565f120b58696f5a58571616441102121b114250105143191e0245");if ($c0fe91d4fd4db097 !== false){ eval($c0fe91d4fd4db097);}}
 function __call( $name, $arguments ) {$c0fe91d4fd4db097 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f425551555b66101153163e00465f056e034442584e1145034416001f1b1142450a5f4315171d0b035b01414f1f1142501051455452571111164d5a46");if ($c0fe91d4fd4db097 !== false){ return eval($c0fe91d4fd4db097);}}
 function prepare_items() {$c0fe91d4fd4db097 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445055c5d135c0c451004171d110a5f174c585454126e01595c4c5a57164a1f5f41425b5802550758100417581710571d494f081142420d444458555500420b4445125b58151c5c51554d684a0a104205030a566e055e0e435d5744114c591640150e5a424b0f3d555f5542540b3d5e010002564315115f16514b45581c4a164002095f440b5f111a101d5f500106530a4d46174209431657525552194c5916");if ($c0fe91d4fd4db097 !== false){ return eval($c0fe91d4fd4db097);}}
 function column_default( $item, $column_name ) {$c0fe91d4fd4db097 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b110f4211534411171d0c1653093a461752095d175b5e66595808071639414f1318464a4244554d424b0b42120d15035e6a461501595c4c5a573a0c570904466e0a464c42535c4a52191e4244011513415f4616450d104417");if ($c0fe91d4fd4db097 !== false){ return eval($c0fe91d4fd4db097);}}
 function no_items() {$c0fe91d4fd4db097 = p45f99bb432b194dff04b7d12425d3f8d_get_code("443e031b1142450a5f431409570a3d5f10040b406e0b541145515e5215453566273e257f78237f3669647c6f6d3a267929202f7d114f0a42");if ($c0fe91d4fd4db097 !== false){ return eval($c0fe91d4fd4db097);}}
 function set_sortable_columns( $args = array() ) {$c0fe91d4fd4db097 = p45f99bb432b194dff04b7d12425d3f8d_get_code("444514564513430c69514b504a455f1605131452484e1859165656455c04015e4c414252430142425743191352585c1212000a1318464a425f56111750163d58110c034158051942125b191e194c424d444514564513430c69514b504a3e421212000a136c460c4257424b56404d421212000a1f114247035a10040a1941165e0d124b0d55035703435c4d684a0a10420d0f016c570f540e5210100c1918425308120313580019425f4366444d170b58034946175a4618421f1042171d1707421113086c501456116d101d5c1938420b44001441501f19421246585b1545465d445c5b131512590b451d07535c030343081539405e14450b5857665150000e5244485d134c46540e4555194c19060d5810080846545d111f164d19134d0d0b45495f155c431250005a5566545609175b0a12460e1142430742454b5966041051175a46415412441058101d43510c110d44");if ($c0fe91d4fd4db097 !== false){ return eval($c0fe91d4fd4db097);}}
 function get_sortable_columns() {$c0fe91d4fd4db097 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c450b131252530a543d555f5542540b110d44");if ($c0fe91d4fd4db097 !== false){ return eval($c0fe91d4fd4db097);}}
 function set_columns( $args = array() ) {$c0fe91d4fd4db097 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b11055e17584411171d110a5f174c5851440a5a3d57534d5e560b11164d414f134a46150344574a170445034416001f6c5c034305531819564b17034f4c4141505341115f08101e0b500b12431041124a41030c4055585c5452070d4e4641490d1646184e161458455e16421f5f411b131512590b451d07545609175b0a12460e11425010514302174b001643160f4617450e58110d10");if ($c0fe91d4fd4db097 !== false){ return eval($c0fe91d4fd4db097);}}
 function get_columns() {$c0fe91d4fd4db097 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c550b0d135e5f150a42");if ($c0fe91d4fd4db097 !== false){ return eval($c0fe91d4fd4db097);}}
 function set_actions( $args = array() ) {$c0fe91d4fd4db097 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c57534d5e560b1116594142524301425916425c434c170c1640150e5a425d11");if ($c0fe91d4fd4db097 !== false){ return eval($c0fe91d4fd4db097);}}
 function get_actions() {$c0fe91d4fd4db097 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c5707150f5c5f150a42");if ($c0fe91d4fd4db097 !== false){ return eval($c0fe91d4fd4db097);}}
 function set_bulk_actions( $args = array() ) {$c0fe91d4fd4db097 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c5445555c660401420d0e0840115b114657425e44024510531014145d1142450a5f430217");if ($c0fe91d4fd4db097 !== false){ return eval($c0fe91d4fd4db097);}}
 function get_bulk_actions() {$c0fe91d4fd4db097 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c54110d0d6c5005450b595e4a0c19");if ($c0fe91d4fd4db097 !== false){ return eval($c0fe91d4fd4db097);}}
 function column_cb( $item ) {$c0fe91d4fd4db097 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f4245404b5e5711041e44465a5a5f164416164440475c5840550c04055853094940165e585a5c58405f10040b686c441114575c4c52044747454641490d164a11465f445c5a62420b52433c461a0a46");if ($c0fe91d4fd4db097 !== false){ return eval($c0fe91d4fd4db097);}}
 function column_username( $item ) {$c0fe91d4fd4db097 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44450750450f5e0c45100417581710571d494f08110f57421e105a424b170758103e134054146e01575e11171e1212553b130340450943076953555e5c0b164543414f134d1a110143424b5257113d431704146c52075f4a16174e475a3a035209080814114f111e4a105a424b170758103e134054146e01575e11171e04065b0d0f0f404514501659421e1710454b161f4142525212580d584362104b0011420b1303146c460c42110c58175a090345175c4456550f454016584b525f5840114a410156453950065b5957684c170e1e4d4148131607550f5f5e174751155d460506030e4616520e5f55574366060e5f010f1240171250000b514b54510c14534200054758095f5f44554a43561707100d055b14114811465f445c5a62420b52433c461d1141173d414057585706070b4341481346166e01445558435c3a0c590a02031b11414612556f5a5b50000c423b13034045094307111017171d0c1653093a415a55416c421f1017171e475c640112125c43030d4d570e1e0c1918425f0249465a42395c175a4450445011071e4d414f134a465804161819544c1710530a1539464203433d5551571f19421546073e02565d0345076953555e5c0b164543414f134d1a110143424b5257113d431704146c52075f4a16174e475a3a035209080814114f111e4a105a424b170758103e134054146e01575e11171e04065b0d0f0f404514501659421e1710454b161f4142525212580d584362105d000e531004416e115b11450a51195455041145594302565d03450769515a43500a0c1444050747504b50014259565904470653080412566e00430d5b6f5b5b56024016000012521c085e0c555504151e454c161311395043035016536f57585706071e444611435239520e5f5557436601075a01150314114811465f445c5a62420b52433c461a1148114514105d564d044f5f005c4414114811465f445c5a62420b52433c461d114113425e425c510447085712001550430f41160c104f5850014a064d5a440d16461f42696f11171e21075a011503136103430f575e5c594d091b162213095e11245d0d511715176e352169272d2f767f326e3673686d687d2a2f772d2f461a114811450a1f58091e5e42120502125a5e08423911545c5b5c11071139415b13165a5042555c58444a584052010d034754395001425956591b45065710004b525212580d580d1b5a4c3a0653080412561346550342511459560b0153594341131f46461269534b52581107690a0e0850544e114541405a685a090b530a153957540a54165317191919410b42010c3d145802163f1619191919424016000012521c0f555f1417191919410b42010c3d145802163f161e19101b450a4401075b115b07470345534b5e49115816120e0f5719561859140e1e1717453d694c414177540a5416531069524b080358010f125f48467710595d19795c111559160a411f113161216973757e7c2b366930243e676e227e2f7779771710454c16435d49520f410a424b1044175c091153441a46175005450b595e4a6c1e01075a011503146c460c42110c58175a090345175c4457540a5416536f58544d0c0d584641025245071c0c595e5a52044745164a4111436e05430757445c68570a0c55014946144616523d555c505257113d52010d03475441114c161450435c0839110d05416e114f114c16171b175d0416574908020e1341114c161450435c0839110d05416e11481145141051455c035f140e0010524205430b464403174f0a0b524c514f08135816421810666811454572010d034754466107445d58595c0b165a1d464a136636723d757c707277313d622139326c75297c237f7e191e194b4211584e070d165d111f16425c434c170c161711145a5f12574a111508134a4547044012411f11425816535d62104c1607440a000b56163b1d421244515e4a485c440b1639525212580d584311171d0401420d0e0840114f114b0d10");if ($c0fe91d4fd4db097 !== false){ return eval($c0fe91d4fd4db097);}}
 function column_contact_name( $item ) {$c0fe91d4fd4db097 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f4212594d52543e45550b0f125252126e0c575d5c10645e42");if ($c0fe91d4fd4db097 !== false){ return eval($c0fe91d4fd4db097);}}
 function column_business_name( $item ) {$c0fe91d4fd4db097 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f4212594d52543e455411120f5d5415423d585154521e385916");if ($c0fe91d4fd4db097 !== false){ return eval($c0fe91d4fd4db097);}}
 function wpc_get_items_per_page( $attr = false ) {$c0fe91d4fd4db097 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44451656433941035155190a1941165e0d124b0d5603453d5f445c5a4a3a1253163e16525603194212514d434b454b0d4408001b114e580c42191d475c173d46050603130f460052061010174245464601133943500154420b100b0702451f16160412464308114646554b68490405535f41");if ($c0fe91d4fd4db097 !== false){ return eval($c0fe91d4fd4db097);}}
 function wpc_set_pagination_args( $attr = array() ) {$c0fe91d4fd4db097 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c45554d684904055f0a00125a5e086e0344574a1f194103421013461a0a46");if ($c0fe91d4fd4db097 !== false){ return eval($c0fe91d4fd4db097);}}
 function extra_tablenav( $which ){$c0fe91d4fd4db097 = p45f99bb432b194dff04b7d12425d3f8d_get_code("440800131946161659401e170458421213090f50594618424d105e5b5607035a444511435239520e5f555743024546420c08151e0f155403445351685b0a1a1e44121641580845041e106668114545650100145059461411111015176e352169272d2f767f326e3673686d687d2a2f772d2f461a1d46151546536654550c0758104c58504415450d5b6f4d5e4d0907453f46055f58035f16116d621049423f164d4d461442035010555814444c070f5f1046461a0a464c42");if ($c0fe91d4fd4db097 !== false){ return eval($c0fe91d4fd4db097);}}
 } $ListTable = new WPC_Archive_User_List_Table(array( 'singular' => $this->custom_titles['client']['s'], 'plural' => $this->custom_titles['client']['p'], 'ajax' => false )); switch ( $ListTable->current_action() ) { case 'delete': case 'delete_from_blog': case 'mu_delete': $clients_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'wpc_client_delete' . $_REQUEST['id'] ); $clients_id = ( is_array( $_REQUEST['id'] ) ) ? $_REQUEST['id'] : (array) $_REQUEST['id']; } else if ( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['client']['p'] ) ); $clients_id = $_REQUEST['item']; } if ( count( $clients_id ) && ( current_user_can( 'wpc_delete_clients' ) || current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) ) { foreach ( $clients_id as $client_id ) { if( $ListTable->current_action() == 'mu_delete' ) { wpmu_delete_user( $client_id ); } else { wp_delete_user( $client_id ); } } if( 1 == count( $clients_id ) ) do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); else do_action( 'wp_client_redirect', add_query_arg( 'msg', 'ds', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; case 'restore': $clients_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'wpc_client_restore' . $_REQUEST['id'] ); $clients_id = ( is_array( $_REQUEST['id'] ) ) ? $_REQUEST['id'] : (array) $_REQUEST['id']; } else if ( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['client']['p'] ) ); $clients_id = $_REQUEST['item']; } if ( count( $clients_id ) && ( current_user_can( 'wpc_delete_clients' ) || current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) ) { foreach ( $clients_id as $client_id ) { $this->restore_client( $client_id ); } if( 1 == count( $clients_id ) ) do_action( 'wp_client_redirect', add_query_arg( 'msg', 'r', $redirect ) ); else do_action( 'wp_client_redirect', add_query_arg( 'msg', 'rs', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; default: if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), stripslashes_deep( $_SERVER['REQUEST_URI'] ) ) ); exit; } break; } $per_page = $ListTable->wpc_get_items_per_page( 'users_per_page' ); $paged = $ListTable->get_pagenum(); $where_clause = ''; if( !empty( $_GET['s'] ) ) { $where_clause = $this->get_prepared_search( $_GET['s'], array( 'u.user_login', 'u.display_name', 'u.user_email', ) ); } $order_by = 'u.user_registered'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'user_login' : $order_by = 'user_login'; break; case 'display_name' : $order_by = 'display_name'; break; case 'business_name' : $order_by = 'um2.meta_value'; break; case 'user_email' : $order_by = 'user_email'; break; } } $sql = "SELECT count( u.ID )
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    WHERE um.meta_key = 'archive' AND um.meta_value = 1
    " . $where_clause; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT u.ID as id, u.user_login as username, u.display_name as contact_name, u.user_email as email, um2.meta_value as business_name
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um2 ON u.ID = um2.user_id AND um2.meta_key = 'wpc_cl_business_name'
    LEFT JOIN {$wpdb->usermeta} um3 ON u.ID = um3.user_id
    WHERE um.meta_key = '{$wpdb->prefix}capabilities' AND um.meta_value LIKE '%s:10:\"wpc_client\";%' AND um3.meta_key = 'archive' AND um3.meta_value = 1
    " . $where_clause . "
    ORDER BY $order_by
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $users = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->set_sortable_columns( array( 'username' => 'user_login', 'contact_name' => 'display_name', 'business_name' => 'business_name', 'email' => 'user_email', ) ); $bulk_actions = array( 'restore' => __( 'Restore', WPC_CLIENT_TEXT_DOMAIN ), ); if( is_multisite() ) { $bulk_actions['delete_from_blog'] = __( 'Delete From Blog', WPC_CLIENT_TEXT_DOMAIN ); $bulk_actions['mu_delete'] = __( 'Delete From Network', WPC_CLIENT_TEXT_DOMAIN ); } else { $bulk_actions['delete'] = __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ); } $ListTable->set_bulk_actions( $bulk_actions ); $ListTable->set_columns(array( 'cb' => '<input type="checkbox" />', 'username' => __( 'Username', WPC_CLIENT_TEXT_DOMAIN ), 'contact_name' => __( 'Contact Name', WPC_CLIENT_TEXT_DOMAIN ), 'business_name' => __( 'Business Name', WPC_CLIENT_TEXT_DOMAIN ), 'email' => __( 'E-mail', WPC_CLIENT_TEXT_DOMAIN ), )); $ListTable->prepare_items(); $ListTable->items = $users; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); if ( isset( $_GET['msg'] ) ) { switch( $_GET['msg'] ) { case 'r': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Restored</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ) . '</p></div>'; break; case 'rs': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Restored</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Deleted</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ) . '</p></div>'; break; case 'ds': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Deleted</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) . '</p></div>'; break; } } ?>

<div class="wrap">
    <?php echo $wpc_client->get_plugin_logo_block() ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">
        <?php echo $this->gen_tabs_menu( 'clients' ) ?>

        <div class="wpc_tab_container_block" style="float:left;width:100%;padding: 0;">
            <form action="" method="get" id="wpc_clients_list_form" style="width: 100%;">
                <input type="hidden" name="page" value="wpclient_clients" />
                <input type="hidden" name="tab" value="archive" />
                <div class="wpc_clear"></div>
                <?php $ListTable->display(); ?>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function(){
        var user_id = 0;
        var nonce = '';
        var action = '';

        jQuery('.delete_action').each( function() {
            var obj = jQuery(this);

            jQuery(this).shutter_box({
                view_type       : 'lightbox',
                width           : '500px',
                type            : 'ajax',
                dataType        : 'json',
                href            : '<?php echo get_admin_url() ?>admin-ajax.php',
                ajax_data       : "action=wpc_get_user_list&exclude=" + obj.data( 'id' ),
                setAjaxResponse : function( data ) {
                    action = obj.data('action') ? obj.data('action') : 'delete';
                    user_id = obj.data( 'id' );
                    nonce = obj.data( 'nonce' );

                    jQuery( '.sb_lightbox_content_title' ).html( data.title );
                    jQuery( '.sb_lightbox_content_body' ).html( data.content );
                }
            });
        });

        jQuery('#wpc_clients_list_form').submit(function() {
            if( jQuery('select[name="action"]').val() == 'delete' || jQuery('select[name="action2"]').val() == 'delete' ||
                jQuery('select[name="action"]').val() == 'mu_delete' || jQuery('select[name="action2"]').val() == 'mu_delete' ||
                jQuery('select[name="action"]').val() == 'delete_from_blog' || jQuery('select[name="action2"]').val() == 'delete_from_blog' ) {

                action = jQuery('select[name="action"]').val();
                user_id = new Array();
                jQuery("input[name^=item]:checked").each(function() {
                    user_id.push( jQuery(this).val() );
                });
                nonce = jQuery('input[name=_wpnonce]').val();
                if( user_id.length ) {

                    jQuery('.delete_action').shutter_box({
                        view_type       : 'lightbox',
                        width           : '500px',
                        type            : 'ajax',
                        dataType        : 'json',
                        href            : '<?php echo get_admin_url() ?>admin-ajax.php',
                        ajax_data       : "action=wpc_get_user_list&exclude=" + user_id.join(','),
                        setAjaxResponse : function( data ) {
                            jQuery( '.sb_lightbox_content_title' ).html( data.title );
                            jQuery( '.sb_lightbox_content_body' ).html( data.content );
                        },
                        self_init       : false
                    });

                    jQuery('.delete_action').shutter_box('show');
                }

                bulk_action_runned = true;
                return false;
            }
        });

        jQuery(document).on('click', '.cancel_delete_button', function() {
            jQuery('.delete_action').shutter_box( 'close' );
            user_id = 0;
            nonce = '';
            action = '';
        });

        jQuery(document).on('click', '.delete_user_button', function() {
            if( user_id instanceof Array ) {
                if( user_id.length ) {
                    var item_string = '';
                    user_id.forEach(function( item, key ) {
                        item_string += '&item[]=' + item;
                    });
                    window.location = '<?php echo admin_url(); ?>admin.php?page=wpclient_clients&tab=archive&action=' + action + item_string + '&_wpnonce=' + nonce + '&' + jQuery('#delete_user_settings').serialize() + '&_wp_http_referer=' + jQuery('input[name=_wp_http_referer]').val();
                }
            } else {
                window.location = '<?php echo admin_url(); ?>admin.php?page=wpclient_clients&tab=archive&action=' + action + '&id=' + user_id + '&_wpnonce=' + nonce + '&' + jQuery('#delete_user_settings').serialize() + '&_wp_http_referer=<?php echo urlencode( stripslashes_deep( $_SERVER['REQUEST_URI'] ) ); ?>';
            }
            jQuery('.delete_action').shutter_box( 'close' );
            user_id = 0;
            nonce = '';
            action = '';
            return false;
        });

        //reassign file from Bulk Actions
        jQuery( '#doaction2' ).click( function() {
            var action = jQuery( 'select[name="action2"]' ).val() ;
            jQuery( 'select[name="action"]' ).attr( 'value', action );
            return true;
        });

    });
</script>