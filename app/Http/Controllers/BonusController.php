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

class BonusController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }



public function clam_bonus(Request $request){
    $id = $request->id;
    $type = $request->type;
    $data = User::where('id',$id)->first();
    $wall = Wallet::where('user_id',$id)->first();
     // check if referal is zero
    if($type == 0){
      return response([
        'success' => false,
        'message' =>'You Have Zero Referral Bonus.'
    ],200);  
    }
    
     // Both agent && vendor
  if($data->agent == 1  && $data->vendor == 1){
    if($type <= 5999 || $wall->wallet <= 9999){
      return response([
        'success' => false,
        'message' =>'Your Referral Bonus Must Be 5000 Or More to Claim It And Your Wallet Must Be 10000.'
    ],200);
    }
    
  }
    
    // for vendor 
    if($data->vendor == 1){
      if($type <= 2499 || $wall->wallet <= 4999){
        return response([
          'success' => false,
          'message' =>'Your Referral Bonus Must Be 2500 Or More to Claim It And Your Wallet Must Be 5000.'
      ],200);
      }
  }
  // for Agent
  if($data->agent == 1){
    if($type <= 1999 || $wall->wallet <= 3999){
      return response([
        'success' => false,
        'message' =>'Your Referral Bonus Must Be 2000 Or More to Claim It And Your Wallet Must Be 4000.'
    ],200);
    }
  }
 

// for Normal subscriber
  if($data->agent == 0  && $data->vendor == 0){
    if($type <= 499 || $wall->wallet <= 999){
      return response([
        'success' => false,
        'message' =>'Your Referral Bonus Must Be 500 Or More to Claim It And Your Wallet Must Be 1000.'
    ],200);
    }
    
  }
$ref_bonus = $wall->wallet + $type;
$data->update([
'referal_point' => 0
]);

  $wall->update([
    'wallet' => $ref_bonus
  ]);
  return response([
    'success' => true,
    'message' =>'Your Wallet Have Been Credited.'
],200);
}

public function reseller(){
  $user_id = Auth::user()->id;
  $wallet = Wallet::where('user_id',$user_id)->first();
  $title = "Reseller";
  return view('users.main.reseller',compact('wallet','title'));
}


public function upgrade_reseller(Request $request){
  $user_id = Auth::user()->id;
  $agent = $request->plan;
  $vendor = $request->plan;
  $wallet = Wallet::where('user_id',$user_id)->first();
  if(empty($wallet)){
     Session::flash("success","Please Fund Your Wallet Before Upgrade"); 
    return back();  
  }
  if($agent == 1){
 
    if( $wallet->wallet < 1500){
         Session::flash("success","You have a low wallet"); 
        return back();
    }
    User::where('id',$user_id)->update([
        'agent' => 1
        ]);
        
        $add = $wallet->wallet - 1500;
        $wallet->update([
            'wallet' => $add
            ]);
      
  }
  
  if($vendor == 2){
    if( $wallet->wallet < 2000){
         Session::flash("success","You have a low wallet"); 
        return back();
    }
    
    User::where('id',$user_id)->update([
        'vendor' => 1
        ]);
        
        $add = $wallet->wallet - 2000;
        $wallet->update([
            'wallet' => $add
            ]);
      
  }
    
  Session::flash("success","Account Upgraded successfully"); 
    return back();
}


