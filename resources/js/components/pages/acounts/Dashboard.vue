<template>

    <div class="row g-5 g-xl-8">

        <!--begin::Col-->
        <div class="col-xl-7">
            <!--begin::Feeds Widget 2-->
            <div id="post">
                <div class="card mb-5 mb-xl-8" v-for="getpostData in dataPost" :key="getpostData.id">
                    <!--begin::Body-->
                    <LoadingPage v-if="loading"></LoadingPage>
                    <div v-else class="card-body pb-0">
                        <!--begin::Header-->
                        <div class="d-flex align-items-center mb-5">
                            <!--begin::User-->
                            <div class="d-flex align-items-center flex-grow-1">
                                <!--begin::Avatar-->
                                <div class="symbol symbol-45px me-5">
                                    <img src="/avatar/img_avatar.png" alt="" />
                                </div>
                                <!--end::Avatar-->
                                <!--begin::Info-->
                                <div class="d-flex flex-column">
                                    <a class="text-gray-900 text-hover-primary fs-6 fw-bolder">Quản Trị Viên</a>
                                    <span class="text-gray-400 fw-bold">{{ timeAgo(getpostData.created_at) }}</span>
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::User-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Post-->
                        <div class="mb-5">
                            <!--begin::Text-->
                            <!--                            <div v-if="hasImage">-->
                            <!--                                <img src="" alt="" style="width:100%" class="rounded mb-4">-->
                            <!--                            </div>-->
                            <!--                            <div v-else>-->
                            <!--                                Không có ảnh-->
                            <!--                            </div>-->
                            <p v-html="getpostData.content" class="text-gray-800 fw-normal mb-5">
                                {{ getpostData.content }}
                            </p>
                            <!--end::Text-->

                        </div>
                        <!--end::Post-->
                    </div>
                    <!--end::Body-->
                </div>
                <div class="loadmore" v-if="hide">
                    <infinite-loading @distance="1" @infinite="handleLoadMore"></infinite-loading>
                </div>

            </div>

            <!--end::Feeds widget 4, 5 load more-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-5">
            <div class="card mb-5 mb-xl-8">
                <!--begin::Body-->
                <LoadingPage v-if="loading"></LoadingPage>
                <div v-else class="card-body p-0">
                    <!--begin::Header-->
                    <div class="px-9 pt-7 card-rounded h-275px w-100 bg-success">
                        <!--begin::Heading-->
                        <div class="d-flex flex-stack">
                            <h3 class="m-0 text-white fw-bolder fs-3">Tài Khoản</h3>
                            <div class="ms-1">
                                <!--begin::Menu-->
                                <button type="button" class="btn btn-sm btn-icon btn-color-white btn-active-white btn-active-color-success border-0 me-n3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                    <span class="svg-icon svg-icon-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="5" y="5" width="5" height="5" rx="1" fill="#000000"></rect>
                                                <rect x="14" y="5" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                                <rect x="5" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                                <rect x="14" y="14" width="5" height="5" rx="1" fill="#000000" opacity="0.3"></rect>
                                            </g>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </button>
                                <!--begin::Menu 3-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-bold w-200px py-3" data-kt-menu="true">
                                    <!--begin::Heading-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Nạp Tiền</div>
                                    </div>
                                    <!--end::Heading-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Thẻ Ngân Hàng</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link flex-stack px-3">
                                            Nạp Ví Momo
                                        </a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">Thẻ Cào Điện Thoại</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3 my-1">
                                        <a href="#" class="menu-link px-3">Lịch Sử Nạp Tiền</a>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu 3-->
                                <!--end::Menu-->
                            </div>
                        </div>
                        <!--end::Heading-->
                        <!--begin::Balance-->
                        <div class="d-flex text-center flex-column text-white pt-8">
                            <span class="fw-bold fs-7">Số Dư Hiện Tại</span>
                            <span class="fw-bolder fs-2x pt-1">{{ formatNumber(dataUser.point) }} VNĐ</span>
                        </div>
                        <!--end::Balance-->
                    </div>
                    <!--end::Header-->
                    <!--begin::Items-->
                    <div class="bg-body shadow-sm card-rounded mx-9 mb-9 px-6 py-9 position-relative z-index-1" style="margin-top: -100px;">
                        <!--begin::Item-->
                        <div class="d-flex align-items-center mb-6">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45px w-40px me-5">
                    <span class="symbol-label bg-lighten">
                        <!--begin::Svg Icon | path: icons/duotune/maps/map004.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M18.4 5.59998C21.9 9.09998 21.9 14.8 18.4 18.3C14.9 21.8 9.2 21.8 5.7 18.3L18.4 5.59998Z" fill="black"></path>
                                <path
                                    d="M12 2C6.5 2 2 6.5 2 12C2 17.5 6.5 22 12 22C17.5 22 22 17.5 22 12C22 6.5 17.5 2 12 2ZM19.9 11H13V8.8999C14.9 8.6999 16.7 8.00005 18.1 6.80005C19.1 8.00005 19.7 9.4 19.9 11ZM11 19.8999C9.7 19.6999 8.39999 19.2 7.39999 18.5C8.49999 17.7 9.7 17.2001 11 17.1001V19.8999ZM5.89999 6.90002C7.39999 8.10002 9.2 8.8 11 9V11.1001H4.10001C4.30001 9.4001 4.89999 8.00002 5.89999 6.90002ZM7.39999 5.5C8.49999 4.7 9.7 4.19998 11 4.09998V7C9.7 6.8 8.39999 6.3 7.39999 5.5ZM13 17.1001C14.3 17.3001 15.6 17.8 16.6 18.5C15.5 19.3 14.3 19.7999 13 19.8999V17.1001ZM13 4.09998C14.3 4.29998 15.6 4.8 16.6 5.5C15.5 6.3 14.3 6.80002 13 6.90002V4.09998ZM4.10001 13H11V15.1001C9.1 15.3001 7.29999 16 5.89999 17.2C4.89999 16 4.30001 14.6 4.10001 13ZM18.1 17.1001C16.6 15.9001 14.8 15.2 13 15V12.8999H19.9C19.7 14.5999 19.1 16.0001 18.1 17.1001Z"
                                    fill="black"
                                ></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Description-->
                            <div class="d-flex align-items-center flex-wrap w-100">
                                <!--begin::Title-->
                                <div class="mb-1 pe-3 flex-grow-1">
                                    <span class="fs-5 text-gray-800 text-hover-primary fw-bolder">Tổng Nạp</span>
                                </div>
                                <!--end::Title-->
                                <!--begin::Label-->
                                <div class="d-flex align-items-center">
                                    <div class="fw-bolder fs-5 text-gray-800 pe-1">{{ formatNumber(total_recharge) }} VNĐ</div>
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                    <span class="svg-icon svg-icon-5 svg-icon-success ms-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black"></rect>
                                            <path
                                                d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                                fill="black"
                                            ></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center mb-6">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45px w-40px me-5">
                    <span class="symbol-label bg-lighten">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect x="2" y="2" width="9" height="9" rx="2" fill="black"></rect>
                                <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black"></rect>
                                <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black"></rect>
                                <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black"></rect>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Description-->
                            <div class="d-flex align-items-center flex-wrap w-100">
                                <!--begin::Title-->
                                <div class="mb-1 pe-3 flex-grow-1">
                                    <span class="fs-5 text-gray-800 text-hover-primary fw-bolder">Tháng Này</span>
                                </div>
                                <!--end::Title-->
                                <!--begin::Label-->
                                <div class="d-flex align-items-center">
                                    <div class="fw-bolder fs-5 text-gray-800 pe-1">{{ formatNumber(total_recharge_month) }} VNĐ</div>
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
                                    <span class="svg-icon svg-icon-5 svg-icon-danger ms-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="11" y="18" width="13" height="2" rx="1" transform="rotate(-90 11 18)" fill="black"></rect>
                                            <path
                                                d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z"
                                                fill="black"
                                            ></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center mb-6">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45px w-40px me-5">
                                <span class="symbol-label bg-lighten">
                                    <!--begin::Svg Icon | path: icons/duotune/electronics/elc005.svg-->
                                    <span class="svg-icon svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.3" d="M15 19H7C5.9 19 5 18.1 5 17V7C5 5.9 5.9 5 7 5H15C16.1 5 17 5.9 17 7V17C17 18.1 16.1 19 15 19Z" fill="black"></path>
                                            <path
                                                d="M8.5 2H13.4C14 2 14.5 2.4 14.6 3L14.9 5H6.89999L7.2 3C7.4 2.4 7.9 2 8.5 2ZM7.3 21C7.4 21.6 7.9 22 8.5 22H13.4C14 22 14.5 21.6 14.6 21L14.9 19H6.89999L7.3 21ZM18.3 10.2C18.5 9.39995 18.5 8.49995 18.3 7.69995C18.2 7.29995 17.8 6.90002 17.3 6.90002H17V10.9H17.3C17.8 11 18.2 10.7 18.3 10.2Z"
                                                fill="black"
                                            ></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Description-->
                            <div class="d-flex align-items-center flex-wrap w-100">
                                <!--begin::Title-->
                                <div class="mb-1 pe-3 flex-grow-1">
                                    <span class="fs-5 text-gray-800 text-hover-primary fw-bolder">Đã Chi Tiêu</span>
                                </div>
                                <!--end::Title-->
                                <!--begin::Label-->
                                <div class="d-flex align-items-center">
                                    <div class="fw-bolder fs-5 text-gray-800 pe-1">0 VNĐ</div>
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                    <span class="svg-icon svg-icon-5 svg-icon-success ms-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="black"></rect>
                                            <path
                                                d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                                fill="black"
                                            ></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <div class="d-flex align-items-center">
                            <!--begin::Symbol-->
                            <div class="symbol symbol-45px w-40px me-5">
                                <span class="symbol-label bg-lighten">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen005.svg-->
                                    <span class="svg-icon svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path
                                                opacity="0.3"
                                                d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z"
                                                fill="black"
                                            ></path>
                                            <rect x="7" y="17" width="6" height="2" rx="1" fill="black"></rect>
                                            <rect x="7" y="12" width="10" height="2" rx="1" fill="black"></rect>
                                            <rect x="7" y="7" width="6" height="2" rx="1" fill="black"></rect>
                                            <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black"></path>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </span>
                            </div>
                            <!--end::Symbol-->
                            <!--begin::Description-->
                            <div class="d-flex align-items-center flex-wrap w-100">
                                <!--begin::Title-->
                                <div class="mb-1 pe-3 flex-grow-1">
                                    <span class="fs-5 text-gray-800 text-hover-primary fw-bolder">Cấp Độ</span>
                                </div>
                                <!--end::Title-->
                                <!--begin::Label-->
                                <div class="d-flex align-items-center">
                                    <span class="fw-bolder fs-5 pe-1 text-warning">Thành Viên</span>
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Description-->
                        </div>
                        <!--end::Item-->
                    </div>
                    <!--end::Items-->
                </div>
                <!--end::Body-->
            </div>



            <div class="card bgi-no-repeat mb-xl-8" style="height: 300px; background-position: right top; background-size: 30% auto; background-image: url('/Backend-Assets/media/svg/shapes//abstract-2.svg')">
                <!--begin::Body-->
                <div class="card-header">
                    <div class="card-title">Thông Báo</div>
                </div>
                <LoadingPage v-if="loading"></LoadingPage>
                <div v-else class="card-body overflow-scroll">
                    <div class="postNoti">
                        <div class="fw-bolder text-primary">03 May 2020</div>
                        <p class="text-gray-800 fw-normal mb-5">Bạn vừa nạp 50,000 VNĐ qua cổng thanh toán Vietcombank</p>
                    </div>

                    <div class="postNoti">
                        <div class="fw-bolder text-primary">03 Jul 2021</div>
                        <p class="text-gray-800 fw-normal mb-5">Bạn vừa tạo dịch vụ Tăng Like Bài Viết với giá 12,000 VNĐ</p>
                    </div>


                </div>
                <!--end::Body-->
            </div>


            <!--- begin Chart -->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Header-->
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">Thống Kê</span>
                    </h3>
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body">
                    <!--begin::Chart-->
                    <div id="kt_charts_widget_2_chart" style="height: 300px"></div>
                    <!--end::Chart-->
                </div>
                <!--end::Body-->
            </div>

            <!--- //end Charts --->

        </div>
        <!--end::Col-->
    </div>
