@extends("layouts.default", [
  'title' => 'Room Category',
  'breadcrumb' => [[
    'title' => 'Room Category'
  ]],
  'new_button_label' => false
])

@section('content')
<div class="{{ $containerClass ?? 'container' }} page__container">
  <div class="card card-form">
    <form action="{{url('room-categories/'.$room_category->id)}}" method="post">
    @csrf @method('put')
    <div class="card card-form">
      <div class="row no-gutters">
        <div class="col-lg-4 card-body">
          <p><strong class="headings-color">Basic Information</strong></p>
          <p class="text-muted">Add category details.</p>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Room Category Photo</label>
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
            <div class="col-md-6">
              <div class="form-group">
                <label for="name">Name</label>
                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ $room_category->name ?? old('name') }}" placeholder="Name" >
                @include('alerts.error-feedback', ['field' => 'name'])
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <label for="name">Rate</label>
                <input id="rate" name="rate" type="number" class="form-control @error('rate') is-invalid @enderror" value="{{ $room_category->rate ?? old('rate') }}">
                @include('alerts.error-feedback', ['field' => 'rate'])
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
              <label for="discounted_rate">Discounted Rate</label>
              <input name="discounted_rate" type="number" class="form-control @error('discounted_rate') is-invalid @enderror" value="{{ $room_category->discounted_rate ?? old('discounted_rate') }}">
              @include('alerts.error-feedback', ['field' => 'discounted_rate'])
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md">
              <label for="opass">Description</label>
              <textarea id="description" name="description" placeholder="Description" class="form-control @error('description') is-invalid @enderror">{{ $room_category->description ?? old('description') }}</textarea>
              @include('alerts.error-feedback', ['field' => 'description'])
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="text-right">
    <button type="button" class="btn btn-danger btn-delete">Delete</button>
    <button type="submit" class="btn btn-success">Save</button>
  </div>
  </form>
</div>
<form class="d-none" id="form-delete" action="{{url('room-categories/'.$room_category->id)}}" onsubmit="return confirm('Are you sure you want to delete this category?'); " method="post">
    @method('Delete')
    @csrf
</form>
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