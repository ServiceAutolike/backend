<template>
    <div class="row">
        <div class="col-12 col-xl-8 mb-4">
            <div class="card shadow-sm">
                <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse"
                     data-bs-target="#kt_docs_card_collapsible">
                    <h3 class="card-title">Nạp Tiền Qua Momo</h3>
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
                    <LoadingPage v-if="loading"></LoadingPage>
                    <div v-else class="card-body">
                        <div class="mb-10">
                            <p>Bạn vui lòng chuyển khoản chính xác nội dung chuyển khoản bên dưới hệ thống sẽ tự động cộng tiền cho bạn sau 1 - 5 phút sau khi nhận được tiền. Nếu sau 10 phút từ khi tiền trong tài khoản của bạn bị trừ mà vẫn chưa được cộng tiền vui lòng nhấn vào liên hệ hỗ trợ.</p>
                        </div>
                        <div class="form-group row mt-4 align-items-center">
                            <div class="img-bank col-sm-4">
                                <label class="col-form-label bold">Thông tin tài khoản</label>
                                <div><img src="/Backend-Assets/media/bank/momo.png" width="80"></div>
                            </div>
                            <div class="col-sm">
                                <div class="card bg-dark hoverable card-xl-stretch ">
                                    <div class="card-body text-gray-100">
                                        <div class="fw-bold text-gray-100 mb-1">Số Momo: <span class="badge badge-success">0971456287</span></div>
                                        <div class="fw-bold text-gray-100 mb-1">Tên tài khoản: <span class="bold">NGUYEN THI HAN</span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row align-items-center mb-3">
                            <div class="col-lg-4">
                                <label><i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title=""
                                          data-bs-original-title="Vui lòng nhập đúng nội dung chuyển khoản để được xử lý nhanh nhất"
                                          aria-label="Vui lòng nhập đúng nội dung chuyển khoản để được xử lý nhanh nhất"></i>
                                    Lời nhắn chuyển tiền <span class="text-danger">*</span></label>
                            </div>
                            <div class="col-lg-8">
                                <div class="d-flex">
                                    <input type="text" class="form-control form-control-solid me-3 flex-grow-1" v-model="desc" ref="desc" />
                                    <button class="btn btn-light-primary btn-active-primary fw-bolder flex-shrink-0" @click="copyURL">Copy</button>
                                </div>
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
                                    <div class="fs-6 text-gray-700">Nạp sai cú pháp vui lòng gửi Yêu cầu hỗ trợ hoặc
                                        liên hệ qua Zalo sau đó cung cấp hóa đơn chuyển tiền để được nạp thủ công.
                                    </div>
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Wrapper-->
                        </div>

                    </div>

                    <div class="card-footer">
                        <LoadingPage v-if="loading"></LoadingPage>
                        <div v-else>
                            <p><small><i><span class="text-danger">*</span> Bạn có thể xác nhận "<b class="text-danger">Tôi Đã Chuyển Tiền</b>" để hệ thống kiểm tra thủ công hoặc bạn có thể đợi 5-10 phút để hệ thống tự cập nhật số dư cho bạn.
                            </i></small></p>
                            <button class="btn btn-sm btn-primary" @click="scanRechargeMomo" :disabled="isDisabled"><i class="el-icon-check" v-if="isStatic"></i><i class="el-icon-loading" v-if="isClick"></i> {{ txtBtn }}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-4">
            <div class="card bg-success hoverable card-xl-stretch mb-5 mb-xl-8">
                <LoadingPage v-if="loading"></LoadingPage>
                <!--begin::Body-->
                <div v-else class="card-body">
                    <!--begin::Svg Icon | path: icons/duotune/graphs/gra005.svg-->
                    <span class="svg-icon svg-icon-white svg-icon-3x ms-n1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M14 12V21H10V12C10 11.4 10.4 11 11 11H13C13.6 11 14 11.4 14 12ZM7 2H5C4.4 2 4 2.4 4 3V21H8V3C8 2.4 7.6 2 7 2Z" fill="black"></path>
                            <path d="M21 20H20V16C20 15.4 19.6 15 19 15H17C16.4 15 16 15.4 16 16V20H3C2.4 20 2 20.4 2 21C2 21.6 2.4 22 3 22H21C21.6 22 22 21.6 22 21C22 20.4 21.6 20 21 20Z" fill="black"></path>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{ formatNumber(dataUser.point) }} VNĐ</div>
                    <div class="fw-bold text-white">Số tiền hiện có</div>
                </div>
                <!--end::Body-->
            </div>


            <div class="card bg-danger hoverable card-xl-stretch mb-xl-8">
                <LoadingPage v-if="loading"></LoadingPage>
                <!--begin::Body-->
                <div v-else class="card-body">
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
                    <div class="text-white fw-bolder fs-2 mb-2 mt-5">{{ formatNumber(total_recharge) }} VNĐ</div>
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
                    <LoadingPage v-if="loading"></LoadingPage>
                    <!--begin::Table container-->
                    <div v-else class="table-responsive">
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
                            <tr v-for="item in dataTransaction">
                                <td>
                                    <span class="time text-muted">{{ timeAgo(item.created_at) }}</span>
                                </td>
                                <td>
                                    <span class="fw-bold d-block fs-7">+{{ formatNumber(item.amount_end) }} VNĐ</span>
                                </td>
                                <td>
                                    <span class="badge badge-light-success" v-if="item.status == 'Updated'">Thành công</span>
                                    <span class="badge badge-light-success" v-if="item.status == 'New'">Thành công</span>

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
</template>

