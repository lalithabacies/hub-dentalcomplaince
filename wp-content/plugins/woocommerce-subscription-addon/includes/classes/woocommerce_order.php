<?php 
include_once( WP_CONTENT_DIR . '/plugins/blogtemplates/nbt-api.php' );
nbt_load_api();
class woocommerce_order{
	public function subscription_new_order_received($order_id){
	global $wpdb,$woocommerce;
	$order = new WC_Order( $order_id );
	$myuser_id = (int)$order->user_id;
	$user_info = get_userdata($myuser_id);
	$items = $order->get_items();
	//print_r($items);
	foreach ( $items as $item ) {
		$product_id = $item['product_id'];
		if(WC_Subscriptions_Product::is_subscription($product_id)){
			//update_user_meta($myuser_id, 'subscription_details', array("is_subscribed"=>true,"subscription_id"=>$product_id));
			$associated_folders = get_post_meta($product_id, '_folders_in_dropbox', true);
			$associated_pages = get_post_meta($product_id, '_pages_in_restriction', true);
			//create a blog
			$site = get_current_site();
			$site_domain = $site->domain;
			$domain = "subsite".$order_id.".".$site_domain;
			$path = "/";
			$title = "Sites of Dental Compliance";
			$new_blog_id = wpmu_create_blog($domain, $path, $title, $myuser_id,  array( 'public' => 1 ), 1);
			update_blog_option($new_blog_id, 'subscription_details', array("is_subscribed"=>true,"subscription_id"=>$product_id));
			$blog_template_subscription = get_post_meta($product_id, '_blogtemplate', true);
			update_blog_option($new_blog_id, 'new_blog_template', $blog_template_subscription);
			if(is_array($associated_folders)){
				update_user_meta($myuser_id, 'dropbox_accessed_folders', $associated_folders);
			}
			if(is_array($associated_pages)){
				update_user_meta($myuser_id, 'accessed_pages', $associated_pages);
			}
			$template_id = get_blog_option( $new_blog_id, 'new_blog_template' , true );
			$sql = $wpdb->get_results("SELECT * FROM wp_nbt_templates WHERE ID = '".$template_id."'", ARRAY_A);
			
			foreach($sql as $fetch_option){
				$SOURCE_BLOG_ID = $fetch_option['blog_id'];
				$settings = $fetch_option['options'];
				$ID = $fetch_option['ID'];
			
			}
			//echo $SOURCE_BLOG_ID;
			//exit;
			$args = array(
			'to_copy' => array(
				'settings'  => true,
				'posts'		=> true,
				'pages'		=> true,
				'menus'		=> true,
			),
            'update_dates' => true
			);
	
			nbt_api_copy_contents_to_new_blog( $SOURCE_BLOG_ID, $new_blog_id, $new_user_id, $args );
			update_blog_option($new_blog_id, 'subscription_details', array("is_subscribed"=>true,"subscription_id"=>$product_id));
		}
	}
}

public function manually_complete_subscription_order($order){
	 if ( ! is_object( $order ) ) {
        $order = new WC_Order( $order );
    }

    foreach ( WC_Subscriptions_Order::get_recurring_items( $order ) as $order_item ) {

        $subscription_key = WC_Subscriptions_Manager::get_subscription_key( $order->id, WC_Subscriptions_Order::get_items_product_id( $order_item ) );
		//WC_Subscriptions_Manager::put_subscription_on_hold( $order->user_id, $subscription_key );
		
    }
	$order->update_status('completed');
}



}