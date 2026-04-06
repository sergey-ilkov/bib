@props([
'title',
'btnName'
])

<div class="content-header">

    <h2 class="content__title title-h2">

        {{ $title }}

    </h2>


    @isset($btnName)

    <x-admin.link-btn class="content__btn" {{ $attributes }}>


        {{ $btnName }}

    </x-admin.link-btn>

    @endisset




</div>