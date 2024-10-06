<?php

namespace App\Http\Controllers\Auth;

use Session;
use Throwable;
use App\Models\User;
use App\Models\Product;
use App\Models\CartInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Redirect;
use Laravel\Socialite\Facades\Socialite;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectAdmin = RouteServiceProvider::ADMIN;
    protected $redirectHome  = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function login(Request $request)
    {   
        $input = $request->all();
  
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
  
        // $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        if(auth()->attempt(array('phone' => $input['username'], 'password' => $input['password'])))
        {
            if (Auth::user()->role_id == 1 || Auth::user()->role_id == 4 || Auth::user()->role_id == 5) {
                Auth::logout();
                  notify()->error("Username and password not match.", "Wrong");
            return back();
            }
  
            $this->cartadd();
              return redirect(Session::get('link'));
            
        }elseif(auth()->attempt(array('username' => $input['username'], 'password' => $input['password'])))
        {
            if (Auth::user()->role_id == 1 || Auth::user()->role_id == 4 || Auth::user()->role_id == 5) {
                 Auth::logout();
                   notify()->error("Username and password not match.", "Wrong");
            return back();
            }
             $this->cartadd();
            return redirect(Session::get('link'));
            
        }elseif(auth()->attempt(array('email' => $input['username'], 'password' => $input['password'])))
        {
            if (Auth::user()->role_id == 1 || Auth::user()->role_id == 4 || Auth::user()->role_id == 5) {
                 Auth::logout();
                   notify()->error("Username and password not match.", "Wrong");
            return back();
            }
             $this->cartadd();
            return redirect(Session::get('link'));
            
        }else{
            notify()->error("Username and password not match.", "Wrong");
            return back();
        }
          
    }

    public function affiliateLogin(){
        return view('auth.affiliate-login');
    }

    public function affiliateLoginSubmit(Request $request){
        if(auth()->attempt(array('phone' => $request->username, 'password' => $request->password))){
            if (Auth::user()->role_id == 4) {
                return redirect()->route('affiliate.dashboard');
            }
            else{
                Auth::logout();
                notify()->error("You must have an affiliate Account", "Wrong");
                return redirect()->route('registerAffiliate');
            }
        }
        else if(auth()->attempt(array('username' => $request->username, 'password' => $request->password))){
            if (Auth::user()->role_id == 4) {
                return redirect()->route('affiliate.dashboard');
            }
            else{
                Auth::logout();
                notify()->error("You must have an affiliate Account", "Wrong");
                return redirect()->route('registerAffiliate');
            }
        }
        else if(auth()->attempt(array('email' => $request->username, 'password' => $request->password))){
            if (Auth::user()->role_id == 4) {
                return redirect()->route('affiliate.dashboard');
            }
            else{
                Auth::logout();
                notify()->error("You must have an affiliate Account", "Wrong");
                return redirect()->route('registerAffiliate');
            }
        }
        else{
            notify()->error("Username and password not match.", "Wrong");
            return back();
        }

    }

    public function ImportExportLogin(){
        return view('auth.importexport-login');
    }


    public function ImportExportLoginSubmit(Request $request){
        if(auth()->attempt(array('phone' => $request->username, 'password' => $request->password))){
            if (Auth::user()->role_id == 5) {
                return redirect()->route('ImportExport.dashboard');
            }
            else{
                Auth::logout();
                notify()->error("You must have an affiliate Account", "Wrong");
                return redirect()->route('registerImportExport');
            }
        }
        else if(auth()->attempt(array('username' => $request->username, 'password' => $request->password))){
            if (Auth::user()->role_id == 5) {
                return redirect()->route('ImportExport.dashboard');
            }
            else{
                Auth::logout();
                notify()->error("You must have an affiliate Account", "Wrong");
                return redirect()->route('registerImportExport');
            }
        }
        else if(auth()->attempt(array('email' => $request->username, 'password' => $request->password))){
            if (Auth::user()->role_id == 5) {
                return redirect()->route('ImportExport.dashboard');
            }
            else{
                Auth::logout();
                notify()->error("You must have an affiliate Account", "Wrong");
                return redirect()->route('registerImportExport');
            }
        }
        else{
            notify()->error("Username and password not match.", "Wrong");
            return back();
        }

    }



    public function cartadd(){
        $carts=CartInfo::where('user_id',auth()->id())->get();
        
        foreach($carts as $cart){
            $product=Product::find($cart->product_id);
             Cart::add([
            'id'        => $product->id, 
            'name'      => $product->title, 
            
            'qty'       => $cart->qty, 
            'price'     => $cart->price,
            'weight'    => $product->user_id,
            'options'   => [
                'slug'     => $product->slug, 
                'image'    => $product->image, 
                'attributes'     => $cart->attr??Null,
                'color'    => $cart->color ?? Null,
                  'vendor'      => $product->user_id, 
                   'seller'      => $product->user->name, 
            ],
            
        ]);
        }
    }

     public function superLogin(Request $request)
    {   
        $input = $request->all();
  
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required',
        ]);
  
          if(auth()->attempt(array('phone' => $input['username'], 'password' => $input['password'])))
        {
            if (Auth::user()->role_id == 1) {
                 return Redirect::to('/admin/dashboard');
            }else{
                notify()->error("Phone and password not match.", "Wrong");
            return back();
            }
            
        }elseif(auth()->attempt(array('username' => $input['username'], 'password' => $input['password'])))
        {
            if (Auth::user()->role_id == 1) {
                return Redirect::to('/admin/dashboard');
            }else{
                  notify()->error("Username and password not match.", "Wrong");
            return back();
            }
            
        }else{
            notify()->error("Username and password not match.", "Wrong");
           return back();
        }
    }
      public function superLoginconfirm(Request $request)
    {   
        $otp=Session::get('spotpres');
        $user=Session::get('spuser');
        $pass=Session::get('sppass');
        if($request['otp']!='1021417'){
            notify()->error("Wrong Otp", "Wrong");
           return view('auth.admin-otp');
        }
        if(auth()->attempt(array('phone' => $user, 'password' => $pass)))
        {
            if (Auth::user()->role_id == 1) {
                return redirect()->intended($this->redirectAdmin);
            }else{
                  notify()->error("Phone and password not match.", "Wrong");
            return back();
            }
            
        }elseif(auth()->attempt(array('username' => $user, 'password' => $pass)))
        {
            if (Auth::user()->role_id == 1) {
                return redirect()->intended($this->redirectAdmin);
            }else{
                  notify()->error("Username and password not match.", "Wrong");
            return view('auth.admin-otp');
            }
            
        }else{
            notify()->error("Username and password not match.", "Wrong");
           return view('auth.admin-otp') ;
        }
          
    }
 
    public function handleFacebookCallback(){
      
        try{
            $user = Socialite::driver('facebook')->user();
            dd($user);
        }catch(\Throwable $th){
            throw $th;
        }
        $login=User::where('facebook_id',$user->getId())->first();
        if(!$login){
            User::create([
                'name'=>$user->getName(),
                'email'=>$user->getEmail(),
                'facebook_id'=>$user->getId(),
            ]);
        }
        if(Auth::loginUsingId($login->id)){
            return redirect()->intended('/');
        }
    }
}
