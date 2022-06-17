@extends('admin.layout.app')
@section('content')

<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-5">
          <div class="col-6 offset-3">
            <div class="card shadow-none">
              <!-- /.card-header -->
             <div class="card-header bg-primary">
                <h3 class="mb-0">Pizza Information</h3>
             </div>
              <!-- /.card-body -->
              <div class="card-body d-flex justify-between">
                <div class="">
                    <img src="{{ asset('uploads/'.$pizza->image) }}" class="img-thumbnail" width="200px" style="height: 200px !important;">
                    <a href="{{ route('admin#editPizza',$pizza->pizza_id) }}" class="btn btn-success btn-sm w-100 mt-3"><i class="fas fa-edit"></i> Edit Pizza</a>
                </div>
                <div class="w-100 px-3">
                    <div class="row my-2">
                        <div class="col-5">
                            <b>Name</b>
                        </div>
                        <div class="col-7">
                            <span>{{ $pizza->pizza_name }}</span>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-5">
                            <b>Price</b>
                        </div>
                        <div class="col-7">
                            <span>{{ $pizza->price }} Kyats</span>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-5">
                            <b>Category</b>
                        </div>
                        <div class="col-7">
                            <span>{{ $pizza->category_id }}</span>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-5">
                            <b>Waiting Time</b>
                        </div>
                        <div class="col-7">
                            <span>{{ $pizza->waiting_time }} min</span>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-5">
                            <b>Discount</b>
                        </div>
                        <div class="col-7">
                            <span>{{ $pizza->discount_price }} Kyats</span>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-5">
                            <b>Publish Status</b>
                        </div>
                        <div class="col-7">
                            <span>
                                @if ($pizza->publish_status == 1)
                                    Yes
                                @else
                                    No
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="row my-2">
                        <div class="col-5">
                            <b>Buy 1 Get 1 Status</b>
                        </div>
                        <div class="col-7">
                            <span>
                                @if ($pizza->buy_one_get_one_status == 1)
                                    Yes
                                @else
                                    No
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-5">
                            <b>Description</b>
                        </div>
                        <div class="col-7">
                            <span>{{ $pizza->description }}</span>
                        </div>
                    </div>
                </div>
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
