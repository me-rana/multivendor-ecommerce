<?php

namespace App\Http\Controllers\ImportExport;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ImportexportAccount;
use App\Http\Controllers\Controller;
use App\Models\ImporterexporterItem;
use Illuminate\Support\Facades\Auth;

class ImportExportController extends Controller
{
    //
    public function dashboard(){
        $user = Auth::user();
        if($user->role_id != 5){
            return redirect()->route('home');
        }
        $importexportUser = User::where('id',$user->id)->first();
        $importer_exporter = ImportexportAccount::where('user_id',$user->id)->first();
        $importItems_count = ImporterexporterItem::count();
        $importItems_approved_count = ImporterexporterItem::where('status',1)->count();

        return view('importer-exporter.dashboard',compact('importexportUser','importer_exporter','importItems_count','importItems_approved_count'));
    }

    public function importexportList(){
        $user = Auth::user();
        if($user->role_id != 5){
            return redirect()->route('home');
        }
        $importexportUser = User::where('id',$user->id)->first();
        $importer_exporter = ImportexportAccount::where('user_id',$user->id)->first();
        $importExportItems = ImporterexporterItem::where('user_id',$user->id)->paginate(50); 
        $importItems_count = ImporterexporterItem::count();
        $importItems_approved_count = ImporterexporterItem::where('status',1)->count();

        return view('importer-exporter.list',compact('importexportUser','importer_exporter','importExportItems','importItems_count','importItems_approved_count'));
    }

    public function importexportCreate(){
        return view('importer-exporter.create');
    }

    public function importexportStore(Request $request){
        $request->validate([
            'item_name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'url' => 'required|url',
            'import_export' => 'required|string|in:import,export',
        ]);

        $request_image = $request->file('image');
        if (!is_null($request_image)){
            $name_gen = hexdec(uniqid()) . '.' . $request_image->getClientOriginalExtension();
            $request_image->move(public_path('uploads/importer-exporter/items'), $name_gen);
            $image = $name_gen;
         }

        ImporterexporterItem::create([
            'user_id' => Auth::user()->id,
            'item_name' => $request->item_name,
            'image' => $image,
            'url' => $request->url,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'import_export' => $request->import_export,
        ]);
        notify()->success("Item Request Added Successfully", "Successfully");
        return redirect()->route('ImportExport.list');
    }
    

    public function showUpdateProfileForm(){
        if(Auth::user()->role_id != 5){
            return redirect()->route('home');
        }
        $user = User::where('id',Auth::user()->id)->first();
        $importExporter = ImportexportAccount::where('user_id',$user->id)->first();
        return view('affiliate.profile.update',compact('user','importExporter'));
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

        $import_export = ImportexportAccount::where('user_id',$user->id)->first();
        $request_trade_license_file = $request->file('trade_license_file');
        if (!is_null($request_trade_license_file)){
            $name_gen = hexdec(uniqid()) . '.' . $request_trade_license_file->getClientOriginalExtension();
            $request_trade_license_file->move(public_path('uploads/importer-exporter'), $name_gen);
            $import_export->update([
                    'trade_license_file' => $name_gen
                ]);
           
         }

         $request_national_id = $request->file('national_id');
        if (!is_null($request_national_id)){
            $name_genx = hexdec(uniqid()) . '.' . $request_national_id->getClientOriginalExtension();
            $request_national_id->move(public_path('uploads/importer-exporter'), $name_genx);
            $import_export->update([
                'national_id' => $name_genx
            ]);
            
         }
        $import_export->update([
            'importer_exporter' => $request->importer_exporter,
            'import_permit' =>  $request->import_permit,
            'permit_type' =>  $request->permit_type,
            'trade_license' =>  $request->trade_license,
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
        return view('importer-exporter.profile.password-change');
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

    

}
