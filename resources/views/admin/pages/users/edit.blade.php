@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y" >
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> {{__('dashboard.crud.edit')}} /</span> {{__('dashboard.user.edit')}}</h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{__('dashboard.user.edit')}}</h5>
                        {{--                         <small class="text-muted float-end">Default label</small>--}}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('admin.users.update',$user->id)}}" enctype="multipart/form-data">
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
                                    @if($user->image)
                                        <img src="{{url('/dash-img/admin/'.$user->image)}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar"/>
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
                                                value="{{$user->name_ar}}"
                                                placeholder="{{__('dashboard.table.name_ar')}}"
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
                                                value="{{$user->name_en}}"
                                                placeholder="{{__('dashboard.table.name_en')}}"
                                                required
                                            />
                                        </div>
                                        <div class="col-md-6 col-6 mb-3">
                                            <label for="role_id" class="form-label">{{(__('dashboard.role.roles'))}}</label>
                                            <select class="form-select" name="role_id" id="role"
                                                    aria-label="Default select example" required>
                                                <option value="0" selected disabled>{{(__('dashboard.role.roles'))}}</option>
                                                @foreach ($roles as $role)
                                                    <option value="{{ $role->id }}"
                                                        {{ $role->id == $user->role_id ? 'Selected' : '' }}>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">{{__('dashboard.user.email')}}</label>
                                        <input
                                            class="form-control"
                                            type="text"
                                            id="email"
                                            name="email"
                                            value="{{$user->email}}"
                                            placeholder="{{__('dashboard.user.email')}}"
                                        />
                                    </div>



                                    <div class="mb-3 form-password-toggle col-md-6">
                                        <label class="form-label" for="password">{{__('dashboard.user.password')}}</label>
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
                                        <label class="form-label" for="password_confirmation">{{__('dashboard.user.confirmation')}}</label>
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
