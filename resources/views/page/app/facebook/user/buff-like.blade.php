@extends('layout.index')
@section('title', 'Buff Like')
@section('content')
    <div class="container-fluid px-0 mt-4">
        <div class="row">
            <div class="col-12 col-xl-7">
                <form action="" method="post">
                    @csrf
                <div class="card rounded-12 shadow-dark-80 border border-gray-200">
                    <div class="card-body p-0">
                        <div class="p-3 p-xl-4">
                            <div class="pt-2 px-md-3 px-xl-0 px-xxl-3">
                                <div class="col ps-0 ps-md-1">
                                    <input type="hidden" name="type" value="1">
                                    <div class="mb-3">
                                        <label for="post_id" class="form-label">Link hoặc ID bài viết:</label>
                                        <input type="text" class="form-control" id="post_id" name="id" placeholder="Nhập Link hoặc ID cần tăng">
                                    </div>
                                    <div class="mb-3">
                                        <label for="id_post" class="form-label">Chế độ bảo hành</label>
                                        <select class="form-select" aria-label="Default select example" name="warranty">
                                            <option selected value="1">Bảo hành 7 ngày</option>
                                            <option value="2">Bảo hành 30 ngày</option>
                                            <option value="3">Bảo hành 60 ngày</option>
                                            <option value="4">Bảo hành 90 ngày</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="number" class="form-label">Số lượng cần tăng</label>
                                        <input type="number" class="form-control" id="number" name="number" placeholder="0">
                                    </div>
                                    <div class="mb-3">
                                        <label for="number_like" class="form-label">Ghi chú</label>
                                        <div class="form-floating">
                                            <textarea class="form-control" name="note" placeholder="Leave a comment here" ></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card rounded-12 shadow-dark-80 border border-gray-200 bg-warning text-light mt-2">
                    <div class="card-body p-0">
                        <div class="p-3 p-xl-4 text-center">
                            Tổng tiền
                        </div>
                    </div>
                </div>
                <div class="card rounded-12 shadow-dark-80 border border-gray-200 mt-2">
                    <div class="card-body p-0">
                        <button class="py-3 text-center w-100 btn btn-dark">
                            Tạo tiến trình
                        </button>
                    </div>
                </div>
                </form>
            </div>
            <div class="col-12 col-xl-5">
                <div class="card rounded-12 shadow-dark-80 border border-gray-200 h-100 bg-warning">
                    <div class="card-body p-0">
                        <div class="p-3 p-xl-4">
                            <div class="pt-2 px-md-3 px-xl-0 px-xxl-3">
                                <div class="col ps-0 ps-md-1">
                                    <p>Chú ý:</p>
                                    <p>- Ngiêm cấm Buff các ID Seeding có nội dung vi phạm pháp luật, chính trị, đồ trụy... Nếu cố tình buff bạn sẽ bị trừ hết tiền và band khỏi hệ thống vĩnh viễn, và phải chịu hoàn toàn trách nhiệm trước pháp luật.</p>
                                    <p>
                                        - Hệ thống sử dụng 99% tài khoản người VN, fb thật để tương tác like, comment, share....
                                    </p>
                                    <p>
                                        - Thời gian làm việc (tăng seeding) và bảo hành tính từ ngày bắt đầu cho đến ngày kết thúc job, tối đa là 1 tuần
                                    </p>
                                    <p>
                                        - Hết thời gian của job đã order nếu không đủ số lượng hệ thống sẽ tự động hoàn lại số tiền seeding chưa tăng cho bạn trong vòng 1 đến 3 ngày
                                    </p>
                                    <p>
                                        - Vui lòng lấy đúng id bài viết, công khai và check kỹ job tránh tạo nhầm, tính năng đang trong giai đoạn thử nghiệm nên sẽ không hoàn tiền nếu bạn tạo nhầm
                                    </p>
                                    <p>
                                        - Chỉ nhận id bài viết công khai không nhập id album, id comment, id trang cá nhân, id page,...
                                    </p>
                                    <p>
                                        - Nhập id lỗi hoặc trong thời gian chạy die id thì hệ thống không hoàn lại tiền.
                                    </p>
                                    <p>
                                        - Mỗi id có thể Buff tối đa 10 lần trên hệ thống để tránh Spam, max 1k trong ngày (hoặc hơn nếu order giá cao), trên 1k thời gian lên chậm hơn trong vòng 7 ngày
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#post_id").on("change paste keyup", function() {
            $.ajax({
                type: "post",
                url: "http://autolike.wtf/find-id",
                data :{
                    'to': 'hhh',
                },
                contentType: "application/json",
                success: function(response){
                    $( "#result" ).empty().append( response );
                }
            });
        });
    </script>
@endsection
