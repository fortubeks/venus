@extends("layouts.default", [
  'title' => 'Purchases',
  'breadcrumb' => [[
    'title' => 'Purchases'
  ]],
  'new_button_label' => false
])

@section('content')
<div class="{{ $containerClass ?? 'container' }} page__container">
  <div class="card card-form">
    <form action="{{url('purchases/'.$purchase->id)}}" method="post" autocomplete="off">
    @csrf @method('put')
    <div class="row no-gutters">
      <div class="col-lg card-form__body card-body">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="phone">Category</label>
              <select id="category" data-category="{{$purchase->category_id}}" class="form-select form-control" name="category_id">
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
              <input id="flatpickrSample01" type="text" class="form-control @error('purchase_date') is-invalid @enderror" name="purchase_date" data-toggle="flatpickr" value="{{$purchase->purchase_date}}">
              @include('alerts.error-feedback', ['field' => 'purchase_date'])
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="phone">Supplier</label>
              <select id="supplier" data-supplier="{{$purchase->supplier_id ?? 0}}" class="form-select form-control" name="supplier_id">
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
              <select id="status" data-status="" class="form-select form-control" name="status">
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
              <input id="" name="note" type="text" class="form-control @error('note') is-invalid @enderror" placeholder="Note" value="{{ old('note') ?? $purchase->note}}">
              @include('alerts.error-feedback', ['field' => 'note'])
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="rooms">Total Amount</label>
              <input type="text" class="form-control" value="{{ $purchase->total_amount}}">
            </div>
          </div>
        </div>
      </div>
    </div>
    <div style="display: none;">
      <div id="input-template" class="row">
        <div class="col">
          <div class="form-group">
            <label for="rooms">Item/Description</label>
            <input type="hidden" name="new_item[]">
            <input id="description_0" name="new_item_description[]" type="text" list="items_" class="form-control @error('description') is-invalid @enderror" placeholder="Name" value="{{ old('description') }}">
            @include('alerts.error-feedback', ['field' => 'description'])

            <datalist id="items_">
              @foreach(getModelList('store-items') as $item_)
              <option value="{{$item_->name}}">
              @endforeach
            </datalist>
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="rooms">Quantity</label>
            <input id="qty_0" name="new_item_qty[]" type="number" onkeyup="updateAmount(0)" inputmode="decimal" min="0" step="any" class="form-control @error('qty') is-invalid @enderror" placeholder="Qty" value="{{ old('qty') }}">
            @include('alerts.error-feedback', ['field' => 'qty'])
          </div>
        </div>
        <div class="col">
            <div class="form-group">
              <label for="rooms">Received</label>
              <input id="received_0" name="new_item_received[]" type="number" onkeyup="updateAmount(0)" inputmode="decimal" min="0" step="any" class="form-control @error('received') is-invalid @enderror" placeholder="Received" value="{{ old('received') }}">
              @include('alerts.error-feedback', ['field' => 'received'])
            </div>
          </div>
        <div class="col">
          <div class="form-group">
            <label for="rooms">Rate</label>
            <input id="rate_0" name="new_item_rate[]" type="number" onkeyup="updateAmount(0)" inputmode="decimal" min="0" step="any" class="form-control @error('rate') is-invalid @enderror" placeholder="Rate" value="{{ old('rate') }}">
            @include('alerts.error-feedback', ['field' => 'rate'])
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="rooms">Amount</label>
            <input id="amount_0" name="new_item_amount[]" type="number" class="form-control money @error('amount') is-invalid @enderror" placeholder="Amount" value="{{ old('amount') }}">
            @include('alerts.error-feedback', ['field' => 'amount'])
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="rooms">Unit Qty</label>
            <input id="unitQty_0" name="new_item_unit_qty[]" type="number" class="form-control money @error('unit_qty') is-invalid @enderror" placeholder="Unit Qty" value="{{ old('unit_qty') }}">
            @include('alerts.error-feedback', ['field' => 'unit_qty'])
          </div>
        </div>
        <div class="mt-4">
          <button type="button" class="btn btn-sm btn-danger remove-button"><i class="material-icons">close</i></button>
        </div>
      </div>
    </div>

    <div class="row no-gutters">
      <div id="input-container" class="col-lg card-form__body card-body">
        @foreach($purchase->items as $key => $item)
        <div id="" class="row">
          <div class="col">
            <div class="form-group">
              <label for="rooms">Item/Description</label>
              <input id="{{_('description_'.$key)}}" name="description[]" type="text" list="items" class="form-control @error('description') is-invalid @enderror" placeholder="Name" value="{{ old('description') ?? $item->storeItem->name }}">
              @include('alerts.error-feedback', ['field' => 'description'])
              <input type="hidden" name="purchase_store_item_id[]" value="{{$item->id}}">
              <datalist id="items">
                @foreach(getModelList('store-items') as $_item)
                <option value="{{$_item->name}}">
                @endforeach
              </datalist>
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="rooms">Quantity</label>
              <input id="{{_('qty'.$key)}}" name="qty[]" type="number" onkeyup="updateAmount(<?php echo $key ?>)" inputmode="decimal" min="0" step="any" class="form-control @error('qty') is-invalid @enderror" placeholder="Qty" value="{{ old('qty') ?? $item->qty }}">
              @include('alerts.error-feedback', ['field' => 'qty'])
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="rooms">Received</label>
              <input id="{{_('received'.$key)}}" name="received[]" type="number" onkeyup="updateAmount(<?php echo $key ?>)" inputmode="decimal" min="0" step="any" class="form-control @error('received') is-invalid @enderror" placeholder="Qty" value="{{ old('received') ?? $item->received }}">
              @include('alerts.error-feedback', ['field' => 'received'])
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="rooms">Rate</label>
              <input id="{{_('rate'.$key)}}" name="rate[]" type="number" onkeyup="updateAmount(<?php echo $key ?>)" inputmode="decimal" min="0" step="any" class="form-control @error('rate') is-invalid @enderror" placeholder="Rate" value="{{ old('rate') ?? $item->rate }}">
              @include('alerts.error-feedback', ['field' => 'rate'])
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="rooms">Amount</label>
              <input id="{{_('amount'.$key)}}" name="amount[]" type="number" class="form-control money @error('amount') is-invalid @enderror" placeholder="Amount" value="{{ old('amount') ?? $item->amount }}">
              @include('alerts.error-feedback', ['field' => 'amount'])
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="rooms">Unit Qty</label>
              <input id="{{_('unit_qty'.$key)}}" name="unit_qty[]" type="number" class="form-control money @error('unit_qty') is-invalid @enderror" placeholder="Unit Qty" value="{{ old('unit_qty') ?? $item->unit_qty }}">
              @include('alerts.error-feedback', ['field' => 'unit_qty'])
            </div>
          </div>
          <div class="mt-4">
            <button type="button" class="btn btn-sm btn-danger remove-button"><i class="material-icons">close</i></button>
          </div>
        </div>
        @endforeach
      </div>
      <div class="col-lg ml-4">
        <button type="button" class="btn btn-sm btn-primary" id="add-input"><i class="material-icons">add</i></button>
      </div>
    </div>
  </div>
  <div class="text-right">
    <input type="hidden" name="hotel_id" value="{{hotelId()}}">
    <button type="button" class="btn btn-danger btn-delete mr-1">Delete</a>
    
    <button type="submit" class="btn btn-success">Save</a>
  </div>
  </form>
