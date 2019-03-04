<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container starter-template">
	<div class="row">
	<div class="col col-12">
		<h2 class="text-center text-primary"><?php echo isset($page_name) ? strtoupper($page_name) : strtoupper('Codeigniter') ;?></h2>
		<div class="row mb-1">
			<button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#addModal">
			  <?php echo lang('BTN_ADD_PRODUCT') ?>
			</button>
		</div>
		<div class="row">
			<?php var_dump($list)?>
		</div>
		<script>$.trumbowyg.svgPath = '/static/img/icons.svg';</script>
		<?php echo isset($add_modal) ? $add_modal :null ?>
		<?php echo isset($update_modal) ? $update_modal :null ?>
		<?php echo isset($ei_js) ? $ei_js :null ?>
	</div>
	</div>
</div>
