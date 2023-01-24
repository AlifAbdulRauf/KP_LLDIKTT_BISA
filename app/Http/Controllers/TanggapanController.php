<?php

namespace App\Http\Controllers;
use App\Models\Pusat;
use App\Models\Disposisi;
use App\Models\Tanggapan;
use App\Models\Karyawan;
use App\Models\Karyawan_Disposisi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Http\Request;

class TanggapanController extends Controller
{

    public $Disposisi;
    public function __construct()
    {
       $this->Disposisi = new Disposisi();  
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $karyawan = Karyawan::all();
        $users = User::all();
        $pusat = Pusat::all();
        $item = Pusat::with([
            'details'
        ])->findOrFail($id);
        $it = Pusat::select('pusat.id')
        ->where('pusat.id',$id)->first();

        return view('tanggapan/add',[
        'item' => $item
        ] , compact('karyawan','users','pusat','it'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        DB::table('pusat')->where('id', $request->pusat_id)->update([
            'status_disposisi'=> $request->status_disposisi,
        ]);

       

        // $users_id = Auth::user()->id;        

            
        // $data = $request->all();

        // $data['pusat_id'] = $request->pusat_id;
        // $data['users_id']=$users_id;

        // Disposisi::create($data);
        if($request->status_disposisi=='Terima'){
        $users_id = Auth::user()->id;  
        $request->validate
        ([
            'pusat_id' => 'required',
        ],[
            'pusat_id.required' => 'lokasi harus diisi!',
            'karyawan_id.required' => 'karyawan harus diisi!',
        ]);

        $data = [
            'users_id' => $users_id,
            'pusat_id' => Request()->pusat_id,
        ];
        $this->Disposisi->addData($data);


        $disposisi = DB::getPdo()->lastInsertId();
        for($i=0;$i<count($request->karyawan_id);$i++){
            $karyawan_disposisi = Karyawan_Disposisi::create([
                'disposisi_id' => $disposisi,
                'karyawan_id' => Request()->karyawan_id[$i],
            ]);
        } }
        
        

        Alert::success('Berhasil', 'Disposisi berhasil ditanggapi');
        return redirect('/disposisi');
    }

}
