<?php 
session_start();
include_once("items.php");
include_once("navbar.php");
include_once("connectDb.php");


if(isset($_POST['submit'])){
    $username = $_POST['user'];
    $password = $_POST['password'];
    $table = $db->prepare('SELECT userName, userPass FROM login WHERE userName=:userName AND userPass=:userPass ');
    $table->bindValue(':userName', $username, PDO::PARAM_INT);
    $table->bindValue(':userPass', $password, PDO::PARAM_INT);
    $table->execute();
    $rows = $table->fetchAll(PDO::FETCH_ASSOC);
    
    if(count($rows) == 1){
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