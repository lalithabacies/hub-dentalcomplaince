<?php
/**
 * Plugin Name:Dropbox Meta Box
 * Plugin URI: http://abacies.com
 * Description: Adds meta box for dropbox in the pages
 * Version: 1.1.0
 * Author: Abacies
 * Author URI: http://abacies.com
 * License: Abacies
 */
 
add_action( 'add_meta_boxes', 'cd_meta_box_add' );
function cd_meta_box_add()
{
$screens = array( 'post', 'page' );
foreach ( $screens as $screen ) {
add_meta_box( 'dropbox_boxes', 'Dropbox Folders', 'dropbox_build_meta_box', $screen, 'side', 'core');
}
}
function dropbox_build_meta_box($post){
    $value = get_post_meta($post->ID, '_dropbox_meta_key', true);
    $dropbox_api = new Dropboxapi();
    $folders_dropbox = $dropbox_api->display_folder_list();
    $stored_folders  = array();
    if(count($folders_dropbox)>0){
        for($i=0;$i<count($folders_dropbox);$i++){ 
            $objects = $folders_dropbox[$i];
            if(empty(trim($objects->client_modified))){
            $path=$objects->name;
            $checked = in_array($path,$value)?"checked":"";
            ?>
            <label class="pp-access-level"><input type="checkbox" name="_dropbox_folder[]" value="<?php echo $path?>" <?php echo $checked?>><span class="pp-access-level-label"><?php echo $path?></span></label>
            <?php
            }
        }
    }
}

function dropbox_save_postdata($post_id)
{
    if (array_key_exists('_dropbox_folder', $_POST)) {
        update_post_meta(
            $post_id,
            '_dropbox_meta_key',
            $_POST['_dropbox_folder']
        );
    }
}
add_action('save_post', 'dropbox_save_postdata');

?>