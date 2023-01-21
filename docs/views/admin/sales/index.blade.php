

@extends('layouts.app')

@section('header')

Sale / ยอดขาย

@endsection

@section('content')

<div class="content-body">

    <div class="container-fluid">

        <div class="card  bg-white mt-1 ml-2">

            <div class="card-header row">

                {{-- <div class="row"> --}}

                    <div class="col-md-6">

                        <h6 class="card-title">Create Sale Information below</h6>

                    </div>

                    <div class="col-md-6">

                        <form action="{{ route('sales.export_excel') }}" class="form form-inline" method="POST">

                            @csrf

                            <input class="form-control input-daterange-datepicker" type="text" name="daterange" value="01/01/2023 - 12/31/2023">

                            <input type="submit" class="btn btn-sm btn-info ml-2" value="EXPORT EXCEL">

                        </form>

                    </div>

                {{-- </div> --}}

            </div>

            <div class="card-body">

                <div class="basic-form">

                    <form action="{{ route('sales.store') }}" method="POST">

                        @csrf

                        <div class="row">

                            <div class="col-md-12">

                                <div class="form-group">

                                    <label><b>Sale for / เลือกยอดวันที่</b></label>

                                    <input type="date" class="form-control" name="sale_date" required placeholder="day/month/year">

                                </div>


                                    <hr width="100%" size="3" align="center" color="green" noshade>


                                
                                <div class="form-group">

                                    <label><b>PAGE = CAMPAIGN NAME = PRODUCT NAME<br>ชื่อเพจ=ชื่อแคมเปญ=ชื่อสินค้า</b></label>



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
                                
                            

                                <hr width="100%" size="3" align="center" color="green" noshade>

                                <div class="form-row">

                                    <div class="form-group col-md-6">

                                        <label><b>GOAL / เป้าหมาย</b></label>

                                        <input type="number" class="form-control" name="goal" required value="" placeholder="GOAL">

                                    </div>

                                    <div class="form-group col-md-6">

                                        <label><b>SALE / ยอดขายที่ได้</b></label>

                                        <input type="number" class="form-control" name="sale" required value="" placeholder="SALE">

                                    </div>

                                </div>

                            </div>



                            <div class="col-md-6 align-self-end mb-3">

                                <button type="submit" class="btn btn-success">ADD / เพิ่ม</button>

                            </div>                    

                        </div>

                    </form>

                </div>

            </div>

        </div>



        <div class="card bg-white mt-1 ml-2">

            <div class="card-header">

                <h4 class="card-title">BILL TABLE </h4>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-responsive-md">

                        <thead>

                            <tr>

                                <th>DATE / วันที่</th>
                                
                                <th>PAGE NAME<br>ชื่อเพจ</th>

                                <th>PAGE = CAMPAIGN NAME = PRODUCT NAME<br>ชื่อเพจ=ชื่อแคมเปญ=ชื่อสินค้า</th>

                                <th>GOAL / เป้าหมาย</th>

                                <th>SALE / ยอดขาย</th>

                                <th>Execute(Delete) / ลบข้อมูล</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($sale as $key => $value)

                            @php

                                $arr = explode('=',$value->page_campaign_name);

                                $page = \App\Models\Page::where('id',$arr[0])->first();

                                //  $total = 0;



                            @endphp

                            @if (isset($page))

                                <tr>

                                    @php

                                        $date = date('d/m/Y', strtotime($value->sale_date))

                                    @endphp

                                    <th>{{ $date }}</th>

                                    <td><div class="d-flex align-items-center">

                                        @if (!empty($page->image))

                                            <img src="{{ !empty($page->image) ? asset('storage/'.$page->image) : '/assets/images/avatar/1.jpg' }} " class="rounded-lg mr-2" width="24" alt=""/> 

                                        @endif

                                        <span class="w-space-no">{{ $page->name }}</span></div></td>

                                    <td>{{ $value->page_campaign_name }}</td>

                                    <td>{{ $value->goal }}</td>

                                    <td>{{ $value->sale }}</td>

                                    <td><a href="{{ route('sales.destroy',$value->id) }}" onclick="return confirm('Are you Sure?')" class="text-danger">delete</a></td>

                                </tr>

                                
                            @endif


                            @empty

                            <tr>

                                <td colspan="5" class="text-center">Not Available</td>

                            </tr>

                            @endforelse

                          

                          

                        </tbody>

                    </table>

                </div>

                <div class="row mt-3">

                    <div class="col-md-12 text-right">

                        {{-- <button type="submit" class="btn btn-success">SAVE</button> --}}

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection