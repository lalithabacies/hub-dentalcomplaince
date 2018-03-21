<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } if ( !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) ) { do_action( 'wp_client_redirect', get_admin_url() . 'admin.php?page=wpclient_clients' ); } global $wpdb, $wp_roles, $role; $wpc_roles = array( 'wpc_client' => $this->custom_titles['client']['s'] . ' (WPC Client)', 'wpc_client_staff' => $this->custom_titles['staff']['s'] . ' (WPC Client Staff)', 'wpc_manager' => $this->custom_titles['manager']['s'] . ' (WPC Manager)', 'wpc_admin' => $this->custom_titles['admin']['s'] . ' (WPC Admin)' ); $wpc_roles = apply_filters( 'wpc_client_convertible_user_roles', $wpc_roles ); $exclude_roles = array_keys( $wpc_roles ); array_push( $exclude_roles, 'administrator' ); if ( isset( $_REQUEST['_wpnonce2'] ) && wp_verify_nonce( $_REQUEST['_wpnonce2'], 'wpc_convert_form' ) ) { if ( isset( $_REQUEST['convert_to'] ) && in_array( $_REQUEST['convert_to'], $exclude_roles ) ) { if ( isset( $_REQUEST['ids'] ) && is_array( $_REQUEST['ids'] ) && 0 < count( $_REQUEST['ids'] ) ) { $convert_to = $_REQUEST['convert_to']; $ids = $_REQUEST['ids']; switch( $convert_to ) { case 'wpc_client': foreach( $ids as $user_id ) { $user_object = new WP_User( $user_id ); if ( isset( $_REQUEST['save_role'] ) && 1 == $_REQUEST['save_role'] ) { $user_object->add_role( 'wpc_client' ); } else { update_user_meta( $user_id, $wpdb->prefix . 'capabilities', array( 'wpc_client' => '1' ) ); } $all_metafields = get_user_meta( $user_id, '', true ); $business_name = ''; if ( isset($_REQUEST['business_name_field'] ) && '' != trim( $_REQUEST['business_name_field'] ) ) { $business_name = $_REQUEST['business_name_field']; foreach( $all_metafields as $meta_key=>$meta_value ) { if ( isset( $all_metafields[$meta_key] ) && strpos( $_REQUEST['business_name_field'], '{' . $meta_key . '}' ) !== false ) { $metavalue = maybe_unserialize( $all_metafields[$meta_key][0] ); $metavalue = ( isset( $metavalue ) && !empty( $metavalue ) ) ? $metavalue : ''; $business_name = str_replace( '{' . $meta_key . '}', $metavalue, $business_name ); } } if( $business_name == $_REQUEST['business_name_field'] ) { $business_name = ''; } } if ( '' == $business_name ) { $first_name = get_user_meta( $user_id, 'first_name', true ); if ( '' != $first_name ) { $business_name = $first_name; } } if ( '' == $business_name ) { $business_name = $user_object->get( 'user_login' ); } update_user_meta( $user_id, 'wpc_cl_business_name', $business_name ); if ( isset( $_REQUEST['wpc_circles'] ) && is_string( $_REQUEST['wpc_circles'] ) && !empty( $_REQUEST['wpc_circles'] ) ) { if( $_REQUEST['wpc_circles'] == 'all' ) { $groups = $this->cc_get_group_ids(); } else { $groups = explode( ',', $_REQUEST['wpc_circles'] ); } foreach ( $groups as $group_id ) { $wpdb->query( $wpdb->prepare( "INSERT INTO {$wpdb->prefix}wpc_client_group_clients SET group_id = %d, client_id = '%d'", $group_id, $user_id ) ); } } update_user_option( $user_id, 'unqiue', md5( time() ) ); if ( isset( $_REQUEST['wpc_managers'] ) && '' != $_REQUEST['wpc_managers'] ) { $assign_data = array(); if( $_REQUEST['wpc_managers'] == 'all' ) { $args = array( 'role' => 'wpc_manager', 'orderby' => 'user_login', 'order' => 'ASC', 'fields' => array( 'ID' ), ); $_REQUEST['wpc_managers'] = get_users( $args ); foreach( $_REQUEST['wpc_managers'] as $key=>$value) { $assign_data[] = $value->ID; } } else { $assign_data = explode( ',', $_REQUEST['wpc_managers'] ); } $this->cc_set_reverse_assigned_data( 'manager', $assign_data, 'client', $user_id ); } $create_portal = false; if ( isset( $_REQUEST['create_client_page'] ) && 1 == $_REQUEST['create_client_page'] ) { $create_portal = true; } $args = array( 'client_id' => $user_id, 'business_name' => $business_name, ); $this->cc_create_hub_page( $args, $create_portal ); $user = get_userdata( $user_id ); if( !empty( $user->user_email ) ) { $args = array( 'client_id' => $user_id ); $this->cc_mail( 'convert_to_client', $user->user_email, $args, 'convert_to_wp_user' ); } } $msg = 'ac'; break; case 'wpc_client_staff': foreach( $ids as $user_id ) { if ( isset( $_REQUEST['save_role'] ) && 1 == $_REQUEST['save_role'] ) { $user_object = new WP_User( $user_id ); $user_object->add_role( 'wpc_client_staff' ); } else { update_user_meta( $user_id, $wpdb->prefix . 'capabilities', array( 'wpc_client_staff' => '1' ) ); } if ( isset( $_REQUEST['wpc_clients'] ) && 0 < $_REQUEST['wpc_clients'] ) { update_user_meta( $user_id, 'parent_client_id', $_REQUEST['wpc_clients'] ); } $user = get_userdata( $user_id ); if( !empty( $user->user_email ) ) { $args = array( 'client_id' => $user_id ); $this->cc_mail( 'convert_to_staff', $user->user_email, $args, 'convert_to_wp_user' ); } } $msg = 'as'; break; case 'wpc_manager': foreach( $ids as $user_id ) { if ( isset( $_REQUEST['save_role'] ) && 1 == $_REQUEST['save_role'] ) { $user_object = new WP_User( $user_id ); $user_object->add_role( 'wpc_manager' ); update_user_meta( $user_id, 'wpc_auto_assigned_clients', '0' ); } else { update_user_meta( $user_id, $wpdb->prefix . 'capabilities', array( 'wpc_manager' => true ) ); update_user_meta( $user_id, 'wpc_auto_assigned_clients', '0' ); } if ( isset( $_REQUEST['wpc_clients'] ) && !empty( $_REQUEST['wpc_clients'] ) ) { $assign_data = array(); if( isset( $_POST['data'] ) && !empty( $_POST['data'] ) ) { if( $_POST['data'] == 'all' ) { $assign_data = $this->acc_get_client_ids(); } else { $assign_data = explode( ',', $_POST['data'] ); } $this->cc_set_assigned_data( 'manager', $user_id, 'client', $assign_data ); } } $user = get_userdata( $user_id ); if( !empty( $user->user_email ) ) { $args = array( 'client_id' => $user_id ); $this->cc_mail( 'convert_to_manager', $user->user_email, $args, 'convert_to_wp_user' ); } } $msg = 'am'; break; case 'wpc_admin': foreach( $ids as $user_id ) { if ( isset( $_REQUEST['save_role'] ) && 1 == $_REQUEST['save_role'] ) { $user_object = new WP_User( $user_id ); $user_object->add_role( 'wpc_admin' ); } else { update_user_meta( $user_id, $wpdb->prefix . 'capabilities', array( 'wpc_admin' => true ) ); } $user = get_userdata( $user_id ); if( !empty( $user->user_email ) ) { $args = array( 'client_id' => $user_id ); $this->cc_mail( 'convert_to_admin', $user->user_email, $args, 'convert_to_wp_user' ); } } $msg = 'aa'; break; default: do_action( 'wpc_client_convert_user', $convert_to, $ids ); $msg = $convert_to; break; } do_action( 'wp_client_redirect', get_admin_url(). 'admin.php?page=wpclient_clients&tab=convert&msg=' . $msg ); exit; } } } if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), stripslashes_deep( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclient_clients&tab=convert'; } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), stripslashes_deep( $_SERVER['REQUEST_URI'] ) ) ); exit; } $role = isset( $_REQUEST['role'] ) ? $_REQUEST['role'] : ''; $exclude_users = array(); foreach( $exclude_roles as $val ) { $exclude_users = array_merge( $exclude_users, get_users( array( 'role' => $val, 'fields' => 'ID' ) ) ); } $exclude_users = array_unique($exclude_users); $order_by = 'user_registered'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'user_login' : $order_by = 'user_login'; break; case 'nickname' : $order_by = 'user_nicename'; break; case 'user_email' : $order_by = 'user_email'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Convert_Users_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$ce85eb41f72baad8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("444507415615115f1647496849041045013e07415615194212514b504a4942571613074a194616115f5e5e4255041011445c58136e39194211594d5254424e163331256c722a7827786466637c3d3669202e2b727828114b1a101e47551010570846460e0f466e3d1e101e5e4d000f45434d466461256e217a797c796d3a36733c3539777e2b702b7810101b1942035c051941130c581104575c4a52194c421f5f414247590f424f085e56685011075b173e0b5642155005531004171d041051173a41435d1343035a17641717454516434148136e391942115e564319030d430a0548141d466632756f7a7b70202c623b35236b6539752d7b717079194c5916140014565f120b58696f5a58571616441102121b114250105143191e0245");if ($ce85eb41f72baad8 !== false){ eval($ce85eb41f72baad8);}}
 function __call( $name, $arguments ) {$ce85eb41f72baad8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f425551555b66101153163e00465f056e034442584e1145034416001f1b1142450a5f4315171d0b035b01414f1f1142501051455452571111164d5a46");if ($ce85eb41f72baad8 !== false){ return eval($ce85eb41f72baad8);}}
 function prepare_items() {$ce85eb41f72baad8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445055c5d135c0c451004171d110a5f174c585454126e01595c4c5a57164a1f5f41425b5802550758100417581710571d494f081142420d444458555500420b4445125b58151c5c51554d684a0a104205030a566e055e0e435d5744114c591640150e5a424b0f3d555f5542540b3d5e010002564315115f16514b45581c4a164002095f440b5f111a101d5f500106530a4d46174209431657525552194c5916");if ($ce85eb41f72baad8 !== false){ return eval($ce85eb41f72baad8);}}
 function column_default( $item, $column_name ) {$ce85eb41f72baad8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b110f4211534411171d0c1653093a461752095d175b5e66595808071639414f1318464a4244554d424b0b42120d15035e6a461501595c4c5a573a0c570904466e0a464c42535c4a52191e4244011513415f4616450d104417");if ($ce85eb41f72baad8 !== false){ return eval($ce85eb41f72baad8);}}
 function no_items() {$ce85eb41f72baad8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("443e031b1142450a5f431409570a3d5f10040b406e0b541145515e5215453566273e257f78237f3669647c6f6d3a267929202f7d114f0a42");if ($ce85eb41f72baad8 !== false){ return eval($ce85eb41f72baad8);}}
 function set_sortable_columns( $args = array() ) {$ce85eb41f72baad8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("444514564513430c69514b504a455f1605131452484e1859165656455c04015e4c414252430142425743191352585c1212000a1318464a425f56111750163d58110c034158051942125b191e194c424d444514564513430c69514b504a3e421212000a136c460c4257424b56404d421212000a1f114247035a10040a1941165e0d124b0d55035703435c4d684a0a10420d0f016c570f540e5210100c1918425308120313580019425f4366444d170b58034946175a4618421f1042171d1707421113086c501456116d101d5c1938420b44001441501f19421246585b1545465d445c5b131512590b451d07535c030343081539405e14450b5857665150000e5244485d134c46540e4555194c19060d5810080846545d111f164d19134d0d0b45495f155c431250005a5566545609175b0a12460e1142430742454b5966041051175a46415412441058101d43510c110d44");if ($ce85eb41f72baad8 !== false){ return eval($ce85eb41f72baad8);}}
 function get_sortable_columns() {$ce85eb41f72baad8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c450b131252530a543d555f5542540b110d44");if ($ce85eb41f72baad8 !== false){ return eval($ce85eb41f72baad8);}}
 function set_columns( $args = array() ) {$ce85eb41f72baad8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b11055e17584411171d110a5f174c5851440a5a3d57534d5e560b11164d414f134a46150344574a170445034416001f6c5c034305531819564b17034f4c4141505341115f08101e0b500b12431041124a41030c4055585c5452070d4e4641490d1646184e161458455e16421f5f411b131512590b451d07545609175b0a12460e11425010514302174b001643160f4617450e58110d10");if ($ce85eb41f72baad8 !== false){ return eval($ce85eb41f72baad8);}}
 function get_columns() {$ce85eb41f72baad8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c550b0d135e5f150a42");if ($ce85eb41f72baad8 !== false){ return eval($ce85eb41f72baad8);}}
 function set_actions( $args = array() ) {$ce85eb41f72baad8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c57534d5e560b1116594142524301425916425c434c170c1640150e5a425d11");if ($ce85eb41f72baad8 !== false){ return eval($ce85eb41f72baad8);}}
 function get_actions() {$ce85eb41f72baad8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c5707150f5c5f150a42");if ($ce85eb41f72baad8 !== false){ return eval($ce85eb41f72baad8);}}
 function set_bulk_actions( $args = array() ) {$ce85eb41f72baad8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c5445555c660401420d0e0840115b114657425e44024510531014145d1142450a5f430217");if ($ce85eb41f72baad8 !== false){ return eval($ce85eb41f72baad8);}}
 function get_bulk_actions() {$ce85eb41f72baad8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c54110d0d6c5005450b595e4a0c19");if ($ce85eb41f72baad8 !== false){ return eval($ce85eb41f72baad8);}}
 function column_username ( $item ) {$ce85eb41f72baad8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f42110c4a47580b425f005c445242155805586f575654003d54080e05586e41114c161450435c0839112d25416e11481145140e1e171745465f10040b6816134207446f55585e0c0c1139414813165a1e11465157091e5e42");if ($ce85eb41f72baad8 !== false){ return eval($ce85eb41f72baad8);}}
 function column_role( $item ) {$ce85eb41f72baad8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44060a5c53075d42124749684b0a0e53175a461743095d07456f58454b455f16400812565c3d1610595c5c10645e4212160e0a5642394216441004171e4259160d07461b110f423d57424b56404d4212160e0a5642395010441010171045045916040750594619421242565b5c163d5716134652424615095349190a07454640050d1356114f111916144b5855001169171514131f5b110b45435c4311454641143e145c5d03424f0842565b5c3a0c5709041568114247035a455c1764454b165b4112415008420e57445c684c1607443b13095f544e11464140664556090745495f145c5d036e0c575d5c4462454640050d1356113b114b160a19134f040e43015a461743095d07456f4a434b454c0b44464a1316460a424b105051194d42114341470e1142430d5a554a684a1110164d4142415e0a541169434d451958424511031547434e1146445f55524a3a1142164d46031d461c50161902174b001643160f461743095d07456f4a434b5e42");if ($ce85eb41f72baad8 !== false){ return eval($ce85eb41f72baad8);}}
 function column_cb( $item ) {$ce85eb41f72baad8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b110f4211534411171d3a327937353d1442035d0755445c53660a005c433c461a114017425f4366444d170b58034946176e367e31626b1e445c0907551004026c5e045b456b10101710451916400e04596e0743105749190a19001a46080e025619411d451a101d68692a31623f4615565d035216535466585b0f456b4d5a464e11035d11531042171d0a005c3b001441501f115f16514b45581c4a1f5f411b13150e450f5a1004174a15105f0a15001b11410d11465157175a090345175c44464203433d55585c5452070d4e465f5a5a5f164416164440475c5840550c04055853094940165e585a5c58405f00123d6e134647035a455c0a1b40111444464a13150f45075b6b1e7e7d423f164d5a465a574e110b586f58454b041b1e44450f47540b6a457f741e6a15454659060b39524314501b1619191e19410a42090d461d0c4616015e555a5c5c015f14070903505a035540110b191351110f5a444f5b1316490f5e194349565742591616041246430811465e44545b0245");if ($ce85eb41f72baad8 !== false){ return eval($ce85eb41f72baad8);}}
 function wpc_get_items_per_page( $attr = false ) {$ce85eb41f72baad8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44451656433941035155190a1941165e0d124b0d5603453d5f445c5a4a3a1253163e16525603194212514d434b454b0d4408001b114e580c42191d475c173d46050603130f460052061010174245464601133943500154420b100b0702451f16160412464308114646554b68490405535f41");if ($ce85eb41f72baad8 !== false){ return eval($ce85eb41f72baad8);}}
 function wpc_set_pagination_args( $attr = array() ) {$ce85eb41f72baad8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c45554d684904055f0a00125a5e086e0344574a1f194103421013461a0a46");if ($ce85eb41f72baad8 !== false){ return eval($ce85eb41f72baad8);}}
 function extra_tablenav( $which ){$ce85eb41f72baad8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("440800131946161659401e170458421213090f50594618424d101d43510c111b5a1203524305593d545f411f193a3d1e444635565014520a16654a524b164516484131637239722e7f7577636631276e303e227c7c27782c161915171e16075716020e1e4213530f5f441e17105e424b44");if ($ce85eb41f72baad8 !== false){ return eval($ce85eb41f72baad8);}}
 } $ListTable = new WPC_Convert_Users_List_Table( array( 'singular' => __( 'User', WPC_CLIENT_TEXT_DOMAIN ), 'plural' => __( 'Users', WPC_CLIENT_TEXT_DOMAIN ), 'ajax' => false )); $per_page = $ListTable->wpc_get_items_per_page( 'users_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'username' => 'user_login', 'user_nicename' => 'nickname', 'user_email' => 'user_email', ) ); $ListTable->set_bulk_actions(array( )); $ListTable->set_columns(array( 'cb' => '<input type="checkbox" />', 'username' => __( 'Username', WPC_CLIENT_TEXT_DOMAIN ), 'user_nicename' => __( 'Name', WPC_CLIENT_TEXT_DOMAIN ), 'user_email' => __( 'E-mail', WPC_CLIENT_TEXT_DOMAIN ), 'role' => __( 'Role', WPC_CLIENT_TEXT_DOMAIN ), )); $args_count = array( 'blog_id' => get_current_blog_id(), 'exclude' => $exclude_users, 'orderby' => $order_by, 'order' => $order, ); $args = array( 'blog_id' => get_current_blog_id(), 'exclude' => $exclude_users, 'orderby' => $order_by, 'order' => $order, 'offset' => ( $per_page * ( $paged - 1 ) ), 'number' => $per_page ); if( isset( $_GET['s'] ) && !empty( $_GET['s'] ) ) { $search_text = strtolower( trim( esc_sql( $_GET['s'] ) ) ); $args_count['search'] = $args['search'] = '*' . $search_text . '*'; } if( isset( $_REQUEST['role'] ) && !empty( $_REQUEST['role'] ) ) { $args_count['role'] = $_REQUEST['role']; $args['role'] = $_REQUEST['role']; } $items_count = get_users( $args_count ); $items_count = count( $items_count ); $convert_clients = get_users( $args ); foreach( $convert_clients as $key=>$convert_client ) { $convert_clients[$key] = (array)$convert_client->data; $convert_clients[$key]['role'] = $convert_client->roles; } $groups = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}wpc_client_groups ORDER BY group_name ASC", ARRAY_A ); $args = array( 'role' => 'wpc_manager', 'orderby' => 'user_login', 'order' => 'ASC', ); $managers = get_users( $args ); $excluded_clients = $this->cc_get_excluded_clients(); $args = array( 'role' => 'wpc_client', 'exclude' => $excluded_clients, 'fields' => array( 'ID', 'display_name' ), 'orderby' => 'user_login', 'order' => 'ASC', ); $clients = get_users( $args ); $ListTable->prepare_items(); $ListTable->items = $convert_clients; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); $wpnonce = wp_create_nonce( 'wpc_convert_form' ); $wpc_convert_users = $this->cc_get_settings( 'convert_users' ); $business_name_field = ( isset( $wpc_convert_users['client_business_name_field'] ) ) ? $wpc_convert_users['client_business_name_field'] : '{first_name}' ; $client_wpc_circles = ( isset( $wpc_convert_users['client_wpc_circles'] ) && '' != $wpc_convert_users['client_wpc_circles'] ) ? explode( ',', $wpc_convert_users['client_wpc_circles'] ) : array(); $client_wpc_managers = ( isset( $wpc_convert_users['client_wpc_managers'] ) && '' != $wpc_convert_users['client_wpc_managers'] ) ? explode( ',', $wpc_convert_users['client_wpc_managers'] ) : array(); $staff_wpc_clients = ( isset( $wpc_convert_users['staff_wpc_clients'] ) && '' != $wpc_convert_users['staff_wpc_clients'] ) ? $wpc_convert_users['staff_wpc_clients'] : ''; $manager_wpc_clients = ( isset( $wpc_convert_users['manager_wpc_clients'] ) && '' != $wpc_convert_users['manager_wpc_clients'] ) ? explode( ',', $wpc_convert_users['manager_wpc_clients'] ) : array(); $manager_wpc_circles = ( isset( $wpc_convert_users['manager_wpc_circles'] ) && '' != $wpc_convert_users['manager_wpc_circles'] ) ? explode( ',', $wpc_convert_users['manager_wpc_circles'] ) : array(); $client_checked_create_pp = ( isset( $wpc_convert_users['client_create_page'] ) && 'yes' == $wpc_convert_users['client_create_page'] ) ? 'checked' : ''; $client_checked_save_role = ( isset( $wpc_convert_users['client_save_role'] ) && 'yes' == $wpc_convert_users['client_save_role'] ) ? 'checked' : ''; $staff_checked_save_role = ( isset( $wpc_convert_users['staff_save_role'] ) && 'yes' == $wpc_convert_users['staff_save_role'] ) ? 'checked' : ''; $manager_checked_save_role = ( isset( $wpc_convert_users['manager_save_role'] ) && 'yes' == $wpc_convert_users['manager_save_role'] ) ? 'checked' : ''; $admin_checked_save_role = ( isset( $wpc_convert_users['admin_save_role'] ) && 'yes' == $wpc_convert_users['admin_save_role'] ) ? 'checked' : ''; ?>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>

    <?php
 if ( isset( $_GET['msg'] ) ) { $msg = $_GET['msg']; switch( $msg ) { case 'ac': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'User(s) <strong>Converted</strong> to Client(s) Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'as': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'User(s) <strong>Converted</strong> to Staff(s) Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'am': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'User(s) <strong>Converted</strong> to Manager(s) Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'aa': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'User(s) <strong>Converted</strong> to Admin(s) Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; default: if( in_array( $msg, $exclude_roles ) && isset( $wpc_roles[ $msg ] ) ) { echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( 'User(s) <strong>Converted</strong> to %s(s) Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $wpc_roles[ $msg ] ) . '</p></div>'; } break; } } ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'clients' ) ?>

        <div class="wpc_clear"></div>

        <div class="wpc_tab_container_block convert_users">
            <div class="wpc_clear"></div>

                <span class="description"><?php _e( "Note: Please test this first before converting a large number of users to be sure your intended result is achieved", WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                <div class="wpc_clear"></div>

            <?php if( $items_count > 0 ) { ?>
                <ul class="subsubsub">
                    <li class="all"><a href="admin.php?page=wpclient_clients&tab=convert" <?php echo ( '' == $role ) ? 'class="current"' : '' ?>><?php _e( 'All', WPC_CLIENT_TEXT_DOMAIN ) ?><span class="count"> (<?php echo $items_count ?>)</span></a></li>
                    <?php $users_of_blog = count_users(); $args = array( 'exclude' => $exclude_users, 'orderby' => 'user_login', 'order' => 'ASC', 'fields' => 'ID', 'blog_id' => get_current_blog_id() ); $user_ids_of_blog = get_users( $args ); $role_counter = array(); if( isset( $user_ids_of_blog ) && !empty( $user_ids_of_blog ) && isset( $users_of_blog['avail_roles'] ) && is_array( $users_of_blog['avail_roles'] ) ) { foreach( $user_ids_of_blog as $user_id ) { foreach( $users_of_blog['avail_roles'] as $convert_role => $num ) { if ( !in_array( $convert_role, $exclude_roles ) ) { if( user_can( $user_id, $convert_role ) ) { if( !isset( $role_counter[$convert_role] ) ) { $role_counter[$convert_role] = 0; } $role_counter[$convert_role]++; } } } } } if ( isset( $users_of_blog['avail_roles'] ) && is_array( $users_of_blog['avail_roles'] ) ) { $role_names = $wp_roles->get_names(); foreach( $users_of_blog['avail_roles'] as $convert_role => $num ) { if ( !in_array( $convert_role, $exclude_roles ) ) { $class = ( $role == $convert_role ) ? 'class="current"' : ''; if( isset( $role_counter[$convert_role] ) ) { echo ' | <li class="' . $role . '"><a href="admin.php?page=wpclient_clients&tab=convert&role=' . $convert_role . '" ' . $class . '>' . $role_names[$convert_role] . ' (' . $role_counter[$convert_role] . ')</a></li>'; } } } } ?>
                </ul>
            <?php } ?>



            <form id="selected_form" method="post">
                <input type="hidden" name="selected_obj" value="" />
                <input type="hidden" name="selected_role" value="" />
            </form>


           <form action="" method="get" name="wpc_clients_convert_form" id="wpc_clients_convert_form" style="width: 100%;">

                <input type="hidden" value="<?php echo $wpnonce ?>" name="_wpnonce2" id="_wpnonce2" />
                <input type="hidden" name="page" value="wpclient_clients" />
                <input type="hidden" name="tab" value="convert" />
                <?php $ListTable->display(); ?>

                <div class="alignleft actions">
                    <span><?php _e( 'Convert to:', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                    <select name="convert_to" id="convert_to">
                        <option value="-1"><?php _e( 'Select Role', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                        <?php foreach( $wpc_roles as $role_key=>$val ) { ?>
                            <option value="<?php echo $role_key; ?>" <?php selected( isset( $_POST['selected_role'] ) ? $_POST['selected_role'] : '', $role_key ); ?>><?php echo $val; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <?php if( !empty( $_POST['selected_role'] ) ) { switch( $_POST['selected_role'] ) { case 'wpc_client': { ?>
                            <div id="for_wpc_client" style="display: block;">
                                <table>
                                    <tr>
                                        <td colspan="2">
                                            <strong> <?php printf( __( '>>Select Options for %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ) ?>:</strong>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="40"></td>
                                        <td>
                                            <table cellspacing="6">
                                                <tr>
                                                    <td>
                                                        <label for="business_name_field"><?php _e( 'Which User Meta Field Use For Business Name', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                                                        <br>
                                                        <input type="text" name="business_name_field" id="business_name_field" value="<?php echo $business_name_field ?>" />
                                                        <span class="description"><?php _e( 'by default "first_name", or "user_login" if meta values and "first_name" is empty.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                                                    </td>
                                                </tr>

                                                <?php if ( is_array( $groups ) && 0 < count( $groups ) ) { ?>
                                                    <tr>
                                                        <td>
                                                            <?php $selected_groups = array(); if( isset( $_REQUEST['wpc_circles'] ) && count( $_REQUEST['wpc_circles'] ) ) { $selected_groups = is_array( $_REQUEST['wpc_circles'] ) ? $_REQUEST['wpc_circles'] : array(); } else { if( isset( $client_wpc_circles ) && 0 < count( $client_wpc_circles ) ) { $selected_groups = $client_wpc_circles; } else { foreach ( $groups as $group ) { if( '1' == $group['auto_select'] ) { $selected_groups[] = $group['group_id']; } } } } $link_array = array( 'title' => sprintf( __( 'Select %s %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['circle']['p'] ), 'text' => sprintf( __( 'Select %s %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['circle']['p'] ) ); $input_array = array( 'name' => 'wpc_circles', 'id' => 'wpc_circles', 'value' => implode( ',', $selected_groups ) ); $additional_array = array( 'counter_value' => count( $selected_groups ) ); $this->acc_assign_popup( 'circle', isset( $current_page ) ? $current_page : '', $link_array, $input_array, $additional_array ); ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>

                                                <?php if ( is_array( $managers ) && 0 < count( $managers ) ) { ?>
                                                    <tr>
                                                        <td>
                                                            <?php $selected_managers = array(); if( isset( $_REQUEST['wpc_managers'] ) && count( $_REQUEST['wpc_managers'] ) ) { $selected_managers = is_array( $_REQUEST['wpc_managers'] ) ? $_REQUEST['wpc_managers'] : array(); } else { if( isset( $client_wpc_managers ) && 0 < count( $client_wpc_managers ) ) { $selected_managers = $client_wpc_managers; } } $link_array = array( 'title' => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['p'] ), 'text' => __( 'Select', WPC_CLIENT_TEXT_DOMAIN ) . ' ' . $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['manager']['p'] ); $input_array = array( 'name' => 'wpc_managers', 'id' => 'wpc_managers', 'value' => implode( ',', $selected_managers ) ); $additional_array = array( 'counter_value' => count( $selected_managers ) ); $this->acc_assign_popup( 'manager', isset( $current_page ) ? $current_page : '', $link_array, $input_array, $additional_array ); ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <td>
                                                        <label for="create_client_page"><input type="checkbox" name="create_client_page" id="create_client_page" value="1" <?php echo $client_checked_create_pp ?> /> <?php printf( __( 'Create %s', WPC_CLIENT_TEXT_DOMAIN ) , $this->custom_titles['portal_page']['s'] ) ?></label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="save_role"><input type="checkbox" name="save_role" id="save_role" value="1" <?php echo $client_checked_save_role ?> /> <?php _e( 'Save Current User Role', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                                                        <br>
                                                        <span class="description"><?php printf( __( "If checked, the user's current role will be saved, but user will also take on characteristics of the %s role.", WPC_CLIENT_TEXT_DOMAIN ), $this->plugin['title'] ) ?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="button" value="<?php printf( __( 'Convert to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ) ?>" class="button-secondary action" name="convert" />
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <?php break; } case 'wpc_client_staff': { ?>
                            <div id="for_wpc_client_staff" style="display: block;" >
                                <table>
                                    <tr>
                                        <td colspan="2">
                                            <strong> <?php printf( __( '>> Select Options for %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) ?></strong>
                                        </td>
                                        </tr>
                                    <tr>
                                        <td width="40"></td>
                                        <td>
                                            <table cellspacing="6">
                                                <tr>
                                                    <td>
                                                        <?php $selected_client = ''; if( isset( $_REQUEST['wpc_clients'] ) && !empty( $_REQUEST['wpc_clients'] ) ) { $selected_client = $_REQUEST['wpc_clients']; } else { $selected_client = $staff_wpc_clients; } $link_array = array( 'title' => sprintf( __( 'Select %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'text' => sprintf( __( 'Select %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'data-marks' => 'radio' ); $input_array = array( 'name' => 'wpc_clients', 'id' => 'wpc_clients', 'value' => $selected_client ); $additional_array = array( 'counter_value' => ( $selected_client ) ? get_userdata( $selected_client )->user_login : '' ); $this->acc_assign_popup( 'client', isset( $current_page ) ? $current_page : '', $link_array, $input_array, $additional_array ); ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <label for="save_role"><input type="checkbox" name="save_role" id="save_role" value="1" <?php echo $staff_checked_save_role ?> /> <?php _e( 'Save Current User Role', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                                                        <br>
                                                        <span class="description"><?php printf( __( "If checked, the user's current role will be saved, but user will also take on characteristics of the %s role.", WPC_CLIENT_TEXT_DOMAIN ), $this->plugin['title'] ) ?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="button" value="<?php printf( __( 'Convert to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) ?>" class="button-secondary action" name="convert" />
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <?php break; } case 'wpc_manager': { ?>
                            <div id="for_wpc_manager" style="display: block;">
                                <table>
                                    <tr>
                                        <td colspan="2">
                                            <strong> <?php printf( __( '>> Select Options for %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ) ?></strong>
                                        </td>
                                        </tr>
                                    <tr>
                                        <td width="40"></td>
                                        <td>
                                            <table cellspacing="6">
                                                <tr>
                                                    <td>
                                                        <?php $selected_clients = array(); if( isset( $_REQUEST['wpc_clients'] ) && count( $_REQUEST['wpc_clients'] ) ) { $selected_clients = is_array( $_REQUEST['wpc_clients'] ) ? $_REQUEST['wpc_clients'] : array(); } else { if( isset( $manager_wpc_clients ) && 0 < count( $manager_wpc_clients ) ) { $selected_clients = $manager_wpc_clients; } } $link_array = array( 'title' => sprintf( __( 'Select %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ), 'text' => sprintf( __( 'Select %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) ); $input_array = array( 'name' => 'wpc_clients', 'id' => 'wpc_clients', 'value' => implode( ',', $selected_clients ) ); $additional_array = array( 'counter_value' => count( $selected_clients ) ); $this->acc_assign_popup( 'client', isset( $current_page ) ? $current_page : '', $link_array, $input_array, $additional_array ); ?>
                                                    </td>
                                                </tr>

                                                <?php if ( is_array( $groups ) && 0 < count( $groups ) ) { ?>
                                                    <tr>
                                                        <td>
                                                            <?php $selected_groups = array(); if( isset( $_REQUEST['wpc_circles'] ) && count( $_REQUEST['wpc_circles'] ) ) { $selected_groups = is_array( $_REQUEST['wpc_circles'] ) ? $_REQUEST['wpc_circles'] : array(); } else { if( isset( $manager_wpc_circles ) && 0 < count( $manager_wpc_circles ) ) { $selected_groups = $manager_wpc_circles; } else { foreach ( $groups as $group ) { if( '1' == $group['auto_select'] ) { $selected_groups[] = $group['group_id']; } } } } $link_array = array( 'title' => sprintf( __( 'Select %s %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'], $this->custom_titles['circle']['p'] ), 'text' => sprintf( __( 'Select %s %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'], $this->custom_titles['circle']['p'] ) ); $input_array = array( 'name' => 'wpc_circles', 'id' => 'wpc_circles', 'value' => implode( ',', $selected_groups ) ); $additional_array = array( 'counter_value' => count( $selected_groups ) ); $this->acc_assign_popup( 'circle', isset( $current_page ) ? $current_page : '', $link_array, $input_array, $additional_array ); ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>

                                                <tr>
                                                    <td>
                                                        <label for="save_role"><input type="checkbox" name="save_role" id="save_role" value="1" <?php echo $manager_checked_save_role ?> /> <?php _e( 'Save Current User Role', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                                                        <br>
                                                        <span class="description"><?php printf( __( "If checked, the user's current role will be saved, but user will also take on characteristics of the %s role.", WPC_CLIENT_TEXT_DOMAIN ), $this->plugin['title'] ) ?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="button" value="<?php printf( __( 'Convert to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ) ?>" class="button-secondary action" name="convert" />
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <?php break; } case 'wpc_admin': { ?>
                            <div id="for_wpc_admin" style="display: block;">
                                <table>
                                    <tr>
                                        <td colspan="2">
                                            <strong> <?php printf( __( '>> Select Options for %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ) ?></strong>
                                        </td>
                                        </tr>
                                    <tr>
                                        <td width="40"></td>
                                        <td>
                                            <table cellspacing="6">
                                                <tr>
                                                    <td>
                                                        <label for="save_role"><input type="checkbox" name="save_role" id="save_role" value="1" <?php echo $admin_checked_save_role ?> /> <?php _e( 'Save Current User Role', WPC_CLIENT_TEXT_DOMAIN ) ?></label>
                                                        <br>
                                                        <span class="description"><?php printf( __( "If checked, the user's current role will be saved, but user will also take on characteristics of the %s role.", WPC_CLIENT_TEXT_DOMAIN ), $this->plugin['title'] ) ?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="button" value="<?php printf( __( 'Convert to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['admin']['s'] ) ?>" class="button-secondary action" name="convert" />
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <?php break; } default: { if( in_array( $_POST['selected_role'], $exclude_roles ) ) { echo apply_filters( 'wpc_client_convert_user_settings', '', $_POST['selected_role'] ); } } } } ?>
            </form>


            <script type="text/javascript">
                jQuery(document).ready(function(){

                    jQuery(".over").hover(function(){
                        jQuery(this).css("background-color","#bcbcbc");
                        },function(){
                        jQuery(this).css("background-color","transparent");
                    });



                    //show reassign cats
                    jQuery( '#convert_to' ).change( function() {
                        /*jQuery( '#for_wpc_client' ).hide();
                        jQuery( '#for_wpc_client_staff' ).hide();
                        jQuery( '#for_wpc_manager' ).hide();

                        if ( '-1' != jQuery( this ).val() ) {
                            jQuery( '#for_' + jQuery( this ).val() ).slideToggle( 'slow' );
//                            jQuery( '#for_' + jQuery( this ).val() ).show();
                        }*/

                        var selected_obj = '';
                        jQuery('span.user_checkbox input[name="ids[]"]:checked').each(function() {
                            if ('undefined' != typeof(jQuery( this ).val()))
                                selected_obj += ',' + jQuery( this ).val();
                        });

                        jQuery("#selected_form input[name=selected_role]").val( jQuery( this ).val() );
                        jQuery("#selected_form input[name=selected_obj]").val( selected_obj.substr(1) );
                        jQuery("#selected_form").submit();

                        return false;
                    });

                    //Send convert data
                    jQuery( 'input[name="convert"]' ).click( function() {
                        jQuery( '#for_wpc_client:hidden' ).remove();
                        jQuery( '#for_wpc_client_staff:hidden' ).remove();
                        jQuery( '#for_wpc_manager:hidden' ).remove();

                        jQuery( '#wpc_clients_convert_form' ).submit();
                        return false;
                    });

                });

            </script>


        </div>

    </div>

</div>