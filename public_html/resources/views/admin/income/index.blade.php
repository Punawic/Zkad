
@extends('layouts.app')

@section('header')

Income/ รายรับ

@endsection

@section('content')

<div class="content-body">

    <div class="container-fluid">

        <div class="card  bg-white mt-1 ml-2">

            <div class="card-header row">

                {{-- <div class="row"> --}}

                    <div class="col-md-8">

                        <h6 class="card-title">Please enter the advertising cost of that page each day. (select previous day)<br>กรุณากรอกค่าโฆษณาของเพจนั้นในแต่ละวัน (เลือกวันก่อนหน้า)</h6>

                    </div>

                    <div class="col-md-4">

                        <form action="{{ route('income.export_excel') }}" class="form form-inline" method="POST">

                            @csrf

                            <input class="form-control input-daterange-datepicker" type="text" name="daterange" value="01/01/2023 - 12/31/2023">

                            <input type="submit" class="btn btn-sm btn-info ml-2" value="EXPORT EXCEL">

                        </form>

                    </div>

                {{-- </div> --}}

            </div>

            <div class="card-body">

                <div class="basic-form">

                    <form action="{{ route('income.store') }}" method="POST">

                        @csrf

                        <div class="row">

                            <div class="col-md-12">

                                <div class="form-group col-md-6">

                                    <label><b>Sale for / เลือกยอดวันที่</b></label>

                                    <input type="date" class="form-control" name="date" required placeholder="day/month/year">

                                </div>


                                    <hr width="100%" size="3" align="center" color="green" noshade>


                                <div class="form-row">

                                    <div class="form-group col-md-6">

                                        <label><b>Income / รายรับ</b></label>

                                        <input type="number" class="form-control" name="income" required value="" placeholder="รายรับ">

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
                                
                                <th>INCOME / รายรับ</th>

                                <th>Execute(Delete) / ลบข้อมูล</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($income as $key => $value)


                                <tr>

                                    @php

                                        $date = date('d/m/Y', strtotime($value->date))

                                    @endphp

                                    <th>{{ $date }}</th>

                                    <td>{{ $value->income }}</td>

                                    <td><a href="{{ route('income.destroy',$value->id) }}" onclick="return confirm('Are you Sure?')" class="text-danger">delete</a></td>

                                </tr>

                                
                            


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