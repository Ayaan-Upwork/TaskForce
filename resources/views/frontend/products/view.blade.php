@extends('layouts.front')
@section('title', $products->name)

@section('content')
    {{-- <div class="container">
        <div class="row">
            <div class="col-md-4">

            </div>
        </div>
    </div> --}}
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0">Collections / {{ $products->category->name }} /{{ $products->name }}</h6>
        </div>
    </div>
    <div class="container">
        <div class="card shadow product_data">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 border-right">
                        <img src="{{ asset('assets/uploads/product/'.$products->image) }}" class="w-100"  alt="">
                    </div>
                    <div class="col-md-8">
                        <h2 class="mb-0"> 
                            {{ $products->name }}
                            @if ( $products->trending  == '1')
                            <label style="font-size: 16px;" class="float-end badge bg-danger trending_tag">Trending</label>
                            @endif
                        </h2>

                        <hr>
                        <label class="me-3"> Original Price : <s>{{ $products->original_price }}</s> </label>
                        <label class="me-3"> Selling Price : <s>{{ $products->selling_price }}</s> </label>
                        <p class="mt-3">
                            {!! $products->small_description  !!}
                        </p>
                        <hr>
                        @if ($products->qty > 0)
                            <label class="badge bg-success">In Stock</label>
                        @else
                        <label class="badge bg-success">In Stock</label>
                        @endif
                        <div class="row mt-2">
                            <div class="col-md-2">
                                <input type="hidden" value="{{ $products->id }}" class="prod_id">
                                <label for="Quantity">Quantity</label>
                                <div class="input-group text-center mb-3">
                                    <button class="input-group-text decrement-btn">-</button>
                                    <input type="text" name="quantity " value="1" class="form-control qty-input">
                                    <button class="input-group-text increment-btn">+</button>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <br/>
                                <button type="button" class="btn btn-success  me-3 float-start">Add To Wishlist <i class="fa fa-heart"></i></button>
                                <button type="button" class="btn btn-success addtocart me-3 float-start">Add To Cart <i class="fa fa-shopping-cart"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
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
    </script>
@endsection