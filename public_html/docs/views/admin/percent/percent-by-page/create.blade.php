@extends('layouts.app')
@section('header')
Return Percent By Page
@endsection
@section('content')
<div class="content-body">
    <div class="container-fluid">

        <div class="card  bg-white mt-1 ml-2">
            <div class="card-header">
                <h6 class="card-title">Choose the page and input the number below</h6>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="{{ route('percent.update',$percentPage->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="row justify-content-around">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="date" class="form-control" name="date"  value="{{ $percentPage->date }}" placeholder="day/month/year">
                                </div>
                            </div>

                            <div class="col-lg-7">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label>PAGE = CAMPAIGN NAME = PRODUCT NAME</label>
                                            <select id="inputState" name="page_campaign_name"  class="form-control default-select">
                                                @foreach ($campaign as $item)
                                                    @php
                                                        $page = \App\Models\Page::where('id',$item->page_id)->first();
                                                    @endphp
                                                    @if (!empty($page)) 
                                                    <option {{ $percentPage->page_campaign_name == $page->id.' = ' . $item->campaign_name . ' = ' .$item->product_name ? 'selected' : '' }} value="{{ $page->id }} = {{ $item->campaign_name }} = {{ $item->product_name }}">{{ $page->name }} = {{ $item->campaign_name }} = {{ $item->product_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-row justify-content-between align-items-center mt-4">
                                            <label class="col-3 col-form-label">
                                            <strong class="text-dark">Total Delivery</strong>
                                            </label>
                                            <div class="col-4">
                                                <input type="number" class="form-control text-center" value="{{ $percentPage->total_delivery }}" name="total_delivery" placeholder="Total Delivery">
                                            </div>
                                            <label class="col-2 col-form-label">PCS</label>
                                        </div>

                                        <div class="form-row justify-content-between align-items-center mt-3">
                                            <label class="col-3 col-form-label">
                                            <strong class="text-dark">Recieved</strong>
                                            </label>
                                            <div class="col-4">
                                                <input type="number" class="form-control text-center" value="{{ $percentPage->recieved }}" name="recieved" placeholder="Recieved">
                                            </div>
                                            <label class="col-2 col-form-label">PCS</label>
                                        </div>
                                    </div>

                                    <div class="col-md-3 align-self-end">
                                        <button type="submit" class="btn btn-success">Update</button>
                                    </div>                    
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        

    </div>
</div>
@endsection