<script>
export default {
    data() {
        return {
            dataUser: Object,
            dataTransaction: Object,
            txtBtn: 'Tôi Đã Chuyển Tiền',
            desc: '',
            isDisabled: false,
            isStatic: true,
            isClick: false,
            fullscreenLoading: true,
            total_recharge: 0,
            total_recharge_month: 0,
            arr_success: Object,
            total_recharge_year: 0,
            loading: true
        }
    },
    created() {
        this.loadMe()
        this.loadTransaction()
    },
    methods: {
        formatNumber(number) {
            return Intl.NumberFormat().format(number);
        },
        timeAgo(dateString) {
            const date = new Date(dateString);
            const DAY_IN_MS = 86400000; // 24 * 60 * 60 * 1000
            const today = new Date();
            const seconds = Math.round((today - date) / 1000);

            if (seconds < 20) {
                return 'Vừa xong';
            }
            else if (seconds < 60) {
                return '1 phút trước';
            }

            const minutes = Math.round(seconds / 60);
            if (minutes < 60) {
                return `${minutes} phút trước`;
            }

            const isToday = today.toDateString() === date.toDateString();
            if (isToday) {
                return 'Hôm nay'
            }

            const yesterday = new Date(today - DAY_IN_MS);
            const isYesterday = yesterday.toDateString() === date.toDateString();
            if (isYesterday) {
                return 'Hôm qua'
            }

            const daysDiff = Math.round((today - date) / (1000 * 60 * 60 * 24));
            if (daysDiff < 30) {
                return `${daysDiff} ngày trước`;
            }

            const monthsDiff = today.getMonth() - date.getMonth() + (12 * (today.getFullYear() - date.getFullYear()));
            if (monthsDiff < 12) {
                return `${monthsDiff} tháng trước`;
            }

            const yearsDiff = today.getYear() - date.getYear();
            return `${yearsDiff} năm trước`;
        },
        loadTransaction() {
            axios.post('/recharge/transaction', {
                params: {
                    type: 'momo'
                }
            }).then(res => {
                this.loading = false
                this.dataTransaction = res.data
            })
        },
        updatedStatus() {
            axios.post('/recharge/scan/updated',
                {
                    params: {
                        type: 'momo'
                    }
                }
            ).then(res => {
                this.loading = false
                if(res.data.code) {
                    return true
                }
                else {
                    Swal.fire('Lỗi', 'Không thể cập nhật dữ liệu', 'error')
                    return false
                }
            })
        },
        async scanRechargeMomo() {
            toastr.success('Bắt đầu chạy tiến trình, vui lòng không thoát trang....')
            this.txtBtn = 'Đang kiểm tra...'
            this.isDisabled = true
            this.isStatic = false
            this.isClick = true
            while (true) {
                try {
                    let response = await axios.post('/recharge/scan/momo');
                    this.dataScan = response.data
                    if (response.data.code != 400) {
                        this.txtBtn = 'Tôi Đã Chuyển Tiền'
                        this.isDisabled = false
                        this.isStatic = true
                        this.isClick = false
                        this.loadMe()
                        this.updatedStatus()
                        Swal.fire('Thông Báo', 'Bạn đã nạp thành công '+this.formatNumber(response.data.total)+ ' VND qua cổng thanh toán Momo','success');
                        break

                    } else {
                        toastr.info('Đang tìm kiếm thông tin chuyển khoản MOMO của bạn....')
                        continue
                    }
                }
                catch (e) {
                    toastr.error('Đã có lỗi xảy ra, tiến trình đã dừng....')
                    this.isDisabled = false
                    this.isStatic = true
                    this.isClick = false
                    break
                }
            }
        },
        async copyURL(text) {
            text = this.desc
            try {
                this.$refs.desc.select();
                document.execCommand('copy');
                Swal.fire('Thông Báo','Đã sao chép thành công!','success')
            } catch($e) {
                Swal.fire('Thông Báo','Lỗi không thể sao chép!','error')
            }
        },
        loadMe() {
            axios.post('/me').then(res => {
                this.loading = false
                this.dataUser = res.data.data
                this.desc = "nap "+res.data.data.name
                this.total_recharge = res.data.total_recharge
                setTimeout(() => this.fullscreenLoading = false, 500);
            }).catch(e => {
                console.log("Error Get Me")
            })
        }
    }
}
</script>
