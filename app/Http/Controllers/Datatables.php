<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Livestream;
use App\Models\Livestream_user;
use App\User;
use Illuminate\Http\Request;

class Datatables extends Controller
    {
        public $roles;
        public $access;

        public function __construct()
            {
                $this->roles = unserialize(session('role'));
                $this->access= User::where('id','=',\Auth::user()->id)->limit(1)->first()->access;

            }
        public function get_livestream_users(Request $request)
            {
                $columns = array(
                    0   =>  'user_id',
                    1   =>  'user_id',
                    2   =>  'visits',
                    3   =>  'status',
                    4   =>  'notified'


                );
                $livestreamid   =   $request->input('id');
                $totalData      =   Livestream_user::where("livestream_id",'=',$livestreamid)
                                                    ->count();
                $totalFiltered  =   $totalData;
                $limit          =   $request->input('length');
                $start          =   $request->input('start');
                $order          =   $columns[$request->input('order.0.column')];
                $dir            =   $request->input('order.0.dir');
                if(empty($request->input('search.value')))
                    {
                        $posts = Livestream_user::where("livestream_id",'=',$livestreamid)
                                                ->offset($start)
                                                ->limit($limit)
                                                ->orderBy($order,$dir)
                                                ->get();
                    }
                else
                    {
                        $search =   $request->input('search.value');

                        $posts  =   Livestream_user::where("livestream_id",'=',$livestreamid)
                                                   ->orWhere(function($query) use($search){
                                                       $user =   User::where('name','LIKE',"%{$search}%")
                                                                     ->orWhere('email','LIKE',"%{$search}%")
                                                                     ->limit(1)
                                                                     ->first();
                                                       if(!is_null($user))
                                                       {
                                                           return $query->where('user_id','=',$user->id);
                                                       }

                                                   })
                                                   ->offset($start)
                                                   ->limit($limit)
                                                   ->orderBy($order,$dir)
                                                   ->get();

                        $totalFiltered = Livestream_user::where("livestream_id",'=',$livestreamid)
                                                        ->orWhere(function($query) use($search){
                                                            $user =   User::where('name','LIKE',"%{$search}%")
                                                                          ->orWhere('email','LIKE',"%{$search}%")
                                                                          ->limit(1)
                                                                          ->first();
                                                            if(!is_null($user))
                                                            {
                                                                return $query->where('user_id','=',$user->id);
                                                            }

                                                        })
                                                ->count();
                    }
                $data = array();
                if(!empty($posts))
                {
                    foreach ($posts as $post)
                    {
                        $userdetails                =    User::where('id',$post->user_id)
                                                             ->limit(1)
                                                             ->first();

                        $nestedData['name']             =   $userdetails->name;
                        $nestedData['email']            =   $userdetails->email;
                        $nestedData['devices']          =   $post->visits;
                        $nestedData['status']           =   ($post->status == 1)?"Active":"Not Active";
                        $nestedData['notified']         =   ($post->notified == 1)?"Yes":"No";
                        $nestedData['action']           =   '<a href="#" class="text-dark mr-2" data-user=\''.$post.'\' title="notify">
                                                                    <i class="fas fa-upload"></i>
                                                                 </a>
                                                                 <a href="#" class="edit-user text-dark mr-2" data-user=\''.$userdetails.'\' >
                                                                    <i class="fas fa-edit"></i>
                                                                 </a>
                                                                 <a href="" class="delete-record text-dark" data-id="'.$post->id.'" data-table="livestream_users">
                                                                    <i class="fas fa-trash"></i>
                                                                 </a>';
                        $data[] = $nestedData;
                    }
                }

                $json_data = array(
                    "draw"            => intval($request->input('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data
                );
                echo json_encode($json_data);
            }

        public function get_companies(Request $request)
            {
                $columns = array(
                    0   =>  'id',
                    1   =>  'company_name',
                    2   =>  'location',
                    3   =>  'user_id',
                    4   =>  'userid',
                    5   =>  'status',
                    6   =>  'created_at'

                );


                if($this->access == "backend")
                    {
                        $totalData      = Company::count();

                        $totalFiltered  = $totalData;

                        $limit  =   $request->input('length');
                        $start  =   $request->input('start');
                        $order  =   $columns[$request->input('order.0.column')];
                        $dir    =   $request->input('order.0.dir');
                        if(empty($request->input('search.value')))
                            {
                                $posts = Company::offset($start)
                                                ->limit($limit)
                                                ->orderBy($order,$dir)
                                                ->get();
                            }
                        else
                            {
                                $search =   $request->input('search.value');

                                $posts  =   Company::where('company_name','LIKE',"%{$search}%")
                                                   ->orWhere('location','LIKE',"%{$search}%")
                                                   ->orWhere(function($query) use($search){
                                                       $user =   User::where('name','LIKE',"%{$search}%")
                                                                     ->orWhere('email','LIKE',"%{$search}%")
                                                                     ->limit(1)
                                                                     ->first();
                                                       if(!is_null($user))
                                                       {
                                                           return $query->where('user_id','=',$user->id);
                                                       }

                                                   })
                                                   ->offset($start)
                                                   ->limit($limit)
                                                   ->orderBy($order,$dir)
                                                   ->get();

                                $totalFiltered = Company::where('company_name','LIKE',"%{$search}%")
                                                        ->orWhere('location','LIKE',"%{$search}%")
                                                        ->orWhere(function($query) use($search){
                                                            $user =   User::where('name','LIKE',"%{$search}%")
                                                                          ->orWhere('email','LIKE',"%{$search}%")
                                                                          ->limit(1)
                                                                          ->first();
                                                            if(!is_null($user))
                                                            {
                                                                return $query->where('user_id','=',$user->id);
                                                            }

                                                        })
                                                        ->count();
                            }
                    }
                else if($this->access == "company")
                    {
                        $totalData      = Company::where('user_id','=',\Auth::user()->id)
                                                 ->count();

                        $totalFiltered  = $totalData;

                        $limit  =   $request->input('length');
                        $start  =   $request->input('start');
                        $order  =   $columns[$request->input('order.0.column')];
                        $dir    =   $request->input('order.0.dir');

                        if(empty($request->input('search.value')))
                            {
                                $posts = Company::where('user_id','=',\Auth::user()->id)
                                                ->offset($start)
                                                ->limit($limit)
                                                ->orderBy($order,$dir)
                                                ->get();
                            }
                        else
                            {
                                $search =   $request->input('search.value');

                                $posts  =   Company::where('user_id','=',\Auth::user()->id)
                                                   ->where('company_name','LIKE',"%{$search}%")
                                                   ->orWhere('location','LIKE',"%{$search}%")
                                                   ->orWhere(function($query) use($search){
                                                       $user =   User::where('name','LIKE',"%{$search}%")
                                                                     ->orWhere('email','LIKE',"%{$search}%")
                                                                     ->limit(1)
                                                                     ->first();
                                                       if(!is_null($user))
                                                       {
                                                           return $query->where('user_id','=',$user->id);
                                                       }

                                                   })
                                                   ->offset($start)
                                                   ->limit($limit)
                                                   ->orderBy($order,$dir)
                                                   ->get();

                                $totalFiltered = Company::where('user_id','=',\Auth::user()->id)
                                                        ->where('company_name','LIKE',"%{$search}%")
                                                        ->orWhere('location','LIKE',"%{$search}%")
                                                        ->orWhere(function($query) use($search){
                                                            $user =   User::where('name','LIKE',"%{$search}%")
                                                                          ->orWhere('email','LIKE',"%{$search}%")
                                                                          ->limit(1)
                                                                          ->first();
                                                            if(!is_null($user))
                                                            {
                                                                return $query->where('user_id','=',$user->id);
                                                            }

                                                        })
                                                        ->count();
                            }
                    }

                $data = array();
                if(!empty($posts))
                {
                    foreach ($posts as $post)
                    {
                        $userdetails                =    User::where('id',$post->user_id)
                                                             ->limit(1)
                                                             ->first();

                        $nestedData['id']               =   $post->id;
                        $nestedData['company']          =   $post->company_name;
                        $nestedData['location']         =   $post->location;
                        $nestedData['contact_name']     =   $userdetails->name;
                        $nestedData['contact_email']    =   $userdetails->email;
                        $nestedData['status']           =   ($post->status == 1)?"Active":"Not Active";
                        $nestedData['created_at']       =   date('j M Y h:i a',strtotime($post->created_at));
                        $nestedData['action']           =   '<a href="#" class="edit-company text-dark mr-2" data-company=\''.$post.'\' data-user=\''. $userdetails .'\' >
                                                                    <i class="fas fa-edit"></i>
                                                                 </a>
                                                                 <a href="" class="delete-record text-dark" data-id="'.$post->id.'" data-table="companies">
                                                                    <i class="fas fa-trash"></i>
                                                                 </a>';
                        $data[] = $nestedData;
                    }
                }

                $json_data = array(
                    "draw"            => intval($request->input('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data
                );
                echo json_encode($json_data);
            }

        public function get_livestreams(Request $request)
            {

                $columns = array(
                                    0   =>  'id',
                                    1   =>  'company_id',
                                    2   =>  'title',
                                    3   =>  'description',
                                    4   =>  'livestream_link',
                                    5   =>  'publishdate',
                                    6   =>  'status'

                                );
                if($this->access == 'backend')
                    {
                        $totalData      = Livestream::count();

                        $totalFiltered  = $totalData;

                        $limit  =   $request->input('length');
                        $start  =   $request->input('start');
                        $order  =   $columns[$request->input('order.0.column')];
                        $dir    =   $request->input('order.0.dir');

                        if(empty($request->input('search.value')))
                        {
                            $posts = Livestream::offset($start)
                                               ->limit($limit)
                                               ->orderBy($order,$dir)
                                               ->get();
                        }
                        else
                        {
                            $search     =   $request->input('search.value');

                            //

                            $posts      =   Livestream::where('title','LIKE',"%{$search}%")
                                                      ->orWhere('description','LIKE',"%{$search}%")
                                                      ->orWhere('publishdate','LIKE',"%{$search}%")
                                                      ->orWhere(function($query) use($search){
                                                          $company =   Company::where('company_name','LIKE',"%{$search}%")
                                                                              ->limit(1)
                                                                              ->first();
                                                          if(!is_null($company))
                                                          {
                                                              return $query->where('company_id','=',$company->id);
                                                          }

                                                      })
                                                      ->offset($start)
                                                      ->limit($limit)
                                                      ->orderBy($order,$dir)
                                                      ->get();

                            $totalFiltered = Livestream::where('title','LIKE',"%{$search}%")
                                                       ->orWhere('description','LIKE',"%{$search}%")
                                                       ->orWhere('publishdate','LIKE',"%{$search}%")
                                                       ->orWhere(function($query) use($search){
                                                           $company =   Company::where('company_name','LIKE',"%{$search}%")
                                                                               ->limit(1)
                                                                               ->first();
                                                           if(!is_null($company))
                                                           {
                                                               return $query->where('company_id','=',$company->id);
                                                           }

                                                       })
                                                       ->count();
                        }

                    }
                elseif($this->access == 'company')
                    {
                        $getcompany = Company::where('user_id','=',\Auth::user()->id)
                                             ->get()
                                             ->toArray();
                        $comp       = array_column($getcompany,'id');
                        //dd($comp);
                        $totalData      = Livestream::whereIn('company_id',$comp)
                                                    ->count();

                        $totalFiltered  = $totalData;

                        $limit  =   $request->input('length');
                        $start  =   $request->input('start');
                        $order  =   $columns[$request->input('order.0.column')];
                        $dir    =   $request->input('order.0.dir');

                        if(empty($request->input('search.value')))
                        {
                            $posts = Livestream::whereIn('company_id',$comp)
                                               ->offset($start)
                                               ->limit($limit)
                                               ->orderBy($order,$dir)
                                               ->get();
                        }
                        else
                        {
                            $search     =   $request->input('search.value');

                            //

                            $posts      =   Livestream::whereIn('company_id',$comp)
                                                      ->orWhere('title','LIKE',"%{$search}%")
                                                      ->orWhere('description','LIKE',"%{$search}%")
                                                      ->orWhere('publishdate','LIKE',"%{$search}%")
                                                      ->offset($start)
                                                      ->limit($limit)
                                                      ->orderBy($order,$dir)
                                                      ->get();

                            $totalFiltered = Livestream::whereIn('company_id',$comp)
                                                       ->orWhere('title','LIKE',"%{$search}%")
                                                       ->orWhere('description','LIKE',"%{$search}%")
                                                       ->orWhere('publishdate','LIKE',"%{$search}%")
                                                       ->count();
                        }

                    }


                $data = array();
                if(!empty($posts))
                    {
                        $x= $start + 1;
                        foreach ($posts as $post)
                            {
                                $nestedData['id']               =   $post->id;
                                $nestedData['company']          =   Company::where("id",$post->company_id)->first()->company_name;
                                $nestedData['title']            =   $post->title;
                                $nestedData["description"]      =   $post->description;
                                $nestedData["livestream_link"]  =   $post->livestream_link;
                                $nestedData["startdate"]        =   $post->publishdate;
                                $nestedData["enddate"]          =   $post->enddate;
                                $nestedData['status']           =   $post->status == 0?'inactive':'Active';
                                $nestedData['action']           =   "<div class='d-flex justify-content-between'><a href='".url('cms/livestreamusers/'.$post->id.'/'.\Str::slug($post->title,'-'))."' class='text-dark mr-2'>
                                                                        <i class='fas fa-plus'></i>
                                                                     </a>
                                                                     ".'<a href="#" class="edit-livestream text-dark mr-2" data-livestream=\''.$post.'\' >
                                                                        <i class="fas fa-edit"></i>
                                                                     </a>
                                                                     <a href="" class="delete-record text-dark" data-id="'.$post->id.'" data-table="companies">
                                                                        <i class="fas fa-trash"></i>
                                                                     </a></div>';
                                $data[] = $nestedData;
                                $x++;
                            }
                    }

                $json_data = array(
                                        "draw"            => intval($request->input('draw')),
                                        "recordsTotal"    => intval($totalData),
                                        "recordsFiltered" => intval($totalFiltered),
                                        "data"            => $data
                                    );

                echo json_encode($json_data);
            }

        public function get_users(Request $request)
            {

                $columns = array(
                    0   =>  'name',
                    1   =>  'email',
                    2   =>  'phoneno',
                    3   =>   'status'

                );

                $totalData      = User::count();

                $totalFiltered  = $totalData;

                $limit  =   $request->input('length');
                $start  =   $request->input('start');
                $order  =   $columns[$request->input('order.0.column')];
                $dir    =   $request->input('order.0.dir');

                if(empty($request->input('search.value')))
                {
                    $posts = User::offset($start)
                                 ->limit($limit)
                                 ->orderBy($order,$dir)
                                 ->get();
                }
                else
                {
                    $search     =   $request->input('search.value');

                    //

                    $posts      =   User::where('name','LIKE',"%{$search}%")
                                        ->orwhere('email','LIKE',"%{$search}%")
                                        ->orwhere('phoneno','LIKE',"%{$search}%")
                                        ->offset($start)
                                        ->limit($limit)
                                        ->orderBy($order,$dir)
                                        ->get();

                    $totalFiltered = User::where('name','LIKE',"%{$search}%")
                                         ->orwhere('email','LIKE',"%{$search}%")
                                         ->orwhere('phoneno','LIKE',"%{$search}%")
                                         ->count();
                }

                $data = array();
                if(!empty($posts))
                {
                    $x= $start + 1;
                    foreach ($posts as $post)
                    {

                        $rolesbtn               =   ($this->roles['users']["roles"] == TRUE)?'<a href="#" class="edit-user-roles text-dark mr-2" data-user=\''.$post.'\' >
                                                                            <i class="fas fa-edit"></i>
                                                                     </a>':NULL;
                        $actionbtn              =    ($this->roles['users']["status"] == TRUE)?$post->status == 0?'<a href="" class="usermgt text-dark" data-type="1" data-user=\''.$post.'\' >
                                                                                           <i class="fas fa-user-plus"></i>
                                                                                         </a>':'<a href="#" class="usermgt text-dark" data-type="0" data-user=\''.$post.'\' >
                                                                                           <i class="fas fa-user-minus"></i>
                                                                                         </a>':NULL;

                        $nestedData['*']        =   $x;
                        $nestedData['name']     =   $post->name;
                        $nestedData['email']    =   $post->email;
                        $nestedData["phoneno"]  =   $post->phoneno;
                        $nestedData['status']   =   $post->status == 0?'inactive':'Active';
                        $nestedData['action']   =   $rolesbtn.$actionbtn;

                        $data[] = $nestedData;
                        $x++;
                    }
                }

                $json_data = array(
                    "draw"            => intval($request->input('draw')),
                    "recordsTotal"    => intval($totalData),
                    "recordsFiltered" => intval($totalFiltered),
                    "data"            => $data
                );

                echo json_encode($json_data);
            }

    }
