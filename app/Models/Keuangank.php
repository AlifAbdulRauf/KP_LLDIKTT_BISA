<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Keuangank extends Model
{
    protected $table = 'keuangan';
    use HasFactory;
    protected $fillable = [
        'id', 'kantor_id', 'transportasi_id', 'uang_transport',
    ];

    public function addData($data)
    {
        DB::table('keuangan')->insert($data);
    }

    public function kantor()
    {
    	return $this->hasOne(Kantor::class,'id', 'id');
    }
}