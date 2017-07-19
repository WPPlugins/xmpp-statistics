<?php
/*
	Copyright (c) 2015-2017 Krzysztof Grochocki

	This file is part of XMPP Statistics.

	XMPP Statistics is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; either version 3, or
	(at your option) any later version.

	XMPP Statistics is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with GNU Radio. If not, see <https://www.gnu.org/licenses/>.
*/

//Admin init
function xmpp_stats_register_settings() {
	//Register settings
	register_setting('xmpp_stats_settings', 'xmpp_stats_rest_url', 'trim');
	register_setting('xmpp_stats_settings', 'xmpp_stats_uptime_url', 'trim');
	register_setting('xmpp_stats_settings', 'xmpp_stats_save_data', 'boolval');
	register_setting('xmpp_stats_settings', 'xmpp_stats_delete_old_data', 'boolval');
	register_setting('xmpp_stats_settings', 'xmpp_stats_login', 'sanitize_email');
	register_setting('xmpp_stats_settings', 'xmpp_stats_password', 'trim');
	register_setting('xmpp_stats_settings', 'xmpp_stats_set_last', 'boolval');
	register_setting('xmpp_stats_settings', 'xmpp_stats_graph_width', 'intval');
	register_setting('xmpp_stats_settings', 'xmpp_stats_graph_height', 'intval');
	register_setting('xmpp_stats_settings', 'xmpp_stats_graph_line_color', 'sanitize_hex_color');
	register_setting('xmpp_stats_settings', 'xmpp_stats_graph_line_color2', 'sanitize_hex_color');
	register_setting('xmpp_stats_settings', 'xmpp_stats_graph_grid_color', 'sanitize_hex_color');
	register_setting('xmpp_stats_settings', 'xmpp_stats_daily_graph_mode', 'intval');
	register_setting('xmpp_stats_settings', 'xmpp_stats_rest_timeout', 'intval');
	register_setting('xmpp_stats_settings', 'xmpp_stats_rest_retry', 'intval');	
	//Add link to the settings on plugins page
	add_filter('plugin_action_links_'.XMPP_STATS_BASENAME, 'xmpp_stats_plugin_action_links', 10, 2);
}
add_action('admin_init', 'xmpp_stats_register_settings');

//Link to the settings on plugins page
function xmpp_stats_plugin_action_links($links) {
	array_unshift($links, '<a href="options-general.php?page=xmpp-stats-options">'.__('Settings', 'xmpp-statistics').'</a>');
    return $links;
}

//Create options menu
function xmpp_stats_add_admin_menu() {
	//Global variable
	global $xmpp_stats_options_page_hook;
	//Add options page
	$xmpp_stats_options_page_hook = add_options_page(__('XMPP Statistics', 'xmpp-statistics'), __('XMPP Statistics', 'xmpp-statistics'), 'manage_options', 'xmpp-stats-options', 'xmpp_stats_options');
	//Add the needed CSS & JavaScript
	add_action('admin_enqueue_scripts', 'xmpp_stats_options_enqueue_scripts');
	//Add the needed jQuery script
	add_action('admin_footer-'.$xmpp_stats_options_page_hook, 'xmpp_stats_options_scripts');
}
add_action('admin_menu', 'xmpp_stats_add_admin_menu');

//Add the needed CSS & JavaScript
function xmpp_stats_options_enqueue_scripts($hook_suffix) {
	//Get global variable
	global $xmpp_stats_options_page_hook;
	if($hook_suffix == $xmpp_stats_options_page_hook) {
		wp_enqueue_style('wp-color-picker');
		wp_enqueue_script('wp-color-picker');
		wp_enqueue_script('custom-script-handle', XMPP_STATS_DIR_URL.'js/min/jquery.color-picker.js', array('wp-color-picker'), false, true);
	}
}

