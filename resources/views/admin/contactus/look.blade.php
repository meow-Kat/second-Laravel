@extends('layouts.app')

@section('title', '查看聯絡我們')

@section('css')

@endsection

@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{asset('/admin/home')}}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ asset('/admin/contact_us') }}">聯絡我們管理</a></li>
              <li class="breadcrumb-item active" aria-current="page">查看聯絡我們</li>
            </ol>
          </nav>
          <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>查看聯絡我們</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ asset('admin/contact_us') }}/{{ $record->id }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <label class="py-2" for="name">姓名</label>
                                    <input type="name" class="form-control" id="name" name="name" required value="{{ $record->name }}" readonly>
                                    <label class="py-2" for="email">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" required value="{{ $record->email }}" readonly>
                                    <label class="py-2" for="title">標題</label>
                                    <input type="title" class="form-control" id="title" name="title" required value="{{ $record->title }}" readonly>
                                    <div class="form-group pt-2">
                                        <label for="content">內容</label>
                                        <textarea class="form-control" id="content" rows="3"
                                            name="content" readonly>{{ $record->content }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <a href="{{ asset('/admin/contact_us') }}" class="btn btn-primary">返回</a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')

@endsection
