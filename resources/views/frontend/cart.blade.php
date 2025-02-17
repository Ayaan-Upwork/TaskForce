@extends('layouts.front')
@section('title')
    Cart
@endsection

@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">
            <a href="{{ url('/') }}">
            Home
            </a> /
            <a href="{{ url('cart') }}">
               Cart
            </a> 
        </h6>
    </div>
</div>

<div class="container my-5">
    <div class="card shadow product_data">
        <div class="card-body">
            @foreach ($cartitems as $item)
                
            @endforeach
                <div class="row">
                    <div class="col-md-2">
                        <img src="{{ asset('assets/uploads/product/'.$item->products->image) }}" height="70px" width="70px" class="w-100"  alt="">
                    </div>
                    <div class="col-md-5">
                        <h6>
                            {{ $item->products->name }}
                        </h6>
                    </div>
                    <div class="col-md-3">
                        <input type="hidden" class="prod_id">
                        <label for="Quantity">Quantity</label>
                        <div class="input-group text-center mb-3" style="width:130px;">
                            <button class="input-group-text decreament-btn">-</button>
                            <input type="text" name="quantity" class="form-control qty-input text-center" value="{{ $item->prod_qty }}">
                            <button class="input-group-text increment-btn">+</button>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <h6>Remove</h6>
                    </div>
                </div>
        </div>
    </div>
</div>

@endsection
{{-- @section('scripts')
    <script>
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
            $('.decreament-btn').click(function(e){
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
@endsection --}}