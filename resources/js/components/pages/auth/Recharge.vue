<template>
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card mb-5 mb-xxl-10">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Heading-->
                    <div class="card-title">
                        <h3>{{ title }}</h3>
                    </div>
                    <!--end::Heading-->
                    <!--begin::Toolbar-->
                    <div class="card-toolbar">
                        <div class="d-flex flex-wrap flex-stack">
                            <!--begin::Controls-->

                            <!--end::Controls-->
                        </div>

                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body p-0">
                    <LoadingPage v-if="loadingTable"></LoadingPage>
                    <!--begin::Table wrapper-->

                    <!--end::Table wrapper-->
                </div>
                <div class="card-footer">

                </div>
                <!--end::Card body-->
            </div>

        </div>
    </div>
</template>
<script>

export default {
    data() {
        return {
            title : '',
            loadingTable: false,
            dataUser : Object,
        }
    },
    created() {
        this.fetchData()
    },
    methods: {
        fetchData() {
            let obj = this
            axios.get('/admin/user/dataRecharge/' + obj.$route.params.id).then(res => {
                obj.title = res.data.title
                obj.dataUser = res.data.data
                console.log(obj.dataUser)
            })
        },


    }
}
</script>
