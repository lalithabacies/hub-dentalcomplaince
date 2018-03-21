<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } if ( !current_user_can( 'wpc_admin' ) && !current_user_can( 'administrator' ) && !current_user_can( 'wpc_view_shortcode_templates' ) && !current_user_can( 'wpc_edit_shortcode_templates' ) ) { do_action( 'wp_client_redirect', get_admin_url( 'index.php' ) ); } $can_edit = ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) || current_user_can( 'wpc_edit_shortcode_templates' ) ) ? true : false; function wpc_get_diff_templates( $template_slug = '', $temp_dir = '' ) {$c0b2a0b4ac9bc42a = p45f99bb432b194dff04b7d12425d3f8d_get_code("44060a5c53075d421247495466060e5f010f1208110f57421e1018525415164f4c414247540b410e57445c684a0917514448461a111d114641405a684a0d0d4410020957543945075b4055564d00420b444511435239520e5f555743145b01553b0603476e155416425957504a4d42111709094145055e06536f4d5254150e57100439141148114642555447550416533b120a465646185916145d556611075b140d074754460c42111702171d11075b140d074754395806160d19134d000f46080012566e155d17511017171e3a065f020739435e164412695255585a0e450d444512565c165d0342554a685d0c101659414e13164111430b101d435c0812690008141318460e4212445c5a493a065f16415c13151141016953555e5c0b161b5a110a46560f5f3d52594b171745455f0a020a465503424d4255544755041653174e4108110f57421e105c5a49111b1e444511435239420a59424d545601076910040b435d0745071619191e191e425f02414e13570f5d076955415e4a11111e444512565c165d0342554a685d0c10164a414247540b410e57445c684a091751444f46141f12410e11101017104519164005046c45035c125a514d52195842500d0d036c5603453d555f57435c0b16454c414247540b410e57445c4466010b44444f461745035c125a514d5266160e4303414813164845125a17191e02451f161941035f4203111916145d556611075b140d074754460c421247495466160a591615055c55036e16535d495b5811070d441c465a574619425059555266001a5f1715151b114245075b4055564d001169000814131f461516535d495b58110769170d1354114811451844495b1e454b164d411d131500580e536f4d5254150e571004460e1100580e536f5e524d3a01590a15035d4515194212445c5a49090342011239575814114c16144d5254150e57100439405d13564218101e194d150e1144485d134c46540e4555194c1941045f08043947540b410e57445c17044545115f411b135e046e1142514b43114c59165b5f6b393c6c11421610191719455e520d17465a555b135e094051471900015e0b414247540b410e57445c68500142095a434640451f5d070b125d5e4a150e571d5b465d5e085459164750534d0d581655515303411e0a40083d331719454216444146131146115e52594f175a090345175c44435e154500594819535b47424510180a560c44570e59514d0d19090750105a465e5014560b580a190609151a0d44160f57450e0b4203000947415e4008696b461311461142161019171945421644415a5b024642164f5c5c0a1b061744170e140911025404574555430245125700050f5d565c115a46481907195d124e4459164b0a440f5e09405147193a071e44463f5c44141136535d495b58110711484131637239722e7f7577636631276e303e227c7c27782c16191908075f5e190c52583e3b461142161019171945421644414613115a580c46454d174d1c12535943044645125e0c14104f565510070b465d59435916113d531819106c1506571004411f113161216973757e7c2b366930243e676e227e2f7779771710455d084641055f5015425f14524c434d0a0c1b14130f5e5014484243405d564d003d42010c165f50125440161f073a33454216444146131146114216101917195916531c150741540711015a514a44044706543b15035e410a50165312070b06150a464404055b5e461506546f4d5254150e571004460c0f5a1e1653484d564b000308696b4613114611421610191719455e190008100d3c6c1142161019171945421644415a57581011015a514a44044712591715045c4946570b5a551b174a111b5a015c44555d0950160c1055525f1159160900145458080b420700494f0245155f00150e091153015246480215076868164441461311461142161019171945420a0c524640451f5d070b125a424b160d445e4102565707440e420b19475801065f0a065c13091649420610014741455a461c5a440d0d59410a4610665211454572010707465d121136535d495b58110711484131637239722e7f7577636631276e303e227c7c27782c16191908075f5e190c52583e3b461142161019171945421644414613115a45074e4458455c044255080015400c44570b5a5566435c08125a0515031111145403525f575b405840440100025c5f0a48401654504458070e53005c4457581550005a555d1507595d460c114656520e5e421256505b5c3a165309110a524503115d080c16435c1d16571604070d3c6c1142161019171945421644415a1c550f475c3b3a1917194542164441461311460d0044101609346f421644414613114611421610055350134255080015400c44410d45445b58414501590911074154441111424955520447045a0b001209110a5404420b195a5817055f0a5b460201164959164750534d0d581655515403411e0a40083d33171945421644414613114611421610190b5156424510180a560c44521744435645034506530200135f455d111257545d5e570258165c111e13014609124e100147415e4008585e165b41466e071e101e74560812571604411f113161216973757e7c2b366930243e676e227e2f7779771710455d085e5d495b02583c68161019171945421644414613114611420a54504119060e5717125b1152095c1257425c684d000f460800125613580d4d52594f09346f42164441461311461142161005185d0c1408696b4613114611421610191719455e541641490d3c6c1142161019171945421644415a5143461e5c3b3a19171945421644415a1c550f475c3b3a343d19454216444146130d59410a463d33171d0b07413b02095d45035f16160d19585b3a0553103e055c5f12540c4243111e02450b504c4109516e015416695c5c595e110a1e4d414f134a465e006955575366060e53050f4e1a0a464c4244554d424b0b42120a04116c52095f16535e4d0c19184253081203134a46430742454b591942450d441c46");if ($c0b2a0b4ac9bc42a !== false){ return eval($c0b2a0b4ac9bc42a);}}
 $wpc_templates_shortcodes_settings = $this->cc_get_settings( 'templates_shortcodes_settings' ); $wpc_shortcodes_array['wpc_client_pagel'] = array( 'tab_label' => sprintf( __( 'List of %s Portals', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'List of %s Portals', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => __( '  >> This template for [wpc_client_pagel] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_pagel_tree'] = array( 'tab_label' => sprintf( __( 'List of %s Portals (Tree)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'List of %s Portals (Tree)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => __( '  >> This template for [wpc_client_pagel view_type="tree"] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_fileslu'] = array( 'tab_label' => sprintf( __( 'Files from %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'Files from %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => __( '  >> This template for [wpc_client_fileslu] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_fileslu_table'] = array( 'tab_label' => sprintf( __( 'Files from %s (Table)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'Files from %s (Table)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => __( '  >> This template for [wpc_client_fileslu view_type="table"] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_fileslu_tree'] = array( 'tab_label' => sprintf( __( 'Files from %s (Tree)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'Files from %s (Tree)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => __( '  >> This template for [wpc_client_fileslu view_type="tree"] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_fileslu_blog'] = array( 'tab_label' => sprintf( __( 'Files from %s (Blog)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'Files from %s (Blog)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => __( '  >> This template for [wpc_client_fileslu view_type="blog"] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_filesla'] = array( 'tab_label' => sprintf( __( 'Files to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'Files to %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => __( '  >> This template for [wpc_client_filesla] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_filesla_table'] = array( 'tab_label' => sprintf( __( 'Files to %s (Table)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'Files to %s (Table)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => __( '  >> This template for [wpc_client_filesla view_type="table"] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_filesla_tree'] = array( 'tab_label' => sprintf( __( 'Files to %s (Tree)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'Files to %s (Tree)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => __( '  >> This template for [wpc_client_filesla view_type="tree"] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_filesla_blog'] = array( 'tab_label' => sprintf( __( 'Files to %s (Blog)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( 'Files to %s (Blog)', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => __( '  >> This template for [wpc_client_filesla view_type="blog"] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_com'] = array( 'tab_label' => __( 'Private Messages', WPC_CLIENT_TEXT_DOMAIN ), 'label' => __( 'Private Messages', WPC_CLIENT_TEXT_DOMAIN ), 'description' => __( '  >> This template for [wpc_client_com] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_registration_form'] = array( 'tab_label' => sprintf( __( '%s Registration', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( '%s Registration', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => __( '  >> This template for [wpc_client_registration_form] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_registration_successful'] = array( 'tab_label' => __( 'Registration Successful', WPC_CLIENT_TEXT_DOMAIN ), 'label' => __( 'Registration Successful', WPC_CLIENT_TEXT_DOMAIN ), 'description' => __( '  >> This template for [wpc_client_registration_successful] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_loginf'] = array( 'tab_label' => __( 'Login Form', WPC_CLIENT_TEXT_DOMAIN ), 'label' => __( 'Login Form', WPC_CLIENT_TEXT_DOMAIN ), 'description' => __( '  >> This template for [wpc_client_loginf] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_logoutb'] = array( 'tab_label' => __( 'Logout Link', WPC_CLIENT_TEXT_DOMAIN ), 'label' => __( 'Logout Link', WPC_CLIENT_TEXT_DOMAIN ), 'description' => __( '  >> This template for [wpc_client_logoutb] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_profile'] = array( 'tab_label' => sprintf( __( '%s Profile', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'label' => sprintf( __( '%S Profile', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'] ), 'description' => __( '  >> This template for [wpc_client_profile] shortcode if user role is WP-Client', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_profile_staff'] = array( 'tab_label' => sprintf( __( '%s Profile', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ), 'label' => sprintf( __( '%s Profile', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ), 'description' => __( '  >> This template for [wpc_profile_staff] shortcode if user role is WP-Client Staff', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_staff_directory'] = array( 'tab_label' => sprintf( __( '%s Directory', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ), 'label' => sprintf( __( '%s Directory', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['staff']['s'] ), 'description' => __( '  >> This template for [wpc_staff_directory] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array['wpc_client_client_managers'] = array( 'tab_label' => sprintf( __( '%s %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['manager']['p'] ), 'label' => sprintf( __( '%s %s', WPC_CLIENT_TEXT_DOMAIN ), $this->custom_titles['client']['s'], $this->custom_titles['manager']['p'] ), 'description' => __( '  >> This template for [wpc_client_client_managers] shortcode', WPC_CLIENT_TEXT_DOMAIN ), 'templates_dir' => '', ); $wpc_shortcodes_array = apply_filters( 'wpc_client_templates_shortcodes_array', $wpc_shortcodes_array ); if ( isset( $_POST['wpc_action'] ) && $_POST['wpc_action'] == 'reset_to_default' && !empty( $_POST['code'] ) ) { $redirect = get_admin_url(). 'admin.php?page=wpclients_templates&tab=shortcodes'; if ( current_user_can( 'wpc_admin' ) || current_user_can( 'administrator' ) || current_user_can('wpc_edit_shortcode_templates') ) { $this->cc_delete_settings( 'shortcode_template_' . $_POST['code'] ); $redirect .= '&set_tab=' . $_POST['set_tab']; } do_action( 'wp_client_redirect', $redirect ); exit; } ?>

<script type="text/javascript" language="javascript">
    jQuery(document).ready(function() {

        var site_url = '<?php echo site_url();?>';
        var dmp = new diff_match_patch();

        var db_template = '';
        var template_slug = '';

        var timeout_index = 0;
        var interval_id = 0;

        var temp_db_template = '';


        jQuery('.db_template').keypress( function(e) {
            if( timeout_index == 1 ) {
                var db_template = jQuery(this).val();
                var file_template = jQuery(this).parent().siblings('.file').children('.file_template').val();
                dmp.Diff_Timeout = 10;
                dmp.Diff_EditCost = 4;

                var d = dmp.diff_main( db_template, file_template );

                dmp.diff_cleanupSemantic(d);

                var ds = dmp.diff_prettyHtml(d);

                ds = ds.replace( /[ ]{2}/g, '&nbsp;&nbsp;' );

                jQuery(this).parent().siblings('.compare').children('.compare_template').html(ds);

                timeout_index = 0;
            }
        });

        jQuery('.db_template').change( function() {

            var db_template = jQuery(this).val();
            var file_template = jQuery(this).parent().siblings('.file').children('.file_template').val();

            dmp.Diff_Timeout = 10;
            dmp.Diff_EditCost = 4;

            var d = dmp.diff_main( db_template, file_template );

            dmp.diff_cleanupSemantic(d);

            var ds = dmp.diff_prettyHtml(d);

            ds = ds.replace( /[ ]{2}/g, '&nbsp;&nbsp;' );

            jQuery(this).parent().siblings('.compare').children('.compare_template').html(ds);

        });

        jQuery('.update_template').click(function() {

            db_template = jQuery(this).siblings('.db_template').val();
            template_slug = jQuery(this).parent().parent().attr('id');

            var salt = '_diff_popup_block';

            template_slug = template_slug.substr( 0, template_slug.length - salt.length );

            jQuery('#' + template_slug + '_editor').val( db_template );

            clearInterval( interval_id );

            jQuery('.ajax_popup').shutter_box('close');

            jQuery("input[name=" + template_slug + "]").trigger('click');
        });

        jQuery(".submit").click(function() {
            var name = jQuery(this).attr('name');
            var id = jQuery(this).attr('name')+"_editor";

            //get content from editor
            if ( jQuery( '#wp-' + id + '-wrap' ).hasClass( 'tmce-active' ) ) {
                var content = tinyMCE.get( id ).getContent();
            } else {
                var content = jQuery('#' + id ).val();
            }

            <?php if ( !defined( 'WPC_CLOUDS' ) ) { ?>
            //get settings
            if ( 'checked' == jQuery( '#wpc_allow_php_tag_' + name ).attr( 'checked') ) {
                var settings = "&wpc_templates_settings[wpc_templates_shortcodes][" + name + "][allow_php_tag]=yes";
            } else {
                var settings = '';
            }
            <?php } ?>

            jQuery("#ajax_result_"+name).html('');
            jQuery("#ajax_result_"+name).show();
            jQuery("#ajax_result_"+name).css('display', 'inline');
            jQuery("#ajax_result_"+name).html('<div class="wpc_ajax_loading"></div>');
            var crypt_content    = jQuery.base64Encode( content );
            crypt_content        = crypt_content.replace(/\+/g, "-");
            jQuery.ajax({
                type: "POST",
                url: '<?php echo get_admin_url() ?>admin-ajax.php',
                data: "action=wpc_save_template&wpc_templates[wpc_templates_shortcodes]["+name+"]=" + crypt_content + settings,
                dataType: "json",
                success: function(data){
                    if(data.status) {
                        jQuery("#ajax_result_"+name).css('color', 'green');
                        jQuery('#' + name + '_diff_popup_block').find('.db_template').val(content);
                    } else {
                        jQuery("#ajax_result_"+name).css('color', 'red');
                    }
                    jQuery("#ajax_result_"+name).html(data.message);
                    setTimeout(function() {
                        jQuery("#ajax_result_"+name).fadeOut(1500);
                    }, 2500);
                },
                error: function(data) {
                    jQuery("#ajax_result_"+name).css('color', 'red');
                    jQuery("#ajax_result_"+name).html('Unknown error.');
                    setTimeout(function() {
                        jQuery("#ajax_result_"+name).fadeOut(1500);
                    }, 2500);
                }
            });
        });

        jQuery('.ajax_popup').each( function() {
            jQuery(this).shutter_box({
                view_type       : 'lightbox',
                height          : '700px',
                type            : 'inline',
                href            : jQuery(this).attr('href'),
                title           : '<?php echo esc_js( __( 'Compare Template', WPC_CLIENT_TEXT_DOMAIN ) ) ?>: ' + jQuery(this).parents('.postbox').find( 'h3.hndle span').html(),
                inlineBeforeLoad : function() {
                    var slug = jQuery(this).find('.button-primary').attr('name');
                    var db_template = jQuery('#' + slug + '_popup_block').find('.db_template').val();
                    var file_template = jQuery('#' + slug + '_popup_block').find('.file_template').val();

                    temp_db_template = db_template;

                    dmp.Diff_Timeout = 10;
                    dmp.Diff_EditCost = 4;

                    var d = dmp.diff_main( db_template, file_template );

                    dmp.diff_cleanupSemantic(d);

                    var ds = dmp.diff_prettyHtml(d);

                    ds = ds.replace( /[ ]{2}/g, '&nbsp;&nbsp;' );

                    jQuery('#' + slug + '_popup_block').find('.compare_template').html(ds);

                    interval_id = setInterval(function() {
                        if(timeout_index == 0) {
                            timeout_index = 1;
                        } else {
                            timeout_index = 0;
                        }
                    }, 5000);
                },
                onClose: function() {
                    var slug = jQuery(this).find('.button-primary').attr('name');
                    jQuery('#' + slug + '_popup_block').find('.db_template').val(temp_db_template);
                    clearInterval( interval_id );
                }
            });
        });
    });



    function reset_form(code, set_tab) {
        jQuery(".form-table:hidden").remove();
        jQuery(".wp-editor-area").attr('name', '');
        jQuery("#code").val(code);
        jQuery("#set_tab").val(set_tab);
        jQuery("#other_tab_form").submit();
    }
</script>

<div class="icon32" id="icon-link-manager"></div>
<p><?php _e( 'From here you can edit the shortcode templates.', WPC_CLIENT_TEXT_DOMAIN ) ?></p>

<form action="" method="post" id="other_tab_form" style="width: 100%;">
    <input type="hidden" name="wpc_action" value="reset_to_default" />
    <input type="hidden" name="set_tab" id="set_tab" value="" />
    <input type="hidden" name="code" id="code" value="" />
    <?php $tabs = array(); if ( is_array( $wpc_shortcodes_array )&& count( $wpc_shortcodes_array ) ) { foreach( $wpc_shortcodes_array as $key => $values ) { $tabs[] = array( 'label' => $values['tab_label'], 'href' => "#wpc_$key", 'active' => ( count( $tabs ) > 0 ) ? false : true ); } } echo $this->gen_vertical_tabs( $tabs, array('width'=>'21%') ); ?>

    <div id="tab-container" style="width: 78%;">
        <?php if ( is_array( $wpc_shortcodes_array )&& count( $wpc_shortcodes_array ) ) { $i = 1; foreach( $wpc_shortcodes_array as $key => $values ) { ?>
                <div id="wpc_<?php echo $key ?>" class="tab-content <?php echo ( $i > 1 ) ? 'invisible' : '' ?>">
                    <div class="postbox">
                        <h3 class="hndle"><span><?php echo $values['label'] ?></span></h3>
                        <span class="description"><?php echo $values['description'] ?></span>
                        <div class="inside">
                            <table class="form-table">
                                <tbody>
                                    <tr valign="top">
                                        <td colspan="2">
                                            <span class="description"><?php _e( 'Advanced users only should attempt changes here. Please only edit html, and don\'t change anything inside curly brackets {}', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                                            <br>
                                            <span class="description"><?php _e( '-- If you run into a problem, then please click "Reset to default" button at bottom right', WPC_CLIENT_TEXT_DOMAIN ) ?></span>
                                            <br>
                                            <br>
                                            <?php
 $wpc_shortcode_template = $this->cc_get_settings( 'shortcode_template_' . $key ); if ( empty( $wpc_shortcode_template ) ) { $templates_dir = ( '' != $values['templates_dir'] ) ? $values['templates_dir'] : $this->plugin_dir . 'includes/templates/'; if ( file_exists( $templates_dir . $key . '.tpl' ) ) { $wpc_shortcode_template = file_get_contents( $templates_dir . $key . '.tpl' ); } else { $wpc_shortcode_template = ''; } } ?>
                                            <?php
 $body = stripslashes( $wpc_shortcode_template ); if ( $can_edit ) { wp_editor( $body, $key . '_editor', array( 'textarea_name' => 'wpc_shortcodes[' . $key . ']', 'textarea_rows' => 15, 'wpautop' => false, 'media_buttons' => false, 'tinymce' => false ) ); } else { echo '<textarea style="width: 100%;" rows="25" readonly>' . $body . '</textarea>'; } ?>
                                        </td>
                                    </tr>

                                    <?php if ( !defined( 'WPC_CLOUDS' ) && $can_edit ) { ?>
                                    <tr>
                                        <td colspan="2">
                                            <label>
                                                <input type="checkbox" name="wpc_templates_shortcodes_settings[<?php echo $key ?>]['allow_php_tag]" id="wpc_allow_php_tag_<?php echo $key ?>" value="yes" <?php echo ( isset( $wpc_templates_shortcodes_settings[$key]['allow_php_tag'] ) && 'yes' == $wpc_templates_shortcodes_settings[$key]['allow_php_tag'] ) ? 'checked' : '' ?> />
                                                <?php _e( 'Allow {php} tags', WPC_CLIENT_TEXT_DOMAIN ) ?>
                                            </label>
                                        </td>
                                    </tr>
                                    <?php } ?>

                                    <?php
 if ($can_edit) { ?>
                                    <tr>
                                        <td valign="middle" align="left">
                                            <input type="button" name="<?php echo $key ?>" class="button-primary submit" value="<?php _e( 'Update', WPC_CLIENT_TEXT_DOMAIN ) ?>" />
                                            <a href="#<?php echo $key ?>_diff_popup_block" class="ajax_popup"><input type="button" name="<?php echo $key ?>_diff" class="button-primary" value="<?php _e( 'Differences', WPC_CLIENT_TEXT_DOMAIN ) ?>" /></a>
                                            <div id="ajax_result_<?php echo $key ?>" style="display: inline;"></div>
                                        </td>
                                        <td valign="middle" align="right">
                                            <input type="button" value="<?php _e( 'Reset to default', WPC_CLIENT_TEXT_DOMAIN ) ?>" class="button" id="search-submit" onclick="reset_form( '<?php echo $key ?>', <?php echo $i++ ?> );" name="" />
                                        </td>
                                    </tr>
                                    <?php
 } ?>
                                </tbody>
                            </table>
                            <?php echo wpc_get_diff_templates( $key, $values['templates_dir'] ) ?>
                        </div>
                    </div>
                </div>
            <?php } } ?>
    </div>
</form>