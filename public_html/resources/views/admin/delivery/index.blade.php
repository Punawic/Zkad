@extends('layouts.app')

@section('header')

Delivery / ติดตั้งค่าส่ง

@endsection

@section('content')

<div class="content-body">

    <div class="container-fluid">



        <div class="card  bg-white mt-1 ml-2">

            <div class="card-header">

                <h6 class="card-title">Create these cost of running page only one time<br>ใส่ต้นทุนครั้งเดียว</h6>

            </div>

            <div class="card-body">

                <div class="basic-form">

                    <form action="{{ route('delivery.store') }}" method="POST">

                        @csrf

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label>PAGE = CAMPAIGN NAME = PRODUCT NAME<br>ชื่อเพจ=ชื่อแคมเปญ=ชื่อสินค้า</label>

                                    <select id="inputState" name="page_campaign_name" required class="form-control default-select">

                                        @foreach ($campaign as $item)

                                            @php

                                                $page = \App\Models\Page::where('id',$item->page_id)->first();

                                                $exist = false;

                                            @endphp

                                            @foreach ($delivery as $value)

                                                @if ($value->page_campaign_name == $page->id .' = '. $item->campaign_name .' = '. $item->product_name )

                                                    @php

                                                        $exist = true;

                                                    @endphp

                                                @endif

                                            @endforeach

                                                @if (!empty($page) && !$exist) 

                                                  <option value="{{ $page->id }} = {{ $item->campaign_name }} = {{ $item->product_name }}">{{ $page->name }} = {{ $item->campaign_name }} = {{ $item->product_name }}</option>

                                                @endif

                                        @endforeach

                                    </select>

                                </div>



                                <div class="form-row justify-content-between align-items-center mt-4">

                                    <label class="col-3 col-form-label">COST<br>ต้นทุนสินค้า</label>

                                    <div class="col-6">

                                        <input type="number" class="form-control text-center" required name="cost" placeholder="ชิ้น">

                                    </div>

                                    <label class="col-2 col-form-label">PER PCS</label>

                                </div>



                                <div class="form-row justify-content-between align-items-center mt-3">

                                    <label class="col-3 col-form-label">DELIVERY FEES<br>ค่าส่ง</label>

                                    <div class="col-6">

                                        <input type="number" class="form-control text-center" required name="delivery_fee" placeholder="ชิ้น">

                                    </div>

                                    <label class="col-2 col-form-label">PER PCS</label>

                                </div>



                                <div class="form-row justify-content-between align-items-center mt-3">

                                    <label class="col-3 col-form-label">COD</label>

                                    <div class="col-6">

                                        <input type="number" class="form-control text-center" required name="cod" placeholder="ชิ้น">

                                    </div>

                                    <label class="col-2 col-form-label">PER PCS</label>

                                </div>

                            </div>



                            <div class="col-md-6 align-self-end">

                                <button type="submit" class="btn btn-success">ADD / เพิ่ม</button>

                            </div>                    

                        </div>

                    </form>

                </div>

            </div>

        </div>



        <div class="card bg-white mt-1 ml-2">

            <div class="card-header">

                <h4 class="card-title">All Delivery</h4>



                {{-- <button type="button" class="btn btn-primary btn-sm">ADD 

                    <span class="btn-icon-right"><i class="fa fa-plus"></i></span>

                </button> --}}

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

                                <th class="text-muted">PAGE NAME<br>ชื่อเพจ</th>

                                <th class="text-muted">CAMPAIGN NAME = PRODUCT NAME<br>แคมเปญ=สินค้า</th>

                                <th class="text-muted">COST<br>ต้นทุนสินค้า</th>

                                <th class="text-muted">DELIVERY FEES<br>ค่าส่ง</th>

                                <th class="text-muted">COD FEES<br> </th>

                                <th class="text-muted">TOTAL COST<br>รวม</th>

                                <th class="text-muted">DATE<br>วันติดตั้งค่าส่ง</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($delivery as $key => $value)

                            @php

                                $arr = explode('=',$value->page_campaign_name);

                                $page = \App\Models\Page::where('id',$arr[0])->first();

                                //  $total = 0;



                            @endphp

                            @if (isset($page))

                                

                            

                            <tr>

                                <td>

                                    <div class="custom-control custom-checkbox checkbox-success check-lg mr-3">

                                        <input type="checkbox" class="custom-control-input" id="customCheckBox1" required="">

                                        <label class="custom-control-label" for="customCheckBox1"></label>

                                    </div>

                                </td>

                                <td><div class="d-flex align-items-center">

                                    @if (!empty($page->image))

                                       <img src="{{ !empty($page->image) ? asset('storage/'.$page->image) : '/assets/images/avatar/1.jpg' }} " class="rounded-lg mr-2" width="24" alt=""/> 

                                    @endif

                                    <span class="w-space-no">{{ $page->name }}</span></div></td>

                                <td><strong>{{ explode('=',$value->page_campaign_name)[1] }} = {{ explode('=',$value->page_campaign_name)[2] }}</strong></td>

                                <td><strong class="text-dark">{{ $value->cost }}</strong></td>

                                <td><strong class="text-dark">{{ $value->delivery_fee }}</strong></td>

                                <td><strong class="text-dark">{{ $value->cod }}</strong></td>

                                <td><strong class="text-dark">{{ $value->cost+$value->delivery_fee+$value->cod }}</strong></td>

                                {{-- <td>01 August 2020</td> --}}

                                <td>{{ date_format($value->created_at,'d M Y') }}</td>

                                <td>

                                    <div class="d-flex">

                                        <a href="{{ route('delivery.edit',$value->id) }}" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>

                                        <a href="{{ route('delivery.destroy',$value->id) }}" onclick="return confirm('Are you Sure?')" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>

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

                {{-- <p>Page 1 of 1</p> --}}

            </div>

        </div>



    </div>

</div>

@endsection