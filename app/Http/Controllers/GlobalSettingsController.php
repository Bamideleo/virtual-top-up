<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\ApiSetting;
use App\Models\Discount;
use App\Models\Purchase;
use App\Models\GlobalSetting;
use Auth;
use Mail;
use Session;
use DB;



class GlobalSettingsController extends Controller
{
   public function index(){
    $g_setting = GlobalSetting::where('id',1)->first();
    return view('admin.main.global_setting',compact('g_setting')); 

   }

   public function save_global_settings(Request $request){
    $rules = [
        'site_name' => 'required',
        'site_logo' => 'nullable|mimes:jpeg,png,jpg',
        'phone_number'    => 'required',
        'email'    => 'required|email',
        'description'    => 'required',
    ];
    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();           
    }


    if ($request->hasFile('site_logo')) {
       
        $file = $request->file('site_logo');
        $extension = $file->extension();
        $filename = time().'.'.$extension;
        $path = $file->move(public_path('images'), $filename);
    }
    $chk_setting = GlobalSetting::where('id',1)->first();
    if($chk_setting){
        GlobalSetting::where('id',1)->update(
            [
                'site_name' => $request->site_name,
                'site_logo' => $filename,
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'description' => $request->description
            ]
        );  
    }
    GlobalSetting::create(
        [
            'site_name' => $request->site_name,
            'site_logo' => $filename,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'description' => $request->description
        ]
    );
    
    Session::flash("success","Global Settings Added Successfully"); 
    return redirect()->back();
   }

   public function updata_bonus(){
     $id = Auth::user()->id;
     $chk = User::where('free_bonus',1)->where('paid_back_bonus',1)->first();
     if(!empty($chk)){
        User::where('id',$id)->update(
            [
                'free_bonus' => 0,
                'paid_back_bonus' => 0
            ]
         );
     }


    

     return response(['status'=>200],200);
   }

}
