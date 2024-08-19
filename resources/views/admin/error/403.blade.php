@extends('admin.layouts.guest')

<style>
    .misc-wrapper {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - (1.625rem * 2));
        text-align: center;
    }

</style>
@section('content')
    <!-- Error -->
    <div class="container-xxl container-p-y">
        <div class="misc-wrapper">
            <h2 class="mb-2 mx-2">{{__('dashboard.error.404')}}</h2>
            <p class="mb-4 mx-2">{{__('dashboard.error.oops')}}</p>
            <a href="{{url('/')}}" class="btn btn-primary">{{__('dashboard.error.back')}}</a>
            <div class="mt-3">
                <img
                    src="{{asset('assets/admin/img/illustrations/page-misc-error-light.png')}}"
                    alt="page-misc-error-light"
                    width="500"
                    class="img-fluid"
                    data-app-dark-img="illustrations/page-misc-error-dark.png"
                    data-app-light-img="illustrations/page-misc-error-light.png"
                />
            </div>
        </div>
    </div>
    <!-- /Error -->
@endsection
