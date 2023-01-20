

@extends('layouts.app')

@section('header')

  User Management

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

                        <h4 class="card-title">{{ isset($user) ? 'Update' : 'Create New' }} User / สร้าง USER ใหม่</h4>

                    </div>

                    <div class="card-body">

                        <div class="basic-form">

                            <form action="{{ isset($user) ? route('users.update',$user->id) : route('users.store') }}" method="POST">

                                @csrf

                                @if (isset($user))

                                    @method('put')

                                @endif

                                <div class="form-row">

                                    <div class="form-group col-md-6">

                                        <label>USER NAME</label>

                                        <input type="text" class="form-control" name="username" value="{{ isset($user) ? $user->name : '' }}" required placeholder="ใส่ username">

                                    </div>

                                    <div class="form-group col-md-6">

                                        <label>EMAIL</label>

                                        <input type="email" class="form-control" name="email" value="{{ isset($user) ? $user->email : '' }}" required placeholder="ใส่ email">

                                    </div>

                                    @if (!isset($user))

                                        

                                    <div class="form-group col-md-12">

                                        <label>Password</label>

                                        <input type="password" class="form-control" name="password" required placeholder="ใส่รหัสผ่าน">

                                    </div>

                                    <div class="form-group col-md-12">

                                        <label>Confirm Password</label>

                                        <input type="password" class="form-control" name="confirm_password" required placeholder="ใส่รหัสผ่านอีกครั้ง">

                                    </div>

                                    @endif

                                    <div class="form-group col-md-12">

                                        

                                    <h3>Roles / หน้าที่</h3>

                                    </div>

                                    <div class="form-group col-md-12">

                                        



