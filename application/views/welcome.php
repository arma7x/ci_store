<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="row starter-template mx-2">
<div class="col col-12 px-0 px-md-2">
	<form class="row form-inline">
		<label class="sr-only"><?php echo lang('L_P_S_SEARCH');?></label>
		<div class="input-group mb-2 mb-md-0">
			<div class="input-group-prepend">
			  <div class="input-group-text rounded-0 border-0 bg-white"><i class="material-icons">&#xe264;</i></div>
			</div>
			<input id="search_keyword" type="text" class="form-control form-control-sm rounded-0 border-0 bg-white no-border" id="inlineFormInputGroupUsername2" placeholder="<?php echo lang('L_P_S_KEYWORD') ?>">
		</div>
		<div class="input-group">
			<button type="submit" class="btn btn-sm btn-primary rounded-0 btn-block" onClick="searchStore()">
				<i class="material-icons">&#xe8b6;</i>
			</button>
		</div>
		<script>
			$(document).ready(function() {
				$('#search_keyword').attr('value', getQueryStringValue('keyword'))
			})
			function searchStore() {
				var data = {
					'keyword': $("#search_keyword").val(),
				}
				var query = []
				for (key in data) {
					if (data[key] != '') {
						query.push(key+'='+data[key])
					}
				}
				if (query.length > 0) {
					Turbolinks.visit('/store'+'?'+query.join('&'), { action: "replace" })
				} else {
					Turbolinks.visit('/store', { action: "replace" })
				}
			}
		</script>
	</form>
</div>
<?php echo isset($products) ? $products : NULL ?>
</div>
