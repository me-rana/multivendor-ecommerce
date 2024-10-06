<?php

namespace App\Http\Controllers\Admin\Ecommerce;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ImportexportAccount;
use App\Http\Controllers\Controller;
use App\Models\ImporterexporterItem;
use Illuminate\Support\Facades\Hash;

class ImportExportController extends Controller
{
    //
    public function index()
    {
        $importExporters = User::where('role_id', 5)->latest('id')->paginate(10);
        return view('admin.e-commerce.importExporter.index', compact('importExporters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.e-commerce.importExporter.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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
            'password'     => 'required|string|min:8|confirmed',
            'avatar'      => 'required|image|max:1024|mimes:jpg,jpeg,bmp,png,webp',
            'trade'  => 'nullable|image|max:1024|mimes:jpg,jpeg,bmp,png,webp',
            'nid'  => 'required|image|max:1024|mimes:jpg,jpeg,bmp,png,webp'
        ]);

        $profile = $request->file('avatar');

        $trade   = $request->file('trade');
        $nid   = $request->file('nid');
        if ($profile) {
            $currentDate = Carbon::now()->toDateString();
            $profileName = $currentDate.'-'.uniqid().'.'.$profile->getClientOriginalExtension();
            
            if (!file_exists('uploads/member')) {
                mkdir('uploads/member', 0777, true);
            }
            $profile->move(public_path('uploads/member'), $profileName);
        }

        if ($trade) {
            $currentDate = Carbon::now()->toDateString();
            $tradeName   = $currentDate.'-'.uniqid().'.'.$trade->getClientOriginalExtension();
            
            if (!file_exists('uploads/importer-exporter')) {
                mkdir('uploads/importer-exporter', 0777, true);
            }
            $trade->move(public_path('uploads/importer-exporter'), $tradeName);
        }
        if ($nid) {
            $currentDate = Carbon::now()->toDateString();
            $nidName   = $currentDate.'-'.uniqid().'.'.$nid->getClientOriginalExtension();
            
            if (!file_exists('uploads/importer-exporter')) {
                mkdir('uploads/importer-exporter', 0777, true);
            }
            $nid->move(public_path('uploads/importer-exporter'), $nidName);
        }

        $user = User::create([
            'role_id'       => 5,
            'name'          => $request->name,
            'username'      => 'dummy',
            'email'         => $request->email,
            'phone'         => $request->phone,
            'password'      => Hash::make($request->password),
            'is_approved'   => false,
            'joining_date'  => date('Y-m-d'),
            'joining_month' => date('F'),
            'joining_year'  => date('Y'),
            'status' => 0,
            'avatar' => $profile
        ]);
        $username = str_replace(' ', '-', strtolower($request->name));
        $user->update([
            'username'      => $username.'-'.$user->id,
        ]);
        
     

        ImportexportAccount::create([
            'importer_exporter' => $request->importer_exporter,
            'import_permit' => $request->import_permit,
            'permit_type' =>  $request->permit_type,
            'trade_license' =>  $request->trade_license,
            'bank_account' => $request->bank_account ?? null,
            'bank_name'    => $request->bank_name ?? null,
            'holder_name'  => $request->holder_name ?? null,
            'branch_name'  => $request->branch_name ?? null,
            'routing'      => $request->routing ?? null,
            'description'  => $request->description,
            'commission'   => $request->commission,
            'trade_license_file'  => $tradeName,
            'national_id'  => $nidName,
            'paypal_account' => $request->paypal,
        ]);
        
        notify()->success("ImportExporter Account successfully added", "Added");
        return redirect()->back();
        
    }


    public function show($id)
    {
        $importExporter = User::where('id', $id)->where('role_id', 5)->firstOrFail();
        return view('admin.e-commerce.importExporter.show', compact('importExporter'));
    }


