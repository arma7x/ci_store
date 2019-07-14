<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script>
	$('.carousel').carousel({
		interval: 10000
	})
	$('#carouselSlider').on('slide.bs.carousel', function (e) {
		$('#thumb_'+e.from).removeClass('border border-primary')
		$('#thumb_'+e.to).addClass('border border-primary')
	})

	function removeCache(id) {
		if (window.localStorage) {
			window.localStorage.removeItem(id)
			goHome()
		}
	}

	$(document).ready(function() {
		var product = <?php echo json_encode($product) ?>;
		delete product['full_description'];
		if (window.localStorage) {
			window.localStorage.setItem(product.id, JSON.stringify(product))
		}
	})
</script>
