jQuery(document).ready(function(e){function o(){e.ajax({method:"GET",url:xmpp_onlineusers_week_graph.data_url,dataType:"json",timeout:3e4,success:function(o){a=o,e.plot("#xmpp_onlineusers_week_graph",a,i)}})}function n(){e.ajax({method:"GET",url:xmpp_onlineusers_week_graph.cache_data_url,dataType:"json",timeout:3e4,success:function(o){o&&(a=o,e.plot("#xmpp_onlineusers_week_graph",a,i))},complete:function(){o(),setInterval(function(){o()},3e5)}})}var a=[],i={xaxis:{mode:"time",timezone:"browser",tickSize:[1,"day"],timeformat:"%a</br>%e.%m",dayNames:xmpp_onlineusers_week_graph.day_names},yaxis:{tickDecimals:0},series:{lines:{lineWidth:1},shadowSize:0},grid:{clickable:!0,hoverable:!0,color:xmpp_onlineusers_week_graph.grind_color,borderWidth:1},legend:{show:!1}};e("#xmpp_onlineusers_week_graph").bind("plothover",function(o,n,a){var i=null;if(a){if(i!=a.dataIndex){i=a.dataIndex,e("#flot-tooltip").remove();var t=a.datapoint[0],r=a.datapoint[1],p=new Date(t);p=p.toLocaleTimeString(),showToolTip(e("#xmpp_onlineusers_week_graph"),a.pageX,a.pageY,a.series.caption+r+xmpp_onlineusers_week_graph.caption+p)}}else e("#flot-tooltip").remove(),i=null}),n(),e(window).on("resize",function(){e.plot("#xmpp_onlineusers_week_graph",a,i)})});