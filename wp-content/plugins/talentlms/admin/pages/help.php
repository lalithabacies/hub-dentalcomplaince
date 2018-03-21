<?php

	if ($screen_id == $admin_panel) {
		get_current_screen()->add_help_tab( array(
			'id'		=> 'about',
			'title'		=> __('About TalentLMS', 'talentlms'),
			'content'	=>
				'<p>' . '<strong>' . __('TalentLMS', 'talentlms') . '</strong>' . __(' a super-easy, cloud-based learning platform to train your people and customers', 'talentlms') . '</p>' .
				'<p>' . '<strong>' . __('ShortCodes', 'talentlms') . '</strong>' . '</p>' .
				'<ul>' .
					'<li>' . '<strong>[talentlms-courses]</strong> ' . __('Shortcode for listing your TalentLMS courses.', 'talentlms') . '</li>' .
					'<li>' . '<strong>[talentlms-signup]</strong> ' . __('Shortcode for a signup to TalentLMS form.', 'talentlms') . '</li>' .
					'<li>' . '<strong>[talentlms-forgot-credentials]</strong> ' . __('Shortcode for a forgot your TalentLMS username/password form', 'talentlms') . '</li>' .
					'<li>' . '<strong>[talentlms-login]</strong> ' . __('Shortcode for a login to TalentLMS form', 'talentlms') . '</li>' .
				'</ul>'
		) );
		get_current_screen()->add_help_tab( array(
			'id'		=> 'screen-content',
			'title'		=> __('Screen Content', 'talentlms'),
			'content'	=>
				'<p>' . __('TalentLMS Setup', 'talentlms') . '</p>' .
				'<ul>' .
					'<li>' . '<strong>Setup</strong> ' . __('Setup your TalentLMS domain and API key to get your plugin started.', 'talentlms') . '</li>' .
					'<li>' . '<strong>Options</strong> ' . __('Choose the options to customize your plugin\'s appearance and behavior', 'talentlms') . '</li>' .
					'<li>' . '<strong>Sync</strong> ' . __('Sync your TalentLMS and WordPress users and content', 'talentlms') . '</li>' .
					'<li>' . '<strong>CSS</strong> ' . __('Edit the plugin\'s CSS rules to best match your WordPress theme\'s look and feel', 'talentlms') . '</li>' .
					'<li>' . '<strong>Shortcodes</strong> ' . __('A coprehensive list of all WordPress TalentLMS plugin\'s shortcodes', 'talentlms') . '</li>' .
					'<li>' . '<strong>Help</strong> ' . __('Details about the plugin and any help you might need.', 'talentlms') . '</li>' .
				'</ul>'
		) );
		get_current_screen()->set_help_sidebar(
			'<p><strong>' . __('For more information', 'talentlms') . ':</strong></p>' .
			'<p>' . __('<a href="http://www.talentlms.com/" target="_blank">TalentLMS</a>') . '</p>' .
			'<p>' . __('<a href="http://support.talentlms.com/" target="_blank">Support</a>') . '</p>'
		);		
	}
	if ($screen_id == $setup_page) {
		get_current_screen()->add_help_tab( array(
			'id'		=> 'about',
			'title'		=> __('About TalentLMS', 'talentlms'),
			'content'	=>
				'<p>' . '<strong>' . __('TalentLMS', 'talentlms') . '</strong>' . __(' a super-easy, cloud-based learning platform to train your people and customers', 'talentlms') . '</p>' .
				'<p>' . '<strong>' . __('ShortCodes', 'talentlms') . '</strong>' . '</p>' .
				'<ul>' .
					'<li>' . '<strong>[talentlms-courses]</strong> ' . __('Shortcode for listing your TalentLMS courses.', 'talentlms') . '</li>' .
					'<li>' . '<strong>[talentlms-signup]</strong> ' . __('Shortcode for a signup to TalentLMS form.', 'talentlms') . '</li>' .
					'<li>' . '<strong>[talentlms-forgot-credentials]</strong> ' . __('Shortcode for a forgot your TalentLMS username/password form', 'talentlms') . '</li>' .
					'<li>' . '<strong>[talentlms-login]</strong> ' . __('Shortcode for a login to TalentLMS form', 'talentlms') . '</li>' .
				'</ul>'
		) );
		get_current_screen()->add_help_tab( array(
			'id'		=> 'screen-content',
			'title'		=> __('Screen Content', 'talentlms'),
			'content'	=>
				'<p>' . __('TalentLMS Setup') . ':</p>' .
				'<ul>' .
					'<li>' . __('TalentLMS Domain: Fill in your TalentLMS domain. A valid TalentLMS domain for the plugin would be like: <pre>&lt;your_domain&gt;.talentlms.com</pre> Do not include the prefix http(s)://', 'talentlms') . '</li>' .
					'<li>' . __('API Key: Fill in your TalentLMS API key. You can find this in your TalentLMS  Home / Account & Settings > Security. Click on <i>Enable the API</i> and copy paste your API key.', 'talentlms') . '</li>' .
				'</ul>'
		) );
		get_current_screen()->set_help_sidebar(
			'<p><strong>' . __('For more information', 'talentlms') . ':</strong></p>' .
			'<p>' . __('<a href="http://www.talentlms.com/" target="_blank">TalentLMS</a>') . '</p>' .
			'<p>' . __('<a href="http://support.talentlms.com/" target="_blank">Support</a>') . '</p>'
		);		
	}
	
	if($screen_id == $options_page){
		get_current_screen()->add_help_tab( array(
			'id'		=> 'about',
			'title'		=> __('About TalentLMS', 'talentlms'),
			'content'	=>
				'<p>' . '<strong>' . __('TalentLMS', 'talentlms') . '</strong>' . __(' a super-easy, cloud-based learning platform to train your people and customers', 'talentlms') . '</p>' .
				'<p>' . '<strong>' . __('ShortCodes', 'talentlms') . '</strong>' . '</p>' .
				'<ul>' .
					'<li>' . '<strong>[talentlms-courses]</strong> ' . __('Shortcode for listing your TalentLMS courses.', 'talentlms') . '</li>' .
					'<li>' . '<strong>[talentlms-signup]</strong> ' . __('Shortcode for a signup to TalentLMS form.', 'talentlms') . '</li>' .
					'<li>' . '<strong>[talentlms-forgot-credentials]</strong> ' . __('Shortcode for a forgot your TalentLMS username/password form', 'talentlms') . '</li>' .
					'<li>' . '<strong>[talentlms-login]</strong> ' . __('Shortcode for a login to TalentLMS form', 'talentlms') . '</li>' .
				'</ul>'
		) );
		get_current_screen()->add_help_tab( array(
			'id'		=> 'screen-content',
			'title'		=> __('Screen Content', 'talentlms'),
			'content'	=>
				'<p>' . __('Catalog', 'talentlms') . ':</p>' .
				'<ul>' .
					'<li>' . __('<strong>Show categories on</strong> Choose the position of the TalentLMS categories in referance to the course list', 'talentlms') .
					'<li>' . __('<strong>Courses per page</strong> Choose how many courses are going to be displayed in each page.', 'talentlms') .
				'</ul>' .
			
				'<p>' . __('Signup', 'talentlms') . '</p>' .
				'<ul>' .
					'<li>' . __('<strong>Signup integration</strong> Choose wheather you want to integrate the signup process of TalentLMS and WordPress. If so each time a user is created in WordPress a new user will be created in TalentLMS. Also each time a users signs up to TalentLMS through the plugin\'s signup form a WordPress user will be created', 'talentlms') .
					'<li>' . __('<strong>On signup redirect user to...</strong> Choose the action to be taken after a users signs up with TalentLMS from your WordPress site.', 'talentlms') .
				'</ul>' .
				'<p>' . __('Login/Logout', 'talentlms') . '</p>' .
				'<ul>' .
					'<li>' . __('<strong>On login redirect user to...</strong> Choose the action to be taken after a users logs in to TalentLMS through your WordPress site.', 'talentlms') .
					'<li>' . __('<strong>On logout redirect user to... 	</strong> Choose the action to be taken after a users logs out from your WordPress site', 'talentlms') .
				'</ul>' 
		) ); 	
		get_current_screen()->set_help_sidebar(
			'<p><strong>' . __('For more information') . ':</strong></p>' .
			'<p>' . __('<a href="http://www.talentlms.com/" target="_blank">TalentLMS</a>') . '</p>' .
			'<p>' . __('<a href="http://support.talentlms.com/" target="_blank">Support</a>') . '</p>'
		);			
	}
	if($screen_id == $sync_page){
		get_current_screen()->add_help_tab( array(
			'id'		=> 'about',
			'title'		=> __('About TalentLMS', 'talentlms'),
			'content'	=>
				'<p>' . '<strong>' . __('TalentLMS', 'talentlms') . '</strong>' . __(' a super-easy, cloud-based learning platform to train your people and customers', 'talentlms') . '</p>' .
				'<p>' . '<strong>' . __('ShortCodes', 'talentlms') . '</strong>' . '</p>' .
				'<ul>' .
					'<li>' . '<strong>[talentlms-courses]</strong> ' . __('Shortcode for listing your TalentLMS courses.', 'talentlms') . '</li>' .
					'<li>' . '<strong>[talentlms-signup]</strong> ' . __('Shortcode for a signup to TalentLMS form.', 'talentlms') . '</li>' .
					'<li>' . '<strong>[talentlms-forgot-credentials]</strong> ' . __('Shortcode for a forgot your TalentLMS username/password form', 'talentlms') . '</li>' .
					'<li>' . '<strong>[talentlms-login]</strong> ' . __('Shortcode for a login to TalentLMS form', 'talentlms') . '</li>' .
				'</ul>'
		) );
		get_current_screen()->add_help_tab(array(
			'id'		=> 'screen-content',
			'title'		=> __('Screen Content', 'talentlms'),
			'content'	=>
				'<p>' . __('TalentLMS and WordPress Synchronization', 'talentlms') . ':</p>' .
				'<ul>' .
					'<li>' . __('You can synchronize your TalentLMS and WordPress users, by making your WordPress also users in TalentLMS and vice versa. If you choose to overwrite WordPress users information from TalentLMS, all WordPress users\' details with the same username in TalentLMS will be overwritten by the corresponding TalentLMS details.', 'talentlms') . '</li>' .
					'<li>' . __('You can synchronize your TalentLMS content with WordPress. TalentLMS courses, categories etc are cached for performance reason. If you have new content in your TalentLMS get your WordPress site up to date.', 'talentlms') . '</li>' .
				'</ul>'
		));
		get_current_screen()->set_help_sidebar(
			'<p><strong>' . __('For more information') . ':</strong></p>' .
			'<p>' . __('<a href="http://www.talentlms.com/" target="_blank">TalentLMS</a>') . '</p>' .
			'<p>' . __('<a href="http://support.talentlms.com/" target="_blank">Support</a>') . '</p>'
		);
	}
	if($screen_id == $css_page){
		get_current_screen()->add_help_tab( array(
			'id'		=> 'about',
			'title'		=> __('About TalentLMS', 'talentlms'),
			'content'	=>
				'<p>' . '<strong>' . __('TalentLMS', 'talentlms') . '</strong>' . __(' a super-easy, cloud-based learning platform to train your people and customers', 'talentlms') . '</p>' .
				'<p>' . '<strong>' . __('ShortCodes', 'talentlms') . '</strong>' . '</p>' .
				'<ul>' .
					'<li>' . '<strong>[talentlms-courses]</strong> ' . __('Shortcode for listing your TalentLMS courses.', 'talentlms') . '</li>' .
					'<li>' . '<strong>[talentlms-signup]</strong> ' . __('Shortcode for a signup to TalentLMS form.', 'talentlms') . '</li>' .
					'<li>' . '<strong>[talentlms-forgot-credentials]</strong> ' . __('Shortcode for a forgot your TalentLMS username/password form', 'talentlms') . '</li>' .
					'<li>' . '<strong>[talentlms-login]</strong> ' . __('Shortcode for a login to TalentLMS form', 'talentlms') . '</li>' .
				'</ul>'
		) );
		get_current_screen()->add_help_tab(array(
			'id'		=> 'screen-content',
			'title'		=> __('Screen Content', 'talentlms'),
			'content'	=>
				'<p>' . __('TalentLMS edit CSS', 'talentlms') . ':</p>' .
				'<ul>' .
					'<li>' . __('You can edit CSS rules for TalentLMS WordPress plugin to best customize the look and feel of the plugin according to your WordPress theme.', 'talentlms') . '</li>' .
				'</ul>'
		));
		get_current_screen()->set_help_sidebar(
			'<p><strong>' . __('For more information') . ':</strong></p>' .
			'<p>' . __('<a href="http://www.talentlms.com/" target="_blank">TalentLMS</a>') . '</p>' .
			'<p>' . __('<a href="http://support.talentlms.com/" target="_blank">Support</a>') . '</p>'
		);	
	}
	
	if($screen_id == $tl_subscriber_page) {
		get_current_screen()->add_help_tab( array(
			'id'		=> 'about',
			'title'		=> __('About TalentLMS', 'talentlms'),
			'content'	=>
				'<p>' . '<strong>' . __('TalentLMS', 'talentlms') . '</strong>' . __(' a super-easy, cloud-based learning platform to train your people and customers', 'talentlms') . '</p>'
		) );
		get_current_screen()->add_help_tab(array(
			'id'		=> 'screen-content',
			'title'		=> __('Screen Content', 'talentlms'),
			'content'	=>
				'<p>' . __('TalentLMS User Profile', 'talentlms') . ':</p>' .
				'<ul>' .
					'<li>' . __('Login to TalentLMS if not already logged in.', 'talentlms') . '</li>' .
					'<li>' . __('Once logged in view information about your profile, and navigate to TalentLMS and your TalentLMS course with one click', 'talentlms') . '</li>' .
				'</ul>'
		));		
		get_current_screen()->set_help_sidebar(
			'<p><strong>' . __('For more information:') . '</strong></p>' .
			'<p>' . __('<a href="http://www.talentlms.com/" target="_blank">TalentLMS</a>') . '</p>' .
			'<p>' . __('<a href="http://support.talentlms.com/" target="_blank">Support</a>') . '</p>'
		);				
	}


    if($screen_id == $integrations_page) {
        get_current_screen()->add_help_tab( array(
            'id'		=> 'about',
            'title'		=> __('About TalentLMS', 'talentlms'),
            'content'	=>
                '<p>' . '<strong>' . __('TalentLMS', 'talentlms') . '</strong>' . __(' a super-easy, cloud-based learning platform to train your people and customers', 'talentlms') . '</p>'
        ) );
        get_current_screen()->add_help_tab(array(
            'id'		=> 'screen-content',
            'title'		=> __('TalentLMS Integrations', 'talentlms'),
            'content'	=>
                '<p>' . __('WooCommerce', 'talentlms') . ':</p>' .
                '<ul>' .
                '<li>' . '<strong>'. __('TalentLMS Users & WooCommerce Customers', 'talentlms').':</strong> '. __('Check this option if you wan to create a new TalentLMS user each time a new WooCommerece customer is created. In case you have custom user profile fields definced in your TalentLMS domain, you can match WooCommerce extra information with your custom fields', 'talentlms') . '</li>' .
                '<li>' . '<strong>'. __('TalentLMS courses/categories & WooCommerce products/categories', 'talentlms') . ':</strong> '. __('Choose your TalentLMS courses you want to integrate as WooCommerce products. All TalentLMS categories will be integrated by default. In case you need to integrate courses that have been already integrated choose the option "Force integration"', 'talentlms') . '</li>' .
                '</ul>'
        ));
        get_current_screen()->set_help_sidebar(
            '<p><strong>' . __('For more information:') . '</strong></p>' .
            '<p>' . __('<a href="http://www.talentlms.com/" target="_blank">TalentLMS</a>') . '</p>' .
            '<p>' . __('<a href="http://support.talentlms.com/" target="_blank">Support</a>') . '</p>'
        );
    }


?>