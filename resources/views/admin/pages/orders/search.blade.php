<div class="container-xxl flex-grow-1 container-p-y" >
        <div class="row">
            <div class="col-12">
                    <hr>

                    <h5 class="py-3">
                        <strong>
                            {{__('dashboard.general.details')}} {{__('dashboard.client.client')}} :
                        </strong>
                    </h5>
                @if (!empty($users) && count($users) > 0)
                    <div class="table-responsive-md  text-nowrap">
                        <table class="table table-bordered">
                            <thead>
                            <tr class="text-center">
                                <th scope="col">{{__('dashboard.table.image')}}</th>
                                <th scope="col">{{__('dashboard.table.name')}}</th>
                                <th scope="col">{{__('dashboard.table.phone')}}</th>
                                <th scope="col">{{__('dashboard.crud.show')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr class="text-center">
                                    <td>
                                        @if($user->image)
                                            <img src="{{url('/dash-img/admin/'.$user->image)}}"  class="rounded" height="20" width="20"/>
                                        @else
                                            <img src="{{url('../assets/admin/img/avatars/1.png')}}"  class="rounded" height="20" width="20" />
                                        @endif
                                    </td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->phone_number}}</td>
                                    <td>
                                        <button type="button" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="{{'#modalCenter'.$user->id}}">
                                            <i class='bx bx-show' style="color: #1a202c"></i>
                                        </button>
                                    </td>

                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                @else
                    <div>
                        <h3 class="text-info text-primary" style="text-align: center;font-size: 20px">{{ __('dashboard.table.empty') }}</h3>
                    </div>
                @endif

                <div class="modal-onboarding modal fade animate__animated" id="{{'modalCenter'.$user->id}}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCenterTitle">{{__('dashboard.crud.show')}}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">


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
                                                            <img src="{{url('/dash-img/admin/'.$user->image)}}" alt="user image"  class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img" />
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
                                                                <i class='bx bx-user-check me-1'></i>{{__('dashboard.table.active')}}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ Header -->



                                    <!-- User Profile Content -->
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-5 col-md-5">
                                            <!-- About User -->
                                            <div class="card mb-4">
                                                <div class="card-body">
                                                    <small class="text-muted text-uppercase">{{__('dashboard.general.about')}}</small>
                                                    <ul class="list-unstyled mb-4 mt-3">
                                                        <li class="d-flex align-items-center mb-3"><i class="bx bx-user"></i><span class="fw-medium mx-2">{{__('dashboard.table.name')}} :</span> <span> {{$user->name}}</span></li>
                                                        <li class="d-flex align-items-center mb-3"><i class="bx bx-check"></i><span class="fw-medium mx-2">{{__('dashboard.table.status')}} :</span> <span> {{__('dashboard.table.active')}}</span></li>
                                                        <li class="d-flex align-items-center mb-3"><i class="bx bx-flag"></i><span class="fw-medium mx-2">Country:</span> <span>USA</span></li>
                                                        <li class="d-flex align-items-center mb-3"><i class="bx bx-detail"></i><span class="fw-medium mx-2">Languages:</span> <span>English</span></li>
                                                    </ul>
                                                    <small class="text-muted text-uppercase">{{__('dashboard.general.contact')}}</small>
                                                    <ul class="list-unstyled mb-4 mt-3">
                                                        <li class="d-flex align-items-center mb-3"><i class="bx bx-phone"></i><span class="fw-medium mx-2">{{__('dashboard.table.phone')}} :</span> <span>{{$user->phone_number}}</span></li>
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
                                                    <h5 class="card-action-title mb-0"><i class='bx bx-location-plus me-2'></i>{{__('dashboard.general.addresses')}}</h5>
                                                </div>
                                                <div class="card-body">
                                                    <ul class="timeline ms-2">
                                                        @if (!empty($user->userAddress) && count($user->userAddress) > 0)
                                                            @foreach($user->userAddress as $address)
                                                                <li class="timeline-item timeline-item-transparent">
                                                                    <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                                                    <div class="timeline-event">
                                                                        <div class="timeline-header mb-1">
                                                                            <h6 class="mb-0">{{$address->title}}</h6>
                                                                            <small class="text-muted">{{$address->created_at->format('Y-m-d')}}</small>
                                                                        </div>
                                                                        <p class="mb-0">{{$address->desc}}</p>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        @else
                                                            <div>
                                                                <h3 class="text-success " style=" text-align: center; font-size: 20px">{{ __('dashboard.table.empty') }}</h3>
                                                            </div>
                                                        @endif

                                                    </ul>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <!--/ User Profile Content -->
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{__('dashboard.profile.close')}}</button>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

