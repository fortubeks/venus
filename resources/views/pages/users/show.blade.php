@extends("layouts.default", [
  'title' => 'Users',
  'breadcrumb' => [[
    'title' => 'Users'
  ]],
  'new_button_label' => false
])

@section('content')
<div class="{{ $containerClass ?? 'container' }} page__container">
  <div class="card card-form">
    <form action="{{url('users/'.$user->id)}}" method="post">
    @csrf @method('put')
    <div class="row no-gutters">
      <div class="col-lg-4 card-body">
        <p><strong class="headings-color">Basic Information</strong></p>
        <p class="text-muted">Edit your account details and settings.</p>
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
              <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name', $user->name) }}">
              @include('alerts.error-feedback', ['field' => 'name'])
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="rooms">User Type / Role</label>
              <select id="user_type" name="user_type" data-user-type="{{$user->user_type}}" class="custom-select">
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
            <input id="phone" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="phone" value="{{ old('phone', $user->phone) }}">
            @include('alerts.error-feedback', ['field' => 'phone'])
            </div>
          </div>
          <div class="col-md-6">
            <label for="opass">Email</label>
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
          </div>
        </div>
        <div class="text-right mt-4">
          <button type="submit" class="btn btn-success">Save</a>
        </div>
      </div>
    </div>
    </form>
  </div>

  <div class="card card-form">
    <div class="row no-gutters">
      <div class="col-lg-4 card-body">
        <p><strong class="headings-color">Login Settings</strong></p>
        <p class="text-muted">Update your details</p>
      </div>
      <div class="col-lg-8 card-form__body card-body">
        <form action="{{url('updatePassword')}}" method="post">
        @csrf
        <div class="form-group">
          <label for="opass">Current Password</label>
          <input style="width: 270px;" id="opass" name="current_password" type="password" class="form-control" placeholder="Old password" >
        </div>
        <div class="form-group">
          <label for="npass">New Password</label>
          <input style="width: 270px;" id="npass" name="new_password" type="password" class="form-control">
        </div>
        <div class="form-group">
          <label for="cpass">Confirm Password</label>
          <input style="width: 270px;" id="cpass" name="confirm_new_password" type="password" class="form-control">
        </div>
        <div class="text-right">
          <button type="submit" class="btn btn-success">Save</a>
        </div>
        </form>
      </div>
    </div>
  </div>
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
        $('.btn-delete').click(function() {
            $('#form-delete').submit()
        });
        var user_type = $('#user_type').attr("data-user-type");
        $('#user_type option[value='+user_type+']').attr('selected','selected');
    });
    
</script>