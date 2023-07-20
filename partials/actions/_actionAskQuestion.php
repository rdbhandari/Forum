<?php
  session_start();
  include_once ($_SERVER['DOCUMENT_ROOT']."/partials/_dbconnection.php");
?>
<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['login'])) {
    $username = $_SESSION['username'];
    $question_tittle = filter_var ( $_POST['question_tittle'], FILTER_SANITIZE_STRING);
    $question_description = filter_var ( $_POST['question_description'], FILTER_SANITIZE_STRING);
    $category_id = $_POST['category_id'];

    $query = mysqli_query($connection, "INSERT INTO questions VALUES (NULL, '$category_id', '$username', '$question_tittle', '$question_description',current_timestamp())");
    // echo mysqli_error($connection);

    if ($query) {
      echo ('Question Has Been Submitted');
    } else {
      echo ('Failed To Submit Your Question !!');
    }
  }

?>