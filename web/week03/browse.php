<?php 
include_once("items.php");
include_once("navbar.php");
session_start();
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
    
$sony = new Headphone('Sony XB950B1', 49.99, 0, 'Extra Bass Wireless Headphones with App Control, Black (2017 Model)', 'Sony.jpg');
$jayBird = new Headphone('Jaybird X3', 129.99, 0, 'Sport Bluetooth Headset for iPhone and Android - Blackout', 'JayBird.jpg');
$leshp = new Headphone('LESHP WIRELESS', 37.99, 0, 'Wireless Bluetooth 4.2 Earphone IP67 Waterproof In-ear Headphones - 18 Hours of Play with 850mAh Charging station, 3 Pairs of Earplugs, Built-in Microphone, Sports Earbuds, for Smartphone', 'Lehsp.jpg');
$samsung = new Headphone('Samsung Earbuds', 29.99, 0, 'Bluetooth Earbud, Mini Wireless Headset Earphone Headphone For IPhone X, 8 8 Plus, 7 7 Plus, 6s 6s Plus and Samsung Galaxy S7 S8 and Android Phones (Single Right Ear)', 'Samsung.jpg');
$mpow = new Headphone('Mpow 059', 39.99, 0, 'Bluetooth Headphones Over Ear, Hi-Fi Stereo Wireless Headset, Foldable, Soft Memory-Protein Earmuffs, w/ Built-in Mic and Wired Mode for PC/ Cell Phones/ TV', 'Mpow.jpg');
$geekee = new Headphone('Geekee Wireless', 25.47, 0, 'Wireless Bluetooth Headphones, Wireless Sports Headphones w/ Mic Waterproof IPX7 HD Stereo Bass In-Ear Earbuds for Running Workout Gym Noise Cancelling Headset Sweatproof Earphones', 'Geekee.jpg');
$alihen = new Headphone('AILIHEN C8', 19.98, 0, 'Headphones with Microphone and Volume Control Folding Lightweight Headset for Cellphones Tablets Smartphones Laptop Computer PC Mp3/4 (Grey/Mint)', 'Ailihen.jpg');
$jaysForDays = new Headphone('Jays for Days', 13.99, 0, 'In Ear Headphone with mic,Earphone Comfortable Fit, Humixx Bass Stereo Earbuds Headphones with Built-in mic (Red)', 'JaysForDays.jpg');

    
// Add all of the items into an array
$array = array($sony, $jayBird, $leshp, $samsung, $mpow, $geekee, $alihen, $jaysForDays);
 
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
        
        // I am using one template to display the items instead
        // of hard coding each element
        for($x = 0; $x < count($array); $x++){
            $item = $array[$x];
            $rowTrack = 0;
            
            // Organize the data into 4 columns.
            // Create a new row if it's the first array item
            if($x == 0){
                echo '<div class="row equal">';
            }
            // Create a new row if it's the 5th item 
            if(($x + 1) % 5 == 0){
                echo '</div>';
                echo '<div class="row equal">';
            }
            
            echo '<div class="col-md-3">';
            echo '<div class="thumbnail">';
            echo '<h2>'."$item->name".'</h2>';
            echo '<a href="'.$item->image.'" target="_blank">';
            echo '<img class="img-responsive" src="'.$item->image.'" alt="Sony"></a>';
            echo '<div class="caption"><p>'.$item->description.'</p><h5>$'.$item->price.' + Free Shipping</h5></div>';
            echo '<div class="input">';
            echo '<form action="addToCart.php" method="post"><p id="quantity">Quantity: </p>';
            echo '<input type="number" name="quantity" value="0" min="0">';
            
            // Using the hidden tag to get the value of the index so that
            // I can get the item off the array on the next page
            echo '<input type="number" name="index" value="'.$x.'" hidden>';
            echo '<input type="submit" value="Add to Cart"></form>';
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