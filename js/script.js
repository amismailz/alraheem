$(document).ready(function(){
    
    var Dropdown = function (element) {
    $(element).on('hover.bs.dropdown', this.toggle);
  };

  
  
   $('#slider').owlCarousel({
    rtl:true,
    loop:true,
    margin:10,
    items : 1,
    autoplay: true,
    autoplayTimeout: 6000,
    autoplayHoverPause: true,
    autoplaySpeed:3000

});

    $('#services-slider').owlCarousel({
    rtl:true,
    loop:true,
    margin:10,
    autoplay: true,
    autoplayTimeout: 4000,
    autoplayHoverPause: true,
    dotsEach: 1,
    responsive:{
        0:{
            items:1
        },
        479:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
});

    $('.newsticker').newsTicker({
    row_height: 88,
    max_rows: 3,
    speed: 600,
    direction: 'up',
    duration: 4000,
    autostart: 1,
    pauseOnHover: 1,
    prevButton:  $('#prev-button'),
    nextButton:  $('#next-button'),
    stopButton:  $('#stop-button'),
    startButton: $('#start-button')
});
   var nt_example1 = $('#nt-example1').newsTicker({
    prevButton: $('#nt-example1-prev'),
    nextButton: $('#nt-example1-next')
}); 



$(function(){

  // Instantiate MixItUp:

  $('#gallery-content').mixItUp();

});

$("#bs-example-navbar-collapse-111").hide();
$("#nav-collapse111").click(function () {
    $("#bs-example-navbar-collapse-111").show();
})
// Tab
$('#myTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
});

 // about us scroll spy
 $('body').scrollspy({ target: '#navbar-example' });



 $('#donate-ways-slider').owlCarousel({
    rtl:true,
    loop:true,
    margin:10,
    autoplay: true,
    autoplayTimeout: 4000,
    autoplayHoverPause: true,
    responsive:{
        0:{
            items:1
        },
        479:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:4
        },
        1200:{
            items:4
        },
        1600:{
            items:5
        },
    }
});

});