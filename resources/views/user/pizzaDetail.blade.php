@extends('user.layout.style')
@section('content')
<section class="py-5" style="min-height: 100vh">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-4">
                      <li class="breadcrumb-item"><a href="{{ route('user#index') }}">Home</a></li>
                      <li class="breadcrumb-item"><a href="{{ url('user#pizza-section') }}">Pizza Menu</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Pizza Details</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="card">
                    <img src="{{ asset('uploads/'.$pizza->image) }}" class="img-fluid" alt="" srcset="">
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h3>{{ $pizza->pizza_name}}</h3>
                        <hr>
                        <p>{{ $pizza->description }}</p>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <h6 class="my-3">Price</h6>
                                <h6 class="my-3">Discount</h6>
                                <h6 class="my-3">Buy 1 Get 1</h6>
                                <h6 class="my-3">Waiting time</h6>
                            </div>
                            <div class="col-8">
                                <h6 class="my-3">{{ $pizza->price }} Ks</h6>
                                <h6 class="my-3">{{ $pizza->discount_price }} Ks</h6>
                                @if ($pizza->buy_one_get_one_status == 0)
                                    <h6 class="my-3">Not Have</h6>
                                @else
                                    <h6 class="my-3 text-success">Have</h6>
                                @endif
                                    <h6 class="my-3">{{ $pizza->waiting_time }} min</h6>
                            </div>
                        </div>
                        <hr>
                        <h4>Total Price : <span class="text-danger ms-4"> {{ $pizza->price - $pizza->discount_price }} Ks</span></h4>
                        <a href="{{ route('user#order') }}" class="mt-3 btn btn-primary rounded-pill text-white">Order Now <i class="fa-solid fa-angle-right ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
