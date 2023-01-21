
@extends('layouts.app')

@section('header')

Cashflow / คาดการณ์รายได้

@endsection

@section('content')

<div class="content-body">

    <div class="container-fluid">

        <div class="card  bg-white mt-1 ml-2">

            <div class="card-header row">

                {{-- <div class="row"> --}}

                    <div class="col-md-8">

                        <h6 class="card-title">Please select the date you want the document<br>กรุณาเลือกวันที่คุณต้องการเอกสาร</h6>

                    </div>

                    <div class="col-md-4">

                        <form action="{{ route('cashflow.export_excel') }}" class="form form-inline" method="POST">

                            @csrf

                            <input class="form-control input-daterange-datepicker" type="text" name="daterange" value="01/01/2023 - 12/31/2023">

                            <input type="submit" class="btn btn-sm btn-info ml-2" value="EXPORT EXCEL">

                        </form>

                    </div>

                {{-- </div> --}}

            </div>

           

        </div>

    </div>

</div>

@endsection