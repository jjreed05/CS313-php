<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home Page</title>
    
    <!-- Adding Bootstrap-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
</head>
<body>
    <?php
    $file = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
    ?>
    
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
                <ul class="nav navbar-nav navbar-right">
                        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Admin</a></li>
                </ul>
                <form action="search.php" method="get" class="form-inline nav navbar-nav navbar-right" style="padding-top: 8px;">
                    <input class="form-control mr-sm-2" type="text" name="userInput" placeholder="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search
                    </button>
                </form>
            </div>
        </div>
    </nav>

</body>
</html>