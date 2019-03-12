<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container starter-template">
	<div class="row">
	<div class="col col-12">
		<h2 class="text-center text-primary"><?php echo isset($page_name) ? strtoupper($page_name) : strtoupper('Codeigniter') ;?></h2>

		<div class="row">
		<form class="form-inline">

			<label class="sr-only"><?php echo lang('L_P_S_SEARCH');?></label>
			<div class="input-group mr-sm-1 mb-2">
				<div class="input-group-prepend">
				  <div class="input-group-text"><i class="material-icons">&#xe264;</i></div>
				</div>
				<input id="search_keyword" type="text" class="form-control form-control-sm no-border" id="inlineFormInputGroupUsername2" placeholder="<?php echo lang('L_P_S_KEYWORD') ?>">
			</div>

			<label class="sr-only"><?php echo lang('H_CATEGORY');?></label>
			<div class="input-group mr-sm-1 mb-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="material-icons">&#xe54e;</i></div>
				</div>
				<select id="search_category" class="form-control form-control-sm no-border">
					<option value=""><?php echo lang('L_P_S_ALL_CATEGORY') ?></option>
					<?php foreach($cat_list as $key => $value): ?>
						<option value="<?php echo $value['id'] ?>">
							<?php echo $value['name'] ?>
						</option>
					<?php endforeach ?>
				</select>
			</div>

			<label class="sr-only"><?php echo lang('L_P_VISIBILITY');?></label>
			<div class="input-group mr-sm-1 mb-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="material-icons">&#xe8f4;</i></div>
				</div>
				<select id="search_visibility" class="form-control form-control-sm no-border">
					<option value=""><?php echo lang('L_P_S_VISIBILITY_ALL') ?></option>
					<option value="1"><?php echo lang('L_P_S_VISIBILITY_SHOW');?></option>
					<option value="0"><?php echo lang('L_P_S_VISIBILITY_HIDE');?></option>
				</select>
			</div>

			<label class="sr-only"><?php echo lang('L_P_SPOTLIGHT');?></label>
			<div class="input-group mr-sm-1 mb-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="material-icons">&#xe89a;</i></div>
				</div>
				<select id="search_spotlight" class="form-control form-control-sm no-border">
					<option value=""><?php echo lang('L_P_S_SPOTLIGHT_ALL') ?></option>
					<option value="0"><?php echo lang('L_P_S_SPOTLIGHT_EXCLUDE') ?></option>
					<option value="1"><?php echo lang('L_P_S_SPOTLIGHT_INCLUDE') ?></option>
				</select>
			</div>

			<label class="sr-only"><?php echo lang('L_P_S_ORDERING');?></label>
			<div class="input-group mr-sm-1 mb-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="material-icons">&#xe242;</i></div>
				</div>
				<select id="search_ordering" class="form-control form-control-sm no-border">
					<option value="created_at@desc"><?php echo lang('L_P_S_LATEST_RELEASE') ?></option>
					<option value="created_at@asc"><?php echo lang('L_P_S_EARLIER_RELEASE') ?></option>
					<option value="price@desc"><?php echo lang('L_P_S_EXPENSIVE_PRICE') ?></option>
					<option value="price@asc"><?php echo lang('L_P_S_REASONABLE_PRICE') ?></option>
				</select>
			</div>

			<label class="sr-only"><?php echo lang('L_P_AVAILABILITY');?></label>
			<div class="input-group mr-sm-1 mb-2">
				<div class="input-group-prepend">
					<div class="input-group-text"><i class="material-icons">&#xe614;</i></div>
				</div>
				<select id="search_availability" class="form-control form-control-sm no-border">
					<option value=""><?php echo lang('L_P_AVAILABILITY');?></option>
					<option value="1"><?php echo lang('L_P_AVAILABILITY_TRUE');?></option>
					<option value="0"><?php echo lang('L_P_AVAILABILITY_FALSE');?></option>
				</select>
			</div>

			<div class="input-group mr-sm-1 mb-2">
				<button type="submit" class="btn btn-sm btn-primary" onClick="searchStore()">
					<i class="material-icons">&#xe8b6;</i>
				</button>
			</div>

			<div class="input-group mr-sm-1 mb-2">
				<button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#addModal">
					<?php echo lang('BTN_ADD_PRODUCT') ?>
				</button>
			</div>

			<script>
				$(document).ready(function() {
					$('#search_keyword').attr('value', getQueryStringValue('keyword'))
					$('#search_category option[value="'+getQueryStringValue('category')+'"]').attr('selected','selected')
					$('#search_visibility option[value="'+getQueryStringValue('visibility')+'"]').attr('selected','selected')
					$('#search_ordering option[value="'+getQueryStringValue('ordering')+'"]').attr('selected','selected')
					$('#search_spotlight option[value="'+getQueryStringValue('spotlight')+'"]').attr('selected','selected')
					$('#search_availability option[value="'+getQueryStringValue('availability')+'"]').attr('selected','selected')
				})
				function searchStore() {
					var data = {
						'keyword': $("#search_keyword").val(),
						'category': $("#search_category").val(),
						'visibility': $("#search_visibility").val(),
						'ordering': $("#search_ordering").val(),
						'spotlight': $("#search_spotlight").val(),
						'availability': $("#search_availability").val(),
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
		<div class="row">
			<div class="table-responsive">
				<table class="table table-sm table-bordered">
					<thead>
						<tr>
							<th scope="col"><?php echo lang('L_ID'); ?></th>
							<th scope="col"><?php echo lang('L_P_NAME'); ?></th>
							<!-- <th scope="col"><?php echo lang('L_P_SLUG'); ?></th> -->
							<th scope="col"><?php echo lang('L_P_PRICE'); ?></th>
							<th scope="col"><?php echo lang('L_P_VISIBILITY'); ?></th>
							<th scope="col"><?php echo lang('L_P_SPOTLIGHT'); ?></th>
							<th scope="col"><?php echo lang('L_P_AVAILABILITY'); ?></th>
							<th scope="col"><?php echo lang('L_INFO');?></th>
							<th scope="col"><?php echo lang('L_ACTION'); ?></th>
						</tr>
					</thead>
					<tbody class="small">
						<?php foreach($list as $index => $item): ?>
						<tr>
							<td class="text-center">
								<strong><?php echo $item['id'] ?></strong><br>
								<img id="thumb_<?php echo $item['id'] ?>" class="img img-fluid" src="/static/img/loading.gif" width="100px" height="100px"/>
								<script>
									$(document).ready(function() {
										resizePicture('<?php echo $item['main_photo'] ?>', null, 100, 100, .50, 'image/webp', renderImg, '#thumb_<?php echo $item['id'] ?>')
									})
								</script>
							</td>
							<td><strong><?php echo $item['name'] ?></strong></td>
							<!-- <td><?php echo $item['slug'] ?></td> -->
							<td><?php echo $this->container['currency_unit'].number_format((float) $item['price'], 2, '.', '') ?></td>
							<td>
								<form>
									<div class="form-group mb-1">
										<label class="sr-only-rm m-0"><?php echo lang('L_P_VISIBILITY');?></label>
										<div class="input-group input-group-sm border rounded">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">&#xe8f4;</i></div>
											</div>
											<select type="text" id="inputVisibility<?php echo $item['id'] ?>" class="form-control" required>
												<option value="0"<?php echo (int) $item['visibility'] === 0 ? ' selected' : '' ;?>><?php echo lang('L_P_VISIBILITY_HIDE');?></option>
												<option value="1"<?php echo (int) $item['visibility'] === 1 ? ' selected' : '' ;?>><?php echo lang('L_P_VISIBILITY_SHOW');?></option>
											</select>
										</div>
									</div>
									<button class="btn btn-block btn-sm btn-outline-success" onclick="updateVisibility('<?php echo $item['id'] ;?>', '<?php echo $item['name'] ;?>')">
										<?php echo lang('BTN_EDIT') ?>
									</button>
								</form>
							</td>
							<td>
								<form>
									<div class="form-group mb-1">
										<label class="sr-only-rm m-0"><?php echo lang('L_P_SPOTLIGHT');?></label>
										<div class="input-group input-group-sm border rounded">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">&#xe89a;</i></div>
											</div>
											<select type="text" id="inputSpotlight<?php echo $item['id'] ?>" class="form-control" placeholder="<?php echo lang('L_P_SPOTLIGHT');?>" required>
												<option value="0"<?php echo (int) $item['spotlight'] === 0 ? ' selected' : '' ;?>><?php echo lang('L_P_SPOTLIGHT_NO');?></option>
												<option value="1"<?php echo (int) $item['spotlight'] === 1 ? ' selected' : '' ;?>><?php echo lang('L_P_SPOTLIGHT_YES');?></option>
											</select>
										</div>
									</div>
									<button class="btn btn-block btn-sm btn-outline-success" onclick="updateSpotlight('<?php echo $item['id'] ;?>', '<?php echo $item['name'] ;?>')">
										<?php echo lang('BTN_EDIT') ?>
									</button>
								</form>
							</td>
							<td>
								<form>
									<div class="form-group mb-1">
										<label class="sr-only-rm m-0"><?php echo lang('L_P_AVAILABILITY');?></label>
										<div class="input-group input-group-sm border rounded">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">&#xe614;</i></div>
											</div>
											<select type="text" id="inputAvailability<?php echo $item['id'] ?>" class="form-control" placeholder="<?php echo lang('L_P_AVAILABILITY');?>" required>
												<option value="0"<?php echo (int) $item['availability'] === 0 ? ' selected' : '' ;?>><?php echo lang('L_P_AVAILABILITY_FALSE');?></option>
												<option value="1"<?php echo (int) $item['availability'] === 1 ? ' selected' : '' ;?>><?php echo lang('L_P_AVAILABILITY_TRUE');?></option>
											</select>
										</div>
									</div>
									<button class="btn btn-block btn-sm btn-outline-success" onclick="updateAvailability('<?php echo $item['id'] ;?>', '<?php echo $item['name'] ;?>')">
										<?php echo lang('BTN_EDIT') ?>
									</button>
								</form>
							</td>
							<td>
								<b><?php echo lang('L_UPDATED_AT');?></b></br>
								<span id="ca_<?php echo $item['id'] ;?>">
									<script>parse_date('<?php echo "ca_".$item['id'] ?>', '<?php echo $item['created_at'] ;?>')</script>
								</span></br>
								<b><?php echo lang('L_UPDATED_AT'); ?></b></br>
								<span id="ua_<?php echo $item['id'] ;?>">
									<script>parse_date('<?php echo "ua_".$item['id'] ?>', '<?php echo $item['updated_at'] ;?>')</script>
								</span>
							</td>
							<td>
								<button class="btn btn-block btn-sm btn-outline-info" onclick="findProduct('<?php echo $item['id'] ;?>')">
									<?php echo lang('BTN_EDIT') ?>
								</button>
								<button class="btn btn-block btn-sm btn-outline-danger" onclick="deleteProduct('<?php echo $item['id'] ;?>', '<?php echo $item['name'] ;?>')">
									<?php echo lang('BTN_REMOVE') ?>
								</button>
							</td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
		<script>$.trumbowyg.svgPath = '/static/img/icons.svg';</script>
		<?php echo isset($add_modal) ? $add_modal :null ?>
		<?php echo isset($update_modal) ? $update_modal :null ?>
		<?php echo isset($ei_js) ? $ei_js :null ?>
	</div>
	</div>
	<div class="row justify-content-sm-center align-items-center" >
	<?php echo $this->pagination->create_links(); ?>
	</div>
</div>
