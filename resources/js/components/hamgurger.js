function toggleNav() {
const $body = $('body');
const $hamburger = $('#js-hamburger');
const $blackBg = $('#js-black-bg');

$hamburger.click(function() {
  console.log('クリックしたよ');
  $body.toggleClass('nav-open');
});
$blackBg.click(function() {
  $body.removeClass('nav-open');
});
}
// window.onload = toggleNav();
$(function () {
    toggleNav();
})