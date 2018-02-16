<?php
session_start();
include_once("items.php");
include_once("navbar.php");
include_once("connectDb.php");
   
$index = $_POST['index'];

$query ='SELECT * FROM products AS a JOIN categories AS b ON b.id = a.categoryID JOIN images AS c on c.id = a.imageid WHERE a.id = :index';
$stmt = $db->prepare($query);
$stmt->bindValue(':index', $index, PDO::PARAM_INT);
$stmt->execute();
$table = $stmt->fetch(PDO::FETCH_ASSOC);

$year = $table['coinyear'];
$name = $table['coinname'];
$amount = $table['coinamount'];
$price = $table['saleprice'];
$category = $table['category'];
$image = 'null';
$itemNum =  $table['id'];
$object = new Coin($year, $name, $amount, $price, $category, $image, $itemNum);

// Add items to the cart
if(empty($_SESSION['shopCart'])){
    $_SESSION['shopCart'] = array($object);
    //$_SESSION['shopCart'] = $shopCart;
}
else{ 
    array_push($_SESSION['shopCart'], $object);
}

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