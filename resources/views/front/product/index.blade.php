@extends('layouts.template')

@section('css')

@endsection

@section('tile', '產品列')

@section('main')
    <div class="container">
        <div class="row my-3">
            <a href="/product" class="btn btn-primary mr-2">All</a>
            @foreach ($types as $type)
             {{-- 打?後面就可以傳參數 --}}
                <a href="/product?type_id={{ $type->id }}" class="btn btn-primary mr-2">{{ $type->type_name }}</a>
            @endforeach
        </div>
    </div>
    <div class="container">
        <div class="row">
            @foreach ($record as $item)
                <div class="card" style="width: 18rem;">
                    <img src="{{ $item->pic }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->product_name }}</h5>
                        <p class="card-text">$ {{ $item->product_price }}</p>
                        <a href="#" class="btn btn-primary">加入購物車</a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

@endsection

@section('js')

@endsection
