@extends('layouts.app')

@section('title', '最新消息管理')

@section('css')

@endsection

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ asset('/admin/home') }}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">最新消息管理</li>
            </ol>
          </nav>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2>最新消息管理</h2></div>
                    <div class="card-body">
                    <a href="{{ asset('/admin/news/create') }}" class="btn btn-success">新增</a>

                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>分類</th>
                                    <th>發布日</th>
                                    <th>標題</th>
                                    <th>圖片</th>
                                    <th>內文</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $item)
                                <tr>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->publish_date }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>
                                        <img src="{{ asset( $item->img ) }}" alt="" style="width: 300px;height: 200px;">
                                    </td>
                                    <td>{!! $item->content !!}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ asset('/admin/news/edit') }}/{{ $item->id }}">編輯</a>
                                        <form action="{{ asset('/admin/news/delete') }}/{{ $item->id }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </form>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <thead>
                                    <tr>
                                    <th>分類</th>
                                    <th>發布日</th>
                                    <th>標題</th>
                                    <th>圖片</th>
                                    <th>內文</th>
                                    </tr>
                                </thead>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>

@endsection
