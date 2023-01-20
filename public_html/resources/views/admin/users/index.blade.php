
@extends('layouts.app')
@section('header')
User Management
@endsection
@section('content')



<!--**********************************
    Content body start
***********************************-->
<div class="content-body ">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <div class="custom-tab-1 d-flex justify-content-between">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#home1">All User</a>
                                </li> 
                            </ul>
                            <a href="{{ route('users.create') }}" class="btn btn-outline-primary">Add New User</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="row"> --}}
                <div class="col-md-12">
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="home1" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-responsive-sm">
                                                    <thead>
                                                        <tr>
                                                            <th><strong>USER</strong></th>
                                                            <th><strong>ROLE</strong></th>
                                                            <th><strong>CREATE DATE</strong></th>
                                                            <th><strong>ACTION</strong></th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if (!empty($user))
                                                            @foreach ($user as $key => $value)
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex align-items-center justify-content-center">
                                                                        <img src="{{ !empty($value->image) ? asset('storage/'.$value->image) : '/assets/images/avatar/1.jpg' }}" class="rounded-lg mr-2" width="24" alt=""/> 
                                                                        <span class="w-space-no"><strong>{{ $value->name }}</strong></span>
                                                                    </div>
                                                                </td>
                                                                <td class="text-dark">
                                                                    @if (!empty($value->role))
                                                                        
                                                                    @foreach (json_decode($value->role) as $item)
                                                                    {{ $item }},
                                                                    @endforeach
                                                                    @else
                                                                    N/A
                                                                    @endif
                                                                </td>
                                                                <td>{{ date_format($value->created_at,'D ,d M Y h:i A') }}</td>
                                                                <td>
                                                                    <div class="d-flex align-items-center justify-content-center">
                                                                        <a href="{{ route('users.edit',$value->id) }}" class="btn btn-primary shadow px-3 sharp mr-1">Edit</a>
                                                                        <a href="{{ route('users.destroy',$value->id) }}" onclick="return confirm('Are you Sure?')" class="btn btn-danger shadow  sharp">Delete</a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                                
                                                            @endforeach
                                                        @endif
                                                        
                                                      
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- </div> --}}
            
        </div>
    </div>
</div>

@endsection