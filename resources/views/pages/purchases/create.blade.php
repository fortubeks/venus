@extends("layouts.default", [
  'title' => 'Purchases',
  'breadcrumb' => [[
    'title' => 'Add To Inventory'
  ]],
  'new_button_label' => false
])

@section('content')
<div class="{{ $containerClass ?? 'container' }} page__container">
  <div class="card card-form">
    <form action="{{url('purchases')}}" method="post" autocomplete="off">
    @csrf
    <div class="row no-gutters">
      <div class="col-lg card-form__body card-body">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="phone">Category</label>
              <select id="category" class="form-select form-control" name="category_id">
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
          <div class="col">
            <div class="form-group">
              <label for="flatpickrSample01">Date</label>
              <input id="flatpickrSample01" type="text" class="form-control @error('purchase_date') is-invalid @enderror" name="purchase_date" data-toggle="flatpickr" value="today">
              @include('alerts.error-feedback', ['field' => 'purchase_date'])
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="phone">Supplier <a href="{{url('suppliers/create')}}">(Add)</a></label>
              <select id="supplier_id" class="form-select form-control" name="supplier_id">
                  <option value=""></option>
                  @foreach(getModelList('suppliers') as $supplier)
                  <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                  @endforeach
              </select>
              @include('alerts.error-feedback', ['field' => 'supplier'])
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="rooms">File</label>
              <input id="" name="uploaded_file" type="file" class="form-control @error('uploaded_file') is-invalid @enderror" placeholder="uploaded_file">
              @include('alerts.error-feedback', ['field' => 'uploaded_file'])
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="phone">Status</label>
              <select id="status" class="form-select form-control" name="status">
                  <option value="1">Received</option>
                  <option value="2">Partial</option>
                  <option value="3">Ordered</option>
                  <option value="4">Pending</option>
              </select>
              @include('alerts.error-feedback', ['field' => 'status'])
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="rooms">Note</label>
              <input id="" name="note" type="text" class="form-control @error('note') is-invalid @enderror" placeholder="Note" value="{{ old('note') }}">
              @include('alerts.error-feedback', ['field' => 'note'])
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row no-gutters">
      <div id="input-container" class="col-lg card-form__body card-body">
        <div id="input-template" class="row">
          <div class="col">
            <div class="form-group">
              <label for="rooms">Item/Description</label>
              <input id="description_0" required name="description[]" type="text" list="items" class="form-control @error('description') is-invalid @enderror" placeholder="Name" value="{{ old('description') }}">
              @include('alerts.error-feedback', ['field' => 'description'])

              <datalist id="items">
                @foreach(getModelList('store-items') as $item)
                <option value="{{$item->name}}">
                @endforeach
              </datalist>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="rooms">Quantity</label>
              <input id="qty_0" name="qty[]" type="number" onkeyup="updateAmount(0)" inputmode="decimal" min="0" step="any" class="form-control @error('qty') is-invalid @enderror" placeholder="Qty" value="{{ old('qty') }}">
              @include('alerts.error-feedback', ['field' => 'qty'])
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="rooms">Received</label>
              <input id="received_0" name="received[]" type="number" onkeyup="updateAmount(0)" inputmode="decimal" min="0" step="any" class="form-control @error('received') is-invalid @enderror" placeholder="Received" value="{{ old('received') }}">
              @include('alerts.error-feedback', ['field' => 'received'])
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="rooms">Rate</label>
              <input id="rate_0" name="rate[]" type="number" onkeyup="updateAmount(0)" inputmode="decimal" min="0" step="any" class="form-control @error('rate') is-invalid @enderror" placeholder="Rate" value="{{ old('rate') }}">
              @include('alerts.error-feedback', ['field' => 'rate'])
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="rooms">Amount</label>
              <input id="amount_0" name="amount[]" type="number" class="form-control money @error('amount') is-invalid @enderror" placeholder="Amount" value="{{ old('amount') }}">
              @include('alerts.error-feedback', ['field' => 'amount'])
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="rooms">Unit Qty</label>
              <input id="unitQty_0" name="unit_qty[]" type="number" class="form-control money @error('unit_qty') is-invalid @enderror" placeholder="Unit Qty" value="{{ old('unit_qty') }}">
              @include('alerts.error-feedback', ['field' => 'unit_qty'])
            </div>
          </div>
          <div class="mt-4">
            <button type="button" class="btn btn-sm btn-danger remove-button"><i class="material-icons">close</i></button>
          </div>
        </div>
      </div>
      <div class="col-lg ml-4">
        <button type="button" class="btn btn-sm btn-primary" id="add-input"><i class="material-icons">add</i></button>
      </div>
    </div>
  </div>
  <div class="text-right">
    <input type="hidden" name="hotel_id" value="{{hotelId()}}">
    <button type="submit" class="btn btn-success">Save</a>
  </div>
  </form>
</div>
@endsection

@section('head')
<!-- Flatpickr -->
<link type="text/css" href="{{ url('css/vendor/flatpickr.css') }}" rel="stylesheet">
<link type="text/css" href="{{ url('css/vendor/flatpickr-airbnb.css') }}" rel="stylesheet">
@endsection

@section('footer')
<!-- Flatpickr -->
<script src="{{ url('vendor/flatpickr/flatpickr.min.js') }}" defer></script>
<script src="{{ url('js/flatpickr.js') }}" defer></script>
@endsection

<script>
    window.addEventListener('load', function() {
      $("#add-input").click(function() {
        inputCounter++;

        // Clone the input template
        var newInput = $("#input-template").clone();
        
        // Update IDs and reset values
        newInput.find('[id]').each(function() {
          var oldId = $(this).attr('id');
          var newId = oldId.replace(/_0$/, '_' + inputCounter);
          $(this).attr('id', newId);
          $(this).val('');
        });
        
        // Attach event handlers for the new input fields
        newInput.find("input[type='number']").on('keyup', function() {
          var index = $(this).attr('id').split('_')[1];
          updateAmount(index);
        });

        // Attach a click event to the remove button
        newInput.find(".remove-button").click(function() {
            newInput.remove();
        });
        
        // Append the new input element to the container
        $("#input-container").append(newInput);

  

        // Trigger an initial update of the amount for the new input
        updateAmount(inputCounter);
      });
    });
</script>
<script>
  let inputCounter = 0;

  function updateAmount(index) {
    var qty = parseFloat($("#qty_" + index).val()) || 0;
    var rate = parseFloat($("#rate_" + index).val()) || 0;
    var amount = qty * rate;
    $("#amount_" + index).val(amount.toFixed(2)); // Format the amount as needed
    $("#unitQty_" + index).val(qty); // set unit qty
  }

  
</script>