<?php
require('item.php');
include ('DB.php');
class ajaxController{
   
    private $conn ;
    private $appleObj;
    private $beerObj;
    private $waterObj;
    private $cheeseObj;
    public function __construct(){
        $this->appleObj= new apple();
        $this->beerObj= new beer();
        $this-> waterObj= new water();
        $this-> cheeseObj= new cheese();
        $db=new DB();
        $this->conn=$db->getConn();
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
    public function getRatings(){
        $sql= "SELECT * FROM `ratings`"; 
        $queryRes=$this->conn->query($sql);
        $ratings=array();
        while ($row = mysqli_fetch_assoc($queryRes))
        {
            array_push($ratings,$row['rating']);
        }
        return $ratings;
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
    public function rate(){
        $itemName= $_POST['item'];
       
        $itemRate=$_POST['rating'];
        $sql= "SELECT * FROM `ratings` WHERE `productName` LIKE '".$itemName."'"; 
        $queryRes=$this->conn->query($sql);
        
        while ($row = mysqli_fetch_assoc($queryRes))
        {
            $currRating=$row['rating'];
            $numOfRaters=$row['numOfRatings'];
        }
        //if the item is already rated the new rating shouldn't change
        $newRating=$currRating;

        // validate session rating

        $rated=false;
        foreach($_SESSION['rated'] as $r){
            if ($r == $itemName){
                $rated=true;
            }
        }
        if(!$rated){
           
            $newRating=$currRating+($itemRate-$currRating)/($numOfRaters+1);
            $newRating= round( $newRating, 1, PHP_ROUND_HALF_EVEN);
            $sql= "UPDATE `ratings` SET `rating` = '" .$newRating ."' WHERE `ratings`.`productName` = '".$itemName."'";
            $queryRes=$this->conn->query($sql);
            $numOfRaters+=1;
            $sql= "UPDATE `ratings` SET `numOfRatings` = '" .$numOfRaters ."' WHERE `ratings`.`productName` = '".$itemName."'";
            $queryRes=$this->conn->query($sql);
            array_push($_SESSION['rated'],$itemName);
        }
           
        return $newRating;
    }
}