@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y" >





        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-7">
                <!-- Activity Timeline -->
                <div class="card card-action mb-4">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0"><i class='bx bx-location-plus me-2'></i>تفاصيل نموذج التسجيل</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="timeline ms-2">

                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">تاريخ الميلاد</h6>
{{--                                                <small class="text-muted">{{$user->created_at->format('Y-m-d')}}</small>--}}
                                            </div>
                                            <p class="mb-0">{{$app->birthday ?? "--"}}</p>
                                        </div>
                                    </li>

                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">النوع</h6>
{{--                                                <small class="text-muted">{{$user->created_at->format('Y-m-d')}}</small>--}}
                                            </div>
                                            <p class="mb-0">{{$app->gender ?? "--"}}</p>
                                        </div>
                                    </li>


                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">
                                                    مستوى اللغة الانجليزية</h6>
{{--                                                <small class="text-muted">{{$user->created_at->format('Y-m-d')}}</small>--}}
                                            </div>
                                            <p class="mb-0">{{$app->level ?? "--"}}</p>
                                        </div>
                                    </li>

                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">الايميل</h6>
{{--                                                <small class="text-muted">{{$user->created_at->format('Y-m-d')}}</small>--}}
                                            </div>
                                            <p class="mb-0">{{$app->email ?? "--"}}</p>
                                        </div>
                                    </li>

                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">رقم الجوال</h6>
                                                {{--                                                <small class="text-muted">{{$user->created_at->format('Y-m-d')}}</small>--}}
                                            </div>
                                            <p class="mb-0">{{$app->phone ?? "--"}}</p>
                                        </div>
                                    </li>



                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="timeline ms-2">

                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">العنوان الوطني</h6>
{{--                                                <small class="text-muted">{{$user->created_at->format('Y-m-d')}}</small>--}}
                                            </div>
                                            <p class="mb-0">{{$app->address ?? "--"}}</p>
                                        </div>
                                    </li>

                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">المدينة</h6>
{{--                                                <small class="text-muted">{{$user->created_at->format('Y-m-d')}}</small>--}}
                                            </div>
                                            <p class="mb-0">{{$app->city_name ?? "--"}}</p>
                                        </div>
                                    </li>


                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">
                                                    الرمز البريدي</h6>
{{--                                                <small class="text-muted">{{$user->created_at->format('Y-m-d')}}</small>--}}
                                            </div>
                                            <p class="mb-0">{{$app->postal_code ?? "--"}}</p>
                                        </div>
                                    </li>

                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">هل انت مدخن للسجائر؟</h6>
{{--                                                <small class="text-muted">{{$user->created_at->format('Y-m-d')}}</small>--}}
                                            </div>
                                            <p class="mb-0">{{$app->is_smoker ?? "--"}}</p>
                                        </div>
                                    </li>


                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">هل لديك مشكلة مع الحيوانات الأليفة؟</h6>
                                                {{--                                                <small class="text-muted">{{$user->created_at->format('Y-m-d')}}</small>--}}
                                            </div>
                                            <p class="mb-0">{{$app->problem_with_pets ?? "--"}}</p>
                                        </div>
                                    </li>



                                </ul>

                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>



        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-7">
                <!-- Activity Timeline -->
                <div class="card card-action mb-4">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0"><i class='bx bx-location-plus me-2'></i>معلومات التواصل لأحد الأقارب</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="timeline ms-2">

                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">الإسم بالكامل</h6>
                                                {{--                                                <small class="text-muted">{{$user->created_at->format('Y-m-d')}}</small>--}}
                                            </div>
                                            <p class="mb-0">{{$app->relative_name ?? "--"}}</p>
                                        </div>
                                    </li>

                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">صلة القرابة</h6>
                                                {{--                                                <small class="text-muted">{{$user->created_at->format('Y-m-d')}}</small>--}}
                                            </div>
                                            <p class="mb-0">{{$app->relative_relation ?? "--"}}</p>
                                        </div>
                                    </li>


                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">رقم الجوال</h6>
                                                {{--                                                <small class="text-muted">{{$user->created_at->format('Y-m-d')}}</small>--}}
                                            </div>
                                            <p class="mb-0">{{$app->relative_phone ??"--"}}</p>
                                        </div>
                                    </li>


                                </ul>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-7">
                <!-- Activity Timeline -->
                <div class="card card-action mb-4">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0"><i class='bx bx-location-plus me-2'></i> رقم الهوية ورقم الجوال المسجل في ابشر</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="timeline ms-2">

                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">رقم الهوية الوطنية</h6>
                                                {{--                                                <small class="text-muted">{{$user->created_at->format('Y-m-d')}}</small>--}}
                                            </div>
                                            <p class="mb-0">{{$app->abs_her_id ?? "--"}}</p>
                                        </div>
                                    </li>

                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">
                                                    رقم الجوال المسجل في ابشر</h6>
                                                {{--                                                <small class="text-muted">{{$user->created_at->format('Y-m-d')}}</small>--}}
                                            </div>
                                            <p class="mb-0">{{$app->abs_her_phone ?? "--"}}</p>
                                        </div>
                                    </li>





                                </ul>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-7">
                <!-- Activity Timeline -->
                <div class="card card-action mb-4">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0"><i class='bx bx-location-plus me-2'></i>هل تعاني من أي مشاكل صحية أو أمراض مزمنة لا سمح الله؟</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="timeline ms-2">

                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">من ماذا تعاني؟</h6>
                                                {{--                                                <small class="text-muted">{{$user->created_at->format('Y-m-d')}}</small>--}}
                                            </div>
                                            <p class="mb-0">{{$app->health_problems_desc ?? "--"}}</p>
                                        </div>
                                    </li>

                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">
                                                    هل هناك أي طلبات خاصة؟</h6>
                                                {{--                                                <small class="text-muted">{{$user->created_at->format('Y-m-d')}}</small>--}}
                                            </div>
                                            <p class="mb-0">{{$app->special_requests	?? "--"}}</p>
                                        </div>
                                    </li>





                                </ul>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-7">
                <!-- Activity Timeline -->
                <div class="card card-action mb-4">
                    <div class="card-header align-items-center">
{{--                        <h5 class="card-action-title mb-0"><i class='bx bx-location-plus me-2'></i>كيف سمعت / تعرفت على يوتوبيا؟--}}

