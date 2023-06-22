@extends('layouts.master')

@section('css')
<link rel="stylesheet" href="{{ asset('main/css/order-detail.css') }}">
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Đơn đặt hàng</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Đơn đặt hàng</li>
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
                    @can('orders review')
                    <div class="col-12">
                        <button data-href="{{ route('home.orders_review', $order->id) }}" data-id="{{ $order->id }}" title="Duyệt" type="button"
                            class="btn btn-success float-right mb-3" data-toggle="modal" data-modal-type="add"
                            data-target="#modalCenter" data-action="accept">
                            <i class="fas fa-check mr-1" style="color: #ffffff;"></i> Duyệt
                        </button>

                        <button data-href="{{ route('home.orders_review', $order->id) }}" data-id="{{ $order->id }}" title="Từ chối" type="button"
                            class="btn btn-danger float-right mb-3 mr-2" data-toggle="modal" data-modal-type="add"
                            data-target="#modalCenter" data-action="reject">
                            <i class="fas fa-times mr-1" style="color: #ffffff;"></i>  Từ chối
                        </button>
                    </div>
                    @endcan
                    <div class="col-12">
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="d-flex">
                                    <p>Mã đơn hàng:</p>
                                    <span>{{ $order->code }}</span>
                                </div>
                                <div class="d-flex">
                                    <p>Nhà cung cấp:</p>
                                    <span>{{ $order->supplier->name }}</span>
                                </div>
                                <div class="d-flex">
                                    <p>Ngày đặt hàng:</p>
                                    <span>{{ $order->formatted_order_date }}</span>
                                </div>
                                <div class="d-flex">
                                    <p>Ngày nhận hàng:</p>
                                    <span>{{ $order->formatted_delivery_date }}</span>
                                </div>
                                <div class="d-flex">
                                    <p>Địa chỉ nhận hàng:</p>
                                    <span>{{ $order->delivery_address }}</span>
                                </div>
                                <div class="d-flex">
                                    <p>Phương thức thanh toán:</p>
                                    <span>{{ $order->payment_method_text }}</span>
                                </div>
                                <div class="d-flex">
                                    <p>Người tạo:</p>
                                    <span>{{ $order->userCreated->name }}</span>
                                </div>
                                <div style="grid-column: 1 / span 3;">
                                    <div class="order_detail">
                                        <p>Danh sách chủng loại tài sản:</p>
                                        <table class="list_assets table table-bordered">
                                            <thead>
                                                <th>#</th>
                                                <th>Tên chủng loại</th>
                                                <th>Loại tài sản</th>
                                                <th>Đơn vị tính</th>
                                                <th>Đơn giá (VNĐ)</th>
                                                <th>Số lượng</th>
                                            </thead>
                                            <tbody>
                                                @if ($order->typeAssetsInOrder()->exists())
                                                    @foreach ($order->typeAssetsInOrder as $id => $typeAsset)
                                                        <tr>
                                                            <td>{{ $id + 1 }}</td>
                                                            <td>{{ $typeAsset->name }}</td>
                                                            <td>{{ $typeAsset->categoryAsset->name }}</td>
                                                            <td>{{ $typeAsset->unit }}</td>
                                                            <td>{{ $typeAsset->pivot->price }}</span></td>
                                                            <td>{{ $typeAsset->pivot->quantity }}</span></td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
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
    <x-modal-center :title="'Đơn đặt hàng'" :size="'size-sm'"></x-modal-center>
@endsection
@section('js')
    <script src="{{ asset('home/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('main/js/plugins/bootstrap-multiselect.min.js') }}"></script>
    <script src="{{ asset('main/js/request.js') }}"></script>

@endsection
