@extends('layout.index')
@section('title', 'Trang Chủ')
@section('content')
    <div class="row g-5 g-xl-8">
        <!--begin::Col-->
        <div class="col-xl-7">
            <!--begin::Feeds Widget 2-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Body-->
                <div class="card-body pb-0">
                    <!--begin::Header-->
                    <div class="d-flex align-items-center mb-5">
                        <!--begin::User-->
                        <div class="d-flex align-items-center flex-grow-1">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-45px me-5">
                                <img src="{{ url('Backend-Assets/media/avatars/150-6.jpg') }}" alt="" />
                            </div>
                            <!--end::Avatar-->
                            <!--begin::Info-->
                            <div class="d-flex flex-column">
                                <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bolder">Quản Trị Viên</a>
                                <span class="text-gray-400 fw-bold">4 ngày trước</span>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::User-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Post-->
                    <div class="mb-5">
                        <!--begin::Text-->
                        <p class="text-gray-800 fw-normal mb-5">Ra mắt thử nghiệm các gói INSTAGRAM SV3 tùy chọn tốc độ với giá siêu rẻ nhất thị trường với phương châm ở đâu rẻ có chúng tôi rẻ hơn
                            <br>- Instagram Sv3 Like bài viết: 9đ
                            <br>- Instagram Sv3 Follow: 14đ
                            <br>Khách hàng có thể tùy chọn tốc độ phù hợp với nhu cầu của mình . Các gói fb sẽ tương tự sẽ ra mắt sớm sau khi test ổn định</p>
                        <!--end::Text-->
                        <!--begin::Toolbar-->
                        <div class="d-flex align-items-center mb-5">
                            <a href="#" class="btn btn-sm btn-light btn-color-muted btn-active-light-danger px-4 py-2">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen030.svg-->
                                <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M18.3721 4.65439C17.6415 4.23815 16.8052 4 15.9142 4C14.3444 4 12.9339 4.73924 12.003 5.89633C11.0657 4.73913 9.66 4 8.08626 4C7.19611 4 6.35789 4.23746 5.62804 4.65439C4.06148 5.54462 3 7.26056 3 9.24232C3 9.81001 3.08941 10.3491 3.25153 10.8593C4.12155 14.9013 9.69287 20 12.0034 20C14.2502 20 19.875 14.9013 20.7488 10.8593C20.9109 10.3491 21 9.81001 21 9.24232C21.0007 7.26056 19.9383 5.54462 18.3721 4.65439Z"
                                        fill="black"
                                    ></path>
                                </svg>
                            </span>
                                <!--end::Svg Icon-->
                            </a>
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Post-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Feeds Widget 2-->


            <!--begin::Feeds Widget 2-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Body-->
                <div class="card-body pb-0">
                    <!--begin::Header-->
                    <div class="d-flex align-items-center mb-5">
                        <!--begin::User-->
                        <div class="d-flex align-items-center flex-grow-1">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-45px me-5">
                                <img src="{{ url('Backend-Assets/media/avatars/150-6.jpg') }}" alt="" />
                            </div>
                            <!--end::Avatar-->
                            <!--begin::Info-->
                            <div class="d-flex flex-column">
                                <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bolder">Quản Trị Viên</a>
                                <span class="text-gray-400 fw-bold">4 ngày trước</span>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::User-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Post-->
                    <div class="mb-5">
                        <!--begin::Text-->
                        <p class="text-gray-800 fw-normal mb-5">Ra mắt thử nghiệm các gói INSTAGRAM SV3 tùy chọn tốc độ với giá siêu rẻ nhất thị trường với phương châm ở đâu rẻ có chúng tôi rẻ hơn
                            <br>- Instagram Sv3 Like bài viết: 9đ
                            <br>- Instagram Sv3 Follow: 14đ
                            <br>Khách hàng có thể tùy chọn tốc độ phù hợp với nhu cầu của mình . Các gói fb sẽ tương tự sẽ ra mắt sớm sau khi test ổn định</p>
                        <!--end::Text-->
                        <!--begin::Toolbar-->
                        <div class="d-flex align-items-center mb-5">
                            <a href="#" class="btn btn-sm btn-light btn-color-muted btn-active-light-danger px-4 py-2">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen030.svg-->
                                <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M18.3721 4.65439C17.6415 4.23815 16.8052 4 15.9142 4C14.3444 4 12.9339 4.73924 12.003 5.89633C11.0657 4.73913 9.66 4 8.08626 4C7.19611 4 6.35789 4.23746 5.62804 4.65439C4.06148 5.54462 3 7.26056 3 9.24232C3 9.81001 3.08941 10.3491 3.25153 10.8593C4.12155 14.9013 9.69287 20 12.0034 20C14.2502 20 19.875 14.9013 20.7488 10.8593C20.9109 10.3491 21 9.81001 21 9.24232C21.0007 7.26056 19.9383 5.54462 18.3721 4.65439Z"
                                        fill="black"
                                    ></path>
                                </svg>
                            </span>
                                <!--end::Svg Icon-->
                            </a>
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Post-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Feeds Widget 2-->


            <!--begin::Feeds Widget 2-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Body-->
                <div class="card-body pb-0">
                    <!--begin::Header-->
                    <div class="d-flex align-items-center mb-5">
                        <!--begin::User-->
                        <div class="d-flex align-items-center flex-grow-1">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-45px me-5">
                                <img src="{{ url('Backend-Assets/media/avatars/150-6.jpg') }}" alt="" />
                            </div>
                            <!--end::Avatar-->
                            <!--begin::Info-->
                            <div class="d-flex flex-column">
                                <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bolder">Quản Trị Viên</a>
                                <span class="text-gray-400 fw-bold">4 ngày trước</span>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::User-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Post-->
                    <div class="mb-5">
                        <!--begin::Text-->
                        <p class="text-gray-800 fw-normal mb-5">Ra mắt thử nghiệm các gói INSTAGRAM SV3 tùy chọn tốc độ với giá siêu rẻ nhất thị trường với phương châm ở đâu rẻ có chúng tôi rẻ hơn
                            <br>- Instagram Sv3 Like bài viết: 9đ
                            <br>- Instagram Sv3 Follow: 14đ
                            <br>Khách hàng có thể tùy chọn tốc độ phù hợp với nhu cầu của mình . Các gói fb sẽ tương tự sẽ ra mắt sớm sau khi test ổn định</p>
                        <!--end::Text-->
                        <!--begin::Toolbar-->
                        <div class="d-flex align-items-center mb-5">
                            <a href="#" class="btn btn-sm btn-light btn-color-muted btn-active-light-danger px-4 py-2">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen030.svg-->
                                <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M18.3721 4.65439C17.6415 4.23815 16.8052 4 15.9142 4C14.3444 4 12.9339 4.73924 12.003 5.89633C11.0657 4.73913 9.66 4 8.08626 4C7.19611 4 6.35789 4.23746 5.62804 4.65439C4.06148 5.54462 3 7.26056 3 9.24232C3 9.81001 3.08941 10.3491 3.25153 10.8593C4.12155 14.9013 9.69287 20 12.0034 20C14.2502 20 19.875 14.9013 20.7488 10.8593C20.9109 10.3491 21 9.81001 21 9.24232C21.0007 7.26056 19.9383 5.54462 18.3721 4.65439Z"
                                        fill="black"
                                    ></path>
                                </svg>
                            </span>
                                <!--end::Svg Icon-->
                            </a>
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Post-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Feeds Widget 2-->


            <!--begin::Feeds Widget 2-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Body-->
                <div class="card-body pb-0">
                    <!--begin::Header-->
                    <div class="d-flex align-items-center mb-5">
                        <!--begin::User-->
                        <div class="d-flex align-items-center flex-grow-1">
                            <!--begin::Avatar-->
                            <div class="symbol symbol-45px me-5">
                                <img src="{{ url('Backend-Assets/media/avatars/150-6.jpg') }}" alt="" />
                            </div>
                            <!--end::Avatar-->
                            <!--begin::Info-->
                            <div class="d-flex flex-column">
                                <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bolder">Quản Trị Viên</a>
                                <span class="text-gray-400 fw-bold">4 ngày trước</span>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::User-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Post-->
                    <div class="mb-5">
                        <!--begin::Text-->
                        <p class="text-gray-800 fw-normal mb-5">Ra mắt thử nghiệm các gói INSTAGRAM SV3 tùy chọn tốc độ với giá siêu rẻ nhất thị trường với phương châm ở đâu rẻ có chúng tôi rẻ hơn
                            <br>- Instagram Sv3 Like bài viết: 9đ
                            <br>- Instagram Sv3 Follow: 14đ
                            <br>Khách hàng có thể tùy chọn tốc độ phù hợp với nhu cầu của mình . Các gói fb sẽ tương tự sẽ ra mắt sớm sau khi test ổn định</p>
                        <!--end::Text-->
                        <!--begin::Toolbar-->
                        <div class="d-flex align-items-center mb-5">
                            <a href="#" class="btn btn-sm btn-light btn-color-muted btn-active-light-danger px-4 py-2">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen030.svg-->
                                <span class="svg-icon svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path
                                        d="M18.3721 4.65439C17.6415 4.23815 16.8052 4 15.9142 4C14.3444 4 12.9339 4.73924 12.003 5.89633C11.0657 4.73913 9.66 4 8.08626 4C7.19611 4 6.35789 4.23746 5.62804 4.65439C4.06148 5.54462 3 7.26056 3 9.24232C3 9.81001 3.08941 10.3491 3.25153 10.8593C4.12155 14.9013 9.69287 20 12.0034 20C14.2502 20 19.875 14.9013 20.7488 10.8593C20.9109 10.3491 21 9.81001 21 9.24232C21.0007 7.26056 19.9383 5.54462 18.3721 4.65439Z"
                                        fill="black"
                                    ></path>
                                </svg>
                            </span>
                                <!--end::Svg Icon-->
                            </a>
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <!--end::Post-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Feeds Widget 2-->

            <!--begin::Feeds widget 4, 5 load more-->
            <button class="btn btn-primary w-100 text-center" id="kt_widget_5_load_more_btn">
                <span class="indicator-label">Xem Thêm</span>
                <span class="indicator-progress">Đang tải... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
            <!--end::Feeds widget 4, 5 load more-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-5">
            <div class="row">
                <div class="col-xl-6">
                    <!--begin::Statistics Widget 5-->
                    <a href="#" class="card bg-body hoverable card-xl-stretch mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                            <span class="svg-icon svg-icon-primary svg-icon-3x ms-n1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black"></rect>
                        <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black"></rect>
                        <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black"></rect>
                        <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black"></rect>
                    </svg>
                </span>
                            <!--end::Svg Icon-->
                            <div class="text-gray-900 fw-bolder fs-2 mb-2 mt-5">0 VNĐ</div>
                            <div class="fw-bold text-gray-400">Số tiền hiện có</div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Statistics Widget 5-->
                </div>
                <div class="col-xl-6">
                    <!--begin::Statistics Widget 5-->
                    <a href="#" class="card bg-success hoverable card-xl-stretch mb-xl-2">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                            <span class="svg-icon svg-icon-gray-100 svg-icon-3x ms-n1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path
                            opacity="0.3"
                            d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z"
                            fill="black"
                        ></path>
                        <path
                            d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z"
                            fill="black"
                        ></path>
                        <path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="black"></path>
                    </svg>
                </span>
                            <!--end::Svg Icon-->
                            <div class="text-gray-100 fw-bolder fs-2 mb-2 mt-5">1.500.000 VNĐ</div>
                            <div class="fw-bold text-gray-100">Tổng tiền đã nạp</div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Statistics Widget 5-->
                </div>
                <div class="col-xl-6">
                    <!--begin::Statistics Widget 5-->
                    <a href="#" class="card bg-warning hoverable card-xl-stretch mb-xl-2">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                            <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path
                            opacity="0.3"
                            d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z"
                            fill="black"
                        ></path>
                        <path
                            d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z"
                            fill="black"
                        ></path>
                    </svg>
                </span>
                            <!--end::Svg Icon-->
                            <div class="text-white fw-bolder fs-2 mb-2 mt-5">0 VNĐ</div>
                            <div class="fw-bold text-white">Tổng nạp tháng này</div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Statistics Widget 5-->
                </div>
                <div class="col-xl-6">
                    <!--begin::Statistics Widget 5-->
                    <a href="#" class="card bg-danger hoverable card-xl-stretch mb-5 mb-xl-8">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Svg Icon | path: icons/duotune/graphs/gra007.svg-->
                            <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path
                            opacity="0.3"
                            d="M10.9607 12.9128H18.8607C19.4607 12.9128 19.9607 13.4128 19.8607 14.0128C19.2607 19.0128 14.4607 22.7128 9.26068 21.7128C5.66068 21.0128 2.86071 18.2128 2.16071 14.6128C1.16071 9.31284 4.96069 4.61281 9.86069 4.01281C10.4607 3.91281 10.9607 4.41281 10.9607 5.01281V12.9128Z"
                            fill="black"
                        ></path>
                        <path
                            d="M12.9607 10.9128V3.01281C12.9607 2.41281 13.4607 1.91281 14.0607 2.01281C16.0607 2.21281 17.8607 3.11284 19.2607 4.61284C20.6607 6.01284 21.5607 7.91285 21.8607 9.81285C21.9607 10.4129 21.4607 10.9128 20.8607 10.9128H12.9607Z"
                            fill="black"
                        ></path>
                    </svg>
                </span>
                            <!--end::Svg Icon-->
                            <div class="text-white fw-bolder fs-2 mb-2 mt-5">12,000 VNĐ</div>
                            <div class="fw-bold text-white">Số tiền đã tiêu</div>
                        </div>
                        <!--end::Body-->
                    </a>
                    <!--end::Statistics Widget 5-->
                </div>
            </div>


            <div class="card bgi-no-repeat mb-xl-8" style="height: 300px; background-position: right top; background-size: 30% auto; background-image: url('/Backend-Assets/media/svg/shapes//abstract-2.svg')">
                <!--begin::Body-->
                <div class="card-header">
                    <div class="card-title">Thông Báo</div>
                </div>
                <div class="card-body overflow-scroll">
                    <div class="postNoti">
                        <div class="fw-bolder text-primary">03 May 2020</div>
                        <p class="text-gray-800 fw-normal mb-5">Bạn vừa nạp 50,000 VNĐ qua cổng thanh toán Vietcombank</p>
                    </div>

                    <div class="postNoti">
                        <div class="fw-bolder text-primary">03 Jul 2021</div>
                        <p class="text-gray-800 fw-normal mb-5">Bạn vừa tạo dịch vụ Tăng Like Bài Viết với giá 12,000 VNĐ</p>
                    </div>


                </div>
                <!--end::Body-->
            </div>


            <!--- begin Chart -->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Thống Kê</span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Chart-->
                    <div id="kt_charts_widget_2_chart" style="height: 300px"></div>
                    <!--end::Chart-->
                </div>
                <!--end::Body-->
            </div>

            <!--- //end Charts --->

        </div>
        <!--end::Col-->
    </div>

@endsection
