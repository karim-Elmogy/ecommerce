@extends('admin.layouts.app')
@section('content')
    <style>
        span.apexcharts-legend-marker{
            left: 4px !important;
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-3 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <div class="avatar flex-shrink-0">
                                <span class="badge bg-label-info p-2">

                                    <i class='bx bx-user'></i> </span>
                                </div>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                    <a class="dropdown-item" href="{{route('admin.users.index')}}">
                                        <i class='bx bx-show-alt'></i>
                                        {{__('dashboard.home.more')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">{{__('dashboard.users.users')}}</span>
                        <h3 class="card-title mb-2">{{$admins}}</h3>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <span class="badge bg-label-info p-2">

                                   <i class='bx bxs-flag-alt'></i> </span>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                    <a class="dropdown-item" href="{{route('admin.category.index')}}">
                                        <i class='bx bx-show-alt'></i>
                                        {{__('dashboard.home.more')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">{{__('dashboard.category.categories')}}</span>
                        <h3 class="card-title mb-2">{{$categories}}</h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <span class="badge bg-label-info p-2">

                                    <i class='bx bx-map'></i> </span>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                    <a class="dropdown-item" href="{{route('admin.city.index')}}">
                                        <i class='bx bx-show-alt'></i>
                                        {{__('dashboard.home.more')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">{{__('dashboard.city.cities')}}</span>
                        <h3 class="card-title mb-2">{{$cities}}</h3>
                    </div>
                </div>
            </div>


            <div class="col-lg-3 col-md-12 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <span class="badge bg-label-info p-2">

                                    <i class='bx bxs-offer'></i> </span>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                    <a class="dropdown-item" href="{{route('admin.offer.index')}}">
                                        <i class='bx bx-show-alt'></i>
                                        {{__('dashboard.home.more')}}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">{{__('dashboard.offer.offers')}}</span>
                        <h3 class="card-title mb-2">{{$offers}}</h3>
                    </div>
                </div>
            </div>
            <!-- Total Revenue -->
            <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card">
                    <div class="row row-bordered g-0">
                        <div class="col-md-8">
                            <h5 class="card-header m-0 me-2 pb-3">{{__('dashboard.general.TotalRevenue')}}</h5>
                            <div id="totalRevenueChart" class="px-2"></div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-body">
                                <div class="text-center">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="growthReportId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            2022
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                                            <a class="dropdown-item" href="javascript:void(0);">2021</a>
                                            <a class="dropdown-item" href="javascript:void(0);">2020</a>
                                            <a class="dropdown-item" href="javascript:void(0);">2019</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="growthChart"></div>
                            <div class="text-center fw-medium pt-3 mb-2"> {{__('dashboard.general.CompanyGrowth')}} 62%</div>

                            <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                                <div class="d-flex">
                                    <div class="me-2">
                                        <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <small>2022</small>
                                        <h6 class="mb-0">$32.5k</h6>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="me-2">
                                        <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <small>2021</small>
                                        <h6 class="mb-0">$41.2k</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Total Revenue -->
            <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                <div class="row">
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{url('/assets/img/icons/unicons/paypal.png')}}" alt="Credit Card" class="rounded">
                                    </div>

                                </div>
                                <span class="d-block mb-1">{{__('dashboard.general.Payments')}}</span>
                                <h3 class="card-title text-nowrap mb-2">$2,456</h3>
                                <small class="text-danger fw-medium"><i class='bx bx-down-arrow-alt'></i> -14.82%</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="{{url('/assets/img/icons/unicons/cc-primary.png')}}" alt="Credit Card" class="rounded">
                                    </div>

                                </div>
                                <span class="fw-medium d-block mb-1">{{__('dashboard.general.Transactions')}}</span>
                                <h3 class="card-title mb-2">$14,857</h3>
                                <small class="text-success fw-medium"><i class='bx bx-up-arrow-alt'></i> +28.14%</small>
                            </div>
                        </div>
                    </div>
                    <!-- </div>
                  <div class="row"> -->
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
                                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                                        <div class="card-title">
                                            <h5 class="text-nowrap mb-2">{{__('dashboard.general.ProfileReport')}}</h5>
                                            <span class="badge bg-label-warning rounded-pill">Year 2021</span>
                                        </div>
                                        <div class="mt-sm-auto">
                                            <small class="text-success text-nowrap fw-medium"><i class='bx bx-chevron-up'></i> 68.2%</small>
                                            <h3 class="mb-0">$84,686k</h3>
                                        </div>
                                    </div>
                                    <div id="profileReportChart"></div>
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
