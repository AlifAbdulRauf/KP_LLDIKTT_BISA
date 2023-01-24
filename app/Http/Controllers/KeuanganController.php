<?php

namespace App\Http\Controllers;
use App\Models\Keuangan;
use App\Models\Lokasi;
use App\Models\Pusat;
use App\Models\Karyawan;
use App\Models\Disposisi;
use App\Models\Karyawan_Disposisi;
use App\Models\Transportasi;
use App\Models\Penginapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;
use PDF;

class KeuanganController extends Controller
{
    public $idKeuangan;

    public function __construct()
    {
       $this->Keuangan = new Keuangan();  
    }

    public function index()
    {
        $lokasi = Lokasi::all();
        $karyawan = Karyawan::all();
        $pusat = Karyawan::all();

        $items = Disposisi::select('disposisi.id','lokasi.nama_kota','pusat.no_surat','pusat.judul_surat','pusat.tanggal_pergi','pusat.tanggal_pulang','pusat.lampiran_undangan','pusat.status_disposisi')
        ->join('pusat','pusat.id', '=' , 'disposisi.pusat_id')
        ->join('lokasi','lokasi.id', '=' , 'pusat.lokasi_id')
        ->get();

        $itemss = Karyawan_Disposisi::select('karyawan_disposisi.id','karyawan_disposisi.disposisi_id','karyawan_disposisi.karyawan_id','karyawan.nama')
        ->join('disposisi','disposisi.id', '=' , 'karyawan_disposisi.disposisi_id')
        ->join('karyawan','karyawan.id', '=' , 'karyawan_disposisi.karyawan_id')
        ->get();

        return view('keuangan/index', compact('lokasi','karyawan','pusat','itemss') , ['items' => $items]);
    }

