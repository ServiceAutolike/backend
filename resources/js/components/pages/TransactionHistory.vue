<template>
    <div>ABC</div>
</template>

<script>
export default {
    data() {
        return {
            historyServices: Object,
            loading: false,
            pagination: {
                'current_page': 1
            },
            pagination_payout: {
                'current_page': 1
            },
        }
    },
    created () {
        this.fetchData()
    },
    watch: {
        $route: {
            immediate: true,
            handler(to, from) {
                document.title = 'Transaction history';
            }
        },
    },
    methods : {
        fetchData() {
            let obj = this
            axios.post('/facebook/history/like?page=' + obj.pagination.current_page).then(res => {
                obj.historyDatas = res.data.historyServices.data.data
                obj.pagination = res.data.historyServices.pagination;
            })
        },
    }
}
</script>
