<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } global $wpdb; if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), wp_unslash( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclient_clients&tab=admins'; } if ( isset( $_GET['action'] ) ) { switch ( $_GET['action'] ) { case 'delete': $admins_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'wpc_admin_delete' . $_REQUEST['id'] . get_current_user_id() ); $admins_id = (array)$_REQUEST['id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['admin']['p'] ) ); $admins_id = $_REQUEST['item']; } if ( count( $admins_id ) ) { foreach ( $admins_id as $admin_id ) { $admin_data = get_userdata( $admin_id ); $wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->prefix}wpc_client_login_redirects WHERE rul_value=%s", $admin_data->user_login ) ); if( is_multisite() ) { wpmu_delete_user( $admin_id ); } else { wp_delete_user( $admin_id ); } } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); break; case 'temp_password': $admins_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'admin_temp_password' . $_REQUEST['id'] . get_current_user_id() ); $admins_id = ( is_array( $_REQUEST['id'] ) ) ? $_REQUEST['id'] : (array) $_REQUEST['id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['admin']['p'] ) ); $admins_id = $_REQUEST['item']; } foreach ( $admins_id as $admin_id ) { $this->set_temp_password( $admin_id ); } if( 1 < count( $admins_id ) ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'pass_s', $redirect ) ); } else if( 1 === count( $admins_id ) ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'pass', $redirect ) ); } else { do_action( 'wp_client_redirect', $redirect ); } exit; case 'send_welcome': $admins_id = array(); if ( isset( $_REQUEST['user_id'] ) ) { check_admin_referer( 'wpc_re_send_welcome' . $_REQUEST['user_id'] . get_current_user_id() ); $admins_id = ( is_array( $_REQUEST['user_id'] ) ) ? $_REQUEST['user_id'] : (array) $_REQUEST['user_id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['admin']['p'] ) ); $admins_id = $_REQUEST['item']; } if ( count( $admins_id ) ) { foreach ( $admins_id as $admin_id ) { $this->resend_welcome_email( $admin_id ); } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'wel', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; break; } } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ); exit; } $where_clause = ''; if( !empty( $_GET['s'] ) ) { $where_clause = $this->get_prepared_search( $_GET['s'], array( 'u.user_login', 'u.user_nicename', 'u.user_email', ) ); } $order_by = 'u.user_registered'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'username' : $order_by = 'u.user_login'; break; case 'nickname' : $order_by = 'u.user_nicename'; break; case 'email' : $order_by = 'u.user_email'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Admins_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$cc3943491f27c764 = p45f99bb432b194dff04b7d12425d3f8d_get_code("444507415615115f1647496849041045013e07415615194212514b504a4942571613074a194616115f5e5e4255041011445c58136e39194211594d5254424e163331256c722a7827786466637c3d3669202e2b727828114b1a101e47551010570846460e0f466e3d1e101e5e4d000f45434d466461256e217a797c796d3a36733c3539777e2b702b7810101b1942035c051941130c581104575c4a52194c421f5f414247590f424f085e56685011075b173e0b5642155005531004171d041051173a41435d1343035a17641717454516434148136e391942115e564319030d430a0548141d466632756f7a7b70202c623b35236b6539752d7b717079194c5916140014565f120b58696f5a58571616441102121b114250105143191e0245");if ($cc3943491f27c764 !== false){ eval($cc3943491f27c764);}}
 function __call( $name, $arguments ) {$cc3943491f27c764 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f425551555b66101153163e00465f056e034442584e1145034416001f1b1142450a5f4315171d0b035b01414f1f1142501051455452571111164d5a46");if ($cc3943491f27c764 !== false){ return eval($cc3943491f27c764);}}
 function prepare_items() {$cc3943491f27c764 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445055c5d135c0c451004171d110a5f174c585454126e01595c4c5a57164a1f5f41425b5802550758100417581710571d494f081142420d444458555500420b4445125b58151c5c51554d684a0a104205030a566e055e0e435d5744114c591640150e5a424b0f3d555f5542540b3d5e010002564315115f16514b45581c4a164002095f440b5f111a101d5f500106530a4d46174209431657525552194c5916");if ($cc3943491f27c764 !== false){ return eval($cc3943491f27c764);}}
 function column_default( $item, $column_name ) {$cc3943491f27c764 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b110f4211534411171d0c1653093a461752095d175b5e66595808071639414f1318464a4244554d424b0b42120d15035e6a461501595c4c5a573a0c570904466e0a464c42535c4a52191e4244011513415f4616450d104417");if ($cc3943491f27c764 !== false){ return eval($cc3943491f27c764);}}
 function no_items() {$cc3943491f27c764 = p45f99bb432b194dff04b7d12425d3f8d_get_code("443e031b1142450a5f431409570a3d5f10040b406e0b541145515e5215453566273e257f78237f3669647c6f6d3a267929202f7d114f0a42");if ($cc3943491f27c764 !== false){ return eval($cc3943491f27c764);}}
 function set_sortable_columns( $args = array() ) {$cc3943491f27c764 = p45f99bb432b194dff04b7d12425d3f8d_get_code("444514564513430c69514b504a455f1605131452484e1859165656455c04015e4c414252430142425743191352585c1212000a1318464a425f56111750163d58110c034158051942125b191e194c424d444514564513430c69514b504a3e421212000a136c460c4257424b56404d421212000a1f114247035a10040a1941165e0d124b0d55035703435c4d684a0a10420d0f016c570f540e5210100c1918425308120313580019425f4366444d170b58034946175a4618421f1042171d1707421113086c501456116d101d5c1938420b44001441501f19421246585b1545465d445c5b131512590b451d07535c030343081539405e14450b5857665150000e5244485d134c46540e4555194c19060d5810080846545d111f164d19134d0d0b45495f155c431250005a5566545609175b0a12460e1142430742454b5966041051175a46415412441058101d43510c110d44");if ($cc3943491f27c764 !== false){ return eval($cc3943491f27c764);}}
 function get_sortable_columns() {$cc3943491f27c764 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c450b131252530a543d555f5542540b110d44");if ($cc3943491f27c764 !== false){ return eval($cc3943491f27c764);}}
 function set_columns( $args = array() ) {$cc3943491f27c764 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b11055e17584411171d110a5f174c5851440a5a3d57534d5e560b11164d414f134a46150344574a170445034416001f6c5c034305531819564b17034f4c4141505341115f08101e0b500b12431041124a41030c4055585c5452070d4e4641490d1646184e161458455e16421f5f411b131512590b451d07545609175b0a12460e11425010514302174b001643160f4617450e58110d10");if ($cc3943491f27c764 !== false){ return eval($cc3943491f27c764);}}
 function get_columns() {$cc3943491f27c764 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c550b0d135e5f150a42");if ($cc3943491f27c764 !== false){ return eval($cc3943491f27c764);}}
 function set_actions( $args = array() ) {$cc3943491f27c764 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c57534d5e560b1116594142524301425916425c434c170c1640150e5a425d11");if ($cc3943491f27c764 !== false){ return eval($cc3943491f27c764);}}
 function get_actions() {$cc3943491f27c764 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c5707150f5c5f150a42");if ($cc3943491f27c764 !== false){ return eval($cc3943491f27c764);}}
 function set_bulk_actions( $args = array() ) {$cc3943491f27c764 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c5445555c660401420d0e0840115b114657425e44024510531014145d1142450a5f430217");if ($cc3943491f27c764 !== false){ return eval($cc3943491f27c764);}}
 function get_bulk_actions() {$cc3943491f27c764 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c54110d0d6c5005450b595e4a0c19");if ($cc3943491f27c764 !== false){ return eval($cc3943491f27c764);}}
 function column_cb( $item ) {$cc3943491f27c764 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f4245404b5e5711041e44465a5a5f164416164440475c5840550c04055853094940165e585a5c58405f10040b686c441114575c4c52044747454641490d164a11465f445c5a62420b52433c461a0a46");if ($cc3943491f27c764 !== false){ return eval($cc3943491f27c764);}}
 function column_username( $item ) {$cc3943491f27c764 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44060a5c53075d421247495466060e5f010f120811425001425956594a455f1640090f5754395001425956594a455f1605131452484e1859161458544d0c0d58173a4156550f45456b1004171e5903160c1303550c4450065b595719490d1209140001560c1141015a595c594d3a015a0d04084742404503540d5853540c0c453b04025a454058060b17191919410b42010c3d145802163f161e19101b5b45164a41396c1946162752594d1015453566273e257f78237f3669647c6f6d3a267929202f7d114f1f42110c16560742591640090f5754395001425956594a3e454114023950501650005f5c504340423f165941410f50465910535604151a1212553b0207435004580e5f44401519010342054c0f570c44164218101d5e4d000f6d430802146c461f42116f1e1717450f52514946144616523d5754545e57424218443223706434743d77656d7f6636237a30414813150f45075b6b1e5e5d423f164d414813164411015a514a4404471457160809464239520346515b5e550c165f0112440d16461f42696f11171e2c0c520d170f5744075d42755149565b0c0e5f10080340164a113566736674752c2778303e327669326e26797d787e77454b164a41410f1e070f450d105051194d42170304126c44155410695d5c43584d42120d15035e6a415806116d15171e1212553b15035e4109430344496647581611410b1302141d4645104355191e194c424d44450e5a55036e0355445058571639111311056c45035c12694058444a120d4400463b130c46165e571056595a090b550f5c3a1443034517445e1954560b045f160c4e1116461f4245404b5e5711041e443e391b1141750d16495642191203581041125c110b50105d104d5f5c4512571712115c4302110345104d5254150d4405131f13570943424258504419401109434d466461256e217a797c796d3a36733c3539777e2b702b7810101b19411546073e055f58035f161b0e5a424a110d5b3b150f475d03423911515d5a500b456b3f4615146c46184218101e15105e3e114446461d114159105356041558010f5f0a4f165b415941035155044049060e5f010f126c520a580758444a114d04000b05050b5a5f1517035544505857581653091139435015421559425d1150015f11444f46175812540f6d1750531e3842184446406c46165f0d58535c0a1e454c161311395043035016536f57585706071e444607575c0f5f3d4255544766150345171609415541114c161450435c0839110d05416e11481105534466544c1710530a1539464203433d5f54111e194c4218434358141148113d691819106a001616340015404609430616514a176d000f460b13074148411d4261607a687a292b732a353967743e653d727f7476702b421f444f46140d49505c110b194a190c04164c41475a421554161e101d5e4d000f6d43150f5e54394307455557531e38421f441d1a131946150b4255546c1e110b5b013e145642035f06116d191c19565406544b5400114f115e1644505a5c4d4b164d411d13150e5806536f58544d0c0d58173a414441056e1053435c595d3a15530802095e54416c420b101e0b58450d58070d0f505a5b6d4544554d424b0b42550b0f005a430b194011101717663a4a1643201456111f5e1716434c455c451b59114111525f12111659106b5214360758004131565d055e0f53107c5a580c0e09434d466461256e217a797c796d3a36733c3539777e2b702b78101017174545144d5a3a14110e4307500d1b565d080b584a110e430e165005530d4e475a090b530a1539505d0f540c42431f4358075f57000c0f5d424050014259565904160758003e11565d055e0f53164c445c173d5f005c41131f46150b4255546c1e0c06113941481316406e15465e56595a005f11444f46444139521053514d52660b0d5807044e131611410169425c684a000c523b16035f52095c07111017171d0c1653093a415a55416c4218575c4366061744160408476e134207446f5053114c421f444f41110f41114c166f661f194230534932035d554666075a53565a5c45275b05080a141d466632756f7a7b70202c623b35236b6539752d7b717079194c421844465a1c50581659164d1952551607161f41425b5802543d57534d5e560b116d431616506e145411535e5d684e000e550b0c03146c460c42110c4a47580b42420d150a560c44164218104a474b0c0c420249466c6e4e11456151504319041059110f02131415110a59454b4419030d444413031e42035f0616594d191e494261342239707d2f742c626f6d7261313d722b2c277a7f46184e1642564257014a164c414e13150f45075b6b1e4350080769160415565f02163f161b19040f55521c5655461a114b11165f5d5c1f10454b164b4155050156114b1619191919424008434148136e39194211625c1a6a000c524436035f52095c07167554565009451a443636706e257d2b737e6d686d203a623b25297e702f7f421f1017171e594d451400080d165d111f1614515e5d003d5707150f5c5f156a45525555524d00456b445c46140d0711015a514a4404470653080412566e0752165f5f571519010342054c085c5f05545f14171919191212690713035245036e0c595e5a521145454114023952550b580c69545c5b5c110711444f46175812540f6d1750531e384218440603476e0544104455574366101153163e0f57194f114b161e19101b45065710004b5a555b1345161e19135011075b3f460f57163b114c16171b175117075059430c524707420144594943034514590d054e03185d135c11101717663a4a164325035f541254451a106e677a3a217a2d2428676e32743a626f7d7874242b784448461d11410d4d570e1e0c19410a5f000439525212580d5843190a1904124608183955580a4507444311171e1212553b020a5a5408453d5b5f4b52660401420d0e08406e07550f5f5e4a101545465e0d05036c5005450b595e4a17105e425f024946505e135f161e101d5f500107690502125a5e0842421f1010174245465707150f5c5f156a4541405a685806165f0b0f15146c460c421247495466060e5f010f121e0f0b5e10536f58544d0c0d58174946175812540f6d1750531e384e163b3e4e13162752165f5f57441e494261342239707d2f742c626f6d7261313d722b2c277a7f46184e1614515e5d003d5707150f5c5f15114b0d1044174b001643160f46404114580c425611101c5446454444541742411d42110c4a47580b425f005c4452550b580c69454a524b0b035b013e41131f46150b4255546c1e0c06113941481316440f45161e19135011075b3f46134054145f035b551e6a194b4211584e154350080f451a101d43510c111b5a1309446e0752165f5f57441145465707150f5c5f15114b16190217");if ($cc3943491f27c764 !== false){ return eval($cc3943491f27c764);}}
 function wpc_get_items_per_page( $attr = false ) {$cc3943491f27c764 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44451656433941035155190a1941165e0d124b0d5603453d5f445c5a4a3a1253163e16525603194212514d434b454b0d4408001b114e580c42191d475c173d46050603130f460052061010174245464601133943500154420b100b0702451f16160412464308114646554b68490405535f41");if ($cc3943491f27c764 !== false){ return eval($cc3943491f27c764);}}
 function wpc_set_pagination_args( $attr = array() ) {$cc3943491f27c764 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c45554d684904055f0a00125a5e086e0344574a1f194103421013461a0a46");if ($cc3943491f27c764 !== false){ return eval($cc3943491f27c764);}}
 function extra_tablenav( $which ){$cc3943491f27c764 = p45f99bb432b194dff04b7d12425d3f8d_get_code("440800131946161659401e170458421213090f50594618424d105e5b5607035a444511435239520e5f555743024546420c08151e0f155403445351685b0a1a1e44121641580845041e106668114545650100145059461411111c196069263d752828237d653965276e6466737628237f2a414f1f11424612556f5a5b50000c42495f054642125e0f694450435500116d4300025e5808163f6d17491064454b1a444615565014520a1b434c55540c161144485d134c46");if ($cc3943491f27c764 !== false){ return eval($cc3943491f27c764);}}
 } $ListTable = new WPC_Admins_List_Table( array( 'singular' => $this->custom_titles['admin']['s'], 'plural' => $this->custom_titles['admin']['p'], 'ajax' => false )); $per_page = $ListTable->wpc_get_items_per_page( 'users_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'username' => 'username', 'nickname' => 'nickname', 'email' => 'email', ) ); $ListTable->set_bulk_actions(array( 'temp_password' => __( 'Set Password as Temporary', WPC_CLIENT_TEXT_DOMAIN ), 'send_welcome' => __( 'Re-Send Welcome Email', WPC_CLIENT_TEXT_DOMAIN ), 'delete' => __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ), )); $ListTable->set_columns(array( 'cb' => '<input type="checkbox" />', 'username' => __( 'Username', WPC_CLIENT_TEXT_DOMAIN ), 'nickname' => __( 'Nickname', WPC_CLIENT_TEXT_DOMAIN ), 'email' => __( 'E-mail', WPC_CLIENT_TEXT_DOMAIN ), )); $sql = "SELECT count( u.ID )
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    WHERE
        um.meta_key = '{$wpdb->prefix}capabilities'
        AND um.meta_value LIKE '%s:9:\"wpc_admin\";%'
        {$where_clause}
    "; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT u.ID as id, u.user_login as username, u.user_nicename as nickname, u.user_email as email, um3.meta_value as time_resend
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um3 ON ( u.ID = um3.user_id AND um3.meta_key = 'wpc_send_welcome_email' )
    WHERE
        um.meta_key = '{$wpdb->prefix}capabilities'
        AND um.meta_value LIKE '%s:9:\"wpc_admin\";%'
        {$where_clause}
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $admins = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $admins; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<div class="wrap">
    <?php echo $this->get_plugin_logo_block() ?>

    <div class="wpc_clear"></div>

    <?php if ( isset( $_GET['msg'] ) ) { $msg = $_GET['msg']; switch( $msg ) { case 'a': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Added</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ) . '</p></div>'; break; case 'u': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Updated</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Deleted</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ) . '</p></div>'; break; case 'wel': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( 'Re-Sent Email for %s.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ) . '</p></div>'; break; case 'pass': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( 'The password marked as temporary for %s.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ) . '</p></div>'; break; case 'pass_s': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( 'The passwords marked as temporary for %s.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['p'] ) . '</p></div>'; break; } } ?>

    <div id="wpc_container">
        <?php echo $this->gen_tabs_menu( 'clients' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block">

            <div class="wpc_clear"></div>

            <a class="add-new-h2" href="admin.php?page=wpclient_clients&tab=admins_add"><?php _e( 'Add New', WPC_CLIENT_TEXT_DOMAIN ) ?></a>

            <form action="" method="get" name="wpc_clients_form" id="wpc_admins_form" style="width: 100%;">
                <input type="hidden" name="page" value="wpclient_clients" />
                <input type="hidden" name="tab" value="admins" />
                <?php $ListTable->display(); ?>
            </form>
        </div>
    </div>

    <script type="text/javascript">

        jQuery(document).ready( function() {
            var user_id = 0;
            var nonce = '';

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
                        user_id = obj.data( 'id' );
                        nonce = obj.data( 'nonce' );

                        jQuery( '.sb_lightbox_content_title' ).html( data.title );
                        jQuery( '.sb_lightbox_content_body' ).html( data.content );
                    }
                });
            });


            jQuery('#wpc_admins_form').submit(function() {
                if( jQuery('select[name="action"]').val() == 'delete' || jQuery('select[name="action2"]').val() == 'delete' ) {

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
            });

            jQuery(document).on('click', '.delete_user_button', function() {
                if( user_id instanceof Array ) {
                    if( user_id.length ) {
                        var item_string = '';
                        user_id.forEach(function( item, key ) {
                            item_string += '&item[]=' + item;
                        });
                        window.location = '<?php echo admin_url(); ?>admin.php?page=wpclient_clients&tab=admins&action=delete' + item_string + '&_wpnonce=' + nonce + '&' + jQuery('#delete_user_settings').serialize() + '&_wp_http_referer=' + jQuery('input[name=_wp_http_referer]').val();
                    }
                } else {
                    window.location = '<?php echo admin_url(); ?>admin.php?page=wpclient_clients&tab=admins&action=delete&id=' + user_id + '&_wpnonce=' + nonce + '&' + jQuery('#delete_user_settings').serialize() + '&_wp_http_referer=<?php echo urlencode( stripslashes_deep( $_SERVER['REQUEST_URI'] ) ); ?>';
                }
                jQuery('.delete_action').shutter_box( 'close' );
                user_id = 0;
                nonce = '';
                return false;
            });

            //reassign file from Bulk Actions
            jQuery( '#doaction2' ).click( function() {
                var action = jQuery( 'select[name="action2"]' ).val() ;
                jQuery( 'select[name="action"]' ).attr( 'value', action );

                return true;
            });


            //display client capabilities
            jQuery('.various_capabilities').each( function() {
                var id = jQuery( this ).data( 'id' );

                jQuery(this).shutter_box({
                    view_type       : 'lightbox',
                    width           : '300px',
                    type            : 'ajax',
                    dataType        : 'json',
                    href            : '<?php echo get_admin_url() ?>admin-ajax.php',
                    ajax_data       : "action=wpc_get_user_capabilities&id=" + id + "&wpc_role=wpc_admin",
                    setAjaxResponse : function( data ) {
                        jQuery( '.sb_lightbox_content_title' ).html( data.title );
                        jQuery( '.sb_lightbox_content_body' ).html( data.content );
                    }
                });
            });


            // AJAX - Update Capabilities
            jQuery('body').on('click', '#update_wpc_capabilities', function () {
                var id = jQuery('#wpc_capability_id').val();
                var caps = {};

                jQuery('#wpc_all_capabilities input').each(function () {
                    if ( jQuery(this).is(':checked') )
                        caps[jQuery(this).attr('name')] = jQuery(this).val();
                    else
                        caps[jQuery(this).attr('name')] = '';
                });

                var notice = jQuery( '.wpc_ajax_result' );

                notice.html('<div class="wpc_ajax_loading"></div>').show();
                jQuery( 'body' ).css( 'cursor', 'wait' );
                jQuery.ajax({
                    type: 'POST',
                    url: '<?php echo get_admin_url() ?>admin-ajax.php',
                    data: 'action=wpc_update_capabilities&id=' + id + '&wpc_role=wpc_admin&capabilities=' + JSON.stringify(caps),
                    dataType: "json",
                    success: function (data) {
                        jQuery('body').css('cursor', 'default');

                        if (data.status) {
                            notice.css('color', 'green');
                        } else {
                            notice.css('color', 'red');
                        }
                        notice.html(data.message);
                        setTimeout(function () {
                            notice.fadeOut(1500);
                        }, 2500);

                    },
                    error: function (data) {
                        notice.css('color', 'red').html('<?php echo esc_js( __( 'Unknown error.', WPC_CLIENT_TEXT_DOMAIN ) ) ?>');
                        setTimeout(function () {
                            notice.fadeOut(1500);
                        }, 2500);
                    }
                });
            });
        });
    </script>

</div>