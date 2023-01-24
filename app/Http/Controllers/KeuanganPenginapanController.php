<?php

namespace App\Http\Controllers;
use App\Models\Kantor;
use App\Models\Karyawan;
use App\Models\Karyawan_Kantor;
use App\Models\Keuangan;
use App\Models\keuangan_penginapan;
use App\Models\Keuangank;
use App\Models\Keuangankk;
use App\Models\Lokasi;
use App\Models\Transportasi;
use App\Models\Penginapan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

use Illuminate\Http\Request;

class KeuanganPenginapanController extends Controller
{
    public $idKeuanganP;

    public function __construct()
    {
       $this->idKeuanganP = new keuangan_penginapan();  
    }
    
    public function index()
    {
        $items = Kantor::select('kantor.id','lokasi.nama_kota','kantor.judul_surat','kantor.tanggal_pergi','kantor.tanggal_pulang','kantor.lampiran_surat')
        ->join('lokasi', 'lokasi.id', '=' , 'kantor.lokasi_id')
        ->join('users', 'users.id', '=' , 'kantor.users_id')
        ->get();


        // dd($items);
        return view('/keuangan_penginapan/index', compact('items'));
    }

    public function tampil($id){

        $item = Kantor::select('kantor.id','lokasi.nama_kota','kantor.judul_surat','kantor.tanggal_pergi','kantor.tanggal_pulang','kantor.lampiran_surat')
        ->join('lokasi', 'lokasi.id', '=' , 'kantor.lokasi_id')
        ->join('users', 'users.id', '=' , 'kantor.users_id')
        ->where('kantor.id',$id)->first();

        $tangap = keuangan_penginapan::where('kantor_id', $id)->first();

        return view('keuangan_penginapan/tampil',  compact(['item','tangap']));
        
    }
    
    public function show($id){

        $kantor = Kantor::all();
        $pn = Penginapan::all();
        $transportasi = Transportasi::all();
        $karyawan = Karyawan::all();
        $item = Kantor::select('kantor.id','lokasi.nama_kota','kantor.judul_surat','kantor.tanggal_pergi','kantor.tanggal_pulang','kantor.lampiran_surat')
        ->join('lokasi', 'lokasi.id', '=' , 'kantor.lokasi_id')
        ->join('users', 'users.id', '=' , 'kantor.users_id')
        ->where('kantor.id',$id)->first();

        $jmlh_data = Karyawan_Kantor::select(DB::raw('kantor_id, count(id) as total'))
        ->groupby('kantor_id')
        ->where('kantor_id',$id)
        ->get();

        

        $tangap = keuangan_penginapan::where('kantor_id', $id)->first();

        $date1 = $item->tanggal_pergi;
        $date2 = $item->tanggal_pulang;
        $date1Timestamp = strtotime($date1);
        $date2Timestamp = strtotime($date2);
        $difference = $date2Timestamp - $date1Timestamp;
        $days = date('d', $difference)-1;
        
        $items = keuangan_penginapan::select('keuangan_penginapan.id','keuangan_penginapan.kantor_id','lokasi.besaran_lumpsum','penginapan.nama_penginapan','keuangan_penginapan.uang_penginapan')
        ->join('kantor', 'keuangan_penginapan.kantor_id', 'kantor.id')
        ->join('lokasi','lokasi.id', '=' , 'kantor.lokasi_id')->where('kantor.id', $id)
        ->join('penginapan', 'penginapan.id', '=' , 'keuangan_penginapan.penginapan_id')
        ->where('kantor_id',$id)->first();
    
        $itemss = keuangan_penginapan::select('keuangan_penginapan.id','keuangan_penginapan.kantor_id','lokasi.besaran_lumpsum','penginapan.nama_penginapan','keuangan_penginapan.uang_penginapan')
        ->join('kantor', 'keuangan.kantor_id', 'kantor.id')
        ->join('lokasi','lokasi.id', '=' , 'kantor.lokasi_id')->where('kantor.id', $id)
        ->join('penginapan', 'penginapan.id', '=' , 'keuangan_penginapan.penginapan_id')
        ->where('kantor_id',$id)
        ->get();


        // $transport = $items->uang_transport;
        // $besarantr = (2*$transport);

        // $penginapan = $items->uang_penginapan;
        // $besaranpn = ($days * $penginapan);

        // $lump = $items->besaran_lumpsum;
        // $besaranlm = ($days * $lump);

        // $jumlah = ($besarantr+$besaranpn+$besaranlm);


        return view('keuangan_penginapan/show',  compact(['item','tangap','pn','items','itemss','days','kantor','transportasi','jmlh_data']));
        
    }

