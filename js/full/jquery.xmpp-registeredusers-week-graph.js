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
			dayNames: xmpp_registeredusers_week_graph.day_names
		},
		yaxis: {
			tickDecimals: 0
		},
		series: {
			lines: {
				lineWidth: 1
			},
			shadowSize: 0
		},
		grid: {
			clickable: true,
			hoverable: true,
			color: xmpp_registeredusers_week_graph.grind_color,
			borderWidth: 1
		},
		legend: {
			show: false
		}
	};
	//Show tooltip
	$("#xmpp_registeredusers_week_graph").bind("plothover", function (event, pos, item) {
		var previousPoint = null;
		if(item) {
			if(previousPoint != item.dataIndex) {
				previousPoint = item.dataIndex;
				$("#flot-tooltip").remove();
				var x = item.datapoint[0],
					y = item.datapoint[1];

				var date = new Date(x);
				date = date.toLocaleTimeString();

				showToolTip($("#xmpp_registeredusers_week_graph"), item.pageX, item.pageY, y + xmpp_registeredusers_day_graph.caption + date);
			}
		} else {
			$("#flot-tooltip").remove();
			previousPoint = null;
		}
	});
	//Get fresh data and draw graph
	function getDataAndDraw() {
		$.ajax({
			method: "GET",
			url: xmpp_registeredusers_week_graph.data_url,
			dataType: "json",
			timeout: 30000,
			success: function(response) {
				data = response;
				$.plot("#xmpp_registeredusers_week_graph", data, options);
			}
		});
	}
	//Get cache data and draw graph
	function getCacheDataAndDraw() {
		$.ajax({
			method: "GET",
			url: xmpp_registeredusers_week_graph.cache_data_url,
			dataType: "json",
			timeout: 30000,
			success: function(response) {
				if(response) {
					data = response;
					$.plot("#xmpp_registeredusers_week_graph", data, options);
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
		$.plot("#xmpp_registeredusers_week_graph", data, options);
	});
});