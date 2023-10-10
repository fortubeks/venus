@extends("layouts.default", [
  'title' => 'Dashboard',
  'breadcrumb' => [[
    'title' => 'Dashboard'
  ]],
  'new_button_label' => 'Settings',
  'new_button_class' => 'light',
  'new_button_icon_label' => 'settings',
  'new_button_icon_class' => 'text-muted',
  'new_button_slug' => '/settings/hotel-information',
])

@section('content')

<div class="{{ $containerClass ?? 'container' }} page__container">
  <div class="row card-group-row">
    <div class="col-lg-3 col-md-4 card-group-row__col">
        <div class="card card-group-row__card">
          <div class="p-2 d-flex flex-row align-items-center">
            <div class="avatar avatar-xs mr-2">
              <span class="avatar-title rounded-circle text-center bg-primary">
                <i class="material-icons text-white icon-18pt">business</i> 
              </span>
            </div>
            <a href="#" class="text-dark">
              <strong>Accounts</strong>
            </a>
          </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 card-group-row__col">
      <div class="card card-group-row__card">
        <div class="p-2 d-flex flex-row align-items-center">
          <div class="avatar avatar-xs mr-2">
            <span class="avatar-title rounded-circle text-center">
              <i class="material-icons text-white icon-18pt">person_add</i> 
            </span>
          </div>
          <a href="#" class="text-dark">
            <strong>Accomodation</strong>
          </a>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 card-group-row__col">
      <div class="card card-group-row__card">
        <div class="p-2 d-flex flex-row align-items-center">
          <div class="avatar avatar-xs mr-2">
            <span class="avatar-title rounded-circle text-center bg-success">
              <i class="material-icons text-white icon-18pt">receipt</i> 
            </span>
          </div>
          <a href="#" class="text-dark">
            <strong>Restaurant</strong>
          </a>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 card-group-row__col">
      <div class="card card-group-row__card">
        <div class="p-2 d-flex flex-row align-items-center">
          <div class="avatar avatar-xs mr-2">
            <span class="avatar-title rounded-circle text-center bg-info">
              <i class="material-icons text-white icon-18pt">monetization_on</i> 
            </span>
          </div>
          <a href="#" class="text-dark">
            <strong>Bar</strong>
          </a>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 card-group-row__col">
      <div class="card card-group-row__card">
        <div class="p-2 d-flex flex-row align-items-center">
          <div class="avatar avatar-xs mr-2">
            <span class="avatar-title rounded-circle text-center bg-purple">
              <i class="material-icons text-white icon-18pt">shop</i> 
            </span>
          </div>
          <a href="#" class="text-dark">
            <strong>Store</strong>
          </a>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 card-group-row__col">
      <div class="card card-group-row__card">
        <div class="p-2 d-flex flex-row align-items-center">
          <div class="avatar avatar-xs mr-2">
            <span class="avatar-title rounded-circle text-center bg-warning">
              <i class="material-icons text-white icon-18pt">account_balance</i> 
            </span>
          </div>
          <a href="#" class="text-dark">
            <strong>HR</strong>
          </a>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 card-group-row__col">
      <div class="card card-group-row__card">
        <div class="p-2 d-flex flex-row align-items-center">
          <div class="avatar avatar-xs mr-2">
            <span class="avatar-title rounded-circle text-center bg-primary">
              <i class="material-icons text-white icon-18pt">assignment</i> 
            </span>
          </div>
          <a href="#" class="text-dark">
            <strong>Gym</strong>
          </a>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-md-4 card-group-row__col">
      <div class="card card-group-row__card">
        <div class="p-2 d-flex flex-row align-items-center">
          <div class="avatar avatar-xs mr-2">
            <span class="avatar-title rounded-circle text-center bg-danger">
              <i class="material-icons text-white icon-18pt">phone</i> 
            </span>
          </div>
          <a href="#" class="text-dark">
            <strong>Analytics</strong>
          </a>
        </div>
      </div>
    </div>
  </div>

  

</div>
@endsection