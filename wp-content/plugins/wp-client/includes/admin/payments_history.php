<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } global $wpdb, $wpc_client; $where_client = ''; $where_function = ''; $where_status = ''; $all_status = array(); $all_counts = array(); $all_filter = array( 'Function' => 'function', $wpc_client->custom_titles['client']['s'] => 'client' ); $all_functions = $wpdb->get_col( "SELECT DISTINCT function FROM {$wpdb->prefix}wpc_client_payments ORDER BY function ASC" ); $all_count = $wpdb->get_var( "SELECT count(id) FROM {$wpdb->prefix}wpc_client_payments WHERE order_status != 'selected_gateway'" ); $all_order_status = $wpdb->get_col( "SELECT DISTINCT order_status FROM {$wpdb->prefix}wpc_client_payments WHERE order_status != 'selected_gateway' ORDER BY order_status ASC" ); if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), wp_unslash( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclients_payments'; } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ); exit; } foreach ( $all_order_status as $status ) { $key = str_replace( '_', ' ', $status ); $key = ucwords( $key ); $count = $wpdb->get_var( "SELECT count(id) FROM {$wpdb->prefix}wpc_client_payments WHERE order_status='$status'" ); $all_status[ $key ] = $status; $all_counts[ $key ] = $count; } if ( isset( $_GET['filter_status'] ) && in_array( $_GET['filter_status'], $all_status ) ) { $where_status = " AND order_status='" . esc_sql( $_GET['filter_status'] ) . "'"; } if ( isset( $_GET['change_filter'] ) ) { switch ( $_GET['change_filter'] ) { case 'client': if ( isset( $_GET['filter_client'] ) ) { $filter_client = (int)$_GET['filter_client']; $where_client = " AND client_id=$filter_client"; } break; case 'function': if ( isset( $_GET['filter_function'] ) ) { $filter_function = $_GET['filter_function']; if ( is_array( $all_functions ) && in_array( $filter_function, $all_functions ) ) $where_function = " AND function='" . esc_sql( $filter_function ) . "'"; } break; } } $where_clause = ''; if( !empty( $_GET['s'] ) ) { $where_clause = $wpc_client->get_prepared_search( $_GET['s'], array( 'u.user_login', 'cp.amount', 'cp.payment_method', ) ); } $order_by = 'time_paid'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'status' : $order_by = 'order_status'; break; case 'client' : $order_by = 'client_login'; break; case 'payment_method' : $order_by = 'payment_method'; break; case 'amount' : $order_by = 'amount * 1'; break; case 'date' : $order_by = 'time_paid'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Payments_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$cbe09e573df48849 = p45f99bb432b194dff04b7d12425d3f8d_get_code("444507415615115f1647496849041045013e07415615194212514b504a4942571613074a194616115f5e5e4255041011445c58136e39194211594d5254424e163331256c722a7827786466637c3d3669202e2b727828114b1a101e47551010570846460e0f466e3d1e101e5e4d000f45434d466461256e217a797c796d3a36733c3539777e2b702b7810101b1942035c051941130c581104575c4a52194c421f5f414247590f424f085e56685011075b173e0b5642155005531004171d041051173a41435d1343035a17641717454516434148136e391942115e564319030d430a0548141d466632756f7a7b70202c623b35236b6539752d7b717079194c5916140014565f120b58696f5a58571616441102121b114250105143191e0245");if ($cbe09e573df48849 !== false){ eval($cbe09e573df48849);}}
 function __call( $name, $arguments ) {$cbe09e573df48849 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f425551555b66101153163e00465f056e034442584e1145034416001f1b1142450a5f4315171d0b035b01414f1f1142501051455452571111164d5a46");if ($cbe09e573df48849 !== false){ return eval($cbe09e573df48849);}}
 function prepare_items() {$cbe09e573df48849 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445055c5d135c0c451004171d110a5f174c585454126e01595c4c5a57164a1f5f41425b5802550758100417581710571d494f081142420d444458555500420b4445125b58151c5c51554d684a0a104205030a566e055e0e435d5744114c591640150e5a424b0f3d555f5542540b3d5e010002564315115f16514b45581c4a164002095f440b5f111a101d5f500106530a4d46174209431657525552194c5916");if ($cbe09e573df48849 !== false){ return eval($cbe09e573df48849);}}
 function column_default( $item, $column_name ) {$cbe09e573df48849 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b110f4211534411171d0c1653093a461752095d175b5e66595808071639414f1318464a4244554d424b0b42120d15035e6a461501595c4c5a573a0c570904466e0a464c42535c4a52191e4244011513415f4616450d104417");if ($cbe09e573df48849 !== false){ return eval($cbe09e573df48849);}}
 function no_items() {$cbe09e573df48849 = p45f99bb432b194dff04b7d12425d3f8d_get_code("443e031b1142450a5f431409570a3d5f10040b406e0b541145515e5215453566273e257f78237f3669647c6f6d3a267929202f7d114f0a42");if ($cbe09e573df48849 !== false){ return eval($cbe09e573df48849);}}
 function set_sortable_columns( $args = array() ) {$cbe09e573df48849 = p45f99bb432b194dff04b7d12425d3f8d_get_code("444514564513430c69514b504a455f1605131452484e1859165656455c04015e4c414252430142425743191352585c1212000a1318464a425f56111750163d58110c034158051942125b191e194c424d444514564513430c69514b504a3e421212000a136c460c4257424b56404d421212000a1f114247035a10040a1941165e0d124b0d55035703435c4d684a0a10420d0f016c570f540e5210100c1918425308120313580019425f4366444d170b58034946175a4618421f1042171d1707421113086c501456116d101d5c1938420b44001441501f19421246585b1545465d445c5b131512590b451d07535c030343081539405e14450b5857665150000e5244485d134c46540e4555194c19060d5810080846545d111f164d19134d0d0b45495f155c431250005a5566545609175b0a12460e1142430742454b5966041051175a46415412441058101d43510c110d44");if ($cbe09e573df48849 !== false){ return eval($cbe09e573df48849);}}
 function get_sortable_columns() {$cbe09e573df48849 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c450b131252530a543d555f5542540b110d44");if ($cbe09e573df48849 !== false){ return eval($cbe09e573df48849);}}
 function set_columns( $args = array() ) {$cbe09e573df48849 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b11055e17584411171d110a5f174c5851440a5a3d57534d5e560b11164d414f134a46150344574a170445034416001f6c5c034305531819564b17034f4c4141505341115f08101e0b500b12431041124a41030c4055585c5452070d4e4641490d1646184e161458455e16421f5f411b131512590b451d07545609175b0a12460e11425010514302174b001643160f4617450e58110d10");if ($cbe09e573df48849 !== false){ return eval($cbe09e573df48849);}}
 function get_columns() {$cbe09e573df48849 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c550b0d135e5f150a42");if ($cbe09e573df48849 !== false){ return eval($cbe09e573df48849);}}
 function set_actions( $args = array() ) {$cbe09e573df48849 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c57534d5e560b1116594142524301425916425c434c170c1640150e5a425d11");if ($cbe09e573df48849 !== false){ return eval($cbe09e573df48849);}}
 function get_actions() {$cbe09e573df48849 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c5707150f5c5f150a42");if ($cbe09e573df48849 !== false){ return eval($cbe09e573df48849);}}
 function set_bulk_actions( $args = array() ) {$cbe09e573df48849 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c5445555c660401420d0e0840115b114657425e44024510531014145d1142450a5f430217");if ($cbe09e573df48849 !== false){ return eval($cbe09e573df48849);}}
 function get_bulk_actions() {$cbe09e573df48849 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c54110d0d6c5005450b595e4a0c19");if ($cbe09e573df48849 !== false){ return eval($cbe09e573df48849);}}
 function column_time_paid( $item ) {$cbe09e573df48849 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44060a5c53075d421247495466060e5f010f120811145416434257171d1212553b020a5a5408454f08535a685d0416533b0709415c07454a161450435c08391110080b566e16500b52176417105e42");if ($cbe09e573df48849 !== false){ return eval($cbe09e573df48849);}}
 function column_amount( $item ) {$cbe09e573df48849 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44060a5c53075d421247495466060e5f010f120811145416434257171d1212553b020a5a5408454f08535a685e00166914130f5054394216445957501145465f10040b6816075c0d435e4d1064494211434d46175812540f6d175a424b1707580718416e114f0a42");if ($cbe09e573df48849 !== false){ return eval($cbe09e573df48849);}}
 function column_transaction_id( $item ) {$cbe09e573df48849 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f4212594d52543e4542160008405005450b595e665e5d423f0d44");if ($cbe09e573df48849 !== false){ return eval($cbe09e573df48849);}}
 function column_client( $item ) {$cbe09e573df48849 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f4212594d52543e45550808035d45395d0d51595710645e42");if ($cbe09e573df48849 !== false){ return eval($cbe09e573df48849);}}
 function wpc_get_items_per_page( $attr = false ) {$cbe09e573df48849 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44451656433941035155190a1941165e0d124b0d5603453d5f445c5a4a3a1253163e16525603194212514d434b454b0d4408001b114e580c42191d475c173d46050603130f460052061010174245464601133943500154420b100b0702451f16160412464308114646554b68490405535f41");if ($cbe09e573df48849 !== false){ return eval($cbe09e573df48849);}}
 function wpc_set_pagination_args( $attr = array() ) {$cbe09e573df48849 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c45554d684904055f0a00125a5e086e0344574a1f194103421013461a0a46");if ($cbe09e573df48849 !== false){ return eval($cbe09e573df48849);}}
 function extra_tablenav( $which ){$cbe09e573df48849 = p45f99bb432b194dff04b7d12425d3f8d_get_code("440800131946161659401e170458421213090f50594618424d105e5b5607035a4445114355041d421247495466060e5f010f12081142500e5a6f5f5e55110744445c46524314501b1e101e714c0b01420d0e0814115b0f4211564c595a110b590a464a13151141016953555e5c0b161b5a02134045095c3d42594d5b5c163911070d0f565f12163f6d174a1064455f084446055f58035f161110100c1941035a083e00465f05450b595e4a17044546411405041e0f0154166953565b11454065212d23706546752b656470797a314250110f054758095f427062767a191e46411405041e0f1643075059414a4e150169070d0f565f126e1257495452571111162b3322766346733b16564c595a110b590a4127607244114b0d100609346f421644414613114611421610055350134255080015400c44500e5f57575b5c0316160502125a5e084240083d33171945421644414613114611421610190b4a000e530715465d500b545f145351565702076902080a47541413425f5404155a0d035803043955580a45074412073a3345421644414613114611421610191719454216445d0943450f5e0c1646585b4c005f14495044130d59410a461050511145435f171203471946153d71756d6c1e060a570a06036c570f5d1653421e6a194c424a1841475a5f3950104451401f19413d7121353d14520e500c515566515009165316463b1f1142500e5a6f5f5e551107444448461a1103520a59101e445c090755100402140a460e5c080c0647511542690149461462035d07554419715009165316464a136636723d757c707277313d622139326c75297c237f7e191e195a5c0a4b0e164758095f5c3b3a19171945421644414613114611421610191719455e0914091613570943075753511711454657080d3955580a450744105844194109531d415b0d1142451b465566515009165316414f134a461511535c5c544d00061659414e135815420742181913662227623f46055b500856076956505b4d00101139414f13174011464249495266030b5a100414130c5b114669777c636242015e050f01566e00580e42554b1064454b165b41411342035d0755445c531e455816434646081103520a59101e0b5615165f0b0f4645500a44070b121e17174546421d11036c570f5d165342191919424011444f461742035d0755445c53194b4211445f41081139544a1614525240494261342239707d2f742c626f6d7261313d722b2c277a7f46185916555a5f5645450a4b0e164758095f5c110b194a195a5c3b6e414613114611421610191719454216445d4940540a5401420e343d194542164441461311461142161019170516075a010212135f075c070b124a52550001423b070f5f4503434016595d0a1b16075a0102126c570f5d1653421b17055a125e14410f55114e11435f434a524d4d42123b2623676a41520a575e5e5266030b5a100414146c4618424a4c1916500b3d571613074a1946153d71756d6c1e060a570a06036c570f5d1653421e6a15454657080d3955580a450744101017104507550c0e46144212480e530d1b535016125a05185c135f095f070d121e0c195a5c08696b46131146114216101917194542164441461311460d5d465849175003421e4408154054121942126f7e726d3e45550c0008545439570b5a445c451e38421f44484648110f57421e101e514c0b01420d0e0814115b0c42126f7e726d3e45550c0008545439570b5a445c451e38421042410f404203454a161466707c31391102080a4754146e04435e5a43500a0c1139414f1318464a42090e343d194542164441461311461142161019171945421644414613114611420a5f4943500a0c1612000a46545b134f0712190b06150a46440800131946100b586f58454b041b1e4445397474326a45505955435c173d50110f054758095f456b1c191358090e6902140850450f5e0c45101017104507550c0e461442035d0755445c531e5e42095a5f5a0c410e4142695511171e36075a0102121377135f01425956591e494261342239707d2f742c626f6d7261313d722b2c277a7f461842090e05185615165f0b0f583e3b461142161019171945421644414613114611421610191719454216445d59435916110b5010111750163d571613074a194615035a5c66514c0b01420d0e0840114f11441010091705450159110f121b1142500e5a6f5f425706165f0b0f1513184618424d105f584b0003550c414e1315075d0e69564c595a110b590a12465242461504435e5a43500a0c164d411d135800114a16171e171858421202140850450f5e0c1619194c19411153080405475402115f161819135f100c551008095d115b0c42126f7e726d3e45500d0d12564339571758534d5e560b456b4448460c114142075a555a435c0145165e4141140a4654015e5f1910050a12420d0e081347075d17530d1b10194b421202140850450f5e0c161e19101b4545164a414240540a540142555d17174545165a46461d1142571758534d5e560b421844465a1c5e16450b595e071002451f1619411b134c46540e45555051194d4211070d0f565f1216420b0d1913662227623f46055b500856076956505b4d00101139414015110f4211534411171d3a2573303a4155580a4507446f5a5b50000c42433c461a114f111916144c59501417533b020a5a54084511160d19134e150654495f01564539520d5a1819156a202e73273546777835652b78736d175a090b530a15395a55467730797d194c1d121252064c58434303570b4e4d4e475a3a015a0d0408476e16501b5b5557434a47421f5f41590d3c6c114216101917194542164441461311461142161019171945421644415a5c4112580d58104f565510070b464c5711115a0e125e40195e5f454a164508086c501443034f181913662227623f46005a5d1254106953555e5c0b1611394d46174408581343556654550c07581012461a114f1107555856171e16075a0102125655410a42090e070b06150a464411145a5f12574a166f661f1942315308040547114342451a106e677a3a217a2d2428676e32743a626f7d7874242b7844484a13151141016953555e5c0b161b5a02134045095c3d42594d5b5c163911070d0f565f12163f6d174a1064454b165b5f5a1c5e16450b595e073a33454216444146131146114216101917194542164441461311461142160c06475115425f02414e1358156e034442584e114546430a0817465439520e5f5557434a454b1642474603115a110159455743114546430a0817465439520e5f5557434a454b164d411d13570943075753511f194117580d1013566e055d0b535e4d441904111640020a5a5408453d5f54191e191e425f02414e13164111430b101d54550c0758103e0f57114f111916144a52550001420105460e114e1146555c505257113d5f00415b0e11426e25736462105f0c0e42011339505d0f540c4217641710455d164312035f540545075217190d1942450d4404055b5e46165e59404d5e560b4240050d13560c44164218101d54550c0758103e0f571148114514101e1717454645010d03504503554218101e1707424218440603476e13420744545843584d4212070d0f565f126e0b5210101a07101153163e0a5c560f5f4218101e0b160a12420d0e080d165d111f164d194a1918424b445e583e3b461142161019171945421644414613115a1e11535c5c544d5b6f3c44414613114611421610191719454216581216525f4658060b12555858013d45010d03504539570b5a445c451b5b5e191711075d0f6b3b421610191719454216444146131146115e5f5e49424d45164f14045b1153134516595e1b1750015f1402080a475414540614104f565510070b465d59435916113d531819107f0c0e420113411f113161216973757e7c2b366930243e676e227e2f7779771710455d084641055f5015425f14524c434d0a0c1b1704055c5f0250104f1219595808070b4643461c0f6b3b421610191719454216444146131146115e57105a5b5816110b460002571c0854151b580b15190c060b4602075d52035d3d505955435c174016585e165b414658041e10185e4a1607424c41426c762365391156505b4d00106902140850450f5e0c116d10171f4342170d121556454e114669777c636242045f081503416e055d0b535e4d10644c421f4404055b5e461611424955520447065f17110a52485c110c595e5c0c1b4259165b5f460d3c6c11421610191719454216444146131146114216100508490d12163b044e131334540f59465c177f0c0e420113441f113161216973757e7c2b366930243e676e227e2f7779771710455d08696b46131146114216101917194542164441461311460d11465157174a111b5a015c44505e0a5e100c101a555a550006065a440d1712580f5343020b161612570a5f6b39114611421610191719454216444146130d49505c3b3a1917194542164441461311460d4d52594f09346f4216444146131146114216100508490d121640150e5a424b0f1153514b54513a00591c49466c6e4e1145655558455a0d426605180b565f1242451a106e677a3a217a2d2428676e32743a626f7d7874242b7844484a13161554034453511a4a10005b0d154113185d111f16");if ($cbe09e573df48849 !== false){ return eval($cbe09e573df48849);}}
 } $ListTable = new WPC_Payments_List_Table( array( 'singular' => __( 'Payment', WPC_CLIENT_TEXT_DOMAIN ), 'plural' => __( 'Payments', WPC_CLIENT_TEXT_DOMAIN ), 'ajax' => false )); $per_page = $ListTable->wpc_get_items_per_page( 'users_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'client' => 'client', 'status' => 'status', 'payment_method' => 'payment_method', 'time_paid' => 'time_paid', 'amount' => 'amount', ) ); $ListTable->set_bulk_actions(array( )); $ListTable->set_columns(array( 'order_id' => __( 'Order ID', WPC_CLIENT_TEXT_DOMAIN ), 'client' => $wpc_client->custom_titles['client']['s'], 'status' => __( 'Status', WPC_CLIENT_TEXT_DOMAIN ), 'payment_method' => __( 'Payment Method', WPC_CLIENT_TEXT_DOMAIN ), 'transaction_id' => __( 'Transaction ID', WPC_CLIENT_TEXT_DOMAIN ), 'amount' => __( 'Amount', WPC_CLIENT_TEXT_DOMAIN ), 'time_paid' => __( 'Date', WPC_CLIENT_TEXT_DOMAIN ), )); $sql = "SELECT count( cp.id )
    FROM {$wpdb->prefix}wpc_client_payments cp
    LEFT JOIN {$wpdb->users} u ON (cp.client_id = u.ID)
    WHERE order_status !='selected_gateway'
        {$where_function}
        {$where_client}
        {$where_status}
        {$where_clause}
    "; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT cp.order_id as order_id, cp.function as function, cp.order_status as status, cp.payment_method as payment_method, cp.client_id as client_id, u.user_login as client_login, cp.amount as amount, cp.currency as currency, cp.transaction_id as transaction_id, cp.time_paid as time_paid
    FROM {$wpdb->prefix}wpc_client_payments cp
    LEFT JOIN {$wpdb->users} u ON (cp.client_id = u.ID)
    WHERE order_status !='selected_gateway'
        {$where_function}
        {$where_client}
        {$where_status}
        {$where_clause}
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $cols = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $cols; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<div class="wrap">

    <?php echo $wpc_client->get_plugin_logo_block() ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">
        <div class="icon32" id="icon-link-manager"></div>
        <h2><?php _e( 'Payment History', WPC_CLIENT_TEXT_DOMAIN ) ?></h2>
        <p><?php _e( 'From here, you can see all payment operations.', WPC_CLIENT_TEXT_DOMAIN ) ?></p>

        <ul class="subsubsub">
            <li class="all"><a class="<?php echo ( !isset( $_GET['filter_status'] ) || !in_array( $_GET['filter_status'], $all_status ) ) ? 'current' : '' ?>" href="admin.php?page=wpclients_payments"  ><?php _e( 'All', WPC_CLIENT_TEXT_DOMAIN ) ?> <span class="count">(<?php echo $all_count ?>)</span></a></li>
            <?php foreach ( $all_status as $key => $status ) { $count = $all_counts[ $key ]; ?>
                <li class="image"> | <a class="<?php echo ( isset( $_GET['filter_status'] ) && $status == $_GET['filter_status'] ) ? 'current' : '' ?>" href="admin.php?page=wpclients_payments&filter_status=<?php echo $status; ?>"><?php _e( $key, WPC_CLIENT_TEXT_DOMAIN ) ?> <span class="count">(<?php echo $count ?>)</span></a></li>
            <?php } ?>
        </ul>

        <span class="wpc_clear"></span>

        <form action="" method="get" name="wpc_clients_form" id="wpc_payments_form" style="width: 100%;">
            <input type="hidden" name="page" value="wpclients_payments" />
            <?php $ListTable->display(); ?>
        </form>
    </div>

    <script type="text/javascript">
        var site_url = '<?php echo site_url();?>';

        jQuery(document).ready(function(){

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
                    data: 'action=wpc_get_options_filter_for_payments&filter=' + filter,
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
                    //if ( in_array() )
                    switch( jQuery( '#change_filter' ).val() ) {
                        case 'function':
                            window.location = req_uri + '&filter_function=' + jQuery( '#select_filter' ).val() + '&change_filter=function';
                            break;
                        case 'client':
                            window.location = req_uri + '&filter_client=' + jQuery( '#select_filter' ).val() + '&change_filter=client';
                            break;
                }
                }
                return false;
            });


            jQuery( '#cancel_filter' ).click( function() {
                var req_uri = "<?php echo preg_replace( '/&filter_client=[0-9]+|&filter_function=[a-z_-]+|&change_filter=[a-z_-]+|&msg=[^&]+/', '', $_SERVER['REQUEST_URI'] ); ?>";
                window.location = req_uri;
                return false;
            });

        });
    </script>

</div>