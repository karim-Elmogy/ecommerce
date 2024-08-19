@extends('admin.layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{__('dashboard.crud.edit')}}/</span>  {{__('dashboard.county.county')}} </h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0"> {{__('dashboard.crud.edit')}} {{__('dashboard.county.county')}} </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('admin.county.update',$county->id)}}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
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
                                <label class="form-label" for="title">{{__('dashboard.table.name_ar')}} </label>
                                <input type="text" class="form-control" value="{{$county->name_ar}}" id="name_ar" placeholder="{{__('dashboard.table.name_ar')}} " name="name_ar" />
                            </div>

                            <div class="mb-3 col-6">
                                <label class="form-label" for="title">{{__('dashboard.table.name_en')}} </label>
                                <input type="text" class="form-control" value="{{$county->name_en}}" id="name_en" placeholder="{{__('dashboard.table.name_en')}} " name="name_en" />
                            </div>

                        </div>


                        <button type="submit" class="btn btn-primary">{{__('dashboard.crud.update')}}</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection


