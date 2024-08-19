@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y" >
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> {{__('dashboard.crud.add')}} /</span> {{__('dashboard.team.team')}}</h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{__('dashboard.crud.add')}} {{__('dashboard.team.team')}}</h5>
                        {{--                         <small class="text-muted float-end">Default label</small>--}}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('admin.team.update',$teamWork->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{url('/dash-img/team/'.$teamWork->image)}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar"/>
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
                                                value="{{old('image')}}"
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
                                    <div class="mb-3 col-md-6">
                                        <label for="name_ar" class="form-label">{{__('dashboard.table.FullName')}}</label>
                                        <input
                                            class="form-control"
                                            type="text"
                                            id="FullName"
                                            name="FullName"
                                            value="{{$teamWork->FullName}}"
                                            placeholder="{{__('dashboard.table.FullName')}}"
                                            required
                                        />
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="JobTitle" class="form-label">{{__('dashboard.table.JobTitle')}}</label>
                                        <input
                                            class="form-control"
                                            type="text"
                                            id="JobTitle"
                                            name="JobTitle"
                                            value="{{$teamWork->JobTitle}}"
                                            placeholder="{{__('dashboard.table.JobTitle')}}"
                                            required
                                        />
                                    </div>

                                    <div class="mb-3 col-md-6">
                                        <label for="phone" class="form-label">{{__('dashboard.table.phone')}}</label>
                                        <input
                                            class="form-control"
                                            type="text"
                                            id="phone"
                                            name="phone"
                                            value="{{$teamWork->phone}}"
                                            placeholder="{{__('dashboard.table.phone')}}"
                                            required
                                        />
                                    </div>


                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">{{__('dashboard.user.email')}}</label>
                                        <input
                                            class="form-control"
                                            type="text"
                                            id="email"
                                            name="email"
                                            value="{{$teamWork->email}}"
                                            placeholder="{{__('dashboard.user.email')}}"
                                        />
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
@endsection
