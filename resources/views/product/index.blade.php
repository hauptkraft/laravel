@extends('layouts.app')

@section('title', 'Data product')

@section('contents')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data product</h6>
    </div>
    <div class="card-body">
        @if (auth()->user()->level == 'Admin')
        <a href="{{ route('product.add') }}" class="btn btn-primary mb-3">Add product</a>
        @endif

        <!-- <form class="d-none d-sm-inline-block form-inline mr-auto float-right ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form> -->

        <div class="container" style="margin-right: 0;">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <!-- <h3 class="text-center">Laravel Autocomplete Search Box</h3> -->
                    <hr>
                    <div class="form-group">
                        <h4>поиск по id имени категорииl!</h4>
                        <input type="text" name="search" id="search" placeholder="Enter search name" class="form-control" onfocus="this.value=''">
                    </div>
                    <div id="search_list"></div>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </div>
        <!-- ////////////////////////////////////////////////////////////////////////// -->

        <!-- ///////////////////////////////////////////////////////////////////// -->
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>№</th>
                        <th>code product</th>
                        <th>name product</th>
                        <th>Category</th>
                        <th>Price</th>
                        @if (auth()->user()->level == 'Admin')
                        <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @php($no = 1)
                    @foreach ($data as $row)
                    <tr>
                        <th>{{ $no++ }}</th>
                        <td>{{ $row->item_code }}</td>
                        <td>{{ $row->productname }}</td>
                        <td>{{ $row->category }}</td>
                        <td>{{ $row->price }}</td>
                        @if (auth()->user()->level == 'Admin')
                        <td>
                            <a href="{{ route('product.edit', $row->id) }}" class="btn btn-warning">Edit</a>
                            <a href="{{ route('product.delete', $row->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection