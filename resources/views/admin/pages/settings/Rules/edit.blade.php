@extends('admin.layouts.app')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><a href="{{route('admin.course.index')}}"><span class="text-muted fw-light"> {{__('dashboard.course.course')}}/</span></a> {{__('dashboard.crud.edit')}}</h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{__('dashboard.crud.edit')}}  {{__('dashboard.course.course')}}</h5>
                        {{-- <small class="text-muted float-end">Default label</small> --}}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('admin.course.update',$item->id)}}" enctype="multipart/form-data">
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

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="title">{{__('dashboard.table.name')}} </label>
                                        <input class="form-control" name="key" value="{{$item->key}}">

                                    </div>
                                </div>

                                <div class="col-md-6 col-6 mb-3">
                                    <label for="category_id" class="form-label">{{(__('dashboard.partner.partners'))}}</label>
                                    <select class="form-select" name="partner_id" id="partner"
                                            aria-label="Default select example" required>
                                        <option value="0" selected disabled>{{(__('dashboard.partner.partners'))}}</option>
                                        @foreach ($partners as $partner)
                                            <option value="{{ $partner->id }}" {{$item->partner_id == $partner->id ? 'selected' : ' '}}>{{ $partner->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                    <div class="col-12">
                                        <div class="mb-3">

                                            <label class="form-label" for="title">{{__('dashboard.general.details')}} </label>
                                            <textarea class="form-control" name="value"  id="exampleFormControlTextarea1" rows="3">{{$item->value}}</textarea>
                                            <label class="form-label" for="title"> لاضافة التفاصيل علي هيئة قائمة يجب استخدام (-) بعد كل جملة </label>

                                        </div>
                                    </div>

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label class="form-label" for="title">{{__('dashboard.table.note')}} </label>
                                        <input class="form-control" name="note" value="{{$item->note}}">

                                    </div>
                                </div>

                            </div>


                            <div class="row mb-3">
                                <div class="col-sm-12">


                                    @if ($item->itemPlan->count() != 0 )
                                        <div class="table-header p-1 py-3 d-flex align-items-center justify-content-between">
                                            <label class="form-label">{{__('dashboard.package.time_price')}}</label>
                                            <button type="button" name="add" id="dynamic-ar-1" class="btn btn-sm btn-primary">{{__('dashboard.crud.add')}}</button>
                                        </div>
                                    @else
                                        <label class="form-label">{{__('dashboard.package.time')}}</label>
                                    @endif

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
                                            @if (!empty($item->itemPlan) && count($item->itemPlan) > 0)
                                                @foreach($item->itemPlan as $packagePlan)
                                                    <tr class="text-center">
                                                        <td>
                                                            <input type="number" name="from[]" value="{{$packagePlan->from}}" placeholder="{{__('dashboard.general.from')}}" class="form-control" required />
                                                        </td>
                                                        <td>
                                                            <input type="number" name="to[]" value="{{$packagePlan->to}}" placeholder="{{__('dashboard.general.to')}}" class="form-control" required />
                                                        </td>
                                                        <td>
                                                            <input type="text" name="price[]" value="{{$packagePlan->price}}" placeholder="{{__('dashboard.package.price')}}" class="form-control" required />
                                                        </td>
                                                        <td>
                                                            <input type="text" name="year[]" value="{{$packagePlan->year}}" placeholder="{{__('dashboard.table.year')}}" class="form-control" required />
                                                        </td>
                                                        <td>
                                                            <input type="text" name="unit[]" value="{{$packagePlan->unit}}" placeholder="{{__('dashboard.package.unit')}}" value="ريال" class="form-control" required />
                                                        </td>



                                                        <td>
                                                            @if ($item->itemPlan->count() == 0 )
                                                                <button type="button" data-id="{{ $packagePlan->id }}" name="add" id=""
                                                                        class="btn btn-sm btn-outline-danger"
                                                                        onclick="alert('هل تريد اتمام عملية الحذف ؟')">{{__('dashboard.crud.delete')}}</button>

                                                            @else
                                                                <button type="button" data-id="{{ $packagePlan->id }}" name="add" id=""
                                                                        class="btn btn-sm btn-outline-danger remove-input-field-1">{{__('dashboard.crud.delete')}}</button>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @else
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
                                                        <input type="text" name="year[]" placeholder="{{__('dashboard.table.year')}}" class="form-control" required />
                                                    </td>
                                                    <td>
                                                        <input type="text" name="unit[]" placeholder="{{__('dashboard.package.unit')}}" value="ريال" class="form-control" required />
                                                    </td>



                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-outline-danger remove-input-field-1">{{__('dashboard.crud.delete')}}</button>
                                                </tr>
                                            @endif




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
                                                    <input type="text" name="unit[]" value="ريال"  placeholder="الوحدة" class="form-control" required />
                                                </td>


                                                <td>
                                                    <button type="button" class="btn btn-sm btn-outline-danger remove-input-field-1">حذف</button>
                                                </td>
                                    </tr>`);
                                        });
                                        $(document).on('click', '.remove-input-field-1', function() {
                                            var x = confirm("هل تريد اتمام عملية الحذف ؟ ");
                                            if (x) {
                                                var id = $(this).data("id");
                                                var token = $("meta[name='csrf-token']").attr("content");
                                                if (id == undefined) {
                                                    $(this).parents('tr').remove();
                                                    return falseN

                                                }
                                                $.ajax({
                                                    url: '/admin/setting/unit/' + id,
                                                    type: 'DELETE',
                                                    data: {
                                                        "id": id,
                                                        "_token": token,
                                                    },
                                                    success: function(data) {
                                                        $(this).parents('tr').remove();
                                                        location.reload(true);
                                                    }
                                                });
                                            } else {
                                                return false;
                                            }
                                        });
                                    </script>
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
