<template>
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ title }}</h3>
            </div>
            <!--end::Card title-->
            <div class="card-toolbar">
                <div class="d-flex flex-wrap flex-stack">
                    <!--begin::Controls-->
                    <div class="d-flex my-2">
                        <div class="d-flex align-items-center position-relative me-4">
                            <input type="number" v-model="inputPrice" class="form-control form-control-sm w-150px" placeholder="Nhập số tiền nạp" />
                        </div>
                        <div class="d-flex align-items-center position-relative me-4">
                            <button class="btn btn-bg-dark btn-color-white btn-sm" @click="updatePrice()">Nạp tiền</button>
                        </div>
                        <!--end::Search-->
                    </div>
                    <!--end::Controls-->
                </div>

            </div>
        </div>
        <!--begin::Card header-->
        <!--begin::Content-->
        <div class="collapse show">
            <!--begin::Card body-->
            <div class="card-body border-top p-9">
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-bold fs-6">Cấp độ</label>
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
                <!--end::Input group-->
                <!--begin::Input group-->
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
                                <img width="100%" :src="'/storage/'+image" alt="">
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
                <!--end::Input group-->
            </div>
            <!--end::Card body-->
            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="button" class="btn btn-light btn-active-light-primary me-2" @click="goBack">Trở lại</button>
                <button type="button" class="btn btn-primary" id="kt_account_profile_details_submit" @click="updateData()">Lưu thông tin</button>
            </div>
            <!--end::Actions-->
        </div>
        <!--end::Content-->
    </div>
</template>
<script>

export default {
    data() {
        return {
            inputPrice : '',
            level : '1',
            name : '',
            email : '',
            image : '',
            phone : '',
            point : '',
            password : '',
            title : '',
        }
    },
    created() {
        this.fetchData()
    },
    methods: {
        goBack(){
            this.$router.go(-1)
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
                this.title = res.data.title
                this.name = res.data.data.name
                this.email = res.data.data.email
                this.point = res.data.data.point
                this.phone = res.data.data.phone
                this.image = res.data.data.image
                this.level = res.data.data.level
            })
        },
        updatePrice() {
            let data = {
                id : this.$route.params.id,
                price : this.inputPrice
            }
            if (this.inputPrice == '') {
                toastr.error('Vui lòng không để trống phần nhập số tiền')
            }else {
                try {
                    axios.post('/admin/user/addPrice', data)
                    toastr.success('Nạp tiền thành công')
                    this.fetchData()
                } catch (e) {
                    toastr.error(e)
                }
            }
        },

    }
}
</script>

