<?php
include ('route.php');
include ('DB.php');


OpenCon();
$routerObj=new route();

$routerObj->Add('/store');
$routerObj->Add('/pay');
$routerObj->redirect();



