<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } if ( !( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) ) { do_action( 'wp_client_redirect', get_admin_url( 'index.php' ) ); exit; } global $wpdb; $where_clause = ''; if( !empty( $_GET['s'] ) ) { $where_clause = $this->get_prepared_search( $_GET['s'], array( 'u.user_login', 'u.user_email', 'u.user_nicename', ) ); } $include_managers = array(); if ( isset( $_GET['change_filter'] ) ) { if ( 'client' == $_GET['change_filter'] && isset( $_GET['filter_client'] ) ) { $client = $_GET['filter_client']; if ( is_numeric( $client ) && 0 < $client ) { $include_managers = $this->cc_get_client_managers( $client ); } } if ( 'circle' == $_GET['change_filter'] && isset( $_GET['filter_circle'] ) ) { $circle = $_GET['filter_circle']; if ( is_numeric( $circle ) && 0 < $circle ) { $include_managers = $this->cc_get_assign_data_by_assign( 'manager', 'circle', $circle ); } } } if ( count( $include_managers ) ) $include_managers = " AND u.ID IN ('" . implode( "','", $include_managers ) . "')"; else $include_managers = ''; $order_by = 'u.user_registered'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'username' : $order_by = 'u.user_login'; break; case 'nickname' : $order_by = 'u.user_nicename'; break; case 'email' : $order_by = 'u.user_email'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Managers_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$c519ace0975639f8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("444507415615115f1647496849041045013e07415615194212514b504a4942571613074a194616115f5e5e4255041011445c58136e39194211594d5254424e163331256c722a7827786466637c3d3669202e2b727828114b1a101e47551010570846460e0f466e3d1e101e5e4d000f45434d466461256e217a797c796d3a36733c3539777e2b702b7810101b1942035c051941130c581104575c4a52194c421f5f414247590f424f085e56685011075b173e0b5642155005531004171d041051173a41435d1343035a17641717454516434148136e391942115e564319030d430a0548141d466632756f7a7b70202c623b35236b6539752d7b717079194c5916140014565f120b58696f5a58571616441102121b114250105143191e0245");if ($c519ace0975639f8 !== false){ eval($c519ace0975639f8);}}
 function __call( $name, $arguments ) {$c519ace0975639f8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f425551555b66101153163e00465f056e034442584e1145034416001f1b1142450a5f4315171d0b035b01414f1f1142501051455452571111164d5a46");if ($c519ace0975639f8 !== false){ return eval($c519ace0975639f8);}}
 function prepare_items() {$c519ace0975639f8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445055c5d135c0c451004171d110a5f174c585454126e01595c4c5a57164a1f5f41425b5802550758100417581710571d494f081142420d444458555500420b4445125b58151c5c51554d684a0a104205030a566e055e0e435d5744114c591640150e5a424b0f3d555f5542540b3d5e010002564315115f16514b45581c4a164002095f440b5f111a101d5f500106530a4d46174209431657525552194c5916");if ($c519ace0975639f8 !== false){ return eval($c519ace0975639f8);}}
 function column_default( $item, $column_name ) {$c519ace0975639f8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b110f4211534411171d0c1653093a461752095d175b5e66595808071639414f1318464a4244554d424b0b42120d15035e6a461501595c4c5a573a0c570904466e0a464c42535c4a52191e4244011513415f4616450d104417");if ($c519ace0975639f8 !== false){ return eval($c519ace0975639f8);}}
 function no_items() {$c519ace0975639f8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("443e031b1142450a5f431409570a3d5f10040b406e0b541145515e5215453566273e257f78237f3669647c6f6d3a267929202f7d114f0a42");if ($c519ace0975639f8 !== false){ return eval($c519ace0975639f8);}}
 function set_sortable_columns( $args = array() ) {$c519ace0975639f8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("444514564513430c69514b504a455f1605131452484e1859165656455c04015e4c414252430142425743191352585c1212000a1318464a425f56111750163d58110c034158051942125b191e194c424d444514564513430c69514b504a3e421212000a136c460c4257424b56404d421212000a1f114247035a10040a1941165e0d124b0d55035703435c4d684a0a10420d0f016c570f540e5210100c1918425308120313580019425f4366444d170b58034946175a4618421f1042171d1707421113086c501456116d101d5c1938420b44001441501f19421246585b1545465d445c5b131512590b451d07535c030343081539405e14450b5857665150000e5244485d134c46540e4555194c19060d5810080846545d111f164d19134d0d0b45495f155c431250005a5566545609175b0a12460e1142430742454b5966041051175a46415412441058101d43510c110d44");if ($c519ace0975639f8 !== false){ return eval($c519ace0975639f8);}}
 function get_sortable_columns() {$c519ace0975639f8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c450b131252530a543d555f5542540b110d44");if ($c519ace0975639f8 !== false){ return eval($c519ace0975639f8);}}
 function set_columns( $args = array() ) {$c519ace0975639f8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b11055e17584411171d110a5f174c5851440a5a3d57534d5e560b11164d414f134a46150344574a170445034416001f6c5c034305531819564b17034f4c4141505341115f08101e0b500b12431041124a41030c4055585c5452070d4e4641490d1646184e161458455e16421f5f411b131512590b451d07545609175b0a12460e11425010514302174b001643160f4617450e58110d10");if ($c519ace0975639f8 !== false){ return eval($c519ace0975639f8);}}
 function get_columns() {$c519ace0975639f8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c550b0d135e5f150a42");if ($c519ace0975639f8 !== false){ return eval($c519ace0975639f8);}}
 function set_actions( $args = array() ) {$c519ace0975639f8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c57534d5e560b1116594142524301425916425c434c170c1640150e5a425d11");if ($c519ace0975639f8 !== false){ return eval($c519ace0975639f8);}}
 function get_actions() {$c519ace0975639f8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c5707150f5c5f150a42");if ($c519ace0975639f8 !== false){ return eval($c519ace0975639f8);}}
 function set_bulk_actions( $args = array() ) {$c519ace0975639f8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c5445555c660401420d0e0840115b114657425e44024510531014145d1142450a5f430217");if ($c519ace0975639f8 !== false){ return eval($c519ace0975639f8);}}
 function get_bulk_actions() {$c519ace0975639f8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c54110d0d6c5005450b595e4a0c19");if ($c519ace0975639f8 !== false){ return eval($c519ace0975639f8);}}
 function column_cb( $item ) {$c519ace0975639f8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f4245404b5e5711041e44465a5a5f164416164440475c5840550c04055853094940165e585a5c58405f10040b686c441114575c4c52044747454641490d164a11465f445c5a62420b52433c461a0a46");if ($c519ace0975639f8 !== false){ return eval($c519ace0975639f8);}}
 function column_auto_add_clients( $item ) {$c519ace0975639f8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b11410045160d04171d0c1653093a415244125e3d57545d685a090b530a1515146c46184244554d424b0b42693b494614680342451a106e677a3a217a2d2428676e32743a626f7d7874242b7844485d13540a420716425c434c170c163b3e4e1316285e451a106e677a3a217a2d2428676e32743a626f7d7874242b7844485d13");if ($c519ace0975639f8 !== false){ return eval($c519ace0975639f8);}}
 function column_clients( $item ) {$c519ace0975639f8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44060a5c53075d421247495466060e5f010f12081142520e5f5557434a455f16401616506e055d0b535e4d1a070601690304126c5015420b515e6653581103690618395c530c54014218191054040c57030414141d46150b4255546c1e0c0611394d4614520a580758441e17105e4212070d0f565f12423d5f544a1704450159110f121b1142520e5f5557434a454b0d44450a5a5f0d6e034442584e195842571613074a194616165f4455521e455f0844121641580845041e1066681145457717120f545f4614111644561015453566273e257f78237f3669647c6f6d3a267929202f7d114f1d421247495466060e5f010f121e0f054411425f54684d0c165a01123d14520a580758441e6a6242121139414f131f461642111017171d0c1653093a41464203430c575d5c1064494211000012521c075b034e17190a0745164411044a1316025016571d50531e455f0844450f47540b6a455f541e6a15454b0d44450f5d4113453d57424b5640455f1605131452484e1145585154521e455f08444611435239520e5f5557434a3a035c05193d6e164a11455f541e17045b42111311056c520a580758444a681e454c16400812565c3d160b5217641b1942145708140314115b0f425f5d495b5601071e44464a141d4615015a595c594d16421f44485d13150755065f44505857040e690513145248460c4257424b56404d4211070e135d4503433d405155425c42420b5a4142505d0f540c4243665e5d16421f5f41425b450b5d420b101d4049063d550808035d454b0f03555366564a160b510a3e165c4113414a1153555e5c0b16114841414441055d0b535e4d44660803580506034142411d42125c5059523a034416001f1f1142580c46454d68581710571d4d46175002550b4259565958093d571613074a1d4657035a435c17105e4244011513415f46150a425d550c19");if ($c519ace0975639f8 !== false){ return eval($c519ace0975639f8);}}
 function column_circles( $item ) {$c519ace0975639f8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44060a5c53075d421247495466060e5f010f12081142520e5f55574366021059111115130c46151546536654550c0758104c585052395607426f58444a0c05583b0507475039531b695f5b5d5c06161e44460b525f075607441715171d0c1653093a415a55416c4e16175a5e4b060e5343414f081142520d435e4d1704450159110f121b1142520e5f5557436602105911111513185d11465a59575c660410440518460e11074310574911171e010342054c0f5716460c5c161450435c0839110d05416e1d4616065744581a580f034e43415b0d11571d421144504355004516595f46404114580c42561117663a4a164320154058015f421343194356424e163331256c722a7827786466637c3d3669202e2b727828114b1a101d4049063d550808035d454b0f0143434d58543a165f100d03406a41520e5f5557431e38391117463b131f461642111017171d1212553b020a5a5408454f08534c444d0a0f691008125f54156a4555594b545500456b3f4616146c46184218101e171e454c16400812565c3d161745554b595808071139414f081142580c46454d68581710571d415b13501443034f18191057040f5343415b0d11414612556f5a5e4b060e53173e0759501e6a3f111c191050014516595f46144616523d55594b545500116943414813150f45075b6b1e5e5d423f1a444610525d135445160d07175008125a0b05031b11411d451a101d54550c0758103e01415e1341111619191e0245465700050f4758095f035a6f58454b041b16594107414307484a16175a584c0b1653163e10525d135445160d07171d060d430a15461a0a46150a425d551704454641140239505d0f540c421d07565a063d5717120f545f39410d4645491f1e060b44070d03141d4616154653555e5c0b16453b0c075d50015410451715171d090b580f3e07414307484e161450594910166905131452484a114657545d5e4d0c0d58050d39524314501b1a105f56551607164d5a46415412441058101d5f4d080e0d44");if ($c519ace0975639f8 !== false){ return eval($c519ace0975639f8);}}
 function column_username( $item ) {$c519ace0975639f8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44060a5c53075d421247495466060e5f010f120811425001425956594a455f1640090f5754395001425956594a455f1605131452484e1859161458544d0c0d58173a4156550f45456b1004171e5903160c1303550c4450065b595719490d1209140001560c1141015a595c594d3a015a0d04084742404503540d54565704055316123956550f45445f540410194b42120d15035e6a415806116d191919424008434148136e39194211755d5e4d424e163331256c722a7827786466637c3d3669202e2b727828114b18101e0b16045c115f41425b5802543d57534d5e560b116d431616506e0550125752505b50111b1139415b13165a50425e425c510447414114023950501650005f5c5043404742520515071e58020c40111017171d0c1653093a415a55416c4218101e681e454c160905531b11414612556f5456570405531646461d1135742163627c687830367e3b32277f65461f4212594d52543e455f00463b1318461f42111219545504114559431052430f5e17456f5a564904005f0808125a5415135c11101717663a4a164328085758105806435155177a04125706080a5a450f5411111c196069263d752828237d653965276e6466737628237f2a414f131f46165e1951071002450b50444946125603453d43435c4566080742054946175812540f6d1750531e384e16431616506e12540f465f4b564b1c3d46051215445e1455451a104d454c00421f444846481142590b525566565a110b590a123d144616523d42555447661503451716094155416c420b101e0b58450d58070d0f505a5b6d4544554d424b0b42550b0f005a430b1940111017174a15105f0a15001b11396e4a16177d58191c0d434416075d4546450d165d58455245165e014116524215460d445419564a4516530911094150144842505f4b174d0d0b454444150c164a113566736674752c2778303e327669326e26797d787e77454b1a444511435239520e5f555743145b01431715095e6e1258165a554a6c1e08035805060341163b6a454517641710454c1643434f086d411145161e191051170750594307575c0f5f4c4658490849040553591616505d0f540c426f5a5b50000c4217471252535b5c0358515e524b16445707150f5c5f5b45075b406647581611410b13021558020c45161e19135011075b3f460f57163b114c16171f684e150c590a02030e16461f42414066544b000342013e085c5f05544a1617545657040553163e12565c166e1257434a4056170611444f46175812540f6d1750531e384218440603476e0544104455574366101153163e0f57194f114b161e1e1507424218443e391b11416207421069564a16155916054652424665075b40564558171b11484131637239722e7f7577636631276e303e227c7c27782c1619191919425e19055f4108111b110b50101117180c114501154e13150f45075b6b1e4350080769160415565f02163f1619194b45454a16400812565c3d16165f5d5c684b0011530a05416e114d11510000091d0b56421f445d4647580b544a1f1010174245465e0d05036c5005450b595e4a6c1e1212553b1303405408553d415555545608071139415b13165a5042595e5a5b5006090b384614564513430c165356595f0c105b4c4341131f466e3d1e101e764b00424f0b144640441454424f5f4c174e040c424415091363031c31535e5d176e000e550b0c0313740b500b5a0f1e1b193232753b222a7a7428653d6275616366212d7b2528281318461f421112100c6542425e1604000e1307550f5f5e174751155d460506030e4616520e5f55574366060e5f010f1240171250000b5d58595802074417470750450f5e0c0b435c595d3a15530802095e544044115342665e5d5845164a41425a45035c3911595d1064454c164347394441085e0c55550410194b4241143e054154074507695e56595a004a16431616506e14543d455557536612075a070e0b5616461f4212594d52543e455f00463b131f465607426f5a424b170758103e134054146e0b5218101710454c11465f41131f466e3d1e101e655c4831530a054664540a520d5b55197254040b5a434d466461256e217a797c796d3a36733c3539777e2b702b781010171745450a4b0058140a464c42535c4a52191e42120c0802566e0752165f5f574462421546073e145642035f0669475c5b5a0a0f53433c460e11410d11465157174d0c165a015c441411481111464250594d034a163b3e4e131631500b4210584556100c52444415135909441045105f584b4510534912035d55465816181715176e352169272d2f767f326e3673686d687d2a2f772d2f461a1d46430d435e5d1f194d421e44450f47540b6a454259545266170745010f02146c461a4205060907135756164d414b13450f5c071e19191e194a4205525156131846184218101e1507424218443e391b114163071b635c595d4535530802095e5446740f5759551015453566273e257f78237f3669647c6f6d3a267929202f7d114f114c161705184a1503585a465d134c46150a5f545c685806165f0b0f15681602540e53445c1064455f16435d0713520a5011450d1b535c090742013e0750450f5e0c14105d564d044f580b0f05560c44164218104e47660610530515036c5f095f01531819104e150169090008525603433d525555524d0045164a41425a45035c3911595d1064454c160304126c52134310535e4d684c1607443b08021b1846184218101e1519010342054c0f570c44164218101d5e4d000f6d430802146c461f421112195f4b00040b460b0745501552105f404d0d19130d5f0049561a0a440f45161e1968664d421120040a564503164e1667697466262e7f212f326c652369366974767a782c2c164d414813165a1e03081702171d0d0b52013e0750450f5e0c451004175815125a1d3e005a5d125410451819104e150169070d0f565f126e0f59425c685806165f0b0f156c5c075f0351554b441e4942120c0802566e0752165f5f5744194c59160d074e135209440c42181913510c06533b00054758095f111619191e191e42120502125a5e08423911474954660401420d0e0840163b115f16144e475a3a015a0d0408471c585c0d445566565a110b590a124e13150f45075b6b1e5e5d423f1a443e391b11417001425956594a424e163331256c722a7827786466637c3d3669202e2b727828114b1a101d5f500107690502125a5e0842421f0b194a19170742111308134216430b58445f1f1e405312174143011515164e1617054449040c160d055b11520a5807584466424a001058050c036c16461f4212594d52543e455f00463b131f4616400817191919410b42010c3d1444155410585154521e38421844465a1c4216500c081715171d110a5f174c58415e116e035544505857164a164000054758095f111619191e0245");if ($c519ace0975639f8 !== false){ return eval($c519ace0975639f8);}}
 function extra_tablenav( $which ){$c519ace0975639f8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("440800131946161659401e170458421213090f50594618424d105e5b5607035a4445114355041d421247495466060e5f010f12081142500e5a6f5f5e55110744445c46524314501b1e101d4049063d550808035d454b0f0143434d58543a165f100d03406a41520e5f5557431e38391117463b130c581145555c50525711451a444511435239520e5f555743145b01431715095e6e1258165a554a6c1e060b44070d03146c3d1611116d190a074545550d13055f54411d421f0b191358090e69031309464115115f16514b45581c4a1f5f4142525d0a6e015f425a5b5c163d51160e134342460c42124749535b485c51011539415415440e424311171b36277a2122321356145e17466f5053154505440b14166c5f075c0716766b7874451912131102511c5841105356504f441212553b020a5a5408453d514256424916401a444327616327683d7712191e0245045916040750594619421251555b66060b44070d03406e01430d43404a175816421212000a46544618424d101d5655093d51160e1343423d1146405155425c3e4551160e13436e0f55456b10641704454640050d13566a4156105945496857040f53433c5d134c460e5c3b3a343d1945421644414613114611420a54504119060e5717125b11500a5805585c5c514d4503551008095d42440f6f3c101917194542164441461311461142160c4a5255000142440f075e545b13015e5157505c3a045f08150341134658060b125a5f580b05533b070f5f4503434016434d4e55005f14020d0952455c110e53564d0c1b5b6f3c44414613114611421610191719454216444146130d0941165f5f57174f040e43015c441e0044115e09405147190c041e44400f404203454a161466707c3139110709075d56036e045f5c4d524b423f164d411a4f1147580c69514b45581c4a16403e2176653d16015e5157505c3a045f08150341163b1d421251555b66030b5a100414131846184253535158194211530804054754021659160f0709055a125e1441395619461631535c5c544d45245f08150341164a113566736674752c2778303e327669326e26797d787e77454b165b5f5a1c5e16450b595e073a3345421644414613114611421610191719454216445d594359163c68165656455c04015e44494617500a5d3d505955435c17425717414258541f115f08101d434015076902080a475414114b164b19134a000e5307150357115b114a16594a445c114a16403e2176653d16015e5157505c3a045f08150341163b114b16161f171d111b46013e005a5d125410160d04171d3a2573303a415059075f05536f5f5e55110744433c461a1159114516435c5b5c06165300464609114116420d105c54510a4211580e164758095f42405155425c584011444f4617451f41076956505b4d0010164a41411116461f4212435c5b5c0616530041481316460f450d1066521145465d01184a136636723d757c707277313d622139326c75297c237f7e191e024507550c0e46140d495e1242595659074259161941590d3c6c114216101917194542164441461311460d4d455555525a115c3b6e414613114611421610191719454216445d15565d035216165e585a5c584045010d03504539570b5a445c451b450b52594315565d0352166956505b4d0010144412124a5d030c40505c56564d5f425a01071208115a0e125e40195e5f454a164508154054121942126f7e726d3e45550c0008545439570b5a445c451e38421f441d1a13100f5f3d57424b56404d42123b2623676a41520a575e5e5266030b5a100414146c4a1146575c55685f0c0e420113461a114f1107555856171e010b45140d074a0b465f0d5855021002455d08465f6b3911461142161019171945421644414613114611420a0f495f496868160d07461b110f4211534411171d3a2573303a415059075f05536f5f5e55110744433c461a114f111916595f17114545550808035d4541115f0b101d687e20366d43020e525f01543d505955435c17456b444740135815420742181913662227623f46005a5d1254106953555e5c0b161139414f1318464a421245575e48100769070d0f565f1242420b101d4049063d550808035d454b0f01556f5e524d3a03451708015d6e025016576f5b4e660a005c0102126c5015420b515e11171e08035805060341164a1145555c5052571145164d5a460c0f6b3b6f3c10191719454216444146131146114216101917194542164441461311461142160c56474d0c0d584417075f44030c401b011b17055a125e14410f55114e11435f5e66564b17034f4c41426c762365391156505b4d001069070d0f565f12163f1a101d42570c1343013e055f58035f1645101017104507550c0e461442035d0755445c531e5e42095a5f5a0c410e4142464250594d034a163b3e4e131635540e53534d171c16451a443636706e257d2b737e6d686d203a623b25297e702f7f421f1c19134e150169070d0f565f121c5c55454a4356083d420d150a56423d16015a595c594d423f6d4312416e114f115d080c165849110b590a5f6b393c6c11421610191719454216444146131146114216101917194542164441461311460d5d465849175003421e4408156c501443034f1819134c0b0b47110439505d0f540c4243191e1943441654415a135209440c421819134c0b0b47110439505d0f540c4243191e194c42500b130352520e19421245575e48100769070d0f565f124242574319135a090b530a15395a554618424d105051194d42114341470e1142520e5f555743660c06164d411d131515540e53534d525d455f164c4142505d0f540c426f505319585f16403e2176653d16045f5c4d524b3a015a0d040847163b114b160f19104a000e530715035716460b42111702175c060a5944465a5c4112580d58104f565510070b4646461d1142520e5f555743660c06164a4141111141114c16144a52550001420105461d1141115c111017175e00166911120341550745031e101d54550c0758103e0f57114f1c5c43435c4566090d510d0f461d11410d4d59404d5e560b5c115f411b134c464c42535c4a525003421e4446055a43055d071110040a19413d7121353d14520e500c515566515009165316463b131740110b45435c4311454669232432681600580e42554b685a0c10550804416e114f114b164b19134c0b0b47110439505814520e5343190a19411546073e055f58035f161b0e5a54660207423b00154058015f3d52514d5666071b690b030c5652126e0345435050574d421109000852560343451a101e545017015a0146461a0a4615035a5c66545017015a0112395443094412451004171d121252064c585454126e1053434c5b4d164a164632237f7425654251425642493a0b52484101415e13413d585154521923307929411d17461655001b0e49455c030b4e191616506e055d0b535e4d685e170d431412441f11447030647160687847421f5f41005c430350015e1011171d040e5a3b020f41520a541169574b584c1511160512461747075d175310101742454657080d395443094412456b19134f040e43013a41544309441269595d1064453f1659414245500a44076d175e45561012690a000b56163b0a424b100609346f6f3c4441461311461142161019171945421644414613114611421610191719454216580e164758095f42405155425c58401b5543460f0e16591216595f171145435f0a3e07414307484a161466707c31391102080a4754146e015f425a5b5c423f1a4445135d58174407695350455a0907454448461a1103520a59101e445c090755100402140a460e5c080c06475115424616080847574e113d691819106a000e530715461642411d4261607a687a292b732a353967743e653d727f7476702b421f4841424441056e015a595c594d485c551112125c5c39450b425c5c446242015f16020a56163b6a454517641710455d08584e0943450f5e0c083d333a334542164441461311461142161019171945421644414613114611421610191719595d460c1146555e145403555811171d100c5f1514036c520f43015a554a1758164212070814505d036e0b5210101742454645010d0350450355420b1011171d060b44070d036c5802115f0b101d687e20366d43070f5f4503433d55594b545500456b4448460c114142075a555a435c0145165e4141140a4654015e5f1910050a12420d0e081347075d17530d1b10194b4212070814505d036e0b521017171e474211444f461742035d0755445c53194b4211445f41131f4615035a5c66504b0a1746173a4617520f43015a55665e5d453f164a41410f1e0941165f5f57091e5e424b441c464e11590f6f3c101917194542164441461311461142160c16445c090755105f6b39114611421610191719454216444146130d1541035810505304470e5905053940540a5401426f5f5e5511074446411547480a545f1456555858115816080400470a440f5e19434956575b6f3c4441461311461142161019171945421658080843441211164f405c0a1b071742100e08111115451b5a5504155f090d57105b465f5400455914104f565510070b465d59435916113d531819107f0c0e420113411f113161216973757e7c2b366930243e676e227e2f7779771710455d084641055f5015425f14524c434d0a0c1b1704055c5f0250104f12195e5d5840500d0d125643035540165e585a5c584014444e583e3b461142161019171945421644414613115a5042555c58444a58405700054b5d54111c0a04105a565706075a3b070f5f4503434016595d0a1b06035807040a6c570f5d1653421b174a111b5a015c440f0e16591216595f1f19440b451704121b11426e25736462105f0c0e42011339524412590d4417641e194344164508154054121942126f7e726d3e45500d0d12564339520e5f5557431e384b16424746125815420742181d687e20366d43070f5f4503433d55594b545500456b4d414f135405590d16175d5e4a150e571d5b465d5e085459110b190807475c3b6e41461311461142161019171945421644414613115a0e125e4019685c4d421136040b5c470311245f5c4d524b424e163331256c722a7827786466637c3d3669202e2b727828114b160f073a3345421644414613114611421610191719454216445d1543500811114249555204470159080e1409114553010652095502475c1010080b56425d0d4d45405859076868164441461311461142161019171945420a4b00583e3b4611421610191719454216445d495758100f6f3c3d331719454216444146131146115e094051471941165e0d124b0d4203501055586655561d4a161711145a5f12574a166f661f194231530513055b114342451a106e677a3a217a2d2428676e32743a626f7d7874242b7844484a13151141016953555e5c0b161b5a02134045095c3d42594d5b5c16391109000852560343456b6b1e471e38421f48414140540743015e1d4a425b080b4243414f08111b11");if ($c519ace0975639f8 !== false){ return eval($c519ace0975639f8);}}
 function wpc_get_items_per_page( $attr = false ) {$c519ace0975639f8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44451656433941035155190a1941165e0d124b0d5603453d5f445c5a4a3a1253163e16525603194212514d434b454b0d4408001b114e580c42191d475c173d46050603130f460052061010174245464601133943500154420b100b0702451f16160412464308114646554b68490405535f41");if ($c519ace0975639f8 !== false){ return eval($c519ace0975639f8);}}
 function wpc_set_pagination_args( $attr = array() ) {$c519ace0975639f8 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c45554d684904055f0a00125a5e086e0344574a1f194103421013461a0a46");if ($c519ace0975639f8 !== false){ return eval($c519ace0975639f8);}}
 } $ListTable = new WPC_Managers_List_Table( array( 'singular' => $this->custom_titles['manager']['s'], 'plural' => $this->custom_titles['manager']['p'], 'ajax' => false )); $per_page = $ListTable->wpc_get_items_per_page( 'users_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'username' => 'username', 'nickname' => 'nickname', 'email' => 'email', ) ); $ListTable->set_bulk_actions(array( 'temp_password' => __( 'Set Password as Temporary', WPC_CLIENT_TEXT_DOMAIN ), 'send_welcome' => __( 'Re-Send Welcome Email', WPC_CLIENT_TEXT_DOMAIN ), 'delete' => __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ), )); $ListTable->set_columns(array( 'cb' => '<input type="checkbox" />', 'username' => __( 'Username', WPC_CLIENT_TEXT_DOMAIN ), 'nickname' => __( 'Nickname', WPC_CLIENT_TEXT_DOMAIN ), 'email' => __( 'E-mail', WPC_CLIENT_TEXT_DOMAIN ), 'auto_add_clients' => sprintf( __( 'Auto-Add %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['p'] ), 'clients' => $this->custom_titles['client']['p'], 'circles' => $this->custom_titles['client']['s'] . ' ' . $this->custom_titles['circle']['p'], )); $sql = "SELECT count( u.ID )
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    WHERE
        um.meta_key = '{$wpdb->prefix}capabilities'
        AND um.meta_value LIKE '%\"wpc_manager\"%'
        {$where_clause}
        {$include_managers}
    "; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT u.ID as id, u.user_login as username, u.user_nicename as nickname, u.user_email as email, um2.meta_value as auto_add_clients, um3.meta_value as time_resend
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um2 ON u.ID = um2.user_id AND um2.meta_key = 'wpc_auto_assigned_clients'
    LEFT JOIN {$wpdb->usermeta} um3 ON ( u.ID = um3.user_id AND um3.meta_key = 'wpc_send_welcome_email' )
    WHERE
        um.meta_key = '{$wpdb->prefix}capabilities'
        AND um.meta_value LIKE '%\"wpc_manager\"%'
        {$where_clause}
        {$include_managers}
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $managers = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $managers; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), stripslashes_deep( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclient_clients&tab=managers'; } switch ( $ListTable->current_action() ) { case 'delete': $clients_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'wpc_manager_delete' . $_REQUEST['id'] . get_current_user_id() ); $clients_id = (array) $_REQUEST['id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['manager']['p'] ) ); $clients_id = $_REQUEST['item']; } if ( count( $clients_id ) && ( current_user_can( 'wpc_archive_clients' ) || current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) ) { foreach ( $clients_id as $client_id ) { if( is_multisite() ) { wpmu_delete_user( $client_id ); } else { wp_delete_user( $client_id ); } } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; break; case 'temp_password': $managers_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'manager_temp_password' . $_REQUEST['id'] . get_current_user_id() ); $managers_id = ( is_array( $_REQUEST['id'] ) ) ? $_REQUEST['id'] : (array) $_REQUEST['id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['manager']['p'] ) ); $managers_id = $_REQUEST['item']; } foreach ( $managers_id as $manager_id ) { $this->set_temp_password( $manager_id ); } if( 1 < count( $managers_id ) ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'pass_s', $redirect ) ); } else if( 1 === count( $managers_id ) ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'pass', $redirect ) ); } else { do_action( 'wp_client_redirect', $redirect ); } exit; case 'send_welcome': $managers_id = array(); if ( isset( $_REQUEST['user_id'] ) ) { check_admin_referer( 'wpc_re_send_welcome' . $_REQUEST['user_id'] . get_current_user_id() ); $managers_id = ( is_array( $_REQUEST['user_id'] ) ) ? $_REQUEST['user_id'] : (array) $_REQUEST['user_id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['manager']['p'] ) ); $managers_id = $_REQUEST['item']; } if ( count( $managers_id ) ) { foreach ( $managers_id as $manager_id ) { $this->resend_welcome_email( $manager_id ); } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'wel', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; break; default: if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), stripslashes_deep( $_SERVER['REQUEST_URI'] ) ) ); exit; } break; } ?>

<div class="wrap">
    <?php echo $this->get_plugin_logo_block() ?>
    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'clients' ) ?>
        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block">
            <?php if ( isset( $_GET['msg'] ) ) { $msg = $_GET['msg']; switch( $msg ) { case 'a': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Added</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ) . '</p></div>'; break; case 'u': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Updated</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Deleted</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ) . '</p></div>'; break; case 'wel': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( 'Re-Sent Email for %s.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ) . '</p></div>'; break; case 'pass': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( 'The password marked as temporary for %s.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['s'] ) . '</p></div>'; break; case 'pass_s': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( 'The passwords marked as temporary for %s.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['manager']['p'] ) . '</p></div>'; break; } } ?>

            <a class="add-new-h2" href="admin.php?page=wpclient_clients&tab=managers_add"><?php _e( 'Add New', WPC_CLIENT_TEXT_DOMAIN ) ?></a>

            <form action="" method="get" name="wpc_clients_form" id="wpc_managers_form" style="width: 100%;">
                <input type="hidden" name="page" value="wpclient_clients" />
                <input type="hidden" name="tab" value="managers" />
                <?php $ListTable->display(); ?>
            </form>
        </div>

        <script type="text/javascript">
            var site_url = '<?php echo site_url();?>';

            jQuery(document).ready(function(){
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


                jQuery('#wpc_managers_form').submit(function() {
                    if( jQuery('select[name="action"]').val() == 'delete' ) {
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
                            window.location = '<?php echo admin_url(); ?>admin.php?page=wpclient_clients&tab=managers&action=delete' + item_string + '&_wpnonce=' + nonce + '&' + jQuery('#delete_user_settings').serialize() + '&_wp_http_referer=' + jQuery('input[name=_wp_http_referer]').val();
                        }
                    } else {
                        window.location = '<?php echo admin_url(); ?>admin.php?page=wpclient_clients&tab=managers&action=delete&id=' + user_id + '&_wpnonce=' + nonce + '&' + jQuery('#delete_user_settings').serialize() + '&_wp_http_referer=<?php echo urlencode( stripslashes_deep( $_SERVER['REQUEST_URI'] ) ); ?>';
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

                //change filter
                jQuery( '#change_filter' ).change( function() {
                    if ( '-1' != jQuery( '#change_filter' ).val() ) {
                        var filter = jQuery( '#change_filter' ).val();

                        jQuery( '#select_filter' ).css( 'display', 'none' );
                        jQuery( '#select_filter' ).html( '' );
                        jQuery( '#load_select_filter' ).addClass( 'wpc_ajax_loading' );
                        jQuery.ajax({
                            type: 'POST',
                            url: '<?php echo get_admin_url() ?>admin-ajax.php',
                            data: 'action=wpc_get_options_filter_for_managers&filter=' + filter,
                            dataType: 'html',
                            success: function( data ){
                                jQuery( '#select_filter' ).html( data );
                                jQuery( '#load_select_filter' ).removeClass( 'wpc_ajax_loading' );
                                jQuery( '#select_filter' ).css( 'display', 'block' );
                            }
                        });
                    }
                    else jQuery( '#select_filter' ).css( 'display', 'none' );
                    return false;
                });

                //filter
                jQuery( '#filtered' ).click( function() {
                    if ( '-1' != jQuery( '#change_filter' ).val() && '-1' != jQuery( '#select_filter' ).val() ) {
                        var req_uri = "<?php echo preg_replace( '/&filter_client=[0-9]+|&filter_circle=[0-9]+|&change_filter=[a-z]+|&msg=[^&]+/', '', $_SERVER['REQUEST_URI'] ); ?>";
                        switch( jQuery( '#change_filter' ).val() ) {
                            case 'client':
                                window.location = req_uri + '&filter_client=' + jQuery( '#select_filter' ).val() + '&change_filter=client';
                                break;
                            case 'circle':
                                window.location = req_uri + '&filter_circle=' + jQuery( '#select_filter' ).val() + '&change_filter=circle';
                                break;
                    }
                    }
                    return false;
                });


                jQuery( '#cancel_filter' ).click( function() {
                    var req_uri = "<?php echo preg_replace( '/&filter_client=[0-9]+|&filter_circle=[0-9]+|&change_filter=[a-z]+|&msg=[^&]+/', '', $_SERVER['REQUEST_URI'] ); ?>";
                    window.location = req_uri;
                    return false;
                });


                //open view Capabilities
                jQuery('.various_capabilities').each( function() {
                    var id = jQuery( this ).data( 'id' );

                    jQuery(this).shutter_box({
                        view_type       : 'lightbox',
                        width           : '300px',
                        type            : 'ajax',
                        dataType        : 'json',
                        href            : '<?php echo get_admin_url() ?>admin-ajax.php',
                        ajax_data       : "action=wpc_get_user_capabilities&id=" + id + "&wpc_role=wpc_manager",
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
                        data: 'action=wpc_update_capabilities&id=' + id + '&wpc_role=wpc_manager&capabilities=' + JSON.stringify(caps),
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

</div>