public function cash_back(Request $request){
     $id = Auth::user()->id;
     $type = Auth::user()->cashback;
    $data = User::where('id',$id)->first();
    $wall = Wallet::where('user_id',$id)->first();
    
    // check if cashback is zero
    if($type == 0){
      return response([
        'success' => false,
        'message' =>'You Have Zero Cashback Balance.'
    ],200);  
    }
    
     // Both agent && vendor
  if($data->agent == 1  && $data->vendor == 1){
    if($type <= 1999 || $wall->wallet <= 2999){
      return response([
        'success' => false,
        'message' =>'Your Cashback Must Be 2000 Or More to Claim It And Your Wallet Must Be 3000.'
    ],200);
    }
    
  }
    // for vendor 
    if($data->vendor == 1){
      if($type <= 999 || $wall->wallet <= 1999){
        return response([
          'success' =>false,
          'message' =>'Your Cashback Must Be 1000 Or More to Claim It And Your Wallet Must Be 2000.'
      ],200);
      }
  }
  // for Agent
  if($data->agent == 1){
    if($type <= 899 || $wall->wallet <= 999){
      return response([
        'success' => false,
        'message' =>'Your Cashback Must Be 900 Or More to Claim It And Your Wallet Must Be 1000.'
    ],200);
    }
  }
 

// for Normal subscriber
  if($data->agent == 0  && $data->vendor == 0){
    if($type <= 499 || $wall->wallet <= 999){
      return response([
        'success' => false,
        'message' =>'Your Cashback Must Be 500 Or More to Claim It And Your Wallet Must Be 1000.'
    ],200);
    }
    
  }
$ref_bonus = $wall->wallet + $type;
$data->update([
'cashback' => 0
]);

  $wall->update([
    'wallet' => $ref_bonus
  ]);
  return response([
    'success' => true,
    'message' =>'Your Wallet Have Been Credited.'
],200);
}

public function coupon(Request $request){
  $id = Auth::user()->id;
  $code = Discount::where('code',$request->coupon)->first();
   if(empty($code )){
    return response([
        'success' =>false,
        'data' =>'You Enter Invalid Code'
    ],200);  
  }
  
    if($code->expire_at <= Carbon::now()){
      return response([
        'success' =>false,
        'data' =>'The code you enter has expired'
    ],200);  
    }

 $user = User::where('coupon_id',$code->id)->first();
if(empty($user)){
    User::where('id',$id)->update([
        'coupon_id' => $code->id
        ]);
        
    return response([
        'success' => true,
        'data' =>$code->coupon_amt
    ],200);
        
  }else{
     User::where('id',$id)->update([
        'coupon_id' => $code->id
        ]);
        
    return response([
        'success' => true,
        'data' =>$code->coupon_amt
    ],200);
  }
 
}

public function get_dat(Request $request){
//      return response([
//       'service' =>$request->service_variation,
//       'number' =>$request->phone_no,
//         'plan' =>$request->plan,
//   ],200);

dd('working');
    
}
    
public function glo_airtel_mobile(Request $request){
     return response([
      'service' =>$request->service_variation,
       'number' =>$request->phone_no,
        'plan' =>$request->plan,
  ],200);
    
  $user_id = Auth::user()->id;
  $rules = [
      'data_type' => 'required',
      'plan' => 'required',
      'phone_no' => 'required|numeric|digits:11',
  ];
  $validator = Validator::make($request->all(), $rules);

  if ($validator->fails()) {  
      return response([
          'success' =>false,
          'errors' => $validator->getMessageBag()->toArray()
      ],400);
  }

// // check if wallet is empty of less
$wall = Wallet::where('user_id',$user_id)->first();
if(empty($wall) || $wall->wallet == 0 || $wall->wallet < $request->t_amount){
return response([
  'success' => 402,
  'errors' => 'You Have Insufficent Balance'
],402);  
}
  $service = $request->service_variation ;
  $number = $request->phone_no;
  $dp = $request->plan;
  
   

$client = new \GuzzleHttp\Client();
$response = $client->request('POST', 'https://gladtidingsapihub.com/api/data/', [
         'headers' => [
          'Authorization' => 'Token 4e33728bf4e660dac895f87345ea93aab0a67978',
          'Content-Type' => 'application/json'
         ],
         'json' => [
          "network"=> $service,
          "mobile_number"=> $number,
          "plan"=> $dp,
          "Ported_number"=> true,
         ],
     ]);
$res = $response->getBody();
$result = json_decode($res,true);
$data['status'] = $result['Status'];
$data['productname'] = $result['plan_name'];
$data['network'] = $result['plan_network'];
$data['ref'] = $result['ident'];
$data['amount'] = $result['plan_amount'];
$data['date'] = $result['create_date'];

if($data['status'] == false){
    return response([
      'success' =>false,
  ],200);
}

Purchase::create([
  'product_name' => $data['product_name'],
  'transaction_id' => $data['ref'],
  'amount' => $request->t_amount,
  'user_id' => $user_id,
  // 'type' => $serviceId,
  'type' =>$data['network'],
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
  'success' =>true,
  // 'data' => $result
],200);
   
    
}

}
