<?php 
include_once("items.php");
include_once("navbar.php");
session_start();

$firstError = "";
$lastError = "";
$streetError = "";
$cityError = "";
$zipError = "";

// Using this logic to validate the form
if(isset($_POST['submitted'])){
    
    // Using regex to validate
    $regexName = "/^[a-zA-Z ]*$/";
    $regexStreet = "/^[a-zA-Z0-9,. ]*$/";
    $regexZip = "/^(\d{5})?$/";
    // Using this variable to tell page if there are errors
    $error = 0;
    
    // Compare the regex to the form
    if(!preg_match($regexName, $_POST['first']) || empty($_POST['first'])){
        $firstError = "Only characters and white spaces.";
        $error = 1;
    }
    
    if(!preg_match($regexName, $_POST['last']) || empty($_POST['last'])){
        $lastError = "Only characters and white spaces.";
        $error = 1;
    }
    
    if(!preg_match($regexStreet, $_POST['street']) || empty($_POST['street'])){
        $streetError = "Not a valid address.";
        $error = 1;
    }
    
    if(!preg_match($regexName, $_POST['city']) || empty($_POST['city'])){
        $cityError = "Not a valid city.";
        $error = 1;
    }
    
    if(!preg_match($regexName, $_POST['state']) || empty($_POST['state'])){
        $stateError = "Not a valid state.";
        $error = 1;
    }

    if(!preg_match($regexZip, $_POST['zip']) || empty($_POST['zip'])){
        $zipError = "Not a valid zip.";
        $error = 1;
    }

    if(empty($_POST['email'])){
        $error = 1;
    }
    
    // If there are no errors, set the session variables and redirect the page.
    if($error == 0){
        $_SESSION['first'] = $_POST['first'];
        $_SESSION['last'] = $_POST['last'];
        $_SESSION['street'] = $_POST['street'];
        $_SESSION['city'] = $_POST['city'];
        $_SESSION['state'] = $_POST['state'];
        $_SESSION['zip'] = $_POST['zip'];
        $_SESSION['email'] = $_POST['email'];
        header("Location: confirmation.php");
    }
    
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" type="text/css"  href="browse.css"/>
    
    <!-- Using Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
</head>

<body>
    <div class="container">
        <h2 class="text-center">Contact Information and Billing Address</h2>
        <form class="horizontal" action="?" method="post">
            <div class="form-group">
                <label for="first">First Name:</label>
                <input type="text" class="form-control" name="first" id="first" value="<?php if(isset($_POST['first'])){echo $_POST['first'];} ?>">
                <p class="text-danger"><?php echo $firstError;?></p>
            </div>
            <div class="form-group">
                <label for="last">Last Name:</label>
                <input type="text" class="form-control" name="last" id="last" value="<?php if(isset($_POST['last'])){echo $_POST['last'];} ?>">
                <p class="text-danger"><?php echo $lastError;?></p>
            </div>
            <div class="form-group">
                <label for="street">Street Address:</label>
                <input type="text" class="form-control" name="street" id="street" value="<?php if(isset($_POST['street'])){echo $_POST['street'];} ?>">
                <p class="text-danger"><?php echo $streetError;?></p>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" class="form-control" name="city" id="city" value="<?php if(isset($_POST['city'])){echo $_POST['city'];} ?>">
                <p class="text-danger"><?php echo $cityError;?></p>
            </div>
            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" class="form-control" name="state" id="state" value="<?php if(isset($_POST['state'])){echo $_POST['state'];} ?>">
                <p class="text-danger"><?php echo $stateError;?></p>
            </div>
            <div class="form-group">
                <label for="zip">Zip:</label>
                <input type="text" class="form-control" name="zip" id="zip" value="<?php if(isset($_POST['zip'])){echo $_POST['zip'];} ?>">
                <p class="text-danger"><?php echo $zipError;?></p>                
            </div>
            <div class="form-group">
                <label for="street">Email:</label>
                <input type="email" class="form-control" name="email" id="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>">
            </div>
            <input class="btn btn-primary center-block" type="submit" name="submitted" class="btn" value="Checkout">
        </form>
    </div>
</body>
</html>