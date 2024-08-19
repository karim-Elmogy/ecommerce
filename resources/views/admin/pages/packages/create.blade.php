@extends('admin.layouts.app')
@section('content')
    <style>
        .file-upload {
            border: 2px dashed #ccc;
            border-radius: 10px;
            padding: 60px 0px;
            text-align: center;
            margin-bottom: 20px;
            position: relative;
            transition: background-color 0.3s ease;
        }

        .file-upload.dragover {
            background-color: #f0f0f0;
        }

        .file-upload input[type="file"] {
            display: none;
        }

        .file-upload label {
            width: 100%;
            height: 100%;
            display: inline-block;
            color: #d4d2d2;
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
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> {{__('dashboard.crud.add')}}/</span> {{__('dashboard.package.package')}}</h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{__('dashboard.crud.add')}}  {{__('dashboard.package.package')}}</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('admin.package.store')}}" enctype="multipart/form-data">
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
{{--                            <!-- Multi  -->--}}
{{--                            <div class="col-12">--}}
{{--                                <div class="container mt-5">--}}
{{--                                    <h5>{{__('dashboard.user.upload')}}</h5>--}}
{{--                                    <div class="file-upload">--}}
{{--                                        <label for="fileInput">click to upload</label>--}}
{{--                                        <input type="file" name="image[]" id="fileInput" multiple accept="image/*">--}}
{{--                                        <div class="file-preview" id="filePreview"></div>--}}

{{--                                    </div>--}}
{{--                                </div>--}}

{{--                            </div>--}}

