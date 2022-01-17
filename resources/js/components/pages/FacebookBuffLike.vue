<template>
    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header card-header-stretch pb-0">
                    <!--begin::Title-->
                    <ul class="nav nav-stretch nav-line-tabs border-transparent" role="tablist">
                        <!--begin::Tab item-->
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fs-5 fw-bolder me-5" @click.prevent="setActive('create')" :class="{ active: isActive('create') }" href="#create">Tạo Tiến Trình</a>
                        </li>
                        <!--end::Tab item-->
                        <!--begin::Tab item-->
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fs-5 fw-bolder" @click.prevent="setActive('history')" :class="{ active: isActive('history') }" href="#history">Lịch Sử Order</a>
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
<!--                                <button class="btn btn-primary btn-sm" @click="fetchData(id_search)">Tìm Kiếm</button>-->
                            </div>
                            <!--end::Controls-->
                        </div>
                    </div>
                    <!--end::Toolbar-->
                </div>

                <div id="tab_content" class="tab-content">
                    <!--begin::Tab create-->
                    <LoadingPage v-if="loading"></LoadingPage>
                    <div v-else class="tab-pane fade" :class="{ 'active show': isActive('create') }" id="create">
                        <div class="card-body">
                            <form method="POST">
                                <input type="hidden" name="warranty" value="7" id="warranty"/>
                                <input type="hidden" value="post" id="type_check"/>
                                <div class="form-group">
                                    <label>Nhập ID hoặc Link bài viết <span
                                        class="text-danger">*</span></label>
                                    <div v-bind:class="{'spinner spinner-success spinner-right': loading_input}">
                                        <input type="text" v-bind:class="[activeClass, errorClass]" class="form-control" v-model="post_id" placeholder="Nhập URL hoặc ID bài viết" @input="findID(post_id)" required>
                                    </div>
                                </div>
                                <div v-if="result_id">
                                    <div class="d-flex align-items-center rounded p-5 mb-7 alert-custom alert alert-success">
                                        <!--begin::Icon-->
                                        <div class="svg-icon svg-icon-success me-5">
                                            <img :src=picture alt="">
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <div class="flex-grow-1 me-2">
                                            <span class="fw-bolder text-gray-800 text-hover-primary fs-6">{{ namefb }}</span>
                                            <span class="text-muted fw-bold d-block">
                                                {{ timeAgo(time) }}
                                            </span>
                                            <span class="content">{{ content }}</span>
                                        </div>

                                        <!--end::Title-->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Chọn SEVER <span class="text-danger">*</span></label>
                                    <div class="row g-9" data-kt-buttons="true"
                                         data-kt-buttons-target="[data-kt-button]">
                                        <!--begin::Col-->
                                        <div class="col-md-6 col-lg-12 col-xxl-6">
                                            <label id="sv_like_check"
                                                   class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6">
                                                <!--begin::Radio button-->
                                                <span
                                                    class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                        <input class="form-check-input" type="radio" v-model="server"
                                                               value="sv_like" @change="changeTotal">
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
                                                   class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6">
                                                <!--begin::Radio button-->
                                                <span
                                                    class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                        <input class="form-check-input" type="radio" v-model="server"
                                                               value="sv_reaction" @change="changeTotal">
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

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Chọn cảm xúc <span class="text-danger">*</span></label>
                                            <div class="list-reaction mt-3">
                                                <div class="icon-buff like">
                                                    <input type="checkbox" value="Like" class="" v-model="reaction"
                                                           id="like" checked>
                                                    <div class="icon-reaction">
                                                        <label for="like">
                                                            <img src="/Backend-Assets/media/icon/like.svg"
                                                                 alt="Like icon" width="40"/>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="icon-buff love" v-bind:class="{ 'd-none': hideIcon }">
                                                    <input type="checkbox" value="Love" v-model="reaction" class=""
                                                           id="love">
                                                    <div class="icon-reaction">
                                                        <label for="love">
                                                            <img src="/Backend-Assets/media/icon/love.svg"
                                                                 alt="love icon" width="40"/>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="icon-buff care" v-bind:class="{ 'd-none': hideIcon }">
                                                    <input type="checkbox" value="Care" v-model="reaction" class=""
                                                           id="care">
                                                    <div class="icon-reaction">
                                                        <label for="care">
                                                            <img src="/Backend-Assets/media/icon/care.svg"
                                                                 alt="care icon" width="40"/>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="icon-buff haha" v-bind:class="{ 'd-none': hideIcon }">
                                                    <input type="checkbox" value="Haha" v-model="reaction" class=""
                                                           id="haha">
                                                    <div class="icon-reaction">
                                                        <label for="haha">
                                                            <img src="/Backend-Assets/media/icon/haha.svg"
                                                                 alt="haha icon" width="40"/>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="icon-buff wow" v-bind:class="{ 'd-none': hideIcon }">
                                                    <input type="checkbox" value="Wow" v-model="reaction" class=""
                                                           id="wow">
                                                    <div class="icon-reaction">
                                                        <label for="wow">
                                                            <img src="/Backend-Assets/media/icon/wow.svg"
                                                                 alt="wow icon" width="40"/>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="icon-buff sad" v-bind:class="{ 'd-none': hideIcon }">
                                                    <input type="checkbox" value="Sad" v-model="reaction" class=""
                                                           id="sad">
                                                    <div class="icon-reaction">
                                                        <label for="sad">
                                                            <img src="/Backend-Assets/media/icon/sad.svg"
                                                                 alt="sad icon" width="40"/>
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="icon-buff angry" v-bind:class="{ 'd-none': hideIcon }">
                                                    <input type="checkbox" value="Angry" v-model="reaction" class=""
                                                           id="angry">
                                                    <div class="icon-reaction">
                                                        <label for="angry">
                                                            <img src="/Backend-Assets/media/icon/angry.svg"
                                                                 alt="angry icon" width="40"/>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Chọn tốc độ <span class="text-danger">*</span></label>
                                            <!--begin::Select-->
                                            <el-select v-model="speedServices" placeholder="Chọn tốc độ" style="display: block" @change="changeTotal">
                                                <el-option
                                                    v-for="item in speedOption"
                                                    :key="item.value"
                                                    :label="item.label"
                                                    :value="item.value">
                                                </el-option>
                                            </el-select>

                                            <!--end::Select-->
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="number_seeding">Số lượng cần tăng <span
                                        class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-solid" id="number_seeding"
                                           name="number" min="20" value="20" v-model="number_seeding"
                                           @input="changeTotal">
                                </div>

                                <div class="form-group">
                                    <label for="sitePrice">Giá/1 tương tác (VNĐ) <span
                                        class="text-danger">*</span></label>
                                    <input type="number" class="form-control form-control-solid" id="sitePrice"
                                           name="sitePrice" value="50" v-model="sitePrice" disabled>
                                </div>

                                <div
                                    class="notice bg-light-warning rounded border-warning border border-dashed mt-3 p-5 text-center">
                                    <div class="fw-bold">
                                        <h2 class="fw-bolder font-weight-semibold pb-2">Tổng tiền: <strong
                                            class="text-danger">{{ Number(totalPrice).toLocaleString() }} VNĐ</strong>
                                        </h2>
                                        <div>Bạn sẽ mua <strong
                                            class="text-danger">{{ Number(number_seeding).toLocaleString() }} {{
                                                svType
                                            }}</strong> với giá <strong class="text-danger">{{ sitePrice }}<sup>đ</sup>/1</strong>
                                            <strong class="text-danger">{{ svType }}</strong> tốc độ <b class="text-success">{{ speed }}</b></div>
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
                                        <tr v-if="historyServices.length == '0'">
                                            <td scope="row" class="text-center" colspan="9">Không có dữ liệu</td>
                                        </tr>


                                        <tr v-for="historyData in historyServices" :key="historyData.transaction_code">
                                            <td><span class="badge badge-light">{{ historyData.service_code }}</span></td>
                                            <td><a :href="'https://facebook.com/'+historyData.url_services+''" target="_blank">{{ historyData.url_services }}</a></td>
                                            <td><img v-for="reactions in JSON.parse(historyData.reactions)" :src="'/Backend-Assets/media/icon/'+reactions+'.svg'" class="me-2"></td>
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
                                                    type="danger"
                                                    @click="handleDelete(scope.$index, scope.row)">Hủy</el-button>
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
            loading: true,
            isTable: false,
            id_search: '',
            time_update: '',
            spinActive: false,
            time: '',
            result_id: false,
            namefb: '',
            picture: '',
            content: '',
            speed: "Nhanh",
            loading_input: false,
            hideIcon: true,
            activeItem: 'create',
            post_id: "",
            activeClass: '',
            errorClass: '',
            svType: "Like",
            speedServices: 'high',
            server: 'sv_like',
            type_check: 'post',
            reaction: ['Like'],
            number_seeding: 20,
            sitePrice: 50,
            isCheckID: false,
            totalPrice: 0,
            isLoading: false,
            isDisabled: false,
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
        isValidate() {
            if(this.post_id === '') {
                return false
            }
            else if(this.server == null) {
                return false
            }
            else if(this.reaction.length < 1) {
                return false
            }
            else if(this.speedServices == null) {
                return false
            }
            else if(this.sitePrice == null) {
                return false
            }
            else if(this.number_seeding == null) {
                return false
            }
            // else if(this.isCheckID === false) {
            //     return false
            // }
            else {
                return true
            }
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
                axios.post('/updateTransaction/like', {type: 'like'}).then(res => {
                    obj.services = res.data
                    if(res.data.length > 0) {
                        obj.time_update = this.timeAgo(res.data.time_update)
                    }
                    obj.loading = false
                    obj.spinActive = false
                })
            }
            else {
                axios.post('/updateTransaction/like', {type: 'like', status: 'updated'}).then(res => {
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
                axios.post('/facebook/history/like', {id_post: search}).then(res => {
                    this.loading = false
                    this.historyServices = res.data.data
                })
            }
            else {
                axios.post('/facebook/history/like?page=' + this.pagination.current_page).then(res => {
                    this.loading = false
                    this.historyServices = res.data.fetchDataTransactions.data.data
                    this.pagination = res.data.fetchDataTransactions.pagination;
                })
            }
        },
        changeTotal() {
            if (this.server == "sv_like") {
                this.hideIcon = true
                switch (this.speedServices) {
                    case "low":
                        this.sitePrice = 20
                        this.speed = "Rất Chậm"
                        break
                    case "normal":
                        this.sitePrice = 30
                        this.speed = "Chậm"
                        break
                    case "medium":
                        this.sitePrice = 40
                        this.speed = "Bình Thường"
                        break
                    case "high":
                        this.sitePrice = 50
                        this.speed = "Nhanh"
                        break
                    default:
                        this.sitePrice = 50
                        this.speed = "Nhanh"
                }
            } else if (this.server == "sv_reaction") {
                this.hideIcon = false
                switch (this.speedServices) {
                    case "low":
                        this.sitePrice = 30
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
            }
            else {
                this.sitePrice = this.sitePrice
            }
            this.totalPrice = this.number_seeding * this.sitePrice
        },

        findID(url) {
            this.loading_input = true
            let data = {
                "url": url,
                "type": 'post'
            }
            axios.post('/api/find-id', data).then(res => {
                this.result_id = true
                if (res.data.code != 400) {
                    this.isCheckID = true;
                    this.post_id = res.data.id_post
                    this.time = res.data.time
                    this.picture = res.data.picture
                    this.namefb = res.data.name
                    this.content = res.data.content
                    this.activeClass = 'is-valid'
                    this.errorClass = ''
                    toastr.success("Đã tìm thấy thông tin ID bài viết");
                } else {
                    this.isCheckID = false;
                    this.errorClass = 'is-invalid'
                    this.activeClass = ''
                    this.result_id = false
                    toastr.error(res.data.message);
                }
                this.loading_input = false
            }).catch(e => {
                this.result_id = false
                this.isCheckID = false;
                this.loading_input = false
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
                this.isLoading = true
                this.isDisabled = true
                this.fullscreenLoading = true;
                let data = {
                    post_id: this.post_id,
                    sv: this.server,
                    reaction: this.reaction,
                    type_check: this.type_check,
                    number_seeding: this.number_seeding,
                    sitePrice: this.sitePrice,
                    warranty: 7,
                    speed: this.speedServices,

                }
                axios.post('/facebook/buff-like', data).then(res => {
                    if (res.data.code != 400) {
                        Swal.fire("Thành công!", res.data.messages, res.data.status);
                    } else {
                        Swal.fire("Có lỗi xảy ra!", res.data.messages, res.data.status);
                    }
                    this.isLoading = false
                    this.isDisabled = false
                }).catch(e => {
                    this.isLoading = false
                    this.isDisabled = false
                    Swal.fire(
                        'Có lỗi xảy ra!',
                        'Vui lòng liên hệ admin để được xử lý!',
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
