@extends('admin.layouts.base')




@section('content')

<div class="content">

    <x-admin.content-header :title="__('admin.title.dashboard')" />



    <div class="content-box">

        <div class="dashboard__items">

            <div class="dashboard__item">
                <h4 class="dashboard__item-title">{{ __('admin.dashboard.blockings') }}</h4>
                <div class="dashboard-box">
                    <div class="dashboard-box__item">
                        <span class="dashboard-box__item-text">{{ __('Кількість заблокованих:') }}</span>
                        <span class="dashboard-box__item-num">{{ $info['blockings'] }}</span>
                    </div>
                </div>
            </div>


        </div>


    </div>


</div>

@endsection