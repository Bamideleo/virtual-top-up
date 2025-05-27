<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Wallet;
use App\Models\Transaction;
use App\Models\Discount;
use App\Models\Purchase;
use App\Models\ApiSetting;
use App\Models\EpinsHistory;
use App\Models\User;
use Carbon\Carbon;
Use Auth;
use DB;

class EpinsController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');
  }


  // Epins Balance Section 

   public function incrementalHash($length = 8){
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return  'wp-'.$randomString;
}

public function tsepin(){
    $title = "Buy Electricity";
  return view('users.main.epin',compact('title'));
}


// Epins Data Section

public function epins_airtime(Request $request){
 $user_id = Auth::user()->id;
        $rules = [
            'phone_no' => 'required|numeric|digits:11',
            'amount'    => 'required|numeric',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {  
            return response([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ],400);
        }

                // check if wallet is empty of less
                if($request->free_bonus == 1){
                    $amount = 100;
                }
                else{
                  $amount = $request->amount;
                  $wall = Wallet::where('user_id',$user_id)->first();
                  if(empty($wall) || $wall->wallet == 0 || $wall->wallet < $request->t_amount){
                      return response([
                          'success' => 402,
                          'errors' => 'You Have Insufficent Balance'
                      ],402);  
                  }

                }
       
        

$get_details = ApiSetting::where('type','epin')->first();
$api_key = $get_details->api_key;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "https://api.epins.com.ng/v2/autho/airtime/");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array(
"apikey" => $api_key,
"network" => $request->network,
"phone" => $request->phone_no,
"amount" =>$amount,
"ref"  => $this->incrementalHash()
  )));
  $response = curl_exec($ch);
  curl_close($ch);
  $result = json_decode($response,true);
if(!empty($result)){
  if($result['code'] == 105){
    return response([
      'success' =>false,
      'data' => $result
  ],200);
  }



  if($result['code'] == 102){
    return response([
      'success' =>false,
      'data' =>$result
  ],200);
  }

  $data['status'] = $result['description']['response_description'];
  $data['amount'] = $result['description']['amount'];
  $data['ref'] = $result['description']['ref'];
  $data['date'] = $result['description']['transaction_date'];
//   $p_tran = EpinsHistory::create([
//         'transaction_id' => $data['ref'],
//         'amount' => $request->t_amount,
//         'user_id' => $user_id,
//         'type' => $request->network,
//         'status' => $data['status'],
//         'date' => $data['date'],
//         'real_amount' => $data['amount'],
//         'phone_number' => $request->phone_no,
//       ]);
      
     $p_tran = Purchase::create([
    //   'product_name' => $data['product_name'],
      'transaction_id' => $data['ref'],
      'amount' => $request->t_amount,
      'user_id' => $user_id,
      'type' =>$request->network,
      'status' => $data['status'],
      'date' => $data['date'],
      'real_amount' => $data['amount'],
      'phone_number' =>$request->phone_no,
  
  ]);

  if($request->free_bonus == 1){
   User::where('id', $user_id)->update([
    'giveway' => 0
   ]);
}
     
      $sub_fund = $wall->wallet - $p_tran->amount;
      Wallet::where('user_id',$user_id)->update([
        "wallet" => $sub_fund
    ]);
    
     $cash_back = Auth::user()->cashback + $request->cash_back;
    User::where('id',$user_id)->update([
        "cashback" => $cash_back
        ]);
    
    return response([
        'success' =>true,
        // 'data' => $result
    ],200);

}
else{
  return response([
    'success' =>false,
    // 'data' => $result
],200);
}





}


public function get_total_amount(Request $request){
  $id = $request->type;
  $data = DB::table('networks')->where('var_code',$id)->first();
  return response([
    'success' =>true,
    'data' =>$data
],200);
}


