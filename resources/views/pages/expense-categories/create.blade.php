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
    <form action="{{url('expense-categories')}}" method="post" autocomplete="off">
    @csrf
    <div class="row no-gutters">
      <div class="col-lg-4 card-body">
        <p><strong class="headings-color">Basic Information</strong></p>
        <p class="text-muted">Add your expense category.</p>
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
              <label for="rooms">Parent Category</label>
              <select id="category" name="category" class="custom-select">
                <option value="1">--Default--</option>
                @foreach(getModelList('expense-categories') as $expense_category)
                <option value="{{$expense_category->id}}">{{$expense_category->name}}</option>
                @endforeach
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