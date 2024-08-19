@extends('user.layouts.app')

@section('content')
    <section class="bookConsultation register">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="head-section">
                        <h2> نموج التسجيل </h2>
                        <p> انشاء حساب  </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="text-bookConsultation">
                        <div class="overlay-text">
                            <form method="POST" action="{{url('phoneConfirm')}}">
                                @csrf
                                <div class="form-group">
                                    <label for="namRegister"> الإسم </label>
                                    <input type="text" required class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="phoneRegister"> رقم الجوال </label>
                                    <input type="text" required class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone">
                                    @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                    @enderror
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
        <img src="{{url('assets/user/assets/img/banner/1.png')}}" class="img-fluid" alt="">
    </section>
@endsection
