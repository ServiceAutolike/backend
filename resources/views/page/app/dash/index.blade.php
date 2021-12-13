@extends('layout.index')
@section('title', 'Dashboard')
@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Row-->
            <div class="row g-5 g-xl-8">
                <!--begin::Col-->
                <div class="col-xl-5">
                    <!--begin::Mixed Widget 2-->
                    <div class="card card-xl-stretch">
                        <!--begin::Header-->
                        <div class="card-header border-0 bg-danger py-5">
                            <h3 class="card-title fw-bolder text-white">Thống Kê</h3>
                            <div class="card-toolbar">
                                <!--begin::Menu-->
                                <button type="button" class="btn btn-sm btn-icon btn-color-white btn-active-white btn-active-color- border-0 me-n3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000" />
                                                <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                                <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                                <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3" />
                                            </g>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </button>
                                <!--begin::Menu 3-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">
                                    <!--begin::Heading-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Payments</div>
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Create Invoice</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link flex-stack px-3">
                                            Create Payment <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference"></i>
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Generate Bill</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-end">
                                        <a href="#" class="menu-link px-3">
                                            <span class="menu-title">Subscription</span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <!--begin::Menu sub-->
                                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">Plans</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">Billing</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">Statements</a>
                                            </div>
                                            <!--end::Menu item-->
                                            <!--begin::Menu separator-->
                                            <div class="separator my-2"></div>
                                            <!--end::Menu separator-->
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <div class="menu-content px-3">
                                                    <!--begin::Switch-->
                                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                                        <!--begin::Input-->
                                                        <input class="form-check-input w-30px h-20px" type="checkbox" value="1" checked="checked" name="notifications" />
                                                        <!--end::Input-->
                                                        <!--end::Label-->
                                                        <span class="form-check-label text-muted fs-6">Recuring</span>
                                                        <!--end::Label-->
                                                    </label>
                                                    <!--end::Switch-->
                                                </div>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu sub-->
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 my-1">
                                        <a href="#" class="menu-link px-3">Settings</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu 3-->
                                <!--end::Menu-->
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body p-0">
                            <!--begin::Chart-->
                            <div class="mixed-widget-2-chart card-rounded-bottom bg-danger" data-kt-color="danger" style="height: 200px;"></div>
                            <!--end::Chart-->
                            <!--begin::Stats-->
                            <div class="card-p mt-n20 position-relative">
                                <!--begin::Row-->
                                <div class="row g-0">
                                    <!--begin::Col-->
                                    <div class="col bg-light-warning px-6 py-8 rounded-2 me-7 mb-7">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen032.svg-->
                                        <span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect x="8" y="9" width="3" height="10" rx="1.5" fill="black" />
                                                <rect opacity="0.5" x="13" y="5" width="3" height="14" rx="1.5" fill="black" />
                                                <rect x="18" y="11" width="3" height="8" rx="1.5" fill="black" />
                                                <rect x="3" y="13" width="3" height="6" rx="1.5" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <span class="text-warning fw-bold fs-6">0 VNĐ</span>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col bg-light-primary px-6 py-8 rounded-2 mb-7">
                                        <!--begin::Svg Icon | path: icons/duotune/finance/fin006.svg-->
                                        <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path
                                                    opacity="0.3"
                                                    d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z"
                                                    fill="black"
                                                />
                                                <path
                                                    d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z"
                                                    fill="black"
                                                />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <a href="#" class="text-primary fw-bold fs-6">0 VNĐ</a>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                                <!--begin::Row-->
                                <div class="row g-0">
                                    <!--begin::Col-->
                                    <div class="col bg-light-danger px-6 py-8 rounded-2 me-7">
                                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs027.svg-->
                                        <span class="svg-icon svg-icon-3x svg-icon-danger d-block my-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path
                                                    opacity="0.3"
                                                    d="M21.25 18.525L13.05 21.825C12.35 22.125 11.65 22.125 10.95 21.825L2.75 18.525C1.75 18.125 1.75 16.725 2.75 16.325L4.04999 15.825L10.25 18.325C10.85 18.525 11.45 18.625 12.05 18.625C12.65 18.625 13.25 18.525 13.85 18.325L20.05 15.825L21.35 16.325C22.35 16.725 22.35 18.125 21.25 18.525ZM13.05 16.425L21.25 13.125C22.25 12.725 22.25 11.325 21.25 10.925L13.05 7.62502C12.35 7.32502 11.65 7.32502 10.95 7.62502L2.75 10.925C1.75 11.325 1.75 12.725 2.75 13.125L10.95 16.425C11.65 16.725 12.45 16.725 13.05 16.425Z"
                                                    fill="black"
                                                />
                                                <path
                                                    d="M11.05 11.025L2.84998 7.725C1.84998 7.325 1.84998 5.925 2.84998 5.525L11.05 2.225C11.75 1.925 12.45 1.925 13.15 2.225L21.35 5.525C22.35 5.925 22.35 7.325 21.35 7.725L13.05 11.025C12.45 11.325 11.65 11.325 11.05 11.025Z"
                                                    fill="black"
                                                />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <a href="#" class="text-danger fw-bold fs-6 mt-2">0 VNĐ</a>
                                    </div>
                                    <!--end::Col-->
                                    <!--begin::Col-->
                                    <div class="col bg-light-success px-6 py-8 rounded-2">
                                        <!--begin::Svg Icon | path: icons/duotune/communication/com010.svg-->
                                        <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M6 8.725C6 8.125 6.4 7.725 7 7.725H14L18 11.725V12.925L22 9.725L12.6 2.225C12.2 1.925 11.7 1.925 11.4 2.225L2 9.725L6 12.925V8.725Z" fill="black" />
                                                <path
                                                    opacity="0.3"
                                                    d="M22 9.72498V20.725C22 21.325 21.6 21.725 21 21.725H3C2.4 21.725 2 21.325 2 20.725V9.72498L11.4 17.225C11.8 17.525 12.3 17.525 12.6 17.225L22 9.72498ZM15 11.725H18L14 7.72498V10.725C14 11.325 14.4 11.725 15 11.725Z"
                                                    fill="black"
                                                />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <a href="#" class="text-success fw-bold fs-6 mt-2">0 VNĐ</a>
                                    </div>
                                    <!--end::Col-->
                                </div>
                                <!--end::Row-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Mixed Widget 2-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-7">
                    <div class="card">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <!--begin::Heading-->
                            <div class="card-title">
                                <h3>Login Sessions</h3>
                            </div>
                            <!--end::Heading-->
                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <div class="my-1 me-4">
                                    <!--begin::Select-->
                                    <select
                                        class="form-select form-select-sm form-select-solid w-125px select2-hidden-accessible"
                                        data-control="select2"
                                        data-placeholder="Select Hours"
                                        data-hide-search="true"
                                        data-select2-id="select2-data-10-1mqp"
                                        tabindex="-1"
                                        aria-hidden="true"
                                    >
                                        <option value="1" selected="selected" data-select2-id="select2-data-12-8zao">1 Hours</option>
                                        <option value="2">6 Hours</option>
                                        <option value="3">12 Hours</option>
                                        <option value="4">24 Hours</option>
                                    </select>
                                    <span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-11-a9zx" style="width: 100%;">
                                        <span class="selection">
                                            <span
                                                class="select2-selection select2-selection--single form-select form-select-sm form-select-solid w-125px"
                                                role="combobox"
                                                aria-haspopup="true"
                                                aria-expanded="false"
                                                tabindex="0"
                                                aria-disabled="false"
                                                aria-labelledby="select2-ycw9-container"
                                                aria-controls="select2-ycw9-container"
                                            >
                                                <span class="select2-selection__rendered" id="select2-ycw9-container" role="textbox" aria-readonly="true" title="1 Hours">1 Hours</span>
                                                <span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span>
                                            </span>
                                        </span>
                                        <span class="dropdown-wrapper" aria-hidden="true"></span>
                                    </span>
                                    <!--end::Select-->
                                </div>
                                <a href="#" class="btn btn-sm btn-primary my-1">View All</a>
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
                                            <th class="min-w-250px">Location</th>
                                            <th class="min-w-100px">Status</th>
                                            <th class="min-w-150px">Device</th>
                                            <th class="min-w-150px">IP Address</th>
                                            <th class="min-w-150px">Time</th>
                                        </tr>
                                    </thead>
                                    <!--end::Thead-->
                                    <!--begin::Tbody-->
                                    <tbody class="fw-6 fw-bold text-gray-600">
                                        <tr>
                                            <td>
                                                <a href="#" class="text-hover-primary text-gray-600">USA(5)</a>
                                            </td>
                                            <td>
                                                <span class="badge badge-light-success fs-7 fw-bolder">OK</span>
                                            </td>
                                            <td>Chrome - Windows</td>
                                            <td>236.125.56.78</td>
                                            <td>2 mins ago</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-hover-primary text-gray-600">United Kingdom(10)</a>
                                            </td>
                                            <td>
                                                <span class="badge badge-light-success fs-7 fw-bolder">OK</span>
                                            </td>
                                            <td>Safari - Mac OS</td>
                                            <td>236.125.56.78</td>
                                            <td>10 mins ago</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-hover-primary text-gray-600">Norway(-)</a>
                                            </td>
                                            <td>
                                                <span class="badge badge-light-danger fs-7 fw-bolder">ERR</span>
                                            </td>
                                            <td>Firefox - Windows</td>
                                            <td>236.125.56.10</td>
                                            <td>20 mins ago</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-hover-primary text-gray-600">Japan(112)</a>
                                            </td>
                                            <td>
                                                <span class="badge badge-light-success fs-7 fw-bolder">OK</span>
                                            </td>
                                            <td>iOS - iPhone Pro</td>
                                            <td>236.125.56.54</td>
                                            <td>30 mins ago</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <a href="#" class="text-hover-primary text-gray-600">Italy(5)</a>
                                            </td>
                                            <td>
                                                <span class="badge badge-light-warning fs-7 fw-bolder">WRN</span>
                                            </td>
                                            <td>Samsung Noted 5- Android</td>
                                            <td>236.100.56.50</td>
                                            <td>40 mins ago</td>
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
            <!--end::Row-->
        </div>
    </div>
</div>

@endsection
