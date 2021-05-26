<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
    {
        public function user()
            {
                return $this->belongsTo('App\User', 'foreign_key');
            }
    }
