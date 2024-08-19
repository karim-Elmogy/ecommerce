@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{__('dashboard.sidebar.app')}} /</span> {{__('dashboard.book.books')}}</h4>

        <div class="card">
            <div class="table-header d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{__('dashboard.crud.add')}} {{__('dashboard.book.book')}}</h5>
            </div>

            <div class="card-body pt-0">
                <div class="table-responsive-md  text-nowrap">
                @if (!empty($books) && count($books) > 0)
                        <table class="table">
                            <thead>
                            <tr class="text-center">
                                <th class="">#</th>
                                <th class="">{{__('dashboard.table.name')}}</th>
                                <th class="">{{__('dashboard.table.phone')}}</th>
                                <th class="">{{__('dashboard.table.status')}}</th>
                                <th class="">{{__('dashboard.table.status')}}</th>
                                <th class="">{{__('dashboard.table.control')}}</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                            @foreach ($books as  $book)
                                <tr class="text-center">
                                    <td>
                                        {{ $books->perPage() * ($books->currentPage() - 1) + $loop->iteration }}
                                    </td>


                                    <td>{{$book->name}}</td>
                                    <td>{{$book->phone}}</td>

                                    @if ($book->status == 0)
                                        <td>
                                            <span class="btn light btn-danger  ">{{__('dashboard.general.new_older')}} </span>
                                        </td>
                                    @elseif ($book->status == 1)
                                        <td>
                                            <span class="btn light btn-success ">{{__('dashboard.order.ok')}}</span>
                                        </td>
                                    @elseif ($book->status == 2)
                                        <td>
                                            <span class="btn light btn-warning ">{{__('dashboard.order.delivery')}}</span>
                                        </td>
                                    @endif

                                    <td>
                                        <div class="dropdown ml-auto">
                                            <button class="btn btn-primary dropdown-toggle me-2" data-bs-toggle="dropdown" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                <span>{{__('dashboard.table.control')}}</span>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <form method="POST" action="{{route('admin.book.update',$book->id)}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input hidden name="key" value="delivery">
                                                    <button class="dropdown-item">
                                                        {{__('dashboard.order.delivery')}}
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{route('admin.book.update',$book->id)}}">
                                                    @csrf
                                                    @method('PUT')
                                                    <input hidden name="key" value="ok">
                                                    <button class="dropdown-item">
                                                        {{__('dashboard.order.ok')}}
                                                    </button>
                                                </form>

                                            </div>
                                        </div>
                                    </td>


                                    <td class="">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <button type="button" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="{{'#modalCenter'.$book->id}}">
                                                    <i class="bx bx-trash me-1"></i> {{__('dashboard.crud.delete')}}
                                                </button>

                                            </div>

                                        </div>


                                    </td>

                                </tr>



                                <!-- Modal -->
                                <div class="modal fade" id="{{'modalCenter'.$book->id}}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalCenterTitle">{{__('dashboard.crud.delete')}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{route('admin.book.destroy',$book->id)}}" method="POST">

                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameWithTitle" class="form-label">{{__('dashboard.table.delete')}}</label>
                                                                <input type="text" disabled id="nameWithTitle" value="{{$book->name}}" class="form-control">
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
                {{$books->links('pagination::bootstrap-5')}}
            </div>
        </div>



    </div>






@endsection

