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
                                    <input type="text" @keyup="changeUp" class="form-control form-control-sm w-150px ps-9" placeholder="Nhập ID bài viết" />
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

                                <input type="hidden" name="warranty" value="7" id="warranty"/>
                                <input type="hidden" value="post" id="type_check"/>
                                <div class="form-group">
                                    <label for="post_id">Nhập ID hoặc URL bài viết <span
                                        class="text-danger">*</span></label>
                                    <div v-bind:class="{'spinner spinner-success spinner-right': loading_input}">
                                        <input type="text" v-bind:class="[activeClass, errorClass]" class="form-control"
                                               id="post_id" v-model="post_id" placeholder="Nhập URL hoặc ID bài viết"
                                               @change="findID(post_id)" required>
                                    </div>
                                </div>
                            <div v-if="isResult">
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
                                <div class="row align-items-center">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label>Chọn bộ comment <span
                                                class="text-danger">*</span>
                                            </label>
                                            <el-select v-model="id_comment" filterable placeholder="Chọn list bình luận" style="display: block;" @change="getTotalComment">
                                                <el-option
                                                    v-for="getAllComment in allcomment"
                                                    :key="getAllComment.id"
                                                    :label="getAllComment.name"
                                                    :value="getAllComment.id_comment">
                                                    <span style="float: left">{{ getAllComment.name }}</span>
                                                    <span style="float: right; color: #8492a6; font-size: 13px">{{ getAllComment.total }} bình luận</span>
                                                </el-option>
                                            </el-select>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <el-button type="primary" @click="dialogVisible = true"><i class="el-icon-circle-plus-outline color-white"></i> Tạo List Comment</el-button>
                                        <el-dialog
                                            title="Tạo List Comment"
                                            :visible.sync="dialogVisible"
                                            width="30%">
                                            <el-form :model="commentForm" :rules="rules" ref="ruleForm" class="commentForm">
                                                <el-form-item label="Tên thể loại" prop="name_comment">
                                                    <el-input placeholder="Mỹ phẩm, Đông y..." v-model="commentForm.name_comment"></el-input>
                                                </el-form-item>
                                                <el-form-item :label="totalcomment" prop="comment">
                                                    <el-input :rows="5" placeholder="Nhập comment, mỗi dòng 1 nội dung được tính là 1 lần seeding" type="textarea" v-model="commentForm.comment" @input="changeUp"></el-input>
                                                </el-form-item>
                                                <div class="notice bg-light-warning rounded border-warning border border-dashed p-5 mt-7">
                                                    <p><b class="text-danger">Lưu ý: </b><br>
                                                    1. Cứ mỗi dòng tính là 1 comment<br>
                                                    2. Yêu cầu tối thiểu 20 comment<br>
                                                    3. Nghiêm cấm bình luận những nội có cử chỉ, lời nói thô bạo, khiêu khích, trêu ghẹo, xúc phạm nhân phẩm, danh dự của Cá nhân hoặc Tổ chức.<br>
                                                    4. Hệ thống chỉ xét duyệt từ 8h sáng đến 12h đêm hằng ngày</p>
                                                </div>
                                                <div class="el-dialog__footer" style="padding: 10px 0px 20px;">
                                                    <button type="button" @click="submitForm('ruleForm')" class="btn btn-primary"><i v-if="btnLoading" class="el-icon-loading"></i> Tạo Comment</button>
                                                    <el-button @click="dialogVisible = false">Đóng</el-button>
                                                </div>
                                            </el-form>
                                        </el-dialog>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sitePrice">Giá/1 bình luận (VNĐ) <span
                                                class="text-danger">*</span></label>
                                            <input type="number" class="form-control form-control-solid" id="sitePrice"
                                                   name="sitePrice" value="80" v-model="sitePrice" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="sitePrice">Chọn tốc độ <span class="text-danger">*</span>
                                            </label>
                                            <el-select v-model="speedServices" placeholder="Chọn tốc độ" style="display: block" @change="changeTotal">
                                                <el-option label="Rất Chậm" value="low"></el-option>
                                                <el-option label="Chậm" value="normal"></el-option>
                                                <el-option label="Trung Bình" value="medium"></el-option>
                                                <el-option label="Nhanh" value="high"></el-option>
                                            </el-select>

                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label :for="note">Ghi chú</label>
                                    <input type="text" class="form-control form-control-solid" id="note" v-model="note" placeholder="Nhập ghi chú về tiến trình của bạn">
                                </div>


                                <div
                                    class="notice bg-light-warning rounded border-warning border border-dashed mt-3 p-5 text-center">
                                    <div class="fw-bold">
                                        <h2 class="fw-bolder font-weight-semibold pb-2">Tổng tiền: <strong
                                            class="text-danger">{{ Number(totalPrice).toLocaleString() }} VNĐ</strong>
                                        </h2>
                                        <div>Bạn sẽ mua <strong
                                            class="text-danger">{{ Number(total_comment).toLocaleString() }} bình luận</strong> với giá <strong class="text-danger">{{ sitePrice }}<sup>đ</sup>/1</strong>
                                            <strong class="text-danger">bình luận</strong> với tốc độ <b class="text-success">{{ speed }}</b></div>
                                    </div>
                                </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary  btn-lg btn-block mr-2" :disabled="isDisabled" @click="createOrder"><i
                                v-if="isLoading" class="el-icon-loading"></i> Tạo Tiến Trình
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
            commentForm: {
                name_comment: '',
                comment: '',
            },
            loading: true,
            loading_input: false,
            isTable: false,
            hideIcon: true,
            btnLoading: false,
            listcomment: [],
            id_comment: '',
            totalcomment: "Số lượng (0 bình luận)",
            allcomment: Object,
            post_comment: '',
            speed: 'Nhanh',
            activeItem: 'create',
            post_id: "",
            namefb: '',
            picture: '',
            content: '',
            showModal: false,
            note: '',
            dialogVisible: false,
            activeClass: '',
            errorClass: '',
            speedServices: 'high',
            sv: 'sv_like',
            type_check: 'user',
            number_seeding: 0,
            sitePrice: 500,
            isCheckID: false,
            isResult: false,
            totalPrice: 0,
            isLoading: false,
            isDisabled: false,
            historyServices: Object,
            type: this.$route.params.type,
            services: [],
            loadingTable: false,
            spinActive: false,
            loading_t: false,
            total_comment: 0,
            pagination: {
                'current_page': 1
            },
            pagination_payout: {
                'current_page': 1
            },
            rules: {
                name_comment: [
                    { required: true, message: 'Vui lòng nhập tên thể loại', trigger: 'blur' },],
                comment: [
                    { required: true, message: 'Vui lòng nhập ít nhất 1 bình luận', trigger: 'change' }
                ],
            }
        };
    },
    created() {
        this.getListComment()
        this.totalPrice = this.total_comment * this.sitePrice
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
        changeUp() {
            if(this.commentForm.comment != "") {
                this.listcomment = this.commentForm.comment.split('\n')
                this.totalcomment = "Số lượng (" + this.listcomment.length + " bình luận)"
            }
            else {
                console.log(this.listcomment)
                this.totalcomment = "Số lượng (0 bình luận)"
            }
        },
        createComment() {
            this.btnLoading = true
            this.listcomment = this.commentForm.comment.split('\n')
            let data = {
                "name": this.commentForm.name_comment,
                "comment": this.listcomment
            }
            axios.post('/facebook/createListComment',data).then(res => {
                this.btnLoading = false
                if(res.data.code == 200) {
                    Swal.fire('Thành Công', 'Tạo comment '+this.commentForm.name_comment+' thành công', 'success');
                    this.dialogVisible = false
                    this.getListComment()
                }
                else {
                    this.$message({
                        showClose: true,
                        message: res.data.message,
                        type: 'error'
                    });
                }

            })
        },
        submitForm(formName) {
            this.$refs[formName].validate((valid) => {
                if (valid) {
                    this.createComment()
                } else {
                    return false;
                }
            });
        },

        getTotalComment() {
            axios.post('/facebook/'+this.id_comment, {id_comment: this.id_comment}).then(res => {
                this.total_comment = res.data.total
                this.post_comment = res.data.comment
                this.totalPrice = this.total_comment * this.sitePrice
            })
        },

        getListComment() {
            axios.get('/facebook/listcomment').then(res => {
                this.allcomment = res.data
            })
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
            if(this.post_id === '') {
                return false
            }
            else if(this.total_comment <= 0) {
                return false
            }
            else {
                return true
            }
        },
        changeTotal() {
            let obj = this
            switch (obj.speedServices) {
                case "low":
                    obj.speed = "Rất Chậm"
                    obj.sitePrice = 150
                    break
                case "normal":
                    obj.speed = "Chậm"
                    obj.sitePrice = 300
                    break
                case "medium":
                    obj.speed = "Bình Thường"
                    obj.sitePrice = 400
                    break
                case "high":
                    obj.speed = "Nhanh"
                    obj.sitePrice = 500
                    break
                default:
                    obj.speed = "Nhanh"
                    obj.sitePrice = 500
            }
            obj.totalPrice = obj.total_comment * obj.sitePrice
        },

        findID(url) {
            let obj = this
            obj.loading_input = true
            let data = {
                "url": url,
                "type": 'post'
            }
            axios.post('/api/find-id', data).then(res => {
                if (res.data.code != 400) {
                    this.isCheckID = true
                    this.isResult = true
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
                    this.isResult = false
                    this.errorClass = 'is-invalid'
                    this.activeClass = ''
                    this.result_id = false
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
            console.log(validate)
            if(validate != false) {
                let obj = this
                obj.isLoading = true
                obj.isDisabled = true
                let data = {
                    post_id: obj.post_id,
                    number_seeding: obj.total_comment,
                    id_comment: obj.id_comment,
                    sitePrice: obj.sitePrice,
                    warranty: 7,
                    speed: obj.speedServices,

                }
                axios.post('/facebook/buff-comment', data).then(res => {
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
                    Swal.fire(
                        'Có lỗi xảy ra!',
                        'Không thể tạo mới giao dịch này',
                        'error'
                    )
                })
            }
            else {
                Swal.fire('Thông Báo','Vui lòng kiểm tra các trường nhập vào trống hoặc ID Post không hợp lệ!','error')
            }

        }

    }
}
</script>
