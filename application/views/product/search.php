<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row starter-template mb-0 pb-0">
	<div class="col col-12 px-0 py-2 p-md-2">
	<form class="form-inline pb-0">

		<div class="input-group col-sm-3 p-0 pr-0 pb-1 pr-sm-1 pb-sm-0">
			<div class="input-group-prepend">
			  <div class="input-group-text rounded-0 border-0 bg-white"><i class="material-icons">&#xe264;</i></div>
			</div>
			<input id="keyword" type="text" class="form-control rounded-0 border-0 bg-white" id="inlineFormInputGroupUsername2" placeholder="Search keyword">
		</div>

		<div class="input-group rounded-0 col-sm-3 p-0 pr-0 pb-1 pr-sm-1 pb-sm-0">
			<div class="input-group-prepend">
				<div class="input-group-text rounded-0 border-0 bg-white"><i class="material-icons">&#xe54e;</i></div>
			</div>
			<select id="category" class="form-control rounded-0 border-0 bg-white">
				<option value="">Non-Categorize</option>
				<?php foreach($cat_link as $key => $value): ?>
					<option value="<?php echo $value['slug'] ?>">
						<?php echo $value['name'] ?>
					</option>
				<?php endforeach ?>
			</select>
		</div>

		<div class="input-group rounded-0 col-sm-3 p-0 pr-0 pb-2 pr-sm-1 pb-sm-0">
			<div class="input-group-prepend">
				<div class="input-group-text rounded-0 border-0 bg-white"><i class="material-icons">&#xe164;</i></div>
			</div>
			<select id="ordering" class="form-control rounded-0 border-0 bg-white">
				<option value="created_desc">Latest(Collection)</option>
				<option value="created_asc">Earlier(Collection)</option>
				<option value="price_desc">Expensive(Price)</option>
				<option value="price_asc">Reasonable(Price)</option>
			</select>
		</div>

		<div class="input-group rounded-0 col-sm-2 p-0 pr-0 pb-2 pr-sm-1 pb-sm-0">
			<div class="input-group-prepend">
				<div class="input-group-text rounded-0 border-0 bg-white"><i class="material-icons">&#xe838;</i></div>
			</div>
			<select id="ordering" class="form-control rounded-0 border-0 bg-white">
				<option value="created_desc">All</option>
				<option value="created_asc">Non-Highlight</option>
				<option value="price_desc">Highlight</option>
			</select>
		</div>

		<button type="submit" class="btn btn-primary rounded-0 col-sm-1">
			<i class="material-icons">&#xe8b6;</i>
		</button>
	</form>
	</div>
</div>
<?php echo isset($products) ? $products : NULL ?>
<style>
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
</style>
<div class="row starter-template mb-0 pb-0">
	<div class="col-12 mx-2">
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
