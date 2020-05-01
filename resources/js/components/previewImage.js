let $productFileInput = $('.js-input__file--product');
let $deletebtn = $('.js-delete__file');

// プロダクト登録プレビュー
$productFileInput.on('change', function () {
  let file = this.files[0],         // 2 file配列にファイルが入ってます
  $img = $(this).siblings('.js-prev__img'), // 3 jQueryのsiblingsメソッドで兄弟のimg取得
  fileReader = new FileReader();  // 4 ファイルを読み込むFileReaderオブジェクト

  //5. 読み込みが完了した際のイベントハンドラ。imgのsrcにデータをセット
  fileReader.onload = function(event) {
    //読み込んだデータをimgに設定
    $img.attr('src', event.target.result).show();
    // 削除ボタン表示
    deletebtnshow();
  };
  
  // 6. 画像読み込み
  fileReader.readAsDataURL(file);

});

//削除ボタン表示関数
let deletebtnshow = function () {
  let $imgs = $('.js-prev__img');

  for (let i = 0; i < $imgs.length; i++){
    if ($($imgs[i]).attr('src') !== '/storage/') {
      $($imgs[i]).parents('.js-image-parents').find('.js-imgModal-open').show();
    } else {
      $($imgs[i]).parents('.js-image-parents').find('.js-imgModal-open').hide();
    }
  }
}
//読み込み時に削除ボタンを表示される
deletebtnshow();

let $profileFileInput = $('.js-input__file--profile');

//プロフィール画像プレビュー
$profileFileInput.on('change', function () {
  
  let file = this.files[0],         // 2 file配列にファイルが入ってます
  $img = $('#js-profile__img'), // 3 jQueryのsiblingsメソッドで兄弟のimg取得
  fileReader = new FileReader();  // 4 ファイルを読み込むFileReaderオブジェクト
  
  //      5. 読み込みが完了した際のイベントハンドラ。imgのsrcにデータをセット
  fileReader.onload = function(event) {
    //        読み込んだデータをimgに設定
    $img.attr('src', event.target.result).show();
  };
  
  //       6. 画像読み込み
  fileReader.readAsDataURL(file);
  
});

//削除処理
$deletebtn.on('click',function () {
    $('.js-prev__img').attr('src', '').show();
})