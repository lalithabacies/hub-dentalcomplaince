<?php
if ( ! defined( 'ABSPATH' ) ) { exit; } if ( !current_user_can( 'wpc_pm_level_4' ) ) { do_action( 'wp_client_redirect', get_admin_url() . 'admin.php?page=wpc_project_management' ); } global $wpdb, $wpc_client; $fields = array(); $wpc_custom_fields = $wpc_client->cc_get_settings( 'pm_custom_fields' ); $types = array(); $i = 0; foreach ( $wpc_custom_fields as $key => $value ) { $i++; $value['id'] = $i; $value['name'] = $key; $types[] = $value; } if ( isset($_REQUEST['_wp_http_referer']) ) { $redirect = remove_query_arg(array('_wp_http_referer' ), wp_unslash( $_REQUEST['_wp_http_referer'] ) ); } else { $redirect = get_admin_url(). 'admin.php?page=wpc_project_management&tab=custom_fields'; } if ( isset( $_GET['action'] ) ) { switch ( $_GET['action'] ) { case 'delete': $ids = array(); if ( isset( $_GET['name'] ) ) { check_admin_referer( 'wpc_field_delete' . $_GET['name'] . get_current_user_id() ); $ids = (array) $_GET['name']; } elseif( isset( $_REQUEST['item'] ) ) { check_admin_referer( 'bulk-' . sanitize_key( __( 'Fields', WPC_CLIENT_TEXT_DOMAIN ) ) ); $ids = $_REQUEST['item']; } if ( count( $ids ) ) { foreach ( $ids as $item_id ) { unset( $wpc_custom_fields[ $item_id ] ); do_action( 'wp_client_settings_update', $wpc_custom_fields, 'pm_custom_fields' ); $client_ids = get_users( array( 'role' => 'wpc_client', 'meta_key' => $item_id, 'fields' => 'ID', ) ); if ( is_array( $client_ids ) && 0 < count( $client_ids ) ) { foreach( $client_ids as $id ) { delete_user_meta( $id, $item_id ); } } } do_action( 'wp_client_redirect', add_query_arg( 'msg', 'd', $redirect ) ); exit; } do_action( 'wp_client_redirect', $redirect ); exit; } } if ( !empty( $_GET['_wp_http_referer'] ) ) { do_action( 'wp_client_redirect', remove_query_arg( array( '_wp_http_referer', '_wpnonce'), wp_unslash( $_SERVER['REQUEST_URI'] ) ) ); exit; } if( ! class_exists( 'WP_List_Table' ) ) { require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' ); } class WPC_Fields_List_Table extends WP_List_Table { var $no_items_message = ''; var $sortable_columns = array(); var $default_sorting_field = ''; var $actions = array(); var $bulk_actions = array(); var $columns = array(); function __construct( $args = array() ){$ccdf6c191bf9215a = p484916a1e7bab6a4a997dc157e8b3fe4_get_code("46125817054b105f1346466e4659434b03695817054b184217504456451411591444581c4a1817115a5f51445a59431f460b07453d671842145842545b1f1d1831667a3a217479277d65696573606567227974242b76104b1f1111415a4d43590a1119585c186f3d1b111158425d5c4b411a1932327b6f217f78737f6267657d3e6266212d75712b7d111f1d161f5052074e1e455f061004525d4554161111115d161d110a51434f0d5f596e5f4c545515695400114b510556110b111259435f156d1e150e4d42035f166b1118181618411617453d671842145f5945165e5e4d085217424e186732706e757d7f7d7f6c39627c3d3667742d7e707f7f16110a1816574b000c4c0a586c6e555e584b454a13554d4d421c5110544216180d18");if ($ccdf6c191bf9215a !== false){ eval($ccdf6c191bf9215a);}}
 function __call( $name, $arguments ) {$ccdf6c191bf9215a = p484916a1e7bab6a4a997dc157e8b3fe4_get_code("46445c11174a5e4250505a5d694d425d14695f100c5b6f03414357481e18504a1457404d421c440a5a421a111256505503161049421c511054445b54584c42184f0d19");if ($ccdf6c191bf9215a !== false){ return eval($ccdf6c191bf9215a);}}
 function prepare_items() {$ccdf6c191bf9215a = p484916a1e7bab6a4a997dc157e8b3fe4_get_code("46125a0a0e4d5d0c40110b11124c5951151b0702074c6f015c5d435c584b19115d161d0d0b5c54075d110b11574a43591f1e105e421c430d414557535a5d110546124d0d0b4b1d5c5454426e4557434c075455003d5b5f0e465c58421e110a184242510c11150e3d505e5a445b566e5003575d00104b105f13504443574119184255560917555e111f1112595f5c555d081a19411157421652535a5416110a18");if ($ccdf6c191bf9215a !== false){ return eval($ccdf6c191bf9215a);}}
 function column_default( $item, $column_name ) {$ccdf6c191bf9215a = p484916a1e7bab6a4a997dc157e8b3fe4_get_code("465f5f4d4251431156451e111251455d0b6d194101575c175e5f695f575554183b1610454b184b42415442444456111c0f425c08391814015c5d435c58675f590b53193859184d42565d45541643114a03424c170c18174508114b11");if ($ccdf6c191bf9215a !== false){ return eval($ccdf6c191bf9215a);}}
 function no_items() {$ccdf6c191bf9215a = p484916a1e7bab6a4a997dc157e8b3fe4_get_code("46695c4d421c440a5a421b0f58576e51125354163d555511405051541a18666825697a292b7d7e366c657369626775772b77702b42110b42");if ($ccdf6c191bf9215a !== false){ return eval($ccdf6c191bf9215a);}}
 function set_sortable_columns( $args = array() ) {$ccdf6c191bf9215a = p484916a1e7bab6a4a997dc157e8b3fe4_get_code("46124b00164d420c6c50445645180c1807444b041b10195913575943535952504e161d04105f4342524216155d050f1c105755454b184b425a571e115f4b6e56135b5c170b5b1842175a16181611114346124b00164d420c6c5044564563111c105755453f180d42524344504f10111c10575549421c46035f110b0c161c45500f45145b065d5603465d426e4557434c0f585e3a0451550e57111f0a1645115d0a455c450b5e18425a426942424a5856011e1941091819421a114d11124a544c1344573a034a57116811125a1665110546574b17034118421747575d1a181553460b0445464c580b401c0855535e504d0a4266160d4a440b5d5669575f5d5d5c461f02451f18550e4054164a165b5e56125f57100703101f134c16154250584b4b084a0a104c51005f5469525954445508451958421c42074744445f6959435f150d1917074c45105d1112455e51420346");if ($ccdf6c191bf9215a !== false){ return eval($ccdf6c191bf9215a);}}
 function get_sortable_columns() {$ccdf6c191bf9215a = p484916a1e7bab6a4a997dc157e8b3fe4_get_code("46445c11174a5e4217455e5845150f4b09444d040054553d505e5a445b56420346");if ($ccdf6c191bf9215a !== false){ return eval($ccdf6c191bf9215a);}}
 function set_columns( $args = array() ) {$ccdf6c191bf9215a = p484916a1e7bab6a4a997dc157e8b3fe4_get_code("465f5f4d425b5f175d451e11124c5951151b070717545b3d52524258595642184f16104519181403415645110b18504a1457403a0f5d420556191650444a50414e161e06001f105f0d11110d5f56414d12164d1c125d0d40505953525d5a5e404416165b4518194e13155743514b11115d164445464c580b401c08525954445508451958421c511054420d11445d454d14581941165059110811");if ($ccdf6c191bf9215a !== false){ return eval($ccdf6c191bf9215a);}}
 function get_columns() {$ccdf6c191bf9215a = p484916a1e7bab6a4a997dc157e8b3fe4_get_code("46445c11174a5e4217455e5845150f5b095a4c080c4b0b42");if ($ccdf6c191bf9215a !== false){ return eval($ccdf6c191bf9215a);}}
 function set_actions( $args = array() ) {$ccdf6c191bf9215a = p484916a1e7bab6a4a997dc157e8b3fe4_get_code("46124d0d0b4b1d5c52524258595642185b161d04105f435913435345434a5f184242510c110310");if ($ccdf6c191bf9215a !== false){ return eval($ccdf6c191bf9215a);}}
 function get_actions() {$ccdf6c191bf9215a = p484916a1e7bab6a4a997dc157e8b3fe4_get_code("46445c11174a5e4217455e5845150f590542500a0c4b0b42");if ($ccdf6c191bf9215a !== false){ return eval($ccdf6c191bf9215a);}}
 function set_bulk_actions( $args = array() ) {$ccdf6c191bf9215a = p484916a1e7bab6a4a997dc157e8b3fe4_get_code("46124d0d0b4b1d5c51445a5a6959524c0f59571642051046524351420d18435d12434b0b421c440a5a420d11");if ($ccdf6c191bf9215a !== false){ return eval($ccdf6c191bf9215a);}}
 function get_bulk_actions() {$ccdf6c191bf9215a = p484916a1e7bab6a4a997dc157e8b3fe4_get_code("46445c11174a5e4217455e5845150f5a135a523a035b440b5c5f450a16");if ($ccdf6c191bf9215a !== false){ return eval($ccdf6c191bf9215a);}}
 function column_cb( $item ) {$ccdf6c191bf9215a = p484916a1e7bab6a4a997dc157e8b3fe4_get_code("46445c11174a5e4240414458584c57104611050c0c48451613454f415305135b0e535a0e00574840135f575c530513511253543e3f1a1014525d43540b1a144b4416165b451410465a45535c6d1f5f590b531e3842110b42");if ($ccdf6c191bf9215a !== false){ return eval($ccdf6c191bf9215a);}}
 function column_type( $item ) {$ccdf6c191bf9215a = p484916a1e7bab6a4a997dc157e8b3fe4_get_code("46454e0c165b584a13155f4553556a1f124f49004565104b134a1652574b541841425c1d161f0a424154424444561167391e1942365d4816137359491114116f367566262e71752c676e62746e6c6e7c297b782c2c1819591353445457530a1805574a00421f5403475446585553544a410c1917074c45105d11696e1e18167c07425c150b5b5b0741161a1161687267257a70202c6c6f367669626e72777c792f78194c59185303405416165557424c410c1917074c45105d11696e1e18167b09454d424e186732706e757d7f7d7f6c39627c3d3667742d7e707f7f16110a1804445c040903100152425311114c544012574b00031f0a424154424444561167391e19422f4d5c165a1c5a58585d116c034e4d45205748451f116161756772742f7377313d6c753a676e727e7b797876461f0245004a5503580a1652574b5418414458010b57175813435345434a5f1839691145456a51065a5e1673434c455708451e49426f60216c727a7873766567327361313d7c7f2f727878111f03115a1453580e59185303405416165550545b0d54561d450210105645434358186e674e161e260a5d5309515e4e54451f1d1831667a3a217479277d65696573606567227974242b76104b0811544353595a034655581607181711565d5352425a5e40410c1917074c45105d11696e1e18166b035a5c061618720d4b161a1161687267257a70202c6c6f367669626e72777c792f78194c5918521056505d0a165b504b03161e081754440b40545a54554c53571e110345105d4417415f166e6910111f2b4355110b1863075f545545167a5e40411a1932327b6f217f78737f6267657d3e6266212d75712b7d111f0a165a435d075d02450159430713165e58525c5456410c1917074c45105d11696e1e1816700f525d000c18760b565d52161a18666825697a292b7d7e366c657369626775772b77702b42110b42514353505d03114546");if ($ccdf6c191bf9215a !== false){ return eval($ccdf6c191bf9215a);}}
 function column_id( $item ) {$ccdf6c191bf9215a = p484916a1e7bab6a4a997dc157e8b3fe4_get_code("46445c11174a5e42140d45415756115b0a574a165f1a5f105754446e584d5c1a5811194b421c5916565c6d165f5c1665461819425e174312525f080d4548505646555504114b0d405c43525444675855011407594d4b40035d0f11110d18");if ($ccdf6c191bf9215a !== false){ return eval($ccdf6c191bf9215a);}}
 function column_title( $item ) {$ccdf6c191bf9215a = p484916a1e7bab6a4a997dc157e8b3fe4_get_code("46445c11174a5e421b115f42455d45104612501107556b454758425d531f6c184f1610455d18140b47545b6a114c584c0a531e384202104514110d11");if ($ccdf6c191bf9215a !== false){ return eval($ccdf6c191bf9215a);}}
 function column_description( $item ) {$ccdf6c191bf9215a = p484916a1e7bab6a4a997dc157e8b3fe4_get_code("46445c11174a5e421b115f42455d45104612501107556b45575445524451414c0f5957423f1819421a1109111251455d0b6d1e01074b53105a41425859561665460c194245180b42");if ($ccdf6c191bf9215a !== false){ return eval($ccdf6c191bf9215a);}}
 function column_options( $item ) {$ccdf6c191bf9215a = p484916a1e7bab6a4a997dc157e8b3fe4_get_code("461251110f54105f13160a585848444c46424015070512015b54555a5457491a46525016035a5c075711110a161c594c0b5a194b5f1818425a4245544210111c0f425c08391f420742445f43535c1665461f19434418175314110b0c161c584c035b6242105d41175a435355116511114609194201505501585452161602111f410d19410a4c5d0e131f0b1111181e0640585b161203160c5142460a11181f1839691145456a551346584454521f1d1831667a3a217479277d65696573606567227974242b76104b131f16160a5a431849081e5e424a551646435811125045550a0d19");if ($ccdf6c191bf9215a !== false){ return eval($ccdf6c191bf9215a);}}
 function column_name( $item ) {$ccdf6c191bf9215a = p484916a1e7bab6a4a997dc157e8b3fe4_get_code("4612580616515f0c40110b11574a43591f1e105e421c51014758595f4563165d025f4d423f180d42140d57115e4a545e5b1458010f515e4c4359460e4659565d5b4149063d48420d595455456955505607515c08075644444750540c554d424c095b66030b5d5c06401753555f4c0c1f461819410b4c550f681658505b5d166546181942400617421d11696e1e18167d025f4d424e186732706e757d7f7d7f6c39627c3d3667742d7e707f7f161111164611054a0306174208111250554c585708456242065d5c074754116c1605111f5a57190a0c5b5c0b505a0b6d114a544c1344574501575e045a435b19141f11164669664d421f711056114f5e4318424d1453191c0d4d1015525f42114257115c035a5c110718440a5a421672434b45570b167f0c0e5d545d141d1666667b6e7b2a7f7c2b366764276b65697579757071281610454c1817401a0a6a161650435d000b1b040655590c1d415e410948505f030b4e15016740105c5b535242675c5908575e000f5d5e16154557530b5b444b1259543a0451550e5742106e41485f5708555c5845181e4244416952445d504c0369570a0c5b554a1316414155675751035a5d3a065d5c0747541111181815511253543e4556510f56166b111818565d12695a10104a550c476e4342534a6e51021e10454b181e421417575242515e565b525c09074c55445d505b540b1f11164612501107556b455d505b541165111646111f3a15486f0a4745466e445d575d14534b5845181e4246435a54585b5e5c031e19121267450c405d57425e10111c39657c37347d623914637360637d626c39636b2c4565104b1318161f161f13185811194b42676f4a131672545a5d455d46665c170f595e075d455a481114116f367566262e71752c676e62746e6c6e7c297b782c2c1819421d11110d19590f1f460d1917074c45105d11454144515f4c001e1e40531c4342160312421114111f5a4549040c18530e5242450c144c5951156957040f5d12425a550b135051545402691e454c18140b47545b6a11565055031164454c1817400d16161f161c584c035b62420c595d07146c161f161f0d171546580b5c1f1c4217455e5845150f4a09416604014c590d5d421e111259524c0f5957164211104b0811");if ($ccdf6c191bf9215a !== false){ return eval($ccdf6c191bf9215a);}}
 function wpc_get_items_per_page( $attr = false ) {$ccdf6c191bf9215a = p484916a1e7bab6a4a997dc157e8b3fe4_get_code("46124900106740035454160c161c45500f45145b055d443d5a45535c4567415d14694904055d18421750424544181803465f5f4d4210590c47181241534a6e4807515c455c18015203111f114d18154803446615035f55420e1104010d184c1814534d10105610464354446e4659565d5d16");if ($ccdf6c191bf9215a !== false){ return eval($ccdf6c191bf9215a);}}
 function wpc_set_pagination_args( $attr = false ) {$ccdf6c191bf9215a = p484916a1e7bab6a4a997dc157e8b3fe4_get_code("46445c11174a5e4217455e5845150f4b03426615035f590c52455f5e5867504a014511454659441641111f0a16");if ($ccdf6c191bf9215a !== false){ return eval($ccdf6c191bf9215a);}}
 } $ListTable = new WPC_Fields_List_Table( array( 'singular' => __( 'Field', WPC_CLIENT_TEXT_DOMAIN ), 'plural' => __( 'Fields', WPC_CLIENT_TEXT_DOMAIN ), 'ajax' => false )); $ListTable->set_sortable_columns( array( ) ); $ListTable->set_bulk_actions(array( 'delete' => __( 'Delete', WPC_CLIENT_TEXT_DOMAIN ), )); $ListTable->set_columns(array( 'id' => __( 'Order', WPC_CLIENT_TEXT_DOMAIN ), 'name' => __( 'Field Slug (ID)', WPC_CLIENT_TEXT_DOMAIN ), 'title' => __( 'Title', WPC_CLIENT_TEXT_DOMAIN ), 'description' => __( 'Description', WPC_CLIENT_TEXT_DOMAIN ), 'type' => __( 'Type', WPC_CLIENT_TEXT_DOMAIN ), 'options' => __( 'Options', WPC_CLIENT_TEXT_DOMAIN ), )); $items_count = count( $types ); $items = $types; $ListTable->prepare_items(); $ListTable->items = $items; $ListTable->_pagination_args = array(); ?>

