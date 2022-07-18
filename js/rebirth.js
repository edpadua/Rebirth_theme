jQuery(document).ready( function($){
	//custom Rebirth scripts
	
	var carousel = '.rebirth-carousel-thumb';
	
	rebirth_get_bs_thumbs(carousel);

	$(carousel).on('slid.bs.carousel', function(){
		rebirth_get_bs_thumbs(carousel);
	});
	
	function rebirth_get_bs_thumbs( carousel ){
		var nextThumb = $('.item.active').find('.next-image-preview').data('image');
		var prevThumb = $('.item.active').find('.prev-image-preview').data('image');
		$(carousel).find('.carousel-control.right').find('.thumbnail-container').css({ 'background-image' : 'url('+nextThumb+')' });
		$(carousel).find('.carousel-control.left').find('.thumbnail-container').css({ 'background-image' : 'url('+prevThumb+')' });
	}
	
    
    /*Script para zoom em imagem da galeria */
    var modal = document.getElementById('myModal');
    items = $('.container-gallery .thumbnail-gallery'),
    itemAmt = items.length;

    $(".figure-gallery").on("click", function(){
        var loc= $(this).find(".image-gallery").attr("data-fullscreen-url")+"";
        var alt= $(this).find(".image-gallery").attr("alt")+"";
        var currentIndex = $(this).find(".image-gallery").attr("image-index")+"";
        console.log(currentIndex);
        $(".conteudo-modal").attr('src',loc); 
        $(".conteudo-modal").attr('image-index',currentIndex); 
        $(".conteudo-modal").attr('alt',alt); 
        $("#lightbox-text").text(alt);
        $("#myModal").css("display","block");
        $("#modal-text").text((parseInt(currentIndex)+1)+'/'+itemAmt);
    });

    $(".close").on("click", function(){
        $("#myModal").css("display","none");
    });
    
    
    /*Script para slide de imagens da galeria */
    
    function cycleItems(index) {
      var nloc=$('.image-gallery[image-index="'+index+'"]').attr("data-fullscreen-url")+"";
      var alt=$('.image-gallery[image-index="'+index+'"]').attr("alt")+"";
      $(".conteudo-modal").attr('src',nloc); 
      $(".conteudo-modal").attr('alt',alt); 
      $("#lightbox-text").text(alt);
      $(".conteudo-modal").attr('image-index',index); 
      $("#modal-text").text((parseInt(index)+1)+'/'+itemAmt);
      
    }
    
   $('#button_next_gallery').click(function() {
      var currentIndex = $(".conteudo-modal").attr("image-index")+""; 
      
      currentIndex++;
        $("#modal-text").text(currentIndex);
      if (currentIndex > itemAmt - 1) {
        currentIndex = 0;
      }
       
       cycleItems(currentIndex);
    });
    
    $('#button_prev_gallery').click(function() {
      var currentIndex = $(".conteudo-modal").attr("image-index")+""; 
         
      currentIndex -= 1;
      if (currentIndex < 0) {
        currentIndex = itemAmt - 1;
      }
                
      $("#modal-text").text(currentIndex);
      cycleItems(currentIndex);
    });
   
    
});



/*Script do menu mobile*/
$(".btn_menu").click(function(){
                   
                   $(".nav-container-mobile").slideToggle();
                   event.stopPropagation();
    
                   $(".nav-container-mobile-vertical").slideToggle();
                   event.stopPropagation();
    
});






jQuery(window).resize(function () {
        if ($(".main_header").width() > 751) {
            $(".nav-container-mobile").css("display", "none");
        }
    
        if ($(window).width() > 975) {
            $(".nav-container-mobile-vertical").css("display", "none");
        }
});

/*Script do thumbnail*/

$(".thumb-caption").hover(
    function(){
	   $(this).children(".info-thumb-projeto").css("opacity", "1");
       $(this).children(".info-thumb-projeto").css("visibility", "visible");
       $(this).children(".info-thumb-projeto").animate({left: '0%'});
       $(this).children(".thumb-caption-back").css("opacity", "0.7");
       
       
    },
    
    function(){
	   $(this).children(".info-thumb-projeto").css("opacity", "0");
       $(this).children(".info-thumb-projeto").css("visibility", "hidden");
       $(".info-thumb-projeto").css("left","-50%");
       $(this).children(".thumb-caption-back").css("opacity", "0");
       $(this).siblings(".thumb-responsive").css('transform','scale(1.0)');
       $(this).siblings(".thumb-responsive-blog").css('transform','scale(1.0)');
    }

);

/* parallax */

$('.parallax-sec').each(function(){
	var $obj = $(this);
 
	$(window).scroll(function() {
		var yPos = -($(window).scrollTop() / $obj.data('speed')); 
 
		var bgpos = '100% '+ yPos + 'px';
 
		$obj.css('background-position', bgpos );
 
	}); 
});


