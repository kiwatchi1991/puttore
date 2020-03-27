// ==================================
// 入力項目のフロントバリデーション
// ==================================


//入力項目の検証ルール定義
let rules = {
    name: {required: true},
    'lang[]': {
        required: true, //必須項目にする
        minlength: 1 //2つのチェックが必要
    },
    'lessons[0][title]': {required: true},//必須項目にする
    detail: {required: true},
    default_price: {required: true},
    skills: {required: true},
};

//入力項目ごとのエラーメッセージ定義
var messages = {
    name: {
    required: 'タイトルを入力してください',
    },
    'lang[]': {
    required: '言語を選択してください',
    },
    'lessons[0][title]': {
    required: 'レッスンタイトルを入力してください',
    },
    detail: {
    required: '説明を入力してください'
    },
    default_price: {
    required: '価格を入力してください'
    },
    skills: {
    required: '価格を入力してください'
    },
};
$(function(){
    $('#form-product').validate({
    rules: rules,
    messages: messages
    });
});
//     window.onbeforeunload = function(e) {
//       e.preventDefault();
//       return '';
//   };