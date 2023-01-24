<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class keuangan_penginapan extends Model
{
    protected $table = 'keuangan_penginapan';
    use HasFactory;
    protected $fillable = [
        'id', 'disposisi_id', 'kantor_id','penginapan_id', 'uang_penginapan',
    ];

    public function addData($data)
    {
        DB::table('keuangan_penginapan')->insert($data);
    }

    public function disposisi()
    {
    	return $this->hasOne(Disposisi::class,'id', 'id');
    }
}
