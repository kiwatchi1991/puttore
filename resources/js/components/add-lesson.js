let $button = $('.c-addLesson__button');

$(function () {
    $button.on('click', function (e) {
        e.preventDefault();
        let $copyTaget = $('.c-lesson__block:last-child');
        $copyTaget.clone().appendTo('#c-lesson__section');

        let $countUpTarget = $('.c-lesson__block:last-child input[data-input="target"]');
        let count = $countUpTarget.prop('value');
        console.log(typeof count);
        count = Number(count) + 1;
        // count = count++;
        $countUpTarget.prop('value', count);

        // val.val(val++);
        // let valAfter = val++;
        console.log(typeof count);
        console.log(count);
    })
});
