<?php 
session_start();
include_once("items.php");
include_once("navbar.php");
include_once("connectDb.php");

$array = array();
$table = $db->prepare('SELECT * FROM products AS a JOIN categories AS b ON b.id = a.categoryID JOIN images AS c on c.id = a.imageid');
$table->execute();
$rows = $table->fetchAll(PDO::FETCH_ASSOC);

foreach($rows as $row){
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
    <link rel="stylesheet"href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<?php
 
// Using a session to access the array of items on each page
if(empty($_SESSION['array'])){
    $_SESSION['array'] = array();
    $_SESSION['array'] = $array;
}

?>
<body>
    
    <!--<div class="container">
        <?php /*
        $count = count($array);
        $rowTrack = 0;
        
        if ($count == 0){
            echo "<h2>Sorry, there are no current items for sale";
        }
        // I am using one template to display the items instead
        // of hard coding each element
        for($x = 0; $x < count($array); $x++){
            $item = $array[$x];
            
            // Organize the data into 4 columns.
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
            echo '<div class="input">';
            echo '<form action="addToCart.php" method="post">';
            
            // Using the hidden tag to get the value of the index so that
            // I can get the item off the array on the next page
            echo '<input type="number" name="index" value="'.$item->itemNum.'" hidden>';
            echo '<input type="submit" value="Add to Cart">';
            echo '</form></div></div></div>';

            // Close the row div tag
            if($rowTrack == $count){
                echo '</div>'; 
            }
            $rowTrack++;
        }*/
        ?>
</div>-->


<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.html">Simple Ecommerce</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarsExampleDefault">
            <ul class="navbar-nav m-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.html">Home</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="category.html">Categories <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="product.html">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.html">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="contact.html">Contact</a>
                </li>
            </ul>

            <form class="form-inline my-2 my-lg-0">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="Search...">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-secondary btn-number">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                <a class="btn btn-success btn-sm ml-3" href="cart.html">
                    <i class="fa fa-shopping-cart"></i> Cart
                    <span class="badge badge-light">3</span>
                </a>
            </form>
        </div>
    </div>
</nav>
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Peace Dollar Coins</h1>
        <p class="lead text-muted mb-0">Welcome to Peace Dollar Coins, this website is owned and operated by a fellow coin collector. We offer competetive rates and a variety of coins. Thanks for checking out the website </p>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="browse.php">Home</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-12 col-sm-3">
            <div class="card bg-light mb-3">
                <div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-list"></i> Categories</div>
                <ul class="list-group category_block">
                    <li class="list-group-item"><a href="category.html">Cras justo odio</a></li>
                    <li class="list-group-item"><a href="category.html">Dapibus ac facilisis in</a></li>
                    <li class="list-group-item"><a href="category.html">Morbi leo risus</a></li>
                    <li class="list-group-item"><a href="category.html">Porta ac consectetur ac</a></li>
                    <li class="list-group-item"><a href="category.html">Vestibulum at eros</a></li>
                </ul>
            </div>
            <div class="card bg-light mb-3">
                <div class="card-header bg-success text-white text-uppercase">Last product</div>
                <div class="card-body">
                    <img class="img-fluid" src="https://dummyimage.com/600x400/55595c/fff" />
                    <h5 class="card-title">Product title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <p class="bloc_left_price">99.00 $</p>
                </div>
            </div>
        </div>
        
        
        <div class="col">
            <?php
            $count = count($array);
        
            if ($count == 0){
                echo "<h2>Sorry, there are no current items for sale";
            }
            // I am using one template to display the items instead
            // of hard coding each element
            for($x = 0; $x < count($array); $x++){
                $item = $array[$x];
            
                // Organize the data into 4 columns.
                // Create a new row if it's the first array item
                if($x == 0){
                    echo '<div class="row">';
                }
                
                echo '<div class="col-12 col-md-6 col-lg-4">';
                echo '<div class="card">';
                echo '<a href="'.$item->image.'" target="_blank">';
                echo '<img class="img-responsive" id="img" src="'.$item->image.'" alt="'.$item->name.'" height="300" width="250"></a>';
                echo '<div class="card-body">';
                echo '<h4 class="card-title">'.$item->name.'</h4>';
                echo '<p class="card-text">'.$item->year.' '.$item->category.'</p>';
                echo '<div class="row">';
                echo '<div class="col">$ '.$item->price.'</p>';
                echo '</div>';
                echo '<div class="col">';
                echo '<div class="input">';
                echo '<form action="addToCart.php" method="post">';
            
                // Using the hidden tag to get the value of the index so that
                // I can get the item off the array on the next page
                echo '<input type="number" name="index" value="'.$item->itemNum.'" hidden>';
                echo '<input class="btn btn-success btn-block" type="submit" value="Add to Cart">';
                echo '</form>';
                echo '</div></div></div></div></div></div>';
            }
                
            ?>
            
            <!--<div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <img class="card-img-top" src="https://dummyimage.com/600x400/55595c/fff" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title"><a href="product.html" title="View Product">Product title</a></h4>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="row">
                                <div class="col">
                                    <p class="btn btn-danger btn-block">99.00 $</p>
                                </div>
                                <div class="col">
                                    <a href="#" class="btn btn-success btn-block">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <img class="card-img-top" src="https://dummyimage.com/600x400/55595c/fff" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title"><a href="product.html" title="View Product">Product title</a></h4>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="row">
                                <div class="col">
                                    <p class="btn btn-danger btn-block">99.00 $</p>
                                </div>
                                <div class="col">
                                    <a href="#" class="btn btn-success btn-block">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <img class="card-img-top" src="https://dummyimage.com/600x400/55595c/fff" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title"><a href="product.html" title="View Product">Product title</a></h4>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="row">
                                <div class="col">
                                    <p class="btn btn-danger btn-block">99.00 $</p>
                                </div>
                                <div class="col">
                                    <a href="#" class="btn btn-success btn-block">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <img class="card-img-top" src="https://dummyimage.com/600x400/55595c/fff" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title"><a href="product.html" title="View Product">Product title</a></h4>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="row">
                                <div class="col">
                                    <p class="btn btn-danger btn-block">99.00 $</p>
                                </div>
                                <div class="col">
                                    <a href="#" class="btn btn-success btn-block">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <img class="card-img-top" src="https://dummyimage.com/600x400/55595c/fff" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title"><a href="product.html" title="View Product">Product title</a></h4>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="row">
                                <div class="col">
                                    <p class="btn btn-danger btn-block">99.00 $</p>
                                </div>
                                <div class="col">
                                    <a href="#" class="btn btn-success btn-block">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <img class="card-img-top" src="https://dummyimage.com/600x400/55595c/fff" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title"><a href="product.html" title="View Product">Product title</a></h4>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <div class="row">
                                <div class="col">
                                    <p class="btn btn-danger btn-block">99.00 $</p>
                                </div>
                                <div class="col">
                                    <a href="#" class="btn btn-success btn-block">Add to cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
                <div class="col-12">
                    <nav aria-label="...">
                        <ul class="pagination">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item active">
                                <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Footer -->
<footer class="text-light">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-lg-4 col-xl-3">
                <h5>About</h5>
                <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                <p class="mb-0">
                    Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression.
                </p>
            </div>

            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto">
                <h5>Informations</h5>
                <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                <ul class="list-unstyled">
                    <li><a href="">Link 1</a></li>
                    <li><a href="">Link 2</a></li>
                    <li><a href="">Link 3</a></li>
                    <li><a href="">Link 4</a></li>
                </ul>
            </div>

            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto">
                <h5>Others links</h5>
                <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                <ul class="list-unstyled">
                    <li><a href="">Link 1</a></li>
                    <li><a href="">Link 2</a></li>
                    <li><a href="">Link 3</a></li>
                    <li><a href="">Link 4</a></li>
                </ul>
            </div>

            <div class="col-md-4 col-lg-3 col-xl-3">
                <h5>Contact</h5>
                <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                <ul class="list-unstyled">
                    <li><i class="fa fa-home mr-2"></i> My company</li>
                    <li><i class="fa fa-envelope mr-2"></i> email@example.com</li>
                    <li><i class="fa fa-phone mr-2"></i> + 33 12 14 15 16</li>
                    <li><i class="fa fa-print mr-2"></i> + 33 12 14 15 16</li>
                </ul>
            </div>
            <div class="col-12 copyright mt-3">
                <p class="float-left">
                    <a href="#">Back to top</a>
                </p>
                <p class="text-right text-muted">created with <i class="fa fa-heart"></i> by <a href="https://t-php.fr/43-theme-ecommerce-bootstrap-4.html"><i>t-php</i></a> | <span>v. 1.0</span></p>
            </div>
        </div>
    </div>
</footer>
    
</body>
</html>