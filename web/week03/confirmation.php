<?php
include_once("items.php");
include_once("navbar.php");
session_start();

$table = $_SESSION['shopCart'];
?>
<!DOCTYPE html>

<html>
<head>
    <title>Confirmation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Using Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
    
<body>
    <div class="container">
        <div class="col-md-12">
            <h3 class="text-center">Confirmation</h3>
            <h4>Dear <?php echo $_SESSION['first'].' '.$_SESSION['last'];?>, your order(s): </h4>
            <br>
            <ul clas="list-group">
            <?php
            $finalPrice = 0;
            foreach($table as $items){
                $total = ($items->price * $items->quantity);
                echo '<li class="list-group-item">'.$items->quantity.' item(s) of '.$items->name.' at $'.$total;
                $finalPrice += $total;
            }
            echo '</ul><br><br>'; 
            echo '<h5><mark>Grand Total: $'.$finalPrice.'</mark></h5>';
            ?>
                
            <br>
            <h4> Your order has been confirmed. We will send your package to 
            <?php 
            echo $_SESSION['street'].', '.$_SESSION['city'].', '.$_SESSION['state'].' '.$_SESSION['zip'].'. ';
            echo 'We have sent a confirmation email to '.$_SESSION['email'].'.';
            ?> 
            </h4>
            <br>
            <p>
            All headphones have a 90 day return policy; headphones must still be sealed in the box. Additionally,
            all headphones are covered under a 2 year warranty. DISCLAIMER: JAY's HEADPHONEs is not responsible for, 
            and expressly disclaims all liability for, damages of any kind arising out of use, reference to, or 
            reliance on any information contained within the site. While the information contained within the site 
            is periodically updated, no guarantee is given that the information provided in this Web site is correct, 
            complete, and up-to-date. If you have any quesitions or concerns about your order, please call 1-800-000-0000.   
            </p>
            <br>
            <h4>Thank you for choosing JAY's!</h4>
        </div>
    </div>
</body>
</html>

<?php
session_destroy();
?>