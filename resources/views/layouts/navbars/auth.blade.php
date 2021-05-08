<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="http://www.creative-tim.com" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('paper') }}/img/logo-small.png">
            </div>
        </a>
        <a class="simple-text logo-normal">
            {{ __('Creative Tim') }}
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li class="{{ $elementActive == 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'dashboard') }}">
                    <i class="nc-icon nc-atom"></i>
                    <p>{{ __('Dashboard') }}</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'company' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'company') }}">
                    <i class="nc-icon nc-bank"></i>
                    <p>Company</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'divisi' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'divisi') }}">
                    <i class="nc-icon nc-chart-bar-32"></i>
                    <p>Divisi</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'aplikasi' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'aplikasi') }}">
                    <i class="nc-icon nc-app"></i>
                    <p>Aplikasi</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'leader' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'leader') }}">
                    <i class="nc-icon nc-single-02"></i>
                    <p>Leader</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'anak' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'anak') }}">
                    <i class="nc-icon nc-badge"></i>
                    <p>Anak</p>
                </a>
            </li>
            <li class="{{ $elementActive == 'tutupbuka' ? 'active' : '' }}">
                <a href="{{ route('page.index', 'tutupbuka') }}">
                    <i class="nc-icon nc-bullet-list-67"></i>
                    <p>TutupBuka</p>
                </a>
            </li>
        </ul>
    </div>
</div>
