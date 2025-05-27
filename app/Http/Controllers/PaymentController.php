<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Transaction;
use App\Models\Transfer;
use App\Models\ApiSetting;
use App\Models\Discount;
use App\Models\Purchase;
use Session;
use Paystack;
use Auth;
use Config;
use DB;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function credit_wallet(){
        $user_id = Auth::user()->id;
        $wallet = Wallet::where('user_id',$user_id)->first();
        $charges =  Discount::where('discount',3)->first();
         $title = "Credit Wallet";
        return view('users.main.credit_wallet',compact('wallet','charges','title'));
    }
    public function share_wallet(){
        $user_id = Auth::user()->id;
        $wallet = Wallet::where('user_id',$user_id)->first();
        $charges =  Discount::where('discount',3)->first();
        $title = "Share Wallet";
        return view('users.main.share_wallet',compact('wallet','charges','title'));
    }

    public function share_balance(Request $request){
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        // check if the receiver exist
        $user = User::where('email',$request->email)->first();
        if(empty($user)){
            Session::flash("success","Email Does Not Exist On Our Platform"); 
            return back(); 
        }
        
      
        // check if wallet is empty of less
        $wall = Wallet::where('user_id',$user_id)->first();
        if(empty($wall) || $wall->wallet == 0 || $wall->wallet < $request->t_amount){
            Session::flash("success","You Have Insufficent Balance"); 
            return back();    
        }
        Transaction::create([
            'user_id' => $user->id,
            'fullname' => $user->first_name .' '. $user->last_name,
            'email' => $request->email,
            'type' => 'Shared',
            'amount' => $request->t_amount,
            'reference' => 'wp-'. $this->incrementalHash(),
            'giver_id' => $user_id
        ]);
        $wallet = Wallet::where('user_id',$user->id)->first();
        if(empty($wallet)){
            Wallet::create([
                "user_id" => $user->id,
                "wallet" => $request->t_amount
            ]);
            $sub_fund = $wall->wallet - $request->t_amount;
            Wallet::where('user_id',$user_id)->update([
                "wallet" => $sub_fund
            ]);
            
        if( $user_email == $request->email){
            $sub_fund = $wall->wallet + $request->t_amount;
            Wallet::where('user_id',$user_id)->update([
                "wallet" => $sub_fund
            ]);
        }
            

        }
        else{
            $sub = $wallet->wallet + $request->t_amount;
            Wallet::where('user_id',$user->id)->update([
                "wallet" => $sub
            ]);
            $sub_fund = $wall->wallet - $request->t_amount;
            Wallet::where('user_id',$user_id)->update([
                "wallet" => $sub_fund
            ]);
        }
        Session::flash("success","Transaction successfully"); 
        return back();

    }