    public function edit($id)
    {
        $importExporter = User::where('id', $id)->where('role_id', 5)->firstOrFail();
        return view('admin.e-commerce.importExporter.form', compact('importExporter'));
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
        $user = User::where('id', $id)->where('role_id', 5)->firstOrFail();
        $importExporter = ImportExportAccount::where('user_id',$user->id)->first();


        $this->validate($request, [
            'name'         => 'required|string|max:50',
            'email'        => 'required|string|max:255',
            'phone'        => 'required|string|max:30',
            'bank_account' => 'required|string|max:255',
            'bank_name'    => 'required|string|max:255',
            'holder_name'  => 'required|string|max:255',
            'branch_name'  => 'required|string|max:255',
            'routing'      => 'required|string|max:255',
            'avatar'      => 'nullable|image|max:1024|mimes:jpg,jpeg,bmp,png,webp',
            'trade'  => 'nullable|image|max:1024|mimes:jpg,jpeg,bmp,png,webp',
            'nid'  => 'nullable|image|max:1024|mimes:jpg,jpeg,bmp,png,webp'
        ]);

        $profile = $request->file('avater');
        $trade   = $request->file('trade');
        $nid   = $request->file('nid');
        if ($profile) {
            $currentDate = Carbon::now()->toDateString();
            $profileName = $currentDate.'-'.uniqid().'.'.$profile->getClientOriginalExtension();
            
            if (file_exists('uploads/member/'.$user->avatar)) {
                unlink('uploads/member/'.$user->avatar);
            }

            if (!file_exists('uploads/member')) {
                mkdir('uploads/member', 0777, true);
            }
            $profile->move(public_path('uploads/member'), $profileName);
        } 
        else {
            $profileName = $user->avatar;
        }
       

        if ($trade) {
            $currentDate = Carbon::now()->toDateString();
            $tradeName   = $currentDate.'-'.uniqid().'.'.$trade->getClientOriginalExtension();
            
            if (file_exists('uploads/importer-exporter'.$importExporter->trade_license_file)) {
                unlink('uploads/importer-exporter'.$importExporter->trade_license_file);
            }

            if (!file_exists('uploads/importer-exporter')) {
                mkdir('uploads/importer-exporter', 0777, true);
            }
            $trade->move(public_path('uploads/importer-exporter'), $tradeName);
        }
        else {
            $tradeName = $importExporter->trade_license_file;
        }
         if ($nid) {
            $currentDate = Carbon::now()->toDateString();
            $nidName   = $currentDate.'-'.uniqid().'.'.$nid->getClientOriginalExtension();
            
            if (file_exists('uploads/importer-exporter'.$importExporter->national_id)) {
                unlink('uploads/importer-exporter'.$importExporter->national_id);
            }

            if (!file_exists('uploads/importer-exporter')) {
                mkdir('uploads/importer-exporter', 0777, true);
            }
            $nid->move(public_path('uploads/importer-exporter'), $nidName);
        }
        else {
            $nidName = $importExporter->national_id;
        }

        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone
        ]);

        $importExporter->update([
            'importer_exporter' => $request->importer_exporter,
            'import_permit' => $request->import_permit,
            'permit_type' =>  $request->permit_type,
            'trade_license' =>  $request->trade_license,
            'bank_account' => $request->bank_account,
            'bank_name'    => $request->bank_name,
            'holder_name'  => $request->holder_name,
            'branch_name'  => $request->branch_name,
            'routing'      => $request->routing,
            'national_id'  => $nidName,
            'trade_license_file'  => $tradeName,
            'paypal_account' => $request->paypal,

        ]);
        
        notify()->success("Vendor successfully updated", "Update");
        redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $importExporter = User::where('id', $id)->where('role_id', 5)->firstOrFail();
        
        if (file_exists('uploads/member/'.$importExporter->avatar)) {
            unlink('uploads/member/'.$importExporter->avatar);
        }
        ImportexportAccount::where('user_id',$importExporter->id)->delete();
        ImporterexporterItem::where('user_id',$importExporter->id)->delete();
        $importExporter->delete();
        notify()->success("Vendor successfully deleted", "Delete");
        return back();
    }

    public function change_passIndex($id){
        $importExporter = User::where('id', $id)->where('role_id', 5)->firstOrFail();
        return view('admin.e-commerce.importExporter.change_passIndex', compact('importExporter'));
    }
    public function change_pass(Request $request, $id)
    {
        $importExporter = User::where('id', $id)->where('role_id', 5)->firstOrFail();
        $this->validate($request, [
            'password'     => 'required|string|min:8|confirmed',
        ]);

        $importExporter->update([
            'password'      => Hash::make($request->password)
        ]);


        notify()->success("Password successfully updated", "Update");
        return redirect()->back();
    }

    public function ImportExportList($id)
    {
        $user = User::where('id', $id)->where('role_id', 5)->firstOrFail();
        $importer_exporter =ImportexportAccount::where('user_id',$user->id)->first();
        $importExportItems = ImporterexporterItem::where('user_id',$user->id)->paginate(50);
        return view('admin.e-commerce.importExporter.list', compact('user','importer_exporter','importExportItems'));
    }
    public function ImportExportListEdit($id,$sid){
        $importExportItem = ImporterexporterItem::where(['user_id' => $id, 'id' => $sid])->first();
        return view('admin.e-commerce.importExporter.edit', compact('importExportItem'));
    }
    public function ImportExportItemUpdate(Request $request){

        $request->validate([
            'item_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'url' => 'required|url',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'import_export' => 'required|string|in:import,export',
        ]);

        $request_image = $request->file('image');
        if (!is_null($request_image)){
            $name_gen = hexdec(uniqid()) . '.' . $request_image->getClientOriginalExtension();
            $request_image->move(public_path('uploads/importer-exporter/items'), $name_gen);
            $image = $name_gen;
         }

        $item = ImporterexporterItem::where('id',$request->hidden_id)->first();
        $item->update([
            'item_name' => $request->item_name,
            'image' => $image ?? $item->image,
            'url' => $request->url,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'import_export' => $request->import_export,
            'payment_status' => $request->payment_status,
            'status' =>  $request->status
        ]);
        notify()->success("Item Request Updated Successfully", "Successfully");
        return redirect()->back();
    }

}
