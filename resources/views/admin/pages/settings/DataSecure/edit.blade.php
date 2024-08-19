@extends('admin.layouts.app')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><a href="{{route('admin.dataSecure.index')}}"><span class="text-muted fw-light"> {{__('dashboard.sections.PrivacyPolicy')}}/</span></a> {{__('dashboard.crud.edit')}}</h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{__('dashboard.crud.edit')}}  {{__('dashboard.sections.DataSecure')}}</h5>
                        {{-- <small class="text-muted float-end">Default label</small> --}}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('admin.dataSecure.update',$item->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                    <div class="form-row">
                                        <div class="col-lg-12">
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <strong>Error!</strong> {{$error}}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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

                                    <div class="col-12">
                                        <div class="mb-3">
                                            <textarea class="form-control editor"  name="value"  id="exampleFormControlTextarea1" rows="3">{{$item->value}}</textarea>

                                        </div>
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
