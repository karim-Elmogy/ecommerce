@extends('user.layouts.app')

@section('content')

    <section class="phoneConfirm">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="head-section">
                        <h2> ادخل رمز التحقق المرسل إلى الجوال </h2>
                    </div>
                    <div class="content-phoneConfirm">
                        <div class="overlay-phoneConfirm">
                            <form method="POST" action="{{route('password')}}">
                                @csrf
                                <div class="form-group">
                                    <input type="text" class="form-control" id="phoneConfirm1" name="phoneConfirm1" maxlength="1" oninput="focusNextOrPrevious(this, phoneConfirm2, null)" required autofocus>
                                    <input type="text" class="form-control" id="phoneConfirm2" name="phoneConfirm2" maxlength="1" oninput="focusNextOrPrevious(this, phoneConfirm3, phoneConfirm1)" required>
                                    <input type="text" class="form-control" id="phoneConfirm3" name="phoneConfirm3" maxlength="1" oninput="focusNextOrPrevious(this, phoneConfirm4, phoneConfirm2)" required>
                                    <input type="text" class="form-control" id="phoneConfirm4" name="phoneConfirm4" maxlength="1" oninput="focusNextOrPrevious(this, null, phoneConfirm3)" required>
                                </div>
                                <div class="form-group">
                                    <button class="btn"> التالى </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        function focusNextOrPrevious(current, next, previous) {
            var maxLength = parseInt(current.getAttribute('maxlength'));
            if (current.value.length === maxLength) {
                next.focus();
            } else if (current.value.length === 0 && previous) {
                previous.focus();
            }
        }
    </script>
@endsection
