<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\AffiliateAccount;
use App\Models\AffiliateWithdraw;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AffiliateController extends Controller
{
    //

    public function index()
    {
        $affiliates = User::where('role_id', 4)->latest('id')->paginate(10);
        return view('admin.e-commerce.affiliate.index', compact('affiliates'));
    }

    public function create()
    {
        return view('admin.e-commerce.affiliate.form');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'         => 'required|string|max:50',
            'email'        => 'required|string|max:255',
            'phone'        => 'required|string|max:30',
            'bank_account' => 'nullable|string|max:255',
            'bank_name'    => 'nullable|string|max:255',
            'holder_name'  => 'nullable|string|max:255',
            'branch_name'  => 'nullable|string|max:255',
            'routing'      => 'nullable|string|max:255',
            'commission'   => 'nullable|numeric',
            'password'     => 'required|string|min:8|confirmed',
            'avatar'      => 'required|image|max:1024|mimes:jpg,jpeg,bmp,png,webp',
        ]);

        $request_image = $request->file('avatar');
        if (!is_null($request_image)){
            $name_gen = hexdec(uniqid()) . '.' . $request_image->getClientOriginalExtension();
            $request_image->move(public_path('uploads/member'), $name_gen);
            $image = $name_gen;
         }



        $user = User::create([
            'name'          => $request->name,
            'username'      => 'dummy',
            'email'         => $request->email,
            'phone'         => $request->phone,
            'password'      => Hash::make($request->password),
            'is_approved'   => true,
            'joining_date'  => date('Y-m-d'),
            'joining_month' => date('F'),
            'joining_year'  => date('Y'),
            'avatar'        => $image ?? '',
            'role_id'       => 4

        ]);

        $username = str_replace(' ', '-', strtolower($request->name));
        $user->update([
            'username'      => $username.'-'.$user->id,
        ]);
        $affiliate_key = date('Y').str_pad($user->id, 5, '0', STR_PAD_LEFT);

        $affiliate_account = AffiliateAccount::create([
            'bank_account' => $request->bank_account ?? null,
            'bank_name'    => $request->bank_name ?? null,
            'holder_name'  => $request->holder_name ?? null,
            'branch_name'  => $request->branch_name ?? null,
            'routing'      => $request->routing ?? null,
            'commision'   => $request->commision ?? 2,
            'paypal_account' => $request->paypal,
            'affiliate_key' =>  $affiliate_key,

        ]);
        
        notify()->success("Affiiate Account successfully added", "Added");
        return redirect()->back();
        
    }

    public function show($id)
    {
        $affiliate = User::where('id', $id)->where('role_id', 4)->firstOrFail();
        return view('admin.e-commerce.affiliate.show', compact('affiliate'));
    }


    public function change_passIndex($id){
        $affiliate = User::where('id', $id)->where('role_id', 4)->firstOrFail();
        return view('admin.e-commerce.affiliate.change_passIndex', compact('affiliate'));
    }
    public function change_pass(Request $request, $id)
    {
        $affiliate = User::where('id', $id)->where('role_id', 4)->firstOrFail();
        $this->validate($request, [
            'password'     => 'required|string|min:8|confirmed',
        ]);

        

        $affiliate->update([
            'password'      => Hash::make($request->password)
        ]);


        notify()->success("Password successfully updated", "Update");
        return redirect()->back();
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $affiliate = User::where('id', $id)->where('role_id', 4)->firstOrFail();
        return view('admin.e-commerce.affiliate.form', compact('affiliate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'         => 'required|string|max:50',
            'email'        => 'required|string|max:255',
            'phone'        => 'required|string|max:30',
            'bank_account' => 'nullable|string|max:255',
            'bank_name'    => 'nullable|string|max:255',
            'holder_name'  => 'nullable|string|max:255',
            'branch_name'  => 'nullable|string|max:255',
            'routing'      => 'nullable|string|max:255',
            'commission'   => 'nullable|numeric',
        ]);

        $request_image = $request->file('avatar');
        if (!is_null($request_image)){
            $name_gen = hexdec(uniqid()) . '.' . $request_image->getClientOriginalExtension();
            $request_image->move(public_path('uploads/member'), $name_gen);
            $image = $name_gen;
         }

        $user = User::where('id',$id)->where('role_id', 4)->first();

        $user->update([
            'name'          => $request->name,
            'email'         => $request->email,
            'phone'         => $request->phone,
            'avatar'        => $image ?? ''
        ]);

        $affiliate_account = AffiliateAccount::where('user_id',$user->id)->first();

        $affiliate_account->update([
            'bank_account' => $request->bank_account ?? null,
            'bank_name'    => $request->bank_name ?? null,
            'holder_name'  => $request->holder_name ?? null,
            'branch_name'  => $request->branch_name ?? null,
            'routing'      => $request->routing ?? null,
            'commision'   => $request->commision ?? 2,
            'paypal_account' => $request->paypal,
        ]);
        
        notify()->success("Affiliate Account successfully updated", "Updated");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $affiliate = User::where('id', $id)->where('role_id', 4)->firstOrFail();
        AffiliateAccount::where('user_id',$id)->delete();
        $affiliate->delete();
        notify()->success("Affiliate Account successfully deleted", "Delete");
        return back();
    }

    public function allwithlist(){
        $withdraws=AffiliateWithdraw::get();
        return view('admin.e-commerce.affiliate.withdraw',compact('withdraws'));
   }
    public function aprove($id){
        $withdraws=AffiliateWithdraw::find($id);
        $withdraws->status='1';
        $withdraws->update();
       notify()->success("AffiliateWithdraw Success", "Success");
     return back();
   
   }
    public function cancel($id){
        $withdraws=AffiliateWithdraw::find($id);
        $withdraws->status='2';
        $withdraws->update();
        if($withdraws->number){
            $user=User::find($withdraws->user_id);
            $user->wallate +=$withdraws->amount;
            $user->save();
        }
       notify()->success("AffiliateWithdraw Cencel", "Success");
     return back();
   
   }
   public function delete($id){
        $withdraws=AffiliateWithdraw::find($id)->delete();
       notify()->error("AffiliateWithdraw Deleted", "Warning");
     return back();
   
   }
}
