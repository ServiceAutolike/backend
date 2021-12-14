@extends('layout.index')
@section('title', 'Nạp Tiền Bằng Thẻ Điện Thoại')
@section('content')
    <div class="row">
        <div class="col-12 col-xl-8 mb-4">
            <div class="card shadow-sm">
                <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse"
                     data-bs-target="#kt_docs_card_collapsible">
                    <h3 class="card-title">Nạp Tiền Bằng Thẻ Cào Điện Thoại</h3>
                    <div class="card-toolbar rotate-180">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none">
                                <rect opacity="0.5" x="11" y="18" width="13" height="2" rx="1"
                                      transform="rotate(-90 11 18)" fill="black"></rect>
                                <path
                                    d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z"
                                    fill="black"></path>
                            </svg>
                        </span>
                    </div>
                </div>
                <div id="kt_docs_card_collapsible" class="collapse show">
                    <div class="card-body">
                        <form method="POST">
                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Loại thẻ</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <select name="currnecy" aria-label="-- Chọn nhà mạng ---" data-control="select2" data-placeholder="Chọn nhà mạng.." class="form-select form-select-solid form-select-lg">
                                        <option value="">Chọn nhà mạng..</option>
                                        <option data-kt-flag="flags/united-states.svg" value="USD">
                                            Viettel</option>
                                        <option data-kt-flag="flags/united-kingdom.svg" value="GBP">
                                            Vinaphone</option>
                                        <option data-kt-flag="flags/australia.svg" value="AUD">
                                            Mobifone</option>
                                        <option data-kt-flag="flags/japan.svg" value="JPY">
                                           Vietnammobile</option>

                                    </select>
                                </div>
                                <!--end::Col-->
                            </div>


                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Mệnh giá</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <select name="currnecy" aria-label="-- Chọn mệnh giá ---" data-control="select2" data-placeholder="Mệnh giá.." class="form-select form-select-solid form-select-lg">
                                        <option value="">Chọn mệnh giá thẻ cào.</option>
                                        <option value="10000">
                                            10,000đ</option>
                                        <option value="20000">
                                            20,000đ</option>
                                        <option value="50000">
                                            50,000đ</option>
                                        <option value="100000">
                                            100,000đ</option>
                                        <option value="200000">
                                            200,000đ</option>
                                        <option value="500000">
                                            500,000đ</option>
                                        <option value="1000000">
                                            1,000,000đ</option>

                                    </select>
                                </div>
                                <!--end::Col-->
                            </div>



                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Số seri</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="number" name="seri_card" class="form-control form-control-lg form-control-solid">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Col-->
                            </div>


                            <div class="row mb-6">
                                <!--begin::Label-->
                                <label class="col-lg-4 col-form-label required fw-bold fs-6">Số thẻ</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                    <input type="number" name="number_card" class="form-control form-control-lg form-control-solid">
                                    <div class="fv-plugins-message-container invalid-feedback"></div>
                                </div>
                                <!--end::Col-->
                            </div>

                        </form>

                        <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed p-6">
                            <!--begin::Icon-->
                            <!--begin::Svg Icon | path: icons/duotune/general/gen044.svg-->
                            <span class="svg-icon svg-icon-2tx svg-icon-warning me-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                     fill="none">
                                    <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                                    <rect x="11" y="14" width="7" height="2" rx="1" transform="rotate(-90 11 14)"
                                          fill="black"></rect>
                                    <rect x="11" y="17" width="2" height="2" rx="1" transform="rotate(-90 11 17)"
                                          fill="black"></rect>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <!--end::Icon-->
                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-grow-1">
                                <!--begin::Content-->
                                <div class="fw-bold">
                                    <h4 class="text-gray-900 fw-bolder">Lưu ý!</h4>
                                    <p class="fs-6 text-muted text-gray-700">Nạp bằng thẻ điện thoại phí nạp là 30%. (Ví dụ nạp thẻ 100,000 sẽ được 70,000 đ)
                                    </p>
                                    <p class="fs-6 text-muted text-gray-700">Gửi sai mệnh giá sẽ mất 100% thẻ, vì vậy hãy nhìn lại mệnh giá 1 lần nữa trước khi bấm NẠP TIỀN để tránh mất tiền
                                    </p>
                                    <p class="fs-6 text-muted text-gray-700">Nạp sai quá nhiều lần và có hành vi spam sẽ bị hủy thẻ. Vi phạm nhiều = Khóa tài khoản
                                    </p>
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->
                        </div>

                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary">Nạp Tiền</button>
                        <button class="btn btn-light btn-active-light-primary">Làm Mới</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4">
            <div class="card bg-success hoverable card-xl-stretch mb-5 mb-xl-8">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Svg Icon | path: icons/duotune/graphs/gra005.svg-->
                    <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M14 12V21H10V12C10 11.4 10.4 11 11 11H13C13.6 11 14 11.4 14 12ZM7 2H5C4.4 2 4 2.4 4 3V21H8V3C8 2.4 7.6 2 7 2Z" fill="black"></path>
                            <path d="M21 20H20V16C20 15.4 19.6 15 19 15H17C16.4 15 16 15.4 16 16V20H3C2.4 20 2 20.4 2 21C2 21.6 2.4 22 3 22H21C21.6 22 22 21.6 22 21C22 20.4 21.6 20 21 20Z" fill="black"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <div class="text-white fw-bolder fs-2 mb-2 mt-5">0 VNĐ</div>
                    <div class="fw-bold text-white">Số tiền hiện có</div>
                </div>
                <!--end::Body-->
            </div>


            <div class="card bg-danger hoverable card-xl-stretch mb-xl-8">
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg-->
                    <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="black"></path>
                            <path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="black"></path>
                            <path
                                opacity="0.3"
                                d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z"
                                fill="black"
                            ></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <div class="text-white fw-bolder fs-2 mb-2 mt-5">0 VNĐ</div>
                    <div class="fw-bold text-white">Số tiền đã nạp</div>
                </div>
                <!--end::Body-->
            </div>






            <div class="card mt-4">
                <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse"
                     data-bs-target="#history">
                    <h3 class="card-title">Lịch Sử Nạp Tiền</h3>
                    <div class="card-toolbar rotate-180">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none">
                                <rect opacity="0.5" x="11" y="18" width="13" height="2" rx="1"
                                      transform="rotate(-90 11 18)" fill="black"></rect>
                                <path
                                    d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z"
                                    fill="black"></path>
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                            <!--begin::Table head-->
                            <thead>
                            <tr class="fw-bolder text-muted">
                                <th>Thời gian</th>
                                <th>Số tiền</th>
                                <th>Trạng thái</th>
                            </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                            <tr>
                                <td>
                                    <span class="time text-muted">12/05/2021 12:00</span>
                                </td>
                                <td>
                                    <span class="fw-bold d-block fs-7">+12,000 VNĐ</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Thành công</span>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <span class="time text-muted">12/05/2021 12:00</span>
                                </td>
                                <td>
                                    <span class="fw-bold d-block fs-7">+12,000 VNĐ</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Thành công</span>
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <span class="time text-muted">12/05/2021 12:00</span>
                                </td>
                                <td>
                                    <span class="fw-bold d-block fs-7">+12,000 VNĐ</span>
                                </td>
                                <td>
                                    <span class="badge badge-success">Thành công</span>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <span class="time text-muted">12/05/2021 12:00</span>
                                </td>
                                <td>
                                    <span class="fw-bold d-block fs-7">200,000 VNĐ</span>
                                </td>
                                <td>
                                    <span class="badge badge-warning">Đang chờ...</span>
                                </td>
                            </tr>


                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>

            </div>
        </div>
    </div>
@endsection

