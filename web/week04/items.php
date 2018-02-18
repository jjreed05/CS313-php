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

class Orders{
    public $name = 'default';
    public $street = 'default';
    public $city = 'default';
    public $state = 'default';
    public $zip = '00000';
    public $email = '';
    public $orderDate = 'null';
    public $coinYear = '0000';
    public $coinName = 'default';
    public $orderId = '0';
    
    // Constructor
    public function __construct($name, $street, $city, $state, $zip, $email, $orderDate, $coinYear, $coinName, $orderId){
        $this->name = $name;
        $this->street = $street;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
        $this->email = $email;
        $this->orderDate = $orderDate;
        $this->coinYear = $coinYear;
        $this->coinName = $coinName;
        $this->orderId = $orderId;
    }    
}

/*echo "hello world!";

$class = new Headphone('Bob', 50.0, 1, '', '');

echo " Constructed <br>";
echo "Testing the name: ".$class->name; */
?>