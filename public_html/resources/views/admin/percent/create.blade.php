
@extends('layouts.app')

@section('content')

<div class="event-sidebar dz-scroll active" id="eventSidebar">
    <div class="card shadow-none rounded-0 bg-transparent h-auto mb-0">
        <div class="row">
           <div class="col-md-12 text-right">
              <!-- Default switch -->
              
            <div class="custom-control custom-switch">
                
                <input type="checkbox" checked class="custom-control-input" id="customSwitches">
                <label class="custom-control-label" for="customSwitches">Active</label>
            </div>
           </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <p>Images</p>
                        <a href="#" class="text-success">+Upload</a>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control bg-custom border-radius-none" name="" id="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0 pb-0">
                        <h4 class="card-title">Sales Summary</h4>
                        <div class="btn-group">
                            <button class="btn btn-light btn-sm tp-btn dropdown-toggle" type="button" data-toggle="dropdown">
                                This Week
                            </button>
                            <div class="dropdown-menu dropdown-right">
                                <a class="dropdown-item" href="javascript:void(0);">This Week</a>
                                <a class="dropdown-item" href="javascript:void(0);">Next Week</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-2">
                        <div class="border p-3 d-flex justify-content-between fs-14 rounded-lg mb-4">
                            <span class="text-black">Tuesday</span>
                            <span class="text-black">215,523 pcs</span>
                        </div>
                        
                        <div class="text-center">
                            <div id="polarAreaCharts"></div>
                        </div>
                        <div class="row mx-0">
                            <div class="col-6 px-0 d-flex align-items-center mb-3">
                                <div class="bg-primary rounded mr-3 d-block" style="width:25px; height:25px;"></div>
                                <div>
                                    <h5 class="mb-1 text-black">VIP</h5>
                                    <span>30%</span>
                                </div>
                            </div>
                            <div class="col-6 px-0 d-flex align-items-center mb-3">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
</div>

<!--**********************************
    Content body start
***********************************-->
<div class="content-body rightside-event">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Create New Campaign</h4>
                    </div>
                    <div class="card-body">
                        <div class="basic-form">
                            <form action="#">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>CAMPAIGN ID</label>
                                        <div class="input-group mb-3">
                                           <input type="text" class="form-control" value="#345893405843">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">random code</button>
                                            </div>
                                       </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>CAMPAIGN NAME</label>
                                        <input type="text" class="form-control" placeholder="CAMPAIGN NAME">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>PAGE</label>
                                        <select name="" class="form-control" id="">
                                            <option value="">1</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Budget per day</label>
                                        <input type="number" class="form-control" value="1000">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Keyword</label>
                                        <input type="text" class="form-control" placeholder="CAMPAIGN NAME">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>USER DUTIES</label>
                                        <select name="" class="form-control" id="">
                                            <option value="">----Choose oneuser----</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>PRODUCT NAME</label>
                                        <input type="text" class="form-control" placeholder="CAMPAIGN NAME">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>LOCATION</label>
                                        <input type="text" class="form-control" placeholder="CAMPAIGN NAME">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Description *</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="summernote"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <button class="btn btn-success">Save</button>
                                    </div>
                                </div>

                                {{-- <div class="input-group mb-3">
                                    <label for="">CAMPAIGN ID</label>
                                    <input type="text" class="form-control" value="#345893405843">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">random code</button>
                                    </div>
                                </div> --}}

                             
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

@endsection