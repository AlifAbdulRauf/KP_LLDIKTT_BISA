<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Disposisi extends Model
{
    protected $table = 'disposisi';
    protected $fillable = [
        'id', 'pusat_id', 'karyawan_id', 'users_id',
    ];
    use HasFactory;
    public function addData($data)
    {
        DB::table('disposisi')->insert($data);
    }
    
    public function pusat()
    {
    	return $this->hasOne(Pusat::class,'id', 'id');
    }

    public function karyawan(){
        return $this->belongsToMany(Karyawan::class,  'karyawan_disposisi', 'disposisi_id', 'karyawan_id');
       
    }
}
