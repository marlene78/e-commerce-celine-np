$(document).ready(function(){
  $('.carousel').slick({
  	  infinite: true,
  slidesToShow: 3,
  slidesToScroll: 1,
  autoplay: true,
  autoplaySpeed: 2000,
  });
});


/******Swith accueil*********/
function switchClass(i) {
   var lis = $('#home-news > div');
   lis.eq(i).removeClass('home_header_on');
   lis.eq(i).removeClass('home_header_out');
    lis.eq(i = ++i % lis.length).addClass('home_header_on');
    lis.eq(i = ++i % lis.length).addClass('home_header_out');
    setTimeout(function() {
        switchClass(i);
    }, 3500);
}

$(window).load(function() {
   switchClass(-1);
});



/**********Scroll********/
        window.sr = ScrollReveal();
        sr.reveal('.showcase-left', {
          duration: 2000,
          origin:'left',
          distance:'300px'
        });
        sr.reveal('.showcase-right', {
          duration: 2000,
          origin:'right',
          distance:'300px'
        });
        sr.reveal('.showcase-btn', {
          duration: 2000,
          delay: 2000,
          origin:'bottom'
        });
        sr.reveal('#testimonial div', {
          duration: 2000,
          origin:'bottom'
        });
        sr.reveal('.info-left', {
          duration: 2000,
          origin:'left',
          distance:'300px',
          viewFactor: 0.2,
          reset:false
        });
        sr.reveal('.info-right', {
          duration: 2000,
          origin:'right',
          distance:'300px',
          viewFactor: 0.2,
          reset:false
        });

    $(function() {
      // Smooth Scrolling
      $('a[href*="#"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
          var target = $(this.hash);
          target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
          if (target.length) {
            $('html, body').animate({
              scrollTop: target.offset().top
            }, 1000);
            return false;
          }
        }
      });
    });
  

