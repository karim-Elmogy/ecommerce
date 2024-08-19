@extends('admin.layouts.app')

@section('content')
    <style>
        .list-side{
            display: flex;
            align-items: center;
            justify-content: flex-start;
            margin: 0;
            padding: 0;
            gap: 0.78vw;
            padding-right: 2.6vw;

        }
    </style>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">{{__('dashboard.sidebar.app')}}<span class="text-muted fw-light"> / {{__('dashboard.course.course')}} </span></h4>

        <div class="col-md-4 col-4 mb-3">
            <label for="category_id" class="form-label">{{(__('dashboard.partner.partners'))}}</label>
            <select class="form-select" name="partner_id" id="partner"
                    aria-label="Default select example" required>
                <option value="0" selected disabled>{{(__('dashboard.partner.partners'))}}</option>
                @foreach ($partners as $partner)
                    <option value="{{ $partner->id }}" {{$c_partner == $partner->id ? 'selected' : ' '}}>{{ $partner->name }}</option>
                @endforeach
            </select>
        </div>

        @if (!empty($courses) && count($courses) > 0)
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{__('dashboard.crud.show')}} {{__('dashboard.course.course')}}</h5>
                        <a href="{{route('admin.course.create')}}" class="btn btn-warning me-2">اضافة </a>

                        {{-- <small class="text-muted float-end">Default label</small> --}}
                    </div>


                    <div class="card-body">
                        <div class="my-3">
                            <div class="col-lg-12 mb-4 mb-xl-0">
                                <div class="demo-inline-spacing mt-3">
                                    <div class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center active">
{{--                                           {{__('dashboard.course.course')}}--}}
                                            الدورات
                                        </li>



                                        <table class="table">
                                            <tbody>
                                            @foreach ($courses as $item)
                                                <tr>
                                                    <td style="width: 900px;">
                                                        {{ $item->key }}
                                                        <br>
                                                        @php
                                                            $string =$item->value;
                                                            $delimiter = "-";
                                                            // Check if the string starts with a hyphen
                                                            if (strpos($string, $delimiter) == 0) {
                                                                $check=0;
                                                            }else{
                                                                $check=1;
                                                            }


                                                            // Split the string by the delimiter
                                                            $parts = explode($delimiter, $string);

                                                            // Trim whitespace from each part
                                                            $parts = array_map('trim', $parts);
                                                        @endphp

                                                        @if($check == 0)
                                                            <p> {{$item->value}}</p>
                                                        @else
                                                            <ul class="list-side list-unstyled pb-3">
                                                                @foreach($parts as $part)
                                                                    <li>{{$part}}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif

                                                        @if($item->note != null)
                                                            <span style="background-color: #9F85F3; padding: 8px ; color: white;border-radius: 15px">{{$item->note}}</span>
                                                        @endif

                                                        @if($item->price)
                                                            <span class="bg-warning" style="padding: 8px 12px; @if($item->note != null) margin-right: 20px;@endif  color: white;border-radius: 15px">{{$item->price}} SAR</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <a href="{{ route("admin.course.edit", $item->id) }}" class="btn btn-primary">
                                                            <i class="bx bx-edit me-1" style="color: white"></i>
                                                            {{ __('dashboard.crud.edit') }}</a>
                                                        <a  class="btn btn-danger" style="color: white"  data-bs-toggle="modal" data-bs-target="{{'#modalCenter'.$item->id}}">
                                                            <i class="bx bx-trash me-1" style="color: white"></i> {{__('dashboard.crud.delete')}}
                                                        </a>
                                                    </td>
                                                </tr>

                                                <!-- Modal -->
                                                <div class="modal fade" id="{{'modalCenter'.$item->id}}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalCenterTitle">{{__('dashboard.crud.delete')}}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{route('admin.course.destroy',$item->id)}}" method="POST">

                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col mb-3">
                                                                            <label for="nameWithTitle" class="form-label">{{__('dashboard.table.delete')}}</label>
                                                                            <input type="text" disabled id="nameWithTitle" value="{{$item->key}}" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{__('dashboard.profile.close')}}</button>
                                                                    <button type="submit" class="btn btn-primary">{{__('dashboard.profile.submit')}}</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="my-3">
                            <div class="col-lg-12 mb-4 mb-xl-0">
                                <div class="demo-inline-spacing mt-3">
                                    <div class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center active">
                                            {{--                                           {{__('dashboard.course.course')}}--}}
                                            السكن
                                        </li>


                                        <table class="table">
                                            <tbody>
                                            @foreach ($living as $item)
                                                <tr>
                                                    <td style="width: 900px;">
                                                        {{ $item->key }}
                                                        <br>
                                                        @php
                                                            $string =$item->value;
                                                            $delimiter = "-";
                                                            // Check if the string starts with a hyphen
                                                            if (strpos($string, $delimiter) == 0) {
                                                                $check=0;
                                                            }else{
                                                                $check=1;
                                                            }

                                                            // Split the string by the delimiter
                                                            $parts = explode($delimiter, $string);

                                                            // Trim whitespace from each part
                                                            $parts = array_map('trim', $parts);
                                                        @endphp

                                                        @if($check == 0)
                                                            <p> {{$item->value}}</p>
                                                        @else
                                                            <ul class="list-side list-unstyled pb-3">
                                                                @foreach($parts as $part)
                                                                    <li>{{$part}}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif

                                                        @if($item->note != null)
                                                            <span style="background-color: #9F85F3; padding: 8px ; color: white;border-radius: 15px">{{$item->note}}</span>
                                                        @endif

                                                        @if($item->price)
                                                            <span class="bg-warning" style="padding: 8px 12px; @if($item->note != null) margin-right: 20px;@endif color: white;border-radius: 15px">{{$item->price}} SAR</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <a href="{{ route("admin.course.edit", $item->id) }}" class="btn btn-primary">
                                                            <i class="bx bx-edit me-1" style="color: white"></i>
                                                            {{ __('dashboard.crud.edit') }}</a>
                                                        <a  class="btn btn-danger" style="color: white"  data-bs-toggle="modal" data-bs-target="{{'#modalCenter'.$item->id}}">
                                                            <i class="bx bx-trash me-1" style="color: white"></i> {{__('dashboard.crud.delete')}}
                                                        </a>
                                                    </td>
                                                </tr>

                                                <!-- Modal -->
                                                <div class="modal fade" id="{{'modalCenter'.$item->id}}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalCenterTitle">{{__('dashboard.crud.delete')}}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{route('admin.course.destroy',$item->id)}}" method="POST">

                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col mb-3">
                                                                            <label for="nameWithTitle" class="form-label">{{__('dashboard.table.delete')}}</label>
                                                                            <input type="text" disabled id="nameWithTitle" value="{{$item->key}}" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{__('dashboard.profile.close')}}</button>
                                                                    <button type="submit" class="btn btn-primary">{{__('dashboard.profile.submit')}}</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="my-3">
                            <div class="col-lg-12 mb-4 mb-xl-0">
                                <div class="demo-inline-spacing mt-3">
                                    <div class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center active">
                                            {{--                                           {{__('dashboard.course.course')}}--}}
                                            الإستقبال من المطار
                                        </li>


                                        <table class="table">
                                            <tbody>
                                            @foreach ($pick_up as $item)
                                                <tr>
                                                    <td style="width: 900px;">
                                                        {{ $item->key }}
                                                        <br>
                                                        @php
                                                            $string =$item->value;
                                                            $delimiter = "-";
                                                            // Check if the string starts with a hyphen
                                                            if (strpos($string, $delimiter) == 0) {
                                                                $check=0;
                                                            }else{
                                                                $check=1;
                                                            }

                                                            // Split the string by the delimiter
                                                            $parts = explode($delimiter, $string);

                                                            // Trim whitespace from each part
                                                            $parts = array_map('trim', $parts);
                                                        @endphp

                                                        @if($check == 0)
                                                            <p> {{$item->value}}</p>
                                                        @else
                                                            <ul class="list-side list-unstyled pb-3">
                                                                @foreach($parts as $part)
                                                                    <li>{{$part}}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif

                                                        @if($item->note)
                                                            <span style="background-color: #9F85F3; padding: 8px ; color: white;border-radius: 15px">{{$item->note}}</span>
                                                        @endif

                                                        @if($item->price)
                                                            <span class="bg-warning" style="padding: 8px 12px; @if($item->note) margin-right: 20px;@endif color: white;border-radius: 15px">{{$item->price}} SAR</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <a href="{{ route("admin.course.edit", $item->id) }}" class="btn btn-primary">
                                                            <i class="bx bx-edit me-1" style="color: white"></i>
                                                            {{ __('dashboard.crud.edit') }}</a>
                                                        <a  class="btn btn-danger" style="color: white"  data-bs-toggle="modal" data-bs-target="{{'#modalCenter'.$item->id}}">
                                                            <i class="bx bx-trash me-1" style="color: white"></i> {{__('dashboard.crud.delete')}}
                                                        </a>
                                                    </td>
                                                </tr>

                                                <!-- Modal -->
                                                <div class="modal fade" id="{{'modalCenter'.$item->id}}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalCenterTitle">{{__('dashboard.crud.delete')}}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{route('admin.course.destroy',$item->id)}}" method="POST">

                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col mb-3">
                                                                            <label for="nameWithTitle" class="form-label">{{__('dashboard.table.delete')}}</label>
                                                                            <input type="text" disabled id="nameWithTitle" value="{{$item->key}}" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{__('dashboard.profile.close')}}</button>
                                                                    <button type="submit" class="btn btn-primary">{{__('dashboard.profile.submit')}}</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="my-3">
                            <div class="col-lg-12 mb-4 mb-xl-0">
                                <div class="demo-inline-spacing mt-3">
                                    <div class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center active">
                                            {{--                                           {{__('dashboard.course.course')}}--}}
                                            التأمين الطبي للطالب
                                        </li>


                                        <table class="table">
                                            <tbody>
                                            @foreach ($medical as $item)
                                                <tr>
                                                    <td style="width: 900px;">
                                                        {{ $item->key }}
                                                        <br>
                                                        @php
                                                            $string =$item->value;
                                                            $delimiter = "-";
                                                            // Check if the string starts with a hyphen
                                                            if (strpos($string, $delimiter) == 0) {
                                                                $check=0;
                                                            }else{
                                                                $check=1;
                                                            }

                                                            // Split the string by the delimiter
                                                            $parts = explode($delimiter, $string);

                                                            // Trim whitespace from each part
                                                            $parts = array_map('trim', $parts);
                                                        @endphp

                                                        @if($check == 0)
                                                            <p> {{$item->value}}</p>
                                                        @else
                                                            <ul class="list-side list-unstyled pb-3">
                                                                @foreach($parts as $part)
                                                                    <li>{{$part}}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif

                                                        @if($item->note != null)
                                                            <span style="background-color: #9F85F3; padding: 8px ; color: white;border-radius: 15px">{{$item->note}}</span>
                                                        @endif

                                                        @if($item->price)
                                                            <span class="bg-warning" style="padding: 8px 12px; @if($item->note != null) margin-right: 20px;@endif color: white;border-radius: 15px">{{$item->price}} SAR</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <a href="{{ route("admin.course.edit", $item->id) }}" class="btn btn-primary">
                                                            <i class="bx bx-edit me-1" style="color: white"></i>
                                                            {{ __('dashboard.crud.edit') }}</a>
                                                        <a  class="btn btn-danger" style="color: white"  data-bs-toggle="modal" data-bs-target="{{'#modalCenter'.$item->id}}">
                                                            <i class="bx bx-trash me-1" style="color: white"></i> {{__('dashboard.crud.delete')}}
                                                        </a>
                                                    </td>
                                                </tr>

                                                <!-- Modal -->
                                                <div class="modal fade" id="{{'modalCenter'.$item->id}}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalCenterTitle">{{__('dashboard.crud.delete')}}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{route('admin.course.destroy',$item->id)}}" method="POST">

                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col mb-3">
                                                                            <label for="nameWithTitle" class="form-label">{{__('dashboard.table.delete')}}</label>
                                                                            <input type="text" disabled id="nameWithTitle" value="{{$item->key}}" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{__('dashboard.profile.close')}}</button>
                                                                    <button type="submit" class="btn btn-primary">{{__('dashboard.profile.submit')}}</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="my-3">
                            <div class="col-lg-12 mb-4 mb-xl-0">
                                <div class="demo-inline-spacing mt-3">
                                    <div class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center active">
                                            {{--                                           {{__('dashboard.course.course')}}--}}
                                            رسوم أخرى
                                        </li>


                                        <table class="table">
                                            <tbody>
                                            @foreach ($other_fees as $item)
                                                <tr>
                                                    <td style="width: 900px;">
                                                        {{ $item->key }}
                                                        <br>
                                                        @php
                                                            $string =$item->value;
                                                            $delimiter = "-";
                                                            // Check if the string starts with a hyphen
                                                            if (strpos($string, $delimiter) == 0) {
                                                                $check=0;
                                                            }else{
                                                                $check=1;
                                                            }

                                                            // Split the string by the delimiter
                                                            $parts = explode($delimiter, $string);

                                                            // Trim whitespace from each part
                                                            $parts = array_map('trim', $parts);
                                                        @endphp

                                                        @if($check == 0)
                                                            <p> {{$item->value}}</p>
                                                        @else
                                                            <ul class="list-side list-unstyled pb-3">
                                                                @foreach($parts as $part)
                                                                    <li>{{$part}}</li>
                                                                @endforeach
                                                            </ul>
                                                        @endif

                                                        @if($item->note != null)
                                                            <span style="background-color: #9F85F3; padding: 8px ; color: white;border-radius: 15px">{{$item->note}}</span>
                                                        @endif

                                                        @if($item->price)
                                                            <span class="bg-warning" style="padding: 8px 12px; @if($item->note != null) margin-right: 20px;@endif color: white;border-radius: 15px">{{$item->price}} SAR</span>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        <a href="{{ route("admin.course.edit", $item->id) }}" class="btn btn-primary">
                                                            <i class="bx bx-edit me-1" style="color: white"></i>
                                                            {{ __('dashboard.crud.edit') }}</a>
                                                        <a  class="btn btn-danger" style="color: white"  data-bs-toggle="modal" data-bs-target="{{'#modalCenter'.$item->id}}">
                                                            <i class="bx bx-trash me-1" style="color: white"></i> {{__('dashboard.crud.delete')}}
                                                        </a>
                                                    </td>
                                                </tr>

                                                <!-- Modal -->
                                                <div class="modal fade" id="{{'modalCenter'.$item->id}}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalCenterTitle">{{__('dashboard.crud.delete')}}</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{route('admin.course.destroy',$item->id)}}" method="POST">

                                                                @csrf
                                                                @method('DELETE')
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        <div class="col mb-3">
                                                                            <label for="nameWithTitle" class="form-label">{{__('dashboard.table.delete')}}</label>
                                                                            <input type="text" disabled id="nameWithTitle" value="{{$item->key}}" class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{__('dashboard.profile.close')}}</button>
                                                                    <button type="submit" class="btn btn-primary">{{__('dashboard.profile.submit')}}</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>

        @else
            <div>
                <h3 class="text-info text-primary" style="text-align: center">{{ __('dashboard.table.empty') }}</h3>
            </div>
        @endif
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function(){
            $('#partner').change(function(){
                var partnerId = $(this).val();
                var url = '/your-route-url/' + partnerId; // Create the URL with partnerId as part of the path
                // Redirect to the new URL
                window.location.href = url;
            });
        });
    </script>



@endsection
