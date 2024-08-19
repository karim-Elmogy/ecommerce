@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y" >

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="user-profile-header-banner">
                        <img class="img-fluid" src="{{url('/dash-img/team/'.$teamWork->image)}}" alt="teamWork image">
{{--                        <img src="{{url('../assets/admin/img/avatars/timeline.jpg')}}" alt="Banner image" class="rounded-top">--}}
                    </div>
                    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">

                        <div class="flex-grow-1 mt-3 mt-sm-5">
                            <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                <div class="user-profile-info">
                                    <h4>{{$teamWork->FullName}}</h4>
                                    <h5>{{$teamWork->email}}</h5>
                                    <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                        <li class="list-inline-item fw-medium d-flex gap-1">
{{--                                            <i class='bx bx-calendar-alt'></i> {{$teamWork->created_at->format('Y-m-d')}}--}}
                                        </li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Header -->



        <!-- User Profile Content -->
        <div class="row">



            <div class="col-xl-12 col-lg-12 col-md-12">
                <!-- Activity Timeline -->
                <div class="card card-action mb-4">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0"><i class='bx bx-location-plus me-2'></i>{{__('dashboard.teamWork.teamWork')}}</h5>
                    </div>
                    <div class="card-body">
                        <ul class="timeline ms-2">
                            <div class="col-xl-8 col-lg-7 col-md-7">
                                <!-- Activity Timeline -->
                                <div class=" card-action mb-4">
                                    <div class="card-header align-items-center">
                                        <h5 class="card-action-title mb-0"><i class='bx bx-list-ul me-2'></i>{{__('dashboard.general.detail')}} {{__('dashboard.teamWork.teamWork')}}</h5>
                                        <div class="card-action-element">
                                            <div class="dropdown">
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li><a class="dropdown-item" href="javascript:void(0);">Share timeline</a></li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
                                                    <li>
                                                        <hr class="dropdown-divider">
                                                    </li>
                                                    <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <ul class="timeline ms-2">
                                            <li class="timeline-item timeline-item-transparent">
                                                <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-info"></span></span>
                                                <div class="timeline-event">
                                                    <div class="timeline-header mb-1">
                                                        <h6 class="mb-0">{{__('dashboard.table.title')}}</h6>
                                                    </div>
                                                    <p class="mb-0">{{$teamWork->title}}</p>
                                                </div>
                                            </li>
                                            <li class="timeline-item timeline-item-transparent">
                                                <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-warning"></span></span>
                                                <div class="timeline-event">
                                                    <div class="timeline-header mb-1">
                                                        <h6 class="mb-0">{{__('dashboard.table.description')}}</h6>
                                                    </div>
                                                    <p class="mb-0">{{$teamWork->desc}}</p>
                                                </div>
                                            </li>





                                            <li class="timeline-end-indicator">
                                                <i class="bx bx-check-circle"></i>
                                            </li>
                                        </ul>


                                    </div>





                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
