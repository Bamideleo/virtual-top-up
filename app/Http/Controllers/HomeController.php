<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Wallet;
use App\Models\Transaction;
use App\Models\Discount;
use App\Models\Purchase;
use App\Models\ApiSetting;
use App\Models\User;
use Carbon\Carbon;
use Session;
Use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::user()->id;
       $data = Transaction::where('user_id',$user_id)->orderBy('id','desc')->paginate(10);
       $total_trans = Transaction::where('user_id',$user_id)->count();
       $wallet = Wallet::where('user_id',$user_id)->first();
       $purchase = Purchase::where('user_id',$user_id)->count();
        $t_referal = User::where('referal_id',$user_id)->count();
        $title = "Dashboard";
        return view('users.main.dashboard',compact('data','total_trans','wallet','purchase','t_referal','title'));
    }

    
    public function Network_data()
    {
        $user_id = Auth::user()->id;
        $wallet = Wallet::where('user_id',$user_id)->first();
        $discount = Discount::where('discount',5)->first();
        $agent = Discount::where('discount',6)->first();
        $vendor = Discount::where('discount',7)->first();
        $cashback = Discount::where('discount',8)->first();
        $title = "Network Data";
        return view('users.main.network_data', compact('wallet','agent','vendor','title','cashback','discount'));
    }


    public function get_mtn_data(Request $request){
        $id = $request->type;
        $network = $request->id;
        // $data= DB::table('networks')->where('network',$network)->where('data_type',$id)->orderBy('id','asc')->get();
         if($id == 1){
        $url = 'https://api.epins.com.ng/v2/autho/variations/?service=sme';
        }

        if($id == 2){
        $url = "https://api.epins.com.ng/v2/autho/variations/?service=cglite";
        }

        if($id == 3){
        $url = 'https://api.epins.com.ng/v2/autho/variations/?service=gifting';
        }

        if($id == 4){
          $url = "https://api.epins.com.ng/v2/autho/variations/?service=directdata";
        }
        
        $curl = curl_init();
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
        // CURLOPT_POSTFIELDS => json_encode($arr),
        // CURLOPT_HTTPHEADER => $headers
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response,true);

        return response(['data'=>$result['description']],200);
        // return response(['data'=>$data],200);

    }

    public function get_gol_data(Request $request){
        $id = $request->type;
        $network = $request->id;
        // $data = DB::table('networks')->where('network',$network)->where('data_type',$id)->orderBy('id','asc')->get();
        
         if($id == 1){
        $url = 'https://api.epins.com.ng/v2/autho/variations/?service=sme';
        }

        if($id == 2){
        $url = "https://api.epins.com.ng/v2/autho/variations/?service=cglite";
        }

        if($id == 3){
        $url = 'https://api.epins.com.ng/v2/autho/variations/?service=gifting';
        }

        if($id == 4){
          $url = "https://api.epins.com.ng/v2/autho/variations/?service=directdata";
        }
        
        $curl = curl_init();
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
        // CURLOPT_POSTFIELDS => json_encode($arr),
        // CURLOPT_HTTPHEADER => $headers
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response,true);

        return response(['data'=>$result['description']],200);
        
        // return response(['data'=>$data],200);    
    }

    public function get_airtel_data(Request $request){
        $id = $request->type;
        $network = $request->id;
        // $data = DB::table('networks')->where('network',$network)->where('data_type',$id)->orderBy('id','asc')->get();
        
         if($id == 1){
        $url = 'https://api.epins.com.ng/v2/autho/variations/?service=sme';
        }

        if($id == 2){
        $url = "https://api.epins.com.ng/v2/autho/variations/?service=cglite";
        }

        if($id == 3){
        $url = 'https://api.epins.com.ng/v2/autho/variations/?service=gifting';
        }

        if($id == 4){
          $url = "https://api.epins.com.ng/v2/autho/variations/?service=directdata";
        }
        
        $curl = curl_init();
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
        // CURLOPT_POSTFIELDS => json_encode($arr),
        // CURLOPT_HTTPHEADER => $headers
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response,true);

        return response(['data'=>$result['description']],200);
        
        // return response(['data'=>$data],200);
    }

    public function get_9moblie_data(Request $request){
        $id = $request->type;
        $network = $request->id;
        // $data = DB::table('networks')->where('network',$network)->where('data_type',$id)->orderBy('id','asc')->get(); 
        
         if($id == 1){
        $url = 'https://api.epins.com.ng/v2/autho/variations/?service=sme';
        }

        if($id == 2){
        $url = "https://api.epins.com.ng/v2/autho/variations/?service=cglite";
        }

        if($id == 3){
        $url = 'https://api.epins.com.ng/v2/autho/variations/?service=gifting';
        }

        if($id == 4){
          $url = "https://api.epins.com.ng/v2/autho/variations/?service=directdata";
        }
        
        $curl = curl_init();
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
        // CURLOPT_POSTFIELDS => json_encode($arr),
        // CURLOPT_HTTPHEADER => $headers
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $result = json_decode($response,true);

        return response(['data'=>$result['description']],200);
        
        // return response(['data'=>$data],200);
    }



    public function Smile_data()
    {
        $user_id = Auth::user()->id;
        $wallet = Wallet::where('user_id',$user_id)->first();
        $discount = Discount::where('discount',2)->first();
        $agent = Discount::where('discount',6)->first();
        $vendor = Discount::where('discount',7)->first();
        $cashback = Discount::where('discount',8)->first();
        $title = "Smile Data";
        return view('users.main.smile_data', compact('wallet','discount','agent','vendor','title','cashback'));
    }

    
    public function get_variation(){
        $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, "https://sandbox.vtpass.com/api/service-variations?serviceID=smile-direct");
        // live
        curl_setopt($ch, CURLOPT_URL, "https://api-service.vtpass.com/api/service-variations?serviceID=smile-direct");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response,true);
        // live
        // return $result['content']['variations'];
        return $result['content']['varations'];
    }

    public function get_vtpass_smile_data(Request $request){

        $rules = [
            'email' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {  
            return response([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ],400);
        }

        
        $get_details = ApiSetting::where('type','vtpass')->first();
        $api_key = $get_details->api_key;
        $public_key = $get_details->public_key;
        $secret_key = $get_details->secret_key;
        $username = $get_details->email;
        $password = $get_details->password;
    // change this to live when go live
    $url = "https://api-service.vtpass.com/api/merchant-verify/smile/email";
        // $url = "https://sandbox.vtpass.com/api/merchant-verify/smile/email";
        $day = Carbon::now()->format('d');
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');
        $hour = Carbon::now()->format('H');
        $min = Carbon::now()->format('i');
        $d = $year.$month.$day.$hour.$min;
      $arr = [
        'serviceID' => 'smile-direct',
        'billersCode' => $request->email,
      ];
    $curl = curl_init();
    $headers  = [
        'Content-Type: multipart/form-data',
        'Username:'. $username,
        'Password:'. $password,
        'api-key:'. $api_key,
        // 'public-key:'.$public_key,
        'secret-key:'.$secret_key
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
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $arr,
      CURLOPT_HTTPHEADER => $headers
    ));
    
    $response = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($response,true);
    if(count($result['content']) > 1){
    $data['username'] = $result['content']['Customer_Name'];
    $data['accountId'] = $result['content']['AccountList']['Account'][0]['AccountId'];
    return response([
        'success' => true,
        'data' => $data,
         'variation' => $this->get_variation(),
    ],200);
    }else{
        $data['error'] = $result['content']['error'];
        return response([
            'success' => false,
            'data' => $data
        ],200);
    }
        
    }

    public function get_vtpass_smile_pay(Request $request){
        $user_id = Auth::user()->id;
        $rules = [
            'type' => 'required',
            // 'plan' => 'required',
            // 'smile_account' => 'required',
            'phone_number' => 'required|numeric|digits:11',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {  
            return response([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ],400);
        }

        
 // check if wallet is empty of less
 $wall = Wallet::where('user_id',$user_id)->first();
 if(empty($wall) || $wall->wallet == 0 || $wall->wallet < $request->t_amount){
    return response([
        'success' => 402,
        'errors' => 'You Have Insufficent Balance'
    ],402);  
 }


$get_details = ApiSetting::where('type','vtpass')->first();
$api_key =     $get_details->api_key;
$public_key = $get_details->public_key;
$secret_key = $get_details->secret_key;
$username = $get_details->email;
$password = $get_details->password;
    // $url = "https://sandbox.vtpass.com/api/pay";
    $url = "https://api-service.vtpass.com/api/pay";
    $day = Carbon::now()->format('d');
    $month = Carbon::now()->format('m');
    $year = Carbon::now()->format('Y');
    $hour = Carbon::now()->format('H');
    $min = Carbon::now()->format('i');
    $id = $year.$month.$day.$hour.$min.$this->incrementalHash();
  $arr = [
    'request_id' => $id,
    'serviceID' => 'smile-direct',
    'billersCode' => $request->accountId,
    'variation_code' => $request->type,
    // 'quantity' => 1,
    'phone' => $request->phone_number
  ];
$curl = curl_init();
$headers  = [
    'Content-Type: multipart/form-data',
    'Username:'. $username,
    'Password:'. $password,
    'api-key:'. $api_key,
    // 'public-key:'.$public_key,
    'secret-key:'.$secret_key
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
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $arr,
  CURLOPT_HTTPHEADER => $headers
));

$response = curl_exec($curl);
curl_close($curl);
$result = json_decode($response,true);
$data['product_name'] = $result['content']['transactions']['product_name'];
$data['transactionId'] = $result['content']['transactions']['transactionId'];
$data['amount'] = $result['amount'];
$data['status'] = $result['response_description'];
$data['date'] = $result['transaction_date']['date'];
$p_tran = Purchase::create([
    'product_name' => $data['product_name'],
    'transaction_id' => $data['transactionId'],
    'amount' => $request->t_amount,
    'user_id' => $user_id,
    'type' => 'smile',
    'status' => $data['status'],
    'date' => $data['date'],
    'phone_number' => $request->phone_number,
    'real_amount' => $data['amount'],

]);
$sub_fund = $wall->wallet - $p_tran->amount;
Wallet::where('user_id',$user_id)->update([
                "wallet" => $sub_fund
            ]);
            
$cash_back = Auth::user()->cashback + $request->cash_back;
    User::where('id',$user_id)->update([
        "cashback" => $cash_back
        ]);
        return response([
            'success' => true
        ],200);

    }

