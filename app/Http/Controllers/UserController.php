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
        $otp=$request->otp;
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
           }elseif(empty($otp)){
            return response()->json([
                'responceMessage'         => 'otp is required',
                'responceCode'            =>  $this->failedStatus,
               ]);
           }else{

            $member = LoginUser::where('mobile',$request->mobile)->where('password',$request->password)->first();

            if($member){

               // $otp=rand('1111','9999');

                $updateotp=LoginUser::where('id', '=',  3)->update(['otp'=> rand('1111','9999')]);

                // dd($updateotp);

                // $login = new LoginUser;
                // $login->mobile=$request->mobile;
                // $login->password=$request->password;
                // $login->otp = $otp;
                // $login->save();

                 $dbotp=LoginUser::select('otp')->where('id', 3)->first();
                 if($dbotp->otp==$request->otp){
                    return response()->json([
                        'responceMessage'         => 'otp verified successfully',
                        'responceCode'            =>  $this->successStatus,
                       ]);
                }
                else{
                    return response()->json([
                            'responceMessage'         => 'incorrect otp',
                            'responceCode'            =>  $this->failedStatus,
                           ]);
                }
             }
            }



        }

    }

