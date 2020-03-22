//レッスン削除ボタンを押したとき

let deleteLesson = function (e) {

    //削除対象のDOM
    let $deleteTarget = $(e).parents('.js-add__target');
    //レッスンの数
    let lessonsCount = $('.js-add__target').length;
    
    if (lessonsCount === 1) {
        alert('現在レッスンは一つなので削除することはできません')
    } else {
        let confirm_result = window.confirm('レッスンを削除します。元に戻せなくなりますが、本当によろしいですか？');
        if (confirm_result) {
            //DBにすでにあるものだったら、DBから削除
            let $deleteTargetData = $deleteTarget.find('#hidden');
            let deleteTargetId = $deleteTargetData.val();
            if ($deleteTargetData) {
                 $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '/products/ajaxLessonDelete',
                    type: 'POST',
                    dataType: 'json',
                    data:{ 'lessonId':deleteTargetId},
                        })
                        // Ajaxリクエストが成功した場合
                        .done(function () {
                            console.log('ここまで4');
                    })
                    // Ajaxリクエストが失敗した場合
                    .fail(function (data) {
                        console.log('エラー');
                        console.log(data);
                    });
            }

            //レッスンを画面から削除
            $deleteTarget.remove();

        } else {
            //処理をしない
        }
    }

    load();
}
// =============================================
// ======   レッスンへの画像登録イベント      =======
// =============================================
$(document).on('change', '.js-lessonUploadImg', function (e) {
    
    //   option.on('change',function(){
    console.log('画像を挿入ボタンクリック！！！ajax処理開始');
    console.log('ここまで1');
    console.log('this');
    console.log(this);
    console.log($(this));
    let $tgt = $(this);

    let file = this.files[0];
    let formData = new FormData();
    formData.append('file', file);
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/products/imgupload',
        type: 'POST',
        dataType: 'json',
        processData: false,
        contentType: false,
        data: formData,
    })
        // Ajaxリクエストが成功した場合
        .done(function (data) {
            let target = $tgt.parents('.js-productNew__lesson').find('.js-marked__textarea');
            console.log('e')
            console.log($(e))
            console.log('e.parents')
            console.log($(e).parents('.js-productNew__lesson'))
            console.log('$(e).parents.find')
            console.log($(e).parents('.js-productNew__lesson').find('.js-marked__textarea'))
            console.log('target')
            // console.log(target)
            target.val(target.val() + '\n\n![代替テキスト](/storage/' + data + ')\n\n');
            target.trigger('keyup'); //keyupイベントを強制的に発生させて、プレビューできるようにする

        })
        // Ajaxリクエストが失敗した場合
        .fail(function (data) {
            console.log('エラー');
            console.log(data);
        })
    // })
});

// ====================================
//レッスンの追加ボタンを押した時
// ====================================
let $button = $('.js-addLesson__button');
$button.on('click', function (e) {
    e.preventDefault();
    console.log('レッスン追加イベント');
    //レッスンのコピー
    let $copyTaget = $('.js-add__target:last-child');
    $copyTaget.clone().appendTo('#js-lesson__section');

    let $newCopyTaget = $('.js-add__target:last-child');
    // $newCopyTaget.find('textarea').trigger('keyup');
    $newCopyTaget.find('textarea').val('').keyup();
    
    // let $lessonUploadImgTarget = $newCopyTaget.find('.js-lessonUploadImg');
    // console.log('$lessonUploadImgTarget');
    // console.log($lessonUploadImgTarget[0]);

    //load()でnumberの振り直し
    load();
    setToggleEvent();
    // setMarkedEvent();
    setDeleteLessonEvent();
    // setLessonUploadImg($lessonUploadImgTarget[0]);
});

//========  クリックでレッスン削除イベントを再付与
let setDeleteLessonEvent = function () {
    let deleteBtn = document.getElementsByClassName('js-deleteIcon');
    for (let i = 0; i < deleteBtn.length; i++){
        deleteBtn[i].addEventListener('click', function () {
            let btn = $(this);
            deleteLesson(btn);
        })
    }
}

//======  クリックでタブ切り替えするイベントを再付与
let setToggleEvent = function () {
    let dom =  document.getElementsByClassName('js-toggleTab');
    for(let i=0; i<dom.length; i++ ){
        dom[i].addEventListener('click',function(){
            let btn = $(this);
            toggleTab(btn);      
        });
    }
}

const marked = require('marked');
$(document).on('keyup', '.js-marked__textarea', function (e) {
    // let $targetArea = $('.js-marked__textarea', this);
    console.log('this');
    console.log(this);
    console.log('e');
    console.log(e);
    console.log($(e));
    var html = marked($(this).val());
    $(this).parents('.js-productNew__lesson').find('.js-lesson__block--preview').html(html);
});

//初期表示でレッスン削除イベント付与
$('.js-deleteIcon').on('click', function () {
    let btn = $(this);
    deleteLesson(btn);
})

//初期読み込み時、レッスンにnumber付与
let load = function () {

    let count = 0;
    let count1 = 1;
    $('.js-add__target').each(function(){

    //コピー後のそれぞれのinput要素DOMを定義
    let $targetHidden = $('#hidden',this);
    let $targetNumber = $('#number',this);
    let $targetLessonNum = $('#lesson_num',this);
    let $targetTitle = $('#title',this);
    let $targetLesson = $('#lesson', this);
    let $imgInputlabel = $('.js-imgInputlabel', this);
    let $imgUploadInput = $('.js-lessonUploadImg', this);

    //カウントアップした数字をそれぞれのinputタグのname属性にセット
    $targetHidden.prop('name','lessons[' + count + '][id]');
    $targetNumber.prop('name','lessons[' + count + '][number]').val(count1);
    $targetLessonNum.html(count1);
    $targetTitle.prop('name','lessons[' + count + '][title]');
    $targetLesson.prop('name', 'lessons[' + count + '][lesson]');
    $imgInputlabel.prop('for', 'uploadimg[' + count + ']');
    $imgUploadInput.prop('id', 'uploadimg[' + count + ']');

    count += 1;
    count1 += 1;

    })
};

//初期読み込み時、レッスン付与
window.onload = load();


//タブ切り替え処理
let $head = $('.js-toggleTab');
var toggleTab = function (e) {

    let $areaInput = $(e).parents('.js-productNew__lesson').find('.js-lesson__block--input');
    let $areaPreview = $(e).parents('.js-productNew__lesson').find('.js-lesson__block--preview');
    let $iconPreview = $(e).parents('.js-productNew__lesson').find('.js-toggleTab__preview');
    let $iconEdit = $(e).parents('.js-productNew__lesson').find('.js-toggleTab__input');
    
    let target = $(e).attr('data-status');
    $areaInput.removeClass('active');
    $areaPreview.removeClass('active');
    $iconEdit.removeClass('active');
    $iconPreview.removeClass('active');

    switch (target) {
        case 'input':
        $iconPreview.addClass('active');
        $areaInput.addClass('active');
        break;
        
        case 'preview':
        $iconEdit.addClass('active');
        $areaPreview.addClass('active');
        break;
     }
};

$head.on('click', function(){
    let btn = $(this);
    toggleTab(btn);
});
