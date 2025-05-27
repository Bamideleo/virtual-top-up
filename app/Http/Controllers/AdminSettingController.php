<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\GeneralSetting;
use App\Mail\TestEmail;
use Auth;
use DB;
use Session;

class AdminSettingController extends Controller
{

    public function get_email_smtp(){
        $data =GeneralSetting::first();
        return view('admin.main.email_setting',compact('data'));
    }

    public function save_email_data(Request $request){

        $chk_settings = GeneralSetting::first();
        if(empty($chk_settings)){
            $rules = [
                'host' => 'required',
                'port'  => 'required',
                'username'  => 'required',
                'password'  => 'required',
                'email'  => 'required',
                'sender'  => 'required',
                'encryption'  => 'required'      
            ];
            $validator = Validator::make($request->all(), $rules);
        
            if ($validator->fails()) {  
                return back()->withErrors($validator)->withInput();        
            }
    
            $data = [
                'host' => $request->host,
                'port'  => $request->port,
                'username'  => $request->username,
                'password'  => $request->password,
                'email'  => $request->email,
                'sender'  => $request->sender,
                'encryption'  => $request->encryption     
            ];
            GeneralSetting::create($data);

            $this->storeSettings('MAIL_HOST', request('host'));
        $this->storeSettings('MAIL_PORT', request('port'));
        $this->storeSettings('MAIL_USERNAME', request('username'));
        $this->storeSettings('MAIL_PASSWORD', request('password'));
        $this->storeSettings('MAIL_FROM_ADDRESS', request('email'));
        $this->storeSettings('MAIL_ENCRYPTION', request('encryption'));  

        if (config('mail.from.name') == '') {
            $newName = "'". request('username') . "'";
            $this->storeSettings('MAIL_FROM_NAME', $newName);
        } else {
            $newName = "'". request('username') . "'";
            $this->storeSettings('MAIL_FROM_NAME', $newName);
        }

            
        }else{
            $data = [
                'host' => $request->host,
                'port'  => $request->port,
                'username'  => $request->username,
                'password'  => $request->password,
                'email'  => $request->email,
                'sender'  => $request->sender,
                'encryption'  => $request->encryption     
            ];
            GeneralSetting::where('id',1)->update($data);

            $this->storeSettings('MAIL_HOST', request('host'));
            $this->storeSettings('MAIL_PORT', request('port'));
            $this->storeSettings('MAIL_USERNAME', request('username'));
            $this->storeSettings('MAIL_PASSWORD', request('password'));
            $this->storeSettings('MAIL_FROM_ADDRESS', request('email'));
            $this->storeSettings('MAIL_ENCRYPTION', request('encryption'));  
    
            if (config('mail.from.name') == '') {
                $newName = "'". request('username') . "'";
                $this->storeSettings('MAIL_FROM_NAME', $newName);
            } else {
                $newName = "'". request('username') . "'";
                $this->storeSettings('MAIL_FROM_NAME', $newName);
            }
        }
      

        Session::flash("success","SMTP Added successfully"); 
        return back();

    }

    private function storeSettings($key, $value)
    {
        $path = base_path('.env');

        if (file_exists($path)) {

            file_put_contents($path, str_replace(
                $key . '=' . env($key), $key . '=' . $value, file_get_contents($path)
            ));

        }
    }



    public function test(Request $request)
    {
		try {
			
            Mail::to(request('email'))->send(new TestEmail($request));
 
            if (Mail::flushMacros()) {
                return redirect()->back()->with('error', 'Test email failed');
            }
			
		} catch(\Exception $e) {
            toastr()->error(__('Your SMTP settings are not configured correctly yet, make sure to enter correct values'));
            return redirect()->back();
        } 

        toastr()->success(__('Test email successfully sent'));
        return back();
    }


}