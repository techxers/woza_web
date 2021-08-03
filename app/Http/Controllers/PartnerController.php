<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Booking;
use App\Models\Business;
use App\Models\Category;
use App\Models\Notification;
use App\Models\PaymentType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class PartnerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
       
        $user=Auth::user();
        $business=$user->business;
        $bookings=Booking::where('service_provider_id',$business->id)->where('status',3)->get();
        $sales=Order::where('business_id',$business->id)->where('status',6)->get();
        $s_customers=Order::where('business_id',$business->id)->where('status',6)->distinct('user_id')->count();
        $b_customers=Booking::where('service_provider_id',$business->id)->where('status',3)->distinct('booker_id')->count();
        $customers=$s_customers+$b_customers;
        $notifications=Notification::where('to',$business->id)->get();
        return view('partner.dashboard',compact('bookings','sales','customers','notifications'));
    }
    public function create()
    {
        $categories=Category::all();
        return view('partner.create',compact('categories'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string',
            'description'=>'required|string',
            'contact'=>'numeric|min:9|required',
            'email'=>'email|required',
            'address'=>'string|required',
            'pricing'=>'',
            'logo'=>'required|mimes:jpeg,jpg,png,gif,JPG'
        ]);

        $business= new Business();
        $business->title=$request->title;
        $business->description=$request->description;
        $business->contact=$request->contact;
        $business->email=$request->email;
        $business->address=$request->address;
        $business->longitude=$request->longitude;
        $business->latitude=$request->latitude;
        $business->category_id=$request->category;
        $business->shop_id=$request->category;
        $category= Category::findOrFail($request->category);

        
        $business->category=$category->title;
        $business->shop_cat=$category->title;

        $business->user_id=Auth::user()->userId;
        $business->owner_name=Auth::user()->fname.' '. Auth::user()->lname;
        $business->open_time=$request->open_time;
        $business->close_time=$request->close_time;
        $business->countrycode=$request->code;
        $business->created_date=now();
        $business->updated_date=now();
        $request->validate([
            'logo'=>'required|mimes:png,gif,jpeg'
        ]);
        $photo=$request->logo;
        $f_name=time().'.'.$photo->getClientOriginalExtension();
        $img = Image::make($photo)->resize(300,300);
        $img->save(public_path("images/profile/".$f_name));
        $business->logo=$f_name;
        $business->mpesa_enabled='-';
        $business->mpesa_reference='-';
        $business->mpesa_shortcode='-';
        $business->save();

        return redirect()->route('payments.create');
    }
    public function businessupdate(Request $request)
    {
        $request->validate([
            'title'=>'required|string',
            'description'=>'required|string',
            'contact'=>'numeric|min:9|required',
            'email'=>'email|required',
            'address'=>'string|required',
            'pricing'=>'',
           
        ]);

        $business=Auth::user()->business;
        $business= Business::findOrFail($business->id);
        $business->title=$request->title;
        $business->description=$request->description;
        $business->contact=$request->contact;
        $business->email=$request->email;
        $business->address=$request->address;
        $business->longitude=$request->longitude;
        $business->latitude=$request->latitude;
        $business->category_id=$request->category;
        $business->shop_id=$request->category;
        $category= Category::findOrFail($request->category);

        
        $business->category=$category->title;
        $business->shop_cat=$category->title;

        $business->user_id=Auth::user()->userId;
        $business->owner_name=Auth::user()->fname.' '. Auth::user()->lname;
        $business->open_time=$request->open_time;
        $business->close_time=$request->close_time;
        $business->countrycode=$request->code;
        $business->created_date=now();
        $business->updated_date=now();
        if($request->has('logo'))
        {
            $request->validate([
                'logo'=>'required|mimes:png,gif,jpeg'
            ]);
            $photo=$request->logo;
            $f_name=time().'.'.$photo->getClientOriginalExtension();
            $img = Image::make($photo)->resize(300,300);
            $img->save(public_path("images/profile/".$f_name));
            $business->logo=$f_name;
        }
        $business->mpesa_enabled='-';
        $business->mpesa_reference='-';
        $business->mpesa_shortcode='-';
        $business->save();

        return redirect()->back()->with('success','Business profile updated successfully');
    }
    public function profile()
    {
        $categories=Category::all();
        $business=Auth::user()->business;
        return view('partner.profile',compact('categories','business'));
    }
    public function update(Request $request)
    {
        $user= User::findOrFail(Auth::user()->userId);
        $request->validate([
            'fname'=>'string|required',
            'lname'=>'string|required',
            'mobile'=>'required|numeric|min:9',
            'email'=>'required|email'
        ]);
        $user->fname=$request->fname;
        $user->lname=$request->lname;
        $user->mobile=$request->mobile;
        $user->email=$request->email;
        $user->profile_image=$user->profile_image;
        if($request->has('photo')){
            $image=$request->photo;
            $img_name=time().'.'.$image->getClientOriginalExtension();
            $img=Image::make($image)->resize(300,300);
            $img->save(public_path('images/profile/'.$img_name));
            $user->profile_image=$img_name;
        }

        $user->save();

        return redirect()->back()->with('success','Profile updated successfully');
    }
    public function payments()
    {
        return view('partner.payments');
    }
    public function paymentsstore(Request $request)
    {
        if(!$request->has('cashmethod')&&!$request->has('mpesamethod'))
        {
            return redirect()->back()->with('error','Please select at least one payment method.');
        }
        $business=Auth::user()->business;
        $payment= new PaymentType();
        $payment->business_id=$business->id;
        if($request->has('cashmethod'))
        {
            $payment->cash=true;
        }
        if($request->has('mpesamethod'))
        {
            if($request->phone==null &&$request->paybill==null && $request->till==null )
            {
                return redirect()->back()->with('error','Please select your mpesa payment method.');
            }
            if(!$request->phone==null)
            {
                $request->validate([
                    'phone'=>'min:9|numeric'
                ]);
                $payment->mpesa_type='phone';
                $payment->phone=$request->phone;
            }
            if(!$request->paybill==null)
            {
                $request->validate([
                    'paybill'=>'numeric',
                    'account'=>'required'
                ]);
                $payment->mpesa_type='paybill';
                $payment->account_number=$request->account;
                $payment->paybill=$request->paybill;
            }
            if(!$request->till==null )
            {
                $request->validate([
                    'till'=>'numeric'
                ]);
                $payment->mpesa_type='till';
                $payment->till=$request->till;
            }  
            $payment->mpesa=true;
        }
       
       $payment->save();
       return redirect()->route('partner.dashboard')->with('success','Profile updated successfully');

    }
    public function paymentsupdate(Request $request)
    {
        if(!$request->has('cashmethod')&&!$request->has('mpesamethod'))
        {
            return redirect()->back()->with('error','Please select at least one payment method.');
        }
        $business=Auth::user()->business;
        $p_id= $business->paymenttype->id;
        $payment= PaymentType::findOrFail($p_id);
        $payment->business_id=$business->id;
        $payment->cash=false;
        $payment->mpesa=false;
        $payment->mpesa_type=null;
        $payment->phone=null;
        $payment->paybill=null;
        $payment->till=null;
        if($request->has('cashmethod'))
        {
            $payment->cash=true;
        }
        if($request->has('mpesamethod'))
        {
            if($request->phone==null &&$request->paybill==null && $request->till==null )
            {
                return redirect()->back()->with('error','Please select your mpesa payment method.');
            }
            if(!$request->phone==null)
            {
                $request->validate([
                    'phone'=>'min:9|numeric'
                ]);
                $payment->mpesa_type='phone';
                $payment->phone=$request->phone;
            }
            if(!$request->paybill==null)
            {
                $request->validate([
                    'paybill'=>'numeric',
                    'account'=>'required'
                ]);
                $payment->mpesa_type='paybill';
                $payment->account_number=$request->account;
                $payment->paybill=$request->paybill;
            }
            if(!$request->till==null )
            {
                $request->validate([
                    'till'=>'numeric'
                ]);
                $payment->mpesa_type='till';
                $payment->till=$request->till;
            }  
            $payment->mpesa=true;
        }
       
       $payment->save();
       return redirect()->back()->with('success','Payment profile updated successfully');

    }
}
