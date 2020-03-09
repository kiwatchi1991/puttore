
//レッスンの追加ボタンを押した時
let $button = $('.c-addLesson__button');
$button.on('click', function (e) {
    e.preventDefault();

    //レッスンのコピー
    let $copyTaget = $('.js-add__target:last-child');
    $copyTaget.clone().appendTo('#js-lesson__section');

    let $newCopyTaget = $('.js-add__target:last-child');
    $newCopyTaget.find('input[type="hidden"]').remove();
    $newCopyTaget.find('#input').empty();
    $newCopyTaget.find('textarea').empty();

    //load()でnumberの振り直し
    load();

    let dom =  document.getElementsByClassName('js-toggleTab');
    for(var i=0; i<dom.length; i++ ){
        dom[i].addEventListener('click',function(){
        let btn = $(this);
        toggleTab(btn);
    });
}
});

//初期読み込み時、レッスンにnumber付与
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

//初期読み込み時、レッスン付与
window.onload = load();


//タブ切り替え処理
let $head = $('.js-toggleTab');
let $block = $('.js-lesson__block');
var toggleTab = function (e) {

    console.log('e');
    console.log(e);
    console.log($(e));
    
    let $parent1 = $(e).parents('.js-productNew__lesson');//logよう
    let $parent2 = $(e).parents('.js-productNew__lesson');//logよう
    let $areaInput = $(e).parents('.js-productNew__lesson').find('.js-lesson__block--input');
    let $areaPreview = $(e).parents('.js-productNew__lesson').find('.js-lesson__block--preview');
    
    console.log('parent1');
    console.log($parent1);
    console.log('parent2');
    console.log($parent2);
    console.log('$areaInput');
    console.log($areaInput);
    console.log('$areaPreview');
    console.log($areaPreview);
    
    let target = $(e).attr('data-status');
    $head.removeClass('active');
    $block.removeClass('active');
    $areaInput.removeClass('active');
    $areaPreview.removeClass('active');
    $('.js-toggleTab__input').removeClass('active');
    $('.js-toggleTab__preview').removeClass('active');
    
    console.log('target');
    console.log(target);

    switch (target) {
        case 'input':
        $('.js-toggleTab__preview').addClass('active');
        $areaInput.addClass('active');
        break;
        
        case 'preview':
        $('.js-toggleTab__input').addClass('active');
        $areaPreview.addClass('active');
        break;
     }
};

$head.on('click', function(){
    let btn = $(this);
    toggleTab(btn);
});