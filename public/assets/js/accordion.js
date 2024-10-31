jQuery(document).ready(function($){
	$(document.body).on('click','#myweb-accordion-menu li .myweb-accordion-item',function(){
		$(this).siblings(".myweb-ac-toolbar-items").slideToggle();
		$(this).toggleClass('active');
	})
})