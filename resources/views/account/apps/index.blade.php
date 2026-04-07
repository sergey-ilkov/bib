@extends('account.layouts.account')

@section('content')








<div class="content">

    <section class="app">
        <div class="app-head">
            <h1 class="title-h1">My Apps</h1>

            <div class="app-info">

                <div class="app-info-col">
                    <span class="app-info-label">sites</span>
                    <span class="app-info-value">{{ count($sites) }}</span>
                </div>
                <div class="app-info-col">
                    <span class="app-info-label">widgets</span>
                    <span class="app-info-value">{{ '0'}}</span>
                </div>
            </div>
        </div>

        <div class="app-items">
            @foreach ($sites as $site)


            <div class="app-item">
                <div class="app-item-row">

                    <div class="app-item-col">
                        <h3 class="app-item-title">{{$site->domen}}</h3>
                        {{-- <div class="app-item-head">
                            <span class="app-item-head-label">Web Site </span>
                            <span class="app-item-head-value">{{$site->domen}}</span>
                        </div>

                        <div class="app-item-head">
                            <span class="app-item-head-label">App key</span>
                            <span class="app-item-head-value">sd5sd5ds-sd4s-d4sd-sd5s-sdf45s5sdf</span>
                        </div> --}}



                    </div>


                    <div class="app-item-col">
                        <a href="#" class="app-item-link btn-2 btn-lightblue">
                            <span class="btn-bg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <span>Create widget</span>
                            </span>
                        </a>
                    </div>


                </div>

            </div>

            @endforeach

        </div>

        {{-- @foreach ($sites as $site)

        <div>{{$site->id}}</div>
        <div>{{$site->name}}</div>
        <div>{{$site->site_url}}</div>
        <div>{{$site->upload_url}}</div>
        <div>{{$site->device_script ? 'true' : 'false';}}</div>
        <div>{{$site->is_blocked ? 'true' : 'false';}}</div>
        <div>''</div>
        <div>''</div>

        @endforeach --}}

    </section>


</div>










@endsection