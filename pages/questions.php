<!-- SECTION :: PAGE VERIFICATION  -->
<?php
  include_once ($_SERVER['DOCUMENT_ROOT']."/partials/_dbconnection.php");
  $category_id = '';
  if (!empty($_GET['category_id'])) {
    $category_id = $_GET['category_id'];

    $query = mysqli_query($connection , "SELECT category_id FROM categories WHERE category_id = '$category_id'");
    if(mysqli_num_rows($query) == 0){ 
      header("location: /");
      exit();
    }
  }else{
    header("location: /");
    exit();
  }
?>
<?php include $_SERVER['DOCUMENT_ROOT']."/partials/_header.php" ?>


<div class="container">
    <div class="row">
        <!-- RIGHT SIDE -->
        <div class="col-md-9 mt-2">
          <?php include $_SERVER['DOCUMENT_ROOT']."/pages/sections/mainQuestions.php"?>
        </div>
        <!-- RIGHT SIDE-->
        <div class="col-md-3">
            <div class="row">
                <!-- RIGHT SIDE 1-->
                <div class="col-md-12 bg-info border-left border-dark p-3 mt-2 rounded bg_0">
                  <h4 class="text-center">RECENT QUESTIONS</h4>
                    <div class="list-group" id="recentQuestions"></div>
                </div>
                <!-- RIGHT SIDE 2-->
                <!-- <div class="col-md-12 bg-primary border-left border-dark p-3 mt-2 rounded bg_0">
                    <?php include $_SERVER['DOCUMENT_ROOT']."/construction/lorem50.php" ?>
                </div> -->
            </div>
        </div>
    </div>
</div>



<?php include $_SERVER['DOCUMENT_ROOT']."/partials/_includeJS.php" ?>
<script src="/custom/js/_recentQuestions.js"></script>
<script>
  // $(document).ready(function () {   
  
  function showAlert(){
    alert('Please Sign In To Ask a Question..');
  }

  $('#askQuestionForm').on('submit', function (e){
    e.preventDefault();
    document.getElementById("btnSubmitQuestion").innerHTML = "Please Wait...";
    document.getElementById("btnSubmitQuestion").disabled = true;
    var data1 = $('#askQuestionForm').serialize();
    data1 = data1.concat("<?php echo '&category_id='.$category_id ?>");
    $.ajax({
      url: "/partials/actions/_actionAskQuestion.php",
      type: 'POST',
      data: data1,
      success: function (result){
        document.getElementById("btnSubmitQuestion").innerHTML = "Submit";
        document.getElementById("btnSubmitQuestion").disabled = false;
        document.getElementById("askQuestionForm").reset();
        $('#askQuestionModal').collapse('hide');
        $('#questionList').load(' #questionList');
        recentQuestions();
        alert(result);

        // window.location.reload();
      }
    })
  })

  updateQuestion();
  setInterval( function(){
    updateQuestion()
      } , 60000);
  function updateQuestion (){
    $('#questionList').load(' #questionList');
  };
// })
</script>

<?php include $_SERVER['DOCUMENT_ROOT']."/partials/_footer.php" ?>