@extends('layout.index')
@section('title', 'Dashboard')
@section('content')
    <div class="container-fluid px-0 mt-4">
        <div class="row">
            <div class="col-12 col-xl-7 mb-4">
                <div class="row">
                    <div class="col-12 col-xxl-4">
                        <div class="row">
                            <div class="col-sm-6 col-md-6">
                                <div class="card mb-4 rounded-12 shadow border border-gray-50">
                                    <div class="card-body p-3 px-xxl-4">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="badge badge-size-xl rounded-24 py-2 bg-pink-50 text-gray-600"><img src="https://fabrx.co/preview/muse-dashboard/assets/svg/icons/wallet.svg" alt="Wallet" /></span>
                                            </div>
                                            <div class="col">
                                                <span class="caption text-gray-600 d-block mb-1">Revenue</span>
                                                <span class="h3 mb-0">$6,443</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="card mb-4 rounded-12 shadow border border-gray-50">
                                    <div class="card-body p-3 px-xxl-4">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="badge badge-size-xl rounded-24 py-2 bg-cyan-50 text-gray-600"><img src="https://fabrx.co/preview/muse-dashboard/assets/svg/icons/goals.svg" alt="Wallet" /></span>
                                            </div>
                                            <div class="col">
                                                <span class="caption text-gray-600 d-block mb-1">Goals</span>
                                                <span class="h3 mb-0">95.6%</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="card mb-4 rounded-12 shadow border border-gray-50">
                                    <div class="card-body p-3 px-xxl-4">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                            <span class="badge badge-size-xl rounded-24 py-2 bg-yellow-50 text-gray-600">
                                                                <img src="https://fabrx.co/preview/muse-dashboard/assets/svg/icons/profile-visits.svg" alt="Wallet" />
                                                            </span>
                                            </div>
                                            <div class="col">
                                                <span class="caption text-gray-600 d-block mb-1">Profile Visits</span>
                                                <span class="h3 mb-0">116,443</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-12 col-xl-5 mb-4">
                <div class="row">
                    <div class="col-md-6 col-lg-12 col-xl-6 col-xxl-3">
                        <div class="card mb-4 rounded-12 shadow">
                            <div class="card-body p-3 p-xl-3 p-xxl-4">
                                <div class="row align-items-center">
                                    <div class="col-5 col-xxl-6">
                                        <span class="caption text-gray-600 d-block mb-1">Page views</span>
                                        <span class="h3 mb-0">37,543</span>
                                        <span class="d-block fs-11 mt-2 font-weight-semibold">
                                                <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 16 16">
                                                    <g data-name="icons/tabler/trend-up" transform="translate(0)">
                                                        <rect data-name="Icons/Tabler/Trend background" width="16" height="16" fill="none" />
                                                        <path
                                                            d="M.249,9.315.18,9.256a.616.616,0,0,1-.059-.8L.18,8.385,5.1,3.462A.616.616,0,0,1,5.9,3.4l.068.059L8.821,6.309,13.9,1.231H9.641A.616.616,0,0,1,9.031.7L9.025.616a.617.617,0,0,1,.532-.61L9.641,0h5.728a.614.614,0,0,1,.569.346h0l0,.008,0,.008h0a.613.613,0,0,1,.048.168V.541A.621.621,0,0,1,16,.61V6.359a.616.616,0,0,1-1.226.083l-.005-.083V2.1L9.256,7.615a.616.616,0,0,1-.8.059l-.069-.059L5.539,4.768,1.05,9.256a.615.615,0,0,1-.8.059Z"
                                                            transform="translate(0 3)"
                                                            fill="#20C997"
                                                        />
                                                    </g>
                                                </svg>
                                                12.54
                                            </span>
                                    </div>
                                    <div class="col-7 col-xxl-6 px-xxl-0">
                                        <div id="MuzeDoubleLine"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-12 col-xl-6 col-xxl-3">
                        <div class="card mb-4 rounded-12 shadow">
                            <div class="card-body p-3 p-xl-3 p-xxl-4">
                                <div class="row align-items-center">
                                    <div class="col-5 col-xxl-6">
                                        <span class="caption text-gray-600 d-block mb-1">Users</span>
                                        <span class="h3 mb-0">6,443</span>
                                        <span class="d-block fs-11 mt-2 font-weight-semibold">
                                                <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                                    <g data-name="Icons/Tabler/Trend down" transform="translate(0)">
                                                        <rect data-name="Icons/Tabler/Trend down background" width="14" height="14" fill="none" />
                                                        <path
                                                            d="M.218.106.158.158a.539.539,0,0,0-.052.7L.158.919,4.465,5.227a.539.539,0,0,0,.7.052l.06-.052L7.718,2.736l4.443,4.443H8.436a.539.539,0,0,0-.533.465L7.9,7.718a.54.54,0,0,0,.465.534l.073,0h5.012a.537.537,0,0,0,.5-.3h0l0-.007,0-.007h0A.537.537,0,0,0,14,7.791V7.783a.544.544,0,0,0,0-.06V2.692a.539.539,0,0,0-1.073-.072l0,.072V6.418L8.1,1.593a.539.539,0,0,0-.7-.052l-.061.052L4.846,4.084.919.158a.538.538,0,0,0-.7-.052Z"
                                                            transform="translate(0 2.625)"
                                                            fill="#e25563"
                                                        />
                                                    </g>
                                                </svg>
                                                -10.45
                                            </span>
                                    </div>
                                    <div class="col-7 col-xxl-6 pe-xxl-0">
                                        <div id="MuzeSingleLine"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-12 col-xl-6 col-xxl-3">
                        <div class="card mb-4 rounded-12 shadow">
                            <div class="card-body p-3 p-xl-3 p-xxl-4">
                                <div class="row align-items-center">
                                    <div class="col-5 col-xxl-6">
                                        <span class="caption text-gray-600 d-block mb-1">Goals</span>
                                        <span class="h3 mb-0">50.1%</span>
                                        <span class="d-block fs-11 mt-2 font-weight-semibold">
                                                <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 16 16">
                                                    <g data-name="icons/tabler/trend-up" transform="translate(0)">
                                                        <rect data-name="Icons/Tabler/Trend background" width="16" height="16" fill="none" />
                                                        <path
                                                            d="M.249,9.315.18,9.256a.616.616,0,0,1-.059-.8L.18,8.385,5.1,3.462A.616.616,0,0,1,5.9,3.4l.068.059L8.821,6.309,13.9,1.231H9.641A.616.616,0,0,1,9.031.7L9.025.616a.617.617,0,0,1,.532-.61L9.641,0h5.728a.614.614,0,0,1,.569.346h0l0,.008,0,.008h0a.613.613,0,0,1,.048.168V.541A.621.621,0,0,1,16,.61V6.359a.616.616,0,0,1-1.226.083l-.005-.083V2.1L9.256,7.615a.616.616,0,0,1-.8.059l-.069-.059L5.539,4.768,1.05,9.256a.615.615,0,0,1-.8.059Z"
                                                            transform="translate(0 3)"
                                                            fill="#20C997"
                                                        />
                                                    </g>
                                                </svg>
                                                2.7%
                                            </span>
                                    </div>
                                    <div class="col-7 col-xxl-6 pe-xxl-0">
                                        <div id="MuzeSimpleDonut"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-12 col-xl-6 col-xxl-3">
                        <div class="card mb-4 rounded-12 shadow">
                            <div class="card-body p-3 p-xl-3 p-xxl-4">
                                <div class="row align-items-center">
                                    <div class="col-5 col-xxl-6">
                                        <span class="caption text-gray-600 d-block mb-1">Avg. time</span>
                                        <span class="h3 mb-0">04:20</span>
                                        <span class="d-block fs-11 mt-2 font-weight-semibold">
                                                <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14">
                                                    <g data-name="Icons/Tabler/Trend down" transform="translate(0)">
                                                        <rect data-name="Icons/Tabler/Trend down background" width="14" height="14" fill="none" />
                                                        <path
                                                            d="M.218.106.158.158a.539.539,0,0,0-.052.7L.158.919,4.465,5.227a.539.539,0,0,0,.7.052l.06-.052L7.718,2.736l4.443,4.443H8.436a.539.539,0,0,0-.533.465L7.9,7.718a.54.54,0,0,0,.465.534l.073,0h5.012a.537.537,0,0,0,.5-.3h0l0-.007,0-.007h0A.537.537,0,0,0,14,7.791V7.783a.544.544,0,0,0,0-.06V2.692a.539.539,0,0,0-1.073-.072l0,.072V6.418L8.1,1.593a.539.539,0,0,0-.7-.052l-.061.052L4.846,4.084.919.158a.538.538,0,0,0-.7-.052Z"
                                                            transform="translate(0 2.625)"
                                                            fill="#FD7E14"
                                                        />
                                                    </g>
                                                </svg>
                                                -0.04%
                                            </span>
                                    </div>
                                    <div class="col-7 col-xxl-6 pe-xxl-0">
                                        <div id="MuzeColumnsChartTwo"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
