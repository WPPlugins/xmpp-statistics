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
			tickSize: [4, "hour"],
			timeformat: "%a</br>%H:%S",
			dayNames: xmpp_s2s_day_graph.day_names
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
			color: xmpp_s2s_day_graph.grind_color,
			borderWidth: 1
		},
		legend: {
			show: false
		}
	};
	//Show tooltip
	$("#xmpp_s2s_day_graph").bind("plothover", function (event, pos, item) {
		var previousPoint = null;
		if(item) {
			if(previousPoint != item.dataIndex) {
				previousPoint = item.dataIndex;
				$("#flot-tooltip").remove();
				var x = item.datapoint[0],
					y = item.datapoint[1];

				var date = new Date(x);
				date = date.toLocaleTimeString();

				showToolTip($("#xmpp_s2s_day_graph"), item.pageX, item.pageY, y + ' ' + item.series.caption + xmpp_s2s_day_graph.caption + date);
			}
		} else {
			$("#flot-tooltip").remove();
			previousPoint = null;
		}
	});
	//Insert checkboxes
	function InsertCheckboxes() {
		if($("#xmpp_s2s_day_graph_choices").is(":empty")) {
			var choiceContainer = $("#xmpp_s2s_day_graph_choices");
			$.each(data, function(key, val) {
				choiceContainer.append('<div><input type="checkbox" name="' + key +
					'" checked="checked" id="xmpp_s2s_day_graph_choices_' + key + '"></input>' +
					'<label for="xmpp_s2s_day_graph_choices_' + key + '" style="color:' + val.color + ';">'
					+ val.label + '</label></div>');
			});
			choiceContainer.find('input').click(plotAccordingToChoices);
		}
	}
	//Draw graph
	function plotAccordingToChoices() {
		//Set custom data
		var custom_data = [];
		$("#xmpp_s2s_day_graph_choices").find("input:checked").each(function () {
			var key = $(this).attr("name");
			if(key && data[key]) {
				custom_data.push(data[key]);
			}
		});
		//Draw graph
		if(custom_data.length > 0) {
			$.plot("#xmpp_s2s_day_graph", custom_data, options);
		}
	}
	//Get fresh data and draw graph
	function getDataAndDraw() {
		$.ajax({
			method: "GET",
			url: xmpp_s2s_day_graph.data_url,
			dataType: "json",
			timeout: 30000,
			success: function(response) {
				data = response;
				InsertCheckboxes();
				plotAccordingToChoices();
			}
		});
	}
	//Get cache data and draw graph
	function getCacheDataAndDraw() {
		$.ajax({
			method: "GET",
			url: xmpp_s2s_day_graph.cache_data_url,
			dataType: "json",
			timeout: 30000,
			success: function(response) {
				if(response) {
					data = response;
					InsertCheckboxes();
					plotAccordingToChoices();
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
		plotAccordingToChoices();
	});
});