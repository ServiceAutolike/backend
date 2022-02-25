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
                <label class="form-label fw-bolder text-dark fs-6">Tên tài khoản</label>
                <input class="form-control form-control-lg form-control-solid" type="text" v-model="name" autocomplete="off" />
                <p v-if="mess.name" class="text-danger p-2">{{ mess.name }}</p>
                <p v-if="!checkName" class="text-danger p-2">Không để trống trường tên tài khoản</p>
                <p v-if="uniqueName" class="text-danger p-2">{{uniqueName}}</p>
            </div>
            <!--end::Input group-->
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-7">
                <label class="form-label fw-bolder text-dark fs-6">Email</label>
                <input class="form-control form-control-lg form-control-solid" type="email" v-model="email" autocomplete="off" />
                <p v-if="mess.email" class="text-danger p-2">{{ mess.email }}</p>
                <p v-if="!checkEmail" class="text-danger p-2">Không để trống trường email</p>
                <p v-if="uniqueEmail" class="text-danger p-2">{{uniqueEmail}}</p>
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
                        <input class="form-control form-control-lg form-control-solid" type="password" v-model="password" autocomplete="off" />
                        <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                            <i class="bi bi-eye-slash fs-2"></i>
                            <i class="bi bi-eye fs-2 d-none"></i>
                        </span>
                    </div>
                    <p v-if="mess.pass" class="text-danger p-2">{{ mess.pass }}</p>
                    <p v-if="!checkPass" class="text-danger p-2">Không để trống trường mật khẩu</p>
                    <!--end::Input wrapper-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Input group=-->
            <!--begin::Input group-->
            <div class="fv-row mb-5">
                <label class="form-label fw-bolder text-dark fs-6">Số điện thoại</label>
                <input class="form-control form-control-lg form-control-solid" type="text" v-model="phone" autocomplete="off"/>
                <p v-if="mess.phone" class="text-danger p-2">{{ mess.phone }}</p>
                <p v-if="!checkPhone" class="text-danger p-2">Không để trống trường số điện thoại</p>
                <p v-if="uniquePhone" class="text-danger p-2">{{uniquePhone}}</p>
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-10">
                <label class="form-check form-check-custom form-check-solid form-check-inline">
                    <input class="form-check-input" type="checkbox" name="toc" value="1" />
                    <span class="form-check-label fw-bold text-gray-700 fs-6">Tôi đồng ý
									<a href="#" class="ms-1 link-primary">Các điều khoản tại Autolike</a>.</span>
                </label>
            </div>
            <!--end::Input group-->
            <!--begin::Actions-->
            <div class="text-center">
                <button type="button" class="btn btn-lg btn-primary" @click="RegisterAccount()" v-loading.fullscreen.lock="Loading">
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
            checkName : true,
            uniqueName : '',
            email : '',
            checkEmail : true,
            uniqueEmail : '',
            password : '',
            checkPass : true,
            phone : '',
            checkPhone : true,
            uniquePhone : '',
            mess: [],
            Loading: false
        }
    },
    watch: {
        name(value){
            this.checkName = true
            this.name = value
            this.validateName(value)
        },
        email(value){
            this.checkEmail = true
            this.email = value
            this.validateEmail(value)
        },
        password(value){
            this.checkPass = true
            this.password = value
            this.validatePass(value)
        },
        phone(value){
            this.checkPhone = true
            this.phone = value
            this.validatePhone(value)
        }
    },
    methods: {
        validateName(value) {
            if (/^[a-zA-Z0-9]+$/.test(value)) {
                this.mess['name'] = ''
                let data = {
                    name : value
                }
                axios.post('/account/registerName', data).then(res => {
                    if (res.data){
                        this.uniqueName = ''
                    }else{
                        this.uniqueName = 'Tên tài khoản đã tồn tại, vui lòng nhập tên tài khoản chưa đăng ký'
                    }
                })
            }
            else {
                this.uniqueName = ''
                this.mess['name'] = 'Tên tài khoản không hợp lệ'
            }
        },
        validateEmail(value) {
            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value)){
                this.mess['email'] = ''
                let data = {
                    email : value
                }
                axios.post('/account/registerEmail', data).then(res => {
                    if (res.data){
                        this.uniqueEmail = ''
                    }else{
                        this.uniqueEmail = 'Email đã tồn tại, vui lòng nhập email chưa đăng ký'
                    }
                })
            } else{
                this.uniqueEmail = ''
                this.mess['email'] = 'Địa chỉ email không hợp lệ'
            }
        },
        validatePass(value) {
            if (value.length < 6){
                this.mess['pass'] = 'Độ dài mật khẩu phải lớn hơn 6 kí tự'
            }else {
                this.mess['pass'] = ''
            }
        },
        validatePhone(value){
            if (/^(1\s|1|)?((\(\d{3}\))|\d{3})(\-|\s)?(\d{3})(\-|\s)?(\d{4})$/.test(value)){
                this.mess['phone'] = ''
                let data = {
                    phone : value
                }
                axios.post('/account/registerPhone', data).then(res => {
                    if (res.data){
                        this.uniquePhone = ''
                    }else{
                        this.uniquePhone = 'Số điện thoại đã tồn tại, vui lòng nhập số điện thoại chưa đăng ký'
                    }
                })
            }else {
                this.uniquePhone = ''
                this.mess['phone'] = 'Số điện thoại không hợp lệ'
            }
        },
        RegisterAccount(){
            const obj = this
            if (obj.mess['name'] || obj.mess['email'] || obj.mess['pass'] || obj.mess['phone']){
                toastr.error('Vui lòng nhập hợp lệ các trường yêu cầu')
            }else if(obj.uniqueEmail != '' || obj.uniquePhone != '' || obj.uniqueName != ''){
                toastr.error('Vui lòng nhập hợp lệ các trường yêu cầu')
            }else {
                if (obj.name == '' && obj.email == '' && obj.password == '' && obj.phone == ''){
                    obj.checkName = false
                    obj.checkEmail = false
                    obj.checkPass = false
                    obj.checkPhone = false
                }else if(obj.name == ''){
                    obj.checkName = false
                }else if(obj.email == ''){
                    obj.checkEmail = false
                }else if(obj.password == ''){
                    obj.checkPass = false
                }else if(obj.phone == ''){
                    obj.checkPhone = false
                }
                else {
                    let data = {
                        name: obj.name,
                        email: obj.email,
                        password: obj.password,
                        phone: obj.phone
                    }
                    axios.post('/account/registerData', data).then(res => {
                        if (res.data){
                            obj.Loading = true;
                            setTimeout(() => {
                                obj.Loading = false;
                                toastr.success('Đăng ký tài khoản thành công')
                            }, 500);
                        }
                    })
                }
            }
        }
    }
}
</script>