</div>
<form class="d-none" id="form-delete" action="{{url('purchases/'.$purchase->id)}}" onsubmit="return confirm('Are you sure you want to delete this purchase?'); " method="post">
    @method('Delete')
    @csrf
</form>

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
      $('.btn-delete').click(function() {
            $('#form-delete').submit()
        });
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
          updateAmountNewInputs(index);
        });

        // Attach a click event to the remove button
        newInput.find(".remove-button").click(function() {
            newInput.remove();
        });
        
        // Append the new input element to the container
        $("#input-container").append(newInput);

  

        // Trigger an initial update of the amount for the new input
        updateAmountNewInputs(inputCounter);
      });
      var category = $('#category').attr("data-category");
      $('#category option[value='+category+']').attr('selected','selected');
      var supplier = $('#supplier').attr("data-supplier");
      $('#supplier option[value='+supplier+']').attr('selected','selected');
    });

</script>
<script>
  let inputCounter = <?php echo count($purchase->items) - 1 ?>;

  function updateAmount(index) {
    var qty = parseFloat($("#qty" + index).val()) || 0;
    var rate = parseFloat($("#rate" + index).val()) || 0;
    var amount = qty * rate;
    $("#amount" + index).val(amount.toFixed(2)); // Format the amount as needed
    $("#unitQty" + index).val(qty); // set unit qty
  }
  function updateAmountNewInputs(index) {
    var qty = parseFloat($("#qty_" + index).val()) || 0;
    var rate = parseFloat($("#rate_" + index).val()) || 0;
    var amount = qty * rate;
    $("#amount_" + index).val(amount.toFixed(2)); // Format the amount as needed
    $("#unitQty_" + index).val(qty); // set unit qty
  }

</script>