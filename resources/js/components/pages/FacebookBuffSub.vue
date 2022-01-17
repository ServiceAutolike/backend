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
                                <div class="mr-3">
                                    <i class="text-muted mr-2">{{ time_update }}</i>
                                    <el-tooltip class="item" effect="light" content="Cập nhật trạng thái đơn của bạn" placement="top-start">
                                        <button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-2" @click="updateTransaction(true)">
                                            <i class="el-icon-refresh" v-bind:class="{ 'fa-spin': spinActive }"></i></button>
                                    </el-tooltip>
                                </div>
                                <div class="d-flex align-items-center position-relative me-4">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span class="svg-icon svg-icon-3 position-absolute ms-3">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
													<rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
													<path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
												</svg>
											</span>
                                    <!--end::Svg Icon-->
                                    <input type="text" v-model="id_search" class="form-control form-control-sm w-150px ps-9" placeholder="Nhập ID bài viết" @input="fetchData(id_search)" />
                                </div>
                                <!--end::Search-->
                            </div>
                            <!--end::Controls-->
                        </div>
                    </div>
                    <!--end::Toolbar-->
                </div>

                <LoadingPage v-if="loading"></LoadingPage>
                <div v-else id="tab_content" class="tab-content">
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
                                               @keyup="findID(user_id)" required>
                                    </div>
                                </div>
                                <div v-if="isResult">
                                    <div class="d-flex align-items-center rounded p-5 mb-7 alert-custom alert alert-success">
                                        <!--begin::Icon-->
                                        <div class="symbol symbol-50px me-5">
                                            <img :src=avatar alt="">
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <div class="flex-grow-1 me-2">
                                            <span class="fw-bolder text-gray-800 text-hover-primary fs-6">{{ namefb }}</span>
                                            <span class="text-muted fw-bold d-block">
                                                Bạn có <b class="text-danger">{{ follow }} </b> người theo dõi
                                            </span>
                                        </div>

                                        <!--end::Title-->
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="number_seeding">Số lượng cần tăng <span
                                        class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-solid" id="number_seeding"
                                           name="number" min="20" value="20" v-model="number_seeding"
                                           @keyup="changeTotal">
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sitePrice">Giá/1 lượt theo dõi (VNĐ) <span
                                                class="text-danger">*</span></label>
                                            <input type="number" class="form-control form-control-solid" id="sitePrice"
                                                   name="sitePrice" value="60" v-model="sitePrice" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sitePrice">Chọn tốc độ <span
                                                class="text-danger">*</span>
                                            </label>
                                            <el-select v-model="speedServices" placeholder="Chọn tốc độ" style="display: block" @change="changeTotal">
                                                <el-option
                                                    v-for="item in speedOption"
                                                    :key="item.value"
                                                    :label="item.label"
                                                    :value="item.value">
                                                </el-option>
                                            </el-select>
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
                                            class="text-danger">{{ Number(number_seeding).toLocaleString() }} theo dõi</strong> với giá <strong class="text-danger">{{ sitePrice }}<sup>đ</sup>/1</strong>
                                            <strong class="text-danger">theo dõi</strong> tốc độ <b class="text-success">{{ speed }}</b></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-lg btn-block mr-2" :disabled="isDisabled" @click="createOrder"><i v-if="isLoading" class="el-icon-loading"></i> Tạo Tiến Trình
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
                                                <el-button
                                                    size="mini"
                                                    @click="handleEdit(scope.$index, scope.row)">Edit</el-button>
                                                <el-button
                                                    size="mini"
                                                    type="danger"
                                                    @click="handleDelete(scope.$index, scope.row)">Delete</el-button>
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
            namefb: '',
            avatar: '',
            follow: 0,
            note: '',
            isTable: false,
            id_search: '',
            speedServices: 'high',
            hideIcon: true,
            activeItem: 'create',
            user_id: "",
            activeClass: '',
            errorClass: '',
            type_check: 'user',
            speed: "Nhanh",
            number_seeding: 20,
            sitePrice: 60,
            isCheckID: false,
            isResult: false,
            totalPrice: 0,
            isLoading: false,
            isDisabled: false,
            historyServices: Object,
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
            speedOption: [{
                value: 'low',
                label: 'Rất Chậm'
            }, {
                value: 'normal',
                label: 'Chậm'
            }, {
                value: 'medium',
                label: 'Trung Bình'
            }, {
                value: 'high',
                label: 'Nhanh'
            }],
            value: ''

        }
    },
    created() {
        this.updateTransaction(false)
        this.totalPrice = this.number_seeding * this.sitePrice
    },
    methods: {
        isActive(menuItem) {
            return this.activeItem === menuItem

        },
        setActive(menuItem) {
            if(menuItem == "history") {
                this.isTable = true
                this.fetchData()
            }
            else {
                this.isTable = false
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
        updateTransaction(status) {
            let obj = this
            obj.loading = true
            obj.spinActive = true
            if(status === false) {
                obj.time_update = "Không có ID nào cần cập nhật"
                axios.post('/updateTransaction/sub', {type: 'like'}).then(res => {
                    obj.services = res.data
                    if(res.data.length > 0) {
                        obj.time_update = this.timeAgo(res.data.time_update)
                    }
                    obj.loading = false
                    obj.spinActive = false
                })
            }
            else {
                axios.post('/updateTransaction/sub', {type: 'like', status: 'updated'}).then(res => {
                    obj.services = res.data
                    if(res.data.length > 0) {
                        obj.time_update = this.timeAgo(res.data.time_update)
                    }
                    else {
                        obj.time_update = "Đã cập nhật"
                    }
                    obj.loading = false
                    obj.spinActive = false
                })
            }

        },
        fetchData(search) {
            search = this.id_search
            this.loading = true
            if(search !== "") {
                axios.post('/facebook/history/sub', {id_post: search}).then(res => {
                    this.loading = false
                    this.historyServices = res.data.data
                })
            }
            else {
                axios.post('/facebook/history/sub?page=' + this.pagination.current_page).then(res => {
                    this.loading = false
                    this.historyServices = res.data.fetchDataTransactions.data.data
                    this.pagination = res.data.fetchDataTransactions.pagination;
                })
            }
        },
        isValidate() {
            if(this.user_id === '') {
                return false
            }
            else if(this.sitePrice < 20 || this.sitePrice == null) {
                return false
            }
            else if(this.server == null) {
                return false
            }
            else if(this.speedServices == null) {
                return false
            }
            else if(this.sitePrice == null) {
                return false
            }
            else if(this.number_seeding == null || this.number_seeding < 20) {
                return false
            }
                // else if(this.isCheckID === false) {
                //     return false
            // }
            else {
                return true
            }
        },

        changeTotal() {
            switch (this.speedServices) {
                case "low":
                    this.sitePrice = 20
                    this.speed = "Rất Chậm"
                    break
                case "normal":
                    this.sitePrice = 40
                    this.speed = "Chậm"
                    break
                case "medium":
                    this.sitePrice = 50
                    this.speed = "Bình Thường"
                    break
                case "high":
                    this.sitePrice = 60
                    this.speed = "Nhanh"
                    break
                default:
                    this.sitePrice = 60
                    this.speed = "Nhanh"
            }
            this.totalPrice = this.number_seeding * this.sitePrice
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
                    this.isResult = true
                    this.user_id = res.data.id
                    this.namefb = res.data.name
                    this.follow = res.data.follow
                    this.avatar = res.data.avatar
                    toastr.success("Đã tìm thấy thông tin Facebook "+this.namefb);
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
            let validate = this.isValidate()
            if(validate != false) {
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
            else {
                Swal.fire('Lỗi','Vui lòng kiểm tra các trường trống hoặc ID bài viết không tồn tại!', 'error')
            }


        }

    }
}
</script>
