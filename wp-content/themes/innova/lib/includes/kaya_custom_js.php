<?php
function kaya_custom_js(){
	$kaya_options = get_option('kayapati');
	 $term_select= isset( $kaya_options['term_select'] )? $kaya_options['term_select'] : 'all';
	 $kaya_scroll_bar = isset( $kaya_options['kaya_scroll_bar'] ) ? $kaya_options['kaya_scroll_bar'] : '0';  ?>
	<script type="text/javascript">
(function($) {
  "use strict";
	$(function() {
<?php if( $kaya_scroll_bar == '1'){ ?>	
  		$("html").niceScroll({styler:"fb",cursorcolor:"#888"}); //scrollbar
  	<?php } ?>	
/****************** Portfolio Isotope code **************/
if (jQuery().isotope){
var tempvar = "<?php echo $term_select; ?>";
$(window).load(function(){
$(function (){
	var isotopeContainer = $('.isotope-container'),
	isotopeFilter = $('#filter'),
	isotopeLink = isotopeFilter.find('a');
	isotopeContainer.isotope({
		itemSelector : '.isotope-item',
		//layoutMode : 'fitRows',
		filter : '.' +tempvar,
		 masonry:  {
                   columnWidth:    1,
                    isAnimated:     true,
                    isFitWidth:     true
                }
	});
	isotopeLink.click(function(){
		var selector = $(this).attr('data-category');
		isotopeContainer.isotope({
			filter : '.' + selector,
			itemSelector : '.isotope-item',
			//layoutMode : 'fitRows',
			animationEngine : 'best-available'
		});
		isotopeLink.removeClass('active');
		$(this).addClass('active');
		return false;
	});
});
		$("#filter ul li a").removeClass('active');
		$("#filter ul li."+tempvar+ " a").addClass('active');
});
}
});
})(jQuery);
</script>
<?php } 
add_action( 'wp_footer', 'kaya_custom_js', 100 );
?>