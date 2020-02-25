console.log('ajaxcart読み込み');
let $cart = $('.c-ajaxCart__icon');
let cartPostId;
$cart.on('click', function () {
    console.log('ajaxcart発火');
    console.log('ここまで1');
    let $this = $(this);
    console.log('ここまで2');
    cartPostId = $this.data('cart');
    console.log('ここまで3');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/carts',
        type: 'POST',
        dataType: 'json',
        data:{ 'cart':cartPostId},
    })
    // Ajaxリクエストが成功した場合
    .done(function () {
        console.log('ここまで4');
    $this.toggleClass('is-inCart');
  })
  // Ajaxリクエストが失敗した場合
  .fail(function (data) {
    console.log('エラー');
    console.log(data);
  });
})