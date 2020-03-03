// 


const marked = require('marked');



$('#lesson').keyup(function () {
    var html = marked($(this).val());
    $('#preview').html(html);
});

