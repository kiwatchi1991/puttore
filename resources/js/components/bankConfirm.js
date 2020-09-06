//======================================================
// 出品するボタンを押したとき、銀行情報があるかいかを確認する
//======================================================
$(document).on('click', '#js-bank_confirm', function (e) {

    e.preventDefault();
    const msg = this.id === 'js-bank_confirm'
        ? '出品するためには、売上金の振込先である銀行情報等を登録していただく必要がございます。登録ページに遷移します。'
        : '売上金の振込先である銀行情報等が登録されておりません。登録ページに遷移します。'

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/ajaxbankconfirm',
        type: 'get',
        dataType: 'json',
    })
        // Ajaxリクエストが成功した場合
        .done(function (data) {
            if (data[0] === false) {
                location.href = "/login";
            }else if (data[1] === true) {
                location.href = "/products/new";
            } else if (data[1] === false) {
                const result = window.confirm(msg);
                result && (location.href = "/mypage/edit");
            }
        })
        // Ajaxリクエストが失敗した場合
        .fail(function (data) {
            const result = window.confirm(msg);
            result && (location.href = "/mypage/edit");
        });
});
