<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container starter-template">
	<div class="row">
		<div class="col col-12 p-0">
			<h2 class="text-center text-primary"><?php echo isset($page_name) ? strtoupper($page_name) : strtoupper('Codeigniter') ;?></h2>
				<ul class="nav nav-tabs" id="myTab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true"><i class="material-icons">&#xe88e;</i> <?php echo lang('H_G_GENERAL_INFORMATION') ;?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="social-tab" data-toggle="tab" href="#social" role="tab" aria-controls="social" aria-selected="false"><i class="material-icons">&#xe335;</i> <?php echo lang('H_G_SOCIAL_CHANNEL') ;?></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="inbox-tab" data-toggle="tab" href="#inbox" role="tab" aria-controls="inbox" aria-selected="false"><i class="material-icons">&#xe0be;</i> <?php echo lang('H_G_INBOX_CHANNEL') ;?></a>
					</li>
				</ul>
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="home-tab">
						<?php echo isset($general_info) ? $general_info : null ?>
					</div>
					<div class="tab-pane fade" id="social" role="tabpanel" aria-labelledby="social-tab">
						<?php echo isset($social_channel) ? $social_channel : null ?>
					</div>
					<div class="tab-pane fade" id="inbox" role="tabpanel" aria-labelledby="inbox-tab">
						<?php echo isset($inbox_channel) ? $inbox_channel : null ?>
					</div>
				</div>
			<?php echo isset($sc_modal_add) ? $sc_modal_add : null ?>
			<?php echo isset($sc_modal_update) ? $sc_modal_update : null ?>
			<?php echo isset($ic_modal_add) ? $ic_modal_add : null ?>
			<?php echo isset($ic_modal_update) ? $ic_modal_update : null ?>
			<?php echo isset($gi_js) ? $gi_js : null ?>
		</div>
	</div>
</div>
