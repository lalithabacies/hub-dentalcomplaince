<?php
global $wpdb, $wpc_client; if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), wp_unslash( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpc_private_post_types'; } if ( isset( $_GET['action'] ) ) { switch ( $_GET['action'] ) { case 'assign_client': $ids = array(); if( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( __('post types') ) ); $ids = $_REQUEST['item']; } $assigns = ( !empty( $_REQUEST['assigns'] ) ) ? explode( ',', $_REQUEST['assigns'] ) : array(); foreach( $ids as $post_id ) { $wpc_client->cc_set_assigned_data( 'private_post', $post_id, 'client', $assigns ); } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'cla', $redirect ) ); exit; break; case 'assign_circle': $ids = array(); if( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( __('post types') ) ); $ids = $_REQUEST['item']; } $assigns = ( !empty( $_REQUEST['assigns'] ) ) ? explode( ',', $_REQUEST['assigns'] ) : array(); foreach( $ids as $post_id ) { $wpc_client->cc_set_assigned_data( 'private_post', $post_id, 'circle', $assigns ); } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'cia', $redirect ) ); exit; break; case 'cancel_protect': if( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { do_action( 'wp_client_redirect', $redirect ); exit; } $ids = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'wpc_cancel_protect' . $_REQUEST['id'] . get_current_user_id() ); $ids = ( is_array( $_REQUEST['id'] ) ) ? $_REQUEST['id'] : (array) $_REQUEST['id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( __('post types') ) ); $ids = $_REQUEST['item']; } foreach( $ids as $post_id ) { delete_post_meta( $post_id, '_wpc_protected' ); } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'canceled_protect', $redirect ) ); exit; break; } } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ); exit; } $where_clause = ''; if( !empty( $_GET['s'] ) ) { $where_clause .= $wpc_client->get_prepared_search( $_GET['s'], array( 'p.post_title', ) ); } if( !empty( $_GET['p_type'] ) ) { $where_clause .= " AND p.post_type = '" . trim( esc_sql( $_GET['p_type'] ) ) . "'"; } if( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { $manager_id = get_current_user_id(); $manager_clients = $wpc_client->cc_get_assign_data_by_object( 'manager', $manager_id, 'client' ); $manager_groups = $wpc_client->cc_get_assign_data_by_object( 'manager', $manager_id, 'circle' ); $clients_groups = array(); foreach ( $manager_groups as $group_id ) { $clients_groups = array_merge( $clients_groups, $wpc_client->cc_get_group_clients_id( $group_id ) ); } $manager_all_clients = array_unique( array_merge( $manager_clients, $clients_groups ) ); $groups_clients = array(); foreach ( $manager_clients as $client_id ) { $groups_clients = array_merge( $groups_clients, $wpc_client->cc_get_client_groups_id( $client_id ) ); } $manager_all_groups = array_unique( array_merge( $manager_groups, $groups_clients ) ); if( count( $manager_all_clients ) || count( $manager_all_groups ) ) { $where_clause .= " AND ( "; if( count( $manager_all_clients ) ) { $private_ids = $wpc_client->cc_get_assign_data_by_assign( 'private_post', 'client', $manager_all_clients ); $where_clause .= "p.ID IN('" . implode( "','", $private_ids ) . "')"; } if( count( $manager_all_groups ) ) { if( count( $manager_all_clients ) ) { $where_clause .= " OR "; } $private_ids = $wpc_client->cc_get_assign_data_by_assign( 'private_post', 'circle', $manager_all_groups ); $where_clause .= "p.ID IN('" . implode( "','", $private_ids ) . "')"; } $where_clause .= " )"; } } $order_by = 'p.ID'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'date' : $order_by = 'p.post_modified'; break; default : $order_by = 'p.' . esc_sql( $_GET['orderby'] ); break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Protected_Posts_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$cff9a58e718f79d9 = pb17dfb706b0f7810f499e85658ad990f_get_code("154502445f4a41084240456848051345503e02445f4a4915465647504b4841574713024f101946460b59524254051311155c5d1667664915455e415255434d16623120696869356a36726d6367202e7b74282d1611154112125b404559084616085f4369671141120b43505a4b434d16623120696869356a36726d6367202e7b74282d1611154112035d544f1f445c081507025a4b5c411c421e0e171c10095f464c5d5857660841075a46685501124554060616051945541050466c1f140d4347000f1165194f154517121716443e691d414458574d41530d425b5316434d16623120696869356a36726d6367202e7b74282d1611024145034550594c5e5b696a020c584b4d134001431d171c05135146414a0d18");if ($cff9a58e718f79d9 !== false){ eval($cff9a58e718f79d9);}}
 function __call( $name, $arguments ) {$cff9a58e718f79d9 = pb17dfb706b0f7810f499e85658ad990f_get_code("151306424d4b0f150156595b67111253473e0543565a3e541045544e1044004447001a1e181d155d0b4419171c0a005b50414a1a181d004705425852561012161c5a43");if ($cff9a58e718f79d9 !== false){ return eval($cff9a58e718f79d9);}}
 function prepare_items() {$cff9a58e718f79d9 = pb17dfb706b0f7810f499e85658ad990f_get_code("15450059544c0c5b111708171c10095f464c5d515d4d3e560d5b405a5617491f0e41475e515d05500c170817591613574c494a0d181d125a104354555401410b1545175e514a4c0b055241684b0b134254030f53675a0e59175a5b44104d5a1611150b5f4b145f6a01585942550a3e5e500007534a4a410842564745591d491611020c5a4d540f464e17115f510005535b4d43124b56134103555952184d5a16");if ($cff9a58e718f79d9 !== false){ return eval($cff9a58e718f79d9);}}
 function column_default( $item, $column_name ) {$cff9a58e718f79d9 = pb17dfb706b0f7810f499e85658ad990f_get_code("1508051e1850124607431d171c0d1553583a43125b560d400f596a595909041668414a1611191a15105241424a0a41125c15065b631945560d5b405a563b0f575804436b03191c15075b4652181f4144501516445619461259174817");if ($cff9a58e718f79d9 !== false){ return eval($cff9a58e718f79d9);}}
 function no_items() {$cff9a58e718f79d9 = pb17dfb706b0f7810f499e85658ad990f_get_code("153e061e181d155d0b441809560b3e5f41040e45675404461156525214443666763e33666c6635703a636a737729207f7b414a0d18");if ($cff9a58e718f79d9 !== false){ return eval($cff9a58e718f79d9);}}
 function set_sortable_columns( $args = array() ) {$cff9a58e718f79d9 = pb17dfb706b0f7810f499e85658ad990f_get_code("154511534c4c135b3d5647504b445c16541311574111480e42515a455d05025e1d4147574a5e12150344151353595f1243000f1611191a150b511d1751173e58400c0644515a4915465c151e184d414d154511534c4c135b3d5647504b3f411243000f1665195c1503454756414c411243000f1a181d17540e17080a1840155e5c124e085c5c0754175b41684b0b13425c0f04695e50045906171c0c1819415359120616515f49150b446a444c16085852494312531948154b174e171c16044240130d69594b06463917115c1839410b15001144594049154641545b1444455d155c5e161c4d095c111a0b535d02004359153c45574b155c0c506a5151010d5215485816451904591152154c18070e5841080d435d024148424a15134c0c0845185f10594a4d00570e526a545708145b5b12430b181d13501642475967051351465a43445d4d14470c171143500d120d15");if ($cff9a58e718f79d9 !== false){ return eval($cff9a58e718f79d9);}}
 function get_sortable_columns() {$cff9a58e718f79d9 = pb17dfb706b0f7810f499e85658ad990f_get_code("151306424d4b0f1546435d5e4b495f455a1317575a55046a01585942550a120d15");if ($cff9a58e718f79d9 !== false){ return eval($cff9a58e718f79d9);}}
 function set_columns( $args = array() ) {$cff9a58e718f79d9 = pb17dfb706b0f7810f499e85658ad990f_get_code("1508051e185a0e400c431d171c10095f464c5d544d550a6a0354415e570a12161c414a1643194554105046170544004447001a69555c1352071f15564a16004f1d4144555a1e41085c17120b510a11434141174f485c5c17015f505453060e4e17414c081f194819421354455f17411f0e411e161c4d095c111a0b545708145b5b12430b181d004705440e174a011543470f43124c5108465917");if ($cff9a58e718f79d9 !== false){ return eval($cff9a58e718f79d9);}}
 function get_columns() {$cff9a58e718f79d9 = pb17dfb706b0f7810f499e85658ad990f_get_code("151306424d4b0f1546435d5e4b495f555a0d165b564a5a15");if ($cff9a58e718f79d9 !== false){ return eval($cff9a58e718f79d9);}}
 function set_actions( $args = array() ) {$cff9a58e718f79d9 = pb17dfb706b0f7810f499e85658ad990f_get_code("1545175e514a4c0b0354415e570a1216084147574a5e120e424550434d160f1611150b5f4b0241");if ($cff9a58e718f79d9 !== false){ return eval($cff9a58e718f79d9);}}
 function get_actions() {$cff9a58e718f79d9 = pb17dfb706b0f7810f499e85658ad990f_get_code("151306424d4b0f1546435d5e4b495f5756150a59564a5a15");if ($cff9a58e718f79d9 !== false){ return eval($cff9a58e718f79d9);}}
 function set_bulk_actions( $args = array() ) {$cff9a58e718f79d9 = pb17dfb706b0f7810f499e85658ad990f_get_code("1545175e514a4c0b0042595c670502425c0e0d4518044111034552440344135341141158181d155d0b440e17");if ($cff9a58e718f79d9 !== false){ return eval($cff9a58e718f79d9);}}
 function get_bulk_actions() {$cff9a58e718f79d9 = pb17dfb706b0f7810f499e85658ad990f_get_code("151306424d4b0f1546435d5e4b495f54400d0869595a155c0d59460c18");if ($cff9a58e718f79d9 !== false){ return eval($cff9a58e718f79d9);}}
 function column_cb( $item ) {$cff9a58e718f79d9 = pb17dfb706b0f7810f499e85658ad990f_get_code("151306424d4b0f151147475e5610071e15465f5f5649144142434c475d5943555d04005d5a5619174259545a5d59435f41040e6d651b4143035b40520546444517414c081f1541110b43505a63430852123c431f0319");if ($cff9a58e718f79d9 !== false){ return eval($cff9a58e718f79d9);}}
 function column_post_title( $item ) {$cff9a58e718f79d9 = pb17dfb706b0f7810f499e85658ad990f_get_code("15060f595a580d154640455467070d5f500f170d181d0056165e5a594b445c16541311574111480e425e531f18454916561411445d57156a17445045670700581d414441485a3e58035954505d1646161c41451018180240104550594c3b144550133c55595749154556515a510a084541130242574b46154b171c1711441a161100004251560f46391050535110466b155c43110458415d1052530a1a140e45414f135e4806115a11430810184a41125c15065b631e0851456a15191843475756150a59560404510b4317174c0d155a505c41111817415011546a564c10131e153e3c1e181e24510b43154759030411194134667b6631653668617260303e727a2c227f761948154b171b171f4641160b46431818663e1d421070535110461a15363375676931613d63706f6c3b257978202a781810411b42100918595a460d151c4312595a155c0d59466c1f00045a5015061165195c15450b5417570a025a5c02080b641e13501642475918070e585308115b101b46154c176a68104446774704434f574c414617455017410b141642000d42184d0e1521565b545d084166470e17535b4d5e124e1762677b3b3166613e3773606d3e712d7a747e764448161b41441411023d12425f47525e594357510c0a58164909455d4754505d591646563e1344514f0041076845584b103e424c1106451e5802410b585b0a5b050f55500d3c464a5615500143135e5c5946161b41475f4c5c0c6e455e511065444f1612473c4148570e5b01520810184a4141453e00445d5815503d595a595b01491612161355675a005b0152596848160e4250021711181741110b43505a63430852123c4318185e04413d5440454a010f426a1410534a6608514a1e151e184a4111133e144667511541126847525e011353475c4416161914470e525b545700041e151613694d57125903445d1f18403e65703335736a624667276660726b303e636728446b1810411c421915101a44155f410d060b1a1e411b4252465467051542474943696711411221565b545d084166470e17535b4d41530d451543500d1216450004531f15416232746a6768303e62703937697c762c742b79151e184d411815464116180746154c176a6810444675540f0053541931470d4350544c434d16623120696869356a36726d6367202e7b74282d1611194f15450b1a5606435a16470417434a57414612455c594c02491110504745181c5311111019171f5803080900435e4a5c070840475a444c4a115e455e13594b4d5c12421915135110045b6e460a521f64411b421013565b1008595b5c0652514d430b45171b1710444916124643170519455c1652586c1f1008425904446b1810410a42135c435d093a114108175a5d1e3c155817121f1f444f166a3e4b161f570e15165e415b5d434d16623120696869356a36726d6367202e7b74282d1611194f15451e121711444f16125d4c5706054e575c1019171c10095f464c5d44574e3e5401435c58561749161100004251560f46421e151e0344");if ($cff9a58e718f79d9 !== false){ return eval($cff9a58e718f79d9);}}
 function column_clients( $item ) {$cff9a58e718f79d9 = pb17dfb706b0f7810f499e85658ad990f_get_code("15060f595a580d154640455467070d5f500f170d181d1446074546170544454145023c555450045b161a0b545b3b0653413e02454b50065b3d535443593b034f6a0e015c5d5a151d4210454551120042503e13594b4d461942135c435d093a115c05446b141946560e5e50594c43411f0e410a501019405c116854454a05181e154516455d4b12154b171c174344454346041145180441541045544e104d5a1648410a50181141561745475256103e43460411695b580f1d421042475b3b0c575b0004534a1e411c421113171907144447040d42674c125010685656564c411154050e5f56501241105641584a43411f1548434d181d02590b525b434b445c1611161355675a0d5c0759411a0607026952041769594a125c05596a535910006957183c595a530456161f151055050f575204111114190650166856424a160458413e16455d4b3e5c061f1c1b1843025a5c040d421f19480e4213585656050653473e0444574c1146420a15134f140269560d0a53564d4c0b01546a505d103e5746120a515666055416566a55413b0e545f04004210194658035954505d16461a15060642675a144710525b4367111253473e0a5210104d1545545c455b080411154858165e56135003545d171044455b540f02515d4b3e52105840474b44004515450444574c116a0b53151e181f4112540507695b5508500c43150a18401646563e005a515c0f414f095654670304426a0611594d493e560e5e50594c173e5f514943125f4b0e4012685c53184d5a1611020f5f5d571546420a15564a16004f6a0c06445f5c49154654595e5d0a1545194147575c5d3e560e5e50594c44480d151c43125b5508500c4346170544004447001a694d57084417521d171c070d5f500f174518105a15465a50595d000653473e16455d4b12155f1754454a05181e1c5a4350574b0454015f151f1840144550131016594a4111015b5c5256103e5f51414a1643190853421f150718584112560d0a53564d3e5c06171c174344085015494317514a1250161f15135b0808535b15101611191d4942165c596705134454184b161c5a0d5c0759416851004d1611020f5f5d571546421e151e18070e5841080d435d02415c041f15165d0911424c4943125b5508500c436a5e5c4448161c4118161c54045b075352524a3b14455013106d65195c154654595e5d0a15695c05581645191c151f1711424b011345155c4312555c0f50065050456711125347125816451904560a5815100400084015020f574b4a5c171154475854083e5254150214061e5a15465b5c59533b004447001a160519004710564c1f1843055741004e5f5c1e41085c17115e4c010c6d12080711651541120656415615050b574d46430b061950194210415e4c080411155c5d164b49135c0c43531f183b3e1e154622454b50065b421246174c0b461a15363375676931613d63706f6c3b257978202a7818104d154640455467070d5f500f171b065a1446165858684c0d155a501238115b5508500c43126a6343111168414a16110241110b5945424c3b004447001a160519004710564c1f18430f575804441605074112154756685b0808535b1510695953004d396a121b1843085212415e08181e16450168565b51010f42463e44161619455c1652586c1f0d0511684d43114e580d400710150a0644085b450d0c525d1141124e1019171c1112534712431f18105a1546565153511008595b000f69594b13541b170817591613574c4943115b56145b165247684e050d435046430b0619025a1759411f18401445501310161119480e421342475b3b025a5c040d4215070056016854444b0d06586a110c464d4949154554595e5d0a151119414441485a3e45105e43564c013e465a1217694c401150111019171c0808585e3e02444a58181942135c594811156954131157411541110353515e4c0d0e58540d3c574a4b004c421e0e175d07095915465f195c50170b450c15");if ($cff9a58e718f79d9 !== false){ return eval($cff9a58e718f79d9);}}
 function column_groups( $item ) {$cff9a58e718f79d9 = pb17dfb706b0f7810f499e85658ad990f_get_code("15060f595a580d154640455467070d5f500f170d185c025d0d17120b5c0d1716560d02454b04434601455a5b543b0557410041081f0241110b536a564a16004f155c43124f49026a015b5c5256104c0856023c515d4d3e5411445c50563b055741003c5441660e570852564310444646470815574c5c3e450d4441101444455f41040e6d1f5005123f1b15105b0d1355590444161102415c041f151651173e574713024f1019455c066854454a0518161c414a164319455c066854454a051816084102444a58181d4b0c154a180d07161d4100434a4b045b166840445d163e55540f4b161f4e11563d5a54595903044412414a161e1f4114014247455d0a156940120644675a005b4a1712565c0908585c121744594d0e4745171c1711441a16110c0258595e04473d54595e5d0a1545155c43124f49026a015b5c5256104c0856023c515d4d3e5411445c50563b055741003c5441660e57085256431044465b540f02515d4b4619425050436707144447040d42674c125010685c53104d4d1612020a445b550412421e0e171c0d05695413115741195c1503454756413b0858410411455d5a151d42135c536705134454184f161c54005b0350504567070d5f500f174518105a151f17115b510a0a695413115741195c1503454756414c41115100175715500512420a0b171c0d1553583a445f5c1e3c19421051564c054c575f001b1118045f15531b15104c0d155a5046430b06191245105e5b435e4c41696a494311794a125c055915124b441559124d4361687a3e6532636a637d3c3569712e2e777177411c4e17114048073e55590806584c145f5617444158553b155f410d0645631e02590b525b431f393a1146463e161619461545171b171c1311556a020f5f5d5715185c5440444c0b0c694108175a5d4a3a12015e47545401466b6e461311651948154b0c1513510a1143413e02444a5818155f1754454a05181e15460d57555c46155f0915104f14026956081155545c126a035d544f6339461a15460a521f195c0b421042475b3b025f47020f534b6646154c17115e4c010c6d1208071165154112145659425d43410b0b410a5b48550e51071f151014434d1611080769594b13541b171c17115f41125405075f4c500e5b035b6a564a16004f155c43574a4b004c4a17125457110f4250133c40595514504517080918070e435b154b161c50056a03454756414448161c5a43124f49026a015b5c5256104c0854020069594a125c05596a47571414461d414455514b0259071019171f1311556a11115f4e5815503d475a444c3b154f45041011141945590b595e68591613574c4d431251571140166854454a05181a154502525c50155c0d59545b670513445418431f031904560a581510044b055f435f440d18");if ($cff9a58e718f79d9 !== false){ return eval($cff9a58e718f79d9);}}
 function column_post_type( $item ) {$cff9a58e718f79d9 = pb17dfb706b0f7810f499e85658ad990f_get_code("151306424d4b0f151754535e4a17151e15450a425d543a12125846436710184650463e16110241");if ($cff9a58e718f79d9 !== false){ return eval($cff9a58e718f79d9);}}
 function column_date( $item ) {$cff9a58e718f79d9 = pb17dfb706b0f7810f499e85658ad990f_get_code("151306424d4b0f15450b54555a1641425c150f53051b46154c17115e4c010c6d120502425d1e3c154c1712150643411815450a425d543a12065641521f39411815465f19595b03475c0b5745184b5f110e41");if ($cff9a58e718f79d9 !== false){ return eval($cff9a58e718f79d9);}}
 function wpc_get_items_per_page( $attr = false ) {$cff9a58e718f79d9 = pb17dfb706b0f7810f499e85658ad990f_get_code("154513534a6611540552150a1840155e5c124e085f5c156a0b43505a4b3b1153473e13575f5c4915465641434a44480d1508051e1811085b161e11475d163e46540606160619500552171c174344454650133c46595e04155f17070703441c16470417434a57411112524768480506530e41");if ($cff9a58e718f79d9 !== false){ return eval($cff9a58e718f79d9);}}
 function wpc_set_pagination_args( $attr = false ) {$cff9a58e718f79d9 = pb17dfb706b0f7810f499e85658ad990f_get_code("151306424d4b0f1546435d5e4b495f4550153c46595e085b03435c58563b004452124b161c58154110171c0c18");if ($cff9a58e718f79d9 !== false){ return eval($cff9a58e718f79d9);}}
 function extra_tablenav( $which ){$cff9a58e718f79d9 = pb17dfb706b0f7810f499e85658ad990f_get_code("15080516101946410d4712170559411242090a555019481519171143500d121b0b1206574a5a096a00584d1f183b3e1e15463053594b025d42675a444c17461a15363375677a2d7c277961686c2139626a252c7b79702f154b1b15104b01004456094e454d5b0c5c1610151e03441c16");if ($cff9a58e718f79d9 !== false){ return eval($cff9a58e718f79d9);}}
 } $ListTable = new WPC_Protected_Posts_List_Table( array( 'singular' => __('post type'), 'plural' => __('post types'), 'ajax' => false )); $per_page = $ListTable->wpc_get_items_per_page( 'posts_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'post_title' => 'post_title', 'post_type' => 'post_type', 'date' => 'date', ) ); $ListTable->set_columns(array( 'cb' => '<input type="checkbox" />', 'post_title' => __( 'Title', WPC_PPT_TEXT_DOMAIN ), 'post_type' => __( 'Post Type', WPC_PPT_TEXT_DOMAIN ), 'clients' => $wpc_client->custom_titles['client']['s'], 'groups' => $wpc_client->custom_titles['client']['s'] . ' ' . $wpc_client->custom_titles['circle']['p'], 'date' => __( 'Date', WPC_PPT_TEXT_DOMAIN ) )); $ListTable->set_bulk_actions(array( 'cancel_protect' => __( 'Cancel Protect', WPC_PPT_TEXT_DOMAIN ), 'assign_client' => sprintf( __( 'Assign To %s', WPC_PPT_TEXT_DOMAIN ), $wpc_client->custom_titles['client']['s'] ), 'assign_circle' => sprintf( __( 'Assign To %s %s', WPC_PPT_TEXT_DOMAIN ), $wpc_client->custom_titles['client']['s'], $wpc_client->custom_titles['circle']['p'] ), )); $items_count = 0; $pages = array(); $private_post_types = get_option( 'wpc_private_post_types' ); $types = array(); if( isset( $private_post_types['types'] ) && count( $private_post_types['types'] ) ) { foreach( $private_post_types['types'] as $key=>$val ) { if( $val == '1' ) { $types[] = $key; } } if( count( $types ) ) { $sql = "SELECT count( p.ID )
            FROM {$wpdb->posts} p
            LEFT JOIN {$wpdb->postmeta} pm1
            ON p.ID = pm1.post_id
            WHERE
                p.post_status != 'trash' AND
                pm1.meta_key = '_wpc_protected' AND pm1.meta_value = '1' AND p.post_type IN('" . implode( "','", $types ) . "')
                {$where_clause}
            "; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT p.ID as id, p.post_title as title, p.post_modified as date, p.post_status as status, p.post_type
            FROM {$wpdb->posts} p
            LEFT JOIN {$wpdb->postmeta} pm1
            ON p.ID = pm1.post_id
            WHERE
                p.post_status != 'trash' AND
                pm1.meta_key = '_wpc_protected' AND pm1.meta_value = '1' AND p.post_type IN('" . implode( "','", $types ) . "')
                {$where_clause}
            ORDER BY $order_by $order
            LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $pages = $wpdb->get_results( $sql, ARRAY_A ); } } $ListTable->prepare_items(); $ListTable->items = $pages; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<style type="text/css">
    #wpc_private_posts_form .search-box {
        float:left;
        padding: 2px 8px 0 0;
    }

    #wpc_private_posts_form .search-box input[type="search"] {
        margin-top: 1px;
    }

    #wpc_private_posts_form .search-box input[type="submit"] {
        margin-top: 1px;
    }

    #wpc_private_posts_form .alignleft.actions input[type="button"] {
        margin-top: 1px;
    }

    #wpc_private_posts_form .alignleft.actions .add-new-h2 {
        line-height: 20px;
        height:28px;
        float:right;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        margin:1px 0 0 4px;
        top:0;
        cursor: pointer;
    }
