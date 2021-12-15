@extends('layout.index')
@section('title', 'Buff Like')
@section('content')

    <div class="row">
        <div class="col-12 col-xl-7">
            <form action="{{ route("faceUser.postLike") }}" method="post">
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
                                <input type="hidden" name="type" value="1"/>
                                <div class="form-group">
                                    <label for="post_id">Nhập ID hoặc Link bài viết <span class="text-danger">*</span></label>
                                    <div class="" id="loadCheck">
                                        <input type="text" class="form-control form-control-solid" id="post_id" name="id" placeholder="Nhập URL hoặc ID bài viết"/>
                                    </div>
                                </div>
                                <div id="result" style="display: none;">
                                    <div class="d-flex align-items-center bg-light-success rounded p-5 mb-7">
                                        <!--begin::Icon-->
                                        <div class="svg-icon svg-icon-success me-5">
                                            <img src="" id="avatar_fb">
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <div class="flex-grow-1 me-2">
                                            <span class="fw-bolder text-gray-800 text-hover-primary fs-6" id="name_fb"></span>
                                            <span class="text-muted fw-bold d-block" id="id_fb"></span>
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="number">Số lượng cần tăng <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-solid" id="number" name="number"
                                           placeholder="0"/>
                                </div>

                                <div class="form-group">
                                    <label for="id_post">Chế độ bảo hành</label>
                                    <!--begin::Input-->
                                    <select class="form-select form-select-solid" data-control="select2" data-placeholder="Select an option" name="warranty">
                                        <option></option>
                                        <option selected value="1">Bảo hành 7 ngày</option>
                                        <option value="2">Bảo hành 30 ngày</option>
                                        <option value="3">Bảo hành 60 ngày</option>
                                        <option value="4">Bảo hành 90 ngày</option>
                                    </select>
                                    <!--end::Input-->
                                </div>


                                <div class="notice bg-light-warning rounded border-warning border border-dashed mt-3 p-6 text-center">
                                    <div class="fw-bold">
                                        <div class="fs-6 text-gray-500">Tổng Tiền Cần Thanh Toán</div>
                                        <h4 class="fw-bolder text-danger font-weight-semibold">12,000 VNĐ</h4>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-2"> Tạo Tiến Trình</button>
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                            </div>

                        </div>
                        <!--begin::Tab history-->
                        <div id="history" class="tab-pane fade" role="tabpanel">
                            ádasd
                        </div>

                    </div>
                </div>
            </form>
        </div>
        <div class="col-12 col-xl-5">
            <div class="card rounded-12 shadow-dark-80 border border-gray-200 bg-warning">
                <div class="card-header">
                    <div class="card-title">Lưu ý</div>
                </div>
                <div class="card-body p-0">
                    <div class="p-3 p-xl-4">
                        <div class="pt-2 px-md-3 px-xl-0 px-xxl-3">
                            <div class="col ps-0 ps-md-1">
                                <p>
                                    - Ngiêm cấm Buff các ID Seeding có nội dung vi phạm pháp luật, chính trị, đồ trụy...
                                    Nếu cố tình buff bạn sẽ bị trừ hết tiền và band khỏi hệ thống vĩnh viễn, và phải
                                    chịu hoàn toàn trách nhiệm trước pháp
                                    luật.
                                </p>
                                <p>
                                    - Hệ thống sử dụng 99% tài khoản người VN, fb thật để tương tác like, comment,
                                    share....
                                </p>
                                <p>
                                    - Thời gian làm việc (tăng seeding) và bảo hành tính từ ngày bắt đầu cho đến ngày
                                    kết thúc job, tối đa là 1 tuần
                                </p>
                                <p>
                                    - Hết thời gian của job đã order nếu không đủ số lượng hệ thống sẽ tự động hoàn lại
                                    số tiền seeding chưa tăng cho bạn trong vòng 1 đến 3 ngày
                                </p>
                                <p>
                                    - Vui lòng lấy đúng id bài viết, công khai và check kỹ job tránh tạo nhầm, tính năng
                                    đang trong giai đoạn thử nghiệm nên sẽ không hoàn tiền nếu bạn tạo nhầm
                                </p>
                                <p>
                                    - Chỉ nhận id bài viết công khai không nhập id album, id comment, id trang cá nhân,
                                    id page,...
                                </p>
                                <p>
                                    - Nhập id lỗi hoặc trong thời gian chạy die id thì hệ thống không hoàn lại tiền.
                                </p>
                                <p>
                                    - Mỗi id có thể Buff tối đa 10 lần trên hệ thống để tránh Spam, max 1k trong ngày
                                    (hoặc hơn nếu order giá cao), trên 1k thời gian lên chậm hơn trong vòng 7 ngày
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toastr-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        $("#post_id").on("change key", function () {
            $('#loadCheck').addClass('spinner spinner-success spinner-right');
            var bodyData = {
                "url": $('#post_id').val(),
            }
            $.ajax({
                url: '/api/find-id',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify( bodyData ),
                success: function(response){
                    toastr.success("Lấy ID Facebook thành công!");
                    const result = JSON.parse(JSON.stringify(response))
                    $('#loadCheck').removeClass('spinner spinner-success spinner-right');
                    $('#result').show();
                    $('#avatar_fb').attr("src", 'http://graph.facebook.com/'+result.id+'/picture?type=square');
                    $('#name_fb').text(result.name);
                    $('#id_fb').text(result.id);
                },
                error: function(){
                    $('#loadCheck').removeClass('spinner spinner-success spinner-right');
                    toastr.error("URL lỗi hoặc ID không tồn tại, vui lòng kiểm tra lại!");
                    $('#result').hide();
                }
            });
        });
    </script>
@endsection
