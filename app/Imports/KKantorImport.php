<?php

namespace App\Imports;
use Carbon\Carbon;

use App\Models\Kantor;
use App\Models\Karyawan_Kantor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Auth;

class KKantorImport implements ToCollection
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {


        // $data = [
        //     'users_id' => $row[2],
        //     'lokasi_id' => $row[2],
        //     'judul_surat' => $row[3],
        //     'tanggal_pergi' => $tglPgi,
        //     'tanggal_pulang' => $tglPlg,
        //     'lampiran_surat' => $row[6],
        // ];
        // $this->kantor->lokasi_id = $row[1];
        // $this->kantor->users_id = $row[2];
        // $this->kantor->judul_surat = $row[3];
        // $this->kantor->tanggal_pergi = $tglPgi;
        // $this->kantor->tanggal_pulang =$tglPlg;
        // $this->kantor->lampiran_surat = $row[6];

        // $this->kantor->addData($data);

        foreach ($rows as $row)
        {
            $tglPgi = Carbon::createFromFormat('Y-m-d H', $row[4])->toDateTimeString();
            $tglPlg = Carbon::createFromFormat('Y-m-d H', $row[5])->toDateTimeString();
            $kantor = Kantor::create([
                'users_id' => $row[2],
                'lokasi_id' => $row[1],
                'judul_surat' => $row[3],
                'tanggal_pergi' => $tglPgi,
                'tanggal_pulang' => $tglPlg,
                'lampiran_surat' => $row[6],
               ]);
    
               $karyawan_id = $row[7];
               $myArray = explode(',', $karyawan_id);
               foreach ($myArray as $value) {
                   Karyawan_Kantor::create([
                        'kantor_id' => $kantor->id,
                        'karyawan_id' => $value,
                   ]);
               }
        }
    }
}