//Add the needed jQuery script
function xmpp_stats_options_scripts() { ?>
	<style>
		.metabox-holder .postbox .hndle{
		cursor:default;
		}
		.metabox-holder .postbox.opened .hndle, .metabox-holder .postbox.closed .hndle{
		cursor:pointer;
		}
		#xmpp_stats_review_meta_box{
		background-color:#E39124;
		border:1px solid transparent;
		cursor:pointer;
		}
		#xmpp_stats_review_meta_box h2{
		border-bottom:none;
		color:#FAEBD7;
		cursor:pointer;
		}
		#xmpp_stats_review_meta_box .inside{
		margin:0;
		}
	</style>
	<script type="text/javascript">
		jQuery(document).ready( function($) {
			//Close some postboxes by default
			$('#xmpp_stats_usage_meta_box').addClass('closed');
			$('#xmpp_stats_simple_shortcodes_meta_box').addClass('closed');
			$('#xmpp_stats_graphs_shortcodes_meta_box').addClass('closed');
			//Add toggles closed to postboxes
			$('.postbox.closed .handlediv').click(function() {
				$(this).parent().toggleClass('closed').toggleClass('opened');
			});
			$('.postbox.closed .hndle').click(function() {
				$(this).parent().toggleClass('closed').toggleClass('opened');
			});
			//Remove toggles from other postboxes
			$('div.postbox:not(.closed)').each(function() {
				$(this).children('button').remove();
			});
			//Plugin review
			$("#xmpp_stats_review_meta_box").click(function() {
				window.open('https://wordpress.org/support/plugin/xmpp-statistics/reviews/?rate=5#new-post', '_blank');
			});
		});
	</script>
<?php }

//Add metaboxes
function xmpp_stats_add_meta_boxes() {
	//Get global variable
	global $xmpp_stats_options_page_hook;
	//Add settings meta box
	add_meta_box(
		'xmpp_stats_settings_meta_box',
		__('Settings', 'xmpp-statistics'),
		'xmpp_stats_settings_meta_box',
		$xmpp_stats_options_page_hook,
		'normal',
		'default'
	);
	//Add review meta box
	add_meta_box(
		'xmpp_stats_review_meta_box',
		'<span class="dashicons dashicons-star-empty"></span>&nbsp;' . __('Rate plugin', 'xmpp-statistics'),
		'xmpp_stats_review_meta_box',
		$xmpp_stats_options_page_hook,
		'side',
		'default'
	);
	//Add donate meta box
	add_meta_box(
		'xmpp_stats_donate_meta_box',
		__('Donations', 'xmpp-statistics'),
		'xmpp_stats_donate_meta_box',
		$xmpp_stats_options_page_hook,
		'side',
		'default'
	);
	//Add usage meta box
	add_meta_box(
		'xmpp_stats_usage_meta_box',
		__('Usage information', 'xmpp-statistics'),
		'xmpp_stats_usage_meta_box',
		$xmpp_stats_options_page_hook,
		'side',
		'default'
	);
	//Add simple shortcodes meta box
	add_meta_box(
		'xmpp_stats_simple_shortcodes_meta_box',
		__('Simple shortcodes', 'xmpp-statistics'),
		'xmpp_stats_simple_shortcodes_meta_box',
		$xmpp_stats_options_page_hook,
		'side',
		'default'
	);
	//Add graphs shortcodes meta box
	add_meta_box(
		'xmpp_stats_graphs_shortcodes_meta_box',
		__('Shortcodes for graphs', 'xmpp-statistics'),
		'xmpp_stats_graphs_shortcodes_meta_box',
		$xmpp_stats_options_page_hook,
		'side',
		'default'
	);
}
add_action('add_meta_boxes', 'xmpp_stats_add_meta_boxes');

