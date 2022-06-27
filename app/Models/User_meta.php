<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_meta extends Model
    {
        protected $fillable = ['user_id','meta_key','meta_value'];
        public function user()
            {
                return $this->belongsTo('App\User', 'foreign_key');
            }
    }
