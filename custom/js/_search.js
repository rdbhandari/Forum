document.getElementById('searchBox').onkeyup = function(){
    $searchData = this.value;
    if($searchData == ""){
        $('#searchList').html("");
    }
    $.ajax({
        url: '/partials/actions/_search.php',
        method: "POST",
        data: {searchData: this.value},
        dataType: "text",
        success: function (output){
            $('#searchList').html(output);
        }
    })
}