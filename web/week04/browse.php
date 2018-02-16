<?php 
session_start();
include_once("items.php");
include_once("navbar.php");
include_once("connectDb.php");

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
    <title>Browse Items</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" type="text/css"  href="browse.css"/>
    
    <!-- Using Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
</head>
<?php
 
// Using a session to access the array of items on each page
if(empty($_SESSION['array'])){
    $_SESSION['array'] = array();
    $_SESSION['array'] = $array;
}

?>
<body>
    <div class="container">
        <?php
        $count = count($array);
        $rowTrack = 0;
        
        if ($count == 0){
            echo "<h2>Sorry, there are no current items for sale";
        }
        // I am using one template to display the items instead
        // of hard coding each element
        for($x = 0; $x < count($array); $x++){
            $item = $array[$x];
            
            // Organize the data into 3 columns.
            // Create a new row if it's the first array item
            if($x == 0){
                echo '<div class="row equal">';
            }
            // Create a new row if it's the 4th item 
            if(($x) % 3 == 0){
                echo '</div>';
                echo '<div class="row equal">';
            }
            
            echo '<div class="col-md-4">';
            echo '<div class="thumbnail">';
            echo '<h2>'.$item->name.'</h2>';
            echo '<a href="'.$item->image.'" target="_blank">';
            echo '<img class="img-responsive" src="'.$item->image.'" alt="Sony"></a>';
            echo '<h4>'.$item->year.' '.$item->category.'</h4>';
            echo '<div class="caption"><h5>$'.$item->price.'</h5></div>';
            echo "<h4>Index: ".$item->itemNum."</h4>";
            echo '<div class="input">';
            echo '<form action="addToCart.php" method="post">';
            
            // Using the hidden tag to get the value of the index so that
            // I can get the item off the array on the next page
            echo '<input type="number" name="index" value="'.$item->itemNum.'" hidden>';
            echo '<input type="submit" value="Add to Cart">';
            echo '</form></div></div></div>';

            // Close the row div tag
            $rowTrack++;
            if($rowTrack == $count){
                echo '</div>'; 
            }
        }
        ?>
    </div>

</body>
</html>