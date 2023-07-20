<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/partials/_dbconnection.php") ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $output = "";

    $data = $_POST['searchData'];
    if($data != ""){
        //questions
        $query = mysqli_query($connection, "SELECT question_id , question_tittle FROM questions WHERE question_tittle LIKE '%{$data}%' LIMIT 3");
        
        if (mysqli_num_rows($query)  > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $output .= '<a href="/pages/disscussions.php?question_id='.$row['question_id'].'" class="list-group-item list-group-item-action border-1">' . $row['question_tittle'] . '</a>';
            }
        }else{
            $output .= 'No Records Found';
        }


    }
    echo $output;
}
?>