public function get_epins_data(Request $request){
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

  // return response([
  //   'success' => 402,
  //   'data' =>$request->all(),
  // ],402);

  if($request->free_bonus == 1){
if($request->plan == 2000 || $request->plan ==211 || $request->plan == '2g' || $request->plan == 'glo-dg-500' || $request->plan == 'airt-500x' || $request->plan == 24 || $request->plan == 13 || $request->plan == 'eti-1200'){
  // check if wallet is empty or less
  $wall = Wallet::where('user_id',$user_id)->first();
if(empty($wall) || $wall->wallet == 0 || $wall->wallet < 500 ){
return response([
  'success' => 402,
  'errors' => 'You Have Insufficent Balance'
],402);  
}
}else{
  return response([
    'success' => 402,
    'errors' => 'Please select 2GB from your plan'
  ],402);
}

  }
  else{
// check if wallet is empty or less
$wall = Wallet::where('user_id',$user_id)->first();
if(empty($wall) || $wall->wallet == 0 || $wall->wallet < $request->t_amount){
return response([
  'success' => 402,
  'errors' => 'You Have Insufficent Balance'
],402);  
}

if($request->t_amount == 0){
  return response([
    'success' => 402,
    'errors' => 'Amount to pay must not be zero'
  ],402);
}
  }



  $service = $request->service_variation ;
  $number = $request->phone_no;
  $dp = $request->plan;

    if($service == 01){
        $network = 'mtn';
    }
    
     if($service == 02){
        $network = 'Glo';
    }
    
    if($service == 03){
        $network = '9Mobile';
    }
    
    if($service == 04){
        $network = 'Airtel';
    }



// Epins Api Section 
$get_details = ApiSetting::where('type','epin')->first();
$api_key = $get_details->api_key;
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "https://api.epins.com.ng/v2/autho/data/");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array(
"apikey" =>$api_key,
"service" => $service,
"MobileNumber" =>$number,
"DataPlan" => $dp,
"ref" => $this->incrementalHash()

  )));
  $response = curl_exec($ch);
  curl_close($ch);
  $result = json_decode($response,true);
  
if(!empty($result)){
  if($result['code'] == 105){
    return response([
      'success' =>false,
  ],200);
  }
  else{
     if($result['code'] == 102){
    return response([
      'success' =>false,
  ],200);
  } 
  $data['status'] = $result['description']['Status'];
// $data['productname'] = $result['description']['ProductName'];
// $data['network'] = $result['description']['Network'];
$data['ref'] = $result['description']['TransactionRef'];
$data['date'] = $result['description']['Date'];
 if($request->free_bonus == 1){
  if($request->plan == 2000 || $request->plan ==211 || $request->plan == '2g' || $request->plan == 'glo-dg-500' || $request->plan == 'airt-500x' || $request->plan == 24 || $request->plan == 13 || $request->plan == 'eti-1200'){
  $chk_bonus = User::where('free_bonus',0)->where('paid_back_bonus',0)->first();
  if(!empty($chk_bonus)){
    return response([
      'success' => 402,
      'errors' => 'Your 2GB Bonus Has Expire'
    ],402);
  }
    $f_bonus = $request->t_amount;
  }else{
    return response([
      'success' => 402,
      'errors' => 'Please select 2GB from your plan'
    ],402);
  }
 }
 else{
  $f_bonus = $request->t_amount;
 }
  $p_tran = Purchase::create([
      'product_name' => $service,
      'transaction_id' => $data['ref'],
      'amount' => $f_bonus,
      'user_id' => $user_id,
      'type' =>$network,
      'status' => $data['status'],
      'date' => $data['date'],
      'phone_number' =>$request->phone_no,
      // 'wallet_balance' => $wall->wallet,
  
  ]);

  if($free_bonus == 1){
    if($request->plan == 2000 || $request->plan ==211 || $request->plan == '2g' || $request->plan == 'glo-dg-500' || $request->plan == 'airt-500x' || $request->plan == 24 || $request->plan == 13 || $request->plan == 'eti-1200'){
      $sub_fund = $wall->wallet - $p_tran->amount;
      Wallet::where('user_id',$user_id)->update([
        "wallet" => $sub_fund
    ]);
    User::where('id',$user_id)->update([
      "free_bonus" => 0
      ]);
    }else{
      return response([
        'success' => 402,
        'errors' => 'Please select 2GB from your plan'
      ],402);
    }
  }

  else{
    $sub_fund = $wall->wallet - $p_tran->amount;
    Wallet::where('user_id',$user_id)->update([
      "wallet" => $sub_fund
  ]);
  }
    
  
    $cash_back = Auth::user()->cashback + $request->cash_back;
    User::where('id',$user_id)->update([
        "cashback" => $cash_back
        ]);
  return response([
      'success' =>true,
    //   'data' => $result
  ],200);
  }

}
else{
  return response([
      'success' =>false,
  ],200);
}


}



