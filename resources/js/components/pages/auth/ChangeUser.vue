<template>
    <div>
        <div class="card mb-5 mb-xl-10">
            <!--begin::Card header-->
            <div class="border-0 cursor-pointer">
                <!--begin::Card title-->
                <div class="card-title m-0">

                </div>
                <!--end::Card title-->
            </div>
            <!--begin::Card header-->
            <!--begin::Content-->
            <div class="collapse show">
                <!--begin::Card body-->
                <div class="card-body p-9 pb-0">
                    <!--begin::Details-->
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                        <!--begin: Pic-->
                        <div class="me-7 mb-4">
                            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                <img :src="'/'+image" alt="image" />
                                <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px"></div>
                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <!--begin::User-->
                                <div class="d-flex flex-column">
                                    <!--begin::Name-->
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{name}}</a>
                                        <a href="#">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen026.svg-->
                                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="#00A3FF" />
                                                <path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white" />
                                            </svg>
                                        </span>
                                            <!--end::Svg Icon-->
                                        </a>
                                        <a href="#" class="btn btn-sm btn-light-success fw-bolder ms-2 fs-8 py-1 px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_upgrade_plan">{{levelText}}</a>
                                    </div>
                                    <!--end::Name-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                        <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                            <span class="svg-icon svg-icon-muted me-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M5 20H19V21C19 21.6 18.6 22 18 22H6C5.4 22 5 21.6 5 21V20ZM19 3C19 2.4 18.6 2 18 2H6C5.4 2 5 2.4 5 3V4H19V3Z" fill="black"/>
                                                    <path opacity="0.3" d="M19 4H5V20H19V4Z" fill="black"/>
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            {{ phone }}
                                        </a>
                                        <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                            <span class="svg-icon svg-icon-4 me-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="black" />
                                                <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="black" />
                                            </svg>
                                        </span>
                                            <!--end::Svg Icon-->
                                            {{ email }}
                                        </a>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->

                            </div>
                            <!--end::Title-->
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded py-3 px-4 me-6 mb-3 w-300px">
                                <h2>Số tiền : {{ formatNumber(point) }} Đồng</h2>
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Details-->
                    <!--begin::Navs-->
                    <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
                        <!--begin::Nav item-->
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 cursor-pointer" @click="activeToolbar(1)" :class="activeClass == 'change' ? 'active' : ''">Thay đổi thông tin</a>
                        </li>
                        <!--end::Nav item-->
                        <!--begin::Nav item-->
                        <li class="nav-item mt-2">
                            <a class="nav-link text-active-primary ms-0 me-10 py-5 cursor-pointer" @click="activeToolbar(2)" :class="activeClass == 'recharge' ? 'active' : ''">Nạp tiền</a>
                        </li>
                        <!--end::Nav item-->
                    </ul>
                    <!--begin::Navs-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Content-->
        </div>
        <div class="tab-content">
            <div class="tab-pane fade" :class="activeClass == 'change' ? 'active show' : ''">
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header cursor-pointer">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">Thay đổi thông tin tài khoản</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body p-9">
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Cấp độ 1</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <select type="text" class="form-control form-control-lg form-control-solid" v-model="level">
                                    <option value="1">Thành viên</option>
                                    <option value="2">Đại lý</option>
                                    <option value="3">Đại lý vip 1</option>
                                    <option value="4">Đại lý vip 2</option>
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Số tiền</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <input type="text" class="form-control form-control-lg form-control-solid" v-model="point" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Tên tài khoản</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <input type="text" class="form-control form-control-lg form-control-solid" v-model="name" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">Số điện thoại</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Phone number must be active"></i>
                            </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <input type="tel" v-model="phone" class="form-control form-control-lg form-control-solid " />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span class="required">Email</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Phone number must be active"></i>
                            </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <input type="email" class="form-control form-control-lg form-control-solid" v-model="email"  />
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-bold fs-6">
                                <span>Mật khẩu</span>
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Phone number must be active"></i>
                            </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <input type="text" class="form-control form-control-lg form-control-solid" v-model="password" />
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label fw-bold fs-6">Avatar</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <!--begin::Image input-->
                                <div class="image-input image-input-outline" data-kt-image-input="true" >
                                    <!--begin::Preview existing avatar-->
                                    <div class="image-input-wrapper w-125px h-125px" >
                                        <img width="100%" :src="'/'+image" alt="">
                                    </div>
                                    <!--end::Preview existing avatar-->

                                </div>
                                <!--end::Image input-->
                                <!--begin::Hint-->
                                <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                                <!--end::Hint-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-6 ">
                            <button type="button" class="btn btn-primary" @click="updateData()">Lưu thông tin</button>
                        </div>
                    </div>

                    <!--end::Card body-->
                </div>
            </div>
            <div class="tab-pane fade" :class="activeClass == 'recharge' ? 'active show' : ''">
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header cursor-pointer">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">Nạp tiền tài khoản</h3>
                        </div>
                        <!--end::Card title-->

                    </div>
                    <!--begin::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body p-9">
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Cổng nạp</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <select class="form-select form-control form-control-solid" v-model="selectMoney" aria-label="Select example">
                                    <option value="bank">Ngân hàng</option>
                                    <option value="momo">Ví momo</option>
                                    <option value="card">Thẻ điện thoại</option>
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Số tiền</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <input type="number" class="form-control form-control-lg form-control-solid" v-model="money" placeholder="Nhập số tiền">
                                <div class="fv-plugins-message-container invalid-feedback"></div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-6">
                            <!--begin::Label-->
                            <label class="col-lg-4 col-form-label required fw-bold fs-6">Giảm giá</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row fv-plugins-icon-container">
                                <select class="form-select form-control form-control-solid" v-model="discount" aria-label="Select example">
                                    <option value="0">0%</option>
                                    <option value="5">5%</option>
                                    <option value="10">10%</option>
                                    <option value="15">15%</option>
                                    <option value="20">20%</option>
                                </select>
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-6 ">
                            <el-button type="primary" :loading="loadbtn"  @click="rechargeData()">{{ loadbtn ? 'Dang Nạp tiền' : 'Nạp tiền' }}</el-button>
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
            </div>
        </div>
    </div>
