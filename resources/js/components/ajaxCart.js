// console.log('ajaxcart読み込み');

// let $cart = $('.js-ajaxCart__icon');
// let cartPostId;
//     $cart.on('click', function () {

//     console.log('ajaxcart発火');
//     console.log('ここまで1');
//     let $this = $(this);
//     console.log('ここまで2');
//     cartPostId = $this.data('add_cart');
//     console.log('ここまで3');
//     console.log(cartPostId);
//     $.ajax({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         url: '/carts',
//         type: 'POST',
//         dataType: 'json',
//         data:{ 'addCart':cartPostId},
//     })
//     // Ajaxリクエストが成功した場合
//     .done(function () {
//         console.log('ここまで4');
//     $this.addClass('is-inCart');
//   })
//   // Ajaxリクエストが失敗した場合
//   .fail(function (data) {
//     console.log('エラー');
//     console.log(data);
//   });
// })


//削除
// let $delete_button = $('.js-ajaxCart__delete');

// $delete_button.on('click',function () {
//     console.log('ajaxdelete発火');
//     console.log('ここまで1');

//     let $this = $(this);
//     console.log('ここまで2');

//     cartPostId = $this.data('delete_cart');
//     console.log('ここまで3');
//     console.log(cartPostId);

//     $.ajax({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//         url: '/carts',
//         type: 'POST',
//         dataType: 'json',
//         data:{ 'deleteCart':cartPostId},
//     })
//     // Ajaxリクエストが成功した場合
//     .done(function () {
//       console.log('ここまで4');
//   $this.removeClass('is-inCart');
// })
// // Ajaxリクエストが失敗した場合
// .fail(function (data) {
//   console.log('エラー');
//   console.log(data);
// });
// })