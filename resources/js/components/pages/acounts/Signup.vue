<template>
    <!--begin::Wrapper-->
    <div class="w-lg-600px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
        <!--begin::Form-->
        <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form">
            <!--begin::Heading-->
            <div class="mb-10 text-center">
                <!--begin::Title-->
                <h1 class="text-dark mb-3">Tạo một tài khoản</h1>
                <!--end::Title-->
                <!--begin::Link-->
                <div class="text-gray-400 fw-bold fs-5">Bạn đã có tài khoản?
                    <router-link to="/account/login" class="link-primary fw-bolder">Đăng nhập tại đây</router-link></div>
                <!--end::Link-->
            </div>
            <!--end::Heading-->
            <!--begin::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <label class="form-label fw-bolder text-dark fs-6">Tên đăng nhập</label>
                <input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="email" autocomplete="off" />
            </div>
            <!--end::Input group-->
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <label class="form-label fw-bolder text-dark fs-6">Email</label>
                <input class="form-control form-control-lg form-control-solid" type="email" placeholder="" name="email" autocomplete="off" />
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="mb-10 fv-row" data-kt-password-meter="true">
                <!--begin::Wrapper-->
                <div class="mb-1">
                    <!--begin::Label-->
                    <label class="form-label fw-bolder text-dark fs-6">Mật khẩu</label>
                    <!--end::Label-->
                    <!--begin::Input wrapper-->
                    <div class="position-relative mb-3">
                        <input class="form-control form-control-lg form-control-solid" type="password" placeholder="" name="password" autocomplete="off" />
                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                            <i class="bi bi-eye-slash fs-2"></i>
                            <i class="bi bi-eye fs-2 d-none"></i>
                        </span>
                    </div>
                    <!--end::Input wrapper-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Hint-->
                <div class="text-muted">Use 8 or more characters with a mix of letters, numbers &amp; symbols.</div>
                <!--end::Hint-->
            </div>
            <!--end::Input group=-->
            <!--begin::Input group-->
            <div class="fv-row mb-5">
                <label class="form-label fw-bolder text-dark fs-6">Số điện thoại</label>
                <input class="form-control form-control-lg form-control-solid" type="text" placeholder="" name="confirm-password" autocomplete="off" />
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-10">
                <label class="form-check form-check-custom form-check-solid form-check-inline">
                    <input class="form-check-input" type="checkbox" name="toc" value="1" />
                    <span class="form-check-label fw-bold text-gray-700 fs-6">Đồng ý
									<a href="#" class="ms-1 link-primary">Các điều khoản tại Autolike</a>.</span>
                </label>
            </div>
            <!--end::Input group-->
            <!--begin::Actions-->
            <div class="text-center">
                <button type="button" class="btn btn-lg btn-primary" @click="RegisterAccount()">
                    <span class="indicator-label">Đăng ký</span>
                    <span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Wrapper-->
</template>
<script>

export default {
    data() {
        return {
            name : '',
            email : '',
            password : '',
            phone : '',
            mess: '',
        }
    },
    // watch: {
    //     email(value){
    //         this.email = value;
    //         this.validateEmail(value);
    //     },
    //     password(value){
    //         this.password = value;
    //         this.validatePass(value);
    //     }
    // },
    methods: {
        // validateEmail(value) {
        //     if (value.length == ''){
        //         this.mess['email'] = 'Không để trống trường này'
        //     }else {
        //         this.mess['email'] = ''
        //     }
        // },
        // validatePass(value) {
        //     if (value.length == ''){
        //         this.mess['pass'] = 'Không để trống trường này'
        //     }else {
        //         this.mess['pass'] = ''
        //     }
        // },
        RegisterAccount(){
            const obj = this
            obj.checkEmail = true
            obj.checkPass = true
            let data = {
                email: obj.email,
                password: obj.password
            }
            axios.post('/account/loginData',data).then(res => {
                if (!res.data.status){
                    toastr.error(res.data.message)
                }else {
                    window.location.href = '/home'
                    toastr.success('Đăng nhập thành công!')
                }
            })
        }
    }
}
</script>
