<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script>
	$(document).ready(function() {
		$('#search_keyword').attr('value', getQueryStringValue('keyword'))
		$('#search_category option[value="'+getQueryStringValue('category')+'"]').attr('selected','selected')
		$('#search_ordering option[value="'+getQueryStringValue('ordering')+'"]').attr('selected','selected')
		$('#search_spotlight option[value="'+getQueryStringValue('spotlight')+'"]').attr('selected','selected')
	})
	function searchStore() {
		var data = {
			'keyword': $("#search_keyword").val(),
			'category': $("#search_category").val(),
			'ordering': $("#search_ordering").val(),
			'spotlight': $("#search_spotlight").val(),
		}
		var query = []
		for (key in data) {
			if (data[key] != '') {
				query.push(key+'='+data[key])
			}
		}
		if (query.length > 0) {
			Turbolinks.visit(document.location.pathname+'?'+query.join('&'), { action: "replace" })
		} else {
			Turbolinks.visit(document.location.pathname, { action: "replace" })
		}
	}
</script>
