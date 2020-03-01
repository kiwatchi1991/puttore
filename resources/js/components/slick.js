$(document).ready(function(){
    $('.c-image__preview ul').slick({
        infinite: true, //スライドのループ有効化
        dots:true, //ドットのナビゲーションを表示
        centerMode: true, //要素を中央寄せ
        centerPadding:'10%', //両サイドの見えている部分のサイズ
    });
  });