@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{__('dashboard.sidebar.app')}} /</span> {{__('dashboard.slider.sliders')}}</h4>

        <div class="card">
            <div class="table-header d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{__('dashboard.slider.sliders')}}</h5>
{{--                <form action="{{route('admin.slider.search')}}" method="GET">--}}
{{--                    @csrf--}}
{{--                    <div class="d-flex align-items-center justify-content-between">--}}
{{--                        <span class="me-2">{{__('dashboard.general.from')}}</span>--}}
{{--                        <input class="form-control me-2" name="from" type="datetime-local" value="" id="html5-datetime-local-input" />--}}
{{--                        <span class="me-2">{{__('dashboard.general.to')}}</span>--}}
{{--                        <input class="form-control me-2" name="to" type="datetime-local" value="" id="html5-datetime-local-input" />--}}
{{--                        <button type="submit"  class="btn btn btn-primary">{{__('dashboard.search.search')}}</button>--}}
{{--                    </div>--}}
{{--                </form>--}}
                <a href="{{route('admin.slider.create')}}" class="btn btn btn-primary me-5">{{__('dashboard.crud.add')}} {{__('dashboard.slider.slider')}}</a>
            </div>
            <div class="card-body pt-4">
                <div class="table-responsive-md text-nowrap">
                    @if (!empty($sliders) && count($sliders) > 0)
                        <table class="table">
                            <thead>
                            <tr class="text-center">
                                <th class=""><i class='bx bx-sort-up'></i></th>
                                <th>#</th>
                                <th>{{__('dashboard.table.image')}}</th>
                                <th>{{__('dashboard.table.title')}}</th>
                                <th>{{__('dashboard.table.control')}}</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0" id="CateList4">
                            @foreach ($sliders as $slider)
                                <tr class="text-center" data-product-id="{{ $slider->id }} ">
                                    <td>
                                        <i style="cursor: pointer" class='bx bx-sort'></i>
                                    </td>
                                    <td>
                                        {{ $sliders->perPage() * ($sliders->currentPage() - 1) + $loop->iteration }}
                                    </td>

                                    <td>
                                        @if($slider->image)
                                            <img src="{{url('/dash-img/slider/'.$slider->image)}}"  class="rounded" height="20" width="20"/>
                                        @else
                                            <img src="{{url('../assets/admin/img/avatars/1.png')}}"  class="rounded" height="20" width="20" />
                                        @endif
                                    </td>



                                    <td>{{$slider->title}}</td>


                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">

                                                <a class="dropdown-item" href="{{route('admin.slider.edit',$slider->id)}}"
                                                ><i class="bx bx-edit-alt me-1"></i>{{__('dashboard.crud.edit')}} </a>

                                                <button type="button" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="{{'#modalCenter'.$slider->id}}">
                                                    <i class="bx bx-trash me-1"></i> {{__('dashboard.crud.delete')}}
                                                </button>

                                            </div>

                                        </div>
                                    </td>
                                </tr>


                                <!-- Modal -->
                                <div class="modal fade" id="{{'modalCenter'.$slider->id}}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalCenterTitle">{{__('dashboard.crud.delete')}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{route('admin.slider.destroy',$slider->id)}}" method="POST">

                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameWithTitle" class="form-label">{{__('dashboard.table.delete')}}</label>
                                                            <input type="text" disabled id="nameWithTitle" value="{{__('dashboard.slider.slider')}}" class="form-control">
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
                    @else
                        <div>
                            <h3 class="text-info text-primary" style="text-align: center">{{ __('dashboard.table.empty') }}</h3>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-footer py-0">
                {{$sliders->links('pagination::bootstrap-5')}}
            </div>
        </div>



    </div>



    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.lock-button').click(function () {
                var isLocked = $(this).attr('data-locked') === 'true';
                var $form = $(this).closest('.status-container').find('.status-form');
                var $select = $form.find('.status-select');

                if (isLocked) {
                    $(this).attr('data-locked', 'false');
                    $(this).text('🔓');
                    $select.prop('disabled', false);
                } else {
                    $(this).attr('data-locked', 'true');
                    $(this).text('🔒');
                    $select.prop('disabled', true);
                }
            });

            $('.status-select').change(function () {
                var $lockButton = $(this).closest('.status-container').find('.lock-button');
                var isLocked = $lockButton.attr('data-locked') === 'true';

                if (!isLocked) {
                    // Editing is allowed only when the lock is open
                    var selectedStatus = $(this).val();
                    var formData = $(this).closest('.status-form').serializeArray();

                    $.ajax({
                        type: 'POST',
                        url: '{{ route('admin.offer.status') }}',
                        data: formData,
                        success: function (response) {
                            console.log(response);
                        },
                        error: function (error) {
                            console.error(error);
                        }
                    });
                }
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cateList = document.getElementById('CateList4');

            new Sortable(cateList, {
                animation: 250,
                ghostClass: 'ghost',
                onEnd: function(evt) {
                    let cateIds = [];
                    cateList.querySelectorAll('tr').forEach((product, index) => {
                        cateIds.push(product.dataset.productId);
                    });
                    console.log(cateIds);
                    fetch('{{ route('update_slider_order') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            cateIds: cateIds
                        }),
                    });
                }
            });
        });
    </script>

@endsection
