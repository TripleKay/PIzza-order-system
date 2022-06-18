@extends('user.layout.style')
@section('content')
    <!-- -------------------------------home section------------------------------------- -->
    <section class="home-section d-flex align-items-center" id="home-section">
        <!-- -------------------------------banner------------------------------------- -->
        <div class="container">
            <div  class="row align-items-center py-md-0" style="">
                <div class="col-6 col-md-12 col-lg-6">
                    <div class="left-banner-container">
                        <h5 class="banner-small-title">Free Home Delivery 24 Hours</h5>
                        <h1 class="banner-title my-3 fw-bolder">THE TASTIEST & BEST PIZZA IN THE TOWN</h1>
                        <p class="text-secondary my-4 long-para">Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid sequi ratione quod! Laudantium veniam odio eum dolorum nesciunt temporibus, nihil commodi ipsa voluptas autem doloremque, id in officiis totam possimus!</p>
                        <a href="#pizza-section" class="btn btn-primary text-white rounded-pill shadow-lg">Order Now <i class="fa-solid fa-angle-right ms-2"></i></a>
                        <a href="#pizza-section" class="btn btn-outline-primary rounded-pill ms-3">Show Menu</a>
                    </div>
                </div>
                <div class="col-6 col-md-12 col-lg-6">
                    <div class="right-banner-container py-5 py-md-0">
                        <div class="img-box-color d-none d-md-block"></div>
                        <img src="{{ asset('customer/img/banner_image.png') }}" class="banner-img img-fluid" alt="" srcset="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- -------------------------------service section------------------------------------- -->
    <section class="service-section py-5 bg-white" id="service-section" style="min-height: 300px;">
        <div class="container">
            <div class="row">
                <div class="col-4 col-md-4">
                    <div class="service-box card bg-white border-0" style="border-radius: 30px ;">
                        <div class="card-body text-center">
                            <img src="{{ asset('customer/img/bike.png') }}" class="img-fluid" alt="" srcset="" style="width: 80px;">
                            <h5 class="mt-4">Fastest Delivery</h5>
                            <p class="d-none d-md-block text-black-50">Delivery that is always anytime even faster</p>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4">
                    <div class="service-box card bg-white border-0" style="border-radius: 30px ;">
                        <div class="card-body text-center">
                            <img src="{{ asset('customer/img/order.jpg') }}" class="img-fluid" alt="" srcset="" style="width: 80px;">
                            <h5 class="mt-4">Easy To Order</h5>
                            <p class="d-none d-md-block text-black-50">You only need a few steps in ordering food</p>
                        </div>
                    </div>
                </div>
                <div class="col-4 col-md-4">
                    <div class="service-box card bg-white border-0" style="border-radius: 30px ;">
                        <div class="card-body text-center">
                            <img src="{{ asset('customer/img/pizza.png') }}" class="img-fluid" alt="" srcset="" style="width: 80px;">
                            <h5 class="mt-4">Tasty Pizza</h5>
                            <p class="d-none d-md-block text-black-50">The tastiest and fresh pizza in town</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- -------------------------------pizza section------------------------------------- -->
    <section class="pizza-section" id="pizza-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-9">
                    <div class="pizza-left-container">
                        <div class="row">
                            <div class="col-12">
                                <div class="px-3 py-2 bg-white rounded d-flex justify-content-between align-items-center" style="border-radius: 10px !important;">
                                    <h4 class="mb-0">Our Pizza Menu</h4>
                                    <button class="btn btn-outline-primary btn-sm d-block d-sm-none show-mobileFilter-btn">Filter</button>
                                </div>
                            </div>
                        </div>
                        <!-- -------------------------------pizza-box-container------------------------------------- -->
                        <div class="pizza-box-container my-4">
                            <div class="row">
                                <!-- -------------------------------pizza-boxs------------------------------------- -->
                                @if ($emptyStatus == 0)
                                    <div class="col-12 d-flex align-items-center justify-content-center" style="min-height: 300px">
                                        <div class="text-danger p-3 bg-white  text-center" style="border-radius: 10px">
                                            <img src="{{ asset('customer/img/pizza.png') }}" class="mb-3" alt="" srcset="" style="width: 80px;">
                                            <h5>There is no Pizza.</h5>
                                        </div>
                                    </div>
                                @else
                                    @foreach ($pizzas as $item)
                                        <div class="col-6 col-md-6 col-lg-4">
                                            <div class="card pizza-card position-relative">
                                                <!-- -------------------------------ribbon------------------------------------- -->
                                                @if ($item->buy_one_get_one_status == 1)
                                                    <div class="ribbon h6 mb-0">Buy 1 Get 1</div>
                                                @endif
                                                <div class="card-body">
                                                    <div class="card-img-container overflow-hidden" style="border: .5px solid #E7E2E2">
                                                        <img src="{{ asset('uploads/'.$item->image) }}" class="img-fluid" alt="" srcset="">
                                                    </div>
                                                    <div class="mt-4">
                                                        <h5>{{ $item->pizza_name }}</h5>
                                                        <div class="d-flex justify-content-between flex-wrap pizza-dis my-2">
                                                            <span class="">Discount: {{ $item->discount_price }} Ks</span>
                                                            <span class="d-none d-md-block">Waiting Time: {{ $item->waiting_time }} min</span>
                                                        </div>
                                                        <div class="d-flex justify-content-between align-items-center flex-wrap my-2">
                                                            <div class="h5 mb-0">{{ $item->price }} Ks</div>
                                                            <a href="{{ route('user#pizzaDetail',$item->pizza_id) }}" class="btn btn-primary px-3 mt-2 rounded-pill text-white pizza-box-btn">View Detail</a>
                                                        </div>
                                                        {{-- <a  href="" class="btn btn-primary rounded-pill w-100 text-white">Order Now</a> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <!-- -------------------------------pizza-boxs------------------------------------- -->

                            </div>

                        </div>

                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <!-- -------------------------------pizza-right-container------------------------------------- -->
                    <div class="pizza-right-container card border-0  bg-white p-3">
                        <div class="d-flex d-sm-none justify-content-between align-items-center mb-4 filter-close-bar bg-white">
                            <h6>Filter Option</h6>
                            <button class="btn btn-sm btn-dark mb-3 shadow hide-mobileFilter-btn"><i class="fas fa-times"></i></button>
                        </div>
                        <!-- -------------------------------search bar------------------------------------- -->
                        <form action="{{ route('user#searchPizza') }}" method="GET">
                            {{-- @csrf --}}
                            <div class="d-flex pizza-search-bar" style="border-radius: 10px">
                                <input type="text" name="search" class="form-control  bg-transparent border-0" placeholder="search pizza ....">
                                <button class="btn px-1 pe-2"><i class="fas fa-search text-primary" style="font-size: 20px ;"></i>
                                </button>
                            </div>
                        </form>
                        <!-- -------------------------------category------------------------------------- -->
                        <div class="my-5">
                            <h5 class="mb-4">Category Lists</h5>
                            <div class="">

                                <div  catId="" class="categoryBtn btn bg-white d-flex justify-content-between mb-2 category  py-2 {{ request()->url() == route('user#index') ? 'active' : '' }}">
                                    <p class="mb-0">All Categories</p>
                                </div>
                                @foreach ($categories as $item)
                                    <div catId="{{ $item->category_id }}"  class="categoryBtn btn bg-white d-flex justify-content-between mb-2 category py-2 {{ request()->url() == route('user#searchCategory',$item->category_id) ? 'active' : '' }}">
                                        <p class="mb-0">{{$item->category_name}}</p>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <form action="{{ route('user#searchPizzaItem') }}" method="GET">
                            @csrf
                            <!-- -------------------------------price------------------------------------- -->
                            <div class="mb-3">
                                <h5 class="mb-4">Filter By Price</h5>

                                <div class="d-flex">
                                    <input type="number" name="minPrice" class="form-control" placeholder="min price">
                                    <input type="number" name="maxPrice" class="form-control ms-1" placeholder="max price">
                                </div>

                            </div>
                            <!-- -------------------------------date------------------------------------- -->
                            <div class="mb-5">
                                <h5 class="mb-4">Filter By Date</h5>
                                <input type="date" name="startDate" class="form-control mb-2">
                                <input type="date" name="endDate" class="form-control">
                            </div>
                            <button class="btn btn-outline-primary w-100" type="submit">Filter <i class="fas fa-search ms-3"></i></button>
                        </form>
                        <!-- -------------------------------pagination------------------------------------- -->
                        <div class="pizza-pigination">
                            @if ($pizzas->total() > 6)
                                <hr>
                            @endif
                            {{ $pizzas->links() }}
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- -------------------------------Contact section------------------------------------- -->
    <section class="contact-section bg-white" id="contact-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-5 text-center">CONTACT US</h3>
                </div>
            </div>
            <div class="row px-0 px-md-5">
                <div class="col-12">
                    <div class="card shadow-lg border-0 overflow-hidden" style="border-radius: 10px !important;">
                        <div class="">
                            <div class="row">
                                <div class="col-12 col-md-5 bg-primary">
                                    <div class=" h-100 d-flex flex-column justify-content-center" style="border-radius: 10px ;">
                                        <div class="d-flex align-items-center bg-white mt-4 mx-5 p-3" style="border-radius: 10px ;">
                                            <i class="fas fa-phone"></i>
                                            <span class="mb-0 ms-3">+95 9123 4567 89</span>
                                        </div>
                                        <div class="d-flex align-items-center bg-white my-4 mx-5 p-3" style="border-radius: 10px ;">
                                            <i class="fas fa-envelope"></i>
                                            <span class="mb-0 ms-3">example@gmail.com</span>
                                        </div>
                                        <div class="d-flex align-items-center bg-white mb-4 mx-5 p-3" style="border-radius: 10px ;">
                                            <i class="fab fa-facebook"></i>
                                            <span class="mb-0 ms-3">Pizza Facebook Page</span>
                                        </div>
                                        <div class="d-flex align-items-center bg-white mb-4 mx-5 p-3" style="border-radius: 10px ;">
                                            <i class="fas fa-map-marked-alt"></i>
                                            <span class="mb-0 ms-3">Yangon Region, Myanmar</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-7 bg-white">
                                    @if (Session::has('success'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <strong>{{ Session::get('success')}}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    @endif
                                    <form action="{{ route('user#createContact') }}" class="py-4 px-5" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="" class="form-label">Your Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="enter your name ....">
                                            @if ($errors->has('name'))
                                                <small class="text-danger">{{ $errors->first('name') }}</small>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Email Address</label>
                                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="enter your email ....">
                                            @if ($errors->has('email'))
                                                <small class="text-danger">{{ $errors->first('email') }}</small>
                                            @endif
                                        </div>
                                        <div class="mb-3">
                                            <label for="" class="form-label">Message</label>
                                            <textarea name="message" id=""  rows="5" class="form-control" placeholder="say something .....">{{ old('message') }}</textarea>
                                            @if ($errors->has('message'))
                                                <small class="text-danger">{{ $errors->first('message') }}</small>
                                            @endif
                                        </div>
                                        <button type="submit" class="btn btn-primary text-white shadow mt-3">Send <i class="fas fa-paper-plane ms-3"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        let pizzaHtml = "";
        //to check buy one buy one
        function buyOneGetOne(status){
            let buyOneGetOne = "";
                if(status == 1){
                    buyOneGetOne = `<div class="ribbon h6 mb-0">Buy 1 Get 1</div>`;
                }
                return buyOneGetOne;
        }
        //to show pizza lists
        function showPizza(response){
            for(let i = 0; i < response.pizzas.length; i++){
                pizzaHtml += `
                <div class="col-6 col-md-6 col-lg-4">
                    <div class="card pizza-card position-relative">
                        ${buyOneGetOne(response.pizzas[i].buy_one_get_one_status)}
                        <div class="card-body">
                            <div class="card-img-container overflow-hidden" style="border: .5px solid #E7E2E2">
                                <img src="{{ asset('uploads') }}/${response.pizzas[i].image}" class="img-fluid" alt="" srcset="">
                            </div>
                            <div class="mt-4">
                                <h5>${response.pizzas[i].pizza_name}</h5>
                                <div class="d-flex justify-content-between flex-wrap pizza-dis my-2">
                                    <span class="">Discount: ${response.pizzas[i].discount_price} Ks</span>
                                    <span class="d-none d-md-block">Waiting Time: ${response.pizzas[i].waiting_time} min</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center flex-wrap my-2">
                                    <div class="h5 mb-0">${response.pizzas[i].price} Ks</div>
                                    <a href="{{ route('user#pizzaDetail','') }}/${response.pizzas[i].pizza_id}" class="btn btn-primary px-3 mt-2 rounded-pill text-white pizza-box-btn">View Detail</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                `;
            }
            return pizzaHtml;
        }
        //search By category
        $('.categoryBtn').on('click',function(){
            //get cat id
            let catId = $(this).attr('catId');
            //for ui
            $('.category').removeClass('active');
            $(this).addClass('active');
            $('.pizza-pigination').addClass('d-none');
            //ajax
            $.ajax({
                url: "{{ route('user#searchCategory') }}",
                method: "post",
                dataType: "json",
                data: {
                    _token: '{{ csrf_token() }}',
                    id: catId,
                },
                success:function(response){
                    pizzaHtml = "";
                    if(response.emptyStatus == 0){
                        pizzaHtml = `
                                    <div class="col-12 d-flex align-items-center justify-content-center" style="min-height: 300px">
                                        <div class="text-danger p-3 bg-white  text-center" style="border-radius: 10px">
                                            <img src="{{ asset('customer/img/pizza.png') }}" class="mb-3" alt="" srcset="" style="width: 80px;">
                                            <h5>There is no Pizza.</h5>
                                        </div>
                                    </div>
                        `;
                    }else{
                        pizzaHtml = showPizza(response);
                    }
                    $('.pizza-box-container .row').html(pizzaHtml);
                }
            })

        })


    </script>
@endsection
