<?php include_once ($_SERVER['DOCUMENT_ROOT']."/partials/_dbconnection.php") ?>
<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(!empty($_POST['action'])){
            $function = $_POST['action'];
            $function($connection);         
        }
    }
?>
<?php //signin
    function signin($connection){
        $signinEmail = $_POST['signinEmail'];
        $signinPassword = $_POST['signinPassword'];

        if( availibilityCheck($connection , $signinEmail , "user_email") ==  true ){
            $query = mysqli_query($connection , "SELECT user_name , user_password FROM users WHERE user_email = '$signinEmail'");
            echo mysqli_error($connection);
            $result = mysqli_fetch_assoc($query);
            $hashedPassword = $result['user_password'];
            $username = $result['user_name'];
            
            if(password_verify($signinPassword , $hashedPassword)){
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['username'] = $username;
                echo ("1");
            }else{
                echo ("0");
            } 
        }else{
            echo ("0");
        } 

    }

?>
<?php //signup
    function signup($connection){
        $signupUsername = $_POST['signupUsername'];
        $signupEmail = $_POST['signupEmail'];
        $signupPassword = $_POST['signupPassword'];
        
        if(usernameValidate($signupUsername) == false){
            echo "Signup Not Successful !! Invalid Username";
        }else if(emailValidate($signupEmail) == false){
            echo "Signup Not Successful !! Invalid Email";
        }else if(passwordValidate($signupPassword) == false){
            echo "Signup Not Successful !! Invalid Password or Password Is Not Matcing";
        }elseif(availibilityCheck($connection , $signupUsername , "user_name") ==  true){
            echo "Signup Not Successful !! Username Is Not Available";
        }
        elseif( availibilityCheck($connection , $signupEmail , "user_email") ==  true ){
            echo "Signup Not Successful !! This Email Is Already Registered";
        }else{
            $hashedPassword = password_hash($signupPassword,PASSWORD_DEFAULT);            
             $query = mysqli_query($connection , "INSERT INTO users VALUES ('$signupUsername' , '$signupEmail' , NULL , '$hashedPassword' , current_timestamp())");
             if($query){
                echo "Signup Is Successful ..";
             }else{
                echo "Signup Is Not Successful .. ";
                //  echo "Signup Is Not Successful .. ".mysqli_error($connection);
             }
        }
    }

?>
<?php //signout
    function signout(){
        
        if(session_id() == ''){
            session_start();
        }
        session_unset();
        session_destroy();
    }
?>

<?php //other//functions
    function usernameAvailibilityCheck($connection){
        $input_data = $_POST['input_data'];
        
        if(availibilityCheck($connection , $input_data , 'user_name')){echo ("1");}
        else{echo ("0");}      
    }
    
    function emailAvailibilityCheck($connection){
        $input_data = $_POST['input_data'];
        if(availibilityCheck($connection , $input_data , 'user_email')){echo ("1");}
        else{echo ("0");}  

    }
    function availibilityCheck($connection , $input_data , $mysql_data){
        $query = mysqli_query($connection , "SELECT $mysql_data FROM users WHERE $mysql_data = '$input_data'");
        if(mysqli_num_rows($query) > 0){                       
            return true;
        }else{
            return false;
        } 
    }
    function usernameValidate($username){
        $pattern = "/[a-zA-Z][a-zA-Z0-9-_]{4,10}/";
        $usernameLength = strlen($username);
        if($usernameLength < 3 || $usernameLength > 10){
            return false;
        }
        elseif(!preg_match($pattern, $username)){
            return false;
        }else return true;
    }

    function emailValidate($email){
        $pattern = "/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/";
        if(!preg_match($pattern, $email)){
            return false;
        }else return true;
    }

    function passwordValidate($password){
        if(strlen($password) < 5){
            return false;
        }else return true;
    }


?>