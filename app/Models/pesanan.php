<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesanan extends Model
{
    
    public function user()
    {
    return $this->belongsto('App\User','user_id', 'id');
    }   
    public function pesanan_detail()
    {
    return $this->hasMany('App\PesananDetail','pesanan_id', 'id');
    }

}
