<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Livestream extends Model
    {
        public function livestream_users()
            {
                return $this->hasMany('App\Models\Livestream_user');
            }
    }
