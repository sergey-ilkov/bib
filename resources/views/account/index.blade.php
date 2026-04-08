@extends('account.layouts.account')

@section('content')


@php
$user = auth('web')->user();

@endphp






<div class="content">

    <section class="account">
        <h1 class="title-h1">Account Settings</h1>

        <div class="account-settings-items">
            <div class="account-settings-item">
                <div class="account-settings-data">
                    <span class="account-settings-data-label">Name</span>
                    <span id="account-user-name" class="account-settings-data-value">{{ $user->name }}</span>
                </div>
                <button class="account-settings-btn btn btn-blue" data-target="account-form-name">
                    <span class="btn-bg">Change Name</span>
                </button>
            </div>
            <div class="account-settings-item">
                <div class="account-settings-data">
                    <span class="account-settings-data-label">Password</span>
                    <span class="account-settings-data-value">************</span>
                </div>
                <button class="account-settings-btn btn btn-blue" data-target="account-form-password">
                    <span class="btn-bg">Change Password</span>
                </button>
            </div>
        </div>

    </section>

</div>




<div id="account-form-name" class="modal modal-account-form">
    <div class="modal-body account-form-wrap">
        <div class="form-title title-h3">Change Name</div>
        <form action="{{ route('account.update') }}" class="account-form form" method="PUT" data-action="change-name">

            <div class="form-group">
                <span class="form-label">New Name</span>
                <input type="text" class="form-input" name="name" autocomplete="off">
            </div>

            <div class="form-btns">
                <button type="button" class="form-btn btn-2 btn-grey" data-action="cancel">
                    <span class="btn-bg">Cancel</span>
                </button>
                <button type="button" class="form-btn btn-2 btn-blue" data-action="confirm">
                    <span class="btn-bg">Confirm</span>
                </button>
            </div>
        </form>
    </div>
    <div class="form-loader">
        <div class="loader"></div>
    </div>
</div>
<div id="account-form-password" class="modal modal-account-form">
    <div class="modal-body account-form-wrap">
        <div class="form-title title-h3">Change Password</div>
        <form action="{{ route('account.update') }}" class="account-form form" method="PUT" data-action="change-password">

            <div class="form-group">
                <span class="form-label">New Password (min 12 symbols)</span>
                <input type="text" class="form-input" name="password" autocomplete="off">
            </div>

            <div class="form-btns">
                <button type="button" class="form-btn btn-2 btn-grey" data-action="cancel">
                    <span class="btn-bg">Cancel</span>
                </button>
                <button type="button" class="form-btn btn-2 btn-blue" data-action="confirm">
                    <span class="btn-bg">Confirm</span>
                </button>
            </div>
        </form>
    </div>
    <div class="form-loader">
        <div class="loader"></div>
    </div>
</div>





@endsection