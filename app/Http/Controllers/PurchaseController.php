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
use Mail;
use DB;



class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


public function get_variation_startime(){
    $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, "https://sandbox.vtpass.com/api/service-variations?serviceID=startimes");
    // live
    curl_setopt($ch, CURLOPT_URL, "https://api-service.vtpass.com/api/service-variations?serviceID=startimes");
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


    public function verify_star_show(Request $request){
        $rules = [
            'smartcard_number' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {  
            return response([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ],400);
        }

        if($request->type == 'startimes'){
            $serviceId = 'startimes';
            $cardnumber = $request->smartcard_number;
            $variate = $this->get_variation_startime();
        }

        if($request->type == 'showmax'){
            $serviceId = 'showmax';
            $cardnumber = $request->smartcard_number;
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
    'serviceID' =>   $serviceId,
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
    // dd($result);
    $data['username'] = $result['content']['Customer_Name'];
    $data['balance'] = $result['content']['Balance'];
    $data['card_nummber'] = $result['content']['Smartcard_Number'];

    return response([
        'success' => true,
        'data' => $data,
        'variation' => $variate,
    ],200);
    
}
else{
    $data = $result['content']['error']; 
    return response([
        'success' => false,
        'data' => $data,
    ],200);
}


    }

public function pay_star_show(Request $request){
    $user_id = Auth::user()->id;
    $rules = [
        'type' => 'required',
        'phone_number'    => 'required|numeric|digits:11',
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
    if($request->amount == null){
        $arr = [
            'request_id' => $id,
            'serviceID' => 'startimes',
            'billersCode' => $request->smartcard_number,
            'variation_code' => $request->type,
            'phone' => $request->phone_number,
          ];
    }
    else{

        $arr = [
            'request_id' => $id,
            'serviceID' => 'startimes',
            'billersCode' => $request->smartcard_number,
            'variation_code' => $request->type,
            'phone' => $request->phone_number,
            'amount' => $request->t_amount,
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
    // 'type' => $serviceId,
    'type' =>' startimes',
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
                // 'data' => $result,
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

    public function showmax(Request $request){

        $user_id = Auth::user()->id;
        $rules = [
            'type' => 'required',
            'phone_number'    => 'required|numeric|digits:11',
        ];
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {  
            return response([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ],400);
        }


        if($request->type == 'full'){
            $amount = 2900;
        }

        if($request->type == 'mobile_only'){
            $amount = 1450;
        }

        if($request->type == 'sports_full'){
            $amount = 6300;
        }

        if($request->type == 'sports_mobile_only'){
            $amount = 3200;
        }

          // check if wallet is empty of less
          $wall = Wallet::where('user_id',$user_id)->first();
          if(empty($wall) || $wall->wallet == 0 || $wall->wallet < $amount){
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
            'serviceID' => 'showmax',
            'billersCode' => $request->phone_number,
            'variation_code' => $request->type,
            'phone' => $request->phone_number,
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
$data['t_amount'] = $result['content']['transactions']['total_amount'];
$data['amount'] = $result['amount'];
$data['status'] = $result['response_description'];
$data['date'] = $result['transaction_date']['date'];
$p_tran = Purchase::create([
    'product_name' => $data['product_name'],
    'transaction_id' => $data['transactionId'],
    'amount' => $data['t_amount'],
    'user_id' => $user_id,
    // 'type' => $serviceId,
    'type' =>' startimes',
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
                // 'data' => $result,
            ],200);
            

    }



    }
    public function electricity_bill(){
        $user_id = Auth::user()->id;
        $wallet = Wallet::where('user_id',$user_id)->first();
        $discount = Discount::where('discount',2)->first();
        $agent = Discount::where('discount',6)->first();
        $vendor = Discount::where('discount',7)->first();
        $electric_bill = 1;
        $title = "Buy Electricity";
        return view('users.main.electricity', compact('wallet','electric_bill','discount','agent','vendor','title')); 
    }


    public function eko_electric(){
        $user_id = Auth::user()->id;
        $wallet = Wallet::where('user_id',$user_id)->first();
        $discount = Discount::where('discount',2)->first();
        $electric_bill = 2;
        $title = "Buy Electricity";
        return view('users.main.electricity', compact('wallet','electric_bill','discount','title')); 
    }


    public function kano_electric(){
        $user_id = Auth::user()->id;
        $wallet = Wallet::where('user_id',$user_id)->first();
        $discount = Discount::where('discount',2)->first();
         $agent = Discount::where('discount',6)->first();
        $vendor = Discount::where('discount',7)->first();
        $electric_bill = 3;
        $title = "Buy Electricity";
        return view('users.main.electricity', compact('wallet','electric_bill','discount','agent','vendor','title')); 
    }

    public function harcourt_electric(){
        $user_id = Auth::user()->id;
        $wallet = Wallet::where('user_id',$user_id)->first();
        $discount = Discount::where('discount',2)->first();
         $agent = Discount::where('discount',6)->first();
        $vendor = Discount::where('discount',7)->first();
        $electric_bill = 4;
        $title = "Buy Electricity";
        return view('users.main.electricity', compact('wallet','electric_bill','discount','agent','vendor','title')); 
    }

    public function jos_electric(){
        $user_id = Auth::user()->id;
        $wallet = Wallet::where('user_id',$user_id)->first();
        $discount = Discount::where('discount',2)->first();
         $agent = Discount::where('discount',6)->first();
        $vendor = Discount::where('discount',7)->first();
        $electric_bill = 5;
        $title = "Buy Electricity";
        return view('users.main.electricity', compact('wallet','electric_bill','discount','agent','vendor','title')); 
    }

    public function ibadan_electric(){
        $user_id = Auth::user()->id;
        $wallet = Wallet::where('user_id',$user_id)->first();
        $discount = Discount::where('discount',2)->first();
        $agent = Discount::where('discount',6)->first();
        $vendor = Discount::where('discount',7)->first();
        $electric_bill = 6;
        $title = "Buy Electricity";
        return view('users.main.electricity', compact('wallet','electric_bill','discount','agent','vendor','title')); 
    }

    public function kaduna_electric(){
        $user_id = Auth::user()->id;
        $wallet = Wallet::where('user_id',$user_id)->first();
        $discount = Discount::where('discount',2)->first();
         $agent = Discount::where('discount',6)->first();
        $vendor = Discount::where('discount',7)->first();
        $electric_bill = 7;
        $title = "Buy Electricity";
        return view('users.main.electricity', compact('wallet','electric_bill','discount','agent','vendor','title')); 
    }

    public function abuja_electric(){
        $user_id = Auth::user()->id;
        $wallet = Wallet::where('user_id',$user_id)->first();
        $discount = Discount::where('discount',2)->first();
         $agent = Discount::where('discount',6)->first();
        $vendor = Discount::where('discount',7)->first();
        $electric_bill = 8;
        $title = "Buy Electricity";
        return view('users.main.electricity', compact('wallet','electric_bill','discount','agent','vendor','title')); 
    }

    public function benin_electric(){
        $user_id = Auth::user()->id;
        $wallet = Wallet::where('user_id',$user_id)->first();
        $discount = Discount::where('discount',2)->first();
         $agent = Discount::where('discount',6)->first();
        $vendor = Discount::where('discount',7)->first();
        $electric_bill = 9;
        $title = "Buy Electricity";
        return view('users.main.electricity', compact('wallet','electric_bill','discount','agent','vendor','title')); 
    }


    public function enugu_electric(){
        $user_id = Auth::user()->id;
        $wallet = Wallet::where('user_id',$user_id)->first();
        $discount = Discount::where('discount',2)->first();
         $agent = Discount::where('discount',6)->first();
        $vendor = Discount::where('discount',7)->first();
        $electric_bill = 10;
        $title = "Buy Electricity";
        return view('users.main.electricity', compact('wallet','electric_bill','discount','agent','vendor','title')); 
    }


    










    public function verify_meter(Request $request){
        $user_id = Auth::user()->id;
        $rules = [
            'meter_type' => 'required',
            'meter_number'    => 'required|numeric',
        ];
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {  
            return response([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ],400);
        }
      
        // if($request->type == 1){
            $serviceId = $request->service;
            $meter_number = $request->meter_number;
            $meter_type = $request->meter_type;
        // }

    $get_details = ApiSetting::where('type','vtpass')->first();
    $api_key = $get_details->api_key;
    $public_key = $get_details->public_key;
    $secret_key = $get_details->secret_key;  
    $username = $get_details->email;
    $password = $get_details->password;
    // $url = "https://sandbox.vtpass.com/api/merchant-verify";
    $url = "https://api-service.vtpass.com/api/merchant-verify";
      
      $arr = [
        'serviceID' => $serviceId,
        'billersCode' =>  $meter_number,
        'type' => $meter_type,
      ];
    $curl = curl_init();
    $headers  = [
        'Content-Type: multipart/form-data',
        'Username:'. $username,
        'Password:'. $password,
        'api-key:'. $api_key,
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





    if($request->type == 4){
        if(count($result['content']) > 1){
            $data['username'] = $result['content']['Customer_Name'];
            $data['meter_no'] = $result['content']['MeterNumber'];
            $data['address'] = $result['content']['Address'];
            $data['meter_type'] = $meter_type;
            return response([
                'success' => true,
                'data' => $data,
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
    elseif($request->type == 10){
        if(count($result['content']) > 1){
            $data['username'] = $result['content']['Customer_Name'];
            $data['meter_no'] = $result['content']['Meter_Number'];
            // $data['address'] = $result['content']['Address'];
            $data['meter_type'] = $meter_type;
            return response([
                'success' => true,
                'data' => $data,
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
    else{

        if(count($result['content']) > 1){
            $data['username'] = $result['content']['Customer_Name'];
            $data['meter_no'] = $result['content']['Meter_Number'];
            $data['address'] = $result['content']['Address'];
            $data['meter_type'] = $meter_type;
            return response([
                'success' => true,
                'data' => $data,
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

   

    }

public function pay_electric_bill(Request $request){

    $user_id = Auth::user()->id;
    $email =  Auth::user()->email;
    $rules = [
        'amount' => 'required',
        'phone_number'    => 'required|numeric|digits:11',
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
      if(empty($wall) || $wall->wallet == 0 || $wall->wallet < $request->amount){
          return response([
              'success' => 402,
              'errors' => 'You Have Insufficent Balance'
          ],402);  
      }



        $serviceId = $request->service;
        $meter_number = $request->meter_number;
        $meter_type = $request->meter_type;
        $amount = $request->amount;
        $phone_number = $request->phone_number;



$get_details = ApiSetting::where('type','vtpass')->first();
$api_key = $get_details->api_key;
$public_key = $get_details->public_key;
$secret_key = $get_details->secret_key; 
$username = $get_details->email;
$password = $get_details->password;
    $url = "https://api-service.vtpass.com/api/pay";
$day = Carbon::now()->format('d');
$month = Carbon::now()->format('m');
$year = Carbon::now()->format('Y');
$hour = Carbon::now()->format('H');
$min = Carbon::now()->format('i');
$id = $year.$month.$day.$hour.$min.$this->incrementalHash();

    $arr = [
        'request_id' => $id,
        'variation_code' =>  $meter_type,
        'amount' => $amount ,
        'serviceID' => $serviceId,
        'billersCode' => $meter_number,
        'phone' =>  $phone_number,
      ];

$curl = curl_init();
$headers  = [
'Content-Type: multipart/form-data',
'Username:'. $username,
'Password:'. $password,
'api-key:'. $api_key,
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
if($request->type == 1){
    if($data['code'] == '016'){
        $data['status'] = $result['response_description'];
        return response([
            'success' => 402,
            'data' =>$data
        ],200);
        }
        
        if($data['code'] == '013'){
        $data['status'] = $result['response_description'];
        return response([
            'success' => 402,
            'data' =>$data
        ],200);
        }
        else{
        
            if($request->meter_type == 'prepaid'){
        $data['product_name'] = $result['content']['transactions']['product_name'];
        $data['transactionId'] = $result['content']['transactions']['transactionId'];
        $data['purchased_code'] = $result['purchased_code'];
        $data['amount'] = $result['amount'];
        $data['customerName'] = $result['customerName'];
        $data['status'] = $result['response_description'];
        $data['date'] = $result['transaction_date']['date'];
        $data['customerAddress'] = $result['customerAddress'];
        $data['units'] = $result['units'];
        $data['phase'] = $result['tariff'];
        $p_tran = Purchase::create([
            'product_name' => $data['product_name'],
            'transaction_id' => $data['transactionId'],
            'amount' => $data['amount'],
            'user_id' => $user_id,
            'type' => 'Electricity-prepaid',
            'status' => $data['status'],
            'date' => $data['date'],
            'token' => $data['purchased_code'],
            'units' => $data['units'],
            'phase' => $data['phase'],
            'customerName' => $data['customerName'],
            'customerAddress' => $data['customerAddress'],
            'real_amount' =>$request->ts_amount,
            'phone_number' =>$request->phone_number,
        
        ]);
        
        $sub_fund = $wall->wallet - $p_tran->amount;
        Wallet::where('user_id',$user_id)->update([
                        "wallet" => $sub_fund
                    ]);
                    
                    
        $token = $data['purchased_code'];
        $status = $data['status'];
        $type = 'Electricity-prepaid';
        $inputs=['email'=>$email,'token'=>$token ,'status'=>$status, 'type'=>$type]; 
        
        Mail::send('users.main.template',  $inputs, function ($message) use ($token,$status,$type,$email)  {
                        
                        $message->from('support@waveplus.com.ng', $name = "Waveplus");
                         $message->subject("Here is Your Token", $name = null);
                         $message->to($email, $name = null);
                         
                    
                 });
               
        return response([
            'success' => true,
            // 'data' => $data,
        ],200);
            }
            else{
        
        
        $data['product_name'] = $result['content']['transactions']['product_name'];
        $data['transactionId'] = $result['content']['transactions']['transactionId'];
        $data['amount'] = $result['amount'];
        $data['customerName'] = $result['customerName'];
        $data['status'] = $result['response_description'];
        $data['date'] = $result['transaction_date']['date'];
        $data['customerAddress'] = $result['customerAddress'];
        $data['utilityname'] = $result['utilityName'];
        $p_tran = Purchase::create([
            'product_name' => $data['product_name'],
            'transaction_id' => $data['transactionId'],
            'amount' => $data['amount'],
            'user_id' => $user_id,
            'type' => 'Electricity-postpaid',
            'status' => $data['status'],
            'date' => $data['date'],
            'token' => $data['utilityname'],
            'customerName' => $data['customerName'],
            'customerAddress' => $data['customerAddress'],
            'real_amount' =>$request->ts_amount,
            'phone_number' =>$request->phone_number,
        
        ]);
        
        $sub_fund = $wall->wallet - $p_tran->amount;
        Wallet::where('user_id',$user_id)->update([
                        "wallet" => $sub_fund
                    ]);
               
        return response([
            'success' => true,
            // 'data' => $data,
        ],200);
        
        
        
            }
            }
}


if($request->type == 2){

    if($data['code'] == '016'){
        $data['status'] = $result['response_description'];
        return response([
            'success' => 402,
            'data' =>$data
        ],200);
        }
        
        if($data['code'] == '013'){
        $data['status'] = $result['response_description'];
        return response([
            'success' => 402,
            'data' =>$data
        ],200);
        }
        else{
        
            if($request->meter_type == 'prepaid'){
        $data['product_name'] = $result['content']['transactions']['product_name'];
        $data['transactionId'] = $result['content']['transactions']['transactionId'];
        $data['purchased_code'] = $result['purchased_code'];
        $data['amount'] = $result['amount'];
        $data['customerName'] = $result['customerName'];
        $data['status'] = $result['response_description'];
        $data['date'] = $result['transaction_date']['date'];
        $data['mainToken'] = $result['mainToken'];
        $data['units'] = $result['mainTokenUnits'];
        $p_tran = Purchase::create([
            'product_name' => $data['product_name'],
            'transaction_id' => $data['transactionId'],
            'amount' => $data['amount'],
            'user_id' => $user_id,
            'type' => 'Electricity-prepaid',
            'status' => $data['status'],
            'date' => $data['date'],
            'purchase_code' => $data['purchased_code'],
            'units' => $data['units'],
            'token' => $data['mainToken'],
            'customerName' => $data['customerName'],
            // 'customerAddress' => $data['customerAddress'],
            'real_amount' =>$request->ts_amount,
            'phone_number' =>$request->phone_number,
        
        ]);
        
        $sub_fund = $wall->wallet - $p_tran->amount;
        Wallet::where('user_id',$user_id)->update([
                        "wallet" => $sub_fund
                    ]);
                    
                    
             $token = $data['purchased_code'];
        $status = $data['status'];
        $type = 'Electricity-prepaid';
        $inputs=['email'=>$email,'token'=>$token ,'status'=>$status, 'type'=>$type]; 
        
        Mail::send('users.main.template',  $inputs, function ($message) use ($token,$status,$type,$email)  {
                        
                        $message->from('support@waveplus.com.ng', $name = "Waveplus");
                         $message->subject("Here is Your Token", $name = null);
                         $message->to($email, $name = null);
                         
                    
                 });
               
        return response([
            'success' => true,
            // 'data' => $data,
        ],200);
            }
            else{   
        $data['product_name'] = $result['content']['transactions']['product_name'];
        $data['transactionId'] = $result['content']['transactions']['transactionId'];
        $data['amount'] = $result['amount'];
        $data['customerName'] = $result['customerName'];
        $data['status'] = $result['response_description'];
        $data['date'] = $result['transaction_date']['date'];
        // $data['customerAddress'] = $result['customerAddress'];
        // $data['utilityname'] = $result['utilityName'];
        $p_tran = Purchase::create([
            'product_name' => $data['product_name'],
            'transaction_id' => $data['transactionId'],
            'amount' => $data['amount'],
            'user_id' => $user_id,
            'type' => 'Electricity-postpaid',
            'status' => $data['status'],
            'date' => $data['date'],
            // 'token' => $data['utilityname'],
            'customerName' => $data['customerName'],
            // 'customerAddress' => $data['customerAddress'],
            'real_amount' =>$request->ts_amount,
            'phone_number' =>$request->phone_number,
        
        ]);
        
        $sub_fund = $wall->wallet - $p_tran->amount;
        Wallet::where('user_id',$user_id)->update([
                        "wallet" => $sub_fund
                    ]);
               
        return response([
            'success' => true,
            // 'data' => $data,
        ],200);
        
        
        
            }
            }
}


if($request->type == 3){

    if($data['code'] == '016'){
        $data['status'] = $result['response_description'];
        return response([
            'success' => 402,
            'data' =>$data
        ],200);
        }
        
        if($data['code'] == '013'){
        $data['status'] = $result['response_description'];
        return response([
            'success' => 402,
            'data' =>$data
        ],200);
        }
        else{
        
            if($request->meter_type == 'prepaid'){
        $data['product_name'] = $result['content']['transactions']['product_name'];
        $data['transactionId'] = $result['content']['transactions']['transactionId'];
        $data['purchased_code'] = $result['purchased_code'];
        $data['amount'] = $result['amount'];
        $data['customerName'] = $result['customerName'];
        $data['status'] = $result['response_description'];
        $data['date'] = $result['transaction_date']['date'];
        $data['mainToken'] = $result['token'];
        $data['units'] = $result['businessUnit'];
        $data['customerAddress'] = $result['customerAddress'];
        $p_tran = Purchase::create([
            'product_name' => $data['product_name'],
            'transaction_id' => $data['transactionId'],
            'amount' => $data['amount'],
            'user_id' => $user_id,
            'type' => 'Electricity-prepaid',
            'status' => $data['status'],
            'date' => $data['date'],
            'purchase_code' => $data['purchased_code'],
            'units' => $data['units'],
            'token' => $data['mainToken'],
            'customerName' => $data['customerName'],
            'customerAddress' => $data['customerAddress'],
            'real_amount' =>$request->ts_amount,
            'phone_number' =>$request->phone_number,
        
        ]);
        
        $sub_fund = $wall->wallet - $p_tran->amount;
        Wallet::where('user_id',$user_id)->update([
                        "wallet" => $sub_fund
                    ]);
                    
         $token = $data['purchased_code'];
        $status = $data['status'];
        $type = 'Electricity-prepaid';
        $inputs=['email'=>$email,'token'=>$token ,'status'=>$status, 'type'=>$type]; 
        
        Mail::send('users.main.template',  $inputs, function ($message) use ($token,$status,$type,$email)  {
                        
                        $message->from('support@waveplus.com.ng', $name = "Waveplus");
                         $message->subject("Here is Your Token", $name = null);
                         $message->to($email, $name = null);
                         
                    
                 });
               
        return response([
            'success' => true,
            // 'data' => $data,
        ],200);
            }
            else{   
        $data['product_name'] = $result['content']['transactions']['product_name'];
        $data['transactionId'] = $result['content']['transactions']['transactionId'];
        $data['amount'] = $result['amount'];
        $data['customerName'] = $result['customerName'];
        $data['status'] = $result['response_description'];
        $data['date'] = $result['transaction_date']['date'];
        $data['customerAddress'] = $result['customerAddress'];
        // $data['utilityname'] = $result['utilityName'];
        $p_tran = Purchase::create([
            'product_name' => $data['product_name'],
            'transaction_id' => $data['transactionId'],
            'amount' => $data['amount'],
            'user_id' => $user_id,
            'type' => 'Electricity-postpaid',
            'status' => $data['status'],
            'date' => $data['date'],
            // 'token' => $data['utilityname'],
            'customerName' => $data['customerName'],
            'customerAddress' => $data['customerAddress'],
            'real_amount' =>$request->ts_amount,
            'phone_number' =>$request->phone_number,
        
        ]);
        
        $sub_fund = $wall->wallet - $p_tran->amount;
        Wallet::where('user_id',$user_id)->update([
                        "wallet" => $sub_fund
                    ]);
               
        return response([
            'success' => true,
            // 'data' => $data,
        ],200);
        
        
        
            }
            }
}


if($request->type == 4){

    if($data['code'] == '016'){
        $data['status'] = $result['response_description'];
        return response([
            'success' => 402,
            'data' =>$data
        ],200);
        }
        
        if($data['code'] == '013'){
        $data['status'] = $result['response_description'];
        return response([
            'success' => 402,
            'data' =>$data
        ],200);
        }
        else{
        
            if($request->meter_type == 'prepaid'){
        $data['product_name'] = $result['content']['transactions']['product_name'];
        $data['transactionId'] = $result['content']['transactions']['transactionId'];
        $data['purchased_code'] = $result['purchased_code'];
        $data['amount'] = $result['amount'];
        $data['customerName'] = $result['customerName'];
        $data['status'] = $result['response_description'];
        $data['date'] = $result['transaction_date']['date'];
        $data['mainToken'] = $result['token'];
        $data['units'] = $result['units'];
        $data['customerAddress'] = $result['address'];
        $p_tran = Purchase::create([
            'product_name' => $data['product_name'],
            'transaction_id' => $data['transactionId'],
            'amount' => $data['amount'],
            'user_id' => $user_id,
            'type' => 'Electricity-prepaid',
            'status' => $data['status'],
            'date' => $data['date'],
            'purchase_code' => $data['purchased_code'],
            'units' => $data['units'],
            'token' => $data['mainToken'],
            'customerName' => $data['customerName'],
            'customerAddress' => $data['customerAddress'],
            'real_amount' =>$request->ts_amount,
            'phone_number' =>$request->phone_number,
        
        ]);
        
        $sub_fund = $wall->wallet - $p_tran->amount;
        Wallet::where('user_id',$user_id)->update([
                        "wallet" => $sub_fund
                    ]);
                    
         $token = $data['purchased_code'];
        $status = $data['status'];
        $type = 'Electricity-prepaid';
        $inputs=['email'=>$email,'token'=>$token ,'status'=>$status, 'type'=>$type]; 
        
        Mail::send('users.main.template',  $inputs, function ($message) use ($token,$status,$type,$email)  {
                        
                        $message->from('support@waveplus.com.ng', $name = "Waveplus");
                         $message->subject("Here is Your Token", $name = null);
                         $message->to($email, $name = null);
                         
                    
                 });
               
        return response([
            'success' => true,
            // 'data' => $data,
        ],200);
            }
            else{   
        $data['product_name'] = $result['content']['transactions']['product_name'];
        $data['transactionId'] = $result['content']['transactions']['transactionId'];
        $data['amount'] = $result['amount'];
        $data['customerName'] = $result['customerName'];
        $data['status'] = $result['response_description'];
        $data['date'] = $result['transaction_date']['date'];
        $data['customerAddress'] = $result['address'];
        // $data['utilityname'] = $result['utilityName'];
        $p_tran = Purchase::create([
            'product_name' => $data['product_name'],
            'transaction_id' => $data['transactionId'],
            'amount' => $data['amount'],
            'user_id' => $user_id,
            'type' => 'Electricity-postpaid',
            'status' => $data['status'],
            'date' => $data['date'],
            // 'token' => $data['utilityname'],
            'customerName' => $data['customerName'],
            'customerAddress' => $data['customerAddress'],
            'real_amount' =>$request->ts_amount,
            'phone_number' =>$request->phone_number,
        
        ]);
        
        $sub_fund = $wall->wallet - $p_tran->amount;
        Wallet::where('user_id',$user_id)->update([
                        "wallet" => $sub_fund
                    ]);
               
        return response([
            'success' => true,
            // 'data' => $data,
        ],200);
        
        
        
            }
            }
}


if($request->type == 5){

    if($data['code'] == '016'){
        $data['status'] = $result['response_description'];
        return response([
            'success' => 402,
            'data' =>$data
        ],200);
        }
        
        if($data['code'] == '013'){
        $data['status'] = $result['response_description'];
        return response([
            'success' => 402,
            'data' =>$data
        ],200);
        }
        else{
        
            if($request->meter_type == 'prepaid'){
        $data['product_name'] = $result['content']['transactions']['product_name'];
        $data['transactionId'] = $result['content']['transactions']['transactionId'];
        $data['purchased_code'] = $result['purchased_code'];
        $data['amount'] = $result['amount'];
        $data['customerName'] = $result['CustomerName'];
        $data['status'] = $result['response_description'];
        $data['date'] = $result['transaction_date']['date'];
        $data['mainToken'] = $result['Token'];
        $data['units'] = $result['Units'];
        $data['customerAddress'] = $result['CustomerAddress'];
        $p_tran = Purchase::create([
            'product_name' => $data['product_name'],
            'transaction_id' => $data['transactionId'],
            'amount' => $data['amount'],
            'user_id' => $user_id,
            'type' => 'Electricity-prepaid',
            'status' => $data['status'],
            'date' => $data['date'],
            'purchase_code' => $data['purchased_code'],
            'units' => $data['units'],
            'token' => $data['mainToken'],
            'customerName' => $data['customerName'],
            'customerAddress' => $data['customerAddress'],
            'real_amount' =>$request->ts_amount,
            'phone_number' =>$request->phone_number,
        
        ]);
        
        $sub_fund = $wall->wallet - $p_tran->amount;
        Wallet::where('user_id',$user_id)->update([
                        "wallet" => $sub_fund
                    ]);
               
                $token = $data['purchased_code'];
        $status = $data['status'];
        $type = 'Electricity-prepaid';
        $inputs=['email'=>$email,'token'=>$token ,'status'=>$status, 'type'=>$type]; 
        
        Mail::send('users.main.template',  $inputs, function ($message) use ($token,$status,$type,$email)  {
                        
                        $message->from('support@waveplus.com.ng', $name = "Waveplus");
                         $message->subject("Here is Your Token", $name = null);
                         $message->to($email, $name = null);
                         
                    
                 });
               
        return response([
            'success' => true,
            // 'data' => $data,
        ],200);
            }
            else{   
        $data['product_name'] = $result['content']['transactions']['product_name'];
        $data['transactionId'] = $result['content']['transactions']['transactionId'];
        $data['amount'] = $result['amount'];
        // $data['customerName'] = $result['customerName'];
        $data['status'] = $result['response_description'];
        $data['date'] = $result['transaction_date']['date'];
        // $data['customerAddress'] = $result['customerAddress'];
        // $data['utilityname'] = $result['utilityName'];
        $p_tran = Purchase::create([
            'product_name' => $data['product_name'],
            'transaction_id' => $data['transactionId'],
            'amount' => $data['amount'],
            'user_id' => $user_id,
            'type' => 'Electricity-postpaid',
            'status' => $data['status'],
            'date' => $data['date'],
            // 'token' => $data['utilityname'],
            // 'customerName' => $data['customerName'],
            // 'customerAddress' => $data['customerAddress'],
            'real_amount' =>$request->ts_amount,
            'phone_number' =>$request->phone_number,
        
        ]);
        
        $sub_fund = $wall->wallet - $p_tran->amount;
        Wallet::where('user_id',$user_id)->update([
                        "wallet" => $sub_fund
                    ]);
               
        return response([
            'success' => true,
            // 'data' => $data,
        ],200);
        
        
        
            }
            }
}


if($request->type == 6){

    if($data['code'] == '016'){
        $data['status'] = $result['response_description'];
        return response([
            'success' => 402,
            'data' =>$data
        ],200);
        }
        
        if($data['code'] == '013'){
        $data['status'] = $result['response_description'];
        return response([
            'success' => 402,
            'data' =>$data
        ],200);
        }
        else{
        
            if($request->meter_type == 'prepaid'){
        $data['product_name'] = $result['content']['transactions']['product_name'];
        $data['transactionId'] = $result['content']['transactions']['transactionId'];
        $data['purchased_code'] = $result['purchased_code'];
        $data['amount'] = $result['amount'];
        $data['customerName'] = $result['CustomerName'];
        $data['status'] = $result['response_description'];
        $data['date'] = $result['transaction_date']['date'];
        $data['mainToken'] = $result['Token'];
        $data['units'] = $result['Units'];
        $data['customerAddress'] = $result['CustomerAddress'];
        $p_tran = Purchase::create([
            'product_name' => $data['product_name'],
            'transaction_id' => $data['transactionId'],
            'amount' => $data['amount'],
            'user_id' => $user_id,
            'type' => 'Electricity-prepaid',
            'status' => $data['status'],
            'date' => $data['date'],
            'purchase_code' => $data['purchased_code'],
            'units' => $data['units'],
            'token' => $data['mainToken'],
            'customerName' => $data['customerName'],
            'customerAddress' => $data['customerAddress'],
            'real_amount' =>$request->ts_amount,
            'phone_number' =>$request->phone_number,
        
        ]);
        
        $sub_fund = $wall->wallet - $p_tran->amount;
        Wallet::where('user_id',$user_id)->update([
                        "wallet" => $sub_fund
                    ]);
                    
                 $token = $data['purchased_code'];
        $status = $data['status'];
        $type = 'Electricity-prepaid';
        $inputs=['email'=>$email,'token'=>$token ,'status'=>$status, 'type'=>$type]; 
        
        Mail::send('users.main.template',  $inputs, function ($message) use ($token,$status,$type,$email)  {
                        
                        $message->from('support@waveplus.com.ng', $name = "Waveplus");
                         $message->subject("Here is Your Token", $name = null);
                         $message->to($email, $name = null);
                         
                    
                 });
               
        return response([
            'success' => true,
            // 'data' => $data,
        ],200);
            }
            else{   
        $data['product_name'] = $result['content']['transactions']['product_name'];
        $data['transactionId'] = $result['content']['transactions']['transactionId'];
        $data['amount'] = $result['amount'];
        // $data['customerName'] = $result['customerName'];
        $data['status'] = $result['response_description'];
        $data['date'] = $result['transaction_date']['date'];
        // $data['customerAddress'] = $result['customerAddress'];
        // $data['utilityname'] = $result['utilityName'];
        $p_tran = Purchase::create([
            'product_name' => $data['product_name'],
            'transaction_id' => $data['transactionId'],
            'amount' => $data['amount'],
            'user_id' => $user_id,
            'type' => 'Electricity-postpaid',
            'status' => $data['status'],
            'date' => $data['date'],
            // 'token' => $data['utilityname'],
            // 'customerName' => $data['customerName'],
            // 'customerAddress' => $data['customerAddress'],
            'real_amount' =>$request->ts_amount,
            'phone_number' =>$request->phone_number,
        
        ]);
        
        $sub_fund = $wall->wallet - $p_tran->amount;
        Wallet::where('user_id',$user_id)->update([
                        "wallet" => $sub_fund
                    ]);
               
        return response([
            'success' => true,
            // 'data' => $data,
        ],200);
        
        
        
            }
            }
}

if($request->type == 7){

    if($data['code'] == '016'){
        $data['status'] = $result['response_description'];
        return response([
            'success' => 402,
            'data' =>$data
        ],200);
        }
        
        if($data['code'] == '013'){
        $data['status'] = $result['response_description'];
        return response([
            'success' => 402,
            'data' =>$data
        ],200);
        }
        else{
        
            if($request->meter_type == 'prepaid'){
        $data['product_name'] = $result['content']['transactions']['product_name'];
        $data['transactionId'] = $result['content']['transactions']['transactionId'];
        $data['purchased_code'] = $result['purchased_code'];
        $data['amount'] = $result['amount'];
        $data['customerName'] = $result['customerName'];
        $data['status'] = $result['response_description'];
        $data['date'] = $result['transaction_date']['date'];
        $data['mainToken'] = $result['token'];
        $data['units'] = $result['units'];
        $data['customerAddress'] = $result['customerAddress'];
        $p_tran = Purchase::create([
            'product_name' => $data['product_name'],
            'transaction_id' => $data['transactionId'],
            'amount' => $data['amount'],
            'user_id' => $user_id,
            'type' => 'Electricity-prepaid',
            'status' => $data['status'],
            'date' => $data['date'],
            'purchase_code' => $data['purchased_code'],
            'units' => $data['units'],
            'token' => $data['mainToken'],
            'customerName' => $data['customerName'],
            'customerAddress' => $data['customerAddress'],
            'real_amount' =>$request->ts_amount,
            'phone_number' =>$request->phone_number,
        
        ]);
        
        $sub_fund = $wall->wallet - $p_tran->amount;
        Wallet::where('user_id',$user_id)->update([
                        "wallet" => $sub_fund
                    ]);
                    
        $token = $data['purchased_code'];
        $status = $data['status'];
        $type = 'Electricity-prepaid';
        $inputs=['email'=>$email,'token'=>$token ,'status'=>$status, 'type'=>$type]; 
        
        Mail::send('users.main.template',  $inputs, function ($message) use ($token,$status,$type,$email)  {
                        
                        $message->from('support@waveplus.com.ng', $name = "Waveplus");
                         $message->subject("Here is Your Token", $name = null);
                         $message->to($email, $name = null);
                         
                    
                 });
               
        return response([
            'success' => true,
            // 'data' => $data,
        ],200);
            }
            else{   
        $data['product_name'] = $result['content']['transactions']['product_name'];
        $data['transactionId'] = $result['content']['transactions']['transactionId'];
        $data['amount'] = $result['amount'];
        $data['customerName'] = $result['customerName'];
        $data['status'] = $result['response_description'];
        $data['date'] = $result['transaction_date']['date'];
        $data['customerAddress'] = $result['customerAddress'];
        $data['token'] = $result['token'];
        $p_tran = Purchase::create([
            'product_name' => $data['product_name'],
            'transaction_id' => $data['transactionId'],
            'amount' => $data['amount'],
            'user_id' => $user_id,
            'type' => 'Electricity-postpaid',
            'status' => $data['status'],
            'date' => $data['date'],
            'token' => $data['token'],
            'customerName' => $data['customerName'],
            'customerAddress' => $data['customerAddress'],
            'real_amount' =>$request->ts_amount,
            'phone_number' =>$request->phone_number,
        
        ]);
        
        $sub_fund = $wall->wallet - $p_tran->amount;
        Wallet::where('user_id',$user_id)->update([
                        "wallet" => $sub_fund
                    ]);
               
        return response([
            'success' => true,
            // 'data' => $data,
        ],200);
        
        
        
            }
            }
}


if($request->type == 8){

    if($data['code'] == '016'){
        $data['status'] = $result['response_description'];
        return response([
            'success' => 402,
            'data' =>$data
        ],200);
        }
        
        if($data['code'] == '013'){
        $data['status'] = $result['response_description'];
        return response([
            'success' => 402,
            'data' =>$data
        ],200);
        }
        else{
        
            if($request->meter_type == 'prepaid'){
        $data['product_name'] = $result['content']['transactions']['product_name'];
        $data['transactionId'] = $result['content']['transactions']['transactionId'];
        $data['purchased_code'] = $result['purchased_code'];
        $data['amount'] = $result['amount'];
        $data['customerName'] = $result['Name'];
        $data['status'] = $result['response_description'];
        $data['date'] = $result['transaction_date']['date'];
        $data['mainToken'] = $result['Token'];
        $data['units'] = $result['PurchasedUnits'];
        $data['customerAddress'] = $result['Address'];
        $p_tran = Purchase::create([
            'product_name' => $data['product_name'],
            'transaction_id' => $data['transactionId'],
            'amount' => $data['amount'],
            'user_id' => $user_id,
            'type' => 'Electricity-prepaid',
            'status' => $data['status'],
            'date' => $data['date'],
            'purchase_code' => $data['purchased_code'],
            'units' => $data['units'],
            'token' => $data['mainToken'],
            'customerName' => $data['customerName'],
            'customerAddress' => $data['customerAddress'],
            'real_amount' =>$request->ts_amount,
            'phone_number' =>$request->phone_number,
        
        ]);
        
        $sub_fund = $wall->wallet - $p_tran->amount;
        Wallet::where('user_id',$user_id)->update([
                        "wallet" => $sub_fund
                    ]);
                    
         $token = $data['purchased_code'];
        $status = $data['status'];
        $type = 'Electricity-prepaid';
        $inputs=['email'=>$email,'token'=>$token ,'status'=>$status, 'type'=>$type]; 
        
        Mail::send('users.main.template',  $inputs, function ($message) use ($token,$status,$type,$email)  {
                        
                        $message->from('support@waveplus.com.ng', $name = "Waveplus");
                         $message->subject("Here is Your Token", $name = null);
                         $message->to($email, $name = null);
                         
                    
                 });
               
        return response([
            'success' => true,
            // 'data' => $data,
        ],200);
            }
            else{   
        $data['product_name'] = $result['content']['transactions']['product_name'];
        $data['transactionId'] = $result['content']['transactions']['transactionId'];
        $data['amount'] = $result['amount'];
        // $data['customerName'] = $result['customerName'];
        $data['status'] = $result['response_description'];
        $data['date'] = $result['transaction_date']['date'];
        // $data['customerAddress'] = $result['customerAddress'];
        // $data['token'] = $result['token'];
        $p_tran = Purchase::create([
            'product_name' => $data['product_name'],
            'transaction_id' => $data['transactionId'],
            'amount' => $data['amount'],
            'user_id' => $user_id,
            'type' => 'Electricity-postpaid',
            'status' => $data['status'],
            'date' => $data['date'],
            // 'token' => $data['token'],
            // 'customerName' => $data['customerName'],
            // 'customerAddress' => $data['customerAddress'],
            'real_amount' =>$request->ts_amount,
            'phone_number' =>$request->phone_number,
        
        ]);
        
        $sub_fund = $wall->wallet - $p_tran->amount;
        Wallet::where('user_id',$user_id)->update([
                        "wallet" => $sub_fund
                    ]);
               
        return response([
            'success' => true,
            // 'data' => $data,
        ],200);
        
        
        
            }
            }
}


if($request->type == 9){

    if($data['code'] == '016'){
        $data['status'] = $result['response_description'];
        return response([
            'success' => 402,
            'data' =>$data
        ],200);
        }
        
        if($data['code'] == '013'){
        $data['status'] = $result['response_description'];
        return response([
            'success' => 402,
            'data' =>$data
        ],200);
        }
        else{

     if($request->meter_type == 'prepaid'){
        $data['product_name'] = $result['content']['transactions']['product_name'];
        $data['transactionId'] = $result['content']['transactions']['transactionId'];
        $data['purchased_code'] = $result['purchased_code'];
        $data['amount'] = $result['amount'];
        // $data['customerName'] = $result['Name'];
        $data['status'] = $result['response_description'];
        $data['date'] = $result['transaction_date']['date'];
        $data['mainToken'] = $result['token'];
        $data['units'] = $result['units'];
        // $data['customerAddress'] = $result['Address'];
        $p_tran = Purchase::create([
            'product_name' => $data['product_name'],
            'transaction_id' => $data['transactionId'],
            'amount' => $data['amount'],
            'user_id' => $user_id,
            'type' => 'Electricity-prepaid',
            'status' => $data['status'],
            'date' => $data['date'],
            'purchase_code' => $data['purchased_code'],
            'units' => $data['units'],
            'token' => $data['mainToken'],
            // 'customerName' => $data['customerName'],
            // 'customerAddress' => $data['customerAddress'],
            'real_amount' =>$request->ts_amount,
            'phone_number' =>$request->phone_number,
        
        ]);
        
        $sub_fund = $wall->wallet - $p_tran->amount;
        Wallet::where('user_id',$user_id)->update([
                        "wallet" => $sub_fund
                    ]);
               
        $token = $data['purchased_code'];
        $status = $data['status'];
        $type = 'Electricity-prepaid';
        $inputs=['email'=>$email,'token'=>$token ,'status'=>$status, 'type'=>$type]; 
        
        Mail::send('users.main.template',  $inputs, function ($message) use ($token,$status,$type,$email)  {
                        
                        $message->from('support@waveplus.com.ng', $name = "Waveplus");
                         $message->subject("Here is Your Token", $name = null);
                         $message->to($email, $name = null);
                         
                    
                 });
               
        return response([
            'success' => true,
            // 'data' => $data,
        ],200);
            }
            else{   
        $data['product_name'] = $result['content']['transactions']['product_name'];
        $data['transactionId'] = $result['content']['transactions']['transactionId'];
        $data['amount'] = $result['amount'];
        // $data['customerName'] = $result['customerName'];
        $data['status'] = $result['response_description'];
        $data['date'] = $result['transaction_date']['date'];
        // $data['customerAddress'] = $result['customerAddress'];
        // $data['token'] = $result['token'];
        $p_tran = Purchase::create([
            'product_name' => $data['product_name'],
            'transaction_id' => $data['transactionId'],
            'amount' => $data['amount'],
            'user_id' => $user_id,
            'type' => 'Electricity-postpaid',
            'status' => $data['status'],
            'date' => $data['date'],
            // 'token' => $data['token'],
            // 'customerName' => $data['customerName'],
            // 'customerAddress' => $data['customerAddress'],
            'real_amount' =>$request->ts_amount,
            'phone_number' =>$request->phone_number,
        
        ]);
        
        $sub_fund = $wall->wallet - $p_tran->amount;
        Wallet::where('user_id',$user_id)->update([
                        "wallet" => $sub_fund
                    ]);
               
        return response([
            'success' => true,
            // 'data' => $data,
        ],200);
        
        
        
            }
            }
}


if($request->type == 10){

    if($data['code'] == '016'){
        $data['status'] = $result['response_description'];
        return response([
            'success' => 402,
            'data' =>$data
        ],200);
        }
        
        if($data['code'] == '013'){
        $data['status'] = $result['response_description'];
        return response([
            'success' => 402,
            'data' =>$data
        ],200);
        }
        else{

     if($request->meter_type == 'prepaid'){
        $data['product_name'] = $result['content']['transactions']['product_name'];
        $data['transactionId'] = $result['content']['transactions']['transactionId'];
        $data['purchased_code'] = $result['purchased_code'];
        $data['amount'] = $result['amount'];
        // $data['customerName'] = $result['Name'];
        $data['status'] = $result['response_description'];
        $data['date'] = $result['transaction_date']['date'];
        $data['mainToken'] = $result['token'];
        $data['units'] = $result['units'];
        // $data['customerAddress'] = $result['Address'];
        $p_tran = Purchase::create([
            'product_name' => $data['product_name'],
            'transaction_id' => $data['transactionId'],
            'amount' => $data['amount'],
            'user_id' => $user_id,
            'type' => 'Electricity-prepaid',
            'status' => $data['status'],
            'date' => $data['date'],
            'purchase_code' => $data['purchased_code'],
            'units' => $data['units'],
            'token' => $data['mainToken'],
            // 'customerName' => $data['customerName'],
            // 'customerAddress' => $data['customerAddress'],
            'real_amount' =>$request->ts_amount,
            'phone_number' =>$request->phone_number,
        
        ]);
        
        $sub_fund = $wall->wallet - $p_tran->amount;
        Wallet::where('user_id',$user_id)->update([
                        "wallet" => $sub_fund
                    ]);
                    
                     $token = $data['purchased_code'];
        $status = $data['status'];
        $type = 'Electricity-prepaid';
        $inputs=['email'=>$email,'token'=>$token ,'status'=>$status, 'type'=>$type]; 
        
        Mail::send('users.main.template',  $inputs, function ($message) use ($token,$status,$type,$email)  {
                        
                        $message->from('support@waveplus.com.ng', $name = "Waveplus");
                         $message->subject("Here is Your Token", $name = null);
                         $message->to($email, $name = null);
                         
                    
                 });
               
        return response([
            'success' => true,
            // 'data' => $data,
        ],200);
            }
            else{   
        $data['product_name'] = $result['content']['transactions']['product_name'];
        $data['transactionId'] = $result['content']['transactions']['transactionId'];
        $data['amount'] = $result['amount'];
        // $data['customerName'] = $result['customerName'];
        $data['status'] = $result['response_description'];
        $data['date'] = $result['transaction_date']['date'];
        // $data['customerAddress'] = $result['customerAddress'];
        // $data['token'] = $result['token'];
        $p_tran = Purchase::create([
            'product_name' => $data['product_name'],
            'transaction_id' => $data['transactionId'],
            'amount' => $data['amount'],
            'user_id' => $user_id,
            'type' => 'Electricity-postpaid',
            'status' => $data['status'],
            'date' => $data['date'],
            // 'token' => $data['token'],
            // 'customerName' => $data['customerName'],
            // 'customerAddress' => $data['customerAddress'],
            'real_amount' =>$request->ts_amount,
            'phone_number' =>$request->phone_number,
        
        ]);
        
        $sub_fund = $wall->wallet - $p_tran->amount;
        Wallet::where('user_id',$user_id)->update([
                        "wallet" => $sub_fund
                    ]);
               
        return response([
            'success' => true,
            // 'data' => $data,
        ],200);
        
        
        
            }
            }
}


}



public function wace_registration(){
        $user_id = Auth::user()->id;
        $wallet = Wallet::where('user_id',$user_id)->first();
        $discount = Discount::where('discount',2)->first();
        $agent = Discount::where('discount',6)->first();
        $vendor = Discount::where('discount',7)->first();
        $title = "Exams Pins";
        return view('users.main.wace_registration', compact('wallet','discount','agent','vendor','title')); 
    
} 


public function pay_wace_registration(Request $request){

    $user_id = Auth::user()->id;
    $rules = [
        'phone_number'    => 'required|numeric|digits:11',
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

      if($request->service == 'waecdirect'){
        $v_code = $request->service;
        $ser_id = $request->service_id;
        $phone = $request->phone_number;
        $amount = $request->wea_amount;
      }
      if($request->service == 'waec-registration'){
        $v_code = $request->service_id;
        $ser_id = $request->service;
        $phone = $request->phone_number;
        $amount = $request->wea_amount;
      }

      $get_details = ApiSetting::where('type','vtpass')->first();
      $api_key = $get_details->api_key;
      $public_key = $get_details->public_key;
      $secret_key = $get_details->secret_key; 
      $username = $get_details->email;
      $password = $get_details->password;
    $url = "https://api-service.vtpass.com/api/pay";
    $day = Carbon::now()->format('d');
    $month = Carbon::now()->format('m');
    $year = Carbon::now()->format('Y');
    $hour = Carbon::now()->format('H');
    $min = Carbon::now()->format('i');
    $id = $year.$month.$day.$hour.$min.$this->incrementalHash();
  $arr = [
    'request_id' => $id,
    'variation_code' => $v_code,
    // 'quantity' =>2,
    'amount' => $amount,
    // 'subscription_type' =>'change',
    'serviceID' => $ser_id,
    // 'billersCode' => '1010101010101',
    'phone' => $phone,
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

if($result == null){
    return response([
        'success' => false,
        // 'data' => $result,
    ],200);  
}
if($request->service == 'waecdirect'){
$data['product_name'] = $result['content']['transactions']['product_name'];
$data['transactionId'] = $result['content']['transactions']['transactionId'];
$data['purchased_code'] = $result['purchased_code'];
$data['amount'] = $result['amount'];
$data['status'] = $result['response_description'];
$data['date'] = $result['transaction_date']['date'];
$data['mainToken'] = $result['cards'][0]['Serial'];
$data['pin'] = $result['cards'][0]['Pin'];

$p_tran = Purchase::create([
    'product_name' => $data['product_name'],
    'transaction_id' => $data['transactionId'],
    'amount' => $request->t_amount,
    'user_id' => $user_id,
    'type' => 'waec-checker',
    'status' => $data['status'],
    'date' => $data['date'],
    'purchase_code' => $data['purchased_code'],
    'pin' => $data['pin'],
    'real_amount' =>$data['amount'],
    'serialNumber' => $data['mainToken'],
    'phone_number' =>$request->phone_number,

]);

$sub_fund = $wall->wallet - $p_tran->amount;
Wallet::where('user_id',$user_id)->update([
                "wallet" => $sub_fund
            ]);
       
return response([
    'success' => true,
    // 'data' => $result,
],200);

}
if($request->service == 'waec-registration'){

    $data['product_name'] = $result['content']['transactions']['product_name'];
    $data['transactionId'] = $result['content']['transactions']['transactionId'];
    $data['purchased_code'] = $result['purchased_code'];
    $data['amount'] = $result['amount'];
    $data['status'] = $result['response_description'];
    $data['date'] = $result['transaction_date']['date'];
    $data['mainToken'] = $result['tokens'][0];
    
    $p_tran = Purchase::create([
        'product_name' => $data['product_name'],
        'transaction_id' => $data['transactionId'],
        'amount' => $request->t_amount,
        'user_id' => $user_id,
        'type' => 'waec-registraion',
        'status' => $data['status'],
        'date' => $data['date'],
        'purchase_code' => $data['purchased_code'],
        'token' => $data['mainToken'],
        'real_amount' =>$data['amount'],
        'phone_number' =>$request->phone_number,
    
    ]);
    
    $sub_fund = $wall->wallet - $p_tran->amount;
    Wallet::where('user_id',$user_id)->update([
                    "wallet" => $sub_fund
                ]);
           
    return response([
        'success' => true,
        // 'data' => $result,
    ],200);
    


}
    

}

public function pricing(){
    $title = "Pricing";
    return view('users.main.pricing',compact('title')); 
}

public function profile(){
    $title = "Profile Setting";
    return view('users.main.profile',compact('title'));    
}

public function update_user(Request $request, $id){
    if($request->password == null){
        User::where('id',$id)->update([
                'first_name' => $request->firstname,
                'last_name' => $request->lastname,
                'address' => $request->address,
                'phone_no' => $request->phone_number,
                'email' => $request->email,
              
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
        ]);

        Session::flash("success","User Updated successfully"); 
        return back();
    }
}


}
