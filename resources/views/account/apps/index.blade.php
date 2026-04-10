@extends('account.layouts.account')

@section('content')


@php
$user = auth('web')->user();
$widgets = $user->widgets;

@endphp

@push('js')
<script src="{{ asset('js/account/alphine-apps.js') }}" defer></script>
<script src="{{ asset('js/libs/alpine3.js') }}" defer></script>
@endpush



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


                @foreach ($site->widgets as $widget)

                @php
                $url_update = route('widget.update', $widget->uid);
                $url_delete = route('widget.destroy', $widget->uid);
                $image = asset("images/account/{$widget->template->widgetType->slug}.png");
                @endphp

                <div class="app-widget" widget-uid="{{ $widget->uid}}">

                    <div class="app-widget-image">
                        <a href="{{ route('widget.edit', $widget->uid) }}" class="app-widget-image-link">
                            <img src="{{ $image }}" alt="bank-statement">
                        </a>
                    </div>

                    <div class="app-widget-box">
                        <a href="{{ route('widget.edit', $widget->uid) }}" class="app-widget-link">{{ $widget->name }}</a>
                        {{-- <div class="app-widget-date">Created {{ $widget->created_at->format('Y-m-d') }}</div> --}}
                        <div class="app-widget-date">Created {{ $widget->created_at->isoFormat('LL') }}</div>

                        <div class="app-widget-buttons">

                            <button class="app-widget-btn btn-2 btn-green" x-data @click="$store.modals.open('app-install'); $store.widget.update({uid: '{{ $widget->uid}}' })">
                                <span class="btn-bg">Install</span>
                            </button>
                            <a href="{{ route('widget.edit', $widget->uid) }}" class="app-widget-btn btn-2 btn-grey">
                                <span class="btn-bg">Edit</span>
                            </a>

                            <div class="app-wdget-more-action" x-data="toggleMoreAction()">
                                <button class="app-widget-btn-more btn-2" @click="toggle()" :class="{ 'show': open }" data-text="More Action">
                                    <span class="btn-bg">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M4.636 10a1.636 1.636 0 1 1 .002 3.271A1.636 1.636 0 0 1 4.636 10ZM12 10a1.636 1.636 0 1 1 .001 3.271A1.636 1.636 0 0 1 12 10Zm7.364 0a1.636 1.636 0 1 1 .001 3.271A1.636 1.636 0 0 1 19.364 10Z" fill="currentColor"></path>
                                        </svg>
                                    </span>
                                </button>

                                <div class="app-wdget-more-box" x-ref="panel" :class="{ 'show': open }" x-show="open" @click.outside="close()" x-on:keydown.escape.window="close()" style="display:none;">

                                    <button class="app-widget-btn btn" x-data @click="$store.modals.open('app-install'); toggle(); $store.widget.update({uid: '{{ $widget->uid}}' })">
                                        <span class="btn-bg">
                                            <span class="btn-group">
                                                <span>Embed Code</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" />
                                                </svg>

                                            </span>
                                        </span>
                                    </button>



                                    <button class="app-widget-btn btn" x-data @click="$store.modals.open('widget-rename'); toggle(); $store.widget.update({uid: '{{$widget->uid }}', url: '{{$url_update }}'})">
                                        <span class="btn-bg">
                                            <span class="btn-group">
                                                <span>Rename Widget</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                </svg>

                                            </span>
                                        </span>
                                    </button>
                                    <span class="app-wdget-more-line"></span>

                                    <button class="app-widget-btn btn btn-red" x-data @click="$store.modals.open('widget-delete'); toggle(); $store.widget.update({uid: '{{$widget->uid }}', url: '{{$url_delete }}'})">
                                        <span class="btn-bg">
                                            <span class="btn-group">
                                                <span>Delete Widget</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                </svg>

                                            </span>
                                        </span>
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

                    <h3 class="app-item-title">{{$site->domen}}</h3>
                    {{-- <div class="app-item-col">

                    </div> --}}



                    <a href="{{ route('widgets.create', $site->id) }}" class="app-item-link btn-2 btn-lightblue">
                        <span class="btn-bg">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                            </svg>
                            <span>Create widget</span>
                        </span>
                    </a>
                    {{-- <div class="app-item-col">
                    </div> --}}

                </div>
            </div>

            @endif



            @endforeach

        </div>



    </section>


</div>



