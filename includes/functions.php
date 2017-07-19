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

//Get XMPP data by ReST API
function xmpp_stats_get_xmpp_data($command, $arguments = '') {
	//POST arguments
	$args = array(
		'headers' => array(
			'Authorization' => 'Basic '.base64_encode(get_option('xmpp_stats_login').':'.get_option('xmpp_stats_password')),
			'X-Admin' => 'true'
		),
		'body' => json_encode($arguments),
		'timeout' => get_option('xmpp_stats_rest_timeout', 5),
		'redirection' => 0,
		'httpversion' => '1.1',
		'sslverify' => apply_filters('xmpp_stats_sslverify', true)
	);
	//POST data
	$rest_url = get_option('xmpp_stats_rest_url');
	$retry_limit = get_option('xmpp_stats_rest_retry', 3);
	$retry_count = 0;
	while($retry_count < $retry_limit) {
		$response = wp_remote_post($rest_url.'/'.$command, $args);
		if(is_wp_error($response)) { /* error */ }
		else if($response['response']['code'] == 200) {
			break;
		}
		$retry_count++;
	}
	//Server temporarily unavailable
	if(is_wp_error($response)) {
		return;
	}
	//Verify response
	else if($response['response']['code'] == 200) {
		//Set last activity information
		if(get_option('xmpp_stats_set_last')) {
			//POST arguments
			list($user, $host) = explode('@', get_option('xmpp_stats_login'));
			$args = array(
				'headers' => array(
					'Authorization' => 'Basic '.base64_encode(get_option('xmpp_stats_login').':'.get_option('xmpp_stats_password')),
					'X-Admin' => 'true'
				),
				'body' => json_encode(array('user' => $user, 'host' => $host, 'timestamp' => current_time('timestamp', 1))),
				'timeout' => get_option('xmpp_stats_rest_timeout', 5),
				'redirection' => 0,
				'httpversion' => '1.1',
				'sslverify' => apply_filters('xmpp_stats_sslverify', true),
				'blocking' => false
			);
			//POST data
			wp_remote_post($rest_url.'/set_last', $args);
		}
		//Return response body
		return $response['body'];
	}
	//Unexpected error
	return;
}

//Get system data by HTTP
function xmpp_stats_get_system_data() {
	//POST arguments
	$args = array(
		'timeout' => get_option('xmpp_stats_rest_timeout', 5),
		'redirection' => 0,
		'sslverify' => apply_filters('xmpp_stats_sslverify', true)
	);
	//POST data
	$retry_limit = get_option('xmpp_stats_rest_retry', 3);
	$retry_count = 0;
	while($retry_count < $retry_limit) {
		$response = wp_remote_get(get_option('xmpp_stats_uptime_url'), $args);
		if(is_wp_error($response)) { /* error */ }
		else if($response['response']['code'] == 200) {
			break;
		}
		$retry_count++;
	}
	//Server temporarily unavailable
	if(is_wp_error($response)) {
		return;
	}
	//Verify response
	else if($response['response']['code'] == 200) {
		//Return response body
		return $response['body'];
	}
	//Unexpected error
	return;
}

//Change seconds to friendly view
function xmpp_stats_seconds_to_datestamp($seconds) {
	if($seconds == 0) return '0s';
    $can_print = false;
    $divs = array(86400, 3600, 60, 1);
    for($div=0; $div<4; $div++) {
        $res = (int)($seconds/$divs[$div]);
        $rem = $seconds % $divs[$div];
        if($res != 0) $can_print = true;
        if($can_print) $return .= sprintf('%d%s ', $res, substr('dhms', $div, 1));
        $seconds = $rem;
    }
    return trim($return);
}

//Change second to friendly view #2
function xmpp_stats_timestamp_to_date($timestamp) {
	$now = current_time('timestamp');
	$last_midnight = $now - ($now % (24*60*60));
	$day_name = date_i18n("j M, G:i T", $timestamp);
	if($timestamp >= $last_midnight) {
		$day_name = __('today', 'xmpp-statistics').', '.date_i18n("G:i T", $timestamp);
	} else if($timestamp >= ($last_midnight-(24*60*60))) {
		$day_name = __('yesterday', 'xmpp-statistics').', '.date_i18n("G:i T", $timestamp);
	}
	return $day_name;
}