</template>
<script>

export default {
    data() {
        return {
            activeClass: 'change',
            inputPrice : '',
            level : '1',
            levelText : '',
            name : '',
            email : '',
            image : '',
            phone : '',
            point : '',
            password : '',
            selectMoney : 'bank',
            money : '0',
            discount : '0',
            loadbtn : false
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
                this.activeClass = "change"
            }
            else {
                this.activeClass = "recharge"
            }
        },
        goBack(){
            this.$router.go(-1)
        },
        rechargeData(){
            this.loadbtn = true
            if (this.money == 0){
                this.loadbtn = false
                toastr.error('Số tiền nhập vào phải lớn hơn 0')
            }else {
                let data = {
                    id_user : this.$route.params.id,
                    type : this.selectMoney,
                    amount : this.money,
                    discount : this.discount
                }
                axios.post('/admin/user/dataRecharge', data).then(res => {
                    console.log(res)
                    this.loadbtn = false
                    this.fetchData()
                    if (res.data.status){
                        toastr.success(res.data.message)
                    }
                })
            }
        },
        updateData() {
            let data = {
                id : this.$route.params.id,
                name : this.name,
                email : this.email,
                phone : this.phone,
                password : this.password,
                image : this.image,
                point : this.point,
                level : this.level
            }
                axios.post('/admin/user/update', data).then(res => {
                    if (res.data == true){
                        toastr.success('Cập nhật thông tin tài khoản thành công')
                        this.fetchData()
                    }else {
                        toastr.error('Cập nhật thất bại, tên tài khoản không thể trùng lặp')
                    }
                })

            },
        fetchData() {
            let obj = this
            axios.get('/admin/user/dataChange/' + obj.$route.params.id).then(res => {
                this.name = res.data.data.name
                this.email = res.data.data.email
                this.point = res.data.data.point
                this.phone = res.data.data.phone
                this.image = res.data.data.image
                this.level = res.data.data.level
                this.levelText = res.data.data.level_text
            })
        },

    }
}
</script>

