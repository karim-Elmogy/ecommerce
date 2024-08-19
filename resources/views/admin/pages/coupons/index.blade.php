@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{__('dashboard.sidebar.app')}} /</span> {{__('dashboard.coupon.coupons')}}</h4>

        <div class="card">
            <div class="table-header d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{__('dashboard.crud.add')}} {{__('dashboard.coupon.coupon')}}</h5>
                <a href="{{route('admin.coupon.create')}}" class="btn btn btn-primary me-5">{{__('dashboard.crud.add')}} {{__('dashboard.coupon.coupon')}}</a>
            </div>

            <div class="card-body pt-0">
                <div class="table-responsive-md  text-nowrap">
                @if (!empty($coupons) && count($coupons) > 0)
                        <table class="table">
                            <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>{{__('dashboard.table.code')}}</th>
                                <th>{{__('dashboard.table.discount_percentage')}}</th>
                                <th>{{__('dashboard.table.expiry_date')}}</th>
                                <th>{{__('dashboard.table.status')}}</th>
                                <th>{{__('dashboard.table.control')}}</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @foreach ($coupons as $coupon)
                                <tr class="text-center">
                                    <td>
                                        {{ $coupons->perPage() * ($coupons->currentPage() - 1) + $loop->iteration }}
                                    </td>
                                    <td>{{$coupon->code}}</td>
                                    <td>{{$coupon->discount_percentage}}</td>
                                    <td>{{$coupon->expiry_date}}</td>
                                    <td>
                                        <div class="status-container">
                                            <div class="row">

                                                <div class="col-md-8 p-0">
                                                    <form class="status-form" action="{{ route('admin.admins.status') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $coupon->id }}">
                                                        <select class="form-select status-select rounded-0 rounded-start" name="status" aria-label="Default select example" required disabled>
                                                            @if($coupon->is_active == 1)
                                                                <option value="1" selected>{{__('dashboard.table.active')}}</option>
                                                                <option value="0">{{__('dashboard.table.no_active')}}</option>
                                                            @else
                                                                <option value="1">{{__('dashboard.table.active')}}</option>
                                                                <option value="0" selected>{{__('dashboard.table.no_active')}}</option>
                                                            @endif
                                                        </select>
                                                    </form>
                                                </div>
                                                <div class="col-md-4 p-0 bg-primary rounded-end">
                                                    <button class="btn lock-button px-1" data-locked="true">🔒</button>
                                                </div>
                                            </div>

                                        </div>
                                    </td>
                                    <td class="col-3">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('admin.coupon.edit',$coupon->id)}}"
                                                ><i class="bx bx-edit-alt me-1"></i>{{__('dashboard.crud.edit')}} </a>

                                                <button type="button" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="{{'#modalCenter'.$coupon->id}}">
                                                    <i class="bx bx-trash me-1"></i> {{__('dashboard.crud.delete')}}
                                                </button>

                                            </div>

                                        </div>
                                    </td>
                                </tr>



                                <!-- Modal -->
                                <div class="modal fade" id="{{'modalCenter'.$coupon->id}}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalCenterTitle">{{__('dashboard.crud.delete')}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{route('admin.coupon.destroy',$coupon->id)}}" method="POST">

                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameWithTitle" class="form-label">{{__('dashboard.table.delete')}}</label>
                                                                <input type="text" disabled id="nameWithTitle" value="{{$coupon->code}}" class="form-control">
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
                {{$coupons->links('pagination::bootstrap-5')}}
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
                        url: '{{ route('admin.coupon.status') }}',
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


@endsection

