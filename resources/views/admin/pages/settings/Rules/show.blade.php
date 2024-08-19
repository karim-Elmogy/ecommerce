@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y" >
        <div class="row py-5">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{__('dashboard.general.new_older')}} #{{ $payment->id }}
                    </div>
                    <div class="card-body">
                        <h5 class="py-3">
                            <strong>{{__('dashboard.general.details')}} {{__('dashboard.client.client')}} :</strong>
                        </h5>
                        <div class="table-responsive-md  text-nowrap">
                            <table class="table table-bordered">
                            <thead>
                            <tr class="text-center">
                                <th scope="col">{{__('dashboard.order.order')}}</th>
                                <th scope="col">{{__('dashboard.table.name')}}</th>
                                <th scope="col">{{__('dashboard.table.phone')}}</th>
{{--                                <th scope="col">{{__('dashboard.city.city')}}</th>--}}
{{--                                <th scope="col">{{__('dashboard.region.region')}}</th>--}}
                                <th scope="col">{{__('dashboard.table.date')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="text-center">
                                <td>{{$payment->id}}</td>
                                <td>{{@$payment->user->name}}</td>
                                <td>{{@$payment->user->phone}}</td>
{{--                                <td>{{@$payment->package->city->name}}</td>--}}
{{--                                <td>{{@$payment->package->region->name}}</td>--}}
                                <td>{{ $payment->created_at->format('Y-m-d') }}</td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                        <hr>

{{--                        <h5 class="py-3">--}}
{{--                            <strong>--}}
{{--                                {{__('dashboard.general.details')}} {{__('dashboard.package.package')}} :--}}
{{--                            </strong>--}}
{{--                        </h5>--}}
{{--                        <div class="table-responsive-md  text-nowrap">--}}
{{--                            <table class="table table-bordered">--}}
{{--                            <thead>--}}
{{--                            <tr class="text-center">--}}
{{--                                <th scope="col">{{__('dashboard.package.package')}}</th>--}}
{{--                                <th scope="col">{{__('dashboard.category.category')}}</th>--}}
{{--                                <th scope="col">{{__('dashboard.city.city')}}</th>--}}

{{--                                <th scope="col">{{__('dashboard.package.answer_a')}}</th>--}}
{{--                                <th scope="col">{{__('dashboard.package.answer_b')}}</th>--}}
{{--                                <th scope="col">{{__('dashboard.package.answer_c')}}</th>--}}
{{--                                <th scope="col">{{__('dashboard.package.answer_d')}}</th>--}}
{{--                                <th scope="col">{{__('dashboard.package.answer_e')}}</th>--}}




{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody>--}}
{{--                            <tr class="text-center">--}}
{{--                                <td>{{@$payment->package->name}}</td>--}}
{{--                                <td>{{@$payment->package->category->name}}</td>--}}
{{--                                <td>{{@$payment->package->city->name}}</td>--}}


{{--                                <td>{{@$payment->package->packageData->answer_a}}</td>--}}

{{--                                <td>--}}
{{--                                    @if(@$payment->package->packageData->answer_b == 'active')--}}
{{--                                        {{__('dashboard.package.active')}}--}}
{{--                                    @else--}}
{{--                                        {{__('dashboard.package.no_active')}}--}}
{{--                                    @endif--}}
{{--                                </td>--}}

{{--                                <td>--}}
{{--                                    @if(@$payment->package->packageData->answer_c == 'active')--}}
{{--                                        {{__('dashboard.package.active')}}--}}
{{--                                    @else--}}
{{--                                        {{__('dashboard.package.no_active')}}--}}
{{--                                    @endif--}}
{{--                                </td>--}}

{{--                                <td>--}}
{{--                                    @if(@$payment->package->packageData->answer_d == 'active')--}}
{{--                                        <span>{{__('dashboard.package.active')}}</span>--}}
{{--                                    @else--}}
{{--                                        <span >{{__('dashboard.package.no_active')}}</span>--}}
{{--                                    @endif--}}
{{--                                </td>--}}
{{--                                <td>--}}
{{--                                    @if(@$payment->package->packageData->answer_e == 'active')--}}
{{--                                        <span>{{__('dashboard.package.active')}}</span>--}}
{{--                                    @else--}}
{{--                                        <span >{{__('dashboard.package.no_active')}}</span>--}}
{{--                                    @endif--}}
{{--                                </td>--}}

{{--                            </tr>--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                        </div>--}}


{{--                        <hr>--}}
                        <h5 class="py-3">
                            <strong>
                                {{__('dashboard.general.details')}} {{__('dashboard.order.order')}} :
                            </strong>
                        </h5>
                        <div class="table-responsive-md  text-nowrap">
                            <table class="table table-bordered">
                                <thead>
                                <tr class="text-center">
                                    <th scope="col">{{(__('dashboard.partner.partner'))}}</th>
                                    <th scope="col">الدورات</th>
                                    <th scope="col">السكن</th>
                                    <th scope="col">الإستقبال من المطار</th>
                                    <th scope="col">التأمين الطبي للطالب</th>
                                    <th scope="col">رسوم أخرى</th>
                                    <th scope="col">عدد الاسبابيع</th>
{{--                                    <th scope="col">السعر</th>--}}
                                </tr>
                                </thead>
                                <tbody>

                                <tr class="text-center">

                                    <td>{{@$payment->partner->name}}</td>
                                    <td>{{@$payment->courses->key}}</td>
                                    <td>{{@$payment->living->key}}</td>
                                    <td>{{@$payment->pick->key}}</td>
                                    <td>{{@$payment->medical->key}}</td>
                                    <td>{{@$payment->fees->key}}</td>
                                    <td>{{@$payment->number_weeks}}</td>
{{--                                    <td>{{@$payment->number_weeks}}</td>--}}

                                </tr>
                                </tbody>
                            </table>
                        </div>


                    </div>


                </div>
            </div>
        </div>


    </div>

@endsection
