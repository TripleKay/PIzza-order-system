@extends('admin.layout.app')
@section('content')
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row mt-4">
          <div class="col-8 offset-3 mt-5">
            <div class="col-md-9">
              <div class="card shadow">
                <div class="card-header bg-primary p-2">
                  <legend class="text-center mb-0">User Profile</legend>
                </div>
                <div class="card-body p-5">
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ Session::get('success')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" action="{{ route('admin#updateProfile',Auth::user()->id) }}" method="POST">
                        @csrf
                        <div class="form-group row">
                          <label for="" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" placeholder="Name" value="{{ old('name', $userData->name ) }}">
                            @if ($errors->has('name'))
                                <small class="text-danger">{{ $errors->first('name') }}</small>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email',$userData->email) }}">
                            @if ($errors->has('email'))
                                <small class="text-danger">{{ $errors->first('email') }}</small>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-10">
                              <input type="number" class="form-control" name="phone" placeholder="phone" value="{{ old('phone',$userData->phone) }}">
                              @if ($errors->has('phone'))
                                <small class="text-danger">{{ $errors->first('phone') }}</small>
                            @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                              <input type="text" class="form-control" name="address" placeholder="address" value="{{ old('address',$userData->address) }}">
                              @if ($errors->has('address'))
                                <small class="text-danger">{{ $errors->first('address') }}</small>
                            @endif
                            </div>
                          </div>
                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <a href="{{ route('admin#changePasswordPage') }}">Change Password</a>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn bg-dark text-white">Submit</button>
                          </div>
                        </div>
                      </form>

                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection
