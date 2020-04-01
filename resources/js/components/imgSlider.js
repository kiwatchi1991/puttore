
let currentItemNum = 1;
let $slideContainer = $('.js-slider__container');
let slideItemNum = $('.js-slider__item').length;
let slideItemWidth = $('.js-slider__item').innerWidth();
let slideContainerWidth = slideItemWidth * slideItemNum;
let DURATION = 500;
$slideContainer.attr('style', 'width:' + slideContainerWidth + 'px');

$('.js-slider__next').on('click', function () {
  if (currentItemNum < slideItemNum) {
    $slideContainer.animate({ left: '-=' + slideItemWidth + 'px' }, DURATION);
    currentItemNum++;
  }
    toggleOpacity();
});
$('.js-slider__prev').on('click', function () {
  if (currentItemNum > 1) {
    $slideContainer.animate({ left: '+=' + slideItemWidth + 'px' }, DURATION);
    currentItemNum--;
    }
    toggleOpacity();
});

let toggleOpacity = function () {
    
    if (currentItemNum == 1) {
        $('.js-slider__prev').attr('style', 'opacity:' + 0.3);
    } else {
        $('.js-slider__prev').attr('style', 'opacity:' + 1);
    }
    if (currentItemNum == slideItemNum) {
        $('.js-slider__next').attr('style', 'opacity:' + 0.3);
    } else {
        $('.js-slider__next').attr('style', 'opacity:' + 1);
    }
}
toggleOpacity();