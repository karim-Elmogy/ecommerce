@extends('admin.layouts.app')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y" >
        <div class="row py-5">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{__('dashboard.general.new_older')}}
                    </div>
                    <div class="card-body">
                        <div class="app-academy">
                            <div class="card p-0 mb-4">
                                <div class="card-body d-flex flex-column flex-md-row justify-content-between p-0 pt-4">
                                    <div class="app-academy-md-25 card-body py-0">
                                        <img src="{{url('/assets/admin/img/illustrations/bulb-light.png')}}" class="img-fluid app-academy-img-height scaleX-n1-rtl" alt="Bulb in hand" data-app-light-img="illustrations/bulb-light.png" data-app-dark-img="illustrations/bulb-dark.png" height="90" />
                                    </div>
                                    <div class="app-academy-md-50 card-body d-flex align-items-md-center flex-column text-md-center">

                                        <div class="d-flex align-items-center justify-content-between app-academy-md-80">
                                            <input type="search" id="input_search" autocomplete="off" placeholder="{{__('dashboard.general.client_search')}}"  class="form-control me-2" />
                                        </div>

                                    </div>
                                    <div class="app-academy-md-25 d-flex align-items-end justify-content-end">
                                        <img src="{{url('/assets/admin/img/illustrations/pencil-rocket.png')}}" alt="pencil rocket" height="188" class="scaleX-n1-rtl" />
                                    </div>
                                </div>
                            </div>

                            <div class="py-1" style="display: none; height: 300px; overflow-y: auto;" id="searchDiv">

                                <div class="tt-dataset tt-dataset-states" id="search-results">


                                </div>


                            </div>





                    </div>


                </div>
            </div>
        </div>
        <div>
            <div class="col-xl">
                <div class="card">
                    <div class="card-body">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    {{__('dashboard.crud.add')}} {{__('dashboard.order.order')}}
                                </h5>
                            </div>
                            <form method="POST" action="{{route('admin.order.store')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        @if($errors->any())
                                            @foreach($errors->all() as $error)
                                                <div class="form-row">
                                                    <div class="col-lg-12">
                                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                                            {{$error}}
                                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                        <div class="col-md-6 col-6 mb-3">
                                            <label for="user_id" class="form-label">{{(__('dashboard.client.clients'))}}</label>
                                            <select class="form-select" name="user_id" id="user"
                                                    aria-label="Default select example" required>
                                                <option value="0" selected disabled>{{(__('dashboard.client.clients'))}}</option>
                                                @foreach ($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }} - ({{$user->phone_number}} )</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 col-6 mb-3">
                                            <label for="package_id" class="form-label">{{(__('dashboard.package.packages'))}}</label>
                                            <select class="form-select" name="package_id" id="package"
                                                    aria-label="Default select example" required>
                                                <option value="0" selected disabled>{{(__('dashboard.package.packages'))}}</option>
                                                @foreach ($packages as $package)
                                                    <option value="{{ $package->id }}">{{ $package->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 col-6 mb-3">
                                            <label for="day_id" class="form-label">{{(__('dashboard.day.days'))}}</label>
                                            <select  id="select2Multiple" class="select2 form-select" multiple name="days[]" id="day"
                                                    aria-label="Default select example" required>
                                                <option value="0" selected disabled>{{(__('dashboard.day.days'))}}</option>
                                                @foreach ($days as $day)
                                                    <option value="{{ $day->id }}">{{ $day->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>



                                            <div class="col-md-6 col-6 mb-3">
                                                <label for="methods" class="form-label">{{(__('dashboard.general.methods'))}}</label>
                                                <select class="form-select" name="methods" id="methods"
                                                        aria-label="Default select example" required>
                                                    <option value="0" selected disabled>{{(__('dashboard.general.methods'))}}</option>
                                                    <option value="cash" >{{(__('dashboard.general.cash'))}}</option>
                                                    <option value="card" >{{(__('dashboard.general.card'))}}</option>
                                                </select>
                                            </div>

                                            <div class="col-md-6 col-6 mb-3">
                                                <label for="methods" class="form-label">{{(__('dashboard.package.package_type'))}}</label>
                                                <select class="form-select" name="package_type" id="package_type"
                                                        aria-label="Default select example" required>
                                                    <option value="0" selected disabled>{{(__('dashboard.package.package_type'))}}</option>
                                                    <option value="morning" >{{(__('dashboard.general.morning'))}}</option>
                                                    <option value="evening" >{{(__('dashboard.general.evening'))}}</option>
                                                </select>
                                            </div>


                                            <div class="mb-3 col-6 col-md-6">
                                                <label for="html5-date-input" class="col-md-2 col-form-label">{{(__('dashboard.table.s_date'))}}</label>
                                                <input class="form-control" type="date" name="start_period" placeholder="{{(__('dashboard.table.s_date'))}}" id="html5-date-input" />
                                            </div>




                                            <div class="mb-3 col-6 col-md-6">
                                                <form id="coupon-form" class="coupon-form" action="{{ route('apply.coupon') }}" method="GET">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <input type="text" class="form-control" id="coupon_code" name="code" placeholder="{{(__('dashboard.coupon.coupon'))}}">
                                                        </div>
                                                        <div class="col-6">
                                                            <button type="button" id="apply_coupon_btn" class="btn btn-primary">{{__('dashboard.coupon.coupon')}}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="mb-3 col-6 col-md-6">
                                                @if( setting('tax'))
                                                    <input class="form-check-input me-2" name="is_tax" type="checkbox" value="1" id="defaultCheck1" />
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        {{(__('dashboard.general.tax'))}} <span>{!! setting('tax') !!} %</span>
                                                    </label>
                                                @else
                                                    {{(__('dashboard.general.tax_null'))}} <br>
                                                    <strong>{{(__('dashboard.general.tax_null_diction'))}} </strong>
                                                @endif
                                            </div>
                                    </div>
                                    <div class="mt-2">
                                        <button type="submit" class="btn btn-primary ">{{__('dashboard.user.submit')}}</button>
                                    </div>
                                </div>
                            </form>


                    </div>
                </div>
            </div>
        </div>
    </div>


        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

        <script>
            $(document).ready(function(){
                $('#apply_coupon_btn').click(function(e){
                    e.preventDefault();
                    var couponCode = $('#coupon_code').val();
                    $.ajax({
                        url: $('#coupon-form').attr('action'),
                        type: 'GET',
                        data: {
                            _token: $('input[name="_token"]').val(),
                            coupon_code: couponCode
                        },
                        success: function(response){
                            // Handle success response
                            console.log(response);
                        },
                        error: function(xhr, status, error){
                            // Handle error response
                            console.log(xhr.responseText);
                        }
                    });
                });
            });
        </script>



        <script>
            new MultiSelectTag('select2Multiple', {
                rounded: true,    // default true
                shadow: false,      // default false
                placeholder: 'البحث',  // default Search...
                tagColor: {
                    textColor: '#697a8d',
                    borderColor: 'rgba(67,89,113,.08)',
                    bgColor: 'rgba(67,89,113,.08)',
                },
                onChange: function(values) {
                    console.log(values)
                }
            })

        </script>

@endsection
