<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style>
.img-container {
  position: relative;
  overflow: hidden;
}

.img {
  display: block;
  width: 100%;
  height: auto;
  opacity: 1;
  transition: .5s ease;
}

.overlay {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100%;
  width: 100%;
  opacity: 0;
  transition: .5s ease;
  background-color: var(--dark);
}

.img-container a {
  color: #000000;
}

.img-container .title {
  position: absolute;
  top: 20%;
  left: 10%;
  text-align: center;
  font-size: 1.5em;
}

.img-container .price {
  border-top: 3px solid var(--pink)!important;
  padding-top: 3px;
  position: absolute;
  top: 7.5%;
  left: 10%;
  text-align: left;
  font-size: 0.9em;
}

.img-container .stock {
  font-size: 20px;
  color: var(--dark);
  position: absolute;
  top: 10%;
  left: 85%;
  text-align: center;
}

.img-container .favourite {
  font-size: 20px;
  color: var(--dark);
  position: absolute;
  top: 85%;
  left: 10%;
  text-align: center;
}

.img-container:hover .overlay {
  opacity: 0.7;
}

.img-container:hover .img {
  opacity: 0.5;
  
}

.img-container:hover .title,
.img-container:hover .price,
.img-container:hover .favourite,
.img-container:hover .stock {
  color: #ffffff;
  opacity: 1;
  z-index: 2;
}
</style>
<div class="row">
	<?php if (isset($list)): ?>
		<?php if(COUNT($list) === 0): ?>
		<div class=" mx-0 my-2 col col-12 row justify-content-sm-center align-items-center" style="height:54vh;">
			<div class="col col-12">
				<h2 class="text-center text-primary"><i class="material-icons" style="font-size:5em;">&#xe7f3;</i></h2>
			</div>
		</div>
		<?php endif ?>
		<?php foreach($list as $index => $item): ?>
			<div class="col col-12 col-md-3 px-0 py-2 p-md-2">
				<div class="img-container" data-placement="top" title="<?php echo $item['brief_description'] ?>">
					<a href="/store/<?php echo $item['slug'] ?>"><img id="product_<?php echo $item['id'] ?>" class="img img-fluid" src="/static/img/loading.gif"/>
					<script>
						$(document).ready(function() {
							if (isCORS('<?php echo $item['main_photo'] ?>')) {
								resizePicture('<?php echo $item['main_photo'] ?>', null, 533, 533, .50, 'image/webp', renderImg, '#product_<?php echo $item['id'] ?>')
							} else {
								renderImg('<?php echo $item['main_photo'] ?>', '#product_<?php echo $item['id'] ?>')
							}
						})
					</script>
					<i class="material-icons stock"><?php echo ($item['availability'] === '1') ? '&#xe1a3;' : '&#xe19c;' ?></i>
					<h4 class="title font-weight-bold"><?php echo $item['name'] ?></h4>
					<h6 class="price font-weight-bold"><?php echo $this->container['currency_unit'].number_format((float) $item['price'], 2, '.', '') ?></h6>
					<?php if ($item['spotlight'] === '1'): ?>
					<i class="material-icons favourite">&#xe87d;</i>
					<?php endif ?>
					<div class="overlay"></div>
					</a>
				</div>
			</div>
		<?php endforeach ?>
	<?php else: ?>
	<div class="mx-0 my-2 col col-12 row justify-content-sm-center align-items-center" style="height:54vh;">
		<div class="col col-12">
			<h2 class="text-center text-primary"><i class="material-icons" style="font-size:5em;">&#xe7f3;</i></h2>
		</div>
	</div>
	<?php endif ?>
</div>
