<?php

  // Pannel Settings
     function kaya_row_container1($styles) {
	$styles['container1'] = __('Fullwidth Container Visual Style 1', 'innova');
	return $styles;
}
add_filter('siteorigin_panels_row_styles', 'kaya_row_container1');

function kaya_row_container2($styles) {
	$styles['container2'] = __('Fullwidth Container Visual Style 2', 'innova');
	return $styles;
}
add_filter('siteorigin_panels_row_styles', 'kaya_row_container2');


