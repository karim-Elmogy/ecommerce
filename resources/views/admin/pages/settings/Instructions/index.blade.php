@extends('admin.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">{{__('dashboard.sidebar.hakkshop')}}<span class="text-muted fw-light"> / {{__('dashboard.sections.Instructions')}} </span></h4>
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{__('dashboard.crud.show')}} {{__('dashboard.sections.Instructions')}}</h5>
                        {{-- <small class="text-muted float-end">Default label</small> --}}
                    </div>
                    <div class="card-body">
                        <div class="my-3">
                            <div class="col-lg-12 mb-4 mb-xl-0">
                                <div class="demo-inline-spacing mt-3">
                                    <div class="list-group">
                                        <li class="list-group-item d-flex justify-content-between align-items-center active">
                                           {{__('dashboard.sections.Instructions')}}
                                        </li>
                                        <table class="table">
                                            <tbody>
                                            @foreach ($data as $item)
                                                <tr>
{{--                                                    <td>{{ $item->key }}</td>--}}
                                                    <td>{!! $item->value !!}</td>
                                                    <td>
                                                        <a href="{{ route("admin.instructions.edit", $item->id) }}" class="btn btn-primary">{{ __('dashboard.crud.edit') }}</a>
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
@endsection
