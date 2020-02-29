let $button = $('.c-addLesson__button');

    //レッスンの追加ボタンを押した時の
    $button.on('click', function (e) {
        e.preventDefault();
    
        //レッスンのコピー
        let $copyTaget = $('.js-add__target:last-child');
        $copyTaget.clone().appendTo('#js-lesson__section');
        
        let $newCopyTaget = $('.js-add__target:last-child');
        $newCopyTaget.find('input[type="hidden"]').remove();

        load();
    })

    
    let load = function () {
        console.log('window.load!!!');
        
        let count = 0;
        let count1 = 1;
        $('.js-add__target').each(function(){

        console.log(typeof count);
        console.log(typeof count1);
        console.log(count);
        console.log(count1);
        // $(this).prop('value',count);
        //コピー後のそれぞれのinput要素DOMを定義
        let $targetHidden = $('#hidden',this);
        let $targetNumber = $('#number',this);
        let $targetTitle = $('#title',this);
        let $targetLesson = $('#lesson',this);

        //カウントアップした数字をそれぞれのinputタグのname属性にセット
        $targetHidden.prop('name','lessons[' + count + '][id]');
        $targetNumber.prop('name','lessons[' + count + '][number]').val(count1);
        $targetTitle.prop('name','lessons[' + count + '][title]');
        $targetLesson.prop('name','lessons[' + count + '][lesson]');

        count += 1;
        count1 += 1;
        
    })
};
window.onload = load();

$(document).ready(function(){
    $('.c-image__preview ul').slick({
        infinite: true, //スライドのループ有効化
        dots:true, //ドットのナビゲーションを表示
        centerMode: true, //要素を中央寄せ
        centerPadding:'10%', //両サイドの見えている部分のサイズ
    });
  });