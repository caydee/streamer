<?php
namespace App\Utils;

use App\Models\Livestream;
use App\Models\Livestream_user;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Assist
    {
        public $data;
        public static function passgen($size)
            {
                $seed = str_split('abcdefghijklmnopqrstuvwxyz'
                                  .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                                  .'0123456789'
                                  .'!$@ ');
                shuffle($seed);
                $rand = '';
                foreach (array_rand($seed,$size) as $k){ $rand .= $seed[$k]; }
                return $rand;
            }
        public static function send($vars)
            {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL,"https://mail.standarddigitalworld.co.ke/api/transactionalMail");
                //curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS,$vars);  //Post Fields
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

                $headers = [
                    "appkey:QW1UTjBXZzAxSVBrSTJLbmlQVlk0SDBNOWJJZ095S2VqTDM2R2RHbG1JdjZXSVFjMG1hWUxvWEhmY2hB5eafd4feeb556"
                ];

                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

                $server_output = curl_exec ($ch);

                curl_close ($ch);
                return json_decode($server_output);
            }
        public static function regmail($data)
            {
                $var['email']   =   $data['email'];
                $var['subject'] =   "Livestream Account registration";
                $var["message"] =   "<p><strong>Dear ".$data["name"]."</strong></p>
                                    <p>Your account has been created successful. </p>
                                    <p>Visit ".url('/login')." and use <i><strong>".$data["password"]."</strong></i> as your password.</p>
                                    <p>Kind Regards,</p>
                                    <p>The Standard</p>";

                return $var;
            }
        public static function passkeynotification($data)
            {
                $var['email']   =   $data['email'];
                $var['subject'] =   $data['Livestream']->title." Livestream invitation";
                $var["message"] =   "<p><strong>Dear ".$data["name"]."</strong></p>
                                    <p>You have been invited to ".$data['Livestream']->title." on ".date('dS F Y',strtotime($data['Livestream']->publishdate))." at ".date('h:ia',strtotime($data['Livestream']->publishdate))."</p>
                                    <p>Kindly visit ".url('/watch/'.$data["uniqueid"])." or use <i><strong>".$data["uniqueid"]."</strong></i> on ".url("/")."</p>
                                    <p>Kind Regards,</p>
                                    <p>The Standard</p>";

                return $var;
            }
        public static function login($key)
            {
                $u = Livestream_user::where("uniqueid","=",$key)
                                    ->limit(1)
                                    ->first();

                if(!is_null($u))
                    {

                        $user = User::where("id","=",$u->user_id)
                                    ->limit(1)
                                    ->first();
                        $live = Livestream::where('id',$u->livestream_id)
                                            ->limit(1)
                                            ->first();

                        if($live->viewsperuser > $u->visits)
                            {

                                if(!is_null($user))
                                    {
                                        $li = Livestream_user::find($u->id);
                                        $li->increment('visits',1);
                                        $li->save();
                                        Auth::setUser($user);
                                        Auth::login($user);
                                    }
                                else
                                    {
                                       return array('msg'=>"Account cannot be found!!");
                                    }
                            }
                        else
                            {
                                   return array('msg'=>"You have reached maximum allowed devices of ".$live->viewsperuser);
                            }
                    }


                  return array('msg'=>"Login Successful");

            }


}
