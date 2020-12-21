var doc = window.document,
  context = doc.querySelector('.horizontal-scroll-wrapper'),
  clones, //context.querySelectorAll('.is-clone')
  childOffsets = [],
  windowWidth = window.innerWidth,
  lastIndex = -1,
  index,
  disableScroll = false,
  scrollWidth = 0,
  scrollPos = 0,
  clonesWidth = 0,
  i = 0;

function getScrollPos () {
  return (context.pageXOffset || context.scrollLeft) - (context.clientLeft || 0);
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
  getChildrenOffsets();
  windowWidth = window.innerWidth;
  scrollUpdate();

  if (scrollPos <= 0) {
    setScrollPos(1); // Scroll 1 pixel to allow upwards scrolling
  }

  // Setup isScrolling variable
  var isScrolling;
  
  context.addEventListener('scroll', function () {  // Listen for scroll events
    window.clearTimeout( isScrolling );// Clear our timeout throughout the scroll
  
    //isScrolling = setTimeout(function() { // Set a timeout to run after scrolling ends
    //  scrollToIndex(getIndex());
    //}, 66);
  
  }, false);
}

function getChildrenOffsets () {
  childOffsets = [];

  for (var i = 0; i < context.children.length; i++) {
    var child = context.children[i];
    childOffsets.push(child.offsetLeft);
  }
}

function getIndex () {
  const middleScroll = scrollPos + windowWidth/2 - (childOffsets[2] - childOffsets[1])/2;
  const diffArr = childOffsets.map(x => Math.abs(middleScroll - x));
  const minNumber = Math.min(...diffArr);
  index = diffArr.findIndex(x => x === minNumber);

  return index;
}

function scrollUpdate () {

  scrollPos = getScrollPos();

  if (!disableScroll) {

    if (clonesWidth + scrollPos >= scrollWidth) {
      // Scroll to the top when you’ve reached the bottom
      setScrollPos(1); // Scroll down 1 pixel to allow upwards scrolling
      disableScroll = true;
    } else if (scrollPos <= 0) {
      // Scroll to the bottom when you reach the top
      setScrollPos(scrollWidth - clonesWidth);
      disableScroll = true;
    }

    index = getIndex();
    const numberOfChildren = childOffsets.length/2;
  
    if (index !== lastIndex) {
      if (typeof context.children[lastIndex] !== 'undefined') {
        context.children[lastIndex].classList.remove('centered');
        context.children[(lastIndex + numberOfChildren) % childOffsets.length].classList.remove('centered');
      }
      //context.children[lastIndex].classList.remove('centered');
      context.children[index].classList.add('centered');
      context.children[(index + numberOfChildren) % childOffsets.length].classList.add('centered');
      lastIndex = index;
    }
  }

  if (disableScroll) {
    // Disable scroll-jumping for a short time to avoid flickering
    window.setTimeout(function () {
      disableScroll = false;
    }, 40);
  }
}

function scrollToIndex(index) {

  const childWidth = (childOffsets[2] - childOffsets[1]);
  const destination = childOffsets[index] - windowWidth/2 + childWidth/2;

  context.scrollTo({
    left: destination,//,
    behavior: 'smooth'
  });
}

function init () {
  if ( !context ) {
    return;
  }

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