$('.parallax-slide').each(function(){
	var $obj = $(this);
 
	$(window).scroll(function() {
		var yPos = -($(window).scrollTop() / $obj.data('speed')); 
 
		var bgpos = '100% '+ yPos + 'px';
 
		$obj.css('background-position', bgpos );
 
	}); 
});


/*script ajuste widget servicos */

$(document).ready(function() {
  

   $(window).resize(function(){
       
        var maxHeight = -1;
    
       $('.realizacao_descricao').each(function() {

            var totalHeight = 0;
            $(this).children().each(function(){
                totalHeight += $(this).outerHeight(true);
            });

            $(this).height(totalHeight);
           totalHeight=$(this).height();    
          

       });
       
       $('.realizacao_descricao').each(function() {

            maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
            

       });
       
       if($(window).width() > 700) {
          $('.realizacao_descricao').each(function() {
             $(this).height(maxHeight);
             /*alert("Max Height: " + $(this).height() + "px");*/
          });  
       }
    
    });
  
 });


$(document).ready(function() {
   var maxHeight = -1;

  
    
   $('.realizacao_descricao').each(function() {
     maxHeight = maxHeight > $(this).height() ? maxHeight : $(this).height();
   });
   
    if($(window).width() > 700) {
          $('.realizacao_descricao').each(function() {
             $(this).height(maxHeight);
          });  
    }   
    
    
    var maxHeightCons = -1;

  
    
   $('.consultor-descricao').each(function() {
     maxHeightCons = maxHeightCons > $(this).height() ? maxHeightCons : $(this).height();
   });
   
    if($(window).width() > 900) {
          $('.consultor-descricao').each(function() {
             $(this).height(maxHeightCons);
          });  
    }   
   
  
 });


/*script ajuste widget consultores */


$(document).ready(function() {
  

   $(window).resize(function(){
       
        var maxHeightCons = -1;
    
       $('.consultor-descricao').each(function() {

            var totalHeightCons = 0;
            $(this).children().each(function(){
                totalHeightCons += $(this).outerHeight(true);
            });

            $(this).height(totalHeightCons);
           totalHeightCons=$(this).height();    
          

       });
       
       $('.consultor-descricao').each(function() {

            maxHeightCons = maxHeightCons > $(this).height() ? maxHeightCons : $(this).height();
            

       });
       
       if($(window).width() > 900) {
          $('.consultor-descricao').each(function() {
             $(this).height(maxHeightCons);
             /*alert("Max Height: " + $(this).height() + "px");*/
          });  
       }
    
    });
  
 });




$(document).ready(function() {
  if($('#myCarousel .carousel-inner').children('.item').hasClass('active')) { 
     $(this).find('.carousel-caption').fadeIn(1000);
           
  
   }
    
     $("#myCarousel").on('slid.bs.carousel', function (e) {
            $(e.relatedTarget).find('.carousel-caption').fadeIn(1000);
     });
    
     $("#myCarousel").on('slide.bs.carousel', function (e) {
            $(e.relatedTarget).find('.carousel-caption').hide();
     });

 
});


/* Efeito de aparecer linha do tempo */
    $(window).scroll( function(){
    
        /* Check the location of each desired element */
        $('.hideme').each( function(i){
            
            var bottom_of_object = $(this).offset().top + $(this).outerHeight();
            var bottom_of_window = $(window).scrollTop() + $(window).height();
            
            /* If the object is completely visible in the window, fade it it */
            if( bottom_of_window > bottom_of_object ){
                
                $(this).animate({'opacity':'1'},500);
                    
            }
            
        }); 
    
    });





/* Efeitos slider */

$('#myCarousel').carousel();



/* Efeito do cabeçalho */


$(function(){
     var shrinkHeader = 100;
      $(window).scroll(function() {
        var scroll = getCurrentScroll();
            if ( scroll >= shrinkHeader ) {
               $('.main-nav-container').addClass('shrink');
               $('#logo').addClass('shrink');
               $('.nav-container').addClass('shrink');
            }
            else {
                $('.main-nav-container').removeClass('shrink');
                $('#logo').removeClass('shrink');
                $('.nav-container').removeClass('shrink');
            }
      });
      function getCurrentScroll() {
        return window.pageYOffset || document.documentElement.scrollTop;
      }
});


/* Carousel especial */


(function(){
  // setup your carousels as you normally would using JS
  // or via data attributes according to the documentation
  // http://getbootstrap.com/javascript/#carousel
  $('#carousel123').carousel({ interval: 2000 });
  $('#carouselABC').carousel({ interval: 3600 });
}());

