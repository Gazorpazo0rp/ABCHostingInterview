<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Store</title>
    <!--jqurey-->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!--Bootstrap-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <link rel="stylesheet"  type="text/css" href="Css/style.css" />
    <script  src="JS/script.js" > </script>
    <?php require('ajaxController.php'); 
      $controller= new ajaxController();
      $productsData= $controller->init();
      //print_r($productsData);

    ?>
</head>
<body>  
<nav class="navbar navbar-dark bg-dark">
  <!-- Navbar content -->
   <i class="fa fa-shopping-cart"></i> 
</nav>
<div class="container">
  <div class="row">
    <?php 
    // the key is the product name and the value is the prodyct price
      foreach($productsData as $key=>$value){
        echo'<div class="col-sm product_box">
        <h3 class="product_header">'.$key .'</h3> 
        
      <img class="product_img" src="Images/'. $key.'.png ">
      <h5 class="price_tag"> Price/unit: '.$value. '$</h5>
      <button class="add_to_cart"> Add to cart <i  class="fa fa-shopping-cart"></i></button>
      </div>';
      }

    ?>
    
    
  </div>
</div>


</div>

    
</body>