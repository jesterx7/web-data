<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('paper') }}/img/logo-small.png">
            </div>
        </a>
        <a href="http://www.creative-tim.com" class="simple-text logo-normal">
            {{ __('Creative Tim') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'dashboard') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'user' || $elementActive == 'profile' ? 'active' : '' }}">
                <a data-toggle="collapse" aria-expanded="true" href="#laravelExamples">
                    <i class="nc-icon"><img src="{{ asset('paper/img/laravel.svg') }}"></i>
                    <p>
                            {{ __('Laravel examples') }}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse show" id="laravelExamples">
                    <ul class="nav">
                        <li class="{{ $elementActive == 'profile' ? 'active' : '' }}">
                            <a href="{{ route('profile.edit') }}">
                                <span class="sidebar-mini-icon">{{ __('UP') }}</span>
                                <span class="sidebar-normal">{{ __(' User Profile ') }}</span>
                            </a>
                        </li>
                        <li class="{{ $elementActive == 'user' ? 'active' : '' }}">
                            <a href="{{ route('page.index', 'user') }}">
                                <span class="sidebar-mini-icon">{{ __('U') }}</span>
                                <span class="sidebar-normal">{{ __(' User Management ') }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="{{ $elementActive == 'icons' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'icons') }}">
                    <i class="nc-icon nc-diamond"></i>
                    <p>{{ __('Icons') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'map' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'map') }}">
                    <i class="nc-icon nc-pin-3"></i>
                    <p>{{ __('Maps') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'notifications' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'notifications') }}">
                    <i class="nc-icon nc-bell-55"></i>
                    <p>{{ __('Notifications') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'company' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'company') }}">
                    <i class="nc-icon nc-tile-56"></i>
                    <p>Company</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'divisi' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'divisi') }}">
                    <i class="nc-icon nc-tile-56"></i>
                    <p>Divisi</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'aplikasi' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'aplikasi') }}">
                    <i class="nc-icon nc-tile-56"></i>
                    <p>Aplikasi</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'leader' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'leader') }}">
                    <i class="nc-icon nc-tile-56"></i>
                    <p>Leader</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'anak' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'anak') }}">
                    <i class="nc-icon nc-tile-56"></i>
                    <p>Anak</p>
                </a>
            </li>
        </ul>
    </div>
</div>
