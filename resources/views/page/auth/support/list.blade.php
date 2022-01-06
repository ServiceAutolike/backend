@extends('layout.index')
@section('title', 'Danh sách hỗ trợ ')
@section('content')

    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card mb-5 mb-xxl-10">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Heading-->
                    <div class="card-title">
                        <h3>Danh sách</h3>
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
                                <th class="min-w-250px">Mã hỗ trợ</th>
                                <th class="min-w-100px">Tiêu đề</th>
                                <th class="min-w-150px">Loại hỗ trợ</th>
                                <th class="min-w-150px">Thời gian</th>
                                <th class="min-w-150px">Trạng thái</th>
                            </tr>
                            </thead>
                            <!--end::Thead-->
                            <!--begin::Tbody-->
                            <tbody class="fw-6 fw-bold text-gray-600">
                            @foreach($data as $item)
                                <tr>
                                    <td>
                                        <span><a href="/support_chat/{{$item->code_chat}}">#{{$item->code_chat}}</a></span>
                                    </td>
                                    <td>
                                        <span class="bold text-success">{{$item->subject}}</span>
                                    </td>
                                    <td>
                                        <span class="badge {{$item->class_service}}">{{$item->service}}</span>
                                    </td>
                                    <td>{{convertTime($item->created_at)}}</td>
                                    <td>
                                        <form action="{{route('support.update')}}" method="post">
                                            @csrf
                                            <input type="hidden" value="{{$item->id}}" name="id">
                                            <select class="form-select form-select-sm form-select-solid w-100px w-xxl-125px"
                                                    data-control="select2"
                                                    data-placeholder="Latest"
                                                    data-hide-search="true"
                                                    name="status"
                                                    onchange='if(this.value != 0) { this.form.submit(); }'
                                            >
                                                @foreach($status_service as $key => $status)
                                                    <option value="{{ $key }}" {{$item->status == $key ? 'selected' : '' }}>
                                                        {{ $status }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </form>
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
            </div>

        </div>
    </div>
@endsection
