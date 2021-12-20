@extends('layout.index')
@section('title', 'Trung Tâm hỗ trợ')
@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="card mb-5 mb-xxl-10">
                <div class="row p-7">
                    <div class="col-xl-4">
                        <!--begin::Statistics Widget 5-->
                        <a href="#" class="card bg-warning hoverable card-xl-stretch mb-xl-2">
                            <!--begin::Body-->
                            <div class="card-body d-flex justify-content-between">
                                <div>
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
                                </div>
                                <div>
                                    <div class="text-white fw-bolder fs-2 mb-2">{{$count_status1}}</div>
                                    <div class="fw-bold text-white">Hỗ trợ đang chờ</div>
                                </div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Statistics Widget 5-->
                    </div>
                    <div class="col-xl-4">
                        <!--begin::Statistics Widget 5-->
                        <a href="#" class="card bg-primary hoverable card-xl-stretch mb-xl-8">
                            <!--begin::Body-->
                            <div class="card-body d-flex justify-content-between">
                                <div><!--begin::Svg Icon | path: icons/duotune/general/gen008.svg-->
                                    <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M3 2H10C10.6 2 11 2.4 11 3V10C11 10.6 10.6 11 10 11H3C2.4 11 2 10.6 2 10V3C2 2.4 2.4 2 3 2Z" fill="black" />
                                        <path opacity="0.3" d="M14 2H21C21.6 2 22 2.4 22 3V10C22 10.6 21.6 11 21 11H14C13.4 11 13 10.6 13 10V3C13 2.4 13.4 2 14 2Z" fill="black" />
                                        <path opacity="0.3" d="M3 13H10C10.6 13 11 13.4 11 14V21C11 21.6 10.6 22 10 22H3C2.4 22 2 21.6 2 21V14C2 13.4 2.4 13 3 13Z" fill="black" />
                                        <path opacity="0.3" d="M14 13H21C21.6 13 22 13.4 22 14V21C22 21.6 21.6 22 21 22H14C13.4 22 13 21.6 13 21V14C13 13.4 13.4 13 14 13Z" fill="black" />
                                    </svg>
                                </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <div>
                                    <div class="text-white fw-bolder fs-2 mb-2">{{$count_status2}}</div>
                                    <div class="fw-bold text-white">Đang hỗ trợ</div>
                                </div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Statistics Widget 5-->
                    </div>
                    <div class="col-xl-4">
                        <!--begin::Statistics Widget 5-->
                        <a href="#" class="card bg-success hoverable card-xl-stretch mb-xl-2">
                            <!--begin::Body-->
                            <div class="card-body d-flex justify-content-between">
                                <div>
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
                                </div>
                                <div>
                                    <div class="text-gray-100 fw-bolder fs-2 mb-2">{{$count_status3}}</div>
                                    <div class="fw-bold text-gray-100">Đã hỗ trợ</div>
                                </div>
                            </div>
                            <!--end::Body-->
                        </a>
                        <!--end::Statistics Widget 5-->
                    </div>
                </div>
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Heading-->
                    <div class="card-title">
                        <h3>Hỗ trợ của bạn</h3>
                    </div>
                    <!--end::Heading-->

                    <!--begin::Toolbar-->
                    <div class="card-toolbar">

                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body p-0">
                    <div class="d-flex flex-column flex-xl-row p-7">
                        <!--begin::Content-->
                        <div class="flex-lg-row-fluid mb-20 mb-xl-0">
                            <!--begin::Tickets-->
                            <div class="mb-0">

                                <!--begin::Tickets List-->
                                <div class="mb-5">
                                    <!--begin::Ticket-->
                                    @foreach($data as $item)
                                        <div class="mb-5 form-control form-control-solid">
                                            <a href="/support_chat/{{$item->code_chat}}">
                                                <div class="d-flex justify-content-between">
                                            <!--begin::Content-->
                                                <div class="align-items-center mb-2">
                                                        <!--begin::Svg Icon | path: assets/media/icons/duotune/social/soc008.svg-->
                                                        @if($item->service == "Nạp tiền")
                                                            <span class="btn btn-icon btn-warning me-5">
                                                                <i class="las la-wallet fs-4"></i>
                                                            </span>
                                                        @elseif($item->service == "Tiktok")
                                                            <span class="btn btn-icon btn-light-facebook me-5 ">
                                                                <i class="fab fa-tiktok fs-4"></i>
                                                            </span>
                                                        @elseif($item->service == "Shoppe")
                                                            <span class="btn btn-icon btn-light-youtube me-5 ">
                                                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 109.59 122.88" xml:space="preserve" style="width: 15px;fill: #e55940;">
                                                                    <g><path class="st0" d="M74.98,91.98C76.15,82.36,69.96,76.22,53.6,71c-7.92-2.7-11.66-6.24-11.57-11.12 c0.33-5.4,5.36-9.34,12.04-9.47c4.63,0.09,9.77,1.22,14.76,4.56c0.59,0.37,1.01,0.32,1.35-0.2c0.46-0.74,1.61-2.53,2-3.17 c0.26-0.42,0.31-0.96-0.35-1.44c-0.95-0.7-3.6-2.13-5.03-2.72c-3.88-1.62-8.23-2.64-12.86-2.63c-9.77,0.04-17.47,6.22-18.12,14.47 c-0.42,5.95,2.53,10.79,8.86,14.47c1.34,0.78,8.6,3.67,11.49,4.57c9.08,2.83,13.8,7.9,12.69,13.81c-1.01,5.36-6.65,8.83-14.43,8.93 c-6.17-0.24-11.71-2.75-16.02-6.1c-0.11-0.08-0.65-0.5-0.72-0.56c-0.53-0.42-1.11-0.39-1.47,0.15c-0.26,0.4-1.92,2.8-2.34,3.43 c-0.39,0.55-0.18,0.86,0.23,1.2c1.8,1.5,4.18,3.14,5.81,3.97c4.47,2.28,9.32,3.53,14.48,3.72c3.32,0.22,7.5-0.49,10.63-1.81 C70.63,102.67,74.25,97.92,74.98,91.98L74.98,91.98z M54.79,7.18c-10.59,0-19.22,9.98-19.62,22.47h39.25 C74.01,17.16,65.38,7.18,54.79,7.18L54.79,7.18z M94.99,122.88l-0.41,0l-80.82-0.01h0c-5.5-0.21-9.54-4.66-10.09-10.19l-0.05-1 l-3.61-79.5v0C0,32.12,0,32.06,0,32c0-1.28,1.03-2.33,2.3-2.35l0,0h25.48C28.41,13.15,40.26,0,54.79,0s26.39,13.15,27.01,29.65 h25.4h0.04c1.3,0,2.35,1.05,2.35,2.35c0,0.04,0,0.08,0,0.12v0l-3.96,79.81l-0.04,0.68C105.12,118.21,100.59,122.73,94.99,122.88 L94.99,122.88z"/></g>
                                                                </svg>
                                                            </span>
                                                        @else
                                                            <span class="btn btn-icon btn-light-{{$item->class_icon_service}} me-5 ">
                                                                <i class="fab fa-{{$item->class_icon_service}} fs-4"></i>
                                                            </span>
                                                        @endif

                                                        <!--end::Svg Icon-->

                                                    <span>
                                                        <!--begin::Title-->
                                                        <span class="text-dark text-hover-primary fs-4 me-3 fw-bold">{{$item->subject}}</span>
                                                        <!--end::Title-->
                                                    </span>
                                                </div>
                                                <div>
                                                    <!--begin::Label-->
                                                    <span class="badge {{$item->class_service}} my-1">{{$item->service}}</span>
                                                    <span class="badge {{$item->class_status}} my-1">{{$item->status}}</span>
                                                    <!--end::Label-->
                                                    <br>
                                                    <!--begin::Svg Icon | path: assets/media/icons/duotune/communication/com003.svg-->
                                                    <span style="font-size: 12px">
                                                        <span class="svg-icon svg-icon-muted svg-icon-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path opacity="0.3" d="M2 4V16C2 16.6 2.4 17 3 17H13L16.6 20.6C17.1 21.1 18 20.8 18 20V17H21C21.6 17 22 16.6 22 16V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4Z" fill="red"/>
                                                                <path d="M18 9H6C5.4 9 5 8.6 5 8C5 7.4 5.4 7 6 7H18C18.6 7 19 7.4 19 8C19 8.6 18.6 9 18 9ZM16 12C16 11.4 15.6 11 15 11H6C5.4 11 5 11.4 5 12C5 12.6 5.4 13 6 13H15C15.6 13 16 12.6 16 12Z" fill="red"/>
                                                            </svg>
                                                        </span>
                                                        <span class="text-success">
                                                            {{$item->count_chat}}
                                                        </span>
                                                    </span>

                                                    <!--end::Svg Icon-->
                                                    <!--begin::Svg Icon | path: assets/media/icons/duotune/general/gen013.svg-->
                                                    <span style="margin-left: 20px; font-size: 12px; color: #a9a6a6;">
                                                        <span class="svg-icon svg-icon-muted svg-icon-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <path opacity="0.3" d="M20.9 12.9C20.3 12.9 19.9 12.5 19.9 11.9C19.9 11.3 20.3 10.9 20.9 10.9H21.8C21.3 6.2 17.6 2.4 12.9 2V2.9C12.9 3.5 12.5 3.9 11.9 3.9C11.3 3.9 10.9 3.5 10.9 2.9V2C6.19999 2.5 2.4 6.2 2 10.9H2.89999C3.49999 10.9 3.89999 11.3 3.89999 11.9C3.89999 12.5 3.49999 12.9 2.89999 12.9H2C2.5 17.6 6.19999 21.4 10.9 21.8V20.9C10.9 20.3 11.3 19.9 11.9 19.9C12.5 19.9 12.9 20.3 12.9 20.9V21.8C17.6 21.3 21.4 17.6 21.8 12.9H20.9Z" fill="black"/>
                                                                <path d="M16.9 10.9H13.6C13.4 10.6 13.2 10.4 12.9 10.2V5.90002C12.9 5.30002 12.5 4.90002 11.9 4.90002C11.3 4.90002 10.9 5.30002 10.9 5.90002V10.2C10.6 10.4 10.4 10.6 10.2 10.9H9.89999C9.29999 10.9 8.89999 11.3 8.89999 11.9C8.89999 12.5 9.29999 12.9 9.89999 12.9H10.2C10.4 13.2 10.6 13.4 10.9 13.6V13.9C10.9 14.5 11.3 14.9 11.9 14.9C12.5 14.9 12.9 14.5 12.9 13.9V13.6C13.2 13.4 13.4 13.2 13.6 12.9H16.9C17.5 12.9 17.9 12.5 17.9 11.9C17.9 11.3 17.5 10.9 16.9 10.9Z" fill="black"/>
                                                            </svg>
                                                        </span>
                                                        <span>
                                                            2 giờ trước
                                                        </span>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </div>
                                            </div>
                                            </a>
                                        </div>
                                    @endforeach
                                    <!--end::Ticket-->

                                </div>
                                <!--end::Tickets List-->
                                <!--begin::Pagination-->
{{--                                <ul class="pagination">--}}
{{--                                    <li class="page-item previous disabled">--}}
{{--                                        <a href="#" class="page-link">--}}
{{--                                            <i class="previous"></i>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                    <li class="page-item">--}}
{{--                                        <a href="#" class="page-link">1</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="page-item active">--}}
{{--                                        <a href="#" class="page-link">2</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="page-item">--}}
{{--                                        <a href="#" class="page-link">3</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="page-item">--}}
{{--                                        <a href="#" class="page-link">4</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="page-item">--}}
{{--                                        <a href="#" class="page-link">5</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="page-item">--}}
{{--                                        <a href="#" class="page-link">6</a>--}}
{{--                                    </li>--}}
{{--                                    <li class="page-item next">--}}
{{--                                        <a href="#" class="page-link">--}}
{{--                                            <i class="next"></i>--}}
{{--                                        </a>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
                                <!--end::Pagination-->
                            </div>
                            <!--end::Tickets-->
                        </div>
                        <!--end::Content-->

                    </div>
                </div>
                <!--end::Card body-->
            </div>

        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
@endsection
