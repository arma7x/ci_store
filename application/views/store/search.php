<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style>
	.pagination {
		position: relative;
		z-index: 1;
		justify-content: flex-end !important;
	}
	.pagination .page-item .page-link,
	.pagination .page-item .page-link a {
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
	.pagination .page-item .page-link:hover,
	.pagination .page-item .page-link:focus,
	.pagination .page-item .page-link:hover a,
	.pagination .page-item .page-link:focus a {
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
</style>
<div class="row starter-template mb-0 pb-0">
	<div class="col col-12 px-0 p-md-2" style="padding:0!important;">
		<form class="form-inline text-md-right mt-2">

			<div class="input-group rounded-0 col col-12 col-md-3 mx-0 px-0 pr-md-1 mb-1 mb-md-0">
				<div class="input-group-prepend">
				  <div class="bg-light input-group-text rounded-0 border-0"><i class="material-icons">&#xe264;</i></div>
				</div>
				<input id="search_keyword" type="text" class="bg-light form-control form-control-sm rounded-0 border-0 no-border" id="inlineFormInputGroupUsername2" placeholder="<?php echo lang('L_P_S_KEYWORD') ?>">
			</div>

			<div class="input-group rounded-0 col col-12 col-md-3 mx-0 px-0 pr-md-1 mb-1 mb-md-0">
				<div class="input-group-prepend">
					<div class="bg-light input-group-text rounded-0 border-0"><i class="material-icons">&#xe54e;</i></div>
				</div>
				<select id="search_category" class="bg-light form-control form-control-sm rounded-0 border-0 no-border">
					<option value=""><?php echo lang('L_P_S_ALL_CATEGORY') ?></option>
					<?php foreach($cat_link as $key => $value): ?>
						<option value="<?php echo $value['id'] ?>">
							<?php echo $value['name'] ?>
						</option>
					<?php endforeach ?>
				</select>
			</div>

			<div class="input-group rounded-0 col col-12 col-md-3 mx-0 px-0 pr-md-1 mb-1 mb-md-0">
				<div class="input-group-prepend">
					<div class="bg-light input-group-text rounded-0 border-0"><i class="material-icons">&#xe838;</i></div>
				</div>
				<select id="search_spotlight" class="bg-light form-control form-control-sm rounded-0 border-0 no-border">
					<option value=""><?php echo lang('L_P_S_SPOTLIGHT_ALL') ?></option>
					<option value="0"><?php echo lang('L_P_S_SPOTLIGHT_EXCLUDE') ?></option>
					<option value="1"><?php echo lang('L_P_S_SPOTLIGHT_INCLUDE') ?></option>
				</select>
			</div>

			<div class="input-group rounded-0 col col-12 col-md-2 mx-0 px-0 pr-md-1 mb-1 mb-md-0">
				<div class="input-group-prepend">
					<div class="bg-light input-group-text rounded-0 border-0"><i class="material-icons">&#xe242;</i></div>
				</div>
				<select id="search_ordering" class="bg-light form-control form-control-sm rounded-0 border-0 no-border">
					<option value="created_at@desc"><?php echo lang('L_P_S_LATEST_RELEASE') ?></option>
					<option value="created_at@asc"><?php echo lang('L_P_S_EARLIER_RELEASE') ?></option>
					<option value="price@desc"><?php echo lang('L_P_S_EXPENSIVE_PRICE') ?></option>
					<option value="price@asc"><?php echo lang('L_P_S_REASONABLE_PRICE') ?></option>
				</select>
			</div>

			<div class="input-group rounded-0 col col-12 col-md-1 mx-0 px-0">
				<button type="submit" class="btn btn-sm btn-primary rounded-0 btn-block" onClick="searchStore()">
					<i class="material-icons">&#xe8b6;</i>
				</button>
			</div>
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
		</form>
	</div>
	<div class="col col-12 py-2 p-md-2">
		<?php echo isset($products) ? $products : NULL ?>
		<div class="row">
			<div class="col col-12 px-0 py-2 p-md-2">
				<nav aria-label="navigation">
					<?php echo $this->pagination->create_links(); ?>
				</nav>
			</div>
		</div>
	</div>
</div>
