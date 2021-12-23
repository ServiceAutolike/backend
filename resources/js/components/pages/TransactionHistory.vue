<template>
    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header card-header-stretch pb-0">
                    <!--begin::Title-->
                    <ul class="nav nav-stretch nav-line-tabs border-transparent" >
                        <!--begin::Tab item-->
                        <li class="nav-item" role="presentation">
                            <a href="/facebook/buff-like" class="nav-link fs-5 fw-bolder me-5">Tạo Tiến
                            Trình</a>
                        </li>
                        <!--end::Tab item-->
                        <!--begin::Tab item-->
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fs-5 fw-bolder active" href="?tab=history">Lịch sử Order</a>
                        </li>
                        <!--end::Tab item-->
                    </ul>
                    <!--end::Title-->
                    <!--begin::Toolbar-->


                    <div class="card-toolbar m-0">
                        <div class="d-flex flex-wrap flex-stack">
                            <!--begin::Controls-->
                            <div class="d-flex my-2">
                                <!--begin::Search-->
                                <div class="mr-3"><small><i>Thời gian cập nhật: {{}}</i></small> <button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-2" v-on:click="updateTransaction"><i class="fas fa-sync" v-bind:class="{ 'fa-spin': spinActive }"></i></button></div>
                                <div class="d-flex align-items-center position-relative me-4">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span class="svg-icon svg-icon-3 position-absolute ms-3">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
													<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
												</svg>
											</span>

                                    <!--end::Svg Icon-->
                                    <input type="text" id="kt_filter_search" class="form-control form-control-sm w-150px ps-9" placeholder="Nhập ID bài viết" />
                                </div>
                                <!--end::Search-->
                                <a href="../../demo8/dist/apps/file-manager/files.html" class="btn btn-primary btn-sm">Tìm Kiếm</a>
                            </div>
                            <!--end::Controls-->
                        </div>
                    </div>
                    <!--end::Toolbar-->
                </div>

                <div class="tab-content">
                    <!--begin::Tab create-->
                    <div class="tab-pane active">
                        <div class="card p-0">
                            <LoadingPage v-if="loading"></LoadingPage>
                            <div v-else class="card-body p-0">
                                <!--begin::Table wrapper-->
                                <div class="table-responsive">
                                    <!--begin::Table-->
                                    <table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9">
                                        <!--begin::Thead-->
                                        <thead class="border-gray-200 fs-5 fw-bold bg-lighten">
                                        <tr>
                                            <th class="min-w-50px">Mã Giao Dịch</th>
                                            <th class="min-w-100px">ID Facebook</th>
                                            <th class="min-w-150px">Cảm Xúc</th>
                                            <th class="min-w-50px">Số Lượng</th>
                                            <th class="min-w-50px">Đơn Giá</th>
                                            <th class="min-w-90px">Tổng Tiền</th>
                                            <th class="min-w-100px">Trạng Thái</th>
                                            <th class="min-w-50px">Thời Gian</th>
                                            <th class="min-w-100px">Công Cụ</th>
                                        </tr>
                                        </thead>
                                        <!--end::Thead-->
                                        <!--begin::Tbody-->
                                        <tbody class="fw-6 fw-bold text-gray-600">
                                            <tr v-for="historyData in historyServices" :key="historyData.transaction_code">
                                                <td><span class="badge badge-light">{{ historyData.transaction_code }}</span></td>
                                                <td>{{ historyData.url_services }}</td>
                                                <td><img v-for="reactions in JSON.parse(historyData.reactions)" :src="'/Backend-Assets/media/icon/'+reactions+'.svg'" class="me-2"></td>
                                                <td>{{ historyData.number }}</td>
                                                <td>{{ historyData.price }}</td>
                                                <td>{{ historyData.total_price }}</td>
                                                <td>
                                                    <div v-if="historyData.status == 'Active'"><span class="badge badge-warning"><i class="fas fa-circle-notch fa-spin color-white"></i> Đang chạy...</span><span class="badge badge-light-success">{{ historyData.number_success }}/{{ historyData.number }}</span></div>
                                                    <span v-if="historyData.status == 'Success'" class="badge badge-success">Hoàn thành</span>
                                                    <span v-if="historyData.status == 'Report'" class="badge badge-danger">Lỗi (Checkpoint)</span>
                                                </td>
                                                <td>{{ timeAgo(historyData.created_at) }}</td>
                                                <td class="textend">
                                                    <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                                        <span class="svg-icon svg-icon-3">
																	<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
																		<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="black"></path>
																		<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="black"></path>
																		<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="black"></path>
																	</svg>
																</span>
                                                        <!--end::Svg Icon-->
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>

                                        <!--end::Tbody-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Table wrapper-->
                            </div>

                            <div class="card-footer">
                                <div class="d-flex flex-stack flex-wrap right">
                                    <p class="bg-transparent m-0" v-if="pagination.last_page > 1">
                                        <pagination  :pagination="pagination" :offset="5" @paginate="fetchData()"></pagination>
                                    </p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            historyServices: Object,
            type: this.$route.params.type,
            services: [],
            loading: false,
            spinActive: false,
            loading_t: false,
            pagination: {
                'current_page': 1
            },
            pagination_payout: {
                'current_page': 1
            },

        }

    },
    created () {
        this.updateTransaction()
    },
    mounted() {
        this.fetchData()
    },
    computed: {
    },
    watch: {
        $route: {
            immediate: true,
            handler(to, from) {
                if(this.$route.params.type == "like") {
                    document.title = 'Lịch Sử Buff Like';
                }
                else if(this.$route.params.type == "sub") {
                    document.title = 'Lịch Sử Buff Sub/Follow';
                }
                else {
                    document.title = 'Lịch Sử Order';
                }
            }
        },
    },
    methods : {
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
        updateTransaction() {
            let obj = this
            obj.loading = true
            obj.spinActive = true
            if (this.$route.params.type == "like") {
                axios.post('/updateTransaction/' + this.$route.params.type).then(res => {
                    obj.services = res.data
                    obj.loading = false
                    obj.spinActive = false
                })
            }
        },
        fetchData() {
            let obj = this
            obj.loading = true
            if (this.$route.params.type == "like") {
                axios.post('/updateTransaction/' + this.$route.params.type).then(res => {
                    obj.services = res.data
                })
                axios.post('/facebook/history/' + this.$route.params.type + '?page=' + obj.pagination.current_page).then(res => {
                    obj.loading = false
                    obj.historyServices = res.data.fetchDataTransactions.data.data
                    obj.pagination = res.data.fetchDataTransactions.pagination;
                })
            }
            else {
                console.log('Không tồn tại');
            }
        }
    }
}
</script>
