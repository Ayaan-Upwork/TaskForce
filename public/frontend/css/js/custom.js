$(document).ready(function(){
    $('.addtocart').click(function (e){
        e.preventDefault();
        var product_id = $(this).closest('.product_data').find('.prod_id').val();
        var product_qty = $(this).closest('.product_data').find('.qty-input').val();
        $.ajaxSetup({
         headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        $.ajax({
            method:"POST",
            url:"/add-to-cart",
            data:{
                'product_id':product_id,
                'product_qty':product_qty,

            },
            error: function(xhr, status, error) {
            alert(status);
            alert(xhr.responseText);
           },
            success:function(response){
                alert(response.status);
            }
        });


    });

    $('.increment-btn').click(function(e){
        e.preventDefault();
         
        var inc_value = $('.qty-input').val();
        var value = parseInt(inc_value,10);
        value = isNaN(value) ? 0 : value;
        if(value < 10)
        {
            value++;
            $('.qty-input').val(value);
        }
    });
});

$(document).ready(function(){
    $('.decrement-btn').click(function(e){
        e.preventDefault();
         
        var dec_value = $('.qty-input').val();
        var value = parseInt(dec_value,10);
        value = isNaN(value) ? 0 : value;
        if(value > 1)
        {
            value--;
            $('.qty-input').val(value);
        }
    });
});