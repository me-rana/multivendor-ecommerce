<?php

namespace App\Http\Controllers\Affiliate;

use App\Models\User;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Models\AffiliateAccount;
use App\Models\AffiliateWithdraw;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AffiliateController extends Controller
{
    //

    public function dashboard(){
        $user = Auth::user();
        if($user->role_id != 4){
            return redirect()->route('home');
        }
        $affiliate = AffiliateAccount::where('user_id',$user->id)->first();
        $affiliate_list = Order::where('affiliate_key', $affiliate->affiliate_key)->select('subtotal','invoice','first_name','status')->latest()->take(10)->get();

        $pending_amount = (Order::where('affiliate_key', $affiliate->affiliate_key)->where('status','!=',3)->sum('subtotal') * $affiliate->commision) / 100;
        $total_amount = (Order::where('affiliate_key', $affiliate->affiliate_key)->sum('subtotal') * $affiliate->commision) / 100;
        $available_amount = $total_amount - $pending_amount;
        $total_affiliate = Order::where('affiliate_key', $affiliate->affiliate_key)->count();
        $affiliate->update([
            'total_balance' => $total_amount,
            'pending_amount' => $pending_amount,
            'withdrawable_balance' =>  $available_amount
        ]);
        $percentage = $affiliate->commision;
        return view('affiliate.dashboard',compact('pending_amount','total_amount','available_amount','total_affiliate', 'affiliate_list', 'percentage','affiliate'));
    }

    public function affiliateList(){
        $user = Auth::user();
        if($user->role_id != 4){
            return redirect()->route('home');
        }
        $affiliate = AffiliateAccount::where('user_id',$user->id)->first();
        $affiliate_list = Order::where('affiliate_key', $affiliate->affiliate_key)->select('subtotal','invoice','first_name','status')->latest()->paginate(50);

        $pending_amount = (Order::where('affiliate_key', $affiliate->affiliate_key)->where('status','!=',3)->sum('subtotal') * $affiliate->commision) / 100;
        $total_amount = (Order::where('affiliate_key', $affiliate->affiliate_key)->sum('subtotal') * $affiliate->commision) / 100;
        $available_amount = $total_amount - $pending_amount;
        $total_affiliate = Order::where('affiliate_key', $affiliate->affiliate_key)->count();
        $percentage = $affiliate->commision;
        return view('affiliate.list',compact('pending_amount','total_amount','available_amount','total_affiliate', 'affiliate_list', 'percentage'));
    }

    public function affiliatePending(){
        $user = Auth::user();
        if($user->role_id != 4){
            return redirect()->route('home');
        }
        $affiliate = AffiliateAccount::where('user_id',$user->id)->first();
        $affiliate_list = Order::where('affiliate_key', $affiliate->affiliate_key)->where('status','!=',3)->select('subtotal','invoice','first_name','status')->latest()->paginate(50);

        $pending_amount = (Order::where('affiliate_key', $affiliate->affiliate_key)->where('status','!=',3)->sum('subtotal') * $affiliate->commision) / 100;
        $total_amount = (Order::where('affiliate_key', $affiliate->affiliate_key)->sum('subtotal') * $affiliate->commision) / 100;
        $available_amount = $total_amount - $pending_amount;
        $total_affiliate = Order::where('affiliate_key', $affiliate->affiliate_key)->count();
        $percentage = $affiliate->commision;
        return view('affiliate.list',compact('pending_amount','total_amount','available_amount','total_affiliate', 'affiliate_list', 'percentage'));
    }

    public function affiliateApproved(){
        $user = Auth::user();
        if($user->role_id != 4){
            return redirect()->route('home');
        }
        $affiliate = AffiliateAccount::where('user_id',$user->id)->first();
        $affiliate_list = Order::where('affiliate_key', $affiliate->affiliate_key)->where('status',3)->select('subtotal','invoice','first_name','status')->latest()->paginate(50);

        $pending_amount = (Order::where('affiliate_key', $affiliate->affiliate_key)->where('status','!=',3)->sum('subtotal') * $affiliate->commision) / 100;
        $total_amount = (Order::where('affiliate_key', $affiliate->affiliate_key)->sum('subtotal') * $affiliate->commision) / 100;
        $available_amount = $total_amount - $pending_amount;
        $total_affiliate = Order::where('affiliate_key', $affiliate->affiliate_key)->count();
        $percentage = $affiliate->commision;
        return view('affiliate.list',compact('pending_amount','total_amount','available_amount','total_affiliate', 'affiliate_list', 'percentage'));
    }

    public function showUpdateProfileForm(){
        if(Auth::user()->role_id != 4){
            return redirect()->route('home');
        }
        $user = User::where('id',Auth::user()->id)->first();
        $affiliate = AffiliateAccount::where('user_id',Auth::user()->id)->first();
        return view('affiliate.profile.update',compact('user','affiliate'));
    }

    public function updateInfo(Request $request){
        $user = User::where('id',Auth::user()->id)->first();
        $request_image = $request->file('avatar');
        if (!is_null($request_image)){
            $name_gen = hexdec(uniqid()) . '.' . $request_image->getClientOriginalExtension();
            $request_image->move(public_path('uploads/member'), $name_gen);
            $image = $name_gen;
         }
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'avatar' =>  $image ?? ''
        ]);
        $affiliate = AffiliateAccount::where('user_id',Auth::user()->id)->first();
        $affiliate->update([
            'bank_name' => $request->bank_name,
            'bank_account' => $request->bank_account,
            'holder_name' => $request->holder_name,
            'branch_name' => $request->branch_name,
            'routing' => $request->routing,
            'paypal_account' => $request->paypal_account,
        ]);

        notify()->success("Account Info Update Successfully", "Successfully");
        return back();

    }

    public function showChangePasswordForm(){
        return view('affiliate.profile.password-change');
    }


    public function updatePassword(Request $request) 
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        // Get logged in user.
        $user = Auth::user();

        if (Hash::check($request->current_password, $user->password)) {
            
            if (!Hash::check($request->password, $user->password)) {
                
                $authUser = User::find($user->id);
                $authUser->update([
                    'password' => Hash::make($request->password),
                ]);
                
              
                notify()->success("Success", "Password Change Successfully");
                
                return back();
                
            } else {
                notify()->warning("New password can't be same as current password! ⚡️", "Sorry!");
            }

        } else {
            notify()->error("Password does not match!!", "Not Match");
        }

        return back();
        
    }

    public function affiliateWithdraw(){
        return view('affiliate.withdraw');
    }

    public function affiliateWithdrawSubmit(Request $request){
        $min_withdrawal = Setting::where('name','min_with')->first()->value;
        $user = User::where('id',Auth::user()->id)->first();
        $affiliate = AffiliateAccount::where('user_id',Auth::user()->id)->first();

        if($request->method==1){
            $method='Paypal';
        }else{
              $method= 'Bank Account';
        }
        if($affiliate->withdrawable_balance< $request->amount){
            notify()->error("You haven't Enough Blance", "Wrong");
            return back();
        }elseif($min_withdrawal > $request->amount){
            notify()->error("Less than min Withdraw Amount", "Wrong");
            return back();
        
        }elseif($method==''){
            notify()->error("Please First Setup Your Payment Details", "Wrong");
            return back();
        }else{
            $affiliate->update([
                'withdrawable_balance' => ($affiliate->withdrawable_balance - $request->amount),
            ]);
            AffiliateWithdraw::create([
                'user_id'=>auth()->id(),
                'amount'=>$request->amount,
                'payment_method'=>$method,
                'status' => 0
            ]);
        }
          notify()->success("Withdraw Success Please Wait For Admin Review", "Success");
     return back();
    }

    public function affiliateWithdrawList(){
        $user = User::where('id',Auth::user()->id)->first();
        $affiliate = AffiliateAccount::where('user_id',Auth::user()->id)->first();
        $withdraws = AffiliateWithdraw::where('user_id',Auth::user()->id)->get();
        return view('affiliate.withdraw-list',compact('withdraws'));
    }

    
}
