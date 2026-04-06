@extends('admin.layouts.base')



@section('content')

<div class="content">

    <x-admin.content-header :title="__('admin.title.languages')" />


    <div class="content-box">


        <div class="content-table">
            <div class="content-table-header">

                <h3 class="content-table__title title-h3">

                    {{ __('admin.title.list-languages')}}

                </h3>


                <x-admin.link-btn href="{{ route('admin.languages.create') }}" class="btn btn-add">

                    {{__('admin.button.add')}}

                </x-admin.link-btn>

            </div>


            <div class="table-body">
                <div class="table-body__row-head">

                    <div class="table-body__col">id</div>
                    <div class="table-body__col">name</div>
                    <div class="table-body__col" style="max-width: 200px">code</div>
                    <div class="table-body__col" style="max-width: 120px">date</div>

                    <div class="table-body__col table-body__col-actions">actions</div>

                </div>


                @foreach ($languages as $language)

                <div class="table-body__row">
                    <div class="table-body__col">{{ $language->id }}</div>
                    <div class="table-body__col">{{ $language->name }}</div>
                    <div class="table-body__col" style="max-width: 200px">{{ $language->code }}</div>
                    <div class="table-body__col" style="max-width: 120px">{{ $language->created_at->format('d-m-Y') }}</div>


                    <div class="table-body__col table-body__col-actions">

                        <div class="table-body-buttons">


                            <x-admin.link-btn href="{{ route('admin.languages.edit', $language->id) }}" class="btn btn-edit">

                                {{__('Edit')}}

                            </x-admin.link-btn>

                            {{-- @if (hasRole('superadmin'))

                            <x-admin.button class="btn btn-delete btn-modal-delete" data-action="{{ route('admin.languages.destroy', $language->id) }}" data-name="{{ $language->id . ' ' . $language->name }}">

                                {{__('Delete')}}

                            </x-admin.button>
                            @endif --}}


                        </div>

                    </div>


                </div>


                @endforeach

            </div>






        </div>


        {{-- ? modal delete --}}
        <x-admin.modal-delete></x-admin.modal-delete>



    </div>


</div>

@endsection