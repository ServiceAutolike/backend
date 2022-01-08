<template>
    <div class="row" v-loading.fullscreen.lock="fullscreenLoading">
        <div class="col-12 col-xl-12">
            <div class="card mb-5 mb-xl-10">
                <div class="card-header card-header-stretch pb-0">
                    <!--begin::Title-->
                    <ul class="nav nav-stretch nav-line-tabs border-transparent" role="tablist">
                        <!--begin::Tab item-->
                        <li class="nav-item" role="presentation">
                            <a class="nav-link fs-5 fw-bolder me-5 active">Tạo tiến trình</a>
                        </li>
                        <!--end::Tab item-->
                        <!--begin::Tab item-->
                        <li class="nav-item" role="presentation">
                            <a href="" @click="redirectHistory()" class="nav-link fs-5 fw-bolder">Lịch sử order</a>
                        </li>
                        <!--end::Tab item-->
                    </ul>
                    <!--end::Title-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar m-0">
                        <!--begin::Tab nav-->
                        <!--end::Tab nav-->
                    </div>
                    <!--end::Toolbar-->
                </div>

                <div id="kt_billing_payment_tab_content" class="tab-content">
                    <!--begin::Tab create-->
                    <div id="create" class="tab-pane fade active show" role="tabpanel">
                        <div class="card-body">
                            <form method="POST">
                                <input type="hidden" name="warranty" value="7" id="warranty"/>
                                <input type="hidden" value="post" id="type_check"/>
                                <div class="form-group">
                                    <label for="post_id">Nhập ID hoặc Link bài viết <span
                                        class="text-danger">*</span></label>
                                    <div v-bind:class="{'spinner spinner-success spinner-right': loading_input}">
                                        <input type="text" v-bind:class="[activeClass, errorClass]" class="form-control"
                                               id="post_id" v-model="post_id" placeholder="Nhập URL hoặc ID bài viết"
                                               @change="findID(post_id)" required>
                                    </div>
                                </div>
                                <div id="result" style="display: none;">
                                    <div class="d-flex align-items-center rounded p-5 mb-7 alert alert-success"
                                         id="classNoti">
                                        <!--begin::Icon-->
                                        <div class="svg-icon svg-icon-success me-5">
                                            <img src="" id="avatar_fb">
                                        </div>
                                        <!--end::Icon-->
                                        <!--begin::Title-->
                                        <div class="flex-grow-1 me-2">
                                                <span class="fw-bolder text-gray-800 text-hover-primary fs-6"
                                                      id="name_fb"></span>
                                            <span class="text-muted fw-bold d-block" id="id_fb"></span>
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
                                                   class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6 active"
                                                   data-kt-button="true">
                                                <!--begin::Radio button-->
                                                <span
                                                    class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                        <input class="form-check-input" type="radio" name="sv"
                                                               value="sv_like" @change="changeType($event)" checked>
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
                                                   class="btn btn-outline btn-outline-dashed btn-outline-default d-flex text-start p-6"
                                                   data-kt-button="true">
                                                <!--begin::Radio button-->
                                                <span
                                                    class="form-check form-check-custom form-check-solid form-check-sm align-items-start mt-1">
                                                        <input class="form-check-input" type="radio" name="sv"
                                                               value="sv_reaction" @change="changeType($event)">
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
                                            <el-select v-model="speedServices" placeholder="Chọn tốc độ" style="display: block">
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
                                           @keyup="changeTotal()">
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
                                            <strong class="text-danger">{{ svType }}</strong></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-lg btn-block mr-2" :disabled="isDisabled" @click="createOrder"><i v-if="isLoading" class="el-icon-loading"></i> Tạo Tiến Trình
                            </button>
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
            fullscreenLoading: false,
            loading: true,
            loading_input: false,
            hideIcon: true,
            post_id: "",
            activeClass: '',
            errorClass: '',
            svType: "Like",
            speedServices: '',
            sv: 'sv_like',
            type_check: 'post',
            reaction: ['Like'],
            number_seeding: 20,
            sitePrice: 50,
            isCheckID: false,
            totalPrice: 1000,
            isLoading: false,
            isDisabled: false,
            speedOption: [{
                value: 'low',
                label: 'Cực Chậm'
            }, {
                value: 'mormal',
                label: 'Bình Thường'
            }, {
                value: 'medium',
                label: 'Trung Bình'
            }, {
                value: 'high',
                label: 'Nhanh'
            }],
            value: 'low'
        }
    },
    methods: {
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
            obj.$router.push('/facebook/history/like')
        },
        changeType() {
            let obj = this
            console.log(obj.reaction)
            console.log(obj.speedServices)
            var sv = event.target.value;
            if (sv == "sv_like") {
                obj.hideIcon = true
                obj.svType = "Like"
            } else {
                obj.hideIcon = false
                obj.svType = "Cảm Xúc"
            }
            obj.changeTotal(sv)
        },
        changeTotal(type) {
            let obj = this
            let typesv = obj.sv
            obj.sv = typesv
            if (typesv == "sv_like") {
                obj.sitePrice = 50
            } else if (typesv == "sv_reaction") {
                obj.sitePrice = 70

            } else {
                obj.sitePrice = obj.sitePrice
            }
            obj.totalPrice = obj.number_seeding * obj.sitePrice


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
                    this.isCheckID = true;
                    toastr.success("Lấy ID Facebook thành công!");
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
            obj.fullscreenLoading = true;
            let data = {
                post_id: obj.post_id,
                sv: obj.sv,
                reaction: obj.reaction,
                type_check: obj.type_check,
                number_seeding: obj.number_seeding,
                sitePrice: obj.sitePrice,
                warranty: 7,
                speed: obj.speedServices,

            }

            axios.post('/facebook/buff-like', data).then(res => {
                setTimeout(() => {
                    this.fullscreenLoading = false;
                    if (res.data.code != 400) {
                        Swal.fire("Thành công!", res.data.messages, res.data.status);
                    } else {
                        Swal.fire("Có lỗi xảy ra!", res.data.messages, res.data.status);
                    }
                    obj.isLoading = false
                    obj.isDisabled = false

                }, 1500);
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
