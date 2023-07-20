<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once($_SERVER['DOCUMENT_ROOT'] . "/partials/_dbconnection.php");
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="/custom/css/customCSS.css">
    <title>Forum</title>
</head>

<body class="bg_body">
    <!-- N A V B A R  -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <a class="navbar-brand" href="/">Forum</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <?php
              if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
                  echo('
             <div class="row mx-1">
                <input class="form-control col-7" id="searchBox" type="search" placeholder="Search" autocomplete="off" aria-label="Search" name="searchData">
                <div class="btn-group col-5" role="group" aria-label="Button group with nested dropdown">
                    <button class="btn btn-primary" disabled>SIGN</button>
                    <button type="submit" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#signupmodal">UP</button>
                    <button type="submit" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#signinmodal">IN</button>


                    <div class="btn-group" role="group">
                        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                            
                            <a class="dropdown-item" href="/pages/developer.php"">Know Developer</a>
                        </div>
                    </div>
                </div>
                <small class="list-group mr-2" id="searchList">
                    <!-- <li class="list-group-item">Cras justo odio</li>
                    <li class="list-group-item">Cras justo odio</li> -->
                </small>
            </div>
            ');
             }else{
                echo ('
            <div class="row ">
                    <form class="form-inline">
                        <input class="form-control " id="searchBox" type="search" placeholder="Search" autocomplete="off" aria-label="Search" name="searchData">

                        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" class=" rounded-circle mx-1" alt="..." width="40px">

                            <div class="btn-group" role="group">
                                <button id="btnGroupDrop1" type="button" class="btn dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="btnGroupDrop1">
                                    <button class="dropdown-item" type="button" id="btnSignout">Signout</button>
                                    <a class="dropdown-item" href="/pages/profile.php">Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="/pages/developer.php"">Know Developer</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <small class="list-group mr-2" id="searchList">
                       <!-- <li class="list-group-item">Cras justo odio</li>
                        <li class="list-group-item">Cras justo odio</li> -->
                    </small>
                </div>
            ');
            }
            ?>
        </div>
    </nav>

    <!-- S I G N     I N  -->
    <div class="modal fade" id="signinmodal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Signin To Forum</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container">
                        <form id="signinForm">
                            <input type="hidden" name="action" value="signin">

                            <div class="form-group border p-2 m-2">
                                <label for="signinEmail" class="form-text text-dark">Email</label>
                                <input type="email" class="form-control" id="signinEmail" name="signinEmail" required>
                                <small id="signinEmailAlert" class="form-text text-danger"></small>
                            </div>

                            <div class="form-group border p-2 m-2">
                                <label for="signinPassword" class="form-text text-dark">Password</label>
                                <input type="password" class="form-control" id="signinPassword" name="signinPassword" required>
                                <small id="signinPasswordAlert" class="form-text text-danger"></small>
                                <input type="checkbox" onclick="showhidePassword('signinPassword')"> Show Password
                            </div>
                            <button type="submit" class="btn btn-primary" id="btnSignin">Signin</button>
                        </form>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!-- S I G N     U P  -->
    <div class="modal fade" id="signupmodal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Signup To Forum</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div class="container">
                        <form id="signupForm">
                            <input type="hidden" name="action" value="signup">
                            <div class="form-group border p-2 m-2">
                                <label for="signupUsername" class="form-text text-dark">Username</label>
                                <input type="text" class="form-control" id="signupUsername" name="signupUsername" maxlength="10" autofocus>
                                <small id="signupUsernameAlert" class="form-text text-danger"></small>
                            </div>

                            <div class="form-group border p-2 m-2">
                                <label for="signupEmail" class="form-text text-dark">Email</label>
                                <input type="email" class="form-control" id="signupEmail" name="signupEmail" required>
                                <small id="signupEmailAlert" class="form-text text-danger"></small>
                            </div>

                            <div class="form-group border p-2 m-2">
                                <label for="signupPassword" class="form-text text-dark">Password</label>
                                <input type="password" class="form-control" id="signupPassword" name="signupPassword" required>
                                <small id="signupPasswordAlert" class="form-text text-danger"></small>
                                <input type="checkbox" onclick="showhidePassword('signupPassword')"> Show Password
                            </div>
                            <button type="submit" class="btn btn-primary" id="btnSignup">Signup</button>
                        </form>
                    </div>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>