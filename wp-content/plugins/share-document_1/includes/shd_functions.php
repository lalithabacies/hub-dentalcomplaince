<?php 
function create_post_type() {
	global $blog_id;
	//if($blog_id == 1){
	register_post_type( 'shd_documents',
		array(
			'labels' => array(
				'name' => __( 'Documents' ),
				'singular_name' => __( 'Document' )
				),
			'public' => true,
			'has_archive' => true,
			)
		);	
//}

}
add_action('admin_menu', 'render_doc_menu');
function render_doc_menu(){
	add_menu_page( __('My Documents', 'share-document'), __('My Documents', 'share-document'), 'administrator', 'custom_doc_page', 'custom_doc_page');
}
function custom_doc_page(){
	echo do_shortcode('[share-docs]');
}
add_action('post_edit_form_tag', 'post_edit_form_tag');
function post_edit_form_tag() {
	echo ' enctype="multipart/form-data"';
}
add_action( 'init', 'create_post_type', 999 );
function document_add_meta_boxes( $post ){
	add_meta_box( 'doc_meta_box', __( 'Upload Documents', 'share-document' ), 'doc_build_meta_box', 'shd_documents', 'side', 'low' );
}
add_action( 'add_meta_boxes_shd_documents', 'document_add_meta_boxes' );
add_action('admin_init','add_cap_for_site_admin');
function add_cap_for_site_admin(){
	$user = $user ? new WP_User( $user ) : wp_get_current_user();
	$role1 =  $user->roles ? $user->roles[0] : false;
	$role = get_role( $role1 );
		//print_r($role);
	if($role1 == 'administrator'){
		if ( ! $role->has_cap( 'level_8' ) ) {
			$role->add_cap( 'level_8' );
			$role->add_cap( 'edit_certificates' );
			$role->add_cap( 'edit_others_posts' );
			$role->add_cap( 'read_others_posts' );
			$role->add_cap( 'read_certificates' );
		}
	}
	if(!is_super_admin()){
		global $wpdb,$wp_admin_bar, $current_user;
		echo '<style>#adminmenuwrap{ display:none;}#wp-admin-bar-new-content{ display:none;}
	</style>';
}
}

