$( "ul#products-widget li img" ).first().css( "display", "block" );
$( "ul#products-widget li p" ).first().css( "display", "block" );
$(function($) {
    $("ul#products-widget li h5").click(function() {
    	$('ul#products-widget li img').hide();
    	$('ul#products-widget li p').hide();
    	$('ul#products-widget li h5').removeClass('toggle-buttonMinus').addClass('toggle-buttonPlus');
        var $this = $(this);
        var showing = $(this).closest("li").children("img").is(':visible');
        if(showing === false){
        $(this).closest("li").children("img").show("slow");
        $(this).closest("li").children("p").show("slow");
        $(this).removeClass('toggle-buttonPlus').addClass('toggle-buttonMinus');
        }
        else{
        //$(this).closest("li").children("img").hide('slow');
        //$(this).closest("li").children("p").hide('slow');
        //$(this).removeClass('toggle-buttonMinus').addClass('toggle-buttonPlus');
        }
    });
    $( "#go" ).load(function() {
  $( ".homebox1:first" ).animate({
    left: 100
  }, {
    duration: 1000,
    step: function( now, fx ){
      $( ".homebox1:gt(0)" ).css( "left", now );
    }
  });
});
});
$( "ul#spotLight li" ).on('mouseleave', function() {
	
	 if ( $( this ).hasClass( "homeboxexpand" ) ) {
     $(this).removeClass('homeboxexpand');
	 $('ul#spotLight li').show();
	 $('ul#spotLight li img').show();
	  }
	
});
$( "ul#spotLight > li img" ).on('click', function() {
	$('ul#spotLight li').hide();
	$(this).closest("li").show();
	$('ul#spotLight li img').hide();
    $(this).closest("li").addClass('homeboxexpand');
});
// Home page slider trigger -->
window.setInterval(function(){

$('.icon-next').trigger('click');
}, 5000);

// $( "ul#spotLight > li" ).on('mouseleave', function() {
// 	$('ul#spotLight li').show();
// 	$('ul#spotLight li img').show();
//     $(this).animate( { "height" : "208px","width": "232px"} );
// });
