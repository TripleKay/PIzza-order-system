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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
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
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('user#index') }}" class="brand-link">
      <img src="{{ asset('customer/img/pizza.png') }}" alt="Logo" class="brand-image" >
      <span class="brand-text h6 mb-0 font-weight-bold">Pizza Order System</span>
    </a>
    <div class="sidebar">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <li class="nav-item">
            <a href="{{ route('admin#profile') }}" class="nav-link">
              <i class="nav-icon fas fa-user-circle "></i>
              <p>
                My Profile

              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin#userList') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User List
                <span class="badge badge-info right">{{ App\Models\User::count() }}</span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin#category') }}" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                  Category List
                  <span class="badge badge-info right">{{ App\Models\Category::count() }}</span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin#pizza') }}" class="nav-link">
              <i class="nav-icon fas fa-pizza-slice"></i>
              <p>
                Pizza List
                <span class="badge badge-info right">{{ App\Models\Pizza::count() }}</span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin#orderList') }}" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Order List
                <span class="badge badge-info right">1</span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{ route('admin#contactList') }}" class="nav-link">
              <i class="fas fa-file-contract nav-icon"></i>
              <p>
                Contact
                <span class="badge badge-info right">{{ App\Models\Contact::count() }}</span>
              </p>
            </a>
          </li>
          {{-- <li class="nav-item">
            <a href="" class="nav-link">
              <i class="fas fa-sign-out-alt nav-icon"></i>
              <p>
                Logout
              </p>
            </a>
          </li> --}}

          <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <div class="nav-link">
                    <button class="w-100 btn btn-secondary" type="submit">
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
