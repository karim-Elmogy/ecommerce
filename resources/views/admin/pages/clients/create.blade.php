@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y" >
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> {{__('dashboard.crud.add')}} /</span> {{__('dashboard.user.add')}}</h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{__('dashboard.user.add')}}</h5>
                        {{--                         <small class="text-muted float-end">Default label</small>--}}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('admin.client.store')}}" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{url('assets/user/assets/img/profile/person.jpg')}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar"/>
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
                                        <label for="name" class="form-label">{{__('dashboard.table.name')}}</label>
                                        <input
                                            class="form-control"
                                            type="text"
                                            id="name"
                                            name="name"
                                            value="{{old('name')}}"
                                            placeholder="{{__('dashboard.table.name')}}"
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
                                            value="{{old('email')}}"
                                            placeholder="{{__('dashboard.user.email')}}"
                                        />
                                    </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="name_en" class="form-label">{{__('dashboard.table.phone')}}</label>
                                            <input
                                                class="form-control"
                                                type="text"
                                                id="phone"
                                                name="phone"
                                                value="{{old('phone')}}"
                                                placeholder="{{__('dashboard.table.phone')}}"
                                                required
                                            />
                                        </div>


{{--                                        <div class="mb-3 col-6">--}}
{{--                                            <label class="form-label" for="desc_ar">{{__('dashboard.table.address')}} </label>--}}
{{--                                            <textarea--}}
{{--                                                class="form-control"--}}
{{--                                                id="address"--}}
{{--                                                placeholder="{{__('dashboard.table.address')}}"--}}
{{--                                                name="address" rows="1" >--}}
{{--                                                {{ old('address') }}--}}
{{--                                            </textarea>--}}
{{--                                        </div>--}}

{{--                                        <div class="mb-3 col-md-6">--}}
{{--                                            <label for="whatsapp" class="form-label">{{__('dashboard.table.whatsapp')}}</label>--}}
{{--                                            <input--}}
{{--                                                class="form-control"--}}
{{--                                                type="url"--}}
{{--                                                id="whatsapp"--}}
{{--                                                name="whatsapp"--}}
{{--                                                value="{{old('whatsapp')}}"--}}
{{--                                                placeholder="{{__('dashboard.table.whatsapp')}}"--}}
{{--                                                required--}}
{{--                                            />--}}
{{--                                        </div>--}}

{{--                                        <div class="mb-3 col-md-6">--}}
{{--                                            <label for="facebook" class="form-label">{{__('dashboard.table.facebook')}}</label>--}}
{{--                                            <input--}}
{{--                                                class="form-control"--}}
{{--                                                type="url"--}}
{{--                                                id="facebook"--}}
{{--                                                name="facebook"--}}
{{--                                                value="{{old('facebook')}}"--}}
{{--                                                placeholder="{{__('dashboard.table.facebook')}}"--}}
{{--                                                required--}}
{{--                                            />--}}
{{--                                        </div>--}}
{{--                                        <div class="mb-3 col-md-6">--}}
{{--                                            <label for="website" class="form-label">{{__('dashboard.table.website')}}</label>--}}
{{--                                            <input--}}
{{--                                                class="form-control"--}}
{{--                                                type="url"--}}
{{--                                                id="website"--}}
{{--                                                name="website"--}}
{{--                                                value="{{old('website')}}"--}}
{{--                                                placeholder="{{__('dashboard.table.website')}}"--}}
{{--                                                required--}}
{{--                                            />--}}
{{--                                        </div>--}}


                                        <div class="mb-3 form-password-toggle col-md-6">
                                        <label class="form-label" for="password">{{__('dashboard.user.password')}}</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="password"
                                                id="password"
                                                class="form-control"
                                                name="password"
                                                value="{{old('password')}}"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                autocomplete="off"
                                            />
                                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                        </div>
                                    </div>
                                    <div class="mb-3 form-password-toggle col-md-6">
                                        <label class="form-label" for="password_confirmation">{{__('dashboard.user.confirmation')}}</label>
                                        <div class="input-group input-group-merge">
                                            <input
                                                type="password"
                                                id="password"
                                                class="form-control"
                                                name="password_confirmation"
                                                value="{{old('password_confirmation')}}"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="password"
                                            />
                                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                        </div>
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