{{--                        </h5>--}}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="timeline ms-2">

                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">كيف سمعت / تعرفت على يوتوبيا؟

                                                </h6>
                                                {{--                                                <small class="text-muted">{{$user->created_at->format('Y-m-d')}}</small>--}}
                                            </div>
                                            <p class="mb-0">{{$app->hear_about_utopia ?? "--"}}</p>
                                        </div>
                                    </li>






                                </ul>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-7">
                <!-- Activity Timeline -->
                <div class="card card-action mb-4">
                    <div class="card-header align-items-center">
                        {{--                        <h5 class="card-action-title mb-0"><i class='bx bx-location-plus me-2'></i>كيف سمعت / تعرفت على يوتوبيا؟--}}

                        {{--                        </h5>--}}
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="timeline ms-2">

                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">
                                                    هل ترغب بأن نقوم بالتواصل معك لحجز تذاكر السفر؟
                                                </h6>
                                                {{--                                                <small class="text-muted">{{$user->created_at->format('Y-m-d')}}</small>--}}
                                            </div>
                                            <p class="mb-0">{{$app->contact_you_to_book ?? "--"}}</p>
                                        </div>
                                    </li>






                                </ul>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>




        <div class="row">
            <div class="col-xl-12 col-lg-12 col-md-7">
                <!-- Activity Timeline -->
                <div class="card card-action mb-4">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0"><i class='bx bx-location-plus me-2'></i>المرفقات</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="timeline ms-2">

                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">صوره من جواز السفر</h6>
                                                {{--                                                <small class="text-muted">{{$user->created_at->format('Y-m-d')}}</small>--}}
                                            </div>
                                            <p class="py-2">
                                                <img src="{{url('/dash-img/user-app/'.$app->passport)}}" width="150" height="150" alt="user image"  />
                                            </p>
                                        </div>
                                    </li>

                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">
                                                    شهادة الثانوية العامة

                                                </h6>
                                                {{--                                                <small class="text-muted">{{$user->created_at->format('Y-m-d')}}</small>--}}
                                            </div>
                                            <p class="py-2">
                                                <img src="{{url('/dash-img/user-app/'.$app->school_certificate)}}" width="150" height="150" alt="user image"  />
                                            </p>
                                        </div>
                                    </li>

                                    <li class="timeline-item timeline-item-transparent">
                                        <span class="timeline-point-wrapper"><span class="timeline-point timeline-point-success"></span></span>
                                        <div class="timeline-event">
                                            <div class="timeline-header mb-1">
                                                <h6 class="mb-0">
                                                    صورة مقاس ٤*٦


                                                </h6>
                                                {{--                                                <small class="text-muted">{{$user->created_at->format('Y-m-d')}}</small>--}}
                                            </div>
                                            <p class="py-2">
                                                <img src="{{url('/dash-img/user-app/'.$app->image)}}" width="150" height="150" alt="user image"  />
                                            </p>
                                        </div>
                                    </li>





                                </ul>
                            </div>
                        </div>

                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
