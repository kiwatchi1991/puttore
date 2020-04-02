let $like = $('.js-ajaxLike__btn');
let likePostId;
$like.on('click', function () {
    let $this = $(this);
    likePostId = $this.data('like');
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
        $this.toggleClass('is-active');
        if ($this.hasClass('is-active')) {
          $this.text('お気に入りに入っています ♡');
        } else {
        $this.text('お気に入りに追加する ♡');
      }
      $this.parents('.c-productShow__like').toggleClass('is-active');
  })
  // Ajaxリクエストが失敗した場合
  .fail(function (data) {
//
  });
})