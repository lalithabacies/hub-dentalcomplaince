<?php
require __DIR__.'/vendor/autoload.php';

use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxApp;
class Dropboxapi{
	
	public static $webAuth;
	private $dropboxKey;
	private $dropboxSecret;
	private $appName;
	public static $appInfo;
	public static $csrfTokenStore;
	public static $authUrl;
	public static $accessToken;
	public static $userId;

	public static function Auth(){
		session_start();
		global $wpdb;
		$_SESSION['userid']=1;
		$get_settings = get_blog_option(1,"drpbox_settings",true);
		if(is_array($get_settings)){
			$dropboxKey = $get_settings['dropbox_key'];
			$dropboxSecret = $get_settings['dropbox_secret'];
			$appName = $get_settings['dropbox_appname'];
			$app_details_glob = get_blog_option(1,'drop_box_api');
			if(is_array($app_details_glob)){
				$glob_access = $app_details_glob['accessToken'];
			}

		}else{
			return die("No Configuration for Dropbox");
		}
		$app = new DropboxApp($dropboxKey,$dropboxSecret,$glob_access);
		$dropbox = new Dropbox($app);
        return $dropbox;
        
		/*if(isset($glob_access))
		{	
			$app = new DropboxApp($dropboxKey,$dropboxSecret,$glob_access);
			$dropbox = new Dropbox($app);
			return $dropbox;
		} else {
			$appInfo=new Dropbox\AppInfo($dropboxKey,$dropboxSecret);

		//store CSRF token
			$csrfTokenStore = new Dropbox\ArrayEntryStore($_SESSION,'dropbox-auth-csrf-token');

		//Define auth details
			$webAuth = new Dropbox\WebAuth($appInfo,$appName,admin_url('admin.php?page=Documents','https'),$csrfTokenStore);

		//fetches details of app
			$app_details = get_option('drop_box_api');

			$ACCES_TOKEN = $app_details['accessToken'];

			(isset(self::$accessToken))?(self::$accessToken=$row['accessToken']):'';

			(isset($ACCES_TOKEN))?($ACCES_TOKEN=$ACCES_TOKEN):'';
			$auth_url = $webAuth->start();
			wp_redirect( $auth_url );
			exit;
		}*/
	}
	public static function show_template(){
		//error_reporting(0);
		$is_dir_restricted = 0;
		$is_under_folder = 0;
		$has_subscription = false;
		$get_settings = get_blog_option(1,"drpbox_settings",true);
		if(is_array($get_settings)){
			$dropboxKey = $get_settings['dropbox_key'];
			$dropboxSecret = $get_settings['dropbox_secret'];
			$appName = $get_settings['dropbox_appname'];
			$app_details_glob = get_blog_option(1,'drop_box_api');
			if(is_array($app_details_glob)){
				$glob_access = $app_details_glob['accessToken'];
			}

		}else{
			return die("No Configuration for Dropbox");
		}
		$app = new DropboxApp($dropboxKey,$dropboxSecret,$glob_access);
		$dropbox = new Dropbox($app);
		global $wpdb,$blog_id;
		$user_id = get_current_user_id();
		if($dropbox!=""){
			if(isset($_GET['search'])){
			$searchQuery = $_GET['search'];
			$searchResults = $dropbox->search("/", $searchQuery, ['start' => 0, 'max_results' => 5]);
			$Items = $searchResults->getItems();
			//print_r($items[0]);die;
			}else{
			$folder = isset($_GET['folder'])?$_GET['folder']:'';
			$listFolderContents = $dropbox->listFolder("/".$folder);
			$Items  = $listFolderContents->getItems();
			//print_r($Items);die;
			}
			
		}
		if(isset($_GET['folder'])){
			$is_under_folder = 1;
		}
			?>
			<div class="container dp-plugin">
				<!-- navbar-start -->
				<div class="navbar">
					<div class="navbar-header">
						<a class="nav-home" href="<?php echo self::StartHome($_SERVER['REQUEST_URI'])?>" title="Back to our first folder">
							<i class="fa fa-home" aria-hidden="true">Start</i>
						</a>
					</div>
					<div class="nav navbar-nav navbar-right">

						<form action="<?php echo $_SERVER['REQUEST_URI']?>" id="search" method="get">
							<input type="text" name="search" id="search-id" value="<?php the_search_query(); ?>" />
							<input type="hidden" value="folders" name="page" />
						</form>

					</div>
				</div>
				<!-- navbar-end -->

				<!-- column-title-start -->
				<div class="column-title">

					<div class="c-name">
						<a href="">Name</a>
						<span class="sort-icon"></span>
					</div>
					<div class="c-date-modified">
						<a href="">Date Modified</a>
					</div>
					<div class="c-date">
						<a href="">Size</a>
					</div>
					<div class="file-option">
					    <a href="">File Option</a>
					</div>
					<div class="c-checkbox">
						<input id="selectall" type="checkbox" value="">
					</div>

				</div>
			
			<!-- column-title-end -->

			<!-- content-start -->
			<div class="folders col-md-12">
	<?php
    if(isset($_GET['search'])){
    for($i=0;$i<count($Items);$i++)
	{
        $objects = $Items[$i];
        $objects = $objects->metadata;
        $pathToFile = $objects['path_lower'];
        $path=$name=$objects['name'];
		# set restriction terms for folders
		$subscription_details = get_blog_option( $blog_id, 'subscription_details', true );
		$subscription_id  = $subscription_details['subscription_id'];			
		//echo $subscription_id;
		switch_to_blog(1);
		$is_accessed = get_post_meta($subscription_id,"_folders_in_dropbox",true);
		restore_current_blog();
		//$is_accessed = get_user_meta( $user_id, 'dropbox_accessed_folders', true );
		switch_to_blog( $blog_id );
		//$site_admins_of_blog = array();
		$users_query = new WP_User_Query( array( 
					'role' => 'administrator', 
					'orderby' => 'display_name'
					) );
		$results = $users_query->get_results();					
		
		foreach($results as $user)
		{
			//get subscription status of admin user
			
			if( $user_meta = get_user_meta($user->ID, 'dropbox_folders', true )){
				$site_admin_folders = $user_meta;
			}else{
				$site_admin_folders = array();
			}
		}
		
		restore_current_blog();
		
		if(strpos($name,'/') !== false){
			$names=explode('/',$name);
			$name=$names[count($names)-1];
		}
		if(!is_super_admin( $user_id )){
			if(is_array($is_accessed)){
				
				if(!in_array($path,$is_accessed) && !in_array($path,$site_admin_folders) && $is_under_folder == 0){
							//$is_dir_restricted = 1;
							continue;						
				}
				
			}else{
				die("No Subscription and Any shared folder");
			}
						
		}
		if(!isset($objects['client_modified'])){
			?>
			<div class="for-separate col-md-12">
			<div class="folder-name col-md-4">
			<a href="<?=site_url();?>/wp-admin/admin.php?page=folders&folder=<?=trim($objects['path_display'])?>"><img src="images/folder.png"><?=$objects['name']?></a>
			</div>
			<div class="folder-date col-md-4"></div>
			<div class="folder-size col-md-2"></div>
			<div class="option">
			 </div>
			   <div class="folder-checkbox col-md-1">
				<input class="cb" type="checkbox" value="">
			  </div>
			</div>
			<?php
		}else{
            $file = $dropbox->getMetadata($pathToFile, ["include_media_info" => true, "include_deleted" => true]);
            $name = $file->getName();
            $size = $file->getSize();
            $temporaryLink = $dropbox->getTemporaryLink($objects['path_display']);
            $link = $temporaryLink->getLink();
			?>			
			<div class="for-separate">
							<div class="folder-name col-md-4 viewer" width='30%'>
								<img src="<?php echo WSA_URL?>/images/<?=$icon?>.png"><?=$name?><input type='hidden' class='link' value='<?=$link?>'>
							</div>
							<div class="folder-date"><?=$objects['client_modified']?></div>
							<div class="folder-size"><?=self::sizeFilter($size)?></div>
							<div class="folder-checkbox">
								<input class="cb" type="checkbox" value="">
							</div>

							<div class="option">
								<div class="dropdown">
									<button class="dropdown-btn" id="menu1" type="button" data-toggle="dropdown">
										File Option
									</button>
									<div class="dropdown-content">
										<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
											<li><a role="menuitem" tabindex="-1" href="<?=$link?>" target="_blank">Preview</a></li>
											<li role="presentation"><a role="menuitem" tabindex="-1" href="<?=$link?>" target="_blank">Download file</a></li> 
										</ul>
									</div>
								</div>
							</div>  
						</div>
			
			<?php
		}
    }
    }
    else{
	//$is_dir_restricted = 0;
	//print_r($Items);
	for($i=0;$i<count($Items);$i++)
	{
        $objects = $Items[$i];
        $pathToFile = $objects->path_lower;
        $path=$name=$objects->name;
		# set restriction terms for folders
		$subscription_details = get_blog_option( $blog_id, 'subscription_details', true );
		$subscription_id  = $subscription_details['subscription_id'];		
		//if(!$subscription_id) $subscription_id = '3223';
		//echo $subscription_id;
		switch_to_blog(1);
		$post_accessed = get_post_meta($subscription_id,"_folders_in_dropbox",true);
		$user_accessed = get_user_meta($subscription_id,"_folders_in_dropbox",true);
		$is_accessed = array_merge($post_accessed,$user_accessed);
		
		$product_sub_link = get_option('site_user_product_link');
		$productId = $product_sub_link['product'];
        $product_details = get_post_meta($productId);
        $product_dropbox = unserialize($product_details['_folders_in_dropbox'][0]);
        
        $membership_dropbox=unserialize();

		restore_current_blog();
		//$is_accessed = get_user_meta( $user_id, 'dropbox_accessed_folders', true );
		switch_to_blog( $blog_id );
		//$site_admins_of_blog = array();
		$users_query = new WP_User_Query( array( 
					'role' => 'administrator', 
					'orderby' => 'display_name'
					) );
		$results = $users_query->get_results();	
		//print_r($results);
		
		foreach($results as $user)
		{
			//get subscription status of admin user
			
			if( $user_meta = get_user_meta($user->ID, 'dropbox_folders', true )){
				$site_admin_folders = $user_meta;
			}else{
				$site_admin_folders = array();
			}
		}
		
		restore_current_blog();
		
		
		if(strpos($name,'/') !== false){
			$names=explode('/',$name);
			$name=$names[count($names)-1];
		}
		if(!is_super_admin( $user_id )){
			if(is_array($is_accessed)){
				if(!in_array($path,$is_accessed) && !in_array($path,$site_admin_folders) && $is_under_folder == 0){
							//$is_dir_restricted = 1;
							continue;						
				}
			}
			else{
			    if($product_sub_link){
			        if(!in_array($name,$product_dropbox)){
			            continue;
			        }
                    
			    }else{
			        die("No Subscription and Any shared folder");
			    }
			}
						
		}
		
		if(empty(trim($objects->client_modified))){
			?>
			<div class="for-separate col-md-12">
			<div class="folder-name col-md-4">
			<a href="<?=site_url();?>/documents/?page=folders&folder=<?=trim($objects->path_display)?>"><img src="images/folder.png"><?=$name?></a>
			</div>
			<div class="folder-date col-md-4"></div>
			<div class="folder-size col-md-2"></div>
			<div class="option">
			 </div>
			   <div class="folder-checkbox col-md-1">
				<input class="cb" type="checkbox" value="">
			  </div>
			</div>
			<?php
		}else{
            $file = $dropbox->getMetadata($pathToFile, ["include_media_info" => true, "include_deleted" => true]);
            $name = $file->getName();
            $size = $file->getSize();
            $temporaryLink = $dropbox->getTemporaryLink($objects->path_display);
            $link = $temporaryLink->getLink();
			?>
			
			
			<div class="for-separate">
			<div class="folder-name col-md-4 viewer" width='30%'>
				<img src="<?php echo WSA_URL?>/images/<?=$icon?>.png"><?=$name?><input type='hidden' class='link' value='<?=$link?>'>
			</div>
			<div class="folder-date"><?=$objects->client_modified?></div>
			<div class="folder-size"><?=self::sizeFilter($size)?></div>
			<div class="option">
				<div class="dropdown">
					<button class="dropdown-btn" id="menu1" type="button" data-toggle="dropdown">
						File Option
					</button>
					<div class="dropdown-content">
						<ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
							<li><a role="menuitem" tabindex="-1" href="<?=$link?>" target="_blank">Preview</a></li>
							<li role="presentation"><a role="menuitem" tabindex="-1" href="<?=$link?>" target="_blank">Download file</a></li> 
						</ul>
					</div>
				</div>
			</div>
			<div class="folder-checkbox">
				<input class="cb" type="checkbox" value="">
			</div>

						</div>
			
			<?php
			
		}
    }
	}?>	
		</div>

		<!-- content-end -->
		<div id="dialog">
			<iframe src="" width="600" height="780" style="border: none;" class='iviewer'></iframe>
		</div>

	</div>
	<!-- multiselect/deselect -->
	<?php }
	public function display_folder_list(){
		$dropboxapi=self::Auth();
		if($dropboxapi!=""){
            // $dropbox=$dropboxapi->getMetadataWithChildren('/');
            $dropbox=$dropboxapi->listFolder('/');
            $Items  = $dropbox->getItems();
		}
		return $Items;
	}

