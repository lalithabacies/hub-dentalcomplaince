<?php
//apply restriction for course content as well
function apply_course_content_restriction($current_post_id){
	global $wpdb;
	if(!is_user_logged_in()){
		return die('<div style="center;margin-top:20px;">Please login to access</div>');
	}
	if(!is_super_admin()){
		//get current user id
		$user_id = get_current_user_id();
		$user_blogs = get_blogs_of_user( $user_id );
		foreach ($user_blogs AS $user_blog) {
			if ( $user_blog->userblog_id != 1 ) {
				$users_blog = $user_blog->userblog_id;
				$subscription_details = get_blog_option($users_blog,'subscription_details',true);
				$subscription_id = $subscription_details['subscription_id'];
				//go to primary blog and take subscription meta
				switch_to_blog(1);
				$accessed_courses = get_post_meta($subscription_id,'_subscription_courses',true);
				restore_current_blog();
				//get post type from post id
				$post_type = get_post_type( $current_post_id );
				switch($post_type){
					case 'sfwd-lessons' :
						//get course details of lesson
						$course_id = get_post_meta($current_post_id,'course_id',true);
						if(is_array($accessed_courses)){
							if($course_id && in_array($course_id,$accessed_courses)){


							}else{
								return die('<div style="center;margin-top:20px;">Access do this page not allowed</div>');
							}

						}else{
							return die('<div style="center;margin-top:20px;">Access do this page not allowed</div>');
						}
						break;
					case 'sfwd-topic' :
						//get course details
						$course_id = get_post_meta($current_post_id,'course_id',true);
						if($course_id == 0){
							//if course is not selected get lesson details
							$lesson_id = get_post_meta($current_post_id,'lesson_id',true);
							//get course of that lesson
							$course_id_less = get_post_meta($lesson_id,'course_id',true);
							if($course_id_less){
								if(is_array($accessed_courses)){
									if($course_id_less && in_array($course_id_less,$accessed_courses)){


									}else{
										return die('<div style="center;margin-top:20px;">Access do this page not allowed</div>');
									}

								}else{
									return die('<div style="center;margin-top:20px;">Access do this page not allowed</div>');
								}
							}else{
								return die('<div style="center;margin-top:20px;">Access do this page not allowed</div>');
							}
						}else{
							if($course_id>0){
								if(is_array($accessed_courses)){
									if($course_id && in_array($course_id,$accessed_courses)){


									}else{
										return die('<div style="center;margin-top:20px;">Access do this page not allowed</div>');
									}

								}else{
									return die('<div style="center;margin-top:20px;">Access do this page not allowed</div>');
								}
							}else{
								return die('<div style="center;margin-top:20px;">Access do this page not allowed</div>');
							}
						}
						break;
					case 'sfwd-quiz' :
						$course_id = get_post_meta($current_post_id,'course_id',true);
						if($course_id>0){
							if(is_array($accessed_courses)){
								if($course_id && in_array($course_id,$accessed_courses)){


								}else{
									return die('<div style="center;margin-top:20px;">Access do this page not allowed</div>');
								}

							}else{
								return die('<div style="center;margin-top:20px;">Access do this page not allowed</div>');
							}
						}else{
							return die('<div style="center;margin-top:20px;">Access do this page not allowed</div>');
						}
				}
			}
		}
	}
}