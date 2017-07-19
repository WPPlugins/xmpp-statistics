<?php
/*
Plugin Name: XMPP Statistics
Plugin URI: https://beherit.pl/en/wordpress/plugins/xmpp-statistics/
Description: Displays the statistics from ejabberd XMPP server through REST API.
Version: 1.7.2
Author: Krzysztof Grochocki
Author URI: https://beherit.pl/
Text Domain: xmpp-statistics
Domain Path: /languages
License: GPLv3
*/

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

//Define plugin basename, dir path and dir url
define('XMPP_STATS_BASENAME', plugin_basename(__FILE__));
define('XMPP_STATS_DIR_PATH', plugin_dir_path(__FILE__));
define('XMPP_STATS_DIR_URL', plugin_dir_url(__FILE__));

//Define plugin version
define('XMPP_STATS_VERSION', '1.7.2');

//Load plugin translations
function xmpp_stats_textdomain() {
	load_plugin_textdomain('xmpp-statistics', false, dirname(XMPP_STATS_BASENAME).'/languages');
}
add_action('plugins_loaded', 'xmpp_stats_textdomain');

//Include admin settings
include_once(XMPP_STATS_DIR_PATH.'includes/admin.php');

//Include functions
include_once(XMPP_STATS_DIR_PATH.'includes/functions.php');

//Include cron
include_once(XMPP_STATS_DIR_PATH.'includes/cron.php');

//Include simple stats
include_once(XMPP_STATS_DIR_PATH.'includes/simple.php');

//Include graphs
include_once(XMPP_STATS_DIR_PATH.'includes/graphs.php');
