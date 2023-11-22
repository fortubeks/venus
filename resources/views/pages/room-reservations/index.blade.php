@extends("layouts.default", [
  'title' => 'Room Reservations',
  'breadcrumb' => [[
    'title' => 'Room Reservations'
  ]],
  'new_button_label' => 'New Reservation',
  'new_button_slug' => '/room-reservations/create'
])

@section('content')
@include('alerts.feedback')
<div class="{{ $containerClass ?? 'container' }} page__container">
  <div class="card card-form d-flex flex-column flex-sm-row">
    <div class="card-form__body card-body-form-group flex">
      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="filter_name">Name</label>
            <input id="filter_name" type="text" class="form-control" placeholder="Search by name">
          </div>
        </div>
        
      </div>
    </div>
    <button class="btn bg-white border-left border-top border-top-sm-0 rounded-top-0 rounded-top-sm rounded-left-sm-0"><i class="material-icons text-primary icon-20pt">refresh</i></button>
  </div>

  <div class="card">
    <div class="table-responsive">

      <table class="table mb-0 thead-border-top-0 table-striped">
        <thead>
          <tr>
            <th style="width: 30px;" class="text-center">#ID</th>
            <th>Date</th>
            <th>Category</th>
            <th>Description</th>
            <th>Supplier</th>
            <th>Payment Status</th>
            <th class="text-right">Amount </th>
            <th></th>
          </tr>
        </thead>
        <tbody class="list" id="">
          @foreach($expenses ?? [] as $expense)
          <tr>
            <td>
              <div class="badge badge-soft-dark">#{{ 1 + $loop->index }}</div>
            </td>
            <td>
              <a href="{{url('expenses/'.$expense->id)}}">{{ $expense->expense_date ?? '' }}</a>
            </td>
            <td class="">{{ $expense->category->name ?? '' }}</td>
            <td class="">{{ $expense->getItems() ?? '' }}</td>
            <td class="">{{ $expense->supplier->name ?? '' }}</td>
            <td class="">{{ $expense->paymentStatus() ?? '' }}</td>
            <td class="text-right">
              {{ $expense->amount ?? '' }}
            </td>
            <td class="text-right">
              <a href="{{url('expenses/'.$expense->id)}}" class="btn btn-sm btn-primary">Preview</a>
              <a href="#" onclick="setId(this)" data-amount="{{$expense->amount}}" data-id="{{$expense->id}}" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modal-payment">Add Payment</a>
              <a href="{{url('expenses/'.$expense->id)}}" class="btn btn-sm btn-primary">EDIT</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    @if($pagination ?? '' !== false)
    <div class="card-body text-right">
      {{$expenses->links()}}
    </div>
    @endif
  </div>
</div>

@endsection
<div id="modal-payment" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modal-standard-title" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-standard-title">Add Payment to Bill [<span id="expense_amount"></span>]</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> <!-- // END .modal-header -->
      <form action="{{url('expense-payments')}}" method="POST">
        <div class="modal-body">
            @csrf
          <div class="row">
              <div class="col-md-12">
                  <label>{{ __('Amount') }}</label>
                  <input type="number" class="form-control" name="amount" value="0" required>
              </div>
              <div class="col-md-12">
                  <label>{{ __('Mode of payment') }}</label>
                  <select name="mode_of_payment" class="form-control">
                      <option value="cash">Cash</option>
                      <option value="transfer">Transfer</option>
                      <option value="pos">POS</option>
                  </select>
              </div>
              <div class="col-md-12">
                  <label>{{ __('Date of payment') }}</label>
                <input type="date" class="form-control @error('date_of_payment') is-invalid @enderror" name="date_of_payment">
              </div>
              <div class="col-md-12">
                  <label>{{ __('Note') }}</label>
                  <input type="text" class="form-control" name="note">
              </div>
          </div>
        </div><!-- // END .modal-body -->
        <div class="modal-footer">
            <input type="hidden" id="expense_id" value="" name="expense_id">
            <input type="hidden" name="hotel_id" value="{{auth()->user()->hotel_id}}">
            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
        </div><!-- // END .modal-footer -->
      </form>
    </div> <!-- // END .modal-content -->
  </div> <!-- // END .modal-dialog -->
</div> <!-- // END .modal -->
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

$('input').click(function() {
    this.select();
});
});
  function setId(item){
    var id = item.dataset.id;
    var amount = item.dataset.amount;
    document.getElementById('expense_id').value = id;
    document.getElementById('expense_amount').innerHTML = amount;
  }
</script>