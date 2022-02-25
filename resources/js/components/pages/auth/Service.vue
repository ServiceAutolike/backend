<template>
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card mb-5 mb-xxl-10">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <!--begin::Heading-->
                        <div class="card-title">
                            <h3>Dịch vụ</h3>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Toolbar-->
                        <div class="card-toolbar">
                            <div class="d-flex flex-wrap flex-stack">
                                <!--begin::Controls-->
                                <div class="d-flex my-2">
                                    <!--begin::Search-->
                                    <div class="d-flex align-items-center position-relative me-4">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                        <span class="svg-icon svg-icon-3 position-absolute ms-3">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <input type="text" @keyup="searchName($event)" v-model="textSearch" class="form-control form-control-sm w-150px ps-9 py-4" placeholder="Nhập tên dịch vụ" />
                                    </div>
                                    <div class="d-flex align-items-center position-relative me-4">
                                        <div class="form-floating">
                                            <select class="form-select" id="floatingSelect" @change="onChange($event)" v-model="selectCateService">
                                                <option value="0">Tất cả</option>
                                                <option value="2">Facebook</option>
                                                <option value="3">Facebook Vip</option>
                                                <option value="4">Instagram</option>
                                                <option value="5">Tiktok</option>
                                                <option value="6">Youtube</option>
                                                <option value="7">Shoppe</option>
                                            </select>
                                            <label for="floatingSelect">Lọc theo danh mục</label>
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
                                    <th class="min-w-250px">Dịch vụ</th>
                                    <th class="min-w-100px">Loại dịch vụ</th>
                                    <th class="min-w-50px">Giá</th>
                                </tr>
                                </thead>
                                <!--end::Thead-->
                                <!--begin::Tbody-->
                                <tbody class="fw-6 fw-bold text-gray-600">
                                    <tr v-if="dataServices.length == '0'">
                                        <td scope="row" class="text-center" colspan="9">Không có dữ liệu</td>
                                    </tr>


                                    <tr v-for="data in dataServices" :key="data.id">
                                        <td>
                                            <span>{{data.services}}</span>
                                        </td>
                                        <td>
                                            <span class="badge" :class="data.class_type_services">{{data.type_services}}</span>
                                        </td>
                                        <td>
                                            <el-input v-model="data.price" @change="updateData(data.price,data.id,data.services)"></el-input>
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
            dataServices: Object,
            selectCateService: "0",
            textSearch : "",
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
        updateData(price,id,name) {
            let data = {
                price : price,
                id : id,
                service : name
            }
            if (price == "" || price == 0){
                toastr.error("Giá trị truyền vào lỗi, vui lòng thử lại")
            }else {
                axios.post('/admin/service/update', data)
                toastr.success("Bạn vừa cập nhật thành công " +name+ " với giá " +price+ " đồng")
            }
        },
        fetchData() {
            let obj = this
            let data = {
                type : obj.selectCateService,
                keyword : obj.textSearch
            }
            axios.post('/admin/service/data?page=' + obj.pagination.current_page, data).then(res => {
                obj.loadingTable = false
                obj.dataServices = res.data.data.data
                obj.pagination = res.data.pagination;
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
        redirectHistory() {
            let obj = this
            obj.$router.push('/facebook/history/')
        },

    }
}
</script>
