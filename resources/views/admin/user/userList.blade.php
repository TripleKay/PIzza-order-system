@extends('admin.layout.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

   <!-- Main content -->
   <section class="content">
     <div class="container-fluid">
       <div class="row mt-5">
         <div class="col-12">
            @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
               <strong>{{ Session::get('success')}}</strong>
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
               </button>
             </div>
            @endif
           <div class="card shadow">
             <div class="card-header">
               <h3 class="card-title">
                 <a href="{{ route('admin#userList') }}" class="btn btn-primary"><i class="fas fa-users mr-2"></i>User List</a>
                 <a href="{{ route('admin#adminList') }}" class="btn btn-success"><i class="fas fa-users mr-2"></i>Admin List</a>

               </h3>

               <div class="card-tools">
                <form action="{{ route('admin#searchUserList') }}" method="GET">
                  @csrf
                  <div class="input-group my-0" style="width: 200px;">
                    <input type="text" name="search" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </form>

               </div>
             </div>

             <!-- /.card-header -->
             <div class="card-body">
               <div class="table-responsive">
                <table class="table table-hover text-nowrap table-bordered">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email Address</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($userData as $item)
                        <tr>
                           <td>{{ $item->id }}</td>
                           <td>{{ $item->name }}</td>
                           <td>{{ $item->email }}</td>
                           <td>{{ $item->phone }}</td>
                           <td>{{ $item->address }}</td>
                           <td>
                             <a href="{{ route('admin#deleteUser',$item->id) }}" class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></a>
                           </td>
                         </tr>
                        @endforeach
                    </tbody>

                  </table>
               </div>

               {{ $userData->links() }}
             </div>
             <!-- /.card-body -->
           </div>
           <!-- /.card -->
         </div>
       </div>

     </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->
</div>

@endsection
