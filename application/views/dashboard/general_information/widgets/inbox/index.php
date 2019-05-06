<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="mt-3">
	<div class="row">
		<div class="col col-12">
			<button type="button" class="btn btn-sm btn-primary mb-1" data-toggle="modal" data-target="#addInboxModal">
			  <?php echo lang('BTN_ADD_INBOX_CHANNEL') ?>
			</button>
			<div class="table-responsive">
				<table class="table table-sm table-bordered table-striped">
					<thead>
						<tr>
							<!-- <th scope="col"><?php echo lang('L_ID'); ?></th> -->
							<th scope="col"><?php echo lang('L_S_C_NAME'); ?></th>
							<!--<th scope="col"><?php echo lang('L_S_C_ICON'); ?></th> -->
							<th scope="col"><?php echo lang('L_S_C_URL'); ?></th>
							<th scope="col"><?php echo lang('L_S_C_ORDERING'); ?></th>
							<th scope="col"><?php echo lang('L_ACTION'); ?></th>
						</tr>
					</thead>
					<tbody class="small">
						<?php foreach($ic_list as $index => $item): ?>
						<tr>
							<!-- <td><?php echo $item['id'] ;?></td> -->
							<td class="pt-3">
								<img class="rounded-circle logo" style="width:50px;height:50px" src="<?php echo $item['icon'] ?>" alt="<?php echo $item['name'] ?>"/>
								<strong><?php echo $item['name'] ;?></strong>
							</td>
							<!-- <td class="text-center pt-3"><img class="rounded-circle logo" style="width:50px;height:50px" src="<?php echo $item['icon'] ?>" alt="<?php echo $item['name'] ?>"/></td> -->
							<td><?php echo $item['url'] ;?></td>
							<td style="width:150px;">
								<form>
									<div class="col col-12 p-0 form-group mb-1">
										<label class="sr-only"><?php echo lang('L_E_ORDERING');?></label>
										<div class="input-group input-group-sm border rounded">
											<div class="input-group-prepend">
												<div class="input-group-text"><i class="material-icons">&#xe242;</i></div>
											</div>
											<input id="inputOrdering<?php echo $item['id'] ?>" value="<?php echo $item['ordering'] ?>" type="number" class="form-control" placeholder="<?php echo lang('L_E_ORDERING');?>">
										</div>
									</div>
									<div class="col col-12 p-0">
										<button class="btn btn-block btn-sm btn-success" onclick="updateOrderInboxChannel('<?php echo $item['id'] ;?>', '<?php echo $item['name'] ;?>')">
											<?php echo lang('BTN_SORT_E_INFORMATION') ?>
										</button>
									</div>
								</form>
							</td>
							<td>
								<button class="btn btn-block btn-sm btn-info" onclick="findInboxChannel('<?php echo $item['id'] ;?>')">
									<?php echo lang('BTN_EDIT') ?>
								</button>
								<button class="btn btn-block btn-sm btn-danger" onclick="deleteInboxChannel('<?php echo $item['id'] ;?>', '<?php echo $item['name'] ;?>')">
									<?php echo lang('BTN_REMOVE') ?>
								</button>
							</td>
						</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
