@extends('admin.layouts.app')
@section('content')

    <div class="container-xxl flex-grow-1 container-p-y" >
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"> {{__('dashboard.crud.add')}} /</span> {{__('dashboard.role.add_role')}}</h4>

        <!-- Basic Layout -->
        <div class="row">
            <div class="col-xl">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{__('dashboard.role.add_role')}}</h5>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' =>  ['admin.role.update',$role->id] , 'method' => 'PUT' , 'files' => true ,'class' => '','data-locale' => app()->getLocale()]) !!}
                        @csrf
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

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="form-label" for="modern">{{ trans('dashboard.table.name') }} <span class="text-danger">*</span></label>
                                    {!! Form::text("name", isset($role) ? $role->name : null, ['class' => 'form-control' , 'placeholder' => trans('dashboard.table.name'),'id' => "modern"]) !!}
                                </div>
                                <div class="form-group col-md-12 mt-3">
                                    <label class="form-label" for="modern">{{ trans('dashboard.role.desc') }} <span class="text-danger">*</span></label>
                                    {!! Form::textarea("desc", isset($role) ? $role->desc : null, ['class' => 'form-control editor' ,'id' => "modern"]) !!}
                                </div>
                            </div>
                        </div>



                        <hr class="my-0" />
                        <div class="card-body">
                            <div class="row">
                                @if($errors->any())
                                    @foreach($errors->all() as $error)
                                        <div class="form-row">
                                            <div class="col-lg-12">
                                                <div class="alert alert-danger alert-dismissible" role="alert">
                                                    {{$error}}
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                <div class="content-header">
                                    <h5 class="mb-0">{{ trans('dashboard.general.public_data') }}</h5>
                                </div>
                                <div class="row">
                                    <div class="form-group d-flex justify-content-center offset-md-6">
                                        <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                            <input type="checkbox" onclick="toggle(this)" class="custom-control-input" id="customSwitch_all" />

                                            <label class="custom-control-label" for="customSwitch_all">
                                                <span class="switch-icon-left"><i class="feather icon-check"></i></span>
                                                <span class="switch-icon-right"><i class="feather icon-x"></i></span>
                                            </label>
                                            <label class="font-medium-1 ml-1" for="customSwitch_all">{{ trans('dashboard.general.check_all') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="routes_div">
                                    @foreach ($routes as $route)
                                        @continue(in_array($route,$public_routes))
                                        <div class="form-group">
                                            <div class="row">
                                                <label class="font-medium-1 col-md-2">{{ $route == 'home' ? trans('dashboard.general.home') :trans('dashboard.'.$route.".".str_plural($route)) }} </label>
                                                <div class="col-md-10">
                                                    <div class="row">
                                                        <div class="custom-control custom-switch custom-switch-success mr-2 mb-1 col-md-3 {{ $route == 'dashboard' ? 'offset-md-6' : '' }}">
                                                            {!! Form::checkbox("permissions[$loop->index][][route_name]", $route.".index", isset($role) && $role->permissions && $role->permissions->contains('route_name',$route.".index")? true :false , ['class' =>
                                                            'custom-control-input permissions','id' => "customSwitch_".$loop->index. "_". $route."_read"]) !!}

                                                            <label class="custom-control-label" for="customSwitch_{{ $loop->index }}_{{ $route }}_read">
                                                                <span class="switch-icon-left"><i class="feather icon-check"></i></span>
                                                                <span class="switch-icon-right"><i class="feather icon-x"></i></span>
                                                            </label>
                                                            <label class="font-medium-1 ml-1" for="customSwitch_{{ $loop->index }}_{{ $route }}_read">{{ trans('dashboard.general.read') }}</label>

                                                        </div>
                                                        @if ($route !='home')
                                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1 col-md-3">
                                                                {!! Form::checkbox("permissions[$loop->index][][route_name]", $route.".store", isset($role) && $role->permissions && $role->permissions->contains('route_name',$route.".store")? true :false , ['class' =>
                                                                'custom-control-input
                                                                permissions','id' => "customSwitch_".$loop->index. "_". $route."_save"]) !!}

                                                                <label class="custom-control-label" for="customSwitch_{{ $loop->index }}_{{ $route }}_save">
                                                                    <span class="switch-icon-left"><i class="feather icon-check"></i></span>
                                                                    <span class="switch-icon-right"><i class="feather icon-x"></i></span>
                                                                </label>
                                                                <label class="font-medium-1 ml-1" for="customSwitch_{{ $loop->index }}_{{ $route }}_save">{{ trans('dashboard.general.save') }}</label>
                                                            </div>
                                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1 col-md-2">
                                                                {!! Form::checkbox("permissions[$loop->index][][route_name]", $route.".update", isset($role) && $role->permissions && $role->permissions->contains('route_name',$route.".update")? true :false , ['class' =>
                                                                'custom-control-input
                                                                permissions','id' => "customSwitch_".$loop->index. "_". $route."_edit"]) !!}

                                                                <label class="custom-control-label" for="customSwitch_{{ $loop->index }}_{{ $route }}_edit">
                                                                    <span class="switch-icon-left"><i class="feather icon-check"></i></span>
                                                                    <span class="switch-icon-right"><i class="feather icon-x"></i></span>
                                                                </label>
                                                                <label class="font-medium-1 ml-1" for="customSwitch_{{ $loop->index }}_{{ $route }}_edit">{{ trans('dashboard.general.edit') }}</label>
                                                            </div>
                                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1 col-md-2">
                                                                {!! Form::checkbox("permissions[$loop->index][][route_name]", $route.".destroy", isset($role) && $role->permissions && $role->permissions->contains('route_name',$route.".destroy")? true :false , ['class' =>
                                                                'custom-control-input permissions','id' => "customSwitch_".$loop->index. "_". $route."_delete"]) !!}

                                                                <label class="custom-control-label" for="customSwitch_{{ $loop->index }}_{{ $route }}_delete">
                                                                    <span class="switch-icon-left"><i class="feather icon-check"></i></span>
                                                                    <span class="switch-icon-right"><i class="feather icon-x"></i></span>
                                                                </label>
                                                                <label class="font-medium-1 ml-1" for="customSwitch_{{ $loop->index }}_{{ $route }}_delete">{{ trans('dashboard.general.delete') }}</label>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>



                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary ">{{__('dashboard.user.submit')}}</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        function toggle(source) {
            checkboxes = document.getElementsByClassName('permissions');
            if (source.checked) {
                for (var i = 0, n = checkboxes.length; i < n; i++) {
                    checkboxes[i].checked = source.checked;
                }
            } else {
                for (var i = 0, n = checkboxes.length; i < n; i++) {
                    checkboxes[i].checked = source.checked;
                }
            }
        }
    </script>
@endsection

