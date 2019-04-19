<?php
require('ajaxController.php');
class route{
    private $routes=array();
    private $controller; 
    public function __construct(){
        $this->controller=new ajaxController();
    }
    public function Add($r){
        array_push($this->routes , $r);
    }
    public function redirect ($uri){
        foreach($this->routes as $key => $value){
            
            if( preg_match("#^$value#",$_GET['uri']) ){
                //Successful route
                if($value == "shop"){
                    readfile("shop.php");
                }
              
            }
            
        }
    }
}