@extends('layout.index')
@section('title', 'Bài viết')
@section('content')
    <div class="row">
        <div class="col-12 col-xl-12">

                <div class="card mb-5 mb-xl-10">
                    <div class="card-header card-header-stretch pb-0">
                        <!--begin::Title-->
                        <div class="card-title">
                            <h3 class="m-0">Bài Viết</h3>
                        </div>
                        <!--end::Title-->
                        <!--begin::Toolbar-->
                        <div class="card-toolbar m-0">
                            <!--begin::Tab nav-->
                            <ul class="nav nav-stretch nav-line-tabs border-transparent" role="tablist">
                                <!--begin::Tab item-->
                                <li class="nav-item" role="presentation">
                                    <a id="kt_billing_create_tab" class="nav-link fs-5 fw-bolder me-5 active"
                                       data-bs-toggle="tab" role="tab" href="#create" aria-selected="true">Danh sách</a>
                                </li>
                                <!--end::Tab item-->
                                <!--begin::Tab item-->
                                <li class="nav-item" role="presentation">
                                    <a id="kt_billing_history_tab" class="nav-link fs-5 fw-bolder" data-bs-toggle="tab"
                                       role="tab" href="#history" aria-selected="false">Tạo mới bài viết</a>
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
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9">
                                    <!--begin::Thead-->
                                    <thead class="border-gray-200 fs-5 fw-bold bg-lighten">
                                    <tr>
                                        <th class="min-w-250px">Bài viết</th>
                                        <th class="min-w-250px">Nội dung</th>
                                        <th class="min-w-150px">Action</th>
                                    </tr>
                                    </thead>
                                    <!--end::Thead-->
                                    <!--begin::Tbody-->
                                    <tbody class="fw-6 fw-bold text-gray-600">
                                    @foreach($data as $item)
                                        <tr>
                                            <td>
                                                <img src="{{asset('/storage/'.$item->image)}}" width="150" alt="">
                                            </td>
                                            <td>
                                                <span class="bold">
                                                    Ra mắt thử nghiệm các gói INSTAGRAM SV3 tùy chọn tốc độ với giá siêu rẻ nhất thị trường với phương châm ở đâu rẻ có chúng tôi rẻ hơn
                                                    - Instagram Sv3 Like bài viết: 9đ
                                                    - Instagram Sv3 Follow: 14đ
                                                        Khách hàng có thể tùy chọn tốc độ phù hợp với nhu cầu của mình . Các gói fb sẽ tương tự sẽ ra mắt sớm sau khi test ổn định
                                                </span>
                                            </td>
                                            <td>
                                                <a href="" class="btn btn-danger">Xóa</a>
                                                <a href="" class="btn btn-success">Sửa</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <!--end::Tbody-->
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--begin::Tab history-->
                        <div id="history" class="tab-pane fade" role="tabpanel">
                            <form method="post" action="{{ route("post.create") }}"  enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="d-flex flex-column mb-8 fv-row">
                                        <label class="fs-6 fw-bold mb-2">Nội dung bài viết</label>
                                        <textarea class="form-control form-control-solid" rows="4" name="content" placeholder="Vui lòng nhập nội dung cho bài viết"></textarea>
                                    </div>
                                    <!--end::Input group-->
                                    <!--begin::Input group-->
                                    <div class="fv-row mb-8">
                                        <label class="fs-6 fw-bold mb-2">Thêm hình ảnh</label>
                                        <!--begin::Dropzone-->
                                        <div class="dropzone" id="kt_modal_create_ticket_attachments">
                                            <!--begin::Message-->
                                            <div class="dz-message needsclick align-items-center">
                                                <!--begin::Icon-->
                                                <!--begin::Svg Icon | path: icons/duotune/files/fil010.svg-->
                                                <span class="svg-icon svg-icon-3hx svg-icon-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM16 12.6L12.7 9.3C12.3 8.9 11.7 8.9 11.3 9.3L8 12.6H11V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18V12.6H16Z" fill="black" />
                                                        <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                <!--end::Icon-->
                                                <!--begin::Info-->
                                                <div class="ms-4">
                                                    <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Chọn hình ảnh từ máy tính của bạn.</h3>
                                                    <input type="file" name="image">
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                        </div>
                                        <!--end::Dropzone-->
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-block mr-2 right"> Tạo Bài Viết</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
        </div>
    </div>
@endsection

