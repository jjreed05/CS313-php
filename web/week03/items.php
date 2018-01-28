<?php
class Headphone{
    public $name = 'default';
    public $price = 0.0;
    public $quantity = 0;
    public $description = '';
    public $image = '';
    
    // Constructor
    public function __construct($name, $price, $quantity, $description, $image){
        $this->name = $name;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->description = $description;
        $this->image = $image;
    }
    
    // Using this function to change quantity when needed
    public function setQuantity($quantity){
        $this->quantity = $quantity;
    }
}


/*echo "hello world!";

$class = new Headphone('Bob', 50.0, 1, '', '');

echo " Constructed <br>";
echo "Testing the name: ".$class->name; */
?>