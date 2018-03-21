<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } if ( !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) && !current_user_can( 'wpc_approve_clients' ) ) { do_action( 'wp_client_redirect', get_admin_url() . 'admin.php?page=wpclient_clients' ); } if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), stripslashes_deep( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclient_clients&tab=approve'; } if ( isset( $_GET['action'] ) ) { switch ( $_GET['action'] ) { case 'delete': $clients_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'wpc_client_delete' . $_REQUEST['id'] . get_current_user_id() ); $clients_id = (array) $_REQUEST['id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['client']['p'] ) ); $clients_id = $_REQUEST['item']; } if ( count( $clients_id ) ) { foreach ( $clients_id as $client_id ) { if( is_multisite() ) { wpmu_delete_user( $client_id ); } else { wp_delete_user( $client_id ); } } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; break; } } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), stripslashes_deep( $_SERVER['REQUEST_URI'] ) ) ); exit; } global $wpdb; $where_clause = ''; if( !empty( $_GET['s'] ) ) { $where_clause = $this->get_prepared_search( $_GET['s'], array( 'u.user_login', 'u.display_name', 'um.meta_value', 'u.user_email', ) ); } $not_approved = get_users( array( 'role' => 'wpc_client', 'meta_key' => 'to_approve', 'fields' => 'ID', ) ); $not_approved = " AND u.ID IN ('" . implode( "','", $not_approved ) . "')"; $order_by = 'u.user_registered'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'user_login' : $order_by = 'user_login'; break; case 'display_name' : $order_by = 'display_name'; break; case 'business_name' : $order_by = 'um.meta_value'; break; case 'user_email' : $order_by = 'user_email'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Clients_Approve_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$c45eaf7ce484f952 = p45f99bb432b194dff04b7d12425d3f8d_get_code("444507415615115f1647496849041045013e07415615194212514b504a4942571613074a194616115f5e5e4255041011445c58136e39194211594d5254424e163331256c722a7827786466637c3d3669202e2b727828114b1a101e47551010570846460e0f466e3d1e101e5e4d000f45434d466461256e217a797c796d3a36733c3539777e2b702b7810101b1942035c051941130c581104575c4a52194c421f5f414247590f424f085e56685011075b173e0b5642155005531004171d041051173a41435d1343035a17641717454516434148136e391942115e564319030d430a0548141d466632756f7a7b70202c623b35236b6539752d7b717079194c5916140014565f120b58696f5a58571616441102121b114250105143191e0245");if ($c45eaf7ce484f952 !== false){ eval($c45eaf7ce484f952);}}
 function __call( $name, $arguments ) {$c45eaf7ce484f952 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f425551555b66101153163e00465f056e034442584e1145034416001f1b1142450a5f4315171d0b035b01414f1f1142501051455452571111164d5a46");if ($c45eaf7ce484f952 !== false){ return eval($c45eaf7ce484f952);}}
 function prepare_items() {$c45eaf7ce484f952 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445055c5d135c0c451004171d110a5f174c585454126e01595c4c5a57164a1f5f41425b5802550758100417581710571d494f081142420d444458555500420b4445125b58151c5c51554d684a0a104205030a566e055e0e435d5744114c591640150e5a424b0f3d555f5542540b3d5e010002564315115f16514b45581c4a164002095f440b5f111a101d5f500106530a4d46174209431657525552194c5916");if ($c45eaf7ce484f952 !== false){ return eval($c45eaf7ce484f952);}}
 function column_default( $item, $column_name ) {$c45eaf7ce484f952 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b110f4211534411171d0c1653093a461752095d175b5e66595808071639414f1318464a4244554d424b0b42120d15035e6a461501595c4c5a573a0c570904466e0a464c42535c4a52191e4244011513415f4616450d104417");if ($c45eaf7ce484f952 !== false){ return eval($c45eaf7ce484f952);}}
 function no_items() {$c45eaf7ce484f952 = p45f99bb432b194dff04b7d12425d3f8d_get_code("443e031b1142450a5f431409570a3d5f10040b406e0b541145515e5215453566273e257f78237f3669647c6f6d3a267929202f7d114f0a42");if ($c45eaf7ce484f952 !== false){ return eval($c45eaf7ce484f952);}}
 function set_sortable_columns( $args = array() ) {$c45eaf7ce484f952 = p45f99bb432b194dff04b7d12425d3f8d_get_code("444514564513430c69514b504a455f1605131452484e1859165656455c04015e4c414252430142425743191352585c1212000a1318464a425f56111750163d58110c034158051942125b191e194c424d444514564513430c69514b504a3e421212000a136c460c4257424b56404d421212000a1f114247035a10040a1941165e0d124b0d55035703435c4d684a0a10420d0f016c570f540e5210100c1918425308120313580019425f4366444d170b58034946175a4618421f1042171d1707421113086c501456116d101d5c1938420b44001441501f19421246585b1545465d445c5b131512590b451d07535c030343081539405e14450b5857665150000e5244485d134c46540e4555194c19060d5810080846545d111f164d19134d0d0b45495f155c431250005a5566545609175b0a12460e1142430742454b5966041051175a46415412441058101d43510c110d44");if ($c45eaf7ce484f952 !== false){ return eval($c45eaf7ce484f952);}}
 function get_sortable_columns() {$c45eaf7ce484f952 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c450b131252530a543d555f5542540b110d44");if ($c45eaf7ce484f952 !== false){ return eval($c45eaf7ce484f952);}}
 function set_columns( $args = array() ) {$c45eaf7ce484f952 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b11055e17584411171d110a5f174c5851440a5a3d57534d5e560b11164d414f134a46150344574a170445034416001f6c5c034305531819564b17034f4c4141505341115f08101e0b500b12431041124a41030c4055585c5452070d4e4641490d1646184e161458455e16421f5f411b131512590b451d07545609175b0a12460e11425010514302174b001643160f4617450e58110d10");if ($c45eaf7ce484f952 !== false){ return eval($c45eaf7ce484f952);}}
 function get_columns() {$c45eaf7ce484f952 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c550b0d135e5f150a42");if ($c45eaf7ce484f952 !== false){ return eval($c45eaf7ce484f952);}}
 function set_actions( $args = array() ) {$c45eaf7ce484f952 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c57534d5e560b1116594142524301425916425c434c170c1640150e5a425d11");if ($c45eaf7ce484f952 !== false){ return eval($c45eaf7ce484f952);}}
 function get_actions() {$c45eaf7ce484f952 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c5707150f5c5f150a42");if ($c45eaf7ce484f952 !== false){ return eval($c45eaf7ce484f952);}}
 function set_bulk_actions( $args = array() ) {$c45eaf7ce484f952 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c5445555c660401420d0e0840115b114657425e44024510531014145d1142450a5f430217");if ($c45eaf7ce484f952 !== false){ return eval($c45eaf7ce484f952);}}
 function get_bulk_actions() {$c45eaf7ce484f952 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c54110d0d6c5005450b595e4a0c19");if ($c45eaf7ce484f952 !== false){ return eval($c45eaf7ce484f952);}}
 function column_cb( $item ) {$c45eaf7ce484f952 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f4245404b5e5711041e44465a5a5f164416164440475c5840550c04055853094940165e585a5c58405f10040b686c441114575c4c52044747454641490d164a11465f445c5a62420b52433c461a0a46");if ($c45eaf7ce484f952 !== false){ return eval($c45eaf7ce484f952);}}
 function column_username( $item ) {$c45eaf7ce484f952 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44060a5c53075d421247495466060e5f010f120811425001425956594a455f1605131452484e1859161458544d0c0d58173a4156550f45456b1004171e5903160b0f055f58055a5f145a68425c171b1e10090f401848560742774b584c15111e43414813150f45075b6b1e5e5d423f164a41411a0a44110a44555f0a1b464008434148136e391942117149474b0a1453434d466461256e217a797c796d3a36733c3539777e2b702b781010171745450a4b0058140a465804161819544c1710530a1539464203433d5551571f19421546073e105a54116e015a595c594d3a065310000f5f4241114b164c45175a101044010f126c44155410695358591145454114023952550b580c1110101745194255111314565f126e1745554b685a040c1e444607575c0f5f0b45444b564d0a10114448461a111d114657534d5e560b116d43170f5646416c420b101e0b58450a4401075b1112105807416f5a5b50000c42464114565d5b1345161e19135011075b3f460f57163b114c16176610194b425b00544e1316114101555c50525711145f01163914114811465f445c5a62420b52433c461a1148114514105a5b5816110b461707415809441114100710194b42693b494614670f5415111c196069263d752828237d653965276e6466737628237f2a414f1d11410d4d570e1e0c191842120502125a5e08423911545c5b5c11071139415b13165a5042595e5a5b5006090b384614564513430c165356595f0c105b4c4341131f464212445957435f4d42693b494614701454424f5f4c174a101053441809461111500c42104d581901075a01150313450e581116154a081e494261342239707d2f742c626f6d7261313d722b2c277a7f46184e16144e475a3a015a0d0408471c5852174544565a66110b420804156816055d0b535e4d10643e4545433c461a114811451419026b1e450a4401075b1150025c0b581e495f495a125703045b4441055d0b535e4d685a090b530a1515154507535f57404945561307100502125a5e080c06535c5c435c430b525946461d11425816535d62105001456b444f461417394612585f57545c5845164a4111436e05430757445c68570a0c55014946144616523d555c505257113d52010d03475441114c161450435c0839110d05416e11481105534466544c1710530a1539464203433d5f54111e194c42184446406c46166e0a424449684b0004531604140e16461f424342555257060d52014946444139440c455c5844514d42123b3223616723633911627c666c2031623b34347a163b114b16191919194240165a46461d11396e4a16177d5255001653434d466461256e217a797c796d3a36733c3539777e2b702b781010171745450a4b0058140a46430742454b59191612440d0f125519411453124319120b4111114841410f4216500c16595d0a1b101153160f075e5439164218101d5e4d000f6d430802146c461f4211120710194b42120d15035e6a414411534257565400456b444f46140d494212575e0710154546420c08151e0f145e1569515a43500a0c454c4142525212580d5843191e194c5916");if ($c45eaf7ce484f952 !== false){ return eval($c45eaf7ce484f952);}}
 function wpc_get_items_per_page( $attr = false ) {$c45eaf7ce484f952 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44451656433941035155190a1941165e0d124b0d5603453d5f445c5a4a3a1253163e16525603194212514d434b454b0d4408001b114e580c42191d475c173d46050603130f460052061010174245464601133943500154420b100b0702451f16160412464308114646554b68490405535f41");if ($c45eaf7ce484f952 !== false){ return eval($c45eaf7ce484f952);}}
 function wpc_set_pagination_args( $attr = array() ) {$c45eaf7ce484f952 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c45554d684904055f0a00125a5e086e0344574a1f194103421013461a0a46");if ($c45eaf7ce484f952 !== false){ return eval($c45eaf7ce484f952);}}
 function extra_tablenav( $which ){$c45eaf7ce484f952 = p45f99bb432b194dff04b7d12425d3f8d_get_code("440800131946161659401e170458421213090f50594618424d105e5b5607035a444511435239520e5f555743024546420c08151e0f155403445351685b0a1a1e44121641580845041e106668114545650100145059461411111c196069263d752828237d653965276e6466737628237f2a414f1f11424612556f5a5b50000c42495f054642125e0f694450435500116d43020a5a540845456b6b1e471e38421f48414140540743015e1d4a425b080b4243414f08111b11");if ($c45eaf7ce484f952 !== false){ return eval($c45eaf7ce484f952);}}
 } $ListTable = new WPC_Clients_Approve_List_Table( array( 'singular' => $this->custom_titles['client']['s'], 'plural' => $this->custom_titles['client']['p'], 'ajax' => false )); $per_page = $ListTable->wpc_get_items_per_page( 'users_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'username' => 'user_login', 'contact_name' => 'display_name', 'business_name' => 'business_name', 'email' => 'user_email', ) ); $ListTable->set_bulk_actions(array( 'approve' => 'Approve', 'delete' => 'Delete', )); $ListTable->set_columns(array( 'cb' => '<input type="checkbox" />', 'username' => __( 'Username', WPC_CLIENT_TEXT_DOMAIN ), 'contact_name' => __( 'Contact Name', WPC_CLIENT_TEXT_DOMAIN ), 'business_name' => __( 'Business Name', WPC_CLIENT_TEXT_DOMAIN ), 'email' => __( 'E-mail', WPC_CLIENT_TEXT_DOMAIN ), )); $sql = "SELECT count( u.ID )
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um2 ON u.ID = um2.user_id
    WHERE
        um2.meta_key = '{$wpdb->prefix}capabilities'
        AND um2.meta_value LIKE '%s:10:\"wpc_client\";%'
        AND um.meta_key = 'wpc_cl_business_name'
        {$not_approved}
        {$where_clause}
    "; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT u.ID as id, u.user_login as username, u.display_name as contact_name, u.user_email as email, um.meta_value as business_name
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um2 ON u.ID = um2.user_id
    WHERE
        um2.meta_key = '{$wpdb->prefix}capabilities'
        AND um2.meta_value LIKE '%s:10:\"wpc_client\";%'
        AND um.meta_key = 'wpc_cl_business_name'
        {$not_approved}
        {$where_clause}
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $clients = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $clients; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>

    <?php
 if (isset($_GET['msg'])) { $msg = $_GET['msg']; switch($msg) { case 'a': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s is approved.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Deleted</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ) . '</p></div>'; break; } } ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'clients' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block" style="float:left;width:100%;padding: 0;">

            <form action="" method="get" name="wpc_clients_form" id="wpc_clients_approve_form" style="width: 100%;">
                <input type="hidden" name="page" value="wpclient_clients" />
                <input type="hidden" name="tab" value="approve" />
                <?php $ListTable->display(); ?>
            </form>


            <div id="opaco"></div>
            <div id="opaco2"></div>

            <div id="popup_block" style="width: auto; left: 35%;">
                <form name="approve_client" method="post" >
                    <input type="hidden" name="wpc_action" value="client_approve" />
                    <input type="hidden" name="client_id" id="client_id" value="" />
                    <input type="hidden" value="<?php echo wp_create_nonce( 'wpc_client_approve' ) ?>" name="_wpnonce" id="_wpnonce">

                    <h3 id="assign_name"></h3>

                    <table>
                        <?php
 $args = array( 'role' => 'wpc_manager', 'orderby' => 'user_login', 'order' => 'ASC', 'fields' => array( 'ID','user_login' ), ); $managers = get_users( $args ); if ( is_array( $managers ) && 0 < count( $managers ) ) { ?>
                            <tr>
                                <td>
                                    <?php
 $link_array = array( 'title' => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['p'] ), 'text' => sprintf( __( 'Assign To %s %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['manager']['p'] ) ); $input_array = array( 'name' => 'wpc_managers', 'id' => 'wpc_managers', 'value' => '' ); $additional_array = array( 'counter_value' => 0 ); $current_page = isset( $_GET['page'] ) ? $_GET['page'] : ''; $this->acc_assign_popup('manager', isset( $current_page ) ? $current_page : '', $link_array, $input_array, $additional_array ); ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td>
                                <?php
 $groups = $this->cc_get_groups(); $selected_groups = array(); foreach ( $groups as $group ) { if( '1' == $group['auto_select'] ) { $selected_groups[] = $group['group_id']; } } $link_array = array( 'title' => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['p'] ), 'text' => sprintf( __( 'Assign To %s %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['circle']['p'] ) ); $input_array = array( 'name' => 'wpc_circles', 'id' => 'wpc_circles', 'value' => implode(',', $selected_groups) ); $additional_array = array( 'counter_value' => count( $selected_groups ) ); $current_page = isset( $_GET['page'] ) ? $_GET['page'] : ''; $this->acc_assign_popup('circle', isset( $current_page ) ? $current_page : '', $link_array, $input_array, $additional_array ); ?>
                            </td>
                        </tr>
                        <tr style="height:15px;"><td>&nbsp;</td></tr>
                        <tr>
                            <td>
                                <input type="submit" name="save" id="save_popup" value="<?php _e( 'Approve', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
                                <input type="button" name="cancel" id="cancel_popup" value="<?php _e( 'Cancel', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
                            </td>
                        </tr>
                    </table>
                </form>
            </div>

            <?php if ( current_user_can( 'wpc_view_client_details' ) || current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) { ?>
            <div id="view_client" style="display: none;">
                <div id="wpc_client_details_content"></div>
            </div>
            <?php } ?>



        </div>


        <script type="text/javascript">
            jQuery(document).ready(function(){

                jQuery( '#doaction' ).click( function() {
                    var action = jQuery(this).parent().find('select[name=action]').val() ;
                    if( action == 'approve' ) {
                        var items = new Array();
                        jQuery('input[name="item[]"]:checked').each( function() {
                            items.push( jQuery( this ).val() );
                        });

                        jQuery(this).getGroups( items );
                    } else {
                        return true;
                    }
                    return false;
                });


                jQuery( '#doaction2' ).click( function() {
                    var action = jQuery(this).parent().find('select[name=action2]').val() ;
                    if( action == 'approve' ) {
                        var items = new Array();
                        jQuery('input[name="item[]"]:checked').each( function() {
                            items.push( jQuery( this ).val() );
                        });

                        jQuery(this).getGroups( items );
                    } else {
                        jQuery( 'select[name="action"]' ).attr( 'value', action );
                        return true;
                    }
                    return false;
                });

                // AJAX - assign Client Circles to client
                jQuery.fn.getGroups = function ( client_id ) {
                    var assign_name = '<?php echo esc_js( sprintf( __( 'Approve the %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ) ) ?>: ' + jQuery( '#username_' + client_id ).html();

                    if( jQuery.isArray( client_id ) ) {
                        client_id = client_id.join(',');
                        assign_name = '<?php echo esc_js( sprintf( __( 'Approve selected %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) ) ?>';
                    }

                    jQuery( '#popup_content' ).html( '' );
                    jQuery( '#select_all' ).parent().hide();
                    jQuery( '#admin_manager :first' ).attr( 'selected', 'selected' );
                    jQuery( '#select_all' ).attr( 'checked', false );
                    jQuery( '#save_popup' ).hide();
                    jQuery( '#client_id' ).val( client_id );
                    jQuery( '#assign_name' ).html( assign_name );
                    jQuery( 'body' ).css( 'cursor', 'wait' );
                    jQuery( '#opaco' ).fadeIn( 'slow' );
                    jQuery( '#popup_block' ).fadeIn( 'slow' );

                    jQuery.ajax({
                        type: 'POST',
                        url: '<?php echo get_admin_url() ?>admin-ajax.php',
                        data: 'action=get_all_groups',
                        success: function( html ){
                            jQuery( 'body' ).css( 'cursor', 'default' );
                            if ( 'false' == html ) {
                                jQuery( '#save_popup' ).show();
                            } else {
                                jQuery( '#save_popup' ).show();
                            }
                        }
                     });
                };


                //Cancel Assign block
                jQuery( "#cancel_popup" ).click( function() {
                    jQuery( '#popup_block' ).fadeOut( 'fast' );
                    jQuery( '#opaco' ).fadeOut( 'fast' );
                });

                //Select/Un-select
                jQuery( "#select_all" ).change( function() {
                    if ( 'checked' == jQuery( this ).attr( 'checked' ) ) {
                        jQuery( '#popup_content input[type="checkbox"]' ).attr( 'checked', true );
                    } else {
                        jQuery( '#popup_content input[type="checkbox"]' ).attr( 'checked', false );
                    }
                });

                <?php if ( current_user_can( 'wpc_view_client_details' ) || current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) { ?>
                    //open view client
                    jQuery('.various').each( function() {
                        var id = jQuery( this ).attr( 'rel' );

                        jQuery(this).shutter_box({
                            view_type       : 'lightbox',
                            width           : '500px',
                            type            : 'ajax',
                            dataType        : 'json',
                            href            : '<?php echo get_admin_url() ?>admin-ajax.php',
                            ajax_data       : "action=wpc_view_client&id=" + id,
                            setAjaxResponse : function( data ) {
                                jQuery( '.sb_lightbox_content_title' ).html( data.title );
                                jQuery( '.sb_lightbox_content_body' ).html( data.content );
                            }
                        });
                    });
                <?php } ?>
            });
        </script>

    </div>
</div>