<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/partials/_dbconnection.php");
 $query = mysqli_query($connection , "SELECT  question_id , question_tittle , question_description FROM questions ORDER BY question_time DESC LIMIT 5");
 $output = '';
 while ($row = mysqli_fetch_assoc($query)) {
    $output .=
        '<a href="/pages/disscussions.php?question_id='.$row['question_id'].'" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
                <small class="mb-1 font-weight-bold">'.substr($row['question_tittle'], 0, 150).'</small>
            </div>
            <small class="mb-1">'.substr($row['question_description'], 0, 200).'</small>
        </a>';
}
echo $output;
?>