@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y" >
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> {{__('dashboard.crud.edit')}} /</span> {{__('dashboard.crud.edit')}} {{__('dashboard.slider.slider')}}</h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{__('dashboard.crud.edit')}} {{__('dashboard.slider.slider')}}</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('admin.slider.update',$slider->id)}}" enctype="multipart/form-data">
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


                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    @if($slider->image)
                                        <img src="{{url('/dash-img/slider/'.$slider->image)}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar"/>
                                    @else
                                        <img src="{{url('../assets/admin/img/avatars/1.png')}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar"/>
                                    @endif
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">{{__('dashboard.user.upload')}}</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input
                                                type="file"
                                                id="upload"
                                                class="account-file-input"
                                                hidden
                                                name="image"
                                            />
                                        </label>
                                        <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                            <i class="bx bx-reset d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">{{__('dashboard.user.reset')}}</span>
                                        </button>

                                        <p class="text-muted mb-0">{{__('dashboard.user.info')}}</p>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0" />
                            <div class="card-body">

                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label class="form-label" for="title">{{__('dashboard.table.title_ar')}} </label>
                                        <input type="text" class="form-control" id="title_ar" value="{{$slider->title_ar}}" placeholder="{{__('dashboard.table.title_ar')}}" name="title_ar" />
                                    </div>

                                    <div class="mb-3 col-6">
                                        <label class="form-label" for="title">{{__('dashboard.table.title_en')}} </label>
                                        <input type="text" class="form-control"  value="{{$slider->title_en}}"  id="title_en" placeholder="{{__('dashboard.table.title_en')}}" name="title_en" />
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="mb-3 col-12">
                                        <label class="form-label" for="desc_ar">{{__('dashboard.table.desc_ar')}} </label>
                                        <textarea class="form-control editor"  rows="12" id="desc_ar" name="desc_ar">{{$slider->desc_ar}}</textarea>
                                    </div>

                                    <div class="mb-3 col-12">
                                        <label class="form-label" for="desc_en">{{__('dashboard.table.desc_en')}} </label>
                                        <textarea class="form-control editor" id="desc_en" name="desc_en">{{$slider->desc_ar}}</textarea>
                                    </div>
                                </div>

                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary ">{{__('dashboard.crud.update')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