//    vtpass spectratnet section
public function get_variation_two(){
    $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, "https://sandbox.vtpass.com/api/service-variations?serviceID=spectranet");
    // live
    curl_setopt($ch, CURLOPT_URL, "https://api-service.vtpass.com/api/service-variations?serviceID=spectranet");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($response,true);
    // live
    return $result['content']['variations'];
    // return $result['content']['varations'];
}

    public function Spectratnet_data()
    {
        $user_id = Auth::user()->id;
        $wallet = Wallet::where('user_id',$user_id)->first();
        $discount = Discount::where('discount',2)->first();
        $agent = Discount::where('discount',6)->first();
        $vendor = Discount::where('discount',7)->first();
        $cashback = Discount::where('discount',8)->first();
        $title = "Spectratnet Data";
        $type = $this-> get_variation_two();
        return view('users.main.spectratnet_data', compact('wallet','discount','agent','vendor','title','type','cashback'));
    }

    public function get_epins_spectranet_pay(Request $request){
        $user_id = Auth::user()->id;
        $rules = [
            'type' => 'required',
            // 'plan' => 'required',
            'phone_number' => 'required|numeric|digits:11',
            // 'amount'    => 'required|numeric',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {  
            return response([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ],400);
        }

         // check if wallet is empty of less
 $wall = Wallet::where('user_id',$user_id)->first();
 if(empty($wall) || $wall->wallet == 0 || $wall->wallet < $request->t_amount){
    return response([
        'success' => 402,
        'errors' => 'You Have Insufficent Balance'
    ],402);  
 }


$get_details = ApiSetting::where('type','vtpass')->first();
$api_key = $get_details->api_key;
$public_key = $get_details->public_key;
$secret_key = $get_details->secret_key;
$username = $get_details->email;
$password = $get_details->password;
    // $url = "https://sandbox.vtpass.com/api/pay";
    $url = "https://api-service.vtpass.com/api/pay";
    $day = Carbon::now()->format('d');
    $month = Carbon::now()->format('m');
    $year = Carbon::now()->format('Y');
    $hour = Carbon::now()->format('H');
    $min = Carbon::now()->format('i');
    $id = $year.$month.$day.$hour.$min.$this->incrementalHash();
  $arr = [
    'request_id' => $id,
    'serviceID' => 'spectranet',
    'billersCode' => $request->phone_number,
    'variation_code' => $request->type,
    'quantity' => 1,
    // 'phone' => '1212121212'
    'phone' => $request->phone_number
  ];
$curl = curl_init();
$headers  = [
    'Content-Type: multipart/form-data',
    'Username:'. $username,
    'Password:'. $password,
    'api-key:'. $api_key,
    // 'public-key:'.$public_key,
    'secret-key:'.$secret_key
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
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $arr,
  CURLOPT_HTTPHEADER => $headers
));

