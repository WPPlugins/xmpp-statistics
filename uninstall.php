<?php
/*
	Copyright (c) 2016 Krzysztof Grochocki

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

//Die if uninstall.php is not called by WordPress
if(!defined('WP_UNINSTALL_PLUGIN')) {
	die;
}
//Remove settings options
delete_option('xmpp_stats_rest_url');
delete_option('xmpp_stats_uptime_url');
delete_option('xmpp_stats_save_data');
delete_option('xmpp_stats_delete_old_data');
delete_option('xmpp_stats_login');
delete_option('xmpp_stats_password');
delete_option('xmpp_stats_set_last');
delete_option('xmpp_stats_graph_line_color');
delete_option('xmpp_stats_graph_line_color2');
delete_option('xmpp_stats_graph_grid_color');
delete_option('xmpp_stats_graph_width');
delete_option('xmpp_stats_graph_height');
delete_option('xmpp_stats_daily_graph_mode');
delete_option('xmpp_stats_rest_timeout');
delete_option('xmpp_stats_rest_retry');
//Delete cache
delete_transient('xmpp_stats_onlineusers_day_graph');
delete_transient('xmpp_stats_onlineusers_week_graph');
delete_transient('xmpp_stats_registeredusers_day_graph');
delete_transient('xmpp_stats_registeredusers_week_graph');
delete_transient('xmpp_stats_s2s_day_graph');
delete_transient('xmpp_stats_s2s_week_graph');
delete_transient('xmpp_stats_s2s_out_day_graph');
delete_transient('xmpp_stats_s2s_out_week_graph');
delete_transient('xmpp_stats_s2s_in_day_graph');
delete_transient('xmpp_stats_s2s_in_week_graph');
delete_transient('xmpp_stats_xmpp_uptime_day_graph');
delete_transient('xmpp_stats_xmpp_uptime_week_graph');
delete_transient('xmpp_stats_system_uptime_day_graph');
delete_transient('xmpp_stats_system_uptime_week_graph');
//Delete statistics table
global $wpdb;
$table_name = $wpdb->prefix . 'xmpp_stats';
$wpdb->query("DROP TABLE IF EXISTS $table_name");
