<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User_meta;
use App\Providers\RouteServiceProvider;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

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
        protected $username     =   'email';
        protected $api;
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
        public function __construct()
            {
                $this->middleware('guest')->except('logout');
                $this->api = 'https://vas.standardmedia.co.ke/api/';

            }

        protected function sendFailedLoginResponse(Request $request)
            {
                $user = User::where('email',$request->email)->first();

                if(is_object($user))
                {
                    if(Hash::check($request->password, $user->password))
                        {
                            throw ValidationException::withMessages([
                                $this->username() => ['Account is inactive , Kindly contact the Administrator'],
                            ]);
                        }
                    else
                        {

                            throw ValidationException::withMessages([
                                $this->username() => [trans('auth.failed'),$request->email],
                            ]);
                        }
                }
            else
                {
                    throw ValidationException::withMessages([
                        $this->username() => [trans('auth.failed'),$request->email],
                    ]);
                }
        }
        protected function authenticated(Request $request, $user)
            {
                foreach(User_meta::where('user_id',$user->id)->get() as $value)
                    {
                        $data[$value->meta_key] = $value->meta_value;
                    }
                if(isset($data))
                    {
                        session($data);
                    }
                $this->redirectTo =$request->redirect;
            }
        public function apilogin(Request $request)
            {
                $username   =   $request->email;
                $password   =   $request->password;

                $params     =   ["body"=>json_encode(['username'=> $username, 'password'=>$password])];        //return $params;

                $client     =   new Client(['headers' => [ 'Content-Type' => 'application/json' ],'verify'=> app_path('/Resources/cacert.pem'),'http_errors'=>false]);
                try
                    {

                        $response = $client->request('POST', $this->api . 'auth', $params);

                    }
                catch (\Exception $e)
                    {
                        return $e->getMessage();
                    }
                $response->getHeaders();
                $body       =   $response->getBody()->getContents();
                $objbody    =   json_decode($body,true);
                /*dump($objbody);

                return;*/

                if(!isset($objbody['message']))
                    {
                        $user = User::updateOrCreate([  'email' =>  $request->email],
                                                        [
                                                            'password'  =>  bcrypt($request->password),
                                                            'name'      =>  $objbody['name'],
                                                            'phoneno'   =>  $objbody['phone'],
                                                            'access'    =>  'backend'
                                                        ]);
                        if(User_meta::where('user_id',$user->id)->count() == 0)
                            {
                                $meta = new User_meta();
                                $meta->user_id      =   $user->id;
                                $meta->meta_key     =   'role';
                                $meta->meta_value   =   serialize([
                                                                    'users'=>['roles'=>FALSE,'status'=>FALSE,"view"=>FALSE],
                                                                    'moderate'=>FALSE,
                                                                    'rates'=>["add"=>FALSE,"update"=>FALSE,"delete"=>FALSE,"view"=>FALSE]
                                                                 ]);
                                $meta->save();

                                $meta = new User_meta();
                                $meta->user_id      =   $user->id;
                                $meta->meta_key     =   'thumburl';
                                $meta->meta_value   =   'assets/img/avatar.png';
                                $meta->save();
                            }
                    }
            }

        public function login(Request $request)
            {
                $this->validateLogin($request);
                if ($this->hasTooManyLoginAttempts($request))
                    {
                        $this->fireLockoutEvent($request);
                        return $this->sendLockoutResponse($request);
                    }

                if ($this->attemptLogin($request))
                    {

                        return $this->sendLoginResponse($request);
                    }
                $this->incrementLoginAttempts($request);
                return $this->sendFailedLoginResponse($request);
            }
        public function validateLogin(Request $request)
            {
                $login          = $request->input('login');
                $login_type     = filter_var( $login, FILTER_VALIDATE_EMAIL ) ? 'email' : 'username';
                $request->merge([ $login_type => $login,'status'=>true]);
                if ( $login_type == 'email' )
                    {

                        $this->validate($request,   [
                            'email'    => 'required|email',
                            'password' => 'required|min:5',
                        ]);
                        $this->username = $login_type;

                    }
                else
                    {
                        unset($request->email);
                        $this->validate($request,   [
                            'username' => 'required',
                            'password' => 'required|min:5',
                        ]);
                        $this->username = $login_type;
                    }
            }
        public function attemptLogin(Request $request)
            {
                $this->apilogin($request);
                return $this->guard()->attempt(
                    $this->credentials($request), $request->filled('remember')
                );
            }
        public function credentials(Request $request)
            {
                $login          = $request->input('login');
                $login_type     = filter_var( $login, FILTER_VALIDATE_EMAIL ) ? 'email' : 'username';

                return $request->only($login_type, 'password','status');
            }
        public function logout(Request $request)
            {
                $this->guard()->logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                if ($response = $this->loggedOut($request))
                    {
                        return $response;
                    }

                return $request->wantsJson()
                    ? new Response('', 204)
                    : redirect($request->redirect);
            }

    }
