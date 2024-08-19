@extends('admin.layouts.app')
@section('content')


<div class="container-xxl flex-grow-1 container-p-y" >
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">{{__('dashboard.sidebar.app')}} /</span> {{__('dashboard.offer.offers')}}</h4>
    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{__('dashboard.crud.edit')}} {{__('dashboard.offer.offer')}}</h5>
                </div>
                <div class="card-body text-center">
                    <div class="my-3">
                        <div class="col-lg-12 mb-4 mb-xl-0">
                            <div class="demo-inline-spacing mt-3">
                                <div class="list-group">
                                    <li class="list-group-item d-flex justify-content-between align-items-center active">
                                        {{__('dashboard.offer.offers')}}
                                    </li>
                                    <table class="table">
                                        <tbody id="CateList3">
                                        @foreach ($offers as $offer)
                                            <tr data-product-id="{{ $offer->id }} ">
                                                <td>
                                                    <i style="cursor: pointer" class='bx bx-sort'></i>
                                                </td>
                                                <td>
                                                   <img src="{{url('/dash-img/offer/'.$offer->image)}}"  class="rounded" height="80" width="150"/>
                                                </td>

                                                <td>
                                                    يجب تكون الصورة مقاس 120 * 150
                                                </td>
                                                <td>
                                                    <a href="{{ route("admin.offer.edit", $offer->id) }}" class="btn btn-primary">{{ __('dashboard.crud.edit') }}</a>
                                                </td>


                                            </tr>
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
</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cateList = document.getElementById('CateList3');

            new Sortable(cateList, {
                animation: 250,
                ghostClass: 'ghost',
                onEnd: function(evt) {
                    let cateIds = [];
                    cateList.querySelectorAll('tr').forEach((product, index) => {
                        cateIds.push(product.dataset.productId);
                    });
                    console.log(cateIds);
                    fetch('{{ route('update_offer_order') }}', {
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
