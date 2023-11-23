@extends("layouts.default", [
  'title' => 'Room Reservations',
  'breadcrumb' => [[
    'title' => 'Room Reservations'
  ]],
  'new_button_label' => false
])

@section('content')
<div class="{{ $containerClass ?? 'container' }} page__container">
<form action="{{url('room-reservations')}}" method="post" autocomplete="off">
    @csrf
  <div class="row mb-2">
    <div class="col-md-6">
      <input id="guest_name" autofocus name="guest_name" type="text" list="guests" class="form-control" placeholder="Search Guest by Name">
      
      <datalist id="guests">
        @foreach(getModelList('guests') as $guest)
        <option value="{{$guest->fullName()}}">
        @endforeach
      </datalist>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <input type="text" required class="form-control @error('checkin_date') is-invalid @enderror dates" name="checkin_date" data-toggle="flatpickr" value="today">
        @include('alerts.error-feedback', ['field' => 'checkin_date'])
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <input type="text" required placeholder="Checkout Date" class="form-control @error('checkout_date') is-invalid @enderror dates" name="checkout_date" data-toggle="flatpickr" >
        @include('alerts.error-feedback', ['field' => 'checkout_date'])
      </div>
    </div>
  </div>
  <div class="card card-form">
    
    <div class="row no-gutters">
      <div class="col-md-8 card-form__body card-body">
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <label for="phone">Title</label>
              <select id="title" class="form-select form-control" name="title">
                 <option value="">--Select--</option>
                 <option value="Mr">Mr</option>
                 <option value="Mrs">Mrs</option>
                 <option value="Chief">Chief</option>
              </select>
              @include('alerts.error-feedback', ['field' => 'title'])
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">First Name</label>
              <input id="" name="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" placeholder="First Name" value="{{ old('first_name') }}">
              @include('alerts.error-feedback', ['field' => 'first_name'])
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="">Last Name</label>
              <input id="" name="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" placeholder="Last Name" value="{{ old('last_name') }}">
              @include('alerts.error-feedback', ['field' => 'last_name'])
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="phone">Other Names</label>
              <input id="" name="other_names" type="text" class="form-control @error('other_names') is-invalid @enderror" placeholder="Other Name" value="{{ old('other_names') }}">
              @include('alerts.error-feedback', ['field' => 'other_names'])
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="phone">Phone</label>
              <input id="" name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone" value="{{ old('phone') }}">
              @include('alerts.error-feedback', ['field' => 'phone'])
            </div>
          </div>
          
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Address</label>
              <input id="" name="address" type="text" class="form-control @error('address') is-invalid @enderror" placeholder="Address" value="{{ old('address') }}">
              @include('alerts.error-feedback', ['field' => 'address'])
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label for="">Email</label>
              <input id="" name="email" type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}">
              @include('alerts.error-feedback', ['field' => 'email'])
            </div>
          </div>
          
        </div>
      </div>
      <div class="col-md-4 card-form__body card-body">
        <div class="row">
          <div class="col-sm-6 col-xs-6">
            <b>Total:</b>
          </div>
          <div class="col-sm-6 col-xs-6">
            <label>{{formatCurrency(300000)}}</label>
          </div>
        </div>
        <div class="row no-gutters">
          <div id="input-container" class="col-lg-12">
            <div id="input-template" class="row">
              <div class="col">
                <div class="form-group">
                  <label for="rooms">Room</label>
                  <select id="room_0" name="room[]" class="form-select form-control">
                    <option value="">--Select--</option>
                    @foreach(getModelList('rooms') as $room)
                    @if($room->isAvailable(now(),now()))
                    <option value="{{$room->id}}">{{$room->name}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="rooms">Rate</label>
                  <input id="rate_0" name="rate[]" type="number" onkeyup="updateAmount(0)" inputmode="decimal" min="0" step="any" class="form-control money @error('qty') is-invalid @enderror" placeholder="Rate" value="{{ old('rate') }}">
                  @include('alerts.error-feedback', ['field' => 'qty'])
                </div>
              </div>
              <div class="mt-4">
                <button type="button" class="btn btn-sm btn-danger remove-button"><i class="material-icons">close</i></button>
              </div>
            </div>
          </div>
          <div class="col-lg-12 ml-4">
            <button type="button" class="btn btn-sm btn-primary" id="add-input"><i class="material-icons">add</i></button>
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

      $('.dates').change(function() {
        // Get the selected date
        var checkInDate = $('#checkin_date').val();
        var checkOutDate = $('#checkout_date').val();

        // Perform an Ajax request to check room availability
        $.ajax({
            url: '/check-room-availability',
            method: 'POST',
            data: {
                checkin_date: checkInDate,
                checkout_date: checkOutDate,
                // Add other necessary data if needed
            },
            success: function(response) {
                // Handle the response
                if (response.available) {
                    // Rooms are available
                    alert('Rooms are available on ' + selectedDate);
                } else {
                    // Rooms are not available
                    alert('No available rooms on ' + selectedDate);
                }
            },
            error: function(error) {
                // Handle the error
                console.error('Ajax request failed:', error);
            }
        });
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