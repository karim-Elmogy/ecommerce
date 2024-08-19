@extends('user.layouts.app')

@section('content')
    <section class="bookConsultation register">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="head-section">
                        <h2> نموج التسجيل </h2>
                        <p> انشاء كلمة مرور  </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="text-bookConsultation">
                        <div class="overlay-text">
                            <form method="POST" action="{{route('applicationForm')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="passRegister"> كلمة المرور </label>
                                    <input type="text"  class="form-control" id="passRegister" name="pass">
                                </div>
                                <div class="form-group">
                                    <label for="passReRegister"> اعادة كلمة المرور </label>
                                    <input type="text" class="form-control" id="passReRegister" name="c_pass">
                                </div>
                                <div class="form-group group-btn">
                                    <button class="btn"> التالى </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="img-banner">
        <img src="{{'assets/user/assets/img/banner/1.png'}}" class="img-fluid" alt="">
    </section>
@endsection
