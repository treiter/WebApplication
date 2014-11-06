$(function() {
	$("#individualid").autocomplete({
		source: "/ajax_autocompleteIndividualId.php",
		minLength: 2,
		select: function(event, ui) {
			var url = ui.item.id;
			if(url != '#') {
				location.href = '/blog/' + url;
			}
		},
		open: function(event, ui) {
			$(".ui-autocomplete").css("z-index", 1000);
		}
	});
});