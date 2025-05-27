<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Wallet;
use App\Models\Transaction;
use App\Models\User;
use App\Models\ApiSetting;
use Auth;
use Mail;
use DB;
use Session;

class AdminDepositController extends Controller
{
   
    public function payment_history(){
        $data = Transaction::orderBy('id','desc')->paginate(10);
        return view('admin.main.get_all_payment',compact('data'));
    }

    public function revert_payment(Request $request){
        $id= $request->id;
        $data = Transaction::where('id',$id)->first();
        $wallet = Wallet::where('user_id',$data->user_id)->first();
        $fund = $wallet->wallet - $data->amount;
        Wallet::where('user_id',$data->user_id)->update([
            "wallet" => $fund
        ]);
        Transaction::where('id',$id)->delete();
        return response(['data'=>200],200);
    }

    public function search_payment(Request $request){
        $queryString = $request->name;
        $data = Transaction::where('fullname', 'LIKE', "%$queryString%")->orWhere('reference', 'LIKE', "%$queryString%")->orderBy('id','desc')->paginate(10);
        return view('admin.main.get_all_payment',compact('data'));
    }


    public function payment_gataway(){
        $user_id = Auth::user()->id;
       $api = ApiSetting::where('user_id', $user_id)->where('type','paystack')->first();
        $api_vpay = ApiSetting::where('user_id', $user_id)->where('type','vpay')->first();
        return view('admin.main.payment_gateway',compact('api','api_vpay'));
    }

