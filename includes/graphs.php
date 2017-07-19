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

//Enqueue graphs style
function xmpp_stats_enqueue_graphs_scripts() {
	$min = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';
	$type = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? 'full' : 'min';
	global $post;
	if(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'xmpp_onlineusers_day_graph')) {
		wp_enqueue_style('flot', XMPP_STATS_DIR_URL.'css/flot'.$min.'.css', array(), XMPP_STATS_VERSION, 'all');
		wp_enqueue_style('fontawesome', XMPP_STATS_DIR_URL.'css/font-awesome'.$min.'.css', array(), '4.7.0', 'all');
		wp_enqueue_script('flot', XMPP_STATS_DIR_URL.'js/jquery.flot'.$min.'.js', array('jquery'), '0.8.3', true);
		wp_enqueue_script('flot-time', XMPP_STATS_DIR_URL.'js/jquery.flot.time'.$min.'.js', array('flot'), '0.8.3', true);
		wp_enqueue_script('flot-tooltip', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.flot.tooltip.js', array('flot'), XMPP_STATS_VERSION, true);
		wp_enqueue_script('xmpp-onlineusers-day-graph', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.xmpp-onlineusers-day-graph.js', array('jquery', 'flot'), XMPP_STATS_VERSION, true);
		wp_localize_script('xmpp-onlineusers-day-graph', 'xmpp_onlineusers_day_graph', array(
			'day_names' => array(__('sun', 'xmpp-statistics'), __('mon', 'xmpp-statistics'), __('tue', 'xmpp-statistics'), __('wed', 'xmpp-statistics'), __('thu', 'xmpp-statistics'), __('fri', 'xmpp-statistics'), __('sat', 'xmpp-statistics')),
			'caption' => ' '.__('users at', 'xmpp-statistics').' ',
			'grind_color' => get_option('xmpp_stats_graph_grid_color', '#eeeeee'),
			'data_url' => admin_url('admin-ajax.php?action=xmpp_onlineusers_day_graph_data'),
			'cache_data_url' => admin_url('admin-ajax.php?action=xmpp_onlineusers_day_graph_cache_data')
		));
	}
	if(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'xmpp_onlineusers_week_graph')) {
		wp_enqueue_style('flot', XMPP_STATS_DIR_URL.'css/flot'.$min.'.css', array(), XMPP_STATS_VERSION, 'all');
		wp_enqueue_style('fontawesome', XMPP_STATS_DIR_URL.'css/font-awesome'.$min.'.css', array(), '4.7.0', 'all');
		wp_enqueue_script('flot', XMPP_STATS_DIR_URL.'js/jquery.flot'.$min.'.js', array('jquery'), '0.8.3', true);
		wp_enqueue_script('flot-time', XMPP_STATS_DIR_URL.'js/jquery.flot.time'.$min.'.js', array('flot'), '0.8.3', true);
		wp_enqueue_script('flot-tooltip', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.flot.tooltip.js', array('flot'), XMPP_STATS_VERSION, true);
		wp_enqueue_script('xmpp-onlineusers-week-graph', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.xmpp-onlineusers-week-graph.js', array('jquery', 'flot'), XMPP_STATS_VERSION, true);
		wp_localize_script('xmpp-onlineusers-week-graph', 'xmpp_onlineusers_week_graph', array(
			'day_names' => array(__('sun', 'xmpp-statistics'), __('mon', 'xmpp-statistics'), __('tue', 'xmpp-statistics'), __('wed', 'xmpp-statistics'), __('thu', 'xmpp-statistics'), __('fri', 'xmpp-statistics'), __('sat', 'xmpp-statistics')),
			'caption' => ' '.__('users at', 'xmpp-statistics').' ',
			'grind_color' => get_option('xmpp_stats_graph_grid_color', '#eeeeee'),
			'data_url' => admin_url('admin-ajax.php?action=xmpp_onlineusers_week_graph_data'),
			'cache_data_url' => admin_url('admin-ajax.php?action=xmpp_onlineusers_week_graph_cache_data')
		));
	}
	if(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'xmpp_registeredusers_day_graph')) {
		wp_enqueue_style('flot', XMPP_STATS_DIR_URL.'css/flot'.$min.'.css', array(), XMPP_STATS_VERSION, 'all');
		wp_enqueue_style('fontawesome', XMPP_STATS_DIR_URL.'css/font-awesome'.$min.'.css', array(), '4.7.0', 'all');
		wp_enqueue_script('flot', XMPP_STATS_DIR_URL.'js/jquery.flot'.$min.'.js', array('jquery'), '0.8.3', true);
		wp_enqueue_script('flot-time', XMPP_STATS_DIR_URL.'js/jquery.flot.time'.$min.'.js', array('flot'), '0.8.3', true);
		wp_enqueue_script('flot-tooltip', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.flot.tooltip.js', array('flot'), XMPP_STATS_VERSION, true);
		wp_enqueue_script('xmpp-registeredusers-day-graph', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.xmpp-registeredusers-day-graph.js', array('jquery', 'flot'), XMPP_STATS_VERSION, true);
		wp_localize_script('xmpp-registeredusers-day-graph', 'xmpp_registeredusers_day_graph', array(
			'day_names' => array(__('sun', 'xmpp-statistics'), __('mon', 'xmpp-statistics'), __('tue', 'xmpp-statistics'), __('wed', 'xmpp-statistics'), __('thu', 'xmpp-statistics'), __('fri', 'xmpp-statistics'), __('sat', 'xmpp-statistics')),
			'caption' => ' '.__('users at', 'xmpp-statistics').' ',
			'grind_color' => get_option('xmpp_stats_graph_grid_color', '#eeeeee'),
			'data_url' => admin_url('admin-ajax.php?action=xmpp_registeredusers_day_graph_data'),
			'cache_data_url' => admin_url('admin-ajax.php?action=xmpp_registeredusers_day_graph_cache_data')
		));
	}
	if(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'xmpp_registeredusers_week_graph')) {
		wp_enqueue_style('flot', XMPP_STATS_DIR_URL.'css/flot'.$min.'.css', array(), XMPP_STATS_VERSION, 'all');
		wp_enqueue_style('fontawesome', XMPP_STATS_DIR_URL.'css/font-awesome'.$min.'.css', array(), '4.7.0', 'all');
		wp_enqueue_script('flot', XMPP_STATS_DIR_URL.'js/jquery.flot'.$min.'.js', array('jquery'), '0.8.3', true);
		wp_enqueue_script('flot-time', XMPP_STATS_DIR_URL.'js/jquery.flot.time'.$min.'.js', array('flot'), '0.8.3', true);
		wp_enqueue_script('flot-tooltip', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.flot.tooltip.js', array('flot'), XMPP_STATS_VERSION, true);
		wp_enqueue_script('xmpp-registeredusers-week-graph', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.xmpp-registeredusers-week-graph.js', array('jquery', 'flot'), XMPP_STATS_VERSION, true);
		wp_localize_script('xmpp-registeredusers-week-graph', 'xmpp_registeredusers_week_graph', array(
			'day_names' => array(__('sun', 'xmpp-statistics'), __('mon', 'xmpp-statistics'), __('tue', 'xmpp-statistics'), __('wed', 'xmpp-statistics'), __('thu', 'xmpp-statistics'), __('fri', 'xmpp-statistics'), __('sat', 'xmpp-statistics')),
			'caption' => ' '.__('users at', 'xmpp-statistics').' ',
			'grind_color' => get_option('xmpp_stats_graph_grid_color', '#eeeeee'),
			'data_url' => admin_url('admin-ajax.php?action=xmpp_registeredusers_week_graph_data'),
			'cache_data_url' => admin_url('admin-ajax.php?action=xmpp_registeredusers_week_graph_cache_data')
		));
	}
	if(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'xmpp_s2s_day_graph')) {
		wp_enqueue_style('flot', XMPP_STATS_DIR_URL.'css/flot'.$min.'.css', array(), XMPP_STATS_VERSION, 'all');
		wp_enqueue_style('fontawesome', XMPP_STATS_DIR_URL.'css/font-awesome'.$min.'.css', array(), '4.7.0', 'all');
		wp_enqueue_script('flot', XMPP_STATS_DIR_URL.'js/jquery.flot'.$min.'.js', array('jquery'), '0.8.3', true);
		wp_enqueue_script('flot-time', XMPP_STATS_DIR_URL.'js/jquery.flot.time'.$min.'.js', array('flot'), '0.8.3', true);
		wp_enqueue_script('flot-tooltip', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.flot.tooltip.js', array('flot'), XMPP_STATS_VERSION, true);
		wp_enqueue_script('xmpp-s2s-day-graph', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.xmpp-s2s-day-graph.js', array('jquery', 'flot'), XMPP_STATS_VERSION, true);
		wp_localize_script('xmpp-s2s-day-graph', 'xmpp_s2s_day_graph', array(
			'day_names' => array(__('sun', 'xmpp-statistics'), __('mon', 'xmpp-statistics'), __('tue', 'xmpp-statistics'), __('wed', 'xmpp-statistics'), __('thu', 'xmpp-statistics'), __('fri', 'xmpp-statistics'), __('sat', 'xmpp-statistics')),
			'caption' => ' '.__('at', 'xmpp-statistics').' ',
			'grind_color' => get_option('xmpp_stats_graph_grid_color', '#eeeeee'),
			'data_url' => admin_url('admin-ajax.php?action=xmpp_s2s_day_graph_data'),
			'cache_data_url' => admin_url('admin-ajax.php?action=xmpp_s2s_day_graph_cache_data')
		));
	}
	if(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'xmpp_s2s_week_graph')) {
		wp_enqueue_style('flot', XMPP_STATS_DIR_URL.'css/flot'.$min.'.css', array(), XMPP_STATS_VERSION, 'all');
		wp_enqueue_style('fontawesome', XMPP_STATS_DIR_URL.'css/font-awesome'.$min.'.css', array(), '4.7.0', 'all');
		wp_enqueue_script('flot', XMPP_STATS_DIR_URL.'js/jquery.flot'.$min.'.js', array('jquery'), '0.8.3', true);
		wp_enqueue_script('flot-time', XMPP_STATS_DIR_URL.'js/jquery.flot.time'.$min.'.js', array('flot'), '0.8.3', true);
		wp_enqueue_script('flot-tooltip', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.flot.tooltip.js', array('flot'), XMPP_STATS_VERSION, true);
		wp_enqueue_script('xmpp-s2s-week-graph', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.xmpp-s2s-week-graph.js', array('jquery', 'flot'), XMPP_STATS_VERSION, true);
		wp_localize_script('xmpp-s2s-week-graph', 'xmpp_s2s_week_graph', array(
			'day_names' => array(__('sun', 'xmpp-statistics'), __('mon', 'xmpp-statistics'), __('tue', 'xmpp-statistics'), __('wed', 'xmpp-statistics'), __('thu', 'xmpp-statistics'), __('fri', 'xmpp-statistics'), __('sat', 'xmpp-statistics')),
			'caption' => ' '.__('at', 'xmpp-statistics').' ',
			'grind_color' => get_option('xmpp_stats_graph_grid_color', '#eeeeee'),
			'data_url' => admin_url('admin-ajax.php?action=xmpp_s2s_week_graph_data'),
			'cache_data_url' => admin_url('admin-ajax.php?action=xmpp_s2s_week_graph_cache_data')
		));
	}
	if(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'xmpp_s2s_out_day_graph')) {
		wp_enqueue_style('flot', XMPP_STATS_DIR_URL.'css/flot'.$min.'.css', array(), XMPP_STATS_VERSION, 'all');
		wp_enqueue_style('fontawesome', XMPP_STATS_DIR_URL.'css/font-awesome'.$min.'.css', array(), '4.7.0', 'all');
		wp_enqueue_script('flot', XMPP_STATS_DIR_URL.'js/jquery.flot'.$min.'.js', array('jquery'), '0.8.3', true);
		wp_enqueue_script('flot-time', XMPP_STATS_DIR_URL.'js/jquery.flot.time'.$min.'.js', array('flot'), '0.8.3', true);
		wp_enqueue_script('flot-tooltip', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.flot.tooltip.js', array('flot'), XMPP_STATS_VERSION, true);
		wp_enqueue_script('xmpp-s2s-out-day-graph', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.xmpp-s2s-out-day-graph.js', array('jquery', 'flot'), XMPP_STATS_VERSION, true);
		wp_localize_script('xmpp-s2s-out-day-graph', 'xmpp_s2s_out_day_graph', array(
			'day_names' => array(__('sun', 'xmpp-statistics'), __('mon', 'xmpp-statistics'), __('tue', 'xmpp-statistics'), __('wed', 'xmpp-statistics'), __('thu', 'xmpp-statistics'), __('fri', 'xmpp-statistics'), __('sat', 'xmpp-statistics')),
			'caption' => ' '.__('outgoing connections at', 'xmpp-statistics').' ',
			'grind_color' => get_option('xmpp_stats_graph_grid_color', '#eeeeee'),
			'data_url' => admin_url('admin-ajax.php?action=xmpp_s2s_out_day_graph_data'),
			'cache_data_url' => admin_url('admin-ajax.php?action=xmpp_s2s_out_day_graph_cache_data')
		));
	}
	if(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'xmpp_s2s_out_week_graph')) {
		wp_enqueue_style('flot', XMPP_STATS_DIR_URL.'css/flot'.$min.'.css', array(), XMPP_STATS_VERSION, 'all');
		wp_enqueue_style('fontawesome', XMPP_STATS_DIR_URL.'css/font-awesome'.$min.'.css', array(), '4.7.0', 'all');
		wp_enqueue_script('flot', XMPP_STATS_DIR_URL.'js/jquery.flot'.$min.'.js', array('jquery'), '0.8.3', true);
		wp_enqueue_script('flot-time', XMPP_STATS_DIR_URL.'js/jquery.flot.time'.$min.'.js', array('flot'), '0.8.3', true);
		wp_enqueue_script('flot-tooltip', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.flot.tooltip.js', array('flot'), XMPP_STATS_VERSION, true);
		wp_enqueue_script('xmpp-s2s-out-week-graph', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.xmpp-s2s-out-week-graph.js', array('jquery', 'flot'), XMPP_STATS_VERSION, true);
		wp_localize_script('xmpp-s2s-out-week-graph', 'xmpp_s2s_out_week_graph', array(
			'day_names' => array(__('sun', 'xmpp-statistics'), __('mon', 'xmpp-statistics'), __('tue', 'xmpp-statistics'), __('wed', 'xmpp-statistics'), __('thu', 'xmpp-statistics'), __('fri', 'xmpp-statistics'), __('sat', 'xmpp-statistics')),
			'caption' => ' '.__('outgoing connections at', 'xmpp-statistics').' ',
			'grind_color' => get_option('xmpp_stats_graph_grid_color', '#eeeeee'),
			'data_url' => admin_url('admin-ajax.php?action=xmpp_s2s_out_week_graph_data'),
			'cache_data_url' => admin_url('admin-ajax.php?action=xmpp_s2s_out_week_graph_cache_data')
		));
	}
	if(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'xmpp_s2s_in_day_graph')) {
		wp_enqueue_style('flot', XMPP_STATS_DIR_URL.'css/flot'.$min.'.css', array(), XMPP_STATS_VERSION, 'all');
		wp_enqueue_style('fontawesome', XMPP_STATS_DIR_URL.'css/font-awesome'.$min.'.css', array(), '4.7.0', 'all');
		wp_enqueue_script('flot', XMPP_STATS_DIR_URL.'js/jquery.flot'.$min.'.js', array('jquery'), '0.8.3', true);
		wp_enqueue_script('flot-time', XMPP_STATS_DIR_URL.'js/jquery.flot.time'.$min.'.js', array('flot'), '0.8.3', true);
		wp_enqueue_script('flot-tooltip', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.flot.tooltip.js', array('flot'), XMPP_STATS_VERSION, true);
		wp_enqueue_script('xmpp-s2s-in-day-graph', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.xmpp-s2s-in-day-graph.js', array('jquery', 'flot'), XMPP_STATS_VERSION, true);
		wp_localize_script('xmpp-s2s-in-day-graph', 'xmpp_s2s_in_day_graph', array(
			'day_names' => array(__('sun', 'xmpp-statistics'), __('mon', 'xmpp-statistics'), __('tue', 'xmpp-statistics'), __('wed', 'xmpp-statistics'), __('thu', 'xmpp-statistics'), __('fri', 'xmpp-statistics'), __('sat', 'xmpp-statistics')),
			'caption' => ' '.__('incoming connections at', 'xmpp-statistics').' ',
			'grind_color' => get_option('xmpp_stats_graph_grid_color', '#eeeeee'),
			'data_url' => admin_url('admin-ajax.php?action=xmpp_s2s_in_day_graph_data'),
			'cache_data_url' => admin_url('admin-ajax.php?action=xmpp_s2s_in_day_graph_cache_data')
		));
	}
	if(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'xmpp_s2s_in_week_graph')) {
		wp_enqueue_style('flot', XMPP_STATS_DIR_URL.'css/flot'.$min.'.css', array(), XMPP_STATS_VERSION, 'all');
		wp_enqueue_style('fontawesome', XMPP_STATS_DIR_URL.'css/font-awesome'.$min.'.css', array(), '4.7.0', 'all');
		wp_enqueue_script('flot', XMPP_STATS_DIR_URL.'js/jquery.flot'.$min.'.js', array('jquery'), '0.8.3', true);
		wp_enqueue_script('flot-time', XMPP_STATS_DIR_URL.'js/jquery.flot.time'.$min.'.js', array('flot'), '0.8.3', true);
		wp_enqueue_script('flot-tooltip', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.flot.tooltip.js', array('flot'), XMPP_STATS_VERSION, true);
		wp_enqueue_script('xmpp-s2s-in-week-graph', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.xmpp-s2s-in-week-graph.js', array('jquery', 'flot'), XMPP_STATS_VERSION, true);
		wp_localize_script('xmpp-s2s-in-week-graph', 'xmpp_s2s_in_week_graph', array(
			'day_names' => array(__('sun', 'xmpp-statistics'), __('mon', 'xmpp-statistics'), __('tue', 'xmpp-statistics'), __('wed', 'xmpp-statistics'), __('thu', 'xmpp-statistics'), __('fri', 'xmpp-statistics'), __('sat', 'xmpp-statistics')),
			'caption' => ' '.__('incoming connections at', 'xmpp-statistics').' ',
			'grind_color' => get_option('xmpp_stats_graph_grid_color', '#eeeeee'),
			'data_url' => admin_url('admin-ajax.php?action=xmpp_s2s_in_week_graph_data'),
			'cache_data_url' => admin_url('admin-ajax.php?action=xmpp_s2s_in_week_graph_cache_data')
		));
	}
	if(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'xmpp_uptime_day_graph')) {
		wp_enqueue_style('flot', XMPP_STATS_DIR_URL.'css/flot'.$min.'.css', array(), XMPP_STATS_VERSION, 'all');
		wp_enqueue_style('fontawesome', XMPP_STATS_DIR_URL.'css/font-awesome'.$min.'.css', array(), '4.7.0', 'all');
		wp_enqueue_script('flot', XMPP_STATS_DIR_URL.'js/jquery.flot'.$min.'.js', array('jquery'), '0.8.3', true);
		wp_enqueue_script('flot-time', XMPP_STATS_DIR_URL.'js/jquery.flot.time'.$min.'.js', array('flot'), '0.8.3', true);
		wp_enqueue_script('flot-tooltip', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.flot.tooltip.js', array('flot'), XMPP_STATS_VERSION, true);
		wp_enqueue_script('xmpp-uptime-day-graph', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.xmpp-uptime-day-graph.js', array('jquery', 'flot'), XMPP_STATS_VERSION, true);
		wp_localize_script('xmpp-uptime-day-graph', 'xmpp_uptime_day_graph', array(
			'day_names' => array(__('sun', 'xmpp-statistics'), __('mon', 'xmpp-statistics'), __('tue', 'xmpp-statistics'), __('wed', 'xmpp-statistics'), __('thu', 'xmpp-statistics'), __('fri', 'xmpp-statistics'), __('sat', 'xmpp-statistics')),
			'grind_color' => get_option('xmpp_stats_graph_grid_color', '#eeeeee'),
			'data_url' => admin_url('admin-ajax.php?action=xmpp_uptime_day_graph_data'),
			'cache_data_url' => admin_url('admin-ajax.php?action=xmpp_uptime_day_graph_cache_data')
		));
	}
	if(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'xmpp_uptime_week_graph')) {
		wp_enqueue_style('flot', XMPP_STATS_DIR_URL.'css/flot'.$min.'.css', array(), XMPP_STATS_VERSION, 'all');
		wp_enqueue_style('fontawesome', XMPP_STATS_DIR_URL.'css/font-awesome'.$min.'.css', array(), '4.7.0', 'all');
		wp_enqueue_script('flot', XMPP_STATS_DIR_URL.'js/jquery.flot'.$min.'.js', array('jquery'), '0.8.3', true);
		wp_enqueue_script('flot-time', XMPP_STATS_DIR_URL.'js/jquery.flot.time'.$min.'.js', array('flot'), '0.8.3', true);
		wp_enqueue_script('flot-tooltip', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.flot.tooltip.js', array('flot'), XMPP_STATS_VERSION, true);
		wp_enqueue_script('xmpp-uptime-week-graph', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.xmpp-uptime-week-graph.js', array('jquery', 'flot'), XMPP_STATS_VERSION, true);
		wp_localize_script('xmpp-uptime-week-graph', 'xmpp_uptime_week_graph', array(
			'day_names' => array(__('sun', 'xmpp-statistics'), __('mon', 'xmpp-statistics'), __('tue', 'xmpp-statistics'), __('wed', 'xmpp-statistics'), __('thu', 'xmpp-statistics'), __('fri', 'xmpp-statistics'), __('sat', 'xmpp-statistics')),
			'grind_color' => get_option('xmpp_stats_graph_grid_color', '#eeeeee'),
			'data_url' => admin_url('admin-ajax.php?action=xmpp_uptime_week_graph_data'),
			'cache_data_url' => admin_url('admin-ajax.php?action=xmpp_uptime_week_graph_cache_data')
		));
	}
	if(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'system_uptime_day_graph')) {
		wp_enqueue_style('flot', XMPP_STATS_DIR_URL.'css/flot'.$min.'.css', array(), XMPP_STATS_VERSION, 'all');
		wp_enqueue_style('fontawesome', XMPP_STATS_DIR_URL.'css/font-awesome'.$min.'.css', array(), '4.7.0', 'all');
		wp_enqueue_script('flot', XMPP_STATS_DIR_URL.'js/jquery.flot'.$min.'.js', array('jquery'), '0.8.3', true);
		wp_enqueue_script('flot-time', XMPP_STATS_DIR_URL.'js/jquery.flot.time'.$min.'.js', array('flot'), '0.8.3', true);
		wp_enqueue_script('flot-tooltip', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.flot.tooltip.js', array('flot'), XMPP_STATS_VERSION, true);
		wp_enqueue_script('system-uptime-day-graph', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.system-uptime-day-graph.js', array('jquery', 'flot'), XMPP_STATS_VERSION, true);
		wp_localize_script('system-uptime-day-graph', 'system_uptime_day_graph', array(
			'day_names' => array(__('sun', 'xmpp-statistics'), __('mon', 'xmpp-statistics'), __('tue', 'xmpp-statistics'), __('wed', 'xmpp-statistics'), __('thu', 'xmpp-statistics'), __('fri', 'xmpp-statistics'), __('sat', 'xmpp-statistics')),
			'grind_color' => get_option('xmpp_stats_graph_grid_color', '#eeeeee'),
			'data_url' => admin_url('admin-ajax.php?action=system_uptime_day_graph_data'),
			'cache_data_url' => admin_url('admin-ajax.php?action=system_uptime_day_graph_cache_data')
		));
	}
	if(is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'system_uptime_week_graph')) {
		wp_enqueue_style('flot', XMPP_STATS_DIR_URL.'css/flot'.$min.'.css', array(), XMPP_STATS_VERSION, 'all');
		wp_enqueue_style('fontawesome', XMPP_STATS_DIR_URL.'css/font-awesome'.$min.'.css', array(), '4.7.0', 'all');
		wp_enqueue_script('flot', XMPP_STATS_DIR_URL.'js/jquery.flot'.$min.'.js', array('jquery'), '0.8.3', true);
		wp_enqueue_script('flot-time', XMPP_STATS_DIR_URL.'js/jquery.flot.time'.$min.'.js', array('flot'), '0.8.3', true);
		wp_enqueue_script('flot-tooltip', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.flot.tooltip.js', array('flot'), XMPP_STATS_VERSION, true);
		wp_enqueue_script('system-uptime-week-graph', XMPP_STATS_DIR_URL.'js/'.$type.'/jquery.system-uptime-week-graph.js', array('jquery', 'flot'), XMPP_STATS_VERSION, true);
		wp_localize_script('system-uptime-week-graph', 'system_uptime_week_graph', array(
			'day_names' => array(__('sun', 'xmpp-statistics'), __('mon', 'xmpp-statistics'), __('tue', 'xmpp-statistics'), __('wed', 'xmpp-statistics'), __('thu', 'xmpp-statistics'), __('fri', 'xmpp-statistics'), __('sat', 'xmpp-statistics')),
			'grind_color' => get_option('xmpp_stats_graph_grid_color', '#eeeeee'),
			'data_url' => admin_url('admin-ajax.php?action=system_uptime_week_graph_data'),
			'cache_data_url' => admin_url('admin-ajax.php?action=system_uptime_week_graph_cache_data')
		));
	}
}
add_action('wp_enqueue_scripts', 'xmpp_stats_enqueue_graphs_scripts');

//Show online users day graph
function shortcode_xmpp_onlineusers_day_graph() {
	//Return loading information
	return '<div class="graph-container"><h3>'.__('Logged in users - by day', 'xmpp-statistics').'</h3><div id="xmpp_onlineusers_day_graph" style="max-width:'.get_option('xmpp_stats_graph_width', 437).'px; height:'.get_option('xmpp_stats_graph_height', 220).'px;" class="graph-placeholder"><i title="'.__('Loading', 'xmpp-statistics').'..." class="fa fa-spinner fa-pulse" style="line-height:'.get_option('xmpp_stats_graph_height', 220).'px;" aria-hidden="true"></i></div></div>';
}
//Return graph data in json via ajax
function shortcode_xmpp_onlineusers_day_graph_json() {
	//Datebase data
	global $wpdb;
	$table_name = $wpdb->prefix . 'xmpp_stats';
	//Get latest record
	$latest_record = $wpdb->get_row("SELECT * FROM $table_name WHERE type = '1' ORDER BY timestamp DESC");
	//Calculating oldest date
	$oldest = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(24*60*60));
	//Get data from the last 24 hours
	$current_rows = $wpdb->get_results("SELECT * FROM $table_name WHERE type = '1' AND timestamp > '$oldest' ORDER BY timestamp ASC");
	//Auxiliary variables
	$count = 0;
	$prev_timestamp = 0;
	//Foreach data
	foreach($current_rows as $current_row) {
		$value = $current_row->value;
		$prev_value = $current_rows[$count-1]->value;
		$next_value = $current_rows[$count+1]->value;
		if(($value == 0) && ($prev_value != 0) && (($next_value != 0) || !$next_value)) {
			/* probably connection error */
		} else {
			//Get current timestamp
			$timestamp = strtotime($current_row->timestamp);
			//Check previous timestamp
			if($prev_timestamp) {
				$prev_timestamp = $timestamp - $prev_timestamp;
				//Gaps in data
				if($prev_timestamp>3600) {
					$current_data[] = array(($timestamp-1800)*1000, null);
				}
			}
			//Save current timestamp as previous
			$prev_timestamp = $timestamp;
			//Put data in array
			$current_data[] = array($timestamp*1000, (int)$value);
		}
		$count++;
	}
	//Calculating previous older and oldest date
	$xmpp_stats_daily_graph_mode = get_option('xmpp_stats_daily_graph_mode', 0);
	if($xmpp_stats_daily_graph_mode == 0) {
		$older = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(24*60*60));
		$oldest = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(2*24*60*60));
	} else {
		$older = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(7*24*60*60));
		$oldest = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(8*24*60*60));
	}
	//Get the previous data from yesterday / last week
	$previous_rows = $wpdb->get_results("SELECT * FROM $table_name WHERE type = '1' AND timestamp > '$oldest' AND timestamp < '$older' ORDER BY timestamp ASC");
	//Auxiliary variables
	$count = 0;
	$prev_timestamp = 0;
	//Foreach data
	foreach($previous_rows as $previous_row) {
		$value = $previous_row->value;
		$prev_value = $previous_rows[$count-1]->value;
		$next_value = $previous_rows[$count+1]->value;
		if(($value == 0) && ($prev_value != 0) && (($next_value != 0) || !$next_value)) {
			/* probably connection error */
		} else {
			//Get current timestamp
			$timestamp = strtotime($previous_row->timestamp);
			//Check previous timestamp
			if($prev_timestamp) {
				$prev_timestamp = $timestamp - $prev_timestamp;
				//Gaps in data
				if($prev_timestamp>3600) {
					if($xmpp_stats_daily_graph_mode == 0) {
						$previous_data[] = array(($timestamp+(24*60*60)-1800)*1000, null);
					} else {
						$previous_data[] = array(($timestamp+(7*4*60*60)-1800)*1000, null);	
					}
				}
			}
			//Save current timestamp as previous
			$prev_timestamp = $timestamp;
			//Put data in array
			if($xmpp_stats_daily_graph_mode == 0) {
				$previous_data[] = array(($timestamp+(24*60*60))*1000, (int)$value);
			} else {
				$previous_data[] = array(($timestamp+(7*24*60*60))*1000, (int)$value);
			}
		}
		$count++;
	}
	//Save cache
	set_transient('xmpp_stats_onlineusers_day_graph', array('current' => $current_data, 'previous' => $previous_data), 0);
	//Calculating the line color
	$hex = get_option('xmpp_stats_graph_line_color2', '#0066b3');
	list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
	$previous_color = 'rgba('.$r.', '.$g.', '.$b.', 0.3)';
	//Return response
	$resp = array(
		array('color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'caption' => '', 'data' => $current_data),
		array('color' => $previous_color, 'caption' => __('Previously', 'xmpp-statistics').' ', 'data' => $previous_data)
	);
	wp_send_json($resp);
}
add_action('wp_ajax_nopriv_xmpp_onlineusers_day_graph_data', 'shortcode_xmpp_onlineusers_day_graph_json');
add_action('wp_ajax_xmpp_onlineusers_day_graph_data', 'shortcode_xmpp_onlineusers_day_graph_json');
//Return graph cache data in json via ajax
function shortcode_xmpp_onlineusers_day_graph_cache_json() {
	//Get cache
	if(true == ($data = get_transient('xmpp_stats_onlineusers_day_graph'))) {
		//Calculating the line color
		$hex = get_option('xmpp_stats_graph_line_color2', '#0066b3');
		list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
		$previous_color = 'rgba('.$r.', '.$g.', '.$b.', 0.3)';
		//Return cache
		$resp = array(
			array('color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'caption' => '', 'data' => $data['current']),
			array('color' => $previous_color, 'caption' => __('Previously', 'xmpp-statistics').' ', 'data' => $data['previous'])
		);
		wp_send_json($resp);
	}
	//No data
	wp_send_json();
}
add_action('wp_ajax_nopriv_xmpp_onlineusers_day_graph_cache_data', 'shortcode_xmpp_onlineusers_day_graph_cache_json');
add_action('wp_ajax_xmpp_onlineusers_day_graph_cache_data', 'shortcode_xmpp_onlineusers_day_graph_cache_json');

//Show online users week graph
function shortcode_xmpp_onlineusers_week_graph() {
	//Return loading information
	return '<div class="graph-container"><h3>'.__('Logged in users - by week', 'xmpp-statistics').'</h3><div id="xmpp_onlineusers_week_graph" style="max-width:'.get_option('xmpp_stats_graph_width', 437).'px; height:'.get_option('xmpp_stats_graph_height', 220).'px;" class="graph-placeholder"><i title="'.__('Loading', 'xmpp-statistics').'..." class="fa fa-spinner fa-pulse" style="line-height:'.get_option('xmpp_stats_graph_height', 220).'px;" aria-hidden="true"></i></div></div>';
}
//Return graph data in json via ajax
function shortcode_xmpp_onlineusers_week_graph_json() {
	//Datebase data
	global $wpdb;
	$table_name = $wpdb->prefix . 'xmpp_stats';
	//Get latest record
	$latest_record = $wpdb->get_row("SELECT * FROM $table_name WHERE type = '1' ORDER BY timestamp DESC");
	//Calculating oldest date
	$oldest = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(7*24*60*60));
	//Get data from the last week
	$current_rows = $wpdb->get_results("SELECT * FROM $table_name WHERE type = '1' AND timestamp > '$oldest' ORDER BY timestamp ASC");
	//Auxiliary variables
	$count = 0;
	$lenght = count($current_rows);
	$prev_timestamp = 0;
	//Foreach data
	foreach($current_rows as $current_row) {
		if((($count+1)%6==0)||($count==$lenght-1)) {
			$value = $current_row->value;
			$prev_value = $current_rows[$count-1]->value;
			$next_value = $current_rows[$count+1]->value;
			if(($value == 0) && ($prev_value != 0) && (($next_value != 0) || !$next_value)) {
				/* probably connection error */
			} else {
				//Get current timestamp
				$timestamp = strtotime($current_row->timestamp);
				//Check previous timestamp
				if($prev_timestamp) {
					$prev_timestamp = $timestamp - $prev_timestamp;
					//Gaps in data
					if($prev_timestamp>3600) {
						$current_data[] = array(($timestamp-1800)*1000, null);
					}
				}
				//Save current timestamp as previous
				$prev_timestamp = $timestamp;
				//Put data in array
				$current_data[] = array($timestamp*1000, (int)$value);
			}
		}
		$count++;
	}
	//Calculating previous older and oldest date
	$older = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(7*24*60*60));
	$oldest = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(14*24*60*60));
	//Get data from the previous week
	$previous_rows = $wpdb->get_results("SELECT * FROM $table_name WHERE type = '1' AND timestamp > '$oldest' AND timestamp < '$older' ORDER BY timestamp ASC");
	//Auxiliary variables
	$count = 0;
	$lenght = count($previous_rows);
	$prev_timestamp = 0;
	//Foreach data
	foreach($previous_rows as $previous_row) {
		if((($count+1)%6==0)||($count==$lenght-1)) {
			$value = $previous_row->value;
			$prev_value = $previous_rows[$count-1]->value;
			$next_value = $previous_rows[$count+1]->value;
			if(($value == 0) && ($prev_value != 0) && (($next_value != 0) || !$next_value)) {
				/* probably connection error */
			} else {
				//Get current timestamp
				$timestamp = strtotime($previous_row->timestamp);
				//Check previous timestamp
				if($prev_timestamp) {
					$prev_timestamp = $timestamp - $prev_timestamp;
					//Gaps in data
					if($prev_timestamp>3600) {
						$previous_data[] = array(($timestamp+(7*24*60*60)-1800)*1000, null);
					}
				}
				//Save current timestamp as previous
				$prev_timestamp = $timestamp;
				//Put data in array
				$previous_data[] = array(($timestamp+(7*24*60*60))*1000, (int)$value);
			}
		}
		$count++;
	}
	//Save cache
	set_transient('xmpp_stats_onlineusers_week_graph', array('current' => $current_data, 'previous' => $previous_data), 0);
	//Calculating the line color
	$hex = get_option('xmpp_stats_graph_line_color2', '#0066b3');
	list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
	$previous_color = 'rgba('.$r.', '.$g.', '.$b.', 0.3)';
	//Return response
	$resp = array(
		array('color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'caption' => '', 'data' => $current_data),
		array('color' => $previous_color, 'caption' => __('Previously', 'xmpp-statistics').' ', 'data' => $previous_data)
	);
	wp_send_json($resp);
}
add_action('wp_ajax_nopriv_xmpp_onlineusers_week_graph_data', 'shortcode_xmpp_onlineusers_week_graph_json');
add_action('wp_ajax_xmpp_onlineusers_week_graph_data', 'shortcode_xmpp_onlineusers_week_graph_json');
//Return graph cache data in json via ajax
function shortcode_xmpp_onlineusers_week_graph_cache_json() {
	//Get cache
	if(true == ($data = get_transient('xmpp_stats_onlineusers_week_graph'))) {
		//Calculating the line color
		$hex = get_option('xmpp_stats_graph_line_color2', '#0066b3');
		list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
		$previous_color = 'rgba('.$r.', '.$g.', '.$b.', 0.3)';
		//Return cache
		$resp = array(
			array('color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'caption' => '', 'data' => $data['current']),
			array('color' => $previous_color, 'caption' => __('Previously', 'xmpp-statistics').' ', 'data' => $data['previous'])
		);
		wp_send_json($resp);
	}
	//No data
	wp_send_json();
}
add_action('wp_ajax_nopriv_xmpp_onlineusers_week_graph_cache_data', 'shortcode_xmpp_onlineusers_week_graph_cache_json');
add_action('wp_ajax_xmpp_onlineusers_week_graph_cache_data', 'shortcode_xmpp_onlineusers_week_graph_cache_json');

//Show registered users day graph
function shortcode_xmpp_registeredusers_day_graph() {
	//Return loading information
	return '<div class="graph-container"><h3>'.__('Registered users - by day', 'xmpp-statistics').'</h3><div id="xmpp_registeredusers_day_graph" style="max-width:'.get_option('xmpp_stats_graph_width', 437).'px; height:'.get_option('xmpp_stats_graph_height', 220).'px;" class="graph-placeholder"><i title="'.__('Loading', 'xmpp-statistics').'..." class="fa fa-spinner fa-pulse" style="line-height:'.get_option('xmpp_stats_graph_height', 220).'px;" aria-hidden="true"></i></div></div>';
}
//Return graph data in json via ajax
function shortcode_xmpp_registeredusers_day_graph_json() {
	//Datebase data
	global $wpdb;
	$table_name = $wpdb->prefix . 'xmpp_stats';
	//Get latest record
	$latest_record = $wpdb->get_row("SELECT * FROM $table_name WHERE type = '2' ORDER BY timestamp DESC");
	//Calculating oldest date
	$oldest = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(24*60*60));
	//Get data from the last 24 hours
	$rows = $wpdb->get_results("SELECT * FROM $table_name WHERE type = '2' AND timestamp > '$oldest' ORDER BY timestamp ASC");
	//Auxiliary variables
	$count = 0;
	$prev_timestamp = 0;
	//Foreach data
	foreach($rows as $row) {
		$value = $row->value;
		$prev_value = $rows[$count-1]->value;
		$next_value = $rows[$count+1]->value;
		if(($value == 0) && ($prev_value != 0) && (($next_value != 0) || !$next_value)) {
			/* probably connection error */
		} else {
			//Get current timestamp
			$timestamp = strtotime($row->timestamp);
			//Check previous timestamp
			if($prev_timestamp) {
				$prev_timestamp = $timestamp - $prev_timestamp;
				//Gaps in data
				if($prev_timestamp>3600) {
					$data[] = array(strtotime($rows[$count-1]->timestamp)*1000, $prev_value);
					$data[] = array(($timestamp-1800)*1000, null);
					$is_gap = true;
				}
			}
			//Save current timestamp as previous
			$prev_timestamp = $timestamp;
			//Put data in array
			if(($value != $prev_value) || ($value != $next_value) || ($is_gap)) {
				$is_gap = false;
				$data[] = array($timestamp*1000, (int)$value);
			}
		}
		$count++;
	}
	//Save cache
	set_transient('xmpp_stats_registeredusers_day_graph', $data, 0);
	//Return response
	$resp = array(
		array('color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'data' => $data)
	);
	wp_send_json($resp);
}
add_action('wp_ajax_nopriv_xmpp_registeredusers_day_graph_data', 'shortcode_xmpp_registeredusers_day_graph_json');
add_action('wp_ajax_xmpp_registeredusers_day_graph_data', 'shortcode_xmpp_registeredusers_day_graph_json');
//Return graph cache data in json via ajax
function shortcode_xmpp_registeredusers_day_graph_cache_json() {
	//Get cache
	if(true == ($data = get_transient('xmpp_stats_registeredusers_day_graph'))) {
		//Return cache
		$resp = array(
			array('color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'data' => $data)
		);
		wp_send_json($resp);
	}
	//No data
	wp_send_json();
}
add_action('wp_ajax_nopriv_xmpp_registeredusers_day_graph_cache_data', 'shortcode_xmpp_registeredusers_day_graph_cache_json');
add_action('wp_ajax_xmpp_registeredusers_day_graph_cache_data', 'shortcode_xmpp_registeredusers_day_graph_cache_json');

//Show registered users week graph
function shortcode_xmpp_registeredusers_week_graph() {
	//Return loading information
	return '<div class="graph-container"><h3>'.__('Registered users - by week', 'xmpp-statistics').'</h3><div id="xmpp_registeredusers_week_graph" style="max-width:'.get_option('xmpp_stats_graph_width', 437).'px; height:'.get_option('xmpp_stats_graph_height', 220).'px;" class="graph-placeholder"><i title="'.__('Loading', 'xmpp-statistics').'..." class="fa fa-spinner fa-pulse" style="line-height:'.get_option('xmpp_stats_graph_height', 220).'px;" aria-hidden="true"></i></div></div>';
}
//Return graph data in json via ajax
function shortcode_xmpp_registeredusers_week_graph_json() {
	//Datebase data
	global $wpdb;
	$table_name = $wpdb->prefix . 'xmpp_stats';
	//Get latest record
	$latest_record = $wpdb->get_row("SELECT * FROM $table_name WHERE type = '2' ORDER BY timestamp DESC");
	//Calculating oldest date
	$oldest = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(7*24*60*60));
	//Get data from the last week
	$rows = $wpdb->get_results("SELECT * FROM $table_name WHERE type = '2' AND timestamp > '$oldest' ORDER BY timestamp ASC");
	//Auxiliary variables
	$count = 0;
	$prev_timestamp = 0;
	//Foreach data
	foreach($rows as $row) {
		$value = $row->value;
		$prev_value = $rows[$count-1]->value;
		$next_value = $rows[$count+1]->value;
		if(($value == 0) && ($prev_value != 0) && (($next_value != 0) || !$next_value)) {
			/* probably connection error */
		} else {
			//Get current timestamp
			$timestamp = strtotime($row->timestamp);
			//Check previous timestamp
			if($prev_timestamp) {
				$prev_timestamp = $timestamp - $prev_timestamp;
				if($prev_timestamp>3600) {
					$data[] = array(strtotime($rows[$count-1]->timestamp)*1000, (int)$prev_value);
					$data[] = array(($timestamp-1800)*1000, null);
					$is_gap = true;
				}
			}
			//Save current timestamp as previous
			$prev_timestamp = $timestamp;
			//Put data in array
			if(($value != $prev_value) || ($value != $next_value) || ($is_gap)) {
				$is_gap = false;
				$data[] = array($timestamp*1000, (int)$value);
			}
		}
		$count++;
	}
	//Save cache
	set_transient('xmpp_stats_registeredusers_week_graph', $data, 0);
	//Return response
	$resp = array(
		array('color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'data' => $data)
	);
	wp_send_json($resp);
}
add_action('wp_ajax_nopriv_xmpp_registeredusers_week_graph_data', 'shortcode_xmpp_registeredusers_week_graph_json');
add_action('wp_ajax_xmpp_registeredusers_week_graph_data', 'shortcode_xmpp_registeredusers_week_graph_json');
//Return graph cache data in json via ajax
function shortcode_xmpp_registeredusers_week_graph_cache_json() {
	//Get cache
	if(true == ($data = get_transient('xmpp_stats_registeredusers_week_graph'))) {
		//Return cache
		$resp = array(
			array('color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'data' => $data)
		);
		wp_send_json($resp);
	}
	//No data
	wp_send_json();
}
add_action('wp_ajax_nopriv_xmpp_registeredusers_week_graph_cache_data', 'shortcode_xmpp_registeredusers_week_graph_cache_json');
add_action('wp_ajax_xmpp_registeredusers_week_graph_cache_data', 'shortcode_xmpp_registeredusers_week_graph_cache_json');

//Show S2S connections day graph
function shortcode_xmpp_s2s_day_graph() {
	//Return loading information
	return '<div class="graph-container"><h3>'.__('S2S connections - by day', 'xmpp-statistics').'</h3><div id="xmpp_s2s_day_graph" style="max-width:'.get_option('xmpp_stats_graph_width', 437).'px; height:'.get_option('xmpp_stats_graph_height', 220).'px;" class="graph-placeholder"><i title="'.__('Loading', 'xmpp-statistics').'..." class="fa fa-spinner fa-pulse" style="line-height:'.get_option('xmpp_stats_graph_height', 220).'px;" aria-hidden="true"></i></div><div id="xmpp_s2s_day_graph_choices" class="graph-choices"></div></div>';
}
//Return graph data in json via ajax
function shortcode_xmpp_s2s_day_graph_json() {
	//Datebase data
	global $wpdb;
	$table_name = $wpdb->prefix . 'xmpp_stats';
	//Get latest record
	$outgoing_row = $wpdb->get_row("SELECT * FROM $table_name WHERE type = '3' ORDER BY timestamp DESC");
	//Calculating oldest date
	$oldest = date_i18n('Y-m-d H:i:s', strtotime($outgoing_row->timestamp)-(24*60*60));
	//Get data from the last 24 hours
	$outgoing_rows = $wpdb->get_results("SELECT * FROM $table_name WHERE type = '3' AND timestamp > '$oldest' ORDER BY timestamp ASC");
	//Auxiliary variables
	$count = 0;
	$prev_timestamp = 0;
	//Foreach data
	foreach($outgoing_rows as $outgoing_row) {
		$value = $outgoing_row->value;
		$prev_value = $outgoing_rows[$count-1]->value;
		$next_value = $outgoing_rows[$count+1]->value;
		if(($value == 0) && ($prev_value != 0) && (($next_value != 0) || !$next_value)) {
			/* probably connection error */
		} else {
			//Get current timestamp
			$timestamp = strtotime($outgoing_row->timestamp);
			//Check previous timestamp
			if($prev_timestamp) {
				$prev_timestamp = $timestamp - $prev_timestamp;
				//Gaps in data
				if($prev_timestamp>3600) {
					$outgoing_data[] = array(($timestamp-1800)*1000, null);
				}
			}
			//Save current timestamp as previous
			$prev_timestamp = $timestamp;
			//Put data in array
			$outgoing_data[] = array($timestamp*1000, (int)$value);
		}
		$count++;
	}
	//Get latest record
	$incoming_row = $wpdb->get_row("SELECT * FROM $table_name WHERE type = '4' ORDER BY timestamp DESC");
	//Calculating oldest date
	$oldest = date_i18n('Y-m-d H:i:s', strtotime($incoming_row->timestamp)-(24*60*60));
	//Get data from the last 24 hours
	$incoming_rows = $wpdb->get_results("SELECT * FROM $table_name WHERE type = '4' AND timestamp > '$oldest' ORDER BY timestamp ASC");
	//Auxiliary variables
	$count = 0;
	$prev_timestamp = 0;
	//Foreach data
	foreach($incoming_rows as $incoming_row) {
		$value = $incoming_row->value;
		$prev_value = $incoming_rows[$count-1]->value;
		$next_value = $incoming_rows[$count+1]->value;
		if(($value == 0) && ($prev_value != 0) && (($next_value != 0) || !$next_value)) {
			/* probably connection error */
		} else {
			//Get current timestamp
			$timestamp = strtotime($incoming_row->timestamp);
			//Check previous timestamp
			if($prev_timestamp) {
				$prev_timestamp = $timestamp - $prev_timestamp;
				//Gaps in data
				if($prev_timestamp>3600) {
					$incoming_data[] = array(($timestamp-1800)*1000, null);
				}
			}
			//Save current timestamp as previous
			$prev_timestamp = $timestamp;
			//Put data in array
			$incoming_data[] = array($timestamp*1000, (int)$value);
		}
		$count++;
	}
	//Save cache
	set_transient('xmpp_stats_s2s_day_graph', array('outgoing' => $outgoing_data, 'incoming' => $incoming_data), 0);
	//Return response
	$resp = array(
		'outgoing' => array(
				'color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'label' =>  __('Outgoing connections', 'xmpp-statistics'), 'caption' =>  __('outgoing connections', 'xmpp-statistics'), 'data' => $outgoing_data
		),
		'incoming' => array(
			'color' => get_option('xmpp_stats_graph_line_color2', '#0066b3'), 'label' =>  __('Incoming connections', 'xmpp-statistics'), 'caption' =>  __('incoming connections', 'xmpp-statistics'), 'data' => $incoming_data
		)
	);
	wp_send_json($resp);
}
add_action('wp_ajax_nopriv_xmpp_s2s_day_graph_data', 'shortcode_xmpp_s2s_day_graph_json');
add_action('wp_ajax_xmpp_s2s_day_graph_data', 'shortcode_xmpp_s2s_day_graph_json');
//Return graph cache data in json via ajax
function shortcode_xmpp_s2s_day_graph_cache_json() {
	//Get cache
	if(true == ($data = get_transient('xmpp_stats_s2s_day_graph'))) {
		//Return cache
		$resp = array(
			'outgoing' => array(
					'color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'label' =>  __('Outgoing connections', 'xmpp-statistics'), 'caption' =>  __('outgoing connections', 'xmpp-statistics'), 'data' => $data['outgoing']
			),
			'incoming' => array(
				'color' => get_option('xmpp_stats_graph_line_color2', '#0066b3'), 'label' =>  __('Incoming connections', 'xmpp-statistics'), 'caption' =>  __('incoming connections', 'xmpp-statistics'), 'data' => $data['incoming']
			)
		);
		wp_send_json($resp);
	}
	//No data
	wp_send_json();
}
add_action('wp_ajax_nopriv_xmpp_s2s_day_graph_cache_data', 'shortcode_xmpp_s2s_day_graph_cache_json');
add_action('wp_ajax_xmpp_s2s_day_graph_cache_data', 'shortcode_xmpp_s2s_day_graph_cache_json');

//Show S2S connections week graph
function shortcode_xmpp_s2s_week_graph() {
	//Return loading information
	return '<div class="graph-container"><h3>'.__('S2S connections - by week', 'xmpp-statistics').'</h3><div id="xmpp_s2s_week_graph" style="max-width:'.get_option('xmpp_stats_graph_width', 437).'px; height:'.get_option('xmpp_stats_graph_height', 220).'px;" class="graph-placeholder"><i title="'.__('Loading', 'xmpp-statistics').'..." class="fa fa-spinner fa-pulse" style="line-height:'.get_option('xmpp_stats_graph_height', 220).'px;" aria-hidden="true"></i></div><div id="xmpp_s2s_week_graph_choices" class="graph-choices"></div></div>';
}
//Return graph data in json via ajax
function shortcode_xmpp_s2s_week_graph_json() {
	//Datebase data
	global $wpdb;
	$table_name = $wpdb->prefix . 'xmpp_stats';
	//Get latest record
	$outgoing_row = $wpdb->get_row("SELECT * FROM $table_name WHERE type = '3' ORDER BY timestamp DESC");
	//Calculating oldest date
	$oldest = date_i18n('Y-m-d H:i:s', strtotime($outgoing_row->timestamp)-(7*24*60*60));
	//Get data from the last week
	$outgoing_rows = $wpdb->get_results("SELECT * FROM $table_name WHERE type = '3' AND timestamp > '$oldest' ORDER BY timestamp ASC");
	//Auxiliary variables
	$count = 0;
	$lenght = count($outgoing_rows);
	$prev_timestamp = 0;
	//Foreach data
	foreach($outgoing_rows as $outgoing_row) {
		if((($count+1)%6==0)||($count==$lenght-1)) {
			$value = $outgoing_row->value;
			$prev_value = $outgoing_rows[$count-1]->value;
			$next_value = $outgoing_rows[$count+1]->value;
			if(($value == 0) && ($prev_value != 0) && (($next_value != 0) || !$next_value)) {
				/* probably connection error */
			} else {
				//Get current timestamp
				$timestamp = strtotime($outgoing_row->timestamp);
				//Check previous timestamp
				if($prev_timestamp) {
					$prev_timestamp = $timestamp - $prev_timestamp;
					//Gaps in data
					if($prev_timestamp>3600) {
						$outgoing_data[] = array(($timestamp-1800)*1000, null);
					}
				}
				//Save current timestamp as previous
				$prev_timestamp = $timestamp;
				//Put data in array
				$outgoing_data[] = array($timestamp*1000, (int)$value);
			}
		}
		$count++;
	}
	//Get latest record
	$incoming_row = $wpdb->get_row("SELECT * FROM $table_name WHERE type = '4' ORDER BY timestamp DESC");
	//Calculating oldest date
	$oldest = date_i18n('Y-m-d H:i:s', strtotime($incoming_row->timestamp)-(7*24*60*60));
	//Get data from the last week
	$incoming_rows = $wpdb->get_results("SELECT * FROM $table_name WHERE type = '4' AND timestamp > '$oldest' ORDER BY timestamp ASC");
	//Auxiliary variables
	$count = 0;
	$lenght = count($incoming_rows);
	$prev_timestamp = 0;
	//Foreach data
	foreach($incoming_rows as $incoming_row) {
		if((($count+1)%6==0)||($count==$lenght-1)) {
			$value = $incoming_row->value;
			$prev_value = $incoming_rows[$count-1]->value;
			$next_value = $incoming_rows[$count+1]->value;
			if(($value == 0) && ($prev_value != 0) && (($next_value != 0) || !$next_value)) {
				/* probably connection error */
			} else {
				//Get current timestamp
				$timestamp = strtotime($incoming_row->timestamp);
				//Check previous timestamp
				if($prev_timestamp) {
					$prev_timestamp = $timestamp - $prev_timestamp;
					//Gaps in data
					if($prev_timestamp>3600) {
						$incoming_data[] = array(($timestamp-1800)*1000, null);
					}
				}
				//Save current timestamp as previous
				$prev_timestamp = $timestamp;
				//Put data in array
				$incoming_data[] = array($timestamp*1000, (int)$value);
			}
		}
		$count++;
	}
	//Save cache
	set_transient('xmpp_stats_s2s_week_graph', array('outgoing' => $outgoing_data, 'incoming' => $incoming_data), 0);
	//Return response
	$resp = array(
		'outgoing' => array(
				'color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'label' =>  __('Outgoing connections', 'xmpp-statistics'), 'caption' =>  __('outgoing connections', 'xmpp-statistics'), 'data' => $outgoing_data
		),
		'incoming' => array(
			'color' => get_option('xmpp_stats_graph_line_color2', '#0066b3'), 'label' =>  __('Incoming connections', 'xmpp-statistics'), 'caption' =>  __('incoming connections', 'xmpp-statistics'), 'data' => $incoming_data
		)
	);
	wp_send_json($resp);
}
add_action('wp_ajax_nopriv_xmpp_s2s_week_graph_data', 'shortcode_xmpp_s2s_week_graph_json');
add_action('wp_ajax_xmpp_s2s_week_graph_data', 'shortcode_xmpp_s2s_week_graph_json');
//Return graph cache data in json via ajax
function shortcode_xmpp_s2s_week_graph_cache_json() {
	//Get cache
	if(true == ($data = get_transient('xmpp_stats_s2s_week_graph'))) {
		//Return cache
		$resp = array(
			'outgoing' => array(
					'color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'label' =>  __('Outgoing connections', 'xmpp-statistics'), 'caption' =>  __('outgoing connections', 'xmpp-statistics'), 'data' => $data['outgoing']
			),
			'incoming' => array(
				'color' => get_option('xmpp_stats_graph_line_color2', '#0066b3'), 'label' =>  __('Incoming connections', 'xmpp-statistics'), 'caption' =>  __('incoming connections', 'xmpp-statistics'), 'data' => $data['incoming']
			)
		);
		wp_send_json($resp);
	}
	//No data
	wp_send_json();
}
add_action('wp_ajax_nopriv_xmpp_s2s_week_graph_cache_data', 'shortcode_xmpp_s2s_week_graph_cache_json');
add_action('wp_ajax_xmpp_s2s_week_graph_cache_data', 'shortcode_xmpp_s2s_week_graph_cache_json');

//Show S2S outgoing connections day graph
function shortcode_xmpp_s2s_out_day_graph() {
	//Return loading information
	return '<div class="graph-container"><h3>'.__('Outgoing S2S connections - by day', 'xmpp-statistics').'</h3><div id="xmpp_s2s_out_day_graph" style="max-width:'.get_option('xmpp_stats_graph_width', 437).'px; height:'.get_option('xmpp_stats_graph_height', 220).'px;" class="graph-placeholder"><i title="'.__('Loading', 'xmpp-statistics').'..." class="fa fa-spinner fa-pulse" style="line-height:'.get_option('xmpp_stats_graph_height', 220).'px;" aria-hidden="true"></i></div></div>';
}
//Return graph data in json via ajax
function shortcode_xmpp_s2s_out_day_graph_json() {
	//Datebase data
	global $wpdb;
	$table_name = $wpdb->prefix . 'xmpp_stats';
	//Get latest record
	$latest_record = $wpdb->get_row("SELECT * FROM $table_name WHERE type = '3' ORDER BY timestamp DESC");
	//Calculating oldest date
	$oldest = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(24*60*60));
	//Get data from the last 24 hours
	$current_rows = $wpdb->get_results("SELECT * FROM $table_name WHERE type = '3' AND timestamp > '$oldest' ORDER BY timestamp ASC");
	//Auxiliary variables
	$count = 0;
	$prev_timestamp = 0;
	//Foreach data
	foreach($current_rows as $current_row) {
		$value = $current_row->value;
		$prev_value = $current_rows[$count-1]->value;
		$next_value = $current_rows[$count+1]->value;
		if(($value == 0) && ($prev_value != 0) && (($next_value != 0) || !$next_value)) {
			/* probably connection error */
		} else {
			//Get current timestamp
			$timestamp = strtotime($current_row->timestamp);
			//Check previous timestamp
			if($prev_timestamp) {
				$prev_timestamp = $timestamp - $prev_timestamp;
				//Gaps in data
				if($prev_timestamp>3600) {
					$current_data[] = array(($timestamp-1800)*1000, null);
				}
			}
			//Save current timestamp as previous
			$prev_timestamp = $timestamp;
			//Put data in array
			$current_data[] = array($timestamp*1000, (int)$value);
		}
		$count++;
	}
	//Calculating previous older and oldest date
	$xmpp_stats_daily_graph_mode = get_option('xmpp_stats_daily_graph_mode', 0);
	if($xmpp_stats_daily_graph_mode == 0) {
		$older = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(24*60*60));
		$oldest = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(2*24*60*60));
	} else {
		$older = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(7*24*60*60));
		$oldest = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(8*24*60*60));
	}
	//Get the previous data from yesterday / last week
	$previous_rows = $wpdb->get_results("SELECT * FROM $table_name WHERE type = '3' AND timestamp > '$oldest' AND timestamp < '$older' ORDER BY timestamp ASC");
	//Auxiliary variables
	$count = 0;
	$prev_timestamp = 0;
	//Foreach data
	foreach($previous_rows as $previous_row) {
		$value = $previous_row->value;
		$prev_value = $previous_rows[$count-1]->value;
		$next_value = $previous_rows[$count+1]->value;
		if(($value == 0) && ($prev_value != 0) && (($next_value != 0) || !$next_value)) {
			/* probably connection error */
		} else {
			//Get current timestamp
			$timestamp = strtotime($previous_row->timestamp);
			//Check previous timestamp
			if($prev_timestamp) {
				$prev_timestamp = $timestamp - $prev_timestamp;
				//Gaps in data
				if($prev_timestamp>3600) {
					if($xmpp_stats_daily_graph_mode == 0) {
						$previous_data[] = array(($timestamp+(24*60*60)-1800)*1000, null);
					} else {
						$previous_data[] = array(($timestamp+(7*24*60*60)-1800)*1000, null);
					}
				}
			}
			//Save current timestamp as previous
			$prev_timestamp = $timestamp;
			//Put data in array
			if($xmpp_stats_daily_graph_mode == 0) {
				$previous_data[] = array(($timestamp+(24*60*60))*1000, (int)$value);
			} else {
				$previous_data[] = array(($timestamp+(7*24*60*60))*1000, (int)$value);
			}
		}
		$count++;
	}
	//Save cache
	set_transient('xmpp_stats_s2s_out_day_graph', array('current' => $current_data, 'previous' => $previous_data), 0);
	//Calculating the line color
	$hex = get_option('xmpp_stats_graph_line_color2', '#0066b3');
	list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
	$previous_color = 'rgba('.$r.', '.$g.', '.$b.', 0.3)';
	//Return response
	$resp = array(
		array('color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'caption' => '', 'data' => $current_data),
		array('color' => $previous_color, 'caption' => __('Previously', 'xmpp-statistics').' ', 'data' => $previous_data)
	);
	wp_send_json($resp);
}
add_action('wp_ajax_nopriv_xmpp_s2s_out_day_graph_data', 'shortcode_xmpp_s2s_out_day_graph_json');
add_action('wp_ajax_xmpp_s2s_out_day_graph_data', 'shortcode_xmpp_s2s_out_day_graph_json');
//Return graph cache data in json via ajax
function shortcode_xmpp_s2s_out_day_graph_cache_json() {
	//Get cache
	if(true == ($data = get_transient('xmpp_stats_s2s_out_day_graph'))) {
		//Calculating the line color
		$hex = get_option('xmpp_stats_graph_line_color2', '#0066b3');
		list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
		$previous_color = 'rgba('.$r.', '.$g.', '.$b.', 0.3)';
		//Return cache
		$resp = array(
			array('color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'caption' => '', 'data' => $data['current']),
			array('color' => $previous_color, 'caption' => __('Previously', 'xmpp-statistics').' ', 'data' => $data['previous'])
		);
		wp_send_json($resp);
	}
	//No data
	wp_send_json();
}
add_action('wp_ajax_nopriv_xmpp_s2s_out_day_graph_cache_data', 'shortcode_xmpp_s2s_out_day_graph_cache_json');
add_action('wp_ajax_xmpp_s2s_out_day_graph_cache_data', 'shortcode_xmpp_s2s_out_day_graph_cache_json');

//Show S2S connections week graph
function shortcode_xmpp_s2s_out_week_graph() {
	//Return loading information
	return '<div class="graph-container"><h3>'.__('Outgoing S2S connections - by week', 'xmpp-statistics').'</h3><div id="xmpp_s2s_out_week_graph" style="max-width:'.get_option('xmpp_stats_graph_width', 437).'px; height:'.get_option('xmpp_stats_graph_height', 220).'px;" class="graph-placeholder"><i title="'.__('Loading', 'xmpp-statistics').'..." class="fa fa-spinner fa-pulse" style="line-height:'.get_option('xmpp_stats_graph_height', 220).'px;" aria-hidden="true"></i></div></div>';
}
//Return graph data in json via ajax
function shortcode_xmpp_s2s_out_week_graph_json() {
	//Datebase data
	global $wpdb;
	$table_name = $wpdb->prefix . 'xmpp_stats';
	//Get latest record
	$latest_record = $wpdb->get_row("SELECT * FROM $table_name WHERE type = '3' ORDER BY timestamp DESC");
	//Calculating oldest date
	$oldest = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(7*24*60*60));
	//Get data from the last week
	$current_rows = $wpdb->get_results("SELECT * FROM $table_name WHERE type = '3' AND timestamp > '$oldest' ORDER BY timestamp ASC");
	//Auxiliary variables
	$count = 0;
	$lenght = count($current_rows);
	$prev_timestamp = 0;
	//Foreach data
	foreach($current_rows as $current_row) {
		if((($count+1)%6==0)||($count==$lenght-1)) {
			$value = $current_row->value;
			$prev_value = $current_rows[$count-1]->value;
			$next_value = $current_rows[$count+1]->value;
			if(($value == 0) && ($prev_value != 0) && (($next_value != 0) || !$next_value)) {
				/* probably connection error */
			} else {
				//Get current timestamp
				$timestamp = strtotime($current_row->timestamp);
				//Check previous timestamp
				if($prev_timestamp) {
					$prev_timestamp = $timestamp - $prev_timestamp;
					//Gaps in data
					if($prev_timestamp>3600) {
						$current_data[] = array(($timestamp-1800)*1000, null);
					}
				}
				//Save current timestamp as previous
				$prev_timestamp = $timestamp;
				//Put data in array
				$current_data[] = array($timestamp*1000, (int)$value);
			}
		}
		$count++;
	};
	//Calculating previous older and oldest date
	$older = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(7*24*60*60));
	$oldest = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(14*24*60*60));
	//Get data from the previous week
	$previous_rows = $wpdb->get_results("SELECT * FROM $table_name WHERE type = '3' AND timestamp > '$oldest' AND timestamp < '$older' ORDER BY timestamp ASC");
	//Auxiliary variables
	$count = 0;
	$lenght = count($previous_rows);
	$prev_timestamp = 0;
	//Foreach data
	foreach($previous_rows as $previous_row) {
		if((($count+1)%6==0)||($count==$lenght-1)) {
			$value = $previous_row->value;
			$prev_value = $previous_rows[$count-1]->value;
			$next_value = $previous_rows[$count+1]->value;
			if(($value == 0) && ($prev_value != 0) && (($next_value != 0) || !$next_value)) {
				/* probably connection error */
			} else {
				//Get current timestamp
				$timestamp = strtotime($previous_row->timestamp);
				//Check previous timestamp
				if($prev_timestamp) {
					$prev_timestamp = $timestamp - $prev_timestamp;
					//Gaps in data
					if($prev_timestamp>3600) {
						$previous_data[] = array(($timestamp+(7*24*60*60)-1800)*1000, null);
					}
				}
				//Save current timestamp as previous
				$prev_timestamp = $timestamp;
				//Put data in array
				$previous_data[] = array(($timestamp+(7*24*60*60))*1000, (int)$value);
			}
		}
		$count++;
	}
	//Save cache
	set_transient('xmpp_stats_s2s_out_week_graph', array('current' => $current_data, 'previous' => $previous_data), 0);
	//Calculating the line color
	$hex = get_option('xmpp_stats_graph_line_color2', '#0066b3');
	list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
	$previous_color = 'rgba('.$r.', '.$g.', '.$b.', 0.3)';
	//Return response
	$resp = array(
		array('color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'caption' => '', 'data' => $current_data),
		array('color' => $previous_color, 'caption' => __('Previously', 'xmpp-statistics').' ', 'data' => $previous_data)
	);
	wp_send_json($resp);
}
add_action('wp_ajax_nopriv_xmpp_s2s_out_week_graph_data', 'shortcode_xmpp_s2s_out_week_graph_json');
add_action('wp_ajax_xmpp_s2s_out_week_graph_data', 'shortcode_xmpp_s2s_out_week_graph_json');
//Return graph cache data in json via ajax
function shortcode_xmpp_s2s_out_week_graph_cache_json() {
	//Get cache
	if(true == ($data = get_transient('xmpp_stats_s2s_out_week_graph'))) {
		//Calculating the line color
		$hex = get_option('xmpp_stats_graph_line_color2', '#0066b3');
		list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
		$previous_color = 'rgba('.$r.', '.$g.', '.$b.', 0.3)';
		//Return cache
		$resp = array(
			array('color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'caption' => '', 'data' => $data['current']),
			array('color' => $previous_color, 'caption' => __('Previously', 'xmpp-statistics').' ', 'data' => $data['previous'])
		);
		wp_send_json($resp);
	}
	//No data
	wp_send_json();
}
add_action('wp_ajax_nopriv_xmpp_s2s_out_week_graph_cache_data', 'shortcode_xmpp_s2s_out_week_graph_cache_json');
add_action('wp_ajax_xmpp_s2s_out_week_graph_cache_data', 'shortcode_xmpp_s2s_out_week_graph_cache_json');

//Show S2S incoming connections day graph
function shortcode_xmpp_s2s_in_day_graph() {
	//Return loading information
	return '<div class="graph-container"><h3>'.__('Incoming S2S connections - by day', 'xmpp-statistics').'</h3><div id="xmpp_s2s_in_day_graph" style="max-width:'.get_option('xmpp_stats_graph_width', 437).'px; height:'.get_option('xmpp_stats_graph_height', 220).'px;" class="graph-placeholder"><i title="'.__('Loading', 'xmpp-statistics').'..." class="fa fa-spinner fa-pulse" style="line-height:'.get_option('xmpp_stats_graph_height', 220).'px;" aria-hidden="true"></i></div></div>';
}
//Return graph data in json via ajax
function shortcode_xmpp_s2s_in_day_graph_json() {
	//Datebase data
	global $wpdb;
	$table_name = $wpdb->prefix . 'xmpp_stats';
	//Get latest record
	$latest_record = $wpdb->get_row("SELECT * FROM $table_name WHERE type = '4' ORDER BY timestamp DESC");
	//Calculating oldest date
	$oldest = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(24*60*60));
	//Get data from the last 24 hours
	$current_rows = $wpdb->get_results("SELECT * FROM $table_name WHERE type = '4' AND timestamp > '$oldest' ORDER BY timestamp ASC");
	//Auxiliary variables
	$count = 0;
	$prev_timestamp = 0;
	//Foreach data
	foreach($current_rows as $current_row) {
		$value = $current_row->value;
		$prev_value = $current_rows[$count-1]->value;
		$next_value = $current_rows[$count+1]->value;
		if(($value == 0) && ($prev_value != 0) && (($next_value != 0) || !$next_value)) {
			/* probably connection error */
		} else {
			//Get current timestamp
			$timestamp = strtotime($current_row->timestamp);
			//Check previous timestamp
			if($prev_timestamp) {
				$prev_timestamp = $timestamp - $prev_timestamp;
				//Gaps in data
				if($prev_timestamp>3600) {
					$current_data[] = array(($timestamp-1800)*1000, null);
				}
			}
			//Save current timestamp as previous
			$prev_timestamp = $timestamp;
			//Put data in array
			$current_data[] = array($timestamp*1000, (int)$value);
		}
		$count++;
	}
	//Calculating previous older and oldest date
	$xmpp_stats_daily_graph_mode = get_option('xmpp_stats_daily_graph_mode', 0);
	if($xmpp_stats_daily_graph_mode == 0) {
		$older = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(24*60*60));
		$oldest = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(2*24*60*60));
	} else {
		$older = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(7*24*60*60));
		$oldest = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(8*24*60*60));
	}
	//Get the previous data from yesterday / last week
	$previous_rows = $wpdb->get_results("SELECT * FROM $table_name WHERE type = '4' AND timestamp > '$oldest' AND timestamp < '$older' ORDER BY timestamp ASC");
	//Auxiliary variables
	$count = 0;
	$prev_timestamp = 0;
	//Foreach data
	foreach($previous_rows as $previous_row) {
		$value = $previous_row->value;
		$prev_value = $previous_rows[$count-1]->value;
		$next_value = $previous_rows[$count+1]->value;
		if(($value == 0) && ($prev_value != 0) && (($next_value != 0) || !$next_value)) {
			/* probably connection error */
		} else {
			//Get current timestamp
			$timestamp = strtotime($previous_row->timestamp);
			//Check previous timestamp
			if($prev_timestamp) {
				$prev_timestamp = $timestamp - $prev_timestamp;
				//Gaps in data
				if($prev_timestamp>3600) {
					if($xmpp_stats_daily_graph_mode == 0) {
						$previous_data[] = array(($timestamp+(24*60*60)-1800)*1000, null);
					} else {
						$previous_data[] = array(($timestamp+(7*24*60*60)-1800)*1000, null);
					}
				}
			}
			//Save current timestamp as previous
			$prev_timestamp = $timestamp;
			//Put data in array
			if($xmpp_stats_daily_graph_mode == 0) {
				$previous_data[] = array(($timestamp+(24*60*60))*1000, (int)$value);
			} else {
				$previous_data[] = array(($timestamp+(7*24*60*60))*1000, (int)$value);
			}
		}
		$count++;
	}
	//Save cache
	set_transient('xmpp_stats_s2s_in_day_graph', array('current' => $current_data, 'previous' => $previous_data), 0);
	//Calculating the line color
	$hex = get_option('xmpp_stats_graph_line_color2', '#0066b3');
	list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
	$previous_color = 'rgba('.$r.', '.$g.', '.$b.', 0.3)';
	//Return response
	$resp = array(
		array('color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'caption' => '', 'data' => $current_data),
		array('color' => $previous_color, 'caption' => __('Previously', 'xmpp-statistics').' ', 'data' => $previous_data)
	);
	wp_send_json($resp);
}
add_action('wp_ajax_nopriv_xmpp_s2s_in_day_graph_data', 'shortcode_xmpp_s2s_in_day_graph_json');
add_action('wp_ajax_xmpp_s2s_in_day_graph_data', 'shortcode_xmpp_s2s_in_day_graph_json');
//Return graph cache data in json via ajax
function shortcode_xmpp_s2s_in_day_graph_cache_json() {
	//Get cache
	if(true == ($data = get_transient('xmpp_stats_s2s_in_day_graph'))) {
		//Calculating the line color
		$hex = get_option('xmpp_stats_graph_line_color2', '#0066b3');
		list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
		$previous_color = 'rgba('.$r.', '.$g.', '.$b.', 0.3)';
		//Return cache
		$resp = array(
			array('color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'caption' => '', 'data' => $data['current']),
			array('color' => $previous_color, 'caption' => __('Previously', 'xmpp-statistics').' ', 'data' => $data['previous'])
		);
		wp_send_json($resp);
	}
	//No data
	wp_send_json();
}
add_action('wp_ajax_nopriv_xmpp_s2s_in_day_graph_cache_data', 'shortcode_xmpp_s2s_in_day_graph_cache_json');
add_action('wp_ajax_xmpp_s2s_in_day_graph_cache_data', 'shortcode_xmpp_s2s_in_day_graph_cache_json');

//Show S2S connections week graph
function shortcode_xmpp_s2s_in_week_graph() {
	//Return loading information
	return '<div class="graph-container"><h3>'.__('Incoming S2S connections - by week', 'xmpp-statistics').'</h3><div id="xmpp_s2s_in_week_graph" style="max-width:'.get_option('xmpp_stats_graph_width', 437).'px; height:'.get_option('xmpp_stats_graph_height', 220).'px;" class="graph-placeholder"><i title="'.__('Loading', 'xmpp-statistics').'..." class="fa fa-spinner fa-pulse" style="line-height:'.get_option('xmpp_stats_graph_height', 220).'px;" aria-hidden="true"></i></div></div>';
}
//Return graph data in json via ajax
function shortcode_xmpp_s2s_in_week_graph_json() {
	//Datebase data
	global $wpdb;
	$table_name = $wpdb->prefix . 'xmpp_stats';
	//Get latest record
	$latest_record = $wpdb->get_row("SELECT * FROM $table_name WHERE type = '4' ORDER BY timestamp DESC");
	//Calculating oldest date
	$oldest = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(7*24*60*60));
	//Get data from the last week
	$current_rows = $wpdb->get_results("SELECT * FROM $table_name WHERE type = '4' AND timestamp > '$oldest' ORDER BY timestamp ASC");
	//Auxiliary variables
	$count = 0;
	$lenght = count($current_rows);
	$prev_timestamp = 0;
	//Foreach data
	foreach($current_rows as $current_row) {
		if((($count+1)%6==0)||($count==$lenght-1)) {
			$value = $current_row->value;
			$prev_value = $current_rows[$count-1]->value;
			$next_value = $current_rows[$count+1]->value;
			if(($value == 0) && ($prev_value != 0) && (($next_value != 0) || !$next_value)) {
				/* probably connection error */
			} else {
				//Get current timestamp
				$timestamp = strtotime($current_row->timestamp);
				//Check previous timestamp
				if($prev_timestamp) {
					$prev_timestamp = $timestamp - $prev_timestamp;
					//Gaps in data
					if($prev_timestamp>3600) {
						$current_data[] = array(($timestamp-1800)*1000, null);
					}
				}
				//Save current timestamp as previous
				$prev_timestamp = $timestamp;
				//Put data in array
				$current_data[] = array($timestamp*1000, (int)$value);
			}
		}
		$count++;
	}
	//Calculating previous older and oldest date
	$older = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(7*24*60*60));
	$oldest = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(14*24*60*60));
	//Get data from the previous week
	$previous_rows = $wpdb->get_results("SELECT * FROM $table_name WHERE type = '4' AND timestamp > '$oldest' AND timestamp < '$older' ORDER BY timestamp ASC");
	//Auxiliary variables
	$count = 0;
	$lenght = count($previous_rows);
	$prev_timestamp = 0;
	//Foreach data
	foreach($previous_rows as $previous_row) {
		if((($count+1)%6==0)||($count==$lenght-1)) {
			$value = $previous_row->value;
			$prev_value = $previous_rows[$count-1]->value;
			$next_value = $previous_rows[$count+1]->value;
			if(($value == 0) && ($prev_value != 0) && (($next_value != 0) || !$next_value)) {
				/* probably connection error */
			} else {
				//Get current timestamp
				$timestamp = strtotime($previous_row->timestamp);
				//Check previous timestamp
				if($prev_timestamp) {
					$prev_timestamp = $timestamp - $prev_timestamp;
					//Gaps in data
					if($prev_timestamp>3600) {
						$previous_data[] = array(($timestamp+(7*24*60*60)-1800)*1000, null);
					}
				}
				//Save current timestamp as previous
				$prev_timestamp = $timestamp;
				//Put data in array
				$previous_data[] = array(($timestamp+(7*24*60*60))*1000, (int)$value);
			}
		}
		$count++;
	}
	//Save cache
	set_transient('xmpp_stats_s2s_in_week_graph', array('current' => $current_data, 'previous' => $previous_data), 0);
	//Calculating the line color
	$hex = get_option('xmpp_stats_graph_line_color2', '#0066b3');
	list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
	$previous_color = 'rgba('.$r.', '.$g.', '.$b.', 0.3)';
	//Return response
	$resp = array(
		array('color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'caption' => '', 'data' => $current_data),
		array('color' => $previous_color, 'caption' => __('Previously', 'xmpp-statistics').' ', 'data' => $previous_data)
	);
	wp_send_json($resp);
}
add_action('wp_ajax_nopriv_xmpp_s2s_in_week_graph_data', 'shortcode_xmpp_s2s_in_week_graph_json');
add_action('wp_ajax_xmpp_s2s_in_week_graph_data', 'shortcode_xmpp_s2s_in_week_graph_json');
//Return graph cache data in json via ajax
function shortcode_xmpp_s2s_in_week_graph_cache_json() {
	//Get cache
	if(true == ($data = get_transient('xmpp_stats_s2s_in_week_graph'))) {
		//Calculating the line color
		$hex = get_option('xmpp_stats_graph_line_color2', '#0066b3');
		list($r, $g, $b) = sscanf($hex, "#%02x%02x%02x");
		$previous_color = 'rgba('.$r.', '.$g.', '.$b.', 0.3)';
		//Return cache
		$resp = array(
			array('color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'caption' => '', 'data' => $data['current']),
			array('color' => $previous_color, 'caption' => __('Previously', 'xmpp-statistics').' ', 'data' => $data['previous'])
		);
		wp_send_json($resp);
	}
	//No data
	wp_send_json();
}
add_action('wp_ajax_nopriv_xmpp_s2s_in_week_graph_cache_data', 'shortcode_xmpp_s2s_in_week_graph_cache_json');
add_action('wp_ajax_xmpp_s2s_in_week_graph_cache_data', 'shortcode_xmpp_s2s_in_week_graph_cache_json');


//Show XMPP server uptime day graph
function shortcode_xmpp_uptime_day_graph() {
	//Return loading information
	return '<div class="graph-container"><h3>'.__('XMPP server uptime - by day', 'xmpp-statistics').'</h3><div id="xmpp_uptime_day_graph" style="max-width:'.get_option('xmpp_stats_graph_width', 437).'px; height:'.get_option('xmpp_stats_graph_height', 220).'px;" class="graph-placeholder"><i title="'.__('Loading', 'xmpp-statistics').'..." class="fa fa-spinner fa-pulse" style="line-height:'.get_option('xmpp_stats_graph_height', 220).'px;" aria-hidden="true"></i></div></div>';
}
//Return graph data in json via ajax
function shortcode_xmpp_uptime_day_graph_json() {
	//Datebase data
	global $wpdb;
	$table_name = $wpdb->prefix . 'xmpp_stats';
	//Get latest record
	$latest_record = $wpdb->get_row("SELECT * FROM $table_name WHERE type = '5' ORDER BY timestamp DESC");
	//Calculating oldest date
	$oldest = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(24*60*60));
	//Get data from the last 24 hours
	$rows = $wpdb->get_results("SELECT * FROM $table_name WHERE type = '5' AND timestamp > '$oldest' ORDER BY timestamp ASC");
	//Auxiliary variables
	$count = 0;
	$prev_timestamp = 0;
	foreach($rows as $row) {
		$value = $row->value;
		$prev_value = $rows[$count-1]->value;
		$next_value = $rows[$count+1]->value;
		if(($value == 0) && ($prev_value != 0) && (($next_value != 0) || !$next_value)) {
			/* probably connection error */
		} else {
			//Get current timestamp
			$timestamp = strtotime($row->timestamp);
			//Check previous timestamp
			if($prev_timestamp) {
				$prev_timestamp = $timestamp - $prev_timestamp;
				//Gaps in data
				if($prev_timestamp>3600) {
					$data[] = array(strtotime($rows[$count-1]->timestamp)*1000, $prev_value/(60*60*24));
					$data[] = array(($timestamp-1800)*1000, null);
					$is_gap = true;
				}
			}
			//Save current timestamp as previous
			$prev_timestamp = $timestamp;
			//Put data in array
			if((!$prev_value) || ($prev_value > $value) || ($value > $next_value) || ($is_gap)) {
				$is_gap = false;
				$data[] = array($timestamp*1000, $value/(60*60*24));
			}
		}
		$count++;
	}
	//Save cache
	set_transient('xmpp_stats_xmpp_uptime_day_graph', $data, 0);
	//Return response
	$resp = array(
		array('color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'data' => $data)
	);
	wp_send_json($resp);
}
add_action('wp_ajax_nopriv_xmpp_uptime_day_graph_data', 'shortcode_xmpp_uptime_day_graph_json');
add_action('wp_ajax_xmpp_uptime_day_graph_data', 'shortcode_xmpp_uptime_day_graph_json');
//Return graph cache data in json via ajax
function shortcode_xmpp_uptime_day_graph_cache_json() {
	//Get cache
	if(true == ($data = get_transient('xmpp_stats_xmpp_uptime_day_graph'))) {
		//Return cache
		$resp = array(
			array('color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'data' => $data)
		);
		wp_send_json($resp);
	}
	//No data
	wp_send_json();
}
add_action('wp_ajax_nopriv_xmpp_uptime_day_graph_cache_data', 'shortcode_xmpp_uptime_day_graph_cache_json');
add_action('wp_ajax_xmpp_uptime_day_graph_cache_data', 'shortcode_xmpp_uptime_day_graph_cache_json');

//Show XMPP server uptime week graph
function shortcode_xmpp_uptime_week_graph() {
	//Return loading information
	return '<div class="graph-container"><h3>'.__('XMPP server uptime - by week', 'xmpp-statistics').'</h3><div id="xmpp_uptime_week_graph" style="max-width:'.get_option('xmpp_stats_graph_width', 437).'px; height:'.get_option('xmpp_stats_graph_height', 220).'px;" class="graph-placeholder"><i title="'.__('Loading', 'xmpp-statistics').'..." class="fa fa-spinner fa-pulse" style="line-height:'.get_option('xmpp_stats_graph_height', 220).'px;" aria-hidden="true"></i></div></div>';
}
//Return graph data in json via ajax
function shortcode_xmpp_uptime_week_graph_json() {
	//Datebase data
	global $wpdb;
	$table_name = $wpdb->prefix . 'xmpp_stats';
	//Get latest record
	$latest_record = $wpdb->get_row("SELECT * FROM $table_name WHERE type = '5' ORDER BY timestamp DESC");
	//Calculating oldest date
	$oldest = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(7*24*60*60));
	//Get data from the last week
	$rows = $wpdb->get_results("SELECT * FROM $table_name WHERE type = '5' AND timestamp > '$oldest' ORDER BY timestamp ASC");
	//Auxiliary variables
	$count = 0;
	$prev_timestamp = 0;
	foreach($rows as $row) {
		$value = $row->value;
		$prev_value = $rows[$count-1]->value;
		$next_value = $rows[$count+1]->value;
		if(($value == 0) && ($prev_value != 0) && (($next_value != 0) || !$next_value)) {
			/* probably connection error */
		} else {
			//Get current timestamp
			$timestamp = strtotime($row->timestamp);
			//Check previous timestamp
			if($prev_timestamp) {
				$prev_timestamp = $timestamp - $prev_timestamp;
				//Gaps in data
				if($prev_timestamp>3600) {
					$data[] = array(strtotime($rows[$count-1]->timestamp)*1000, $prev_value/(60*60*24));
					$data[] = array(($timestamp-1800)*1000, null);
					$is_gap = true;
				}
			}
			//Save current timestamp as previous
			$prev_timestamp = $timestamp;
			//Put data in array
			if((!$prev_value) || ($prev_value > $value) || ($value > $next_value) || ($is_gap)) {
				$is_gap = false;
				$data[] = array($timestamp*1000, $value/(60*60*24));
			}
		}
		$count++;
	}
	//Save cache
	set_transient('xmpp_stats_xmpp_uptime_week_graph', $data, 0);
	//Return response
	$resp = array(
		array('color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'data' => $data)
	);
	wp_send_json($resp);
}
add_action('wp_ajax_nopriv_xmpp_uptime_week_graph_data', 'shortcode_xmpp_uptime_week_graph_json');
add_action('wp_ajax_xmpp_uptime_week_graph_data', 'shortcode_xmpp_uptime_week_graph_json');
//Return graph cache data in json via ajax
function shortcode_xmpp_uptime_week_graph_cache_json() {
	//Get cache
	if(true == ($data = get_transient('xmpp_stats_xmpp_uptime_week_graph'))) {
		//Return cache
		$resp = array(
			array('color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'data' => $data)
		);
		wp_send_json($resp);
	}
	//No data
	wp_send_json();
}
add_action('wp_ajax_nopriv_xmpp_uptime_week_graph_cache_data', 'shortcode_xmpp_uptime_week_graph_cache_json');
add_action('wp_ajax_xmpp_uptime_week_graph_cache_data', 'shortcode_xmpp_uptime_week_graph_cache_json');

//Show system uptime day graph
function shortcode_system_uptime_day_graph() {
	//Return loading information
	return '<div class="graph-container"><h3>'.__('System uptime - by day', 'xmpp-statistics').'</h3><div id="system_uptime_day_graph" style="max-width:'.get_option('xmpp_stats_graph_width', 437).'px; height:'.get_option('xmpp_stats_graph_height', 220).'px;" class="graph-placeholder"><i title="'.__('Loading', 'xmpp-statistics').'..." class="fa fa-spinner fa-pulse" style="line-height:'.get_option('xmpp_stats_graph_height', 220).'px;" aria-hidden="true"></i></div></div>';
}
//Return graph data in json via ajax
function shortcode_system_uptime_day_graph_json() {
	//Datebase data
	global $wpdb;
	$table_name = $wpdb->prefix . 'xmpp_stats';
	//Get latest record
	$latest_record = $wpdb->get_row("SELECT * FROM $table_name WHERE type = '6' ORDER BY timestamp DESC");
	//Calculating oldest date
	$oldest = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(24*60*60));
	//Get data from the last 24 hours
	$rows = $wpdb->get_results("SELECT * FROM $table_name WHERE type = '6' AND timestamp > '$oldest' ORDER BY timestamp ASC");
	//Auxiliary variables
	$count = 0;
	$prev_timestamp = 0;
	foreach($rows as $row) {
		$value = $row->value;
		$prev_value = $rows[$count-1]->value;
		$next_value = $rows[$count+1]->value;
		if(($value == 0) && ($prev_value != 0) && (($next_value != 0) || !$next_value)) {
			/* probably connection error */
		} else {
			//Get current timestamp
			$timestamp = strtotime($row->timestamp);
			//Check previous timestamp
			if($prev_timestamp) {
				$prev_timestamp = $timestamp - $prev_timestamp;
				//Gaps in data
				if($prev_timestamp>3600) {
					$data[] = array(strtotime($rows[$count-1]->timestamp)*1000, $prev_value/(60*60*24));
					$data[] = array(($timestamp-1800)*1000, null);
					$is_gap = true;
				}
			}
			//Save current timestamp as previous
			$prev_timestamp = $timestamp;
			//Put data in array
			if((!$prev_value) || ($prev_value > $value) || ($value > $next_value) || ($is_gap)) {
				$is_gap = false;
				$data[] = array($timestamp*1000, $value/(60*60*24));
			}
		}
		$count++;
	}
	//Save cache
	set_transient('xmpp_stats_system_uptime_day_graph', $data, 0);
	//Return response
	$resp = array(
		array('color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'data' => $data)
	);
	wp_send_json($resp);
}
add_action('wp_ajax_nopriv_system_uptime_day_graph_data', 'shortcode_system_uptime_day_graph_json');
add_action('wp_ajax_system_uptime_day_graph_data', 'shortcode_system_uptime_day_graph_json');
//Return graph cache data in json via ajax
function shortcode_xmpp_system_uptime_day_graph_cache_json() {
	//Get cache
	if(true == ($data = get_transient('xmpp_stats_system_uptime_day_graph'))) {
		//Return cache
		$resp = array(
			array('color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'data' => $data)
		);
		wp_send_json($resp);
	}
	//No data
	wp_send_json();
}
add_action('wp_ajax_nopriv_system_uptime_day_graph_cache_data', 'shortcode_xmpp_system_uptime_day_graph_cache_json');
add_action('wp_ajax_system_uptime_day_graph_cache_data', 'shortcode_xmpp_system_uptime_day_graph_cache_json');

//Show system uptime week graph
function shortcode_system_uptime_week_graph() {
	//Return loading information
	return '<div class="graph-container"><h3>'.__('System uptime - by week', 'xmpp-statistics').'</h3><div id="system_uptime_week_graph" style="max-width:'.get_option('xmpp_stats_graph_width', 437).'px; height:'.get_option('xmpp_stats_graph_height', 220).'px;" class="graph-placeholder"><i title="'.__('Loading', 'xmpp-statistics').'..." class="fa fa-spinner fa-pulse" style="line-height:'.get_option('xmpp_stats_graph_height', 220).'px;" aria-hidden="true"></i></div></div>';
}
//Return graph data in json via ajax
function shortcode_system_uptime_week_graph_json() {
	//Datebase data
	global $wpdb;
	$table_name = $wpdb->prefix . 'xmpp_stats';
	//Get latest record
	$latest_record = $wpdb->get_row("SELECT * FROM $table_name WHERE type = '6' ORDER BY timestamp DESC");
	//Calculating oldest date
	$oldest = date_i18n('Y-m-d H:i:s', strtotime($latest_record->timestamp)-(7*24*60*60));
	//Get data from the last week
	$rows = $wpdb->get_results("SELECT * FROM $table_name WHERE type = '6' AND timestamp > '$oldest' ORDER BY timestamp ASC");
	//Auxiliary variables
	$count = 0;
	$prev_timestamp = 0;
	foreach($rows as $row) {
		$value = $row->value;
		$prev_value = $rows[$count-1]->value;
		$next_value = $rows[$count+1]->value;
		if(($value == 0) && ($prev_value != 0) && (($next_value != 0) || !$next_value)) {
			/* probably connection error */
		} else {
			//Get current timestamp
			$timestamp = strtotime($row->timestamp);
			//Check previous timestamp
			if($prev_timestamp) {
				$prev_timestamp = $timestamp - $prev_timestamp;
				//Gaps in data
				if($prev_timestamp>3600) {
					$data[] = array(strtotime($rows[$count-1]->timestamp)*1000, $prev_value/(60*60*24));
					$data[] = array(($timestamp-1800)*1000, null);
					$is_gap = true;
				}
			}
			//Save current timestamp as previous
			$prev_timestamp = $timestamp;
			//Put data in array
			if((!$prev_value) || ($prev_value > $value) || ($value > $next_value) || ($is_gap)) {
				$is_gap = false;
				$data[] = array($timestamp*1000, $value/(60*60*24));
			}
		}
		$count++;
	}
	//Save cache
	set_transient('xmpp_stats_system_uptime_week_graph', $data, 0);
	//Return response
	$resp = array(
		array('color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'data' => $data)
	);
	wp_send_json($resp);
}
add_action('wp_ajax_nopriv_system_uptime_week_graph_data', 'shortcode_system_uptime_week_graph_json');
add_action('wp_ajax_system_uptime_week_graph_data', 'shortcode_system_uptime_week_graph_json');
//Return graph cache data in json via ajax
function shortcode_xmpp_system_uptime_week_graph_cache_json() {
	//Get cache
	if(true == ($data = get_transient('xmpp_stats_system_uptime_week_graph'))) {
		//Return cache
		$resp = array(
			array('color' => get_option('xmpp_stats_graph_line_color', '#71c73e'), 'data' => $data)
		);
		wp_send_json($resp);
	}
	//No data
	wp_send_json();
}
add_action('wp_ajax_nopriv_system_uptime_week_graph_cache_data', 'shortcode_xmpp_system_uptime_week_graph_cache_json');
add_action('wp_ajax_system_uptime_week_graph_cache_data', 'shortcode_xmpp_system_uptime_week_graph_cache_json');

//Add shortcodes
add_shortcode('xmpp_onlineusers_day_graph', 'shortcode_xmpp_onlineusers_day_graph');
add_shortcode('xmpp_onlineusers_week_graph', 'shortcode_xmpp_onlineusers_week_graph');
add_shortcode('xmpp_registeredusers_day_graph', 'shortcode_xmpp_registeredusers_day_graph');
add_shortcode('xmpp_registeredusers_week_graph', 'shortcode_xmpp_registeredusers_week_graph');
add_shortcode('xmpp_s2s_day_graph', 'shortcode_xmpp_s2s_day_graph');
add_shortcode('xmpp_s2s_week_graph', 'shortcode_xmpp_s2s_week_graph');
add_shortcode('xmpp_s2s_out_day_graph', 'shortcode_xmpp_s2s_out_day_graph');
add_shortcode('xmpp_s2s_out_week_graph', 'shortcode_xmpp_s2s_out_week_graph');
add_shortcode('xmpp_s2s_in_day_graph', 'shortcode_xmpp_s2s_in_day_graph');
add_shortcode('xmpp_s2s_in_week_graph', 'shortcode_xmpp_s2s_in_week_graph');
add_shortcode('xmpp_uptime_day_graph', 'shortcode_xmpp_uptime_day_graph');
add_shortcode('xmpp_uptime_week_graph', 'shortcode_xmpp_uptime_week_graph');
add_shortcode('system_uptime_day_graph', 'shortcode_system_uptime_day_graph');
add_shortcode('system_uptime_week_graph', 'shortcode_system_uptime_week_graph');
