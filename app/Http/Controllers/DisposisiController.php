<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pusat;
use App\Models\Disposisi;
use App\Models\Karyawan;
use App\Models\Karyawan_Disposisi;
use App\Models\Tanggapan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;

class DisposisiController extends Controller
{
    public function index()
    {
        $items = Pusat::orderBy('created_at', 'DESC')->get();
        return view('/disposisi/index', [
            'items' => $items
        ]);
    }

    public function show($id)
    {
        
        $item = Pusat::with([
            'details'
        ])->findOrFail($id);


        $tangap = Disposisi::where('pusat_id', $id)->first();
        // $karyawan[] = Karyawan::all();
    //     $kantors = Kantor::select('kantor.id', 'lokasi.nama_kota', 'users.role_user', 'kantor.judul_surat', 'kantor.tanggal_pergi', 'kantor.tanggal_pulang', 'kantor.lampiran_surat')
    //     ->join('lokasi', 'lokasi.id', '=' , 'kantor.lokasi_id')
    //     ->join('users', 'users.id', '=' , 'kantor.users_id')
    //    ->get();
        

        return view('disposisi/show', [
            'item' => $item,
            'tangap' => $tangap
        ]);
    }
}
