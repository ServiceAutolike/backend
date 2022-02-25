<template>
    <div class="w-lg-500px bg-body rounded shadow-sm p-10 p-lg-15 mx-auto">
        <form class="form w-100" novalidate="novalidate"  action="#">
            <!--begin::Heading-->
            <div class="text-center mb-10">
                <!--begin::Title-->
                <h1 class="text-dark mb-3">Đăng nhập vào hệ thống Autolike</h1>
                <!--end::Title-->
                <!--begin::Link-->
                <div class="text-gray-400 fw-bold fs-5">Bạn đã có tài khoản chưa?
                    <router-link to="/account/register" class="link-primary fw-bolder">Tạo tài khoản mới</router-link>
                </div>
                <!--end::Link-->
            </div>
            <!--begin::Heading-->
            <!--begin::Input group-->
            <div class="fv-row mb-10">
                <!--begin::Label-->
                <label class="form-label fs-6 fw-bolder text-dark">Email</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input class="form-control form-control-lg form-control-solid" type="text" v-model="email" autocomplete="off" />
                <p v-if="!checkEmail" class="text-danger p-2">Không bỏ trống trường email</p>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="fv-row mb-10">
                <!--begin::Wrapper-->
                <div class="d-flex flex-stack mb-2">
                    <!--begin::Label-->
                    <label class="form-label fw-bolder text-dark fs-6 mb-0">Mật khẩu</label>
                    <!--end::Label-->
                    <!--begin::Link-->
                    <a href="../../demo8/dist/authentication/layouts/basic/password-reset.html" class="link-primary fs-6 fw-bolder">Quên mật khẩu ?</a>
                    <!--end::Link-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Input-->
                <input class="form-control form-control-lg form-control-solid" type="password" v-model="password" autocomplete="off" />
                <p v-if="!checkPass" class="text-danger p-2">Không bỏ trống trường mật khẩu</p>
                <!--end::Input-->
            </div>
            <!--end::Input group-->
            <!--begin::Actions-->
            <div class="text-center">
                <!--begin::Submit button-->
                <button type="button" class="btn btn-lg btn-primary w-100 mb-5" @click="LoginAccount()" v-loading.fullscreen.lock="Loading">
                    <span class="indicator-label">Tiếp tục</span>
                </button>
                <!--end::Submit button-->
            </div>
            <!--end::Actions-->
        </form>
    </div>
</template>
<script>

export default {
    data() {
        return {
            email : '',
            checkEmail : true,
            checkPass : true,
            password : '',
            Loading: false
        }
    },
    methods: {
        LoginAccount(){
            const obj = this
            if (obj.email == '' && obj.password == ''){
                obj.checkEmail = false
                obj.checkPass = false
                toastr.error('Không bỏ trống các trường yêu cầu')
            }else if(!obj.email){
                obj.checkEmail = false
                toastr.error('Không bỏ trống các trường yêu cầu')
            }else if(!obj.password){
                obj.checkPass = false
                toastr.error('Không bỏ trống các trường yêu cầu')
            }
            else {
                obj.checkEmail = true
                obj.checkPass = true
                let data = {
                    email: obj.email,
                    password: obj.password
                }
                axios.post('/account/loginData',data).then(res => {
                    if (!res.data.status){
                        obj.Loading = true;
                        setTimeout(() => {
                            obj.Loading = false;
                            toastr.error(res.data.message)
                        }, 500);
                    }else {
                        obj.Loading = true;
                        setTimeout(() => {
                            obj.Loading = false;
                            window.location.href = '/home'
                        }, 500);
                    }
                })
            }
        }
    }
}
</script>
