<?php
include_once("connectDb.php");

// Make sure the button was clicked
if (isset($_POST['insert'])){
    $coinYear = $_POST['coinYear'];
    $coinName = $_POST['coinName'];
    $coinAmount = $_POST['coinAmount'];
    $saleprice = $_POST['saleprice'];
    $category = $_POST['category'];
    $categoryId = 0;
    
    
    // Image upload
    $file = $_FILES['image'];
    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileSize = $_FILES['image']['size'];
    $fileError = $_FILES['image']['error'];
    $fileType = $_FILES['image']['type'];
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    
    // Only allow jpg extentions
    $allowed = array('jpg', 'jpeg');
    
    // Check jpg extentions
    if(in_array($fileActualExt, $allowed)){
        if ($fileError === 0){
            // Dont allow a large file
            if($fileSize < 1000000){
                $fileNameNew = uniqid('', true).".JPG";
                $fileDestination = "pictures/".$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
            }
            else {
                $errorMessage = "Your file is too big";
                header("Location: adminPage.php?error=$errorMessage");
                die();
            } 
        }
        else{
            $errorMessage = "There was error with the file";
            header("Location: adminPage.php?error=$errorMessage");
            //die();
        }
    }
    else{
        $errorMessage =  "Not a jpg file";
        header("Location: adminPage.php?error=$errorMessage");
        die();
    }
    
    // Insert into images column
    $imageUrl = "pictures/".$fileNameNew;
    $query = "INSERT INTO images (imgName, img) VALUES (:imgName, :img)";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':imgName', $coinName, PDO::PARAM_STR);
    $stmt->bindValue(':img', $imageUrl, PDO::PARAM_STR);
    $stmt->execute();
    $imgId = $db->lastInsertId('images_id_seq');
    
    // Check to see if the category has already been inserted
    $query = "SELECT category FROM categories WHERE category=:category";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':category', $category, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // If it hasn't been inserted, insert new category
    if($row == FALSE){
        $query = "INSERT INTO categories (category) VALUES (:category)";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':category', $category, PDO::PARAM_STR);
        $stmt->execute();
        $categoryId = $db->lastInsertId('categories_id_seq');
    }
    // Get the categoryId number otherwise
    else{
        $query = "SELECT * FROM categories WHERE category=:category";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':category', $category, PDO::PARAM_STR);
        $stmt->execute();  
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $categoryId = $row['id'];
    }
    
    // Insert the new coin
    $query = "INSERT INTO products (coinyear, coinname, coinamount, saleprice, imageid, categoryid) VALUES (:coinYear, :coinName, :coinAmount, :saleprice, :imageId, :categoryId)";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':coinYear', $coinYear, PDO::PARAM_INT);
    $stmt->bindValue(':coinName', $coinName, PDO::PARAM_STR);
    $stmt->bindValue(':coinAmount', $coinAmount, PDO::PARAM_INT);
    $stmt->bindValue(':saleprice', $saleprice, PDO::PARAM_STR);
    $stmt->bindValue(':imageId', $imgId, PDO::PARAM_INT);
    $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
    $stmt->execute();
    
    header("Location: adminPage.php?uploadSuccess");
}

?>