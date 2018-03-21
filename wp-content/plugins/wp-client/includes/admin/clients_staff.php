<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } if ( !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) && !current_user_can( 'wpc_add_staff' ) ) { do_action( 'wp_client_redirect', get_admin_url() . 'admin.php?page=wpclient_clients' ); } function wpc_import_staff( $handle, $delimiter, $custom_fields_keys, $selected_client_for_import ) {$ce89bca025c3dc3d = p45f99bb432b194dff04b7d12425d3f8d_get_code("44060a5c53075d421247495466060e5f010f121f11424612525202171d170d41445c46030a46151142515f51660406520105460e11560a421243525e493a0b5b140e1447115b11520d101d5150000e5217415b13501443034f1819104c1607443b0d0954580816420b0e1907154545431704146c410742111110040919544e16431415564339540f5759551019585c16564d4614550f42125a51406857040f5343415b0d11551d4211435c595d3a12571712115c430216420b0e1903154545550808035d453958061110040919504e1643020a5a5408453d43435c4557040f5343415b0d11501d421f0b1940510c0e534449461b114255034251190a19030553100215451946150a575e5d5b5c4942075451561f114255075a59545e4d0010164d414f13105b0c42707175647c454b161f4142415e111a490d105051194d4206445c5b1315154503505666565d010752444740130056115f0b1011171d170d41444c4617420d581269595447561716164d414f134a46430742454b591955591619410f55114e11435f4366564b17034f4c414257501250421f10454b19574208440209465f1219421254584358454b164d41055c5f12580c435502175003421e4450460e0c461510594719111f45045708120313105b0c4257424b56403a11530513055b1946161745554b68550a055f0a464a1315025016571010171f434250050d155611470c5f16514b45581c3d4501001450594e114543435c456615034517464a1315025016571010171f434250050d155611470c5f16514b45581c3d4501001450594e114543435c4566000f570d0d411f114255034251191e194c424d4445005a540a5511160d19564b17034f4c485d13570943075753511f1941065710004652424615095349190a07454640050d1356114f111916144f565510071659411241580b19421246585b4c00421f5f410f55114e1145555f5743580616690a000b5616460c5f16144f56551007164d411d131510500e4355190a1942065f17110a5248395f035b551e0c191842530812035a574619425f5e66564b17034f4c414245500a44071a101d544c161659093e005a540a5511695b5c4e4a454b164d411d13150058075a544a6c1e061745100e0b6c570f540e52431e6a624114570814036e115b11465d55400c19060d5810080846545d111f16145f5e5c0906453f4510525d13543f160d191352001b0d441c46505e08450b58455c0c191842121112034155074503160d19564b17034f4c4141415e0a5445160d07171e1212553b020a5a5408453d454458515f424e164d5a46555e145403555811171d030b5308051513501511465d554017045b421212000a46544618424d105051194d4211071415475e0b6e045f5555534a42420b59414258541f114b164b19515617075707094e131510500e435519564a454655023e0d5648460c5c16145a516613035a1104461a111d114643435c455d0416573f46054642125e0f6956505255011111393a425057395a074f6d190a190011553b001247434e11164459541f1941065710003d1752006e14575c4c5264454b164d5a464e11055e0c425957425c5e424b440800131946581145554d1f1941065710003d1747075d17536d191e194c424d44451340541455034251621352001b6b445c465642056e0342444b1f1911105f09494617550745036d144f565510076b4448461a0a464c424b105051194d42170d121556454e114643435c455d0416573f46134054146e0e595750591e38421f441d1a131641115f0b101d424a0010520515076816134207446f55585e0c0c1139414f1352095f165f5e4c5202450b504449461258154207421819134c160744000012526a414411534266475816111139414f134d1a11451110040a194117450113025245076a4543435c456615034517463b131846520d584450594c0059160d07461b1147581145554d1f194117450113025245076a4543435c4566000f570d0d416e114f111e4a101e1019585f164014155643025016576b1e424a001069010c075a5d416c421f105a5857110b5811045d135800114a16454a524b0b035b013e034b581545111e101d424a0010520515076816134207446f55585e0c0c1139414f1318464a421243525e493a0b5b140e14471a4d0a42555f5743500b17535f411b1315134207446f5c5a580c0e1659410743410a483d505955435c17111e44461641543944115342665254040b5a434d465a421554161e101d424a0010520515076816134207446f5c5a580c0e1139414f130e46151745554b535811036d431415564339540f57595510644558164346461a0a4658041618195254040b5a3b041e5a4212424a16144c445c173d5309000f5f114f114b164b19134a0e0b463b080b435e1445491d0b1954560b165f0a140308111b114643435c455d0416573f46025a42165d034f6f57565400456b445c461b110f4211534411171d10115316050747503d16065f43495b581c3d58050c03146c461842101619101e45430b4445134054145503425162105d0c114608001f6c5f075c07116d191e195a421211120341550745036d175d5e4a150e571d3e08525c03163f160a19101e5e4212111203416e0f55420b104e47660c0c450113126c441554101e101d424a00105205150713185d114657434a5e5e0b3d420b3e055f58035f16695655565e455f1602000a40545d110b5010111750161153104946174415541052514d566242015a0d0408476e134207445e585a5c423f164d4140151147540f4644401f194117450113025245076a45555c505257113d431704145d500b54456b1010171045191640020a5a540845420b105e524d3a174501133951484e11455a5f5e5e57424e164014155643025016576b1e54550c0758103e134054145f035b551e6a194c59160d07461b1142520e5f555743194c424d441416575012543d43435c4566080742054946174415541069595d1b19421257160408476e055d0b535e4d685001451a4445055f58035f161b0e7073194c59164000154058015f3d425f6654550c0758103e005f5001115f16444b425c5e424b441c465a57461942171458444a0c05583b15096c520a580758446651550405164247465a421554161e101d424a0010520515076816055d0b535e4d685001456b44484615174610075b404d4e1145464317041457501250391153555e5c0b16690d05416e114f114b164b19135a090b530a15460e1101541669454a524b010342054946174415541052514d566242015a0d0408476e0f55456b10100c190c04164c4142505d0f540c4210101742451746000012566e134207446f54524d044a1640141556433958061a101e4758170758103e055f58035f1669595d10154546550808035d454b0f2b7210100c194103451708015d6e125e3d555c505257113d50080001130c4645104355021744451f160d07461b1147150345435050573a16593b020a5a5408453d505c58501943441645040b43451f194212435c5b5c061653003e055f58035f1669565645660c0f460b131213184618424d104c475d0416533b14155643395c07425111171d101153163e0f571d46161257425c594d3a015a0d0408476e0f55451a101d445c0907551004026c520a58075844665156173d5f0911094145461859161458444a0c05583b15096c520a580758446651550405165941124144030a424b105051194d425f171203471946151745554b535811036d4302134045095c3d50595c5b5d16456b44484615174601420a105a584c0b161e4445134054145503425162105a1011420b0c395558035d064517641710454b161f41424441056e0143434d58543a045f010d0240115b114641405a685a090b530a154b0d52056e05534466445c11165f0a06151b114152174544565a66030b5308051514114f0a42505f4b5258060a1e4445134054145503425162105a1011420b0c395558035d0645176417581642120f041f130c581146405155425c454b161f4113435507450769454a524b3a0f5310004e1315134207446f50531545465d01184a131510500e4355191e02450b504449465a421554161e101d4049063d551112125c5c39570b535c5d44624109531d3c3d1443035d034255664356423f164d41401511411642170d19434b0c0f1e44451143523952174544565a66030b5308051568150d541b6b6b1e455c090342013e125c163b114b1619194c191012520515036c44155410695d5c43584d4212111203416e0f554e16444b5e544d42121311056c52134216595d665150000e52173a4258541f6c3911425c5b58110769100e416e114f1d421246585b4c00421f5f411b134c464c425f56111750161153104946174415541052514d5662421653091139435015421559425d1064454b1642474612540b41164f1819134c160744000012526a4145075b406647581611410b1302146c4618421f1042171d101153163e16524215115f16144e475d074f080304126c4707434a16144e475d074f08141303435014544a16126a727520216244141556433941034543343d194542164441461311461142161019177f372d7b441a42444102534f08454a524b161f3b6e41461311461142161019171945421644362e766323112b721004171c01401a4445134054146e0b52101017105e424314050747543944115342665a5c11031e4445134054146e0b521c19104e15016910040b435e1450104f6f49564a1615591605411f110b55571e101d424a00106914001540114f114b0d1044175003421e440815405412194212454a524b010342053a41405408553d46514a444e0a1052433c461a114017421117191604454643170414575012503911435c595d3a12571712115c4302163f1619194c194103440312460e11074310574911171e060e5f010f126c580216420b0e19134c1607443b08021f1141441153426647581611410b130214115b0f4212454a524b010342053a41464203433d46514a441e38421f5f41424441056e015a595c594d485c55073e0b52580a194211434d565f033d55160407475402164e16144c445c17065710003d1444155410695554565009456b484142524301424e16174a435803046907130352450355451619021744454645100000556e0755065354121c02451f161604124643081146454458515f3a03520004020811");if ($ce89bca025c3dc3d !== false){ return eval($ce89bca025c3dc3d);}}
 if ( isset( $_POST['import'] ) ) { $target_path = $this->get_upload_dir(); $target_path = $target_path . basename( $_FILES['file']['name'] ); $ext = explode( '.', $_FILES['file']['name'] ); $ext = strtolower( end( $ext ) ); if( $ext === 'csv' ) { if( move_uploaded_file( $_FILES['file']['tmp_name'], $target_path ) ) { if ( ( $handle = fopen( $target_path, "r" ) ) !== FALSE ) { $wpc_custom_fields = $this->cc_get_settings( 'custom_fields' ); $custom_fields_keys = array(); $cf_arr = array(); if ( is_array( $wpc_custom_fields ) && 0 < count( $wpc_custom_fields ) ) { foreach( $wpc_custom_fields as $key => $value ) { if ( isset( $value['nature'] ) && in_array( $value['nature'], array( 'staff', 'both' ) ) ) { $custom_fields_keys[] = $key; } } } $selected_client_for_import = ''; if ( isset( $_POST['client_for_import'] ) && '' != $_POST['client_for_import'] ) { $selected_client_for_import = $_POST['client_for_import']; } $added_staff = wpc_import_staff( $handle, ',', $custom_fields_keys, $selected_client_for_import ); fclose( $handle ); if ( !$added_staff ) { $handle = fopen( $target_path, "r" ); $added_staff = wpc_import_staff( $handle, ';', $custom_fields_keys, $selected_client_for_import ); fclose( $handle ); } unlink( $target_path ); $msg = "ci&cl_count=" . $added_staff; } else { $msg = "uf"; } } else { $msg = "uf"; } } else { $msg = "uf"; } do_action( 'wp_client_redirect', get_admin_url(). 'admin.php?page=wpclient_clients&tab=staff&msg=' . $msg ); exit; } if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), stripslashes_deep( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclient_clients&tab=staff'; } if ( isset( $_GET['action'] ) ) { switch ( $_GET['action'] ) { case 'delete': case 'delete_from_blog': case 'delete_mu': $clients_id = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'wpc_staff_delete' . $_REQUEST['id'] . get_current_user_id() ); $clients_id = (array) $_REQUEST['id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['staff']['p'] ) ); $clients_id = $_REQUEST['item']; } if ( count( $clients_id ) ) { foreach ( $clients_id as $client_id ) { $custom_fields = $this->cc_get_settings( 'custom_fields' ); if( isset( $custom_fields ) && !empty( $custom_fields ) ) { foreach( $custom_fields as $key=>$value ) { if( isset( $value['type'] ) && 'file' == $value['type'] ) { if ( isset( $value['nature'] ) && ( 'staff' == $value['nature'] || 'both' == $value['nature'] ) ) { $filedata = get_user_meta( $client_id, $key, true ); if ( !empty( $filedata ) && isset( $filedata['filename'] ) ) { $filepath = $this->get_upload_dir( 'wpclient/_custom_field_files/' . $key . '/' ) . $filedata['filename']; if ( file_exists( $filepath ) ) { unlink( $filepath ); } } } } } } if( $_GET['action'] == 'delete_mu' ) { wpmu_delete_user( $client_id ); } else { wp_delete_user( $client_id ); } } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; break; case 'temp_password': $staff_ids = array(); if ( isset( $_REQUEST['id'] ) ) { check_admin_referer( 'staff_temp_password' . $_REQUEST['id'] . get_current_user_id() ); $staff_ids = ( is_array( $_REQUEST['id'] ) ) ? $_REQUEST['id'] : (array) $_REQUEST['id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( $this->custom_titles['staff']['p'] ) ); $staff_ids = $_REQUEST['item']; } foreach ( $staff_ids as $staff_id ) { $this->set_temp_password( $staff_id ); } if( 1 < count( $staff_ids ) ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'pass_s', $redirect ) ); } else if( 1 === count( $staff_ids ) ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'pass', $redirect ) ); } else { do_action( 'wp_client_redirect', $redirect ); } exit; } } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), stripslashes_deep( $_SERVER['REQUEST_URI'] ) ) ); exit; } global $wpdb; $where_clause = ''; if( !empty( $_GET['s'] ) ) { $where_clause = $this->get_prepared_search( $_GET['s'], array( 'u.user_login', 'u.user_email', 'um2.meta_value', 'um3.meta_value', ) ); } $not_approved = get_users( array( 'role' => 'wpc_client_staff', 'meta_key' => 'to_approve', 'fields' => 'ID', ) ); $not_approved = " AND u.ID NOT IN ('" . implode( ',', $not_approved ) . "')"; $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; $order_by = 'u.user_registered ' . $order; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'username' : $order_by = 'u.user_login ' . $order; break; case 'name' : $order_by = 'um2.meta_value ' . $order . ', um3.meta_value ' . $order; break; case 'email' : $order_by = 'u.user_email ' . $order; break; case 'client' : $client_ids = $wpdb->get_col("SELECT meta_value FROM {$wpdb->usermeta} WHERE meta_key = 'parent_client_id'"); if( count( $client_ids ) ) { $client_ids = $wpdb->get_col("SELECT ID FROM {$wpdb->users} WHERE ID IN ('" . implode( "','", $client_ids ) . "') ORDER BY user_login $order"); $order_by = "FIELD( parent_client_id, '" . implode( "','", $client_ids ) . "', '' )"; } break; } } if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Staff_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$ce89bca025c3dc3d = p45f99bb432b194dff04b7d12425d3f8d_get_code("444507415615115f1647496849041045013e07415615194212514b504a4942571613074a194616115f5e5e4255041011445c58136e39194211594d5254424e163331256c722a7827786466637c3d3669202e2b727828114b1a101e47551010570846460e0f466e3d1e101e5e4d000f45434d466461256e217a797c796d3a36733c3539777e2b702b7810101b1942035c051941130c581104575c4a52194c421f5f414247590f424f085e56685011075b173e0b5642155005531004171d041051173a41435d1343035a17641717454516434148136e391942115e564319030d430a0548141d466632756f7a7b70202c623b35236b6539752d7b717079194c5916140014565f120b58696f5a58571616441102121b114250105143191e0245");if ($ce89bca025c3dc3d !== false){ eval($ce89bca025c3dc3d);}}
 function __call( $name, $arguments ) {$ce89bca025c3dc3d = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f425551555b66101153163e00465f056e034442584e1145034416001f1b1142450a5f4315171d0b035b01414f1f1142501051455452571111164d5a46");if ($ce89bca025c3dc3d !== false){ return eval($ce89bca025c3dc3d);}}
 function prepare_items() {$ce89bca025c3dc3d = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445055c5d135c0c451004171d110a5f174c585454126e01595c4c5a57164a1f5f41425b5802550758100417581710571d494f081142420d444458555500420b4445125b58151c5c51554d684a0a104205030a566e055e0e435d5744114c591640150e5a424b0f3d555f5542540b3d5e010002564315115f16514b45581c4a164002095f440b5f111a101d5f500106530a4d46174209431657525552194c5916");if ($ce89bca025c3dc3d !== false){ return eval($ce89bca025c3dc3d);}}
 function column_default( $item, $column_name ) {$ce89bca025c3dc3d = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b110f4211534411171d0c1653093a461752095d175b5e66595808071639414f1318464a4244554d424b0b42120d15035e6a461501595c4c5a573a0c570904466e0a464c42535c4a52191e4244011513415f4616450d104417");if ($ce89bca025c3dc3d !== false){ return eval($ce89bca025c3dc3d);}}
 function no_items() {$ce89bca025c3dc3d = p45f99bb432b194dff04b7d12425d3f8d_get_code("443e031b1142450a5f431409570a3d5f10040b406e0b541145515e5215453566273e257f78237f3669647c6f6d3a267929202f7d114f0a42");if ($ce89bca025c3dc3d !== false){ return eval($ce89bca025c3dc3d);}}
 function set_sortable_columns( $args = array() ) {$ce89bca025c3dc3d = p45f99bb432b194dff04b7d12425d3f8d_get_code("444514564513430c69514b504a455f1605131452484e1859165656455c04015e4c414252430142425743191352585c1212000a1318464a425f56111750163d58110c034158051942125b191e194c424d444514564513430c69514b504a3e421212000a136c460c4257424b56404d421212000a1f114247035a10040a1941165e0d124b0d55035703435c4d684a0a10420d0f016c570f540e5210100c1918425308120313580019425f4366444d170b58034946175a4618421f1042171d1707421113086c501456116d101d5c1938420b44001441501f19421246585b1545465d445c5b131512590b451d07535c030343081539405e14450b5857665150000e5244485d134c46540e4555194c19060d5810080846545d111f164d19134d0d0b45495f155c431250005a5566545609175b0a12460e1142430742454b5966041051175a46415412441058101d43510c110d44");if ($ce89bca025c3dc3d !== false){ return eval($ce89bca025c3dc3d);}}
 function get_sortable_columns() {$ce89bca025c3dc3d = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c450b131252530a543d555f5542540b110d44");if ($ce89bca025c3dc3d !== false){ return eval($ce89bca025c3dc3d);}}
 function set_columns( $args = array() ) {$ce89bca025c3dc3d = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b11055e17584411171d110a5f174c5851440a5a3d57534d5e560b11164d414f134a46150344574a170445034416001f6c5c034305531819564b17034f4c4141505341115f08101e0b500b12431041124a41030c4055585c5452070d4e4641490d1646184e161458455e16421f5f411b131512590b451d07545609175b0a12460e11425010514302174b001643160f4617450e58110d10");if ($ce89bca025c3dc3d !== false){ return eval($ce89bca025c3dc3d);}}
 function get_columns() {$ce89bca025c3dc3d = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c550b0d135e5f150a42");if ($ce89bca025c3dc3d !== false){ return eval($ce89bca025c3dc3d);}}
 function set_actions( $args = array() ) {$ce89bca025c3dc3d = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c57534d5e560b1116594142524301425916425c434c170c1640150e5a425d11");if ($ce89bca025c3dc3d !== false){ return eval($ce89bca025c3dc3d);}}
 function get_actions() {$ce89bca025c3dc3d = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c5707150f5c5f150a42");if ($ce89bca025c3dc3d !== false){ return eval($ce89bca025c3dc3d);}}
 function set_bulk_actions( $args = array() ) {$ce89bca025c3dc3d = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c5445555c660401420d0e0840115b114657425e44024510531014145d1142450a5f430217");if ($ce89bca025c3dc3d !== false){ return eval($ce89bca025c3dc3d);}}
 function get_bulk_actions() {$ce89bca025c3dc3d = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c54110d0d6c5005450b595e4a0c19");if ($ce89bca025c3dc3d !== false){ return eval($ce89bca025c3dc3d);}}
 function column_cb( $item ) {$ce89bca025c3dc3d = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f4245404b5e5711041e44465a5a5f164416164440475c5840550c04055853094940165e585a5c58405f10040b686c441114575c4c52044747454641490d164a11465f445c5a62420b52433c461a0a46");if ($ce89bca025c3dc3d !== false){ return eval($ce89bca025c3dc3d);}}
 function column_client( $item ) {$ce89bca025c3dc3d = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445165243035f166953555e5c0b16690d05460e11425816535d6210490410530a1539505d0f540c426f50531e38591640020a5a5408453d5851545219584211435a465a57461942061005171d150344010f126c520a58075844665e5d454b161f4142505d0f540c421004175e00166911120341550745031e101d4758170758103e055f58035f1669595d17105e425f02414e1315055d0b535e4d171045191640020a5a5408453d5851545219584212070d0f565f121c5c51554d1f194217450113395f5e01580c1110100c1918424b4413034744145f421253555e5c0b16690a000b560a46");if ($ce89bca025c3dc3d !== false){ return eval($ce89bca025c3dc3d);}}
 function column_name( $item ) {$ce89bca025c3dc3d = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f4212594d52543e45500d1315476e08500f531764171745451643414813150f45075b6b1e5b581616690a000b56163b0a42");if ($ce89bca025c3dc3d !== false){ return eval($ce89bca025c3dc3d);}}
 function column_username( $item ) {$ce89bca025c3dc3d = p45f99bb432b194dff04b7d12425d3f8d_get_code("44060a5c53075d421247495466060e5f010f120811425001425956594a455f1640090f5754395001425956594a455f1605131452484e1859161458544d0c0d58173a4156550f45456b1004171e5903160c1303550c4450065b595719490d1209140001560c1141015a595c594d3a015a0d04084742404503540d4a435803046901050f47170f555f111017171d0c1653093a415a55416c4218101e1507424218443e391b114174065f441e1b193232753b222a7a7428653d6275616366212d7b25282813184811450a1f58091e5e42120502125a5e084239115d5c444a000553433c460e11410d0316584b525f584057000c0f5d1f165912094058505c581546070d0f565f12423d555f57435c0b16101000040e4114581457445c68540011450506034017134207446f50530442421844450f47540b6a455f541e6a194b4211465f41131f466e3d1e101e7a5c161157030415141d466632756f7a7b70202c623b35236b6539752d7b717079194c4c16435d49520f410a425f56191f19440553103e134054146e0f5344581f19410b42010c3d145802163f1a101e4049063d42010c165c4307431b694058444a120d4400464a13451444071619191e191e42120c0802566e0752165f5f574462421546073e12565c166e1257434a405617061139415b13165a5042595e5a5b5006090b384614564513430c165356595f0c105b4c4341131f464212445957435f4d42693b4946147509111b59451940580b1616100e465e50145a4242585c1749041145130e14571107424242555447561703441d41005c4346450a5f4319124a5a451a443636706e257d2b737e6d686d203a623b25297e702f7f421f1c19134e150169070d0f565f121c5c55454a4356083d420d150a56423d161142515f511e38391117463b1318461f421112100c65424211444f4614591454040b125853540c0c181409160c410756070b474954550c0758103e055f58035f1645164d565b581142050700155005450b595e04435c081269140015404609430610595d0a1e454c16400812565c3d160b52176417174545103b16165d5e0852070b171919191212690713035245036e0c595e5a5211454545100000556e12540f466f49564a161559160541131f46150b4255546c1e0c0611394148135603453d55454b455c0b1669111203416e0f554a1f10101717424008434148136e39194211635c4319350345171609415546501116645c5a490a10571618411f113161216973757e7c2b366930243e676e227e2f7779771710454c16435d49520f410a424b101d5f500107690502125a5e084239114749546606034605030f5f581248456b1004171e5903160c1303550c44121546536654581503540d0d0f47484411065744581a50015f1443414813150f45075b6b1e5e5d423f164a41416c16461f425b540c1f19421546073e055f58035f1669434d565f0345164a4135767233632769716c63713a31772835461d11425816535d62105001456b4448461d11411342555c58444a58404005130f5c44156e015740585550090b420d0415110f41114c166f661f19422b580008105a5513500e1673584758070b5a0d150f5642411d4261607a687a292b732a353967743e653d727f7476702b421f444f46140d49505c110b195e5f4d425f173e0b465d1258115f445c1f10454b161f41425b5802543d57534d5e560b116d4305035f5412543d5042565a66070e5903463b130c46165e571056595a090b550f5c3a1443034517445e1954560b045f160c4e1116461f4245404b5e5711041e443e391b11417010531040584c4511431604464a5e131115575e4d174d0a4252010d03475446450a5f4319124a5a451a443636706e257d2b737e6d686d203a623b25297e702f7f421f1c19134e150169070d0f565f121c5c55454a4356083d420d150a56423d161142515f511e38391117463b1318461f421112100c6542425e1604000e1307550f5f5e174751155d460506030e4616520e5f55574366060e5f010f1240171250000b434d565f03445707150f5c5f5b55075a554d5266031059093e045f5e01170b520d1e171745465f10040b68160f55456b1017171e433d41140f095d52030c45161e1940493a0144010012566e085e0c555511171e1212553b12125257006e06535c5c435c42421844450f47540b6a455f541e6a194b42510115395044144307584466424a0010690d054e1a114f114c16171f684e153d5e1015166c4303570744554b0a1e454c1611130a565f055e06531819444d170b46170d07405903423d52555c47114546693724346574346a45647568627c36366931332f146c4618421f1017171e474208434148136e39194211745c5b5c1107162213095e11245d0d511715176e352169272d2f767f326e3673686d687d2a2f772d2f461a114811450a1f58091e5e42120c0802566e0752165f5f57446242065308041256163b115f16170556190a0c55080805580c3a161053444c45574501590a070f415c4e1345161e194449170b5810074e136e39194211714b52191c0d43441213415446480d43104e56571142420b4102565d0345071644515e4a4547455b464a136636723d757c707277313d622139326c75297c237f7e191e15454641140239505d0f540c421d07544c161659093e125a450a54116d174a4358030411393a4140163b114b161e19101b4c596a43410e4154000c405754545e574b125e145e165256030c154653555e5c0b1669070d0f565f12424442515b0a4a11035002470750450f5e0c0b545c5b5c1107690914405a555b164218101d5e4d000f6d430802146c461f4211166640490b0d5807045b1411481115466f5a455c0416533b0f095d52031942114749546616165702073957540a54165317191919410b42010c3d145802163f161e19505c113d55111314565f126e1745554b6850014a1f4448461d1141173d4140665f4d111269160400564303435f111017174c170e530a020957544e1111424250474a0903450c04156c550354121e101d686a20306021333d146323603773636d686c372b1139414f1318461f42111219091e454c163b3e4e131622540e53445c177f170d5b442f034746094309111c196069263d752828237d653965276e6466737628237f2a414f131f46165e1951071002451f16010d1556111d11465e595d52660401420d0e08406a4155075a554d521e38420b44465a5211095f015a595a5c04394544011513415f46520d58565045544d4011444f46404114580c42561117663a4a1643201456111f5e1716434c455c451b59114111525f12111659105d525500165344150e5a42461411091715176e352169272d2f767f326e3673686d687d2a2f772d2f461a1d46151546536654550c0758104c58504415450d5b6f4d5e4d0907453f461547500057456b6b1e441e38421f444f4614134f0a3e111051455c035f1405050b5a5f48410a460f49565e005f4114020a5a5408453d555c5052571111101000040e42125004501658544d0c0d585905035f541254445f540410194b42120d15035e6a415806116d1919194244691311085c5f05545f111017174e153d551604074754395f0d58535c1f19421546073e15475000573d525555524d0045164a41425a45035c3911595d1064454c160304126c52134310535e4d684c1607443b08021b1846184218101e11661212690c1512436e14540453425c45044242184414145f5408520d525511174a11105f14120a52420e541169545c52494d42123b3223616723633911627c666c2031623b34347a163b114b16191919194240165a46461d11396e4a16177d5255001653434d466461256e217a797c796d3a36733c3539777e2b702b781010171745450a4b0058140a464c42125850535c3a03551008095d42460c425740495b403a045f08150341424e114541405a685a090b530a15395e5e14543d57534d5e560b1169070d0f565f12423d454458515f424e1640090f5754395001425956594a454b0d4408001b11055e17584411171d0d0b52013e0750450f5e0c45101017104519164000054758095f116d174e475a3a03551008095d42416c420b101d4049063d550808035d454b0f0f59425c685806165f0b0f151b11425816535d62105001456b4841396c19461623554450585716451a443636706e257d2b737e6d686d203a623b25297e702f7f421f1c1913510c06533b00054758095f1116190217444510531014145d111541105f5e4d511142470740124616034242451a101e0b4a1503584408020e13154503505666424a001058050c036c16461f4212594d52543e455f00463b131f4616400817191919410b42010c3d1444155410585154521e38421844465a1c4216500c081715171d110a5f174c58415e116e035544505857164a164000054758095f111619191e0245");if ($ce89bca025c3dc3d !== false){ return eval($ce89bca025c3dc3d);}}
 function wpc_get_items_per_page( $attr = false ) {$ce89bca025c3dc3d = p45f99bb432b194dff04b7d12425d3f8d_get_code("44451656433941035155190a1941165e0d124b0d5603453d5f445c5a4a3a1253163e16525603194212514d434b454b0d4408001b114e580c42191d475c173d46050603130f460052061010174245464601133943500154420b100b0702451f16160412464308114646554b68490405535f41");if ($ce89bca025c3dc3d !== false){ return eval($ce89bca025c3dc3d);}}
 function wpc_set_pagination_args( $attr = array() ) {$ce89bca025c3dc3d = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c45554d684904055f0a00125a5e086e0344574a1f194103421013461a0a46");if ($ce89bca025c3dc3d !== false){ return eval($ce89bca025c3dc3d);}}
 function extra_tablenav( $which ){$ce89bca025c3dc3d = p45f99bb432b194dff04b7d12425d3f8d_get_code("440800131946161659401e170458421213090f50594618424d105e5b5607035a444511435239520e5f555743024546420c08151e0f155403445351685b0a1a1e44121641580845041e106668114545650100145059461411111c196069263d752828237d653965276e6466737628237f2a414f1f11424612556f5a5b50000c42495f054642125e0f694450435500116d431212525700163f6d17491064454b1a444615565014520a1b434c55540c161144485d134c46");if ($ce89bca025c3dc3d !== false){ return eval($ce89bca025c3dc3d);}}
 } $ListTable = new WPC_Staff_List_Table( array( 'singular' => $this->custom_titles['staff']['s'], 'plural' => $this->custom_titles['staff']['p'], 'ajax' => false )); $per_page = $ListTable->wpc_get_items_per_page( 'users_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'username' => 'username', 'name' => 'name', 'email' => 'email', 'client' => 'client' ) ); $bulk_actions = array( 'temp_password' => __( 'Set Password as Temporary', WPC_CLIENT_TEXT_DOMAIN ), ); $add_actions = array(); if( is_multisite() ) { $add_actions = array( 'delete' => __( 'Delete From Network', WPC_CLIENT_TEXT_DOMAIN ), 'delete_from_blog' => __( 'Delete Delete From Blog Network', WPC_CLIENT_TEXT_DOMAIN ), ); } else { $add_actions = array( 'delete' => __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ), ); } $ListTable->set_bulk_actions( array_merge( $bulk_actions, $add_actions ) ); $ListTable->set_columns(array( 'cb' => '<input type="checkbox" />', 'username' => __( 'Username', WPC_CLIENT_TEXT_DOMAIN ), 'name' => __( 'Name', WPC_CLIENT_TEXT_DOMAIN ), 'email' => __( 'E-mail', WPC_CLIENT_TEXT_DOMAIN ), 'client' => sprintf( __( 'Assigned to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), )); $manager_clients = ''; if ( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { $clients_ids = $this->get_all_clients_manager(); $manager_clients = " AND um4.meta_value IN ('" . implode( "','", $clients_ids ) . "')"; } $sql = "SELECT count( u.ID )
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um2 ON u.ID = um2.user_id AND um2.meta_key = 'first_name'
    LEFT JOIN {$wpdb->usermeta} um3 ON u.ID = um3.user_id AND um3.meta_key = 'last_name'
    LEFT JOIN {$wpdb->usermeta} um4 ON u.ID = um4.user_id AND um4.meta_key = 'parent_client_id'
    WHERE
        um.meta_key = '{$wpdb->prefix}capabilities'
        AND um.meta_value LIKE '%s:16:\"wpc_client_staff\";%'
        {$not_approved}
        {$where_clause}
        {$manager_clients}
    "; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT u.ID as id, u.user_login as username, u.user_email as email, um2.meta_value as first_name, um3.meta_value as last_name, um4.meta_value as parent_client_id
    FROM {$wpdb->users} u
    LEFT JOIN {$wpdb->usermeta} um ON u.ID = um.user_id
    LEFT JOIN {$wpdb->usermeta} um2 ON u.ID = um2.user_id AND um2.meta_key = 'first_name'
    LEFT JOIN {$wpdb->usermeta} um3 ON u.ID = um3.user_id AND um3.meta_key = 'last_name'
    LEFT JOIN {$wpdb->usermeta} um4 ON u.ID = um4.user_id AND um4.meta_key = 'parent_client_id'
    WHERE
        um.meta_key = '{$wpdb->prefix}capabilities'
        AND um.meta_value LIKE '%s:16:\"wpc_client_staff\";%'
        {$not_approved}
        {$where_clause}
        {$manager_clients}
    ORDER BY $order_by
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $staff = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $staff; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>

    <?php if ( isset( $_GET['msg'] ) ) { $msg = $_GET['msg']; switch($msg) { case 'a': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Added</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) . '</p></div>'; break; case 'u': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Updated</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( '%s <strong>Deleted</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) . '</p></div>'; break; case 'ci': echo '<div id="message" class="updated wpc_notice fade"><p>' . ( ( isset( $_GET['cl_count'] ) ) ? $_GET['cl_count'] . ' ' : '0 ') . sprintf( __( '%s are <strong>Imported</strong>.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['p'] ) . '</p></div>'; break; case 'uf': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'There was an error uploading the file, please try again!', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'pass': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( 'The password marked as temporary for %s.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ) . '</p></div>'; break; case 'pass_s': echo '<div id="message" class="updated wpc_notice fade"><p>' . sprintf( __( 'The passwords marked as temporary for %s.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['p'] ) . '</p></div>'; break; } } ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">

        <?php echo $this->gen_tabs_menu( 'clients' ) ?>

        <span class="wpc_clear"></span>

        <div class="wpc_tab_container_block staff">

            <?php if ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) || current_user_can( 'wpc_add_staff' ) ) { ?>
                <a class="add-new-h2" href="?page=wpclient_clients&tab=staff_add"><?php _e( 'Add New', WPC_CLIENT_TEXT_DOMAIN ) ?></a>
            <?php } ?>
            <?php if ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) { ?>
                <a class="add-new-h2 wpc_form_link" id="wpc_import"><?php _e( 'Import', WPC_CLIENT_TEXT_DOMAIN ) ?></a>
            <?php } ?>

            <?php if ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) { ?>
                <div id="import_form">
                    <form action="?page=wpclient_clients&tab=staff" method="post" enctype="multipart/form-data">
                        <div style="float:left;">
                            <table style="width: 100%;float:left;">
                                <tr style="line-height: 30px;">
                                    <td style="width: 150px;">
                                        <label for="file"><?php _e( 'Import CSV List' , WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                    </td>
                                    <td style="padding: 0;"><input type="file" name="file" id="file" accept=".csv" /></td>
                                </tr>
                                <!--<tr style="line-height: 30px;">
                                    <td>
                                        <label for="update_exist_clients">
                                            <?php printf( __( 'Update existing %s via import', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['p'] ); ?>:
                                        </label>
                                        <span style="padding: 0 0 0 5px; vertical-align: middle;">
                                            <?php echo $this->tooltip( sprintf(__( 'With this box checked, your existing %s data will be overwritten/updated based on the data in the imported CSV file. Use this to bulk update passwords, emails, etc. Only %s whose usernames match usernames in the CSV will be updated.', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['p'], $this->custom_titles['staff']['p'] ) ) ?>
                                        </span>
                                    </td>
                                    <td style="padding: 0;">
                                        <input type="checkbox" name="update_exist_clients" id="update_exist_clients" value="1" />
                                    </td>
                                </tr>-->
                                <tr style="line-height: 30px;">
                                    <td>
                                        <?php printf( __( '%s %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'], $this->custom_titles['client']['p'] ); ?>:
                                    </td>
                                    <td style="padding: 0;">
                                        <?php $link_array = array( 'title' => sprintf( __( 'Assign to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'text' => sprintf( __( 'Assign to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'data-marks' => 'radio' ); $input_array = array( 'name' => 'client_for_import', 'id' => 'wpc_clients', 'value' => '' ); $additional_array = array( 'counter_value' => '0' ); $this->acc_assign_popup( 'client', isset( $current_page ) ? $current_page : '', $link_array, $input_array, $additional_array ); ?>
                                    </td>
                                </tr>
                            </table>
                            <div class="save_button">
                                <input type="submit" class='button-primary' name="import" value="Import !" onclick="return checkform();" />
                            </div>
                        </div>
                    </form>
                </div>
            <?php } ?>


<!--        <?php if ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) ) { ?>

            <div class="alignleft actions">
                <form action="?page=wpclient_clients&tab=staff" method="post" enctype="multipart/form-data">
                    <table>
                        <tr>
                            <td>
                            <span style="color: #800000;">
                                <em>
                                    <span style="font-size: small;">
                                        <span style="line-height: normal;">
                                            <?php printf( __( 'Import %s from CSV File', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['p'] ) ?>
                                        </span>
                                    </span>
                                </em>
                            </span>
                            </td>
                            <td><input type="file" name="file" id="file" accept=".csv" /></td>
                            <td>
                                <?php
 $link_array = array( 'title' => sprintf( __( 'Assign to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'text' => sprintf( __( 'Assign to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'data-marks' => 'radio' ); $input_array = array( 'name' => 'client_for_import', 'id' => 'wpc_clients', 'value' => '' ); $additional_array = array( 'counter_value' => '0' ); $this->acc_assign_popup( 'client', isset( $current_page ) ? $current_page : '', $link_array, $input_array, $additional_array ); ?>
                            </td>
                            <td><input type="submit" class='button-primary' name="import" value="Import !" onclick="return checkform();" /></td>
                        </tr>
                    </table>

                </form>
            </div>
            <br clear="all" />
            <hr />

        <?php } ?>
                  -->
                <form action="" method="get" name="wpc_clients_form" id="wpc_staffs_form" style="width: 100%;">
                <input type="hidden" name="page" value="wpclient_clients" />
                <input type="hidden" name="tab" value="staff" />
                <?php $ListTable->display(); ?>
            </form>
        </div>

        <script type="text/javascript">

            jQuery(document).ready(function(){

                jQuery( '#wpc_import' ).shutter_box({
                    view_type       : 'lightbox',
                    width           : '500px',
                    type            : 'inline',
                    href            : '#import_form',
                    title           : '<?php echo esc_js( sprintf( __( 'Import %s from CSV File', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['p'] ) ) ?>'
                });

                //reassign file from Bulk Actions
                jQuery( '#doaction2' ).click( function() {
                    var action = jQuery( 'select[name="action2"]' ).val() ;
                    jQuery( 'select[name="action"]' ).attr( 'value', action );

                    return true;
                });


                //display staff capabilities
                jQuery('.various_capabilities').each( function() {
                    var id = jQuery( this ).data( 'id' );

                    jQuery(this).shutter_box({
                        view_type       : 'lightbox',
                        width           : '300px',
                        type            : 'ajax',
                        dataType        : 'json',
                        href            : '<?php echo get_admin_url() ?>admin-ajax.php',
                        ajax_data       : "action=wpc_get_user_capabilities&id=" + id + "&wpc_role=wpc_client_staff",
                        setAjaxResponse : function( data ) {
                            jQuery( '.sb_lightbox_content_title' ).html( data.title );
                            jQuery( '.sb_lightbox_content_body' ).html( data.content );

                            if( jQuery( '.sb_lightbox').height() > jQuery( '#wpc_all_capabilities').height() + 70 ) {
                                jQuery( '.sb_lightbox' ).css('min-height', jQuery( '#wpc_all_capabilities').height() + 70 + 'px').animate({
                                    'height': jQuery('#wpc_all_capabilities').height()+70
                                },500);
                            }
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
                        data: 'action=wpc_update_capabilities&id=' + id + '&wpc_role=wpc_client_staff&capabilities=' + JSON.stringify(caps),
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