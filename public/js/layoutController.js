// JavaScript Document

$(function(){
	
	$(".arrow-img").on('click', function(){

		var temp = $('#row_' + $(this).data('row'));
		layout.switchSrc(temp, $(this));
	});
	
});

var layout = {
	switchSrc: function(showhide, elem) {
		 showhide.slideToggle("fast");
		 var src = elem.attr("src").split('images/');
		 switch(src[1]) {
			case 'arrow_up.png' :  elem.attr('src', siteURL + '/images/arrow_down.png'); break;
			case 'arrow_down.png' : elem.attr('src', siteURL + '/images/arrow_up.png'); break;
			case 'arrow_up.png' :  elem.attr('src', siteURL + '/images/arrow_down.png'); break;
			case 'arrow_down.png' :  elem.attr('src', siteURL + '/images/arrow_up.png'); break;
		 }
	},
	
	hideShow: function(_trigger, _show){
		_trigger.click(function(){
			_show.slideToggle("slow");
		});
	},
	
	rtn : false,
	
	flag : 0,
	
	x_flag : 0,
	
	x_data : ""
	
}