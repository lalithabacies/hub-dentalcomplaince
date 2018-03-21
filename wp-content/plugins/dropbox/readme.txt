=== woocommerce-subscription-addon ===
Contributors: Abacies Logiciels Pvt Ltd
Version : 1.0
Requires : Woocommerce and Woocommerce Subscription

== Description ==
This plugin is a dependent addon plugin of woocommerce subscription. This creates some input attributes at the time of product addition in woocommerce to add subscription limits.Restriction is two types:
i) Restriction to access wordpress pages
ii)Restriction to access dropbox api folders

== Installation ==
 
This section describes how to install the plugin and get it working.
 
1. Upload woocommerce-subscription-addon folder to the `/wp-content/plugins/` directory
2. Can be uploaded from add new option of plugins page.Here need to upload the plugin as zip format.
3. Network Activate the plugin through the 'Plugins' menu in WordPress.

== Usage ==

Automatically the plugin will create 2 extra product tabs when click on subscription and variable- subscription product data type in woocommerce product addition template. The product tabs will provide dynamic data in dropbox to add as a limitation parameter in you subscription product.

Here is the useful shortcode to see the dropbox documents anywhere in your site.
[folders-display]
Can be used in pages as [folders-display] and also can be used in code as <?php echo do_shortcode('[folders-display]'); ?>


