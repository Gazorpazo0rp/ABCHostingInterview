<?php
require('item.php');
class ajaxController{
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
      
        $appleObj= new apple();
        $beerObj= new beer();
        $waterObj= new water();
        $cheeseObj= new cheese();

        $productsData=array($appleObj->getName() => $appleObj->getPrice(),$beerObj->getName() => $beerObj->getPrice(),$waterObj->getName() => $waterObj->getPrice(),$cheeseObj->getName() => $cheeseObj->getPrice());
        return $productsData;

       
    }
}