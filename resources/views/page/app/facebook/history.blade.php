@extends('layout.index')
@section('title', 'Lịch Sử Order')
@section('content')

    <transition name="page" mode="out-in">
        <router-view></router-view>
    </transition>


    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header card-header-stretch pb-0">
                    <!--begin::Title-->
                    <ul class="nav nav-stretch nav-line-tabs border-transparent" >
                        <!--begin::Tab item-->
                        <li class="nav-item" role="presentation">
                            <a href="{{ route("faceUser.like") }}" class="nav-link fs-5 fw-bolder me-5">Tạo Tiến
                                Trình</a>
                        </li>
                        <!--end::Tab item-->
                        <!--begin::Tab item-->
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fs-5 fw-bolder active" href="?tab=history">Lịch sử Order</a>
                        </li>
                        <!--end::Tab item-->
                    </ul>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar m-0">
                        <div class="d-flex flex-wrap flex-stack">
                            <!--begin::Controls-->
                            <div class="d-flex my-2">
                                <!--begin::Search-->
                                <div class="d-flex align-items-center position-relative me-4">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span class="svg-icon svg-icon-3 position-absolute ms-3">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
													<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
												</svg>
											</span>
                                    <!--end::Svg Icon-->
                                    <input type="text" id="kt_filter_search" class="form-control form-control-sm w-150px ps-9" placeholder="Nhập ID bài viết" />
                                </div>
                                <!--end::Search-->
                                <a href="../../demo8/dist/apps/file-manager/files.html" class="btn btn-primary btn-sm">Tìm Kiếm</a>
                            </div>
                            <!--end::Controls-->
                        </div>
                    </div>
                    <!--end::Toolbar-->
                </div>

                <div class="tab-content">
                    <!--begin::Tab create-->
                    <div class="tab-pane active">
                        <div class="card p-0">
                            <div class="card-body p-0">
                                <!--begin::Table wrapper-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9">
                                        <!--begin::Thead-->
                                        <thead class="border-gray-200 fs-5 fw-bold bg-lighten">
                                        <tr>
                                            <th class="min-w-50px">Thời Gian</th>
                                            <th class="min-w-50px">Mã Giao Dịch</th>
                                            <th class="min-w-100px">ID Facebook</th>
                                            <th class="min-w-150px">Cảm Xúc</th>
                                            <th class="min-w-50px">Số Lượng</th>
                                            <th class="min-w-50px">Đơn Giá</th>
                                            <th class="min-w-90px">Tổng Tiền</th>
                                            <th class="min-w-100px">Trạng Thái</th>
                                            <th class="min-w-100px">Công Cụ</th>
                                        </tr>
                                        </thead>
                                        <!--end::Thead-->
                                        <!--begin::Tbody-->
                                        <tbody class="fw-6 fw-bold text-gray-600">
{{--                                        @if(count($historyServices) > 0)--}}
{{--                                            @foreach($historyServices as $history)--}}
{{--                                                <tr>--}}
{{--                                                    <td>{!!  $history->created_at !!}</td>--}}
{{--                                                    <td><span class="badge badge-light fs-8 fw-bold ms-2">{!!  $history->transaction_code !!}</span></td>--}}
{{--                                                    <td><a href="https://fb.com/{{ $history->url_services }}" target="_blank">{{ $history->url_services }}</a></td>--}}
{{--                                                    <td>--}}
{{--                                                        @php--}}
{{--                                                            $reactions = json_decode($history->reactions)--}}
{{--                                                        @endphp--}}
{{--                                                        @foreach($reactions as $item)--}}
{{--                                                            <img src="/Backend-Assets/media/icon/{{ $item }}.svg" alt="">--}}
{{--                                                        @endforeach--}}

{{--                                                    </td>--}}
{{--                                                    <td>{!!  $history->number !!}</td>--}}
{{--                                                    <td>{!!  $history->price !!}</td>--}}
{{--                                                    <td>{!!  $history->total_price !!}</td>--}}
{{--                                                    <td><span class="badge badge-light-warning">Đang chạy</span><span class="badge badge-light-success">{!!  $history->number_success !!}</span>--}}
{{--                                                    </td>--}}
{{--                                                    <td>--}}
{{--                                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">--}}
{{--                                                            Thao tác--}}
{{--                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->--}}
{{--                                                            <span class="svg-icon svg-icon-5 m-0">--}}
{{--                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
{{--                                                                    <path--}}
{{--                                                                        d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"--}}
{{--                                                                        fill="black"--}}
{{--                                                                    ></path>--}}
{{--                                                                </svg>--}}
{{--                                                            </span>--}}
{{--                                                            <!--end::Svg Icon-->--}}
{{--                                                        </a>--}}
{{--                                                        <!--begin::Menu-->--}}
{{--                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">--}}
{{--                                                            <!--begin::Menu item-->--}}
{{--                                                            <div class="menu-item px-3">--}}
{{--                                                                <a href="#" class="menu-link px-3">Hủy Đơn</a>--}}
{{--                                                            </div>--}}
{{--                                                            <!--end::Menu item-->--}}
{{--                                                            <!--begin::Menu item-->--}}
{{--                                                            <div class="menu-item px-3">--}}
{{--                                                                <a href="#" class="menu-link px-3" data-kt-customer-table-filter="delete_row">Bảo Hành</a>--}}
{{--                                                            </div>--}}
{{--                                                            <!--end::Menu item-->--}}
{{--                                                        </div>--}}
{{--                                                        <!--end::Menu-->--}}
{{--                                                    </td>--}}

{{--                                                </tr>--}}
{{--                                            @endforeach--}}
{{--                                            @else--}}
{{--                                                <tr>--}}
{{--                                                    <td>--}}
{{--                                                        <div class="text-center">--}}
{{--                                                            <small>- No data -</small>--}}
{{--                                                        </div>--}}
{{--                                                    </td>--}}
{{--                                                </tr>--}}
{{--                                            @endif--}}
{{--                                        </tbody>--}}
                                        <!--end::Tbody-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table wrapper-->
                            </div>

                            <div class="card-footer">
                                <div class="d-flex flex-stack flex-wrap right">
{{--                                    {{ $historyServices->links()}}--}}
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
