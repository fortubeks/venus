<!-- drawer -->
<div class="mdk-drawer js-mdk-drawer {{ $drawerClass ?? '' }}" data-align="{{ $drawerAlign ?? 'start' }}" id="default-drawer">
  <div class="mdk-drawer__content">
    <div class="sidebar sidebar-left sidebar-p-t {{ config("flowdash.sidebarClass.{$layout}") }}" data-perfect-scrollbar>
      
      <div class="sidebar-heading sidebar-m-t">Menu</div>
      @if(auth()->user()->user_type == 'super_admin')
      @include('partials.superadmin-sidebar-menu')
      @endif
      @if(auth()->user()->user_type == 'admin')
      @include('partials.admin-sidebar-menu')
      @endif
      @if(auth()->user()->user_type == 'accounts')
      @include('partials.accounts-sidebar-menu')
      @endif

      <div class="d-flex align-items-center sidebar-p-a border-bottom sidebar-account">
        <a href="{{ url('/profile') }}" class="flex d-flex align-items-center text-underline-0 text-body">
          <span class="avatar mr-3">
            <img src="{{ asset('/vendor/flowdash/images/avatar/demi.png') }}" alt="avatar" class="avatar-img rounded-circle">
          </span>
          <span class="flex d-flex flex-column">
            <strong>{{auth()->user()->name}}</strong>
            <small class="text-muted text-uppercase">{{auth()->user()->user_type}}</small>
          </span>
        </a>
        <div class="dropdown ml-auto">
          <a href="#" data-toggle="dropdown" data-caret="false" class="text-muted"><i class="material-icons">more_vert</i></a>
          <div class="dropdown-menu dropdown-menu-right">
            <div class="dropdown-item-text dropdown-item-text--lh">
              <div><strong>{{auth()->user()->name}}</strong></div>
              <div>{{auth()->user()->email}}</div>
            </div>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item {{ activeClass('home') }}" href="{{ url('home') }}">Dashboard</a>
            <a class="dropdown-item {{ activeClass('profile') }}" href="{{ url('/profile') }}">My profile</a>
            <a class="dropdown-item {{ activeClass('edit-account') }}" href="{{ url('edit-account') }}">Edit account</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ url('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
          </div>
        </div>
      </div>

      <div class="sidebar-p-a">
        <a href="" class="btn btn-primary btn-block">Contact Venus Support</a>
      </div>

    </div>
  </div>
</div>
<!-- // END drawer -->