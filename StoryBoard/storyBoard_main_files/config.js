/* --------------------------------------------------------------------------
 * File        : config.js
 * Version     : 1.0
 * Author      : Indonez Team
 * Author URI  : http://indonez.com
 *
 * Indonez Copyright 2015 All Rights Reserved.
 * -------------------------------------------------------------------------- */

/* --------------------------------------------------------------------------
 * javascript handle initialization
      1. To top Jquery
      2. Progress Bar Jquery
      3. Circular Bar Jquery
 *
 * -------------------------------------------------------------------------- */
 
(function($){

	"use strict";
	
	var themeApp = {
		
	  //----------- 1. To top Jquery ----------- 
	   theme_scrollUP:function() {
		   
		$(document).scroll(function () {
		var toTop = $('.to-top');
		if ($(this).scrollTop() > 400) {
		
		toTop.fadeIn();
		} else {
		toTop.fadeOut();
		}
		});

	   },
		
	  //----------- 2. Progress Bar Jquery ----------- 
      theme_progressbar:function() {
		
		function progress(percent, element) {
		"use strict";
		var progressBarWidth = percent * element.width() / 100;
		element.find('div').animate({ width: progressBarWidth }, 2000).html("<div class='idz-progress-meter'>"+percent+"%&nbsp;</div>");
		}
		 
		var bar = $('.idz-progress-bar');
		 
		bar.each(function() { 
			var bar = $(this);
			var percentage = $(this).attr('data-percent');
			progress(percentage, bar);
		});

         
      },
	  
	  //----------- 3. Circular Bar Jquery ----------- 
	  theme_circularbar:function() {
		  
		var cb  = $('.idz-circular');
		var cbg = $('.idz-circular.green');
		var cbb = $('.idz-circular.blue');
		var cbo = $('.idz-circular.orange');
		var cbr = $('.idz-circular.red');
		
		cb.each(function() { 
		
			cb.donutchart({'size': 150});
			cb.donutchart("animate");

			cbg.donutchart({'size': 150, 'fgColor': '#9bc23c' });
			cbg.donutchart("animate");

			cbb.donutchart({'size': 150, 'fgColor': '#0090cf' });
			cbb.donutchart("animate");

			cbo.donutchart({'size': 150, 'fgColor': '#f07406' });
			cbo.donutchart("animate");

			cbr.donutchart({'size': 150, 'fgColor': '#e74b3b' });
			cbr.donutchart("animate");
		});
         
      },
	  
	  // theme init
      theme_init:function(){
		 themeApp.theme_scrollUP();
         themeApp.theme_progressbar();
		 themeApp.theme_circularbar();
      }
		
	}//end themeApp
	
	
	jQuery(document).ready(function($){
	   	   
		themeApp.theme_init();

    });
	
})(jQuery);