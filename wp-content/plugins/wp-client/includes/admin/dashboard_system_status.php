<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } global $wpdb; if ( isset( $_GET['wpc_custom_trigger'] ) && 'change_permalink' == $_GET['wpc_custom_trigger'] ) { global $wp_rewrite; $wp_rewrite->set_permalink_structure( '/%postname%/' ); flush_rewrite_rules(); } ?>
<table width="70%" style="float: left;">
    <tr>
        <td valign="top">
            <table class="wc_status_table widefat" cellspacing="0">
                <thead>
                    <tr>
                        <th colspan="2"><?php _e( 'Environment', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><?php _e( 'Home URL', WPC_CLIENT_TEXT_DOMAIN ) ?>:</td>
                        <td style="width: 75%;"><?php echo home_url() ?></td>
                    </tr>
                    <tr>
                        <td><?php _e( 'Site URL', WPC_CLIENT_TEXT_DOMAIN ) ?>:</td>
                        <td><?php echo site_url() ?></td>
                    </tr>
                    <tr>
                        <td><?php _e( 'WP Version', WPC_CLIENT_TEXT_DOMAIN ) ?>:</td>
                        <td><?php echo ( is_multisite() ) ? 'WPMU' : 'WP' ?> <?php bloginfo( 'version' ) ?></td>
                    </tr>
                    <tr>
                        <td><?php _e( 'WPC Version', WPC_CLIENT_TEXT_DOMAIN ) ?>:</td>
                        <td><?php echo esc_html( WPC_CLIENT_VER ) ?></td>
                    </tr>
                    <tr>
                        <td><?php _e( 'Web Server Info', WPC_CLIENT_TEXT_DOMAIN ) ?>:</td>
                        <td><?php echo esc_html( $_SERVER['SERVER_SOFTWARE'] ) ?></td>
                    </tr>
                    <tr>
                        <td><?php _e( 'PHP Version', WPC_CLIENT_TEXT_DOMAIN ) ?>:</td>
                        <td><?php if ( function_exists( 'phpversion' ) ) echo esc_html( phpversion() ) ?></td>
                    </tr>
                    <tr>
                        <td><?php _e( 'MySQL Version', WPC_CLIENT_TEXT_DOMAIN ) ?>:</td>
                        <td><?php echo esc_html( $wpdb->db_version() ) ?></td>
                    </tr>
                    <tr>
                        <td><?php _e( 'WP Memory Limit', WPC_CLIENT_TEXT_DOMAIN ) ?>:</td>
                        <td>
                        <?php
 $memory = wp_client_let_to_num( WP_MEMORY_LIMIT ); if ( $memory < 67108864 ) { echo sprintf( __( '%s - We recommend setting memory to at least 64 MB. See: <a href="%s" target="_blank">Increasing memory allocated to PHP</a>', WPC_CLIENT_TEXT_DOMAIN ), size_format( $memory ), 'http://codex.wordpress.org/Editing_wp-config.php#Increasing_memory_allocated_to_PHP' ); } else { echo size_format( $memory ); } ?>
                        </td>
                    </tr>
                    <tr>
                        <td><?php _e( 'WP Debug Mode', WPC_CLIENT_TEXT_DOMAIN ) ?>:</td>
                        <td><?php echo ( defined( 'WP_DEBUG' ) && WP_DEBUG ) ? __( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) : __( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                    </tr>
                    <tr>
                        <td><?php _e( 'WP Max Upload Size', WPC_CLIENT_TEXT_DOMAIN ) ?>:</td>
                        <td><?php echo size_format( wp_max_upload_size() ) ?></td>
                    </tr>

                    <tr>
                        <td><?php _e( 'WP Multisite',WPC_CLIENT_TEXT_DOMAIN ) ?>:</td>
                        <td><?php echo ( is_multisite() ) ? __( 'Enabled', WPC_CLIENT_TEXT_DOMAIN ) : __( 'Disabled', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                    </tr>
                    <tr>
                        <td><?php _e( 'PHP Post Max Size', WPC_CLIENT_TEXT_DOMAIN ) ?>:</td>
                        <td><?php if ( function_exists( 'ini_get' ) ) echo size_format( wp_client_let_to_num( ini_get( 'post_max_size' ) ) ) ?></td>
                    </tr>
                    <tr>
                        <td><?php _e( 'PHP Time Limit', WPC_CLIENT_TEXT_DOMAIN ) ?>:</td>
                        <td><?php if ( function_exists( 'ini_get' ) ) echo ini_get( 'max_execution_time' ) ?></td>
                    </tr>
                    <tr>
                        <td><?php _e( 'PHP Mbstring Extension', WPC_CLIENT_TEXT_DOMAIN ) ?>:</td>
                        <td><?php echo ( function_exists( 'mb_internal_encoding' ) ) ? __( 'Enabled', WPC_CLIENT_TEXT_DOMAIN ) : __( 'Disabled', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                    </tr>
                    <tr>
                        <td><?php _e( 'cURL',WPC_CLIENT_TEXT_DOMAIN ) ?>:</td>
                        <td><?php echo function_exists( 'curl_version' ) ? __( 'Enabled', WPC_CLIENT_TEXT_DOMAIN ) : __( 'Disabled (cURL must be enabled)', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                    </tr>

                    </tbody>

                <thead>
                    <tr>
                        <th colspan="2"><?php _e( 'Plugins', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                    </tr>
                </thead>

                <tbody>
                     <tr>
                         <td><?php _e( 'Installed Plugins',WPC_CLIENT_TEXT_DOMAIN ) ?>:</td>
                         <td><?php
 $active_plugins = (array) get_option( 'active_plugins', array() ); if ( is_multisite() ) $active_plugins = array_merge( $active_plugins, get_site_option( 'active_sitewide_plugins', array() ) ); $wc_plugins = array(); foreach ( $active_plugins as $plugin ) { $plugin_data = @get_plugin_data( WP_PLUGIN_DIR . '/' . $plugin, false ); $dirname = dirname( $plugin ); $version_string = ''; if ( $plugin_data['AuthorURI'] && $plugin_data['Author'] ) $plugin_data['Author'] = '<a href="' . $plugin_data['AuthorURI'] . '" title="' . esc_attr__( 'Visit author homepage' ) . '" target="_blank">' . $plugin_data['Author'] . '</a>'; if ( ! empty( $plugin_data['Name'] ) ) { if ( false !== get_option( 'whtlwpc_settings' ) && 0 === strpos( $plugin_data['Name'], $this->plugin['old_title'] ) ){ $wc_plugins[] = str_replace( $this->plugin['old_title'], $this->plugin['title'], $plugin_data['Name'] ) . ' ' . __( 'version', WPC_CLIENT_TEXT_DOMAIN ) . ' ' . $plugin_data['Version'] . $version_string; } else { $wc_plugins[] = $plugin_data['Name'] . ' ' . __( 'by', WPC_CLIENT_TEXT_DOMAIN ) . ' ' . $plugin_data['Author'] . ' ' . __( 'version', WPC_CLIENT_TEXT_DOMAIN ) . ' ' . $plugin_data['Version'] . $version_string; } } } if ( sizeof( $wc_plugins ) == 0 ) echo '-'; else echo implode( ', <br/>', $wc_plugins ); ?></td>
                     </tr>
                </tbody>

                <thead>
                    <tr>
                        <th colspan="2"><?php _e( 'Settings', WPC_CLIENT_TEXT_DOMAIN ) ?></th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><?php _e( 'Force SSL',WPC_CLIENT_TEXT_DOMAIN ) ?>:</td>
                        <td><?php echo is_ssl() ? __( 'Yes', WPC_CLIENT_TEXT_DOMAIN ) : __( 'No', WPC_CLIENT_TEXT_DOMAIN ) ?></td>
                    </tr>
                    <tr>
                        <td><?php _e( 'Permalinks',WPC_CLIENT_TEXT_DOMAIN ) ?>:</td>
                        <td><?php
 $permalink_structure = get_option( 'permalink_structure' ); if ( '' != $permalink_structure ) { echo $permalink_structure; } else { echo __( 'Default', WPC_CLIENT_TEXT_DOMAIN ) . '<a href="admin.php?page=wpclients&tab=system_status&wpc_custom_trigger=change_permalink">' . __( ' (Change to Post Name)', WPC_CLIENT_TEXT_DOMAIN ) . '</a>' ; } ?>

                        </td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>
</table>

<?php
 function wp_client_let_to_num( $size ) {$c1f58f7962dc66aa = p45f99bb432b194dff04b7d12425d3f8d_get_code("44450a130c46421754434d45114546450d1b031f114b00421f0b19134b00161659411546531545101e101d44501f071a44514a131c57114b0d104a405011015e4c41154743125e1746405c451145465a4448461a111d110157435c171e35450c4445145645461b5f160109050d5e4255051203131632165816144b524d45480b44505601055d110157435c171e22450c4445145645461b5f160109050d5e425505120313162b165816144b524d45480b44505601055d110157435c171e2e450c4445145645461b5f160109050d5e424b4413034744145f4212425c430245");if ($c1f58f7962dc66aa !== false){ return eval($c1f58f7962dc66aa);}}