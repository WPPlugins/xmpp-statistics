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

//Enqueue shortcodes styles & jQuery scripts
function xmpp_stats_enqueue_shortcodes_scripts() {
	$min = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';
	$type = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? 'full' : 'min';
	global $post;
	if(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'xmpp_onlineusers')) {
		wp_enqueue_style('fontawesome', XMPP_STATS_DIR_URL.'css/font-awesome'.$min.'.css', array(), '4.7.0', 'all');
		wp_enqueue_script('xmpp-onlineusers', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.xmpp-onlineusers.js', array('jquery'), XMPP_STATS_VERSION, true);
		wp_localize_script('xmpp-onlineusers', 'xmpp_onlineusers', array(
			'data_url' => admin_url('admin-ajax.php?action=get_xmpp_onlineusers'),
			'timeout' => (get_option('xmpp_stats_rest_timeout', 5)*get_option('xmpp_stats_rest_retry', 3)+5)*1000
		));
	}
	if(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'xmpp_registeredusers')) {
		wp_enqueue_style('fontawesome', XMPP_STATS_DIR_URL.'css/font-awesome'.$min.'.css', array(), '4.7.0', 'all');
		wp_enqueue_script('xmpp-registeredusers', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.xmpp-registeredusers.js', array('jquery'), XMPP_STATS_VERSION, true);
		wp_localize_script('xmpp-registeredusers', 'xmpp_registeredusers', array(
			'data_url' => admin_url('admin-ajax.php?action=get_xmpp_registeredusers'),
			'timeout' => (get_option('xmpp_stats_rest_timeout', 5)*get_option('xmpp_stats_rest_retry', 3)+5)*1000
		));
	}
	if(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'xmpp_s2s_out')) {
		wp_enqueue_style('fontawesome', XMPP_STATS_DIR_URL.'css/font-awesome'.$min.'.css', array(), '4.7.0', 'all');
		wp_enqueue_script('xmpp-s2s-out', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.xmpp-s2s-out.js', array('jquery'), XMPP_STATS_VERSION, true);
		wp_localize_script('xmpp-s2s-out', 'xmpp_s2s_out', array(
			'data_url' => admin_url('admin-ajax.php?action=get_xmpp_s2s_out'),
			'timeout' => (get_option('xmpp_stats_rest_timeout', 5)*get_option('xmpp_stats_rest_retry', 3)+5)*1000
		));
	}
	if(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'xmpp_s2s_in')) {
		wp_enqueue_style('fontawesome', XMPP_STATS_DIR_URL.'css/font-awesome'.$min.'.css', array(), '4.7.0', 'all');
		wp_enqueue_script('xmpp-s2s-in', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.xmpp-s2s-in.js', array('jquery'), XMPP_STATS_VERSION, true);
		wp_localize_script('xmpp-s2s-in', 'xmpp_s2s_in', array(
			'data_url' => admin_url('admin-ajax.php?action=get_xmpp_s2s_in'),
			'timeout' => (get_option('xmpp_stats_rest_timeout', 5)*get_option('xmpp_stats_rest_retry', 3)+5)*1000
		));
	}
	if(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'xmpp_uptime')) {
		wp_enqueue_style('hint', XMPP_STATS_DIR_URL.'css/hint'.$min.'.css', array(), '2.4.1', 'all');
		wp_enqueue_style('fontawesome', XMPP_STATS_DIR_URL.'css/font-awesome'.$min.'.css', array(), '4.7.0', 'all');
		wp_enqueue_script('xmpp-uptime', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.xmpp-uptime.js', array('jquery'), XMPP_STATS_VERSION, true);
		wp_localize_script('xmpp-uptime', 'xmpp_uptime', array(
			'data_url' => admin_url('admin-ajax.php?action=get_xmpp_uptime'),
			'timeout' => (get_option('xmpp_stats_rest_timeout', 5)*get_option('xmpp_stats_rest_retry', 3)+5)*1000
		));
	}
	if(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'system_uptime')) {
		wp_enqueue_style('hint', XMPP_STATS_DIR_URL.'css/hint'.$min.'.css', array(), '2.4.1', 'all');
		wp_enqueue_style('fontawesome', XMPP_STATS_DIR_URL.'css/font-awesome'.$min.'.css', array(), '4.7.0', 'all');
		wp_enqueue_script('system-uptime', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.system-uptime.js', array('jquery'), XMPP_STATS_VERSION, true);
		wp_localize_script('system-uptime', 'system_uptime', array(
			'data_url' => admin_url('admin-ajax.php?action=get_system_uptime'),
			'timeout' => (get_option('xmpp_stats_rest_timeout', 5)*get_option('xmpp_stats_rest_retry', 3)+5)*1000
		));
	}
}
add_action('wp_enqueue_scripts', 'xmpp_stats_enqueue_shortcodes_scripts');

