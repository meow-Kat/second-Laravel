@extends('layouts.app')

@section('title', '新增產品品項')

@section('css')

@endsection

@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ asset('/admin/home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="">產品品項</a></li>
                <li class="breadcrumb-item active" aria-current="page">產品種類管理</li>
            </ol>
          </nav>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2>新增產品種類</h2></div>
                    <div class="card-body">
                        <form method="POST" action="{{ asset('admin/product/type/store') }}">
                            @csrf
                            {{-- <div class="form-group row">
                                <label for="role" class="col-md-4 col-form-label text-md-right">腳色</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="role" name="role">
                                        <option>admin</option>
                                        <option>user</option>
                                      </select>
                                </div>
                            </div> --}}

                            <div class="form-group row">
                                <label for="type_name" class="col-md-4 col-form-label text-md-right">品項</label>
                                <div class="col-md-6">                             {{--  報錯會顯示在這邊  --}}
                                    <input id="type_name" type="text" class="form-control @error('type_name') is-invalid @enderror" name="type_name" value="{{ old('type_name') }}" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        新增
                                    </button>
                                </div>
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
