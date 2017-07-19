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
	along with GNU Radio. If not, see <http://www.gnu.org/licenses/>.
*/

jQuery(document).ready(function($) {
	function get_xmpp_uptime() {
		$.ajax({
			method: "GET",
			url: xmpp_uptime.data_url,
			timeout: xmpp_uptime.timeout,
			success: function(response) {
				$('#xmpp_uptime').html(response.data);
				$('#xmpp_uptime span').addClass('hint--'+$('#xmpp_uptime').attr('hint-position')+' hint--'+$('#xmpp_uptime').attr('hint-style'));
			},
			error: function() {
				$('#xmpp_uptime').html('-');
			}
		});
	}
	get_xmpp_uptime();
	setInterval(function() {
		get_xmpp_uptime();
	}, 300000);
});