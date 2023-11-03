@extends("layouts.default", [
  'title' => 'Store Item',
  'breadcrumb' => [[
    'title' => 'Store Item'
  ]],
  'new_button_label' => false
])

@section('content')
<div class="{{ $containerClass ?? 'container' }} page__container">
  <div class="card card-form">
    <form action="{{url('store-items')}}" method="post" autocomplete="off">
    @csrf
    <div class="row no-gutters">
      <div class="col-lg-4 card-body">
        <p><strong class="headings-color">Basic Information</strong></p>
        <p class="text-muted">Add your store item .</p>
      </div>
      <div class="col-lg-8 card-form__body card-body">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="name">Name</label>
              <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name') }}">
              @include('alerts.error-feedback', ['field' => 'name'])
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="rooms">Purchase Category</label>
              <select id="category" class="form-select form-control" name="purchase_category_id">
                <option value="1">Food</option>
                <option value="2">Drink</option>
                <option value="3">House Keeping</option>
                <option value="4">Maintenance</option>
                <option value="5">Staff</option>
                <option value="6">Admin/Stationery</option>
                <option value="7">Others</option>
              </select>
              @include('alerts.error-feedback', ['field' => 'category'])
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="text-right">
    <button type="submit" class="btn btn-success">Save</a>
  </div>
  </form>
</div>
@endsection

@section('head')
<!-- Dropzone -->
@endsection

@section('footer')

@endsection

<script>
    window.addEventListener('load', function() {
       
    });
    
</script>