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
                <button type="button" class="btn btn-outline-primary font-weight-bold mr-2">
                    Total - <span class="badge badge-danger"> {{ $orders->total() }}</span>
                  </button>
               <div class="card-tools d-flex">
                <a href="{{ route('admin#downloadOrder') }}" class="btn btn-dark mr-2"><i class="fas fa-download mr-2"></i>Download CSV</a>
                <form action="{{ route('admin#searchOrder') }}" method="GET">
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
                        <th>Pizza Name</th>
                        <th>Customer Name</th>
                        <th>Pizza Count</th>
                        <th>Order Date</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if ($emptyStatus == 0)
                              <tr>
                                  <td colspan="8" class="text-danger text-center py-4">There is no data!</td>
                              </tr>
                          @else
                            @foreach ($orders as $item)
                            <tr>
                                <td>{{ $item->order_id }}</td>
                                <td>{{ $item->pizza_name }}</td>
                                <td>{{ $item->customer_name }}</td>
                                <td>{{ $item->count }}</td>
                                <td>{{ $item->order_time }}</td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>

                  </table>
               </div>

               {{ $orders->links() }}
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
