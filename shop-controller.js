
//Add to Cart Jquery Ajax
$(document).on('click','.addToCart', function(){
    var prodname = $(this).data('prodname');
    var prodprice = $(this).data('prodprice');
    var prodcode = $(this).data('prodcode');
    var prodid = $(this).data('prodid')
    var qty = $(this).data('qty');

    $.ajax({
        url: 'shop-controller.php',
        method: 'POST',
        cache: false,
        data:{'func':'addedtocart', 'prodid': prodid, 'prodname': prodname, 'prodprice': prodprice, 'prodcode': prodcode, 'qty': qty},
        success: function(data){
            //window.location.href = "shop.php";
            alert('Successfully Added to Cart!');
            $.ajax({
                url: 'shop-controller.php',
                method: 'GET',
                dataType:'json',
                data:{'func':'getcartcnt'},
                success: function(data){
                    console.log(data);
                    $.each( data[0], function( key, value ) {
                        $('.cart-count').html(value);
                    });
                },
                error: function(data){
                    console.log('There Something Wrong With Code!');
                }
            });

        },
        error: function(data){
            console.log('There Something Wrong With Code!');
        }
    });
});




$(document).on('click','.AddOrder',function(){
    var orderaddress = $('#orderAdd').val();
    var mobilenumber = $('#contactNumber').val();
    var paymentopt = $('#paymentopt').val();
    var subtotal = $(this).data('subtotal');
    var grandtotal = $(this).data('grandtotal');
    var totalqty = $(this).data('totalqty');
    
    if(orderaddress !== ''){

        $.ajax({
            url: 'shop-controller.php',
            method: 'POST',
            cache: false,
            data:{'func':'placedorder', 'orderaddress':orderaddress, 'mobilenumber':mobilenumber, 'paymentopt': paymentopt, 'subtotal':subtotal, 'grandtotal':grandtotal, 'totalqty':totalqty},
            success: function(data){
                //window.location.href = "shop.php";
                alert('Successfully Placed Order!');
                location.reload();
            },
            error: function(data){
                console.log('There Something Wrong With Code!');
            }
        });


    }else{
        alert('Please Put Order Address');
    }
});





$(document).on('click','.OrderDetails', function(){
    var orderid = $(this).data('orderid');

    $.ajax({
        url: 'shop-controller.php',
        method: 'GET',
        dataType:'json',
        data:{'func': 'orderdetails','orderid': orderid},
        success: function(data){
            //console.log(data);
            var rows = '';
            $.each( data, function( key, value ) {
                  rows = '<tr class="cart-product">'
                        + '<td data-title="Name"><p>'+ value.prodname +'</p></td>'
                        + '<td data-title="Image"><img class="product-img-profile" src="images/'+value.prodimg+'"></td>'
                        + '<td data-title="Quantity">'+value.prodqty+'</td>'
                        + '<td data-title="Price">'+value.prodprice+'</td>'
                        + '<td data-title="Total">'+ value.prodprice * value.prodqty +'</td>'
                        + '</tr>';
                  $('.cart-info').append(rows);
            });

        },
        error: function(data){

        }
    });
});