console.log('ajaxfollow読み込み');
let $follow = $('.c-ajaxFollow__icon');
let followPostId;
$follow.on('click', function () {
    console.log('ajaxfollow発火');
    console.log('ここまで1');
    let $this = $(this);
    console.log('ここまで2');
    followPostId = $this.data('follow');
    console.log('ここまで3');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/products/ajaxfollow',
        type: 'POST',
        dataType: 'json',
        data:{ 'follow':followPostId},
    })
    // Ajaxリクエストが成功した場合
    .done(function () {
        console.log('ここまで4');
    $this.toggleClass('is-active');
  })
  // Ajaxリクエストが失敗した場合
  .fail(function (data) {
    console.log('エラー');
    console.log(data);
  });
})