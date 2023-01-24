<?php

namespace App\Imports;

use App\Models\Lokasi;
use Maatwebsite\Excel\Concerns\ToModel;

class LokasiImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {      
        return new Lokasi([
            'nama_kota' => $row[0],
            'besaran_lumpsum' =>(int) $row[1],
        ]);
    }
}