global $blog_id;
if($blog_id == 1){
	function document_add_meta_boxes_sites( $post ){
		add_meta_box( 'site_meta_box', __( 'Assign to Sites', 'share-document' ), 'site_build_meta_box', 'shd_documents', 'side', 'low' );
	}
	add_action( 'add_meta_boxes_shd_documents', 'document_add_meta_boxes_sites' );
}
function doc_build_meta_box( $post ){
	wp_nonce_field(plugin_basename(__FILE__), 'wp_custom_attachment_nonce');
	$post_attachment_id = get_post_meta($post->ID,'document_file_id',true);
	
	$html = '<p class="description">';
	$html .= 'Upload your DOC here.';
	$html .= '</p>';
	$html .= '<input type="file" id="wp_custom_attachment" name="wp_custom_attachment" value="" size="25" />';
	if($post_attachment_id)
	{
		$attachment_page = get_attachment_link( $post_attachment_id );
		$html .= '<p><a href="'.$attachment_page.'">'.get_the_title( $attachment_id ).'</a></p>';
	}   
	echo $html;
}// end wp_custom_attachment
//saving the file
function save_custom_meta_data($post_id) {
	global $post;

	if(strtolower($_POST['post_type']) === 'page') {
		if(!current_user_can('edit_page', $post_id)) {
			return $post_id;
		}
	}
	else {
		if(!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
	}

	if(!empty($_FILES['wp_custom_attachment'])) {
		$file   = $_FILES['wp_custom_attachment'];
		$upload = wp_handle_upload($file, array('test_form' => false));
		if(!isset($upload['error']) && isset($upload['file'])) {
			$filetype   = wp_check_filetype(basename($upload['file']), null);
			$title      = $file['name'];
			$ext        = strrchr($title, '.');
			$title      = ($ext !== false) ? substr($title, 0, -strlen($ext)) : $title;
			$attachment = array(
				'post_mime_type'    => $wp_filetype['type'],
				'post_title'        => addslashes($title),
				'post_content'      => '',
				'post_status'       => 'inherit',
				'post_parent'       => $post->ID
				);

			$attach_key = 'document_file_id';
			$attach_id  = wp_insert_attachment($attachment, $upload['file']);
			$existing_download = (int) get_post_meta($post->ID, $attach_key, true);

			if(is_numeric($existing_download)) {
				wp_delete_attachment($existing_download);
			}

			update_post_meta($post->ID, $attach_key, $attach_id);
		}
	}

} // end save_custom_meta_data
add_action('save_post', 'save_custom_meta_data');
function site_build_meta_box($post){
	$get_id = get_post_meta($post->ID,'document_site_id',true);
	$blog_list = get_blog_list( 0, 'all' );
	echo '<select name="select_blog[]" multiple>';
	echo '<option value="">Select one or multiple Sites</option>';
	foreach ($blog_list AS $blog) {
		if(in_array($blog['blog_id'],$get_id) ){
			echo '<option value="'.$blog['blog_id'].'" selected>'.$blog['domain'].$blog['path'].'</option>';
		}else{
			echo '<option value="'.$blog['blog_id'].'" >'.$blog['domain'].$blog['path'].'</option>';
		}

	}
	echo '</select>';
	//echo $html;
}
add_action('save_post', 'save_custom_metadata_site');
function save_custom_metadata_site($post_id){
	//$get_id = get_post_meta($post_id,'document_site_id',true);
	if(isset($_POST['select_blog']) && $_POST['select_blog']!=""){
		update_post_meta($post_id, 'document_site_id', $_POST['select_blog']);
	}
}

//create a shortcode to list available documents
add_shortcode('share-docs','list_documents');
function list_documents(){
	global $wpdb,$blog_id,$post;	
	$current_site_blog_id = $blog_id;
	switch_to_blog(1);
	$args = array(
		'posts_per_page'   => 5,
		'post_type'        => 'shd_documents',
		'post_status'      => 'publish'
		);
	$posts_array = get_posts( $args ); 
	$html = '';
	$html .='<ul>';
	$html.='<h3>Shared Documents by Super Admin</h3>';
	$flag = 0;
	foreach ( $posts_array as $post ) : setup_postdata( $post ); 
	$post_attachment_id = get_post_meta($post->ID,'document_file_id',true);
	$attachment_page = wp_get_attachment_url( $post_attachment_id );
		//echo "Link : ".$attachment_page;
	$site_arr= get_post_meta($post->ID,'document_site_id',true);	
	if(in_array($current_site_blog_id,$site_arr)){
		$flag = 1;
		$html .='<li>';
		$html.='<div class="doc_list">';
		$html.='<div class="shd_doc_title"><label>Title : </label>&nbsp;'.$post->post_title.'</div>';
		$html.='<div class="shd_doc_title"><label>Brief : </label>&nbsp;'.$post->post_content.'</div>';
		$html.='<div class="shd_doc_title"><label>Doc : </label>&nbsp;<a href="'.$attachment_page.'">"'.get_the_title( $post_attachment_id ).'"</a></div>';
		$html.='</div>';
		$html .='</li>';
	}
	endforeach;
	$html .='</ul>';	
	wp_reset_postdata();
	echo $html;
	// get own created documents
	$html1 = ''; 
	switch_to_blog($current_site_blog_id);
	$args1 = array(
		'posts_per_page'   => 5,
		'post_type'        => 'shd_documents',
		'post_status'      => 'publish'
		);
	$posts_array1 = get_posts( $args1 );
	
	$html1 .='<ul>';
	$html1.='<h3>Site Documents</h3>';
	$flag = 0;
	foreach ( $posts_array1 as $post ) : setup_postdata( $post ); 
	$post_attachment_id = get_post_meta($post->ID,'document_file_id',true);
	$attachment_page = wp_get_attachment_url( $post_attachment_id );	
	$flag = 1;
	$html1.='<li>';
	$html1.='<div class="doc_list">';
	$html1.='<div class="shd_doc_title"><label>Title : </label>&nbsp;'.$post->post_title.'</div>';
	$html1.='<div class="shd_doc_title"><label>Brief : </label>&nbsp;'.$post->post_content.'</div>';
	$html1.='<div class="shd_doc_title"><label>Doc : </label>&nbsp;<a href="'.$attachment_page.'">"'.get_the_title( $post_attachment_id ).'"</a></div>';
	$html1.='</div>';
	$html1.='</li>';
	endforeach;
	$html1.='</ul>';	
	echo $html1;
	wp_reset_postdata();
	if($flag == 0){
		echo '<div class="doc_not_found">No documents found</div>';
	}
}
/* Add option to select sites to share courses  */
global $blog_id;
if($blog_id == 1){
	function courses_add_meta_boxes_sites( $post ){
		add_meta_box( 'course_meta_box', __( 'Assign to Sites', 'share-document' ), 'course_build_meta_box', 'sfwd-courses', 'side', 'low' );
	}
	add_action( 'add_meta_boxes_sfwd-courses', 'courses_add_meta_boxes_sites' );
}
function course_build_meta_box($post){
	$get_id = get_post_meta($post->ID,'shared_sites_id',true);
	$blog_list = get_blog_list( 0, 'all' );
	echo '<select name="select_blog_course[]" multiple>';
	echo '<option value="">Select one or multiple Sites</option>';
	foreach ($blog_list AS $blog) {
		if(in_array($blog['blog_id'],$get_id) ){
			echo '<option value="'.$blog['blog_id'].'" selected>'.$blog['domain'].$blog['path'].'</option>';
		}else{
			echo '<option value="'.$blog['blog_id'].'" >'.$blog['domain'].$blog['path'].'</option>';
		}

	}
	echo '</select>';
	//echo $html;
}
add_action('save_post', 'save_custom_metadata_course');
function save_custom_metadata_course($post_id){
	//$get_id = get_post_meta($post_id,'shared_sites_id',true);
	if(isset($_POST['select_blog_course']) && $_POST['select_blog_course']!=""){
		update_post_meta($post_id, 'shared_sites_id', $_POST['select_blog_course']);
	}
}
add_shortcode('available-courses','show_all_courses');
function show_all_courses(){
	//error_reporting(0);
	$flag = 0;
	global $wpdb,$blog_id,$post;	
	$current_site_blog_id = $blog_id;
	$html = '';
	switch_to_blog(1);
	$args = array(
		'posts_per_page'   => 5,
		'post_type'        => 'sfwd-courses',
		'post_status'      => 'publish'
		);
	$posts_array = get_posts( $args ); 
	$flag = 0;
	foreach ( $posts_array as $post ) : setup_postdata( $post ); 
	$site_arr= get_post_meta($post->ID,'shared_sites_id',true);
	if(is_array($site_arr)){
		if(in_array($current_site_blog_id,$site_arr)){
			$flag = 1;
			$course_id = $post->ID;
			$html.='<div class="available-ct"><span>Course Title : </span>'.$post->post_title.'</div>';
			$html.='<div class="available-cc">'.$post->post_content.'</h3>';
			$html.=do_shortcode('[course_content course_id='.$course_id.']');
			$html.='<hr>';			
		}
	}
	endforeach;
	wp_reset_postdata();
	restore_current_blog();
	
	// get own created documents
	switch_to_blog($current_site_blog_id);
	$args1 = array(
		'posts_per_page'   => 5,
		'post_type'        => 'sfwd-courses',
		'post_status'      => 'publish'
		);
	$posts_array1 = get_posts( $args1 );
	foreach ( $posts_array1 as $post ) : setup_postdata( $post ); 
	$flag = 1;
	$course_id1 = $post->ID;
	$html.='<div class="available-ct"><span>Course Title : </span>'.$post->post_title.'</div>';
	$html.='<div class="available-cc">'.$post->post_content.'</h3>';
	$html.=do_shortcode('[course_content course_id='.$course_id1.']'); 
	endforeach;
	wp_reset_postdata();
	echo $html;
	if($flag == 0){
		echo '<div class="doc_not_found">No course found</div>';
	}
}
/* student dashboard shortcode */
add_shortcode('student_dashboard','callback_student_dash');
function callback_student_dash(){
	global $wp_db,$blog_id;
	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;
	$current_site_blog_id = $blog_id;
	echo do_shortcode('[ld_profile]');
	?>
	<!--<div class="expand_collapse">
	<a href="#" onClick='return flip_expand_all("#course_list");'><?php _e( 'Expand All', 'learndash' ); ?></a> | <a href="#" onClick='return flip_collapse_all("#course_list");'><?php _e( 'Collapse All', 'learndash' ); ?></a>
	</div>

	<div class="learndash_profile_heading">
	<span><?php _e( 'Profile', 'learndash' ); ?></span>
	</div>

	<div class="profile_info clear_both">
	<div class="profile_avatar">
	<?php echo get_avatar( $current_user->user_email, 96 ); ?>
	<div class="profile_edit_profile" align="center">
	<a href='<?php echo get_edit_user_link(); ?>'><?php _e( 'Edit profile', 'learndash' ); ?></a>
	</div>
	</div>

	<div class="learndash_profile_details">
	<?php if ( ( ! empty( $current_user->user_lastname) ) || ( ! empty( $current_user->user_firstname ) ) ): ?>
	<div><b><?php _e( 'Name', 'learndash' ); ?>:</b> <?php echo $current_user->user_firstname . ' ' . $current_user->user_lastname; ?></div>
	<?php endif; ?>
	<div><b><?php _e( 'Username', 'learndash' ); ?>:</b> <?php echo $current_user->user_login; ?></div>
	<div><b><?php _e( 'Email', 'learndash' ); ?>:</b> <?php echo $current_user->user_email; ?></div>
	</div>
	</div>

	<div class="learndash_profile_heading no_radius clear_both">
	<span class="ld_profile_course"><?php printf( _x( 'Registered %s', 'Registered Courses Label', 'learndash' ), LearnDash_Custom_Label::get_label( 'courses' ) ); ?></span>
	<span class="ld_profile_status"><?php _e( 'Status', 'learndash' ); ?></span>
	<span class="ld_profile_certificate"><?php _e( 'Certificate', 'learndash' ); ?></span>
	</div>---->	
	<div id="learndash_profile">
		<div id="course_list">
			<?php
			$users_blog = $blog_id;
			switch_to_blog(1);
			$args = array(
				'posts_per_page'   => 5,
				'post_type'        => 'sfwd-courses',
				'post_status'      => 'publish'
			);
			$posts_array = get_posts( $args );
			//echo "<pre>";			
			//print_r($posts_array);
			//echo "</pre>";
			$flag = 0;
			$user_course_progress  = get_user_meta($user_id,"_sfwd-course_progress",true);
			if( is_blog_user( $users_blog ) ){
				$subscription_details = get_blog_option($users_blog,'subscription_details',true);
				$subscription_id = $subscription_details['subscription_id'];
				$accessed_courses = get_post_meta($subscription_id,'_subscription_courses',true);
			}
			foreach ( $posts_array as $course ){ 
				$site_arr= get_post_meta($course->ID,'shared_sites_id',true);

				//if(!empty($site_arr) || !empty($accessed_courses)){
				if(is_array($site_arr) && in_array($current_site_blog_id,$site_arr) && $user_course_progress!="" && array_key_exists($course->ID,$user_course_progress) || isset($accessed_courses) && !empty($accessed_courses) && in_array($course->ID,$accessed_courses)){
					$course_link = get_permalink( $course->ID);
					//echo  "here".$course->ID;
					$progress = learndash_course_progress( array(
					'user_id'   => $user_id,
					'course_id' => $course->ID,
					'array'     => true
					) );

					$status = ( $progress['percentage'] == 100 ) ? 'completed' : 'notcompleted';?>
					<div id='course-<?php echo esc_attr( $user_id ) . '-' . esc_attr( $course->ID ); ?>'>
						<div class="list_arrow collapse flippable"  onClick='return flip_expand_collapse("#course-<?php echo esc_attr( $user_id ); ?>", <?php echo esc_attr( $course->ID ); ?>);'></div>


						<?php
                    /**
                     * @todo Remove h4 container.
                     */
                    ?>
                    <h4>
                    	<div class="learndash-course-link"><a href="<?php echo esc_attr( $course_link ); ?>"><?php echo $course->post_title; ?></a></div>

                    	<div class="learndash-course-status"><a class="<?php echo esc_attr( $status ); ?>" href="<?php echo esc_attr( $course_link ); ?>"><?php echo $course->post_title; ?></a></div>
                    	<div class="learndash-course-certificate"><?php
                    		$certificateLink = learndash_get_course_certificate_link( $course->ID, $user_id );
                    		if ( !empty( $certificateLink ) ) {
                    			?><a target="_blank" href="<?php echo esc_attr( $certificateLink ); ?>"><div class="certificate_icon_large"></div></a><?php
                    		} else {
                    			?><a style="padding: 10px 2%;" href="#">-</a><?php
                    		}
                    		?></div>
                    		<div class="flip" style="clear: both; display:none;">

                    			<div class="learndash_profile_heading course_overview_heading"><?php printf( _x( '%s Progress Overview', 'Course Progress Overview Label', 'learndash' ), LearnDash_Custom_Label::get_label( 'course' ) ); ?></div>

                    			<div>
                    				<dd class="course_progress" title='<?php echo sprintf( __( '%s out of %s steps completed', 'learndash' ), $progress['completed'], $progress['total'] ); ?>'>
                    					<div class="course_progress_blue" style='width: <?php echo esc_attr( $progress['percentage'] ); ?>%;'>
                    					</dd>

                    					<div class="right">
                    						<?php echo sprintf( __( '%s%% Complete', 'learndash' ), $progress['percentage'] ); ?>
                    					</div>
                    				</div>

                    				<?php if ( ! empty( $quiz_attempts[ $course_id ] ) ) : ?>
                    					<div class="learndash_profile_quizzes clear_both">

                    						<div class="learndash_profile_quiz_heading">
                    							<div class="quiz_title"><?php echo LearnDash_Custom_Label::get_label( 'quizzes' ); ?></div>
                    							<div class="certificate"><?php _e( 'Certificate', 'learndash' ); ?></div>
                    							<div class="scores"><?php _e( 'Score', 'learndash' ); ?></div>
                    							<div class="statistics"><?php _e( 'Statistics', 'learndash' ); ?></div>
                    							<div class="quiz_date"><?php _e( 'Date', 'learndash' ); ?></div>
                    						</div>

                    						<?php foreach ( $quiz_attempts[ $course_id ] as $k => $quiz_attempt ) : ?>
                    							<?php
                    							$certificateLink = null;

                    							if ( (isset( $quiz_attempt['has_graded'] ) ) && ( true === $quiz_attempt['has_graded'] ) && (true === LD_QuizPro::quiz_attempt_has_ungraded_question( $quiz_attempt )) ) {
                    								$status = 'pending';
                    							} else {
                    								$certificateLink = @$quiz_attempt['certificate']['certificateLink'];
                    								$status = empty( $quiz_attempt['pass'] ) ? 'failed' : 'passed';
                    							}

                    							$quiz_title = ! empty( $quiz_attempt['post']->post_title) ? $quiz_attempt['post']->post_title : @$quiz_attempt['quiz_title'];

                    							$quiz_link = ! empty( $quiz_attempt['post']->ID) ? get_permalink( $quiz_attempt['post']->ID ) : '#';
                    							?>
                    							<?php if ( ! empty( $quiz_title ) ) : ?>
                    								<div class='<?php echo esc_attr( $status ); ?>'>

                    									<div class="quiz_title">
                    										<span class='<?php echo esc_attr( $status ); ?>_icon'></span>
                    										<a href='<?php echo esc_attr( $quiz_link ); ?>'><?php echo esc_attr( $quiz_title ); ?></a>
                    									</div>

                    									<div class="certificate">
                    										<?php if ( ! empty( $certificateLink ) ) : ?>
                    											<a href='<?php echo esc_attr( $certificateLink ); ?>&time=<?php echo esc_attr( $quiz_attempt['time'] ) ?>' target="_blank">
                    												<div class="certificate_icon"></div></a>
                    											<?php else : ?>
                    												<?php echo '-';	?>
                    											<?php endif; ?>
                    										</div>

                    										<div class="scores">
                    											<?php if ( (isset( $quiz_attempt['has_graded'] ) ) && (true === $quiz_attempt['has_graded']) && (true === LD_QuizPro::quiz_attempt_has_ungraded_question( $quiz_attempt )) ) : ?>
                    												<?php echo _x('Pending', 'Pending Certificate Status Label', 'learndash'); ?>
                    											<?php else : ?>
                    												<?php echo round( $quiz_attempt['percentage'], 2 ); ?>%
                    											<?php endif; ?>
                    										</div>

                    										<div class="statistics">
                    											<?php													
                    											if ( ( ( $user_id == get_current_user_id() ) || ( learndash_is_admin_user() ) || ( learndash_is_group_leader_user() ) ) && ( isset( $quiz_attempt['statistic_ref_id'] ) ) && ( !empty( $quiz_attempt['statistic_ref_id'] ) ) ) {
														/**
														 *	 @since 2.3
														 * See snippet on use of this filter https://bitbucket.org/snippets/learndash/5o78q
														 */
														if ( apply_filters( 'show_user_profile_quiz_statistics', 
															get_post_meta( $quiz_attempt['post']->ID, '_viewProfileStatistics', true ), $user_id, $quiz_attempt, basename( __FILE__ ) ) ) {

															?><a class="user_statistic" data-statistic_nonce="<?php echo wp_create_nonce( 'statistic_nonce_'. $quiz_attempt['statistic_ref_id'] .'_'. get_current_user_id() . '_'. $user_id ); ?>" data-user_id="<?php echo $user_id ?>" data-quiz_id="<?php echo $quiz_attempt['pro_quizid'] ?>" data-ref_id="<?php echo intval( $quiz_attempt['statistic_ref_id'] ) ?>" href="#"><div class="statistic_icon"></div></a><?php
													}
												}
												?>
											</div>

											<div class="quiz_date"><?php echo learndash_adjust_date_time_display(  $quiz_attempt['time'] ); ?></div>
											
										</div>
									</div>
								<?php endif; ?>

							</div>
						</h4>
					</div>
					<?php endforeach; 
						  endif;?>
					</div>
					
				

		</div>
		<?php }
			}
			?>
	</div>
<?php }
/* get course status for every user*/
add_action('admin_menu', 'render_course_status_menu');
function render_course_status_menu(){
	add_menu_page( __('Course Status', 'share-document'), __('Course Status', 'share-document'), 'administrator', 'custom_course_status_page', 'custom_course_status_page');
}
function custom_course_status_page(){
	global $blog_id;
	$loader_path = plugins_url('share-document/assets/images/ajax-loader.gif');
	$html = '';
	$blogusers = get_users( 'blog_id='.$blog_id );
	echo "<div class='search'><input type='text' name='search_user' id='search_user' value=''/><input type='button' name='search_butt_user' id='search_butt_user' value='Search'/><span><img src='".$loader_path."' class='loader_img' style='display:none' /></span></div>";
	echo "<div id='response1'>";
	foreach($blogusers as $users){
		$user_id = $users->ID;
		$user_info = get_userdata($user_id);	
		$user_roles=$user_info->roles;
		if(in_array("administrator",$user_roles)){
		}else{	
		    echo do_shortcode('[ld_profile user_id='.$user_id.']');
		}
		
	}
	echo "</div>";
}

/* Create option to download certificates for site admins*/
add_action('admin_menu', 'render_custom_certificate_menu');
function render_custom_certificate_menu(){
	add_menu_page( __('Certificates', 'share-document'), __('Certificates', 'share-document'), 'administrator', 'custom_cert_page', 'custom_cert_page');
}
function custom_cert_page(){
	global $blog_id,$wpdb;
	$current_blog_id = $blog_id;
	$loader_path = plugins_url('share-document/assets/images/ajax-loader.gif');
	$html = "";
	//$html.="<div class='search'><input type='text' name='search_course' id='search_course' value=''/><input type='button' name='search_butt' id='search_butt' value='Search'/></div>";
	echo "<div class='search'><input type='text' name='search_course' id='search_course' value=''/><input type='button' name='search_butt' id='search_butt' value='Search'/><span><img src='".$loader_path."' class='loader_img' style='display:none' /></span></div>";
	echo "<div id='response'>";
	$view_user_id = get_current_user_id();
	$args1 = array(
		'posts_per_page'   => 5,
		'post_type'        => 'sfwd-courses',
		'post_status'      => 'publish'
		);
	$posts_array1 = get_posts( $args1 ); 
	
	foreach ($posts_array1 AS $posts1) {
		$course_meta1 = get_post_meta($posts1->ID,'_sfwd-courses',true);
		$certificate_id1 = $course_meta1['sfwd-courses_certificate'];
		$html.="<div class='course-plus-download'><div class='course-title-id'><p><span class='coursetitle'>Course Title:  </span><span class='coursename'>".  $posts1->post_title ."</span> </p><p><span class='certificateid'>Certificate Id: </span> <span class='certid'>".$certificate_id1."</span></p></div><div class='cert-download'>";
		$course_completed_meta1 = $wpdb->get_results("SELECT * from wp_usermeta where meta_key='course_completed_".$posts1->ID."'",ARRAY_A);
		foreach($course_completed_meta1 as $completed1){
			$course_completed_by_user1 = $completed1['user_id'];
			if($course_completed_by_user1 !=""){
				$user_info = get_userdata($course_completed_by_user1);
				$display_name = $user_info->display_name;
				$cert_query_args = array(
					"course_id"	=>	$posts1->ID,
					);
				$cert_query_args['user'] = $course_completed_by_user1;
				$cert_query_args['cert-nonce'] = wp_create_nonce( $posts1->ID . $course_completed_by_user1 . $view_user_id );
				
				$url = add_query_arg( $cert_query_args, get_permalink( $certificate_id1 ) );
				$download_url = "<button class='download-certificate'><a href=".$url.">Download Certificate</a></button>";
				$html.="<p class='download-link'>";
				$html.="<span class='dl-for-user'>Certificate Download link for User  : </span><span class='d-name'>".$display_name."</span>".$download_url;
				$html.="</p>";

			}
		}
		$html.="</div>";
		$html.="</div>";
	}
	echo $html;
	echo "</div>";
}


/* add a meta box in all posts to show a gui to choose for sites */
global $blog_id;
$get_template = get_blog_option(1,'blog_blogtemplate');
if($get_template){
	$assigned_blog_template = $get_template;
}else{
	$assigned_blog_template = 1;
}
if($blog_id == 1 || $blog_id == $assigned_blog_template){
	function sites_add_meta_boxes_all( $post ){
		add_meta_box( 'site_all_meta_box', __( 'Assign to Sites', 'share-document' ), 'site_all_build_meta_box', 'post', 'side', 'low' );
	}
	add_action( 'add_meta_boxes', 'sites_add_meta_boxes_all' );
}
function site_all_build_meta_box($post){
	global $blog_id;
	$get_template = get_blog_option(1,'blog_blogtemplate');
	if($get_template){
		$assigned_blog_template = $get_template;
	}else{
		$assigned_blog_template = 1;
	}
	$get_id = get_post_meta($post->ID,'replicated_sites_id',true);
	$blog_list = get_blog_list( 0, 'all' );
	echo '<select name="select_blog_all[]" multiple>';
	echo '<option value="">Select one or multiple Sites</option>';
	
	foreach ($blog_list AS $blog) {
		if($blog_id == $assigned_blog_template){
			$template_id = get_blog_option($blog['blog_id'], 'blog_template');
			if($blog_id == $template_id){
				if(in_array($blog['blog_id'],$get_id) ){
					echo '<option value="'.$blog['blog_id'].'" selected>'.$blog['domain'].$blog['path'].'</option>';
				}else{
					echo '<option value="'.$blog['blog_id'].'" >'.$blog['domain'].$blog['path'].'</option>';
				}
			}
			if($assigned_blog_template == 1){
				if(in_array($blog['blog_id'],$get_id) ){
					echo '<option value="'.$blog['blog_id'].'" selected>'.$blog['domain'].$blog['path'].'</option>';
				}else{
					echo '<option value="'.$blog['blog_id'].'" >'.$blog['domain'].$blog['path'].'</option>';
				}
			}
		}else{
			if(is_array($get_id) && in_array($blog['blog_id'],$get_id) ){
				echo '<option value="'.$blog['blog_id'].'" selected>'.$blog['domain'].$blog['path'].'</option>';
			}else{
				echo '<option value="'.$blog['blog_id'].'" >'.$blog['domain'].$blog['path'].'</option>';
			}
		}
	}
	echo '</select>';
	//echo $html;
}

//add_action( 'publish_post', 'save_in_all_sites'  );

function save_custom_metadata_site_all($post_id){
	global $wpdb,$post,$blog_id;
	if (isset($post->post_status) && 'inherit' == $post->post_status) {
		return;
	}
	if(isset($_POST['select_blog_all']) && $_POST['select_blog_all']!=""){
		update_post_meta($post_id, 'replicated_sites_id', $_POST['select_blog_all']);
		$sites_arr = get_post_meta($post_id,'replicated_sites_id',true);
		$shared_post_arr = get_post_meta($post_id,'shared_postmeta_id',true);
		$my_post = get_post($post_id, ARRAY_A); // get the original post
		$the_thumbnail_id = get_post_meta($post_id, '_thumbnail_id', true);
		//echo "post - ".$post_id. "thumb id ".$the_thumbnail_id;
		//echo "Current Blog Id : ".$blog_id;
		if($blog_id == 1){
			$table_name = "wp_postmeta";

		}else{
			$table_name = "wp_".$blog_id."_postmeta";
		}
		switch_to_blog($blog_id);
		$filename = $wpdb->get_var( "SELECT meta_value FROM ".$table_name." WHERE post_id = '".$the_thumbnail_id."' AND meta_key = '_wp_attached_file'" );
		//echo  "SELECT meta_value FROM ".$table_name." WHERE post_id = '".$the_thumbnail_id."' AND meta_key = '_wp_attached_file'";
		//echo "Filename".$filename; 
		$upload_dir = wp_upload_dir();
		$filename1 =  $upload_dir['path']."/".basename($filename);
		$original_post_id = $post_id;

		//$arrnew = array();
		foreach($sites_arr as $site1){
			switch_to_blog($site1);
			//echo "Post Title : ".post_exists($my_post['post_title']);
			remove_action( current_filter(), __FUNCTION__ );
			if(false !== $key = array_search($site1, $shared_post_arr) || post_exists($my_post['post_title']) == 0){
				$my_post['ID'] = '';
				$ru_post_id1 = wp_insert_post( $my_post );
				//set thumbnail
				$wp_upload_dir = wp_upload_dir();
				$upload_file = wp_upload_bits(basename( $filename1 ), null, file_get_contents($filename1));
				if (!$upload_file['error']) {
					$wp_filetype = wp_check_filetype($filename1, null );
					$attachment = array(
						'post_mime_type' => $wp_filetype['type'],
						'post_parent' => $shared_post_arr[$site1],
						'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
						'post_content' => '',
						'post_status' => 'inherit'
						);
					$attachment_id = wp_insert_attachment( $attachment, $upload_file['file'], $ru_post_id1 );
					if (!is_wp_error($attachment_id)) {
						require_once(ABSPATH . "wp-admin" . '/includes/image.php');
						$attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
						wp_update_attachment_metadata( $attachment_id,  $attachment_data );
					}
				}
				set_post_thumbnail( $ru_post_id1, $attachment_id );	
				
				$arrnew[$site1] = $ru_post_id1;
			}else{
				if(post_exists($my_post['post_title'])!=0){
					$my_post['ID'] = post_exists($my_post['post_title']);
				}else{
					$my_post['ID'] = $shared_post_arr[$site1];
				}				
				$wp_upload_dir = wp_upload_dir();
				$the_thumbnail_id_up = get_post_meta($shared_post_arr[$site1], '_thumbnail_id', true);
				$filename_up = $wpdb->get_var( "SELECT meta_value FROM wp_".$site1."_postmeta WHERE post_id = '".$the_thumbnail_id_up."' AND meta_key = '_wp_attached_file'" );
				//echo "Child :".basename($filename_up). "Mother :".basename( $filename1 ) ;exit;
				if(basename($filename_up) != basename( $filename1 )){
					$upload_file = wp_upload_bits(basename( $filename1 ), null, file_get_contents($filename1));

					if (!$upload_file['error']) {
						$wp_filetype = wp_check_filetype($filename1, null );
						$attachment = array(
							'post_mime_type' => $wp_filetype['type'],
							'post_parent' => $shared_post_arr[$site1],
							'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
							'post_content' => '',
							'post_status' => 'inherit'
							);
						$attachment_id = wp_insert_attachment( $attachment, $upload_file['file'], $shared_post_arr[$site1] );
						if (!is_wp_error($attachment_id)) {
							require_once(ABSPATH . "wp-admin" . '/includes/image.php');
							$attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
							wp_update_attachment_metadata( $attachment_id,  $attachment_data );
						}
					}
					set_post_thumbnail( $my_post['ID'], $attachment_id );
				}
				
				$ru_post_id2 = wp_update_post( $my_post );
			}
			restore_current_blog();
			
		}

		if(isset($ru_post_id1)){
			update_post_meta($post_id, 'shared_postmeta_id', $arrnew);
		}
	}
}
add_action('save_post', 'save_custom_metadata_site_all');

/**** If site created using a blog template i.e primary subsite and a new page created or updated in blog template site it will change or insert the post status in all blogs created ***/
//global $blog_id;

//get template blog id
$get_template = get_blog_option(1,'blog_blogtemplate');
if($get_template && $blog_id == $get_template){
	function site_blog_template_meta_box_page( $post ){
		add_meta_box( 'site_template_meta_box_page', __( 'Assign to Sites', 'share-document' ), 'site_template_build_meta_box_page', 'page', 'side', 'low' );
	}
	add_action( 'add_meta_boxes', 'site_blog_template_meta_box_page' );
}
function site_template_build_meta_box_page($post){
	global $blog_id,$wpdb;
	$get_id = get_post_meta($post->ID,'replicated_sites_id',true);
	$blog_list = get_blog_list( 0, 'all' );
	echo '<select name="select_blog_all[]" multiple>';
	echo '<option value="">Share this page with below sites</option>';
	foreach ($blog_list AS $blog) {
		$template_id = get_blog_option($blog['blog_id'], 'blog_template');
		if($blog_id == $template_id){
			// display this site in select box
			if(in_array($blog['blog_id'],$get_id) ){
				echo '<option value="'.$blog['blog_id'].'" selected>'.$blog['domain'].$blog['path'].'</option>';
			}else{
				echo '<option value="'.$blog['blog_id'].'" >'.$blog['domain'].$blog['path'].'</option>';
			}
		}
	}
	echo '</select>';
}

/****adds a settings page in network admin***/
add_action('network_admin_menu', 'add_network_menu_selblog');
function add_network_menu_selblog() {
	add_menu_page( "Primary Sub Blog", "Select Blog", 'manage_options', 'select_blog', 'call_user_func_menu','dashicons-admin-generic',8);	
} 
function call_user_func_menu(){
	if(isset($_POST['set_blog']) && $_POST['set_blog'] == "Set as Blog Template"){
		update_option("blog_blogtemplate",$_POST['select_blog_template']);
	}
	$template_id = get_option('blog_blogtemplate');
	//$blog_list = get_blog_list( 0, 'all' );
	global $wpdb, $current_site;

	$current_site_id = ! empty ( $current_site ) ? $current_site->id : 1;
	$table = $wpdb->base_prefix . 'nbt_templates';
	$blog_list = 
	$wpdb->get_results( "SELECT * FROM ".$table." WHERE network_id = '".$current_site_id."' " , ARRAY_A );
	echo '<form method="post" >';
	echo '<select name="select_blog_template">';
	echo '<option value="">Select Blog Template Site</option>';
	foreach ($blog_list AS $blog) {
		if($blog['ID'] == $template_id ){
			echo '<option value="'.$blog['ID'].'" selected>'.$blog['name'].'</option>';
		}else{
			echo '<option value="'.$blog['ID'].'" >'.$blog['name'].'</option>';
		}

	}
	echo '</select>';
	echo '<input type="submit" name="set_blog"  value="Set as Blog Template"  class="btn btn-primary"/></form>';
	
}

/* add a meta box in all posts of the primary subsite template site to show a gui to choose for sites */
global $blog_id;

//get template blog id
/*$get_template = get_blog_option(1,'blog_blogtemplate');
if($get_template && $blog_id == $get_template){
function site_blog_template_meta_box( $post ){
	add_meta_box( 'site_template_meta_box', __( 'Assign to Sites', 'share-document' ), 'site_template_build_meta_box', 'post', 'side', 'low' );
}
add_action( 'add_meta_boxes', 'site_blog_template_meta_box' );
}
function site_template_build_meta_box($post){
	global $blog_id,$wpdb;
	$get_id = get_post_meta($post->ID,'replicated_sites_id',true);
	$blog_list = get_blog_list( 0, 'all' );
	echo '<select name="select_blog_all[]" multiple>';
	echo '<option value="">Share this post with below sites</option>';
	foreach ($blog_list AS $blog) {
		$template_id = get_blog_option($blog['blog_id'], 'blog_template');
		if($blog_id == $template_id){
			// display this site in select box
			if(in_array($blog['blog_id'],$get_id) ){
				echo '<option value="'.$blog['blog_id'].'" selected>'.$blog['domain'].$blog['path'].'</option>';
			}else{
				echo '<option value="'.$blog['blog_id'].'" >'.$blog['domain'].$blog['path'].'</option>';
			}
		}
	}
	echo '</select>';

}*/
add_action('blog_templates-copy-after_copying', 'blog_template_add_template_todb', 10, 3);
function blog_template_add_template_todb($template, $blog_id, $user_id){
	update_blog_option($blog_id,'blog_template',$template['blog_id']);
}
/////////////////////////////////////////////////////////////////////////
# after login into dashboard redirect to custom page
/* Redirect the user logging in to a custom admin page. */
function my_login_redirect( $redirect_to, $request, $user ) {
	error_reporting(0);
	$user_blogs = get_blogs_of_user( $user->ID);
	if($user_blogs){
		foreach ($user_blogs as $key=>$user_blog) {
			foreach($user_blog as $key1=>$each){
				$my_blogs[$key1] = $each;
			}
		}
	}
	$blogurl = $my_blogs['siteurl'];
	$user_info = get_userdata($user->ID);	
	$user_roles=$user_info->roles;
	//is there a user to check?
	if(isset( $user->ID) && $user->ID !=0){
		if ( ($user->ID) == 1 || in_array("administrator",$user_roles)) {
			return admin_url();
		}else{
			$url = get_permalink( get_page_by_path( 'course-dashboard/' ));
		//echo $url;
		//return( $url);
			wp_redirect($url,301);
			die();
		//return $url;
		}
	}else{
		return admin_url();
	}
	
}

add_filter( 'login_redirect', 'my_login_redirect', 10, 3 );
add_shortcode('list-posts','list_my_post_shortcode_function');
function list_my_post_shortcode_function(){
	global $wpdb,$blog_id;
	//echo $blog_id;
	switch_to_blog($blog_id);
	$args = array( 'numberposts' => 6, 'post_status'=>"publish",'post_type'=>"post",'orderby'=>"post_date");
	$postslist = get_posts( $args );
	echo '<ul id="latest_posts">';
	foreach ($postslist as $post) :  setup_postdata($post); ?> 
	<li>
		<strong><a href="<?php the_permalink($post->ID); ?>" title="<?php echo $post->post_title;?>"> <?php echo $post->post_title; ?></a></strong>
		<?php echo $post->post_date; ?><br />
	</li>
<?php endforeach; ?>
</ul>
<?php 
restore_current_blog();
}

// ajax call for search in custom certificate page
add_action( 'wp_ajax_get_certificate_response', 'get_certificate_response' );
add_action( 'wp_ajax_nopriv_get_certificate_response', 'get_certificate_response' );
function get_certificate_response(){
	global $wpdb,$blog_id;
	$course_name = $_REQUEST['search_course'];
	//echo $course_name;
	$results = $wpdb->get_results("SELECT ID FROM wp_".$blog_id."_posts
		WHERE post_type = 'sfwd-courses' 
		AND post_status = 'publish' AND post_title LIKE '%".$course_name."%' ",ARRAY_A);
	$posts_id_arr = array();
	foreach($results as $result){
		//echo $result['ID'];
		array_push($posts_id_arr,$result['ID']);
	}
	//print_r($posts_id_arr);
	$args1 = array(
		'posts_per_page'   => 5,
		'post_type'        => 'sfwd-courses',
		'post_status'      => 'publish',
		'post__in' => $posts_id_arr
		);
	$posts_array1 = get_posts( $args1 ); 
	$view_user_id = get_current_user_id();
	if(!is_empty($posts_array1)){
		foreach ($posts_array1 AS $posts1) {
			$course_meta1 = get_post_meta($posts1->ID,'_sfwd-courses',true);
			$certificate_id1 = $course_meta1['sfwd-courses_certificate'];
			$html.="<div class='course-plus-download'><div class='course-title-id'><p><span class='coursetitle'>Course Title:  </span><span class='coursename'>".  $posts1->post_title ."</span> </p><p><span class='certificateid'>Certificate Id: </span> <span class='certid'>".$certificate_id1."</span></p></div><div class='cert-download'>";
			$course_completed_meta1 = $wpdb->get_results("SELECT * from wp_usermeta where meta_key='course_completed_".$posts1->ID."'",ARRAY_A);
			foreach($course_completed_meta1 as $completed1){
				$course_completed_by_user1 = $completed1['user_id'];
				if($course_completed_by_user1 !=""){
					$user_info = get_userdata($course_completed_by_user1);
					$display_name = $user_info->display_name;
					$cert_query_args = array(
						"course_id"	=>	$posts1->ID,
						);
					$cert_query_args['user'] = $course_completed_by_user1;
					$cert_query_args['cert-nonce'] = wp_create_nonce( $posts1->ID . $course_completed_by_user1 . $view_user_id );
					
					$url = add_query_arg( $cert_query_args, get_permalink( $certificate_id1 ) );
					//$download_url = "<button class='download-certificate'><a href=".$url.">Download Certificate</a></button>";
					$html.="<p class='download-link'>";
					$html.="<span class='dl-for-user'>Certificate Download link for User  : </span><span class='d-name'>".$display_name."</span><a href=".$url." class='url-download-certificate'>Download Certificate</a>";
					$html.="</p>";
					
				}
			}
			$html.="</div>";
			$html.="</div>";
		}
	}else{
		$html.="<div class='no_data'>No certificates found.</div>";
	}
	echo $html;
	echo "</div>";
	die();
	
}
// ajax call for search in custom student status page
add_action( 'wp_ajax_get_status_response', 'get_status_response' );
add_action( 'wp_ajax_nopriv_get_status_response', 'get_status_response' );
function get_status_response(){
	global $wpdb,$blog_id;
	$search_user = $_REQUEST['search_user'];
	//echo $course_name;
	$results = $wpdb->get_results("SELECT ID FROM wp_users
		WHERE user_login LIKE '%".$search_user."%' ",ARRAY_A);
	$arr_user = array();
	foreach($results as $result){
		array_push($arr_user,$result['ID']);
	}
	//print_r($arr_user);
	$blogusers = get_users( 'blog_id='.$blog_id );
	$arr_bloguser = array();
	foreach($blogusers as $users){
		$user_id = $users->ID;
		array_push($arr_bloguser,$user_id);
	}
	$final_arr = array_intersect($arr_user,$arr_bloguser);
	if(!empty($final_arr)){
		foreach($final_arr as $user_id => $user){
			$user_info = get_userdata($user);	
			$user_roles=$user_info->roles;
			if(in_array("administrator",$user_roles)){
			}else{	
				echo do_shortcode('[ld_profile user_id='.$user.']');
			}
		}
	}else{
		echo "<div id='learndash_profile'>Result Not Found</div>";
	}
	die();
}

/* Add option to assign a post to a subscription */
global $wpdb, $current_site, $blog_id;

$current_site_id = ! empty ( $current_site ) ? $current_site->id : 1;
$table = $wpdb->base_prefix . 'nbt_templates';
$blog_list = 
$wpdb->get_results( "SELECT * FROM ".$table." WHERE network_id = '".$current_site_id."' " , ARRAY_A );
if($blog_id == 1){
	add_action( 'add_meta_boxes', 'generate_subscription_post_assignment' );
}else{
	foreach($blog_list as $blog){
		if($blog_id == $blog['blog_id']){
			//add_action( 'add_meta_boxes', 'generate_subscription_post_assignment' );
		}
		
	}
} 
function generate_subscription_post_assignment(){
	add_meta_box( 'generate_subscription_post_assignment1', __( 'Assign to Subscription', 'share-document' ), 'generate_subscription_post_assignment_callback', 'post', 'side', 'low' );
	add_meta_box( 'generate_subscription_post_assignment2', __( 'Assign to Subscription', 'share-document' ), 'generate_subscription_post_assignment_callback', 'page', 'side', 'low' );
}
function generate_subscription_post_assignment_callback($post){
	global $post;
	switch_to_blog(1);
	$query_args_product = array(
	'post_type' => 'product', 
	'tax_query' => array(
	array(
	'taxonomy' => 'product_type',
	'field'    => 'slug',
	'terms'    => 'subscription', 
	)
	),
	);
	$loop = new WP_Query( $query_args_product );
	$replicated_at_subscription_ids = get_post_meta($post->ID,'posts_in_subscription',true);
	echo '<select name="select_subscription_all[]" multiple>';
	echo '<option value="">Share this post/page with below subscription</option>';
	foreach($loop->posts as $posts1){
	$subscription_id =  $posts1->ID;
	$subscription_title = $posts1->post_title;
	if(in_array($subscription_id,$replicated_at_subscription_ids) ){
		echo '<option value="'.$subscription_id.'" selected >'.$subscription_title.'</option>';
	}else{
		echo '<option value="'.$subscription_id.'" >'.$subscription_title.'</option>';
	}
	}
	echo '</select>';
	
	restore_current_blog();
	
}
/* Save the meta data with the current post */
function save_post_subscription($post_id){
	global $wpdb,$post,$blog_id;
	if(isset($_POST['select_subscription_all']) && $_POST['select_subscription_all']!=""){
	update_post_meta($post_id, 'posts_in_subscription', $_POST['select_subscription_all']);
	//get subscription ids from current post meta
	$subscriptions = get_post_meta($post_id,'posts_in_subscription',true);
	$shared_post_arr = get_post_meta($post_id,'shared_postmeta_id',true);
	$my_post = get_post($post_id, ARRAY_A); // get the original post
	//exit;
	//upload the thumbnail if exists
	if (isset($post->post_status) && 'inherit' == $post->post_status) {
		return;
	}
	if(has_post_thumbnail($post)){
		$the_thumbnail_id = get_post_meta($post_id, '_thumbnail_id', true);
		//echo "post - ".$post_id. "thumb id ".$the_thumbnail_id;
		//echo "Current Blog Id : ".$blog_id;
		if($blog_id == 1){
		$table_name = "wp_postmeta";

		}else{
		$table_name = "wp_".$blog_id."_postmeta";
		}
		switch_to_blog($blog_id);
		$filename = $wpdb->get_var( "SELECT meta_value FROM ".$table_name." WHERE post_id = '".$the_thumbnail_id."' AND meta_key = '_wp_attached_file'" );
		//echo  "SELECT meta_value FROM ".$table_name." WHERE post_id = '".$the_thumbnail_id."' AND meta_key = '_wp_attached_file'";
		//echo "Filename".$filename; 
		$upload_dir = wp_upload_dir();
		$filename1 =  $upload_dir['path']."/".basename($filename);	
	}
	$original_post_id = $post_id;
	//copy or update for blog templates of the subscription
	foreach($subscriptions as $subscription_id){
		// get blog template details of this subscription
		switch_to_blog(1);
		//get blog template associated with the subscription
		$table = $wpdb->base_prefix . 'nbt_templates';
		$blog_template_id = get_post_meta($subscription_id,'_blogtemplate',true);
		if($blog_template_id){
			$blog_id_of_temp = 
			$wpdb->get_var( "SELECT blog_id FROM ".$table." WHERE ID = '".$blog_template_id."' " );
			restore_current_blog();
			//now check if the current blog is not this template blog
			if($blog_id == $blog_id_of_temp ){
				
			}else{
				$blog_template_flag[] = $blog_id_of_temp;
			}
		}
	}

	//get blogs who are under a particular subscription
	//get all blogs
	$blog_list = get_blog_list( 0, 'all' );
	foreach($blog_list as $blog){
		
		switch_to_blog($blog['blog_id']);
		$site1 = $blog['blog_id'];
		$subscription_meta_of_blog = get_blog_option($blog['blog_id'],'subscription_details',true);
		$subscription_id_blog = $subscription_meta_of_blog['subscription_id'];
		// check if any direct blog is selected to copy post
		if(isset($_POST['select_blog_all'])){
		if(in_array($site1,$_POST['select_blog_all']) ){
			$direct_select_blog = $site1;
		}else{
			$direct_select_blog = -1;
		}
		}
		
		if($subscription_id_blog || is_array($blog_template_flag) && in_array($site1,$blog_template_flag) ){
			if(is_array($subscriptions)){
				if(in_array($subscription_id_blog,$subscriptions) || is_array($blog_template_flag) && in_array($site1,$blog_template_flag) ){
					//echo "Site id is : ".$site1."Blog Template : ".print($blog_template_flag);
					remove_action( current_filter(), __FUNCTION__ );
					if(false !== $key = array_search($site1, $shared_post_arr) || post_exists($my_post['post_title']) == 0){
						$my_post['ID'] = '';
						$my_post['post_name'] = '';						
						$ru_post_id1 = wp_insert_post( $my_post );
						if($filename1 != "" || $filename1 != null){
							//set thumbnail
							$wp_upload_dir = wp_upload_dir();
							$upload_file = wp_upload_bits(basename( $filename1 ), null, file_get_contents($filename1));
							if (!$upload_file['error']) {
							$wp_filetype = wp_check_filetype($filename1, null );
							$attachment = array(
							'post_mime_type' => $wp_filetype['type'],
							'post_parent' => $shared_post_arr[$site1],
							'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
							'post_content' => '',
							'post_status' => 'inherit'
							);
							$attachment_id = wp_insert_attachment( $attachment, $upload_file['file'], $ru_post_id1 );
							if (!is_wp_error($attachment_id)) {
							require_once(ABSPATH . "wp-admin" . '/includes/image.php');
							$attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
							wp_update_attachment_metadata( $attachment_id,  $attachment_data );
							}
							}
							set_post_thumbnail( $ru_post_id1, $attachment_id );
						}
						$arrnew[$site1] = $ru_post_id1;
					}else{
						if(post_exists($my_post['post_title'])!=0){
							$my_post['ID'] = post_exists($my_post['post_title']);
						}else{
							$my_post['ID'] = $shared_post_arr[$site1];
						}
						if($filename1 != "" || $filename1 != null){
							$wp_upload_dir = wp_upload_dir();
							$the_thumbnail_id_up = get_post_meta($shared_post_arr[$site1], '_thumbnail_id', true);
							$filename_up = $wpdb->get_var( "SELECT meta_value FROM wp_".$site1."_postmeta WHERE post_id = '".$the_thumbnail_id_up."' AND meta_key = '_wp_attached_file'" );
							//echo "Child :".basename($filename_up). "Mother :".basename( $filename1 ) ;exit;
							if(basename($filename_up) != basename( $filename1 )){
								$upload_file = wp_upload_bits(basename( $filename1 ), null, file_get_contents($filename1));

								if (!$upload_file['error']) {
									$wp_filetype = wp_check_filetype($filename1, null );
									$attachment = array(
									'post_mime_type' => $wp_filetype['type'],
									'post_parent' => $shared_post_arr[$site1],
									'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
									
									'post_content' => '',
									'post_status' => 'inherit'
									);
									$attachment_id = wp_insert_attachment( $attachment, $upload_file['file'], $shared_post_arr[$site1] );
									if (!is_wp_error($attachment_id)) {
										require_once(ABSPATH . "wp-admin" . '/includes/image.php');
										$attachment_data = wp_generate_attachment_metadata( $attachment_id, $upload_file['file'] );
										wp_update_attachment_metadata( $attachment_id,  $attachment_data );
									}
								}
								set_post_thumbnail( $my_post['ID'], $attachment_id );
							
							}
						}
										
						$ru_post_id2 = wp_update_post( $my_post );
					}
					
					
					if(isset($ru_post_id1)){
						update_post_meta($post_id, 'shared_postmeta_id', $arrnew);
					}
					
				}else if($blog['blog_id'] != $direct_select_blog){
					//switch_to_blog($blog['blog_id']);
					remove_action( current_filter(), __FUNCTION__ );
					$args = array(
								'post_status'      => 'publish',			
							);
					$post_details = get_posts($args); 
					foreach($post_details as $post_d){
						$post_title_in_blog = $post_d->post_title;
						if($my_post['post_title'] == $post_title_in_blog && false !== $key = array_search($blog['blog_id'], $shared_post_arr) ){
							wp_delete_post($post_d->ID,true);	
						}
					}
					$args = array(
					'post_type' => 'page',
					'post_status' => 'publish'
					); 
					$pages = get_pages($args); 
					foreach($pages as $page_d){
						$page_title_in_blog = $page_d->post_title;
						if($my_post['post_title'] == $page_title_in_blog && false !== $key = array_search($blog['blog_id'], $shared_post_arr)){
							wp_delete_post($page_d->ID,true);
						}
					}
					//restore_current_blog();
				}
			}
		}
		restore_current_blog();	
	}
	//exit;
	}
}
add_action('save_post', 'save_post_subscription');
?>