// public function get_epins_data(Request $request){
//   $user_id = Auth::user()->id;
//   $rules = [
//       'data_type' => 'required',
//       'plan' => 'required',
//       'phone_no' => 'required|numeric|digits:11',
//   ];
//   $validator = Validator::make($request->all(), $rules);

//   if ($validator->fails()) {  
//       return response([
//           'success' =>false,
//           'errors' => $validator->getMessageBag()->toArray()
//       ],400);
//   }

// // check if wallet is empty of less
// $wall = Wallet::where('user_id',$user_id)->first();
// if(empty($wall) || $wall->wallet == 0 || $wall->wallet < $request->t_amount){
// return response([
//   'success' => 402,
//   'errors' => 'You Have Insufficent Balance'
// ],402);  
// }


//   $service = $request->service_variation ;
//   $number = $request->phone_no;
//   $dp = $request->plan;
  
//     if($service == 1){
//         $network = 'mtn';
//     }
    
//      if($service == 2){
//         $network = 'Glo';
//     }
    
//     if($service == 3){
//         $network = '9Mobile';
//     }
    
//     if($service == 4){
//         $network = 'Airtel';
//     }



// // Epins Api Section 
// $get_details = ApiSetting::where('type','epin')->first();
// $api_key = $get_details->public_key;
//  $arr = [
//  "network"=>$service,
// "mobile_number" =>$number,
// "plan" =>$dp,
// "Ported_number" =>true

//   ];
// $curl = curl_init();
// curl_setopt_array($curl, array(
//   CURLOPT_URL => 'https://www.maskawasub.com/api/data/',
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_SSL_VERIFYHOST => 0,
//   CURLOPT_SSL_VERIFYPEER => 0,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'POST',
//   CURLOPT_POSTFIELDS => json_encode($arr),

//   CURLOPT_HTTPHEADER => array(
//     "Authorization: Token".$api_key,
//     "Content-Type: application/json"
//   ),
// ));

// $response = curl_exec($curl);
// curl_close($curl);
// $result = json_decode($response);
  
// if(!empty($result)){
// //   if($result['code'] == 105){
// //     return response([
// //       'success' =>false,
// //   ],200);
// //   }

// // $data['status'] = $result->Status;
// // $data['network'] = $result->plan_network;
// // $data['plan_amount'] = $result->plan_amount;
// // $data['ref'] = $result->ident;
// // $data['date'] = $result->create_date;
// // $data['productname'] = $result->plan_name;
// //   $p_tran = Purchase::create([
// //       'product_name' => $data['productname'],
// //       'transaction_id' => $data['ref'],
// //       'amount' => $request->t_amount,
// //       'user_id' => $user_id,
// //       'type' =>$data['network'],
// //       'status' => $data['status'],
// //       'date' => $data['date'],
// //       'phone_number' =>$request->phone_no,
// //   'real_amount' => $data['amount'],
// //   ]);

// //     $sub_fund = $wall->wallet - $p_tran->amount;
// //     Wallet::where('user_id',$user_id)->update([
// //       "wallet" => $sub_fund
// //   ]);
//   return response([
//       'success' =>true,
//       'data' => $result
//   ],200);


// }
// else{
//   return response([
//       'success' =>false,
//   ],200);
// }


// }


public function get_datahub(Request $request){
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
  $get_details = ApiSetting::where('type','apihub')->first();
  $api_key = $get_details->api_key;
   

$client = new \GuzzleHttp\Client();
$response = $client->request('POST', 'https://gladtidingsapihub.com/api/data/', [
         'headers' => [
          'Authorization' => $api_key,
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

if($data['status'] =='failed'){
    return response([
      'success' =>false,
  ],200);
}

$sub_fund = $wall->wallet - $request->t_amount;
Wallet::where('user_id',$user_id)->update([
  "wallet" => $sub_fund
]);
Purchase::create([
  'product_name' => $data['productname'],
  'transaction_id' => $data['ref'],
  'amount' => $request->t_amount,
  'user_id' => $user_id,
  // 'type' => $serviceId,
  'type' =>$data['network'],
  'status' => $data['status'],
  'date' => $data['date'],
  'real_amount' => $data['amount'],
  'phone_number' =>$request->phone_no,

]);

return response([
  'success' =>true,
  // 'data' => $result
],200);
   
}



}
