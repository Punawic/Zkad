
@extends('layouts.app')
@section('header')
  User Settings
@endsection
@section('content')


<!--**********************************
    Content body start
***********************************-->
<div class="content-body">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Profile Setting</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('setting.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>USER NAME</label>
                                        <input type="text" class="form-control" name="username" value="{{ Auth::user()->name }}" required placeholder="Eneter User Name">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>EMAIL</label>
                                        <input type="email" class="form-control" name="email" value="{{  Auth::user()->email }}" required readonly placeholder="Enter email">
                                    </div>
                                    <div class="form-group col-md-12">
                                        @if (!empty(Auth::user()->image))
                                           <img src="{{ asset('storage/'.Auth::user()->image) }}" width="100px" alt=""> 
                                        @endif
                                        <label>Image</label>
                                        <input type="file" class="form-control" name="image" >
                                    </div>
                                                                       
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Password Setting</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="{{ route('setting.password') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                         
                                    <div class="form-group col-md-12">
                                        <label>Old Password</label>
                                        <input type="password" class="form-control" name="old_password" placeholder="Enter Old Password">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>New Password</label>
                                        <input type="password" class="form-control" name="new_password"  placeholder="Enter New Password">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_password" placeholder="Enter Confirm Password">
                                    </div>
                                    
                                   
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-success">Update</button>
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

@endsection