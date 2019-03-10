<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php if ($this->container['sw_offline_cache'] === NULL): ?>
<div class="row starter-template mx-2 pb-2">
	<div class="col col-12 px-0 px-md-2">
		<form class="row form-inline">
			<div class="input-group p-1 pr-0 bg-white">
				<div class="input-group-prepend">
				  <div class="input-group-text rounded-0 border-0 bg-white"><i class="material-icons">&#xe264;</i></div>
				</div>
				<input id="search_keyword" type="text" class="form-control form-control-sm rounded-0 border-0 bg-white no-border" id="inlineFormInputGroupUsername2" placeholder="<?php echo lang('L_P_S_KEYWORD') ?>">
			</div>
			<div class="input-group p-1 pl-0 bg-white">
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
</div>
<div class="mx-4">
<?php echo isset($products) ? $products : NULL ?>
</div>
<?php else: ?>
<script>
//caches.keys().then((c) => {
	//caches.open(c[0]).then((c) => {
		//c.keys().then(keys => {
			//keys.forEach(req => {
				//if (req.url.indexOf(window.location.origin+'/store/') == 0) {
					//console.log('------------------')
					//console.log(req.url)
					//console.log(req.url.replace(window.location.origin+'/store/', ''))
					//console.log(req.url.replace(window.location.origin+'/store/', '').replace('-', ' '))
				//}
			//})
			//console.log('------------------')
		//})
	//})
//})
for(var k in window.localStorage) {
	if (window.localStorage.getItem(k) != null) {
		console.log(window.localStorage.getItem(k))
	}
}
</script>
<?php endif ?>
