jQuery(function(){
	jQuery("a[href^=#]").click(function(){
		var Hash = jQuery(this.hash);
		var HashOffset = jQuery(Hash).offset().top;
		jQuery("html,body").animate({
			scrollTop: HashOffset
		}, 500);
		return false;
	});
});