<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php if ($this->container['sw_offline_cache'] === NULL): ?>
<div class="row starter-template mx-2 pb-2">
	<div class="col col-12 px-0 px-md-2">
		<form class="row form-inline">
			<div class="input-group">
				<div class="input-group-prepend">
				  <div class="input-group-text rounded-0 border-0 bg-light"><i class="material-icons">&#xe264;</i></div>
				</div>
				<input id="search_keyword" type="text" class="form-control form-control-sm rounded-0 border-0 bg-light no-border" id="inlineFormInputGroupUsername2" placeholder="<?php echo lang('L_P_S_KEYWORD') ?>">
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
</div>
<?php endif ?>
<div class="mx-4">
<?php echo isset($products) ? $products : NULL ?>
</div>
<?php if ($this->container['sw_offline_cache'] !== NULL): ?>
<script>
var product_list = $("#product_list")
var list = []
for(var i in window.localStorage) {
	if (window.localStorage.getItem(i) != null) {
		var k = JSON.parse(window.localStorage.getItem(i))
		var wrapper = '<div class="col col-12 col-md-3 px-0 py-2 p-md-2">{wrapper}</div>'
		var container = '<div class="img-container" data-placement="top" title="{k.brief_description}">{container}</div>'
		container = container.replace('{k.brief_description}', k.brief_description)
		var a = '<a href="/store/{k.slug}"><img id="{k.id}" class="img img-fluid" src="/static/img/loading.gif"/>{a}</a>'
		a = a.replace('{k.slug}', k.slug).replace('{k.id}', k.id)
		var script = '$(document).ready(function() { if (isCORS("{k.main_photo}")) { resizePicture("{k.main_photo}", null, 533, 533, .50, "image/webp", renderImg, "#{k.id}") } else { renderImg("{k.main_photo}", "#{k.id}") } })'
		script = script.replace('{k.main_photo}', k.main_photo)
		script = script.replace('{k.main_photo}', k.main_photo)
		script = script.replace('{k.main_photo}', k.main_photo)
		script = script.replace('{k.id}', k.id)
		script = script.replace('{k.id}', k.id)
		var availability = ''
		if(k.availability == '1'){
			availability = '<i class="material-icons stock text-success">&#xe3fa;</i>'
		} else {
			availability = '<i class="material-icons stock text-danger">&#xe3fa;</i>'
		}
		var name = '<h4 class="title font-weight-bold">{k.name}</h4>'
		name = name.replace('{k.name}', k.name)
		var spotlight = ''
		if (k.spotlight == '1') {
			spotlight = '<i class="material-icons favourite text-primary">&#xe89a;</i>'
		}
		var price = '<h6 class="price font-weight-bold"><?php echo $this->container["currency_unit"] ?>{k.price}</h6>'
		price = price.replace('{k.price}', parseFloat(k.price).toFixed(2))
		var overlay = '<div class="overlay"></div>'
		var script_tag = document.createElement('script')
		script_tag.append(script)
		a = a.replace('{a}', availability+name+spotlight+price+overlay)
		container = container.replace('{container}', a)
		wrapper = wrapper.replace('{wrapper}', container)
		var _final = $.parseHTML(wrapper)
		_final[0].append(script_tag)
		list.push(_final)
	}
}
if (list.length == 0) {
	var empty = '<div class="mx-0 my-2 col col-12 row justify-content-sm-center align-items-center" style="height:54vh;"><div class="col col-12"><h2 class="text-center text-primary"><i class="material-icons" style="font-size:5em;">&#xe7f3;</i></h2></div></div>'
	product_list.append($.parseHTML(empty))
} else {
	for(var l in list) {
		product_list.append(list[l])
	}
}
</script>
<?php endif ?>
