jQuery(document).ready(function(e){function t(){e.ajax({method:"GET",url:xmpp_registeredusers.data_url,timeout:xmpp_registeredusers.timeout,success:function(t){e("#xmpp_registeredusers").html(t.data)},error:function(){e("#xmpp_registeredusers").html("-")}})}t(),setInterval(function(){t()},3e5)});