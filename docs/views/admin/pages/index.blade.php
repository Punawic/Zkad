
@extends('layouts.app')
@section('header')
Page / เพจ
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
                                    <a class="nav-link active" data-toggle="tab" href="#home1">All Page<br>เพจทั้งหมด</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#profile1">Available<br>เพจปกติ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#contact1">Unavailable<br>เพจปิดแล้ว</a>
                                </li>
                                
                            </ul>
                            <a href="{{ route('page.create') }}" class="btn btn-outline-primary">Add New Page<br>เพิ่มเพจ</a>
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
                                                            <th>PAGE PHOTO / รูปเพจ</th>
                                                            <th>NAME PAGE / ชื่อเพจ</th>
                                                            <th>CREATE DATE</th>
                                                            <th>ACTION</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($page as $key => $value)
                                                            
                                                        <tr>
                                                            <th><img src="{{ asset('storage/'.$value->image) }}" class="border-radius-50" width="80px" alt=""></th>
                                                            <td>{{ $value->name }}</td>
                                                            
                                                            </td>
                                                            <td>{{ date_format($value->created_at,'D m') }}</td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <a href="{{ route('page.edit',$value->id) }}" class="btn btn-primary shadow px-3 sharp mr-1">Edit</a>
                                                                    <a href="{{ route('page.destroy',$value->id) }}" onclick="return confirm('Are you Sure?');" class="btn btn-danger shadow  sharp">Delete</a>
                                                                </div>
                                                            </td>
                                                        </tr>               
                                                        @empty
                                                            <tr>
                                                                <td colspan="3" class="text-center">Not Available</td>
                                                            </tr>
                                                        @endforelse
                                                        
                                                      
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile1">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-responsive-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>PAGE PHOTO</th>
                                                            <th>NAME PAGE</th>
                                                            <th>CREATE DATE</th>
                                                            <th>ACTION</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($active as $key => $value)
                                                            
                                                        <tr>
                                                            <th><img src="{{ asset('storage/'.$value->image) }}" class="border-radius-50" width="80px" alt=""></th>
                                                            <td>{{ $value->name }}</td>
                                                            
                                                            </td>
                                                            <td>{{ date_format($value->created_at,'D m') }}</td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <a href="{{ route('page.edit',$value->id) }}" class="btn btn-primary shadow px-3 sharp mr-1">Edit</a>
                                                                    <a href="{{ route('page.destroy',$value->id) }}" onclick="return confirm('Are you Sure?');" class="btn btn-danger shadow  sharp">Delete</a>
                                                                </div>
                                                            </td>
                                                        </tr>               
                                                        @empty
                                                            <tr>
                                                                <td colspan="3" class="text-center">Not Available</td>
                                                            </tr>
                                                        @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact1">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="card">
                                        
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-responsive-sm">
                                                    <thead>
                                                        <tr>
                                                            <th>PAGE PHOTO</th>
                                                            <th>NAME PAGE</th>
                                                            <th>CREATE DATE</th>
                                                            <th>ACTION</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($inActive as $key => $value)
                                                            
                                                        <tr>
                                                            <th><img src="{{ asset('storage/'.$value->image) }}" class="border-radius-50" width="80px" alt=""></th>
                                                            <td>{{ $value->name }}</td>
                                                            
                                                            </td>
                                                            <td>{{ date_format($value->created_at,'D m') }}</td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <a href="{{ route('page.edit',$value->id) }}" class="btn btn-primary shadow px-3 sharp mr-1">Edit</a>
                                                                    <a href="{{ route('page.destroy',$value->id) }}" onclick="return confirm('Are you Sure?');" class="btn btn-danger shadow  sharp">Delete</a>
                                                                </div>
                                                            </td>
                                                        </tr>               
                                                        @empty
                                                            <tr>
                                                                <td colspan="3" class="text-center">Not Available</td>
                                                            </tr>
                                                        @endforelse
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