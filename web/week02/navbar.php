<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home Page</title>
    
    <!-- Adding Bootstrap-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="homepage.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
</head>
<body>
    <?php
    $file = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);
    ?>
    
    <nav class="navbar navbar-default">
        <div class="conatainer-fluid">
            
            <!-- Logo -->
            <div class="navbar-header">
                <a href="#" class="navbar-brand">jASONrEED</a>
            </div>
            
            <!-- Menu Items-->
            <div>
                <!-- Iterate through to see which web page is active -->
                <ul class="nav navbar-nav">
                    <li <?php if ($file === 'homepage') echo 'class="active"' ?>><a href="homepage.php">Home</a></li>
                    <li <?php if ($file === 'projects') echo 'class="active"' ?>><a href="projects.php">Projects</a></li>
                    <li><a href="https://github.com/jjreed05">Github</a></li>
                </ul>
            </div>
        </div>
    </nav>

</body>
</html>