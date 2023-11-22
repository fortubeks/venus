@extends("layouts.default", [
  'title' => 'Room Categories',
  'breadcrumb' => [[
    'title' => 'Room Categories'
  ]],
  'new_button_label' => 'New Room Category',
  'new_button_slug' => '/room-categories/create'
])

@section('content')
@include('alerts.feedback')
<div class="{{ $containerClass ?? 'container' }} page__container">
  <div class="card card-form d-flex flex-column flex-sm-row">
    <div class="card-form__body card-body-form-group flex">
      <div class="row">
        <div class="col-sm-auto">
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
            <th>Name</th>
            <th class="text-center">No Rooms</th>
            <th class="text-center">Rate</th>
            <th class="text-center">Discounted Rate</th>
          </tr>
        </thead>
        <tbody class="list" id="">
          @foreach($room_categories ?? [] as $category)
          <tr>
            <td>
              <div class="badge badge-soft-dark">#{{ 1 + $loop->index }}</div>
            </td>
            <td>
              <img src="{{ asset('/vendor/flowdash/images/avatar/demi.png') }}" alt="avatar" class="avatar-img rounded-circle mr-2" style="width:35px" >
              <a href="{{url('room-categories/'.$category->id)}}">{{ $category->name ?? '' }}</a>
            </td>
            <td class="text-center">
              {{ $category->rooms->count() ?? '' }}
            </td>
            <td class="text-center">
              {{ $category->rate ?? '' }}
            </td>
            <td class="text-center">
              {{ $category->discounted_rate ?? '' }}
            </td>
            <td class="text-right">
              <a href="{{url('room-categories/'.$category->id)}}" class="btn btn-sm btn-primary">EDIT</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    @if($pagination ?? '' !== false)
    <div class="card-body text-right">
      
    </div>
    @endif
  </div>
</div>
@endsection

