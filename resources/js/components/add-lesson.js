//=========================================
//=======    レッスン削除イベント
//=========================================
$(document).on('click', '.js-deleteIcon', function () {
    let $that = $(this);
    //削除対象のDOM
    let $deleteTarget = $that.parents('.js-add__target');
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
                    data: { 'lessonId': deleteTargetId },
                })
                // Ajaxリクエストが成功した場合
                .done(function () {
                })
                // Ajaxリクエストが失敗した場合
                .fail(function (data) {
                });
            }
            //レッスンを画面から削除
            $deleteTarget.remove();
        } else {
            //処理をしない
        }
    }
    load();
});

// =============================================
// ======   レッスンへの画像登録イベント      =======
// =============================================
$(document).on('change', '.js-lessonUploadImg', function () {
    
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
            //現在のカーソル位置を特定し、そこに画像を挿入する
            let textarea = $tgt.parents('.js-productNew__lesson').find('.js-marked__textarea');
            
            let sentence = textarea.val();
            let len      = sentence.length;
            let pos = textarea.prop('selectionStart');
            
            let before   = sentence.substr(0, pos);
            let word     = '\n\n![代替テキスト](/storage/' + data + ')\n\n';
            let after    = sentence.substr(pos, len);

            sentence = before + word + after;
            textarea.val(sentence);
            
            textarea.trigger('keyup'); //keyupイベントを強制的に発生させて、プレビューできるようにする
            
        })
        // Ajaxリクエストが失敗した場合
        .fail(function (data) {
            let status = data.status;
            let errMessage;
                
            switch (status) {
                case 413:
                    errMessage = 'アップロード上限は2MBです';
                    break;
                case 422:
                    errMessage = 'アップロードできるのは画像のみです';
                    break;
                default:
                    errMessage = 'アップロードに失敗しました。もう一度やり直してください';
            }
            
            alert(errMessage);
        })
});

// ===============================================
// ==============    レッスンの追加ボタンを押した時
// ===============================================
let $button = $('.js-addLesson__button');
// $(document).on('click', '.js-addLesson__button', function (e) {
$button.on('click', function (e) {
    e.preventDefault();
    //レッスンのコピー
    let $copyTaget = $('.js-add__target:last-child');
    $copyTaget.clone().appendTo('#js-lesson__section');
    
    let $newCopyTaget = $('.js-add__target:last-child');
    //エラーメッセージ削除
    $newCopyTaget.find('#title-error').remove();
    $newCopyTaget.find('#lesson-error').remove();
    
    $newCopyTaget.find('#hidden').remove();
    $newCopyTaget.find('#title').val('');
    $newCopyTaget.find('textarea').val('');
    $newCopyTaget.find('#preview').html('');
    
    //初期表示をプレビューではなく入力に
    $newCopyTaget.find('.js-lesson__block--input').removeClass('active');
    $newCopyTaget.find('.js-lesson__block--preview').removeClass('active');
    $newCopyTaget.find('.js-toggleTab__preview').removeClass('active');
    $newCopyTaget.find('.js-toggleTab__input').removeClass('active');

    $newCopyTaget.find('.js-lesson__block--input').addClass('active');
    $newCopyTaget.find('.js-toggleTab__preview').addClass('active');

    //load()でnumberの振り直し
    load();
});



//===========================================
//==========    レッスンへのnumber付与
//===========================================

let load = function () {

let count = 0;
let count1 = 1;
$('.js-add__target').each(function () {

    //コピー後のそれぞれのinput要素DOMを定義
    let $targetHidden = $('#hidden', this);
    let $targetNumber = $('#number', this);
    let $targetLessonNum = $('#lesson_num', this);
    let $targetTitle = $('#title', this);
    let $targetLesson = $('#lesson', this);
    let $imgInputlabel = $('.js-imgInputlabel', this);
    let $imgUploadInput = $('.js-lessonUploadImg', this);

    //カウントアップした数字をそれぞれのinputタグのname属性にセット
    $targetHidden.prop('name', 'lessons[' + count + '][id]');
    $targetNumber.prop('name', 'lessons[' + count + '][number]').val(count1);
    $targetLessonNum.html(count1);
    $targetTitle.prop('name', 'lessons[' + count + '][title]');
    $targetLesson.prop('name', 'lessons[' + count + '][lesson]');
    $imgInputlabel.prop('for', 'uploadimg[' + count + ']');
    $imgUploadInput.prop('id', 'uploadimg[' + count + ']');

    count += 1;
    count1 += 1;

})
};

//初期読み込み時、レッスン付与
window.onload = load();

//============================================
//=============     タブ切り替え処理
//============================================
$(document).on('click', '.js-toggleTab', function () {

    let $that = $(this);
    let $areaInput = $that.parents('.js-productNew__lesson').find('.js-lesson__block--input');
    let $areaPreview = $that.parents('.js-productNew__lesson').find('.js-lesson__block--preview');
    let $iconPreview = $that.parents('.js-productNew__lesson').find('.js-toggleTab__preview');
    let $iconEdit = $that.parents('.js-productNew__lesson').find('.js-toggleTab__input');
    
    let target = $that.attr('data-status');
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
});
