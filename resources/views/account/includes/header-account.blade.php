@php
$user = auth('web')->user();
$user_initial = substr($user->email, 0, 1) ;

@endphp


<header class="header">
    <div class="container">
    </div>
    <div class="header-inner">
        <div class="logo">Bibber</div>

        <ul class="header-menu">
            <li class="header-menu-item {{ active_link('apps') }}">

                @if(request()->is('apps*'))

                <span class="header-menu-title">My Apps</span>

                @else

                <a href="{{ route('apps') }}" class="header-menu-link btn">
                    <span class="btn-bg">My Apps</span>
                </a>

                @endif
            </li>
            <li class="header-menu-item {{ active_link('account') }}">

                @if(request()->is('account*'))

                <span class="header-menu-title">Account</span>

                @else

                <a href="{{ route('account') }}" class="header-menu-link btn">
                    <span class="btn-bg">Account</span>
                </a>

                @endif

            </li>
        </ul>


        <div id="user-box" class="user-box">
            <button id="user-box-btn" class="user-box-btn btn">
                <span class="user-icon">B</span>
                <svg class="user-box-btn-svg" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                </svg>
            </button>


            <div id="user-panel" class="user-panel">
                <div class="user-panel-header">
                    <span class="user-icon">{{ $user_initial }}</span>
                    <span class="user-email">{{ $user->email }}</span>
                </div>


                <ul class="user-panel-menu">

                    <li class="user-panel-item">
                        <a href="{{ route('account') }}" class="user-panel-link btn">
                            <span class="btn-bg">Account Settings</span>
                        </a>
                    </li>
                </ul>



                <div class="user-panel-footer">

                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button class="user-panel-btn btn">
                            <span class="btn-bg">Log out</span>
                        </button>

                    </form>

                </div>


            </div>

        </div>

        <button id="burger-menu" class="burger-menu"><span></span></button>


        <div id="header-menu-mobile" class="header-menu-mobile">
            <div class="header-menu-mobile-box">

                <div class="user-panel-header">
                    <span class="user-icon">{{ $user_initial }}</span>
                    <span class="user-email">{{ $user->email }}</span>
                </div>

                <ul class="user-panel-menu">
                    <li class="user-panel-item">
                        <a href="{{ route('apps') }}" class="user-panel-link btn">
                            <span class="btn-bg">My Apps</span>
                        </a>
                    </li>
                    <li class="user-panel-item">
                        <a href="{{ route('account') }}" class="user-panel-link btn">
                            <span class="btn-bg">Account Settings</span>
                        </a>
                    </li>
                </ul>

                <div class="user-panel-footer">

                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button class="user-panel-btn btn">
                            <span class="btn-bg">Log out</span>
                        </button>

                    </form>

                </div>
            </div>

        </div>

    </div>
</header>