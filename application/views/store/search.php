<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row starter-template mb-0 pb-0">
	<style>
		.btn-primary {
			background: var(--pink);
			border-color: var(--pink);
		}
		.btn-primary:hover,
		.btn-primary:active,
		.btn-primary:focus {
			background: var(--red)!important;
			border-color: var(--red)!important;
		}
		.pagination {
			position: relative;
			z-index: 1;
		}
		.pagination .page-item .page-link {
			width: 40px;
			height: 40px;
			border: none;
			font-size: 16px;
			font-weight: 400;
			line-height: 40px;
			padding: 0;
			text-align: center;
			color: #242424;
		}
		.pagination .page-item .page-link:hover, .pagination .page-item .page-link:focus {
			color: #fff;
			box-shadow: none;
			background-color: var(--pink)!important;
		}
		.pagination .page-item.active .page-link {
			color: #fff;
			box-shadow: none;
			background-color: var(--pink)!important;
		}
		.pagination .page-item:first-child .page-link {
			margin-left: 0;
			border-top-left-radius: 0;
			border-bottom-left-radius: 0;
		}
		.pagination .page-item:last-child .page-link {
			margin-left: 0;
			border-top-right-radius: 0;
			border-bottom-right-radius: 0;
		}
		.no-border:focus{
			outline: none!important;
			  border-color: inherit;
			  -webkit-box-shadow: none;
			  box-shadow: none;
		}
	</style>
	<div class="col col-12 col-md-9 px-0 pt-2 p-md-2 order-last order-md-first">
		<?php echo isset($products) ? $products : NULL ?>
		<div class="row">
			<div class="col col-12 px-0 py-2 p-md-2">
				<nav aria-label="navigation">
					<ul class="pagination justify-content-end">
						<li class="page-item active"><a class="page-link" href="#">1</a></li>
						<li class="page-item"><a class="page-link" href="#">2</a></li>
						<li class="page-item"><a class="page-link" href="#">3</a></li>
						<li class="page-item"><a class="page-link" href="#">4</a></li>
					</ul>
				</nav>
			</div>
		</div>
	</div>
	<div class="col col-12 col-md-3 px-0 pt-2 p-md-2">
		<form class="form text-md-right pt-2">

			<label><?php echo lang('L_P_S_SEARCH');?></label>
			<div class="input-group mb-2">
				<div class="input-group-prepend">
				  <div class="input-group-text rounded-0 border-0 bg-white"><i class="material-icons">&#xe264;</i></div>
				</div>
				<input id="search_keyword" type="text" class="form-control rounded-0 border-0 bg-white no-border" id="inlineFormInputGroupUsername2" placeholder="<?php echo lang('L_P_S_KEYWORD') ?>">
			</div>

			<label><?php echo lang('H_CATEGORY');?></label>
			<div class="input-group rounded-0 mb-2">
				<div class="input-group-prepend">
					<div class="input-group-text rounded-0 border-0 bg-white"><i class="material-icons">&#xe54e;</i></div>
				</div>
				<select id="search_category" class="form-control rounded-0 border-0 bg-white no-border">
					<option value=""><?php echo lang('L_P_S_ALL_CATEGORY') ?></option>
					<?php foreach($cat_link as $key => $value): ?>
						<option value="<?php echo $value['id'] ?>">
							<?php echo $value['name'] ?>
						</option>
					<?php endforeach ?>
				</select>
			</div>

			<label><?php echo lang('L_P_S_ORDERING');?></label>
			<div class="input-group rounded-0 mb-2">
				<div class="input-group-prepend">
					<div class="input-group-text rounded-0 border-0 bg-white"><i class="material-icons">&#xe242;</i></div>
				</div>
				<select id="search_ordering" class="form-control rounded-0 border-0 bg-white no-border">
					<option value="created_desc"><?php echo lang('L_P_S_LATEST_RELEASE') ?></option>
					<option value="created_asc"><?php echo lang('L_P_S_EARLIER_RELEASE') ?></option>
					<option value="price_desc"><?php echo lang('L_P_S_EXPENSIVE_PRICE') ?></option>
					<option value="price_asc"><?php echo lang('L_P_S_REASONABLE_PRICE') ?></option>
				</select>
			</div>

			<label><?php echo lang('L_P_SPOTLIGHT');?></label>
			<div class="input-group rounded-0 mb-2">
				<div class="input-group-prepend">
					<div class="input-group-text rounded-0 border-0 bg-white"><i class="material-icons">&#xe838;</i></div>
				</div>
				<select id="search_highlight" class="form-control rounded-0 border-0 bg-white no-border">
					<option value=""><?php echo lang('L_P_S_SPOTLIGHT_ALL') ?></option>
					<option value="0"><?php echo lang('L_P_S_SPOTLIGHT_EXCLUDE') ?></option>
					<option value="1"><?php echo lang('L_P_S_SPOTLIGHT_INCLUDE') ?></option>
				</select>
			</div>

			<div class="input-group rounded-0">
				<button type="submit" class="btn btn-primary rounded-0 btn-block" onClick="searchStore()">
					<i class="material-icons">&#xe8b6;</i>
				</button>
			</div>
			<script>
				$(document).ready(function() {
					$('#search_keyword').attr('value', getQueryStringValue('keyword'))
					$('#search_category option[value="'+getQueryStringValue('category')+'"]').attr('selected','selected')
					$('#search_ordering option[value="'+getQueryStringValue('ordering')+'"]').attr('selected','selected')
					$('#search_highlight option[value="'+getQueryStringValue('highlight')+'"]').attr('selected','selected')
				})
				function searchStore() {
					var data = {
						'keyword': $("#search_keyword").val(),
						'category': $("#search_category").val(),
						'ordering': $("#search_ordering").val(),
						'highlight': $("#search_highlight").val(),
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
		</form>
	</div>
</div>
