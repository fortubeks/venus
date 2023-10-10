@extends("layouts.default", [
  'title' => 'Supplier',
  'breadcrumb' => [[
    'title' => 'Supplier'
  ]],
  'new_button_label' => false
])

@section('content')
<div class="{{ $containerClass ?? 'container' }} page__container">
  <div class="card card-form">
    <form action="{{url('suppliers/'.$supplier->id)}}" method="post">
    @csrf @method('put')
    <div class="row no-gutters">
      <div class="col-lg-4 card-body">
        <p><strong class="headings-color">Basic Information</strong></p>
        <p class="text-muted">Edit your supplier details.</p>
      </div>
      <div class="col-lg-8 card-form__body card-body">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="name">Name</label>
              <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ old('name', $supplier->name) }}">
              @include('alerts.error-feedback', ['field' => 'name'])
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="rooms">Contact Person</label>
              <input id="" name="contact_person_name" type="text" class="form-control @error('contact_person_name') is-invalid @enderror" placeholder="Name" value="{{ old('contact_person_name', $supplier->contact_person_name) }}">
              @include('alerts.error-feedback', ['field' => 'contact_person_name'])
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
            <label for="phone">Phone</label>
            <input id="phone" name="contact_person_phone" type="text" class="form-control @error('contact_person_phone') is-invalid @enderror" placeholder="phone" value="{{ old('contact_person_phone', $supplier->contact_person_phone) }}">
            @include('alerts.error-feedback', ['field' => 'contact_person_phone'])
            </div>
          </div>
          <div class="col-md-6">
            <label for="opass">Address</label>
            <input id="email" type="text" name="adress" class="form-control" value="{{ old('address', $supplier->address) }}">
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <label for="opass">Supplier Email</label>
            <input id="email" type="email" name="email" class="form-control" value="{{ old('email', $supplier->email) }}">
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card card-form">
    <div class="row no-gutters">
      <div class="col-lg-4 card-body">
        <p><strong class="headings-color">Bank Details</strong></p>
        <p class="text-muted">Update</p>
      </div>
      <div class="col-lg-8 card-form__body card-body">
        <div class="form-group">
          <label for="phone">Bank Name</label>
            <select id="bank" class="form-select form-control" name="bank_name">
                @foreach(getBanksList() as $bank)
                <option value="{{$bank}}">{{$bank}}</option>
                @endforeach
            </select>
            @include('alerts.error-feedback', ['field' => 'bank_name'])
        </div>
        <div class="form-group">
          <label for="opass">Account Name</label>
          <input id="email" type="text" name="bank_account_name" class="form-control" value="{{ old('bank_account_name', $supplier->bank_account_name) }}">
        </div>
        <div class="form-group">
          <label for="opass">Account Number</label>
          <input id="email" type="text" name="bank_account_no" class="form-control" value="{{ old('bank_account_no', $supplier->bank_account_no) }}">
        </div>
        <div class="text-right">
          <button type="submit" class="btn btn-success">Save</a>
        </div>
      </div>
    </div>
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
        $('.btn-delete').click(function() {
            $('#form-delete').submit()
        });
        var bank = $('#bank').attr("data-bank");
        $('#bank option[value='+bank+']').attr('selected','selected');
    });
    
</script>