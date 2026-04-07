@extends('account.layouts.widget')

@section('content')


@php


@endphp


<section class="widget-create">

    <div class="form-widget-create-wrap">

        <div class=""></div>
        <div class="title-h1">Create widget</div>
        <div class=""></div>


        {{-- <div class="">{{'id site: ' . $site->id}}</div> --}}
        {{-- <div class="">{{'id site: ' . $site->name}}</div> --}}
        <div class="">{{'Domen: ' . $site->domen}}</div>
        <div class=""></div>
        <div class="">{{'Template: ' . $template->name}}</div>
        <div class=""></div>
        {{-- <div class="">{{'Conutry code: ' . $template->country_code}}</div> --}}
        <div class=""></div>
        {{-- <div class="">{{'Language file: ' . $template->ocr_lang}}</div> --}}
        <div class="">{{'Language file: ' . $template->defaultLanguage->name}}</div>
        <div class=""></div>

        <button class="btn-2 btn-blue">
            <span class="btn-bg">Create</span>
        </button>
    </div>

</section>



{{-- {{dd($template)}} --}}


@endsection