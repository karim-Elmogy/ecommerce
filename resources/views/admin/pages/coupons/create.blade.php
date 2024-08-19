@extends('admin.layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> {{__('dashboard.crud.add')}}/</span> {{__('dashboard.coupon.coupon')}}</h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{__('dashboard.crud.add')}}  {{__('dashboard.coupon.coupon')}}</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('admin.coupon.store')}}" enctype="multipart/form-data">
                        @csrf
                        @if($errors->any())
                        @foreach($errors->all() as $error)
                        <div class="form-row">
                            <div class="col-lg-12">
                                <div class="alert alert-danger alert-dismissible" role="alert">
                                    <strong>Error!</strong> {{$error}}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                        @if(session()->has('message'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            {{ session()->get('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <div class="row">
                            <div class="mb-3 col-6">
                                <label class="form-label" for="code">{{__('dashboard.table.code')}} </label>
                                <input type="text" class="form-control" id="code" value="{{old('code')}}" placeholder="{{__('dashboard.table.code')}}" name="code" />
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label" for="discount_percentage">{{__('dashboard.table.discount_percentage')}} </label>
                                <input type="number" class="form-control" id="discount_percentage" value="{{old('discount_percentage')}}" placeholder="{{__('dashboard.table.discount_percentage')}}" name="discount_percentage" />
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label" for="expiry_date">{{__('dashboard.table.expiry_date')}} </label>
                                <input type="date" class="form-control" id="expiry_date" value="{{old('expiry_date')}}" placeholder="{{__('dashboard.table.expiry_date')}}" name="expiry_date" />
                            </div>


                        </div>





                    <div class="p-4">
                        <button type="submit" class="btn btn-primary ">{{__('dashboard.user.submit')}}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



