const $head = $('.js-toggleTab');
const $block = $('.js-lesson__block');
const $areaInput = $('.js-lesson__block--input');
const $areaPreview = $('.js-lesson__block--preview');

$head.on('click', e => {
const target = $(e.target).attr('data-status');
$head.removeClass('active');
$block.removeClass('active');

switch (target) {
    case 'input':
    $areaInput.addClass('active');
    break;

    case 'preview':
    $areaPreview.addClass('active');
    break;
 }
})