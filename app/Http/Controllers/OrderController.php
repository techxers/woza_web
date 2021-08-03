<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Business;
use Illuminate\Support\Arr;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
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
    public function index(Request $request)
    {
        $business=Auth::user()->business;
        $status=$request->status;
        $orders=null;
        if($request->status==null)
        {
            $orders=Order::where('business_id',$business->id)->paginate(8);
        }
        else{
            $orders=Order::where('business_id',$business->id)->where('status',$status)->paginate(8);
        }
       
        return view('orders.index',compact('orders','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function accept($id)
    {
        $order=Order::findOrFail($id);
        $order->status=1;
        $order->save();

        $notication=new Notification();
        $notication->from=Auth::user()->userId;
        $notication->to=$order->user_id;
        $notication->title='ORDER ACCEPTED';
        $notication->message=Auth::user()->business->title.' shop has accepted your order '.$order->id.'.';
        $notication->type='ORDER';
        $notication->created_date=now();
        $notication->save();
        
        return redirect()->back()->with('success','Order accepted successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cancel(Request $request,$id)
    {
        $order=Order::findOrFail($id);
        $order->status=3;
        $order->save();

        $notication=new Notification();
        $notication->from=Auth::user()->userId;
        $notication->to=$order->user_id;
        $notication->title='ORDER CANCELED';
        $notication->message=Auth::user()->business->title.' shop has canceled your order '.$order->id.'. For more information on reasons for cancelation please contact the shop via: '.Auth::user()->business->contact.' or email them at: '.Auth::user()->business->email;
        $notication->type='ORDER';
        $notication->created_date=now();
        $notication->save();

        return redirect()->back()->with('success','Order canceled successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order=Order::findOrFail($id);
        
        return view('orders.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function process($id)
    {
        $order=Order::findOrFail($id);
        $order->status=3;
        $order->save();

        return redirect()->back()->with('success','Order marked as processing successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function boda($id)
    {
        $order=$id;
        $bodas=User::where('uType',2)->get();
        $addressFrom= Auth::user()->business->address;
        $home=new HomeController;
        $mybodas=array();
        foreach ($bodas as $boda) {
            $distance= $home->getDistance($addressFrom, $boda->address, $unit = 'M');
            if((int)$distance<10000)
            {
               $boda->setAttribute('distance',$distance);
                array_push($mybodas,$boda);    
            }
        }
        return view('orders.bodas',compact('mybodas','order'));
    }
     public function deliver(Request $request)
    {
       $order=$request->order;
       $boda=$request->boda;
        $order=Order::findOrFail($order);
        $order->status=5;
        $order->bodaid=$boda;
        $order->save();

        $notication=new Notification();
        $notication->from=Auth::user()->userId;
        $notication->to=$order->user_id;
        $notication->title='ORDER ON DELIVERY';
        $notication->message=Auth::user()->business->title.' shop is delivering your order '.$order->id.'. To track the delivery call: '.$order->boda->mobile.' or call the shop: '.Auth::user()->business->contact;
        $notication->type='ORDER';
        $notication->created_date=now();
        $notication->save();

        $notication=new Notification();
        $notication->from=Auth::user()->userId;
        $notication->to=$boda;
        $notication->title='BODA ORDERED';
        $notication->message=Auth::user()->business->title.' shop has ordered for delivery services by your boda. Please confirm the booking on the app or call the shop: '.Auth::user()->business->contact;
        $notication->type='BODA';
        $notication->created_date=now();
        $notication->save();

        return redirect()->route('orders.index')->with('success','Boda booked for order delivery');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function paid($id)
    {
        $order=Order::findOrFail($id);
        $order->status=6;
        $order->save();

        return redirect()->back()->with('success','Order marked as paid and completed successfully');
    }
}
