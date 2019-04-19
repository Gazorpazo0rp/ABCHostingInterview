<?php
include ('route.php');

$routerObj=new route();

$routerObj->Add('shop');

$routerObj->Add('submit');

$routerObj->redirect($_GET['uri']);


