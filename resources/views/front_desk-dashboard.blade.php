@extends("layouts.default", [
  'title' => 'Dashboard',
  'breadcrumb' => [[
    'title' => 'Dashboard'
  ]],
  'new_button_label' => false
])

@section('content')

<div class="{{ $containerClass ?? 'container' }} page__container">
  <div class="row card-group-row">
    <div class="col-lg-12">
      <div class="row">
        <div class="col-md-12">

        </div>
      </div>
      <div class="row">
        <div class="col-md-10">
          <div class="card">
            <div class="table-responsive">

              <table class="table mb-0 thead-border-top-0 table-striped">
                <thead>
                  <tr>
                    <th style="width: 30px;" class="text-center">#Room</th>
                    <th>Guest</th>
                    <th>Checked In</th>
                    <th>Checked Out</th>
                    <th>Payment Status</th>
                    <th class="text-right">Amount </th>
                    <th></th>
                  </tr>
                </thead>
                <tbody class="list" id="">
                  @foreach($rooms ?? [] as $room)
                  @php 
                  $reservation = $room->hasReservation($dashboard_date); @endphp
                  <tr>
                    <td>
                      <div class="badge badge-soft-dark">#{{ $room->name }}</div>
                    </td>
                    <td>
                      @if($reservation)
                      <a href="{{url('reservation/'.$reservation->id)}}">{{ $reservation->guest->first_name ?? '' }}</a>
                      @else
                      
                      @endif
                    </td>
                    <td class="">{{ $$reservation->check_in_date ?? '' }}</td>
                    <td class="">{{ $$reservation->checked_in_at ?? '' }}</td>
                    <td class="">{{ $reservation->checked_out_at ?? '' }}</td>
                    <td class="">{{ $reservation->paymentStatus() ?? '' }}</td>
                    <td class="text-right">{{ $reservation->amount ?? '' }}</td>
                    <td class="text-right">
                      <a href="{{url('reservation/'.$reservation->id)}}" class="btn btn-sm btn-primary">Preview</a>
                      <a href="{{url('reservation/'.$reservation->id)}}" class="btn btn-sm btn-primary">EDIT</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @if($pagination ?? '' !== false)
              <div class="card-body text-right">
                
              </div>
              @endif
            </div>
          </div>
        </div>
        <div class="col-md-2">
          
        </div>
      </div>
        
    </div>
  </div>

  

</div>
@endsection