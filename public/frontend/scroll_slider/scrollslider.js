(function($){
   $.extend($.fn,{
       jscrollSlider : function(settings)
	   {
		   
		   $.fn.jscrollSlider.defaults = 
		   {
		       enable : true,
			   autoplay : true,
			   speed : 300,
			   timeout:6000,
			   titlebar : 
			   {
			      enable : true,
				  dynamic : true,
				  speed : 300,
				  layout: '<div class="titlebar"><div class="masklayer"></div><div class="title"><a href="#"></a></div></div>',
				  container: '.titlebar',
				  title: '.title A'
			   },
			   inner : '.inner',
			   img : 'A',
			   
			   buttons : 
			   {	enable : true,
					appendbutton : true,
				   
				   layout : '<ul class="buttons"></ul>',
				   
				   container : '.buttons',
				   
				   butLayout : '<li></li>', 
				   
				   button : 'LI',
				   
				   presentLayout : '<li id="present"></li>',
				   
				   present : 'present'
				   
			   
			   }
		   }//default
		      
			  var options = $.extend(true,$.fn.jscrollSlider.defaults,settings);
			  $this = $(this);
			  var timeoutHandle;
			  var present = 0;
			  var index = 0;
			  
			  
			  var slider = 
			  {
			  
			      init : function()
				  {
				     
					 if(options.enable)
					 {
					 
					     options.inner = $this.find(options.inner);
			             options.img = options.inner.find(options.img);
						 if(options.img.length > 0)
						 {
							 if(options.buttons.enable && options.buttons.appendbutton)
							 {
							     slider.initButton();
							 }
							 
							 options.inner.append(options.img.clone());
							 
							 if(options.titlebar.enable)
							 {
							     slider.initTielbar();
							 
							 }
							 
							 if(options.autoplay)
							 {
								 
							  $this.mouseenter(function(e) {clearTimeout(timeoutHandle)}).mouseleave(function(e) {timeoutHandle = setTimeout(slider.play,options.timeout)});
							    slider.autoplay();
							 }
							 
						 }

					 }
					 				  
				  },//init
				  
				  initTielbar : function()
				  {
					  $this.append(options.titlebar.layout);
					  
					  options.titlebar.container = $this.find(options.titlebar.container);
					  options.titlebar.title = options.titlebar.container.find(options.titlebar.title);
					  
					  var firstIMG = $(options.img.get(0));
					  options.titlebar.title.attr('href',firstIMG.attr('href'));
					  options.titlebar.title.html(firstIMG.attr('title'));
					  
					  if(options.titlebar.dynamic)
					  {
					     dynamicAnimate();
						 $this.mouseenter(function(e) {dynamicAnimate(0)}).mouseleave(function(e) {dynamicAnimate()});
						 
					  }
					  
					  function dynamicAnimate(top)
					  {
					      if(typeof(top) == 'undefined'){top = -options.titlebar.container.height();}
						  options.titlebar.container.animate({top:top},options.titlebar.speed);
					  }
					  
				  
				  },//initTielbar
				  
				  initButton : function()
				  {
				      $this.append(options.buttons.layout);
					  options.buttons.container = $this.find(options.buttons.container);
					  for(var i = 0; i < options.img.length; i++)
					  {
                         if(!i)
						 {
							       
							 options.buttons.container.append(options.buttons.presentLayout);
								    
						  }else
								
							options.buttons.container.append(options.buttons.butLayout);
								 
					   }
					   
					   options.buttons.button = options.buttons.container.find(options.buttons.button);
					   
					   options.buttons.button.click(function(){
					       
						   if(this.id != options.buttons.present)
						   {
						      present = $(this).index();
							  slider.play();
						   }
					   
					   });
				  
				  },//initButton
				  
				  autoplay: function()
				  {
					  
					 if(present < options.img.length)
					 {
						 
						 present++;
					 
					 }else{
					    
						 present = 1;
						 //	options.inner.css({left:0});
					 
					 }

					 timeoutHandle = setTimeout(slider.play,options.timeout);
				  
				  },//autoplay
				  play : function()
				  {
					 clearTimeout(timeoutHandle);
					 options.buttons.button.attr('id',null);
					 index = present < options.img.length ? present : 0
					 options.buttons.button.get(index).id = options.buttons.present;
					 var img = $(options.img.get(index));
					 //options.titlebar.title.html(img.attr('title'));
					 //options.titlebar.title.attr('href',img.attr('href'));
					 //alert(present);
					 options.inner.animate({left:-(present * options.img.width()+60)},options.speed,function(){if(options.autoplay){slider.autoplay()}});
				  }
			  
			  }//slider
			  slider.init();
	   }//jscrollSlider
   })
})(jQuery)
