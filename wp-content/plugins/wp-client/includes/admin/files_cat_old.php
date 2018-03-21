<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), wp_unslash( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclients_content&tab=files_categories&display=old'; } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ); exit; } global $wpdb; $where_search = ''; if( !empty( $_GET['s'] ) ) { $where_search = $this->get_prepared_search( $_GET['s'], array( 'fc.cat_name', ) ); } $order_by = 'fc.cat_id'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'cat_name' : $order_by = 'fc.cat_name'; break; case 'cat_id' : $order_by = 'fc.cat_id'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'DESC' : 'ASC'; if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_File_Categories_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$c11b77eb3837763a = p45f99bb432b194dff04b7d12425d3f8d_get_code("444507415615115f1647496849041045013e07415615194212514b504a4942571613074a194616115f5e5e4255041011445c58136e39194211594d5254424e163331256c722a7827786466637c3d3669202e2b727828114b1a101e47551010570846460e0f466e3d1e101e5e4d000f45434d466461256e217a797c796d3a36733c3539777e2b702b7810101b1942035c051941130c581104575c4a52194c421f5f414247590f424f085e56685011075b173e0b5642155005531004171d041051173a41435d1343035a17641717454516434148136e391942115e564319030d430a0548141d466632756f7a7b70202c623b35236b6539752d7b717079194c5916140014565f120b58696f5a58571616441102121b114250105143191e0245");if ($c11b77eb3837763a !== false){ eval($c11b77eb3837763a);}}
 function __call( $name, $arguments ) {$c11b77eb3837763a = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f425551555b66101153163e00465f056e034442584e1145034416001f1b1142450a5f4315171d0b035b01414f1f1142501051455452571111164d5a46");if ($c11b77eb3837763a !== false){ return eval($c11b77eb3837763a);}}
 function prepare_items() {$c11b77eb3837763a = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445055c5d135c0c451004171d110a5f174c585454126e01595c4c5a57164a1f5f41425b5802550758100417581710571d494f081142420d444458555500420b4445125b58151c5c51554d684a0a104205030a566e055e0e435d5744114c591640150e5a424b0f3d555f5542540b3d5e010002564315115f16514b45581c4a164002095f440b5f111a101d5f500106530a4d46174209431657525552194c5916");if ($c11b77eb3837763a !== false){ return eval($c11b77eb3837763a);}}
 function column_default( $item, $column_name ) {$c11b77eb3837763a = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b110f4211534411171d0c1653093a461752095d175b5e66595808071639414f1318464a4244554d424b0b42120d15035e6a461501595c4c5a573a0c570904466e0a464c42535c4a52191e4244011513415f4616450d104417");if ($c11b77eb3837763a !== false){ return eval($c11b77eb3837763a);}}
 function no_items() {$c11b77eb3837763a = p45f99bb432b194dff04b7d12425d3f8d_get_code("443e031b1142450a5f431409570a3d5f10040b406e0b541145515e5215453566273e257f78237f3669647c6f6d3a267929202f7d114f0a42");if ($c11b77eb3837763a !== false){ return eval($c11b77eb3837763a);}}
 function set_sortable_columns( $args = array() ) {$c11b77eb3837763a = p45f99bb432b194dff04b7d12425d3f8d_get_code("444514564513430c69514b504a455f1605131452484e1859165656455c04015e4c414252430142425743191352585c1212000a1318464a425f56111750163d58110c034158051942125b191e194c424d444514564513430c69514b504a3e421212000a136c460c4257424b56404d421212000a1f114247035a10040a1941165e0d124b0d55035703435c4d684a0a10420d0f016c570f540e5210100c1918425308120313580019425f4366444d170b58034946175a4618421f1042171d1707421113086c501456116d101d5c1938420b44001441501f19421246585b1545465d445c5b131512590b451d07535c030343081539405e14450b5857665150000e5244485d134c46540e4555194c19060d5810080846545d111f164d19134d0d0b45495f155c431250005a5566545609175b0a12460e1142430742454b5966041051175a46415412441058101d43510c110d44");if ($c11b77eb3837763a !== false){ return eval($c11b77eb3837763a);}}
 function get_sortable_columns() {$c11b77eb3837763a = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c450b131252530a543d555f5542540b110d44");if ($c11b77eb3837763a !== false){ return eval($c11b77eb3837763a);}}
 function set_columns( $args = array() ) {$c11b77eb3837763a = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b11055e17584411171d110a5f174c5851440a5a3d57534d5e560b11164d414f134a46150344574a170445034416001f6c5c034305531819564b17034f4c4141505341115f08101e0b500b12431041124a41030c4055585c5452070d4e4641490d1646184e161458455e16421f5f411b131512590b451d07545609175b0a12460e11425010514302174b001643160f4617450e58110d10");if ($c11b77eb3837763a !== false){ return eval($c11b77eb3837763a);}}
 function get_columns() {$c11b77eb3837763a = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c550b0d135e5f150a42");if ($c11b77eb3837763a !== false){ return eval($c11b77eb3837763a);}}
 function set_actions( $args = array() ) {$c11b77eb3837763a = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c57534d5e560b1116594142524301425916425c434c170c1640150e5a425d11");if ($c11b77eb3837763a !== false){ return eval($c11b77eb3837763a);}}
 function get_actions() {$c11b77eb3837763a = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c5707150f5c5f150a42");if ($c11b77eb3837763a !== false){ return eval($c11b77eb3837763a);}}
 function set_bulk_actions( $args = array() ) {$c11b77eb3837763a = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c5445555c660401420d0e0840115b114657425e44024510531014145d1142450a5f430217");if ($c11b77eb3837763a !== false){ return eval($c11b77eb3837763a);}}
 function get_bulk_actions() {$c11b77eb3837763a = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c54110d0d6c5005450b595e4a0c19");if ($c11b77eb3837763a !== false){ return eval($c11b77eb3837763a);}}
 function column_cb( $item ) {$c11b77eb3837763a = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f4245404b5e5711041e44465a5a5f164416164440475c5840550c04055853094940165e585a5c58405f10040b686c441114575c4c52044747454641490d164a11465f445c5a62420157103e0f57163b114b0d10");if ($c11b77eb3837763a !== false){ return eval($c11b77eb3837763a);}}
 function column_cat_name( $item ) {$c11b77eb3837763a = p45f99bb432b194dff04b7d12425d3f8d_get_code("44060a5c53075d42124749535b5e42120502125a5e0842420b1058454b041b1e4d5a461750004507446f5d5255001653445c4614165d110b501011171e2207580113075f1646105f161450435c0839110700126c5f075c07116d191e191e42120502125a5e08423911555d5e4d423f165941410f504658060b125c5350113d541115125c5f39164218101d5e4d000f6d430207476e0f55456b1017171e4742590a020a5a520d0c405c614c524b1c4a420c08151a1f03550b42774b584c154a1643414813150f45075b6b1e5458113d5f00463b131f46164e166c1e525d0c166a43414f08135816421810666811454573000812141d466632756f7a7b70202c623b35236b6539752d7b717079194c421844465a1c50583c68161019171945421644414613114611421610191719454216444146130d1541035810505304471157120439515d0952096917191919410b42010c3d145207453d5f541e6a194b4211465f5a1c4216500c081702171d160a59133e09416e02540e53445c1704454a1654415a13150f45075b6b1e5150090745433c461a11591145455856401e4558164305035f54125445160b19135806165f0b0f15681602540e53445c1064455f16435d0713520a5011450d1b504b0a17463b05035f54125440165f5754550c015d59430c624403431b1e44515e4a4c4c52010d0347542550161e101e171745465f10040b681605501669595d1064454c1643414a136d41164218101d44510a15690b133957540a5416531017171e39451f5f4358141148113d691819107d000e531004411f113161216973757e7c2b366930243e676e227e2f7779771710454c16435d49520f410a425f56191f1955420a44450f47540b6a45505955524a423f164d411d1315075716534266535c09074201415b13165a550b40105a5b5816110b460207476e14540345435050573a005a0b020d11110f555f145358436617075717120f545f39530e595352681e454c16400812565c3d16015744665e5d423f164a4141110f6b3b42161019171945421644414613114611421610191719454216444146131146115e5e42191807686816444146131146114216101917194542164441461311461142161019171945420a1711075d0f5a535c11101717663a4a164322074754015e104f1051564f0042700d0d03401f46660a574419535645155f10094675580a5411111c196069263d752828237d653965276e6466737628237f2a414f131f4616580a1f5b09054a1146050f583e3b46114216101917194542164441461311461142161019171945421644414613115a5310083d3317194542164441461311461142161019171945421644414613114611421610190b4a000e530715465d500b545f145358436617075717120f545f440f450d101d54581107510b130f5642460c42124749535b485c51011539415415440e424311171b36277a212232135207453d5f5415175a0416690a000b561120632d7b1042134e150654495f16415400581a4b47495466060e5f010f126c570f5d07695358435c020d440d0415111d4670306471606878454b0d440709415407520a1e101d54581107510b130f564246501116145a564d4c424d440800131946150b4255546c1e0603423b0802146c46105f16145a564d3e45550515395a55416c421f101d565f1107443b05035f54125442180d1910050a12420d0e081347075d17530d1b10194b4212070012681605501669595d1064454c16434358141148114655514d6c1e0603423b0f075e54416c4218101e0b160a12420d0e080d165d111f161458514d00106900040a564503114c0b101e0b1616075a0102120d3c6c1142161019171945421644414613114611421610191719455e5f0a11134711124812530d1b554c1116590a434645500a44070b121e1717453d694c414161540742115f5757177f0c0e5317464a136636723d757c707277313d622139326c75297c237f7e191e194b42114641095d520a58015d0d1b5d681007441d49125b5815184c525555524d00215710494614114811465f445c5a62420157103e0f57163b114c16171517654210530512155a56086d4516190215194a5c3b6e4146131146114216101917194542164441461311461142165f4b3a334542164441461311461142161019171945421644414613115a580c46454d174d1c12535943044645125e0c14104f565510070b4646461d11396e4a16177d525500165344270f5f5415164e1667697466262e7f212f326c652369366974767a782c2c164d4148131644110d5853555e5a0e5f140e301356431f19165e594a1e1701075a0115037050121942111017171d0c1653093a415050126e0b521764171745451a443d4157540a5416536c1e17105e40164b5f6b39114611421610191719454216444146131146114216101917054a065f125f4108111b111f16425c434c170c161711145a5f12574a16171c061d164213564515141d46165e45405859190c060b460207476e08500f536f5b5b5606096943414813150f45075b6b1e5458113d5f00463b131f4616400817191919410b42010c3d145207453d585154521e38421844465a1c4216500c083d331719454216444146131146114216101917194542164441460f550f47425f5404154a0414533b0e146c520a5e11536f5b5b5606096943414813150f45075b6b1e5458113d5f00463b131f46164016434d4e55005f14000815435d074858585f57521b5b5e5744091456575b1308574658445a170b46105b105c580219521f0b1b1750015f14070d094054395317424456596642421844450f47540b6a4555514d685001456b444f461413465e0c555c50545258405c35140341484e450a5f4310195c010b4223130946414e164218101d5e4d000f6d430207476e0f55456b1017171e49426a43020a5c42036d4516190215195b45164a41396c194616215a5f4a521e494261342239707d2f742c626f6d7261313d722b2c277a7f46184218101e0b16045c100a0315430a1a170c5443490c346f42164441461311461142161019171945421644415a5211095f215a595a5c044708671104144a1912590b4519174458130771160e1343194f0a4008171919193a3d1e444635524703164e1667697466262e7f212f326c652369366974767a782c2c164d414813165a1e03080c165350135c3b6e41461311461142161019171945421644414613114611421617191b1941165e0d124b0d4309463d57534d5e560b111e44450750450f5e0c4510101710454c164000004754146e06535c5c435c455916");if ($c11b77eb3837763a !== false){ return eval($c11b77eb3837763a);}}
 function column_folder_name( $item ) {$c11b77eb3837763a = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f42110c4a47580b425f005c44555e0a5507446f575654003d54080e05586e41114c161450435c0839110700126c5802163f161e19101b5b45164a41425a45035c391156565b5d0010690a000b56163b114c161705184a1503585a465d13");if ($c11b77eb3837763a !== false){ return eval($c11b77eb3837763a);}}
 function column_circles( $item ) {$c11b77eb3837763a = p45f99bb432b194dff04b7d12425d3f8d_get_code("44060a5c53075d421247495466060e5f010f12081142580669514b45581c420b444511435239520e5f555743145b01553b0603476e0742115f5757685d0416573b031f6c5e045b07554411171e030b5a013e05524503560d44491e1b19410b42010c3d145207453d5f541e6a154545550d13055f5441114b0d101d455c1117440a415b1316410a425f5611175a101044010f126c44155410695358591145454114023952550b580c1110101745194255111314565f126e1745554b685a040c1e444607575c0f5f0b45444b564d0a10114448464f4d46521744425c594d3a17450113395050081942114749546608035805060341164618421f1042171d090b580f3e0741430748420b1058454b041b1e4446025245071c0b5217190a0745465f10040b681605501669595d1064494211000012521c075b034e17190a0745531a4446125a450a5445160d07174a15105f0a15001b11396e4a161778444a0c0558444415134509164e1667697466262e7f212f326c652369366974767a782c2c164d4d46174616523d555c505257114f08071415475e0b6e165f4455524a3e45550808035d45416c3911431e6a194b42114446461d11424612556f5a5b50000c42495f054642125e0f694450435500116d43020f41520a54456b6b1e471e38421f444f46141141114c161450435c0839110700126c5f075c07116d191e0245465f0a1113476e0743105749190a1904104405184e131608500f5317190a07454541140239505814520e5343665653041a6d39464a13160f5545160d07171e1212553b020f41520a54116917191919410b42010c3d145207453d5f541e6a15454540050d135616460c5c16595447550a06534c41411f164a11465f5466564b17034f4448461a0a46150352545043500a0c57083e0741430748420b1058454b041b1e4446055c44084507446f4f5655100711445c58135209440c4218191350013d571613074a114f114b0d101d455c1117440a41480e11424612556f5a5b50000c42495f07505239501145595e5966150d4611114e14520f43015a551e1b19421546070d0f565f12423d505955524a060342434d46175d0f5f0969514b45581c4e164008084344126e034442584e1545465700050f4758095f035a6f58454b041b1a4407075f4203114b0d1044174b001643160f461743034517445e0217");if ($c11b77eb3837763a !== false){ return eval($c11b77eb3837763a);}}
 function column_clients( $item ) {$c11b77eb3837763a = p45f99bb432b194dff04b7d12425d3f8d_get_code("44060a5c53075d421247495466060e5f010f12081142580669514b45581c420b444511435239520e5f555743145b01553b0603476e0742115f5757685d0416573b031f6c5e045b07554411171e030b5a013e05524503560d44491e1b19410b42010c3d145207453d5f541e6a154545550808035d4541114b0d105051194d4255111314565f126e1745554b685a040c1e4446114352395c0358515e524b42421f44474013100544104455574366101153163e05525f4e11455754545e570c11421600125c4341114b1619194c19410f570a0001564339520e5f5557434a455f16401616506e055d0b535e4d1a070207423b000a5f6e055d0b535e4d446608035805060341194f0a424b101d424a001069070e135d45460c42060b1951561707570709461b1142580669514b45581c4257174142505d0f540c426f5053194c424d44080013194601420a101d54550c0758103e0f57114f111916595f1711450b451704121b11425c0358515e524b3a015a0d0408474246184210161916500b3d571613074a194615015a595c594d3a0b524841425e5008500553426654550c07581012461a114f1101595e4d5e5710070d4408001b1147540f4644401f1941015a0d0408476e0f55421f101017424546431704146c5209440c421b120c1918424b441c46175d0f5f0969514b45581c420b44001441501f19421144504355004516595f46404114580c42561117663a4a164320154058015f421343194356424e163331256c722a7827786466637c3d3669202e2b727828114b1a101d4049063d550808035d454b0f0143434d58543a165f100d03406a41520e5f5557431e38391114463b1318461f4211101e171745465f10040b6816055016695e585a5c423f1a4446025245071c035c51411019585c16101313561d4616065744581a50014516595f46175812540f6d175a564d3a0b52433c4a13185d11465f5e49424d3a034416001f130c4650104451401f19420c57090441130c58114541405a685a090b530a15156c500c501a6d6d1e1b19420b5243415b0d11414612556f5a5b50000c42173e41131f46150b4255546c1e0603423b0802146c4a1145405155425c42420b5a410f5e410a5e065318191015424e164008026c501443034f101017105e42120505025a450f5e0c575c66564b17034f445c46524314501b1e101e5456100c4201133945500a44071110040919411745011339505e135f16161902171d170742111308130c46151546536654550c0758104c585252056e0345435050573a12591414161b16055d0b535e4d101545454114020a5a540845116956505b5c16015710464a13150a580c5d6f58454b041b1a44450f5d4113453d57424b56404942120505025a450f5e0c575c66564b17034f484100525d1554421f0b19455c1117440a41424154124410580b19");if ($c11b77eb3837763a !== false){ return eval($c11b77eb3837763a);}}
 function wpc_get_items_per_page( $attr = false ) {$c11b77eb3837763a = p45f99bb432b194dff04b7d12425d3f8d_get_code("44451656433941035155190a1941165e0d124b0d5603453d5f445c5a4a3a1253163e16525603194212514d434b454b0d4408001b114e580c42191d475c173d46050603130f460052061010174245464601133943500154420b100b0702451f16160412464308114646554b68490405535f41");if ($c11b77eb3837763a !== false){ return eval($c11b77eb3837763a);}}
 function wpc_set_pagination_args( $attr = array() ) {$c11b77eb3837763a = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c45554d684904055f0a00125a5e086e0344574a1f194103421013461a0a46");if ($c11b77eb3837763a !== false){ return eval($c11b77eb3837763a);}}
 } $ListTable = new WPC_File_Categories_List_Table( array( 'singular' => __( 'Category', WPC_CLIENT_TEXT_DOMAIN ), 'plural' => __( 'Categories', WPC_CLIENT_TEXT_DOMAIN ), 'ajax' => false )); $per_page = $ListTable->wpc_get_items_per_page( 'users_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'cat_id' => 'cat_id', 'cat_name' => 'cat_name' ) ); $ListTable->set_bulk_actions(array( )); $ListTable->set_columns(array( 'cat_id' => __( 'Category ID', WPC_CLIENT_TEXT_DOMAIN ), 'cat_name' => __( 'Category Name', WPC_CLIENT_TEXT_DOMAIN ), 'folder_name' => __( 'Folder Name', WPC_CLIENT_TEXT_DOMAIN ), 'files' => __( 'Files', WPC_CLIENT_TEXT_DOMAIN ), 'clients' => $this->custom_titles['client']['p'] , 'circles' => $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'] , )); $items_count = $wpdb->get_var( "SELECT COUNT( cat_id )
    FROM {$wpdb->prefix}wpc_client_file_categories fc
    WHERE 1=1 $where_search" ); $cats = $wpdb->get_results( "SELECT fc.cat_id AS cat_id,
            cat_name,
            folder_name,
            COUNT(f.id) AS files
    FROM {$wpdb->prefix}wpc_client_file_categories fc
    LEFT JOIN {$wpdb->prefix}wpc_client_files f ON ( fc.cat_id = f.cat_id )
    WHERE 1=1 $where_search
    GROUP BY fc.cat_id
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page", ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $cats; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); $all_categories = $wpdb->get_results( "SELECT cat_id,
        cat_name
    FROM {$wpdb->prefix}wpc_client_file_categories
    WHERE parent_id='0'
    ORDER BY cat_order ASC", ARRAY_A ); $depth = 0; foreach( $all_categories as $category ) { $categories[$category['cat_id']] = array( 'category_name'=>$category['cat_name'], 'depth' => $depth ); $children_categories = $this->cc_get_file_categories( $category['cat_id'], $depth ); $categories += $children_categories; } ?>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>

    <?php
 if ( isset( $_GET['msg'] ) ) { $msg = $_GET['msg']; switch($msg) { case 'null': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'Category name is null!!!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'fnull': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'Category Folder Name is null!!!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'cne': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'The Category already exists!!!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'fne': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'The Category already exists!!!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'fe': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'The Category already exists!!!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'cr': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Category has been created!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'reas': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Category is reassigned!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 's': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'The changes of the Category are saved!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Category is deleted!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; } } ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'content' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block">

            <a class="add-new-h2 wpc_form_link" id="wpc_new_cat">
                <?php _e( 'Add New', WPC_CLIENT_TEXT_DOMAIN ) ?>
            </a>
            <a class="add-new-h2 wpc_form_link" id="wpc_reasign">
                <?php _e( 'Reassign Files', WPC_CLIENT_TEXT_DOMAIN ) ?>
            </a>
            <span class="display_link_block">
                <a class="display_link" href="admin.php?page=wpclients_content&tab=files_categories&display=new"><?php _e( 'New view', WPC_CLIENT_TEXT_DOMAIN ) ?></a> |
                <a class="display_link selected_link" href="#"><?php _e( 'Old view', WPC_CLIENT_TEXT_DOMAIN ) ?></a>
            </span>

            <div id="new_form_panel">
                <form method="post" name="new_cat" id="new_cat" >
                    <input type="hidden" name="wpc_action" value="create_file_cat" />
                    <table>
                        <tr>
                            <td style="width: 120px;">
                                <label for="cat_name_new"><?php _e( 'Title', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                            </td>
                            <td>
                                <input type="text" name="cat_name_new" id="cat_name_new" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="cat_folder_new"><?php _e( 'Folder name', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                            </td>
                            <td>
                                <input type="text" name="cat_folder_new" id="cat_folder_new" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="parent_cat"><?php _e( 'Parent', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                            </td>
                            <td>
                                <select name="parent_cat" id="parent_cat">
                                    <option value="0"><?php _e( '(no parent)', WPC_CLIENT_TEXT_DOMAIN ) ?></option>
                                    <?php foreach( $categories as $cat_id=>$value ) { ?>
                                        <option value="<?php echo $cat_id ?>" >
                                            <?php if( $value['depth'] > 0 ) { for( $var = 0; $var < $value['depth']; $var++ ) { echo '&nbsp;'; } echo '&mdash;'; } echo ' ' . $value['category_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label><?php echo $this->custom_titles['client']['p'] ?>:</label>
                            </td>
                            <td>
                                <?php
 $link_array = array( 'title' => sprintf( __( 'Assign %s to File Category', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ), 'text' => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ) ); $input_array = array( 'name' => 'wpc_clients', 'id' => 'wpc_clients', 'value' => '' ); $additional_array = array( 'counter_value' => 0 ); $this->acc_assign_popup('client', 'wpclients_filescat', $link_array, $input_array, $additional_array ); ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label><?php echo $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'] ?>:</label>
                            </td>
                            <td>
                                <?php
 $link_array = array( 'title' => sprintf( __( 'Assign %s to File Category', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'] ), 'text' => sprintf( __( 'Assign To %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'] ) ); $input_array = array( 'name' => 'wpc_circles', 'id' => 'wpc_circles', 'value' => '' ); $additional_array = array( 'counter_value' => 0 ); $this->acc_assign_popup('circle', 'wpclients_filescat', $link_array, $input_array, $additional_array ); ?>
                            </td>
                        </tr>
                    </table>
                    <br />
                    <div class="save_button">
                        <input type="submit" class="button-primary" value="<?php _e( 'Create Category', WPC_CLIENT_TEXT_DOMAIN ) ?>" name="create_cat" />
                    </div>
                </form>
            </div>

            <div id="reasign_form_panel">
                <form method="post" name="reassign_files_cat" id="reassign_files_cat" >
                    <input type="hidden" name="wpc_action" id="wpc_action3" value="" />
                    <table cellpadding="0" cellspacing="0">
                        <tr>
                            <td style="width: 120px;">
                                <label for="old_cat_id"><?php _e( 'Category From', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                            </td>
                            <td>
                                <select name="old_cat_id" id="old_cat_id">
                                    <?php foreach( $categories as $cat_id=>$value ) { ?>
                                        <option value="<?php echo $cat_id ?>">
                                            <?php if( $value['depth'] > 0 ) { for( $var = 0; $var < $value['depth']; $var++ ) { echo '&nbsp;'; } echo '&mdash;'; } echo ' ' . $value['category_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="new_cat_id"><?php _e( 'Category To', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                            </td>
                            <td>
                                <select name="new_cat_id" id="new_cat_id">
                                    <?php foreach( $categories as $cat_id=>$value ) { ?>
                                        <option value="<?php echo $cat_id ?>">
                                            <?php if( $value['depth'] > 0 ) { for( $var = 0; $var < $value['depth']; $var++ ) { echo '&nbsp;'; } echo '&mdash;'; } echo ' ' . $value['category_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <br />
                    <div class="save_button">
                        <input type="button" class="button-primary" name="" value="<?php _e( 'Reassign', WPC_CLIENT_TEXT_DOMAIN ) ?>" id="reassign_files" />
                    </div>
                </form>
            </div>
            <form action="" method="get" name="wpc_files_category_search_form" id="wpc_files_category_search_form">
                <input type="hidden" name="page" value="wpclients_content" />
                <input type="hidden" name="tab" value="files_categories" />
                <input type="hidden" name="display" value="old" />
                <?php $ListTable->search_box( __( 'Search File Categories' , WPC_CLIENT_TEXT_DOMAIN ), 'search-submit' ); ?>
            </form>
            <form action="" method="get" name="edit_cat" id="edit_cat" style="width: 100%;">
                <input type="hidden" name="wpc_action" id="wpc_action2" value="" />
                <input type="hidden" name="cat_id" id="cat_id" value="" />
                <input type="hidden" name="reassign_cat_id" id="reassign_cat_id" value="" />
                <input type="hidden" name="display" id="display" value="old" />

                <input type="hidden" name="page" value="wpclients_content" />
                <input type="hidden" name="tab" value="files_categories" />
                <?php $ListTable->display(); ?>
            </form>
        </div>

        <script type="text/javascript">
            var site_url = '<?php echo site_url();?>';

            jQuery( document ).ready( function() {

                jQuery( '#wpc_new_cat' ).shutter_box({
                    view_type       : 'lightbox',
                    width           : '500px',
                    type            : 'inline',
                    href            : '#new_form_panel',
                    title           : '<?php echo esc_js( __( 'New File Category', WPC_CLIENT_TEXT_DOMAIN ) ); ?>'
                });

                jQuery( '#wpc_reasign' ).shutter_box({
                    view_type       : 'lightbox',
                    width           : '500px',
                    type            : 'inline',
                    href            : '#reasign_form_panel',
                    title           : '<?php echo esc_js( __( 'Reassign Files Category', WPC_CLIENT_TEXT_DOMAIN ) ); ?>'
                });

                //reassign file from Bulk Actions
                jQuery( '#doaction2' ).click( function() {
                    var action = jQuery( 'select[name="action2"]' ).val() ;
                    jQuery( 'select[name="action"]' ).attr( 'value', action );

                    return true;
                });

                var group_name  = "";
                var folder_name = "";

                jQuery.fn.editGroup = function ( id, action ) {
                    if ( action == 'edit' ) {
                        group_name = jQuery( '#cat_name_block_' + id ).html();
                        group_name = group_name.replace(/(^\s+)|(\s+$)/g, "");

                        folder_name = jQuery( '#folder_name_block_' + id ).html();
                        folder_name = folder_name.replace(/(^\s+)|(\s+$)/g, "");


                        jQuery( '#cat_name_block_' + id ).html( '<input type="text" name="cat_name" size="30" id="edit_cat_name"  value="' + group_name + '" /><input type="hidden" name="cat_id" value="' + id + '" />' );
                        jQuery( '#folder_name_block_' + id ).html( '<input type="text" name="folder_name" size="30" id="edit_folder_name"  value="' + folder_name + '" />' );

                        jQuery( '#edit_cat input[type="button"]' ).attr( 'disabled', true );

                        jQuery( this ).parent().parent().attr('style', "display:none" );
                        jQuery( '#save_or_close_block_' + id ).attr('style', "display:block;" );

                        return '';

                    } else if ( action == 'close' ) {
                        jQuery( '#cat_name_block_' + id ).html( group_name );
                        jQuery( '#folder_name_block_' + id ).html( folder_name );

                        jQuery( '#save_or_close_block_' + id ).attr('style', "display:none;" );
                        jQuery( this ).parent().next().attr('style', "display:block" );

                        return '';
                    }


                };


                jQuery.fn.saveGroup = function ( ) {

                    jQuery( '#edit_cat_name' ).parent().parent().attr( 'class', '' );

                    if ( '' == jQuery( '#edit_cat_name' ).val() ) {
                        jQuery( '#edit_cat_name' ).parent().parent().attr( 'class', 'wpc_error' );
                        return false;
                    }

                    jQuery( '#wpc_action2' ).val( 'edit_file_cat' );
                    jQuery( '#edit_cat' ).submit();
                };

                //block for delete cat
                jQuery.fn.deleteCat = function ( id, act ) {
                    if ( 'show' == act ) {
                        jQuery( '#cat_reassign_block_' + id ).slideToggle( 'slow' );

                        if( jQuery(this).html() == '<?php echo esc_js( __( 'Cancel Delete', WPC_CLIENT_TEXT_DOMAIN ) ) ?>' ) {
                            jQuery(this).html( '<?php echo esc_js( __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ) ) ?>' );
                        } else {
                            jQuery(this).html( '<?php echo esc_js( __( 'Cancel Delete', WPC_CLIENT_TEXT_DOMAIN ) ) ?>' );
                        }
                    } else if( 'reassign' == act ) {
                        if( confirm("<?php echo esc_js( __( 'Are you sure want to delete permanently this category and reassign all files and parent categories to another category? ', WPC_CLIENT_TEXT_DOMAIN ) ) ?>") ) {
                            jQuery( '#wpc_action2' ).val( 'delete_file_category' );
                            jQuery( '#cat_id' ).val( id );
                            jQuery( '#reassign_cat_id' ).val( jQuery( '#cat_reassign_block_' + id + ' select' ).val() );
                            jQuery( '#edit_cat' ).submit();
                        }
                    } else if( 'delete' == act ) {
                        if( confirm("<?php echo esc_js( __( 'Are you sure want to delete permanently this category with all files and parent categories? ', WPC_CLIENT_TEXT_DOMAIN ) ) ?>") ) {
                            jQuery( '#wpc_action2' ).val( 'delete_file_category' );
                            jQuery( '#cat_id' ).val( id );
                            jQuery( '#edit_cat' ).submit();
                        }
                    }
                };

                //Reassign files to another cat
                jQuery( '#reassign_files' ).click( function() {
                    if ( jQuery( '#old_cat_id' ).val() == jQuery( '#new_cat_id' ).val() ) {
                        jQuery( '#old_cat_id' ).parent().parent().attr( 'class', 'wpc_error' );
                        return false;
                    }
                    jQuery( '#wpc_action3' ).val( 'reassign_files_from_category' );
                    jQuery( '#reassign_files_cat' ).submit();
                    return false;
                });

                jQuery( 'input[name=create_cat]' ).click( function() {
                    if( jQuery( '#cat_name_new' ).val() != '' ) {
                        return true;
                    }
                    return false;
                });



                jQuery( '.wp-list-table').attr("id", "sortable");

                var fixHelper = function(e, ui) {
                    ui.children().each(function() {
                        jQuery(this).width(jQuery(this).width());
                    });
                    return ui;
                };

                jQuery( '#sortable tbody' ).sortable({
                    axis: 'y',
                    helper: fixHelper,
                    handle: '.order',
                    items: 'tr'
                });

                jQuery( '#sortable' ).bind( 'sortupdate', function(event, ui) {

                    new_order = new Array();
                    jQuery('#sortable tbody tr td.order div').each( function(){
                        new_order.push( jQuery(this).attr("id") );
                    });
                    jQuery( 'body' ).css( 'cursor', 'wait' );
                    jQuery.ajax({
                        type: 'POST',
                        url: '<?php echo get_admin_url() ?>admin-ajax.php',
                        data: 'action=change_cat_order&new_order=' + new_order,
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
            });
        </script>

    </div>

</div>