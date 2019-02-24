var _cat = <?php echo json_encode($this->Category->get_all_cache()) ?>;
for(var cat_index in _cat) {
	$('#cat_'+_cat[cat_index].id).attr('src', _cat[cat_index].icon);
}


