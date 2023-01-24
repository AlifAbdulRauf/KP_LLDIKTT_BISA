<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kantor extends Model
{
    protected $table = 'kantor';

    protected $fillable = ['id','lokasi_id','users_id','judul_surat','tanggal_pergi','tanggal_pulang','lampiran_surat'];

        
    // public function allData()
    // {
    //    return DB::table('kantor')
    //    ->select('kantor.id', 'lokasi.nama_kota', 'users.role_user', 'karyawan_kantor.karyawan_id','karyawan.nama', 'kantor.judul_surat', 'kantor.tanggal_pergi', 'kantor.tanggal_pulang', 'kantor.lampiran_surat')
    //     ->leftJoin('lokasi', 'lokasi.id', '=' , 'kantor.lokasi_id')
    //     ->leftJoin('users', 'users.id', '=' , 'kantor.users_id')
    //     ->leftJoin('karyawan_kantor', 'kantor.id', '=' , 'karyawan_kantor.kantor_id')
    //     ->leftJoin('karyawan', 'karyawan.id', '=' , 'karyawan_kantor.karyawan_id')
    //    ->get();
         
    // }

    public function addData($data)
    {
        DB::table('kantor')->insert($data);
    }

    public function lokasi(){
        return $this->belongsTo('App\Lokasi');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function karyawan(){
        return $this->belongsToMany(Karyawan::class,  'karyawan_kantor', 'kantor_id', 'karyawan_id');
       
    }
    public function details() {
        return $this->hasMany(Kantor::class, 'id', 'id');
    }

  
}