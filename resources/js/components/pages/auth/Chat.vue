<template>
    <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
        <!--begin::Messenger-->
        <div class="card" >
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Title-->
                <div class="card-title">
                    <!--begin::User-->
                    <div class="d-flex justify-content-center flex-column me-3">
                         <span class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 mb-5 lh-1 symbol symbol-35px symbol-circle">
                            <img alt="Pic" :src="'/storage/'+data.user.image" />
                            {{data.subject}}
                        </span>
                        <!--begin::Info-->
                        <div class="mb-2 lh-1">
                            <span class="badge badge-success badge-circle w-5px h-5px me-1"></span>
                            <span class="fs-7 fw-bold text-gray-900">Mã hỗ trợ :</span>
                            <span class="fs-7 fw-bold text-danger">{{data.code_chat}}</span>
                        </div>
                        <div class="mb-2 lh-1">
                            <span class="badge badge-success badge-circle w-5px h-5px me-1"></span>
                            <span class="fs-7 fw-bold text-gray-900">Loại hỗ trợ :</span>
                            <span class="badge my-1" :class="data.class_service">{{data.service}}</span>
                        </div>
                        <div class="mb-2 lh-1">
                            <span class="badge badge-success badge-circle w-5px h-5px me-1"></span>
                            <span class="fs-7 fw-bold text-gray-900">Mô tả :</span>
                            <span class="fs-7 fw-bold p-2 rounded bg-light-primary text-dark fw-bold mw-lg-400px text-end">{{data.description}}</span>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::User-->
                </div>
                <!--end::Title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Menu-->
                    <button type="submit" class="btn btn-sm" :class="data.status == 2 ? 'btn-success' : 'btn-danger'" @click="updateStatus(data.status == 1 ? 2 : 1)">{{data.status == 2 ? "Mở lại hỗ trợ" : "Đóng hỗ trợ"}}</button>
                    <!--end::Menu-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div v-if="dataChat.length == 0">
                <p class="text-center py-12 mt-5 text-gray-400">Không có dữ liệu</p>
            </div>
            <div v-else class="card-body scroll-y h-300px">
                <!--begin::Messages-->
                <div class="scroll-y me-n5 pe-5 h-300px h-lg-auto" data-kt-element="messages" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_header, #kt_toolbar, #kt_footer, #kt_chat_messenger_header, #kt_chat_messenger_footer" data-kt-scroll-wrappers="#kt_content, #kt_chat_messenger_body" data-kt-scroll-offset="5px">
                    <!--begin::Message(in)-->
                    <div v-for="itemChat in dataChat" :key="itemChat.id">
                        <div class="d-flex mb-10" :class="itemChat.id_user == idActive ? 'justify-content-end' : 'justify-content-start'">
                        <!--begin::Wrapper-->
                            <div v-if="itemChat.id_user == idActive" class="d-flex flex-column align-items-end">
                                <!--begin::User-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Details-->
                                    <div class="me-3">
                                        <span class="text-muted fs-7 mb-1">{{timeAgo(itemChat.created_at)}}</span>
                                        <span v-if="itemChat.id_user == idActive" class="fs-5 fw-bolder text-gray-900 text-hover-primary ms-1">
                                            Bạn
                                        </span>
                                        <span v-else class="fs-5 fw-bolder text-gray-900 text-hover-primary ms-1">
                                            {{itemChat.user.name}}
                                        </span>

                                    </div>
                                    <!--end::Details-->
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <img alt="Pic" :src="'/storage/'+itemChat.user.image" />
                                    </div>
                                    <!--end::Avatar-->
                                </div>
                                <!--end::User-->
                                <!--begin::Text-->
                                <div class="p-5 rounded bg-light-primary text-dark fw-bold mw-lg-400px text-end" data-kt-element="message-text">
                                    {{itemChat.message}}
                                </div>
                                <!--end::Text-->
                            </div>
                            <div v-else class="d-flex flex-column align-items-start">
                                <!--begin::User-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Avatar-->
                                    <div class="symbol symbol-35px symbol-circle">
                                        <img alt="Pic" :src="'/storage/'+itemChat.user.image" />
                                    </div>
                                    <!--end::Avatar-->
                                    <!--begin::Details-->
                                    <div class="ms-3">
                                        <span v-if="itemChat.id_user == idActive" class="fs-5 fw-bolder text-gray-900 text-hover-primary ms-1">
                                            Bạn
                                        </span>
                                        <span v-else class="fs-5 fw-bolder text-gray-900 text-hover-primary ms-1">
                                            {{itemChat.user.name}}
                                        </span>
                                        <span class="text-muted fs-7 mb-1">{{timeAgo(itemChat.created_at)}}</span>
                                    </div>
                                    <!--end::Details-->
                                </div>
                                <!--end::User-->
                                <!--begin::Text-->
                                <div class="p-5 rounded bg-light-info text-dark fw-bold mw-lg-400px text-start" data-kt-element="message-text">
                                    {{itemChat.message}}
                                </div>
                                <!--end::Text-->
                            </div>
                        <!--end::Wrapper-->
                        </div>
                    </div>
                    <!--end::Message(in)-->

                </div>
                <!--end::Messages-->
            </div>
            <!--end::Card body-->
            <!--begin::Card footer-->
            <div v-if="data.status == 2"></div>
            <div v-else class="card-footer pt-4" >
                <!--begin::Input-->
                <textarea class="form-control form-control-flush mb-3" v-model="message" rows="1" data-kt-element="input" placeholder="Gõ một tin nhắn"></textarea>
                <!--end::Input-->
                <!--begin:Toolbar-->
                <div class="d-flex flex-stack">
                    <!--begin::Actions-->
                    <div class="d-flex align-items-center me-2">
                        <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip" title="Coming soon">
                            <i class="bi bi-paperclip fs-3"></i>
                        </button>
                        <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip" title="Coming soon">
                            <i class="bi bi-upload fs-3"></i>
                        </button>
                    </div>
                    <!--end::Actions-->
                    <!--begin::Send-->
                    <button class="btn btn-primary" type="button" data-kt-element="Gửi" @click="sendMess()">Gửi</button>
                    <!--end::Send-->
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Card footer-->
        </div>
        <!--end::Messenger-->
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
            isResult: false,
            isLoading: false,
            isDisabled: false,
            data: Object,
            dataChat: Object,
            idActive : '',
            message : '',
            loadingTable: true,
            spinActive: false,
            loading_t: false,
        }
    },
    created() {
        this.fetchData()
    },
    methods: {
        fetchData() {
            let obj = this
            axios.get('/support/data/' + obj.$route.params.code).then(res => {
                if (res.data.status == false) {
                    obj.$router.go(-1)
                    toastr.error(res.data.message)
                }
                else {
                    obj.data = res.data.data
                    obj.dataChat = res.data.dataChat
                    obj.idActive = res.data.id_active
                }
            })
        },
        sendMess(){
            let obj = this
            if (obj.message == ""){
                toastr.error('Vui lòng không để trống phần nội dung tin nhắn!')
            }
            else {
                let data = {
                    'id_user': obj.idActive,
                    'code_chat': obj.data.code_chat,
                    'message': obj.message
                }
                try {
                    axios.post('/support/sendMess',data)
                    obj.fetchData()
                    toastr.success('Gửi tin nhắn thành công')
                }catch (error){
                    toastr.error(error)
                }


            }
        },
        updateStatus(status){
            let obj = this
            let data = {
                'status' : status,
                'id' : obj.data.id
            }
            try {
                axios.post('/support/update', data)
                obj.$router.go()
                toastr.success('Bạn vừa cập nhật trạng thái hỗ trợ thành công')
            }catch (error){
                toastr.error(error)
            }
        }

    }
}
</script>
