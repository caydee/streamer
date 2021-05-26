<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Livestream;
use App\Models\Livestream_user;
use App\Models\Tag_relations;
use App\Models\Tags;
use App\Models\Usermeta;
use App\User;
use App\Utils\Assist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Cms extends Controller
    {
        public $data;
        public function __construct()
            {
                $this->middleware('auth');
                $this->data = ["title","description","author"];
            }
        public function index()
            {
                return view('cms.modules.dashboard',$this->data);
            }
        public function dashboard(Request $request)
            {
                return view('cms.modules.dashboard',$this->data);
            }
        public function company(Request $request)
            {
                return view('cms.modules.company',$this->data);
            }
        public function addcompany(Request $request)
            {
                $validatedData = $request->validate([
                                                        'company'       =>  'required',
                                                        'location'      =>  'required',
                                                        'contact_name'  =>  'required',
                                                        'contact_email' =>  'required'
                                                    ]);
                if($validatedData)
                    {
                        $usercheck              =   User::where('email',$request->contact_email)
                                                    ->limit(1)
                                                    ->first();
                        if(is_null($usercheck))
                            {
                                $pass                   =   Assist::passgen(8);
                                $user                   =   new User();
                                $user->name             =   $request->contact_name;
                                $user->email            =   $request->contact_email;
                                $user->status           =   1;
                                $user->password         =   bcrypt($pass);
                                $user->access           =   "company";
                                $user->save();
                                $userid                 =   $user->id;
                                $vars                   =   [
                                                                'email'     =>  $request->contact_email,
                                                                'name'      =>  $request->contact_name,
                                                                'password'  =>  $pass,

                                                            ];
                                Assist::send(Assist::regmail($vars));
                            }
                        else
                            {
                                $userid                 =   $usercheck->id;
                            }

                        if(!is_null($userid))
                            {

                                $company                =   new Company();
                                $company->company_name  =   $request->company;
                                $company->location      =   $request->location;
                                $company->status        =   1;
                                $company->user_id       =   $userid;
                                $req                    =   $company->save();
                                if($req)
                                    {
                                        return array('status'=>TRUE,'msg'=>'Company added successful','header'=>'Company');
                                    }
                                else
                                    {
                                        return array('status'=>False,'msg'=>'Company addition failed','header'=>'Company');
                                    }
                            }
                        else
                            {
                                return array('status'=>False,'msg'=>'User creation failed','header'=>'Company');
                            }
                    }
                else
                    {
                        return array('status'=>False,'msg'=>'Company addition failed','header'=>'Company');
                    }
            }
        public function editcompany(Request $request)
            {
                $validatedData = $request->validate([
                    'company'       =>  'required',
                    'location'      =>  'required',
                    'contact_name'  =>  'required',
                    'contact_email' =>  'required'
                ]);
                if($validatedData)
                {
                    $usercheck              =   User::where('email',$request->contact_email)
                                                    ->limit(1)
                                                    ->first();
                    if(is_null($usercheck))
                        {
                            $pass                   =   Assist::passgen(8);
                            $user                   =   new User();
                            $user->name             =   $request->contact_name;
                            $user->email            =   $request->contact_email;
                            $user->status           =   1;
                            $user->password         =   bcrypt($pass);
                            $user->access           =   "company";
                            $user->save();
                            $userid                 =   $user->id;
                            $vars                   =   [
                                'email'     =>  $request->contact_email,
                                'name'      =>  $request->contact_name,
                                'password'  =>  $pass,

                            ];
                            Assist::send(Assist::regmail($vars));
                        }
                    else
                        {
                            $userid                 =   $usercheck->id;
                        }

                    if(!is_null($userid))
                        {
                             //dd($request);
                            $company                =   Company::find((int)$request->id);
                            $company->company_name  =   $request->company;
                            $company->location      =   $request->location;
                            $company->status        =   1;
                            $company->user_id       =   $userid;
                            $req                    =   $company->save();
                            if($req)
                                {
                                    return array('status'=>TRUE,'msg'=>'Company update successful','header'=>'Company');
                                }
                            else
                                {
                                    return array('status'=>False,'msg'=>'Company update failed','header'=>'Company');
                                }
                        }
                    else
                        {
                            return array('status'=>False,'msg'=>'User update failed','header'=>'Company');
                        }
                }
                else
                    {
                        return array('status'=>False,'msg'=>'Company update failed','header'=>'Company');
                    }
            }
        public function livestream(Request $request)
            {
                $this->data["company"]  =   Company::get();
                return view('cms.modules.livestream',$this->data);
            }
        public function addlivestream(Request $request)
            {
                $validatedData = $request->validate([
                    'title'             =>  'required',
                    'description'       =>  'required',
                    'company'           =>  'required',
                    'devices'           =>  'required',
                    'livestream_link'   =>  'required|unique:livestreams',
                    'publishdate'       =>  'required',
                    'enddate'           =>  'required',
                    'image'             =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                if($validatedData)
                    {
                        $imageName = uniqid().time().'.'.$request->image->extension();
                        $request->image->move(public_path('uploads'), $imageName);
                        $livestream                 = new Livestream();
                        $livestream->title          =   $request->title;
                        $livestream->description    =   $request->description;
                        $livestream->company_id     =   $request->company;
                        $livestream->viewsperuser   =   $request->devices;
                        $livestream->livestream_link=   $request->livestream_link;
                        $livestream->publishdate    =   date('Y-m-d H:i:s',strtotime(str_replace("/","-",$request->publishdate)));
                        $livestream->enddate        =   date('Y-m-d H:i:s',strtotime(str_replace("/","-",$request->enddate)));
                        $livestream->status         =   1;
                        $livestream->thumbnail      =   $imageName;
                        $req                        =   $livestream->save();

                        if($req)
                            {
                                $keywords   =   explode(';', str_replace(',',';',trim($request->keywords)));
                                foreach($keywords as $value)
                                    {
                                        $checkkeyword   =   Tags::where("tag_name","=",$value)->first();
                                        if(!is_null($checkkeyword))
                                            {
                                                $tag            =   Tags::find($checkkeyword->id);
                                                $tag->increment('count',1);
                                                $tagsave        =   $tag->save();
                                                if($tagsave)
                                                    {
                                                        $tag_rel                =   new Tag_relations();
                                                        $tag_rel->tag_id        =   $checkkeyword->id;
                                                        $tag_rel->livestream_id =   $livestream->id;
                                                        $tag_rel->save();
                                                    }
                                            }
                                        else
                                            {
                                                $tag            =   new Tags();
                                                $tag->tag_name  = $value;
                                                $tag->count     = 1;
                                                $tagsave        =   $tag->save();
                                                if($tagsave)
                                                    {
                                                        $tag_rel                =   new Tag_relations();
                                                        $tag_rel->tag_id        =   $tag->id;
                                                        $tag_rel->livestream_id =   $livestream->id;
                                                        $tag_rel->save();
                                                    }
                                            }
                                    }
                                //dd($livestream->id);
                                return array('status'=>TRUE,'msg'=>'Livestream added successfully','header'=>'Livestream');
                            }
                        else
                            {
                                return array('status'=>False,'msg'=>'Livestream addition failed','header'=>'Livestream');
                            }
                    }
                else
                    {
                        return array('status'=>False,'msg'=>'Livestream addition failed','header'=>'Livestream');
                    }
            }
        public function editlivestream(Request $request)
            {
                $validatedData = $request->validate([
                    'title'             =>  'required',
                    'description'       =>  'required',
                    'company'           =>  'required',
                    'devices'           =>  'required',
                    'livestream_link'   =>  'required'
                ]);
                if($validatedData)
                    {
                        $livestream                 =   Livestream::find($request->id);
                        $livestream->title          =   $request->title;
                        $livestream->description    =   $request->description;
                        $livestream->company_id     =   $request->company;
                        $livestream->viewsperuser   =   $request->devices;
                        $livestream->livestream_link=   $request->livestream_link;
                        $livestream->publishdate    =   date('Y-m-d H:i:s',strtotime(str_replace("/","-",$request->publishdate)));
                        $livestream->status         =   1;
                        $req                        =   $livestream->save();

                        if($req)
                            {
                                return array('status'=>TRUE,'msg'=>'Livestream updated successfully','header'=>'Livestream');
                            }
                        else
                            {
                                return array('status'=>False,'msg'=>'Livestream update failed','header'=>'Livestream');
                            }
                    }
                else
                    {
                        return array('status'=>False,'msg'=>'Livestream update failed','header'=>'Livestream');
                    }
            }
        public function livestream_users($id,$slug)
            {
                $this->data['livestream_title'] = Livestream::where('id','=',$id)
                                                            ->limit(1)
                                                            ->first()
                                                            ->title;
                $this->data['id']               =   $id;
                return view('cms.modules.livestream-users',$this->data);
            }
        public function users(Request $request)
            {
                return view('cms.modules.users',$this->data);
            }

        public function getuserroles(Request $request)
            {
                $user = Usermeta::where('user_id', $request->userid)
                               ->where('meta_key', 'role')
                               ->limit(1)
                               ->first();
                if ($user)
                    {
                        return unserialize($user->meta_value);
                    }
                else
                    {
                        return ['users' => ['roles' => FALSE, 'status' => FALSE, 'view' => FALSE], 'moderate' => FALSE, 'rates' => ["add" => FALSE, "update" => FALSE, "delete" => FALSE]];
                    }

            }
        public function edituserroles(Request $request)
            {
                $data['users']['roles']     =   isset($request->roles['users']['roles'])?(bool)$request->roles['users']['roles']:FALSE;
                $data['users']['status']    =   isset($request->roles['users']['status'])?(bool)$request->roles['users']['status']:FALSE;
                $data['users']['view']      =   isset($request->roles['users']['view'])?(bool)$request->roles['users']['view']:FALSE;
                $data['moderate']           =   isset($request->roles['moderate'])?(bool)$request->roles['moderate']:FALSE;
                $data['rates']['add']       =   isset($request->roles['rates']['add'])?(bool)$request->roles['rates']['add']:FALSE;
                $data['rates']['update']    =   isset($request->roles['rates']['update'])?(bool)$request->roles['rates']['update']:FALSE;
                $data['rates']['delete']    =   isset($request->roles['rates']['delete'])?(bool)$request->roles['rates']['delete']:FALSE;
                $data['rates']['view']      =   isset($request->roles['rates']['view'])?(bool)$request->roles['rates']['view']:FALSE;
                $status                     =   User_meta::updateOrCreate(['user_id'=>$request->userid,'meta_key'=>'role'],['meta_value'=>serialize($data)])->save();
                if($status)
                    {
                        $result = array('status'=>TRUE,'msg'=>'User Role manipulation successful','header'=>'User Role');
                    }
                else
                    {
                        $result = array('status'=>False,'msg'=>'User Role manipulation failed','header'=>'User Role');
                    }
                return $result;
            }
        public function delete(Request $request)
            {
                $res = DB::table($request->table)->where('id',$request->id)->delete();
                if($res)
                    {
                        return array('status'=>TRUE,'msg'=>'Record deletion successful','header'=>ucfirst($request->table));
                    }
                else
                    {
                        return array('status'=>False,'msg'=>'Record deletion failed','header'=>ucfirst($request->table));
                    }
            }
        public function update(Request $request)
            {

                $res = DB::table($request->table)
                         ->where('id', $request->id)
                         ->update([$request->column => $request->value]);
                if($res)
                    {
                        return array('status'=>TRUE,'msg'=>'Record update successful','header'=>ucfirst($request->table));
                    }
                else
                    {
                        return array('status'=>False,'msg'=>'Record update failed','header'=>ucfirst($request->table));
                    }
            }
        public function bulkupload(Request $request)
            {
                $request->validate([
                    'file' => 'required|mimes:csv,txt'
                ]);
                $path = request()->file('file')->getRealPath();
                $file = file($path);
                foreach ($file as $data)
                    {
                        $cf = explode(',',str_replace('\n',NULL,$data));
                       if((strtolower($cf[0]) != 'name') && (strtolower($cf[1]) != 'email'))
                           {
                               $usercheck              =   User::where('email',$cf[1])
                                                               ->limit(1)
                                                               ->first();
                               if(is_null($usercheck))
                                   {
                                       $pass                        =   Assist::passgen(8);
                                       $user                        =   new User();
                                       $user->name                  =   $cf[0];
                                       $user->email                 =   $cf[1];
                                       $user->status                =   1;
                                       $user->password              =   bcrypt($pass);
                                       $user->access                =   'frontend';
                                       $user->save();
                                       $userid                      =   $user->id;
                                   }
                               else
                                   {
                                       $userid                 =   $usercheck->id;
                                   }
                               $lucheck =  Livestream_user::where("user_id","=",$userid)
                                                          ->where('livestream_id','=',$request->livestream_id)
                                                          ->limit(1)
                                                          ->first();
                               if(is_null($lucheck))
                                   {
                                       $uniqueid                    =   Assist::passgen(12)."-".$userid;

                                       $livestream                  =   new Livestream_user();
                                       $livestream->user_id         =   $userid;
                                       $livestream->livestream_id   =   $request->livestream_id;
                                       $livestream->uniqueid        =   $uniqueid;
                                       $rq                          =   $livestream->save();
                                       if($rq)
                                           {
                                               $resp =    Assist::send(Assist::passkeynotification([
                                                   'name'          =>  $cf[0],
                                                   'email'         =>  $cf[1],
                                                   'uniqueid'      =>  $uniqueid,
                                                   'Livestream'    =>  Livestream::where("id","=",$request->livestream_id)->limit(1)->first()
                                               ]));

                                               if($resp->message == "Email successfully sent to user." )
                                                   {
                                                       $ld              =   Livestream_user::find($livestream->id);
                                                       $ld->notified    =   1;
                                                       $ld->save();

                                                   }

                                           }
                                   }

                           }
                    }
                return array('status'=>TRUE,'msg'=>'Livestream users added successful','header'=>'Livestream users');
            }
        public function addlivestreamusers(Request $request)
            {
                $validatedData = $request->validate([
                                                        'email'       =>  'required',
                                                        'name'        =>  'required'
                                                    ]);
                if($validatedData)
                    {
                        $usercheck              =   User::where('email',$request->email)
                                                        ->limit(1)
                                                        ->first();
                        if(is_null($usercheck))
                            {
                                $pass                        =   Assist::passgen(8);
                                $user                        =   new User();
                                $user->name                  =   $request->name;
                                $user->email                 =   $request->email;
                                $user->status                =   1;
                                $user->password              =   bcrypt($pass);
                                $user->access                =   'frontend';
                                $user->save();
                                $userid                      =   $user->id;
                            }
                        else
                            {
                                $userid                 =   $usercheck->id;
                            }
                        $lucheck =  Livestream_user::where("user_id","=",$userid)
                                                   ->where('livestream_id','=',$request->livestream_id)
                                                   ->limit(1)
                                                   ->first();
                        if(is_null($lucheck))
                            {
                                $uniqueid                    =   Assist::passgen(12)."-".$userid;
                                $livestream                  =   new Livestream_user();
                                $livestream->user_id         =   $userid;
                                $livestream->livestream_id   =   $request->livestream_id;
                                $livestream->uniqueid        =   $uniqueid;
                                $rq                          =   $livestream->save();
                                if($rq)
                                    {
                                        $resp =    Assist::send(Assist::passkeynotification([
                                            'name'          =>  $request->name,
                                            'email'         =>  $request->email,
                                            'uniqueid'      =>  $uniqueid,
                                            'Livestream'    =>  Livestream::where("id","=",$request->livestream_id)->limit(1)->first()
                                        ]));

                                        if($resp->message == "Email successfully sent to user." )
                                            {
                                                $ld              =   Livestream_user::find($livestream->id);
                                                $ld->notified    =   1;
                                                $ld->save();

                                            }
                                        return array('status'=>TRUE,'msg'=>'Livestream user added successful','header'=>'Livestream user');
                                    }
                                else
                                    {
                                        return array('status'=>False,'msg'=>'Livestream User addition failed','header'=>'Livestream User');
                                    }
                            }
                    }
                else
                    {
                        return array('status'=>False,'msg'=>'Livestream User addition failed','header'=>'Livestream User');
                    }
            }
    }
