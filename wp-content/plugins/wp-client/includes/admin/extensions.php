<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } $output = ''; $error = ''; $msg = ''; if ( isset( $_GET['msg'] ) ) { $msg = $_GET['msg']; } function wpc_get_extensions() {$c788948bd8998d29 = p45f99bb432b194dff04b7d12425d3f8d_get_code("44060a5c53075d42124749535b5e4212011912565f15580d5843190a1904104405184e1a0a465804161819535c030b5801054e1316227e2f77797768742432662d2f2114114f114b164b19134c170e16594142444102534f08575c43661303444c414460742a7421621056474d0c0d583b17075f44031124647f74174241154600034b0d411454045f48445849110b590a12466479236327165f4943500a0c690a000b56115b114545594d524c170e1146414f08111b11075a435c1742454643160d460e11015416695255585e0c0c500b494446430a134b0d1044171d150d4510070f565d02423914515a43500a0c1439415b1316114103434451685c1d16530a120f5c5f156e1053434958571607115f4142435e1545045f5555534a3e4046160e024652126e0346591b6a195842510115395c4112580d58181910495157505d5804510555030007090d535f035202065602020352035752035f0f5d3a12440b051350453950125f17191e024546460b12125558035d06456b1b535608035f0a433b130c4642164444565b561207444c4113415d035f0159545c1f191716440d0c4e131513430e1a101b181b454b164d414f081142410d45445f5e5c0906453f43045f5e016e0b5212641704450553103e05464314540c426f5b5b56023d5f00494f081142410d45445f5e5c0906453f430a5a52035f11536f4a565511406b445c465e5553194277726a6778312a164a4122716e2e7e31621017177d273d78252c23131f46151259434d5150000e52173a44515d09563d5f541b6a194c591640110940450058075a544a6c1b13074417433b130c461350140b19134b0011460b0f1556115b1115466f4b52540a16533b110940454e11405e444d474a5f4d19130404435e1445035a5848195a0a0f1913114b52550b580c19515d5a500b4f570e001e1d410e41401a1058454b041b1e44460b56450e5e0611100409194232793735411f1141450b5b5556424d42420b5a4152061d461610535450455c06165f0b0f41130c5811571a101e5f4d1112400113155a5e0816420b0e1910084b5211484141515d0952095f5e5e1019585c16101313561d461611455c4f524b0c044f43415b0d1100500e455515171e0d07570004144016460c5c16514b45581c4a1f484141515e024845160d07171d150d4510070f565d02424e16175a58560e0b531746460e0f4650104451401f10454b164d5a465a574619425f436640493a0744160e141b11424307454056594a00421f444846481103520a59101d455c1612590a12031e0f01541669554b4556173d5b011215525603194b0d105c4f501159161941035f4203111916145d564d04420b4445145642165e0c4555021744450b504449461215025016576b1e5556011b1139414f134a46550b531819107c17105916415703005600520717191e02451f1640000840460343420b105344560b3d5201020957544e114652514d56624200590018416e114f0a425f56191f190c114501154e1315075f1141554b1a0716175507041540114f114410101d5657161553164c5840440552074543191e191e4212011912565f15580d5843190a19100c4501130f525d0f4b071e101d5657161553164c58564912540c455956594a454b0d441203476e1243035843505257114a16431616506e034916535e4a5e560b1111484142564912540c455956594a4942005451461a0a464c4244554d424b0b4212011912565f15580d58430217");if ($c788948bd8998d29 !== false){ return eval($c788948bd8998d29);}}
 function wpc_extensions_actions( $extensions ) {$c788948bd8998d29 = p45f99bb432b194dff04b7d12425d3f8d_get_code("444508130c4616450d101d52411107581708095d115b114669777c636242074e1004084058095f456b0b195e5f454a1613113945541458044f6f57585706071e4445397474326a4569474959560b0153433c4a1316114101695541435c0b115f0b0f39141148114669777c63624203551008095d163b114c16145c4f4d000c450d0e08131f465607426f5a424b170758103e134054146e0b5218101710454b161f4115445812520a1e101d687e20366d4300054758095f456b10101742450157170446145005450b40514d521e5f425f02414e13100f423d465c4c50500b3d5707150f45544e114653484d5257160b590a414f1318464a4212425c444c09161659410750450f4703425566475510055f0a494617541e45075843505857454b0d4408001319465811694749685c17105916494617430342175a44191e194c424d4408001319461617585541475c061653003e0946451644161110040a1941105317140a471c585607426f5c454b0a1069070e0256194f114b164b19135c17105916415b1315145411435c4d1a070207423b0414415e146e065744581f105e424b44040a4054464a4212554b455617420b4445145642135d160d1044174445075a1704464811025e3d57534d5e560b4a11131139505d0f540c426f4b525d0c10530715411f1101541669515d5a500b3d43160d4e1a1f461603525d505917150a465b110754545b4612555c505257111169011912565f15580d58431f5a4a025f5743414f081103490b420b194a19184253081203134a46150c160d19105704450d441c4651430350090d105a564a00421100040750450f470342551e0d190c04164c410f406e165d17515957685806165f12044e1315034916535e4a5e560b421f44484648110254035544504158110769140d13545808424a16145c4f4d000c450d0e0813185d1106596f58544d0c0d584c4611436e055d0b535e4d684b00065f16040547164a1105534466565d080b583b14145f194f1f4211515d5a500b4c460c1159435001545f41405a5b50000c42173e034b45035f115f5f57441f08115159054113185d11074e594d0c19184253081203134a46150c160d19105701450d441c4651430350090d105a564a0042110d0f1547500a5d450c105051194d425f17120347194615074e445c594a0c0d58173a42564912540c45595659643e45520b16085f5e07553d5a59575c1e38421f44484648110f5f015a455d52660a0c5501412771623670367e1017171e12121b05050b5a5f49580c555c4c535c164d55080015401c11414f43405e45580107444a110e43165d115d083d3317194542164441461311461142161019171945420a0008101358020c405b554a44580207054641055f5015425f1445495358110752441616506e085e165f535c175f040653465f6b3911461142161019171945421644414613114611420a0f495f4968681640141654430755074410041757001516340d135458086e3746574b565d00101e4d5a4617430342175a44190a194117460313075754141c5c5f5e4a4358090e1e4445034b45035f115f5f57446241074e1004084058095f3f6d175d584e0b0e590505395f58085a456b10100c195a5c3b6e41461311461142161019171945421644414613115a1e065f46073a3345421644414613114611421610191719454216445d1550430f4116164440475c5840420119121c5b07470345534b5e49114008696b46131146114216101917194542164441461311461142161053664c00104f4c41025c52135c075844191e1717075700184e1357135f0142595659114c424d696b4613114611421610191719454216444146131146114216101917194508671104144a194616415b554a4458020705444f0f505e080250111010194b000f5912044e1a0a6b3b4216101917194542164441461311461142161019171945421644414659601354104f1819101a080745170001560246415850594b444d42421f4a13035e5e10544a1f0b343d346f4216444146131146114216101917194542164441461311464c4b0d3d3317194542164441461311461142161019171945420a4b1205415816455c3b3a19171945421644414613114611421610191719455e091409163e3b465804161819134b0011430815461a111d114644554a425511420b4400054758105016536f495b4c020b584c4142564912540c45595659194c59160d07461b110f423d414066524b170d444c4142415415440e42101017104519160d07461b1141440c534849525a1107523b0e134741134545160d04171d170745110d121e0f01541669554b4556173d550b05031b184618424d101d524b170d44445c4617430342175a4414095e0016690113145c433955034251111e02451f16010d1556111d114653424b584b455f1640130340440a4559164d194a19000e4501411d1355096e0355445058574d4541143e055f58035f1669425c535017075510464a135603453d5754545e573a174408494f1d114150065b595719490d1209140001560c1141015a595c594d163d531c15035d420f5e0c451654445e58031144485d13541e58160d1044174445074e0d155d134c4653105351520c190603450141414641025016531703171d06174416040847115b110553446644501107691013075d420f540c421819104c150657100439435d13560b58431e17105e425f02414e1358154207421819135a101044010f121e0f145411465f57445c3e4212011912565f15580d5810641710454b161f4142525212581457445c1704454a160d1239435d13560b586f58544d0c14534c4142564912540c45595659194c421f445e4647431354420c105f565516070d440503525212581457445c68490917510d0f151b1142541a42555744500a0c164d5a465a5f055d175255665857060716252335637032794218101e40494803520908081c5808520e43545c4416060e5717124b44414b4412514258535c174c460c11410811590f6f3c101917194542164441461311461142161019171959065f12410f570c445c07454358505c564016070d0740425b1317465458435c0142411402395d5e12580153105f565d004008696b46131146114216101917194542164441461311460d5d4658493a3345464314061452550343420b1057524e45325a11060f5d6e33410544515d524b4d4b0d4445134356145006534214094c1505440505031b1142541a42555744500a0c164d5a460c0f6b3b42161019171945421644414613114611421610190b16010b405a6c6c13114611421610191719454216444146131146115e45534b5e491142421d11030e1312541a421f53564f0411551608164713583c681610191719454216444146131146114216101917194542160e301356431f1942525f5a4254000c42444848415407551b1e105f425706165f0b0f4e1a111d3c68161019171945421644414613114611421610191719454216444146135b374407444911171e460f53171207545455114c5f5356590a5745164d4f14565c0947071e19023a33454216444146131146114216101917194542164441461311461142165a68425c171b1e4446455e5415420351550a17495f045f16121214114f1f10535d56415c4d4b0d696b6b39114611421610191719454216444146131146114216101917444c593b6e41461311461142161019171945421644414613115a1e11554250474d5b6f3c44414613114611421610191719454216444146130d59410a463d331744450b50444946175005450b40514d52194c424d4445145642135d16160d19565a110b400515036c410a44055f5e11171d001a42010f155a5e08114b0d105051194d425f173e11436e034310594211171d170745110d1213184618424d105051194d4211110f034b41035216535466584c1112431046460e0c46151053434c5b4d485c510115395643145e10695356535c4d4b164d411d13150343105942190a1941105317140a471c585607426f5c454b0a106900001252194f0a424b105c5b4a00424d44450341430943420b101d455c16175a105a464e111b111f16524b52580e591619411b13540a4207164b1953563a03551008095d194146126953555e5c0b16691604025a43035216111c19505c113d57000c0f5d6e13430e1e1917171e04065b0d0f484359160e1257575c0a4e15015a0d0408474239541a42555744500a0c4543414f081103490b420b194a19");if ($c788948bd8998d29 !== false){ return eval($c788948bd8998d29);}}
 $extensions = get_transient( 'wpc_extensions' ); $old_extensions_keys = array(); if( false !== get_option( 'p45f99bb432b194dff04b7d12425d3f8d_extensions_count_diff' ) ) { if ( !empty( $extensions ) ) { $old_extensions_keys = array_keys( $extensions ); } $extensions = wpc_get_extensions(); delete_option( 'p45f99bb432b194dff04b7d12425d3f8d_extensions_count_diff' ); } else { if ( !$extensions ) { $extensions = wpc_get_extensions(); } } if ( isset( $_GET['action'] ) && isset( $_GET['extension'] ) && '' != $_GET['extension'] ) { wpc_extensions_actions( $extensions ); } ?>

