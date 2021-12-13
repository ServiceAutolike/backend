@extends('layout.index')
@section('title', 'Nạp Tiền Bằng Tài Khoản Ngân Hàng')
@section('content')
    <div class="row">
        <div class="col-8 col-xl-8">
            <div class="card shadow-sm">
                <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse"
                     data-bs-target="#kt_docs_card_collapsible">
                    <h3 class="card-title">Nạp Tiền Qua Ngân Hàng</h3>
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
                        <div class="mb-10">
                            <p>Bạn vui lòng chuyển khoản chính xác nội dung chuyển khoản bên dưới hệ thống sẽ tự động
                                cộng tiền cho bạn sau 1 - 5 phút sau khi nhận được tiền. Nếu chuyển khác ngân hàng sẽ
                                mất thời gian lâu hơn, tùy thời gian xử lý của mỗi ngân hàng.Nếu sau 10 phút từ khi tiền
                                trong tài khoản của bạn bị trừ mà vẫn chưa được cộng tiền vui lòng nhấn vào liên hệ hỗ
                                trợ.</p>
                        </div>
                        <div class="form-group row mt-4 align-items-center">
                            <div class="img-bank col-sm-4">
                                <label class="col-form-label bold">Thông tin tài khoản</label>
                                <img src="{{ url('Backend-Assets/media/bank/vcb.png') }}" width="100">
                            </div>
                            <div class="col-sm">
                                <div class="card bg-dark hoverable card-xl-stretch ">
                                    <div class="card-body text-gray-100">
                                        <div class="fw-bold text-gray-100 mb-1">Số tài khoản: <span
                                                class="badge badge-success">0491000168154</span></div>
                                        <div class="fw-bold text-gray-100 mb-1">Chủ tài khoản: <span class="bold">NGUYEN THI HAN</span>
                                        </div>
                                        <div class="fw-bold text-gray-100 mb-1">Chi nhánh: <span
                                                class="bold">Thăng Long</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center mb-3">
                            <div class="col-lg-4">
                                <label><i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title=""
                                          data-bs-original-title="Vui lòng nhập đúng nội dung chuyển khoản để được xử lý nhanh nhất"
                                          aria-label="Vui lòng nhập đúng nội dung chuyển khoản để được xử lý nhanh nhất"></i>
                                    Nội dung chuyển tiền <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-lg-8">
                                <form>
                                    <div class="form-row row">
                                        <div class="col-lg-10 col-sm-9 col-9">
                                            <input type="text" id="syntax" class="form-control form-control-lg"
                                                   value="naptien duyvn">
                                        </div>
                                        <div class="col-lg-2 col-sm-3 col-3">
                                            <button type="button" class="btn btn-primary copy"
                                                    data-clipboard-target="#syntax">Copy
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


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
                                    <div class="fs-6 text-gray-700">- Nạp sai cú pháp vui lòng gửi Yêu cầu hỗ trợ hoặc
                                        liên hệ qua Zalo sau đó cung cấp hóa đơn chuyển tiền để được nạp thủ công.
                                    </div>
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->
                        </div>

                    </div>

                    <div class="card-footer">
                        <p><small><i><span class="text-danger">*</span> Bạn có thể "Kiểm Tra Nạp Tiền" nếu thời gian chờ
                                    quá lâu, đây là cáh kiểm tra thủ công khi hệ thống nạp tiền bị gián đoạn.
                                </i></small></p>
                        <button class="btn btn-primary">Kiểm Tra Nạp Tiền</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4 col-xl-4">
            <div class="card">
                <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse"
                     data-bs-target="#kt_docs_card_collapsible">
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

