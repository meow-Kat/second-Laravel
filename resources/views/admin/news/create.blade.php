@extends('layouts.app')

@section('title', '新增最新消息')

@section('css')

@endsection

@section('content')

    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ asset('/admin/home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ asset('/admin/news') }}">最新消息管理</a></li>
                <li class="breadcrumb-item active" aria-current="page">新增最新消息</li>
            </ol>
        </nav>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>新增最新消息</h2>
                    </div>
                    <div class="card-body"> {{-- ↓ 圖片的路徑 ↓ --}}
                        <form method="POST" action="{{ asset('admin/news/store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-6">
                                    <img style="width: 450px; height: 300px;" id="preview_progressbarTW_img"
                                        src="https://dummyimage.com/600x400">
                                    <input class="py-3" type="file" onchange="readURL(this)"
                                        targetID="preview_progressbarTW_img" accept="image/gif, image/jpeg, image/png"
                                        name="img">
                                </div>
                                <div class="col-6">
                                    <label for="type">分類 Classify</label>
                                    <select class="form-control form-control-lg" id="type" name="type">
                                        {{-- 這邊94這樣 --}}
                                        @foreach ($type as $item)
                                            <option value="{{ $item }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    {{-- <label class="py-2" for="publish">發布時間</label> --}}
                                    {{-- 日期 type="date  可選年月日 可是就當日要日期可以不用輸入 --}}
                                    {{-- <input type="date" class="form-control" id="publish" name="publish" required> --}}
                                    <label class="py-2" for="title">標題</label>
                                    <input type="title" class="form-control" id="title" name="title" required>

                                    <div class="form-group pt-2">
                                        <label for="content">內容</label>
                                        <textarea class="form-control" id="content" rows="12" name="content"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">新增</button>
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
        function readURL(input) {
            if (input.files && input.files[0]) {
                let imageTagID = input.getAttribute("targetID")
                let reader = new FileReader()
                reader.onload = function(e) {
                    let img = document.getElementById(imageTagID)
                    img.setAttribute("src", e.target.result)
                }
                reader.readAsDataURL(input.files[0])
            }
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#content').summernote();
        });
    </script>
@endsection
