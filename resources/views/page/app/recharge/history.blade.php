@extends('layout.index')
@section('title', 'Lịch Sử Nạp Tiền')
@section('content')

<div class="row">
    <div class="col-md-12 col-12">
        <div class="card mb-5 mb-xxl-10">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Heading-->
                <div class="card-title">
                    <h3>Lịch Sử Nạp Tiền</h3>
                </div>
                <!--end::Heading-->
                <!--begin::Toolbar-->
                <div class="card-toolbar">
                    <div class="my-1 me-4">
                        <input type="text" placeholder="Nhập ID nạp tiền" class="form-control form-control-solid">
                    </div>
                    <button class="btn btn-sm btn-primary my-1">Tìm Kiếm</button>
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body p-0">
                <!--begin::Table wrapper-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9">
                        <!--begin::Thead-->
                        <thead class="border-gray-200 fs-5 fw-bold bg-lighten">
                        <tr>
                            <th class="min-w-250px">Mã giao dịch</th>
                            <th class="min-w-100px">Số tiền</th>
                            <th class="min-w-150px">Cổng nạp</th>
                            <th class="min-w-150px">Trạng thái</th>
                            <th class="min-w-150px">Thời gian</th>
                        </tr>
                        </thead>
                        <!--end::Thead-->
                        <!--begin::Tbody-->
                        <tbody class="fw-6 fw-bold text-gray-600">
                        <tr>
                            <td>
                                <span>#145DS</span>
                            </td>
                            <td>
                                <span class="bold text-success">12,000 VNĐ</span>
                            </td>
                            <td>Vietcombank</td>
                            <td><span class="badge badge-success">Thành công</span> </td>
                            <td>2 phút trước</td>
                        </tr>


                        <tr>
                            <td>
                                <span>#FFDFEW</span>
                            </td>
                            <td>
                                <span class="bold text-success">20,000 VNĐ</span>
                            </td>
                            <td>Thẻ Cào Viettel</td>
                            <td><span class="badge badge-danger">Huỷ</span> </td>
                            <td>7 phút trước</td>
                        </tr>



                        </tbody>
                        <!--end::Tbody-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table wrapper-->
            </div>
            <!--end::Card body-->
        </div>

    </div>
</div>
@endsection
