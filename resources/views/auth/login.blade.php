@extends('user.layouts.app')

@section('content')

<section class="bookConsultation register">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <nav>
                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                        <button class="nav-link active" id="nav-student-tab" data-bs-toggle="tab" data-bs-target="#nav-student" type="button" role="tab" aria-controls="nav-student" aria-selected="true"> دخول الطالب </button>
                        <button class="nav-link" id="nav-partners-tab" data-bs-toggle="tab" data-bs-target="#nav-partners" type="button" role="tab" aria-controls="nav-partners" aria-selected="false"> دخول الشركاء </button>
                        <button class="nav-link" id="nav-team-tab" data-bs-toggle="tab" data-bs-target="#nav-team" type="button" role="tab" aria-controls="nav-team" aria-selected="false"> دخول الفريق </button>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-student" role="tabpanel" aria-labelledby="nav-student-tab" tabindex="0">
                        <div class="text-bookConsultation">
                            <div class="overlay-text">
                                <form method="POST" action="{{route('user.login')}}">
                                    @csrf
                                    <input type="hidden" name="user_type" value="student">
                                    <div class="form-group">
                                        <label for="PhoneStudLogin"> رقم الجوال</label>
                                        <input type="text" class="form-control" id="PhoneStudLogin" name="phone" >
                                    </div>
                                    <div class="form-group">
                                        <label for="passStudLogin"> كلمة المرور </label>
                                        <input type="text" class="form-control" id="passStudLogin" name="password">
                                    </div>
                                    <div class="form-group group-link">
                                        <a href="{{route('register')}}"> إنشاء حساب </a>
                                    </div>
                                    <div class="form-group group-btn">
                                        <button class="btn"> تسجيل الدخول </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-partners" role="tabpanel" aria-labelledby="nav-partners-tab" tabindex="0">
                        <div class="text-bookConsultation">
                            <div class="overlay-text">
                                <form method="POST" action="{{route('user.login')}}">
                                    @csrf
                                    <input type="hidden" name="user_type" value="partner">
                                    <div class="form-group">
                                        <label for="emailPartLogin"> البريد الإلكترونى </label>
                                        <input type="text" class="form-control" id="emailPartLogin" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="passPartLogin"> كلمة المرور </label>
                                        <input type="text" class="form-control" id="passPartLogin" name="password">
                                    </div>
                                    <div class="form-group group-link">
{{--                                        <a href="{{route('register')}}"> إنشاء حساب </a>--}}
                                    </div>
                                    <div class="form-group group-btn">
                                        <button class="btn"> تسجيل الدخول </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="nav-team" role="tabpanel" aria-labelledby="nav-team-tab" tabindex="0">
                        <div class="text-bookConsultation">
                            <div class="overlay-text">
                                <form action="teamRegister.php">
                                    <div class="form-group">
                                        <label for="teamPartLogin"> البريد الإلكترونى </label>
                                        <input type="text" class="form-control" id="teamPartLogin" name="teamPartLogin">
                                    </div>
                                    <div class="form-group">
                                        <label for="teamPartLogin"> كلمة المرور </label>
                                        <input type="text" class="form-control" id="teamPartLogin" name="teamPartLogin">
                                    </div>
                                    <div class="form-group group-link">
{{--                                        <a href="{{route('register')}}"> إنشاء حساب </a>--}}
                                    </div>
                                    <div class="form-group group-btn">
                                        <button class="btn"> تسجيل الدخول </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="img-banner">
    <img src="{{url('assets/user/assets/img/banner/1.png')}}" class="img-fluid" alt="">
</section>
@endsection
