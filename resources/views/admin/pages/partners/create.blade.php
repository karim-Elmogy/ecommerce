@extends('admin.layouts.app')
@section('content')
    <style>
        .file-upload {
            border: 2px dashed #ccc;
            border-radius: 10px;
            padding: 60px 0px;
            text-align: center;
            margin-bottom: 20px;
        }
        .file-upload input[type="file"] {
            display: none;
        }
        .file-upload label {
            width: 100%;
            height: 100%;
            display: inline-block;
            /*padding: 10px 20px;*/
            /*    background-color: #007bff;*/
            color: #d4d2d2;
            /*border-radius: 5px;*/
            cursor: pointer;
        }
        .file-preview {
            display: flex;
            flex-wrap: wrap;
            margin-top: 20px;
        }
        .file-item {
            width: 150px;
            margin: 10px;
            text-align: center;
            border: 1px solid #e0e0e0;
            border-radius: 5px;
            padding: 10px;
            background-color: #f8f8f8;
        }
        .file-item img {
            max-width: 100%;
            border-radius: 5px;
        }
        .remove-file {
            margin-top: 10px;
            cursor: pointer;
            color: #007bff;
        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y" >
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> {{__('dashboard.crud.add')}} /</span> {{__('dashboard.partner.partner')}}</h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"> {{__('dashboard.crud.add')}} {{__('dashboard.partner.partner')}}</h5>
                        {{--                         <small class="text-muted float-end">Default label</small>--}}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('admin.partner.store')}}" enctype="multipart/form-data">
                            @csrf

                            <!-- Multi  -->
                            <div class="col-12">
                                <div class="container mt-5">
                                    <h5>{{__('dashboard.user.upload')}}</h5>
                                    <div class="file-upload">
                                        <label for="fileInput">click to upload</label>
                                        <input type="file" name="image[]" id="fileInput" multiple accept="image/*">
                                        <div class="file-preview" id="filePreview"></div>

                                    </div>
                                </div>

                            </div>

                            <!-- Multi  -->
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
                                        <label for="name_ar" class="form-label">{{__('dashboard.partner.name_ar')}}</label>
                                        <input
                                            class="form-control"
                                            type="text"
                                            id="name_ar"
                                            name="name_ar"
                                            value="{{old('name_ar')}}"
                                            placeholder="{{__('dashboard.partner.name_ar')}}"
                                            required
                                        />
                                    </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="name_en" class="form-label">{{__('dashboard.partner.name_en')}}</label>
                                            <input
                                                class="form-control"
                                                type="text"
                                                id="name_en"
                                                name="name_en"
                                                value="{{old('name_en')}}"
                                                placeholder="{{__('dashboard.partner.name_en')}}"
                                                required
                                            />
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="name_ar" class="form-label">{{__('dashboard.partner.sort_title_ar')}}</label>
                                            <input
                                                class="form-control"
                                                type="text"
                                                id="sort_title_ar"
                                                name="sort_title_ar"
                                                value="{{old('sort_title_ar')}}"
                                                placeholder="{{__('dashboard.partner.sort_title_ar')}}"
                                                required
                                            />
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="name_en" class="form-label">{{__('dashboard.partner.sort_title_en')}}</label>
                                            <input
                                                class="form-control"
                                                type="text"
                                                id="sort_title_en"
                                                name="sort_title_en"
                                                value="{{old('sort_title_en')}}"
                                                placeholder="{{__('dashboard.partner.sort_title_en')}}"
                                                required
                                            />
                                        </div>

                                        <div class="mb-3 col-12">
                                            <label class="form-label" for="desc_ar">{{__('dashboard.partner.desc_ar')}} </label>
                                            <textarea class="form-control " id="desc_ar" name="desc_ar">{{ old('desc_ar') }}</textarea>
                                        </div>

                                        <div class="mb-3 col-12">
                                            <label class="form-label" for="desc_en">{{__('dashboard.partner.desc_en')}} </label>
                                            <textarea class="form-control " id="desc_en" name="desc_en">{{ old('desc_en') }}</textarea>
                                        </div>



                                        <div class="col-md-6 col-6 mb-3">
                                            <label for="city_id" class="form-label">{{(__('dashboard.city.cities'))}}</label>
                                            <select class="form-select" name="city_id" id="city"
                                                    aria-label="Default select example" required>
                                                <option value="0" selected disabled>{{(__('dashboard.city.cities'))}}</option>
                                                @foreach ($cities as $city)
                                                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                    <div class="mb-3 col-md-6">
                                        <label for="email" class="form-label">{{__('dashboard.partner.email')}}</label>
                                        <input
                                            class="form-control"
                                            type="text"
                                            id="email"
                                            name="email"
                                            value="{{old('email')}}"
                                            placeholder="{{__('dashboard.partner.email')}}"
                                        />
                                    </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="phone" class="form-label">{{__('dashboard.table.phone')}}</label>
                                            <input
                                                class="form-control"
                                                type="text"
                                                id="phone"
                                                name="phone"
                                                value="{{old('phone')}}"
                                                placeholder="{{__('dashboard.table.phone')}}"
                                            />
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label class="form-label" for="title">{{__('dashboard.table.price')}} </label>
                                            <input type="text" class="form-control"  value="{{old('price')}}"  id="price" placeholder="{{__('dashboard.table.price')}}" name="price" />
                                        </div>

                                        <div class="mb-3 col-6">
                                            <label class="form-label" for="title">{{__('dashboard.general.url')}} </label>
                                            <input type="url" class="form-control"  value="{{old('url')}}"  id="url" placeholder="{{__('dashboard.general.url')}}" name="url" />
                                        </div>



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
