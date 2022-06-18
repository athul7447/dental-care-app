@extends('admin.layout')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="card mb-4">
            <h5 class="card-header">My profile</h5>
            @if (session('message'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    {{ session('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card-body demo-vertical-spacing demo-only-element">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon11"><i class="fa fa-user" aria-hidden="true"></i> </span>
                        <input type="text" class="form-control " placeholder="Username" aria-label="Username" name="name" value="{{ Auth()->user()->name }}" aria-describedby="basic-addon11">
                    </div>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon11">  <i class="fa fa-envelope" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" placeholder="Email" aria-label="Email" value="{{ Auth()->user()->email }}" name="email" aria-describedby="basic-addon11">
                    </div>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <div class="form-password-toggle">
                        <label class="form-label" for="basic-default-password">Password</label>
                        <div class="input-group">
                        <span class="input-group-text" id="basic-addon11"> <i class="fa fa-lock" aria-hidden="true"></i></span>
                        <input type="password" class="form-control" id="basic-default-password" name="password" placeholder="············" aria-describedby="basic-default-password2">
                    </div>
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-password-toggle">
                        <label class="form-label" for="basic-default-password1">Password Confirmation</label>
                        <div class="input-group">
                         <span class="input-group-text" id="basic-addon11"><i class="fa fa-lock" aria-hidden="true"></i></i></span>
                        <input type="password" class="form-control" id="basic-default-password1" name="password_confirmation"  placeholder="············" aria-describedby="basic-default-password2">
                    </div>
                    @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">Send</button>
                    </div>
                </div>
            </form>
          </div>
    </div>
</div>
@endsection
