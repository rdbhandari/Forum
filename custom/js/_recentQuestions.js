recentQuestions();
setInterval( function(){
     recentQuestions()
    } , 60000);
function recentQuestions (){
    $.ajax({
        url: '/partials/actions/_recentQuestions.php',
        method: "POST",
        dataType: "text",
        success: function (output){
            $('#recentQuestions').html(output);
        }
    })
};