@extends('account.layouts.widget')

@section('content')


@php


@endphp


<section class="constructor">



    <div class=""></div>
    <div class="title-h1">Constructor widget</div>
    <div class=""></div>


    {{-- <div class="">{{'id site: ' . $site->id}}</div> --}}
    {{-- <div class="">{{'id site: ' . $site->name}}</div> --}}
    <div class="">{{'Widget name: ' . $widget->name}}</div>
    <div class="">{{'App key: ' . $widget->uid}}</div>




</section>



{{-- {{dd($template)}} --}}


@endsection