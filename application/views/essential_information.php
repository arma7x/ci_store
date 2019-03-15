<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<div class="container bg-light">
	<div class="col col-12">
		<h2 class="text-center text-primary"><?php echo isset($page_name) ? strtoupper($page_name) : strtoupper('Codeigniter') ;?></h2>
	</div>
	<div><?php echo $ei_content['full_description'] ?></div>
</div>
