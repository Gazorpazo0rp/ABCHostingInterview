$(document).ready(function(){
    var cart={
        'apple':0,
        'beer':0,
        'water':0,
        'cheese':0
    }
    var items=['apple','beer','water','cheese'];

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
    function updatePayment(){
        var Payment =getTotalPayment();
        $('#current_balance').html('Current balance: '+ currentBalance);

        $('#total_payment').html('Total price: '+Payment);
        $('#remaining_balance').html('This will be the remaining balance after the payment: '+ parseFloat(currentBalance-Payment));
    }


    cnt=1; //counts the number of items in the cart for the table # column
    function addToCart(toUpdate){
        if(cart[toUpdate]==0){
            $('#products_in_cart tbody').append('<tr><th scope="row">'+ cnt+'</th><td>'+ toUpdate+'</td><td>'+ cart[toUpdate]+'</td><td><input type="text" name="'+toUpdate +'" value="1"></td><td id="price'+ toUpdate+'">'+prices[toUpdate] +'</td></tr>');
            cart[clickedType] +=1;
            cnt++;
            updatePayment();

        }  
        else{
            alert('This item is already in your cart. Please modify the amount if you need to buy more.')
        }
    }
    function clearCart(){
        $('#products_in_cart tbody').html("");
    }
    function updateCart(toUpdate){
        for(i=0;i<items.length;i++){
            if(cart[items[i]]!=0){
                cart[items[i]]=$('input[name="'+items[i] +'"]').val();
                $('#price'+items[i]).html(cart[items[i]]*prices[items[i]]);
            }
        }
        updatePayment();
    }
    $('body').click(function(){
        updateCart();
    });
    $('.close_cart').click(function(){
        if($(".cart").css('display')=="block" ){
            $(".cart").fadeOut(500);
            $('.container').css('opacity',1);
        }
    });

    //initially hide the cart on load
    $(".cart").css('display','none');
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
    $(".add_to_cart").click(function(){
        $(".container").css('opacity',0.4);
        $(".cart").fadeIn(500);
        clickedType=$(this).data('which_product');
        addToCart(clickedType);     
    });
    
    function pay( totalPayment){
        var request=$.ajax({
            url: 'pay',
            method: 'POST',
            data:cart,
            success: function(response){
                alert('Your order has been placed.');
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
    $(':input[type="submit"]').click(function(){
        payment_method= $('input[name="payment_method"]:checked').val();
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


});