(function(){
  $('.carousel-showmanymoveone .item').each(function(){
    var itemToClone = $(this);
    var $count = $("#carousel_logos").attr("count");

    for (var i=1;i<$count;i++) {
      itemToClone = itemToClone.next();

      // wrap around if at end of item collection
      if (!itemToClone.length) {
        itemToClone = $(this).siblings(':first');
      }

      // grab item, clone, add marker class, add to collection
      itemToClone.children(':first-child').clone()
        .addClass("cloneditem-"+(i))
        .appendTo($(this));
    }
  });
}());
    

/* Carousel galeria */


(function(){
  // setup your carousels as you normally would using JS
  // or via data attributes according to the documentation
  // http://getbootstrap.com/javascript/#carousel
  $('#carousel123').carousel({ interval: 2000 });
  $('#carouselABC').carousel({ interval: 3600 });
}());

(function(){
  $('.carousel-gallery-full .item').each(function(){
    var itemToClone = $(this);
    var $count = $("#carousel_gallery").attr("count");

    for (var i=1;i<$count;i++) {
      itemToClone = itemToClone.next();

      // wrap around if at end of item collection
      if (!itemToClone.length) {
        itemToClone = $(this).siblings(':first');
      }

      // grab item, clone, add marker class, add to collection
      itemToClone.children(':first-child').clone()
        .addClass("cloneditem-"+(i))
        .appendTo($(this));
    }
  });
}());





/* Contador */




$(window).scroll(function() {
    var hT = $('.counter-list').offset().top,
        hH = $('.counter-list').outerHeight(),
        wH = $(window).height(),
        wS = $(this).scrollTop();
    console.log((hT - wH), wS);
    
    if (wS > (hT + hH - wH)) {
         $('.count').each(function () {
                    $(this).prop('Counter',0).animate({
                        Counter: $(this).text()
                    }, {
                        duration: 4000,
                        easing: 'swing',
                        step: function (now) {
                            $(this).text(Math.ceil(now));
                        }
                    });
        }); {
            $('.count').removeClass('count').addClass('counted');
        };

    }
});



/* Contagem regressiva */

 /* ---------------------------------------------------------------------------
         * Downcount
* --------------------------------------------------------------------------- */
	



(function(e){
    e.fn.downCount=function(t,n){
        function o(){
            var e=new Date(r.date),t=s();
            var o=e-t;
            if(o<0){
                 clearInterval(u);
                 if(n&&typeof n==="function")n();
                  return}
                  var a=1e3,f=a*60,l=f*60,c=l*24;
                  var h=Math.floor(o/c),p=Math.floor(o%c/l),d=Math.floor(o%l/f),v=Math.floor(o%f/a);
                  h=String(h).length>=2?h:"0"+h;
                  p=String(p).length>=2?p:"0"+p;
                  d=String(d).length>=2?d:"0"+d;
                  v=String(v).length>=2?v:"0"+v;
                  var m=h===1?"day":"days",g=p===1?"hour":"hours",y=d===1?"minute":"minutes",b=v===1?"second":"seconds";
                  i.find(".days").text(h);
                  i.find(".hours").text(p);
                  i.find(".minutes").text(d);
                  i.find(".seconds").text(v);
                  i.find(".days_ref").text(m);
                  i.find(".hours_ref").text(g);
                  i.find(".minutes_ref").text(y);
                  i.find(".seconds_ref").text(b)}
                  var r=e.extend({date:null,offset:null},t);
                  if(!r.date){e.error("Date is not defined.")}if(!Date.parse(r.date)){e.error("Incorrect date format, it should look like this, 12/24/2012 12:00:00.")}
                  var i=this;
                  var s=function(){
                  var e=new Date;var t=e.getTime()+e.getTimezoneOffset()*6e4;
                  var n=new Date(t+36e5*r.offset);return n};
                  var u=setInterval(o,1e3)}})(jQuery);


	
        $( '.downcount' ).each( function(){
        	var el = $(this);
        	el.downCount({
        		date	: el.attr('data-date'),
        		offset	: el.attr('data-offset')
        	});  
        }); 



/*  Toggle list */


$(".toggle-section-button").click(function(){
    
                   $(this).next().slideToggle();
                   $(this).toggleClass("box-full-height");     
                   $(this).find("a").toggleClass("toggle_header_link");     
    
});





$(".tab-header-item").click(function(){
    
        
                   $(this).siblings().each( function () {
                        $(this).removeClass("tab-header-item-active");
                   });   
                   $(this).addClass("tab-header-item-active");
    
                   var tabNum = $(this).index();
    
                   
    
                   
                   $(".tab-content-item").each( function () {
                        $(this).removeClass("tab-content-item-active");
                        if($(this).index()==tabNum){
                            $(this).addClass("tab-content-item-active");
                        }
                   });   
                  
                   
});
