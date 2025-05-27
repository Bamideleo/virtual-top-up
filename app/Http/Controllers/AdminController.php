<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Admin;
use App\Models\Discount;
use App\Models\Wallet;
use App\Models\Transaction;
use App\Models\Purchase;
use App\Models\Transfer;
use App\Models\ApiSetting;
use Session;
use Carbon\Carbon;
use Hash;
use DB;

class AdminController extends Controller
{
   
    public function Dashboard(){
        $month = date('m');
        $year = date('Y');
        $t_user = User::count();
        $payment = Transaction::count();
        $t_referral = User:: whereNotNull('referal_id')->count();
        $payment_1 = Transaction::orderBy('id','desc')->paginate(10);
        $transfer = Transfer::count();
        $wallet = Wallet::sum('wallet');
        $purchase = Purchase::count();
        $t_payment = Transaction::sum('amount');
        $m_payment = Transaction::whereYear('created_at', $year)
        ->whereMonth('created_at', $month)
        ->sum('amount');
        
        
        
$get_details = ApiSetting::where('type','vtpass')->first();

if(!empty($get_details)){
$api_key = $get_details->api_key;
$public_key = $get_details->public_key;
$secret_key = $get_details->secret_key;
  
$url = "https://sandbox.vtpass.com/api/balance";
$url = "https://api-service.vtpass.com/api/balance";
   
$curl = curl_init();
$headers  = [
    'Content-Type: multipart/form-data',
    'api-key:'. $api_key,
    'public-key:'.$public_key,
    //  'secret-key:'.$secret_key
];
curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
//   CURLOPT_POSTFIELDS => $arr,
  CURLOPT_HTTPHEADER => $headers
));

$response = curl_exec($curl);
curl_close($curl);
$result = json_decode($response,true);
$vtpass = $result['contents']['balance'];    
}else{
  $vtpass = 0;  
}



$get_det = ApiSetting::where('type','epin')->first();
if(!empty($get_det)){
 $api_key_2 = $get_det->api_key;
$url_2 = "https://api.epins.com.ng/v2/autho/balance/?apikey=".$api_key_2;
   
$curl = curl_init();
$headers  = [
    'Content-Type: multipart/form-data',
    'apikey:'. $api_key_2,
];
curl_setopt_array($curl, array(
  CURLOPT_URL => $url_2,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
//   CURLOPT_POSTFIELDS => $arr,
  CURLOPT_HTTPHEADER => $headers
));

$response = curl_exec($curl);
curl_close($curl);
$res = json_decode($response,true);
$epin = $res;   
}else{
 $epin = 0;    
}


return view('admin.main.dashboard',compact('t_user','payment','transfer','t_payment','t_referral','m_payment','payment_1','vtpass','epin','wallet','purchase'));
    }

    public function Create_user(){
        return view('admin.main.create_user'); 
    }


    public function Save_user(Request $request){
        $code =  $this->generateRandom();
        $rules = [
            'firstname' => 'required',
            'lastname' => 'required',
            'email'    => 'required|email',
            // 'phone_number' => 'required|numeric|min:11',
            'password' => [
                'required',
                'string',
                'min:6',             // must be at least 10 characters in length
            ],
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();           
        }
        $referal = $request->last_name .'-'.$code;
        User::create(
            [
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'phone_no' => $request->phone_number,
                'email' => $request->email,
                'type'  => 1,
                'referal_name' =>  $referal,
                'username' =>  $referal,
                'password' => Hash::make($request->password),
            ]
        );
        Session::flash("success","User Created successfully"); 
        return back();
        


    }

    public function generateRandom($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return 'wp'.$randomString;
    }

public function Get_user(){
    $data = User::orderBy('id','desc')->paginate(20);
    return view('admin.main.get_all_user',compact('data'));
}

public function search_user(Request $request){
    $queryString = $request->name;
    $data = User::where('first_name', 'LIKE', "%$queryString%")->orWhere('email', 'LIKE', "%$queryString%")->orderBy('id','desc')->paginate(10);
    return view('admin.main.get_all_user', compact('data')); 
}

public function edit_user($id){
$data = User::find($id);
$wallet = Wallet::where('user_id',$id)->first();
return view('admin.main.edit_user',compact('data','wallet'));
}

public function update_user(Request $request, $id){
    if($request->password == null){
        User::where('id',$id)->update([
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'address' => $request->address,
                'phone_no' => $request->phone_number,
                'email' => $request->email,
                'giveway' => $request->free_bonus
              
        ]);
        Session::flash("success","User Updated successfully"); 
        return back();
    }
    else{
        User::where('id',$id)->update([
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'address' => $request->address,
                'email' => $request->email,
                'phone_no' => $request->phone_number,
                'password' => Hash::make($request->password),
                'giveway' => $request->free_bonus
        ]);

        Session::flash("success","User Updated successfully"); 
        return back();
    }
}


public function active_user(Request $request){
    $id= $request->id;
    $type = $request->type;
    if($type == 0 ){
        User::where('id',$id)->update(
            ['type' => 1]
        );

        return response(['data'=>200],200);

    }else{
        User::where('id',$id)->update(
            ['type' =>0]
        );
    return response(['data'=>400],200);
    }

  
}


public function delete_user($id){
    User::where('id',$id)->delete();
    Session::flash("error","User Deleted successfully"); 
        return back();
}



public function network(){
   $data = DB::table('networks')->orderBy('id','desc')->paginate(10);
    return view('admin.main.network', compact('data'));   
}


