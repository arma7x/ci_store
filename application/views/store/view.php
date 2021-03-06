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
									resizePicture('<?php echo $product['main_photo'] ?>', 2, 0, 0, .50, 'image/webp', renderImg, '#main_photo')
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
									resizePicture('<?php echo $product['second_photo'] ?>', 2, 0, 0, .50, 'image/webp', renderImg, '#second_photo')
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
									resizePicture('<?php echo $product['third_photo'] ?>', 2, 0, 0, .50, 'image/webp', renderImg, '#third_photo')
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
									resizePicture('<?php echo $product['fourth_photo'] ?>', 2, 0, 0, .50, 'image/webp', renderImg, '#fourth_photo')
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
		<h4 class="font-weight-bold">
			<span class="text-primary">#<?php echo $product['id'] ?></span> /
			<span class="text-primary"><?php echo $this->container['currency_unit'].number_format((float) $product['price'], 2, '.', '') ?></span>
		</h4>
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
			<?php if($this->container['sw_offline_cache'] !== NULL): ?>
			<a onClick="removeCache('<?php echo $product['id'] ?>')"><h6 class="ml-5 text-danger font-weight-bold"><i class="material-icons">&#xe92b;</i> <?php echo lang('BTN_REMOVE');?></h6></a>
			<?php endif?>
		</div>
		<h6 class="text-muted font-weight-bold"><?php echo lang('L_P_ORDER_HERE') ?></h6>
		<div class="row mb-3">
			<ul class="list-inline text-center ml-3">
			<?php foreach($this->container['ic_link'] as $key => $value): ?>
				<li class="list-inline-item">
					<a target="_blank" href="<?php echo str_replace('%param', $product['id'].' - '.$product['name'], $value['url']) ?>">
						<img id="pm_ic_<?php echo $value['id'] ?>" class="btn-circle shadow-sm" src="<?php echo $value['icon'] ?>" alt="<?php echo $value['name'] ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $value['name'] ?>" style="width:30px;height:30px"/>
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
								resizePicture('<?php echo $product['main_photo'] ?>', 2, 0, 0, .50, 'image/webp', renderImg, '#t_main_photo')
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
								resizePicture('<?php echo $product['second_photo'] ?>', 2, 0, 0, .50, 'image/webp', renderImg, '#t_second_photo')
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
								resizePicture('<?php echo $product['third_photo'] ?>', 2, 0, 0, .50, 'image/webp', renderImg, '#t_third_photo')
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
								resizePicture('<?php echo $product['fourth_photo'] ?>', 2, 0, 0, .50, 'image/webp', renderImg, '#t_fourth_photo')
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
	</div>
	<div class="col col-12 p-1 pt-0 px-md-4">
		<hr class="star-primary" style="margin-top:8px;margin-bottom:25px;">
		<div class="mb-2">
			<?php echo $product['full_description'] ?>
		</div>
	</div>
</div>
<?php echo isset($view_js) ? $view_js : null ?>
