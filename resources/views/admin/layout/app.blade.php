<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pizza Order System</title>
  {{-- fav icon  --}}
  <link rel="icon" type="image/x-icon" href="{{ asset('customer/img/pizza.png') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">
  {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous"> --}}
  <style>
    .sidebar-light-white {
      background-color: #EB904A !important ;
    }
    .sidebar-light-white .nav-link {
      color: #fff !important;
    }
    .sidebar-light-white .nav-link.active{
      color: #EB904A !important;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" style="background-color: #f4f6f9;">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <aside class="main-sidebar sidebar-light-white elevation-4">
    <a href="{{ route('user#index') }}" class="brand-link">
      <img src="{{ asset('customer/img/pizza.png') }}" alt="Logo" class="brand-image">
      <span class="brand-text h6 mb-0 font-weight-bold text-white">Pizza Order System</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="{{ route('admin#profile') }}" class="nav-link {{ request()->url() == route('admin#profile') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-circle "></i>
              <p>
                My Profile

              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin#userList') }}" class="nav-link {{ request()->url() == route('admin#userList') ? 'active' : '' }}">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User List
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin#category') }}" class="nav-link {{ request()->url() == route('admin#category') ? 'active' : '' }}">
              <i class="nav-icon fas fa-list"></i>
              <p>
                  Category List
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin#pizza') }}" class="nav-link {{ request()->url() == route('admin#pizza') ? 'active' : '' }}">
              <i class="nav-icon fas fa-pizza-slice"></i>
              <p>
                Pizza List

              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin#orderList') }}" class="nav-link {{ request()->url() == route('admin#orderList') ? 'active' : '' }}">
                <i class="nav-icon fas fa-shopping-bag"></i>
              <p>
                Order List
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin#contactList') }}" class="nav-link {{ request()->url() == route('admin#contactList') ? 'active' : '' }}">
              <i class="fas fa-file-contract nav-icon"></i>
              <p>
                Contact
              </p>
            </a>
          </li>
          <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <div class="">
                    <button class="btn  nav-link text-left text-white" type="submit">
                        <i class="fas fa-sign-out-alt nav-icon"></i>
                        <p>Logout</p>
                    </button>
                </div>
            </form>
          </li>

        </ul>
      </nav>
    </div>
  </aside>

  @yield('content')

  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>
</html>
