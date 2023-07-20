<!-- SECTION :: CATEGORY DISPLAYING -->
<div class="container ">
  <?php
  $query = mysqli_query($connection, "SELECT category_name , category_description FROM categories WHERE category_id = '".$category_id."'");
  $query_result = mysqli_fetch_assoc($query);

  echo ('<div class="jumbotron jumbotron-fluid bg_banner rounded">
    <div class="container">
      <h1 class="display-4">' . $query_result['category_name'] . '</h1>
      <p class="lead">' . $query_result['category_description'] . '</p>
    </div>
  </div>');
  ?>
</div>

<h1 class="text-center text-info">QUESTIONS</h1>
<!-- SECTION :: ASK QUESTION -->
<div class="container">
  <?php
    if (isset($_SESSION['login']) && $_SESSION['login'] == true){
      echo('
      <p class="text-right">    
        <button class="btn btn-primary" type="button" id="btnAskQuestion" data-toggle="collapse" data-target="#askQuestionModal" aria-expanded="false" aria-controls="askQuestionModal">
          Ask a Question
        </button>
      </p>
      <div class="collapse" id="askQuestionModal">
        <div class="card card-body px-5">
          <h4 class="text-center">Your Question</h4>
          <form id="askQuestionForm" action="'); /*echo htmlentities("/Projects/mP1_Forum/partials/_actionAskQuestion.php");*/ echo('" method="POST">
            <div class="form-group">
              <label class="font-weight-bold">Question Tittle</label>
              <input type="text" name="question_tittle" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" maxlength="100"">
            </div>

            <div class=" form-group">
              <label class=" font-weight-bold">Problem Description</label>
              <textarea class="form-control mb-3" name="question_description" id="exampleFormControlTextarea1" rows="3" required maxlength="1000"></textarea>
            </div>
            <button type="submit" id="btnSubmitQuestion" class="btn btn-primary">Post</button>
          </form>
        </div>
      </div>
      ');
    }else{
      echo('
      <p class="text-right">    
        <button class="btn btn-primary" type="button" id="askQuestion" onclick="showAlert()">
          Ask a Question
        </button>
      </p>
      ');
    }
  ?>
</div>


<!-- SECTION :: LIST OF PROBLEMS-->
<div class="container" id="questionList">
  <?php
  $query = mysqli_query($connection, "SELECT question_id, user_name , question_tittle , question_description , question_time FROM questions WHERE category_id = '" . $category_id . "'");

  // echo mysqli_error($connection);

  while ($query_result = mysqli_fetch_assoc($query)) {
    echo ('<div id="'. $query_result['question_id'] .'" class="container border border-light rounded my-1 text-success">
        <a href="/pages/disscussions.php?question_id=' . $query_result['question_id'] . '"class="text-decoration-none">
            <h4 class="d-inline">' . $query_result['question_tittle'] . '</h4>
        </a>
        <small>(Posted By : ' . $query_result['user_name'] . ' at ' . $query_result['question_time'] . ')</small>
        <p class="text-muted ml-3 ">' . substr($query_result['question_description'], 0, 100) . '...</p>
    </div>');
  }
  ?>
</div>