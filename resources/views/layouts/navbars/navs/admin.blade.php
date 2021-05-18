<li>
    <a data-toggle="collapse" aria-expanded="true" href="#toggle-admin" class="">
        <i class="nc-icon nc-key-25"></i>
        <p>
            Admin
            <b class="caret"></b>
        </p>
    </a>
    <div class="collapse show" id="toggle-admin">
        <ul class="nav">
            <li class="{{ $elementActive == 'account' ? 'active' : '' }}">
                <a href="{{ route('admin.add', 'account') }}">
                    <span class="sidebar-mini-icon">AC</span>
                    <span class="sidebar-normal">Account</span>
                </a>
            </li>
        </ul>
    </div>
</li>