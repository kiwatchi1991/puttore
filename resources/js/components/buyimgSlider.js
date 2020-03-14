
// let currentItemNum = 1;
let $buyContainer = $('.js-buy__container');
let buyItemNum = $('.js-buy__item').length;
let buyItemWidth = $('.js-buy__item').innerWidth();
let buyContainerWidth = buyItemWidth * buyItemNum;
// let DURATION = 500;
$buyContainer.attr('style', 'width:' + buyContainerWidth + 'px');

// $('.js-buy__next').on('click', function () {
//   if (currentItemNum < buyItemNum) {
//     $buyContainer.animate({ left: '-=' + buyItemWidth + 'px' }, DURATION);
//     currentItemNum++;
//   }
//     toggleOpacity();
// });
// $('.js-buy__prev').on('click', function () {
//   if (currentItemNum > 1) {
//     $buyContainer.animate({ left: '+=' + buyItemWidth + 'px' }, DURATION);
//     currentItemNum--;
//     }
//     toggleOpacity();
// });

// let toggleOpacity = function () {
    
//     if (currentItemNum == 1) {
//         $('.js-buy__prev').attr('style', 'opacity:' + 0.5);
//     } else {
//         $('.js-buy__prev').attr('style', 'opacity:' + 1);
//     }
//     if (currentItemNum == buyItemNum) {
//         $('.js-buy__next').attr('style', 'opacity:' + 0.5);
//     } else {
//         $('.js-buy__next').attr('style', 'opacity:' + 1);
//     }
// }
// toggleOpacity();