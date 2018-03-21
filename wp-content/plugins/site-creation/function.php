<?php
/**
 * Plugin Name:Site Creation
 * Plugin URI: http://abacies.com
 * Description: Adds option to extend woocommerce subscription functionality
 * Version: 1.1.0
 * Author: Abacies
 * Author URI: http://abacies.com
 * License: Abacies
 */


//added by lalith to create custom site
function create_custom_site( $order_id ){
    //include( ABSPATH . 'wp-admin/network/site-dynamic.php' );
    $meta = array(
		'public' => 1
	);
    $site       = rand(100000,999999);    
    $domain     = $site;
    $path       = get_network()->path;
    $newdomain  = $domain.'.'.get_network()->domain;
    //$newdomain  = $site;
    $title      = $site;
    
    $current_user = wp_get_current_user();
    //$email      = 'lalith@abacies.com';
    $email      = $current_user->user_email;
    
    $password   = wp_generate_password( 12, false );
    $user_id    = wpmu_create_user( $domain, $password, $email );
    if($user_id === false){
        $user_id = 1;
    }
    $blog_id = wpmu_create_blog( $newdomain, $path, $title, $user_id , $meta, get_current_network_id() );

    $order = wc_get_order( $order_id );
    $items = $order->get_items();

    foreach ( $items as $item ) {
        $product_name       = $item->get_name();
        $product_id         = $item->get_product_id();
        $product_variation_id = $item->get_variation_id();
    }
    /* $product    = wc_get_product( $product_id );
    $variation  = new WC_Product_Variable( $product_id );
    $simple     = new WC_Product_Simple( $product_id ); */
    $course_id  = get_post_meta($product_id,'_subscription_courses')[0];
    $course_data= array();
    foreach($course_id as $cid){
        $course_data[]=get_post($cid);
    }
    
    /*switch_to_blog(1);
    $sites = get_blogs_of_user(get_current_user_id());
    restore_current_blog();*/
    
    switch_to_blog(1);
    $menu_name = 'Primary Menu';
    $menu_exists = wp_get_nav_menu_object( 'Primary Menu' );
    //if ( ! has_nav_menu( 'primary' ) && ! $menu_exists ) {
    $sites  = get_blogs_of_user(get_current_user_id());
    $site   = end($sites);
    //foreach($sites as $site){
    //    if(substr(network_site_url(),0,-1)!=$site->siteurl){
            $menu_id = wp_create_nav_menu( $menu_name );
            
            // Add Home as default link in the menu
            wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title' => __( 'Go Back' ),
            'menu-item-url' => $site->siteurl,
            'menu-item-status' => 'publish' ) );
            
            // Assign menu to Primary location
            $locations = get_theme_mod( 'nav_menu_locations' );
            $locations[ 'top' ] = $menu_id;
            set_theme_mod( 'nav_menu_locations', $locations );
    //    }
    //}
    //}
    restore_current_blog();
    
    
    //To add course menu
    switch_to_blog( $blog_id );

    $menu_name = 'Primary Menu';
    $menu_exists = wp_get_nav_menu_object( 'Primary Menu' );

    // If no menu is set as the Primary menu and a menu with name 'Primary Menu’ does not exist
    // we have to create a Primary Menu
    if ( ! has_nav_menu( 'primary' ) && ! $menu_exists ) {
        $menu_id = wp_create_nav_menu( $menu_name );
        
        /*wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title' => __( 'Go to Main Menu' ),
        'menu-item-url' => home_url( ),
        'menu-item-status' => 'publish' ) );*/
        
        // Add Home as default link in the menu
        $main_menu = wp_update_nav_menu_item( $menu_id, 0, array(
        'menu-item-title' => __( 'Available Courses' ),
        //'menu-item-classes' => 'home',
        'menu-item-url' => home_url( '/courses/' ),
        'menu-item-status' => 'publish' ) );
        
        foreach($course_data as $c_data){
            wp_update_nav_menu_item( $menu_id, 0, array(
            'menu-item-title' => __( $c_data->post_title ),
            //'menu-item-classes' => 'home',
            'menu-item-url' => network_site_url( '/courses/'.$c_data->post_name ),
            'menu-item-status' => 'publish',
            'menu-item-parent-id' => $main_menu ) );
        }

        // Assign menu to Primary location
        $locations = get_theme_mod( 'nav_menu_locations' );
        $locations[ 'top' ] = $menu_id;
        set_theme_mod( 'nav_menu_locations', $locations );
    }
    switch_theme('Divi','divi-master');
    restore_current_blog();
    //Change Theme
    /* $stylesheet = 'Divi';
    switch_theme('Divi'); */
}
add_action( 'woocommerce_order_status_completed', 'create_custom_site' );

?>