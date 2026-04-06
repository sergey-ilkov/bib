@extends('admin.layouts.base')



@section('content')

<div class="content">

    <x-admin.content-header :title="__('Add site to user')" />


    <div class="content-box">


        <div class="content-table">
            <div class="content-table-header">

                <h3 class="content-table__title title-h3">

                    {{ __('List of users')}}

                </h3>



            </div>


            <div class="table-body">
                <div class="table-body__row-head">

                    <div class="table-body__col">id</div>
                    <div class="table-body__col">name</div>
                    <div class="table-body__col">email</div>
                    <div class="table-body__col" style="max-width: 120px">is_blocked</div>
                    <div class="table-body__col" style="max-width: 120px">count sites</div>


                    <div class="table-body__col table-body__col-actions">actions</div>

                </div>


                @foreach ($users as $user)

                <div class="table-body__row {{ $user->is_blocked ? 'is_blocked': '' }}">
                    <div class="table-body__col">{{ $user->id }}</div>
                    <div class="table-body__col">{{ $user->name }}</div>
                    <div class="table-body__col">{{ $user->email }}</div>
                    <div class="table-body__col" style="max-width: 120px">{{ $user->is_blocked }}</div>
                    <div class="table-body__col" style="max-width: 120px">{{ $user->sites_count }}</div>



                    <div class="table-body__col table-body__col-actions">

                        <div class="table-body-buttons">


                            <x-admin.link-btn href="{{ route('admin.user-sites.create', $user) }}" class="btn btn-add">

                                {{__('Add site')}}

                            </x-admin.link-btn>






                        </div>

                    </div>


                </div>


                @endforeach

            </div>






        </div>





    </div>


</div>

@endsection