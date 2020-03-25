console.log('ばりデート読み込み！');
//入力項目の検証ルール定義
var rules = {
name: {required: true},
// num: "phone",
// address: {required: true, email: true},
// gender: {required: true}
};

//入力項目ごとのエラーメッセージ定義
var messages = {
name: {
required: '*名前を入力してください'
},
// address: {
// required: "*メアドを入力してください"
// },
// gender: {
// required: "*性別を選択してください"
// }
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