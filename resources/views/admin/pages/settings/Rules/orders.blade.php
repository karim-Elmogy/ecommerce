@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y" >
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{__('dashboard.sidebar.app')}} /</span> {{__('dashboard.order.orders')}}</h4>

        <div class="card">
            <div class="table-header d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{__('dashboard.order.orders')}}</h5>
{{--                <a href="{{route('admin.order.create')}}" class="btn btn btn-primary me-5">{{__('dashboard.crud.add')}} {{__('dashboard.order.order')}}</a>--}}
            </div>

            <div class="card-body pt-0">
                <div class="table-responsive-md text-nowrap">
                    @if (!empty($payments) && count($payments) > 0)
                        <table class="table" >
                            <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>{{__('dashboard.table.name')}}</th>
                                <th>{{__('dashboard.table.status')}}</th>
                                <th>{{__('dashboard.partner.partner')}}</th>
{{--                                <th>{{__('dashboard.package.package')}}</th>--}}

                                <th>{{__('dashboard.table.phone')}}</th>
                                <th>{{__('dashboard.table.date')}}</th>
                                <th>{{__('dashboard.table.control')}}</th>
                            </tr>
                            </thead>
                            <tbody id="payment_body" class="table-border-bottom-0">
                            @foreach ($payments as $payment)
                                <tr class="text-center">
                                    <td>{{ $payment->id }}</td>
                                    <td>{{ $payment->user->name }}</td>
                                    @if ($payment->status == 0)
                                        <td>
                                            <span class="btn light btn-secondary  ">{{__('dashboard.general.new_older')}} </span>
                                        </td>
                                    @elseif ($payment->status == 1)
                                        <td>
                                            <span class="btn light btn-primary ">{{__('dashboard.order.ok')}}</span>
                                        </td>
                                    @elseif ($payment->status == 2)
                                        <td>
                                            <span class="btn light btn-danger ">{{__('dashboard.order.delivery')}}</span>
                                        </td>
                                    @elseif ($payment->status == 3)
                                        <td>
                                            <span class="btn light btn-success ">{{__('dashboard.order.paid')}}</span>
                                        </td>
                                    @endif

                                        <td>{{ @$payment->partner->name }}</td>

                                    <td>{{ @$payment->user->phone }}</td>
                                    <td>{{$payment->created_at->format('Y-m-d')}}</td>

                                    <td class="d-flex flex-direction-row ">
                                        <!-- Button trigger modal -->
                                        <a href="{{route('admin.course.show',$payment->id)}}" class="btn btn-warning me-2">
                                            {{__('dashboard.crud.show')}} <i class='bx bx-show'></i>
                                        </a>



                                        <div class="dropdown ml-auto">
                                            <button class="btn btn-primary dropdown-toggle me-2" data-bs-toggle="dropdown" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <span>{{__('dashboard.table.control')}}</span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <form method="POST" action="{{route('admin.order.update',$payment->id)}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input hidden name="key" value="ok">
                                                    <button class="dropdown-item">
                                                        {{__('dashboard.order.ok')}}
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{route('admin.order.update',$payment->id)}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input hidden name="key" value="delivery">
                                                    <button class="dropdown-item">
                                                        {{__('dashboard.order.delivery')}}
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{route('admin.order.update',$payment->id)}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input hidden name="key" value="paid">
                                                    <button class="dropdown-item">
                                                        {{__('dashboard.order.paid')}}
                                                    </button>
                                                </form>
                                            </div>
                                        </div>


                                    </td>
                                </tr>

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
                {{ $payments->links('pagination::bootstrap-5') }}
            </div>
        </div>



    </div>
    <script>
        var print_icon = document.getElementById('print_icon');
        var payment_body = document.getElementById('payment_body');
        payment_body.addEventListener('click',function(e){

            if(e.target.className === "bx bxs-printer"){
                var content = e.target.parentElement.parentElement.parentElement.querySelector('.modal-body')
                document.body.innerHTML = content.innerHTML
                window.print();
                window.location.reload()
            }
        })
    </script>
@endsection
