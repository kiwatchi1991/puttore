function toggleNav() {
const $body = $('body');
const $hamburger = $('#js-hamburger');
const $blackBg = $('#js-black-bg');

$hamburger.click(function() {
  $body.toggleClass('nav-open');
});
$blackBg.click(function() {
  $body.removeClass('nav-open');
});
}
$(function () {
    toggleNav();
})