@extends("layouts.default", [
  'title' => 'Hotel Information',
  'breadcrumb' => [[
    'title' => 'Hotel Information'
  ]],
  'new_button_label' => false
])

@section('content')
@include('alerts.feedback')
<div class="{{ $containerClass ?? 'container' }} page__container">
  <form action="{{url('settings/hotel-information')}}" method="post">
    @csrf @method('put')
  <div class="card card-form">
    <div class="row no-gutters">
      <div class="col-lg-4 card-body">
        <p><strong class="headings-color">Basic Information</strong></p>
        <p class="text-muted">Edit your account details and settings.</p>
      </div>
      <div class="col-lg-8 card-form__body card-body">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="name">Hotel name</label>
              <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Hotel name" value="{{ old('name', auth()->user()->hotel->name) }}">
              @include('alerts.error-feedback', ['field' => 'name'])
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="rooms">Number of rooms</label>
              <input id="no_of_rooms" name="number_of_rooms" value="{{ old('number_of_rooms', auth()->user()->hotel->number_of_rooms) }}" type="number" class="form-control @error('no_of_rooms') is-invalid @enderror" >
              @include('alerts.error-feedback', ['field' => 'no_of_rooms'])
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
            <label for="address">Address</label>
            <textarea name="address" id="address" rows="4" class="form-control @error('address') is-invalid @enderror" placeholder="Address">{{ old('address', auth()->user()->hotel->address) }}</textarea>
            @include('alerts.error-feedback', ['field' => 'address'])
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="country">Country</label>
              <select id="country" name="country_id" class="custom-select">
                @foreach(getModelList('countries') as $country)
                <option value="{{$country->id}}">{{$country->name}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="country">State</label>
              <select id="country" name="state_id" class="custom-select" >
                @foreach(getModelList('states') as $state)
                <option value="{{$state->id}}">{{$state->name}}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="card card-form">
    <div class="row no-gutters">
      <div class="col-lg-4 card-body">
        <p><strong class="headings-color">Profile Settings</strong></p>
        <p class="text-muted">Update your public profile with relevant and meaningful information.</p>
      </div>
      <div class="col-lg-8 card-form__body card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Logo</label>
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
          <div class="col-md-6">
            <label>Phone</label>
            <div class="input-group input-group-merge mb-2" style="width: 270px;">
              <input name="phone" type="number" class="form-control form-control-prepended @error('phone') is-invalid @enderror" placeholder="Phone" value="{{ old('phone', auth()->user()->hotel->phone) }}">
              @include('alerts.error-feedback', ['field' => 'phone'])
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <span class="fab fa-facebook"></span>
                </div>
              </div>
            </div>
            <label>Website</label>
            <div class="input-group input-group-merge mb-2" style="width: 270px;">
              <input name="website" type="text" class="form-control form-control-prepended" placeholder="Website" value="{{ old('website', auth()->user()->hotel->website) }}">
              @include('alerts.error-feedback', ['field' => 'website'])
              <div class="input-group-prepend">
                <div class="input-group-text">
                  <span class="fab fa-facebook"></span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="text-right mb-5">
    <button type="submit" class="btn btn-success">Save</a>
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