public function save_network(Request $request){
    // dd($request->all());
    $rules = [
        'network' => 'required',
        'variation_code' => 'required',
        'plan' => 'required',
        
    ];
    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();           
    }
    DB::table('networks')->insert(
        [
            "network" => $request->network,
            "data_type" => $request->data_type,
            "plans" => $request->plan,
            "var_code" => $request->variation_code,
            "amount" => $request->amount
        ]
    );
    Session::flash("success","Details Added successfully"); 
    return back();

}

public function edit_network($id){
    $data = DB::table('networks')->where('id',$id)->first(); 
    return view('admin.main.edit_network', compact('data')); 
}

public function update_network(Request $request, $id){

    
    $data = DB::table('networks')->where('id',$id)->update(
        [
            "network" => $request->network,
            "data_type" => $request->data_type,
            "plans" => $request->plan,
            "var_code" => $request->variation_code,
            "amount" => $request->amount
        ]
    ); 

    Session::flash("success","Details Updated successfully"); 
    return back();
}

public function delete_network($id){
    DB::table('networks')->where('id',$id)->delete();
    Session::flash("error","User Deleted successfully"); 
        return back();
}

public function discount_and_charges(){
    $coupon =  Discount::where('discount',1)->first();
    $unility =  Discount::where('discount',2)->first();
    $payment =  Discount::where('discount',3)->first();
    $airtime =  Discount::where('discount',4)->first();
    $data =  Discount::where('discount',5)->first();
    $agent =  Discount::where('discount',6)->first();
    $vendor =  Discount::where('discount',7)->first();
    $cashback =  Discount::where('discount',8)->first();
    $get_all =  Discount::get();
    return view('admin.main.discount_and_charge', compact('coupon','unility','payment','airtime','get_all','data','agent','vendor','cashback'));   
}

public function get_coupon($length = 6){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    $code = 'WP-'.$randomString;
    return response(['data'=>$code],200);
}

public function incrementalHash($length = 8){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
}

public function save_discount_and_charges(Request $request){
    $rules = [
        'discount' => 'required',
        'code' => 'required',
    ];
    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();           
    }
    
    if( $request->discount == 1){
    $chk = Discount::where('discount', 1)->first();
    if(!empty($chk)){
          $chk->update([
        "code" => $request->code,
        "expire_at" => $request->expire_at,
        "coupon_amt" => $request->coupon_amt
    ]);   
        }else{
        Discount::create([
        "discount" => $request->discount,
        "code" => $request->code,
        "expire_at" => $request->expire_at,
        "coupon_amt" => $request->coupon_amt
    ]);  
        }
        
        
      
    }else{
       Discount::create([
        "discount" => $request->discount,
        "code" => $request->code,
        "expire_at" => $request->expire_at,
        "coupon_amt" => $request->coupon_amt
    ]);  
    }
    Session::flash("success","Charges Added successfully"); 
    return back();
}

public function delete_discount($id){
    Discount::where('id',$id)->delete();
    Session::flash("success","Charges Deleted successfully"); 
    return back();
}

public function fund_wallet(Request $request, $id){
    $rules = [
        'amount' => 'required',
    ];
    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();           
    }
    $user = User::find($id);
    Transaction::create([
        'user_id' => $id,
        'fullname' => $user->first_name .' '. $user->last_name,
        'email' => $user->email,
        'type' => 'Transfer',
        'amount' => $request->amount,
        'reference' => 'wp-'. $this->incrementalHash()
    ]);
    $wallet = Wallet::where('user_id',$id)->first();
    if(empty($wallet)){
        Wallet::create([
            "user_id" => $id,
            "wallet" => $request->amount
        ]);
    }
    else{
        $fund = $wallet->wallet + $request->amount;
        Wallet::where('user_id',$id)->update([
            "wallet" => $fund
        ]);
    }
    Session::flash("success","Wellet Fund successfully"); 
    return back();
}


public function transfer(){
    $data = Transfer::where('status',0)->orderBy('id','desc')->paginate(10);
    return view('admin.main.transfer', compact('data')); 
}

public function search_fund(Request $request){
    $queryString = $request->name;
    $data = Transfer::where('status',0)->where('fullname', 'LIKE', "%$queryString%")->orderBy('id','desc')->paginate(10);
    return view('admin.main.transfer', compact('data')); 
}

public function all_transfer(){
    $data = Transfer::orderBy('id','desc')->paginate(10);
    return view('admin.main.all_transfer', compact('data')); 
}

public function search_all_fund(Request $request){
    $queryString = $request->name;
    $data = Transfer::where('fullname', 'LIKE', "%$queryString%")->orderBy('id','desc')->paginate(10);
    return view('admin.main.all_transfer', compact('data'));
}

public function approve_transfer(Request $request){
    $id= $request->id;
    Transfer::where('id',$id)->update(
            ['status' => 1]
        );
    return response(['data'=>200],200);
}

public function get_all_purchase(){
    $data = Purchase::orderBy('id','desc')->paginate(20);
   return view('admin.main.purchase', compact('data'));   
} 

function admin_profile(){
    $data = Admin::where('id',1)->first();
    return view('admin.main.profile', compact('data')); 
}

function update_profile(Request $request){
    $rules = [
        'name' => 'required',
        'email'    => 'required|email',
        'password' => 'required'
    ];
    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();           
    }

    Admin::where('id',1)->update(
        [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]
    );

    Session::flash("success","Profile Updated successfully"); 
    return back();
}


}