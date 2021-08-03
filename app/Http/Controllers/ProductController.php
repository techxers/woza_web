<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
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
        $business= Auth::user()->business;
        $products=Product::where('business_id',$business->id)->paginate(8);
        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::where('user_id',Auth::user()->userId)->get();
        return view('products.create',compact('categories'));
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
            'name'=>'string|required',
            'description'=>'string|required',
            'buying_price'=>'integer|required',
            'selling_price'=>'integer|required',
            'quantity'=>'integer|required',
            'shipping_charge'=>'integer|required',
            'image'=>'required|mimes:jpg,jpeg,gif,png'
        ]);
        $product= new Product();
        $product->name=$request->name;
        $product->business_id=Auth::user()->business->id;
        $product->description=$request->description;
        $product->purchase_price=$request->buying_price;
        $product->selling_price=$request->selling_price;
        $product->qut=$request->quantity;
        $product->shipping_charge=$request->shipping_charge;
        $product->selling_type=$request->unit;
        $product->category_id=$request->category;
        if($request->size==null)
        {
            $product->size=0;
        }
        else{
            $product->size=$request->size;
        }
        

        $image=$request->image;
        $img_name=time().'.'.$image->getClientOriginalExtension();
        $img=Image::make($image)->resize(300,300);
        $img->save(public_path('images/products/'.$img_name));

        $product->image=$img_name;
        $product->save();

        return redirect()->route('products.index')->with('success','Product added successfully');
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
        $categories=Category::where('user_id',Auth::user()->userId)->get();
        $product=Product::findOrFail($id);
        return view('products.edit',compact('categories','product'));
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
            'name'=>'string|required',
            'description'=>'string|required',
            'buying_price'=>'integer|required',
            'selling_price'=>'integer|required',
            'quantity'=>'integer|required',
            'shipping_charge'=>'integer|required',   
        ]);
        $product= Product::findOrFail($id);
        $product->name=$request->name;
        $product->description=$request->description;
        $product->purchase_price=$request->buying_price;
        $product->selling_price=$request->selling_price;
        $product->qut=$request->quantity;
        $product->shipping_charge=$request->shipping_charge;
        $product->selling_type=$request->unit;
        $product->category_id=$request->category;
        if($request->size==null)
        {
            $product->size=0;
        }
        else{
            $product->size=$request->size;
        }
        $product->image=$product->image;
        if($request->has('image'))
        {
            $request->validate([
                'image'=>'required|mimes:jpg,jpeg,gif,png'
            ]);
            $image=$request->image;
            $img_name=time().'.'.$image->getClientOriginalExtension();
            $img=Image::make($image)->resize(300,300);
            $img->save(public_path('images/products/'.$img_name));
    
            $product->image=$img_name;
        }
      
        $product->save();

        return redirect()->route('products.index')->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::findOrFail($id);
        $items=$product->order_items->count();
        if($items>0)
        {
            return redirect()->back()->withErrors('This product cannot be deleted because it has been ordered.');
        }
        else{
            $product->delete();
            return redirect()->route('products.index')->with('success','Product deleted successfully');
        }
    }
}
