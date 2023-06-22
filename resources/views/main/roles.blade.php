@extends('layouts.master')

@section('css')
    <link rel="stylesheet" href="{{ asset('main/css/plugins/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('home/plugins/toastr/toastr.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Danh sách các chức vụ</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Danh sách các chức vụ</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    @can('roles create')
                    <div class="col-12">
                        <button data-href="{{ route('home.roles_create') }}" title="Thêm" type="button"
                            class="btn btn-primary float-right mb-3" data-toggle="modal" data-modal-type="add"
                            data-target="#modalCenter">
                            <i class="fas fa-plus" style="color: #ffffff;"></i></i> Thêm mới
                        </button>
                    </div>
                    @endcan
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="data-table" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tên chức vụ</th>
                                            <th>Ngày tạo</th>
                                            <th>Ngày cập nhật</th>
                                            <th>Thao tác</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- Form 1 -->
    <x-modal-center :title="'Chức vụ'" :size="'size-lg'"></x-modal-center>
@endsection
@section('js')
    <script src="{{ asset('main/js/plugins/select2.min.js') }}"></script>
    <script src="{{ asset('home/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('main/js/app.js') }}"></script>
    <script src="{{ asset('main/js/request.js') }}"></script>


    @if (session()->has('permissions_role'))
        <script>
            toastr.success(
                '{{session('permissions_role')['message']}}'
            );
        </script>
    @endif
@endsection
