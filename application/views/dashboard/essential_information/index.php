<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container starter-template">
	<div class="row">
	<div class="col col-12">
		<h2 class="text-center text-primary"><?php echo isset($page_name) ? strtoupper($page_name) : strtoupper('Codeigniter') ;?></h2>
		<div class="row mb-1">
			<button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addModal">
			  <?php echo lang('BTN_ADD_E_INFORMATION') ?>
			</button>
		</div>
		<div class="row">
			<div class="table-responsive">
				<table class="table table-sm table-bordered table-striped">
					<thead>
						<tr>
							<!-- <th scope="col"><?php echo lang('L_ID'); ?></th> -->
							<th scope="col"><?php echo lang('L_E_TITLE'); ?></th>
							<th scope="col"><?php echo lang('L_E_SLUG'); ?></th>
							<th scope="col"><?php echo lang('L_E_ORDERING'); ?> & <?php echo lang('L_E_MATERIAL_ICON'); ?></th>
							<th scope="col"><?php echo lang('L_E_POSITION'); ?> & <?php echo lang('L_E_VISIBILITY'); ?></th>
							<!-- <th scope="col"><?php echo lang('L_E_BRIEF_DESC'); ?></th>-->
							<th scope="col"><?php echo lang('L_INFO');?></th>
							<th scope="col"><?php echo lang('L_ACTION'); ?></th>
						</tr>
					</thead>
					<tbody class="small">
						<?php foreach($list['result'] as $index => $item): ?>
						<tr>
							<!-- <td><?php echo $item['id'] ;?></td> -->
							<td>
								<i class="material-icons"><?php echo $item['material_icon'] ;?></i>
								<strong><?php echo $item['title'] ;?></strong>
							</td>
							<td><?php echo $item['slug'] ;?></td>
							<td style="width:150px;">
								<form class="mb-2">
									<div class="form-group mb-1">
										<label class="sr-only-rm m-0"><?php echo lang('L_E_ORDERING');?></label>
										<div class="input-group input-group-sm border rounded">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">&#xe242;</i></div>
											</div>
											<input id="inputOrdering<?php echo $item['id'] ?>" value="<?php echo $item['ordering'] ?>" type="number" class="form-control" placeholder="<?php echo lang('L_E_ORDERING');?>">
										</div>
									</div>
									<button class="btn btn-block btn-sm btn-success" onclick="updateOrderEI('<?php echo $item['id'] ;?>', '<?php echo $item['title'] ;?>')">
										<?php echo lang('BTN_EDIT') ?>
									</button>
								</form>
								<form>
									<div class="form-group mb-1">
										<label class="sr-only-rm m-0">
											<a href="https://material.io/tools/icons/?style=baseline" target="_blank">
												<?php echo lang('L_E_MATERIAL_ICON');?>
											</a> / 
											<a href="https://raw.githubusercontent.com/google/material-design-icons/master/iconfont/codepoints" target="_blank">
												Unicode
											</a>
										</label>
										<div class="input-group input-group-sm border rounded">
											<div class="input-group-prepend">
												<div class="input-group-text"><i id="edit_mi<?php echo $item['id'] ?>" class="material-icons"><?php echo $item['material_icon'] ;?></i></div>
											</div>
											<input id="inputMaterialIcon<?php echo $item['id'] ?>" value="<?php echo htmlentities($item['material_icon']) ?>" type="text" class="form-control" placeholder="<?php echo lang('L_E_MATERIAL_ICON');?>" onInput="renderIcon('#inputMaterialIcon<?php echo $item['id'] ?>', '#edit_mi<?php echo $item['id'] ?>')" >
										</div>
									</div>
									<button class="btn btn-block btn-sm btn-success" onclick="updateIconEI('<?php echo $item['id'] ;?>', '<?php echo $item['title'] ;?>')">
										<?php echo lang('BTN_EDIT') ?>
									</button>
								</form>
							</td>
							<td style="width:150px;">
								<form class="mb-2">
									<div class="form-group mb-1">
										<label class="sr-only-rm m-0"><?php echo lang('L_E_POSITION');?></label>
										<div class="input-group input-group-sm border rounded">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">&#xe051;</i></div>
											</div>
											<select type="text" id="inputPosition<?php echo $item['id'] ?>" class="form-control" placeholder="<?php echo lang('L_E_POSITION');?>" required>
												<option value="-1"<?php echo (int) $item['position'] === -1 ? ' selected' : '' ;?>><?php echo lang('L_E_POSITION_BOTH');?></option>
												<option value="0"<?php echo (int) $item['position'] === 0 ? ' selected' : '' ;?>><?php echo lang('L_E_POSITION_NAV');?></option>
												<option value="1"<?php echo (int) $item['position'] === 1 ? ' selected' : '' ;?>><?php echo lang('L_E_POSITION_BOTTOM');?></option>
											</select>
										</div>
									</div>
									<button class="btn btn-block btn-sm btn-success" onclick="updatePositionEI('<?php echo $item['id'] ;?>', '<?php echo $item['title'] ;?>')">
										<?php echo lang('BTN_EDIT') ?>
									</button>
								</form>
								<form>
									<div class="form-group mb-1">
										<label class="sr-only-rm m-0"><?php echo lang('L_E_VISIBILITY');?></label>
										<div class="input-group input-group-sm border rounded">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">&#xe8f4;</i></div>
											</div>
											<select type="text" id="inputVisibility<?php echo $item['id'] ?>" class="form-control" required>
												<option value="0"<?php echo (int) $item['visibility'] === 0 ? ' selected' : '' ;?>><?php echo lang('L_E_VISIBILITY_HIDE');?></option>
												<option value="1"<?php echo (int) $item['visibility'] === 1 ? ' selected' : '' ;?>><?php echo lang('L_E_VISIBILITY_SHOW');?></option>
											</select>
										</div>
									</div>
									<button class="btn btn-block btn-sm btn-success" onclick="updateVisibilityEI('<?php echo $item['id'] ;?>', '<?php echo $item['title'] ;?>')">
										<?php echo lang('BTN_EDIT') ?>
									</button>
								</form>
							</td>
							<!-- <td><?php echo $item['brief_description'] ;?></td> -->
							<td>
								<b><?php echo lang('L_CREATED_AT');?></b></br>
								<span id="ca_<?php echo $item['id'] ;?>">
									<script>parse_date('<?php echo "ca_".$item['id'] ?>', '<?php echo $item['created_at'] ;?>')</script>
								</span></br>
								<b><?php echo lang('L_UPDATED_AT'); ?></b></br>
								<span id="ua_<?php echo $item['id'] ;?>">
									<script>parse_date('<?php echo "ua_".$item['id'] ?>', '<?php echo $item['updated_at'] ;?>')</script>
								</span>
							</td>
							<td>
								<button class="btn btn-block btn-sm btn-info" onclick="findEI('<?php echo $item['id'] ;?>')">
									<?php echo lang('BTN_EDIT') ?>
								</button>
								<button class="btn btn-block btn-sm btn-danger" onclick="deleteEI('<?php echo $item['id'] ;?>', '<?php echo $item['title'] ;?>')">
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