{{--                                        

                                       <label onclick="$(this).toggleClass('bg-primary text-white')" class="badge badge-outline-primary role-btn

                                       @if(isset($user))

                                        @foreach(json_decode($user->role) as $item)

                                          {{ $item== 'Page' ? 'bg-primary text-white' : '' }}

                                        @endforeach

                                       @endif

                                       py-3 px-4">Page

                                        <input type="checkbox" name="role[]"

                                        @if(isset($user))

                                        @foreach(json_decode($user->role) as $item)

                                          {{ $item== 'Page' ? 'checked' : '' }}

                                        @endforeach

                                       @endif

                                        class="page-input hidden" value="Page">

                                       </label>


                                       <label class="badge badge-outline-primary role-btn

                                       @if(isset($user))

                                       @foreach(json_decode($user->role) as $item)

                                         {{ $item== 'Cashflow' ? 'bg-primary text-white' : '' }}

                                       @endforeach

                                      @endif

                                       py-3 px-4">Cashflow

                                        <input type="checkbox" name="role[]"

                                        @if(isset($user))

                                        @foreach(json_decode($user->role) as $item)

                                          {{ $item== 'Cashflow' ? 'checked' : '' }}

                                        @endforeach

                                       @endif

                                        class="cashflow-input hidden" value="Cashflow">

                                       </label>


                                        <label class="badge badge-outline-primary role-btn

                                       @if(isset($user))

                                       @foreach(json_decode($user->role) as $item)

                                         {{ $item== 'Shipping' ? 'bg-primary text-white' : '' }}

                                       @endforeach

                                      @endif

                                       py-3 px-4">Shipping

                                        <input type="checkbox" name="role[]"

                                        @if(isset($user))

                                        @foreach(json_decode($user->role) as $item)

                                          {{ $item== 'Shipping' ? 'checked' : '' }}

                                        @endforeach

                                       @endif

                                        class="shipping-input hidden" value="Shipping">

                                       </label>

                                       

                                       <label class="badge badge-outline-primary role-btn

                                       @if(isset($user))

                                       @foreach(json_decode($user->role) as $item)

                                         {{ $item== 'Campaign' ? 'bg-primary text-white' : '' }}

                                       @endforeach

                                      @endif

                                       py-3 px-4">Campaign

                                        <input type="checkbox" name="role[]"

                                        @if(isset($user))

                                        @foreach(json_decode($user->role) as $item)

                                          {{ $item== 'Campaign' ? 'checked' : '' }}

                                        @endforeach

                                       @endif

                                        class="campaign-input hidden" value="Campaign">

                                       </label>

                                       

                                       <label class="badge badge-outline-primary role-btn

                                       @if(isset($user))

                                       @foreach(json_decode($user->role) as $item)

                                         {{ $item== 'Sale' ? 'bg-primary text-white' : '' }}

                                       @endforeach

                                      @endif

                                       py-3 px-4">Sale

                                        <input type="checkbox" name="role[]"

                                        @if(isset($user))

                                        @foreach(json_decode($user->role) as $item)

                                          {{ $item== 'Sale' ? 'checked' : '' }}

                                        @endforeach

                                       @endif

                                        class="sale-input hidden" value="Sale">

                                       </label> --}}







                                    <input type="checkbox"

                                        @if(isset($user))

                                            @if (!empty($user->role))     

                                                @foreach(json_decode($user->role) as $item)

                                                    {{ $item== 'Page' ? 'checked' : '' }}

                                                @endforeach

                                            @endif

                                       @endif

                                    name="role[]" value="Page" id="page" class="users">

                                    <label for="page">Page</label>

                                    <br>


                                    <input type="checkbox"

                                        @if(isset($user))

                                            @if (!empty($user->role))     

                                                @foreach(json_decode($user->role) as $item)

                                                    {{ $item== 'Cashflow' ? 'checked' : '' }}

                                                @endforeach

                                            @endif

                                       @endif

                                    name="role[]" value="Cashflow" id="cashflow" class="users">

                                    <label for="cashflow">Cashflow</label>

                                    <br>


                                    <input type="checkbox"

                                        @if(isset($user))

                                            @if (!empty($user->role))     

                                                @foreach(json_decode($user->role) as $item)

                                                    {{ $item== 'Shipping' ? 'checked' : '' }}

                                                @endforeach

                                            @endif

                                       @endif

                                    name="role[]" value="Shipping" id="shipping" class="users">

                                    <label for="shipping">Shipping</label>

                                    <br>



                                    <input type="checkbox"

                                        @if(isset($user))

                                            @if (!empty($user->role))  

                                                @foreach(json_decode($user->role) as $item)

                                                    {{ $item== 'Campaign' ? 'checked' : '' }}

                                                @endforeach

                                            @endif

                                        @endif

                                    name="role[]" value="Campaign" id="campaign" class="users">

                                       

                                    <label for="campaign">Campaign</label>

                                    <br>



                                    <input type="checkbox" 

                                        @if(isset($user))

                                            @if (!empty($user->role))  

                                                @foreach(json_decode($user->role) as $item)

                                                    {{ $item== 'Sale' ? 'checked' : '' }}

                                                @endforeach

                                            @endif

                                        @endif

                                    name="role[]" value="Sale" id="sale" class="users">

                                       

                                    <label for="sale">Sale</label>

                                    <br>


                                    <input type="checkbox" 

                                        @if(isset($user))

                                            @if (!empty($user->role))  

                                                @foreach(json_decode($user->role) as $item)

                                                    {{ $item== 'Advertising' ? 'checked' : '' }}

                                                @endforeach

                                            @endif

                                        @endif

                                    name="role[]" value="Advertising" id="advertising" class="users">

                                       

                                    <label for="advertising">Advertising</label>

                                    <br>


                                    <input type="checkbox" 

                                        @if(isset($user))

                                            @if (!empty($user->role))  

                                                @foreach(json_decode($user->role) as $item)

                                                    {{ $item== 'Delivery' ? 'checked' : '' }}

                                                @endforeach

                                            @endif

                                        @endif

                                    name="role[]" value="Delivery" id="delivery" class="users">

                                       

                                    <label for="delivery">Delivery</label>

                                    <br>



                                    <input type="checkbox" 

                                        @if(isset($user))

                                            @if (!empty($user->role))  

                                                @foreach(json_decode($user->role) as $item)

                                                    {{ $item== 'Return Percent' ? 'checked' : '' }}

                                                @endforeach

                                            @endif

                                        @endif

                                    name="role[]" value="Return Percent" id="return-percent" class="users">

                                       

                                    <label for="return-percent">Return Percent</label>

                                    <br>



                                    <input type="checkbox" 

                                        @if(isset($user))

                                            @if (!empty($user->role))  

                                                @foreach(json_decode($user->role) as $item)

                                                    {{ $item== 'Admin' ? 'checked' : '' }}

                                                @endforeach

                                            @endif

                                        @endif

                                    name="role[]" value="Admin" id="admin" class="admin">

                                       

                                    <label for="admin">Admin</label>

                                    <br>

                                    

                                    </div>

                                    <div class="col-md-12 text-right">

                                        <button type="submit" class="btn btn-success">{{ isset($user) ? 'Update' : 'Save' }}</button>

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





@section('js')

<script>

    var adminBox = document.querySelector('.admin');

    var usersBoxs = document.querySelectorAll('.users');



    adminBox.addEventListener('change', () => {

        if(adminBox.checked) {

            usersBoxs.forEach(box => {

            if(box.checked) {

                box.checked = false;

            }

        });

        }

    });



</script>

@endsection