    public function soundbox(Request $request){
        $user_id = Auth::user()->id;
        $chk_api = ApiSetting::where('user_id',$user_id)->where('type','vtpass-soundbox')->first();
        if($request->type == 'vtpass'){
            $rules = [
                'public_key' => 'required',
                'secret_key' => 'required',
                'email' => 'required',
                'password' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if(empty($chk_api)){
               
                ApiSetting::create([
                    'user_id'=> $user_id,
                    'public_key' => $request->public_key,
                    'secret_key' => $request->secret_key,
                    'api_key' => $request->api,
                    'type' => "vtpass-soundbox",
                    'email' => $request->email,
                    'password' => $request->password
                ]);
            }
            else{
                ApiSetting::where('user_id', $user_id)->where('type','vtpass-soundbox')->update([
                    'public_key' => $request->public_key,
                    'secret_key' => $request->secret_key,
                    'api_key' => $request->api,
                    'type' => "vtpass-soundbox",
                    'email' => $request->email,
                    'password' => $request->password
                ]);
            }
        }

        Session::flash("success","Soundbox Added successfully"); 
        return back();

 
    }
    public function payment_api(Request $request){
        // data service provider API
        $user_id = Auth::user()->id;
        $chk_api = ApiSetting::where('user_id',$user_id)->where('type','vtpass')->first();
        if($request->type == 'vtpass'){
            $rules = [
                'public_key' => 'required',
                'secret_key' => 'required',
                'email' => 'required',
                'password' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if(empty($chk_api)){
                ApiSetting::create([
                    'user_id'=> $user_id,
                    'public_key' => $request->public_key,
                    'secret_key' => $request->secret_key,
                    'api_key' => $request->api,
                    'type' => "vtpass",
                    'email' => $request->email,
                    'password' => $request->password
                ]);
            }
            else{
                ApiSetting::where('user_id', $user_id)->where('type','vtpass')->update([
                    'public_key' => $request->public_key,
                    'secret_key' => $request->secret_key,
                    'api_key' => $request->api,
                    'type' => "vtpass",
                    'email' => $request->email,
                    'password' => $request->password
                ]);
            }
        }


        $chk_epin = ApiSetting::where('user_id',$user_id)->where('type','epin')->first();
        if($request->type == 'epins'){
            $rules = [
                'api' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();           
            }
            if(empty($chk_epin)){
                ApiSetting::create([
                    'user_id'=> $user_id,
                    'api_key' => $request->api,
                    'type' => "epin"
                ]);
            }
            else{
                ApiSetting::where('user_id', $user_id)->where('type','epin')->update([
                    'api_key' => $request->api,
                    'type' => "epin"
                ]);
            } 
        }

        $chk_apihub = ApiSetting::where('user_id',$user_id)->where('type','apihub')->first();
       
        if($request->type == 'apihub'){
            $rules = [
                'api' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();           
            }
            if(empty($chk_apihub)){
                ApiSetting::create([
                    'user_id'=> $user_id,
                    'api_key' =>'Token'.' '.$request->api,
                    'type' => "apihub"
                ]);
            }
            else{
                ApiSetting::where('user_id', $user_id)->where('type','apihub')->update([
                    'api_key' => $request->api,
                    'type' => "apihub"
                ]);
            } 
        }


// Payment Gateway API
        $chk_paystack = ApiSetting::where('user_id',$user_id)->where('type','paystack')->first();
        if($request->type == 'paystack'){ 
        if(empty($chk_paystack)){
            $rules = [
                'public_key' => 'required',
                'secret_key' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();           
            }
            ApiSetting::create([
                'user_id'=> $user_id,
                'public_key' => $request->public_key,
                'secret_key' => $request->secret_key,
                'type' => "paystack"
            ]);
        }
        else{
            ApiSetting::where('user_id', $user_id)->where('type','paystack')->update([
                'public_key' => $request->public_key,
                'secret_key' => $request->secret_key,
                'type' => "paystack"
            ]);
        }
    }
        
    $chk_monnify = ApiSetting::where('user_id',$user_id)->where('type','vpay')->first();
    if($request->type == 'vpay'){ 
    if(empty($chk_monnify)){
        $rules = [
            'public_key' => 'required',
            'email' => 'required',
            'password' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();           
        }
        ApiSetting::create([
            'user_id'=> $user_id,
            'public_key' => $request->public_key,
            'type' => "vpay",
            'email' => $request->email,
            'password' => $request->password
        ]);
    }
    else{
        ApiSetting::where('user_id', $user_id)->where('type','vpay')->update([
            'public_key' => $request->public_key,
            'type' => "vpay",
            'email' => $request->email,
            'password' => $request->password
        ]);
    }
}
        
        Session::flash("success","Gateway Added successfully"); 
        return back();

    }


    public function api_gataway(){
        $user_id = Auth::user()->id;
        $api = ApiSetting::where('user_id', $user_id)->where('type','vtpass')->first();
        $epin = ApiSetting::where('user_id', $user_id)->where('type','epin')->first();
        $apihub = ApiSetting::where('user_id', $user_id)->where('type','apihub')->first();
         return view('admin.main.api_gateway',compact('api','epin','apihub'));  
    }

    public function sound_box(){
        $user_id = Auth::user()->id;
        $api = ApiSetting::where('user_id', $user_id)->where('type','vtpass-soundbox')->first();
         return view('admin.main.soundbox',compact('api'));  
    }

    public function get_transaction(Request $request){
        $data = Transaction::whereYear('created_at', $request->year_data)
        ->whereMonth('created_at', $request->month_data)
        ->sum('amount');
        return response(['data'=>$data],200);
    }

    public function send_message(Request $request){
        $rules = [
            'email'    => 'required',
            'subject'    => 'required',
            'message'    => 'required',      
        ];
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {  
            return back()->withErrors($validator)->withInput();        
        }
            $email = $request->email;
            $subject = $request->subject;
            $mess = $request->message;
            $user = User::where('id',$request->id)->first();
            $name = $user->first_name.' '.$user->last_name;
          $dat=['name'=>$name,'email'=>$email, 'subject'=>$subject, 'mess'=>$mess];

           //  for sending mail
         Mail::send('admin.main.send_email_template',  $dat, function ($message) use ($email, $subject, $name, $mess){
                        
           $message->from('support@waveplus.com.ng', $name = "WavePlus");
            $message->subject($subject, $name = $name);
            $message->to($email, $name = null);  
    });
    
    Session::flash("success","Message Send Successfully"); 
    return back();


}

public function get_notification($id){
    $data = DB::table('notifications')->where('id', $id)->first();
    return view('admin.main.get_notification',compact('data'));
}

}
