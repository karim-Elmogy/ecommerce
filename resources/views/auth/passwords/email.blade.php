@extends('user.layouts.app')

@section('content')
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Reset Password') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    <form method="POST" action="{{ route('password.email') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="row mb-3">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="row mb-0">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Send Password Reset Link') }}--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<section class="login">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="login-side">
                    <div class="side-overlay">
                        <div class="top-side">
                            <div class="logo">
                                <img src="/assets/user/assets/img/logo/logo.png" width="175" alt="" class="img-fluid">
                            </div>
                            <h4> أعد ضبط كلمة المرور </h2>
                        </div>
                        <div class="bottom-side">
                            <form action="#">
                                <div class="form-group text-center">
                                    <input type="text" name="usernameLogin" id="usernameLogin" class="form-control" placeholder="اسم المستخدم أو البريد الإلكتروني">
                                    <small> سوف تتلقى رابطًا لإنشاء كلمة مرور جديدة عبر البريد الإلكتروني الخاص بك. </small>
                                </div>
                                <div class="form-bottom">
                                    <div class="btn-form">
                                        <button type="submit" class="btn"> غيّر كلمة المرور </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="register-side">
                    <div class="register-overlay">
                        <div class="top-side">
                            <div class="img-register">
                                <img src="/assets/user/assets/img/general/register.png" alt="" class="img-fluid">
                            </div>
                        </div>
                        <div class="bottom-side">
                            <div class="head-bottom">
                                <h2> إنشاء حساب جديد </h2>
                                <p> للإستفادة أعلى من خدمات الموقع، سجّل معنا بكل سهولة </p>
                            </div>
                            <div class="btn-form">
                                <a href="{{route('register')}}" class="btn"> تسجيل جديد </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="about p-0">
    <div class="about-content pt-0">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="btn-about mt-0">
                        <a href="{{url('/')}}" class="btn mt-5">
                            <span> الصفحة الرئيسية </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
