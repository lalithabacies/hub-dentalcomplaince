<?php
 if ( ! defined( 'ABSPATH' ) ) { exit; } ?>

<div class="postbox" style="width: 70%; float: left; padding: 0 10px;">
    <?php
 $content = ''; $content = apply_filters( 'wpc_get_started_content', $content ); echo $content; ?>
</div>