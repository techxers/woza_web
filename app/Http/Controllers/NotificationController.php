<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function __construct()
    {
       $this->middleware('auth');
    }
    public function index()
    {
        $business=Auth::user()->business;
       $notifications= Notification::where('to',$business->id)->get();
        return view('notifications.index',compact('notifications'));
    }
    public function customerindex()
    {
        $user=Auth::user();
        $notifications= Notification::where('to',$user->userId)->paginate(10);
        return view('notifications.customer.index',compact('notifications'));
    }
    public function show($id)
    {
        $notification=Notification::findOrFail($id);
        $notification->status=1;
        $notification->save();

        return view('notifications.show',compact('notification'));
    }
    public function delete($id)
    {
        $notification=Notification::findOrFail($id);
        $notification->delete();
       return redirect()->route('notifications.index')->with('success','Notification deleted successfully');
    }
    public function customerdelete($id)
    {
        $notification=Notification::findOrFail($id);
        $notification->delete();
       return redirect()->route('customer.notifications.index')->with('success','Notification deleted successfully');
    }
}
