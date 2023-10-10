@extends("layouts.default", [
  'title' => 'Dashboard',
  'breadcrumb' => [[
    'title' => 'Dashboard'
  ]],
  'new_button_label' => false
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
            <a href="{{url('expenses')}}" class="text-dark">
              <strong>Expenses</strong>
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
          <a href="{{url('suppliers')}}" class="text-dark">
            <strong>Suppliers</strong>
          </a>
        </div>
      </div>
    </div>
  </div>

  

</div>
@endsection