<?php

namespace App\Http\Controllers;
use App\Models\Kantor;
use App\Models\Lokasi;
use App\Models\Karyawan;
use Illuminate\Support\Facades\DB;
use PDF;
use Illuminate\Http\Request;
use App\Models\Karyawan_Kantor;

class SurattugaskController extends Controller
{
    public function index()
    {
        // $lokasi = Lokasi::all();
        // $karyawan = Karyawan::all();
        // $id = 'kantor_id';
        // $id = Kantor::all()->id;  
        // $items = Kantor::orderBy('created_at', 'DESC')->get();

        $items = Kantor::select('kantor.id','lokasi.nama_kota','kantor.judul_surat','kantor.tanggal_pergi','kantor.tanggal_pulang','kantor.lampiran_surat')
        ->join('lokasi', 'lokasi.id', '=' , 'kantor.lokasi_id')
        ->join('users', 'users.id', '=' , 'kantor.users_id')
        ->get();


        // dd($items);
        return view('/surat_tugask/index', compact('items'));
    }
    public function cetak(Request $request){
        
        $kantor = DB::table('kantor')
        ->join('lokasi', 'lokasi.id', '=' , 'kantor.lokasi_id')
        ->join('users', 'users.id', '=' , 'kantor.users_id')
        ->where('kantor.id',$request->id)
        ->select('kantor.tanggal_pergi','kantor.tanggal_pulang','lokasi.nama_kota')
        ->get();
       
        $itemss = Karyawan_Kantor::select('karyawan_kantor.id','karyawan_kantor.kantor_id','karyawan_kantor.karyawan_id','karyawan.nama','karyawan.jabatan')
        ->join('kantor','kantor.id', '=' , 'karyawan_kantor.kantor_id')
        ->join('karyawan','karyawan.id', '=' , 'karyawan_kantor.karyawan_id')
        ->where('kantor_id',$request->id)
        ->get();
        
        $pdf = PDF::loadview('/surat_tugask/cetak_suratk',['kantor'=>$kantor],compact('itemss') );
        return $pdf ->stream();
    }

}

