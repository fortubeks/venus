<ul class="sidebar-menu">
    <li class="sidebar-menu-item {{ $dashboards_menu ?? '' ? 'active open' : '' }}">
        <a class="sidebar-menu-button" data-toggle="collapse" href="#dashboards_menu">
        <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">dvr</i>
        <span class="sidebar-menu-text">Dashboard</span>
        </a>
    </li>

    <li class="sidebar-menu-item {{ activeClass('ui-buttons') }}">
        <a class="sidebar-menu-button" href="{{ url('ui-buttons') }}">
            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">mouse</i>
            <span class="sidebar-menu-text">Rooms</span>
        </a>
    </li>
    <li class="sidebar-menu-item {{ activeClass('ui-alerts') }}">
        <a class="sidebar-menu-button" href="{{ url('ui-alerts') }}">
            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">notifications</i>
            <span class="sidebar-menu-text">Events/Meeting Spaces</span>
        </a>
    </li>
    <li class="sidebar-menu-item {{ activeClass('users') }}">
        <a class="sidebar-menu-button" href="{{ url('users') }}">
            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">person</i>
            <span class="sidebar-menu-text">Users</span>
        </a>
    </li>
</ul>

<div class="sidebar-heading"></div>
    <div class="sidebar-block p-0 mb-0">
    <ul class="sidebar-menu" id="components_menu">
        
        
        <li class="sidebar-menu-item {{ $apps_menu ?? '' ? 'active open' : '' }}">
            <a class="sidebar-menu-button" data-toggle="collapse" href="#apps_menu">
            <i class="sidebar-menu-icon sidebar-menu-icon--left material-icons">slideshow</i>
            <span class="sidebar-menu-text">Settings</span>
            <span class="ml-auto sidebar-menu-toggle-icon"></span>
            </a>
            <ul class="sidebar-submenu collapse {{ $apps_menu ?? '' ? 'show' : '' }}" id="apps_menu">
            @include('partials.settings-sidebar-menu')
            </ul>
        </li>
    </ul>
</div>