/*
	Copyright (c) 2015 Krzysztof Grochocki

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

function showToolTip(graph, x, y, contents) {
	if(screen.width>768) {
		jQuery('<div id="flot-tooltip">' + contents + '</div>').css({
			top: y - 16,
			left: x + 20,
		}).appendTo('body').fadeIn(200);
	}
	else {
		jQuery('<div id="flot-tooltip" class="mobile">' + contents + '</div>').css({
			top: 8,
			right: 13,
			display: 'inline'
		}).appendTo(graph).fadeIn(200);
	}
};