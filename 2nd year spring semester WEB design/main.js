$(function(){
	var _window = $(window),
		_header = $('.site-header'),
		heroBottom;
	
	_window.on('scroll',function(){		
		heroBottom = $('.hero').height();
		if(_window.scrollTop() > heroBottom){
			_header.addClass('fixed');   
		}
		else{
			_header.removeClass('fixed');   
		}
	});
	
	_window.trigger('scroll');
});