<div class='wrap'>

    <?php echo $this->get_plugin_logo_block() ?>

    <div class="wpc_clear"></div>

    <div id="message" class="updated wpc_notice fade" <?php echo ( isset( $_GET['msg'] ) && ( 't' == $_GET['msg'] || 'f' == $_GET['msg'] ) ) ? '' : ' style="display: none;"'; ?>>
        <p>
            <?php
 if( isset( $_GET['msg'] ) && 't' == $_GET['msg'] ) { _e( 'Import was successful', WPC_CLIENT_TEXT_DOMAIN ); } elseif( isset( $_GET['msg'] ) && 'f' == $_GET['msg'] ){ _e( 'Invalid *.xml file', WPC_CLIENT_TEXT_DOMAIN ); } ?>
        </p>
    </div>

    <div class="icon32" id="icon-options-general"></div>
    <h2><?php printf( __( '%s Extensions', WPC_CLIENT_TEXT_DOMAIN ), $this->plugin['title'] ) ?></h2>

    <p><?php printf( __( '%s uses Extensions to expand the functionality of the plugin. These can be installed/activated as you have the need for them.', WPC_CLIENT_TEXT_DOMAIN ), $this->plugin['title'] ) ?></p>
    <p><?php _e( "To begin the installation, click Install. You will then need to Activate the Extension, and enter the Extension's unique API Key.", WPC_CLIENT_TEXT_DOMAIN ) ?></p>



