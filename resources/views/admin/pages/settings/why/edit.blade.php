@extends('admin.layouts.app')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><a href="{{route('admin.why.index')}}"><span class="text-muted fw-light"> {{__('dashboard.sections.why')}}/</span></a> {{__('dashboard.crud.edit')}}</h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{__('dashboard.crud.edit')}}  {{__('dashboard.sections.why')}}</h5>
                        {{-- <small class="text-muted float-end">Default label</small> --}}
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('admin.why.update',$item->id)}}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                    <div class="form-row">
                                        <div class="col-lg-12">
                                            <div class="alert alert-danger alert-dismissible" role="alert">
                                                <strong>Error!</strong> {{$error}}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                            @if(session()->has('message'))
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    {{ session()->get('message') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif
                            <div class="row">
                                @if ($item->key == "image-1" || $item->key == "image-2" || $item->key == "image-3")

                                <div class="card-body">
                                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                                        @if($item->value)
                                            <img src="{{url('/dash-img/why/'.$item->value)}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar"/>
                                        @else
                                            <img src="{{url('../assets/admin/img/avatars/1.png')}}" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar"/>
                                        @endif
                                        <div class="button-wrapper">
                                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                                <span class="d-none d-sm-block">{{__('dashboard.user.upload')}}</span>
                                                <i class="bx bx-upload d-block d-sm-none"></i>
                                                <input
                                                    type="file"
                                                    id="upload"
                                                    class="account-file-input"
                                                    hidden
                                                    name="image"
                                                />
                                            </label>
                                            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                                <i class="bx bx-reset d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">{{__('dashboard.user.reset')}}</span>
                                            </button>

                                            <p class="text-muted mb-0">{{__('dashboard.user.info')}}</p>
                                        </div>
                                    </div>
                                </div>
                                @else
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <textarea class="form-control editor" name="value"  id="exampleFormControlTextarea1" rows="3">{{$item->value}}</textarea>

                                        </div>
                                    </div>
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">{{__('dashboard.crud.update')}}</button>


                        </form>


                    </div>
                </div>
            </div>
        </div>
    </div>










@endsection
