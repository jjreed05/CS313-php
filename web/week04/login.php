<?php 
session_start();
include_once("items.php");
include_once("navbar.php");
include_once("connectDb.php");


if($_SESSION['authentication'] == TRUE){
    header("Location: adminPage.php");
    exit();
}
if(isset($_POST['submit'])){
    
    $username = $_POST['user'];
    $table = $db->prepare('SELECT username, userpass FROM login WHERE username=:username');
    $table->bindValue(':username', $username, PDO::PARAM_STR);
    $table->execute();
    $rows = $table->fetch(PDO::FETCH_ASSOC);
    
    if(password_verify($_POST['password'], $rows['userpass'])){
        echo '<h1>Success</h1>';
        $authentication = True;
        $_SESSION['authentication'] = $authentication;
        header("Location: adminPage.php");
        exit();
        
    }
    else{
        echo '<h1>Authentication Error</h1>';
    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>LogIn</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" type="text/css"  href="login.css"/>
    
    <!-- Using Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
</head>
    
<body>
    <div class="container">
        <div class="col-md-offset-3 col-md-6">
            <div class="form-login">
                <h4>Welcome back.</h4>
                <form action="login.php" method="post">
                <input type="text" id="userName" name="user" class="form-control input-sm chat-input" placeholder="username" />
                <br>
                <input type="password" id="userPassword" name="password" class="form-control input-sm chat-input" placeholder="password" />
                <br>
                <div class="wrapper">
                    <input type="submit" class="group-btn" name="submit" value="Login">     
                </div>
            `   </form>
            </div>
        </div>
    </div>
</body>

</html>