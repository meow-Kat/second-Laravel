@extends('layouts.app')

@section('title', '編輯產品品項')

@section('css')
    <style>
        .del-img-btn{
            position: absolute;
            right: 10px;
            top: -10px;
            width: 20px;
            height: 20px;
            background-color: red;
            border-radius:50%;
            cursor: pointer;
            color: white;
            text-align: center;
            line-height: 22px;
            font-size:16px 
        }
    </style>
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
                    <div class="card-body">                                                {{--  ↓ 圖片要注意 --}}
                        <form method="POST" action="{{ asset('admin/product/item/update') }}/{{ $record->id }}" enctype="multipart/form-data">
                            @csrf
                            <div class="product_type_id row">
                                <label for="product_type_id" class="col-md-4 col-form-label text-md-right">分類</label>
                                <div class="col-md-6">
                                        <select class="form-control" id="role" name="product_type_id">
                                            @foreach ($type as $item)
                                                            {{-- ↓ 重要 要抓到之前的id --}}
                                                <option @if( $item->id == $record->type->id) selected @endif value="{{ $item->id }}">{{ $item->type_name }}</option>
                                            @endforeach
                                        </select>
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

                            {{-- 圖片 --}}

                            <div class="form-group row">
                                <label for="pic" class="col-md-4 col-form-label text-md-right">封面圖片</label>
                                    <div class="col-md-3">
                                       <img class="w-100" src="{{ $record->pic }}" alt="">
                                    </div>
                            </div>

                            <div class="form-group row">
                                <label for="pic" class="col-md-4 col-form-label text-md-right">修改封面圖片</label>
                                <div class="col-md-6">
                                    <input class="py-3" type="file" id="pic" accept="image/gif, image/jpeg, image/png"
                                        name="pic">
                                </div>
                            </div>
                            
                            <hr>


                            <div class="form-group row">
                                <label for="photo" class="col-md-4 col-form-label text-md-right">其他圖片</label>
                                {{-- 上傳的部分 --}}
                                {{-- 用關聯拿 --}}
                                @foreach ($record->photo as $item)
                                    <div class="col-md-3">
                                        {{-- 點到圖片刪除按鈕時 將圖片 id 記下來 傳到後端 --}}
                                        {{--  後端根據該筆 id 找到並刪除 --}}
                                        <div data-id="{{ $item->id }}" class="del-img-btn">x</div>
                                       <img class="w-100" src="{{ $item->photo }}" alt="">
                                    </div>
                                @endforeach
                            </div>

                            {{-- 讓使用者在編輯資料時刪除關聯圖片 --}}
                            <div class="form-group row">
                                <label for="photo" class="col-md-4 col-form-label text-md-right">其他圖片</label>
                                <div class="col-md-6">
                                    <input class="py-3" type="file" id="photo" accept="image/gif, image/jpeg, image/png"
                                        name="photo[]" multiple>
                                    {{-- 陣列型式 ↑     ↑ 多圖上傳要有 --}}
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
    <script>
        let del = document.querySelectorAll('.del-img-btn')
        del.forEach(e =>{
            e.onclick = function (){
                let yes = confirm('確定刪除嗎?')
                if(yes){
                    // 拿到id
                    let id = e.getAttribute('data-id')
                    // let id = $(e).attr('data-id')
                    
                    // 發送非同步的資料到後端
                    let formdata = new FormData()
                    //.append('key', 'value')
                    formdata.append('id',id)
                    // 有幾筆資料就要用幾次 這個是csrf_token
                    formdata.append('_token','{{ csrf_token() }}')

                    let parent_element = e.parentElement

                    // fetch結構記一下很重要 
                    fetch('/admin/deleteImage', { // 走route
                        'method': 'post',
                        'body': formdata
                    }).then(function (response) { // 會街道所以後端傳來的資訊包刮header cookies
                        // 用字串方式讀出來
                        return response.text()
                        // 這邊的 result = succses 來自FileCollorer
                    }).then(function (result) { // 結果 這邊只有前端有被刪除而已後端也要砍
                        if (result == 'success') {
                            alert('刪除成功')
                            parent_element.remove()
                        }
                    })
                }
            }
        })

    </script>
@endsection















