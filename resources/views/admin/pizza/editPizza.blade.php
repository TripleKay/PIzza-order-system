@extends('admin.layout.app')
@section('content')

<div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-5">
          <div class="col-6 offset-3">
            <div class="card shadow">
              <!-- /.card-header -->
             <div class="card-header text-center">
                <h3 class="mb-0">Edit Pizza</h3>
             </div>
              <!-- /.card-body -->
              <div class="card-body ">
                 <form action="{{ route('admin#updatePizza',$pizza->pizza_id) }}"  method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <label for="" class="col-3 col-form-label">Name</label>
                        <div class="col-9">
                          <input type="text" class="form-control" id="" name="name" placeholder="pizza name" value="{{ old('name',$pizza->pizza_name) }}">
                          @if ($errors->has('name'))
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                          @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-3 col-form-label">Image</label>
                        <div class="col-9 border rounded p-1">
                          <input type="file" class="form-control" id="" name="image" placeholder="pizza image" value="{{ old('image',$pizza->image) }}">
                          <img src="{{ asset('uploads/'.$pizza->image) }}" class="img-thumbnail mt-2" width="80px">
                          @if ($errors->has('image'))
                            <small class="text-danger">{{ $errors->first('image') }}</small>
                          @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-3 col-form-label">Price</label>
                        <div class="col-9">
                          <input type="number" class="form-control" id="" name="price" placeholder="pizza price" value="{{ old('price',$pizza->price) }}">
                          @if ($errors->has('price'))
                            <small class="text-danger">{{ $errors->first('price') }}</small>
                          @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-3 col-form-label">Publish Status</label>
                        <div class="col-9">
                          <select name="publishStatus" id="" class="custom-select">
                              <option value="">----Select Option----</option>
                              <option value="1" @if ($pizza->publish_status == 1)
                                selected
                              @endif>Publish</option>
                              <option value="0" @if ($pizza->publish_status == 0)
                                selected
                              @endif>Unpublish</option>
                          </select>
                          @if ($errors->has('publishStatus'))
                            <small class="text-danger">{{ $errors->first('publishStatus') }}</small>
                          @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-3 col-form-label">Category</label>
                        <div class="col-9">
                          <select name="category" id="" class="custom-select">
                            <option value="{{ $pizza->category_id }}">{{ $pizza->category_name }}</option>
                              @foreach ($categories as $item)
                                @if ($item->category_id != $pizza->category_id)
                                    <option value="{{ $item->category_id }}">{{ $item->category_name }}</option>
                                @endif
                              @endforeach
                          </select>
                          @if ($errors->has('category'))
                            <small class="text-danger">{{ $errors->first('category') }}</small>
                          @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-3 col-form-label">Discount</label>
                        <div class="col-9">
                          <input type="number" class="form-control" id="" name="discount" placeholder="discount price" value="{{ old('discount',$pizza->discount_price) }}">
                          @if ($errors->has('discount'))
                            <small class="text-danger">{{ $errors->first('discount') }}</small>
                          @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-3 col-form-label">Buy 1 Get 1 </label>
                        <div class="col-9">
                            <input class="form-input-check" type="radio" name="buyOneGetOne" value="1" @if ($pizza->buy_one_get_one_status == 1)
                                checked
                            @endif> Yes
                            <input class="form-input-check ml-2" type="radio" name="buyOneGetOne" value="0" @if ($pizza->buy_one_get_one_status == 0)
                                checked
                            @endif> No
                            @if ($errors->has('buyOneGetOne'))
                            <small class="text-danger">{{ $errors->first('buyOneGetOne') }}</small>
                          @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-3 col-form-label">Waiting Time</label>
                        <div class="col-9">
                          <input type="number" class="form-control" id="" name="waitingTime" placeholder="waiting time" value="{{ old('waitingTime',$pizza->waiting_time) }}">
                          @if ($errors->has('waitingTime'))
                            <small class="text-danger">{{ $errors->first('waitingTime') }}</small>
                          @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-3 col-form-label">Description</label>
                        <div class="col-9">
                          <textarea name="description" class="form-control" rows="3" placeholder="description">{{ old('description',$pizza->description) }}</textarea>
                          @if ($errors->has('description'))
                            <small class="text-danger">{{ $errors->first('description') }}</small>
                          @endif
                        </div>
                    </div>
                    <button class="btn btn-primary float-right mt-3 shadow" type="submit">Update Pizza</button>
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