<?php if ( '' != $error) { ?>
    <div id="message" class="error wpc_notice fade"><p><b><?php _e( 'The Extension generated unexpected output:', WPC_CLIENT_TEXT_DOMAIN ) ?></b></p><p><?php echo $error ?></p></div>
<?php } ?>


<?php if ( '' != $msg ) { ?>
    <div id="message" class="updated wpc_notice fade">
        <p>
        <?php
 switch( $msg ) { case 'a': echo __( 'Extension activated.', WPC_CLIENT_TEXT_DOMAIN ); break; case 'na': echo __( 'Extension not activated.', WPC_CLIENT_TEXT_DOMAIN ); break; case 'd': echo __( 'Extension deactivated.', WPC_CLIENT_TEXT_DOMAIN ); break; case 'nd': echo __( 'Extension not deactivated', WPC_CLIENT_TEXT_DOMAIN ); break; } ?>
        </p>
    </div>
<?php } ?>

    <form method="post" action="" class="wpc_extensions">
        <table cellspacing="0" class="widefat fixed">
            <thead>
            <tr>
                <th class="manage-column column-c" scope="col" width="10">&nbsp;</th>
                <th class="manage-column column-name" scope="col"><?php _e( 'Extension Name', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                <th class="manage-column column-name" scope="col" width="700"><?php _e( 'Description', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                <th class="manage-column column-active" scope="col"><?php _e( 'Active', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
            </tr>
            </thead>

            <tfoot>
            <tr>
                <th class="manage-column column-c" scope="col">&nbsp;</th>
                <th class="manage-column column-name" scope="col"><?php _e( 'Extension Name', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                <th class="manage-column column-name" scope="col"><?php _e( 'Description', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                <th class="manage-column column-active" scope="col"><?php _e( 'Active', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
            </tr>
            </tfoot>
            <tbody>
                <?php
 if ( isset( $extensions ) && count( $extensions ) ) { $update_plugins = get_site_transient( 'update_plugins' ); foreach( $extensions as $key => $extension ) { if ( empty( $extension['title'] ) ) { continue; } $active = ( is_plugin_active( $key ) ) ? true : false; $download = ( !file_exists( WP_PLUGIN_DIR . '/' . $key ) ) ? true : false; $update = ( isset( $update_plugins->response[$key] ) ) ? true : false; $paid = $extension['can_install']; ?>

                        <tr valign="middle" class="alternate" id="plugin-<?php echo $key ?>">
                            <td class="column-c" valign="bottom">
                                <input type="checkbox" value="" disabled <?php echo ( $active ) ? 'checked' : '' ?>  />
                            </td>
                            <td class="column-name">
                                <?php if( !empty( $old_extensions_keys ) && !in_array( $key, $old_extensions_keys ) ) { echo '<span style="color:#d54e21;font-weight: bold;margin-right: 5px;float:left;display:block;">' . __( 'NEW', WPC_CLIENT_TEXT_DOMAIN ). '</span>'; } ?>

                                <?php echo '<strong style="float:left;display:block;">' . esc_html( $extension['title'] ) . '</strong>' ?>

                                <div class="actions" style="float: left;width:100%;">
                                <?php if ( $paid && $download ) { ?>
                                    <span class="edit install">
                                        <a href="admin.php?page=wpclients_extensions&action=install&extension=<?php echo $key ?>&_wpnonce=<?php echo wp_create_nonce( 'wpc_extension_install' . $key . get_current_user_id() ) ?>"> <?php _e( 'Install', WPC_CLIENT_TEXT_DOMAIN ) ?></a>
                                    </span>
                                <?php } elseif( !$paid && isset( $extension['details_link'] ) && !empty( $extension['details_link'] ) ) { ?>
                                    <span class="edit details">
                                        <a target="_blank" href="<?php echo $extension['details_link'] ?>"> <?php _e( 'Details', WPC_CLIENT_TEXT_DOMAIN ) ?></a>
                                    </span>
                                <?php } elseif( $paid ) { ?>

                                    <?php if ( $active ) { ?>
                                        <span class="edit deactivate">
                                            <a href="admin.php?page=wpclients_extensions&action=deactivate&extension=<?php echo $key ?>&_wpnonce=<?php echo wp_create_nonce( 'wpc_extension_deactivate' . $key . get_current_user_id() ) ?>"> <?php _e( 'Deactivate', WPC_CLIENT_TEXT_DOMAIN ) ?></a>
                                        </span>
                                    <?php } else { ?>
                                        <span class="edit activate">
                                            <a href="admin.php?page=wpclients_extensions&action=activate&extension=<?php echo $key ?>&_wpnonce=<?php echo wp_create_nonce( 'wpc_extension_activate' . $key . get_current_user_id() ) ?>"> <?php _e( 'Activate', WPC_CLIENT_TEXT_DOMAIN ) ?></a>
                                        </span>
                                    <?php } ?>

                                    <?php if ( $update ) { ?>
                                        <span class="edit update">
                                            | <a href="admin.php?page=wpclients_extensions&action=update&extension=<?php echo $key ?>&_wpnonce=<?php echo wp_create_nonce( 'wpc_extension_update' . $key . get_current_user_id() ) ?>"> <?php _e( 'Update', WPC_CLIENT_TEXT_DOMAIN ) ?></a>
                                        </span>
                                    <?php } ?>

                                <?php } ?>
                                </div>

                            </td>
                            <td class="column-c" valign="bottom" align="justify">
                                <div class="wpc_extension_description">
                                    <?php
 if ( !empty( $extension['description'] ) ) { echo esc_html( $extension['description'] ); } if( $extension['can_install'] ) { ?>
                                    <br />
                                    <br />
                                    <strong><?php _e( 'API Key:', WPC_CLIENT_TEXT_DOMAIN ) ?></strong>
                                    <?php echo $extension['api_key'] ?>
                                    <br />
                                    <br />
                                    <?php } ?>
                                </div>
                            </td>

                            <td class="column-active">
                                <?php
 if ( $active ) { echo "<strong>" . __( 'Active', WPC_CLIENT_TEXT_DOMAIN ) . "</strong>"; } else { _e( 'Inactive', WPC_CLIENT_TEXT_DOMAIN ); } ?>
                            </td>
                        </tr>
                        <?php
 } } else { ?>
                    <tr valign="middle" class="alternate" >
                        <td colspan="4" scope="row" align="center"><?php _e( 'No Extensions were found for this install.', WPC_CLIENT_TEXT_DOMAIN ); ?></td>
                    </tr>
                    <?php
 } ?>
            </tbody>
        </table>
    </form>

</div>