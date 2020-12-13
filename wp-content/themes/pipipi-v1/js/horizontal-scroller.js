var doc = window.document,
  context = doc.querySelector('.horizontal-scroll-wrapper'),
  clones, //context.querySelectorAll('.is-clone')
  disableScroll = false,
  scrollWidth = 0,
  scrollPos = 0,
  clonesWidth = 0,
  i = 0;

function getScrollPos () {
  return (context.pageYOffset || context.scrollLeft) - (context.clientTop || 0);
}

function setScrollPos (pos) {
  context.scrollLeft = pos;
}

function makeClones () {
  var children = [];

  for (var i = 0; i < context.childNodes.length; i++) {
    var clone = context.childNodes[i].cloneNode(true);
    clone.classList += " is-clone";
    children.push(clone);
  }
  
  for (var j = 0; j < children.length; j++) {
    context.appendChild(children[j]);
  }

  clones = context.querySelectorAll('.is-clone');
}

function getClonesWidth () {
  clonesWidth = 0;

  for (i = 0; i < clones.length; i += 1) {
    clonesWidth = clonesWidth + clones[i].offsetWidth;
  }

  return clonesWidth;
}

function reCalc () {
  scrollPos = getScrollPos();
  scrollWidth = context.scrollWidth;
  clonesWidth = getClonesWidth();

  if (scrollPos <= 0) {
    setScrollPos(1); // Scroll 1 pixel to allow upwards scrolling
  }
}

function scrollUpdate () {
  if (!disableScroll) {
    scrollPos = getScrollPos();

    if (clonesWidth + scrollPos >= scrollWidth) {
      // Scroll to the top when you’ve reached the bottom
      setScrollPos(1); // Scroll down 1 pixel to allow upwards scrolling
      disableScroll = true;
    } else if (scrollPos <= 0) {
      // Scroll to the bottom when you reach the top
      setScrollPos(scrollWidth - clonesWidth);
      disableScroll = true;
    }
  }

  if (disableScroll) {
    // Disable scroll-jumping for a short time to avoid flickering
    window.setTimeout(function () {
      disableScroll = false;
    }, 40);
  }
}

function init () {
  makeClones();
  reCalc();
  
  context.addEventListener('scroll', function () {
    window.requestAnimationFrame(scrollUpdate);
  }, false);

  window.addEventListener('resize', function () {
    window.requestAnimationFrame(reCalc);
  }, false);
}

if (document.readyState !== 'loading') {
  init();
} else {
  document.addEventListener('DOMContentLoaded', init, false);
}


// Just for this demo: Center the middle block on page load
//window.onload = function () {
//  setScrollPos(Math.round(clones[0].getBoundingClientRect().top + getScrollPos() - (context.offsetHeight - clones[0].offsetHeight) / 2));
//};