// ###  Paystack Section  ###
// Important Note Go to this path   vendor\guzzlehttp\guzzle\src\Handler\CurlFactory.php $conf[CURLOPT_SSL_VERIFYHOST] = 2; $conf[CURLOPT_SSL_VERIFYPEER] = true; at the else condition when on live
public function incrementalHash($length = 8){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        $api = ApiSetting::where('user_id',2)->first();
        $public_key = $api->public_key;
        $secret_key =  $api->secret_key;
        return $randomString;
}

    public function redirectToGateway(Request $request)
    {
        $rules = [
            'amount'    => 'required|numeric',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {  
            return back()->withErrors($validator)->withInput();     
        }
       $user = Auth::user()->email;
       $first_name = Auth::user()->first_name;
       $last_name= Auth::user()->last_name;
       $code = 'wp-'. $this->incrementalHash();
       $amount = $request->amount;
       $total_amount = $amount * 100;
        $data = array(
            "amount" => $total_amount,
            "reference" => $code,
            "email" => $user,
            "first_name" =>$first_name,
            "last_name" => $last_name,
            "currency" => "NGN",
            // "orderID" => 23456,
        );
      
        try{
            return Paystack::getAuthorizationUrl($data)->redirectNow(); 
        }catch(\Exception $e) {
            return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }        
    }

    public function handleGatewayCallback()
    {
        $id = Auth::user()->id;
        $paymentDetails = Paystack::getPaymentData();
        $amount = $paymentDetails['data']['amount'];
        $reference = $paymentDetails['data']['reference'];
        $email = $paymentDetails['data']['customer']['email'];
        $tt_amt = $amount / 100;
        $charges =  Discount::where('discount',3)->first();
        $r_up = round(($tt_amt * $charges->code) / 100);
        $t_amt = $tt_amt - $r_up;
        $user = User::where('email',$email)->first();
        Transaction::create([
            'user_id' => $id,
            'fullname' => $user->first_name .' '. $user->last_name,
            'email' => $email,
            'type' => 'paystack',
            'amount' => $t_amt,
            'reference' => $reference
        ]);
        $chk_transaction = Transaction::where('reference',$reference)->first();
        if(!empty($chk_transaction)){
            echo 'already exist';
            exit();
        }
        else{
            $wallet = Wallet::where('user_id',$id)->first();
        if(empty($wallet)){
            Wallet::create([
                "user_id" => $id,
                "wallet" => $t_amt
            ]);
        }
        else{
            $sub = $wallet->wallet + $t_amt;
            Wallet::where('user_id',$id)->update([
                "wallet" => $sub
            ]);
        }
        Session::flash("success","Payment successfully"); 
        return redirect('/credit-wallet');
        }  
    }


// ###  Transfer Section  ###

public function payByTransfer(Request $request){
    $id = Auth::user()->id;
    $rules = [
        'reference_name'    => 'required',
        'amount'    => 'required|numeric',     
    ];
    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {  
        return response([
            'success' => false,
            'errors' => $validator->getMessageBag()->toArray()
        ],400);
    }
    
    Transfer::create([
        "user_id" => $id,
        "fullname" => $request->reference_name,
        "amount" => $request->amount,
        "type" => 1
    ]);


    return response([
        'success' => true
    ],200);
    
}


public function payment_history(){
    $user_id = Auth::user()->id;
    $data = Transaction::where('user_id',$user_id)->orderBy('id','desc')->paginate(10);
    $title = "Payment History";
    return view('users.main.payment_history',compact('data','title'));  
}

public function transfer_history(){
    $user_id = Auth::user()->id;
    $data = Transaction::where('giver_id',$user_id)->orderBy('id','desc')->paginate(10);
    $title = "Transfer History";
    return view('users.main.transfer_history',compact('data','title')); 
}

public function purchase_history(){
    $user_id = Auth::user()->id;
    $data = Purchase::where('user_id', $user_id)->orderBy('id','desc')->paginate(10);
    $title = "Purchase History";
    return view('users.main.purchase_history',compact('data','title'));  
}

public function edit_history($id){
    $data = Purchase::where('id',$id)->first();
    $title = "Invoice";
    return view('users.main.invoice',compact('data','title'));
}







// Test Api
//  public function vtpass_balance(){
//     $api_key = "8b65001c9b6f0af182d8bff0dc3e1157";
//     $public_key = "PK_3970a0ee5a5bf8c36839f3cf3a58b07ca9b0c201570";
//     // $secret_key = "SK_323eb0470547dbad71105436b0bd851b72c4d86069e";
//     $url = "https://sandbox.vtpass.com/api/balance";
   
// $curl = curl_init();
// $headers  = [
//     'Content-Type: multipart/form-data',
//     'api-key:'. $api_key,
//     'public-key:'.$public_key
// ];
// curl_setopt_array($curl, array(
//   CURLOPT_URL => $url,
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_SSL_VERIFYHOST => 0,
//   CURLOPT_SSL_VERIFYPEER => 0,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'GET',
// //   CURLOPT_POSTFIELDS => $arr,
//   CURLOPT_HTTPHEADER => $headers
// ));

// $response = curl_exec($curl);
// curl_close($curl);
// $result = json_decode($response,true);
// dd($result); 
// }

// public function buy_airtime_api_vtpass(Request $request){
//     $api_key = "8b65001c9b6f0af182d8bff0dc3e1157";
//     $public_key = "PK_3970a0ee5a5bf8c36839f3cf3a58b07ca9b0c201570";
//     $secret_key = "SK_323eb0470547dbad71105436b0bd851b72c4d86069e";
//     $url = "https://sandbox.vtpass.com/api/pay";
//     $day = Carbon::now()->format('d');
//     $month = Carbon::now()->format('m');
//     $year = Carbon::now()->format('Y');
//     $hour = Carbon::now()->format('H');
//     $min = Carbon::now()->format('i');
//     $d = $year.$month.$day.$hour.$min;
//   $arr = [
//     'request_id' => $d.'YUs83meikd',
//     'serviceID' => 'mtn',
//     'amount' => 400,
//     'phone' => '08011111111'
//   ];
// $curl = curl_init();
// $headers  = [
//     'Content-Type: multipart/form-data',
//     'api-key:'. $api_key,
//     // 'public-key:'.$public_key,
//     'secret-key:'.$secret_key
// ];
// curl_setopt_array($curl, array(
//   CURLOPT_URL => $url,
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_SSL_VERIFYHOST => 0,
//   CURLOPT_SSL_VERIFYPEER => 0,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'POST',
//   CURLOPT_POSTFIELDS => $arr,
//   CURLOPT_HTTPHEADER => $headers
// ));

// $response = curl_exec($curl);
// curl_close($curl);
// $result = json_decode($response,true);
// // $data['product_name'] = $result['content']['transactions']['product_name'];
// // $data['transactionId'] = $result['content']['transactions']['transactionId'];
// // $data['amount'] = $result['amount'];

// }

public function test_api(){

// Your Paystack secret key
$secretKey = 'sk_test_0bfb39b5034f90f80f9f490a59991cbcaae081e4';


$amount = 100000; // Amount in kobo (NGN 10,000)
$email = 'customer@example.com'; // Customer's email
$reference = uniqid(); // Unique transaction reference

// Set the Paystack API endpoint
$paystackUrl = 'https://api.paystack.co/transaction/initialize';

// Create an array with the payment data
$data = [
    'amount' => $amount,
    'email' => $email,
    'reference' => $reference,
];

// Initialize cURL session
// $ch = curl_init($paystackUrl);
$curl = curl_init();
// Set cURL options

curl_setopt_array($curl, array(
    CURLOPT_URL => $paystackUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_SSL_VERIFYHOST => 0,
    CURLOPT_SSL_VERIFYPEER => 0,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => json_encode($data),
    CURLOPT_HTTPHEADER => [
        'Authorization: Bearer ' . $secretKey,
        'Content-Type: application/json',
    ]
  ));


// Execute the cURL request
$response = curl_exec($curl);

// Close the cURL session
curl_close($curl);

// Check for errors
// if ($response === false) {
//     die('cURL Error: ' . curl_error($ch));
// }


$responseData = json_decode($response, true);
if ($responseData && $responseData['status'] && $responseData['status'] === true) {
    $paymentUrl = $responseData['data']['authorization_url'];
    header('Location: ' . $paymentUrl);
    exit;
} else {
    die('Payment initiation failed: ' . $responseData['message']);
}

}




public function test_api_o(){
  
    $api_key = "8b65001c9b6f0af182d8bff0dc3e1157";
    $public_key = "PK_3970a0ee5a5bf8c36839f3cf3a58b07ca9b0c201570";
    $secret_key = "SK_323eb0470547dbad71105436b0bd851b72c4d86069e";
$username = "oluwabukolaoluwaseun@gmail.com";
$password = "Bami@seun24";
    $url = "https://sandbox.vtpass.com/api/pay";
    $day = Carbon::now()->format('d');
    $month = Carbon::now()->format('m');
    $year = Carbon::now()->format('Y');
    $hour = Carbon::now()->format('H');
    $min = Carbon::now()->format('i');
    $d = $year.$month.$day.$hour.$min;
  $arr = [
    'request_id' => $d.'YUs83meikd',
    'serviceID' => 'ikeja-electric',
    'billersCode' => '1111111111111',
    'variation_code' => 'prepaid',
    'amount' => 1000,
    'phone' => '081230000000'
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
dd($result);

}




public function pay_api(Request $request){
    $user_id = Auth::user()->id;
    $chk_api = ApiSetting::where('user_id',$user_id)->where('type','vtpass-soundbox')->first();
    $api_key = $chk_api->api_key;
    $public_key = $chk_api->public_key;
    $secret_key = $chk_api->secret_key;
    $username = $chk_api->email;
    $password = $chk_api->password;
    $url = "https://sandbox.vtpass.com/api/pay";
    $day = Carbon::now()->format('d');
    $month = Carbon::now()->format('m');
    $year = Carbon::now()->format('Y');
    $hour = Carbon::now()->format('H');
    $min = Carbon::now()->format('i');
    $d = $year.$month.$day.$hour.$min;
    if($request->id == 'exam'){
        $arr = [
            'request_id' => $d.'YUs83meikd',
            'variation_code' => 'waecdirect',
            'amount' => 900,
            'serviceID' => 'waec',
            'phone' => '08011111111',
          ];
    }elseif($request->id == 'showmax'){
        $arr = [
            'request_id' => $d.'YUs83mfikd',
            'serviceID' => 'showmax',
            'billersCode' => '08011111111',
            'variation_code' => 'full',
            'amount' => 900,
            'phone' => '08011111111',
          ];
}elseif($request->id == 'dstv' || $request->id == 'gotv' || $request->id == 'startimes'){
    if($request->id == 'dstv'){
        $cable = 'dstv';
        $code = 'dstv10';
        $_id = $d.'YUs83muikc';
    }

    if($request->id == 'gotv'){
        $cable = 'gotv';
        $code = 'gotv-lite';
        $_id = $d.'YUs83muild';
    }

    if($request->id == 'startimes'){
        $cable = 'startimes';
        $code = 'nova';
        $_id = $d.'YUs83muikd';
    }

    $arr = [
        'request_id' => $_id,
        'serviceID' => $cable,
        'billersCode' => '1212121212',
        'variation_code' => $code,
        'subscription_type' => 'change',
        'amount' => 900,
        'phone' => '08011111111',
      ];
}else{

    if($request->id == 'ikeja-electric'){
        $bill = 'ikeja-electric';
        $_id = $d.'YUs83mznkd';
    }

    if($request->id == 'eko-electric'){
        $bill = 'eko-electric';
        $_id = $d.'YUs83pinkd';
    }

    if($request->id == 'kano-electric'){
        $bill = 'kano-electric';
        $_id = $d.'YUs83mrnkd';
    }

    if($request->id == 'portharcourt-electric'){
        $bill = 'portharcourt-electric';
        $_id = $d.'YUs83tinkd';
    }

    if($request->id == 'jos-electric'){
        $bill = 'jos-electric';
        $_id = $d.'YUs83hinkd';
    }

    if($request->id == 'ibadan-electric'){
        $bill = 'ibadan-electric';
        $_id = $d.'YUs83monkd';
    }

    if($request->id == 'kaduna-electric'){
        $bill = 'kaduna-electric';
        $_id = $d.'YUs83minkd';
    }

    if($request->id == 'abuja-electric'){
        $bill = 'abuja-electric';
        $_id = $d.'YUs83milkd';
    }

    if($request->id == 'enugu-electric'){
        $bill = 'enugu-electric';
        $_id = $d.'YUs83miikd';
    }

    if($request->id == 'benin-electric'){
        $bill = 'benin-electric';
        $_id = $d.'YUs83moikd';
    }
    if($request->id == 'aba-electric'){
        $bill = 'aba-electric';
        $_id = $d.'YUs83mrikd';
    }
    
    $arr = [
        'request_id' => $_id,
        'serviceID' => $bill,
        'billersCode' => '1111111111111',
        'variation_code' => 'prepaid',
        'amount' => 1000,
        'phone' => '081230000000'
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

return response([
    'data'=>$result['requestId']
]);

}




// public function mon(){

//      // Define your Monnify API credentials
//      $apiKey = 'YOUR_API_KEY';
//      $secretKey = 'YOUR_SECRET_KEY';
     
//      // Make a request to the Monnify API
//      $client = new Client();
//      $response = $client->request('POST', 'https://sandbox.monnify.com/api/v1/transaction/initialize', [
//          'headers' => [
//              'Content-Type' => 'application/json',
//              'Authorization' => "Basic " . base64_encode($apiKey . ":" . $secretKey),
//          ],
//          'json' => [
//              'amount' => 1000, // Set the payment amount
//              'currencyCode' => 'NGN', // Set the currency code
//              // Add any other required parameters based on the Monnify API documentation
//          ],
//      ]);
//      // Process the API response
//      $statusCode = $response->getStatusCode();
//      $body = $response->getBody()->getContents();
     
//      // Return the response to the client
//      return $body;


// }


public function connect_vpay(Request $request){
    $id = Auth::user()->id;
    $get_details = ApiSetting::where('type','vpay')->first();
     $publickey = $get_details->public_key;
      $rules = [
            'phone_number'    => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

         if ($validator->fails()) {  
            return response([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ],400);
         }
     sleep(10);
     $token = $this->get_token();
     $client = new \GuzzleHttp\Client();
     
     $response = $client->request('POST', 'https://services2.vpay.africa/api/service/v1/query/customer/add', [
         'headers' => [
             'Content-Type' => 'application/json',
             'publicKey' => $publickey,
             'b-access-token' =>$token,
         ],
         'json' => [
             'email' =>Auth::user()->email, // Set the payment amount
             'phone' => $request->phone_number,
             'contactfirstname' => Auth::user()->first_name,
             'contactlastname' => Auth::user()->last_name,
         ],
     ]);
     
    $body = $response->getBody()->getContents();
    $result = json_decode($body, true);
    
    $res_customer = $client->request('GET', 'https://services2.vpay.africa/api/service/v1/query/customer/'.$result['id'] .'/show', [
        'headers' => [
            'Content-Type' => 'application/json',
            'publicKey' => $publickey,
            'b-access-token' =>$token,
        ],
    ]);
    
     $body =  $res_customer->getBody()->getContents();
     $result_cus = json_decode($body, true);
     
     User::where('id', $id)->update([
         
         'account_number_1' =>$result_cus['virtualaccounts'][0]['nuban'],
         'bank_name_1' =>  $result_cus['virtualaccounts'][0]['bank'],
          'phone_no' => $request->phone_number
         ]);
    
      return response([
                'success' => true,
            ],200);
}

public function get_token(){
    
    $get_details = ApiSetting::where('type','vpay')->first();
    $publickey = $get_details->public_key;
    $client = new \GuzzleHttp\Client();
     $response = $client->request('POST', 'https://services2.vpay.africa/api/service/v1/query/merchant/login', [
         'headers' => [
             'Content-Type' => 'application/json',
             'publicKey' => $publickey,
         ],
         'json' => [
             'username' => $get_details->email, 
             'password' => $get_details->password, 
            
         ],
     ]);  

     $body = $response->getBody()->getContents();
     $result = json_decode($body, true);

     return $result['token'];
}


// public function vpay_webhook(){
    
//      header('Content-Type: application/json');
//     $input = @file_get_contents("php://input");
//     $res = json_decode($input, true);
//     dd($res);
//     $ref_id = $res["reference"];
//     $session_id = $res["session_id"];
//     $amount = $res["amount"];
//     $account_number = $res["account_number"];
//     $originator_account_number = $res["originator_account_number"];
//     $originator_account_name = $res["originator_account_name"];
//     $originator_bank = $res["originator_bank"];
//     $timestamp = $res["timestamp"];
    
//     $chk_hook = DB::table('webhook')->where('session_id',$session_id)->first();
    
//     if(!empty($chk_hook)){
//        echo 'already exist';
//          exit();
//     }
//     else{
//      DB::table('webhook')->insert([
//          'reference' => $ref_id,
//          'session_id' => $session_id,
//          'amount' =>  $amount,
//          'account_number' => $account_number,
//          'originator_account_number' => $originator_account_number,
//          'originator_account_name' => $originator_account_name,
//          'originator_bank' =>  $originator_bank,
//          'timestamp' => $timestamp
//          ]);
//         $user_id = User::where('account_number_1',$account_number)->first();
//          $t_amt = $amount - 50;
//          $wallet = Wallet::where('user_id',$user_id->id)->first();
//         if(empty($wallet)){
//             Wallet::create([
//                 "user_id" =>$user_id->id,
//                 "wallet" => $t_amt
//             ]);
//         }
//         else{
//             $sub = $wallet->wallet + $t_amt;
//             Wallet::where('user_id',$user_id->id)->update([
//                 "wallet" => $sub
//             ]);
//         }
//         echo 'credited';
//          exit(); 
//     }  
// }


public function send_message(){
    $title = "Contact Support";
    return view('users.main.notification',compact('title'));   
}

public function send_notification(Request $request){
    $rules = [
        'subject'    => 'required',
        'message'    => 'required',     
    ];
    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {  
        return back()->withErrors($validator)->withInput();        
    }
    $data = [
        'subject' => $request->subject,
        'message' => $request->message,
        'user_name' => Auth::user()->first_name,
    ];
    DB::table('notifications')->insert($data);

    Session::flash("success","Message Send Successfully"); 
    return back();
}


}
