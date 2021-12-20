@extends('layout.index')
@section('title', 'Tạo hỗ trợ')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <div class="card mb-5 mb-xxl-10">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Heading-->
                        <div class="card-title">
                            <h3>Tạo mới một hỗ trợ</h3>
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
                            <div class="flex-lg-row-fluid me-xl-15 mb-20 mb-xl-0">
                                <!--begin::Tickets-->
                                <div class="mb-0">


                                    <!--begin::Tickets List-->
                                    <div class="mb-10">
                                        <!--begin::Ticket-->
                                        <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                                            <!--begin:Form-->
                                            <form id="kt_modal_new_ticket_form" class="form" action="{{route('support.create')}}" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="id_user" value="{{auth()->user()->id}}">
                                                <input type="hidden" name="code_user" value="{{auth()->user()->code}}">
                                                <!--begin::Input group-->
                                                <div class="d-flex flex-column mb-8 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                        <span class="required">Tiêu đề</span>
                                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a subject for your issue"></i>
                                                    </label>
                                                    <!--end::Label-->
                                                    <input type="text" class="form-control form-control-solid" placeholder="Vui lòng nhập tiêu đề của bạn" name="subject" />
                                                    <p class="text-danger p-2">Chú ý: <br>Tiêu đề ngắn gọn, nói vào nội dung chính ví dụ: Nạp tiền momo bị lỗi, chưa được cộng tiền momo, tăng like bị lỗi,.... Tránh những từ ngữ thô tục. Nếu vi phạm những điều này Admin có quyền khóa tài khoản của bạn!</p>
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="row g-9 mb-8">
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row">
                                                        <label class="required fs-6 fw-bold mb-2">Dịch vụ</label>
                                                        <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Chọn một dịch vụ" name="service">
                                                            <option value="">Chọn một dịch vụ...</option>
                                                            @foreach($select_service as $key => $value)
                                                                <option value="{{$key}}">{{$value}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row">
                                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                            <span >ID bài viết(nếu có)</span>
                                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a subject for your issue"></i>
                                                        </label>
                                                        <!--end::Label-->
                                                        <input type="text" class="form-control form-control-solid" placeholder="Nhập id bài viết" name="id_port" />
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="d-flex flex-column mb-8 fv-row">
                                                    <label class="fs-6 fw-bold mb-2 required">Mô tả</label>
                                                    <textarea class="form-control form-control-solid" rows="4" name="description" placeholder="Nhập mô tả chi tiết về vấn đề cần hỗ trợ"></textarea>
                                                    <p class="text-danger p-2">Nếu hỗ trợ là một lỗi của hệ thống bạn vui lòng miêu tả lại chi tiết các bước xảy ra lỗi .<br> Những điều này giúp cho admin giải quyết vấn đề cho bạn nhanh hơn!</p>
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="fv-row mb-8">
                                                    <label class="fs-6 fw-bold mb-2">Thêm hình ảnh mô tả</label>
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
                                                                <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Chọn một bức ảnh mà bạn chụp lại khi gặp lỗi</h3>
                                                                <input type="file" name="image">
                                                            </div>
                                                            <!--end::Info-->
                                                        </div>
                                                    </div>
                                                    <!--end::Dropzone-->
                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Actions-->
                                                <div class="text-center">
                                                    <button type="reset" id="kt_modal_new_ticket_cancel" class="btn btn-light me-3">Xóa</button>
                                                    <button type="submit" id="kt_modal_new_ticket_submit" class="btn btn-primary">
                                                        <span class="indicator-label">Gửi hỗ trợ</span>
                                                        <span class="indicator-progress">Please wait...
															<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                    </button>
                                                </div>
                                                <!--end::Actions-->
                                            </form>
                                            <!--end:Form-->
                                        </div>
                                    <!--end::Ticket-->

                                    </div>
                                    <!--end::Tickets List-->
                                </div>
                                <!--end::Tickets-->
                            </div>
                            <!--end::Content-->

                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--begin::Modal - Support Center - Create Ticket-->
                <div class="modal fade" id="kt_modal_new_ticket" tabindex="-1" aria-hidden="true">
                    <!--begin::Modal dialog-->
                    <div class="modal-dialog modal-dialog-centered mw-750px">
                        <!--begin::Modal content-->
                        <div class="modal-content rounded">
                            <!--begin::Modal header-->
                            <div class="modal-header pb-0 border-0 justify-content-end">
                                <!--begin::Close-->
                                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                    <span class="svg-icon svg-icon-1">
														<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
															<rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
															<rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
														</svg>
													</span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Close-->
                            </div>
                            <!--begin::Modal header-->
                            <!--begin::Modal body-->

                            <!--end::Modal body-->
                        </div>
                        <!--end::Modal content-->
                    </div>
                    <!--end::Modal dialog-->
                </div>
                <!--end::Modal - Support Center - Create Ticket-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
@endsection
