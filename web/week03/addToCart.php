<?php
include_once("items.php");
include_once("navbar.php");
session_start();

    
$index = $_POST['index'];

$array = array();
$array = $_SESSION['array']; 
$item = $array[$index];
//Add the quantity
$item->setQuantity($_POST['quantity']);

// Add items to the cart
if(empty($_SESSION['shopCart'])){
    $_SESSION['shopCart'] = array($item);
    //$_SESSION['shopCart'] = $shopCart;
}
else{
    array_push($_SESSION['shopCart'], $item);
}

/*$test = array();
$test = $_SESSION['shopCart'];
$testing = $test[0];
echo 'Testing objects '.$testing->name.'<br>';


foreach($_SESSION['shopCart'] as $object){
    echo 'Test: '.$object->quantity.'<br>';
}*/

?>
<!DOCTYPE html>

<html>
<head>
    <title>Add to Cart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Using Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
    
<body>
    <?php 
    //echo 'Index Check: '.$index;
    ?>
    <div class="container">
        <div class="col-md-12">
        <br>
        <br>
        <h3>
            Product was successfully added to your cart.
            <a href="shoppingCart.php">View Shopping Cart</a>
            or 
            <a href="browse.php">Buy More Items</a>
        </h3>
        </div>
    </div>
</body>
</html>