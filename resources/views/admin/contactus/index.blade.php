@extends('layouts.app')

@section('title', '聯絡我們管理')

@section('css')

@endsection

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ asset('/admin/home') }}">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">聯絡我們管理</li>
            </ol>
          </nav>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2>聯絡我們管理</h2></div>
                    <div class="card-body">

                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>姓名</th>
                                    <th>Email</th>
                                    <th>主旨</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->title }}</td>
                                    <td>
                                        <img src="{{ asset( $item->img ) }}" alt="" style="width: 300px;height: 200px;">
                                    </td>
                                    <td>{{ $item->content }}</td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ asset('/admin/news/look') }}/{{ $item->id }}">查看</a>
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
                                        <th>姓名</th>
                                        <th>Email</th>
                                        <th>主旨</th>
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
