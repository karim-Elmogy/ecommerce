@extends('admin.layouts.app')
@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"> {{__('dashboard.profile.settings')}}<span class="text-muted fw-light"> / {{__('dashboard.profile.profile')}} </span> </h4>
        <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
            <h5 class="card-header">{{__('dashboard.profile.details')}}</h5>
            <!-- Account -->
            <form id="formAccountSettings" method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
             @csrf
             @method('PUT')
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        @if(Auth::guard('admin')->user()->image)
                            <img src="{{url('/dash-img/admin/'.Auth::guard('admin')->user()->image)}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar"/>
                        @else
                            <img src="{{url('../assets/admin/img/avatars/1.png')}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar"/>
                        @endif
                    <div class="button-wrapper">
                         <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                        <span class="d-none d-sm-block">{{__('dashboard.profile.upload')}}</span>
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
                        <span class="d-none d-sm-block">{{__('dashboard.profile.reset')}}</span>
                        </button>

                         <p class="text-muted mb-0">{{__('dashboard.profile.info')}}</p>
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
                        <label for="name_ar" class="form-label">{{__('dashboard.table.name_ar')}}</label>
                                <input
                                    class="form-control"
                                    type="text"
                                    id="name_ar"
                                    name="name_ar"
                                    value="{{auth('admin')->user()->name_ar}}"
                                    required
                                />

                        </div>
                         <div class="mb-3 col-md-6">
                            <label for="name_en" class="form-label">{{__('dashboard.table.name_en')}}</label>
                            <input
                                    class="form-control"
                                    type="text"
                                    id="name_en"
                                    name="name_en"
                                    value="{{auth('admin')->user()->name_en}}"
                                    required
                                />


                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">{{__('dashboard.profile.email')}}</label>
                            <input
                                class="form-control"
                                type="text"
                                id="email"
                                name="email"
                                value="{{auth('admin')->user()->email}}"
                                placeholder="john.doe@example.com"
                                disabled
                            />
                        </div>

                        <div class="mb-3 form-password-toggle col-md-6">
                            <label class="form-label" for="password">{{__('dashboard.profile.password')}}</label>
                            <div class="input-group input-group-merge">
                            <input
                                type="password"
                                id="password"
                                class="form-control"
                                name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                autocomplete="off"
                            />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="mb-3 form-password-toggle col-md-6">
                            <label class="form-label" for="password_confirmation">{{__('dashboard.profile.confirmation')}}</label>
                            <div class="input-group input-group-merge">
                            <input
                                type="password"
                                id="password"
                                class="form-control"
                                name="password_confirmation"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password"
                            />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary ">{{__('dashboard.profile.submit')}}</button>
                    </div>

            </form>
            </div>
            <!-- /Account -->
            </div>

        </div>
        </div>
</div>
@endsection
