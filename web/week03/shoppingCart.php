<?php
include_once("navbar.php");
include_once("items.php");
session_start();

// Allows the user to remove an item off the shopping cart
function removeItem(){
    $index = $_GET['index'];
    array_splice($_SESSION['shopCart'], $index, 1);
}

// Only remove if the user clicks Remove Item
if (isset($_GET['submit'])){
    removeItem();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shopping Cart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Using Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
</head>

<body>
    <p>
    <?php
    if (empty($_SESSION['shopCart'])){
        echo '<div class="container"><h1>Your Shopping Cart is Empty</h1>';
        echo '<h3><a href="browse.php">Continue Browsing</a></h3>';
    }
    else{
        // Creating a table using the bootstrap framework
        echo '<div class="container"><h1>Shopping Cart</h1>';
        echo '<table class="table">';
        echo '<thread><tr><th>Quantity</th><th>Item</th><th>Price Per Item</th><th>Total</th><th>Option</th></tr></thread>';
        echo '<tbody>';
        $table = array();
        $table = $_SESSION['shopCart'];
        $finalTotal = 0;
        
        // Display the items in the table as well as calculating the total
        for($x = 0; $x < count($table); $x++){
            $items = $table[$x];
            $total = ($items->quantity * $items->price);
            echo '<tr>';
            echo '<td>'.$items->quantity.' item(s)</td>';
            echo '<td>'.$items->name.'</td>';
            echo '<td>$'.$items->price.'</td>';
            echo "<td>$$total</td>";
            echo '<td><form action="shoppingCart.php" method="get">';
            
            // Using the hidden tag again in order to define which item to remove
            echo '<input type="number" name="index" value="'.$x.'" hidden>';
            // Remove Item button
            echo '<input type="submit" class="btn" name="submit" value="Remove Item">';
            echo '</form></td>';
            echo '</tr>';
            
            $finalTotal += $total;
        }
        
        echo '</tbody></table>';
        echo '<form action="checkout.php">';
        echo '<h3>Final Total: $'.$finalTotal.'</h3>';
        echo '<input type=submit class="btn" value="Checkout"></form>';
    }
    ?>
    </p>
   
    
</body>