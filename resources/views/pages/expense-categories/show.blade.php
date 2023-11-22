@extends("layouts.default", [
  'title' => 'Expense Categories',
  'breadcrumb' => [[
    'title' => 'Expense Categories'
  ]],
  'new_button_label' => false
])

@section('content')
<div class="{{ $containerClass ?? 'container' }} page__container">
  <div class="card card-form">
    <form action="{{url('expense-categories/'.$expense_category->id)}}" method="post" autocomplete="off">
    @csrf @method('put')
    <div class="row no-gutters">
      <div class="col-lg-4 card-body">
        <p><strong class="headings-color">Basic Information</strong></p>
        <p class="text-muted">Edit your expense category.</p>
      </div>
      <div class="col-lg-8 card-form__body card-body">
        <div class="row">
          <div class="col">
            <div class="form-group">
              <label for="name">Name</label>
              <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ $expense_category->name ?? old('name') }}">
              @include('alerts.error-feedback', ['field' => 'name'])
            </div>
          </div>
          <div class="col">
            <div class="form-group">
              <label for="rooms">Parent Category</label>
              <select id="category" data-category="{{ $expense_category->parent_id }}" name="parent_id" class="custom-select">
                @foreach(getModelList('expense-categories') as $_expense_category)
                <option value="{{$_expense_category->id}}">{{$_expense_category->name}}</option>
                @endforeach
              </select>
              @include('alerts.error-feedback', ['field' => 'category'])
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="text-left">
    <button type="button" class="btn btn-danger btn-delete">Delete</a>
  </div>
  <div class="text-right">
    <button type="submit" class="btn btn-success">Save</a>
  </div>
  </form>
</div>
<form class="d-none" id="form-delete" action="{{url('expense-categories/'.$expense_category->id)}}" onsubmit="return confirm('Are you sure you want to delete this category?'); " method="post">
    @method('Delete')
    @csrf
</form>
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
        var category = $('#category').attr("data-category");
        $('#category option[value='+category+']').attr('selected','selected');
    });
    
</script>