jQuery(function() {

	jQuery( window ).load(function() {
		// Masonry for Footer
		jQuery( '#widget-area .container' ).masonry({
			itemSelector: '.widget',
			isAnimated: true
		});

		adjustHeaderImage();
		centerThumbnail();
	});

	// Navigation for mobile
	jQuery( "#small-menu" ).click( function(){
		jQuery( "#menu-primary-items" ).slideToggle();
		jQuery( this ).toggleClass( "current" );
	});

	// back to pagetop
    var totop = jQuery( '#back-top' );
    totop.hide();
    jQuery( window ).scroll(function () {
        if ( jQuery( this ).scrollTop() > 800 ) totop.fadeIn(); else totop.fadeOut();

		var y = jQuery(this).scrollTop();
		jQuery("#headerimage").css('top', parseInt( y * -0.3) + 'px');
    });
    totop.click( function () {
        jQuery( 'body, html' ).animate( { scrollTop: 0 }, 500 ); return false;
    });

	// Header Image Position
	jQuery(window).resize(function () {
		adjustHeaderImage();
	});
});

////////////////////////////////////////
// Center Thumbnail Position
function centerThumbnail() {

	jQuery('.entry-eyecatch img').each(function(i){
		var wrapperHeight = jQuery(this).parent().height();
		var wrapperWidth = jQuery(this).parent().width();
		var imageHeight = jQuery(this).height();
		var imageWidth = jQuery(this).width();

		if(imageWidth > imageHeight){
			// Horizontal Thumbnail
			var h = wrapperHeight;
			var w = (imageWidth/imageHeight) * h;
		}
		else{
			// Vertical Thumbnail
			var w = wrapperWidth;
			var h = (imageHeight/imageWidth) * w;
		}

		// Set Center
		var y = (wrapperHeight - h) / 2;
		var x = (wrapperWidth - w) / 2;

		jQuery(this).css({'height': h + 'px', 'width': w + 'px', 'top': y + 'px', 'left': x + 'px'});
	});
}

////////////////////////////////////////
// Header Image Position
function adjustHeaderImage() {

	if( 0 < jQuery( '#headerimage' ).length ){
		var header_height = jQuery( '#headerimage' ).height();
		jQuery( 'body' ).css( 'padding-top', header_height + 'px' );
	}
}
