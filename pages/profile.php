<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(!isset($_SESSION)){
        header("location: /");
        exit();
    }
?>

<?php include $_SERVER['DOCUMENT_ROOT']."/partials/_header.php" ?>
<div class="container text-center">
    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" class="m-2 rounded-circle" alt="..." width="200px">
    <h1 class="text-center text-light"><?php echo $_SESSION['username'] ?></h1>

</div>

<?php include $_SERVER['DOCUMENT_ROOT']."/partials/_includeJS.php" ?>

<?php include $_SERVER['DOCUMENT_ROOT']."/partials/_footer.php" ?>
