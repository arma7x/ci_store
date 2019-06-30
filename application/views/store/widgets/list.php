<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style>
.img-container {
  position: relative;
  overflow: hidden;
  color: #000000;
}

.img-container .favourite {
  font-size: 14px;
  color: var(--dark);
  position: absolute;
  top: 7.5%;
  left: 10%;
  text-align: left;
}

.text-container {
  position: relative;
  overflow: hidden;
  color: #000000;
}

.text-container .id {
  position: absolute;
  padding-top: 3px;
  top: 4.5%;
  text-align: left;
  font-size: 10px;
}

.text-container .title {
  position: absolute;
  color: var(--dark);
  top: 45%;
  text-align: left;
  font-size: 14px;
}

.text-container .price {
  border-top: 3px solid var(--pink)!important;
  padding-top: 3px;
  position: absolute;
  top: 7.5%;
  right: 10%;
  text-align: right;
  font-size: 12px;
}

.text-container .content-weight {
  position: absolute;
  top: 23%;
  right: 10%;
  text-align: right;
  font-size: 9px;
}

.text-container .package-weight {
  position: absolute;
  top: 33%;
  right: 10%;
  text-align: right;
  font-size: 9px;
}

.text-container .stock {
  font-size: 14px;
  color: var(--dark);
  position: absolute;
  top: 80%;
  right: 10%;
  text-align: right;
}

.text-container .btn {
  position: absolute;
  padding-top: 3px;
  margin-left: 5px;
  top: 75%;
  font-size: 8px;
  font-weight: bold;
  border-radius: 15px;
  z-index: 5;
}

a .overlay {
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

a:hover .overlay {
  opacity: 0.5;
}

a:hover .text-container .id,
a:hover .text-container .title,
a:hover .text-container .price,
a:hover .text-container .content-weight,
a:hover .text-container .package-weight,
a:hover .text-container .stock,
a:hover .img-container .favourite {
  color: #ffffff;
  opacity: 1;
  z-index: 2;
}

</style>
<div id="product_list" class="row mb-5">
<?php if ($this->container['sw_offline_cache'] === NULL): ?>
	<?php if (isset($list['result'])): ?>
		<?php if(COUNT($list['result']) === 0): ?>
		<div class=" mx-0 my-2 col col-12 row justify-content-sm-center align-items-center" style="height:54vh;">
			<div class="col col-12">
				<h2 class="text-center text-primary"><i class="material-icons" style="font-size:5em;">&#xe7f3;</i></h2>
			</div>
		</div>
		<?php endif ?>
		<?php foreach($list['result'] as $index => $item): ?>
			<div class="col col-12 col-md-3 mt-3 p-1">
				<a class="d-flex flex-row" href="/store/<?php echo $item['slug'] ?>">
					<div style="width:50%" class="img-container bg-light" data-placement="top" title="<?php echo $item['brief_description'] ?>">
						<img id="product_<?php echo $item['id'] ?>" class="img img-fluid" src="/static/img/loading.gif"/>
						<?php if ($item['spotlight'] === '1'): ?>
						<i class="material-icons favourite text-primary">&#xe89a;</i>
						<?php endif ?>
						<script>
							$(document).ready(function() {
								if (isCORS('<?php echo $item['main_photo'] ?>')) {
									resizePicture('<?php echo $item['main_photo'] ?>', 2, 0, 0, .50, 'image/webp', renderImg, '#product_<?php echo $item['id'] ?>')
								} else {
									renderImg('<?php echo $item['main_photo'] ?>', '#product_<?php echo $item['id'] ?>')
								}
							})
						</script>
					</div>
					<div style="width:50%" class="text-container bg-light">
						<i class="material-icons stock<?php echo ($item['availability'] === '1') ? ' text-success' : ' text-danger' ?>">&#xe3fa;</i>
						<h6 class="id font-weight-bold pl-1"><?php echo $item['id'] ?></h6>
						<h6 class="price font-weight-bold"><?php echo $this->container['currency_unit'].number_format((float) $item['price'], 2, '.', '') ?></h6>
						<h6 class="title font-weight-bold pl-1"><?php echo $item['name'] ?></h6>
					</div>
					<div class="overlay"></div>
				</a>
			</div>
		<?php endforeach ?>
	<?php else: ?>
	<div class="mx-0 my-2 col col-12 row justify-content-sm-center align-items-center" style="height:54vh;">
		<div class="col col-12">
			<h2 class="text-center text-primary"><i class="material-icons" style="font-size:5em;">&#xe7f3;</i></h2>
		</div>
	</div>
	<?php endif ?>
<?php endif ?>
</div>
