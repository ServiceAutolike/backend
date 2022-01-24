<template>
    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header card-header-stretch pb-0">
                    <!--begin::Title-->
                    <ul class="nav nav-stretch nav-line-tabs border-transparent">
                        <!--begin::Tab item-->
                        <li class="nav-item" role="presentation">
                            <a data-toggle="tab" class="nav-link fs-5 fw-bolder" @click.prevent="setActive('list')" :class="{ active: isActive('list') }" href="#list">Danh sách</a>
                        </li>
                        <!--end::Tab item-->
                        <!--begin::Tab item-->
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fs-5 fw-bolder me-5" href="/admin/post/create">Tạo bài viết</a>
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
                                    <button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-2" v-on:click="updateTransaction" data-bs-toggle="tooltip" title="" data-bs-original-title="Cập nhật dữ liệu lịch sử">
                                    <i class="fas fa-sync" v-bind:class="{ 'fa-spin': spinActive }"></i>
                                    </button>
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


                    <div class="tab-pane fade" :class="{ 'active show': isActive('list') }" id="list">

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
                                            <th class="min-w-100px">Bài viết</th>
                                            <th class="min-w-100px">Nội dung</th>
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


                                        <tr v-for="historyData in historyServices" :key="historyData.id">
                                            <td v-if="historyData.image != '' ">
                                                <img :src="'/storage/'+historyData.image" width="50" alt="" class="rounded">
                                            </td>
                                            <td v-else></td>
                                            <td v-html="historyData.content">{{historyData.content}}</td>
                                            <td>{{ timeAgo(historyData.created_at) }}</td>
                                            <td class="textend">
                                                <el-button
                                                    size="mini"
                                                    @click="handleEdit(scope.$index, scope.row)">Edit</el-button>
                                                <el-button
                                                    size="mini"
                                                    type="danger"
                                                    @click="handleDelete(historyData.id)">Delete</el-button>
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
            activeItem: 'list',
            content: '',
            activeClass: '',
            errorClass: '',
            isResult: false,
            isLoading: false,
            isDisabled: false,
            historyServices: Object,
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
        isActive(menuItem) {
            return this.activeItem === menuItem

        },
        setActive(menuItem) {
            if(menuItem == "list") {
                this.isTable = true
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
        fetchData() {
            let obj = this
            axios.get('/admin/post/data?page=' + obj.pagination.current_page).then(res => {
                obj.loadingTable = false
                obj.historyServices = res.data.data.data
                obj.pagination = res.data.pagination;
            })
        },

        redirectHistory() {
            let obj = this
            obj.$router.push('/facebook/history/')
        },
        handleDelete(id){
            let obj = this
            obj.loadingTable = true
            axios.get('/admin/post/delete/' + id)
            obj.fetchData()
        }
    }
}
</script>
