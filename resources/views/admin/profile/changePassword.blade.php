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
                    @if (Session::has('notSameError'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ Session::get('notSameError')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (Session::has('lengthError'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ Session::get('lengthError')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if (Session::has('oldPassError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ Session::get('oldPassError')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form class="form-horizontal" action="{{ route('admin#changePassword',Auth::user()->id) }}" method="POST">
                        @csrf
                        <div class="form-group row">
                          <label for="" class="col-sm-3 col-form-label">Old Password</label>
                          <div class="col-sm-9">
                            <input type="password" class="form-control" name="oldPassword" placeholder="old password">
                            @if ($errors->has('oldPassword'))
                                <small class="text-danger">{{ $errors->first('oldPassword') }}</small>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">New Password</label>
                            <div class="col-sm-9">
                              <input type="password" class="form-control" name="newPassword" placeholder="new password">
                              @if ($errors->has('newPassword'))
                                  <small class="text-danger">{{ $errors->first('newPassword') }}</small>
                              @endif
                            </div>
                          </div>
                          <div class="form-group row">
                            <label for="" class="col-sm-3 col-form-label">Confirm Password</label>
                            <div class="col-sm-9">
                              <input type="password" class="form-control" name="confirmPassword" placeholder="confirm password">
                              @if ($errors->has('confirmPassword'))
                                  <small class="text-danger">{{ $errors->first('confirmPassword') }}</small>
                              @endif
                            </div>
                          </div>

                        <div class="form-group row">
                          <div class="offset-sm-3 col-sm-9">
                            <button type="submit" class="btn bg-primary text-white">Change Password</button>
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
