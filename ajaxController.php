<?php
require('item.php');
class ajaxController{
    private $appleObj;
    private $beerObj;
    private $waterObj;
    private $cheeseObj;
    public function __construct(){
        $this->appleObj= new apple();
        $this->beerObj= new beer();
        $this-> waterObj= new water();
        $this-> cheeseObj= new cheese();
    }
    public function getPrice(){
        $appleObj= new apple(5);
        $price= $appleObj->getPrice();
        return $price;

    }
    function getSubclassesOfItem($parent="item") {
        $result = array();
        foreach (get_declared_classes() as $class) {
            if (is_subclass_of($class, $parent))
                $result[] = $class;
        }
        return $result;
    }
    // init function prepares all the data neeeded for loading the shop page
    public function init(){
        $productsData=array($this->appleObj->getName() => $this->appleObj->getPrice(),$this->beerObj->getName() => $this->beerObj->getPrice(),$this->waterObj->getName() => $this->waterObj->getPrice(),$this->cheeseObj->getName() => $this->cheeseObj->getPrice());
        return $productsData;
    }
    public function pay(){
        //Recalculation of the total price in the server 
        //passing such sensitive information is so dangerous in such basic frameworkless system
        $totalCost=0;
        if(isset($_POST['apple'])){
            $totalCost+= $_POST['apple']*$this->appleObj->getPrice();
        }
        if(isset($_POST['beer'])){
            $totalCost+= $_POST['beer']*$this->beerObj->getPrice();
        }
        if(isset($_POST['water'])){
            $totalCost+= $_POST['water']*$this->waterObj->getPrice();
        }
        if(isset($_POST['cheese'])){
            $totalCost+= $_POST['cheese']*$this->cheeseObj->getPrice();
        }
        $totalCost+=$_POST['payment_method'];
        $prev_balance=$_SESSION['balance'];
        $_SESSION['balance']=$prev_balance-$totalCost;
        return ;
    }
    
}