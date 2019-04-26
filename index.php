<?php
include ('route.php');

$routerObj=new route();

$routerObj->Add('/store');
$routerObj->Add('/pay');
$routerObj->Add('/rate');
$routerObj->Add('/test');
echo $_GET['uri'];
$routerObj->redirect();



