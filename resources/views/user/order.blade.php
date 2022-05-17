@extends('user.layout.style')
@section('content')
<section class=" py-5" style="min-height: 100vh">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-4">
                      <li class="breadcrumb-item"><a href="{{ route('user#index') }}">Home</a></li>
                      <li class="breadcrumb-item"><a href="{{ url('user#pizza-section') }}">Pizza Menu</a></li>
                      <li class="breadcrumb-item active" aria-current="page">Pizza Order</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4">
                <div class="card">
                    <img src="{{ asset('uploads/'.$pizza->image) }}" class="img-fluid" alt="" srcset="">
                </div>
                <a href="{{ route('user#pizzaDetail',$pizza->pizza_id) }}" class="mt-3 btn btn-outline-primary w-100">View Detail</a>
            </div>
            <div class="col-12 col-md-8">
                <div class="card shadow">
                    <div class="card-body">
                        @if (Session::has('totalTime'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Order Success! Please wait {{ Session::get('totalTime')}} minutes...</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <h3>{{ $pizza->pizza_name}}</h3>
                        {{-- <hr>
                        <p>{{ $pizza->description }}</p>
                        <hr> --}}
                        <div class="row">
                            <div class="col-4">
                                <h6 class="my-3">Buy 1 Get 1</h6>
                                <h6 class="my-3">Waiting time</h6>
                                <h5 class="my-3">Price for One</h5>
                            </div>
                            <div class="col-8">

                                @if ($pizza->buy_one_get_one_status == 0)
                                    <h6 class="my-3">Not Have</h6>
                                @else
                                    <h6 class="my-3 text-success">Have</h6>
                                @endif
                                <h6 class="my-3">{{ $pizza->waiting_time }} min</h6>
                                <h5 class="my-3 text-danger">{{ $pizza->price - $pizza->discount_price }} Ks</h5>
                            </div>
                        </div>
                        <hr>
                        <form action="{{ route('user#placeOrder')}}" method="POST">
                            @csrf
                            <div class="my-4">
                                <h6 class="mb-3">Pizza Count</h6>
                                <input type="number" name="pizzaCount" class="form-control" placeholder="how many pizza do you want to order">
                                @if ($errors->has('pizzaCount'))
                                    <small class="text-danger">{{ $errors->first('pizzaCount') }}</small>
                                @endif
                            </div>

                            <div class="">
                                <h6 class="mb-3">Payment Type</h6>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="paymentType" id="inlineRadio1" value="1">
                                    <label class="form-check-label" for="inlineRadio1">Credit Card</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="paymentType" id="inlineRadio2" value="2">
                                    <label class="form-check-label" for="inlineRadio2">Cash</label>
                                </div>
                                <br>
                                @if ($errors->has('paymentType'))
                                    <small class="text-danger">{{ $errors->first('paymentType') }}</small>
                                @endif
                            </div>
                            <hr>
                            <button type="submit" class="my-3 btn btn-primary rounded-pill text-white shadow">Place Order <i class="fas fa-shopping-cart ms-2"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
