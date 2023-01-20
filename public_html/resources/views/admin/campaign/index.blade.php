
@extends('layouts.app')
@section('header')
Campaign / แคมเปญ
@endsection
@section('content')



<!--**********************************
    Content body start
***********************************-->
<div class="content-body ">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-6">
                <a href="{{ route('campaign.create') }}" class="btn btn-outline-primary">+Add New Campaign<br>สร้างแคมเปญใหม่</a>    
            </div>
            <div class="col-md-6">
                <div class="card">
                    
                    <div class="card-body">
                        <!-- Nav tabs -->
                        <div class="custom-tab-1">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#home1">All Campaign<br>แคมเปญทั้งหมด</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#profile1">Active<br>เปิดอยู่</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#contact1">Close<br>ปิดแล้ว</a>
                                </li>
                                
                            </ul>
                            
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
                                                <table class="table table-responsive-md">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:50px;">
                                                                <div class="custom-control custom-checkbox checkbox-success check-lg mr-3">
                                                                    <input type="checkbox" class="custom-control-input" id="checkAll" required="">
                                                                    <label class="custom-control-label" for="checkAll"></label>
                                                                </div>
                                                            </th>
                                                            <th><strong>CAM ID</strong></th>
                                                            <th><strong>DATE CREATE</strong></th>
                                                            <th><strong>CAM NAME</strong></th>
                                                            <th><strong>PAGE NAME</strong></th>
                                                            {{-- <th><strong>USER Respond.</strong></th> --}}
                                                            <th><strong>LOCATION</strong></th>
                                                            {{-- <th><strong>RETURN %</strong></th> --}}
                                                            <th><strong>Total Profit/Loss</strong></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($campaign as $key => $value)
                                                        @php
                                                            $page = \App\Models\Page::where('id',$value->page_id)->first();
                                                        @endphp
                                                        @if (isset($page))
                                                            
                                                        <tr>
                                                            <td>
                                                                <div class="custom-control custom-checkbox checkbox-success check-lg mr-3">
                                                                    <input type="checkbox" class="custom-control-input" id="customCheckBox{{ $key }}" >
                                                                    <label class="custom-control-label" for="customCheckBox{{ $key }}"></label>
                                                                </div>
                                                            </td>
                                                            <td><strong>{{ $value->campaign_id }}</strong></td>
                                                            <td>{{ date_format($value->created_at,'d/m/Y') }}</td>
                                                            <td>{{ $value->campaign_name}}</td>
                                                            <td>{{ $page->name }}</td>
                                                            {{-- <td>Numan Khan</td> --}}
                                                            <td>{{ $value->location }}</td>
                                                            {{-- <td><span class="text-danger">87%</span></td> --}}
                                                            <td>${{ $value->budget }}</td>
                                                            <td><span class="badge {{ $value->status == 1 ? 'badge-primary' : 'badge-danger' }} ">{{ $value->status == 1 ? 'Active/เปิดอยู่' : 'Close/ปิดแล้ว' }}</span></td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <a href="{{ route('campaign.edit',$value->id) }}" class="btn btn-white shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                                                    <a href="{{ route('campaign.destroy',$value->id) }}" onclick="return confirm('Are you Sure?')" class="btn btn-white shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endif

                                                        @empty
                                                        <tr>
                                                            <td colspan="9" class="text-center">Not Available</td>
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
                                                <table class="table table-responsive-md">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:50px;">
                                                                <div class="custom-control custom-checkbox checkbox-success check-lg mr-3">
                                                                    <input type="checkbox" class="custom-control-input" id="checkAll" required="">
                                                                    <label class="custom-control-label" for="checkAll"></label>
                                                                </div>
                                                            </th>
                                                            <th><strong>CAM ID</strong></th>
                                                            <th><strong>DATE CREATE</strong></th>
                                                            <th><strong>CAM NAME</strong></th>
                                                            <th><strong>PAGE NAME</strong></th>
                                                            {{-- <th><strong>USER Respond.</strong></th> --}}
                                                            <th><strong>LOCATION</strong></th>
                                                            {{-- <th><strong>RETURN %</strong></th> --}}
                                                            <th><strong>Total Profit/Loss</strong></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($active as $key => $value)
                                                        @php
                                                            $page = \App\Models\Page::where('id',$value->page_id)->first();
                                                        @endphp
                                                        @if (isset($page))
                                                        <tr>
                                                            <td>
                                                                <div class="custom-control custom-checkbox checkbox-success check-lg mr-3">
                                                                    <input type="checkbox" class="custom-control-input" id="customCheckBox{{ $key }}" >
                                                                    <label class="custom-control-label" for="customCheckBox{{ $key }}"></label>
                                                                </div>
                                                            </td>
                                                            <td><strong>{{ $value->campaign_id }}</strong></td>
                                                            <td>{{ date_format($value->created_at,'d/m/Y') }}</td>
                                                            <td>#</td>
                                                            <td>{{ $page->name }}</td>
                                                            {{-- <td>Numan Khan</td> --}}
                                                            <td>{{ $value->location }}</td>
                                                            {{-- <td><span class="text-danger">87%</span></td> --}}
                                                            <td>${{ $value->budget }}</td>
                                                            <td><span class="badge {{ $value->status == 1 ? 'badge-primary' : 'badge-danger' }} ">{{ $value->status == 1 ? 'Active' : 'Close' }}</span></td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <a href="{{ route('campaign.edit',$value->id) }}" class="btn btn-white shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                                                    <a href="{{ route('campaign.destroy',$value->id) }}" onclick="return confirm('Are you Sure?')" class="btn btn-white shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endif
                                                        @empty
                                                        <tr>
                                                            <td colspan="9" class="text-center">Not Available</td>
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
                                                <table class="table table-responsive-md">
                                                    <thead>
                                                        <tr>
                                                            <th style="width:50px;">
                                                                <div class="custom-control custom-checkbox checkbox-success check-lg mr-3">
                                                                    <input type="checkbox" class="custom-control-input" id="checkAll" required="">
                                                                    <label class="custom-control-label" for="checkAll"></label>
                                                                </div>
                                                            </th>
                                                            <th><strong>CAM ID</strong></th>
                                                            <th><strong>DATE CREATE</strong></th>
                                                            <th><strong>CAM NAME</strong></th>
                                                            <th><strong>PAGE NAME</strong></th>
                                                            {{-- <th><strong>USER Respond.</strong></th> --}}
                                                            <th><strong>LOCATION</strong></th>
                                                            {{-- <th><strong>RETURN %</strong></th> --}}
                                                            <th><strong>Total Profit/Loss</strong></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse ($inActive as $key => $value)
                                                        @php
                                                            $page = \App\Models\Page::where('id',$value->page_id)->first();
                                                        @endphp
                                                        @if (isset($page))
                                                        <tr>
                                                            <td>
                                                                <div class="custom-control custom-checkbox checkbox-success check-lg mr-3">
                                                                    <input type="checkbox" class="custom-control-input" id="customCheckBox{{ $key }}" >
                                                                    <label class="custom-control-label" for="customCheckBox{{ $key }}"></label>
                                                                </div>
                                                            </td>
                                                            <td><strong>{{ $value->campaign_id }}</strong></td>
                                                            <td>{{ date_format($value->created_at,'d/m/Y') }}</td>
                                                            <td>#</td>
                                                            <td>{{ $page->name }}</td>
                                                            {{-- <td>Numan Khan</td> --}}
                                                            <td>{{ $value->location }}</td>
                                                            {{-- <td><span class="text-danger">87%</span></td> --}}
                                                            <td>${{ $value->budget }}</td>
                                                            <td><span class="badge {{ $value->status == 1 ? 'badge-primary' : 'badge-danger' }} ">{{ $value->status == 1 ? 'Active' : 'Close' }}</span></td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <a href="{{ route('campaign.edit',$value->id) }}" class="btn btn-white shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                                                                    <a href="{{ route('campaign.destroy',$value->id) }}" onclick="return confirm('Are you Sure?')" class="btn btn-white shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endif
                                                        @empty
                                                        <tr>
                                                            <td colspan="9" class="text-center">Not Available</td>
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