@extends('frontend.layouts.auth')

@section('content')



{{ auth('admin')->user() }}
{{ auth('web')->user()}}

@auth('admin')
<p>Вы вошли как админ: {{ Auth::guard('admin')->user()->name }}</p>
@endauth

@auth('web')
<p>Вы вошли как обычный пользователь: {{ Auth::user()->name }}</p>
@endauth


<section id="sign-in" class="auth-section">
    <div class="container">

        <div class="auth-section-box">
            <div class="auth-section-header">
                <h1 class="auth-section__title">Sign In <span>Bibber</span></h1>
            </div>



            <div class="form-errors"></div>

            <div class="form-wrap">

                <form class="form" action="{{ route('login.post') }}" action="POST">


                    <div class="form-group">
                        <input type="email" class="form-input" name="email" autocomplete="off" placeholder="Email">
                        <span class="form-input-error">Email is invalid.</span>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-input" name="password" autocomplete="off" placeholder="Password">
                        <span class="form-input-error">Password is required.</span>
                    </div>


                    <button type="button" class="btn-send btn btn-blue">
                        <span class="btn-bg">Sign in</span>
                    </button>

                </form>

            </div>


            <div class="auth-section-footer">
                <span class="auth-section-text">Forgot Password?</span>
                <a class="auth-section-link link" href="{{ route('password-reset') }}">Password reset</a>
            </div>



        </div>
    </div>
</section>











@endsection