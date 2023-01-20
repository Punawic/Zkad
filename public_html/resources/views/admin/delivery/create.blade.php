@extends('layouts.app')
@section('header')
Delivery
@endsection
@section('content')
<div class="content-body">
    <div class="container-fluid">

        <div class="card  bg-white mt-1 ml-2">
            <div class="card-header">
                <h6 class="card-title">Create these cost of running page only one time</h6>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="{{ route('delivery.update',$delivery->id) }}" method="POST">
                        @method('put')
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>PAGE = CAMPAIGN NAME = PRODUCT NAME</label>
                                    <select id="inputState" name="page_campaign_name" class="form-control default-select">
                                        @foreach ($campaign as $item)
                                            @php
                                                $page = \App\Models\Page::where('id',$item->page_id)->first();
                                            @endphp
                                            @if (!empty($page)) 
                                               <option {{ $delivery->page_campaign_name == $page->id.' = ' . $item->campaign_name . ' = ' .$item->product_name ? 'selected' : '' }} value="{{ $page->id }} = {{ $item->campaign_name }} = {{ $item->product_name }}">{{ $page->name }} = {{ $item->campaign_name }} = {{ $item->product_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-row justify-content-between align-items-center mt-4">
                                    <label class="col-3 col-form-label">COST</label>
                                    <div class="col-6">
                                        <input type="number" class="form-control text-center" name="cost" value="{{ $delivery->cost }}" placeholder="COST">
                                    </div>
                                    <label class="col-2 col-form-label">PER PCS</label>
                                </div>

                                <div class="form-row justify-content-between align-items-center mt-3">
                                    <label class="col-3 col-form-label">DELIVERY FEES</label>
                                    <div class="col-6">
                                        <input type="number" class="form-control text-center" name="delivery_fee" value="{{ $delivery->delivery_fee }}" placeholder="DELIVERY FEES">
                                    </div>
                                    <label class="col-2 col-form-label">PER PCS</label>
                                </div>

                                <div class="form-row justify-content-between align-items-center mt-3">
                                    <label class="col-3 col-form-label">COD</label>
                                    <div class="col-6">
                                        <input type="number" class="form-control text-center" name="cod" value="{{ $delivery->cod }}" placeholder="COD">
                                    </div>
                                    <label class="col-2 col-form-label">PER PCS</label>
                                </div>
                            </div>

                            <div class="col-md-6 align-self-end">
                                <button type="submit" class="btn btn-success">Update</button>
                            </div>                    
                        </div>
                    </form>
                </div>
            </div>
        </div>

       

    </div>
</div>
@endsection