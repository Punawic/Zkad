@extends('layouts.app')

@section('header')

Return Percent By Page / เปอร์เซ็นต์คืนแยกเพจ

@endsection

@section('content')

<div class="content-body">

    <div class="container-fluid">



        <div class="card  bg-white mt-1 ml-2">

            <div class="card-header row">

                {{-- <div class="row"> --}}

                    <div class="col-md-6">

                        <h6 class="card-title">Choose the page and input the number below</h6>

                    </div>




                    <div class="col-md-6">

                        <form action="{{ route('percent_pages.export_excel') }}" class="form form-inline" method="POST">

                        @csrf

                            <input class="form-control input-daterange-datepicker" type="text" name="daterange" value="11/01/2022 - 12/31/2022">

                            <input type="submit" class="btn btn-sm btn-info ml-2" value="EXPORT EXCEL">

                        </form>

                    </div>

                {{-- </div> --}}

            </div>


            <div class="card-body">

                <div class="basic-form">

                    <form action="{{ route('percent.page.store') }}" method="POST">

                        @csrf

                        <div class="row justify-content-around">

                            <div class="col-lg-4">

                                <label>Choose The Date / เลือกวันที่</label>

                                <div class="form-group">

                                    <input type="date" class="form-control" name="date" required placeholder="day/month/year">

                                </div>

                            </div>



                            <div class="col-lg-7">

                                <div class="row">

                                    <div class="col-md-9">

                                        <div class="form-group">

                                            <label>PAGE = CAMPAIGN NAME = PRODUCT NAME<br>ชื่อเพจ=ชื่อแคมเปญ=ชื่อสินค้า</label>

                                            <select id="inputState" name="page_campaign_name" required class="form-control default-select">

                                                @foreach ($campaign as $item)

                                                    @php

                                                        $page = \App\Models\Page::where('id',$item->page_id)->first();

                                                    @endphp

                                                    @if (!empty($page)) 

                                                      <option value="{{ $page->id }} = {{ $item->campaign_name }} = {{ $item->product_name }}">{{ $page->name }} = {{ $item->campaign_name }} = {{ $item->product_name }}</option>

                                                    @endif

                                                @endforeach

                                            </select>

                                        </div>



                                        <div class="form-row justify-content-between align-items-center mt-4">

                                            <label class="col-3 col-form-label">

                                            <strong class="text-dark">Total Delivery<br>ยอดส่งรวม</strong>

                                            </label>

                                            <div class="col-4">

                                                <input type="number" class="form-control text-center" required name="total_delivery" placeholder="ชิ้น">

                                            </div>

                                            <label class="col-2 col-form-label">PCS</label>

                                        </div>



                                        <div class="form-row justify-content-between align-items-center mt-3">

                                            <label class="col-3 col-form-label">

                                            <strong class="text-dark">Recieved<br>เซ็นรับแล้ว</strong>

                                            </label>

                                            <div class="col-4">

                                                <input type="number" class="form-control text-center" required name="recieved" placeholder="ชิ้น">

                                            </div>

                                            <label class="col-2 col-form-label">PCS</label>

                                        </div>

                                    </div>



                                    <div class="col-md-3 align-self-end">

                                        <button type="submit" class="btn btn-success">ADD / เพิ่ม</button>

                                    </div>                    

                                </div>

                            </div>

                        </div>



                    </form>

                </div>

            </div>

        </div>



        <div class="card bg-white mt-1 ml-2">

            <div class="card-header row">

                <div class="col-md-3  mb-3">

                    <h4 class="card-title">All Page Return Percentage</h4>  

                </div>

                <div class="col-md-5">

                    <div class="basic-form">

                        <form class="form-inline">

                            <div class="form-group mb-2">

                                <label class="mr-2">From:</label>

                                <input type="date" value="{{ isset($_GET['from']) ? $_GET['from'] : '' }}" class="form-control from-date">

                            </div>

                            <div class="form-group mx-sm-3 mb-2">

                                <label class="mr-2">To:</label>

                                <input type="date" value="{{ isset($_GET['to']) ? $_GET['to'] : '' }}" class="form-control to-date">

                            </div>

                            <button type="button" class="btn btn-info btn-sm mb-2 search-btn">Search</button>

                        </form>

                    </div>

                </div>

                <div class="col-md-4">


                <div class="basic-form">

                        <form class="form-inline" action="{{ route('percent.page.search') }}" method="GET">

                            <div class="form-group mx-sm-3 mb-2">

                                <label class="mr-2">From:</label>

                                <input type="search" name="search"  class="form-control" wire:model="search" >

                            </div>


                             <button type="submit" class="btn btn-info btn-sm mb-2">Search</button>

                        </form>

                </div>


                

                    {{-- <button type="button" class="btn btn-primary btn-sm mb-2">ADD 

                        <span class="btn-icon-right"><i class="fa fa-plus"></i></span>

                    </button> --}}

                </div>

            </div>

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

                                <th class="text-muted">DATE<br>วันที่</th>

                                <th class="text-muted">PAGE NAME<br>ชื่อเพจ</th>

                                <th class="text-muted">CAMPAIGN NAME = PRODUCT NAME<br>แคมเปญ = ชื่อสินค้า</th>

                                <th class="text-muted">Total Delivery<br>ยอดส่งรวม</th>

                                <th class="text-muted">Recieved<br>เซ็นรับแล้ว</th>

                                <th class="text-muted">%Return<br>% ตีคืน</th>

                                <th class="text-muted">Action</th>

                            </tr>

                        </thead>

                        <tbody>



                            {{-- <tr>

                                <td>

                                    <div class="custom-control custom-checkbox checkbox-success check-lg mr-3">

                                        <input type="checkbox" class="custom-control-input" id="customCheckBox1" required="">

                                        <label class="custom-control-label" for="customCheckBox1"></label>

                                    </div>

                                </td>

                                <td>01 August 2020</td>

                                <td><div class="d-flex align-items-center"><img src="/assets/images/avatar/1.jpg" class="rounded-lg mr-2" width="24" alt=""/> <span class="w-space-no">page1</span></div></td>

                                <td><strong>CAMPAIGN HELLO = NECKLACEKITTY</strong></td>

                                <td><strong class="text-dark">38</strong></td>

                                <td><strong class="text-dark">20</strong></td>

                                <td><strong class="text-dark">20%</strong></td>

                                <td>

                                    <div class="d-flex">

                                        <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>

                                        <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>

                                    </div>

                                </td>

                            </tr> --}}
  
                           @forelse ($percentPage as $key => $value)

                            @php

                                $arr = explode('=',$value->page_campaign_name);

                                 $page = \App\Models\Page::where('id',$arr[0])->first();

                            @endphp

                            @if (isset($page))

                                

                            <tr>

                                <td>

                                    <div class="custom-control custom-checkbox checkbox-success check-lg mr-3">

                                        <input type="checkbox" class="custom-control-input" id="customCheckBox1" required="">

                                        <label class="custom-control-label" for="customCheckBox1"></label>

                                    </div>

                                </td>

                                <td>{{ date_format(date_create($value->date),'d M Y') }}</td>

                                <td><div class="d-flex align-items-center">

                                    @if (!empty($page->image))

                                       <img src="{{ !empty($page->image) ? asset('storage/'.$page->image) : '/assets/images/avatar/1.jpg' }} " class="rounded-lg mr-2" width="24" alt=""/> 

                                    @endif

                                    <span class="w-space-no">{{ $page->name }}</span></div></td>

                                <td><strong>{{ explode('=',$value->page_campaign_name)[1] }} = {{ explode('=',$value->page_campaign_name)[2] }}</strong></td>  

                                <td><strong class="text-dark">{{ $value->total_delivery }}</strong></td>

                                <td><strong class="text-dark">{{ $value->recieved }}</strong></td>

                                <td><strong class="text-dark">{{ number_format((float) ($value->recieved/$value->total_delivery) - 1, 2, '.', '')  }}%</strong></td>

                                <td>

                                    <div class="d-flex">

                                        <a href="{{ route('percent.edit',$value->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>

                                        <a href="{{ route('percent.destroy',$value->id) }}" onclick="return confirm('Are you Sure?')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>

                                    </div>

                                </td>

                            </tr>

                            @endif

                                

                            @empty

                            <tr>

                                <td colspan="7" class="text-center">Not Available</td>

                            </tr>

                            @endforelse
                            
                         

                        </tbody>

                    </table>

                </div>



                <p>Page 1 of 1</p>

            </div>

        </div>



    </div>

</div>

@endsection



