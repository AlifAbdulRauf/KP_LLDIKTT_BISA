<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Karyawan_Kantor extends Model
{
    protected $table = 'karyawan_kantor';
    protected $primaryKey = 'id';
    protected $fillable = ['kantor_id','karyawan_id'];

//     public function kantor(){
//         return $this->belongsTo(Kantor::class,'kantor_id','id');
//     }

//     public function karyawan(){
//         return $this->belongsTo(Kantor::class,'karyawan_id','id');
//     }
}