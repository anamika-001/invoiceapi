<?php

namespace App\Http\Controllers;

use App\LoginUser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $successStatus = '200';
    public $failedStatus = '0';

    public function login(Request $request){

        $mobile = $request->mobile;
        $password=$request->password;
       if(empty($mobile)){
            return response()->json([
                'responceMessage'         => 'mobile_no is required',
                'responceCode'            =>  $this->failedStatus,
               ]);
           }elseif(empty($password)){
            return response()->json([
                'responceMessage'         => 'password is required',
                'responceCode'            =>  $this->failedStatus,
               ]);
           }else{
            $otp = rand('1111','9999');
            $countMobileNo = LoginUser::where('mobile',$mobile)->where('active',Null)->count();

            if($countMobileNo==1){
                $userMobileData = LoginUser::where('mobile',$mobile)->first();
                $data = array(
                    'otp' => $otp,
                   );

           $updateOtp =   LoginUser::where('mobile',$mobile)->update($data);
           if ($updateOtp) {
             return response()->json([
              'responceMessage'         => 'otp send on your mobile no.',
              'responceCode'            =>  $this->successStatus,
              'mobile'               =>  $userMobileData->mobile,
              'otp'                     =>  (string)$otp,
           ]);
           }
           else{
             return response()->json([
            'responceMessage'         => 'otp sending failed',
            'responceCode'            =>  $this->failedStatus,
           ]);
           }
        }else{
                return response()->json([
                    'responceMessage'         => 'your number is not register',
                    'responceCode'            =>  $this->failedStatus,
                   ]);

            }

        }
    }
}