</template>

<script>
export default {
    data() {
        return {
            hasImage: false,
            content: '',
            loading: false,
            dataToShow: {},
            dataPost: [],
            page: 1,
            hide: true,
            dataUser: Object,
            total_recharge: 0,
            total_recharge_month: 0,
            total_recharge_year: 0,
        }
    },
    created() {
        this.loadMe()
        this.loadNotification()
    },
    methods: {
        formatNumber(number) {
            return Intl.NumberFormat().format(number);
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
        loadMe() {
            axios.post('/me').then(res => {
                this.dataUser = res.data.data
                this.desc = "nap "+res.data.data.name
                this.total_recharge = res.data.total_recharge
            }).catch(e => {
                console.log("Error Get Me")
            })
        },
        handleLoadMore($state) {
            this.loading = true
            axios.post('/loadPost', {'page': this.page})
                .then(res => {
                    return res.data;
                })
                .then(res => {
                    $.each(res.data, (key, value) => {
                        this.dataPost.push(value);
                    });
                    if(res.data.length > 0) {
                        $state.loaded();
                    }
                    else {
                        this.hide = false
                    }
                }).catch(e => {
                console.log("Load")
            })
            this.loading = false
            this.page = this.page + 1;
        },

        loadNotification() {
            axios.post('/loadNotification', {'status': 'seen'}).then(res => {
                $.each(res.data, function (key, value) {
                    Swal.fire('Thông Báo', 'Bạn vừa nạp thành công ' + value.amount_end + " VNĐ qua Vietcombank", 'success')
                    axios.post('/updateNofitication', {'id': value.id}).then(res => {
                        console.log(res)

                    }).catch(e => {
                        console.log("err")
                    })


                });

            }).catch(e => {
                console.log("err")
            })
        },
    }
}

</script>
