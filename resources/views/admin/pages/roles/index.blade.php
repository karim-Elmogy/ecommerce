@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{__('dashboard.sidebar.app')}} /</span> {{__('dashboard.role.roles')}}</h4>

        <div class="card">
            <div class="table-header d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{__('dashboard.role.add_role')}}</h5>
                <a href="{{route('admin.role.create')}}" class="btn btn btn-primary me-5">{{__('dashboard.role.add_role')}}</a>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    {!! $roles->links() !!}
                </div>
                <div class="card-datatable table-responsive">
                    @if (!empty($roles) && count($roles) > 0)
                        <table class="datatables-custom table table-hover-animation" data-title="{{ trans('dashboard.role.add_role') }}" data-create_title="{{ trans('dashboard.role.add_role') }}" data-create_link="{{ route('admin.role.create') }}">
                            <thead>
                            <tr class="text-center">
                                <th>#</th>

                                <th>{!! trans('dashboard.table.name') !!}</th>
                                <th>{!! trans('dashboard.role.manager_count') !!}</th>
                                <th>{!! trans('dashboard.general.added_date') !!}</th>
                                <th>{!! trans('dashboard.table.control') !!}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($roles as $role)
                                <tr class="{{ $role->id }} text-center">
                                    <td>
                                        {{ $roles->perPage() * ($roles->currentPage() - 1) + $loop->iteration }}
                                    </td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->users->count() }}</td>
                                    <td>
                                <span >
                                    {{ $role->created_at->format("Y-m-d") }}
                                </span>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('admin.role.edit',$role->id)}}"
                                                ><i class="bx bx-edit-alt me-1"></i>{{__('dashboard.crud.edit')}} </a>

                                                <button type="button" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="{{'#modalCenter'.$role->id}}">
                                                    <i class="bx bx-trash me-1"></i> {{__('dashboard.crud.delete')}}
                                                </button>

                                            </div>

                                        </div>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="{{'modalCenter'.$role->id}}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalCenterTitle">{{__('dashboard.crud.delete')}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{route('admin.role.destroy',$role->id)}}" method="POST">

                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameWithTitle" class="form-label">{{__('dashboard.table.delete')}}</label>
                                                            <input type="text" disabled id="nameWithTitle" value="{{$role->name}}" class="form-control">
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
                {{$roles->links('pagination::bootstrap-5')}}
            </div>
        </div>



    </div>



@endsection
