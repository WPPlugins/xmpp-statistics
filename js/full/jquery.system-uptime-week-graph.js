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
	//Graph data
	var data = [];
	//Graph options
	var options = {
		xaxis: {
			mode: "time",
			timezone: "browser",
			tickSize: [1, "day"],
			timeformat: "%a</br>%e.%m",
			dayNames: system_uptime_week_graph.day_names
		},
		yaxis: {
			tickDecimals: 0
		},
		series: {
			lines: {
				lineWidth: 0,
				fill: true
			},
			shadowSize: 0
		},
		grid: {
			color: system_uptime_week_graph.grind_color,
			borderWidth: 1
		},
		legend: {
			show: false
		}
	};
	//Get fresh data and draw graph
	function getDataAndDraw() {
		$.ajax({
			method: "GET",
			url: system_uptime_week_graph.data_url,
			dataType: "json",
			timeout: 30000,
			success: function(response) {
				data = response;
				$.plot("#system_uptime_week_graph", data, options);
			}
		});
	}
	//Get cache data and draw graph
	function getCacheDataAndDraw() {
		$.ajax({
			method: "GET",
			url: system_uptime_week_graph.cache_data_url,
			dataType: "json",
			timeout: 30000,
			success: function(response) {
				if(response) {
					data = response;
					$.plot("#system_uptime_week_graph", data, options);
				}
			},
			complete: function() {
				//Get fresh data and draw graph
				getDataAndDraw();
				//Set timer
				setInterval(function() {
					getDataAndDraw();
				}, 300000);
			}
		});
	}
	getCacheDataAndDraw();
	//Redraw graph
	$(window).on("resize", function( event ) {
		$.plot("#system_uptime_week_graph", data, options);
	});
});