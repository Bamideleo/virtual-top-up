<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
use DB;

class FrontendController extends Controller
{
  
    public function index(){
        return view('index');
    }

    public function about_page(){
        return view('about');
    }

    public function Testimonials(){
        return view('testimonial');
    }

    public function contact_page(){
        return view('contact');
    }
    
//vpay webhook section start 
public function vpay_webhook(){
     header('Content-Type: application/json');
    $input = @file_get_contents("php://input");
    $res = json_decode($input, true);
    $ref_id = $res["reference"];
    $session_id = $res["session_id"];
    $amount = $res["amount"];
    $account_number = $res["account_number"];
    $originator_account_number = $res["originator_account_number"];
    $originator_account_name = $res["originator_account_name"];
    $originator_bank = $res["originator_bank"];
    $timestamp = $res["timestamp"];
    
    $chk_hook = DB::table('webhook')->where('session_id',$session_id)->first();
    
    if(!empty($chk_hook)){
       echo 'already exist';
         exit();
    }
    else{
     DB::table('webhook')->insert([
         'reference' => $ref_id,
         'session_id' => $session_id,
         'amount' =>  $amount,
         'account_number' => $account_number,
         'originator_account_number' => $originator_account_number,
         'originator_account_name' => $originator_account_name,
         'originator_bank' =>  $originator_bank,
         'timestamp' => $timestamp
         ]);
        $user_id = User::where('account_number_1',$account_number)->first();
        $commission = Discount::where('discount',3)->first();
        if($amount >= 10000){
           $chk_user_bonus = User::where('account_number_1',$account_number)->where('paid_back_bonus',1)->first();
           $chk_no_transaction = Transaction::where('user_id',$chk_user_bonus->id)->count();
           if($chk_no_transaction <= 23){

            $t_amt = $amount -  $commission->code; 

           }
           else{
            if($chk_no_transaction == 23){
            User::where('account_number_1',$account_number)->update(
               [
                'paid_back_bonus'=> 0
               ]
            );
            }
            $t_amt = $amount;
            
           }
           
        }
        else{
           $chk_bonus = User::where('account_number_1',$account_number)->where('paid_back_bonus',1)->first();
           $chk_no_trans = Transaction::where('user_id',$chk_bonus->id)->count();
           if($chk_no_trans <= 23){

            $t_amt = $amount - $commission->code; 

           }
           else{
            if($chk_no_trans == 23){
                User::where('account_number_1',$account_number)->update(
                   [
                    'paid_back_bonus'=> 0
                   ]
                );
                }
            $t_amt = $amount - $commission->code;

           }
             
        }
        
         $wallet = Wallet::where('user_id',$user_id->id)->first();
        if(empty($wallet)){
            Wallet::create([
                "user_id" =>$user_id->id,
                "wallet" => $t_amt
            ]);
        }
        else{
            $sub = $wallet->wallet + $t_amt;
            Wallet::where('user_id',$user_id->id)->update([
                "wallet" => $sub
            ]);
        }
        
        Transaction::create([
            'user_id' => $user_id->id,
            'fullname' =>$user_id->first_name .' '. $user_id->last_name,
            'email' => $user_id->email,
            'type' => 'vpay',
            'amount' => $t_amt,
            'reference' => $ref_id
        ]);
    //         $email = "";
    //         $name = $user_id->first_name .' '. $user_id->last_name;
    //       $dat=['name'=>$name,'email'=>$email, 'amount'=>$amount];
    //        //  for sending mail
    //      Mail::send('users.main.vpay_template',  $dat, function ($message) use ($email,$amount,$name)  {
                        
    //        $message->from('support@waveplus.com.ng', $name = "WavePlus");
    //         $message->subject("Vpay Purchase Info", $name = null);
    //         $message->to($email, $name = null);
            
       
    // });
        
        echo 'credited';
         exit(); 
    }
    
   
    
    
}

}
