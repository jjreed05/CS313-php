<?php
session_start();
include_once("connectDb.php");

if($_SESSION['authentication'] == false){
    header("Location: login.php");
    exit();
}

$current = $_POST['current'];
$userName = "Admin";
$table = $db->prepare('SELECT userName, userPass FROM login WHERE userName=:admin');
$table->bindValue(':admin', $userName, PDO::PARAM_STR);
$table->execute();
$rows = $table->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['insert'])){
    if(password_verify($current, $rows['userpass'])){
        
        if($_POST['new'] == ""){
            $errorNew = "Empty Field";
        }
        if($_POST['confirm'] == ""){
            $errorConfirm = "Empty Field";
        }
        if($_POST['new'] != $_POST['confirm']){
            $errorConfirm = "Passwords do not match!";
        }
        
        if($_POST['new'] === $_POST['confirm'] && $_POST['confirm'] != ''){
            $newPassword = password_hash($_POST['new'], PASSWORD_DEFAULT);
            $table = $db->prepare('UPDATE login SET userpass=:password WHERE userName=:admin');
            $table->bindValue(':admin', $userName, PDO::PARAM_STR);
            $table->bindValue(':password', $newPassword, PDO::PARAM_STR);
            $table->execute();
            $success = "Your password has been updated";
        }
    }
    else{
        $errorCurrent = "Password Not Valid";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="adminPage.css">
    <!-- Using Bootstrap -->
    <link rel="stylesheet"href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="editPassword.js"></script>
    
</head>

<body>
    <?php
    $file = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
    ?>
    
    <!-- Did not include navbar file because I needed to change the admin button to logout -->
    <nav class="navbar navbar-inverse">
        <div class="conatainer-fluid">
            
            <!-- Logo -->
            <div class="navbar-header">
                <a class="navbar-brand">PeaceDollar</a>
            </div>
            
            <!-- Menu Items-->
            <div>
                <!-- Iterate through to see which web page is active -->
                <ul class="nav navbar-nav">
                    <li <?php if ($file === 'browse') echo 'class="active"' ?>><a href="browse.php">Home</a></li>
                    <li <?php if ($file === 'shoppingCart') echo 'class="active"' ?>><a href="shoppingCart.php">Shopping Cart</a></li>
                </ul>
                <div class="dropdown">
                <ul class="nav navbar-nav navbar-right">
                    <li id="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">User
                            <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a><form action="adminPage.php" method="post"><span class="glyphicon glyphicon-user"><input type=submit class="btn btn-link" name="logout" value="Logout"></span></form></a>
                                </li>
                                <li>
                                <a href="editPassword.php"><span class="glyphicon glyphicon-cog"></span> Update Password</a>
                                </li>
                            </ul>
                    </li>
                </ul>
                </div>
                <form action="search.php" method="get" class="form-inline nav navbar-nav navbar-right" id="search">
                    <input class="form-control mr-sm-2" type="text" name="userInput" placeholder="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search
                    </button>
                </form>
            </div>
        </div>
    </nav>
    
    <div class="container">
        <h1>Change Password</h1>
        <form class="form-horizontal" action="editPassword.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label col-sm-2" for="current">Please Enter Current Password</label>
                <div class="col-sm-10"> 
                    <input type='password' class="form-control" name="current">
                </div>
                <?php if(isset($errorCurrent)){echo "<h3 class='text-danger'>".$errorCurrent."</h3>";} ?>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="new">Please Enter New Password</label>
                <div class="col-sm-10"> 
                    <input type='password' class="form-control" name="new">
                </div>
                <?php if(isset($errorNew)){echo "<h3 class='text-danger'>".$errorNew."</h3>";} ?>
            </div>    
            <div class="form-group">
                <label class="control-label col-sm-2" for="confirm">Confirm Password</label>
                <div class="col-sm-10"> 
                    <input type='password' class="form-control" name="confirm">
                </div>
                <?php if(isset($errorConfirm)){echo "<h3 class='text-danger'>".$errorConfirm."</h3>";} ?>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-primary" name="insert" value="Update">
                </div>
            </div>
        </form>
    </div>
    <?php 
    if(isset($success)){
        $_SESSION['authentication'] = false;
        echo "<div class='container'>";
        echo "<h1 class='text-success'>".$success."</h1>";
        echo "<p>You will be redirected in <span id='counter'>5</span> second(s).</p><script> setInterval(function(){ countdown(); },1000);</script>'";
        echo "</div>";
    }
    ?>
</body>