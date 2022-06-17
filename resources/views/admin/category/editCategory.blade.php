@extends('admin.layout.app')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

   <!-- Main content -->
   <section class="content">
     <div class="container-fluid">
       <div class="row mt-5">
         <div class="col-4 offset-4">
           <div class="card shadow-none">

             <!-- /.card-header -->
            <div class="card-header">
               <h3 class="mb-0"> Edit Category</h3>
            </div>
             <!-- /.card-body -->
             <div class="card-body d-flex justify-content-center">
                <form action="{{ route('admin#updateCategory') }}" class="d-flex" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $category->category_id }}">
                    <input type="text" name="categoryName" class="form-control" placeholder="category name" value="{{ old('categoryName',$category->category_name) }}">
                    <button class="btn btn-primary mx-3" type="submit">Update</button>
                </form>
            </div>
           </div>
           <!-- /.card -->
         </div>
       </div>

     </div><!-- /.container-fluid -->
   </section>
   <!-- /.content -->
</div>

@endsection
