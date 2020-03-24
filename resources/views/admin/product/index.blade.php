@extends('layout')

@section('content')
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Product List</h3>
              <a href="{{ route('product.create') }}" class="float-right btn btn-info">Add New product</a>
            </div>
            <!-- /.box-header -->
            <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="product_list" style="width:100%;">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Product Name</th>
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
           
            $('#product_list').DataTable(
              {
            "processing": true,
            "scrollX": true,
            "serverSide": true,
            "ajax":"{{ route('product.getlist') }}",
            "columns":[
              {"data": "Sr_No" },
              {"data": "product_name" },
              {"data": "actions"}
            ], 
                }
            );
            // alert('99');
        });
  </script> 
@endsection