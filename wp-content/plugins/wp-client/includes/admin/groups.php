<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } if ( !( current_user_can( 'wpc_show_circles' ) || current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) ) { do_action( 'wp_client_redirect', get_admin_url( 'index.php' ) ); exit; } if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), wp_unslash( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclients_content&tab=circles'; } global $wpdb; if ( isset( $_REQUEST['action'] ) ) { switch ( $_REQUEST['action'] ) { case 'delete': $groups_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'wpc_group_delete' . $_REQUEST['id'] . get_current_user_id() ); $groups_id = (array) $_REQUEST['id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['circle']['p'] ) ); $groups_id = $_REQUEST['item']; } if ( count( $groups_id ) ) { if ( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { $manager_groups = $this->cc_get_assign_data_by_object( 'manager', get_current_user_id(), 'circle' ); } foreach ( $groups_id as $group_id ) { if ( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { if( !in_array( $group_id, $manager_groups ) ) { continue; } } $this->delete_group( $group_id ); } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; break; case 'create_group': if ( !empty( $_REQUEST['group_name'] ) && isset( $_REQUEST['_wpnonce'] ) && wp_verify_nonce( $_REQUEST['_wpnonce'], 'wpc_create_circle' . get_current_user_id() ) ) { $args = array( 'group_name' => ( isset( $_REQUEST['group_name'] ) ) ? $_REQUEST['group_name'] : '', 'auto_select' => ( isset( $_REQUEST['auto_select'] ) ) ? '1' : '0', 'auto_add_files' => ( isset( $_REQUEST['auto_add_files'] ) ) ? '1' : '0', 'auto_add_pps' => ( isset( $_REQUEST['auto_add_pps'] ) ) ? '1' : '0', 'auto_add_manual' => ( isset( $_REQUEST['auto_add_manual'] ) ) ? '1' : '0', 'auto_add_self' => ( isset( $_REQUEST['auto_add_self'] ) ) ? '1' : '0', 'assign' => ( isset( $_REQUEST['wpc_clients'] ) ) ? $_REQUEST['wpc_clients'] : '' ); $result = $this->create_circle( $args ); if( is_numeric( $result ) && current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { $wpdb->query( $wpdb->prepare( "INSERT INTO {$wpdb->prefix}wpc_client_objects_assigns SET" . " `object_type` = 'manager'" . ", `object_id` = %d" . ", `assign_type` = 'circle'" . ", `assign_id` = %d" , get_current_user_id(), $result ) ); } if ( $result ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'c', get_admin_url(). 'admin.php?page=wpclients_content&tab=circles' ) ); exit; } else { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'ae', get_admin_url(). 'admin.php?page=wpclients_content&tab=circles' ) ); exit; } } break; case 'edit_group': if ( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { $manager_groups = $this->cc_get_assign_data_by_object( 'manager', get_current_user_id(), 'circle' ); if( !empty( $_REQUEST['id'] ) && !in_array( $_REQUEST['id'], $manager_groups ) ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'ae', get_admin_url(). 'admin.php?page=wpclients_groups' ) ); exit; } } if ( !empty( $_REQUEST['group_name'] ) && !empty( $_REQUEST['id'] ) && !empty( $_REQUEST['_wpnonce'] ) && wp_verify_nonce( $_REQUEST['_wpnonce'], 'wpc_update_circle' . get_current_user_id() . $_REQUEST['id'] ) ) { $args = array( 'id' => ( $id = filter_input( INPUT_POST, 'id' ) ) ? $id : '0', 'group_name' => $_REQUEST['group_name'], 'auto_select' => ( isset( $_REQUEST['auto_select'] ) ) ? '1' : '0', 'auto_add_files' => ( isset( $_REQUEST['auto_add_files'] ) ) ? '1' : '0', 'auto_add_pps' => ( isset( $_REQUEST['auto_add_pps'] ) ) ? '1' : '0', 'auto_add_manual' => ( isset( $_REQUEST['auto_add_manual'] ) ) ? '1' : '0', 'auto_add_self' => ( isset( $_REQUEST['auto_add_self'] ) ) ? '1' : '0', 'assign' => ( isset( $_REQUEST['wpc_clients'] ) ) ? $_REQUEST['wpc_clients'] : '', ); $result = $this->update_circle( $args ); if ( $result ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 's', get_admin_url(). 'admin.php?page=wpclients_content&tab=circles' ) ); exit; } else { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'ae', get_admin_url(). 'admin.php?page=wpclients_content&tab=circles' ) ); exit; } } break; } } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ); exit; } $order_by = 'id'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'group_name' : $order_by = 'group_name'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Group_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$c9cce4a06f6c7075 = p45f99bb432b194dff04b7d12425d3f8d_get_code("444507415615115f1647496849041045013e07415615194212514b504a4942571613074a194616115f5e5e4255041011445c58136e39194211594d5254424e163331256c722a7827786466637c3d3669202e2b727828114b1a101e47551010570846460e0f466e3d1e101e5e4d000f45434d466461256e217a797c796d3a36733c3539777e2b702b7810101b1942035c051941130c581104575c4a52194c421f5f414247590f424f085e56685011075b173e0b5642155005531004171d041051173a41435d1343035a17641717454516434148136e391942115e564319030d430a0548141d466632756f7a7b70202c623b35236b6539752d7b717079194c5916140014565f120b58696f5a58571616441102121b114250105143191e0245");if ($c9cce4a06f6c7075 !== false){ eval($c9cce4a06f6c7075);}}
 function __call( $name, $arguments ) {$c9cce4a06f6c7075 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f425551555b66101153163e00465f056e034442584e1145034416001f1b1142450a5f4315171d0b035b01414f1f1142501051455452571111164d5a46");if ($c9cce4a06f6c7075 !== false){ return eval($c9cce4a06f6c7075);}}
 function prepare_items() {$c9cce4a06f6c7075 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445055c5d135c0c451004171d110a5f174c585454126e01595c4c5a57164a1f5f41425b5802550758100417581710571d494f081142420d444458555500420b4445125b58151c5c51554d684a0a104205030a566e055e0e435d5744114c591640150e5a424b0f3d555f5542540b3d5e010002564315115f16514b45581c4a164002095f440b5f111a101d5f500106530a4d46174209431657525552194c5916");if ($c9cce4a06f6c7075 !== false){ return eval($c9cce4a06f6c7075);}}
 function column_default( $item, $column_name ) {$c9cce4a06f6c7075 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b110f4211534411171d0c1653093a461752095d175b5e66595808071639414f1318464a4244554d424b0b42120d15035e6a461501595c4c5a573a0c570904466e0a464c42535c4a52191e4244011513415f4616450d104417");if ($c9cce4a06f6c7075 !== false){ return eval($c9cce4a06f6c7075);}}
 function no_items() {$c9cce4a06f6c7075 = p45f99bb432b194dff04b7d12425d3f8d_get_code("443e031b1142450a5f431409570a3d5f10040b406e0b541145515e5215453566273e257f78237f3669647c6f6d3a267929202f7d114f0a42");if ($c9cce4a06f6c7075 !== false){ return eval($c9cce4a06f6c7075);}}
 function set_sortable_columns( $args = array() ) {$c9cce4a06f6c7075 = p45f99bb432b194dff04b7d12425d3f8d_get_code("444514564513430c69514b504a455f1605131452484e1859165656455c04015e4c414252430142425743191352585c1212000a1318464a425f56111750163d58110c034158051942125b191e194c424d444514564513430c69514b504a3e421212000a136c460c4257424b56404d421212000a1f114247035a10040a1941165e0d124b0d55035703435c4d684a0a10420d0f016c570f540e5210100c1918425308120313580019425f4366444d170b58034946175a4618421f1042171d1707421113086c501456116d101d5c1938420b44001441501f19421246585b1545465d445c5b131512590b451d07535c030343081539405e14450b5857665150000e5244485d134c46540e4555194c19060d5810080846545d111f164d19134d0d0b45495f155c431250005a5566545609175b0a12460e1142430742454b5966041051175a46415412441058101d43510c110d44");if ($c9cce4a06f6c7075 !== false){ return eval($c9cce4a06f6c7075);}}
 function get_sortable_columns() {$c9cce4a06f6c7075 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c450b131252530a543d555f5542540b110d44");if ($c9cce4a06f6c7075 !== false){ return eval($c9cce4a06f6c7075);}}
 function set_columns( $args = array() ) {$c9cce4a06f6c7075 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b11055e17584411171d110a5f174c5851440a5a3d57534d5e560b11164d414f134a46150344574a170445034416001f6c5c034305531819564b17034f4c4141505341115f08101e0b500b12431041124a41030c4055585c5452070d4e4641490d1646184e161458455e16421f5f411b131512590b451d07545609175b0a12460e11425010514302174b001643160f4617450e58110d10");if ($c9cce4a06f6c7075 !== false){ return eval($c9cce4a06f6c7075);}}
 function get_columns() {$c9cce4a06f6c7075 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c550b0d135e5f150a42");if ($c9cce4a06f6c7075 !== false){ return eval($c9cce4a06f6c7075);}}
 function set_actions( $args = array() ) {$c9cce4a06f6c7075 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c57534d5e560b1116594142524301425916425c434c170c1640150e5a425d11");if ($c9cce4a06f6c7075 !== false){ return eval($c9cce4a06f6c7075);}}
 function get_actions() {$c9cce4a06f6c7075 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c5707150f5c5f150a42");if ($c9cce4a06f6c7075 !== false){ return eval($c9cce4a06f6c7075);}}
 function set_bulk_actions( $args = array() ) {$c9cce4a06f6c7075 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c5445555c660401420d0e0840115b114657425e44024510531014145d1142450a5f430217");if ($c9cce4a06f6c7075 !== false){ return eval($c9cce4a06f6c7075);}}
 function get_bulk_actions() {$c9cce4a06f6c7075 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c54110d0d6c5005450b595e4a0c19");if ($c9cce4a06f6c7075 !== false){ return eval($c9cce4a06f6c7075);}}
 function column_cb( $item ) {$c9cce4a06f6c7075 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f4245404b5e5711041e44465a5a5f164416164440475c5840550c04055853094940165e585a5c58405f10040b686c441114575c4c52044747454641490d164a11465f445c5a62420b52433c461a0a46");if ($c9cce4a06f6c7075 !== false){ return eval($c9cce4a06f6c7075);}}
 function column_group_id( $item ) {$c9cce4a06f6c7075 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f4212594d52543e455f00463b0811");if ($c9cce4a06f6c7075 !== false){ return eval($c9cce4a06f6c7075);}}
 function column_group_name( $item ) {$c9cce4a06f6c7075 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44060a5c53075d421247495466060e5f010f120811425001425956594a455f1605131452484e1859161458685c010b42445c46140d07110a44555f0a1b0f03400512054158164558405f505311554b0d4641025245071c0b520d1b10194b42120d15035e6a415806116d191919424016070d0740425b1315465366525d0c1669070814505d03135c110b19135806165f0b0f15681603550b42176417044546573b04025a45461f42696f11107c010b42434d466461256e217a797c796d3a36733c3539777e2b702b781010171745450a4b0058140a461503554450585716391100040a564503163f160d1910050442590a020a5a520d0c3e11425c434c170c16070e085558145c4a14171919191612440d0f125519466e3d1e101e764b00424f0b144640441454424f5f4c174e040c424415091355035d0742551943510c1116411259141d466632756f7a7b70202c623b35236b6539752d7b717079194c4e16401616506e055d0b535e4d1a07061745100e0b6c450f450e534362105a0c10550804416e6a4142456b101017174545144d5a3a1416461f42111051455c035f1405050b5a5f48410a460f49565e005f4114020a5a54084511695356594d000c42421507510c055810555c5c441f0401420d0e080e55035d0742551f5e5d5845164a41425a45035c3911595d1064454c164347394441085e0c55550410194b4241143e054154074507695e56595a004a16431616506e01430d434066535c0907420146461d11425816535d62105001456b444f465454126e0143424b5257113d431704146c5802194b16191919194240165a46461d11396e4a16177d5255001653434d466461256e217a797c796d3a36733c3539777e2b702b781010171745450a4b0058140a46430742454b59191612440d0f12551946164707144a171c574645434d46140d154103580e1e171745465f10040b681601430d434066595808071139414813165a1e11465157091e49421210090f401c58430d416f58544d0c0d58174946175005450b595e4a1710454b0d44");if ($c9cce4a06f6c7075 !== false){ return eval($c9cce4a06f6c7075);}}
 function get_selectbox( $bool ) {$c9cce4a06f6c7075 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f42110c505949101616101816560c44520a53535255561d4016070d0740425b130b585656685a0d07550f03094b1341114c1654504458070e530049571f11571d42505155445c4c421844020e56520d54061e101d55560a0e1a44151446544a1104575c4a52194c4218444658140a46");if ($c9cce4a06f6c7075 !== false){ return eval($c9cce4a06f6c7075);}}
 function column_auto_select( $item ) {$c9cce4a06f6c7075 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c5101153940540a54014252564f11455316595c46175812540f6d1758424d0a3d45010d035045416c421f0b19");if ($c9cce4a06f6c7075 !== false){ return eval($c9cce4a06f6c7075);}}
 function column_auto_add_files( $item ) {$c9cce4a06f6c7075 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c5101153940540a54014252564f11455316595c46175812540f6d1758424d0a3d5700053955580a5411116d191e0245");if ($c9cce4a06f6c7075 !== false){ return eval($c9cce4a06f6c7075);}}
 function column_auto_add_pps( $item ) {$c9cce4a06f6c7075 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c5101153940540a54014252564f11455316595c46175812540f6d1758424d0a3d57000539434115163f16190217");if ($c9cce4a06f6c7075 !== false){ return eval($c9cce4a06f6c7075);}}
 function column_auto_add_manual( $item ) {$c9cce4a06f6c7075 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c5101153940540a54014252564f11455316595c46175812540f6d1758424d0a3d570005395e500844035a176417105e42");if ($c9cce4a06f6c7075 !== false){ return eval($c9cce4a06f6c7075);}}
 function column_auto_add_self( $item ) {$c9cce4a06f6c7075 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c5101153940540a54014252564f11455316595c46175812540f6d1758424d0a3d5700053940540a57456b10100c19");if ($c9cce4a06f6c7075 !== false){ return eval($c9cce4a06f6c7075);}}
 function column_assign( $item ) {$c9cce4a06f6c7075 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44060a5c53075d421247495466060e5f010f12081142520e5f5557434a3a0b52445c46174616523d555c505257114f080702395454126e05445f4c4766060e5f010f12406e0f554a161450435c0839110d05416e114f0a42125c5059523a034416001f130c4650104451401f1942165f100d0314115b0f4245404b5e5711041e443e391b1141701145595e5919401116100e46141d466632756f7a7b70202c623b35236b6539752d7b717079194c4e16401616506e055d0b535e4d1a07061745100e0b6c450f450e534362105a090b530a15416e6a4141456b1010171745465f10040b681601430d4340665958080711394d4614550745031b5153564142420b5a41124144031d421154584358480b5243415b0d11425816535d62105001456b48414f081142580c46454d68581710571d415b13501443034f18191057040f5343415b0d11414612556f5a5b50000c42173e0759501e6a3f111c191050014516595f46144616523d555c50525711116943414813150f45075b6b1e5e5d423f1a444610525d135445160d07175008125a0b05031b11411d451a101d54550c07581012395a554618421f0b19135801065f1008095d500a6e034442584e195842571613074a19461601594557435c173d40050d135616460c5c1653564257114a1640020a5a5408451169595d1710454b0d44450e475c0a115f16144e475a3a015a0d0408471c585001556f58444a0c05583b11094344161945555c50525711451a44461143520a580758444a685e170d431412411f11425d0b585b66564b17034f4841425a5f16441669514b45581c4e16400002575812580d58515568581710571d4d4655500a4207161902174b001643160f461759125c0e0d10");if ($c9cce4a06f6c7075 !== false){ return eval($c9cce4a06f6c7075);}}
 function wpc_get_items_per_page( $attr = false ) {$c9cce4a06f6c7075 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44451656433941035155190a1941165e0d124b0d5603453d5f445c5a4a3a1253163e16525603194212514d434b454b0d4408001b114e580c42191d475c173d46050603130f460052061010174245464601133943500154420b100b0702451f16160412464308114646554b68490405535f41");if ($c9cce4a06f6c7075 !== false){ return eval($c9cce4a06f6c7075);}}
 function wpc_set_pagination_args( $attr = array() ) {$c9cce4a06f6c7075 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c45554d684904055f0a00125a5e086e0344574a1f194103421013461a0a46");if ($c9cce4a06f6c7075 !== false){ return eval($c9cce4a06f6c7075);}}
 } $ListTable = new WPC_Group_List_Table( array( 'singular' => $this->custom_titles['circle']['s'], 'plural' => $this->custom_titles['circle']['p'], 'ajax' => false )); $per_page = $ListTable->wpc_get_items_per_page( 'users_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'group_name' => 'group_name', 'id' => 'id', ) ); $ListTable->set_bulk_actions(array( 'delete' => __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ), )); $ListTable->set_columns(array( 'cb' => '<input type="checkbox" />', 'id' => __( 'ID', WPC_CLIENT_TEXT_DOMAIN ), 'group_name' => __( 'Name', WPC_CLIENT_TEXT_DOMAIN ), 'assign' => sprintf( __( 'Assign %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ), 'auto_select' => __( 'Checkbox Select', WPC_CLIENT_TEXT_DOMAIN ) . $this->tooltip( sprintf( "Auto-selects this %s in all assignment popup boxes", $this->custom_titles['circle']['s'] ) ), 'auto_add_files' => __( 'Files', WPC_CLIENT_TEXT_DOMAIN ) . $this->tooltip( sprintf( "Auto-assigns all newly uploaded files to this %s", $this->custom_titles['circle']['s'] ) ), 'auto_add_pps' => $this->custom_titles['portal_page']['p'] . $this->tooltip( sprintf( "Auto-assigns all newly created %s to this %s", $this->custom_titles['portal_page']['p'], $this->custom_titles['circle']['s'] ) ), 'auto_add_manual' => sprintf( __( 'Manual %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) . $this->tooltip( sprintf( "Auto-assigns all new manually created %s to this %s", $this->custom_titles['client']['p'], $this->custom_titles['circle']['s'] ) ), 'auto_add_self' => sprintf( __( 'Registered %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) . $this->tooltip( sprintf( "Auto-assigns all new self-registered %s to this %s", $this->custom_titles['client']['p'], $this->custom_titles['circle']['s'] ) ), )); $where = ''; if ( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { $manager_groups = $this->cc_get_assign_data_by_object( 'manager', get_current_user_id(), 'circle' ); if( count( $manager_groups ) ) { $where .= " AND group_id IN (" . implode( ',', $manager_groups ) . ")"; } else { $where .= " AND 1 = 0"; } } $sql = "SELECT count( group_id )
    FROM {$wpdb->prefix}wpc_client_groups
    WHERE 1=1 $where"; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT *, group_id as id
    FROM {$wpdb->prefix}wpc_client_groups
    WHERE 1=1 $where
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $groups = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $groups; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<style>
    .column-id {
        width: 5%;
    }

    tr .column-assign,
    tr .column-auto_select,
    tr .column-auto_add_files,
    tr .column-auto_add_pps,
    tr .column-auto_add_manual,
    tr .column-auto_add_self
    {
        text-align: center;
    }

    #edit_group table th {
        font-size: 12px !important;
    }

    #wpc_edit_circle {
        display: none;
    }

</style>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>

    <?php
 if ( isset( $_GET['msg'] ) ) { switch( $_GET['msg'] ) { case 'ae': echo '<div id="message" class="error wpc_notice fade"><p>' . sprintf( __( 'The %s already exists! or Something wrong.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['s'] ) . '</p></div>'; break; case 's': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( 'Changes to %s have been saved', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['s'] ) . '</p></div>'; break; case 'c': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s has been created!', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['s'] ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s %s is deleted!', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['circle']['s'] ) . '</p></div>'; break; } } ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'content' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block">

            <a id="add_circle" class="add-new-h2 wpc_form_link"><?php _e( 'Add New', WPC_CLIENT_TEXT_DOMAIN ) ?></a>

            <form action="" method="get" name="edit_group" id="edit_group">
                <input type="hidden" name="page" value="wpclients_content" />
                <input type="hidden" name="tab" value="circles" />
                <?php $ListTable->display(); ?>
            </form>

        </div>

        <div id="wpc_edit_circle">

            <form method="post" action="" class="wpc_form">
                <table>
                    <table class="form-table">
                    <tr>
                        <td>
                            <input type="hidden" name="id" id="wpc_id" />
                            <input type="hidden" name="action" id="wpc_circle_action" />
                            <input type="hidden" name="_wpnonce" id="wpc_circle_wpnonce" />
                            <?php printf( __( '%s Name', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['s'] ) ?>:<span class="required">*</span>
                            <input type="text" class="input" name="group_name" id="wpc_group_name" value="" size="30" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>
                                <input type="checkbox" name="auto_select" id="wpc_auto_select" value="1" />
                                <?php printf( __( 'Auto-Select this %s on the Assign Popups', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['s'] ) ?>
                            </label>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label>
                                <input type="checkbox" name="auto_add_files" id="wpc_auto_add_files" value="1" />
                                <?php printf( __( 'Automatically assign new Files to this %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['circle']['s'] ) ?>
                            </label>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label>
                                <input type="checkbox" name="auto_add_pps" id="wpc_auto_add_pps" value="1" />
                                <?php printf( __( 'Automatically assign new %s to this %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal_page']['p'], $this->custom_titles['circle']['s'] ) ?>
                            </label>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label>
                                <input type="checkbox" name="auto_add_manual" id="wpc_auto_add_manual" value="1" />
                                <?php printf( __( 'Automatically assign new manual %s to this %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'], $this->custom_titles['circle']['s'] ) ?>
                            </label>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label>
                                <input type="checkbox" name="auto_add_self" id="wpc_auto_add_self" value="1" />
                                <?php printf( __( 'Automatically assign new self-registered %s to this %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'], $this->custom_titles['circle']['s'] ) ?>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
 $link_array = array( 'title' => sprintf( __( 'Assign %s to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'], $this->custom_titles['circle']['s'] ), 'text' => sprintf( __( 'Assign %s To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'], $this->custom_titles['circle']['s'] ), ); $input_array = array( 'name' => 'wpc_clients', 'id' => 'wpc_clients', 'value' => '', ); $additional_array = array( 'counter_value' => 0 ); $this->acc_assign_popup('client', 'wpclients_groups', $link_array, $input_array, $additional_array ); ?>
                        </td>
                    </tr>
                </table>
                <br>
                <div class="save_button">
                    <input type="submit" class="button-primary wpc_submit" id="add_group" value="<?php printf( __( 'Save %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['s'] ) ?>" />
                </div>
            </form>
        </div>

        <script type="text/javascript">
            function checked( name, data ) {
                jQuery( '#wpc_' + name ).prop( 'checked', ( data.params !== undefined && data.params[ name ] == true ) );
            }

            function set_data( data ) {
                if( data.action === undefined ) {
                    //clear
                    jQuery( '#wpc_circle_action' ).val( '' );
                    jQuery( '#wpc_circle_wpnonce' ).val( '' );
                    jQuery( '#wpc_clients' ).val( '' );
                    jQuery( '#wpc_id' ).val( '' );
                    jQuery( '#wpc_group_name' ).val( '' );
                    jQuery( '.counter_wpc_clients' ).text( '(0)' );
                } else if( 'edit_group' === data.action ) {
                    //edit
                    jQuery( '#wpc_circle_action' ).val( data.action );
                    jQuery( '#wpc_circle_wpnonce' ).val( data.wpnonce );
                    jQuery( '#wpc_id' ).val( data.id );
                    jQuery( '#wpc_group_name' ).val( data.params.group_name );
                    jQuery( '#wpc_clients' ).val( data.clients );
                    jQuery( '.counter_wpc_clients' ).text( '(' + data.count_clients + ')' );
                } else {
                    //create
                    jQuery( '#wpc_circle_action' ).val( data.action );
                    jQuery( '#wpc_circle_wpnonce' ).val( data.wpnonce );
                    jQuery( '#wpc_id' ).val( '' );
                    jQuery( '#wpc_group_name' ).val( '' );
                    jQuery( '#wpc_clients' ).val( '' );
                    jQuery( '.counter_wpc_clients' ).text( '(0)' );
                }
                checked( 'auto_select', data );
                checked( 'auto_add_files', data );
                checked( 'auto_add_pps', data );
                checked( 'auto_add_manual', data );
                checked( 'auto_add_self', data );

            }

            jQuery( document ).ready( function() {

                //reassign file from Bulk Actions
                jQuery( '#doaction2' ).click( function() {
                    var action = jQuery( 'select[name="action2"]' ).val() ;
                    jQuery( 'select[name="action"]' ).attr( 'value', action );

                    return true;
                });

                jQuery( '#add_circle, .wpc_edit_circle').each( function() {
                    jQuery(this).shutter_box({
                        view_type       : 'lightbox',
                        width           : '500px',
                        type            : 'inline',
                        href            : '#wpc_edit_circle',
                        title           : ( 'add_circle' === jQuery( this ).prop('id') )
                            ? '<?php echo esc_js( sprintf( __( 'New %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['s'] ) ); ?>'
                            : '<?php echo esc_js( sprintf( __( 'Edit %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['s'] ) ); ?>',
                        onClose         : function() {
                            set_data( '' );
                        }
                    });
                });

                jQuery( '#add_circle, .wpc_edit_circle').click( function() {
                    var obj = jQuery(this);
                    var id = obj.data('id');

                    obj.shutter_box('showPreLoader');
                    jQuery.ajax({
                        type     : 'POST',
                        dataType : 'json',
                        url      : '<?php echo get_admin_url() ?>admin-ajax.php',
                        data     : 'action=get_data_circle&id=' + id,
                        success: function( data ) {
                            set_data( data );
                        },
                        error: function(data) {
                            obj.shutter_box('close');
                        }
                    });

                });


                //Click for save circle
                jQuery('body').on('click', '#add_group', function() {
                    if ( !jQuery(this).parents( 'form').find("#wpc_group_name" ).val() ) {
                        jQuery(this).parents( 'form').find("#wpc_group_name" ).parent().parent().attr( 'class', 'wpc_error' );
                        return false;
                    } else {
                        jQuery(this).parents('form').submit();
                    }
                });

            });
        </script>

    </div>

</div>