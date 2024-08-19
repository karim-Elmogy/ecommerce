@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y" >

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="user-profile-header-banner">
                        <img src="{{url('../assets/admin/img/avatars/timeline.jpg')}}" alt="Banner image" class="rounded-top">
                    </div>
                    <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
                        <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                            @if($user->image)
                                <img src="{{url('/dash-img/user/'.$user->image)}}" alt="user image"  class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
                            @else
                                <img src="{{url('../assets/admin/img/avatars/1.png')}}" alt="user image"  class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img"  />
                            @endif
                        </div>
                        <div class="flex-grow-1 mt-3 mt-sm-5">
                            <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                <div class="user-profile-info">
                                    <h4>{{$user->name}}</h4>
                                    <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                        <li class="list-inline-item fw-medium d-flex gap-1">
                                            <i class='bx bx-calendar-alt'></i> {{$user->created_at->format('Y-m-d')}}
                                        </li>
                                    </ul>
                                </div>
                                <a href="javascript:void(0)" class="btn btn-success text-nowrap">
                                    @if($user->is_active == 1)
                                        <i class='bx bx-user-check me-1'></i>{{__('dashboard.table.active')}}
                                    @else
                                        <i class='bx bx-user-check me-1'></i>{{__('dashboard.table.no_active')}}
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Header -->



        <!-- User Profile Content -->
        <div class="row" >
            <div class="col-xl-4 col-lg-5 col-md-5" >
                <!-- About User -->
                <div class="card mb-4">
                    <div class="card-body" style="height: 365px">
                        <small class="text-muted text-uppercase">{{__('dashboard.general.about')}}</small>
                        <ul class="list-unstyled mb-4 mt-3">
                            <li class="d-flex align-items-center mb-3"><i class="bx bx-user"></i><span class="fw-medium mx-2">{{__('dashboard.table.name')}} :</span> <span> {{$user->name}}</span></li>
                            <li class="d-flex align-items-center mb-3"><i class="bx bx-check"></i><span class="fw-medium mx-2">{{__('dashboard.table.status')}} :</span> <span> {{__('dashboard.table.active')}}</span></li>
                            {{--                            <li class="d-flex align-items-center mb-3"><i class="bx bx-flag"></i><span class="fw-medium mx-2">Country:</span> <span>USA</span></li>--}}
                            {{--                            <li class="d-flex align-items-center mb-3"><i class="bx bx-detail"></i><span class="fw-medium mx-2">Languages:</span> <span>English</span></li>--}}
                        </ul>
                        <small class="text-muted text-uppercase">{{__('dashboard.general.contact')}}</small>
                        <ul class="list-unstyled mb-4 mt-3">
                            <li class="d-flex align-items-center mb-3"><i class="bx bx-phone"></i><span class="fw-medium mx-2">{{__('dashboard.table.phone')}} :</span> <span>{{$user->phone}}</span></li>
                            <li class="d-flex align-items-center mb-3"><i class="bx bx-envelope"></i><span class="fw-medium mx-2">{{__('dashboard.table.email')}}:</span> <span>{{$user->email ? $user->email : __('dashboard.table.null')}}</span></li>
                        </ul>

                    </div>
                </div>
                <!--/ About User -->

            </div>
            <div class="col-xl-8 col-lg-7 col-md-7">
                <!-- Activity Timeline -->
                <div class="card card-action mb-4">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0"><i class='bx bx-location-plus me-2'></i>{{__('dashboard.general.details')}}</h5>
                    </div>
                    <div class="card-body">
                        <ul class="timeline ms-2">

                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">{{__('dashboard.table.address')}}</h6>
                                                <small class="text-muted">{{$user->created_at->format('Y-m-d')}}</small>
                                            </div>
                                            <p class="mb-0">{{$user->address ?? "--"}}</p>
                                        </div>
                                    </li>

                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                <div class="timeline-event">
                                    <div class="timeline-header mb-1">
                                        <h6 class="mb-0">{{__('dashboard.table.whatsapp')}}</h6>
                                        <small class="text-muted">{{$user->created_at->format('Y-m-d')}}</small>
                                    </div>
                                    <p class="mb-0">{{$user->whatsapp ?? "--"}}</p>
                                </div>
                            </li>


                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                <div class="timeline-event">
                                    <div class="timeline-header mb-1">
                                        <h6 class="mb-0">{{__('dashboard.table.facebook')}}</h6>
                                        <small class="text-muted">{{$user->created_at->format('Y-m-d')}}</small>
                                    </div>
                                    <p class="mb-0">{{$user->facebook ?? "--"}}</p>
                                </div>
                            </li>

                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                <div class="timeline-event">
                                    <div class="timeline-header mb-1">
                                        <h6 class="mb-0">{{__('dashboard.table.website')}}</h6>
                                        <small class="text-muted">{{$user->created_at->format('Y-m-d')}}</small>
                                    </div>
                                    <p class="mb-0">{{$user->website ?? "--"}}</p>
                                </div>
                            </li>



                        </ul>
                    </div>
                </div>


            </div>
        </div>
        <!--/ User Profile Content -->





        <div class="card py-5">
            <div class="card-header align-items-center">
                <h5 class="card-action-title mb-0"><i class='bx bx-location-plus me-2'></i>تفاصيل نموذج التسجيل الخاص بالباقات المعاهد</h5>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive-md text-nowrap">
                    @if (!empty($user->app) && count($user->app) > 0)
                        <table class="table">
                            <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>{{__('dashboard.partner.partner')}}</th>
                                <th>{{__('dashboard.package.package')}}</th>
                                <th>{{__('dashboard.table.phone')}}</th>
                                <th>{{__('dashboard.table.email')}}</th>
                                <th>{{__('dashboard.table.control')}}</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @foreach ($user->app as $item)
                                <tr class="text-center">
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td >{{@$item->university->name}}</td>
                                    <td >{{@$item->package->name}}</td>
                                    <td >{{$item->phone}}</td>
                                    <td>{{$item->email ?? '--'}}</td>

                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">

                                                <a class="dropdown-item" href="{{route('admin.show-app-form',$item->id)}}"
                                                ><i class="bx bx-show-alt me-1"></i>{{__('dashboard.crud.show')}} </a>

                                            </div>

                                        </div>
                                    </td>
                                </tr>



                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div>
                            <h3 class="text-info text-primary" style="text-align: center">{{ __('dashboard.table.empty') }}</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>


        <div class="card py-5">
            <div class="card-header align-items-center">
                <h5 class="card-action-title mb-0"><i class='bx bx-location-plus me-2'></i>تفاصيل نموذج التسجيل الخاص بتخصصات المعاهد</h5>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive-md text-nowrap">
                    @if (!empty($user->universityApp) && count($user->universityApp) > 0)
                        <table class="table">
                            <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>{{__('dashboard.partner.partner')}}</th>
                                <th>{{__('dashboard.specialization.specialization')}}</th>
                                <th>{{__('dashboard.table.phone')}}</th>
                                <th>{{__('dashboard.table.email')}}</th>
                                <th>{{__('dashboard.table.control')}}</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @foreach ($user->universityApp as $item)
                                <tr class="text-center">
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td >{{@$item->university->name}}</td>
                                    <td >{{@$item->specialization->name}}</td>
                                    <td >{{$item->phone}}</td>
                                    <td>{{$item->email ?? '--'}}</td>

                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">

                                                <a class="dropdown-item" href="{{route('admin.show-app-university-form',$item->id)}}"
                                                ><i class="bx bx-show-alt me-1"></i>{{__('dashboard.crud.show')}} </a>

                                            </div>

                                        </div>
                                    </td>
                                </tr>



                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div>
                            <h3 class="text-info text-primary" style="text-align: center">{{ __('dashboard.table.empty') }}</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection
