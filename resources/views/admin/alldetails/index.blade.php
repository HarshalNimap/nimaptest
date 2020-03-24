@extends('layout')

@section('content')
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">All Product With Category List</h3>
              
            </div>
            <!-- /.box-header -->
            <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="all_list" style="width:100%;">
                <thead>
                  <tr>
                    <th>Ser No.</th>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Category ID</th>
                    <th>Category Name</th>
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
           
            $('#all_list').DataTable(
              {
            "processing": true,
            "scrollX": true,
            "serverSide": true,
            "ajax":"{{ route('all.getlist') }}",
            "columns":[
              {"data": "Sr_No" },
              {"data": "product_id" },
              {"data": "product_name"},
               {"data": "category_id" },
              {"data": "category_name"}
            ], 
                }
            );
            // alert('99');
        });
  </script> 
@endsection
