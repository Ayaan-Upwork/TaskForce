@extends('layouts.front')

@section('title')
    Welcome to Admin-Shop
@endsection

@section('content')
    @include('layouts.inc.slider')
    <div class="py-5">
        <div class="container">
            {{-- <div class="row">
                <h2>Featured Products</h2>
                <div class="owl-carousel featured-carousel owl-theme">
                    @foreach ($featured_products as $item)
                    <div class="item">
                        <div class="card">
                            <img src="{{ asset('assets/uploads/product/'.$item->image) }}" alt="Product Image">
                            <div class="card-body">
                                <h5>{{ $item->name }}</h5>
                                <span class="float-start">{{ $item->selling_price }} </span>
                                <span class="float-end"> <s> {{ $item->original_price }} </s></span>
                                <small>  </small>
                            </div>
                        </div>
                    </div>                    
                    @endforeach
                </div>
            </div> --}}
        </div>
    </div>
    <div class="py-5">
        <div class="container">
            {{-- <div class="row">
                <h2>Trending Category</h2>
                <div class="owl-carousel trending-carousel owl-theme">
                    @foreach ($trending_category as $category)
                    <div class="item">
                        <a href=" {{ url('view-category/'.$category->slug) }} ">
                        <div class="card">
                            <img src="{{ asset('assets/uploads/category/'.$category->image) }}" alt="Product Image">
                            <div class="card-body">
                                <h5>{{ $category->name }}</h5>
                                <p>
                                    {{ $category->description }}
                                </p>
                            </div>
                        </div>
                    </a>
                    </div>                    
                    @endforeach
                </div>
            </div> --}}
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.featured-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:3
        }
    }
})

$('.trending-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    dots:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:3
        }
    }
})
    </script>
@endsection