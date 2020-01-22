$("#tellsub").click( function() {
	$.post( $("#tell").attr("action"), $("#tell :input").serializeArray(), function(info){ $("#result").html(info); });

});
	$("#tell").submit( function() {
		return false;
	});

$("#passsub").click( function() {
	$.post( $("#pass").attr("action"), $("#pass :input").serializeArray(), function(info){ $("#result2").html(info); });

});
	$("#pass").submit( function() {
		return false;
	});
