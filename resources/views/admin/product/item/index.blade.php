@extends('layouts.app')

@section('title', '產品種類管理')

@section('css')

@endsection

@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{ asset('/admin/home') }}">Home</a></li>
              <li class="breadcrumb-item"><a href="{{ asset('/admin/product/type') }}">產品種類管理</a></li>
              <li class="breadcrumb-item active" aria-current="page">產品品項管理</li>
            </ol>
          </nav>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h2>產品品項管理</h2></div>
                    <div class="card-body">
                    <a href="{{ asset('/admin/product/item/create') }}" class="btn btn-success">新增</a>

                        <table id="example" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Product Type</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Discrip</th>
                                    <th>Photo</th>
                                    <th>Operation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($list as $item)
                                <tr>
                                    <td>{{ $item->type->type_name }}</td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->product_price }}</td>
                                    <td>{{ $item->product_discript }}</td>
                                    <td>
                                        @foreach ($photo as $item)
                                            <img src="{{ asset( $item->photo??'' ) }}" alt="" style="width: 150px;height: 100px;">
                                        @endforeach
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-sm" href="{{ asset('/admin/product/item/edit') }}/{{ $item->id }}">編輯</a>
                                        <form action="{{ asset('/admin/product/item/delete') }}/{{ $item->id }}" method="POST">
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
                                        <th>Product Type</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Discrip</th>
                                        <th>Photo</th>
                                        <th>Operation</th>
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