//Settings meta box
function xmpp_stats_settings_meta_box() { ?>
	</div>
	<form id="xmpp-stats-form" method="post" action="options.php">
		<?php settings_fields('xmpp_stats_settings'); ?>
		<div class="inside" style="margin-top:-18px;">
			<ul>
				<li>
					<strong><?php _e('Basic options', 'xmpp-statistics'); ?></strong>
				</li>
				<li>
					<label for="xmpp_stats_rest_url"><?php _e('ReST API url', 'xmpp-statistics'); ?>:&nbsp;<input type="text" size="40" style="max-width:100%;" name="xmpp_stats_rest_url" id="xmpp_stats_rest_url" value="<?php echo get_option('xmpp_stats_rest_url'); ?>" /></label>
					</br><small><?php _e('Enter URL defined for module mod_http_api in ejabberd settings.', 'xmpp-statistics'); ?></small>
				</li>
				<li>
					<label for="xmpp_stats_uptime_url"><?php _e('URL to system uptime data', 'xmpp-statistics'); ?>:&nbsp;<input type="text" size="40" style="max-width:100%;" name="xmpp_stats_uptime_url" id="xmpp_stats_uptime_url" value="<?php echo get_option('xmpp_stats_uptime_url'); ?>" /></label>
					</br><small><?php _e('Enter URL defined for module mod_http_fileserver in ejabberd settings which returns system boot time in UNIX TimeStamp.', 'xmpp-statistics'); ?></small>
					</br><small><?php _e('Example to get system boot time:', 'xmpp-statistics'); ?> <kbd style="font-size:smaller;">cat /proc/stat | grep btime | awk '{ print $2 }' > /var/www/uptime.html</kbd></small>
				</li>
				<li>
					<label for="xmpp_stats_save_data"><input type="checkbox" id="xmpp_stats_save_data" name="xmpp_stats_save_data" value="1" <?php echo checked(1, get_option('xmpp_stats_save_data', false)); ?> /><?php _e('Save statistics', 'xmpp-statistics'); ?></label>
					</br><small><?php _e('Automatically retrieves server statistics every 5 minutes and stores them in a database.', 'xmpp-statistics'); ?> <?php _e('WP Cron fires only on the page visit and plugin could work incorrectly, to prevent such situations please add a task to system cron, for example:', 'xmpp-statistics'); ?> <kbd style="font-size:smaller;">*/1 * * * * /usr/bin/php <?php echo get_home_path(); ?>wp-cron.php</kbd></small>
				</li>
				<ol style="list-style:none;">
					<li>
						<label for="xmpp_stats_delete_old_data"><input type="checkbox" id="xmpp_stats_delete_old_data" name="xmpp_stats_delete_old_data" value="1" <?php echo checked(1, get_option('xmpp_stats_delete_old_data', false)); ?> /><?php _e('Automatically delete unnecessary data from the database', 'xmpp-statistics'); ?></label>
						</br><small><?php _e('Use this option with caution - it irrevocably removes data older than 2 weeks!', 'xmpp-statistics'); ?></small>
					</li>
				</ol>
			</ul>
			<ul>
				<li>
					<strong><?php _e('Authorization', 'xmpp-statistics'); ?></strong>
					</br><small><?php _e('Authorization is required to connect with the ReST API.', 'xmpp-statistics'); ?></small>
				</li>
				<li>
					<label for="xmpp_stats_login"><?php _e('Login', 'xmpp-statistics'); ?>:&nbsp;<input type="text" size="40" name="xmpp_stats_login" id="xmpp_stats_login" value="<?php echo get_option('xmpp_stats_login'); ?>" /></label>
					</br><label for="xmpp_stats_password"><?php _e('Password', 'xmpp-statistics'); ?>:&nbsp;<input type="password" size="40" name="xmpp_stats_password" id="xmpp_stats_password" value="<?php echo get_option('xmpp_stats_password'); ?>" /></label>
				</li>
				<li>
					<label for="xmpp_stats_set_last"><input type="checkbox" id="xmpp_stats_set_last" name="xmpp_stats_set_last" value="1" <?php echo checked(1, get_option('xmpp_stats_set_last', false)); ?> /><?php _e('Set last activity information', 'xmpp-statistics'); ?></label>
				</li>
			</ul>
			<ul>
				<li>
					<strong><?php _e('Graphs style', 'xmpp-statistics'); ?></strong>
				</li>
				<li>
					<label for="xmpp_stats_graph_width"><?php _e('Width', 'xmpp-statistics'); ?>:&nbsp;<input type="number" size="4" name="xmpp_stats_graph_width" id="xmpp_stats_graph_width" value="<?php echo get_option('xmpp_stats_graph_width', 437); ?>" />&nbsp;px</label>
				</li>
				<li>
					<label for="xmpp_stats_graph_height"><?php _e('Height', 'xmpp-statistics'); ?>:&nbsp;<input type="number" size="4" name="xmpp_stats_graph_height" id="xmpp_stats_graph_height" value="<?php echo get_option('xmpp_stats_graph_height', 220); ?>" />&nbsp;px</label>
				</li>
				<li>
					<label for="xmpp_stats_graph_line_color">
						<div style="display:inline; vertical-align:50%;"><?php _e('Line color', 'xmpp-statistics'); ?>:&nbsp</div>
						<input type="text" name="xmpp_stats_graph_line_color" id="xmpp_stats_graph_line_color" value="<?php echo get_option('xmpp_stats_graph_line_color', '#71c73e'); ?>" class="color-picker" data-default-color="#71c73e" />
					</label>
				</li>
				<li>
					<label for="xmpp_stats_graph_line_color2">
						<div style="display:inline; vertical-align:50%;"><?php _e('Line color', 'xmpp-statistics'); ?> #2:&nbsp</div>
						<input type="text" name="xmpp_stats_graph_line_color2" id="xmpp_stats_graph_line_color2" value="<?php echo get_option('xmpp_stats_graph_line_color2', '#0066b3'); ?>" class="color-picker" data-default-color="#0066b3" />
					</label>
				</li>
				<li>
					<label for="xmpp_stats_graph_grid_color">
						<div style="display:inline; vertical-align:50%;"><?php _e('Grid color', 'xmpp-statistics'); ?>:&nbsp</div>
						<input type="text" name="xmpp_stats_graph_grid_color" id="xmpp_stats_graph_grid_color" value="<?php echo get_option('xmpp_stats_graph_grid_color', '#eeeeee'); ?>" class="color-picker" data-default-color="#eeeeee" />
					</label>
				</li>
				<li>
					<?php $xmpp_stats_daily_graph_mode = get_option('xmpp_stats_daily_graph_mode', 0); ?>
					<label for="xmpp_stats_daily_graph_mode"><?php _e('Daily graphs show previous data from', 'xmpp-statistics'); ?>:&nbsp;<select name="xmpp_stats_daily_graph_mode" id="xmpp_stats_daily_graph_mode"><option value="0" <?php selected($xmpp_stats_daily_graph_mode, 0); ?>><?php _e('yesterday', 'xmpp-statistics'); ?></option><option value="1" <?php selected($xmpp_stats_daily_graph_mode, 1); ?>><?php _e('last week', 'xmpp-statistics'); ?></option></select></label>
				</li>
			</ul>
			<ul>
				<li>
					<strong><?php _e('Advanced', 'xmpp-statistics'); ?></strong>
				</li>
				<li>
					<label for="xmpp_stats_rest_timeout"><?php _e('Connection timeout with ReST API', 'xmpp-statistics'); ?>:&nbsp;<input type="number" min="5" size="4" name="xmpp_stats_rest_timeout" id="xmpp_stats_rest_timeout" value="<?php echo get_option('xmpp_stats_rest_timeout', 5); ?>" />&nbsp;s</label>
				</li>
				<li>
					<label for="xmpp_stats_rest_retry"><?php _e('Connection retry limit with ReST API', 'xmpp-statistics'); ?>:&nbsp;<input type="number" min="3" size="4" name="xmpp_stats_rest_retry" id="xmpp_stats_rest_retry" value="<?php echo get_option('xmpp_stats_rest_retry', 3); ?>" /></label>
				</li>
			</ul>
		</div>
		<div id="major-publishing-actions">
			<div id="publishing-action">
				<input type="submit" name="submit" id="submit" class="button-primary" value="<?php _e('Save settings', 'xmpp-statistics'); ?>" />
			</div>
			<div class="clear"></div>
		</div>
	</form>
	<div>
<?php }

