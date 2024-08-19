@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{__('dashboard.sidebar.app')}} /</span> {{__('dashboard.team.teams')}}</h4>

        <div class="card">
            <div class="table-header d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{__('dashboard.team.teams')}}</h5>
                <a href="{{route('admin.team.create')}}" class="btn btn btn-primary me-5">{{__('dashboard.crud.add')}} {{__('dashboard.team.team')}}</a>
            </div>
            <div class="card-footer py-0">
                {{$teams->links('pagination::bootstrap-5')}}
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive-md text-nowrap">
                    @if (!empty($teams) && count($teams) > 0)
                        <table class="table">
                            <thead>
                            <tr class="text-center">
                                <th>#</th>
                                <th>{{__('dashboard.table.name')}}</th>
                                <th>{{__('dashboard.team.email')}}</th>
                                <th>{{__('dashboard.city.city')}}</th>
                                {{--                            <th>{{__('dashboard.table.status')}}</th>--}}
                                <th>{{__('dashboard.table.image')}}</th>
                                <th>{{__('dashboard.table.control')}}</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @foreach ($teams as $team)
                                <tr class="text-center">
                                    <td>
                                        {{ $teams->perPage() * ($teams->currentPage() - 1) + $loop->iteration }}
                                    </td>
                                    <td >{{$team->name}}</td>
                                    <td>{{$team->email}}</td>
                                    <td>{{@$team->city->name}}</td>
                                    <td>
                                        <div class="status-container">
                                            <div class="row">

                                                {{--                                            <div class="col-md-8 p-0">--}}
                                                {{--                                                <form class="status-form" action="{{ route('admin.team.status') }}" method="post">--}}
                                                {{--                                                    @csrf--}}
                                                {{--                                                    <input type="hidden" name="id" value="{{ $team->id }}">--}}
                                                {{--                                                    <select class="form-select status-select rounded-0 rounded-start" name="status" aria-label="Default select example" required disabled>--}}
                                                {{--                                                        @if($team->is_active == 1)--}}
                                                {{--                                                            <option value="1" selected>{{__('dashboard.table.active')}}</option>--}}
                                                {{--                                                            <option value="0">{{__('dashboard.table.no_active')}}</option>--}}
                                                {{--                                                        @else--}}
                                                {{--                                                            <option value="1">{{__('dashboard.table.active')}}</option>--}}
                                                {{--                                                            <option value="0" selected>{{__('dashboard.table.no_active')}}</option>--}}
                                                {{--                                                        @endif--}}
                                                {{--                                                    </select>--}}
                                                {{--                                                </form>--}}
                                                {{--                                            </div>--}}
                                                <div class="col-md-4 p-0 bg-primary rounded-end">
                                                    <button class="btn lock-button px-1" data-locked="true">🔒</button>
                                                </div>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        @if($team->image)
                                            <img src="{{url('/dash-img/team/'.$team->image)}}"  class="rounded" height="20" width="20"/>
                                        @else
                                            <img src="{{url('../assets/admin/img/avatars/1.png')}}"  class="rounded" height="20" width="20" />
                                        @endif
                                    </td>





                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">

                                                {{--                                            <a class="dropdown-item" href="{{route('admin.teams.show',$team->id)}}"--}}
                                                {{--                                            ><i class="bx bx-show-alt me-1"></i>{{__('dashboard.crud.show')}} </a>--}}

                                                {{--                                            <a class="dropdown-item" href="{{route('admin.team.edit',$team->slug)}}"--}}
                                                {{--                                            ><i class="bx bx-edit-alt me-1"></i>{{__('dashboard.crud.edit')}} </a>--}}

                                                <button type="button" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="{{'#modalCenter'.$team->slug}}">
                                                    <i class="bx bx-trash me-1"></i> {{__('dashboard.crud.delete')}}
                                                </button>

                                            </div>

                                        </div>
                                    </td>
                                </tr>


                                <!-- Modal -->
                                <div class="modal fade" id="{{'modalCenter'.$team->id}}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalCenterTitle">{{__('dashboard.crud.delete')}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{route('admin.team.destroy',$team->id)}}" method="POST">

                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameWithTitle" class="form-label">{{__('dashboard.table.delete')}}</label>
                                                            <input type="text" disabled id="nameWithTitle" value="{{$team->name}}" class="form-control">
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
        </div>



    </div>

@endsection
