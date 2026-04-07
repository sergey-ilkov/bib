@extends('account.layouts.auth')

@section('content')



@if ($resetData)

<section id="new-password" class="auth-section">
    <div class="container">



        <div class="auth-section-box">



            <div class="auth-section-header">

                <h1 class="auth-section__title">New Password <span>Bibber</span></h1>

                <div class="form-message">
                    <span>Enter new password to your account {{ $resetData->email }}</span>
                </div>
            </div>

            <div class="form-errors"></div>
            <div class="form-wrap">


                <form class="form" action="{{ route('new-password.post') }}" action="POST">


                    <input type="hidden" name="token" value="{{$token}}">

                    <div class="form-group">
                        <input type="password" class="form-input" name="password" autocomplete="off" placeholder="Password">
                        <span class="form-input-label">Min. 12 symbols</span>
                    </div>


                    <button type="button" class="btn-send btn btn-blue">
                        <span class="btn-bg">Save</span>
                    </button>

                </form>

            </div>

        </div>
    </div>
</section>


@else

<div class="auth-section error">
    <div class="container">

        <div class="error-token">
            Invalid or expired token.
        </div>

        <div class="auth-section-footer">
            <span class="auth-section-text">Request a new password reset link.</span>
            <a class="auth-section-link link" href="{{ route('password-reset') }}">Password Reset</a>
        </div>
    </div>
</div>
@endif








@endsection