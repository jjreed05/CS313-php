<?php
include_once("navbar.php");
include_once("items.php");
include_once("connectDb.php");
session_start();

if(isset($_POST['logout'])){
    $_SESSION['authentication'] = False;
}
if ($_SESSION['authentication'] == False){
    header("Location: login.php");
    exit();
}

$array = array();

foreach($db->query('SELECT * FROM products AS a JOIN categories AS b ON b.id = a.categoryID JOIN images AS c on c.id = a.imageid') as $row){
    $year = $row['coinyear'];
    $name = $row['coinname'];
    $amount = $row['coinamount'];
    $price = $row['saleprice'];
    $category = $row['category'];
    $image = $row['img'];
    $itemNum =  $row['id'];
    
    $object = new Coin($year, $name, $amount, $price, $category, $image, $itemNum);
    array_push($array, $object);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Shopping Cart</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Using Bootstrap -->
    <link rel="stylesheet"href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
</head>

<body>
    <p>
    <?php
    if (empty($array)){
        echo '<div class="container"><h1>Your Database is Empty</h1>';
    }
    else{
        // Creating a table using the bootstrap framework
        echo '<div class="container"><h1>Items in Database</h1>';
        echo '<form action="#">';
        echo '<table class="table">';
        echo '<thread><tr><th>Option</th><th>Year</th><th>Category</th><th>Item</th><th>Dollar Amount</th><th>Price to Sell</th></tr></thread>';
        echo '<tbody>';
        
        // Display the items in the table as well as calculating the total
        for($x = 0; $x < count($array); $x++){
            $items = $array[$x];
            echo '<tr>';
            echo '<td><input type="radio" name="action"></td>';
            echo '<td>'.$items->year.'</td>';
            echo '<td>'.$items->category.'</td>';
            echo '<td>'.$items->name.'</td>';
            echo '<td>$'.$items->amount.'</td>';
            echo '<td>$'.$items->price.'</td>';
            echo '<input type="number" name="index" value="'.$items->itemNum.'" hidden>';
            echo '</tr>';
        }
        echo '</tbody></table>';
        echo '<input type=submit class="btn btn-primary" value="Remove">';
        echo '</form></div>';
        
    }
    ?>
    </p>
    <br>
    <div class="container">
        <div class="col-md-12 text-center">
            <form action='adminPage.php' method="post">
            <?php
        
                echo '<input type=submit class="btn" name="logout" value="Logout">';
            ?>
            </form>
        </div>
    </div>
   
</body>