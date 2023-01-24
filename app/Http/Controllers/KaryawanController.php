<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class KaryawanController extends Controller
{

    public $Karyawan;

    public function __construct()
    {
       $this->$Karyawan = new Karyawan();  
    }

    public function index()
    {
        $data = [
            'karyawan' => $this->Karyawan->allData(),

        ];
       
        return view('karyawan/index', $data);
    }

    public function add()
    {
        return view ('karyawan/add_karyawan');
    }

    public function insert()
    {
        Request()->validate([
            'nip' => 'required|unique:karyawan,nip|',
            'nama' => 'required',
            'golongan' => 'required',
            'jabatan' => 'required',
            'divisi' => 'required',
        ],[
            'nip.required' => 'nip harus diisi!',
            'nip.unique' => 'nip sudah ada!',
            'nama.required' => 'nama harus diisi!',
            'golongan.required' => 'golongan harus diisi!',
            'jabatan.required' => 'jabatan harus diisi!',
            'divisi.required' => 'divisi harus diisi!',
        ]);

        $data = [
            'nip' => Request()->nip,
            'nama' => Request()->nama,
            'golongan' => Request()->golongan,
            'jabatan' => Request()->jabatan,
            'divisi' => Request()->divisi,
        ];

        $this->Karyawan->addData($data);
        Alert::success('Berhasil!', 'Data karyawan berhasil disimpan!');
        return redirect()->route('karyawan');

    }
    public function destroy($id)
    {
        DB::table('karyawan')->where('id', $id)->delete();
        Alert::success('Berhasil!', 'Data pegawai berhasil dihapus!');
        return redirect('karyawan');
    }

    public function edit($id)
    {
        $karyawan = DB::table('karyawan')->find($id);
        return view('karyawan/edit_karyawan',['karyawan'=>$karyawan]);
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

        $affected = DB::table('karyawan')
              ->where('id', $id)
              ->update(['nip' => $request->nip,
                        'nama' => $request->nama,
                        'golongan' => $request->golongan,
                        'jabatan' => $request->jabatan,
                        'divisi' => $request->divisi]);

            Alert::success('Berhasil!', 'Data pegawai berhasil diupdate!');
            return redirect('/karyawan');
    }
}
