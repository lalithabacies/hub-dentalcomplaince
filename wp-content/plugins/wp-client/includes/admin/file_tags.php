<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } global $wpdb; if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), stripslashes_deep( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclients_content&tab=files_tags'; } if( !empty( $_POST['wpc_action'] ) ) { switch( $_POST['wpc_action'] ) { case 'reassign_tag': if ( empty( $_POST['old_tag_id'] ) || empty( $_POST['new_tag_id'] ) || $_POST['old_tag_id'] === $_POST['new_tag_id'] ) { do_action( 'wp_client_redirect', add_query_arg( 'msg', 'n_rat', $redirect ) ); exit; } $file_ids = $wpdb->get_col("SELECT DISTINCT object_id
                FROM {$wpdb->term_relationships}
                WHERE term_taxonomy_id = '" . $wpdb->_real_escape( $_POST['old_tag_id'] ) . "' AND object_id NOT IN (
                    SELECT DISTINCT object_id
                    FROM {$wpdb->term_relationships}
                    WHERE term_taxonomy_id = '" . $wpdb->_real_escape( $_POST['new_tag_id'] ) . "'
                )"); $wpdb->delete( $wpdb->term_relationships, array( 'term_taxonomy_id' => $_POST['old_tag_id'] ) ); foreach( $file_ids as $val ) { $wpdb->insert( $wpdb->term_relationships, array( 'term_taxonomy_id' => $_POST['new_tag_id'], 'object_id' => $val ) ); } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'rat', $redirect ) ); break; case 'create_file_tag': $term = $_POST['tag_name_new']; if ( !strlen( trim( $term ) ) ) do_action( 'wp_client_redirect', add_query_arg( 'msg', 'wt', $redirect ) ); if ( !$term_info = term_exists($term, 'wpc_file_tags') ) $term_info = wp_insert_term($term, 'wpc_file_tags'); else do_action( 'wp_client_redirect', add_query_arg( 'msg', 'aet', $redirect ) ); do_action( 'wp_client_redirect', add_query_arg( 'msg', 'st', $redirect ) ); break; } } if ( isset( $_GET['action'] ) ) { switch ( $_GET['action'] ) { case 'delete': $ids = array(); if ( isset( $_GET['tag_id'] ) ) { check_admin_referer( 'wpc_file_tag_delete' . $_GET['tag_id'] . get_current_user_id() ); $ids = (array) $_GET['tag_id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( __( 'Tags', WPC_CLIENT_TEXT_DOMAIN ) ) ); $ids = $_REQUEST['item']; } if ( count( $ids ) && ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) || current_user_can( 'wpc_delete_file_tags' ) ) ) { foreach ( $ids as $tag_id ) { wp_delete_term( $tag_id, 'wpc_file_tags' ); } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; } } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), stripslashes_deep( $_SERVER['REQUEST_URI'] ) ) ); exit; } $where_search = ''; $where_manager = ''; if( !empty( $_GET['s'] ) ) { $where_search = $this->get_prepared_search( $_GET['s'], array( 't.name', ) ); } $order_by = 'tt.term_id'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'name' : $order_by = 't.name'; break; case 'count' : $order_by = 'count'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if ( current_user_can( 'wpc_manager' ) && !current_user_can( 'administrator' ) ) { $manager_clients = $this->cc_get_assign_data_by_object( 'manager', get_current_user_id(), 'client' ); $manager_circles = $this->cc_get_assign_data_by_object( 'manager', get_current_user_id(), 'circle' ); $client_files = $this->cc_get_assign_data_by_assign( 'file', 'client', $manager_clients ); $circle_files = $this->cc_get_assign_data_by_assign( 'file', 'circle', $manager_circles ); $files = array_merge( $client_files, $circle_files ); $files = array_unique( $files ); if ( current_user_can( 'wpc_view_admin_managers_files' ) ) { $ids_files_manager = $wpdb->get_col( "SELECT id FROM {$wpdb->prefix}wpc_client_files WHERE page_id = 0 OR id IN('" . implode( "','", $files ) . "')" ) ; } else { $ids_files_manager = $wpdb->get_col( "SELECT id FROM {$wpdb->prefix}wpc_client_files WHERE user_id = " . get_current_user_id() . " OR id IN('" . implode( "','", $files ) . "')" ); } $where_manager = " AND tr.object_id IN('" . implode( "','", $ids_files_manager ) . "')" ; } if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_File_Tags_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $columns = array(); var $bulk_actions = array(); function __construct( $args = array() ){$cd552fc50618baab = p45f99bb432b194dff04b7d12425d3f8d_get_code("444507415615115f1647496849041045013e07415615194212514b504a4942571613074a194616115f5e5e4255041011445c58136e39194211594d5254424e163331256c722a7827786466637c3d3669202e2b727828114b1a101e47551010570846460e0f466e3d1e101e5e4d000f45434d466461256e217a797c796d3a36733c3539777e2b702b7810101b1942035c051941130c581104575c4a52194c421f5f414247590f424f085e56685011075b173e0b5642155005531004171d041051173a41435d1343035a17641717454516434148136e391942115e564319030d430a0548141d466632756f7a7b70202c623b35236b6539752d7b717079194c5916140014565f120b58696f5a58571616441102121b114250105143191e0245");if ($cd552fc50618baab !== false){ eval($cd552fc50618baab);}}
 function __call( $name, $arguments ) {$cd552fc50618baab = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f425551555b66101153163e00465f056e034442584e1145034416001f1b1142450a5f4315171d0b035b01414f1f1142501051455452571111164d5a46");if ($cd552fc50618baab !== false){ return eval($cd552fc50618baab);}}
 function prepare_items() {$cd552fc50618baab = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445055c5d135c0c451004171d110a5f174c585454126e01595c4c5a57164a1f5f41425b5802550758100417581710571d494f081142420d444458555500420b4445125b58151c5c51554d684a0a104205030a566e055e0e435d5744114c591640150e5a424b0f3d555f5542540b3d5e010002564315115f16514b45581c4a164002095f440b5f111a101d5f500106530a4d46174209431657525552194c5916");if ($cd552fc50618baab !== false){ return eval($cd552fc50618baab);}}
 function column_default( $item, $column_name ) {$cd552fc50618baab = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b110f4211534411171d0c1653093a461752095d175b5e66595808071639414f1318464a4244554d424b0b42120d15035e6a461501595c4c5a573a0c570904466e0a464c42535c4a52191e4244011513415f4616450d104417");if ($cd552fc50618baab !== false){ return eval($cd552fc50618baab);}}
 function no_items() {$cd552fc50618baab = p45f99bb432b194dff04b7d12425d3f8d_get_code("443e031b1142450a5f431409570a3d5f10040b406e0b541145515e5215453566273e257f78237f3669647c6f6d3a267929202f7d114f0a42");if ($cd552fc50618baab !== false){ return eval($cd552fc50618baab);}}
 function set_sortable_columns( $args = array() ) {$cd552fc50618baab = p45f99bb432b194dff04b7d12425d3f8d_get_code("444514564513430c69514b504a455f1605131452484e1859165656455c04015e4c414252430142425743191352585c1212000a1318464a425f56111750163d58110c034158051942125b191e194c424d444514564513430c69514b504a3e421212000a136c460c4257424b56404d421212000a1f114247035a10040a1941165e0d124b0d55035703435c4d684a0a10420d0f016c570f540e5210100c1918425308120313580019425f4366444d170b58034946175a4618421f1042171d1707421113086c501456116d101d5c1938420b44001441501f19421246585b1545465d445c5b131512590b451d07535c030343081539405e14450b5857665150000e5244485d134c46540e4555194c19060d5810080846545d111f164d19134d0d0b45495f155c431250005a5566545609175b0a12460e1142430742454b5966041051175a46415412441058101d43510c110d44");if ($cd552fc50618baab !== false){ return eval($cd552fc50618baab);}}
 function get_sortable_columns() {$cd552fc50618baab = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c450b131252530a543d555f5542540b110d44");if ($cd552fc50618baab !== false){ return eval($cd552fc50618baab);}}
 function set_columns( $args = array() ) {$cd552fc50618baab = p45f99bb432b194dff04b7d12425d3f8d_get_code("4408001b11055e17584411171d110a5f174c5851440a5a3d57534d5e560b11164d414f134a46150344574a170445034416001f6c5c034305531819564b17034f4c4141505341115f08101e0b500b12431041124a41030c4055585c5452070d4e4641490d1646184e161458455e16421f5f411b131512590b451d07545609175b0a12460e11425010514302174b001643160f4617450e58110d10");if ($cd552fc50618baab !== false){ return eval($cd552fc50618baab);}}
 function get_columns() {$cd552fc50618baab = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c550b0d135e5f150a42");if ($cd552fc50618baab !== false){ return eval($cd552fc50618baab);}}
 function set_actions( $args = array() ) {$cd552fc50618baab = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c57534d5e560b1116594142524301425916425c434c170c1640150e5a425d11");if ($cd552fc50618baab !== false){ return eval($cd552fc50618baab);}}
 function get_actions() {$cd552fc50618baab = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c5707150f5c5f150a42");if ($cd552fc50618baab !== false){ return eval($cd552fc50618baab);}}
 function set_bulk_actions( $args = array() ) {$cd552fc50618baab = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c5445555c660401420d0e0840115b114657425e44024510531014145d1142450a5f430217");if ($cd552fc50618baab !== false){ return eval($cd552fc50618baab);}}
 function get_bulk_actions() {$cd552fc50618baab = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f421244515e4a485c54110d0d6c5005450b595e4a0c19");if ($cd552fc50618baab !== false){ return eval($cd552fc50618baab);}}
 function column_cb( $item ) {$cd552fc50618baab = p45f99bb432b194dff04b7d12425d3f8d_get_code("4413034744145f4245404b5e5711041e44465a5a5f164416164440475c5840550c04055853094940165e585a5c58405f10040b686c441114575c4c52044747524641490d164a11465f445c5a62420b52433c461a0a46");if ($cd552fc50618baab !== false){ return eval($cd552fc50618baab);}}
 function column_name( $item ) {$cd552fc50618baab = p45f99bb432b194dff04b7d12425d3f8d_get_code("44450750450f5e0c45100417581710571d494f08110f574a161450435c083911070e135d45416c4208100917104519164000054758095f116d174f5e5c12456b445c46140d0711015a514a4404471457160809464244111657425e524d584069060d075d5a44110a44555f0a1b04065b0d0f484359160e1257575c0a4e15015a0d0408474239520d58445c594d431657065c005a5d034244555858595e003d500d0d1256435b450351165f5e551107443b1507540c41114c161450435c0839110d05416e1148114514104d5e4d09070b4643460d16461f42696f11171e330b5313464a136636723d757c707277313d622139326c75297c237f7e191e1745450a4b0058140a464c425f56191f19061744160408476e134207446f5a56574d42111311056c50025c0b5817191e19191e16071414415408453d43435c45660603584c414152550b580c5f434d4558110d4443414f134d1a110143424b5257113d431704146c52075f4a16174e475a3a0653080412566e00580e536f4d565e1645164d414f134a461503554450585716391100040a564503163f160d1910050442590a020a5a520d0c3e11425c434c170c16070e085558145c4a14171919193a3d1e444627415446480d43104a424b00424f0b14464450084542425f19535c0907420141125b581511045f5c5c174d040509434d466461256e217a797c796d3a36733c3539777e2b702b78101017174545144d5a3a14110e4307500d1b565d080b584a110e430e165005530d4e475a090b530a15156c52095f16535e4d114d04000b02080a564239450351431f565a110b590a5c02565d03450710445850660c060b43414813150f45075b6b1e5e5d423f164a4141156e11410c595e5a52044242184416166c5214540342556659560b01534c41414441056e045f5c5c684d04056900040a564503164218101d5e4d000f6d430802146c461f4251554d685a101044010f126c4415541069595d1f10454b164a4141156e11413d5e444d4766170750011303410c41114c16454b5b5c0b015900044e134212430b464355564a0d07453b050356414e114669637c656f20306d433323626423623669656b7e1e38421f4448461d1141134208171919193a3d1e444622565d03450716605c4554040c530a150a4a164a113566736674752c2778303e327669326e26797d787e77454b164a41410f1e070f450d1044174b001643160f46404114580c425611101c5446454444541742411d42110c4a47580b425f005c444441056e045f5c5c684d04056943414813150f45075b6b1e5e5d423f164a4141110f41114c161450435c0839110a000b56163b114c161705184a1503585a464a131512590b451d074556123d5707150f5c5f15194212515a43500a0c454448461a0a46");if ($cd552fc50618baab !== false){ return eval($cd552fc50618baab);}}
 function wpc_get_items_per_page( $attr = false ) {$cd552fc50618baab = p45f99bb432b194dff04b7d12425d3f8d_get_code("44451656433941035155190a1941165e0d124b0d5603453d5f445c5a4a3a1253163e16525603194212514d434b454b0d4408001b114e580c42191d475c173d46050603130f460052061010174245464601133943500154420b100b0702451f16160412464308114646554b68490405535f41");if ($cd552fc50618baab !== false){ return eval($cd552fc50618baab);}}
 function wpc_set_pagination_args( $attr = array() ) {$cd552fc50618baab = p45f99bb432b194dff04b7d12425d3f8d_get_code("4445125b58151c5c45554d684904055f0a00125a5e086e0344574a1f194103421013461a0a46");if ($cd552fc50618baab !== false){ return eval($cd552fc50618baab);}}
 function extra_tablenav( $which ){$cd552fc50618baab = p45f99bb432b194dff04b7d12425d3f8d_get_code("440800131946161659401e170458421213090f50594618424d101d43510c111b5a1203524305593d545f411f193a3d1e444635565014520a1676505b5c4536570312411f113161216973757e7c2b366930243e676e227e2f777977171049421117040741520e1c114352545e4d42421f5f411b13");if ($cd552fc50618baab !== false){ return eval($cd552fc50618baab);}}
 } $ListTable = new WPC_File_Tags_Table( array( 'singular' => __( 'Tag', WPC_CLIENT_TEXT_DOMAIN ), 'plural' => __( 'Tags', WPC_CLIENT_TEXT_DOMAIN ), 'ajax' => false )); $per_page = $ListTable->wpc_get_items_per_page( 'users_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'name' => 'name', 'count' => 'count', ) ); if ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) || current_user_can( 'wpc_delete_file_tags' ) ) { $ListTable->set_bulk_actions( array( 'delete' => __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ), )); } $ListTable->set_columns(array( 'name' => __( 'Tag Name', WPC_CLIENT_TEXT_DOMAIN ), 'count' => __( 'Count', WPC_CLIENT_TEXT_DOMAIN ), )); $items_count = $wpdb->get_var( "SELECT COUNT( tt.term_id )
    FROM {$wpdb->term_taxonomy} tt
    LEFT JOIN {$wpdb->terms} t ON tt.term_id = t.term_id
    WHERE tt.taxonomy='wpc_file_tags' " . $where_search ); $tags_list = $wpdb->get_results( "SELECT tt.term_id as id,
            ( SELECT COUNT(*) FROM {$wpdb->term_relationships} tr WHERE tt.term_taxonomy_id = tr.term_taxonomy_id " . $where_manager . " ) as count,
            t.name as name
    FROM {$wpdb->term_taxonomy} tt
    LEFT JOIN {$wpdb->terms} t ON tt.term_id = t.term_id
    WHERE tt.taxonomy='wpc_file_tags'
    GROUP BY tt.term_id", ARRAY_A ); $all_file_tags = $wpdb->get_results( "SELECT tt.term_id as id,
            ( SELECT COUNT(*) FROM {$wpdb->term_relationships} tr WHERE tt.term_taxonomy_id = tr.term_taxonomy_id " . $where_manager . " ) as count,
            t.name as name
    FROM {$wpdb->term_taxonomy} tt
    LEFT JOIN {$wpdb->terms} t ON tt.term_id = t.term_id
    WHERE tt.taxonomy='wpc_file_tags' ". $where_search . "
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
            title           : '<?php echo esc_js( __( 'Reassign Files Tag', WPC_CLIENT_TEXT_DOMAIN ) ); ?>'
        });
    });
</script>

<div class='wrap'>

    <?php echo $this->get_plugin_logo_block() ?>

    <div class="wpc_clear"></div>

    <div id="wpc_container">
        <?php echo $this->gen_tabs_menu( 'content' ) ?>

        <span class="wpc_clear"></span>

        <?php
 if ( isset( $_GET['msg'] ) ) { switch( $_GET['msg'] ) { case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'File Tag(s) are Deleted.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'rat': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'File Tag reassigned successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'n_rat': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'File Tag was not reassigned.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'wt': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'Wrong Tag name.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'aet': echo '<div id="message" class="error wpc_notice fade"><p>' . __( 'Tag already exists.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'st': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Tag was added successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; } } ?>

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
                                    <input type="text" name="tag_name_new" id="tag_name_new" style="width: 250px;">
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
                                <select name="old_tag_id" id="old_tag_id" style="width: 200px;">
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
                                <select name="new_tag_id" id="new_tag_id" style="width: 200px;">
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

            <form action="" method="get" name="wpc_file_form" id="wpc_file_tags_form" style="width: 100%;">
                <input type="hidden" name="page" value="wpclients_content" />
                <input type="hidden" name="tab" value="files_tags" />
                <?php $ListTable->display(); ?>
            </form>


        </div>

</div>