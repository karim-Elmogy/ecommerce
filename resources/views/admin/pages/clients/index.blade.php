@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{__('dashboard.sidebar.app')}} /</span> {{__('dashboard.client.clients')}}</h4>

        <div class="card">
            <div class="table-header mb-5 mt-4 d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{__('dashboard.client.clients')}}</h5>
{{--                <form action="{{route('admin.user.search')}}" method="GET">--}}
                <form action="" method="GET">
                    @csrf
                    <div class="d-flex align-items-center justify-content-between">
                            <span class="me-2">{{__('dashboard.general.from')}}</span>
                            <input class="form-control me-2" name="from" type="datetime-local" value="" id="html5-datetime-local-input" />
                            <span class="me-2">{{__('dashboard.general.to')}}</span>
                            <input class="form-control me-2" name="to" type="datetime-local" value="" id="html5-datetime-local-input" />
                            <button type="submit"  class="btn btn btn-primary">{{__('dashboard.search.search')}}</button>
                    </div>
                </form>
                <div class="">
                    <a href="{{route('admin.export')}}" class="btn btn btn-primary ">{{__('dashboard.general.excel')}}</a>
                    <a href="{{route('admin.client.create')}}" class="btn btn btn-primary me-5">{{__('dashboard.user.add')}}</a>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive-md text-nowrap">
                    @if (!empty($records) && count($records) > 0)
                    <table class="table">
                        <thead>
                        <tr class="text-center">
                            <th>#</th>
                            <th>{{__('dashboard.table.name')}}</th>
                            <th>{{__('dashboard.table.phone')}}</th>
{{--                            <th>{{__('dashboard.table.status')}}</th>--}}
                            <th>{{__('dashboard.table.created_at')}}</th>
                            <th>{{__('dashboard.general.login_status')}}</th>
                            <th>{{__('dashboard.table.login')}}</th>
                            <th>{{__('dashboard.table.control')}}</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                        @foreach ($records as $user)
                            <tr class="text-center">
                                <td>
                                    {{ $records->perPage() * ($records->currentPage() - 1) + $loop->iteration }}
                                </td>
                                <td >{{$user->name}}</td>
                                <td >{{$user->phone}}</td>

{{--                                <td>--}}
{{--                                    @if($user->is_active == 1)--}}
{{--                                      {{__('dashboard.table.active')}}--}}
{{--                                    @else--}}
{{--                                      {{__('dashboard.table.no_active')}}--}}
{{--                                    @endif--}}
{{--                                </td>--}}




                                <td>{{$user->created_at->format('Y-m-d h:i A')}}</td>

                                <td>
                                    @if($user->is_complete== 1)
                                        <span class="btn btn-success">{{__('dashboard.general.complete')}}</span>
                                    @else
                                        <span class="btn btn-danger">{{__('dashboard.general.no_complete')}}</span>
                                    @endif
                                </td>
                                <td>
                                    @if(@$user->lastLogin->updated_at)
                                        {{@$user->lastLogin->updated_at->format('Y-m-d h:i A') ?? "--"}}
                                    @else
                                    {{"--"}}
                                    @endif
                                </td>


                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">

                                                    <a class="dropdown-item" href="{{route('admin.client.show',$user->id)}}"
                                                    ><i class="bx bx-show-alt me-1"></i>{{__('dashboard.crud.show')}} </a>

                                                    <a class="dropdown-item" href="{{route('admin.client.edit',$user->id)}}"
                                                    ><i class="bx bx-edit-alt me-1"></i>{{__('dashboard.crud.edit')}} </a>

                                                    <button type="button" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="{{'#modalCenter'.$user->id}}">
                                                        <i class="bx bx-trash me-1"></i> {{__('dashboard.crud.delete')}}
                                                    </button>

                                        </div>

                                    </div>
                                </td>
                            </tr>


                            <!-- Modal -->
                            <div class="modal fade" id="{{'modalCenter'.$user->id}}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalCenterTitle">{{__('dashboard.crud.delete')}}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{route('admin.client.destroy',$user->id)}}" method="POST">

                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <label for="nameWithTitle" class="form-label">{{__('dashboard.table.delete')}}</label>
                                                            <input type="text" disabled id="nameWithTitle" value="{{$user->name}}" class="form-control">
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
                {{$records->links('pagination::bootstrap-5')}}
            </div>
        </div>



    </div>





@endsection
