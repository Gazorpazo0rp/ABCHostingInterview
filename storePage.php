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
    <!--include the style and script -->
    <link rel="stylesheet"  type="text/css" href="Css/style.css" />
    <script  src="JS/script.js" > </script>
</head>
<body>  
  <script>
    //this script initializes an array that will hold the products prices
    //this is needed for the script.js to run properly
    var prices={'apple':0,'beer':0,'water':0,'cheeses':0};
    //save the current balance to use in script.js 
    currentBalance=<?php echo $_SESSION['balance'];?> ;
  </script>
  <nav class="navbar navbar-dark bg-dark">
    <!-- Navbar content -->
    <i class="fa fa-shopping-cart toggle_cart"></i> 
  </nav>
  <div class="container">
    <h4> These are the available products right now. Click on add to cart, select the amount and the payment methon then submit your order!</h4>
    <div class="row">
      <?php 
        $counter=0;
      // the key is the product name and the value is the prodyct price
        foreach($productsData as $key=>$value){
          echo'<div class="col-sm product_box">
          <h3 class="product_header">'.$key .'</h3> 
          <img class="product_img" src="Images/'. $key.'.png ">
          <h5 class="price_tag"> Price/unit: '.$value. '$</h5>
          <fieldset class="rating">

            <input type="radio" id="star5'.$key.'" name="rating'.$key.'" value="5" /><label for="star5'.$key.'" title="Rocks!">5 stars</label>
            <input type="radio" id="star4'.$key.'" name="rating'.$key.'" value="4" /><label for="star4'.$key.'" title="Pretty good">4 stars</label>
            <input type="radio" id="star3'.$key.'" name="rating'.$key.'" value="3" /><label for="star3'.$key.'" title="Meh">3 stars</label>
            <input type="radio" id="star2'.$key.'" name="rating'.$key.'" value="2" /><label for="star2'.$key.'" title="Kinda bad">2 stars</label>
            <input type="radio" id="star1'.$key.'" name="rating'.$key.'" value="1" /><label for="star1'.$key.'" title="Sucks big time">1 star</label>
          </fieldset>
          <h4 class="rating_tag">'.$ratings[$counter].' stars</h4>
          <button data-which_product="'.$key.'" class=" button add_to_cart"> Add to cart <i  class="fa fa-shopping-cart"></i></button>
          <script>prices["'.$key.'"]= '.$value.'</script>
          </div>';
          $counter++;
        }

      ?>
    </div>
  </div>
  <div class="cart">
    <h1 style="color:rgb(243, 164, 73);" >Your Cart </h1> <i  class="fa fa-times close_cart"></i>
    <hr>
    <div>
      <table id="products_in_cart" class="table table-striped">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Product Name</th>
            <th scope="col">Unit Price</th>
            <th scope="col">Amount</th>
            <th scope="col">SubTotal</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>   
    <h4 id="current_balance"> Current balance:<?php echo $_SESSION['balance'];?></h4>
    <h4 id ="total_payment"> </h4>
    <h4 id="remaining_balance"></h4>   
    <input type="radio" name="payment_method" value="0"> Pick up(0$)
    <input type="radio" name="payment_method" value="5"> UPS(5$)     
    <button type="submit" class="button pay_button">Pay</button>
  </div>
  <div class="container">
      <h3>This is a simple User interface to try the following functionalities:</h3>
      <hr>
      <h5>- Add the above products to the cart.</h5>
      <h5>- View the cart and select the required amounts of each product.</h5>
      <h5>- View the subtotal, the total price, the current balance and the remaining balance after the transaction.</h5>
      <h5>- Submit the payment after selecting the payment method.</h5>
      <h3> Notes:</h3>
      <hr>
      <h5>- The balance is session based so whenever you clear the browser cache it resets to 100$ </h5>
      <h5>- This system is designed with OOP with a herirarchy inheritance tree so the items Prices are not stored in the database. </h5>
      <h5>- This GUI is meant to be very simple but user-friendly. Sophistication won't help with such a simple system with that low number of features.</h5>


  </div>
        
        <form method="POST" action="rate">
          <input type="text" name="item">
          <input type="text" name="rating">
          <button type="submit"></button>
      </form>
      
</body>