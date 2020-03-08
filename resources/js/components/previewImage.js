let $dropArea = $('.js-area__drop');
let $fileInput = $('.c-input__file');
let $deletebtn = $('.c-delete__file')
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
$fileInput.on('change', function () {
    console.log('changeイベントはっせい！');
  $dropArea.css('border', 'none');
  let file = this.files[0],         // 2 file配列にファイルが入ってます
      $img = $(this).siblings('.c-prev__img'), // 3 jQueryのsiblingsメソッドで兄弟のimg取得
      fileReader = new FileReader();  // 4 ファイルを読み込むFileReaderオブジェクト
  
//      5. 読み込みが完了した際のイベントハンドラ。imgのsrcにデータをセット
  fileReader.onload = function(event) {
//        読み込んだデータをimgに設定
    $img.attr('src', event.target.result).show();
  };
  
//       6. 画像読み込み
  fileReader.readAsDataURL(file);
  
});

$deletebtn.on('click',function () {
    $('.c-prev__img').attr('src', '').show();
})