<div id="app-install" class="modal modal-app-install" x-data="copyEmbedCode()" :class="{ 'show': $store.modals.isOpen('app-install') }" x-show="$store.modals.isOpen('app-install')" x-on:keydown.escape.window="$store.modals.close('app-install')" @click="$store.modals.close('app-install')" style="display:none;">
    <div class="modal-body app-install-wrap" @click.stop>
        <button class="app-install-btn-close" @click="$store.modals.close('app-install')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
        <h3 class="app-install-title title-h3">Embed Code</h3>
        <p class="app-install-desc">
            Copy and paste this code into desired place of your website (HTML editor, website template, theme, etc.).
        </p>

        <div class="app-install-code-wrap" x-ref="target">
            <span class="app-install-copy-text">Code copied</span>
            <button class="app-install-btn-copy btn-2 btn-green" @click="copyCode()">
                <span class="btn-bg">
                    <span class="btn-group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 8.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v8.25A2.25 2.25 0 0 0 6 16.5h2.25m8.25-8.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-7.5A2.25 2.25 0 0 1 8.25 18v-1.5m8.25-8.25h-6a2.25 2.25 0 0 0-2.25 2.25v6" />
                        </svg>

                        <span>Copy Code</span>
                    </span>
                </span>
            </button>

            <div class="app-install-code" x-html="$store.widget.html" x-ref="embedcode">

                {{--
                <pre>
<code x-ref="source">&lt;div class="bibber-app" data-bibber-app="dd0910c2-ec3f-472a-b010-670686a54bb6"&gt;&lt;/div&gt;
&lt;script src="https://bibber.net/apps/ebmed.js" async&gt;&lt;/script&gt;</code>
</pre> --}}
            </div>

        </div>


    </div>

</div>



<div id="widget-rename" class="modal modal-app-form" x-data="combined('widget-rename')" :class="{ 'show': $store.modals.isOpen('widget-rename') }" x-show="$store.modals.isOpen('widget-rename')" x-on:keydown.escape.window="$store.modals.close('widget-rename')" @click="$store.modals.close('widget-rename')" style="display:none;">
    <div class="modal-body app-form-wrap" @click.stop>
        <div class="form-title title-h3">Rename Widget</div>

        <form action="#" class="app-form form" method="PUT" data-action="widget-rename" @keydown.enter.prevent="sendData()">

            <div class="form-group">
                <span class="form-label">Widget Rename</span>
                <input x-ref="firstInput" type="text" class="form-input" name="name" autocomplete="off">
            </div>

            <div class="form-btns">
                <button type="button" class="form-btn btn-2 btn-grey" @click="$store.modals.close('widget-rename')" data-action="cancel">
                    <span class="btn-bg">Cancel</span>
                </button>
                <button type="button" class="form-btn btn-2 btn-blue" @click="sendData()" data-action="confirm">
                    <span class="btn-bg">Confirm</span>
                </button>
            </div>
        </form>
    </div>
    <div class="form-loader">
        <div class="loader"></div>
    </div>
</div>

<div id="widget-delete" class="modal modal-app-form" x-data="ajaxForm()" :class="{ 'show': $store.modals.isOpen('widget-delete') }" x-show="$store.modals.isOpen('widget-delete')" x-on:keydown.escape.window="$store.modals.close('widget-delete')" @click="$store.modals.close('widget-delete')" style="display:none;">
    <div class="modal-body app-form-wrap" @click.stop>
        <div class="form-head">
            <div class="form-title title-h3">Are you sure you want to delete the widget?</div>
            <div class="form-desc">Once deleted it cannot be recovered.</div>
        </div>

        <form action="#" class="app-form form" method="DELETE" data-action="widget-delete">

            <div class="form-btns">
                <button type="button" class="form-btn btn-2 btn-grey" @click="$store.modals.close('widget-delete')" data-action="cancel">
                    <span class="btn-bg">Cancel</span>
                </button>
                <button type="button" class="form-btn btn-2 btn-red" @click="sendData()" data-action="confirm">
                    <span class="btn-bg">Delete Widget</span>
                </button>
            </div>
        </form>
    </div>
    <div class="form-loader">
        <div class="loader"></div>
    </div>
</div>



{{-- <script>
    document.addEventListener('alpine:init', () => {
       
  Alpine.store('modals', {
    openIds: {},
    open(id){this.openIds[id] = true },
    close(id){ delete this.openIds[id] },
    isOpen(id){ return !!this.openIds[id] },
    closeAll(){ this.openIds = {} }
  });
});

</script> --}}



@endsection