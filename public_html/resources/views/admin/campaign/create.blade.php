

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

           

            <div class="col-xl-9 col-lg-9">

                <form action="{{ isset($campaign) ? route('campaign.update',$campaign->id) : route('campaign.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf

                    @if (isset($campaign))

                        @method('put')

                    @endif

                <div class="card">

                    <div class="card-header">

                        <h4 class="card-title">Create New Campaign / สร้างแคมเปญใหม่</h4>

                    </div>

                    <div class="card-body">

                        <div class="basic-form">

                            

                                <div class="form-row">

                                    <div class="form-group col-md-6">

                                        <label>CAMPAIGN ID</label>

                                        <div class="input-group mb-3">

                                           <input type="text" class="form-control" readonly required name="campaign_id" value="{{ isset($campaign) ? $campaign->campaign_id : 'กดปุ่มสีน้ำเงินเพื่อสุ่มรหัสแคมเปญ'}}">

                                            <div class="input-group-append">

                                                <button class="btn btn-primary random-btn" type="button">random code</button>

                                            </div>

                                       </div>

                                    </div>

                                    <div class="form-group col-md-6">

                                        <label>CAMPAIGN NAME</label>

                                        <input type="text" class="form-control" name="campaign_name" required value="{{ isset($campaign) ? $campaign->campaign_name : ''}}"  placeholder="ชื่อแคมเปญ">

                                    </div>

                                    <div class="form-group col-md-6">

                                        <label>PAGE / เลือกเพจ</label>

                                        <select name="page_id" class="form-control" required>

                                            @foreach (\App\Models\Page::orderBy('id','desc')->get() as $item)

                                               <option {{ isset($campaign) && $campaign->page_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>        

                                            @endforeach

                                        </select>

                                    </div>

                                    <div class="form-group col-md-6">

                                        <label>Budget per day / งบประมาณต่อวัน</label>

                                        <input type="number" class="form-control" name="budget" required  value="{{ isset($campaign) ? $campaign->budget : '' }}">

                                    </div>

                                    <div class="form-group col-md-6">

                                        

                                        <label>Keyword / กลุ่มเป้าหมาย</label>

                                        <div id="box">



                                            <ul>

                                               @if (isset($campaign))

                                               <input type="text" id="type" class="form-control" name="" value="" placeholder="Keyword">

                                                @foreach (explode(',',$campaign->keyword) as $item)

                                                    @if (!empty($item))

                                                        <li><span>{{ $item }}<input type="hidden" name="key[]" value="{{ $item }}" /><a href="javascript:void(0);" class="mt-1" onclick="closer()">x</a></span></li>

                                                    @endif

                                                @endforeach

                                                @else

                                                    <li>

                                                        <input type="text" id="type" class="form-control" name="" required value="{{ isset($campaign) ? $campaign->keyword : '' }}" placeholder="Keyword">

                                                    </li>

                                                @endif

                                                {{-- <input type="text" id="type" class="form-control" name="" value="" placeholder="Keyword">  --}}

                                            </ul>

                                        </div>

                                    </div>

                                    <div class="form-group col-md-6">

                                        <label>USER DUTIES / พนักงานดูแลเพจ</label>

                                        <input type="text" class="form-control" name="duty" required value="{{ isset($campaign) ? $campaign->duty : '' }}" placeholder="USER DUTIES">

                                        {{-- <select name="duty" class="form-control" required>

                                            <option value="">----Choose oneuser----</option>

                                            <option {{ isset($campaign) && $campaign->duty == 1 ? 'selected' : '' }} value="1">1</option>

                                            <option {{ isset($campaign) && $campaign->duty == 2 ? 'selected' : '' }} value="2">2</option>

                                        </select> --}}

                                    </div>

                                    <div class="form-group col-md-6">

                                        <label>PRODUCT NAME / ชื่อสินค้า</label>

                                        <input type="text" class="form-control" name="product_name" required value="{{ isset($campaign) ? $campaign->product_name : '' }}" placeholder="PRODUCT NAME">

                                    </div>

                                    <div class="form-group col-md-6">

                                        <label>LOCATION / จังหวัด</label>

                                        <input type="text" class="form-control" name="location" required value="{{ isset($campaign) ? $campaign->location : '' }}" placeholder="LOCATION">

                                    </div>

                                    <div class="form-group col-md-6">

                                        <label>SALE PRICE / ราคาขายต่อออเดอร์</label>

                                        <input type="text" class="form-control" name="sale_price" required value="{{ isset($campaign) ? $campaign->sale_price : '' }}" placeholder="SALE PRICE">

                                    </div>

                                    <div class="form-group col-md-12">

                                        <div class="card">

                                            <div class="card-header">

                                                <h4 class="card-title">Description * / ใส่แคปชั่น รายละเอียด</h4>

                                            </div>

                                            <div class="card-body">

                                                <div class="summernote"></div>

                                                <textarea name="description" class="hidden text-area">{!! isset($campaign) ? $campaign->description : ''  !!}</textarea>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-12 text-right">

                                        <button type="submit" class="btn btn-success description-save">Save</button>

                                    </div>

                                </div>                            

                        </div>

                    </div>

                </div>

            </div>



            <div class="col-xl-3 col-lg-3">

                <div class="" >

                 

                    <div class="card shadow-none rounded-0 bg-transparent h-auto mb-0">

                        <div class="row">

                           <div class="col-md-12 text-right">

                              <!-- Default switch -->

                              

                            <div class="custom-control custom-switch">

                                

                                <input type="checkbox" name="status" {{ isset($campaign) && $campaign->status == 1 ? 'checked' : '' }} class="custom-control-input" id="customSwitches">

                                <label class="custom-control-label" for="customSwitches">Active / Close <br> สถานะเปิด / ปิด</label>

                            </div>

                           </div>

                            <div class="col-md-12">

                                <div class="card">

                                    <div class="card-header d-flex justify-content-between">

                                        <p>Images<br>อัพโหลดวิดีโอ</p>

                                        <a href="javascript:void(0)" onclick="$('.image-campain').click()" class="text-success">+Upload</a>

                                        <input type="file" class="hidden image-campain" name="image">

                                    </div>

                                    <div class="card-body">

                                        <div class="form-group">

                                            @if (isset($campaign))

                                              <img src="{{ !empty($campaign->image) ? asset('storage/'.$campaign->image) : asset('assets/images/user-1.png') }}" width="100px" alt="">

                                                

                                            @endif

                                            {{-- <input type="text" class="form-control bg-custom border-radius-none" name="" id=""> --}}

                                        </div>

                                    </div>

                                </div>

                            </div>

                            @if (isset($campaign))

                            <div class="col-md-12">

                                <div class="card">

                                    <div class="card-header border-0 pb-0">

                                        <h4 class="card-title">Sales Summary</h4>

                                        {{-- <div class="btn-group">

                                            <button class="btn btn-light btn-sm tp-btn dropdown-toggle" type="button" data-toggle="dropdown">

                                                This Week

                                            </button>

                                            <div class="dropdown-menu dropdown-right">

                                                <a class="dropdown-item" href="javascript:void(0);">This Week</a>

                                                <a class="dropdown-item" href="javascript:void(0);">Next Week</a>

                                            </div>

                                        </div> --}}

                                    </div>

                                    <div class="card-body pt-2">

                                        <div class="border p-3 d-flex justify-content-between fs-14 rounded-lg mb-4">

                                            <span class="text-black">{{ date_format($campaign->created_at,'D') }}</span>

                                            <span class="text-black">$ {{ $campaign->budget }}</span>

                                        </div>

                                        

                                        <div class="text-center">

                                            <div id="polarAreaCharts"></div>

                                        </div>

                                        <div class="row mx-0">

                                            <div class="col-6 px-0 d-flex align-items-center mb-3">

                                                <div class="bg-primary rounded mr-3 d-block" style="width:25px; height:25px;"></div>

                                                <div>

                                                    <h5 class="mb-1 text-black">Budget</h5>

                                                    {{-- <span>30%</span> --}}

                                                </div>

                                            </div>

                                            {{-- <div class="col-6 px-0 d-flex align-items-center mb-3">

                                                <div class="bg-success rounded mr-3 d-block" style="width:25px; height:25px;"></div>

                                                <div>

                                                    <h5 class="mb-1 text-black">Exclusive</h5>

                                                    <span>24%</span>

                                                </div>

                                            </div>

                                            <div class="col-6 px-0 d-flex align-items-center">

                                                <div class="bg-warning rounded mr-3 d-block" style="width:25px; height:25px;"></div>

                                                <div>

                                                    <h5 class="mb-1 text-black">Reguler</h5>

                                                    <span>30%</span>

                                                </div>

                                            </div>

                                            <div class="col-6 px-0 d-flex align-items-center">

                                                <div class="bg-secondary rounded mr-3 d-block" style="width:25px; height:25px;"></div>

                                                <div>

                                                    <h5 class="mb-1 text-black">Economic</h5>

                                                    <span>2%</span>

                                                </div>

                                            </div> --}}

                                        </div>

                                    </div>

                                </div>

                            </div>



                            @endif

                        </div>

                    </div>

                  

                </div>

            </div>

            

        </div>

    </div>

  </form>

</div>



@endsection



@section('js')

@if (isset($campaign))

   @include('include.chart') 

@endif



<script>

    function closer(){

        $('#box a').on('click', function() {

            $(this).parent().parent().remove(); 

        });

    }



    function close(){

        $(this).parent().parent().remove(); 

    }



    let text = '';

    $('#type').keypress(function(e) {

        if(e.which == 32) {//change to 32 for spacebar instead of enter

            var tx = $(this).val();

            if (tx) {

                $(this).val('').parent().before('<li><span>'+tx+'<input type="hidden" name="key[]" value="'+ tx +'" /><a href="javascript:void(0);" class="mt-1">x</a></span></li>');

                closer();

            }

        }

    });

</script>

@endsection