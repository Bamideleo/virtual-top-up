<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Cookie;
use App\Models\User;
use App\Models\Admin;
use App\Models\ApiSetting;
use Hash;
Use Auth;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    //     $this->middleware('guest:admin')->except('logout');
    // }


    public function showAdminLoginForm()
    {
        return view('adminauth.login', ['url' => route('admin.login-view'), 'title'=>'Admin']);
    }

    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
       

        if (\Auth::guard('admin')->attempt($request->only(['email','password']), $request->get('remember'))){
            return redirect()->intended('/admin/dashboard');
        }

        return back()->withInput($request->only('email', 'remember'));
    }


    public function create_user(Request $request,User $user){ 

        $code =  $this->generateRandom();

        $cookie = Cookie::get('referral');
        $point  = 0;
        $referred_by = $cookie ? \Hashids::decode($cookie)[0] : null;
      
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_nummber'=>'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
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

        $get_details = ApiSetting::where('type','vpay')->first();
        $publickey = $get_details->public_key;
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
             'email' =>$request->email, // Set the payment amount
             'phone' => $request->phone_number,
             'contactfirstname' => $request->first_name,
             'contactlastname' =>  $request->last_name,
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

        if(empty($referred_by)){
            $referal = $request->last_name .'-'.$code;
       $new_id = User::create(
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'type'  => 1,
                'referal_point' =>  $point,
                'username' =>  $referal,
                'password' => Hash::make($request->password),
                'free_bonus' => 1,
                'paid_back_bonus' => 1,
                'account_number_1' =>$result_cus['virtualaccounts'][0]['nuban'],
                'bank_name_1' =>  $result_cus['virtualaccounts'][0]['bank'],
                'phone_no' => $request->phone_number
            ]
        );
        
        Session::flash("success","Registration successfully"); 
        return redirect('/login');
        }
        else{
            $point = 50;
            $point_2 = 50;
            $data = User::find($referred_by);
            if($data->agent == 1){
                $point = 100;
            }
            if($data->vendor == 1){
                $point = 150;
            }
            if($data->agent == 1 && $data->vendor == 1){
                $point = 200;
            }
           
            $total_point = $point + $data->referal_point;
            if($data){
                $data->update([
                    'referal_point' => $total_point,  
                ]);
            }
         $referal = $request->last_name .'-'.$code;
       $new_id = User::create(
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'type'  => 1,
                'referal_point' => $point_2,
                'referal_id' => $referred_by,
                'username' =>  $referal,
                'password' => Hash::make($request->password),
                'free_bonus' => 1,
                'paid_back_bonus' => 1,
                'account_number_1' =>$result_cus['virtualaccounts'][0]['nuban'],
                'bank_name_1' =>  $result_cus['virtualaccounts'][0]['bank'],
                'phone_no' => $request->phone_number
            ]
        );
        Session::flash("success","Registration successfully"); 
        return redirect('/login');
        }
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

    public function Logout(){
    $this->middleware('guest')->except('logout');
    Session::flush();
    return redirect('login');
    }

    public function adminLogout(){
    $this->middleware('guest:admin')->except('logout');
    Session::flush();
    return redirect('/admin'); 
}


public function  get_tokenn(){
    $key = ApiSetting::where('user_id',2)->where('type','monnify')->first();
   
    $monnifyApi = $key->public_key;
    $monnifySecret = $key->secret_key;
    $accessKey = "$monnifyApi:$monnifySecret";
	$apiKey = base64_encode($accessKey);
    $url = 'https://api.monnify.com/api/v1/auth/login';
    // $url = "https://sandbox.monnify.com/api/v1/auth/login";
    // $curl = curl_init();
    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0,
        CURLOPT_HTTPHEADER => array(
            "Authorization: Basic {$apiKey}",
        ),
    ));
    $json = curl_exec($ch);
    $result = json_decode($json);
    curl_close($ch);
    return $result->responseBody->accessToken;


    //  return $body;


}

public function get_ref($length = 8){

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }

    return 'wp-'.$randomString;
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


public function reset_admin_password(){
    return view('auth.adminpassword.email');
}

public function send_reset_link(Request $request){
    $rules = [
        'email' => 'required',        
    ];
    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();           
    }

    $chk = Admin::where('email', $request->email)->first();
    if(empty($chk)){

        Session::flash("success","Email Does Not Exist"); 
        return back();
    }
    $input=['link'=>route('admin.reset-link')];

    dd($input);
    Mail::send('admin.main.reset_password', $input, function ($message) use ($link) {
                  
        $message->from('support@waveplus.com', $name = "Boltware");
        $message->subject("Reset Link", $name = null);
        $message->to($email, $name = null); 
});

Session::flash("success","Pls check your inbox or spam folder for reset link"); 
 return back();


}

public function reset_admin_link(){
    return view('auth.adminpassword.reset');
}

public function update_pasword(Request $request){
    $rules = [
        'email' => 'required',   
        'password' => 'required',        
    ];
    $validator = Validator::make($request->all(), $rules);

    $chk = Admin::where('email', $request->email)->first();

    if(empty($chk)){
        Session::flash("success","Email Does Not Exist"); 
    }

    Admin::where('email', $request->email)->update([
        'password' => Hash::make($request->password),
    ]);

    Session::flash("success","Password Reset Sucessfully"); 
    return redirect()->route('admin.login-view');
}

}