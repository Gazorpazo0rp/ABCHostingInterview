<?php
class item{
    private $unitPrice;
    private $itemName;
    public function __construct($price,$name){
        $this->unitPrice=$price;
        $this->itemName=$name;
    }
    public function getPrice(){
        return $this->unitPrice;
    }
    public function getName(){
        return $this->itemName;
    }
    public function setPrice($price){
         $this->unitPrice=$price;
    }
}

class apple extends item{
    public function __construct(){
        parent::__construct(0.3,"apple");

    }
}

class beer extends item{
    public function __construct(){
        parent::__construct(2,"beer");

    }
}

class water extends item{
    public function __construct(){
        parent::__construct(1,"water");

    }
}

class cheese extends item{
    public function __construct(){
        parent::__construct(3.74,"cheese");

    }
}