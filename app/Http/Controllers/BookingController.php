<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $business=Auth::user()->business;
        $status=$request->status;
        $bookings=null;
        if($status==null)
        {
            $bookings=Booking::where('service_provider_id',$business->id)->paginate(8);
        }
        else{
            $bookings=Booking::where('service_provider_id',$business->id)->where('status',$status)->paginate(8);
        }
       
        return view('bookings.index',compact('bookings','status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function accept($id)
    {
        $booking=Booking::findOrFail($id);
        $booking->status=1;
        $booking->save();

        $notication=new Notification();
        $notication->from=Auth::user()->userId;
        $notication->to=$booking->booker_id;
        $notication->title='BOOKING ACCEPTED';
        $notication->message=Auth::user()->business->title.' shop has accepted your booking '.$booking->id.'.';
        $notication->type='BOOKING';
        $notication->created_date=now();
        $notication->save();
        return redirect()->back()->with('success','Booking accepted successfully');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function completed(Request $request,$id)
    {
        $booking=Booking::findOrFail($id);
        $booking->status=3;
        $booking->save();

        return redirect()->back()->with('success','Booking completed successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking=Booking::findOrFail($id);
        return view('bookings.show',compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {
        $booking=Booking::findOrFail($id);
        $booking->status=2;
        $booking->save();

        $notication=new Notification();
        $notication->from=Auth::user()->userId;
        $notication->to=$booking->booker_id;
        $notication->title='BOOKING CANCELED';
        $notication->message=Auth::user()->business->title.' shop has canceled your booking '.$booking->id.'. Please contact the shop for more information.';
        $notication->type='BOOKING';
        $notication->created_date=now();
        $notication->save();
        return redirect()->back()->with('success','Booking canceled successfully');
    }
}
