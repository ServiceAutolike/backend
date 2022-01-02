@extends('layout.index')
@section('title', 'Danh sách dịch vụ')
@section('content')

    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card mb-5 mb-xxl-10">
                <form action="{{route('service.admin.update')}}" method="post">
                    @csrf
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Heading-->
                        <div class="card-title">
                            <h3>Dịch vụ</h3>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Toolbar-->
                        <div class="card-toolbar">
                            <button class="btn btn-sm btn-primary my-1">Lưu thay đổi</button>
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
                                    <th class="min-w-250px">Dịch vụ</th>
                                    <th class="min-w-100px">Loại dịch vụ</th>
                                    <th class="min-w-50px">Giá</th>
                                </tr>
                                </thead>
                                <!--end::Thead-->
                                <!--begin::Tbody-->
                                <tbody class="fw-6 fw-bold text-gray-600">
                                    @foreach($data as $item)
                                        <tr>
                                            <td>
                                                <span>{{$item->services}}</span>
                                            </td>
                                            <td>
                                                <span class="badge {{$item->class_type_services}}">{{$item->type_services}}</span>
                                            </td>
                                            <td>
                                                <input width="50" type="number"
                                                       value="{{$item->price}}"
                                                       name="service[{{$item->id}}]"
                                                       class="form-control form-control-solid"
                                                >
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <!--end::Tbody-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table wrapper-->
                    </div>
                    <!--end::Card body-->
                </form>
            </div>

        </div>
    </div>
@endsection