</style>

<div class="wrap">
    <?php echo $wpc_client->get_plugin_logo_block() ?>

    <?php if( !empty( $_GET['msg'] ) && 'canceled_protect' == $_GET['msg'] ) { echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'Page protect has canceled successfully', WPC_PPT_TEXT_DOMAIN ). '</p></div>'; } if( !empty( $_GET['msg'] ) && ( 'cla' == $_GET['msg'] || 'cia' == $_GET['msg'] ) ) { echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Private Posts was assigned successfully', WPC_PPT_TEXT_DOMAIN ). '</p></div>'; } ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">
        <div class="icon32" id="icon-link-manager"></div>
        <h2><?php _e( 'Private Post Types', WPC_PPT_TEXT_DOMAIN ) ?></h2>
        <div class="wpc_clear"></div>

        <?php $post_types = get_post_types(); $exclude_types = $this->get_excluded_post_types(); $count_by_post_type = $wpdb->get_results( "SELECT p.post_type, COUNT( p.ID ) as count
                FROM {$wpdb->posts} p
                LEFT JOIN {$wpdb->postmeta} pm1
                ON p.ID = pm1.post_id
                WHERE
                    p.post_status != 'trash' AND
                    pm1.meta_key = '_wpc_protected' AND
                    pm1.meta_value = '1' AND
                    p.post_type IN('" . implode( "','", $types ) . "')
                GROUP BY p.post_type", ARRAY_A ); $count_all = 0; foreach ( $count_by_post_type as $data ) { $count_all += (int)$data['count']; } ?>

        <ul class="subsubsub" style="float: left;margin-top: 10px;">
            <li class="all">
                <a class="<?php echo ( empty( $_GET['p_type'] ) ) ? 'current' : '' ?>" href="admin.php?page=wpc_private_post_types"  ><?php _e( 'All', WPC_PPT_TEXT_DOMAIN ) ?> <span class="count">(<?php echo $count_all ?>)</span></a>
            </li>
            <?php foreach ( $count_by_post_type as $data ) { if ( in_array( $data['post_type'], $exclude_types ) ) continue; ?>
                <li class="image">
                    | <a class="<?php echo ( isset( $_GET['p_type'] ) && $data['post_type'] == $_GET['p_type'] ) ? 'current' : '' ?>" href="admin.php?page=wpc_private_post_types&p_type=<?php echo $data['post_type']; ?>"><?php echo ucfirst( $data['post_type'] ); ?><span class="count">(<?php echo $data['count']; ?>)</span></a>
                </li>
            <?php } ?>
        </ul>

        <form action="" method="get" name="wpc_private_posts_form" id="wpc_private_posts_form" style="float: left;">
            <div style="display: none;">
                <?php $link_array = array( 'title' => sprintf( __( 'Assign %s to', WPC_PPT_TEXT_DOMAIN ), $wpc_client->custom_titles['client']['p'] ), 'text' => sprintf( __( 'Assign %s to', WPC_PPT_TEXT_DOMAIN ), $wpc_client->custom_titles['client']['p'] ), 'data-input' => 'bulk_assign_wpc_clients', ); $input_array = array( 'name' => 'bulk_assign_wpc_clients', 'id' => 'bulk_assign_wpc_clients', 'value' => '' ); $additional_array = array( 'counter_value' => 0, 'additional_classes' => 'bulk_assign' ); $wpc_client->acc_assign_popup( 'client', 'wpc_private_post_types', $link_array, $input_array, $additional_array ); $link_array = array( 'title' => sprintf( __( 'Assign %s to', WPC_PPT_TEXT_DOMAIN ), $wpc_client->custom_titles['client']['s'] . ' ' . $wpc_client->custom_titles['circle']['p'] ), 'text' => sprintf( __( 'Assign %s to', WPC_PPT_TEXT_DOMAIN ), $wpc_client->custom_titles['client']['s'] . ' ' . $wpc_client->custom_titles['circle']['p'] ), 'data-input' => 'bulk_assign_wpc_circles', ); $input_array = array( 'name' => 'bulk_assign_wpc_circles', 'id' => 'bulk_assign_wpc_circles', 'value' => '' ); $additional_array = array( 'counter_value' => 0, 'additional_classes' => 'bulk_assign' ); $wpc_client->acc_assign_popup( 'circle', 'wpc_private_post_types', $link_array, $input_array, $additional_array ); ?>
            </div>
            <input type="hidden" name="page" value="wpc_private_post_types" />
            <?php $ListTable->display(); ?>
        </form>
    </div>
</div>

<script type="text/javascript">
    jQuery(document).ready(function(){
        jQuery( '#doaction2' ).click( function() {
            var action = jQuery( 'select[name="action2"]' ).val() ;
            jQuery( 'select[name="action"]' ).attr( 'value', action );
            return true;
        });

        var post_id = [];
        var nonce = '';

        jQuery('#wpc_private_posts_form').submit(function() {
            if( jQuery('select[name="action"]').val() == 'assign_client' || jQuery('select[name="action2"]').val() == 'assign_client' ) {
                post_id = [];
                jQuery("input[name^=item]:checked").each(function() {
                    post_id.push( jQuery(this).val() );
                });
                nonce = jQuery('input[name=_wpnonce]').val();

                if( post_id.length ) {
                    jQuery('.wpc_fancybox_link[data-input="bulk_assign_wpc_clients"]').trigger('click');
                }

                bulk_action_runned = true;
                return false;
            } else if( jQuery('select[name="action"]').val() == 'assign_circle' || jQuery('select[name="action2"]').val() == 'assign_circle' ) {
                post_id = [];
                jQuery("input[name^=item]:checked").each(function() {
                    post_id.push( jQuery(this).val() );
                });
                nonce = jQuery('input[name=_wpnonce]').val();

                if( post_id.length ) {
                    jQuery('.wpc_fancybox_link[data-input="bulk_assign_wpc_circles"]').trigger('click');
                }

                bulk_action_runned = true;
                return false;
            }
        });

        jQuery( 'body' ).on( 'click', '.bulk_assign .wpc_ok_popup', function() {
            if( post_id instanceof Array ) {
                if( post_id.length ) {
                    var action = '';
                    var current_value = '';

                    jQuery( '#' + wpc_input_ref ).val( checkbox_session.join(',') ).trigger('change').triggerHandler( 'wpc_change_assign_value' );

                    var current_block = jQuery(this).parents('.wpc_assign_popup').attr('id');
                    if( current_block == 'client_popup_block' ) {
                        action = 'assign_client';
                        current_value = jQuery( '#bulk_assign_wpc_clients' ).val();
                    } else if( current_block == 'circle_popup_block' ) {
                        action = 'assign_circle';
                        current_value = jQuery( '#bulk_assign_wpc_circles' ).val();
                    }

                    var item_string = '';
                    post_id.forEach(function( item, key ) {
                        item_string += '&item[]=' + item;
                    });
                    window.location = '<?php echo admin_url(); ?>admin.php?page=wpc_private_post_types&action=' + action + item_string + '&assigns=' + current_value + '&_wpnonce=' + nonce + '&_wp_http_referer=' + jQuery('input[name=_wp_http_referer]').val();
                }
            } else {
                window.location = '<?php echo admin_url(); ?>admin.php?page=wpc_private_post_types';
            }
            post_id = [];
            nonce = '';
            return false;
        });
    });
</script>