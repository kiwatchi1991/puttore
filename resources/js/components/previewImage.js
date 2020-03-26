let $dropArea = $('.js-area__drop');
let $productFileInput = $('.js-input__file--product');
let $deletebtn = $('.js-delete__file');
$dropArea.on('dragover', function(e){
  e.stopPropagation();
  e.preventDefault();
  $(this).css('border', '3px #ccc dashed');
});
$dropArea.on('dragleave', function(e){
  e.stopPropagation();
  e.preventDefault();
  $(this).css('border', 'none');
});


// プロダクト登録プレビュー
$productFileInput.on('change', function () {
  $dropArea.css('border', 'none');
  let file = this.files[0],         // 2 file配列にファイルが入ってます
      $img = $(this).siblings('.js-prev__img'), // 3 jQueryのsiblingsメソッドで兄弟のimg取得
      fileReader = new FileReader();  // 4 ファイルを読み込むFileReaderオブジェクト
  
      //5. 読み込みが完了した際のイベントハンドラ。imgのsrcにデータをセット
      fileReader.onload = function(event) {
        //読み込んだデータをimgに設定
        $img.attr('src', event.target.result).show();
      };
      
      // 6. 画像読み込み
      fileReader.readAsDataURL(file);
    });
    
    
    
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