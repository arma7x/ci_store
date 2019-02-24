<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row starter-template mb-0 pb-0">
	<div class="col col-12 px-0 py-2 p-md-2">
	<form class="form-inline pb-0">

		<div class="input-group col-sm-4 p-0 pr-0 pb-1 pr-sm-1 pb-sm-0">
			<div class="input-group-prepend">
			  <div class="input-group-text rounded-0 border-0 bg-white"><i class="material-icons">&#xe264;</i></div>
			</div>
			<input id="keyword" type="text" class="form-control rounded-0 border-0 bg-white" id="inlineFormInputGroupUsername2" placeholder="Username">
		</div>

		<div class="input-group rounded-0 col-sm-3 p-0 pr-0 pb-1 pr-sm-1 pb-sm-0">
			<div class="input-group-prepend">
				<div class="input-group-text rounded-0 border-0 bg-white"><i class="material-icons">&#xe54e;</i></div>
			</div>
			<select id="category" class="form-control rounded-0 border-0 bg-white">
				<?php foreach($cat_link as $key => $value): ?>
					<option value="<?php echo $value['slug'] ?>">
						<?php echo $value['name'] ?>
					</option>
				<?php endforeach ?>
			<select>
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
			<select>
		</div>

		<button type="submit" class="btn btn-primary rounded-0 col-sm-2">
			<i class="material-icons">&#xe8b6;</i>
		</button>
	</form>
	</div>
</div>
<?php echo isset($products) ? $products : NULL ?>