	public static function finish(){
		session_start();
		global $wpdb;
		$get_settings = get_blog_option(1,"drpbox_settings",true);
		if(is_array($get_settings)){
			$dropboxKey1 = $get_settings['dropbox_key'];
			$dropboxSecret1 = $get_settings['dropbox_secret'];
			$appName1 = $get_settings['dropbox_appname'];	
		}else{
			return die("No Configuration for Dropbox");
		}
		/*$appInfo1=new Dropbox\AppInfo($dropboxKey1,$dropboxSecret1);

		//store CSRF token
		$csrfTokenStore1 = new Dropbox\ArrayEntryStore($_SESSION,'dropbox-auth-csrf-token');

		//Define auth details
		$webAuth1 = new Dropbox\WebAuth($appInfo1,$appName1,admin_url('admin.php?page=Documents'),$csrfTokenStore1);
		
		list($accessToken1,$userId1) = $webAuth1->finish($_GET);*/
		
		$authHelper = $dropbox->getAuthHelper();
        $callbackUrl = "https://batterysolutionss.com/wp-admin/admin.php?page=Documents";
        $authUrl = $authHelper->getAuthUrl($callbackUrl);
        $parts = parse_url($authUrl);
        parse_str($parts['query'], $query);
		$accessToken = $authHelper->getAccessToken($code, $state, $callbackUrl);
		$accessToken1=$accessToken->getToken();

		$_SESSION['accessToken']=$accessToken1;
		$access_details = array("id"=>1,"userid"=>1,"dropboxKey"=>$dropboxKey1,"dropboxSecret"=>$dropboxSecret1,"appName"=>$appName1,"accessToken"=>$accessToken1,"username"=>"","dropbox_token"=>"");
		update_option('drop_box_api',$access_details);
	}
	
	public function finish_page(){
		self::finish();
		wp_redirect(admin_url('admin.php?page=folders'));
		exit;
	}
	public static function sizeFilter( $bytes )
	{
        $label = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB' );
        for( $i = 0; $bytes >= 1024 && $i < ( count( $label ) -1 ); $bytes /= 1024, $i++ );
        return( round( $bytes, 2 ) . " " . $label[$i] );
	}
	
	public static function StartHome($url,$key='search'){
    	/*unset($_GET[$key]); // delete search parameter;
        $qs = http_build_query($_GET);
        return explode("?",$url)[0]."?".$qs;*/
        return $url;
	}

}

?>