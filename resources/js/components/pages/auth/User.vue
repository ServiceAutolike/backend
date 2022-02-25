<template>
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card mb-5 mb-xxl-10">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Heading-->
                    <div class="card-title">
                        <h3>{{ title }}</h3>
                    </div>
                    <!--end::Heading-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <div class="d-flex flex-wrap flex-stack">
                            <!--begin::Controls-->
                            <div class="d-flex my-2">
                                <div class="d-flex align-items-center position-relative me-4">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span class="svg-icon svg-icon-3 position-absolute ms-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                            </svg>
                                        </span>
                                    <!--end::Svg Icon-->
                                    <input type="text" @keyup="searchName($event)" v-model="textSearch" class="form-control form-control-sm w-150px ps-9 py-4" placeholder="Nhập từ khoá" />
                                </div>
                                <div class="d-flex align-items-center position-relative me-4">
                                    <div class="form-floating">
                                        <select class="form-select" id="floatingSelect" @change="onChange($event)" v-model="selectSearch">
                                            <option value="name">Tên tài khoản</option>
                                            <option value="email">Email</option>
                                            <option value="phone">Số điện thoại</option>
                                        </select>
                                        <label for="floatingSelect">Tìm kiếm theo</label>
                                    </div>
                                </div>
                                <!--end::Search-->
                            </div>
                            <!--end::Controls-->
                        </div>

                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body p-0">
                    <LoadingPage v-if="loadingTable"></LoadingPage>
                    <!--begin::Table wrapper-->
                    <div v-else class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9">
                            <!--begin::Thead-->
                            <thead class="border-gray-200 fs-5 fw-bold bg-lighten">
                            <tr>
                                <th>Tài khoản</th>
                                <th>Tên tài khoản</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Số tiền</th>
                                <th>Cấp độ</th>
                                <th>Ngày tạo</th>
                                <th class="w-250px">Hoạt động</th>
                            </tr>
                            </thead>
                            <!--end::Thead-->
                            <!--begin::Tbody-->
                            <tbody class="fw-6 fw-bold text-gray-600">
                            <tr v-if="dataAll.length == '0'">
                                <td scope="row" class="text-center" colspan="9">Không có dữ liệu</td>
                            </tr>


                            <tr v-for="data in dataAll" :key="data.id">
                                <td>
                                    <div class="symbol symbol-50px"><img :src="'/'+data.image" alt=""></div>
                                </td>
                                <td>
                                    <span >{{data.name}}</span>
                                </td>
                                <td>
                                    <span >{{data.email}}</span>
                                </td>
                                <td>
                                    <span >{{data.phone}}</span>
                                </td>
                                <td>
                                    <span class="badge badge-light-info">{{data.point.toLocaleString()}} đ</span>
                                </td>
                                <td>
                                    <span class="badge" :class="data.class_level">{{data.level}} </span>
                                </td>
                                <td>
                                    <span >{{timeAgo(data.created_at)}}</span>
                                </td>
                                <td>
                                    <router-link :to="{ path: '/admin/user/change/'+ data.id}" class="btn btn-danger btn-hover-scale me-5 btn-sm">Thay đổi</router-link>
                                    <button class="btn btn-danger btn-hover-scale me-5 btn-sm" @click="loginUser(data.id)">Đăng nhập</button>
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
                <!--end::Card body-->
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
            isResult: false,
            isLoading: false,
            isDisabled: false,
            dataAll: Object,
            textSearch : "",
            selectSearch: 'name',
            title : '',
            loadingTable: true,
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
    created() {
        this.fetchData()
    },
    methods: {
        loginUser(id){
            let data = {
                id : id
            }
            try {
                axios.post('/admin/user/loginUser', data).then(res => {
                    this.$router.go(0)
                })
            }catch (e) {
                toastr.error(e)
            }
        },
        updateData(price,id,name) {
            let data = {
                price : price,
                id : id,
                service : name
            }
            if (price == "" || price == 0){
                toastr.error("Giá trị phải truyền vào lỗi, vui lòng thử lại")
            }else {
                axios.post('/admin/service/update', data)
                toastr.success("Bạn vừa cập nhật thành công " +name+ " với giá " +price+ " đồng")
            }
        },
        fetchData() {
            let obj = this
            let data = {
                keyword : obj.textSearch,
                select : obj.selectSearch
            }
            axios.post('/admin/user/data?page=' + obj.pagination.current_page, data).then(res => {
                obj.loadingTable = false
                obj.dataAll = res.data.data.data
                obj.pagination = res.data.pagination
                obj.title = res.data.title
            })
        },
        onChange(event) {
            this.selectCateService = event.target.value
            this.fetchData()
        },
        searchName(event) {
            this.loadingTable = true
            this.textSearch = event.target.value
            this.fetchData()
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

    }
}
</script>
