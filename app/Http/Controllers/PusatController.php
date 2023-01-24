<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pusat;
use App\Models\Lokasi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class PusatController extends Controller
{
    public function __construct()
    {
       $this->Pusat = new Pusat();  
    }

    public function index()
    {
        $data = [
            'pusat' => $this->Pusat->allData(),

        ];
        return view('pusat/index', $data);
    }

    public function add()
    {
        $lokasi = Lokasi::all();
        $users = User::all();
        return view ('pusat/add_pusat', compact('lokasi','users'));
    }

    public function insert(Request $request)
    {
        $users_id = Auth::user()->id;   
        $request->validate
        ([
            'lokasi_id' => 'required',
            'no_surat' => 'required',
            'judul_surat' => 'required',
            'tanggal_pergi' => 'required',
            'tanggal_pulang' => 'required',
            'lampiran_undangan' => 'required | mimes:doc,docx,pdf,xls,xlxs',
        ],[
            'lokasi_id.required' => 'lokasi harus diisi!',
            'no_surat.required' => 'nomor surat harus diisi!',
            'judul_surat.required' => 'judul surat harus diisi!',
            'tanggal_pergi.required' => 'tanggal pergi harus diisi!',
            'tanggal_pulang.required' => 'tanggal pulang harus diisi!',
            'lampiran_undangan.required' => 'lampiran surat harus diisi!',
        ]);

        $file = Request()->lampiran_undangan;
        $fileName = Request()->no_surat . '.' . $file->extension();
        $file->move(public_path('lampiran_undangan'), $fileName);

        $data = [
            'users_id' => $users_id,
            'lokasi_id' => Request()->lokasi_id,
            'no_surat' => Request()->no_surat,
            'judul_surat' => Request()->judul_surat,
            'tanggal_pergi' => Request()->tanggal_pergi,
            'tanggal_pulang' => Request()->tanggal_pulang,
            'lampiran_undangan' => $fileName,
        ];

        $this->Pusat->addData($data);
        Alert::success('Berhasil!', 'Data undangan berhasil disimpan!');
        return redirect()->route('pusat');

    }
    public function destroy($id)
    {
        DB::table('pusat')->where('id', $id)->delete();
        Alert::success('Berhasil!', 'Data undangan berhasil dihapus!');
        return redirect('pusat');
    }

    public function edit($id)
    {
        $lokasi = Lokasi::all();
        $users = User::all();
        $pusat = DB::table('pusat')->find($id);
        return view('pusat/edit_pusat',compact('lokasi','users') , ['pusat'=>$pusat]);

        // $pusat = Pusat::select('pusat.id','lokasi.nama_kota','users.role_user','pusat.no_surat','pusat.judul_surat','pusat.tanggal_pergi','pusat.tanggal_pulang','pusat.lampiran_undangan','pusat.status_disposisi')
        // ->join('lokasi','lokasi.id', '=' , 'pusat.lokasi_id')->where('pusat.id', $id)
        // ->join('users','users.id', '=' , 'pusat.users_id')->where('pusat.id', $id)->first();
        // return view('pusat/edit_pusat',compact('pusat','lokasi','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // DB::table('karyawan')
        //     ->updateOrInsert(
        //         ['nama_karyawan' => $request->nama_karyawan,
        //          'alamat' => $request->alamat,
        //          'no_hp' => $request->no_hp]
        //     );

        // $pusat = DB::table('pusat')->find($id);
        // $destination = 'lampiran_undangan'.$pusat->lampiran_undangan;
        // if(File::exist($destination))
        // {
        //     File::delete($destination);
        // }
        $users_id = Auth::user()->id; 
        if(Request()->lampiran_undangan <> ""){
            $file = Request()->lampiran_undangan;
            $fileName = Request()->no_surat . '.' . $file->extension();
            $file->move(public_path('lampiran_undangan'), $fileName);

            $affected = DB::table('pusat')
                ->where('id', $id)
                ->update([  'users_id' => $users_id,
                            'lokasi_id' => $request->lokasi_id,
                            'no_surat' => $request->no_surat,
                            'judul_surat' => $request->judul_surat,
                            'tanggal_pergi' => $request->tanggal_pergi,
                            'tanggal_pulang' => $request->tanggal_pulang,
                            'lampiran_undangan' => $fileName
                            ]);

            Alert::success('Berhasil!', 'Data surat berhasil diupdate!');

        }else{
            $affected = DB::table('pusat')
                ->where('id', $id)
                ->update([  'users_id' => $users_id,
                            'lokasi_id' => $request->lokasi_id,
                            'no_surat' => $request->no_surat,
                            'judul_surat' => $request->judul_surat,
                            'tanggal_pergi' => $request->tanggal_pergi,
                            'tanggal_pulang' => $request->tanggal_pulang]);

            Alert::success('Berhasil!', 'Data surat berhasil diupdate!');

        }
        
        // $status->update($data);    
        return redirect('/pusat');
    }
}
