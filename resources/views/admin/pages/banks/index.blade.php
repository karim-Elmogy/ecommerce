@extends('admin.layouts.app')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{__('dashboard.sidebar.app')}} /</span> {{__('dashboard.bank.banks')}}</h4>

        <div class="card">
            <div class="table-header d-flex align-items-center justify-content-between">
                <h5 class="card-header">{{__('dashboard.crud.add')}} {{__('dashboard.bank.bank')}}</h5>
                <a href="{{route('admin.bank.create')}}" class="btn btn btn-primary me-5">{{__('dashboard.crud.add')}} {{__('dashboard.bank.bank')}}</a>
            </div>

            <div class="card-body pt-0">
                <div class="table-responsive-md  text-nowrap">
                @if (!empty($banks) && count($banks) > 0)
                        <table class="table">
                            <thead>
                            <tr class="text-center">
                                <th class=""><i class='bx bx-sort-up'></i></th>
                                <th class="">#</th>
                                <th class="">{{__('dashboard.table.name')}}</th>
                                <th class="">{{__('dashboard.table.image')}}</th>
                                <th class="">{{__('dashboard.table.control')}}</th>
                            </tr>
                            </thead>
                            <tbody class="table-border-bottom-0" id="CateList101">
                            @foreach ($banks as  $bank)
                                <tr class="text-center" data-product-id="{{ $bank->id }}">
                                    <td>
                                        <i style="cursor: pointer" class='bx bx-sort'></i>
                                    </td>

                                    <td>
                                        {{ $banks->perPage() * ($banks->currentPage() - 1) + $loop->iteration }}
                                    </td>
                                        <td class="">{{ $bank->name }}</td>
                                    <td>
                                        @if($bank->image)
                                            <img src="{{url('/dash-img/bank/'.$bank->image)}}"  class="rounded" height="20" width="20"/>
                                        @else
                                            <img src="{{url('../assets/admin/img/avatars/1.png')}}"  class="rounded" height="20" width="20" />
                                        @endif
                                    </td>
                                    <td class="">
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{ route('admin.bank.edit',$bank->id)}}"
                                                ><i class="bx bx-edit-alt me-1"></i>{{__('dashboard.crud.edit')}} </a>

                                                <button type="button" class="dropdown-item"  data-bs-toggle="modal" data-bs-target="{{'#modalCenter'.$bank->id}}">
                                                    <i class="bx bx-trash me-1"></i> {{__('dashboard.crud.delete')}}
                                                </button>

                                            </div>

                                        </div>
                                    </td>
                                </tr>



                                <!-- Modal -->
                                <div class="modal fade" id="{{'modalCenter'.$bank->id}}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalCenterTitle">{{__('dashboard.crud.delete')}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{route('admin.bank.destroy',$bank->id)}}" method="POST">

                                                @csrf
                                                @method('DELETE')
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <label for="nameWithTitle" class="form-label">{{__('dashboard.table.delete')}}</label>
                                                                <input type="text" disabled id="nameWithTitle" value="{{$bank->name}}" class="form-control">
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
                {{$banks->links('pagination::bootstrap-5')}}
            </div>
        </div>



    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const CateList101 = document.getElementById('CateList101');

            new Sortable(CateList101, {
                animation: 250,
                ghostClass: 'ghost',
                onEnd: function(evt) {
                    let cateIds = [];
                    CateList101.querySelectorAll('tr').forEach((product, index) => {
                        cateIds.push(product.dataset.productId);
                    });
                    console.log(cateIds);
                    fetch('{{ route('update_bank_order') }}', {
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

