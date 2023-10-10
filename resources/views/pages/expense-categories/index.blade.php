@extends("layouts.default", [
  'title' => 'Expense Categories',
  'breadcrumb' => [[
    'title' => 'Expense Categories'
  ]],
  'new_button_label' => 'New Expense Category'
  'new_button_slug' => '/expense-categories/create'
])

@section('content')

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
            <th class="text-center">Parent Category</th>
          </tr>
        </thead>
        <tbody class="list" id="">
          @foreach($expense_categories ?? [] as $expense_category)
          <tr>
            <td>
              <div class="badge badge-soft-dark">#{{ 1 + $loop->index }}</div>
            </td>
            <td>
              <a href="{{url('expense-categories/'.$expense_category->id)}}">{{ $expense_category->name ?? '' }}</a>
            </td>
            <td class="text-center">
              {{ $expense_category->parentCategory->name ?? '' }}
            </td>
            
            <td class="text-right">
              <a href="{{url('expense-categories/'.$expense_category->id)}}" class="btn btn-sm btn-primary">EDIT</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    @if($pagination ?? '' !== false)
    <div class="card-body text-right">
      {{$suppliers->links()}}
    </div>
    @endif
  </div>
</div>
@endsection

