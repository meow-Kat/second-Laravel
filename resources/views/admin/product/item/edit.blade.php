@extends('layouts.app')

@section('title', '編輯產品品項')

@section('css')

@endsection

@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{asset('/admin/home')}}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">編輯產品品項</li>
            </ol>
          </nav>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2>編輯產品品項</h2></div>
                    <div class="card-body">
                        <form method="POST" action="{{ asset('admin/product/item/update') }}/{{ $record->id }}">
                            @csrf

                            <div class="form-group row">
                                <label for="product_type_id" class="col-md-4 col-form-label text-md-right">分類</label>
                                <div class="col-md-6">
                                    <select class="form-control" id="role" name="product_type_id">
                                        @foreach ($type as $item)
                                            <option value="{{ $item->id }}">{{ $item->type_name }}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="product_name" class="col-md-4 col-form-label text-md-right">品項</label>
                                <div class="col-md-6">
                                    <input id="product_name" type="text" class="form-control @error('product_name') is-invalid @enderror" name="product_name" value="{{ $record->product_name }}" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="product_price" class="col-md-4 col-form-label text-md-right">價格</label>
                                <div class="col-md-6">
                                    <input id="product_price" type="number" class="form-control" name="product_price" value="{{ $record->product_price }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="product_discript">描述</label>
                                <textarea class="form-control" id="product_discript" rows="3">{{ $record->product_discript }}</textarea>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">更新</button>
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
