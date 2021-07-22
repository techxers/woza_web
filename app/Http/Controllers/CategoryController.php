<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::where('user_id',Auth::user()->userId)->paginate(8);
        return view('categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'string|required',
            'description'=>'string|required',
            'icon'=>'required|mimes:png,jpeg,jpg,gif'
        ]);

        $category=new Category();
        $category->title=$request->title;
        $category->description=$request->description;
        $category->type=$request->type;
        $category->user_id=Auth::user()->userId;
        $icon=$request->icon;
        $icon_name=time().'.'.$icon->getClientOriginalExtension();
        $image=Image::make($icon)->resize(300,300);
        $image->save(public_path("images/".$icon_name));
        
       $category->icon=$icon_name;
       $category->create_date=now();
       $category->save();
       return redirect()->route('categories.index')->with('success','Category added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=Category::findOrFail($id);
        return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'string|required',
            'description'=>'string|required'
        ]);

        $category=Category::findOrFail($id);
        $category->title=$request->title;
        $category->description=$request->description;
        $category->type=$request->type;
        $category->icon=$category->icon;
        
        if($request->has('icon'))
        {
            $request->validate([
                'icon'=>'required|mimes:png,jpeg,jpg,gif'
            ]);
            $icon=$request->icon;
            $icon_name=time().'.'.$icon->getClientOriginalExtension();
            $image=Image::make($icon)->resize(300,300);
            $image->save(public_path("images/".$icon_name));
            
             $category->icon=$icon_name;
        }
       
       $category->create_date=now();
       $category->save();
       return redirect()->route('categories.index')->with('success','Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::findOrFail($id);
        if($category->products->count()>0)
        {
            return redirect()->back()->with('errors','Please remove products related to this category before deleting.');
        }
        else{
            $category->delete();
            return redirect()->route('categories.index')->with('success','Category deleted successfully');
        }
    }
}
