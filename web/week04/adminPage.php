<?php
session_start();
include_once("navbar.php");
include_once("items.php");
include_once("connectDb.php");

if(isset($_POST['logout'])){
    $_SESSION['authentication'] = False;
}

// Don't allow anyone to login
if ($_SESSION['authentication'] == False){
    header("Location: login.php");
    exit();
}

// Remove an item off the database
if(isset($_POST['remove'])){
    // Delete the product off the database
    $dbIndex = ($_POST['dbNumber']);
    $table = $db->prepare("DELETE FROM products WHERE id=:index");
    $table->bindValue(":index", $dbIndex, PDO::PARAM_INT);
    $table->execute();
    
    // Find the image location and delete it from the folder
    $table = $db->prepare("SELECT * FROM images WHERE id=:index");
    $table->bindValue(':index', $dbIndex, PDO::PARAM_INT);
    $table->execute();
    $rows = $table->fetch(PDO::FETCH_ASSOC);
    $fileName = $rows['img'];
    //unlink("$fileName");
    
    // Delete image from database
    $table = $db->prepare("DELETE FROM images WHERE id=:index");
    $table->bindValue(":index", $dbIndex, PDO::PARAM_INT);
    $table->execute();
}

// Used to display the current items on the database
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
        echo '<table class="table">';
        echo '<thread><tr><th>Option</th><th>Year</th><th>Category</th><th>Item</th><th>Dollar Amount</th><th>Price to Sell</th></tr></thread>';
        echo '<tbody>';
        
        // Display the items in the table as well as calculating the total
        for($x = 0; $x < count($array); $x++){
            $items = $array[$x];
            echo '<form action="adminPage.php" method="post">';
            echo '<tr>';
            echo '<input type="number" name="dbNumber" value="'.$items->itemNum.'" hidden>';
            // Remove Item button
            echo '<td><input type="submit" class="btn btn-primary" name="remove" value="Remove"></td>';
            echo '<td>'.$items->year.'</td>';
            echo '<td>'.$items->category.'</td>';
            echo '<td>'.$items->name.'</td>';
            echo '<td>$'.$items->amount.'</td>';
            echo '<td>$'.$items->price.'</td>';
            echo '</tr></form>';
        
        }
        echo '</tbody></table>';
        echo '</div>';
        
    }
    ?>
    </p>
    <br>
    <div class="container">
        <h1>Add items to the Database</h1><br>
        <form class="form-horizontal" action="insertIntoDB.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label class="control-label col-sm-2" for="year">Coin Year:</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="coinYear" placeholder="1700">
                </div>    
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="name">Coin Name:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="coinName" placeholder="Enter Name">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="amount">Coin Amount:</label>
                <div class="col-sm-10">                                
                    <input type="number" class="form-control" name="coinAmount" min="0.01" step="0.01" placeholder="0.00">
                </div>   
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="sale">Sale Price:</label>
                <div class="col-sm-10"> 
                    <input type="number" class="form-control" name="saleprice" min="0.01" step="0.01" placeholder="0.00">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="category">Type of Coin:</label>
                <div class="col-sm-10"> 
                    <input type="text" class="form-control" name="category" placeholder="ie Penny">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2" for="category">Upload Image: </label>
                <div class="col-sm-10"> 
                    <input type="file" class="form-control" name="image">
                    <?php 
                    if (isset($_GET['error'])){
                        $error = $_GET['error'];
                        echo "<p class='text-danger'>".$error."</p>";
                    }
                    ?>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-primary" name="insert" value="Upload to Database">
                </div>
            </div>
        </form>
    </div>
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