<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="row starter-template mt-2">
	<div class="col col-12 col-md-6 p-1">
		<div class="mb-4">
			<div id="carouselSlider" class="carousel slide" data-ride="carousel">
				<div class="carousel-inner">
					<div class="carousel-item active">
						<img id="main_photo" src="/static/img/loading.gif" class="d-block w-100" alt="...">
						<script>
							$(document).ready(function() {
								if (isCORS('<?php echo $product['main_photo'] ?>')) {
									resizePicture('<?php echo $product['main_photo'] ?>', null, 533, 533, .50, 'image/webp', renderImg, '#main_photo')
								} else {
									renderImg('<?php echo $product['main_photo'] ?>', '#main_photo')
								}
							})
						</script>
					</div>
					<?php if($product['second_photo'] !== ''): ?>
					<div class="carousel-item">
						<img id="second_photo" src="/static/img/loading.gif" class="d-block w-100" alt="...">
						<script>
							$(document).ready(function() {
								if (isCORS('<?php echo $product['second_photo'] ?>')) {
									resizePicture('<?php echo $product['second_photo'] ?>', null, 533, 533, .50, 'image/webp', renderImg, '#second_photo')
								} else {
									renderImg('<?php echo $product['second_photo'] ?>', '#second_photo')
								}
							})
						</script>
					</div>
					<?php endif ?>
					<?php if($product['third_photo'] !== ''): ?>
					<div class="carousel-item">
						<img id="third_photo" src="/static/img/loading.gif" class="d-block w-100" alt="...">
						<script>
							$(document).ready(function() {
								if (isCORS('<?php echo $product['third_photo'] ?>')) {
									resizePicture('<?php echo $product['third_photo'] ?>', null, 533, 533, .50, 'image/webp', renderImg, '#third_photo')
								} else {
									renderImg('<?php echo $product['third_photo'] ?>', '#third_photo')
								}
							})
						</script>
					</div>
					<?php endif ?>
					<?php if($product['fourth_photo'] !== ''): ?>
					<div class="carousel-item">
						<img id="fourth_photo" src="/static/img/loading.gif" class="d-block w-100" alt="...">
						<script>
							$(document).ready(function() {
								if (isCORS('<?php echo $product['fourth_photo'] ?>')) {
									resizePicture('<?php echo $product['fourth_photo'] ?>', null, 533, 533, .50, 'image/webp', renderImg, '#fourth_photo')
								} else {
									renderImg('<?php echo $product['fourth_photo'] ?>', '#fourth_photo')
								}
							})
						</script>
					</div>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col col-12 col-md-6 p-1 pt-0 px-md-4">
		<h4 class="text-primary font-weight-bold"><?php echo $this->container['currency_unit'].$product['price'] ?></h4>
		<h2 class="my-3 font-weight-bold"><?php echo $product['name'] ?></h2>
		<div class="row mb-3">
			<?php if($product['availability'] === '1'): ?>
			<h6 class="ml-3 text-success font-weight-bold"><i class="material-icons">&#xe3fa;</i> <?php echo lang('L_P_AVAILABILITY_TRUE');?></h6>
			<?php else :?>
			<h6 class="ml-3 text-danger font-weight-bold"><i class="material-icons">&#xe3fa;</i> <?php echo lang('L_P_AVAILABILITY_FALSE');?></h6>
			<?php endif?>
			<?php if($product['spotlight'] === '1'): ?>
			<h6 class="ml-5 text-primary font-weight-bold"><i class="material-icons">&#xe89a;</i> <?php echo lang('L_P_SPOTLIGHT');?></h6>
			<?php endif?>
		</div>
		<h6 class="text-muted font-weight-bold"><?php echo lang('L_P_ORDER_HERE') ?></h6>
		<div class="row mb-3">
			<ul class="list-inline text-center ml-3">
			<?php foreach($this->container['ic_link'] as $key => $value): ?>
				<li class="list-inline-item">
					<a target="_blank" href="<?php echo str_replace('%param', $product['id'].' - '.$product['name'], $value['url']) ?>">
						<img id="ic_pm_<?php echo $value['id'] ?>" class="btn-circle shadow-sm" src="/static/img/favicon-32x32.png" alt="<?php echo $value['name'] ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $value['name'] ?>" style="width:30px;height:30px"/>
					</a>
				</li>
			<?php endforeach ?>
				<?php if (isset($this->container['gi_link']['mobile_number'])): ?>
				<?php if ($this->container['gi_link']['mobile_number'] !== ''): ?>
				<li class="list-inline-item">
					<a href="sms:<?php echo $this->container['gi_link']['mobile_number'] ?>?body=<?php echo $product['id'].' - '.$product['name'] ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $this->container['gi_link']['mobile_number'] ?>">
						<button class="btn btn-primary btn-circle shadow-sm" style="width:30px;height:30px">
							<i class="material-icons mi_fab" style="font-size:1em;margin:-8px 0 0 -6px;">&#xe0d8;</i>
						</button>
					</a>
				</li>
				<?php endif ?>
				<?php endif ?>
			</ul>
		</div>
		<div class="mb-3">
			<div class="row m-0">
				<div id="thumb_0" class="col col-3 p-0 border border-primary">
					<a onClick="$('#carouselSlider').carousel(0)">
						<img id="t_main_photo" src="/static/img/loading.gif" class="d-block w-100">
					</a>
					<script>
						$(document).ready(function() {
							if (isCORS('<?php echo $product['main_photo'] ?>')) {
								resizePicture('<?php echo $product['main_photo'] ?>', null, 533, 533, .50, 'image/webp', renderImg, '#t_main_photo')
							} else {
								renderImg('<?php echo $product['main_photo'] ?>', '#t_main_photo')
							}
						})
					</script>
				</div>
				<?php if($product['second_photo'] !== ''): ?>
				<div id="thumb_1" class="col col-3 p-0">
					<a onClick="$('#carouselSlider').carousel(1)">
						<img id="t_second_photo" src="/static/img/loading.gif" class="d-block w-100">
					</a>
					<script>
						$(document).ready(function() {
							if (isCORS('<?php echo $product['second_photo'] ?>')) {
								resizePicture('<?php echo $product['second_photo'] ?>', null, 533, 533, .50, 'image/webp', renderImg, '#t_second_photo')
							} else {
								renderImg('<?php echo $product['second_photo'] ?>', '#t_second_photo')
							}
						})
					</script>
				</div>
				<?php endif ?>
				<?php if($product['third_photo'] !== ''): ?>
				<div id="thumb_2" class="col col-3 p-0">
					<a onClick="$('#carouselSlider').carousel(2)">
						<img id="t_third_photo" src="/static/img/loading.gif" class="d-block w-100">
					</a>
					<script>
						$(document).ready(function() {
							if (isCORS('<?php echo $product['third_photo'] ?>')) {
								resizePicture('<?php echo $product['third_photo'] ?>', null, 533, 533, .50, 'image/webp', renderImg, '#t_third_photo')
							} else {
								renderImg('<?php echo $product['third_photo'] ?>', '#t_third_photo')
							}
						})
					</script>
				</div>
				<?php endif ?>
				<?php if($product['fourth_photo'] !== ''): ?>
				<div id="thumb_3" class="col col-3 p-0">
					<a onClick="$('#carouselSlider').carousel(3)">
						<img id="t_fourth_photo" src="/static/img/loading.gif" class="d-block w-100">
					</a>
					<script>
						$(document).ready(function() {
							if (isCORS('<?php echo $product['fourth_photo'] ?>')) {
								resizePicture('<?php echo $product['fourth_photo'] ?>', null, 533, 533, .50, 'image/webp', renderImg, '#t_fourth_photo')
							} else {
								renderImg('<?php echo $product['fourth_photo'] ?>', '#t_fourth_photo')
							}
						})
					</script>
				</div>
				<?php endif ?>
			</div>
		</div>
		<div>
			<p><?php echo $product['brief_description'] ?></p>
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
	<div class="col col-12 p-1 pt-0 px-md-4">
		<hr class="star-primary" style="margin-top:8px;margin-bottom:25px;">
		<div class="mb-2">
			<?php echo $product['full_description'] ?>
		</div>
	</div>
	<script>
		$(document).ready(function() {
			var product = <?php echo json_encode($product) ?>;
			delete product['full_description'];
			if (window.localStorage) {
				window.localStorage.setItem(product.id, JSON.stringify(product))
			}
		})
	</script>
</div>
