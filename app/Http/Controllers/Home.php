<?php

namespace App\Http\Controllers;

use App\Models\Livestream;
use App\Models\Livestream_user;
use App\Utils\Assist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class Home extends Controller
    {
        public $data;
        public function __construct($msg="")
            {
                $this->data = ["title","description","author"];
                $this->data['msg']=$msg;
            }
        public function index()
            {
                return view('home.modules.index',$this->data);
            }
        public function login(Request $request)
            {
                $validatedData = $request->validate([
                    "key"=>"required"
                    ]);
                $dt=Assist::login($request->key);
                if($validatedData)
                    {
                        if (Auth::check())
                            {
                                return redirect("/watch/".$request->key)->with($dt);
                            }
                        else
                            {
                                return redirect("/")->with($dt);
                            }
                    }
            }
        public function logout()
            {
                $l    = Livestream_user::where('user_id',Auth::user()->id)->limit(1)->first();
                $live = Livestream_user::find($l->id);
                $live->decrement('visits',1);
                $live->save();
                Auth::logout();
                return redirect("/");
            }
        public function watch($key ,Request $request)
            {
                $dt=Assist::login($key);
                if (Auth::check())
                    {
                        $this->data["video"] = Livestream::where(function($query) use($key){
                                                            $lu =   Livestream_user::where("uniqueid","=",$key)
                                                                                   ->limit(1)
                                                                                   ->first();
                                                            if(!is_null($lu))
                                                                {
                                                                   return $query->where("id","=",$lu->livestream_id);
                                                                }
                                                            return FALSE;
                                                        })
                                                ->limit(1)
                                                ->first();
                        return view( 'home.modules.watch', $this->data );
                    }
                else
                    {
                       return redirect("/")->with($dt);
                    }
            }
    }
