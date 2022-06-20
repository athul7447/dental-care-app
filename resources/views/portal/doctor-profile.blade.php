@extends('portal.layout')
@section('content')
<section class="section">
    <div class="section-header">
      <h1>Profile</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="{{ route('portal.dashboard') }}">Dashboard</a></div>
        <div class="breadcrumb-item">Profile</div>
      </div>
    </div>
    <div class="section-body">
      <h2 class="section-title">Hi,{{ ucfirst(Auth::user()->name) }}!</h2>
        <div class="col">
            <div class="row">

                <div class="col-md-12" style="text-align: center;">
                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible show fade">
                        <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>×</span>
                        </button>
                        {{ session('success') }}
                        </div>
                    </div>
                    @endif
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible show fade">
                        <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>×</span>
                        </button>
                        {{ session('error') }}
                        </div>
                    </div>
                    @endif
                </div>

                <div class="col-md-12">
                    <div class="card mb-4">
                        <!-- Account -->
                    <form method="POST" action="{{ route('portal.profile.update') }}" enctype="multipart/form-data" id="update_form">
                        @csrf
                        <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                          <img
                                @if (Auth::user()->getImage())
                                    src="{{ asset('/storage/doctors/'.Auth::user()->image) }}"
                                @else
                                    src="{{ asset('doctor_assets/img/avatar/avatar-3.png') }}"
                                @endif
                                 alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar">
                          <div class="button-wrapper" style="padding-left: 10px;">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                              <span class="d-none d-sm-block">Upload photo</span>
                              <i class="bx bx-upload d-block d-sm-none"></i>
                              <input type="file" id="upload" class="account-file-input" name="image" hidden="" accept="image/png, image/jpeg">
                            </label>
                            <p class="text-muted mb-0">Allowed JPG,JPEG,,PNG,SVG or GIF. Max size of 1MB</p>
                          </div>
                        </div>
                                      </div>
                      <hr class="my-0">
                      <div class="card-body">
                          <div class="row">
                            <div class="mb-3 col-md-6">
                              <label for="name" class="form-label">Name</label>
                              <input class="form-control" type="text" id="name" name="name" value="{{ Auth::user()->name }}" autofocus="" placeholder="enter name">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="username" class="form-label">Username</label>
                              <input class="form-control" type="text" name="username" id="username" value="{{ Auth::user()->username}}" placeholder="enter username">
                                @error('username')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="email" class="form-label">E-mail</label>
                              <input class="form-control" type="text" id="email" name="email" value="{{ Auth::user()->email }}" placeholder="enter email">
                              @error('email')
                              <div class="text-danger">{{ $message }}</div>
                                @enderror
                             </div>
                            <div class="mb-3 col-md-6">
                              <label for="qualification" class="form-label">Qualificattion</label>
                              <input type="text" class="form-control" id="qualification" name="qualification" value="{{ Auth::user()->qualification}}" placeholder="enter qualification">
                              @error('qualification')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                              <label class="form-label" for="phone">Phone Number</label>
                                <input type="text" id="phone" name="phone" class="form-control" value="{{ Auth::user()->phone }}" placeholder="enter phone number">
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="address" class="form-label">Address</label>
                              <input type="text" class="form-control" id="address" name="address" value="{{ Auth::user()->address }}" placeholder="Enter Address">
                              @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                              <label for="password" class="form-label">Password</label>
                              <input class="form-control" type="password" id="password" name="password" placeholder="********">
                              @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                                    </div>
                            <div class="mb-3 col-md-6">
                              <label for="password_confirmation" class="form-label">Password confirmation</label>
                              <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="********">
                            </div>
                          </div>
                          <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Update</button>
                            <button type="reset" class="btn btn-outline-secondary">Reset</button>
                          </div>

                      </div></form>
                      <!-- /Account -->
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
@endsection