$response = curl_exec($curl);
curl_close($curl);
$result = json_decode($response,true);
$data['product_name'] = $result['content']['transactions']['product_name'];
$data['transactionId'] = $result['content']['transactions']['transactionId'];
$data['amount'] = $result['amount'];
$data['phone_number'] = $result['content']['transactions']['unique_element'];
$data['status'] = $result['response_description'];
$data['date'] = $result['transaction_date']['date'];
$data['pin'] = $result['cards'][0]['pin'];
$data['serialNumber'] = $result['cards'][0]['serialNumber'];
$p_tran = Purchase::create([
    'product_name' => $data['product_name'],
    'transaction_id' => $data['transactionId'],
    'amount' => $request->t_amount,
    'user_id' => $user_id,
    'type' => 'spectranet',
    'status' => $data['status'],
    'date' => $data['date'],
    'pin' => $data['pin'],
    'serialNumber' => $data['serialNumber'],
    'phone_number' => $data['phone_number'],
    'real_amount' => $data['amount'],

]);
$sub_fund = $wall->wallet - $p_tran->amount;
Wallet::where('user_id',$user_id)->update([
                "wallet" => $sub_fund
            ]);

$cash_back = Auth::user()->cashback + $request->cash_back;
    User::where('id',$user_id)->update([
        "cashback" => $cash_back
        ]);

        return response([
            'success' => true
        ],200);

    }

    public function get_airtime(){
        $user_id = Auth::user()->id;
        $wallet = Wallet::where('user_id',$user_id)->first();
        $discount = Discount::where('discount',4)->first();
        $agent = Discount::where('discount',6)->first();
        $vendor = Discount::where('discount',7)->first();
        $cashback = Discount::where('discount',8)->first();
        $title = "Airtime";
        return view('users.main.network_airtime', compact('wallet','discount','agent','vendor','title','cashback')); 
    }


    // public function get_mtn_airtime(Request $request){
    //     $user_id = Auth::user()->id;
    //     $rules = [
    //         'phone_no' => 'required|numeric|digits:11',
    //         'amount'    => 'required|numeric',
    //     ];
    //     $validator = Validator::make($request->all(), $rules);

    //     if ($validator->fails()) {  
    //         return response([
    //             'success' => false,
    //             'errors' => $validator->getMessageBag()->toArray()
    //         ],400);
    //     }

    //             // check if wallet is empty of less
    //     $wall = Wallet::where('user_id',$user_id)->first();
    //     if(empty($wall) || $wall->wallet == 0 || $wall->wallet < $request->amount){
    //         return response([
    //             'success' => 402,
    //             'errors' => 'You Have Insufficent Balance'
    //         ],402);  
    //     }


    //     return response([
    //         'success' => true
    //     ],200);
    // }

    public function get_epin(){
        $user_id = Auth::user()->id;
        $wallet = Wallet::where('user_id',$user_id)->first();
        $title = "E-Pins";
        return view('users.main.network_epin', compact('wallet','title')); 
    }

    public function get_network_epin(Request $request){
        $user_id = Auth::user()->id;
        $rules = [
            'denomination' => 'required',
            'quantity'    => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {  
            return response([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ],400);
        }
        if($request->denomination == 1){
            $amount = 100;
        }

        if($request->denomination == 2){
            $amount = 200;
        }

        if($request->denomination == 4){
            $amount = 400;
        }

        if($request->denomination == 5){
            $amount = 500;
        }

        if($request->denomination == 7.5){
            $amount = 750;
        }

        if($request->denomination == 10){
            $amount = 1000;
        }

        if($request->denomination == 15){
            $amount = 1500;
        }

         // check if wallet is empty of less
         $wall = Wallet::where('user_id',$user_id)->first();
         if(empty($wall) || $wall->wallet == 0 || $wall->wallet < $amount){
             return response([
                 'success' => 402,
                 'errors' => 'You Have Insufficent Balance'
             ],402);  
         }

        return response([
            'success' => true
        ],200);
    }

    public function get_variation_s_max(){
        $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL, "https://sandbox.vtpass.com/api/service-variations?serviceID=showmax");
        // live
        curl_setopt($ch, CURLOPT_URL, "https://api-service.vtpass.com/api/service-variations?serviceID=showmax");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($response,true);
        dd($result);
        // live
        return $result['content']['variations'];
        // return $result['content']['varations'];
    }


    public function get_tv_subscription(){
        $user_id = Auth::user()->id;
        $wallet = Wallet::where('user_id',$user_id)->first();
        $discount = Discount::where('discount',2)->first();
        $agent = Discount::where('discount',6)->first();
        $vendor = Discount::where('discount',7)->first();
        $title = "TV Subscription";
        $showmax = $this->get_variation_s_max();
        
        return view('users.main.tv_subscription', compact('wallet','discount','agent', 'vendor','title','showmax'));  
    }


