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
		global $wpdb;
		$_SESSION['userid']=1;
        $get_settings = self::get_option_values_(1,"drpbox_settings",true);
		if(is_array($get_settings)){
			$dropboxKey = $get_settings['dropbox_key'];
			$dropboxSecret = $get_settings['dropbox_secret'];
			$appName = $get_settings['dropbox_appname'];
			$app_details_glob = self::get_option_values_(1,'drop_box_api');
			if(is_array($app_details_glob)){
				$glob_access = $app_details_glob['accessToken'];
			}

		}else{
			return die("No Configuration for Dropbox");
		}
		$app = new DropboxApp($dropboxKey,$dropboxSecret,$glob_access);
		$dropbox = new Dropbox($app);
        return $dropbox;
	}
	public static function show_template(){
        global $wpdb,$post;
		//error_reporting(0);
		$is_dir_restricted = 0;
		$is_under_folder = 0;
		$has_subscription = false;
		$get_settings = self::get_option_values_(1,"drpbox_settings",true);
		if(is_array($get_settings)){
			$dropboxKey = $get_settings['dropbox_key'];
			$dropboxSecret = $get_settings['dropbox_secret'];
			$appName = $get_settings['dropbox_appname'];
			$app_details_glob = self::get_option_values_(1,'drop_box_api');
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
        
        $is_accessed = get_post_meta($post->ID,"_dropbox_meta_key",true);
		
		if(strpos($name,'/') !== false){
			$names=explode('/',$name);
			$name=$names[count($names)-1];
		}
		if(!is_super_admin( $user_id )){
			if(is_array($is_accessed)){
                if(!in_array($path,$is_accessed) && $is_under_folder == 0){
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
	for($i=0;$i<count($Items);$i++)
	{
        $objects = $Items[$i];
        $pathToFile = $objects->path_lower;
        $path=$name=$objects->name;
        
        $is_accessed = get_post_meta($post->ID,"_dropbox_meta_key",true);
		
		
		if(strpos($name,'/') !== false){
			$names=explode('/',$name);
			$name=$names[count($names)-1];
		}
		if(!is_super_admin( $user_id )){
			if(is_array($is_accessed)){
                if(!in_array($path,$is_accessed) && $is_under_folder == 0){
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
            <!--<span class="dashicons dashicons-arrow-down-alt"></span>-->
            <a role="menuitem" tabindex="-1" href="<?=$link?>" target="_blank"><i class="fa fa-arrow-circle-o-down fa-2x" aria-hidden="true"></i></a>
            </div>
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
		$get_settings = self::get_option_values_(1,"drpbox_settings",true);
		if(is_array($get_settings)){
			$dropboxKey1 = $get_settings['dropbox_key'];
			$dropboxSecret1 = $get_settings['dropbox_secret'];
			$appName1 = $get_settings['dropbox_appname'];	
		}else{
			return die("No Configuration for Dropbox");
		}
		
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
        return $url;
	}
    
    public function get_option_values_($blogid,$key,$boolean=true){
        if(is_multisite()){
            $result = get_blog_option($blogid,$key,$boolean);
        }else{
            $result = get_option($key);
        }
        return $result;
    }

}

?>