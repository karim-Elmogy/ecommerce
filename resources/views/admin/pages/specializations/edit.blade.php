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
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> {{__('dashboard.crud.edit')}}/</span> {{__('dashboard.specialization.specialization')}}</h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{__('dashboard.crud.edit')}}  {{__('dashboard.specialization.specialization')}}</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('admin.specialization.update',$specialization->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
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

                            <div class="d-flex pt-3 align-items-start align-items-sm-center gap-1">
{{--                                    @foreach ($specialization->specializationImage as $image)--}}
                                        <div class="position-relative me-2 mb-2" style="width: 150px; height: 100px;">
                                            <img src="{{ url('/dash-img/specialization/' . $specialization->image) }}"  alt="Image" class="img-thumbnail" style="width: 100%; height: 100%;">
                                            <button type="button" data-image-id="{{$specialization->id}}" class="pckbtn btn btn-img-del position-absolute rounded-circle p-0" style="top: 7px; right: 7px; width: 35px; height: 35px; background-color: rgba(255, 62, 29, 0.7);transition: background-color 0.3s;"><i class="bx bx-trash text-white"></i></button>
                                        </div>
{{--                                    @endforeach--}}
                                </div>


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
                                    <input type="text" class="form-control" id="p_name_ar" value="{{$specialization->p_name_ar}}" placeholder="{{__('dashboard.table.name_ar')}}" name="p_name_ar" />
                                </div>

                                <div class="mb-3 col-6">
                                    <label class="form-label" for="title">{{__('dashboard.table.name_en')}} </label>
                                    <input type="text" class="form-control"  value="{{$specialization->p_name_en}}"  id="p_name_en" placeholder="{{__('dashboard.table.name_en')}}" name="p_name_en" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label" for="title">{{__('dashboard.table.title_ar')}} </label>
                                    <input type="text" class="form-control" id="title_ar" value="{{$specialization->title_ar}}" placeholder="{{__('dashboard.table.title_ar')}}" name="title_ar" />
                                </div>

                                <div class="mb-3 col-6">
                                    <label class="form-label" for="title">{{__('dashboard.table.title_en')}} </label>
                                    <input type="text" class="form-control"  value="{{$specialization->title_en}}"  id="title_en" placeholder="{{__('dashboard.table.title_en')}}" name="title_en" />
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6 col-6 mb-3">
                                    <label for="partner_id" class="form-label">{{(__('dashboard.partner.partners'))}}</label>
                                    <select class="form-select" name="partner_id" id="partner"
                                            aria-label="Default select example" required>
                                        <option value="0" selected disabled>{{(__('dashboard.partner.partners'))}}</option>
                                        @foreach ($partners as $partner)
                                            <option value="{{ $partner->id }}" {{ $partner->id ==  $specialization->partner_id ? 'selected' : '' }}>{{ $partner->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3 col-6">
                                    <label class="form-label" for="title">{{__('dashboard.table.price')}} </label>
                                    <input type="text" class="form-control"  value="{{$specialization->order_price}}"  id="order_price" placeholder="{{__('dashboard.table.price')}}" name="order_price" />
                                </div>


                            </div>


                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="desc_ar">{{__('dashboard.table.desc_ar')}} </label>
                                    <textarea class="form-control "  rows="12" id="p_desc_ar" name="p_desc_ar">{{ $specialization->p_desc_ar }}</textarea>
                                </div>

                                <div class="mb-3 col-12">
                                    <label class="form-label" for="desc_en">{{__('dashboard.table.desc_en')}} </label>
                                    <textarea class="form-control " id="p_desc_en" name="p_desc_en">{{ $specialization->p_desc_en}}</textarea>
                                </div>



                                <div class="mb-3 col-6">
                                    <label class="form-label" for="title">{{__('dashboard.general.language')}} </label>
                                    <input type="text" class="form-control"  value="{{$specialization->language}}"  id="language" placeholder="{{__('dashboard.general.language')}}" name="language" />
                                </div>

                                <div class="mb-3 col-6">
                                    <label class="form-label" for="title">{{__('dashboard.general.requirement')}} </label>
                                    <input type="text" class="form-control"  value="{{$specialization->requirement}}"  id="requirement" placeholder="{{__('dashboard.general.requirement')}}" name="requirement" />
                                </div>

                                <div class="mb-3 col-6">
                                    <label class="form-label" for="title">{{__('dashboard.general.duration_accept')}} </label>
                                    <input type="text" class="form-control"  value="{{$specialization->duration_accept}}"  id="duration_accept" placeholder="{{__('dashboard.general.duration_accept')}}" name="duration_accept" />
                                </div>

                            </div>



                            <div class="p-4">
                                <button type="submit" class="btn btn-primary">{{__('dashboard.user.submit')}}</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

