<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use App\Models\Booking;
use App\Models\Business;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function dashboard()
    {
        $user=Auth::user();
        $orders=Order::where('user_id',$user->userId)->paginate(5);
        $products=null;
        $totalPrice=null;
        if(Session::has('cart')){
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
            $products=$cart->items;$totalPrice=$cart->totalPrice;
            $totalPrice=$cart->totalPrice;
        }
        return view('dashboard.orders',compact('products','totalPrice','orders'));
    }
    public function mybookings()
    {
        $user=Auth::user();
        $bookings=Booking::where('booker_id',$user->userId)->paginate(5);
        $products=null;
        $totalPrice=null;
        if(Session::has('cart')){
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
            $products=$cart->items;$totalPrice=$cart->totalPrice;
            $totalPrice=$cart->totalPrice;
        }
        return view('dashboard.bookings',compact('products','totalPrice','bookings'));
    }
    public function myaddress()
    {
        $user=Auth::user();
        $products=null;
        $totalPrice=null;
        if(Session::has('cart')){
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
            $products=$cart->items;$totalPrice=$cart->totalPrice;
            $totalPrice=$cart->totalPrice;
        }
        $address=Address::where('user_id',$user->userId)->first();
        return view('dashboard.address',compact('products','totalPrice','address'));
    }
    public function myaccount()
    {
        $products=null;
        $totalPrice=null;
        if(Session::has('cart')){
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
            $products=$cart->items;$totalPrice=$cart->totalPrice;
            $totalPrice=$cart->totalPrice;
        }
        return view('dashboard.account',compact('products','totalPrice'));
    }
    public function changepassword()
    {
        $products=null;
        $totalPrice=null;
        if(Session::has('cart')){
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
            $products=$cart->items;$totalPrice=$cart->totalPrice;
            $totalPrice=$cart->totalPrice;
        }
        return view('dashboard.password',compact('products','totalPrice'));
    }
    public function cancel($id)
    {
        $order=Order::findOrFail($id);
        $order->status=2;
        $order->save();

        $notication=new Notification();
        $notication->from=Auth::user()->userId;
        $notication->to=$order->business_id;
        $notication->title='ORDER CANCELLED';
        $notication->message=Auth::user()->fname.' '.Auth::user()->lname.' has canceled order '.$order->id.' for your shop.';
        $notication->type='ORDER';
        $notication->created_date=now();
        $notication->save();

        return redirect()->route('dashboard')->with('success','Order canceled successfully');
    }
    public function cancelbooking($id)
    {
        $order=Booking::findOrFail($id);
        $order->status=2;
        $order->save();

        $notication=new Notification();
        $notication->from=Auth::user()->userId;
        $notication->to=$order->service_provider_id;
        $notication->title='BOOKING CANCELLED';
        $notication->message=Auth::user()->fname.' '.Auth::user()->lname.' has canceled booking '.$order->id.'(' .$order->category. ')  service your shop.';
        $notication->type='BOOKING';
        $notication->created_date=now();
        $notication->save();

        return redirect()->route('dashboard')->with('success','Booking canceled successfully');
    }
    public function reschedulebooking($id)
    {
        $booking=Booking::findOrFail($id);
        $products=null;
        $totalPrice=null;
        if(Session::has('cart')){
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
            $products=$cart->items;$totalPrice=$cart->totalPrice;
            $totalPrice=$cart->totalPrice;
        }
       $service=Business::findOrFail($id);
       
    
        return view('customer.reschedule',compact('booking','products','totalPrice','service'));
    } 
    public function rescheduled($id,Request $request)
    {
        $booking= Booking::findOrFail($id);
        $booking->service_date=$request->date;
        $booking->service_time=$request->time;
        $booking->description=$request->description;
        $booking->save();

        $notication=new Notification();
        $notication->from=Auth::user()->userId;
        $notication->to=$booking->service_provider_id;
        $notication->title='BOOKING RESCHEDULED';
        $notication->message=Auth::user()->fname.' '.Auth::user()->lname.' has rescheduled booking '.$booking->id.' (' .$booking->category. ') service in your shop.';
        $notication->type='BOOKING';
        $notication->created_date=now();
        $notication->save();
        return redirect()->route('dashboard')->with('success','Booking rescheduled successfully');
    }
    public function profile(Request $request)
    {
       $request->validate([
            'fname'=>'string|required',
            'lname'=>'string|required',
            'phone'=>'string|required|min:10',
            'email'=>'email|required',
       ]);
        $profile=User::findOrFail(Auth::user()->userId);
        $profile->fname=$request->fname;
        $profile->lname=$request->lname;
        $profile->mobile=$request->phone;
        $profile->email=$request->email;
        $profile->profile_image=$profile->profile_image;
        if($request->has('photo'))
        {
            $request->validate([
                'photo'=>'required|mimes:png,gif,jpeg'
            ]);
            $photo=$request->photo;
            $f_name=time().'.'.$photo->getClientOriginalExtension();
            $img = Image::make($photo)->resize(300,300);
            $img->save(public_path("images/profile/".$f_name));
            
           
            $profile->profile_image=$f_name;
        }
        $profile->save();

        return redirect()->back()->with('success','Profile updated successfully');
    }
    public function password(Request $request)
    {
        $request->validate([
            'old'=>'required',
            'password'=>'required|min:8|confirmed'
        ]);
        $user=User::findOrFail(Auth::user()->userId);
        if (!Hash::check($request->old, $user->password)) {
            return redirect()->back()->with('error','Old password is incorrect');
        }
        else{
            $user->password=Hash::make($request->password);
            $user->save();
            return redirect()->back()->with('success','Password changed successfully');
        }
    }
}
