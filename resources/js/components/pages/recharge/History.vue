<template>
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card mb-5 mb-xxl-10">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Heading-->
                    <div class="card-title">
                        <h3>Lịch Sử Nạp Tiền</h3>
                    </div>
                    <!--end::Heading-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <div class="my-1 me-4">
                            <input type="text" placeholder="Nhập ID nạp tiền" class="form-control form-control-solid">
                        </div>
                        <button class="btn btn-sm btn-primary my-1">Tìm Kiếm</button>
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <LoadingPage v-if="loading"></LoadingPage>
                <div v-else class="card-body p-0">
                    <!--begin::Table wrapper-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9">
                            <!--begin::Thead-->
                            <thead class="border-gray-200 fs-5 fw-bold bg-lighten">
                            <tr>
                                <th class="min-w-100px">Mã Giao Dịch</th>
                                <th class="min-w-100px">Số Tiền</th>
                                <th class="min-w-100px">Số Nhận Được</th>
                                <th class="min-w-100px">Phí (%)</th>
                                <th class="min-w-100px">Khuyến Mãi (%)</th>
                                <th class="min-w-150px">Cổng Nạp</th>
                                <th class="min-w-150px">Trạng Thái</th>
                                <th class="min-w-150px">Thời Gian</th>
                            </tr>
                            </thead>
                            <!--end::Thead-->
                            <!--begin::Tbody-->
                            <tbody class="fw-6 fw-bold text-gray-600">
                            <tr v-if="historyRecharge.length == '0'">
                                <td scope="row" class="text-center" colspan="9">Không có dữ liệu</td>
                            </tr>

                            <tr v-for="historyData in historyRecharge" >
                                <td>
                                    <span class="badge badge-light">{{ historyData.transaction_code }}</span>
                                </td>
                                <td>
                                    <span class="bold">{{ formatNumber(historyData.amount) }} VNĐ</span>
                                </td>
                                <td>
                                    <span class="bold text-success">+{{ formatNumber(historyData.amount_end) }} VNĐ</span>
                                </td>

                                <td>
                                    <span>{{ historyData.fee }} %</span>
                                </td>

                                <td>
                                    <span><b>+{{ formatNumber((historyData.amount_end*historyData.discount)/100) }} VND</b> <span class="badge badge-warning">{{ historyData.discount }}%</span></span>
                                </td>

                                <td v-if="historyData.type == 'vcb'">Ngân Hàng</td>
                                <td v-if="historyData.type == 'momo'">Ví Momo</td>
                                <td v-if="historyData.type == 'card'">Thẻ Điện Thoại</td>
                                <td><span class="badge badge-success">Thành công</span> </td>
                                <td>{{ timeAgo(historyData.created_at) }}</td>
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
                            <pagination  :pagination="pagination" :offset="5" @paginate="fechDataHistory()"></pagination>
                        </p>
                    </div>
                </div>
                <!--end::Card body-->
            </div>

        </div>
    </div>
</template>
<script>
export default {
    data() {
        return {
            historyRecharge: Object,
            loading: false,
            pagination: {
                'current_page': 1
            },
            pagination_payout: {
                'current_page': 1
            },

        }

    },
    mounted() {
        this.fechDataHistory()
    },

    methods: {
        formatNumber(num) {
            return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
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
        fechDataHistory() {
            let obj = this
            obj.loading = true
            axios.post('/recharge/history?page=' + obj.pagination.current_page).then(res => {
                obj.loading = false
                obj.historyRecharge = res.data.fetchDataHistory.data.data
                obj.pagination = res.data.fetchDataHistory.pagination;
            })
        }
    }
}
</script>