//Get online users count
function shortcode_xmpp_onlineusers() {
	//Return loading information
	return '<div id="xmpp_onlineusers"><i title="'.__('Loading', 'xmpp-statistics').'..." class="fa fa-spinner fa-pulse" aria-hidden="true"></i></div>';
}
//Enqueue ajax function
function shortcode_xmpp_onlineusers_ajax() {
	//Get data
	$data = xmpp_stats_get_xmpp_data('stats', array('name' => 'onlineusers'));
	//Return response
	if(is_null($data)) wp_send_json(array('data' => '-'));
	else wp_send_json(array('data' => json_decode($data)->stat));
}
add_action('wp_ajax_nopriv_get_xmpp_onlineusers', 'shortcode_xmpp_onlineusers_ajax');
add_action('wp_ajax_get_xmpp_onlineusers', 'shortcode_xmpp_onlineusers_ajax');

//Get registered users count
function shortcode_xmpp_registeredusers() {
	//Return loading information
	return '<div id="xmpp_registeredusers"><i title="'.__('Loading', 'xmpp-statistics').'..." class="fa fa-spinner fa-pulse" aria-hidden="true"></i></div>';
}
//Enqueue ajax function
function shortcode_xmpp_registeredusers_ajax() {
	//Get data
	$data = xmpp_stats_get_xmpp_data('stats', array('name' => 'registeredusers'));
	//Return response
	if(is_null($data)) wp_send_json(array('data' => '-'));
	else wp_send_json(array('data' => json_decode($data)->stat));
}
add_action('wp_ajax_nopriv_get_xmpp_registeredusers', 'shortcode_xmpp_registeredusers_ajax');
add_action('wp_ajax_get_xmpp_registeredusers', 'shortcode_xmpp_registeredusers_ajax');

//Get outgoing s2s connections count
function shortcode_xmpp_s2s_out() {
	//Return loading information
	return '<div id="xmpp_s2s_out"><i title="'.__('Loading', 'xmpp-statistics').'..." class="fa fa-spinner fa-pulse" aria-hidden="true"></i></div>';
}
//Enqueue ajax function
function shortcode_xmpp_s2s_out_ajax() {
	//Get data
	$data = xmpp_stats_get_xmpp_data('outgoing_s2s_number');
	//Return response
	if(is_null($data)) wp_send_json(array('data' => '-'));
	else wp_send_json(array('data' => json_decode($data)->s2s_outgoing));
}
add_action('wp_ajax_nopriv_get_xmpp_s2s_out', 'shortcode_xmpp_s2s_out_ajax');
add_action('wp_ajax_get_xmpp_s2s_out', 'shortcode_xmpp_s2s_out_ajax');

