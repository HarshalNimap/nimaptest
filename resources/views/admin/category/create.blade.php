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
            <form  method="post" action="{{route('category.store')}}" class="form-horizontal" name="form">
              @csrf
              <div class="card-body">
                <div class="form-group row">
                  <div class="col-sm-4">
                    <label for="category_name" class="control-label">Category Name<span class="red-star">*</span></label>
                    <input type="text" class="form-control" id="category_name" name="category_name" placeholder="name">
                  </div>
                </div>
                <!-- <div class="form-group row">
                    
                    <div class="col-sm-6">
                        <label for="inputcategoryname" class="control-label">Status</label>
                        <inp    ut type="checkbox"   name="active" value="1" checked><br>
                    </div>
                </div> -->
                <div class="form-group row">
                  <div class="col-md-12">
                    <button type="reset" class="btn btn-default" onclick="return myFunction()">Cancel</button>
                    <button type="submit" class="btn btn-info pull-right">Submit</button>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /.box -->
          </div>
        </div>
@endsection