//Review meta box
function xmpp_stats_review_meta_box() { ?>
	<?php _e('If you like this plugin, please give it a nice review', 'xmpp-statistics'); ?>
<?php }

//Donate meta box
function xmpp_stats_donate_meta_box() { ?>
	<p><?php _e('If you like this plugin, please send a donation to support its development and maintenance', 'xmpp-statistics'); ?></p>
	<p style="text-align:center; height:50px;"><a href="https://beherit.pl/donate/xmpp-statistics/" style="display: inline-block;"><img src="<?php echo XMPP_STATS_DIR_URL; ?>img/paypal.png" style="height:50px;"></a></p>
<?php }

//Usage meta box
function xmpp_stats_usage_meta_box() { ?>
	<p><?php printf(__('Make sure that you have the latest version of ejabberd - plugin requires at least ejabberd %s.', 'xmpp-statistics'), '16.04'); ?></p>
	<p><?php _e('Check that module mod_http_api and mod_http_fileserver in ejabberd is properly configured. Example configuration:', 'xmpp-statistics'); ?></p>
	<pre style="overflow-x:auto;">
modules:
  mod_http_fileserver:
    docroot: "/var/www"
    directory_indices:
      - "uptime.html"
    default_content_type: "text/html"

listen:
  - ip: "::"
    port: 5285
    module: ejabberd_http
    request_handlers:
      "/api": mod_http_api
      "/uptime": mod_http_fileserver

acl:
  rest:
    user:
      - "bot": "<?php echo preg_replace('/^www\./','',$_SERVER['SERVER_NAME']); ?>"

access:
  rest:
    rest: allow

commands_admin_access: rest
commands:
  - add_commands:
    - incoming_s2s_number
    - outgoing_s2s_number
    - set_last
    - stats</pre>
	<p><?php _e('Then configure ReST API url and authorization data, finally put shortcodes on some page.', 'xmpp-statistics'); ?></p>
<?php }

