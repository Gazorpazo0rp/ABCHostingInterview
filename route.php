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
        if(!isset($_SESSION['rated'])){
            $rated=array();
            $_SESSION['rated']=$rated;
        }

    }
    public function Add($r){
        array_push($this->routes , $r);
    }
    public function redirect(){
        $successfulRoute=0;
        $uri=isset($_GET['uri']) ? '/'. $_GET['uri'] : '/store';
        
        foreach($this->routes as $key => $value){
            if( $value==$uri ||$value.'/'==$uri) {
                //succcessful route
                $successfulRoute=1;
                //echo $uri;
                if($value == "/store"){
                    
                    $productsData= $this->controller->init();
                    $ratings=$this->controller->getRatings();
                    include 'storePage.php';
                }
                if($value=="/pay"){
                    $this->controller->pay();
                    $response=array("balance"=> $_SESSION['balance']);
                    echo (json_encode($response)) ;
                }
                if($value=="/rate"){
                    $newRate= $this->controller->rate();
                    echo $newRate;
                }
                if($value=="/test"){
                    echo "tested";
                }
            }
        }
        if(!$successfulRoute){
            echo"Wrong route. The store is available at / or /store ";
        }
    }
}