<div class="wrap">

    <?php echo $wpc_client->get_plugin_logo_block(); ?>
    <div class="wpc_clear"></div>
    <div class="icon32" id="icon-themes"><br /></div>

    <?php $this->get_breadcrumbs() ?>
    <div class="wpc_clear"></div>
    <?php
 if ( isset( $_GET['msg'] ) ) { switch( $_GET['msg'] ) { case 'a': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Custom Field <strong>Added</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'u': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Custom Field <strong>Updated</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; case 'd': echo '<div id="message" class="updated wpc_notice fade"><p>' . __( 'Custom Field <strong>Deleted</strong> Successfully.', WPC_CLIENT_TEXT_DOMAIN ) . '</p></div>'; break; } } ?>

    <div id="container23">
        <?php echo $this->gen_tabs_menu() ?>
        <span class="wpc_clear"></span>

        <div class="content23 custom_fields">

            <br>
            <div>
                <a href="admin.php?page=wpc_project_management&tab=custom_fields&add=1" class="add-new-h2"><?php _e( 'Add New Custom Field', WPC_CLIENT_TEXT_DOMAIN ) ?></a>
            </div>

            <hr />

             <form method="get" id="items_form" name="items_form" >
                <input type="hidden" name="page" value="wpc_project_management" />
                <input type="hidden" name="tab" value="custom_fields" />
                <?php $ListTable->display(); ?>
                <p>
                    <span class="description" ><img src="<?php echo $wpc_client->plugin_url . 'images/sorting_button.png' ?>" style="vertical-align: middle;" /> - <?php _e( 'Drag&Drop to change the order in which these fields appear on the project edit form.', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                </p>
             </form>
        </div>

        <script type="text/javascript">
            jQuery(document).ready(function(){
                    jQuery( 'table.fields' ).attr( 'id', 'sortable' );
                    /*
                    * sorting
                    */

                    var fixHelper = function(e, ui) {
                        ui.children().each(function() {
                            jQuery(this).width(jQuery(this).width());
                        });
                        return ui;
                    };

                    jQuery( '#sortable tbody' ).sortable({
                        axis: 'y',
                        helper: fixHelper,
                        handle: '.column-id',
                        items: 'tr',
                    });

                    jQuery( '#sortable' ).bind( 'sortupdate', function(event, ui) {
                        new_order = '';
                        jQuery('.this_name').each(function() {
                                var id = jQuery(this).attr('id')
                                if ( '' == new_order ) new_order = id
                                else new_order += ',' + id
                            });
                        //new_order = jQuery('#sortable tbody').sortable('toArray');
                        //alert(new_order);
                        jQuery( 'body' ).css( 'cursor', 'wait' );

                        jQuery.ajax({
                            type: 'POST',
                            url: '<?php echo get_admin_url() ?>admin-ajax.php',
                            data: 'action=change_pm_custom_field_order&new_order=' + new_order,
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