//Simple shortcodes meta box
function xmpp_stats_simple_shortcodes_meta_box() { ?>
	<ul>
		<li><b>[xmpp_onlineusers]</b></br><?php _e('Online users count', 'xmpp-statistics'); ?></br><small><?php _e('Command', 'xmpp-statistics'); ?>:&nbsp;ejabberdctl stats onlineusers</small></li>
		<li><b>[xmpp_registeredusers]</b></br><?php _e('Registered users count', 'xmpp-statistics'); ?></br><small><?php _e('Command', 'xmpp-statistics'); ?>:&nbsp;ejabberdctl stats registeredusers</small></li>
		<li><b>[xmpp_s2s_out]</b></br><?php _e('Outgoing s2s connections count', 'xmpp-statistics'); ?></br><small><?php _e('Command', 'xmpp-statistics'); ?>:&nbsp;ejabberdctl outgoing_s2s_number</small></li>
		<li><b>[xmpp_s2s_in]</b></br><?php _e('Incomming s2s connections count', 'xmpp-statistics'); ?></br><small><?php _e('Command', 'xmpp-statistics'); ?>:&nbsp;ejabberdctl incoming_s2s_number</small></li>
		<li><b>[xmpp_uptime]</b></br><?php _e('XMPP server uptime', 'xmpp-statistics'); ?></br><small><?php _e('Command', 'xmpp-statistics'); ?>:&nbsp;ejabberdctl stats uptimeseconds</small></br><small><?php _e('Optional parameters', 'xmpp-statistics'); ?>:&nbsp;hint-position, hint-style</small></li>
		<li><b>[system_uptime]</b></br><?php _e('System uptime', 'xmpp-statistics'); ?></br><small><?php _e('Optional parameters', 'xmpp-statistics'); ?>:&nbsp;hint-position, hint-style</small></li>
	</ul>
<?php }

//Graphs shortcodes meta box
function xmpp_stats_graphs_shortcodes_meta_box() { ?>
	<ul>
		<li><b>[xmpp_onlineusers_day_graph]</b></br><?php _e('Logged in users - by day', 'xmpp-statistics'); ?></li>
		<li><b>[xmpp_onlineusers_week_graph]</b></br><?php _e('Logged in users - by week', 'xmpp-statistics'); ?></li>
		<li><b>[xmpp_registeredusers_day_graph]</b></br><?php _e('Registered users - by day', 'xmpp-statistics'); ?></li>
		<li><b>[xmpp_registeredusers_week_graph]</b></br><?php _e('Registered users - by week', 'xmpp-statistics'); ?></li>
		<li><b>[xmpp_s2s_day_graph]</b></br><?php _e('S2S connections - by day', 'xmpp-statistics'); ?></li>
		<li><b>[xmpp_s2s_week_graph]</b></br><?php _e('S2S connections - by week', 'xmpp-statistics'); ?></li>
		<li><b>[xmpp_s2s_out_day_graph]</b></br><?php _e('Outgoing S2S connections - by day', 'xmpp-statistics'); ?></li>
		<li><b>[xmpp_s2s_out_week_graph]</b></br><?php _e('Outgoing S2S connections - by week', 'xmpp-statistics'); ?></li>
		<li><b>[xmpp_s2s_in_day_graph]</b></br><?php _e('Incoming S2S connections - by day', 'xmpp-statistics'); ?></li>
		<li><b>[xmpp_s2s_in_week_graph]</b></br><?php _e('Incoming S2S connections - by week', 'xmpp-statistics'); ?></li>
		<li><b>[xmpp_uptime_day_graph]</b></br><?php _e('XMPP server uptime - by day', 'xmpp-statistics'); ?></li>
		<li><b>[xmpp_uptime_week_graph]</b></br><?php _e('XMPP server uptime - by week', 'xmpp-statistics'); ?></li>
		<li><b>[system_uptime_day_graph]</b></br><?php _e('System uptime - by day', 'xmpp-statistics'); ?></li>
		<li><b>[system_uptime_week_graph]</b></br><?php _e('System uptime - by week', 'xmpp-statistics'); ?></li>
	</ul>
<?php }

//Display options page
function xmpp_stats_options() {
	//Global variable
	global $xmpp_stats_options_page_hook;
	//Enable add_meta_boxes function
	do_action('add_meta_boxes', $xmpp_stats_options_page_hook); ?>
	<div class="wrap">
		<h2><?php _e('XMPP server statistics', 'xmpp-statistics'); ?></h2>
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
				<div id="postbox-container-2" class="postbox-container">
					<?php do_meta_boxes($xmpp_stats_options_page_hook, 'normal', null); ?>
				</div>
				<div id="postbox-container-1" class="postbox-container">
					<?php do_meta_boxes($xmpp_stats_options_page_hook, 'side', null); ?>
				</div>
			</div>
		</div>
	</div>
<?php }
