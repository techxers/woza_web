<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Business;
use App\Models\Category;
use App\Models\Order;
use App\Models\Order_Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    public function __construct()
    {
        if(Session::has('cart')){
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
            View::share(['products'=>$cart->items,'totalPrice'=>$cart->totalPrice]);
        }
        
    }
    public function index()
    {
       $services=Category::where('type',0)->get();
       $shops=Category::where('type',1)->get();
       $businesses=Business::all();
       $products=null;
       $totalPrice=0;
       if(Session::has('cart')){
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
            $products=$cart->items;$totalPrice=$cart->totalPrice;
            $totalPrice=$cart->totalPrice;
        }
        return view('home.index',compact('services','shops','businesses','products','totalPrice'));
    }
    public function location(Request $request)
    {
    
        $request->validate([
            'txtPlaces'=>'required'
        ]);
        $value=$request->txtPlaces;

       $set= Cookie::queue('name', $value);
    return redirect()->back();

    }
    public function categories($id,Request $request)
    {
        $products=null;
        $totalPrice=null;
        if(Session::has('cart')){
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
            $products=$cart->items;$totalPrice=$cart->totalPrice;
            $totalPrice=$cart->totalPrice;
        }
    
        $categories=Business::where('category','like','%'.$id.'%')->orWhere('shop_cat','like','%'.$id.'%')->get();
        return view('home.categories',compact('categories','id','products','totalPrice'));
    }
    public function services($id,Request $request)
    {
        $categories=Business::where('category','like','%'.$id.'%')->orWhere('shop_cat','like','%'.$id.'%')->get();
        return view('home.services',compact('categories','id'));
    }
    public function shopproducts(Request $request,$id)
    {
        $products=null;
        $totalPrice=null;
        if(Session::has('cart')){
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
            $products=$cart->items;$totalPrice=$cart->totalPrice;
            $totalPrice=$cart->totalPrice;
        }
    
        $shop_products=Product::where('business_id',$id)->paginate(5);
        $shop=Business::findOrFail($id);
        return view('home.products',compact('shop_products','shop','id','products','totalPrice'));
    }
    public function service($id)
    {
        $products=null;
        $totalPrice=null;
        if(Session::has('cart')){
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
            $products=$cart->items;$totalPrice=$cart->totalPrice;
            $totalPrice=$cart->totalPrice;
        }
        $shop=Business::findOrFail($id);
    
        $others=Business::where('id','!=',$shop->id)->where('category','like','%'.$shop->category.'%')->orWhere('shop_cat','like','%'.$id.'%')->get();
    
        return view('home.service',compact('shop','others','products','totalPrice'));
    }
    public function addtocart(Request $request,$shop,$id)
    {
        $product=Product::findOrFail($id);
        $oldCart=Session::has('cart') ? Session::get('cart') : null;
       if($oldCart!=null)
       {
           if($oldCart->shop!=$shop)
           {
               return redirect()->back()->with('error','A cart can only contain products from one shop.');
           }
       }
        $cart= new Cart($oldCart);
        $cart->add($product,$product->id,$shop);
        $request->session()->put('cart',$cart);
        return redirect()->back();
    }
    public function reduce($id,Request $request)
    {
        $oldCart=Session::has('cart') ? Session::get('cart') : null;
         $cart= new Cart($oldCart);
         $cart->reduce($id);
         if(count($cart->items)>0)
         {
             $request->session()->put('cart',$cart);
         }
         else{
             $request->session()->forget('cart');
         }
      
         return redirect()->back();
    }
    public function remove($id,Request $request)
    {
        $oldCart=Session::has('cart') ? Session::get('cart') : null;
        $cart= new Cart($oldCart);
        $cart->remove($id);
        if(count($cart->items)>0)
        {
            $request->session()->put('cart',$cart);
        }
        else{
            $request->session()->forget('cart');
        }
        

        return redirect()->back();
    }
    public function cart()
    {
        if(!Session::has('cart')){
            return view('home.cart');
        }
        $oldCart=Session::get('cart');
        $cart=new Cart($oldCart);
       // dd($cart->items);
        return view('home.cart',['products'=>$cart->items,'totalPrice'=>$cart->totalPrice]);
    }
    public function checkout()
    {
        if(!Session::has('cart')){
            return view('home.cart');
        }
        $oldCart=Session::get('cart');
        $cart=new Cart($oldCart);
        $totalPrice=$cart->totalPrice;
        $products=$cart->items;
        return view('home.checkout',compact('totalPrice','products'));
    }
    public function placeorder(Request $request)
    {
        $order=new Order();
        $cart=Session::get('cart');
        //dd($cart->items);
        $order->user_id=Auth::user()->userId;
        $order->business_id=$cart->shop;
        $order->payment_method=$request->payment_method;
        $order->delivery_address=$request->address.' '.$request->street;
        $order->amount=$cart->totalPrice;
        $order->name=$request->fname.' '.$request->lname;
        $order->type=1;
        $order->created_at=now();
        $order->killmeter=1;
        $order->distance=1;
        $order->save();
        foreach($cart->items as $item)
        {
           //dd($item);
            $order_item=new Order_Item;
            $order_item->order_id=$order->id;
            $order_item->product_id=$item['item']['id'];
            $order_item->unit_price=$item['item']['selling_price'];
           
            $order_item->quantity=$item['qty'];
            $order_item->save();
            //dd($order_item);
        }
        Session::forget('cart');
        return redirect()->route('home.index')->with('success','Your order placed successfully. Delivery in 30-45 mins.');
    }
    public function bookservice($id)
    {
        $products=null;
        $totalPrice=null;
        if(Session::has('cart')){
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
            $products=$cart->items;$totalPrice=$cart->totalPrice;
            $totalPrice=$cart->totalPrice;
        }
       $service=Business::findOrFail($id);
        return view('home.book',compact('products','totalPrice','service'));
    }
    public function confirmbooking($id,Request $request)
    {
        $service=Business::findOrFail($id);
        $booking= new Booking();
        $booking->booker_id=Auth::user()->userId;
        $booking->service_provider_id=$service->id;
        $booking->description=$request->description;
        $booking->latitude=$service->latitude;
        $booking->longitude=$service->longitude;
        $booking->service_time=$request->time;
        $booking->service_date=$request->date;
        $booking->status=0;
        $booking->category=$service->category;
        $booking->address=$service->address;
        $booking->amount=$service->pricing;
        $booking->booking_date=now();
        $booking->save();

        return redirect()->route('home.index')->with('success','Your booking has been placed successfully.');
    }
    public function dashboard()
    {
        
        $products=null;
        $totalPrice=null;
        if(Session::has('cart')){
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
            $products=$cart->items;$totalPrice=$cart->totalPrice;
            $totalPrice=$cart->totalPrice;
        }
        return view('home.dashboard',compact('products','totalPrice'));
    }
}
