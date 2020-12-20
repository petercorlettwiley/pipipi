/* global jQuery, Cookies */
//import Cookies from 'cookie.min.js';
/**
 * File acid.js.
 *
 * Makes things acidic
 */
( function( $ ) {

  const $acidButton = $('a[href*="acid"]');
  const $elements = $('main p, main img, main h1, main h2, main h3, main iframe, .mix .wrap');
  var acid = false;

  if (Cookies.get('acid') == 'on') {
    $('body').addClass('acid');
    acid = true;
  }

  if (acid) {
    acidify($elements);
  }
  
  $acidButton.on('click', function(event) {
    event.preventDefault();

    if (Cookies.get('acid') == 'on') {
      Cookies.set('acid', 'off');
      acid = false;
    } else {
      Cookies.set('acid', 'on');
      acid = true;
    } 
    
    $('body').toggleClass('acid');

    if (acid) {
      acidify($elements);
    } else {
      unacidify($elements);
    }

  });

  function acidify(elements) {
    $(elements).each(function() {
      $(this).css('position', 'relative');
      animateElement($(this));
    });
  }

  function unacidify(elements) {
    $(elements).each(function() {
      $(this).css('position', '').css('transform', '');
      //animateElement($(this));
    });
  }

  function animateElement(element){

    const maxMove = 20;
    const baseTime = 1000;
    const maxRotate = 45;
    const flexTime = 2000;

    var leftVal = Math.random()*maxMove-maxMove/2;
    var topVal = Math.random()*maxMove-maxMove/2;
    var speed = Math.random()*flexTime+baseTime;
    var rotate = Math.random()*maxRotate-maxRotate/2

    $(element).animate( {
      left: "+="+leftVal+"px",
      top: "+="+topVal+"px",
      transform: 'rotate(' + rotate + 'deg)'
    },
    {
      duration: speed,
      complete: function(){
        animateElement(this);
      }
    });
  }
  
  
}( jQuery ) );
