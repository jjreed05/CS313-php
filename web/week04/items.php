<?php
class Coin{
    public $year = 0;
    public $name = 'default';
    public $amount = 0;
    public $price = 0.00;
    public $category = 'default';
    public $image = '';
    public $itemNum = 0;
    
    // Constructor
    public function __construct($year, $name, $amount, $price, $category, $image, $itemNum){
        $this->year = $year;
        $this->name = $name;
        $this->amount = $amount;
        $this->price = $price;
        $this->category = $category;
        $this->image = $image;
        $this->itemNum = $itemNum;
    }
    
}


/*echo "hello world!";

$class = new Headphone('Bob', 50.0, 1, '', '');

echo " Constructed <br>";
echo "Testing the name: ".$class->name; */
?>