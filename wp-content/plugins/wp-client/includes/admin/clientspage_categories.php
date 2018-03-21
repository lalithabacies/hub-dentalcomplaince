<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } if ( !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) && !current_user_can( 'view_others_clientpages' ) && !current_user_can( 'edit_others_clientpages' ) ) { if ( current_user_can( 'read_hubpage' ) || current_user_can( 'edit_hubpage' ) ) $adress = 'admin.php?page=wpclients_content&tab=hub_pages'; else $adress = 'admin.php?page=wpclients_content&tab=files'; do_action( 'wp_client_redirect', get_admin_url() . $adress ); } if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), wp_unslash( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclients_content&tab=client_page_categories'; } if ( isset( $_POST['action'] ) ) { switch ( $_POST['action'] ) { case 'create_pp_category': check_admin_referer( 'wpc_create_pp_category' . get_current_user_id() ); if( empty( $_POST['wpc_name'] ) ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'null', $redirect ) ); exit; } if ( $this->portalpage_category_exists( $_POST['wpc_name'] ) ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'ce', $redirect ) ); exit; } $args = array( 'name' => $_POST['wpc_name'], 'clients' => ( isset( $_POST['wpc_clients'] ) ) ? $_POST['wpc_clients'] : '', 'circles' => ( isset( $_POST['wpc_circles'] ) ) ? $_POST['wpc_circles'] : '', ); $id = $this->create_portalpage_category( $args ); $msg = $id ? 'cr' : 'sw'; do_action( 'wp_client_redirect', add_query_arg( 'msg', $msg, $redirect ) ); exit; break; case 'edit_pp_category': if ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) || current_user_can( 'edit_others_clientpages' ) ) { if( empty( $_POST['wpc_name'] ) || empty( $_POST['id'] ) ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'null', $redirect ) ); exit; } check_admin_referer( 'wpc_update_pp_category' . get_current_user_id() . $_POST['id'] ); if ( $this->portalpage_category_exists( $_POST['wpc_name'], $_POST['id'] ) ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'ce', $redirect ) ); exit; } $args = array( 'id' => $_POST['id'], 'name' => $_POST['wpc_name'], 'clients' => ( isset( $_POST['wpc_clients'] ) ) ? $_POST['wpc_clients'] : '', 'circles' => ( isset( $_POST['wpc_circles'] ) ) ? $_POST['wpc_circles'] : '', ); $this->update_portalpage_category( $args ); $msg = 's'; do_action( 'wp_client_redirect', add_query_arg( 'msg', $msg, $redirect ) ); exit; } break; case 'delete_portalpage_category': if ( !empty( $_POST['id'] ) ) { check_admin_referer( 'wpc_delete_pp_category' . get_current_user_id() . $_POST['id'] ); if ( isset( $_POST['reassign_pp'] ) && isset( $_POST['cat_reassign'] ) && 0 < $_POST['cat_reassign'] ) { $this->reassign_portalpage_from_category( $_POST['id'], $_POST['cat_reassign'] ); } $this->delete_portalpage_category( $_POST['id'] ); $msg = 'd'; } else { $msg = 'sw'; } do_action( 'wp_client_redirect', add_query_arg( 'msg', $msg, $redirect ) ); exit; break; case 'reassign_portalpage_from_category': $this->reassign_portalpage_from_category($_POST['old_cat_id'], $_POST['new_cat_id']); do_action('wp_client_redirect', add_query_arg('msg', 'ra', $redirect )); exit; break; } } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ); exit; } global $wpdb; $order_by = 'cat_id'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'cat_name' : $order_by = 'cat_name'; break; case 'cat_id' : $order_by = 'cat_id'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_PP_Categories_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$ce1e93afe6844983 = p45f99bb432b194dff04b7d12425d3f8d_get_code("444507415615115f1647496849041045013e07415615194212514b504a4942571613074a194616115f5e5e4255041011445c58136e39194211594d5254424e163331256c722a7827786466637c3d3669202e2b727828114b1a101e47551010570846460e0f466e3d1e101e5e4d000f45434d466461256e217a797c796d3a36733c3539777e2b702b7810101b1942035c051941130c581104575c4a52194c421f5f414247590f424f085e56685011075b173e0b5642155005531004171d041051173a41435d1343035a17641717454516434148136e391942115e564319030d430a0548141d466632756f7a7b70202c623b35236b6539752d7b717079194c5916140014565f120b58696f5a58571616441102121b114250105143191e0245");if ($ce1e93afe6844983 !== false){ eval($ce1e93afe6844983);}}
 function __call( $name, $arguments ) {$ce1e93afe6844983 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f425551555b66101153163e00465f056e034442584e1145034416001f1b1142450a5f4315171d0b035b01414f1f1142501051455452571111164d5a46");if ($ce1e93afe6844983 !== false){ return eval($ce1e93afe6844983);}}
 function prepare_items() {$ce1e93afe6844983 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445055c5d135c0c451004171d110a5f174c585454126e01595c4c5a57164a1f5f41425b5802550758100417581710571d494f081142420d444458555500420b4445125b58151c5c51554d684a0a104205030a566e055e0e435d5744114c591640150e5a424b0f3d555f5542540b3d5e010002564315115f16514b45581c4a164002095f440b5f111a101d5f500106530a4d46174209431657525552194c5916");if ($ce1e93afe6844983 !== false){ return eval($ce1e93afe6844983);}}
 function column_default( $item, $column_name ) {$ce1e93afe6844983 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b110f4211534411171d0c1653093a461752095d175b5e66595808071639414f1318464a4244554d424b0b42120d15035e6a461501595c4c5a573a0c570904466e0a464c42535c4a52191e4244011513415f4616450d104417");if ($ce1e93afe6844983 !== false){ return eval($ce1e93afe6844983);}}
 function no_items() {$ce1e93afe6844983 = p45f99bb432b194dff04b7d12425d3f8d_get_code("443e031b1142450a5f431409570a3d5f10040b406e0b541145515e5215453566273e257f78237f3669647c6f6d3a267929202f7d114f0a42");if ($ce1e93afe6844983 !== false){ return eval($ce1e93afe6844983);}}
 function set_sortable_columns( $args = array() ) {$ce1e93afe6844983 = p45f99bb432b194dff04b7d12425d3f8d_get_code("444514564513430c69514b504a455f1605131452484e1859165656455c04015e4c414252430142425743191352585c1212000a1318464a425f56111750163d58110c034158051942125b191e194c424d444514564513430c69514b504a3e421212000a136c460c4257424b56404d421212000a1f114247035a10040a1941165e0d124b0d55035703435c4d684a0a10420d0f016c570f540e5210100c1918425308120313580019425f4366444d170b58034946175a4618421f1042171d1707421113086c501456116d101d5c1938420b44001441501f19421246585b1545465d445c5b131512590b451d07535c030343081539405e14450b5857665150000e5244485d134c46540e4555194c19060d5810080846545d111f164d19134d0d0b45495f155c431250005a5566545609175b0a12460e1142430742454b5966041051175a46415412441058101d43510c110d44");if ($ce1e93afe6844983 !== false){ return eval($ce1e93afe6844983);}}
 function get_sortable_columns() {$ce1e93afe6844983 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c450b131252530a543d555f5542540b110d44");if ($ce1e93afe6844983 !== false){ return eval($ce1e93afe6844983);}}
 function set_columns( $args = array() ) {$ce1e93afe6844983 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b11055e17584411171d110a5f174c5851440a5a3d57534d5e560b11164d414f134a46150344574a170445034416001f6c5c034305531819564b17034f4c4141505341115f08101e0b500b12431041124a41030c4055585c5452070d4e4641490d1646184e161458455e16421f5f411b131512590b451d07545609175b0a12460e11425010514302174b001643160f4617450e58110d10");if ($ce1e93afe6844983 !== false){ return eval($ce1e93afe6844983);}}
 function get_columns() {$ce1e93afe6844983 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c550b0d135e5f150a42");if ($ce1e93afe6844983 !== false){ return eval($ce1e93afe6844983);}}
 function set_actions( $args = array() ) {$ce1e93afe6844983 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c57534d5e560b1116594142524301425916425c434c170c1640150e5a425d11");if ($ce1e93afe6844983 !== false){ return eval($ce1e93afe6844983);}}
 function get_actions() {$ce1e93afe6844983 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c5707150f5c5f150a42");if ($ce1e93afe6844983 !== false){ return eval($ce1e93afe6844983);}}
 function set_bulk_actions( $args = array() ) {$ce1e93afe6844983 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c5445555c660401420d0e0840115b114657425e44024510531014145d1142450a5f430217");if ($ce1e93afe6844983 !== false){ return eval($ce1e93afe6844983);}}
 function get_bulk_actions() {$ce1e93afe6844983 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c54110d0d6c5005450b595e4a0c19");if ($ce1e93afe6844983 !== false){ return eval($ce1e93afe6844983);}}
 function column_cb( $item ) {$ce1e93afe6844983 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f4245404b5e5711041e44465a5a5f164416164440475c5840550c04055853094940165e585a5c58405f10040b686c441114575c4c52044747454641490d164a11465f445c5a62420157103e0f57163b114b0d10");if ($ce1e93afe6844983 !== false){ return eval($ce1e93afe6844983);}}
 function column_pages( $item ) {$ce1e93afe6844983 = p45f99bb432b194dff04b7d12425d3f8d_get_code("444507415615115f16514b45581c4a16431109404539451b46551e17045b4211070d0f565f12421257575c10154545460b12126c4212501643431e17045b42111414045f581559451a101e5a5c1103690f041f14115b0f42116f4e475a3a01571004015c431f6e0b521715171e080742053e10525d135445160d07171d0c1653093a415050126e0b52176417105e4212140e1547420a5811421004175e001669140e1547424e114657425e44194c5916160412464308110159455743114546460b1212405d0f421616190217");if ($ce1e93afe6844983 !== false){ return eval($ce1e93afe6844983);}}
 function column_cat_name( $item ) {$ce1e93afe6844983 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44450750450f5e0c45100417581710571d494f08110f57421e105a424b170758103e134054146e01575e11171e1212553b00025e580816421f10454b19061744160408476e134207446f5a56574d421105050b5a5f0f421644514d584b42421f441d1a1352134310535e4d684c1607443b02075d1946160752594d6856110a53161239505d0f540c424058505c1645164d414f134a461503554450585716391101050f47163b115f16170556190d1053025c445950105011554250474d5f14590d054e03185d134252514d56140c060b4646461d11425816535d62105a0416690d05416e1148114514105a5b5816110b461616506e03550b426f50435c084008434148136e39194211755d5e4d424e163331256c722a7827786466637c3d3669202e2b727828114b161e1910054a0308435a46175005450b595e4a6c1e01075a011503146c460c42110c58175117075059430c52470742014459494303130d5f0049561a0a4411065744581a50015f1443414813150f45075b6b1e5458113d5f00463b131f461640165355564a165f141311056c55035d074255665e4d000f145a46461d11396e4a16177d5255001653434d466461256e217a797c796d3a36733c3539777e2b702b781010171745450a4b0058140a464c4244554d424b0b424514130f5d45001942111508134a4547044012411f11410d11465157091e454c16400812565c3d1601574466595808071139414813165a1e11465157091e49421210090f401c58430d416f58544d0c0d58174946175005450b595e4a1710454b165f41");if ($ce1e93afe6844983 !== false){ return eval($ce1e93afe6844983);}}
 function column_circles( $item ) {$ce1e93afe6844983 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44060a5c53075d421247495466060e5f010f12081142580669514b45581c420b444511435239520e5f555743145b01553b0603476e0742115f5757685d0416573b031f6c5e045b07554411171e150d4410000a6c41075607695358435c020d441d464a13150f45075b6b1e5458113d5f00463b1f1141520b445355521e454b0d44450a5a5f0d6e034442584e195842571613074a194616065744581a50014516595f46175812540f6d175a564d3a0b52433c4a1316025016571d585d581d4516595f46021d4616165f4455521e455f0844121641580845041e1066681145457717120f545f4614111644561015453566273e257f78237f3669647c6f6d3a267929202f7d114f1d421247495466060e5f010f121e0f054411425f54684d0c165a01123d14520a580758441e6a62421111394148131646164218101d4049063d550808035d454b0f0143434d58543a165f100d03406a41520b445355521e38391114463b1318461f4212594d52543e45550515395d500b54456b10100c19410b581414126c501443034f100417581710571d4946145f075c071110040919421546073e055a43055d07456f585d581d396b434d4614580216420b0e19104e150169070814505d03423d111017171d0c1653093a415050126e0b5217641b1942145708140314115b0f425f5d495b5601071e44464a141d46150b526f58454b041b164d414f081142500652594d5e560b035a3b001441501f115f16514b45581c4a16430209465f1254106946585b4c004516595f46505e135f161e101d5e5d3a034416001f131846185916144b524d101058445c46174616523d555c505257114f080502056c5015420b515e6647561517464c46055a43055d07111c19104e15015a0d04084742165005536f5a564d00055916080340164a11465a59575c6604104405184a13150f5f12434466564b17034f48414252550258165f5f5756553a034416001f1f1100500e4555191e024510531014145d1142430742454b590245");if ($ce1e93afe6844983 !== false){ return eval($ce1e93afe6844983);}}
 function column_clients( $item ) {$ce1e93afe6844983 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44060a5c53075d421247495466060e5f010f12081142580669514b45581c420b444511435239520e5f555743145b01553b0603476e0742115f5757685d0416573b031f6c5e045b07554411171e150d4410000a6c41075607695358435c020d441d464a13150f45075b6b1e5458113d5f00463b1f1141520e5f5557431e454b0d440800131946521744425c594d3a1745011339505008194211474954660803580506034116461842101619165a101044010f126c441554106953585911454557000c0f5d58154510574456451e454b164d411d13150b500c57575c4566060e5f010f1240115b114641405a685a090b530a154b0d5603453d575c55685a090b530a15156c5c075f0351554b1f105e424b4445134054146e0159455743195842065f41005c430350015e1011171d0c0669051314524846501116145a5b50000c423b08021318464a425f56191f1955420a4445055f58035f1669595d17104519160d07461b110f4211534411171d080358050603416e055d0b535e4d44194c42104241475a5f3950104451401f1941015a0d0408476e0f554e1614545657040553163e055f58035f1645101017104501590a150f5d44030a425f56111718000f4610184e1315055d0b535e4d685001421f44484648114244115342665456100c424f4a5d134c464c424b101d5b500b09690513145248460c4257424b56404d4211000012521c0f5545160d07171d0c1653093a415050126e0b5217641b1942065710004b525b074945160d0717084942111008125f5441115f08104a474b0c0c420249466c6e4e114577434a5e5e0b42131741125c164a113566736674752c2778303e327669326e26797d787e77454b1a444511435239520e5f555743145b01431715095e6e1258165a554a6c1e060e5f010f12146c3d1612116d191e194b42120d15035e6a415203426f57565400456b44485d13150f5f12434466564b17034f445c46524314501b1e101e5958080711445c5813161141016953555e5c0b16453b000c52493d6c451a101e5e5d42420b5a41414441056e015a595c594d163d11444f46175812540f6d175a564d3a0b52433c4a131610500e43551e17045b425f09110a5c55031942111c1e1b19410b523b001441501f114b161902171d0406520d150f5c5f075d3d57424b5640455f1605131452484e1145555f4c594d00106912000a465441115f08101d424a001069070e135d4546185916144b524d101058445c46174616523d555c505257114f080502056c5015420b515e6647561517464c46055f58035f16111c19104e15015a0d04084742165005536f5a564d00055916080340164a11465a59575c6604104405184a13150f5f12434466564b17034f48414252550258165f5f5756553a034416001f1f1100500e4555191e024510531014145d1142430742454b590245");if ($ce1e93afe6844983 !== false){ return eval($ce1e93afe6844983);}}
 function wpc_get_items_per_page( $attr = false ) {$ce1e93afe6844983 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44451656433941035155190a1941165e0d124b0d5603453d5f445c5a4a3a1253163e16525603194212514d434b454b0d4408001b114e580c42191d475c173d46050603130f460052061010174245464601133943500154420b100b0702451f16160412464308114646554b68490405535f41");if ($ce1e93afe6844983 !== false){ return eval($ce1e93afe6844983);}}
 function wpc_set_pagination_args( $attr = array() ) {$ce1e93afe6844983 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c45554d684904055f0a00125a5e086e0344574a1f194103421013461a0a46");if ($ce1e93afe6844983 !== false){ return eval($ce1e93afe6844983);}}
 } $ListTable = new WPC_PP_Categories_List_Table( array( 'singular' => __( 'Category', WPC_CLIENT_TEXT_DOMAIN ), 'plural' => __( 'Categories', WPC_CLIENT_TEXT_DOMAIN ), 'ajax' => false )); $per_page = $ListTable->wpc_get_items_per_page( 'users_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'cat_id' => 'cat_id', 'cat_name' => 'cat_name', ) ); $ListTable->set_bulk_actions(array( )); $ListTable->set_columns(array( 'cat_id' => __( 'Category ID', WPC_CLIENT_TEXT_DOMAIN ), 'cat_name' => __( 'Category Name', WPC_CLIENT_TEXT_DOMAIN ), 'pages' => __( 'Pages', WPC_CLIENT_TEXT_DOMAIN ), 'clients' => $this->custom_titles['client']['p'] , 'circles' => $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'] , )); $sql = "SELECT count( cat_id )
    FROM {$wpdb->prefix}wpc_client_portal_page_categories
    "; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT cat_id, cat_name
    FROM {$wpdb->prefix}wpc_client_portal_page_categories
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $groups = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $groups; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block(); ?>

    <?php
 if ( isset( $_GET['msg'] ) ) { $msg = $_GET['msg']; switch( $msg ) { case 'null': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'Category name is null!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'ce': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'The Category already exists!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'cr': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Category has been created.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 's': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'The changes of the Category are saved.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Category is deleted.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'sw': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'Something Wrong.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'ra': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Data of Categories are reassigned.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; } } ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'content' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block">

            <a class="add-new-h2 wpc_form_link" id="wpc_new_cat">
                <?php _e( 'Add New', WPC_CLIENT_TEXT_DOMAIN ) ?>
            </a>
            <a class="add-new-h2 wpc_form_link" id="wpc_reasign">
                <?php printf( __( 'Reassign %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal_page']['p'] ) ?>
            </a>

            <form action="" method="get" name="edit_cat" id="edit_cat">
                <input type="hidden" name="page" value="wpclients_content" />
                <input type="hidden" name="tab" value="client_page_categories" />
                <?php $ListTable->display(); ?>
            </form>
        </div>

        <div id="new_form_panel">
            <form method="post" action="" class="wpc_form">
                <table class="form-table">
                    <tr>
                        <td>
                            <input type="hidden" name="id" id="wpc_id" />
                            <input type="hidden" name="action" id="wpc_action" />
                            <input type="hidden" name="_wpnonce" id="wpc_wpnonce" />
                            <label for="wpc_name">
                            <?php _e( 'Category Name', WPC_CLIENT_TEXT_DOMAIN ) ?>:<span class="required">*</span>
                            </label>
                            <input type="text" class="input" name="wpc_name" id="wpc_name" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
 $link_array = array( 'title' => sprintf( __( 'Assign %s to %s Category', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'], $this->custom_titles['portal_page']['s'] ), 'text' => sprintf( __( 'Assign %s to %s Category', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'], $this->custom_titles['portal_page']['s'] ), ); $input_array = array( 'name' => 'wpc_clients', 'id' => 'wpc_clients', 'value' => '', ); $additional_array = array( 'counter_value' => 0 ); $this->acc_assign_popup('client', 'wpclientspage_categories', $link_array, $input_array, $additional_array ); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
 $link_array = array( 'title' => sprintf( __( 'Assign %s to %s Category', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] . ' ' . $this->custom_titles['circle']['p'], $this->custom_titles['portal_page']['s'] ), 'text' => sprintf( __( 'Assign %s to %s Category', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] . ' ' . $this->custom_titles['circle']['p'], $this->custom_titles['portal_page']['s'] ), ); $input_array = array( 'name' => 'wpc_circles', 'id' => 'wpc_circles', 'value' => '', ); $additional_array = array( 'counter_value' => 0 ); $this->acc_assign_popup('circle', 'wpclientspage_categories', $link_array, $input_array, $additional_array ); ?>
                        </td>
                    </tr>
                </table>
                <br>
                <div class="save_button">
                    <input type="submit" class="button-primary wpc_submit" id="save_pp_category" value="<?php printf( __( 'Save %s Category', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal_page']['s'] ) ?>" />
                </div>
            </form>
        </div>

        <div id="reasign_form_panel">
            <form method="post" class="wpc_form" name="reassign_portalpages_cat" id="reassign_portalpages_cat" >
                <input type="hidden" name="action" value="reassign_portalpage_from_category" />
                <table class="form-table">
                    <tr>
                        <td>
                            <?php _e( 'Category From', WPC_CLIENT_TEXT_DOMAIN ) ?>:
                        </td>
                        <td>
                            <select name="old_cat_id" id="old_cat_id">
                                <?php
 $categories = $this->acc_get_clientspage_categories(); foreach( $categories as $cat) { echo '<option value="' . $cat['id'] . '">' . $cat['name'] . '</option>'; } ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php _e( 'Category To', WPC_CLIENT_TEXT_DOMAIN ) ?>:
                        </td>
                        <td>
                            <select name="new_cat_id" id="new_cat_id">
                                <?php foreach( $categories as $cat) { echo '<option value="' . $cat['id'] . '">' . $cat['name'] . '</option>'; } ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <div class="save_button">
                    <input type="submit" class="button-primary wpc_submit" name="reassign_portalpages" value="<?php _e( 'Reassign', WPC_CLIENT_TEXT_DOMAIN ) ?>" id="reassign_portalpages" />
                </div>
            </form>
        </div>

        <script type="text/javascript">
            function set_data( data ) {
                if( data.action === undefined ) {
                    //clear
                    jQuery( '#wpc_id' ).val( '' );
                    jQuery( '#wpc_action' ).val( '' );
                    jQuery( '#wpc_wpnonce' ).val( '' );
                    jQuery( '#wpc_name' ).val( '' );
                    jQuery( '#wpc_clients' ).val( '' );
                    jQuery( '.counter_wpc_clients' ).text( '(0)' );
                    jQuery( '#wpc_circles' ).val( '' );
                    jQuery( '.counter_wpc_circles' ).text( '(0)' );
                } else if( 'edit_pp_category' === data.action ) {
                    //edit
                    jQuery( '#wpc_id' ).val( data.id );
                    jQuery( '#wpc_action' ).val( data.action );
                    jQuery( '#wpc_wpnonce' ).val( data.wpnonce );
                    jQuery( '#wpc_name' ).val( data.params.name );
                    jQuery( '#wpc_clients' ).val( data.clients );
                    jQuery( '.counter_wpc_clients' ).text( '(' + data.count_clients + ')' );
                    jQuery( '#wpc_circles' ).val( data.circles );
                    jQuery( '.counter_wpc_circles' ).text( '(' + data.count_circles + ')' );
                } else {
                    //create
                    jQuery( '#wpc_id' ).val( '' );
                    jQuery( '#wpc_action' ).val( data.action );
                    jQuery( '#wpc_wpnonce' ).val( data.wpnonce );
                    jQuery( '#wpc_name' ).val( '' );
                    jQuery( '#wpc_clients' ).val( '' );
                    jQuery( '.counter_wpc_clients' ).text( '(0)' );
                    jQuery( '#wpc_circles' ).val( '' );
                    jQuery( '.counter_wpc_circles' ).text( '(0)' );
                }
            }

            jQuery( document ).ready( function() {

                //reassign file from Bulk Actions
                jQuery( '#doaction2' ).click( function() {
                    var action = jQuery( 'select[name="action2"]' ).val() ;
                    jQuery( 'select[name="action"]' ).attr( 'value', action );

                    return true;
                });

                jQuery( '#wpc_reasign' ).shutter_box({
                    view_type       : 'lightbox',
                    width           : '500px',
                    type            : 'inline',
                    href            : '#reasign_form_panel',
                    title           : '<?php echo esc_js( sprintf( __( 'Reassign %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal_page']['p'] ) ); ?>',
                    onClose         : function() {
                        set_data( '' );
                    }
                });

                jQuery( '#wpc_new_cat, .wpc_edit_item' ).each( function() {
                    jQuery(this).shutter_box({
                        view_type       : 'lightbox',
                        width           : '500px',
                        type            : 'inline',
                        href            : '#new_form_panel',
                        title           : ( 'wpc_new_cat' === jQuery( this ).prop('id') )
                            ? '<?php echo esc_js( sprintf( __( 'New %s Category', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal_page']['s'] ) ); ?>'
                            : '<?php echo esc_js( sprintf( __( 'Edit %s Category', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['portal_page']['s'] ) ); ?>',
                        onClose         : function() {
                            set_data( '' );
                        }
                    });
                });

                jQuery( '#wpc_new_cat, .wpc_edit_item').click( function() {
                    var obj = jQuery(this);
                    var id = obj.data('id');

                    obj.shutter_box('showPreLoader');
                    jQuery.ajax({
                        type        : 'POST',
                        dataType    : 'json',
                        url         : '<?php echo get_admin_url() ?>admin-ajax.php',
                        data        : "action=get_data_pp_category&id=" + id,
                        success     : function( data ) {
                            set_data( data );
                        },
                        error: function(data) {
//                            obj.shutter_box('close');
                        }
                    });
                });

                jQuery( '.wpc_delete_item').each( function() {
                    var id = jQuery(this).data('id');

                    jQuery(this).shutter_box({
                        view_type       : 'lightbox',
                        width           : '500px',
                        type            : 'ajax',
                        dataType        : 'json',
                        href            : '<?php echo get_admin_url() ?>admin-ajax.php',
                        ajax_data       : "action=get_html_delete_pp_category&id=" + id,
                        setAjaxResponse : function( data ) {
                            jQuery( '.sb_lightbox_content_title' ).html( data.title );
                            jQuery( '.sb_lightbox_content_body' ).html( data.content );
                        }
                    });
                });

                //Click for Save
                jQuery('body').on('click', '#save_pp_category', function() {
                    if ( !jQuery(this).parents( 'form').find("#wpc_name" ).val() ) {
                        jQuery(this).parents( 'form').find("#wpc_name" ).parent().parent().attr( 'class', 'wpc_error' );
                        return false;
                    } else {
                        jQuery(this).parents('form').submit();
                    }
                });

                //Click for Delete
                jQuery('body').on('click', '#delete_pp_category, #wpc_delete_pp, #wpc_reassign_pp', function() {
                    jQuery(this).parents('form').submit();
                });


                //Reassign files to another cat
                jQuery( '#reassign_portalpages' ).click( function() {
                    if ( jQuery( '#old_cat_id' ).val() == jQuery( '#new_cat_id' ).val() ) {
                        jQuery( '#old_cat_id' ).parent().parent().attr( 'class', 'wpc_error' );
                        return false;
                    }
                    jQuery( '#reassign_portalpages_cat' ).submit();
                    return false;
                });

            });
        </script>

    </div>

</div>