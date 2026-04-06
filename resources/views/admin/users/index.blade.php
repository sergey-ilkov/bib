@extends('admin.layouts.base')



@section('content')

<div class="content">

    <x-admin.content-header :title="__('Users')" />


    <div class="content-box">


        <div class="content-table">
            <div class="content-table-header">

                <h3 class="content-table__title title-h3">

                    {{ __('List of users')}}

                </h3>


                <x-admin.link-btn href="{{ route('admin.users.create') }}" class="btn btn-add">

                    {{__('admin.button.add')}}

                </x-admin.link-btn>

            </div>


            <div class="table-body">
                <div class="table-body__row-head">

                    <div class="table-body__col">id</div>
                    <div class="table-body__col">name</div>
                    <div class="table-body__col">email</div>
                    <div class="table-body__col" style="max-width: 120px">is_blocked</div>


                    <div class="table-body__col table-body__col-actions">actions</div>

                </div>


                @foreach ($users as $user)

                <div class="table-body__row {{ $user->is_blocked ? 'is_blocked': '' }}">
                    <div class="table-body__col">{{ $user->id }}</div>
                    <div class="table-body__col">{{ $user->name }}</div>
                    <div class="table-body__col">{{ $user->email }}</div>
                    <div class="table-body__col" style="max-width: 120px">{{ $user->is_blocked }}</div>



                    <div class="table-body__col table-body__col-actions">

                        <div class="table-body-buttons">


                            <x-admin.link-btn href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-edit">

                                {{__('Edit')}}

                            </x-admin.link-btn>


                            @if (hasRole('superadmin'))


                            <x-admin.form action="{{ route('admin.users.toggle-block', $user) }}" method="PATCH" class="card-form">



                                <x-admin.button type="submit" class="btn-view">

                                    {{ $user->is_blocked ? 'unblock' : 'block'; }}

                                </x-admin.button>


                            </x-admin.form>



                            @endif



                        </div>

                    </div>


                </div>


                @endforeach

            </div>






        </div>





    </div>


</div>

@endsection