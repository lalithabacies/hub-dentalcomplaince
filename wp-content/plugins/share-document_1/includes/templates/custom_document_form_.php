<?php 
require_once(ABSPATH . "wp-admin" . '/includes/image.php');
require_once(ABSPATH . "wp-admin" . '/includes/file.php');
require_once(ABSPATH . "wp-admin" . '/includes/media.php');

$attachment_id = media_handle_upload('file-upload', $post->ID);

?>
<input type="file" name="file-upload" id="file-upload" />