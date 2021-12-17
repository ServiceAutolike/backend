@extends('layout.index')
@section('title', 'Buff Like')
@section('content')

    <div class="row">
        <div class="col-12 col-xl-12">
            <form id="form-create" method="post" action="{{ route("faceUser.postLike") }}"  novalidate="novalidate">
                @csrf
                <div class="card mb-5 mb-xl-10">
                    <div class="card-header card-header-stretch pb-0">
                        <!--begin::Title-->
                        <div class="card-title">
                            <h3 class="m-0">Buff Like Bài Viết</h3>
                        </div>
                        <!--end::Title-->
                        <!--begin::Toolbar-->
                        <div class="card-toolbar m-0">
                            <!--begin::Tab nav-->
                            <ul class="nav nav-stretch nav-line-tabs border-transparent" role="tablist">
                                <!--begin::Tab item-->
                                <li class="nav-item" role="presentation">
                                    <a id="kt_billing_create_tab" class="nav-link fs-5 fw-bolder me-5 active"
                                       data-bs-toggle="tab" role="tab" href="#create" aria-selected="true">Tạo Đơn
                                        Mới</a>
                                </li>
                                <!--end::Tab item-->
                                <!--begin::Tab item-->
                                <li class="nav-item" role="presentation">
                                    <a id="kt_billing_history_tab" class="nav-link fs-5 fw-bolder" data-bs-toggle="tab"
                                       role="tab" href="#history" aria-selected="false">Lịch Sử</a>
                                </li>
                                <!--end::Tab item-->
                            </ul>
                            <!--end::Tab nav-->
                        </div>
                        <!--end::Toolbar-->
                    </div>

                    <div id="kt_billing_payment_tab_content" class="tab-content">
                        <!--begin::Tab create-->
                        <div id="create" class="tab-pane fade active show" role="tabpanel">
                            <div class="card-body">
                                <input type="hidden" name="warranty" value="7" id="warranty"/>
                                <input type="hidden" value="post" id="type_check"/>
                                <div class="form-group">
                                    <label for="post_id">Nhập ID hoặc Link bài viết <span
                                            class="text-danger">*</span></label>
                                    <div class="" id="loadCheck">
                                        <input type="text" class="form-control form-control-solid" id="post_id"
                                               name="id" placeholder="Nhập URL hoặc ID bài viết" required>
                                    </div>
                                </div>
                                <div id="result" style="display: none;">
                                    <div class="d-flex align-items-center rounded p-5 mb-7 alert alert-success"
                                         id="classNoti">
                                        <!--begin::Icon-->
                                        <div class="svg-icon svg-icon-success me-5">
                                            <img src="" id="avatar_fb">
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <div class="flex-grow-1 me-2">
                                            <span class="fw-bolder text-gray-800 text-hover-primary fs-6"
                                                  id="name_fb"></span>
                                            <span class="text-muted fw-bold d-block" id="id_fb"></span>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="sever">Chọn SEVER <span class="text-danger">*</span></label>
                                    <div class="row g-9" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                                        <!--begin::Col-->
                                        <div class="col-md-6 col-lg-12 col-xxl-6">
                                            <label id="sv_like_check" class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6 active"
                                                data-kt-button="true">
                                                <!--begin::Radio button-->
                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                    <input class="form-check-input" type="radio" name="sv" value="sv_like" id="sv_like" checked="checked">
                                                </span>
                                                <!--end::Radio button-->
                                                <span class="ms-5">
                                                    <span class="fs-4 fw-bolder mb-1 d-block">Sever Like</span>
                                                    <span class="fw-bold fs-7 text-gray-600">Ở SEVER này chỉ cho phép duy nhất cảm xúc là LIKE (giá rẻ)</span>
                                                </span>
                                            </label>
                                        </div>
                                        <!--end::Col-->
                                        <!--begin::Col-->
                                        <div class="col-md-6 col-lg-12 col-xxl-6">
                                            <label id="sv_reaction_check"
                                                class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6"
                                                data-kt-button="true">
                                                <!--begin::Radio button-->
                                                <span class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                    <input class="form-check-input" type="radio" name="sv" id="sv_reaction" value="sv_reaction">
                                                </span>
                                                <!--end::Radio button-->
                                                <span class="ms-5">
                                                    <span class="fs-4 fw-bolder mb-1 d-block">Sever Cảm Xúc</span>
                                                    <span class="fw-bold fs-7 text-gray-600">Bạn có thể chọn các loại cảm xúc được thực hiện cho bài viết</span>
                                                </span>
                                            </label>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="number">Chọn cảm xúc <span class="text-danger">*</span></label>
                                    <div class="list-reaction mt-3">
                                        <div class="icon-buff like">
                                            <input type="checkbox" value="Like" name="reaction" class="" id="like"
                                                   checked>
                                            <div class="icon-reaction">
                                                <label for="like">
                                                    <img src="{{ url('Backend-Assets/media/icon/like.svg') }}"
                                                         alt="Like icon" width="40"/>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="icon-buff love d-none">
                                            <input type="checkbox" value="Love" name="reaction" class="" id="love">
                                            <div class="icon-reaction">
                                                <label for="love">
                                                    <img src="{{ url('Backend-Assets/media/icon/love.svg') }}"
                                                         alt="love icon" width="40"/>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="icon-buff care d-none">
                                            <input type="checkbox" value="Care" name="reaction" class="" id="care">
                                            <div class="icon-reaction">
                                                <label for="care">
                                                    <img src="{{ url('Backend-Assets/media/icon/care.svg') }}"
                                                         alt="care icon" width="40"/>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="icon-buff haha d-none">
                                            <input type="checkbox" value="Haha" name="reaction" class="" id="haha">
                                            <div class="icon-reaction">
                                                <label for="haha">
                                                    <img src="{{ url('Backend-Assets/media/icon/haha.svg') }}"
                                                         alt="haha icon" width="40"/>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="icon-buff wow d-none">
                                            <input type="checkbox" value="Wow" name="reaction" class="" id="wow">
                                            <div class="icon-reaction">
                                                <label for="wow">
                                                    <img src="{{ url('Backend-Assets/media/icon/wow.svg') }}"
                                                         alt="wow icon" width="40"/>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="icon-buff sad d-none">
                                            <input type="checkbox" value="Sad" name="reaction" class="" id="sad">
                                            <div class="icon-reaction">
                                                <label for="sad">
                                                    <img src="{{ url('Backend-Assets/media/icon/sad.svg') }}"
                                                         alt="sad icon" width="40"/>
                                                </label>
                                            </div>
                                        </div>

                                        <div class="icon-buff angry d-none">
                                            <input type="checkbox" value="Angry" name="reaction" class="" id="angry">
                                            <div class="icon-reaction">
                                                <label for="angry">
                                                    <img src="{{ url('Backend-Assets/media/icon/angry.svg') }}"
                                                         alt="angry icon" width="40"/>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                </div>


                                <div class="form-group">
                                    <label for="number_seeding">Số lượng cần tăng <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-solid" id="number_seeding"
                                           name="number" min="20" value="20" required>
                                </div>

                                <div class="form-group">
                                    <label for="sitePrice">Giá/1 tương tác (VNĐ) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-solid" id="sitePrice"
                                           name="sitePrice" value="50" disabled="disabled" required>
                                </div>

                                <div class="notice bg-light-warning rounded border-warning border border-dashed mt-3 p-5 text-center">
                                    <div class="fw-bold">
                                        <h2 class="fw-bolder font-weight-semibold">Tổng tiền: <span class="text-danger" id="total_price"></span></h2>
                                        <div>Bạn sẽ buff <span id="number" class="text-danger"></span> <span id="type" class="text-danger"></span> với giá <span class="text-danger" id="priceServices"></span>đ/1 <span class="text-danger" id="type2"></span> </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-block mr-2 right"> Tạo Tiến Trình</button>
                            </div>

                        </div>
                        <!--begin::Tab history-->
                        <div id="history" class="tab-pane fade" role="tabpanel">
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
                                        <th class="min-w-50px">Đã Chạy</th>
                                        <th class="min-w-50px">Đơn Giá</th>
                                        <th class="min-w-90px">Tổng Tiền</th>
                                        <th class="min-w-100px">Trạng Thái</th>
                                        <th class="min-w-100px">Công Cụ</th>

                                    </tr>
                                    </thead>
                                    <!--end::Thead-->
                                    <!--begin::Tbody-->
                                    <tbody class="fw-6 fw-bold text-gray-600">
                                    @foreach($historyServices as $historyServices)
                                        <tr>
                                            <td>{!!  $historyServices->created_at !!}</td>
                                            <td>{!!  $historyServices->transaction_code !!}</td>
                                            <td>{!!  $historyServices->url_services !!}</td>
                                            <td>{!!  $historyServices->reactions !!}</td>
                                            <td>{!!  $historyServices->number !!}</td>
                                            <td>{!!  $historyServices->number_success !!}</td>
                                            <td>{!!  $historyServices->price !!}</td>
                                            <td>{!!  $historyServices->total_price !!}</td>
                                            <td><span class="badge badge-warning rounded">Đang chạy: {!!  $historyServices->number_success !!}</span>
                                            </td>
                                            <td><button type="button" class="btn btn-sm btn-danger">Hủy Đơn</button> </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                    <!--end::Tbody-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table wrapper-->
                        </div>

                    </div>
                </div>
            </form>
        </div>

    </div>
@endsection
