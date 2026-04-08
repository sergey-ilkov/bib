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





            @if($site->widgets->isNotEmpty())

            <div class="app-item active">


                <div class="app-item-head">

                    <h3 class="app-item-title">{{$site->domen}}</h3>

                </div>

                {{-- @php
                app()->setLocale('en')
                @endphp --}}

                {{-- {{ dd($site->widgets) }} --}}
                @foreach ($site->widgets as $widget)

                <div class="app-widget" widget-uid="{{ $widget->uid}}">

                    <div class="app-widget-image">
                        Link and Image widget
                    </div>

                    <div class="app-widget-box">
                        <a href="{{ route('widget.edit', $widget->uid) }}" class="app-widget-link">{{ $widget->name }}</a>
                        {{-- <div class="app-widget-date">Created {{ $widget->created_at->format('Y-m-d') }}</div> --}}
                        <div class="app-widget-date">Created {{ $widget->created_at->isoFormat('LL') }}</div>

                        <div class="app-widget-buttons">

                            <button class="app-widget-btn btn-2 btn-green">
                                <span class="btn-bg">Install</span>
                            </button>
                            <a href="{{ route('widget.edit', $widget->uid) }}" class="app-widget-btn btn-2 btn-grey">
                                <span class="btn-bg">Edit</span>
                            </a>

                            <div class="app-wdget-more-action">
                                <button class="app-widget-btn-more btn-2" data-text="More Action">
                                    <span class="btn-bg">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M4.636 10a1.636 1.636 0 1 1 .002 3.271A1.636 1.636 0 0 1 4.636 10ZM12 10a1.636 1.636 0 1 1 .001 3.271A1.636 1.636 0 0 1 12 10Zm7.364 0a1.636 1.636 0 1 1 .001 3.271A1.636 1.636 0 0 1 19.364 10Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                </button>

                                <div class="app-wdget-more-box">

                                    <button class="app-widget-btn btn">
                                        <span class="btn-bg">
                                            <span class="btn-group">
                                                <span>Embed Code</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" />
                                                </svg>

                                            </span>
                                        </span>
                                    </button>

                                    {{-- <span class="app-wdget-more-line"></span> --}}
                                    <button class="app-widget-btn btn">
                                        <span class="btn-bg">
                                            <span class="btn-group">
                                                <span>Rename Widget</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                </svg>

                                            </span>
                                        </span>
                                        {{-- <span class="btn-bg">Rename Widget</span> --}}
                                    </button>
                                    <span class="app-wdget-more-line"></span>

                                    <button class="app-widget-btn btn btn-red">
                                        <span class="btn-bg">
                                            <span class="btn-group">
                                                <span>Delete Widget</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>

                                            </span>
                                        </span>
                                        {{-- <span class="btn-bg">Delete Widget</span> --}}
                                    </button>




                                </div>
                            </div>

                        </div>

                    </div>


                </div>


            </div>



            @endforeach



            @else

            <div class="app-item">

                <div class="app-item-head">

                    <div class="app-item-col">
                        <h3 class="app-item-title">{{$site->domen}}</h3>

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
            </div>

            @endif



            @endforeach

        </div>



    </section>


</div>



<div id="app-install" class="modal modal-app-install">
    <div class="modal-body app-install-wrap">
        <button class="app-install-btn-close">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
        <h3 class="app-install-title title-h3">Embed Code</h3>
        <p class="app-install-desc">
            Copy and paste this code into desired place of your website (HTML editor, website template, theme, etc.).
        </p>

        <div class="app-install-code-wrap">
            <span class="app-install-copy-text">Code copied</span>
            <button class="app-install-btn-copy btn-2 btn-green">
                <span class="btn-bg">
                    <span class="btn-group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 8.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v8.25A2.25 2.25 0 0 0 6 16.5h2.25m8.25-8.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-7.5A2.25 2.25 0 0 1 8.25 18v-1.5m8.25-8.25h-6a2.25 2.25 0 0 0-2.25 2.25v6" />
                        </svg>

                        <span>Copy Code</span>
                    </span>
                </span>
            </button>

            <div class="app-install-code">
                <pre>
<code>&lt;div class="bibber-app" data-bibber-app="dd0910c2-ec3f-472a-b010-670686a54bb6"&gt;&lt;/div&gt;
&lt;script src="https://bibber.net/apps/ebmed.js" async&gt;&lt;/script&gt;</code>
</pre>
            </div>

        </div>


    </div>

</div>



<div id="app-form-rename" class="modal modal-app-form">
    <div class="modal-body app-form-wrap">
        <div class="form-title title-h3">Rename Widget</div>

        <form action="#" class="app-form form" method="PUT" data-action="widget-rename">

            <div class="form-group">
                <span class="form-label">Widget Rename</span>
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

<div id="app-form-delete" class="modal modal-app-form">
    <div class="modal-body app-form-wrap">
        <div class="form-head">
            <div class="form-title title-h3">Are you sure you want to delete the widget?</div>
            <div class="form-desc">Once deleted it cannot be recovered.</div>
        </div>

        <form action="#" class="app-form form" method="DELETE" data-action="widget-rename">

            <div class="form-btns">
                <button type="button" class="form-btn btn-2 btn-grey" data-action="cancel">
                    <span class="btn-bg">Cancel</span>
                </button>
                <button type="button" class="form-btn btn-2 btn-red" data-action="confirm">
                    <span class="btn-bg">Delete Widget</span>
                </button>
            </div>
        </form>
    </div>
    <div class="form-loader">
        <div class="loader"></div>
    </div>
</div>







@endsection