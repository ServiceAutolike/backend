<template>
    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header card-header-stretch pb-0">
                    <!--begin::Title-->
                    <ul class="nav nav-stretch nav-line-tabs border-transparent">
                        <!--begin::Tab item-->
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fs-5 fw-bolder me-5" @click.prevent="setActive('create')" :class="{ active: isActive('create') }" href="#create">Tạo Tiến Trình</a>
                        </li>
                        <!--end::Tab item-->
                        <!--begin::Tab item-->
                        <li class="nav-item" role="presentation">
                            <a data-toggle="tab" class="nav-link fs-5 fw-bolder" @click.prevent="setActive('history')" :class="{ active: isActive('history') }" href="#history">Lịch Sử Order</a>
                        </li>
                        <!--end::Tab item-->
                    </ul>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar m-0" v-if="isTable">
                        <div class="d-flex flex-wrap flex-stack">
                            <!--begin::Controls-->
                            <div class="d-flex my-2">
                                <!--begin::Search-->
                                <div class="mr-3"><button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-2" v-on:click="updateTransaction" data-bs-toggle="tooltip" title="" data-bs-original-title="Cập nhật dữ liệu lịch sử"><i class="fas fa-sync" v-bind:class="{ 'fa-spin': spinActive }"></i></button></div>
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
                                <a href="/" class="btn btn-primary btn-sm">Tìm Kiếm</a>
                            </div>
                            <!--end::Controls-->
                        </div>
                    </div>
                    <!--end::Toolbar-->
                </div>

                <div id="tab_content" class="tab-content">
                    <!--begin::Tab create-->
                    <div class="tab-pane fade" :class="{ 'active show': isActive('create') }" id="create">
                        <div class="card-body">
                            <form method="POST">
                                <input type="hidden" name="warranty" value="7" id="warranty"/>
                                <input type="hidden" value="post" id="type_check"/>
                                <div class="form-group">
                                    <label for="user_id">Nhập ID hoặc URL trang cá nhân <span
                                        class="text-danger">*</span></label>
                                    <div v-bind:class="{'spinner spinner-success spinner-right': loading_input}">
                                        <input type="text" v-bind:class="[activeClass, errorClass]" class="form-control"
                                               id="user_id" v-model="user_id" placeholder="Nhập URL hoặc ID bài viết"
                                               @change="findID(user_id)" required>
                                    </div>
                                </div>
                                <div role="alert" class="alert alert-custom fade show mt-4 bg-green-3">
                                    <div v-if="isResult">
                                        <div class="cl-green mb-0">
                                            <i>Kết quả tìm kiếm:</i><br>
                                            ID của bạn là: <b class="text-danger">{{ idFB }}</b><br>
                                            Tên Facebook: <b class="text-danger">{{ name }}</b>
                                        </div>

                                    </div>
                                    <div v-else class="cl-green mb-0">
                                        Get ID Facebook từ Link nhanh <a href="https://fb-search.com/find-my-facebook-id" target="_blank" class="font-bold cl-green">tại đây</a><br />
                                        Vui lòng công khai Theo dõi để Buff theo hướng dẫn dưới đây trước khi Order <a href="http://www.dungqb.com/2019/07/huong-dan-cong-khai-cac-thong-tin.html" target="_blank" class="font-bold cl-green">Click Tại Đây Để Xem Hướng Dẫn</a>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="number_seeding">Số lượng cần tăng <span
                                        class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-solid" id="number_seeding"
                                           name="number" min="20" value="20" v-model="number_seeding"
                                           @keyup="changeTotal()">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sitePrice">Giá/1 lượt theo dõi (VNĐ) <span
                                                class="text-danger">*</span></label>
                                            <input type="number" class="form-control form-control-solid" id="sitePrice"
                                                   name="sitePrice" value="80" v-model="sitePrice" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sitePrice">Chọn tốc độ <span
                                                class="text-danger">*</span></label>
                                            <select class="form-select form-select-sm bg-body border-body" v-model="speedServices" @change="changeTotal">
                                                <option value="low" selected="selected">Rất Chậm</option>
                                                <option value="normal">Chậm</option>
                                                <option value="medium">Trung Bình</option>
                                                <option value="high">Nhanh</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="number_seeding">Ghi chú</label>
                                    <input type="text" class="form-control form-control-solid" id="note" v-model="note" placeholder="Nhập ghi chú về tiến trình của bạn">
                                </div>


                                <div
                                    class="notice bg-light-warning rounded border-warning border border-dashed mt-3 p-5 text-center">
                                    <div class="fw-bold">
                                        <h2 class="fw-bolder font-weight-semibold pb-2">Tổng tiền: <strong
                                            class="text-danger">{{ Number(totalPrice).toLocaleString() }} VNĐ</strong>
                                        </h2>
                                        <div>Bạn sẽ mua <strong
                                            class="text-danger">{{ Number(number_seeding).toLocaleString() }} follow</strong> với giá <strong class="text-danger">{{ sitePrice }}<sup>đ</sup>/1</strong>
                                            <strong class="text-danger">follow</strong></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary  btn-lg btn-block mr-2" :disabled="isDisabled" @click="createOrder"><i
                                v-if="isLoading" class="fas fa-circle-notch fa-spin"></i> Tạo Tiến Trình
                            </button>
                        </div>

                    </div>

                    <div class="tab-pane fade" :class="{ 'active show': isActive('history') }" id="history">

                        <div class="card p-0">
                            <LoadingPage v-if="loadingTable"></LoadingPage>
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
                                        <tr v-if="historyServices.length == '0'">
                                            <td scope="row" class="text-center" colspan="9">Không có dữ liệu</td>
                                        </tr>


                                        <tr v-for="historyData in historyServices" :key="historyData.transaction_code">
                                            <td><span class="badge badge-light">{{ historyData.service_code }}</span></td>
                                            <td><a :href="'https://facebook.com/'+historyData.url_services+''" target="_blank">{{ historyData.url_services }}</a></td>
                                            <td>{{ historyData.number }}</td>
                                            <td>{{ historyData.price }}</td>
                                            <td>{{ historyData.total_price }}</td>
                                            <td>
                                                <div v-if="historyData.status == 'Active'"><span class="badge badge-warning"><i class="fas fa-circle-notch fa-spin color-white"></i> Đang chạy...</span><span class="badge badge-light-success">{{ historyData.number_success }}/{{ historyData.number }}</span></div>
                                                <span v-if="historyData.status == 'Success'" class="badge badge-success">Hoàn thành</span>
                                                <span v-if="historyData.status == 'Report'" class="badge badge-danger">ID Facebook không tồn tại</span>
                                                <span v-if="historyData.status == 'Pause'" class="badge badge-danger">Đã Dừng</span>
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
            loading: true,
            loading_input: false,
            isTable: false,
            hideIcon: true,
            activeItem: 'create',
            user_id: "",
            note: '',
            activeClass: '',
            errorClass: '',
            speedServices: '',
            sv: 'sv_like',
            type_check: 'user',
            number_seeding: 100,
            sitePrice: 50,
            isCheckID: false,
            isResult: false,
            name: '',
            idFB: '',
            totalPrice: 5000,
            isLoading: false,
            isDisabled: false,
            historyServices: Object,
            type: this.$route.params.type,
            services: [],
            loadingTable: false,
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
    methods: {
        isActive(menuItem) {
            return this.activeItem === menuItem

        },
        setActive(menuItem) {
            if(menuItem == "history") {
                this.isTable = true
                this.updateTransaction()
                this.fetchData()
            }
            this.activeItem = menuItem
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
        updateTransaction() {
            let obj = this
            obj.loadingTable = true
            obj.spinActive = true
            axios.post('/updateTransaction/sub').then(res => {
                obj.services = res.data
                obj.loadingTable = false
                obj.spinActive = false
            })
        },
        fetchData() {
            let obj = this
            obj.loadingTable = true
            axios.post('/facebook/history/sub?page=' + obj.pagination.current_page).then(res => {
                obj.loadingTable = false
                obj.historyServices = res.data.fetchDataTransactions.data.data
                obj.pagination = res.data.fetchDataTransactions.pagination;
            })
        },
        isValidate() {
            if (this.user_id == '') {
                this.errorClass = 'is-invalid'
                return false

            } else {
                this.activeClass = 'is-valid'
                return true
            }
            return false
        },
        redirectHistory() {
            let obj = this
            obj.$router.push('/facebook/history/sub')
        },

        changeTotal() {
            let obj = this
            switch (obj.speedServices) {
                case "low":
                    obj.sitePrice = 50
                    break
                case "normal":
                    obj.sitePrice = 60
                    break
                case "medium":
                    obj.sitePrice = 80
                    break
                case "high":
                    obj.sitePrice = 100
                    break
                default:
                    obj.sitePrice = 50
            }
            obj.totalPrice = obj.number_seeding * obj.sitePrice
        },

        findID(url) {
            let obj = this
            obj.loading_input = true
            let data = {
                "url": url,
                "type": 'user'
            }
            axios.post('/api/find-id', data).then(res => {
                if (res.data.code != 400) {
                    this.isCheckID = true;
                    this.user_id = res.data.id
                    this.isResult = true
                    this.name = res.data.name
                    this.idFB = res.data.id
                    toastr.success("Đã tìm thấy thông tin ID: "+res.data.name);
                } else {
                    this.isCheckID = false;
                    toastr.error(res.data.message);
                }
                obj.loading_input = false
            }).catch(e => {
                obj.loading_input = false
                Swal.fire(
                    'Có lỗi xảy ra!',
                    'Lỗi!',
                    'error'
                )
            })
        },
        createOrder() {
            this.isValidate()
            let obj = this
            obj.isLoading = true
            obj.isDisabled = true
            let data = {
                user_id: obj.user_id,
                type_check: obj.type_check,
                number_seeding: obj.number_seeding,
                sitePrice: obj.sitePrice,
                warranty: 7,
                speed: obj.speedServices,

            }
            axios.post('/facebook/buff-follow', data).then(res => {
                if (res.data.code != 400) {
                    Swal.fire("Thành công!", res.data.messages, res.data.status);
                } else {
                    Swal.fire("Có lỗi xảy ra!", res.data.messages, res.data.status);
                }
                obj.isLoading = false
                obj.isDisabled = false
            }).catch(e => {
                obj.isLoading = false
                obj.isDisabled = false
                var response = JSON.parse(xhr.responseText);
                Swal.fire(
                    'Có lỗi xảy ra!',
                    response.messages,
                    'error'
                )
            })


        }

    }
}
</script>
