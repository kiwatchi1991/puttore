let $buyContainer = $('.js-buy__container');
let buyItemNum = $('.js-buy__item').length;
let buyItemWidth = $('.js-buy__item').innerWidth();
let buyContainerWidth = buyItemWidth * buyItemNum;
$buyContainer.attr('style', 'width:' + buyContainerWidth + 'px');

let $draftContainer = $('.js-draft__container');
let draftItemNum = $('.js-draft__item').length;
let draftItemWidth = $('.js-draft__item').innerWidth();
let draftContainerWidth = draftItemWidth * draftItemNum;
$draftContainer.attr('style', 'width:' + draftContainerWidth + 'px');

