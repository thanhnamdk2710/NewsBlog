<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoaiSP extends Model
{
    //
    protected $table = 'loaisp';
    public $timestamps = false;

    public function sanpham(){
        return $this->hasMany('App\SanPham', 'id_loaisp', 'id');
    }
}
