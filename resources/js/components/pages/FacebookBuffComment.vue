<template>

    <div class="row">
        <Modal v-if="showModal"></Modal>

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
                                <div class="row align-items-center">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label>Chọn bộ comment <span
                                                class="text-danger">*</span>
                                            </label>
                                            <el-select v-model="id_comment" filterable placeholder="Chọn list bình luận" style="display: block;">
                                                <el-option
                                                    v-for="getAllComment in allcomment"
                                                    :key="getAllComment.id"
                                                    :label="getAllComment.name"
                                                    :value="getAllComment.id_comment">
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
                                            class="text-danger">{{ Number(number_seeding).toLocaleString() }} comment</strong> với giá <strong class="text-danger">{{ sitePrice }}<sup>đ</sup>/1</strong>
                                            <strong class="text-danger">comment</strong></div>
                                    </div>
                                </div>

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
            speed: 'low',
            activeItem: 'create',
            post_id: "",
            showModal: false,
            note: '',
            dialogVisible: false,
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
            if (this.post_id == '') {
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
                    this.post_id = res.data.id
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
                post_id: obj.post_id,
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
