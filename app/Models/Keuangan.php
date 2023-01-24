<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Keuangan extends Model
{
    protected $table = 'keuangan';
    use HasFactory;
    protected $fillable = [
        'id', 'kantor_id', 'transportasi_id', 'penginapan_id', 'uang_transport', 'uang_penginapan',
    ];

    public function addData($data)
    {
        DB::table('keuangan')->insert($data);
    }

    public function disposisi()
    {
    	return $this->hasOne(Disposisi::class,'id', 'id');
    }

}
