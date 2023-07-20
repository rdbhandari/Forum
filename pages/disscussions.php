<!-- SECTION :: PAGE VERIFICATION -->
<?php
  include_once ($_SERVER['DOCUMENT_ROOT']."/partials/_dbconnection.php");
  $question_id = '';
  if (!empty($_GET['question_id'])) {
    $question_id = $_GET['question_id'];
    $query = mysqli_query($connection , "SELECT question_id FROM questions WHERE question_id = '$question_id'");
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
          <?php include $_SERVER['DOCUMENT_ROOT']."/pages/sections/mainDiscussions.php"?>
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
  function showAlert(){
    alert('Please Sign In To Make Answer..');
  }

  $('#giveAnswerForm').on('submit', function (e){
    e.preventDefault();
    document.getElementById("btnSubmitAnswer").innerHTML = "Please Wait...";
    document.getElementById("btnSubmitAnswer").disabled = true;
    var data1 = $('#giveAnswerForm').serialize();
    data1 = data1.concat("<?php echo '&question_id='.$question_id ?>");
    $.ajax({
      url: "/partials/actions/_actionGiveAnswer.php",
      type: 'POST',
      data: data1,
      success: function (result){
        alert(result);
        document.getElementById("btnSubmitAnswer").innerHTML = "Sumbit";
        document.getElementById("btnSubmitAnswer").disabled = false;
        document.getElementById("giveAnswerForm").reset();
        $('#giveAnswerCollapse').collapse('hide');
        $('#answerList').load(' #answerList');

        // window.location.reload();
      }
    })
  })

  updateAnswer();
  setInterval( function(){
    updateAnswer()
      } , 60000);
  function updateAnswer (){
    $('#answerList').load(' #answerList');
  };
</script>
<?php include $_SERVER['DOCUMENT_ROOT']."/partials/_footer.php" ?>