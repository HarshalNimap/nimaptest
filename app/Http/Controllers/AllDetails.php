<?php

namespace App\Http\Controllers;

use App\product;
use Illuminate\Http\Request;
use DataTables;

use DB;
use App\category;
class AllDetails extends Controller
{  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	public function index()
    {
        return view('admin.alldetails.index');
    }

   public function alldetails(DataTables $datatables){
   		$productDetails = DB::table('product')
	            ->join('category', 'product.category_id', '=', 'category.category_id')
	            ->select('product.product_id','product.product_name','category.category_id','category.category_name')
	            ->get();
	            $i=1;
		        $datatable_array= array();
		        foreach($productDetails as $val)
		        {
		            $new_arr['Sr_No']= $i;
		            $new_arr['product_id']= $val->product_id;
		            $new_arr['product_name']= $val->product_name;
		            $new_arr['category_id']= $val->category_id;
		            $new_arr['category_name']= $val->category_name;
		            $i++;
		            $datatable_array[]=$new_arr;
		            
		        } 
		        //return $datatable_array;
 return DataTables::of($datatable_array)
        ->addColumn('actions', '
        <a href="{{ route(\'product.edit\',$product_id) }}" class="actionbtn"><i class="far fa-edit"></i></a>
        <a href="{{ route(\'product.show\',$product_id) }}" class="actionbtn"><i class="far fa-eye"></i></a>
        <form action="{{ route(\'product.destroy\', $product_id) }}" method="post" class="delete" style="display:inline">
            @csrf
            @method(\'DELETE\')
            <button class="actionbtn" type="submit" onclick="return confirm(\'Are you sure want to delete?\');">
            <i class="far fa-trash-alt"></i></button>
        </form>')->rawColumns(['actions'])->make();
   }
  

}
 