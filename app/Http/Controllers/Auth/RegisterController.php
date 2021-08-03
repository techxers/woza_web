<?php

namespace App\Http\Controllers\Auth;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
  
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function signin()
    {
       $products=null;
       $totalPrice=null;
        if(Session::has('cart')){
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
            $products=$cart->items;$totalPrice=$cart->totalPrice;
            $totalPrice=$cart->totalPrice;
        }
        return view('auth.login',compact('products','totalPrice'));
    }
    public function signup()
    {
       $products=null;
       $totalPrice=null;
        if(Session::has('cart')){
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
            $products=$cart->items;$totalPrice=$cart->totalPrice;
            $totalPrice=$cart->totalPrice;
        }
        return view('auth.register',compact('products','totalPrice'));
    }
    public function partnersignup()
    {
       $products=null;
       $totalPrice=null;
        if(Session::has('cart')){
            $oldCart=Session::get('cart');
            $cart=new Cart($oldCart);
            $products=$cart->items;$totalPrice=$cart->totalPrice;
            $totalPrice=$cart->totalPrice;
        }
        return view('auth.partner',compact('products','totalPrice'));
    }
    public function login(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'mobile' => 'required|numeric',
            'password' => 'required',
        ]);
        if($validate->fails())
        {
            return redirect()->route('signin')->withErrors($validate)->with('code','login');
        }
        else{
            $credentials = $request->only('mobile', 'password');
            if (Auth::attempt($credentials)) {
                $user=User::where('mobile',$request->mobile)->first();
                
                if($user->uType==0||$user->uType=='-'||$user->uType==NULL)
                {
                    if(Session::has('cart')){
                        $oldCart=Session::get('cart');
                        $cart=new Cart($oldCart);
                        $products=$cart->items;$totalPrice=$cart->totalPrice;
                        $totalPrice=$cart->totalPrice;
                        return redirect()->route('products.cart',compact('products','totalPrice'));
                    }
                    return redirect()->route('home.index');
                }
                else if($user->uType==1)
                {
                    return redirect()->route('partner.dashboard');
                }
            }
        }
        return redirect()->route('signin')->withErrors('Oops! You have entered invalid credentials')->with('code','login');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function register(Request $request)
    {  

        if($request->user_type==0){
            $validate= Validator::make($request->all(),[
                'fname' => ['required', 'string', 'max:255'],
                'lname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:tbl_users'],
                'mobile'=>['required','numeric','unique:tbl_users'],
                'user_type'=>[''],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            if($validate->fails())
            {
                return redirect()->route('signup')->withErrors($validate)->with('code','register');
            }
               
            $data = $request->all();
            $check = $this->create($data);
            Auth::login($check);
            return redirect()->route('home.index');
        }
        else if($request->user_type==1)
        {
            $validate= Validator::make($request->all(),[
                'fname' => ['required', 'string', 'max:255'],
                'lname' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:tbl_users'],
                'mobile'=>['required','numeric','unique:tbl_users'],
                'user_type'=>[''],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'id'=>'required|numeric|min:8'
            ]);
            if($validate->fails())
            {
                return redirect()->route('signup')->withErrors($validate)->with('code','register_p');
            }
               
            $data = $request->all();
            $check = $this->create($data);
            Auth::login($check);
            return redirect()->route('partner.dashboard');
        }
    }
    public function create(array $data)
    {
        return User::create([
            'fname' => $data['fname'],
            'lname' => $data['lname'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'uType'=>$data['user_type'],
            'country_code'=>$data['country_code'],
            'roleId'=>4,
            'password' => Hash::make($data['password']),
        ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
       
        Auth::logout();
  
        return Redirect()->route('home.index');
    }
    
    // Facebook Login
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }
    // Callback from facebook and save details into the database
    public function callback()
    {
        $userdetails = Socialite::driver('facebook')->stateless()->user();

        $user=User::where('email',$userdetails->email)->first();
       if($user)
       {
        Auth::login($user);
       }
       else{
        
            return redirect()->route('signin')->withErrors('We could not find details associated with the Facebook account.')->with('code','login');
       }

       if($user->uType==0||$user->uType=='-'||$user->uType==NULL)
       {
           return redirect()->route('home.index');
       }
       else if($user->uType==1)
       {
           return redirect()->route('partner.dashboard');
       }
    }
    //Login with google
    public function googleredirect()
    {
        return Socialite::driver('google')->redirect();
    }
    public function googlecallback()
    {
        $userdetails = Socialite::driver('google')->stateless()->user();
       
        $user=User::where('email',$userdetails->email)->first();
       if($user)
       {
        Auth::login($user);
       }
       else{
            return redirect()->route('signin')->withErrors('We could not find details associated with the Google account.')->with('code','login');
       }
       
       if($user->uType==0||$user->uType=='-'||$user->uType==NULL)
       {
           return redirect()->route('home.index');
       }
       else if($user->uType==1)
       {
           return redirect()->route('partner.dashboard');
       }
    }
    public function forgotpassword()
    {
        return view('auth.passwords.email');
    }
    public function sendresetemail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => __($status),'password'=>'email'])
                    : back()->withErrors(['email' => __($status)]);
    }
    public function resetpassword($token,Request $request)
    {
        $email=$request->email;
        return view('auth.passwords.reset',compact('token','email'));
    }
    public function updatepassword(Request $request)
    {
        $validate=Validator::make($request->all(),[
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);
        if($validate->fails())
        {
            return redirect()->back()->withErrors($validate);
        }
        $token=$request->_token;
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
        
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('signin')->with(['status'=> __($status),'code'=>'login'])
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
