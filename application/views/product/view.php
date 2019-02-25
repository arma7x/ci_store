<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row starter-template">
	<div class="col col-12 col-md-6 p-1">
		<div class="mb-4">
			<div id="carouselSlider" class="carousel slide" data-ride="carousel">
<!--
				<ol class="carousel-indicators">
					<li data-target="#carouselSlider" data-slide-to="0" class="active"></li>
					<li data-target="#carouselSlider" data-slide-to="1"></li>
					<li data-target="#carouselSlider" data-slide-to="2"></li>
				</ol>
-->
				<div class="carousel-inner">
					<div class="carousel-item active">
						<img src="https://colorlib.com/preview/theme/amado/img/bg-img/1.jpg" class="d-block w-100" alt="...">
					</div>
					<div class="carousel-item">
						<img src="https://colorlib.com/preview/theme/amado/img/bg-img/1.jpg" class="d-block w-100" alt="...">
					</div>
					<div class="carousel-item">
						<img src="https://colorlib.com/preview/theme/amado/img/bg-img/1.jpg" class="d-block w-100" alt="...">
					</div>
				</div>
<!--
				<a class="carousel-control-prev" href="#carouselSlider" role="button" data-slide="prev">
					<i class="material-icons" style="font-size:3em">&#xe408;</i>
				</a>
				<a class="carousel-control-next" href="#carouselSlider" role="button" data-slide="next">
					<i class="material-icons" style="font-size:3em">&#xe409;</i>
				</a>
-->
			</div>
		</div>
		<div>
			<div class="row m-0">
				<div id="thumb_0" class="col col-4 p-0 border border-primary">
					<a onClick="$('#carouselSlider').carousel(0)"><img src="https://colorlib.com/preview/theme/amado/img/bg-img/1.jpg" class="d-block w-100"></a>
				</div>
				<div id="thumb_1" class="col col-4 p-0">
					<a onClick="$('#carouselSlider').carousel(1)"><img src="https://colorlib.com/preview/theme/amado/img/bg-img/1.jpg" class="d-block w-100"></a>
				</div>
				<div id="thumb_2" class="col col-4 p-0">
					<a onClick="$('#carouselSlider').carousel(2)"><img src="https://colorlib.com/preview/theme/amado/img/bg-img/1.jpg" class="d-block w-100"></a>
				</div>
			</div>
		</div>
		<script>
			$('.carousel').carousel({
				interval: 10000
			})
			$('#carouselSlider').on('slide.bs.carousel', function (e) {
				$('#thumb_'+e.from).removeClass('border border-primary')
				$('#thumb_'+e.to).addClass('border border-primary')
			})
		</script>
	</div>
	<div class="col col-12 col-md-6 p-1 px-md-4">
		<h5 class="text-primary">$180</h5>
		<h2>White Modern Chair</h2>
		<p class="avaibility"><i class="fa fa-circle"></i> In Stock</p>
		<div class="my-3">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid quae eveniet culpa officia quidem mollitia impedit iste asperiores nisi reprehenderit consequatur, autem, nostrum pariatur enim?</p>
		</div>
	</div>
</div>
