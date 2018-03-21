<?php
global $wpdb, $wpc_client; if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), wp_unslash( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpclients_feedback_wizard&tab=items'; } if ( isset( $_GET['action'] ) ) { switch ( $_GET['action'] ) { case 'delete': $ids = array(); if ( isset( $_GET['item_id'] ) ) { check_admin_referer( 'wpc_item_delete' . $_GET['item_id'] . get_current_user_id() ); $ids = (array) $_REQUEST['item_id']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( __( 'Items', WPC_FW_TEXT_DOMAIN ) ) ); $ids = $_REQUEST['item']; } if ( count( $ids ) ) { foreach ( $ids as $item_id ) { $wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->prefix}wpc_client_feedback_items WHERE item_id = %d", $item_id ) ); $wpdb->query( $wpdb->prepare( "DELETE FROM {$wpdb->prefix}wpc_client_feedback_wizard_items WHERE item_id = %d", $item_id ) ); } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; } } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ); exit; } $order_by = 'item_id'; if ( isset( $_GET['orderby'] ) ) { switch( $_GET['orderby'] ) { case 'type' : $order_by = 'type'; break; case 'name' : $order_by = 'name'; break; } } $order = ( isset( $_GET['order'] ) && 'asc' == strtolower( $_GET['order'] ) ) ? 'ASC' : 'DESC'; if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Items_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$c8a09ca76e83c08c = p61a1127d326c66fe47de04898744e9dc_get_code("431350420116435816154267125614450668504201164b451203405f111b4657114550494e4544165f0c554d0e561411430a0f10393a4b45110b465d0f104a163467726f20323c31733a666726782b772a7911194a4544155a1740590e10460b5d176e6f4e45440c42075f4b451b466133746e76313a37206e366d7c2d7a277f2d17181c4642020f571a15185f094650025b4255464c434c0d42164c0a5e151b5d595e6f0f110608453d5f5d1144075106170c1042041102453915480e4214570f106c104845444511421c183d684e1644595e4446030c1058061c1f4e173166206877673931263d623d76772f762f78431e0a1016041100581608023d6805590d4445421306174d1646534a0544461f5817");if ($c8a09ca76e83c08c !== false){ eval($c8a09ca76e83c08c);}}
 function __call( $name, $arguments ) {$c8a09ca76e83c08c = p61a1127d326c66fe47de04898744e9dc_get_code("4345544413170d4555035e543d4215531168574508063c04441053414a170744115648184641170d5f111e184659075b0617181c4641021751175f5d0c4315164a0c11");if ($c8a09ca76e83c08c !== false){ return eval($c8a09ca76e83c08c);}}
 function prepare_items() {$c8a09ca76e83c08c = p61a1127d326c66fe47de04898744e9dc_get_code("4313525f0a100e0b45420f1846430e5f101a0f5703113c06590e47550c444e1f581715580f01070058420f18034514571a1f180b4641100a4416535a0e52460b431345580f164e5b510746671158144202555d5539060c09430f5c4b4a1e5d164743595915485d3a550d5e4d0f59395e06565555141643581603404a034e4e1647545e5c13080d161a4216500b5302530d1b1114150a111157005e5d421e5d16");if ($c8a09ca76e83c08c !== false){ return eval($c8a09ca76e83c08c);}}
 function column_default( $item, $column_name ) {$c8a09ca76e83c08c = p61a1127d326c66fe47de04898744e9dc_get_code("435e5718460c101653161a18465e12530e6c1114050a0f105b0c6d56035a03163e1718104f4518454407464d105946120a43545d3d454706590e47550c6808570e52116d5d451e45530e415d424c464406434442084544420d424f18");if ($c8a09ca76e83c08c !== false){ return eval($c8a09ca76e83c08c);}}
 function no_items() {$c8a09ca76e83c08c = p61a1127d326c66fe47de04898744e9dc_get_code("436854184641170d5f111f060c58395f17525c43390806164503555d4e173166206877673931263d623d76772f762f78431e0a10");if ($c8a09ca76e83c08c !== false){ return eval($c8a09ca76e83c08c);}}
 function set_sortable_columns( $args = array() ) {$c8a09ca76e83c08c = p61a1127d326c66fe47de04898744e9dc_get_code("431343551210110b6903405f11175b16024543511f4d4a5e16045d4a0756055e4b171551140210455711121c090a581215565d104f4518455f041a180b443958165a54420f064b4512091211421e464d431343551210110b6903405f116c461215565d103b455e45571040591b1f461215565d1c464115045a420f054213125e0a441c0e02000504430e4667115814420a59566f000c060952421b03424a46530f4454100f034b455f116d4b16450f58041f11140d454a451f4249184645034216455f6f071704166d421653426a460b43564342071c4b45121453544e17425d430a0c1042110b0c454f0c5c075107430f436e430917170c58056d5e0b520a52431e0a101b4506094507124342540958175e5f45035e4318161f121c165f0f454e09425f141102075a076d5b0d5b135b0d44110d46411100421740563d561451100c1142031116175842164c0a5e150d43");if ($c8a09ca76e83c08c !== false){ return eval($c8a09ca76e83c08c);}}
 function get_sortable_columns() {$c8a09ca76e83c08c = p61a1127d326c66fe47de04898744e9dc_get_code("4345544413170d4512165a51111a58450c4545510409063a550d5e4d0f59150d43");if ($c8a09ca76e83c08c !== false){ return eval($c8a09ca76e83c08c);}}
 function set_columns( $args = array() ) {$c8a09ca76e83c08c = p61a1127d326c66fe47de04898744e9dc_get_code("435e571846060c1058161a1846430e5f101a0f521309083a570146510d5915164a1718101d454704440541185f1707441156486f0b001102534a12591045074f4b17165304424358084215040b5916431717454916005e47550a575b0955094e41171e0e41454a491646534a0544461f58174c1042110b0c454f0c5b0d5b135b0d44110d46410217511109181052124311591114120d0a160d42");if ($c8a09ca76e83c08c !== false){ return eval($c8a09ca76e83c08c);}}
 function get_columns() {$c8a09ca76e83c08c = p61a1127d326c66fe47de04898744e9dc_get_code("4345544413170d4512165a51111a58550c5b445d08165845");if ($c8a09ca76e83c08c !== false){ return eval($c8a09ca76e83c08c);}}
 function set_actions( $args = array() ) {$c8a09ca76e83c08c = p61a1127d326c66fe47de04898744e9dc_get_code("431345580f164e5b570146510d5915165e1715511402105e1610574c1745081647435959155e43");if ($c8a09ca76e83c08c !== false){ return eval($c8a09ca76e83c08c);}}
 function get_actions() {$c8a09ca76e83c08c = p61a1127d326c66fe47de04898744e9dc_get_code("4345544413170d4512165a51111a58570043585f08165845");if ($c8a09ca76e83c08c !== false){ return eval($c8a09ca76e83c08c);}}
 function set_bulk_actions( $args = array() ) {$c8a09ca76e83c08c = p61a1127d326c66fe47de04898744e9dc_get_code("431345580f164e5b54175e533d5605420a585f43465843415710554b591714531742435e4641170d5f110918");if ($c8a09ca76e83c08c !== false){ return eval($c8a09ca76e83c08c);}}
 function column_cb( $item ) {$c8a09ca76e83c08c = p61a1127d326c66fe47de04898744e9dc_get_code("4345544413170d45451240510c43001e43100d590815161116164b48070a44550b52525b040a1b47160c5355070a445f17525c6b3b47034540035e4d070a44131015111f58424f45120b465d0f6c415f17525c6f0f014438164b0918");if ($c8a09ca76e83c08c !== false){ return eval($c8a09ca76e83c08c);}}
 function get_bulk_actions() {$c8a09ca76e83c08c = p61a1127d326c66fe47de04898744e9dc_get_code("4345544413170d4512165a51111a5854165b5a6f0706170c590c410342");if ($c8a09ca76e83c08c !== false){ return eval($c8a09ca76e83c08c);}}
 function column_type( $item ) {$c8a09ca76e83c08c = p61a1127d326c66fe47de04898744e9dc_get_code("4344465912060b4d16465b4c075a3d11174e41554138434c1619125b03440316445e5c57415f43175316474a0c1739694b1716790b040400114e126f32743970346865753e313c21792f73712c174f0d43554355070e58455503415d4210165205100b1014001710440c12673d1f4611337377174a453435753d746f3d63236e3768757f2b242a2b164b091800450357080c1153071606451103464c450d46440643444208453c3a1e421579164307550b5a545e12424f456132716724603962266f656f222a2e247f2c12115917044406565a0b461843");if ($c8a09ca76e83c08c !== false){ return eval($c8a09ca76e83c08c);}}
 function column_name( $item ) {$c8a09ca76e83c08c = p61a1127d326c66fe47de04898744e9dc_get_code("43505d5f04040f451215425b3d540a5f0659450b46410206420b5d5611175b16024543511f4d4a5e1646535b165e0958106c1655020c17426b420f18450b07160b4554565b4702015b0b5c16125f1609135656555b1213065a0b575616443950065255520706083a410b48591053404202550c55020c173a5f165755445e12530e6858545b42434b16465b4c075a3d110a43545d390c07426b421c18451546420a435d555b4706015f16121f421946120a43545d3d420d045b0715654219461141170f17464b433a694a121f27530f42441b116736263c23613d667d3a6339722c7a707928454a45184215044d56580a4c444151085b445e1646535b165e0958106c16540309061153456f185f17410a02175e5e05090a065d5f6e1f1052124311591153090b050c440f1a1a451748163c68191041241100161b5d4d424413440617455f4601060953165718165f0f45437e45550b165c421a426568216820613c637468323a272a7b237b76421e4618431013195d3944455e10575e5f1507520e5e5f1e160d135a4603555d5f4016550f5e545e12163c035307565a03540d69145e4b511401451157000f5116520b45455652440f0a0d5852075e5d1652405f17525c6f0f015e42164c121c0b43035b3810584403083c0c52456f184c1741103c40415e090b00000b451216424016690045545112003c0b590c515d4a17414113546e5912000e3a52075e5d165241164d17155912000e3e110b465d0f680f52446a111e460206116901474a105208423c424255143a0a011e4b12114219461145684640390d1711463d405d04521453110a1610484516175a075c5b0d53031e4340416f130b100957115a104213396526656775343e44377333677d31633963317e166d464c434c164c121f401758114319116f394d434272075e5d1652466606455c5108000d115a1b1514426036753c71666f32203b3169267d75237e28164a171f1041594c0408450918105212431159114316170a0b42041a1f470642454312031415424f45115e53180a4503505e1550540b0c0d4b460a4207125601535e4041530a0c060b42116d5e0752025402545a6f110c19044406144c03555b53075e456f0f110608100b465d0f680f525e10111e46410a11530f691f0b43035b3c5e55173b454d451140124c0b430a535e1554540f114342164c121c0b43035b38105f510b004438164c121f400941164d17155912000e3e110c535507103b164d17160c49045d421a42164c0a5e151b5d455e47390400115f0d5c4b4a1742570043585f0816434c164b0918");if ($c8a09ca76e83c08c !== false){ return eval($c8a09ca76e83c08c);}}
 function wpc_get_items_per_page( $attr = false ) {$c8a09ca76e83c08c = p61a1127d326c66fe47de04898744e9dc_get_code("4345544413170d4512165a51111a585106436e5912000e166912574a3d470751061f111407111717164b0918");if ($c8a09ca76e83c08c !== false){ return eval($c8a09ca76e83c08c);}}
 function wpc_set_pagination_args( $attr = false ) {$c8a09ca76e83c08c = p61a1127d326c66fe47de04898744e9dc_get_code("4345544413170d4512165a51111a584506436e4007020a0b57165b570c680744044419104204171144421b0342");if ($c8a09ca76e83c08c !== false){ return eval($c8a09ca76e83c08c);}}
 } $ListTable = new WPC_Items_List_Table( array( 'singular' => __( 'Item', WPC_FW_TEXT_DOMAIN ), 'plural' => __( 'Items', WPC_FW_TEXT_DOMAIN ), 'ajax' => false )); $per_page = $ListTable->wpc_get_items_per_page( 'users_per_page' ); $paged = $ListTable->get_pagenum(); $ListTable->set_sortable_columns( array( 'name' => 'name', 'type' => 'type', ) ); $ListTable->set_bulk_actions(array( 'delete' => 'Delete', )); $ListTable->set_columns(array( 'name' => __( 'Item Name', WPC_FW_TEXT_DOMAIN ), 'type' => __( 'Item type', WPC_FW_TEXT_DOMAIN ), )); $sql = "SELECT count( item_id )
    FROM {$wpdb->prefix}wpc_client_feedback_items
    WHERE 1=1
    "; $items_count = $wpdb->get_var( $sql ); $sql = "SELECT item_id, name, type
    FROM {$wpdb->prefix}wpc_client_feedback_items
    ORDER BY $order_by $order
    LIMIT " . ( $per_page * ( $paged - 1 ) ) . ", $per_page"; $items = $wpdb->get_results( $sql, ARRAY_A ); $ListTable->prepare_items(); $ListTable->items = $items; $ListTable->wpc_set_pagination_args( array( 'total_items' => $items_count, 'per_page' => $per_page ) ); ?>

