@extends('layout')

@section('content')

<script>
  function myFunction() {
    if (confirm("Are you Sure you want to Cancel")) {
      location.reload(true);
    } else {
      return false;
    }
}
</script>
<div class="row">
    <div class="col-md-12">

@if($errors->any())
<div class="alert alert-danger">
 <ul>
  @foreach($errors->all() as $error)
  <li>{{ $error }}</li>
  @endforeach
 </ul>
</div>
@endif
          <!-- Horizontal Form -->  
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Category</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="post" action="" class="form-horizontal">
              @csrf
              @method('PATCH')
              <div class="card-body">
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label for="category_name" class="control-label">Category Name<span class="red-star">*</span></label>
                    <input type="text" class="form-control" id="category_name" name="category_name" readonly value="{{ $data->category_name }}" placeholder="name">
                  </div>
                </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        </div>
@endsection