public function get_variation_dstv(){
    $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, "https://sandbox.vtpass.com/api/service-variations?serviceID=dstv");
    // live
    curl_setopt($ch, CURLOPT_URL, "https://api-service.vtpass.com/api/service-variations?serviceID=dstv");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($response,true);
    // live
    return $result['content']['variations'];
    // return $result['content']['varations'];
}

public function get_variation_gotv(){
    $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, "https://sandbox.vtpass.com/api/service-variations?serviceID=gotv");
    // live
    curl_setopt($ch, CURLOPT_URL, "https://api-service.vtpass.com/api/service-variations?serviceID=gotv");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($response,true);
    // live
    return $result['content']['variations'];
    // return $result['content']['varations'];
}



    public function get_tvs_subscription(Request $request){
       
        $rules = [
            'smartcard_number' => 'required',
            // 'quantity'    => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {  
            return response([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ],400);
        }

        if($request->type == 'dstv'){
            $serviceId = 'dstv';
            $cardnumber = $request->smartcard_number;
            $variate = $this->get_variation_dstv();
        }

        if($request->type == 'gotv'){
            $serviceId = 'gotv';
            $cardnumber = $request->smartcard_number;
            $variate = $this->get_variation_gotv();
        }

        $get_details = ApiSetting::where('type','vtpass')->first();
        $api_key = $get_details->api_key;
        $public_key = $get_details->public_key;
        $secret_key = $get_details->secret_key;  
        $username = $get_details->email;
        $password = $get_details->password;
        // $url = "https://sandbox.vtpass.com/api/merchant-verify";
        $url = "https://api-service.vtpass.com/api/merchant-verify";
       
        $day = Carbon::now()->format('d');
        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');
        $hour = Carbon::now()->format('H');
        $min = Carbon::now()->format('i');
        $d = $year.$month.$day.$hour.$min;
      $arr = [
        'serviceID' =>  $serviceId,
        'billersCode' => $cardnumber,
      ];
    $curl = curl_init();
    $headers  = [
        'Content-Type: multipart/form-data',
        'Username:'. $username,
        'Password:'. $password,
        'api-key:'. $api_key,
        // 'public-key:'.$public_key,
        'secret-key:'.$secret_key
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
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $arr,
      CURLOPT_HTTPHEADER => $headers
    ));
    
    $response = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($response,true);
    if(count($result['content']) > 1){
        $data['username'] = $result['content']['Customer_Name'];
        $data['bouquet'] = $result['content']['Current_Bouquet'];
        $data['card'] = $cardnumber;
        return response([
            'success' => true,
            'data' => $data,
            'variation' => $variate,
        ],200);
    }
    else{
        $data['error'] =$result['content']['error']; 
        return response([
            'success' => false,
            'data' =>$data
        ],200);
    }




       
    }


    public function get_tvs_subscription_pay(Request $request){
        $user_id = Auth::user()->id;
        $rules = [
            'type' => 'required',
            'phone_number'    => 'required|numeric|digits:11',
            'subscription_type' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {  
            return response([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ],400);
        }

         // check if wallet is empty of less
        $wall = Wallet::where('user_id',$user_id)->first();
        if(empty($wall) || $wall->wallet == 0 || $wall->wallet < $request->t_amount){
            return response([
                'success' => 402,
                'errors' => 'You Have Insufficent Balance'
            ],402);  
        }


        if($request->service == 'dstv'){
            $serviceId = 'dstv';
            $cardnumber = $request->smartcard_number;
            $variation_code = $request->type;
            $subscription_type = $request->subscription_type;
            $phone = $request->phone_number;
        }

        if($request->service == 'gotv'){
            $serviceId = 'gotv';
            $cardnumber = $request->smartcard_number;
            $variation_code = $request->type;
            $subscription_type = $request->subscription_type;
            $phone = $request->phone_number;
        }


    $get_details = ApiSetting::where('type','vtpass')->first();
    $api_key = $get_details->api_key;
    $public_key = $get_details->public_key;
    $secret_key = $get_details->secret_key; 
    $username = $get_details->email;
    $password = $get_details->password;
    // $url = "https://sandbox.vtpass.com/api/pay";
    $url = "https://api-service.vtpass.com/api/pay";
    $day = Carbon::now()->format('d');
    $month = Carbon::now()->format('m');
    $year = Carbon::now()->format('Y');
    $hour = Carbon::now()->format('H');
    $min = Carbon::now()->format('i');
    $id = $year.$month.$day.$hour.$min.$this->incrementalHash();
    if($request->amount == null){
        $arr = [
            'request_id' => $id,
            'serviceID' => $serviceId,
            'billersCode' =>$cardnumber,
            'variation_code' => $variation_code,
            // 'quantity' =>2,
            // 'amount' =>$request->amount,
            'subscription_type' => $subscription_type,
            'phone' => $phone,
          ];
    }else{
        $arr = [
            'request_id' => $id,
            'serviceID' => $serviceId,
            'billersCode' => $cardnumber,
            'variation_code' => $variation_code,
            // 'quantity' =>2,
            'amount' =>$request->amount,
            'subscription_type' => $subscription_type,
            'phone' => $phone,
          ];
    }
 
$curl = curl_init();
$headers  = [
    'Content-Type: multipart/form-data',
    'Username:'. $username,
    'Password:'. $password,
    'api-key:'. $api_key,
    // 'public-key:'.$public_key,
    'secret-key:'.$secret_key
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
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $arr,
  CURLOPT_HTTPHEADER => $headers
));

$response = curl_exec($curl);
curl_close($curl);
$result = json_decode($response,true);
$data['code'] = $result['code'];
// handle error
if($data['code'] == '011'){
$data['status'] = $result['response_description'];
return response([
    'success' => false,
    'data' =>$data
],200);
}
else{
$data['product_name'] = $result['content']['transactions']['product_name'];
$data['transactionId'] = $result['content']['transactions']['transactionId'];
$data['amount'] = $result['amount'];
$data['status'] = $result['response_description'];
$data['date'] = $result['transaction_date']['date'];
$p_tran = Purchase::create([
    'product_name' => $data['product_name'],
    'transaction_id' => $data['transactionId'],
    'amount' => $request->t_amount,
    'user_id' => $user_id,
    'type' => $serviceId,
    'status' => $data['status'],
    'date' => $data['date'],
    'real_amount' => $data['amount'],
    'phone_number' =>$request->phone_number,

]);
$sub_fund = $wall->wallet - $p_tran->amount;
Wallet::where('user_id',$user_id)->update([
                "wallet" => $sub_fund
            ]);
       
return response([
    'success' => true,
    // 'data' => $data
],200);

    }


    }

    public function incrementalHash($length = 6){
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[random_int(0, $charactersLength - 1)];
            }
            return $randomString;
    }

    public function hunt_code(){
          $title = "Point Generator";
        return view('users.main.hunt', compact('title')); 
    }

    public function save_code(Request $request){
        $code = $request->code; 
        $chk_code = DB::table('check_code')->where('code',$code)->first();

        if(!empty($chk_code)){
        return response([
            'status' => false,
            'data'=>'Code has been used'],
            400);
        }
        else{
            $chk_code = DB::table('hunt')->where('code',$code)->first();
            if(empty($chk_code)){
                return response([
                    'status' => false,
                    'data'=>'Invaild Code']
                    ,400);
            }
            DB::table('check_code')->insert([
                'code' => $request->code,
                // 'point' =>$request->point
            ]);
            return response(['data'=>$chk_code],200);
        }

    }

    public function get_coupon($length = 32){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        $code = $randomString;
        return response(['data'=>$code],200);
    }

}
