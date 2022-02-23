<template>
    <div class="row">
        <div class="col-12 col-xl-12">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header card-header-stretch pb-0">
                    <!--begin::Title-->
                    <ul class="nav nav-stretch nav-line-tabs border-transparent">
                        <!--begin::Tab item-->
                        <li class="nav-item" role="presentation">
                            <a data-toggle="tab" class="nav-link fs-5 fw-bolder" :class="activeClass == 'list' ? 'active' : ''" @click="activeToolbar(1)">Danh sách</a>
                        </li>
                        <!--end::Tab item-->
                        <!--begin::Tab item-->
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fs-5 fw-bolder me-5" :class="activeClass == 'create' ? 'active' : ''" @click="activeToolbar(2)">Tạo bài viết</a>
                        </li>
                        <!--end::Tab item-->
                    </ul>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar m-0" >
                        <div class="d-flex flex-wrap flex-stack">
                            <!--begin::Controls-->
                            <div class="d-flex my-2">
                                <!--begin::Search-->
                                <div class="mr-3">
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
                                    <input type="text" class="form-control form-control-sm w-150px ps-9" placeholder="Nhập ID bài viết" />
                                </div>
                                <!--end::Search-->
                                <a href="/" class="btn btn-primary btn-sm">Tìm Kiếm</a>
                            </div>
                            <!--end::Controls-->
                        </div>
                    </div>
                    <!--end::Toolbar-->
                </div>

                <div class="tab-content">
                    <!--begin::Tab create-->

                    <div class="tab-pane fade" :class="activeClass == 'list' ? 'active show' : ''">

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
                                                <img :src="historyData.image" width="50" alt="" class="rounded">
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
                    <div class="tab-pane fade" :class="activeClass == 'create' ? 'active show' : ''">
                        <div class="card-body">
                            <!--end::Input group-->
                            <editor :content.sync="contentForEditor"></editor>
                            <!--begin::Input group-->
                            <div class="fv-row mb-8">
                                <label class="fs-6 fw-bold mb-2">Thêm hình ảnh</label>
                                <!--begin::Dropzone-->
                                <div class="dropzone" >
                                    <!--begin::Message-->
                                    <div class="dz-message needsclick align-items-center">
                                        <!--begin::Icon-->
                                        <!--begin::Svg Icon | path: icons/duotune/files/fil010.svg-->
                                        <span class="svg-icon svg-icon-3hx svg-icon-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM16 12.6L12.7 9.3C12.3 8.9 11.7 8.9 11.3 9.3L8 12.6H11V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18V12.6H16Z" fill="black" />
                                                        <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black" />
                                                    </svg>
                                                </span>
                                        <!--end::Svg Icon-->
                                        <!--end::Icon-->
                                        <!--begin::Info-->
                                        <div class="ms-4">
                                            <h3 class="fs-5 fw-bolder text-gray-900 mb-1">Chọn một bức ảnh mà bạn chụp lại khi gặp lỗi</h3>
                                            <div v-if="image == ''">
                                                <input type="file" v-on:change="onImageChange">
                                            </div>
                                            <div v-else class="mt-2">
                                                <div class="image-input image-input-outline" data-kt-image-input="true">
                                                    <!--begin::Preview existing avatar-->
                                                    <div class="image-input-wrapper w-125px h-125px">
                                                        <img :src="image" class="rounded" style="object-fit: cover;width: 120px;height: 120px" alt="">
                                                    </div>
                                                    <!--end::Preview existing avatar-->

                                                    <!--begin::Remove-->
                                                    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" @click="deleteImage" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="" data-bs-original-title="Remove avatar">
                                                                        <i class="bi bi-x fs-2"></i>
                                                                    </span>
                                                    <!--end::Remove-->
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                </div>
                                <!--end::Dropzone-->
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-block mr-2 right mb-5" @click="create()"> Tạo Bài Viết</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Editor from "./Editor";
export default {
    components: {
        Editor
    },
    data() {
        return {
            activeClass : 'list',
            historyServices: Object,
            loadingTable: true,
            pagination: {
                'current_page': 1
            },
            pagination_payout: {
                'current_page': 1
            },
            contentForEditor: '',
            image: '',
        }
    },
    created() {
        this.fetchData()
    },
    methods: {
        activeToolbar(number){
            this.loadingTable = true
            this.fetchData()
            if (number == 1){
                this.activeClass = "list"
            }
            else {
                this.activeClass = "create"
            }
        },
        onImageChange(e){
            let formData = new FormData();
            formData.append('image', e.target.files[0]);
            axios.post('/upload', formData).then(res => {
                this.image = res.data
            })
        },
        deleteImage(){
            this.image = ''
        },
        create(){
            let obj = this
            let data = {
                content : obj.contentForEditor,
                image : obj.image,

            }
            axios.post('/admin/post/create', data)
            toastr.success('Thêm bài viết thành công')
        },
        fetchData() {
            let obj = this
            axios.get('/admin/post/data?page=' + obj.pagination.current_page).then(res => {
                obj.loadingTable = false
                obj.historyServices = res.data.data.data
                obj.pagination = res.data.pagination;
            })
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
