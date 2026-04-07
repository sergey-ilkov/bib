@extends('account.layouts.auth')

@section('content')





<section id="password-reset" class="auth-section">
    <div class="container">

        <div class="auth-section-box">

            <div class="auth-section-header">

                <h1 class="auth-section__title">Password Reset <span>Bibber</span></h1>

                <div class="form-message">
                    <span>Enter your account’s email and we’ll send you an email to reset your password</span>
                </div>

            </div>

            <div class="form-errors"></div>

            <div class="form-wrap">


                <form class="form" action="{{ route('password-reset.post') }}" action="POST">


                    <div class="form-group">
                        <input type="email" class="form-input" name="email" autocomplete="off" placeholder="Email">
                        <span class="form-input-error">Email is invalid.</span>
                    </div>


                    <button type="button" class="btn-send btn btn-blue">
                        <span class="btn-bg">Send Email</span>
                    </button>

                </form>


            </div>

            <div class="auth-section-footer">
                <span class="auth-section-text">or go back to</span>
                <a class="auth-section-link link" href="{{ route('login') }}">Log In</a>
                <span class="auth-section-text">page</span>
            </div>



        </div>
    </div>
</section>










@endsection