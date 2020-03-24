<?php

namespace App\Http\Controllers;

use App\product;
use Illuminate\Http\Request;
use DataTables;

use App\category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categoryData= category::where('active','1')->orderBy('category_id','DESC')->get()->toArray();
        return view('admin.product.create', compact('categoryData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id=auth()->user()->id;
        $rules = [
            'product_name'    =>  'required|max:255',
            'category_id'    =>  'required'
        ];
    
        $customMessages = [
            'product_name.required' => 'Enter Product Name.',
            'category_id.required' => 'Select Category ID.'
        ];
    
        $this->validate($request, $rules, $customMessages);

        $data = product::where('product_name', 'like', $request->product_name)->first();
        // dd($data);
        if($data !== null)
        if($data->product_id)
         {
              return back()->withErrors(['Product Name Is Already Exist']);
         }

       $form_data = array(
            'product_name'=>$request->product_name,
            'category_id'=>$request->category_id,
            'active'=>'1',
            'created_by'=>$user_id,
            'updated_by'=>$user_id
        );

        product::create($form_data);
        return redirect('admin/product/')->with('success', 'Product Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($product_id)
    {
        $data = product::where('Product_id','=',$product_id)->firstOrFail();
        // dd($data->category_id);
        $category= category::where('category_id',$data->category_id)->get()->toArray();
        // dd($category);
        return view('admin.product.view', compact('data','category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id)
    {
        $data = product::where('product_id', '=' ,$product_id)->firstOrFail();
        $categoryData= category::where('active','1')->orderBy('category_id','DESC')->get()->toArray();
        // dd($data);
        return view('admin.product.edit', compact('data','categoryData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$product_id)
    {
        $user_id=auth()->user()->id;
        $rules = [
            'product_name'    =>  'required|max:255',
            'category_id'    =>  'required'
        ];
    
        $customMessages = [
            'product_name.required' => 'Enter Product Name.',
            'category_id.required' => 'Select Category ID.'
        ];
    
        $this->validate($request, $rules, $customMessages);

        $data = product::where('product_name', 'like', $request->product_name)->where('product_id','!=',$product_id)->first();
        if($data !== null)
        if($data->product_id)
            {
                return back()->withErrors(['Product is already exist']);
            }

        $form_data = array(
            'product_name'=>$request->product_name,
            'category_id'=>$request->category_id,
            'active'=>'1',
            'created_by'=>$user_id,
            'updated_by'=>$user_id
        );

        product::whereProductId($product_id)->update($form_data);

        return redirect('admin/product/')->with('success', 'Product is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id)
    {
        
        product::whereProductId($product_id)->update(['active'=>'0']);
        return redirect('admin/product/')->with('success', 'Product is successfully deleted');
    }

    public function getProductList(DataTables $datatables)
    {
        // dd($datatables);
        $productData= product::where('active','1')->orderBy('product_id','DESC')->get();
        // dd($productData);
        $i=1;
        $datatable_array= array();
        foreach($productData as $val)
        {
            $new_arr['Sr_No']= $i;
            $new_arr['product_id']= $val->product_id;
            $new_arr['product_name']= $val->product_name;
            $i++;
            $datatable_array[]=$new_arr;
            
        } 
        // dd($datatable_array);
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
    public function allDetails(DataTables $datatables){
       $productData= product::where('active','1')->orderBy('product_id','DESC')->get();
        // dd($productData);
        $i=1;
        $datatable_array= array();
        foreach($productData as $val)
        {
            $new_arr['Sr_No']= $i;
            $new_arr['product_id']= $val->product_id;
            $new_arr['product_name']= $val->product_name;
            $i++;
            $datatable_array[]=$new_arr;
            
        } 
        // dd($datatable_array);
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
