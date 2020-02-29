$(function () {
    console.log('loaded！！！');

    $('.c-tag__list').hover(function () {
        console.log('click！！！');
        $('.c-tag__lists:not(:animated)', this).slideDown();
    }, function () {
          $('.c-tag__lists', this).slideUp();
    });

  });