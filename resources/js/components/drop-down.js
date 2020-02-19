$(function () {
    console.log('loaded！！！');

    $('.c-tag__title').hover(function () {
        console.log('click！！！');
        $('.c-tag__list:not(:animated)', this).slideDown();
    }, function () {
          $('.c-tag__list', this).slideUp();
    });

  });