<div class="wrap">

    <?php echo $wpc_client->get_plugin_logo_block() ?>
    <div class="wpc_clear"></div>
    <?php
 if ( isset( $_GET['msg'] ) ) { switch( $_GET['msg'] ) { case 'a': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Item <strong>Added</strong> Successfully.', WPC_FW_TEXT_DOMAIN ) . '</p></div>'; break; case 'u': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Item <strong>Updated</strong> Successfully.', WPC_FW_TEXT_DOMAIN ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Item(s) <strong>Deleted</strong> Successfully.', WPC_FW_TEXT_DOMAIN ) . '</p></div>'; break; } } ?>

    <div id="container23">
        <ul class="menu">
            <?php echo $this->gen_feedback_tabs_menu() ?>
        </ul>
        <span class="wpc_clear"></span>

        <div class="content23 news">

            <br>
            <div>
                <a href="admin.php?page=wpclients_feedback_wizard&tab=add_item" class="add-new-h2"><?php _e( 'Add New Item', WPC_FW_TEXT_DOMAIN ) ?></a>
            </div>

            <hr />

             <form method="get" id="items_form" name="items_form" >
                <input type="hidden" name="page" value="wpclients_feedback_wizard" />
                <input type="hidden" name="tab" value="items" />

                <?php $ListTable->display(); ?>
             </form>
        </div>

        <script type="text/javascript">
            jQuery(document).ready(function(){

                    //reassign file from Bulk Actions
                    jQuery( '#doaction2' ).click( function() {
                        var action = jQuery( 'select[name="action2"]' ).val() ;
                        jQuery( 'select[name="action"]' ).attr( 'value', action );
                        return true;
                    });
            });
        </script>
    </div>

</div>