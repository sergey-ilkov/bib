@extends('account.layouts.account')

@section('content')


@php
$user = auth('web')->user();
$widgets = $user->widgets;

@endphp





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
                    <span class="app-info-value">{{ count($widgets)}}</span>
                </div>
            </div>
        </div>

        <div class="app-items">
            @foreach ($sites as $site)


            <div class="app-item">


                @if($site->widgets->isNotEmpty())

                <div class="app-item-row">

                    <h3 class="app-item-title" style="color: green; margin-bottom:10px">{{$site->domen}}</h3>

                </div>

                {{-- {{ dd($site->widgets) }} --}}
                @foreach ($site->widgets as $widget)

                <div>Image - нужно для шаблона добавить поле с ссылкой на картинку и вставлять картинку</div>
                <div class=""></div>
                <div class="" style="color: #197bff;font-size:18px;">Widget: {{ $widget->name }}</div>
                <div class="" style="color: rgba(17,17,17,0.5); font-size:13px;">Created {{ $widget->created_at }}</div>
                <div class="">App Key: {{ $widget->uid }}</div>
                <div class=""></div>

                <button class="btn">
                    <span class="btn-bg">Install - открывает модальное окна с кодом и короткой инструкцией</span>
                </button>
                <button class="btn">
                    <span class="btn-bg">Edit - Это ССЫЛКА открывает страницу конструктора /widget/UUID</span>
                </button>

                <div class="">Кнопка на абсолюте ...</div>
                <button class="btn">
                    <span class="btn-bg">Embed code- открывает модальное окна с кодом и короткой инструкцией</span>
                </button>
                <button class="btn">
                    <span class="btn-bg">Rename widget - открывает форму переименования виджета</span>
                </button>
                <button class="btn">
                    <span class="btn-bg">Delete widget - открывает форму с удалением: cancel, delete</span>
                </button>


                @endforeach



                @else

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

                        {{-- <div class=""></div>
                        <div class="">W {{ dd(empty( $site->widgets))}}</div> --}}

                    </div>



                    <div class="app-item-col">
                        <a href="{{ route('widgets.create', $site->id) }}" class="app-item-link btn-2 btn-lightblue">
                            <span class="btn-bg">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>
                                <span>Create widget</span>
                            </span>
                        </a>
                    </div>

                </div>

                @endif

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