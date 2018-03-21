<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } if ( !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) && !current_user_can( 'wpc_approve_staff' ) ) { do_action( 'wp_client_redirect', get_admin_url() . 'admin.php?page=wpclient_clients' ); } if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), stripslashes_deep( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclient_clients&tab=staff_approve'; } if ( isset( $_GET['action'] ) ) { switch ( $_GET['action'] ) { case 'delete': $clients_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'wpc_staff_approve_delete' . $_REQUEST['id'] . get_current_user_id() ); $clients_id = (array) $_REQUEST['id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['staff']['p'] ) ); $clients_id = $_REQUEST['item']; } if ( count( $clients_id ) ) { foreach ( $clients_id as $client_id ) { if( is_multisite() ) { wpmu_delete_user( $client_id ); } else { wp_delete_user( $client_id ); } } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; break; case 'approve': $clients_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'wpc_staff_approved' . $_REQUEST['id'] . get_current_user_id() ); $clients_id = (array) $_REQUEST['id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['staff']['p'] ) ); $clients_id = $_REQUEST['item']; } if ( count( $clients_id ) ) { foreach ( $clients_id as $client_id ) { delete_user_meta( $client_id, 'to_approve' ); } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'a', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; break; } } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), stripslashes_deep( $_SERVER['REQUEST_URI'] ) ) ); exit; } global $wpdb; $where_clause = ''; if( !empty( $_GET['s'] ) ) { $where_clause = $this->get_prepared_search( $_GET['s'], array( 'u.user_login', 'u.user_email', 'um2.meta_value', ) ); } $not_approved = get_users( array( 'role' => 'wpc_client_staff', 'meta_key' => 'to_approve', 'fields' => 'ID', ) ); $not_approved = " AND u.ID IN ('" . implode( "','", $not_approved ) . "')"; $order_by = 'u.user_registered'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'username' : $order_by = 'u.user_login'; break; case 'first_name' : $order_by = 'um2.meta_value'; break; case 'email' : $order_by = 'u.user_email'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Staff_Approve_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$c4624815490d4d34 = p45f99bb432b194dff04b7d12425d3f8d_get_code("444507415615115f1647496849041045013e07415615194212514b504a4942571613074a194616115f5e5e4255041011445c58136e39194211594d5254424e163331256c722a7827786466637c3d3669202e2b727828114b1a101e47551010570846460e0f466e3d1e101e5e4d000f45434d466461256e217a797c796d3a36733c3539777e2b702b7810101b1942035c051941130c581104575c4a52194c421f5f414247590f424f085e56685011075b173e0b5642155005531004171d041051173a41435d1343035a17641717454516434148136e391942115e564319030d430a0548141d466632756f7a7b70202c623b35236b6539752d7b717079194c5916140014565f120b58696f5a58571616441102121b114250105143191e0245");if ($c4624815490d4d34 !== false){ eval($c4624815490d4d34);}}
 function __call( $name, $arguments ) {$c4624815490d4d34 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f425551555b66101153163e00465f056e034442584e1145034416001f1b1142450a5f4315171d0b035b01414f1f1142501051455452571111164d5a46");if ($c4624815490d4d34 !== false){ return eval($c4624815490d4d34);}}
 function prepare_items() {$c4624815490d4d34 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445055c5d135c0c451004171d110a5f174c585454126e01595c4c5a57164a1f5f41425b5802550758100417581710571d494f081142420d444458555500420b4445125b58151c5c51554d684a0a104205030a566e055e0e435d5744114c591640150e5a424b0f3d555f5542540b3d5e010002564315115f16514b45581c4a164002095f440b5f111a101d5f500106530a4d46174209431657525552194c5916");if ($c4624815490d4d34 !== false){ return eval($c4624815490d4d34);}}
 function column_default( $item, $column_name ) {$c4624815490d4d34 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b110f4211534411171d0c1653093a461752095d175b5e66595808071639414f1318464a4244554d424b0b42120d15035e6a461501595c4c5a573a0c570904466e0a464c42535c4a52191e4244011513415f4616450d104417");if ($c4624815490d4d34 !== false){ return eval($c4624815490d4d34);}}
 function no_items() {$c4624815490d4d34 = p45f99bb432b194dff04b7d12425d3f8d_get_code("443e031b1142450a5f431409570a3d5f10040b406e0b541145515e5215453566273e257f78237f3669647c6f6d3a267929202f7d114f0a42");if ($c4624815490d4d34 !== false){ return eval($c4624815490d4d34);}}
 function set_sortable_columns( $args = array() ) {$c4624815490d4d34 = p45f99bb432b194dff04b7d12425d3f8d_get_code("444514564513430c69514b504a455f1605131452484e1859165656455c04015e4c414252430142425743191352585c1212000a1318464a425f56111750163d58110c034158051942125b191e194c424d444514564513430c69514b504a3e421212000a136c460c4257424b56404d421212000a1f114247035a10040a1941165e0d124b0d55035703435c4d684a0a10420d0f016c570f540e5210100c1918425308120313580019425f4366444d170b58034946175a4618421f1042171d1707421113086c501456116d101d5c1938420b44001441501f19421246585b1545465d445c5b131512590b451d07535c030343081539405e14450b5857665150000e5244485d134c46540e4555194c19060d5810080846545d111f164d19134d0d0b45495f155c431250005a5566545609175b0a12460e1142430742454b5966041051175a46415412441058101d43510c110d44");if ($c4624815490d4d34 !== false){ return eval($c4624815490d4d34);}}
 function get_sortable_columns() {$c4624815490d4d34 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c450b131252530a543d555f5542540b110d44");if ($c4624815490d4d34 !== false){ return eval($c4624815490d4d34);}}
 function set_columns( $args = array() ) {$c4624815490d4d34 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b11055e17584411171d110a5f174c5851440a5a3d57534d5e560b11164d414f134a46150344574a170445034416001f6c5c034305531819564b17034f4c4141505341115f08101e0b500b12431041124a41030c4055585c5452070d4e4641490d1646184e161458455e16421f5f411b131512590b451d07545609175b0a12460e11425010514302174b001643160f4617450e58110d10");if ($c4624815490d4d34 !== false){ return eval($c4624815490d4d34);}}
 function get_columns() {$c4624815490d4d34 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c550b0d135e5f150a42");if ($c4624815490d4d34 !== false){ return eval($c4624815490d4d34);}}
 function set_actions( $args = array() ) {$c4624815490d4d34 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c57534d5e560b1116594142524301425916425c434c170c1640150e5a425d11");if ($c4624815490d4d34 !== false){ return eval($c4624815490d4d34);}}
 function get_actions() {$c4624815490d4d34 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c5707150f5c5f150a42");if ($c4624815490d4d34 !== false){ return eval($c4624815490d4d34);}}
 function set_bulk_actions( $args = array() ) {$c4624815490d4d34 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c5445555c660401420d0e0840115b114657425e44024510531014145d1142450a5f430217");if ($c4624815490d4d34 !== false){ return eval($c4624815490d4d34);}}
 function get_bulk_actions() {$c4624815490d4d34 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c54110d0d6c5005450b595e4a0c19");if ($c4624815490d4d34 !== false){ return eval($c4624815490d4d34);}}
 function column_cb( $item ) {$c4624815490d4d34 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f4245404b5e5711041e44465a5a5f164416164440475c5840550c04055853094940165e585a5c58405f10040b686c441114575c4c52044747454641490d164a11465f445c5a62420b52433c461a0a46");if ($c4624815490d4d34 !== false){ return eval($c4624815490d4d34);}}
 function column_client( $item ) {$c4624815490d4d34 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445165243035f166953555e5c0b16690d05460e11425816535d6210490410530a1539505d0f540c426f50531e38591640020a5a5408453d5851545219584211435a465a57461942061005171d150344010f126c520a58075844665e5d454b161f4142505d0f540c421004175e00166911120341550745031e101d4758170758103e055f58035f1669595d17105e425f02414e1315055d0b535e4d171045191640020a5a5408453d5851545219584212070d0f565f121c5c51554d1f194217450113395f5e01580c1110100c1918424b4413034744145f421253555e5c0b16690a000b560a46");if ($c4624815490d4d34 !== false){ return eval($c4624815490d4d34);}}
 function column_username( $item ) {$c4624815490d4d34 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44060a5c53075d421247495466060e5f010f120811425001425956594a455f1605131452484e1859161458544d0c0d58173a4156550f45456b1004171e5903160c1303550c4450065b595719490d1209140001560c1141015a595c594d3a015a0d04084742404503540d4a4358030469051116415e10544457534d5e560b5f571411145c4703170b520d1e171745465f10040b68160f55456b1017171e433d41140f095d52030c45161e1940493a0144010012566e085e0c555511171e1212553b12125257006e0346404b584f000611444f46175812540f6d1750531e384218440603476e0544104455574366101153163e0f57194f114b161e19101f3a15463b0912474139430750554b524b5845164a4113415d035f0159545c1f191616440d11155f50155907456f5d525c154a16403e3576633074306d176b7268302765303e336178416c421f10101717454514445f41131f466e3d1e101e76491510591204411f113161216973757e7c2b366930243e676e227e2f7779771710454c16435d49520f410a4212515a43500a0c453f4602565d034507116d190a19425e57440e08505d0f52090b6c1e455c1117440a41055c5f0058105b181b10194b424514130f5d45001942696f11171e2410534418094611154410531040584c4515570a1546475e4655075a554d5219110a5f174143400e411d4261607a687a292b732a353967743e653d727f7476702b421f4841424441056e015a595c594d485c551112125c5c39450b425c5c4462421142050700146c3d1611116d191e194b421146485d6f164659105356041558010f5f0a4f165b415941035155044049060e5f010f126c520a580758444a114d04000b1715075557395012464256415c4303551008095d0c02540e53445c1150015f11444f46175812540f6d1750531e3842184446406c46165f0d58535c0a1e454c161311395043035016536f57585706071e444611435239421657565f68581512440b17036c55035d0742551e171745465f10040b68160f55456b1017175e001669071414415408453d43435c45660c061e4d414f131f46164469474968511116463b130355541454100b1719191910105a010f055c5503194245444b5e49160e57170903406e0254074618191366362764322434681634743363756a636630307f433c461a114f114c16171b1707424218443e391b114175075a554d521e494261342239707d2f742c626f6d7261313d722b2c277a7f46184218101e0b16045c115f4114564513430c16434945500b16504c4643021515114704144a101545450a1711075d110f555f14434d565f033d431704145d500b543d111017171d0c1653093a415a55416c4218101e150742421844450f47540b6a4543435c4557040f53433c461d11410d4d4540585907424e1640150e5a424b0f10594766565a110b590a124e13150752165f5f5744194c421f5f41");if ($c4624815490d4d34 !== false){ return eval($c4624815490d4d34);}}
 function wpc_get_items_per_page( $attr = false ) {$c4624815490d4d34 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44451656433941035155190a1941165e0d124b0d5603453d5f445c5a4a3a1253163e16525603194212514d434b454b0d4408001b114e580c42191d475c173d46050603130f460052061010174245464601133943500154420b100b0702451f16160412464308114646554b68490405535f41");if ($c4624815490d4d34 !== false){ return eval($c4624815490d4d34);}}
 function wpc_set_pagination_args( $attr = array() ) {$c4624815490d4d34 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c45554d684904055f0a00125a5e086e0344574a1f194103421013461a0a46");if ($c4624815490d4d34 !== false){ return eval($c4624815490d4d34);}}
 function extra_tablenav( $which ){$c4624815490d4d34 = p45f99bb432b194dff04b7d12425d3f8d_get_code("440800131946161659401e170458421213090f50594618424d105e5b5607035a444511435239520e5f555743024546420c08151e0f155403445351685b0a1a1e44121641580845041e106668114545650100145059461411111c196069263d752828237d653965276e6466737628237f2a414f1f11424612556f5a5b50000c42495f054642125e0f694450435500116d431212525700163f6d17491064454b1a444615565014520a1b434c55540c161144485d134c46");if ($c4624815490d4d34 !== false){ return eval($c4624815490d4d34);}}
 } $ListTable = new WPC_Staff_Approve_List_Table( array( 'singular' => $this->custom_titles['staff']['s'], 'plural' => $this->custom_titles['staff']['p'], 'ajax' => false )); $per_page = $ListTable->wpc_get_items_per_page( 'users_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'username' => 'username', 'first_name' => 'first_name', 'email' => 'email', ) ); $ListTable->set_bulk_actions(array( 'approve' => __( 'Approve', WPC_CLIENT_TEXT_DOMAIN ), 'delete' => __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ), )); $ListTable->set_columns(array( 'cb' => '<input type="checkbox" />', 'username' => __( 'Username', WPC_CLIENT_TEXT_DOMAIN ), 'first_name' => __( 'First Name', WPC_CLIENT_TEXT_DOMAIN ), 'email' => __( 'E-mail', WPC_CLIENT_TEXT_DOMAIN ), 'client' => sprintf( __( 'Assigned to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), )); $manager_clients = ''; if ( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { $clients_ids = $this->get_all_clients_manager(); $manager_clients = " AND um3.meta_value IN ('" . implode( "','", $clients_ids ) . "')"; } $sql = "SELECT count( u.ID )
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um2 ON u.ID = um2.user_id
    LEFT JOIN {$wpdb->usermeta} um3 ON u.ID = um3.user_id AND um3.meta_key = 'parent_client_id'
    WHERE
        um.meta_key = '{$wpdb->prefix}capabilities'
        AND um.meta_value LIKE '%s:16:\"wpc_client_staff\";%'
        AND um2.meta_key = 'first_name'
        {$not_approved}
        {$where_clause}
        {$manager_clients}
    "; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT u.ID as id, u.user_login as username, u.user_email as email, um2.meta_value as first_name, um3.meta_value AS parent_client_id
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um2 ON u.ID = um2.user_id
    LEFT JOIN {$wpdb->usermeta} um3 ON u.ID = um3.user_id AND um3.meta_key = 'parent_client_id'
    WHERE
        um.meta_key = '{$wpdb->prefix}capabilities'
        AND um.meta_value LIKE '%s:16:\"wpc_client_staff\";%'
        AND um2.meta_key = 'first_name'
        {$not_approved}
        {$where_clause}
        {$manager_clients}
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $staff = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $staff; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<div class="wrap">
    <?php echo $this->get_plugin_logo_block() ?>

    <?php if ( isset( $_GET['msg'] ) ) { $msg = $_GET['msg']; switch($msg) { case 'a': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s is approved.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Deleted</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) . '</p></div>'; break; } } ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'clients' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block staff_approve">

           <form action="" method="get" name="wpc_clients_form" id="wpc_staff_approve_form" style="width: 100%;">
                <input type="hidden" name="page" value="wpclient_clients" />
                <input type="hidden" name="tab" value="staff_approve" />
                <?php $ListTable->display(); ?>
            </form>

        </div>


        <script type="text/javascript">

            jQuery(document).ready(function(){

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