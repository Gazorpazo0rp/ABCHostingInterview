$(document).ready(function(){
    //this cart object holds the user card information
    var cart={
        'apple':0,
        'beer':0,
        'water':0,
        'cheese':0,
        'paymentMethod':0
    }
    var items=['apple','beer','water','cheese'];
    //this function calculates the total price of items within the cart
    function getTotalPayment(){
        totalPayment= 0;
        for(i=0;i<items.length;i++){
            totalPayment+= cart[items[i]]* prices[items[i]];
        }
        shippingFare=$('input[name="payment_method"]:checked').val();
        if(shippingFare!=undefined){
            totalPayment +=parseFloat(shippingFare);
        }
        return totalPayment;
    }
    //this func updates the payment div in the cart with the financial information
    function updatePayment(){
        var Payment =getTotalPayment();
        $('#current_balance').html('Current balance: '+ currentBalance);

        $('#total_payment').html('Total price: '+Payment);
        $('#remaining_balance').html('This will be the remaining balance after the payment: '+ parseFloat(currentBalance-Payment));
    }

    cnt=1; //counts the number of items in the cart for the table # column

    function addToCart(toUpdate){
        if(cart[toUpdate]==0){
            $('#products_in_cart tbody').append('<tr><th scope="row">'+ cnt+'</th><td>'+ toUpdate+'</td><td>'+ cart[toUpdate]+'</td><td><input type="text" name="'+toUpdate +'" value="1"></td><td id="price'+ toUpdate+'">'+prices[toUpdate] +'</td><td><i class="removeItemFromCart fa fa-times" id="remove'+toUpdate+'"></i></td></tr>');
            cart[clickedType] +=1;
            cnt++;
            updatePayment();

        }  
        else{
            alert('This item is already in your cart. Please modify the amount if you need to buy more.')
        }
    }
    //this function emptires the cart after a successful order submission
    function clearCart(){
        $('#products_in_cart tbody').html("");
    }

    //this function removes an item from the cart by id 
    $('.cart').on("click",'.removeItemFromCart', function(){
        id= $(this).attr('id');
        id=id.slice(6);
        $(this).parent().parent().fadeOut('slow');
        cart[id]=0;
    });
    //this function updates the cart after a text input(amount) change
    function updateCart(toUpdate){
        for(i=0;i<items.length;i++){
            if(cart[items[i]]!=0){
                value=$('input[name="'+items[i] +'"]').val();
                //console.log(isNaN( value));
                if(!isNaN( value)){
                    cart[items[i]]=value;
                
                    $('#price'+items[i]).html(cart[items[i]]*prices[items[i]]);
                }
            }
        }
        updatePayment();
    }
    $('body').click(function(){
        updateCart();
    });
    //closes the cart
    $('.close_cart').click(function(){
        if($(".cart").css('display')=="block" ){
            $(".cart").fadeOut(500);
            $('.container').css('opacity',1);
        }
    });

    //initially hide the cart on load
    //$(".cart").css('display','none');
    //$(".cart").fadeOut(0);
    $(".toggle_cart").click(function(){
        if($(".cart").css('display')=="block" ){
            $(".cart").fadeOut(500);
            $('.container').css('opacity',1);
        }
        else{
            $('.container').css('opacity',0.4);
            $(".cart").fadeIn(500);
            $(".cart").css('opacity',1);
            updatePayment();
        }
    });
    //This func adds an item to the cart and shows it
    $(".add_to_cart").click(function(){
        $(".container").css('opacity',0.4);
        $(".cart").fadeIn(500);
        clickedType=$(this).data('which_product');
        addToCart(clickedType);     
    });
    //This function makes the payment request
    function pay( totalPayment){
        var request=$.ajax({
            url: 'pay',
            method: 'POST',
            data:cart,
            success: function(response){
                alert('Your order has been placed.');
                console.log(response);
                currentBalance-=totalPayment;
                $(".cart").fadeOut(500);
                $('.container').css('opacity',1);
                for(i=0;i<items.length;i++){
                    cart[items[i]]=0;
                }

                $('input[name="payment_method"]:checked').prop('checked', false);
                clearCart();

            },
            error: function(xhr, status, error) {
            console.log(error);
            }
        });
    }
    //this function validates if the payment will be valid 
    $(':input[type="submit"]').click(function(){
        payment_method= $('input[name="payment_method"]:checked').val();
        cart['payment_method']=payment_method;
        //check if cart is empty
        if(getTotalPayment()==0 ||getTotalPayment()==5 &&payment_method!=undefined){
            alert('Your cart is empty. You can\'t submit an empty order.');
            return;
        }
        if(currentBalance- getTotalPayment()>=0 ){
            if(payment_method != undefined){
                pay(getTotalPayment());
            }
            else{
                alert('You must select a payment method');
            }
        }
        else{
            alert('You don\'t have enough balance');
        }
    });
    function rateItem(ratingFor,rate){
        var request=$.ajax({
            url: 'rate',
            method: 'POST',
            data:{'item':ratingFor,'rating':rate},
            success: function(response){
                
                console.log(response);
                

            },
            error: function(xhr, status, error) {
            console.log(error);
            }
        });
    }
    $('.rating label').click(function(){
        ratingFor=$(this).attr('for');
        rate=ratingFor[4];
        ratingFor=ratingFor.slice(5);
        rateItem(ratingFor,rate);
        
    });
});