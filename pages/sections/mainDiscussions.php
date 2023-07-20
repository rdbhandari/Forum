<!-- SECTION :: QUESTION DISPLAYING -->
<div class="container " >
  <?php
  $query = mysqli_query($connection, "SELECT question_tittle , question_description FROM questions WHERE question_id = '" . $question_id . "'");
  $query_result = mysqli_fetch_assoc($query);

  echo ('<div class="jumbotron jumbotron-fluid bg_banner rounded">
    <div class="container">
      <h1 class="display-4">' . $query_result['question_tittle'] . '</h1>
      <p class="lead">' . $query_result['question_description'] . '</p>
    </div>
  </div>');
  ?>
</div>

<h1 class="text-center text-light">SOLUTIONS</h1>
<!-- SECTION :: MAKE ANSWER -->
<div class="container">
  <?php
    if (isset($_SESSION['login']) && $_SESSION['login'] == true){
      echo('
      <p class="text-right">    
        <button class="btn btn-primary" type="button" id="btnGiveAnswer" data-toggle="collapse" data-target="#giveAnswerCollapse" aria-expanded="false" aria-controls="giveAnswerCollapse">
          Give Answer
        </button>
      </p>
      <div class="collapse " id="giveAnswerCollapse">
        <div class="card card-body px-5">
          <h4 class="text-center">Your Answer</h4>
          <form id="giveAnswerForm" action="'); /*echo htmlentities("/Projects/mP1_Forum/partials/_actionAskQuestion.php");*/ echo('" method="POST">
            <div class=" form-group">
              <label class=" font-weight-bold">Description</label>
              <textarea class="form-control mb-3" name="answer_description" id="exampleFormControlTextarea1" rows="3" required maxlength="1000"></textarea>
            </div>
            <button type="submit" id="btnSubmitAnswer" class="btn btn-primary">Post</button>
          </form>
        </div>
      </div>
      ');
    }else{
      echo('
      <p class="text-right">    
        <button class="btn btn-primary" type="button" id="btnGiveAnswer" onclick="showAlert()">
        Give Answer
        </button>
      </p>
      ');
    }
  ?>
</div>


<!-- SECTION :: LIST OF SOLUTIONS-->
<div class="container" id="answerList">
  <?php
  $query = mysqli_query($connection, "SELECT answer_id, user_name , answer_description , answer_time FROM answers WHERE question_id = '" . $question_id . "'");

  // echo mysqli_error($connection);

  while ($query_result = mysqli_fetch_assoc($query)) {
    echo ('<div class="media border border-success rounded  my-1 text-success">
              <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" class="m-2 rounded-circle" alt="..." width="50px">
              <div class="media-body">
                <h5 class="mt-0 d-inline text-info">' . $query_result['user_name'] . '</h5> <small> at ' . $query_result['answer_time'] . '</small>
                <p class="ml-3 text-muted">' . $query_result['answer_description'] . '</p>
              </div>
          </div>');
  }
  ?>
</div>