    public function add($id){


        $kantor = Kantor::all();
        $transportasi = Transportasi::all();
        $penginapan = Penginapan::all();
        return view('keuangan_penginapan/add' , compact('kantor','penginapan'));
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        
       
        $users_id = Auth::user()->id;   
        $request->validate
        ([
            'kantor_id' => 'required',
            'penginapan_id' => 'required',
            'uang_penginapan' => 'required',
        ],[
            'kantor_id.required' => 'judul surat harus diisi!',
            'penginapan_id.required' => 'penginapan surat harus diisi!',
            'uang_penginapan.required' => 'uang penginapan harus diisi!',
        ]);


        $data = [
            'users_id' => $users_id,
            'kantor_id' => Request()->kantor_id,
            'penginapan_id' => Request()->penginapan_id,
            'uang_penginapan' => Request()->uang_penginapan,
        ];

        $this->idKeuanganP->addData($data);
        $id = $request->kantor_id;
        Alert::success('Berhasil', 'Data Keuangan Berhasil Ditambahkan');
        return redirect()->route('keuangan_penginapan.show', $id);
    }



    public function cetak(Request $request){
        
        $kantor = DB::table('kantor')
        ->join('lokasi', 'lokasi.id', '=' , 'kantor.lokasi_id')
        ->join('users', 'users.id', '=' , 'kantor.users_id')
        ->where('kantor.id',$request->id)
        ->select('kantor.tanggal_pergi','kantor.tanggal_pulang','kantor.judul_surat','lokasi.nama_kota')
        ->get();
       
        $itemss = Karyawan_Kantor::select('karyawan_kantor.id','karyawan_kantor.kantor_id','karyawan_kantor.karyawan_id','karyawan.nama','karyawan.jabatan','karyawan.nip')
        ->join('kantor','kantor.id', '=' , 'karyawan_kantor.kantor_id')
        ->join('karyawan','karyawan.id', '=' , 'karyawan_kantor.karyawan_id')
        ->where('kantor_id',$request->id)
        ->get();

        $item = Kantor::select('kantor.id','lokasi.nama_kota','kantor.judul_surat','kantor.tanggal_pergi','kantor.tanggal_pulang','kantor.lampiran_surat')
        ->join('lokasi', 'lokasi.id', '=' , 'kantor.lokasi_id')
        ->join('users', 'users.id', '=' , 'kantor.users_id')
        ->where('kantor.id',$request->id)->first();
       

        $date1 = $item->tanggal_pergi;
        $date2 = $item->tanggal_pulang;
        $date1Timestamp = strtotime($date1);
        $date2Timestamp = strtotime($date2);
        $difference = $date2Timestamp - $date1Timestamp;
        $days = date('d', $difference)-1;

        $items = Keuangan::select('keuangan.id','keuangan.kantor_id','lokasi.besaran_lumpsum','transportasi.jenis_transportasi','keuangan.uang_transport')

        //$items = Keuangan::select('keuangan.id','keuangan.kantor_id','lokasi.besaran_lumpsum','transportasi.jenis_transportasi','penginapan.nama_penginapan','keuangan.uang_transport','keuangan.uang_penginapan')
        ->join('kantor', 'keuangan.kantor_id', 'kantor.id')
        ->join('lokasi','lokasi.id', '=' , 'kantor.lokasi_id')->where('kantor.id', $request->id)
        ->join('transportasi', 'transportasi.id', '=' , 'keuangan.transportasi_id')
        ->where('kantor_id',$request->id)->first();
    
        $itemsss = Keuangan::select('keuangan.id','keuangan.kantor_id','lokasi.besaran_lumpsum','transportasi.jenis_transportasi','keuangan.uang_transport')

        //$itemsss = Keuangan::select('keuangan.id','keuangan.kantor_id','lokasi.besaran_lumpsum','transportasi.jenis_transportasi','penginapan.nama_penginapan','keuangan.uang_transport','keuangan.uang_penginapan')
        ->join('kantor', 'keuangan.kantor_id', 'kantor.id')
        ->join('lokasi','lokasi.id', '=' , 'kantor.lokasi_id')->where('kantor.id', $request->id)
        ->join('transportasi', 'transportasi.id', '=' , 'keuangan.transportasi_id')
        ->where('kantor_id',$request->id)
        ->get();

        $jmlh_data = Karyawan_Kantor::select(DB::raw('kantor_id, count(id) as total'))
        ->groupby('kantor_id')
        ->where('kantor_id',$request->id)
        ->get();
        
        $pdf = PDF::loadview('/keuangan_penginapan/cetak_suratk',['kantor'=>$kantor],compact('itemss','item','days','items','itemsss','jmlh_data') );

        return $pdf ->stream();
    }
    public function destroy($id)
    {
        DB::table('keuangan_penginapan')->where('id', $id)->delete();
        Alert::success('Berhasil!', 'Data keuangan berhasil dihapus!');
        return redirect('keuangan_penginapan/show');
    }
}
