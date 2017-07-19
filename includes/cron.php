<?php
/*
	Copyright (c) 2015-2016 Krzysztof Grochocki

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

//Activation hook
function xmpp_stats_activated() {
	//Add statistics cron job
	wp_schedule_event(time(), 'everyfiveminutes', 'xmpp_stats_cron');
	//Create table for statistics
	global $wpdb;
	$wpdb->query("CREATE TABLE {$wpdb->prefix}xmpp_stats (
		id bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
		timestamp timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
		type tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
		value int(12) UNSIGNED NOT NULL DEFAULT 0,
		UNIQUE KEY id (id)
	) {$wpdb->get_charset_collate()};");
}
register_activation_hook(XMPP_STATS_DIR_PATH.'xmpp-stats.php', 'xmpp_stats_activated');

//Deactivation hook
function xmpp_stats_deactivated() {
	//Remove statistics cron job
	wp_clear_scheduled_hook('xmpp_stats_cron');
}
register_deactivation_hook(XMPP_STATS_DIR_PATH.'xmpp-stats.php', 'xmpp_stats_deactivated' );

//Add cron schedule
function xmpp_stats_schedule_recurrence($schedules) {
	$schedules['everyfiveminutes'] = array(
		'interval' => 300,
		'display' => __('Once Every 5 Minutes', 'xmpp-statistics')
	);
	return $schedules;
}
add_filter('cron_schedules', 'xmpp_stats_schedule_recurrence');

//Add statistics cron job action
function xmpp_stats_cron() {
	//If statistics are to be saved
	if(get_option('xmpp_stats_save_data')) {
		//Get current time in UTC
		$now = current_time('mysql', 1);
		//Get statistics
		$online = json_decode(xmpp_stats_get_xmpp_data('stats', array('name' => 'onlineusers')))->stat;
		$registered = json_decode(xmpp_stats_get_xmpp_data('stats', array('name' => 'registeredusers')))->stat;
		$s2s_out = json_decode(xmpp_stats_get_xmpp_data('outgoing_s2s_number'))->s2s_outgoing;
		$s2s_in = json_decode(xmpp_stats_get_xmpp_data('incoming_s2s_number'))->s2s_incoming;
		$xmpp_uptime = json_decode(xmpp_stats_get_xmpp_data('stats', array('name' => 'uptimeseconds')))->stat;
		$system_uptime = xmpp_stats_get_system_data();
		if($system_uptime != 0) $system_uptime = strtotime($now)-$system_uptime;
		//Save statistics to database
		global $wpdb;
		$table_name = $wpdb->prefix . 'xmpp_stats';
		$wpdb->insert(
			$table_name,
			array(
				'timestamp' => $now,
				'type' => '1',
				'value' => $online
			)
		);
		$wpdb->insert(
			$table_name,
			array(
				'timestamp' => $now,
				'type' => '2',
				'value' => $registered
			)
		);
		$wpdb->insert(
			$table_name,
			array(
				'timestamp' => $now,
				'type' => '3',
				'value' => $s2s_out
			)
		);
		$wpdb->insert(
			$table_name,
			array(
				'timestamp' => $now,
				'type' => '4',
				'value' => $s2s_in
			)
		);
		$wpdb->insert(
			$table_name,
			array(
				'timestamp' => $now,
				'type' => '5',
				'value' => $xmpp_uptime
			)
		);
		$wpdb->insert(
			$table_name,
			array(
				'timestamp' => $now,
				'type' => '6',
				'value' => $system_uptime
			)
		);
		//Delete unnecessary data older than 2 weeks
		if(get_option('xmpp_stats_delete_old_data')) {
			$latest = $wpdb->get_row("SELECT * FROM $table_name WHERE id = (SELECT MAX(id) FROM $table_name);");
			$time = date_i18n('Y-m-d H:i:s', strtotime($latest->timestamp)-(14*24*60*60));
			$wpdb->query("DELETE FROM $table_name WHERE timestamp < '$time'");
			$all = $wpdb->get_col("SELECT id FROM $table_name");
			foreach($all as $col) {
				$count++;
				$wpdb->query("UPDATE $table_name SET id=$count WHERE id=$col");
			}
			$count++;
			$wpdb->query("ALTER TABLE $table_name AUTO_INCREMENT=$count;");
		}
	}
}
add_action('xmpp_stats_cron', 'xmpp_stats_cron');
