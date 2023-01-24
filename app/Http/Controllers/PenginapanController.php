<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penginapan;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PenginapanController extends Controller
{
    public $Penginapan;
    
    public function __construct()
    {
       $this->Penginapan = new Penginapan();  
    }

    public function index()
    {
        $data = [
            'penginapan' => $this->Penginapan->allData(),

        ];
        return view('penginapan/index', $data);
    }

    public function add()
    {
        return view ('penginapan/add_penginapan');
    }

    public function insert()
    {
        Request()->validate([
            'nama_penginapan' => 'required',
            'lokasi' => 'required',
        ],[
            'nama_penginapan.required' => 'nama penginapan harus diisi!',
            'lokasi.required' => 'Lokasi penginapan harus diisi!',
        ]);

        $data = [
            'nama_penginapan' => Request()->nama_penginapan,
            'lokasi' => Request()->lokasi,
        ];

        $this->Penginapan->addData($data);
        Alert::success('Berhasil!', 'Data penginapan berhasil disimpan!');
        return redirect()->route('penginapan');

    }
    public function destroy($id)
    {
        DB::table('penginapan')->where('id', $id)->delete();
        Alert::success('Berhasil!', 'Data penginapan berhasil dihapus!');
        return redirect('penginapan');
    }

    public function edit($id)
    {
        $penginapan = DB::table('penginapan')->find($id);
        return view('penginapan/edit_penginapan',['penginapan'=>$penginapan]);
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

        $affected = DB::table('penginapan')
              ->where('id', $id)
              ->update(['nama_penginapan' => $request->nama_penginapan,'lokasi' => $request->lokasi]);

            Alert::success('Berhasil!', 'Data penginapan berhasil diupdate!');
            return redirect('/penginapan');
    }
}