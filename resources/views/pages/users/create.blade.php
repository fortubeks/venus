@extends("layouts.default", [
  'title' => 'Users',
  'breadcrumb' => [[
    'title' => 'Users'
  ]],
  'new_button_label' => false
])

@section('content')
<div class="{{ $containerClass ?? 'container' }} page__container">
  <form action="{{url('users')}}" method="post">
    @csrf
  <div class="card card-form">
    <div class="row no-gutters">
      <div class="col-lg-4 card-body">
        <p><strong class="headings-color">Basic Information</strong></p>
        <p class="text-muted">Add account details and settings.</p>
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label>Profile Photo</label>
              <div 
                class="dz-clickable media align-items-center"
                data-toggle="dropzone"
                data-dropzone-url="http://"
                data-dropzone-clickable=".dz-clickable"
                data-dropzone-files='["{{ url('/vendor/flowdash/images/account-add-photo.svg') }}"]'>
                <div class="dz-preview dz-file-preview dz-clickable mr-3">
                  <div class="avatar" style="width: 80px; height: 80px;">
                    <img src="{{ url('/vendor/flowdash/images/account-add-photo.svg') }}" class="avatar-img rounded" alt="..." data-dz-thumbnail>
                  </div>
                </div>
                <div class="media-body">
                  <button class="btn btn-sm btn-primary dz-clickable">Choose photo</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-8 card-form__body card-body">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="name">Name</label>
              <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Name" >
              @include('alerts.error-feedback', ['field' => 'name'])
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="rooms">User Type / Role</label>
              <select id="user_type" name="user_type" class="custom-select">
                <option value="">--Select--</option>
                <option value="super_admin">Super Admin</option>
                <option value="admin">Admin/Manager</option>
                <option value="accounts">Accounts</option>
                <option value="front_desk">Front Desk</option>
                <option value="sales_point">Sales Point</option>
                <option value="store">Store</option>
                <option value="hr">HR</option>
                <option value="gym">Gym</option>
                <option value="spa">Spa</option>
              </select>
              @include('alerts.error-feedback', ['field' => 'user_type'])
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
            <label for="phone">Phone</label>
            <input id="phone" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone" value="{{ old('phone') }}">
            @include('alerts.error-feedback', ['field' => 'phone'])
            </div>
          </div>
          <div class="col-md-6">
            <label for="opass">Email</label>
            <input id="email" type="email" name="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
            @include('alerts.error-feedback', ['field' => 'email'])
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card card-form">
    <div class="row no-gutters">
      <div class="col-lg-4 card-body">
        <p><strong class="headings-color">Login Settings</strong></p>
        <p class="text-muted">Update your details</p>
      </div>
      <div class="col-lg-8 card-form__body card-body">
        <div class="form-group">
          <label for="rooms">Hotel</label>
          <select id="hotel" name="hotel_id" class="custom-select">
            @foreach(auth()->user()->userAccount->hotels as $hotel)
            <option value="{{$hotel->id}}">{{$hotel->name}}</option>
            @endforeach
          </select>
          @include('alerts.error-feedback', ['field' => 'user_type'])
        </div>
        <div class="form-group">
          <label for="npass">Password</label>
          <input id="npass" name="password" type="password" class="form-control @error('password') is-invalid @enderror">
          @include('alerts.error-feedback', ['field' => 'password'])
        </div>
        <div class="form-group">
          <label for="cpass">Confirm Password</label>
          <input id="cpass" name="password_confirmation" type="password" class="form-control  @error('password_confirmation') is-invalid @enderror">
          @include('alerts.error-feedback', ['field' => 'password'])
        </div>
      </div>
    </div>
  </div>
  <div class="text-right mb-5">
  <button type="submit" class="btn btn-success">Save</button>
  </div>
  </form>
</div>
@endsection

@section('head')
<!-- Dropzone -->
<link type="text/css" href="{{ url('css/vendor/dropzone.css') }}" rel="stylesheet">
@endsection

@section('footer')
<!-- Dropzone -->
<script src="{{ url('vendor/dropzone.min.js') }}" defer></script>
<script src="{{ url('js/dropzone.js') }}" defer></script>
@endsection

<script>
    window.addEventListener('load', function() {
        
    });
    
</script>