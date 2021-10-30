<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\Booking;
use App\Models\Country;
use App\Models\Product;
use App\Models\Business;
use App\Models\Category;
use App\Models\Order_Item;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    public function __construct()
    {
        $products=array();
        $totalPrice=null;
        if(Session::has('cart')){
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
            $products=$cart->items;
            $totalPrice=$cart->totalPrice;
        }
        $this->products=$products;
        $this->totalPrice=$totalPrice;
    }
    //Paginate arrays
    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
    // Calculates distance between user and restaurants 
    function getDistance($addressFrom, $addressTo, $unit = ''){
        // Google API key
        $apiKey = 'AIzaSyAIlDX7c8972C1NTV4QMxHgUZrBPCN5Tdo';
        
        // Change address format
        $formattedAddrFrom    = str_replace(' ', '+', $addressFrom);
        $formattedAddrTo     = str_replace(' ', '+', $addressTo);
        
        // Geocoding API request with start address
        $geocodeFrom = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrFrom.'&sensor=false&key='.$apiKey);
        $outputFrom = json_decode($geocodeFrom);
        if(!empty($outputFrom->error_message)){
            return redirect()->back()->with('error',$outputFrom->error_message);
        }
        
        // Geocoding API request with end address
        $geocodeTo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address='.$formattedAddrTo.'&sensor=false&key='.$apiKey);
        $outputTo = json_decode($geocodeTo);
        if(!empty($outputTo->error_message)){
            return redirect()->back()->with('error',$outputTo->error_message);
        }
        
        // Get latitude and longitude from the geodata
        $latitudeFrom    = $outputFrom->results[0]->geometry->location->lat;
        $longitudeFrom    = $outputFrom->results[0]->geometry->location->lng;
        $latitudeTo        = $outputTo->results[0]->geometry->location->lat;
        $longitudeTo    = $outputTo->results[0]->geometry->location->lng;
        
        // Calculate distance between latitude and longitude
        $theta    = $longitudeFrom - $longitudeTo;
        $dist    = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
        $dist    = acos($dist);
        $dist    = rad2deg($dist);
        $miles    = $dist * 60 * 1.1515;
        
        // Convert unit and return distance
        $unit = strtoupper($unit);
        if($unit == "K"){
           // return round($miles * 1.609344, 2).' km';
            return round($miles * 1.609344, 2);
        }elseif($unit == "M"){
            return round($miles * 1609.344, 2).' meters';
        }else{
            return round($miles, 2).' miles';
        }
    }
    public function index()
    {
       if(Auth::check())
       {
            if(Auth::user()->uType==1)
            {
                return redirect()->route('partner.dashboard');
            }
       }
        
       $services=Category::where('type',0)->get();
       $shops=Category::where('type',1)->get();

        $businesses=Business::all();
        $featured_shops=Business::all();
        $featured_products=Product::all();
        $featured_products2=Product::all();
       if($businesses->count()>10)
       {
            $featured_shops=Business::all()->random(10);
       }
       else 
       {
            $featured_shops=Business::all();
       }
       if($featured_products->count()>3)
       {
           $featured_products=Product::all()->random(3);
            $featured_products2=Product::all()->random(3);
       }
       else
       {
        $featured_products=Product::all();
        $featured_products2=Product::all();
       }
        
       $products=null;
       $totalPrice=0;
       if(Session::has('cart')){
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
            $products=$cart->items;$totalPrice=$cart->totalPrice;
            $totalPrice=$cart->totalPrice;
        }
        $all_products=Product::all();
        $countries=Country::orderBy('name','ASC')->get();
        return view('customer.index',compact('featured_products','featured_products2','featured_shops','all_products','countries','services','shops','businesses','products','totalPrice'));
    }
    public function contact()
    {
        $products=null;
        $totalPrice=0;
        if(Session::has('cart')){
             $oldCart=Session::get('cart');
             $cart=new Cart($oldCart);
             $products=$cart->items;$totalPrice=$cart->totalPrice;
             $totalPrice=$cart->totalPrice;
         }
        return view('customer.contact',compact('products','totalPrice'));
    }
    public function about()
    {
        $products=null;
        $totalPrice=0;
        if(Session::has('cart')){
             $oldCart=Session::get('cart');
             $cart=new Cart($oldCart);
             $products=$cart->items;$totalPrice=$cart->totalPrice;
             $totalPrice=$cart->totalPrice;
         }
         $customers=User::where('uType',0)->count();
         $partners=User::where('uType',1)->count();
         $bookings=Booking::count();
         $products=Product::count();
        return view('customer.about',compact('products','totalPrice','customers','partners','bookings','products'));
    }
    public function search(Request $request)
    {
        $query=$request->q;
        $type=$request->type;
        
        $results=null;
        if($type==1)
        {
            $results=Product::where('name','like','%'.$query.'%')->orWhere('description','like','%'.$query.'%')->get();
        }
       else if($type==2)
       {
        $results=Business::where('category','like','%'.$query.'%')->orWhere('shop_cat','like','%'.$query.'%')->get();
       }
       else if($type==3)
       {
        $results=Business::where('title','like','%'.$query.'%')->orWhere('category','like','%'.$query.'%')->orWhere('shop_cat','like','%'.$query.'%')->get();
       }
       $results=$this->paginate($results);
       $products=$this->products;
       $totalPrice=$this->totalPrice;
        return view('customer.results',compact('results','query','type','products','totalPrice'));
    }
   
    public function location(Request $request)
    {
    
        $request->validate([
            'txtPlaces'=>'required'
        ]);
        $value=$request->txtPlaces;
        if(Auth::check())
        {
           $address=Address::where('user_id',Auth::user()->userId)->first();
            if($address==null)
            {
                $address= new Address;
                $address->user_id=Auth::user()->userId;
                $address->address=$request->txtPlaces;
                $address->created_at=now();
                $address->save();
            }
            else{
                $address->address=$value;
                $address->save();
            }
            
        }
       $set= Cookie::queue('name', $value);
    return redirect()->back();

    }
    public function categories($id,Request $request)
    {
        
        $addressFrom= Cookie::get('name');
        $products=null;
        $totalPrice=null;
        if(Session::has('cart')){
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
            $products=$cart->items;$totalPrice=$cart->totalPrice;
            $totalPrice=$cart->totalPrice;
        }
        
        $categories=Business::where('category','like','%'.$id.'%')->orWhere('shop_cat','like','%'.$id.'%')->get();
       $places=$request->places;
        if($places==null){
            $myshops=array();
            foreach ($categories as $category) {
                $distance= $this->getDistance($addressFrom, $category->address, $unit = 'K');
                if((int)$distance<40)
                {
                    array_push($myshops,$category);
                }
            }
            $categories=$myshops;
        }

          return view('customer.categories',compact('places','categories','id','products','totalPrice'));
    }
    public function services($id,Request $request)
    {
        $addressFrom= Cookie::get('name');
        $categories=Business::where('category','like','%'.$id.'%')->orWhere('shop_cat','like','%'.$id.'%')->get();
        if($request->location==null){
            $myshops=array();
            foreach ($categories as $category) {
                $distance= $this->getDistance($addressFrom, $category->address, $unit = 'K');
                if((int)$distance<40)
                {
                    array_push($myshops,$category);
                }
            }
            $categories=$myshops;
        }
        $products=null;
        $totalPrice=null;
        if(Session::has('cart')){
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
            $products=$cart->items;$totalPrice=$cart->totalPrice;
            $totalPrice=$cart->totalPrice;
        }
       $location=$request->location;
    
        return view('customer.services',compact('location','categories','id','products','totalPrice'));
    }
    public function shopproducts(Request $request,$id)
    {
        if(Cookie::get('name')===null)
        {
            return redirect()->back()->with('address','Please enter address');
        }
        $shop=Business::findOrFail($id);
        $addressFrom=Cookie::get('name');
        $products=null;
        $totalPrice=null;
        if(Session::has('cart')){
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
            $products=$cart->items;$totalPrice=$cart->totalPrice;
            $totalPrice=$cart->totalPrice;
        }
        if($request->product==null)
        {
        $shop_products=null;
            if($request->category!=null)
            {
                 $shop_products=Product::where('business_id',$id)->where('category_id',$request->category)->paginate(5);
            }
            else{
               $shop_products= Product::where('business_id',$id)->paginate(5);
            }
        }
        else{
            $shop_products=null;
            if($request->category!=null)
            {
                $shop_products=Product::where('business_id',$id)->where('name','like','%'.$request->product.'%')->orWhere('description','like','%'.$request->product.'%')->where('category_id',$request->category)->paginate(5);
            }
            else{
                $shop_products=Product::where('business_id',$id)->where('name','like','%'.$request->product.'%')->orWhere('description','like','%'.$request->product.'%')->paginate(5);
            }
        }
      
        $categories=Product::where('business_id',$id)->pluck('category_id');
      $shop_categories=Category::whereIn('id',$categories)->get();
      return view('customer.shop',compact('shop_categories','shop_products','shop','id','products','totalPrice'));
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
    
        return view('customer.service',compact('shop','others','products','totalPrice'));
    }
    public function addtocart(Request $request,$shop,$id)
    {
        $product=Product::findOrFail($id);
        $oldCart=Session::has('cart') ? Session::get('cart') : null;
       if($oldCart!=null)
       {
           if($oldCart->shop!=$shop)
           {
               return redirect()->back()->withErrors('A cart can only contain products from one shop. Checkout or remove products which are already in the cart to order from this shop.');
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
            return view('customer.cart');
        }
        $oldCart=Session::get('cart');
        $cart=new Cart($oldCart);

       return view('customer.cart',['products'=>$cart->items,'totalPrice'=>$cart->totalPrice]);
    }
    public function checkout()
    {
        if(!Session::has('cart')){
            return view('customer.cart');
        }
        $oldCart=Session::get('cart');
        $cart=new Cart($oldCart);
        $totalPrice=$cart->totalPrice;
        $products=$cart->items;
        $business=Business::findOrFail($cart->shop);
    
        return view('customer.checkout',compact('totalPrice','products','business'));
    }
    public function confirm(Request $request)
    {
        $data=array();
        foreach($request->all() as $item) 
        {
            array_push($data,$item);
        }
        $request->session()->put('data',$data);
        if(!Session::has('cart')){
            return view('customer.cart');
        }
        $oldCart=Session::get('cart');
        $cart=new Cart($oldCart);
        $totalPrice=$cart->totalPrice;
        $products=$cart->items;
        $business=Business::findOrFail($cart->shop);
        
        return view('customer.confirm',compact('totalPrice','products','business','data'));
    }
    public function placeorder(Request $request)
    {
       $data=Session::get('data');
        $order=new Order();
        $cart=Session::get('cart');
    
        $order->user_id=Auth::user()->userId;
        $order->business_id=$cart->shop;
        $order->payment_method=$data[7];
        $order->delivery_address=$data[3];
        $order->amount=$cart->totalPrice;
        $order->name=$data[1].' '.$data[2];
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
        
        $notication=new Notification();
        $notication->from=Auth::user()->userId;
        $business=Business::findOrFail($cart->shop);
        $user=User::findOrFail($business->user_id);
        $notication->to=$user->userId;
        $notication->title='ORDER PLACED';
        $notication->message=Auth::user()->fname.' '.Auth::user()->lname.' has placed an order '.$order->id.' for your shop.';
        $notication->type='ORDER';
        $notication->created_date=now();
        $notication->save();
        
        Session::forget('cart');

    Session::forget('data');
        return redirect()->route('dashboard')->with('success','Your order placed successfully. Delivery in 30-45 mins.');
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
        return view('customer.book',compact('products','totalPrice','service'));
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

        $notication=new Notification();
        $notication->from=Auth::user()->userId;
        $notication->to=$service->id;
        $notication->title='BOOKING PLACE';
        $notication->message=Auth::user()->fname.' '.Auth::user()->lname.' has made a book for '.$booking->category.' service in your shop.';
        $notication->type='BOOKING';
        $notication->created_date=now();
        $notication->save();

        return redirect()->route('dashboard')->with('success','Your booking has been placed successfully.');
    }
   
}
