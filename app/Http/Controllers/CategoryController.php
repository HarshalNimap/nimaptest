<?php

namespace App\Http\Controllers;

use App\category;
use Illuminate\Http\Request;
use DataTables;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
        $request->validate([
            'category_name'    =>  'required|max:255'
           
        ]);

        $data = category::where('category_name', 'like', $request->category_name)->first();
        // dd($data);
        if($data !== null)
        if($data->category_id)
         {
              return back()->withErrors(['Category Name Is Already Exist']);
         }

       $form_data = array(
            'category_name'=>$request->category_name,
            'active'=>'1',
            'created_by'=>$user_id,
            'updated_by'=>$user_id
        );

        category::create($form_data);
        return redirect('admin/category/')->with('success', 'Category Added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($category_id)
    {
        $data = category::where('category_id','=',$category_id)->firstOrFail();
        return view('admin.category.view', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($category_id)
    {
        $data = category::where('category_id', '=' ,$category_id)->firstOrFail();
        return view('admin.category.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$category_id)
    {
        $user_id=auth()->user()->id;
        $request->validate([
            'category_name'  =>  'required|max:255'
        ]);

        $data = category::where('category_name', 'like', $request->category_name)->where('category_id','!=',$category_id)->first();
        if($data !== null)
        if($data->category_id)
            {
                return back()->withErrors(['Category is already exist']);
            }

        $form_data = array(
            'category_name' =>  $request->category_name,
            'active' => '1',
            'updated_by'=>$user_id
        );

        category::wherecategoryId($category_id)->update($form_data);

        return redirect('admin/category/')->with('success', 'Category is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($category_id)
    {
        category::whereCategoryId($category_id)->update(['active'=>'0']);
        return redirect('admin/category/')->with('success', 'Category is successfully deleted');
    }

    public function getCategoryList(DataTables $datatables)
    {
        // dd($datatables);
        $categoryData= category::where('active','1')->orderBy('category_id','DESC')->get();
        // dd($categoryData);
        $i=1;
        $datatable_array= array();
        foreach($categoryData as $val)
        {
            $new_arr['Sr_No']= $i;
            $new_arr['category_id']= $val->category_id;
            $new_arr['category_name']= $val->category_name;
            $i++;
            $datatable_array[]=$new_arr;
            
        } 
        // dd($datatable_array);
    return DataTables::of($datatable_array)
        ->addColumn('actions', '
        <a href="{{ route(\'category.edit\',$category_id) }}" class="actionbtn"><i class="far fa-edit"></i></a>
        <a href="{{ route(\'category.show\',$category_id) }}" class="actionbtn"><i class="far fa-eye"></i></a>
        <form action="{{ route(\'category.destroy\', $category_id) }}" method="post" class="delete" style="display:inline">
            @csrf
            @method(\'DELETE\')
            <button class="actionbtn" type="submit" onclick="return confirm(\'Are you sure want to delete?\');">
            <i class="far fa-trash-alt"></i></button>
        </form>')->rawColumns(['actions'])->make();
    }
}
