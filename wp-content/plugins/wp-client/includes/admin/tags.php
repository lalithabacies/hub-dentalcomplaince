<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } global $wpdb; if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), stripslashes_deep( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclients_content&tab=tags'; } if( !empty( $_POST['wpc_action'] ) ) { switch( $_POST['wpc_action'] ) { case 'reassign_tag': if ( empty( $_POST['old_tag_id'] ) || empty( $_POST['new_tag_id'] ) || $_POST['old_tag_id'] === $_POST['new_tag_id'] ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'n_rat', $redirect ) ); exit; } $file_ids = $wpdb->get_col("SELECT DISTINCT object_id
                FROM {$wpdb->term_relationships}
                WHERE term_taxonomy_id = '" . $wpdb->_real_escape( $_POST['old_tag_id'] ) . "' AND object_id NOT IN (
                    SELECT DISTINCT object_id
                    FROM {$wpdb->term_relationships}
                    WHERE term_taxonomy_id = '" . $wpdb->_real_escape( $_POST['new_tag_id'] ) . "'
                )"); $wpdb->delete( $wpdb->term_relationships, array( 'term_taxonomy_id' => $_POST['old_tag_id'] ) ); foreach( $file_ids as $val ) { $wpdb->insert( $wpdb->term_relationships, array( 'term_taxonomy_id' => $_POST['new_tag_id'], 'object_id' => $val ) ); } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'rat', $redirect ) ); break; case 'create_file_tag': $term = $_POST['tag_name_new']; if ( !strlen( trim( $term ) ) ) do_action( 'wp_client_redirect', add_query_arg( 'msg', 'wt', $redirect ) ); if ( !$term_info = term_exists($term, 'wpc_tags') ) $term_info = wp_insert_term($term, 'wpc_tags'); else do_action( 'wp_client_redirect', add_query_arg( 'msg', 'aet', $redirect ) ); do_action( 'wp_client_redirect', add_query_arg( 'msg', 'st', $redirect ) ); break; } } if ( isset( $_GET['action'] ) ) { switch ( $_GET['action'] ) { case 'delete': $ids = array(); if ( isset( $_GET['tag_id'] ) ) { check_admin_referer( 'wpc_file_tag_delete' . $_GET['tag_id'] . get_current_user_id() ); $ids = (array) $_GET['tag_id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( __( 'Tags', WPC_CLIENT_TEXT_DOMAIN ) ) ); $ids = $_REQUEST['item']; } if ( count( $ids ) && ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) || current_user_can( 'wpc_delete_file_tags' ) ) ) { foreach ( $ids as $tag_id ) { wp_delete_term( $tag_id, 'wpc_tags' ); } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; } } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), stripslashes_deep( $_SERVER['REQUEST_URI'] ) ) ); exit; } $where_search = ''; $where_manager = ''; if( !empty( $_GET['s'] ) ) { $where_search = $this->get_prepared_search( $_GET['s'], array( 't.name', ) ); } $order_by = 'tt.term_id'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'name' : $order_by = 't.name'; break; case 'count' : $order_by = 'count'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if ( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { $manager_clients = $this->cc_get_assign_data_by_object( 'manager', get_current_user_id(), 'client' ); $manager_circles = $this->cc_get_assign_data_by_object( 'manager', get_current_user_id(), 'circle' ); $client_files = $this->cc_get_assign_data_by_assign( 'file', 'client', $manager_clients ); $circle_files = $this->cc_get_assign_data_by_assign( 'file', 'circle', $manager_circles ); $files = array_merge( $client_files, $circle_files ); $files = array_unique( $files ); if ( current_user_can( 'wpc_view_admin_managers_files' ) ) { $ids_files_manager = $wpdb->get_col( "SELECT id FROM {$wpdb->prefix}wpc_client_files WHERE page_id = 0 OR id IN('" . implode( "','", $files ) . "')" ) ; } else { $ids_files_manager = $wpdb->get_col( "SELECT id FROM {$wpdb->prefix}wpc_client_files WHERE user_id = " . get_current_user_id() . " OR id IN('" . implode( "','", $files ) . "')" ); } $where_manager = " AND tr.object_id IN('" . implode( "','", $ids_files_manager ) . "')" ; } if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Tags_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $columns = array(); var $bulk_actions = array(); function __construct( $args = array() ){$c43d11de730a2286 = p45f99bb432b194dff04b7d12425d3f8d_get_code("444507415615115f1647496849041045013e07415615194212514b504a4942571613074a194616115f5e5e4255041011445c58136e39194211594d5254424e163331256c722a7827786466637c3d3669202e2b727828114b1a101e47551010570846460e0f466e3d1e101e5e4d000f45434d466461256e217a797c796d3a36733c3539777e2b702b7810101b1942035c051941130c581104575c4a52194c421f5f414247590f424f085e56685011075b173e0b5642155005531004171d041051173a41435d1343035a17641717454516434148136e391942115e564319030d430a0548141d466632756f7a7b70202c623b35236b6539752d7b717079194c5916140014565f120b58696f5a58571616441102121b114250105143191e0245");if ($c43d11de730a2286 !== false){ eval($c43d11de730a2286);}}
 function __call( $name, $arguments ) {$c43d11de730a2286 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f425551555b66101153163e00465f056e034442584e1145034416001f1b1142450a5f4315171d0b035b01414f1f1142501051455452571111164d5a46");if ($c43d11de730a2286 !== false){ return eval($c43d11de730a2286);}}
 function prepare_items() {$c43d11de730a2286 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445055c5d135c0c451004171d110a5f174c585454126e01595c4c5a57164a1f5f41425b5802550758100417581710571d494f081142420d444458555500420b4445125b58151c5c51554d684a0a104205030a566e055e0e435d5744114c591640150e5a424b0f3d555f5542540b3d5e010002564315115f16514b45581c4a164002095f440b5f111a101d5f500106530a4d46174209431657525552194c5916");if ($c43d11de730a2286 !== false){ return eval($c43d11de730a2286);}}
 function column_default( $item, $column_name ) {$c43d11de730a2286 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b110f4211534411171d0c1653093a461752095d175b5e66595808071639414f1318464a4244554d424b0b42120d15035e6a461501595c4c5a573a0c570904466e0a464c42535c4a52191e4244011513415f4616450d104417");if ($c43d11de730a2286 !== false){ return eval($c43d11de730a2286);}}
 function no_items() {$c43d11de730a2286 = p45f99bb432b194dff04b7d12425d3f8d_get_code("443e031b1142450a5f431409570a3d5f10040b406e0b541145515e5215453566273e257f78237f3669647c6f6d3a267929202f7d114f0a42");if ($c43d11de730a2286 !== false){ return eval($c43d11de730a2286);}}
 function set_sortable_columns( $args = array() ) {$c43d11de730a2286 = p45f99bb432b194dff04b7d12425d3f8d_get_code("444514564513430c69514b504a455f1605131452484e1859165656455c04015e4c414252430142425743191352585c1212000a1318464a425f56111750163d58110c034158051942125b191e194c424d444514564513430c69514b504a3e421212000a136c460c4257424b56404d421212000a1f114247035a10040a1941165e0d124b0d55035703435c4d684a0a10420d0f016c570f540e5210100c1918425308120313580019425f4366444d170b58034946175a4618421f1042171d1707421113086c501456116d101d5c1938420b44001441501f19421246585b1545465d445c5b131512590b451d07535c030343081539405e14450b5857665150000e5244485d134c46540e4555194c19060d5810080846545d111f164d19134d0d0b45495f155c431250005a5566545609175b0a12460e1142430742454b5966041051175a46415412441058101d43510c110d44");if ($c43d11de730a2286 !== false){ return eval($c43d11de730a2286);}}
 function get_sortable_columns() {$c43d11de730a2286 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c450b131252530a543d555f5542540b110d44");if ($c43d11de730a2286 !== false){ return eval($c43d11de730a2286);}}
 function set_columns( $args = array() ) {$c43d11de730a2286 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b11055e17584411171d110a5f174c5851440a5a3d57534d5e560b11164d414f134a46150344574a170445034416001f6c5c034305531819564b17034f4c4141505341115f08101e0b500b12431041124a41030c4055585c5452070d4e4641490d1646184e161458455e16421f5f411b131512590b451d07545609175b0a12460e11425010514302174b001643160f4617450e58110d10");if ($c43d11de730a2286 !== false){ return eval($c43d11de730a2286);}}
 function get_columns() {$c43d11de730a2286 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c550b0d135e5f150a42");if ($c43d11de730a2286 !== false){ return eval($c43d11de730a2286);}}
 function set_actions( $args = array() ) {$c43d11de730a2286 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c57534d5e560b1116594142524301425916425c434c170c1640150e5a425d11");if ($c43d11de730a2286 !== false){ return eval($c43d11de730a2286);}}
 function get_actions() {$c43d11de730a2286 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c5707150f5c5f150a42");if ($c43d11de730a2286 !== false){ return eval($c43d11de730a2286);}}
 function set_bulk_actions( $args = array() ) {$c43d11de730a2286 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c5445555c660401420d0e0840115b114657425e44024510531014145d1142450a5f430217");if ($c43d11de730a2286 !== false){ return eval($c43d11de730a2286);}}
 function get_bulk_actions() {$c43d11de730a2286 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c54110d0d6c5005450b595e4a0c19");if ($c43d11de730a2286 !== false){ return eval($c43d11de730a2286);}}
 function column_cb( $item ) {$c43d11de730a2286 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f4245404b5e5711041e44465a5a5f164416164440475c5840550c04055853094940165e585a5c58405f10040b686c441114575c4c52044747524641490d164a11465f445c5a62420b52433c461a0a46");if ($c43d11de730a2286 !== false){ return eval($c43d11de730a2286);}}
 function column_name( $item ) {$c43d11de730a2286 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44450750450f5e0c45100417581710571d494f08110f574a161450435c083911070e135d45416c4208100917104519164000054758095f116d174f5e5c12456b445c46140d0711015a514a4404471457160809464244111657425e524d584069060d075d5a44110a44555f0a1b04065b0d0f484359160e1257575c0a4e15015a0d0408474239520d58445c594d431657035c41131f46150b4255546c1e0c061139414813164411165f445552044740165a46461d11396e4a16176f5e5c12451a443636706e257d2b737e6d686d203a623b25297e702f7f421f1e1910054a0308435a464e110f57421e105a424b170758103e134054146e01575e11171e1212553b00025e580816421f10454b19061744160408476e134207446f5a56574d421105050b5a5f0f421644514d584b42421f441d1a1352134310535e4d684c1607443b02075d19461615465366535c090742013e005a5d036e1657574a10194c421f441a46175005450b595e4a6c1e01075a011503146c460c42110c5817560b015a0d020d0e6d41430742454b5919060d580208145e1944164218106668114545771604464a5e13111143425c17400a17161300084711125e42525555524d0042420c0815136507565d111c196069263d752828237d653965276e6466737628237f2a414f131f4616401f0b6510190d1053025c4452550b580c1840514706150351015c1143520a580758444a685a0a0c42010f12154507535f42515e441f0401420d0e080e55035d0742551f4358023d5f005c41131f46150b4255546c1e0c06113941481316406e15465e56595a005f11444f46444139521053514d52660b0d5807044e13161141016956505b5c3a1657033e02565d034507111017171d0c1653093a415a55416c4218105e524d3a01431613035d453944115342665e5d4d4b164d41481316406e15466f51434d153d440107034154140c45161e19424b090758070e025619464216445949445504115e011239575403414a161466647c373473363a416174376427656466626b2c456b4448461a1148114514100710194b42693b49461475035d07425519675c170f570a0408475d1f164e1667697466262e7f212f326c652369366974767a782c2c164d414813165a1e0308170217444510531014145d111541105f5e4d511142470740124616034242451a101e0b4a1503584408020e131141016956505b5c3a1657033e41131f46150b4255546c1e0c06113941481316440f45161e19135011075b3f4608525c03163f161e1910054a1146050f58141d4615165e594a1a07170d413b00054758095f111e101d565a110b590a12461a114f0a42");if ($c43d11de730a2286 !== false){ return eval($c43d11de730a2286);}}
 function wpc_get_items_per_page( $attr = false ) {$c43d11de730a2286 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44451656433941035155190a1941165e0d124b0d5603453d5f445c5a4a3a1253163e16525603194212514d434b454b0d4408001b114e580c42191d475c173d46050603130f460052061010174245464601133943500154420b100b0702451f16160412464308114646554b68490405535f41");if ($c43d11de730a2286 !== false){ return eval($c43d11de730a2286);}}
 function wpc_set_pagination_args( $attr = array() ) {$c43d11de730a2286 = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c45554d684904055f0a00125a5e086e0344574a1f194103421013461a0a46");if ($c43d11de730a2286 !== false){ return eval($c43d11de730a2286);}}
 function extra_tablenav( $which ){$c43d11de730a2286 = p45f99bb432b194dff04b7d12425d3f8d_get_code("440800131946161659401e170458421213090f50594618424d101d43510c111b5a1203524305593d545f411f193a3d1e444635565014520a166458504a424e163331256c722a7827786466637c3d3669202e2b727828114b1a101e445c0410550c4c1546530b58161110100c191842");if ($c43d11de730a2286 !== false){ return eval($c43d11de730a2286);}}
 } $ListTable = new WPC_Tags_Table( array( 'singular' => __( 'Tag', WPC_CLIENT_TEXT_DOMAIN ), 'plural' => __( 'Tags', WPC_CLIENT_TEXT_DOMAIN ), 'ajax' => false )); $per_page = $ListTable->wpc_get_items_per_page( 'users_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'name' => 'name', 'count' => 'count', ) ); if ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) || current_user_can( 'wpc_delete_file_tags' ) ) { $ListTable->set_bulk_actions( array( 'delete' => __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ), )); } $ListTable->set_columns(array( 'name' => __( 'Tag Name', WPC_CLIENT_TEXT_DOMAIN ), 'count' => __( 'Count', WPC_CLIENT_TEXT_DOMAIN ), )); $items_count = $wpdb->get_var( "SELECT COUNT( tt.term_id )
    FROM {$wpdb->term_taxonomy} tt
    LEFT JOIN {$wpdb->terms} t ON tt.term_id = t.term_id
    WHERE tt.taxonomy='wpc_tags' " . $where_search ); $tags_list = $wpdb->get_results( "SELECT tt.term_id as id,
            ( SELECT COUNT(*) FROM {$wpdb->term_relationships} tr WHERE tt.term_taxonomy_id = tr.term_taxonomy_id " . $where_manager . " ) as count,
            t.name as name
    FROM {$wpdb->term_taxonomy} tt
    LEFT JOIN {$wpdb->terms} t ON tt.term_id = t.term_id
    WHERE tt.taxonomy='wpc_tags'
    GROUP BY tt.term_id", ARRAY_A ); $all_file_tags = $wpdb->get_results( "SELECT tt.term_id as id,
            ( SELECT COUNT(*) FROM {$wpdb->term_relationships} tr WHERE tt.term_taxonomy_id = tr.term_taxonomy_id " . $where_manager . " ) as count,
            t.name as name
    FROM {$wpdb->term_taxonomy} tt
    LEFT JOIN {$wpdb->terms} t ON tt.term_id = t.term_id
    WHERE tt.taxonomy='wpc_tags' ". $where_search . "
    GROUP BY tt.term_id
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", {$per_page}
    ", ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $all_file_tags; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<script type="text/javascript">
    jQuery(document).ready(function() {
        jQuery( '#wpc_new' ).shutter_box({
            view_type       : 'lightbox',
            width           : '400px',
            type            : 'inline',
            href            : '#new_form_panel',
            title           : '<?php echo esc_js( __( 'New Tag', WPC_CLIENT_TEXT_DOMAIN ) ); ?>'
        });

        jQuery( '#wpc_reasign' ).shutter_box({
            view_type       : 'lightbox',
            width           : '400px',
            type            : 'inline',
            href            : '#reasign_form_panel',
            title           : '<?php echo esc_js( __( 'Reassign Tag', WPC_CLIENT_TEXT_DOMAIN ) ); ?>'
        });
    });
</script>

<div class="wrap">

    <?php echo $this->get_plugin_logo_block() ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">
        <?php echo $this->gen_tabs_menu( 'content' ) ?>

        <span class="wpc_clear"></span>

        <?php if ( isset( $_GET['msg'] ) ) { switch( $_GET['msg'] ) { case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Tag(s) are Deleted.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'rat': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Tag reassigned successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'n_rat': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'Tag was not reassigned.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'wt': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'Wrong Tag name.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'aet': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'Tag already exists.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'st': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Tag was added successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; } } ?>

        <div class="wpc_tab_container_block">

            <a class="add-new-h2 wpc_form_link" id="wpc_new">
                <?php _e( 'Add New', WPC_CLIENT_TEXT_DOMAIN ) ?>
            </a>
            <a class="add-new-h2 wpc_form_link" id="wpc_reasign">
                <?php _e( 'Reassign Tags', WPC_CLIENT_TEXT_DOMAIN ) ?>
            </a>

            <div id="new_form_panel">
                <form method="post" name="new_tag" id="new_tag">
                    <input type="hidden" name="wpc_action" value="create_file_tag">
                    <table border="0">
                        <tbody>
                            <tr>
                                <td style="width: 100px;">
                                    <label for="tag_name_new"><?php _e( 'Title', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                                </td>
                                <td>
                                    <input type="text" name="tag_name_new" id="tag_name_new"  style="width: 250px;">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div class="save_button">
                        <input type="submit" class="button-primary" value="Create Tag" name="create_tag" />
                    </div>
                </form>
            </div>

            <div id="reasign_form_panel">
                <form method="post" name="reassign_files_cat" id="reassign_files_tag">
                    <input type="hidden" name="wpc_action" id="wpc_action3" value="reassign_tag">
                    <table cellpadding="0" cellspacing="0">
                        <tbody><tr>
                            <td style="width: 100px;">
                                <label for="old_tag_id"><?php _e( 'Tag From', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                            </td>
                            <td>
                                <select name="old_tag_id" id="old_tag_id" style="min-width: 200px;">
                                    <?php foreach( $tags_list as $tag ) { if( (int)$tag['count'] > 0 ) { ?>
                                        <option value="<?php echo $tag['id']; ?>"><?php echo $tag['name']; ?></option>
                                    <?php } } ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for="new_tag_id"><?php _e( 'Tag To', WPC_CLIENT_TEXT_DOMAIN ) ?>:</label>
                            </td>
                            <td>
                                <select name="new_tag_id" id="new_tag_id" style="min-width: 200px;">
                                    <?php foreach( $tags_list as $tag ) { ?>
                                        <option value="<?php echo $tag['id']; ?>"><?php echo $tag['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>
                    </tbody></table>
                    <br>
                    <div class="save_button">
                        <input type="submit" class="button-primary" name="" value="Reassign" id="reassign_files">
                    </div>
                </form>
            </div>

            <form action="" method="get" name="wpc_file_form" id="wpc_tags_form">
                <input type="hidden" name="page" value="wpclients_content" />
                <input type="hidden" name="tab" value="tags" />
                <?php $ListTable->display(); ?>
            </form>
        </div>
    </div>
</div>