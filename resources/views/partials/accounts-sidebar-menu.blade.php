<ul class="sidebar-menu">
    <li class="sidebar-menu-item {{ $dashboards_menu ?? '' ? 'active open' : '' }}">
        <a class="sidebar-menu-button" href="{{url('/home')}}">
        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
        <span class="sidebar-menu-text">Dashboard</span>
        </a>
    </li>

    <li class="sidebar-menu-item {{ activeClass('ui-buttons') }}">
        <a class="sidebar-menu-button" href="{{ url('/home') }}">
            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">mouse</i>
            <span class="sidebar-menu-text">Revenue</span>
        </a>
    </li>
    <li class="sidebar-menu-item {{ activeClass('ui-alerts') }}">
        <a class="sidebar-menu-button" href="{{ url('expenses') }}">
            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">notifications</i>
            <span class="sidebar-menu-text">Expenses</span>
        </a>
    </li>
    <li class="sidebar-menu-item {{ activeClass('users') }}">
        <a class="sidebar-menu-button" href="{{ url('expense-categories') }}">
            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">person</i>
            <span class="sidebar-menu-text">Expense Categories</span>
        </a>
    </li>
    <li class="sidebar-menu-item {{ activeClass('users') }}">
        <a class="sidebar-menu-button" href="{{ url('suppliers') }}">
            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">person</i>
            <span class="sidebar-menu-text">Suppliers</span>
        </a>
    </li>
</ul>