//Get incoming s2s connections count
function shortcode_xmpp_s2s_in() {
	//Return loading information
	return '<div id="xmpp_s2s_in"><i title="'.__('Loading', 'xmpp-statistics').'..." class="fa fa-spinner fa-pulse" aria-hidden="true"></i></div>';
}
//Enqueue ajax function
function shortcode_xmpp_s2s_in_ajax() {
	//Get data
	$data = xmpp_stats_get_xmpp_data('incoming_s2s_number');
	//Return response
	if(is_null($data)) wp_send_json(array('data' => '-'));
	else wp_send_json(array('data' => json_decode($data)->s2s_incoming));
}
add_action('wp_ajax_nopriv_get_xmpp_s2s_in', 'shortcode_xmpp_s2s_in_ajax');
add_action('wp_ajax_get_xmpp_s2s_in', 'shortcode_xmpp_s2s_in_ajax');

//Get XMPP uptime
function shortcode_xmpp_uptime($atts) {
	//Hint attributes
	$atts = shortcode_atts(
		array(
			'hint-position' => 'right',
			'hint-style' => 'info',
		), $atts, 'xmpp_uptime');
	//Return loading information
	return '<div id="xmpp_uptime" hint-position="'.$atts['hint-position'].'" hint-style="'.$atts['hint-style'].'"><i title="'.__('Loading', 'xmpp-statistics').'..." class="fa fa-spinner fa-pulse" aria-hidden="true"></i></div>';
}
//Enqueue ajax function
function shortcode_xmpp_uptime_ajax() {
	//Get data
	$data = xmpp_stats_get_xmpp_data('stats', array('name' => 'uptimeseconds'));
	//Return response
	if(is_null($data)) wp_send_json(array('data' => '-'));
	else {
		$stat = json_decode($data)->stat;
		wp_send_json(array('data' => '<span aria-label="'.__('Last restart', 'xmpp-statistics').' '.xmpp_stats_timestamp_to_date(current_time('timestamp')-$stat).'">'.xmpp_stats_seconds_to_datestamp($stat).'</span>'));
	}
}
add_action('wp_ajax_nopriv_get_xmpp_uptime', 'shortcode_xmpp_uptime_ajax');
add_action('wp_ajax_get_xmpp_uptime', 'shortcode_xmpp_uptime_ajax');

//Get system uptime
function shortcode_system_uptime($atts) {
	//Hint attributes
	$atts = shortcode_atts(
		array(
			'hint-position' => 'right',
			'hint-style' => 'info',
		), $atts, 'system_uptime');
	//Return loading information
	return '<div id="system_uptime" hint-position="'.$atts['hint-position'].'" hint-style="'.$atts['hint-style'].'"><i title="'.__('Loading', 'xmpp-statistics').'..." class="fa fa-spinner fa-pulse" aria-hidden="true"></i></div>';
}
//Enqueue ajax function
function shortcode_system_uptime_ajax() {
	//Get data
	$data = xmpp_stats_get_system_data();
	if(is_null($data)) $data = '-';
	else {
		$last_restart = __('Last restart', 'xmpp-statistics').' '.xmpp_stats_timestamp_to_date($data+(wp_timezone_override_offset()*3600));
		$data = '<span aria-label="'.$last_restart.'">'.xmpp_stats_seconds_to_datestamp(current_time('timestamp')-$data-(wp_timezone_override_offset()*3600)).'</span>';
	}
	//Return response
	wp_send_json(array('data' => $data));
}
add_action('wp_ajax_nopriv_get_system_uptime', 'shortcode_system_uptime_ajax');
add_action('wp_ajax_get_system_uptime', 'shortcode_system_uptime_ajax');

//Add shortcodes
add_shortcode('xmpp_onlineusers', 'shortcode_xmpp_onlineusers');
add_shortcode('xmpp_registeredusers', 'shortcode_xmpp_registeredusers');
add_shortcode('xmpp_s2s_out', 'shortcode_xmpp_s2s_out');
add_shortcode('xmpp_s2s_in', 'shortcode_xmpp_s2s_in');
add_shortcode('xmpp_uptime', 'shortcode_xmpp_uptime');
add_shortcode('system_uptime', 'shortcode_system_uptime');
