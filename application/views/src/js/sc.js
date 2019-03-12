var _sc = <?php echo json_encode($this->SC->get_all_cache()) ?>;
for(var sc_index in _sc) {
	$('#top_sc_'+_sc[sc_index].id).attr('src', _sc[sc_index].icon);
	$('#btm_sc_'+_sc[sc_index].id).attr('src', _sc[sc_index].icon);
}


