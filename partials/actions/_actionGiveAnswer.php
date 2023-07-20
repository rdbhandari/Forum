<?php session_start(); ?>
<?php include_once ($_SERVER['DOCUMENT_ROOT']."/partials/_dbconnection.php") ?>
<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['login'])) {
    $username = $_SESSION['username'];
    $answer_description = filter_var ( $_POST['answer_description'], FILTER_SANITIZE_STRING);
    $question_id = $_POST['question_id'];

    $query = mysqli_query($connection, "INSERT INTO answers VALUES ( NULL, '$question_id', '$username', '$answer_description',current_timestamp() ) ");
    echo mysqli_error($connection);
    if ($query) {
      echo ('Your Answer Has Been Submitted');
    } else {
      echo ('Failed To Submit Your Answer');
    }
  }

?>