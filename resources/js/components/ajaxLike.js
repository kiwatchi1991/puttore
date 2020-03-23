console.log('ajaxlike読み込み');
let $like = $('.c-ajaxLike__icon');
let likePostId;
$like.on('click', function () {
    console.log('ajaxlike発火');
    console.log('ここまで1');
    let $this = $(this);
    console.log('ここまで2');
    likePostId = $this.data('like');
    console.log('ここまで3');
    console.log(likePostId);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/products/ajaxlike',
        type: 'POST',
        dataType: 'json',
        data:{ 'like':likePostId},
    })
    // Ajaxリクエストが成功した場合
    .done(function () {
        console.log('ここまで4');
        $this.toggleClass('is-active');
        if ($this.hasClass('is-active')) {
          console.log('trueの処理');
          $this.text('ほしいものリストに入っています ♡');
        } else {
          console.log('falseの処理');
        $this.text('ほしいものリストに追加する ♡');
      }
      $this.parents('.c-productShow__like').toggleClass('is-active');
  })
  // Ajaxリクエストが失敗した場合
  .fail(function (data) {
    console.log('エラー');
    console.log(data);
  });
})