{{--                            <!-- Multi  -->--}}

                            <div class="col-12">
                                <div class="container mt-5">
                                    <h5>{{__('dashboard.user.upload')}}</h5>
                                    <div class="file-upload" id="dropZone">
                                        <label for="fileInput">Click or drag files to upload</label>
                                        <input type="file" name="image[]" id="fileInput" multiple accept="image/*">
                                        <div class="file-preview" id="filePreview"></div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label class="form-label" for="title">{{__('dashboard.table.name_ar')}} </label>
                                    <input type="text" class="form-control" id="name_ar" value="{{old('name_ar')}}" placeholder="{{__('dashboard.table.name_ar')}}" name="name_ar" />
                                </div>

                                <div class="mb-3 col-6">
                                    <label class="form-label" for="title">{{__('dashboard.table.name_en')}} </label>
                                    <input type="text" class="form-control"  value="{{old('name_en')}}"  id="name_en" placeholder="{{__('dashboard.table.name_en')}}" name="name_en" />
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-6 mb-3">
                                    <label for="category_id" class="form-label">{{(__('dashboard.partner.partners'))}}</label>
                                    <select class="form-select" name="partner_id" id="category"
                                            aria-label="Default select example" required>
                                        <option value="0" selected disabled>{{(__('dashboard.partner.partners'))}}</option>
                                        @foreach ($partners as $partner)
                                            <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-6 mb-3">
                                    <label for="category_id" class="form-label">{{(__('dashboard.category.categories'))}}</label>
                                    <select class="form-select" name="category_id" id="category"
                                            aria-label="Default select example" required>
                                        <option value="0" selected disabled>{{(__('dashboard.category.categories'))}}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
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

                                <div class="mb-3 col-6">
                                    <label class="form-label" for="title">{{__('dashboard.table.price')}} </label>
                                    <input type="text" class="form-control"  value="{{old('g_price')}}"  id="price" placeholder="{{__('dashboard.table.price')}}" name="g_price" />
                                </div>

                            </div>


                            <div class="row">
                                <div class="mb-3 col-12">
                                    <label class="form-label" for="desc_ar">{{__('dashboard.table.desc_ar')}} </label>
                                    <textarea class="form-control "  rows="12" id="desc_ar" name="desc_ar">{{ old('desc_ar') }}</textarea>
                                </div>

                                <div class="mb-3 col-12">
                                    <label class="form-label" for="desc_en">{{__('dashboard.table.desc_en')}} </label>
                                    <textarea class="form-control " id="desc_en" name="desc_en">{{ old('desc_en') }}</textarea>
                                </div>

                                <div class="mb-3 col-12">
                                    <label class="form-label" for="includes">{{__('dashboard.package.includes')}} </label>
                                    <textarea class="form-control editor" id="includes" name="includes">{{ old('includes') }}</textarea>
                                </div>

                                <div class="mb-3 col-6">
                                    <label class="form-label" for="title">{{__('dashboard.table.instagram')}} </label>
                                    <input type="url" class="form-control"  value="{{old('instagram')}}"  id="name_en" placeholder="{{__('dashboard.table.instagram')}}" name="instagram" />
                                </div>

                            </div>








                            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{__('dashboard.general.details')}}</h4>

                            <div class="row">

                                <div class="mb-3 col-6">
                                    <label class="form-label" for="title">{{__('dashboard.package.answer_a')}} </label>
                                    <input type="text" class="form-control"  value="{{old('answer_a')}}"  id="price" placeholder="{{__('dashboard.package.answer_a')}}" name="answer_a" />
                                </div>


                                <div class="mb-3 col-6">
                                    <label class="form-label" for="title">{{__('dashboard.package.answer_b')}} </label>

                                    <select class="form-select  rounded-0 rounded-start" name="answer_b" aria-label="Default select example" required >
                                        <option value="0" selected >{{(__('dashboard.package.answer_b'))}}</option>
                                        <option value="active" >{{__('dashboard.package.active')}}</option>
                                            <option value="not">{{__('dashboard.package.no_active')}}</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-6">
                                    <label class="form-label" for="title">{{__('dashboard.package.answer_c')}} </label>

                                    <select class="form-select  rounded-0 rounded-start" name="answer_c" aria-label="Default select example" required >
                                        <option value="0" selected >{{(__('dashboard.package.answer_c'))}}</option>
                                        <option value="active">{{__('dashboard.package.active')}}</option>
                                        <option value="not">{{__('dashboard.package.no_active')}}</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-6">
                                    <label class="form-label" for="title">{{__('dashboard.package.answer_d')}} </label>

                                    <select class="form-select  rounded-0 rounded-start" name="answer_d" aria-label="Default select example" required >
                                        <option value="0" selected >{{(__('dashboard.package.answer_d'))}}</option>
                                        <option value="active">{{__('dashboard.package.active')}}</option>
                                        <option value="not">{{__('dashboard.package.no_active')}}</option>
                                    </select>
                                </div>

                                <div class="mb-3 col-6">
                                    <label class="form-label" for="title">{{__('dashboard.package.answer_e')}} </label>

                                    <select class="form-select  rounded-0 rounded-start" name="answer_e" aria-label="Default select example" required >
                                        <option value="0" selected >{{(__('dashboard.package.answer_e'))}}</option>
                                        <option value="active">{{__('dashboard.package.active')}}</option>
                                        <option value="not">{{__('dashboard.package.no_active')}}</option>
                                    </select>
                                </div>


                            </div>











                            <div class="row mb-3">
                                <div class="col-sm-12">
                                    <div class="table-header p-1 py-2 d-flex align-items-center justify-content-between">
                                        <label class="form-label">{{__('dashboard.package.time_price')}}</label>
                                        <button type="button" name="add" id="dynamic-ar-1" class="btn btn-sm btn-primary">{{__('dashboard.crud.add')}}</button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dynamicAddRemove-1">
                                            <tr class="text-center">
                                                <th>{{__('dashboard.package.time')}}</th>
                                                <th>{{__('dashboard.package.price')}}</th>
                                                <th>{{__('dashboard.package.unit')}}</th>
                                                <th>{{__('dashboard.table.control')}}</th>
                                            </tr>
                                            <tr class="text-center">
                                                <td>
                                                    <input type="number" name="time[]" placeholder="{{__('dashboard.package.time')}}" class="form-control" required />
                                                </td>
                                                <td>
                                                    <input type="text" name="price[]" placeholder="{{__('dashboard.package.price')}}" class="form-control" required />
                                                </td>
                                                <td>
                                                    <input type="text" name="unit[]" placeholder="{{__('dashboard.package.unit')}}" value="ريال" class="form-control" required />
                                                </td>

                                                <td>
                                                    <button type="button" class="btn btn-sm btn-outline-danger remove-input-field-1">{{__('dashboard.crud.delete')}}</button>

                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                                    <script type="text/javascript">
                                        $("#dynamic-ar-1").click(function() {
                                            $("#dynamicAddRemove-1").append(`<tr>
                                                <td>
                                                    <input type="number" name="time[]" placeholder="المدة"  class="form-control" required />
                                                </td>
                                                <td>
                                                    <input type="text" name="price[]"  placeholder="السعر" class="form-control" required />
                                                </td>
                                                <td>
                                                    <input type="text" name="unit[]"  value="ريال" placeholder="الوحدة" class="form-control" required />
                                                </td>



                                                <td>
                                                    <button type="button" class="btn btn-sm btn-outline-danger remove-input-field-1">حذف</button>

                                                </td>
                                    </tr>`);
                                        });
                                        $(document).on('click', '.remove-input-field-1', function() {
                                            $(this).parents('tr').remove();
                                        });
                                    </script>
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

