@extends('admin.layouts.app')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><a href="{{route('admin.course.index')}}"><span class="text-muted fw-light"> {{__('dashboard.course.course')}}/</span></a> {{__('dashboard.crud.add')}}</h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{__('dashboard.crud.add')}}  {{__('dashboard.course.course')}}</h5>
                        {{-- <small class="text-muted float-end">Default label</small> --}}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('admin.course.store')}}" enctype="multipart/form-data">
                            @csrf
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

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="title">{{__('dashboard.table.name')}} </label>
                                        <input class="form-control" name="key">

                                    </div>
                                </div>

{{--                                <div class="col-6">--}}
{{--                                    <div class="mb-3">--}}
{{--                                        <label class="form-label" for="title">{{__('dashboard.table.price')}} </label>--}}
{{--                                        <input class="form-control" name="price" >--}}

{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="col-md-6 col-6 mb-3">
                                    <label for="category_id" class="form-label">{{(__('dashboard.partner.partners'))}}</label>
                                    <select class="form-select" name="partner_id" id="partner"
                                            aria-label="Default select example" required>
                                        <option value="0" selected disabled>{{(__('dashboard.partner.partners'))}}</option>
                                        @foreach ($partners as $partner)
                                            <option value="{{ $partner->id }}" >{{ $partner->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                    <div class="col-12">
                                        <div class="mb-3">

                                            <label class="form-label" for="title">{{__('dashboard.general.details')}} </label>
                                            <textarea class="form-control" name="value"  id="exampleFormControlTextarea1" rows="3"></textarea>
                                            <label class="form-label" for="title"> لاضافة التفاصيل علي هيئة قائمة يجب استخدام (-) بعد كل جملة </label>

                                        </div>
                                    </div>

                                <div class="col-md-6 col-6 mb-3">
                                    <label for="city_id" class="form-label">{{(__('dashboard.general.type'))}}</label>
                                    <select class="form-select" name="section" id="section"
                                            aria-label="Default select example" required>
                                        <option value="0" selected disabled>{{(__('dashboard.general.type'))}}</option>
                                        <option value="courses"  >الدورات</option>
                                        <option value="living"  >السكن</option>
                                        <option value="pick_up"  >الإستقبال من المطار</option>
                                        <option value="medical"  >التأمين الطبي للطالب</option>
                                        <option value="other_fees"  >رسوم أخرى</option>

                                    </select>
                                </div>

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="title">{{__('dashboard.table.note')}} </label>
                                        <input class="form-control" name="note" >

                                    </div>
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
                                                <th>{{__('dashboard.general.from')}}</th>
                                                <th>{{__('dashboard.general.to')}}</th>
                                                <th>{{__('dashboard.table.price')}}</th>
                                                <th>{{__('dashboard.table.year')}}</th>
                                                <th>{{__('dashboard.package.unit')}}</th>
                                                <th>{{__('dashboard.table.control')}}</th>
                                            </tr>
                                            <tr class="text-center">
                                                <td>
                                                    <input type="number" name="from[]" placeholder="{{__('dashboard.general.from')}}" class="form-control" required />
                                                </td>
                                                <td>
                                                    <input type="number" name="to[]" placeholder="{{__('dashboard.general.to')}}" class="form-control" required />
                                                </td>
                                                <td>
                                                    <input type="text" name="price[]" placeholder="{{__('dashboard.table.price')}}" class="form-control" required />
                                                </td>
                                                <td>
                                                    <input type="text" name="year[]" placeholder="{{__('dashboard.table.year')}}" value="العام" class="form-control" required />
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
                                                    <input type="number" name="from[]" placeholder="من"  class="form-control" required />
                                                </td>

                                                <td>
                                                    <input type="number" name="to[]" placeholder="الي"  class="form-control" required />
                                                </td>

                                                <td>
                                                    <input type="text" name="price[]"  placeholder="السعر" class="form-control" required />
                                                </td>
                                                <td>
                                                    <input type="text" name="year[]"  placeholder="العام" class="form-control" required />
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

                            <button type="submit" class="btn btn-primary">{{__('dashboard.crud.add')}}</button>


                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>










@endsection
