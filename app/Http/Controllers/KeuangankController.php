<?php

namespace App\Http\Controllers;
use App\Models\Kantor;
use App\Models\Karyawan;
use App\Models\Karyawan_Kantor;
use App\Models\Keuangan;
use App\Models\Tipe_lumpsum;
use App\Models\Keuangank;
use App\Models\Lokasi;
use App\Models\Transportasi;
use App\Models\Penginapan;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class KeuangankController extends Controller
{
    public $idKeuangan;

    public function __construct()
    {
       $this->idKeuangan = new Keuangan();  
    }
    
    public function index()
    {
        $items = Kantor::select('kantor.id','lokasi.nama_kota','kantor.judul_surat','kantor.tanggal_pergi','kantor.tanggal_pulang','kantor.lampiran_surat')
        ->join('lokasi', 'lokasi.id', '=' , 'kantor.lokasi_id')
        ->join('users', 'users.id', '=' , 'kantor.users_id')
        ->get();

        


        // dd($items);
        return view('/keuangank/index', compact('items'));
    }

    public function tampil($id){

        $item = Kantor::select('kantor.id','lokasi.nama_kota','kantor.judul_surat','kantor.tanggal_pergi','kantor.tanggal_pulang','kantor.lampiran_surat')
        ->join('lokasi', 'lokasi.id', '=' , 'kantor.lokasi_id')
        ->join('users', 'users.id', '=' , 'kantor.users_id')
        ->where('kantor.id',$id)->first();

        $tangap = Keuangan::where('kantor_id', $id)->first();
        // $karyawan[] = Karyawan::all();
    //     $kantors = Kantor::select('kantor.id', 'lokasi.nama_kota', 'users.role_user', 'kantor.judul_surat', 'kantor.tanggal_pergi', 'kantor.tanggal_pulang', 'kantor.lampiran_surat')
    //     ->join('lokasi', 'lokasi.id', '=' , 'kantor.lokasi_id')
    //     ->join('users', 'users.id', '=' , 'kantor.users_id')
    //    ->get();
        // $awal = strtotime('tanggal_pergi');
        // $akhir = strtotime('tanggal_pulang');
        // $diff = date_diff($awal, $akhir);
     

        return view('keuangank/tampil',  compact(['item','tangap']));
        
    }
    
    public function show($id){

        $kantor = Kantor::all();
        $tipeLump = Tipe_lumpsum::all();
        $pn = Penginapan::all();
        $transportasi = Transportasi::all();
        $lokasii = Lokasi::all();
        $karyawan = Karyawan::all();
        $item = Kantor::select('kantor.id','lokasi.nama_kota','kantor.judul_surat','kantor.tanggal_pergi','kantor.tanggal_pulang','kantor.lampiran_surat')
        ->join('lokasi', 'lokasi.id', '=' , 'kantor.lokasi_id')
        ->join('users', 'users.id', '=' , 'kantor.users_id')
        ->where('kantor.id',$id)->first();

        $jmlh_data = Karyawan_Kantor::select(DB::raw('kantor_id, count(id) as total'))
        ->groupby('kantor_id')
        ->where('kantor_id',$id)
        ->get();

        $itemUang = Tipe_lumpsum::select('reff_tipe_lumpsum.id', 'reff_tipe_lumpsum.tipe_lumpsum', 'reff_tipe_lumpsum.biaya','keuangan.tipe_penginapan_id') 
        ->join('keuangan', 'keuangan.tipe_penginapan_id', '=', 'reff_tipe_lumpsum.id')
        ->where('tipe_penginapan_id',$id)->first();

        $tangap = Keuangan::where('kantor_id', $id)->first();
        // $karyawan[] = Karyawan::all();
    //     $kantors = Kantor::select('kantor.id', 'lokasi.nama_kota', 'users.role_user', 'kantor.judul_surat', 'kantor.tanggal_pergi', 'kantor.tanggal_pulang', 'kantor.lampiran_surat')
    //     ->join('lokasi', 'lokasi.id', '=' , 'kantor.lokasi_id')
    //     ->join('users', 'users.id', '=' , 'kantor.users_id')
    //    ->get();
        // $awal = strtotime('tanggal_pergi');
        // $akhir = strtotime('tanggal_pulang');
        // $diff = date_diff($awal, $akhir);

        $date1 = $item->tanggal_pergi;
        $date2 = $item->tanggal_pulang;
        $date1Timestamp = strtotime($date1);
        $date2Timestamp = strtotime($date2);
        $difference = $date2Timestamp - $date1Timestamp;
        $days = date('d', $difference)-1;
        
        $items = Keuangan::select('keuangan.id','keuangan.kantor_id','lokasi.besaran_lumpsum','transportasi.jenis_transportasi','penginapan.nama_penginapan','keuangan.uang_transport','keuangan.uang_penginapan')
        ->join('kantor', 'keuangan.kantor_id', 'kantor.id')
        ->join('lokasi','lokasi.id', '=' , 'kantor.lokasi_id')->where('kantor.id', $id)
        ->join('transportasi', 'transportasi.id', '=' , 'keuangan.transportasi_id')
        ->join('penginapan', 'penginapan.id', '=' , 'keuangan.penginapan_id')
        ->join('reff_tipe_lumpsum','reff_tipe_lumpsum.id', '=','keuangan.tipe_penginapan_id')
        ->where('kantor_id',$id)->first();
    
        $itemss = Keuangan::select('keuangan.id','keuangan.kantor_id','keuangan.tipe_penginapan_id','reff_tipe_lumpsum.tipe_lumpsum','reff_tipe_lumpsum.biaya','lokasi.nama_kota','lokasi.besaran_lumpsum','transportasi.jenis_transportasi','penginapan.nama_penginapan','keuangan.uang_transport','keuangan.uang_penginapan')
        ->join('kantor', 'keuangan.kantor_id', 'kantor.id')
        ->join('lokasi','lokasi.id', '=' , 'kantor.lokasi_id')->where('kantor.id', $id)
        ->join('transportasi', 'transportasi.id', '=' , 'keuangan.transportasi_id')
        ->join('penginapan', 'penginapan.id', '=' , 'keuangan.penginapan_id')
        ->join('reff_tipe_lumpsum','reff_tipe_lumpsum.id', '=','keuangan.tipe_penginapan_id')
        ->where('kantor_id',$id)
        ->get();
        

        // $transport = $items->uang_transport;
        // $besarantr = (2*$transport);

        // $penginapan = $items->uang_penginapan;
        // $besaranpn = ($days * $penginapan);

        // $lump = $items->besaran_lumpsum;
        // $besaranlm = ($days * $lump);

        // $jumlah = ($besarantr+$besaranpn+$besaranlm);


        return view('keuangank/show',  compact(['item','lokasii','itemUang','tangap','pn','tipeLump','items','itemss','days','kantor','transportasi','jmlh_data']));
        
    }

    public function add($id){


        $kantor = Kantor::all();
        $transportasi = Transportasi::all();
        $penginapan = Penginapan::all();
        return view('keuangank/add' , compact('kantor','transportasi','penginapan'));
        
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
            'transportasi_id' => 'required',
            'penginapan_id' => 'required',
            'tipe_penginapan_id' => 'required',
            'id_lokasi' => 'required',
            'hari' => 'required',
            'uang_transport' => 'required',
            'uang_penginapan' => 'required',
        ],[
            'kantor_id.required' => 'judul surat harus diisi!',
            'transportasi_id.required' => 'transportasi surat harus diisi!',
            'tipe_penginapan_id.required' => 'tipe penginapan surat harus diisi!',
            'penginapan_id.required' => 'penginapan surat harus diisi!',
            'id_lokasi.required' => 'lokasi surat harus diisi!',
            'hari.required' => 'hari harus diisi!',
            'uang_transport.required' => 'uang transport harus diisi!',
            'uang_penginapan.required' => 'uang penginapan harus diisi!',
        ]);


        $data = [
            'users_id' => $users_id,
            'kantor_id' => Request()->kantor_id,
            'transportasi_id' => Request()->transportasi_id,
            'tipe_penginapan_id' => Request()->tipe_penginapan_id,
            'penginapan_id' => Request()->penginapan_id,
            'id_lokasi' => Request()->id_lokasi,
            'hari' => Request()->hari,
            'uang_transport' => Request()->uang_transport,
            'uang_penginapan' => Request()->uang_penginapan,
        ];

        $this->idKeuangan->addData($data);
        $id = $request->kantor_id;
        Alert::success('Berhasil', 'Data Keuangan Berhasil Ditambahkan');
        return redirect()->route('keuangank.show', $id);
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

        $items = Keuangan::select('keuangan.id','keuangan.kantor_id','lokasi.besaran_lumpsum','transportasi.jenis_transportasi','penginapan.nama_penginapan','keuangan.uang_transport','keuangan.uang_penginapan')
        ->join('kantor', 'keuangan.kantor_id', 'kantor.id')
        ->join('lokasi','lokasi.id', '=' , 'kantor.lokasi_id')->where('kantor.id', $request->id)
        ->join('transportasi', 'transportasi.id', '=' , 'keuangan.transportasi_id')
        ->join('penginapan', 'penginapan.id', '=' , 'keuangan.penginapan_id')
        ->where('kantor_id',$request->id)->first();
    
        $itemsss = Keuangan::select('keuangan.id','keuangan.kantor_id','lokasi.besaran_lumpsum','transportasi.jenis_transportasi','penginapan.nama_penginapan','keuangan.uang_transport','keuangan.uang_penginapan')
        ->join('kantor', 'keuangan.kantor_id', 'kantor.id')
        ->join('lokasi','lokasi.id', '=' , 'kantor.lokasi_id')->where('kantor.id', $request->id)
        ->join('transportasi', 'transportasi.id', '=' , 'keuangan.transportasi_id')
        ->join('penginapan', 'penginapan.id', '=' , 'keuangan.penginapan_id')
        ->where('kantor_id',$request->id)
        ->get();

        $jmlh_data = Karyawan_Kantor::select(DB::raw('kantor_id, count(id) as total'))
        ->groupby('kantor_id')
        ->where('kantor_id',$request->id)
        ->get();
        
        $pdf = PDF::loadview('/keuangank/cetak_suratk',['kantor'=>$kantor],compact('itemss','item','days','items','itemsss','jmlh_data') );
        return $pdf ->stream();
    }
    public function destroy($id)
    {
        DB::table('keuangan')->where('id', $id)->delete();
        Alert::success('Berhasil!', 'Data keuangan berhasil dihapus!');
        return redirect('keuangank/show');
    }
}
