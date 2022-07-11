<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pesanandetail extends Model
{
    public function user()
    {
    return $this->belongsto(Barang::class,'barang_id', 'id');
    } 
    
    public function pesanan()
    {
    return $this->belongsto('App\Pesanan','pesanan_id', 'id');
    }   
    
    public function barang()
    {
    return $this->belongsto(Barang::class,'barang_id', 'id');
    }   
    public function check_out()
    {
    return $this->belongsto(Check_out::class,'check_out', 'id');
    }
}
