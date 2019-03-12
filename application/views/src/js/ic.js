var _ic = <?php echo json_encode($this->IC->get_all_cache()) ?>;
for(var ic_index in _ic) {
	$('#ic_'+_ic[ic_index].id).attr('src', _ic[ic_index].icon);
	$('#pm_ic_'+_ic[ic_index].id).attr('src', _ic[ic_index].icon);
}
