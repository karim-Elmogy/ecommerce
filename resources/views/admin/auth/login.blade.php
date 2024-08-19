@extends('admin.layouts.guest')
@section('content')
<div class="authentication-wrapper authentication-basic container-p-y">
    <div class="authentication-inner">
    <!-- Register -->
    <div class="card">
        <div class="card-body"  dir="rtl">
        <!-- Logo -->


            <div class="app-brand justify-content-center">

            <a href="{{url('/admin/login')}}" class="app-brand-link gap-2">
            <span class="app-brand-logo demo">
                <img src="{{ setting('logo') }}" style="max-width:150px;" alt="">
            </span>
            </a>
        </div>
{{--        <div class="text-center">--}}
{{--            <span class="app-brand-text demo text-body fw-bolder">لوحة تحكم</span>--}}
{{--        </div>--}}
        <!-- /Logo -->

        <form id="formAuthentication" class="mb-3" action="{{ route('admin.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif
            </div>
            <div class="mb-3">
            <label for="email" class="form-label">البريد الالكتروني</label>
            <input
                type="text"
                class="form-control"
                id="email"
                name="email"
                placeholder="ادخل الايميل الخاص بك"
                autofocus
            />
            </div>
            <div class="mb-3 form-password-toggle">
            <div class="d-flex justify-content-between">
                <label class="form-label" for="password">كلمة المرور</label>
            </div>
            <div class="input-group">
                <input
                type="password"
                id="password"
                class="form-control"
                style="border-left: 0 !important;"
                name="password"
                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                aria-describedby="password"
                />
                <span class="input-group-text cursor-pointer" style="border-right: 0 !important;" onclick="togglePasswordVisibility()"><i class="bx bx-hide" id="toggleIcon"></i></span>
            </div>
            </div>
             <div class="mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="remember-me" />
                <label class="form-check-label" for="remember-me"> تذكرني </label>
            </div>
            </div>
            <div class="mb-3">
            <button class="btn btn-primary d-grid w-100" type="submit">تسجيل دخول</button>
            </div>
        </form>


        </div>
    </div>
    <!-- /Register -->
    </div>
</div>

@endsection