    public function show($id)
    {
        $lokasi = Lokasi::all();
        $karyawan = Karyawan::all();
        $pusat = Pusat::all();
        $pn = Penginapan::all();
        $transportasi = Transportasi::all();

        $item = Disposisi::select('disposisi.id','lokasi.nama_kota','pusat.no_surat','pusat.judul_surat','pusat.tanggal_pergi','pusat.tanggal_pulang','pusat.lampiran_undangan','pusat.status_disposisi')
        ->join('pusat','pusat.id', '=' , 'disposisi.pusat_id')
        ->join('lokasi','lokasi.id', '=' , 'pusat.lokasi_id')
        ->where('disposisi.id',$id)->first();

        // $itemss = Karyawan_Disposisi::select('karyawan_disposisi.id','karyawan_disposisi.disposisi_id','karyawan_disposisi.karyawan_id','karyawan.nama')
        // ->join('disposisi','disposisi.id', '=' , 'karyawan_disposisi.disposisi_id')
        // ->join('karyawan','karyawan.id', '=' , 'karyawan_disposisi.karyawan_id')
        // ->get();

        $jmlh_data = Karyawan_Disposisi::select(DB::raw('disposisi_id, count(id) as total'))
        ->groupby('disposisi_id')
        ->where('disposisi_id',$id)
        ->get();

        $tangap = Keuangan::where('disposisi_id', $id)->first();

        $date1 = $item->tanggal_pergi;
        $date2 = $item->tanggal_pulang;
        $date1Timestamp = strtotime($date1);
        $date2Timestamp = strtotime($date2);
        $difference = $date2Timestamp - $date1Timestamp;
        $days = date('d', $difference)-1;
        
        $data = Keuangan::select('keuangan.id','keuangan.disposisi_id','lokasi.besaran_lumpsum','transportasi.jenis_transportasi','penginapan.nama_penginapan','keuangan.uang_transport','keuangan.uang_penginapan')
        ->join('disposisi','keuangan.disposisi_id', 'disposisi.id')
        ->join('pusat','pusat.id', '=' , 'disposisi.pusat_id')
        ->join('lokasi','lokasi.id', '=' , 'pusat.lokasi_id')
        ->join('transportasi', 'transportasi.id', '=' , 'keuangan.transportasi_id')
        ->join('penginapan', 'penginapan.id', '=' , 'keuangan.penginapan_id')
        ->where('disposisi_id',$id)->first();

        $dataa = Keuangan::select('keuangan.id','keuangan.disposisi_id','lokasi.besaran_lumpsum','transportasi.jenis_transportasi','penginapan.nama_penginapan','keuangan.uang_transport','keuangan.uang_penginapan')
        ->join('disposisi','keuangan.disposisi_id', 'disposisi.id')
        ->join('pusat','pusat.id', '=' , 'disposisi.pusat_id')
        ->join('lokasi','lokasi.id', '=' , 'pusat.lokasi_id')
        ->join('transportasi', 'transportasi.id', '=' , 'keuangan.transportasi_id')
        ->join('penginapan', 'penginapan.id', '=' , 'keuangan.penginapan_id')
        ->where('disposisi_id',$id)
        ->get();

        return view('keuangan/show',  compact(['pusat','item','tangap','pn','data','dataa','days','pusat','transportasi','jmlh_data']));
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
            'disposisi_id' => 'required',
            'transportasi_id' => 'required',
            'penginapan_id' => 'required',
            'uang_transport' => 'required',
            'uang_penginapan' => 'required',
        ],[
            'disposisi_id.required' => 'judul surat harus diisi!',
            'transportasi_id.required' => 'transportasi surat harus diisi!',
            'penginapan_id.required' => 'penginapan surat harus diisi!',
            'uang_transport.required' => 'uang transport harus diisi!',
            'uang_penginapan.required' => 'uang penginapan harus diisi!',
        ]);


        $data = [
            'users_id' => $users_id,
            'disposisi_id' => Request()->disposisi_id,
            'transportasi_id' => Request()->transportasi_id,
            'penginapan_id' => Request()->penginapan_id,
            'uang_transport' => Request()->uang_transport,
            'uang_penginapan' => Request()->uang_penginapan,
        ];

        $this->Keuangan->addData($data);
        $id = $request->disposisi_id;
        Alert::success('Berhasil', 'Data Keuangan Berhasil Ditambahkan');
        return redirect()->route('keuangan.show', $id);
    }

    public function cetak(Request $request){
        
        $disposisi = DB::table('disposisi')
        ->join('pusat','pusat.id', '=' , 'disposisi.pusat_id')
        ->join('lokasi','lokasi.id', '=' , 'pusat.lokasi_id')
        ->where('disposisi.id',$request->id)
        ->select('disposisi.id','lokasi.nama_kota','pusat.no_surat','pusat.judul_surat','pusat.tanggal_pergi','pusat.tanggal_pulang','pusat.lampiran_undangan','pusat.status_disposisi')
        ->get();

        $itemss = Karyawan_Disposisi::select('karyawan_disposisi.id','karyawan_disposisi.disposisi_id','karyawan_disposisi.karyawan_id','karyawan.nama','karyawan.jabatan','karyawan.nip')
        ->join('disposisi','disposisi.id', '=' , 'karyawan_disposisi.disposisi_id')
        ->join('karyawan','karyawan.id', '=' , 'karyawan_disposisi.karyawan_id')
        ->where('disposisi_id',$request->id)
        ->get();
        
        $item = Disposisi::select('disposisi.id','lokasi.nama_kota','pusat.no_surat','pusat.judul_surat','pusat.tanggal_pergi','pusat.tanggal_pulang','pusat.lampiran_undangan','pusat.status_disposisi')
        ->join('pusat','pusat.id', '=' , 'disposisi.pusat_id')
        ->join('lokasi','lokasi.id', '=' , 'pusat.lokasi_id')
        ->where('Disposisi.id',$request->id)->first();

        $date1 = $item->tanggal_pergi;
        $date2 = $item->tanggal_pulang;
        $date1Timestamp = strtotime($date1);
        $date2Timestamp = strtotime($date2);
        $difference = $date2Timestamp - $date1Timestamp;
        $days = date('d', $difference)-1;


        $data = Keuangan::select('keuangan.id','keuangan.disposisi_id','lokasi.besaran_lumpsum','transportasi.jenis_transportasi','penginapan.nama_penginapan','keuangan.uang_transport','keuangan.uang_penginapan')
        ->join('disposisi','keuangan.disposisi_id', 'disposisi.id')
        ->join('pusat','pusat.id', '=' , 'disposisi.pusat_id')
        ->join('lokasi','lokasi.id', '=' , 'pusat.lokasi_id')
        ->join('transportasi', 'transportasi.id', '=' , 'keuangan.transportasi_id')
        ->join('penginapan', 'penginapan.id', '=' , 'keuangan.penginapan_id')
        ->where('disposisi_id',$request->id)->first();
        

        $itemsss = Keuangan::select('keuangan.id','keuangan.disposisi_id','pusat.lokasi_id','lokasi.besaran_lumpsum','transportasi.jenis_transportasi','penginapan.nama_penginapan','keuangan.uang_transport','keuangan.uang_penginapan')
        ->join('disposisi', 'keuangan.disposisi_id', 'disposisi.id')
        ->join('pusat', 'pusat.id', '=' , 'disposisi.pusat_id')
        ->join('lokasi','lokasi.id', '=' , 'pusat.lokasi_id')->where('pusat_id', $request->id)
        ->join('transportasi', 'transportasi.id', '=' , 'keuangan.transportasi_id')
        ->join('penginapan', 'penginapan.id', '=' , 'keuangan.penginapan_id')
        ->where('disposisi_id',$request->id)
        ->get();

        $jmlh_data = Karyawan_Disposisi::select(DB::raw('disposisi_id, count(id) as total'))
        ->groupby('disposisi_id')
        ->where('disposisi_id',$request->id)
        ->get();

        $pdf = PDF::loadview('/keuangan/cetak_suratp',['disposisi'=>$disposisi],compact('itemss','data','item','days','jmlh_data','itemsss') );
        return $pdf ->stream();
    }
    
}
