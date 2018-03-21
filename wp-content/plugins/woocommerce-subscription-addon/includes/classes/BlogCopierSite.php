<?php
class BlogCopierSite{
//copies a blog
public function wpmu_blog_copier($blog_id, $user_id, $_passed_domain=false, $_passed_path=false, $_passed_site_id=false, $_passed_meta=false){
		global $wpdb, $multi_dm;

		$settings = nbt_get_settings();

		$default = false;

		/* Start special Multi-Domain feature */
		if( !empty( $multi_dm ) ) {
			$bloginfo = get_blog_details( (int) $blog_id, false );
			foreach( $multi_dm->domains as $multi_domain ) {
				if( strpos( $bloginfo->domain, $multi_domain['domain_name'] ) ) {
					if( isset( $multi_domain['blog_template'] ) && !empty( $settings['templates'][$multi_domain['blog_template']] ) )
						$default = $settings['templates'][$multi_domain['blog_template']];
				}
			}
		}
		/* End special Multi-Domain feature */

		if( empty( $default ) && isset( $settings['default'] ) && is_numeric( $settings['default'] ) ) { // select global default
			$default = isset($settings['templates'][$settings['default']])
				? $settings['templates'][$settings['default']]
				: false
			;
		}


		$template = '';
		// Check $_POST first for passed template and use that, if present.
		// Otherwise, check passed meta from blog signup.
		// Lastly, apply the default.
		$template_id = get_option('blog_blogtemplate');
		if ( isset( $template_id ) ) {
			// The blog is being created from the admin network.
			// The super admin can create a blog without a template
			if ( '' === $template_id ) {
				// The Super Admin does not want to use any template
				return;
			}
			else {
				$template = $settings['templates'][$template_id];
			}
		}
		elseif ( isset( $template_id ) && is_numeric( $template_id ) ) { //If they've chosen a template, use that. For some reason, when PHP gets 0 as a posted var, it doesn't recognize it as is_numeric, so test for that specifically
			$template = $settings['templates'][$template_id];
		} elseif ($_passed_meta && isset($_passed_meta['blog_template']) && is_numeric($_passed_meta['blog_template'])) { // Do we have a template in meta?
			$template = $settings['templates'][$_passed_meta['blog_template']]; // Why, yes. Yes, we do. Use that.
		} elseif ( $default ) { //If they haven't chosen a template, use the default if it exists
			$template = $default;
		}
		$template = apply_filters('blog_templates-blog_template', $template, $blog_id, $user_id );
		if ( ! $template || '' == $template )
			return; //No template, lets leave

		switch_to_blog( $blog_id ); //Switch to the blog that was just created

		//include_once( 'copier.php' );
		include_once( WP_CONTENT_DIR . '/plugins/blogtemplates/nbt-api.php' );
		nbt_load_api();
		$copier_args = array();
		foreach( $template['to_copy'] as $value ) {
			$copier_args['to_copy'][ $value ] = true;
		}
		$copier_args['post_category'] = $template['post_category'];
		$copier_args['pages_ids'] = $template['pages_ids'];
		$copier_args['template_id'] = $template['ID'];
		$copier_args['block_posts_pages'] = $template['block_posts_pages'];
		$copier_args['update_dates'] = $template['update_dates'];
		$copier_args['copy_status'] = isset( $template['copy_status'] ) && $template['copy_status'];
		$copier_args['additional_tables'] = ( isset( $template['additional_tables'] ) && is_array( $template['additional_tables'] ) ) ? $template['additional_tables'] : array();
		$source_blog_id = $template['blog_id'];

		/*$classname = apply_filters( 'nbt_copier_classname', 'NBT_Template_copier' );

		$variables = compact( 'source_blog_id', 'blog_id', 'user_id', 'copier_args' );
		if ( class_exists( $classname ) ) {
			$r = new ReflectionClass( $classname );
			$copier = $r->newInstanceArgs( $variables );
			$copier->execute();
		}*/
		nbt_api_copy_contents_to_new_blog( $source_blog_id, $blog_id, $user_id, $copier_args );

		restore_current_blog(); //Switch back to our current blog
}

public function copy_blog_callback( $blog_id, $user_id ) {
	global $wpdb, $multi_dm;

		$settings = nbt_get_settings();

		$default = false;

		/* Start special Multi-Domain feature */
		if( !empty( $multi_dm ) ) {
			$bloginfo = get_blog_details( (int) $blog_id, false );
			foreach( $multi_dm->domains as $multi_domain ) {
				if( strpos( $bloginfo->domain, $multi_domain['domain_name'] ) ) {
					if( isset( $multi_domain['blog_template'] ) && !empty( $settings['templates'][$multi_domain['blog_template']] ) )
						$default = $settings['templates'][$multi_domain['blog_template']];
				}
			}
		}
		/* End special Multi-Domain feature */

		if( empty( $default ) && isset( $settings['default'] ) && is_numeric( $settings['default'] ) ) { // select global default
			$default = isset($settings['templates'][$settings['default']])
				? $settings['templates'][$settings['default']]
				: false
			;
		}


		$template = '';
		// Check $_POST first for passed template and use that, if present.
		// Otherwise, check passed meta from blog signup.
		// Lastly, apply the default.
		
		$subscription_details = get_blog_option( $blog_id, 'subscription_details' , true );
		$subscription_id  = $subscription_details['subscription_id'];
		$blog_template_subscription = get_post_meta($subscription_id, '_blogtemplate');
		//$template_id = get_option('blog_blogtemplate');
		$template_id = $blog_template_subscription;
		if ( isset( $template_id ) ) {
			// The blog is being created from the admin network.
			// The super admin can create a blog without a template
			if ( '' === $template_id ) {
				// The Super Admin does not want to use any template
				return;
			}
			else {
				$template = $settings['templates'][$template_id];
			}
		}
		elseif ( isset( $template_id ) && is_numeric( $template_id ) ) { //If they've chosen a template, use that. For some reason, when PHP gets 0 as a posted var, it doesn't recognize it as is_numeric, so test for that specifically
			$template = $settings['templates'][$template_id];
		} elseif ($_passed_meta && isset($_passed_meta['blog_template']) && is_numeric($_passed_meta['blog_template'])) { // Do we have a template in meta?
			$template = $settings['templates'][$_passed_meta['blog_template']]; // Why, yes. Yes, we do. Use that.
		} elseif ( $default ) { //If they haven't chosen a template, use the default if it exists
			$template = $default;
		}
		$template = apply_filters('blog_templates-blog_template', $template, $blog_id, $user_id );
		if ( ! $template || '' == $template )
			return; //No template, lets leave
		$copier_args = array();
		foreach( $template['to_copy'] as $value ) {
			$copier_args['to_copy'][ $value ] = true;
		}
		$copier_args['post_category'] = $template['post_category'];
		$copier_args['pages_ids'] = $template['pages_ids'];
		$copier_args['template_id'] = $template['ID'];
		$copier_args['block_posts_pages'] = $template['block_posts_pages'];
		$copier_args['update_dates'] = $template['update_dates'];
		$copier_args['copy_status'] = isset( $template['copy_status'] ) && $template['copy_status'];
		$copier_args['additional_tables'] = ( isset( $template['additional_tables'] ) && is_array( $template['additional_tables'] ) ) ? $template['additional_tables'] : array();
		$source_blog_id = $template['blog_id'];
		
	nbt_api_copy_contents_to_new_blog( $source_blog_id , $blog_id, $user_id, $copier_args );
}

public function add_extra_field_blogtemplate($content, $item, $column_name){
	 print_r($content);
	 return "LAZY";
}
}
?>