<?php
require('ajaxController.php');
class route{
    private $routes=array();
    private $controller; 
    public function __construct(){
        $this->controller=new ajaxController();
        session_start();
        if(!isset($_SESSION['balance'])){
            $_SESSION['balance']=100;

        }

        //OpenCon();
    }
    public function Add($r){

        array_push($this->routes , $r);
    }
    public function redirect(){

        $uri=isset($_GET['uri']) ? '/'. $_GET['uri'] : '/';
        //echo $uri;
        foreach($this->routes as $key => $value){
            if( preg_match("#^$value#",$uri) ){
                //echo "match".$value;
                if($value == "/store"){
                    //echo"haaaa";
                    $productsData= $this->controller->init();
                    include 'storePage.php';
                }
                if($value=="/pay"){
                    $this->controller->pay();
                    return $_SESSION['balance'];
                }
                
              
            }
            
        }
    }
}