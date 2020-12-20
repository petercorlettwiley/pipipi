/* global jQuery, mixLinks */
/**
 * File dice.js.
 *
 * Loads a random mix
 */
( function( $ ) {


  const $diceButton = $('a[href*="dice"]');
  
  // bail if no videos
  $diceButton.on('click', function(event) {
    event.preventDefault();
    const randomLink = getRandomLink(mixLinks);
    window.location.href = randomLink;
  });
  
  function getRandomLink(links) {
    const randomLink = links[Math.floor(Math.random() * links.length)];
    return randomLink;
  }
  
  
}( jQuery ) );
