let $dropArea = $('.js-area__drop');
let $fileInput = $('.js-input__file');
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
$fileInput.on('change', function () {
  console.log('changeイベントはっせい！');
  
  
  $dropArea.css('border', 'none');
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
  
    // 初期設定
	var options =
	{
	aspectRatio: 1 / 1,
	viewMode:1,
	crop: function(e) {
		var cropData = $('#js-profile__img').cropper('getData');
	$('#upload-image-x').val(Math.floor(cropData.x));
	$('#upload-image-y').val(Math.floor(cropData.y));
	$('#upload-image-w').val(Math.floor(cropData.width));
	$('#upload-image-h').val(Math.floor(cropData.height));
		},
		zoomable:false,
		minCropBoxWidth:162,
		minCropBoxHeight:162
	}

        // 初期設定をセットする
	$('#js-profile__img').cropper(options);
	$('#js-profile__img').cropper('replace',URL.createObjectURL(this.files[0]));


  //画像トリミング
  // $('#js-profile__img').cropper({
  //   aspectRatio: 1 / 1
  // });
  
});

//削除処理
$deletebtn.on('click',function () {
    $('.js-prev__img').attr('src', '').show();
})

// const cropper = require('cropper');
