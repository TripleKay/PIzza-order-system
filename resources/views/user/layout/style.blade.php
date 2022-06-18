
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- fav icon  --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('customer/img/pizza.png') }}">
    {{-- <!-- -------------------------------fontawesome------------------------------------- --> --}}
    <link rel="stylesheet" href="{{ asset('customer/node_modules/@fortawesome/fontawesome-free/css/all.min.css') }}">
    {{-- <!-- -------------------------------custom css------------------------------------- --> --}}
    <link rel="stylesheet" href="{{ asset('customer/css/style.css') }}">
    {{-- <!-- -------------------------------custom scss bootstrap 5------------------------------------- --> --}}
    <link rel="stylesheet" href="{{ asset('customer/scss/custom.css') }}">
    <title>Pizza Order System</title>
</head>
<body  data-bs-spy="scroll" data-bs-target="#navbarNav" data-bs-offset="0">
    <!-- -------------------------------nav bar------------------------------------- -->
    <div class="container-fluid bg-white shadow-sm" style="z-index: 3000">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="navbar navbar-expand-lg navbar-light">

                            <a class="navbar-brand d-flex align-items-center" href="#">
                                <!-- <img src="img/pizza_logo_black.png" class="img-fluid" alt="" srcset="" style="width: 50px ;"> -->
                                <img src="{{ asset('customer/img/pizza.png') }}" class="img-fluid" alt="" srcset="" style="width: 50px ;">

                                <h3 class="mb-0 ms-2 fw-bolder text-primary">PIZZA</h3>
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                    <a class="nav-link text-uppercase active" aria-current="page" href="{{ route('user#index') }}">Home</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link text-uppercase" href="#service-section">Service</a>
                                    </li>
                                    <li class="nav-item">
                                    <a class="nav-link text-uppercase" href="#pizza-section">Pizza Menu</a>
                                    </li>
                                    {{-- <li class="nav-item">
                                    <a class="nav-link text-uppercase" href="#contact-section">About Us</a>
                                    </li> --}}
                                    <li class="nav-item">
                                    <a class="nav-link text-uppercase" href="#contact-section">Contact Us</a>
                                    </li>
                                    <li>
                                        @if (Auth::check())
                                            <div class="dropdown d-block d-md-none">
                                                <a class="btn btn-primary rounded-pill text-white dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fas fa-user me-2"></i>
                                                    <span class="">{{ auth()->user()->name }}</span>
                                                </a>

                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                    <li><a class="dropdown-item" href="#">My Orders</a></li>
                                                    <li>
                                                        <form action="{{ route('logout') }}" method="POST">
                                                            @csrf
                                                            <button class="dropdown-item" type="sutmit" >Logout</button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                        @else
                                            <div class="d-block d-md-none">
                                                <a href="{{ route('login') }}" class=" btn btn-outline-primary rounded-pill ">Login</a>
                                                <a href="{{ route('register') }}" class=" btn btn-primary text-white rounded-pill ">Register</a>
                                            </div>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            @if (Auth::check())
                                <div class="dropdown d-none d-md-block">
                                    <a class="btn btn-primary rounded-pill text-white dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fas fa-user me-2"></i>
                                        <span class="d-none d-md-inline-block">{{ auth()->user()->name }}</span>
                                    </a>

                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        {{-- <li><a class="dropdown-item d-block d-md-none" href="#">{{ auth()->user()->name }}</a></li> --}}
                                        <li><a class="dropdown-item" href="#">My Orders</a></li>
                                        <li>
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button class="dropdown-item" type="sutmit" >Logout</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @else
                                <div class="d-none d-md-block">
                                    <a href="{{ route('login') }}" class=" btn btn-outline-primary rounded-pill ">Login</a>
                                    <a href="{{ route('register') }}" class=" btn btn-primary text-white rounded-pill ">Register</a>
                                </div>
                            @endif

                        </nav>
                </div>
            </div>
        </div>
    </div>

    @yield('content')
<!-- -------------------------------Footer section------------------------------------- -->
    <footer class="bg-dark py-4 text-center" id="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <p class="text-secondary mb-0">Copyright &copy; 2022 Pizza Order System</p>
                </div>
            </div>
        </div>
    </footer>



    <!-- -------------------------------jquery------------------------------------- -->
    <script src="{{ asset('customer/node_modules/jquery/dist/jquery.min.js') }}"></script>
    <!-- -------------------------------bootstrap------------------------------------- -->
    <script src="{{ asset('customer/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    @yield('script')
    <script>

        /* -------------------------------home-section-------------------------------------   */

        $(".show-mobileFilter-btn").click(function () {
            $(".pizza-right-container").addClass("active");
        });
        $(".hide-mobileFilter-btn").click(function () {
            $(".pizza-right-container").removeClass("active");
        });

    </script>
</body>
</html>
