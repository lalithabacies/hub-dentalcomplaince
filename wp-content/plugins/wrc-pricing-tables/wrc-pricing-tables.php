<?php
/*
Plugin Name: WordPress Responsive CSS3 Pricing Tables
Plugin URI: http://wordpress.org/plugins/wrc-pricing-tables/
Version: 2.2.1
Description: Responsive pricing table plugin developed to display pricing table in a lot more professional way on different posts or pages by SHORTCODE.
Author: Iftekhar
Author URI: http://profiles.wordpress.org/moviehour/
*/

/*  Copyright 2016  Iftekhar  (email : realwebcare@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

define('WRCPT_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
if(is_admin()) { include ( WRCPT_PLUGIN_PATH . 'inc/admin-menu.php' ); }

function enable_pricing_package_form() {
	wp_register_script('wrcptjs', plugins_url( 'js/wrcpt-admin.min.js', __FILE__ ), array('jquery'), '2.2.1');
	wp_enqueue_script('wrcptjs');
	wp_enqueue_script('jquery-ui-sortable');
	wp_enqueue_script('jquery-ui-accordion');
	wp_enqueue_script('wp-color-picker');
	wp_localize_script('wrcptjs', 'wrcptajax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	wp_enqueue_style('wp-color-picker');
	wp_enqueue_style('wrcptfront', plugins_url( 'css/wrcpt-front.css', __FILE__ ), '', '2.2.1');
	wp_enqueue_style('wrcptadmin', plugins_url( 'css/wrcpt-admin.css', __FILE__ ), '', '2.2.1');
	wp_enqueue_style('jquery-ui-style', plugins_url( 'css/jquery-accordion.css', __FILE__ ), '', '1.10.4');
}
add_action('admin_init', 'enable_pricing_package_form');
function wrcpt_enqueue_scripts() {
	wp_enqueue_style('wrcptfront', plugins_url( 'css/wrcpt-front.css', __FILE__ ), '', '2.2.1');
	wp_register_style('googleFonts', '//fonts.googleapis.com/css?family=Roboto+Condensed');
	wp_enqueue_style( 'googleFonts');
}
add_action('wp_enqueue_scripts', 'wrcpt_enqueue_scripts');
function add_view_port() {
	echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">';
}
add_action('wp_head', 'add_view_port');
function adjustBrightness($hex, $steps) {
	$steps = max(-255, min(255, $steps));
	$hex = str_replace('#', '', $hex);
	if (strlen($hex) == 3) { $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2); }
	$r = hexdec(substr($hex,0,2));
	$g = hexdec(substr($hex,2,2));
	$b = hexdec(substr($hex,4,2));
	$r = max(0,min(255,$r + $steps));
	$g = max(0,min(255,$g + $steps));
	$b = max(0,min(255,$b + $steps));
	$r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
	$g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
	$b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);
	return '#'.$r_hex.$g_hex.$b_hex;
}
function wrc_pricing_table_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array(
		'id' => 1
	), $atts, 'wrc-pricing-table' ) );
	ob_start();
	$i = 1; $j = 0;
	$f_value = '';
	$f_tips = '';
	$pricing_table_lists = get_option('packageTables');
	$pricing_table_lists = explode(', ', $pricing_table_lists);
	$pricing_table = $pricing_table_lists[$id-1];
	$tableID = strtolower($pricing_table) . '-' .$id;
	$package_feature = get_option($pricing_table.'_feature');
	$packageCombine = get_option($pricing_table.'_option');
	$total_feature = count($package_feature)/2;
	$package_lists = get_option($pricing_table);
	$packageOptions = explode(', ', $package_lists);
	$package_count = count($packageOptions);
	if($packageCombine['cwidth']) { $container_width = (int)$packageCombine['cwidth']; } else { $container_width = 100; }
	if($packageCombine) {
		if($packageCombine['autocol'] == 'no') {
			if($package_count > $packageCombine['maxcol']) {
				$width = ($packageCombine['cwidth']-(($packageCombine['colgap']-2)/2))/$packageCombine['maxcol'] . '%';
				$cap_width = ($packageCombine['cwidth']-(($packageCombine['colgap']-1)/2))/($packageCombine['maxcol']+1) . '%';
			} else {
				$width = ($packageCombine['cwidth']-(($packageCombine['colgap']-2)/2))/$package_count . '%';
				$cap_width = ($packageCombine['cwidth']-(($packageCombine['colgap']-1)/2))/($package_count+1) . '%';
			}
		} else {
			$width = $packageCombine['colwidth'];
			$cap_width = $packageCombine['capwidth'];
		}
	}
?>
	<div id="<?php echo $tableID; ?>" class="wrcpt_content wrcpt_container">
		<div class="wrc_pricing_table wrcpt_row">
<?php
		if(!empty($package_lists) && $packageCombine['enable'] == 'yes') {
			foreach($packageOptions as $key => $value) {
				if(($j < 1 || $j % $packageCombine['maxcol'] == 0) && $j <= $package_count) {
					$i = 1;
?>
					<style type="text/css">
					<?php if($packageCombine['cwidth']) { ?>div#<?php echo $tableID; ?> {width:<?php echo $container_width; ?>%}<?php } ?>
					<?php if($packageCombine['ftcap'] != "yes") { ?>
						@media screen and (min-width: 1024px) {
							div#<?php echo $tableID; ?> div.package_details {margin-right:<?php echo $packageCombine['colgap']; ?>;width: <?php echo $width; ?>}
						}
					<?php } else { ?>
						@media screen and (min-width: 1024px) {
							div.wrcpt_content h2.caption {font-size: <?php echo $packageCombine['ctsize']; ?>}
							div#<?php echo $tableID; ?> div.package_caption {width: <?php echo $cap_width; ?>;margin-right:<?php echo $packageCombine['colgap']; ?>}
							<?php if($packageCombine['tbody']) { ?>div#<?php echo $tableID; ?> div.package_caption li.pricing_table_title {height: <?php echo $packageCombine['tbody']; ?>;}<?php } ?>
							<?php if($packageCombine['pbody']) { ?>div#<?php echo $tableID; ?> div.package_caption li.pricing_table_plan {height: <?php echo $packageCombine['pbody']; ?>;line-height: <?php echo $packageCombine['pbody']; ?>;}<?php } ?>
							<?php if($packageCombine['ftbody']) { ?>div#<?php echo $tableID; ?> div.package_caption li.feature_style_2, div#<?php echo $tableID; ?> div.package_caption li.feature_style_3 {height: <?php echo $packageCombine['ftbody']; ?>;line-height: <?php echo $packageCombine['ftbody']; ?>;}<?php } ?>
							<?php if($packageCombine['ftsize']) { ?>div#<?php echo $tableID; ?> div.package_caption li.feature_style_2 span.caption, div#<?php echo $tableID; ?> div.package_caption li.feature_style_3 span.caption {font-size: <?php echo $packageCombine['ftsize']; ?>}<?php } ?>
							div#<?php echo $tableID; ?> div.package_details {width: <?php if($packageCombine['autocol'] == 'no') { echo $cap_width; } else { echo $width; } ?>;margin-right:<?php echo $packageCombine['colgap']; ?>;margin-bottom:10px}
						}
					<?php } ?>
					<?php if($packageCombine['encol'] != "yes") { ?>
						div#<?php echo $tableID; ?> div.package_details:hover {-moz-transform: none;-webkit-transform: none;-o-transform: none;-ms-transform: none;transform: none;}
					<?php } ?>
					<?php if($packageCombine['dscol'] == "yes") { ?>
						div#<?php echo $tableID; ?> div.package_details:hover {box-shadow: none;}
					<?php } ?>
					<?php if($packageCombine['ttwidth']) { ?>
						div#<?php echo $tableID; ?> div.package_details div.text_tooltip:hover:after, div#<?php echo $tableID; ?> div.package_details div.icon_tooltip:hover:after {width: <?php echo $packageCombine['ttwidth']; ?>}
					<?php } ?>
					</style>
					<?php if($packageCombine['ftcap'] == "yes") { ?>
						<div class="package_caption">
							<ul>
								<li class="pricing_table_title"></li>
								<li class="pricing_table_plan">
									<h2 class="caption"><?php echo ucwords(str_replace('_', ' ', $pricing_table)); ?></h2>
								</li>
								<?php for($tf = 1; $tf <= $total_feature; $tf++) { ?>
									<?php if($i % 2 == 0) { ?>
										<?php if($i == $total_feature) { ?>
											<li class="feature_style_2 bottom_left_radius"><span class="caption"><?php echo $package_feature['fitem'.$tf]; ?></span></li>
										<?php } else { ?>
											<li class="feature_style_2"><span class="caption"><?php echo $package_feature['fitem'.$tf]; ?></span></li>
										<?php } ?>
									<?php } else { ?>
										<?php if($i == 1) { ?>
											<li class="feature_style_3 top_left_radius"><span class="caption"><?php echo $package_feature['fitem'.$tf]; ?></span></li>
										<?php } elseif($i == $total_feature) { ?>
											<li class="feature_style_3 bottom_left_radius"><span class="caption"><?php echo $package_feature['fitem'.$tf]; ?></span></li>
										<?php } else { ?>
											<li class="feature_style_3"><span class="caption"><?php echo $package_feature['fitem'.$tf]; ?></span></li>
										<?php } ?>
									<?php } $i++; ?>
								<?php } ?>
							</ul>
						</div>
					<?php } ?>
				<?php }
				$packageType = get_option($value);
				$tlight = adjustBrightness($packageType['tbcolor'], 80);
				$tdark = adjustBrightness($packageType['tbcolor'], 20);
				$blight = adjustBrightness($packageType['bcolor'], 50);
				$bdark = adjustBrightness($packageType['bhover'], 20);
				$rlight = adjustBrightness($packageType['rbcolor'], 80);
				$rdark = adjustBrightness($packageType['rbcolor'], 20);
				$i = 1;
				?>
				<style type="text/css">
					div#<?php echo $tableID; ?> div.package_details h2.txcolor-<?php echo $packageType['pid']; ?> {font-size: <?php echo $packageCombine['tsize']; ?>;color: <?php echo $packageType['tcolor']; ?>;}
					div#<?php echo $tableID; ?> div.package_details li.color-<?php echo $packageType['pid']; ?> {background: -moz-linear-gradient(<?php echo $tlight; ?>, <?php echo $tdark; ?>);background: -webkit-linear-gradient(<?php echo $tlight; ?>, <?php echo $tdark; ?>);background: -o-linear-gradient(<?php echo $tlight; ?>, <?php echo $tdark; ?>);background: -ms-linear-gradient(<?php echo $tlight; ?>, <?php echo $tdark; ?>);filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $tlight; ?>', endColorstr='<?php echo $tdark; ?>',GradientType=1);-ms-filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $tlight; ?>', endColorstr='<?php echo $tdark; ?>',GradientType=1);background: linear-gradient(<?php echo $tlight; ?>, <?php echo $tdark; ?>);<?php if($packageCombine['tbody']) { ?>height: <?php echo $packageCombine['tbody']; ?>;line-height: <?php echo $packageCombine['tbody']; ?>;<?php } ?>}
					div#<?php echo $tableID; ?> div.package_details h1.txcolor-<?php echo $packageType['pid']; ?> {font-size: <?php echo $packageCombine['psbig']; ?>;color: <?php echo $packageType['pcbig']; ?>;}
					div#<?php echo $tableID; ?> div.package_details h1.txcolor-<?php echo $packageType['pid']; ?> span.unit, div#<?php echo $tableID; ?> div.package_details h1.txcolor-<?php echo $packageType['pid']; ?> span.cent {font-size: <?php echo $packageCombine['pssmall']; ?>}
					div#<?php echo $tableID; ?> div.package_details li.plan-<?php echo $packageType['pid']; ?> {background: <?php echo $packageType['tbcolor']; ?>;line-height: 120px;z-index: -1;<?php if($packageCombine['pbody']) { ?>height: <?php echo $packageCombine['pbody']; ?>;line-height: <?php echo $packageCombine['pbody']; ?>;<?php } ?>}
					div#<?php echo $tableID; ?> div.package_details li.bbcolor-<?php echo $packageType['pid']; ?> {background: <?php echo $packageType['tbcolor']; ?>}
					div#<?php echo $tableID; ?> div.package_details li.button-<?php echo $packageType['pid']; ?> a.action_button {background: -moz-linear-gradient(<?php echo $blight; ?>, <?php echo $packageType['bcolor']; ?>);background: -webkit-linear-gradient(<?php echo $blight; ?>, <?php echo $packageType['bcolor']; ?>);background: -o-linear-gradient(<?php echo $blight; ?>, <?php echo $packageType['bcolor']; ?>);background: -ms-linear-gradient(<?php echo $blight; ?>, <?php echo $packageType['bcolor']; ?>);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $blight; ?>', endColorstr='<?php echo $packageType['bcolor']; ?>',GradientType=1 );-ms-filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $blight; ?>', endColorstr='<?php echo $packageType['bcolor']; ?>',GradientType=1 );background: linear-gradient(<?php echo $blight; ?>, <?php echo $packageType['bcolor']; ?>);border:1px solid <?php echo $packageType['bcolor']; ?>;font-size: <?php echo $packageCombine['btsize']; ?>;color: <?php echo $packageType['btcolor']; ?>;}
					div#<?php echo $tableID; ?> div.package_details li.button-<?php echo $packageType['pid']; ?> a.action_button:hover {background: -moz-linear-gradient(<?php echo $bdark; ?>, <?php echo $packageType['bhover']; ?>);background: -webkit-linear-gradient(<?php echo $bdark; ?>, <?php echo $packageType['bhover']; ?>);background: -o-linear-gradient(<?php echo $bdark; ?>, <?php echo $packageType['bhover']; ?>);background: -ms-linear-gradient(<?php echo $bdark; ?>, <?php echo $packageType['bhover']; ?>);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $bdark; ?>', endColorstr='<?php echo $packageType['bhover']; ?>',GradientType=1 );-ms-filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $bdark; ?>', endColorstr='<?php echo $packageType['bhover']; ?>',GradientType=1 );background: linear-gradient(<?php echo $bdark; ?>, <?php echo $packageType['bhover']; ?>);color: <?php echo $packageType['bthover']; ?>;}
					<?php if($packageCombine['ftbody']) { ?>div#<?php echo $tableID; ?> div.package_details li.ftcolor-<?php echo $packageType['pid']; ?> {height: <?php echo $packageCombine['ftbody']; ?>;line-height: <?php echo $packageCombine['ftbody']; ?>}<?php } ?>
					<?php if($packageCombine['ftsize']) { ?>div#<?php echo $tableID; ?> div.package_details li.ftcolor-<?php echo $packageType['pid']; ?> div.feat_cap, div#<?php echo $tableID; ?> div.package_details li.ftcolor-<?php echo $packageType['pid']; ?> div.text_tooltip, div#<?php echo $tableID; ?> div.package_details li.ftcolor-<?php echo $packageType['pid']; ?> span {font-size: <?php echo $packageCombine['ftsize']; ?>}<?php } ?>
					div#<?php echo $tableID; ?> div.package_details li.rowcolor-<?php echo $packageType['pid']; ?> {background-color: #DFDFDF;text-align:<?php echo $packageCombine['ftdir']; ?>}
					div#<?php echo $tableID; ?> div.package_details li.altrowcolor-<?php echo $packageType['pid']; ?> {background-color: #FAFAFA;text-align:<?php echo $packageCombine['ftdir']; ?>}
					div#<?php echo $tableID; ?> div.package_details li.ribbon_color-<?php echo $packageType['pid']; ?> {background: -moz-linear-gradient(left, <?php echo $rlight; ?>, <?php echo $packageType['rbcolor']; ?>);background: -webkit-linear-gradient(left, <?php echo $rlight; ?>, <?php echo $packageType['rbcolor']; ?>);background: -o-linear-gradient(left, <?php echo $rlight; ?>, <?php echo $packageType['rbcolor']; ?>);background: -ms-linear-gradient(left, <?php echo $rlight; ?>, <?php echo $packageType['rbcolor']; ?>);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $rlight; ?>', endColorstr='<?php echo $packageType['rbcolor']; ?>',GradientType=1 );-ms-filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='<?php echo $rlight; ?>', endColorstr='<?php echo $packageType['rbcolor']; ?>', GradientType=1);background: linear-gradient(to right, <?php echo $rlight; ?>, <?php echo $packageType['rbcolor']; ?>);<?php if($packageCombine['tbody']) { ?>top: <?php echo $packageCombine['tbody']; ?>;<?php } ?>font-size: <?php echo $packageCombine['rtsize']; ?>;color: <?php echo $packageType['rtcolor']; ?>}
					div#<?php echo $tableID; ?> div.package_details li.ribbon_color-<?php echo $packageType['pid']; ?>:before {border-color: transparent transparent transparent <?php echo $packageType['rbcolor']; ?>;}
					div#<?php echo $tableID; ?> div.package_details li.ribbon_color-<?php echo $packageType['pid']; ?>:after {border-color: transparent <?php echo $rlight; ?> transparent transparent;}
				</style>
				<div class="package_details">
					<ul>
						<?php if($packageCombine['enribs'] == "yes" && $packageType['rtext'] != '') { ?><li class="ribbon ribbon_color-<?php echo $packageType['pid']; ?>"><div class="ribbon-content"><?php echo $packageType['rtext']; ?></div></li><?php } ?>
						<li class="pricing_table_title color-<?php echo $packageType['pid']; ?> title_top_radius">
							<h2 class="package_type txcolor-<?php echo $packageType['pid']; ?>"><?php echo $packageType['type']; ?></h2>
						</li>
						<li class="pricing_table_plan plan-<?php echo $packageType['pid']; ?>">
							<h1 class="package_plan txcolor-<?php echo $packageType['pid']; ?>"><?php if(is_numeric($packageType['price'])) { ?><span class="unit"><?php echo $packageType['unit']; ?></span><span class="price"><?php echo $packageType['price']; ?></span><span class="cent"><?php if($packageType['cent']) echo '.'.$packageType['cent']; ?></span><span class="plan">/<?php echo $packageType['plan']; ?></span><?php } else { ?><?php echo $packageType['price']; ?><?php } ?></h1>
						</li>
						<?php if($package_feature) { ?>
							<?php for($tf = 1; $tf <= $total_feature; $tf++) { ?>
								<?php if(isset($packageType['fitem'.$tf])) {
										$f_value = $packageType['fitem'.$tf];
										$f_tips = $packageType['tip'.$tf]; }
								?>
								<?php if ($i % 2 == 0) { ?>
									<li class="feature_style_1 feature-align ftcolor-<?php echo $packageType['pid']; ?> rowcolor-<?php echo $packageType['pid']; ?>"><?php if($f_value == 'yes') { ?><?php if($packageCombine['entips'] == "no" || $f_tips == '') { ?><?php if($packageCombine['ftcap'] == "yes") { ?><a class="feature_yes"><span class="media_screen"><?php echo $package_feature['fitem'.$i]; ?></span></a><?php } else { ?><a class="feature_yes"><span><?php echo $package_feature['fitem'.$i]; ?></span></a><?php } ?><?php } else { ?><div class="icon_tooltip" title="<?php echo $f_tips; ?>"><?php if($packageCombine['ftcap'] == "yes") { ?><a class="feature_yes"><span class="media_screen"><?php echo $package_feature['fitem'.$i]; ?></span></a><?php } else { ?><a class="feature_yes"><span><?php echo $package_feature['fitem'.$i]; ?></span></a><?php } ?></div><?php } ?><?php } elseif($f_value == 'no' || $f_value == '') { ?><?php if($packageCombine['entips'] == "no" || $f_tips == '') { ?><?php if($packageCombine['ftcap'] == "yes") { ?><a class="feature_no"><span class="media_screen"><?php echo $package_feature['fitem'.$i]; ?></span></a><?php } else { ?><a class="feature_no"><span><?php echo $package_feature['fitem'.$i]; ?></span></a><?php } ?><?php } else { ?><div class="icon_tooltip" title="<?php echo $f_tips; ?>"><?php if($packageCombine['ftcap'] == "yes") { ?><a class="feature_no"><span class="media_screen"><?php echo $package_feature['fitem'.$i]; ?></span></a><?php } else { ?><a class="feature_no"><span><?php echo $package_feature['fitem'.$i]; ?></span></a><?php } ?></div><?php } ?><?php } else { ?><?php if($packageCombine['entips'] == "yes" && $f_tips != '') { ?><div class="text_tooltip" title="<?php echo $f_tips; ?>"><?php echo $f_value; ?></div><?php if($packageCombine['ftcap'] != "yes") { ?><span><?php echo $package_feature['fitem'.$i]; ?></span><?php } else { ?><span class="media_screen"><?php echo $package_feature['fitem'.$i]; ?></span><?php } ?><?php } else { ?><div class="feat_cap"><?php echo $f_value; ?><?php if($packageCombine['ftcap'] != "yes") { ?><span><?php echo $package_feature['fitem'.$i]; ?></span><?php } else { ?><span class="media_screen"><?php echo $package_feature['fitem'.$i]; ?></span><?php } ?></div><?php } ?><?php } ?></li>
								<?php } else { ?>
									<li class="feature_style_1 feature-align ftcolor-<?php echo $packageType['pid']; ?> altrowcolor-<?php echo $packageType['pid']; ?>"><?php if($f_value == 'yes') { ?><?php if($packageCombine['entips'] == "no" || $f_tips == '') { ?><?php if($packageCombine['ftcap'] == "yes") { ?><a class="feature_yes"><span class="media_screen"><?php echo $package_feature['fitem'.$i]; ?></span></a><?php } else { ?><a class="feature_yes"><span><?php echo $package_feature['fitem'.$i]; ?></span></a><?php } ?><?php } else { ?><div class="icon_tooltip" title="<?php echo $f_tips; ?>"><?php if($packageCombine['ftcap'] == "yes") { ?><a class="feature_yes"><span class="media_screen"><?php echo $package_feature['fitem'.$i]; ?></span></a><?php } else { ?><a class="feature_yes"><span><?php echo $package_feature['fitem'.$i]; ?></span></a><?php } ?></div><?php } ?><?php } elseif($f_value == 'no' || $f_value == '') { ?><?php if($packageCombine['entips'] == "no" || $f_tips == '') { ?><?php if($packageCombine['ftcap'] == "yes") { ?><a class="feature_no"><span class="media_screen"><?php echo $package_feature['fitem'.$i]; ?></span></a><?php } else { ?><a class="feature_no"><span><?php echo $package_feature['fitem'.$i]; ?></span></a><?php } ?><?php } else { ?><div class="icon_tooltip" title="<?php echo $f_tips; ?>"><?php if($packageCombine['ftcap'] == "yes") { ?><a class="feature_no"><span class="media_screen"><?php echo $package_feature['fitem'.$i]; ?></span></a><?php } else { ?><a class="feature_no"><span><?php echo $package_feature['fitem'.$i]; ?></span></a><?php } ?></div><?php } ?><?php } else { ?><?php if($packageCombine['entips'] == "yes" && $f_tips != '') { ?><div class="text_tooltip" title="<?php echo $f_tips; ?>"><?php echo $f_value; ?></div><?php if($packageCombine['ftcap'] != "yes") { ?><span><?php echo $package_feature['fitem'.$i]; ?></span><?php } else { ?><span class="media_screen"><?php echo $package_feature['fitem'.$i]; ?></span><?php } ?><?php } else { ?><div class="feat_cap"><?php echo $f_value; ?><?php if($packageCombine['ftcap'] != "yes") { ?><span><?php echo $package_feature['fitem'.$i]; ?></span><?php } else { ?><span class="media_screen"><?php echo $package_feature['fitem'.$i]; ?></span><?php } ?></div><?php } ?><?php } ?></li>
								<?php } $i++; ?>
							<?php } $j++; ?>
						<?php } ?>
						<li class="pricing_table_button bbcolor-<?php echo $packageType['pid']; ?> button-<?php echo $packageType['pid']; ?>"><a href="<?php echo $packageType['blink']; ?>" class="action_button"<?php if($packageCombine['nltab'] == 'yes') { ?> target="_blank"<?php } ?>><?php echo $packageType['btext']; ?></a></li>
					</ul>
				</div>
			<?php } ?>
		<?php } else { echo 'Please <strong>Enable</strong> pricing table to display pricing table columns!'; } ?>
		</div>
	</div>
	<div class="wrc_clear"></div>
<?php
	return ob_get_clean();
}
add_shortcode('wrc-pricing-table', 'wrc_pricing_table_shortcode');
?>