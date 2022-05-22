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
                    Total - <span class="badge badge-danger"> {{ $categories->total() }}</span>
                  </button>
                 <a href="{{ route('admin#addCategory') }}" class="btn btn-primary"><i class="fas fa-plus-circle mr-2"></i>Add Category</a>
               <div class="card-tools d-flex">
                    <a href="{{ route('admin#downloadCategory') }}" class="btn btn-dark mr-2"><i class="fas fa-download mr-2"></i>Download CSV</a>
                    <form action="{{ route('admin#searchCategory') }}" method="GET">
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
                        <th>Category Name</th>
                        <th>Product Count</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $item)
                        <tr>
                           <td>{{ $item->category_id }}</td>
                           <td>{{ $item->category_name }}</td>
                           <td>
                                @if ($item->count == 0)
                                    {{ $item->count }}
                                @else
                                    <a href="{{ route('admin#categoryItem',$item->category_id) }}" class="">{{ $item->count }}</a>
                                @endif


                            </td>
                           <td>
                             <a href="{{ route('admin#editCategory',$item->category_id) }}" class="btn btn-sm bg-info text-white"><i class="fas fa-edit"></i></a>
                             <a href="{{ route('admin#deleteCategory',$item->category_id) }}" class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></a>
                           </td>
                         </tr>
                        @endforeach
                    </tbody>

                  </table>
               </div>

               {{ $categories->links() }}
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
