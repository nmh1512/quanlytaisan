@extends('layouts.master')

@section('css')
  <link rel="stylesheet" href="{{ asset('home/plugins/toastr/toastr.min.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Danh mục loại tài sản</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Danh mục loại tài sản</li>
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
                    <div class="col-12">
                        <button data-href="{{ route('category_assets_create') }}" title="Thêm" type="button" class="btn btn-primary float-right mb-3" data-toggle="modal" data-modal-type="add"
                            data-target="#modalCenter">
                            <i class="fas fa-plus" style="color: #ffffff;"></i></i> Thêm mới
                        </button>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div id="table-category-assets" class="card-body">
                                {!! $table !!}
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
    <x-modal-center></x-modal-center>
    
@endsection
@section('js')
<script src="{{ asset('home/plugins/toastr/toastr.min.js') }}"></script>
<script src="{{ asset('main/js/category_assets.js') }}"></script>
@endsection