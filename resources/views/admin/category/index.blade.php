@extends('layout')

@section('content')
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Category List</h3>
              <a href="{{ route('category.create') }}" class="float-right btn btn-info">Add New Category</a>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="category_list" style="width:100%;">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Category Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
              </table> 
            </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
         
@endsection

@section('scripts')
<script>
        $(document).ready(function () {
           
            $('#category_list').DataTable(
              {
            "processing": true,
            "scrollX": true,
            "serverSide": true,
            "ajax":"{{ route('category.getlist') }}",
            "columns":[
              {"data": "Sr_No" },
              {"data": "category_name" },
              {"data": "actions"}
            ], 
                }
            );
            // alert('99');
        });
  </script> 
@endsection