
@extends('layouts.app')
@section('header')
Page / เพจ
@endsection
@section('content')


<div class="content-body ">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
           
            <div class="col-xl-12">
                <form action="{{ isset($page) ? route('page.update',$page->id) : route('page.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($page))
                    @method('put')
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{ isset($page) ? 'Update' : 'Create' }} Page / สร้างเพจใหม่</h4>
                    </div>
                    <div class="card-body">
                      
                        <div class="basic-form">
                            <form>
                                <div class="form-group">
                                    <input type="text" class="form-control input-default" name="name" value="{{ isset($page) ? $page->name : '' }}" required placeholder="Enter page name / ใส่ชื่อเพจ">
                                </div>
                                @if (isset($page))
                                  <img src="{{ asset('storage/'.$page->image) }}" width="100px" alt="">  
                                @endif
                                <div class="form-group">
                                    <input type="file" class="form-control input-rounded" {{ !isset($page) ? 'required' : '' }} name="image">
                                </div>
                                <div class="form-group">
                                    <input type="checkbox" id="active" name="status" {{ isset($page) && $page->status=='1' ? 'checked' : '' }}>
                                    <label for="active">Avariable / ติ๊กเพื่อเปิดเพจ</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="reset" class="btn btn-danger">Reset / รีเซตใหม่</button>
                                        <button type="submit" class="btn btn-primary">{{ isset($page) ? 'Update' : 'Create' }} / สร้าง</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                           
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

@endsection