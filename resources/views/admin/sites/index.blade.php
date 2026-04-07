@extends('admin.layouts.base')



@section('content')

<div class="content">

    <x-admin.content-header :title="__('Sites')" />


    <div class="content-box">


        <div class="content-table">
            <div class="content-table-header">

                <h3 class="content-table__title title-h3">

                    {{ __('List of sites')}}

                </h3>



            </div>


            <div class="table-body">
                <div class="table-body__row-head">

                    <div class="table-body__col">№</div>
                    {{-- <div class="table-body__col">User email</div> --}}
                    <div class="table-body__col">Site name</div>
                    <div class="table-body__col">domen</div>
                    <div class="table-body__col">settings</div>
                    {{-- <div class="table-body__col">upload_url</div>
                    <div class="table-body__col" style="max-width: 120px">device_script</div> --}}
                    <div class="table-body__col" style="max-width: 120px">is_blocked</div>


                    <div class="table-body__col table-body__col-actions">actions</div>

                </div>

                @php $prevUserId = null; @endphp

                @foreach ($sites as $site)

                @if($site->user_id !== $prevUserId)
                <div class="table-body__row">
                    <div class="row-title">{{ $site->user->name }} ({{ $site->user->email }})</div>
                </div>
                @php $prevUserId = $site->user_id; @endphp
                @endif

                <div class="table-body__row {{ $site->is_blocked ? 'is_blocked': '' }}">
                    <div class="table-body__col">{{ $sites->firstItem() + $loop->index }}</div>
                    {{-- <div class="table-body__col">{{ $loop->iteration }}</div> --}}
                    {{-- <div class="table-body__col">{{ $site->user->email }}</div> --}}
                    <div class="table-body__col">{{ $site->name }}</div>
                    <div class="table-body__col">{{ $site->domen }}</div>

                    <div class="table-body__col col-json">
                        @foreach ($site->settings as $key => $value)
                        @if ($value)

                        <span><strong>{{ $key }}:</strong> {{ $value }}</span>
                        @endif
                        @endforeach
                    </div>


                    <div class="table-body__col" style="max-width: 120px">{{ $site->is_blocked }}</div>



                    <div class="table-body__col table-body__col-actions">

                        <div class="table-body-buttons">


                            <x-admin.link-btn href="{{ route('admin.sites.edit', $site) }}" class="btn btn-edit">

                                {{__('Edit')}}

                            </x-admin.link-btn>


                            @if (hasRole('superadmin'))


                            <x-admin.form action="{{ route('admin.sites.toggle-block', $site) }}" method="PATCH" class="card-form">



                                <x-admin.button type="submit" class="btn-view">

                                    {{ $site->is_blocked ? 'unblock' : 'block'; }}

                                </x-admin.button>


                            </x-admin.form>



                            @endif



                        </div>

                    </div>


                </div>


                @endforeach

            </div>


            {{-- Пагинация --}}
            <div class="my-pagination">
                {{ $sites->links() }}
            </div>






        </div>





    </div>


</div>

@endsection