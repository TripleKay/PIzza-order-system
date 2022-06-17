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
                <h3 class="mb-0"><span class="h5 mb-0">Edit</span> {{ $data->name }}</h3>
             </div>
              <!-- /.card-body -->
              <div class="card-body ">
                 <form action="{{ route('admin#updateUser',$data->id) }}"  method="POST" >
                    @csrf
                    <div class="row mb-3">
                        <label for="" class="col-3 col-form-label">Name</label>
                        <div class="col-9">
                          <input type="text" class="form-control" id="" name="name" placeholder="user name" value="{{ old('name',$data->name) }}">
                          @if ($errors->has('name'))
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                          @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-3 col-form-label">Email</label>
                        <div class="col-9">
                          <input type="email" class="form-control" id="" name="email" placeholder="email address" value="{{ old('email',$data->email) }}">
                          @if ($errors->has('email'))
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                          @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-3 col-form-label">Phone</label>
                        <div class="col-9">
                          <input type="number" class="form-control" id="" name="phone" placeholder="phone" value="{{ old('phone',$data->phone) }}">
                          @if ($errors->has('phone'))
                            <small class="text-danger">{{ $errors->first('phone') }}</small>
                          @endif
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="" class="col-3 col-form-label">Address</label>
                        <div class="col-9">
                          <textarea name="address" id=""  rows="3" class="form-control">{{ old('address',$data->address) }}</textarea>
                          @if ($errors->has('address'))
                            <small class="text-danger">{{ $errors->first('address') }}</small>
                          @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="" class="col-3 col-form-label">Role</label>
                        <div class="col-9">
                          <select name="role" id="" class="custom-select">
                                <option value="admin" @if ($data->role == 'admin') selected @endif>Admin</option>
                                <option value="user" @if ($data->role == 'user') selected @endif>user</option>
                          </select>
                          @if ($errors->has('role'))
                            <small class="text-danger">{{ $errors->first('role') }}</small>
                          @endif
                        </div>
                    </div>

                    <button class="btn btn-primary float-right mt-3 shadow" type="submit">Update User</button>
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
