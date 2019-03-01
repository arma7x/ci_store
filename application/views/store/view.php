<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row starter-template mt-2">
	<div class="col col-12 col-md-6 p-1">
		<div class="mb-4">
			<div id="carouselSlider" class="carousel slide" data-ride="carousel">
				<!--
				<ol class="carousel-indicators">
					<li data-target="#carouselSlider" data-slide-to="0" class="active"></li>
					<li data-target="#carouselSlider" data-slide-to="1"></li>
					<li data-target="#carouselSlider" data-slide-to="2"></li>
					<li data-target="#carouselSlider" data-slide-to="3"></li>
				</ol>
				-->
				<div class="carousel-inner">
					<div class="carousel-item active">
						<img src="https://colorlib.com/preview/theme/amado/img/bg-img/<?php echo $this->uri->segment(2) ?>.jpg" class="d-block w-100" alt="...">
					</div>
					<div class="carousel-item">
						<img src="https://colorlib.com/preview/theme/amado/img/bg-img/<?php echo $this->uri->segment(2) ?>.jpg" class="d-block w-100" alt="...">
					</div>
					<div class="carousel-item">
						<img src="https://colorlib.com/preview/theme/amado/img/bg-img/<?php echo $this->uri->segment(2) ?>.jpg" class="d-block w-100" alt="...">
					</div>
					<div class="carousel-item">
						<img src="https://colorlib.com/preview/theme/amado/img/bg-img/<?php echo $this->uri->segment(2) ?>.jpg" class="d-block w-100" alt="...">
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
		<div class="mb-1">
			<div class="row m-0">
				<div id="thumb_0" class="col col-# p-0 border border-primary">
					<a onClick="$('#carouselSlider').carousel(0)"><img src="https://colorlib.com/preview/theme/amado/img/bg-img/<?php echo $this->uri->segment(2) ?>.jpg" class="d-block w-100"></a>
				</div>
				<div id="thumb_1" class="col col-3 p-0">
					<a onClick="$('#carouselSlider').carousel(1)"><img src="https://colorlib.com/preview/theme/amado/img/bg-img/<?php echo $this->uri->segment(2) ?>.jpg" class="d-block w-100"></a>
				</div>
				<div id="thumb_2" class="col col-3 p-0">
					<a onClick="$('#carouselSlider').carousel(2)"><img src="https://colorlib.com/preview/theme/amado/img/bg-img/<?php echo $this->uri->segment(2) ?>.jpg" class="d-block w-100"></a>
				</div>
				<div id="thumb_3" class="col col-3 p-0">
					<a onClick="$('#carouselSlider').carousel(3)"><img src="https://colorlib.com/preview/theme/amado/img/bg-img/<?php echo $this->uri->segment(2) ?>.jpg" class="d-block w-100"></a>
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
	<div class="col col-12 col-md-6 p-1 pt-0 px-md-4">
		<h4 class="text-primary font-weight-bold">RM180</h4>
		<h2 class="my-4">White Modern Chair</h2>
		<div class="row mb-3">
			<h6 class="ml-3 text-success font-weight-bold"><i class="material-icons">&#xe3fa;</i> In Stock</h6>
			<!--
				<h6 class="text-danger font-weight-bold"><i class="material-icons">&#xe3fa;</i> Out Stock</h6>
			-->
			<h6 class="ml-5 text-primary font-weight-bold"><a onClick="alert(1)"><i class="material-icons">&#xe87d;</i> Saved</a></h6>
			<!--
				<h6 class="ml-5 text-primary font-weight-bold"><a onClick="alert(2)"><i class="material-icons">&#xe87e; Unsaved</i></a></h6>
			-->
		</div>
		<div class="row mb-2">
			<ul class="list-inline text-center ml-3">
			<?php foreach($this->container['ic_link'] as $key => $value): ?>
				<li class="list-inline-item mb-2">
					<a target="_blank" href="<?php echo str_replace('%param', 'PRODUCT ID & NAME', $value['url']) ?>">
						<img id="ic_pm_<?php echo $value['id'] ?>" class="btn-circle shadow-sm" src="/static/img/favicon-32x32.png" alt="<?php echo $value['name'] ?>" data-toggle="tooltip" data-placement="right" title="<?php echo $value['name'] ?>" style="width:30px;height:30px"/>
					</a>
				</li>
			<?php endforeach ?>
				<?php if (isset($this->container['gi_link']['mobile_number'])): ?>
				<?php if ($this->container['gi_link']['mobile_number'] !== ''): ?>
				<li class="list-inline-item mb-2">
					<a href="sms:<?php echo $this->container['gi_link']['mobile_number'] ?>?body=PRODUCT ID & NAME" data-toggle="tooltip" data-placement="right" title="<?php echo $this->container['gi_link']['mobile_number'] ?>">
						<button class="btn btn-primary btn-circle shadow-sm" style="width:30px;height:30px">
							<i class="material-icons mi_fab" style="font-size:1em;margin:-8px 0 0 -6px;">&#xe0d8;</i>
						</button>
					</a>
				</li>
				<?php endif ?>
				<?php endif ?>
			</ul>
		</div>
		<hr class="star-primary" style="margin-top:8px;margin-bottom:25px;">
		<div class="mb-2">
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid quae eveniet culpa officia quidem mollitia impedit iste asperiores nisi reprehenderit consequatur, autem, nostrum pariatur enim? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid quae eveniet culpa officia quidem mollitia impedit iste asperiores nisi reprehenderit consequatur, autem, nostrum pariatur enim? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid quae eveniet culpa officia quidem mollitia impedit iste asperiores nisi reprehenderit consequatur, autem, nostrum pariatur enim? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid quae eveniet culpa officia quidem mollitia impedit iste asperiores nisi reprehenderit consequatur, autem, nostrum pariatur enim? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid quae eveniet culpa officia quidem mollitia impedit iste asperiores nisi reprehenderit consequatur, autem, nostrum pariatur enim? Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid quae eveniet culpa officia quidem mollitia impedit iste asperiores nisi reprehenderit consequatur, autem, nostrum pariatur enim?</p>
		</div>
	</div>
</div>
