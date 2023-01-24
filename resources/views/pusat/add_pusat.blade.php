@extends('layout.v_template')


@section('main-content')

 <!-- Page Heading -->
 <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Tambah Surat') }}</h1>

 <!-- Main Content goes here -->
<form action="/pusat/insert" method="POST" enctype="multipart/form-data">
@csrf
<div class="content">
    <div class="row"> 
    <div class="col-sm-6">
        <div class="form-group">

            <label>Lokasi</label>
            <select name="lokasi_id" class="form-control" >
            <option value="" >- Pilih -</option>
            @foreach ($lokasi as $item)
            <option value="{{ $item->id }}" >{{ $item->nama_kota }}</option>
            @endforeach
            </select> </div>
            <!-- <div class="text-danger">
                @error('name')
                {{ $message }}
                @enderror
            </div> -->
            
            <!-- <div class="form-group">
            <label>User</label>
            <select name="users_id" class="form-control" >
            <option value="" >- Pilih -</option>
            @foreach ($users as $item)
            <option value="{{ $item->id }}" >{{ $item->role_user }}</option>
            @endforeach
            </select> </div> -->
            <!-- <div class="text-danger">
                @error('name')
                {{ $message }}
                @enderror
            </div> -->

        <div class="form-group">
            <label>Nomor Surat</label>
            <input name='no_surat' class="form-control" value="{{ old('no_surat') }}">
            <div class="text-danger">
                @error('no_surat')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Judul Surat</label>
            <input name='judul_surat' class="form-control" value="{{ old('judul_surat') }}">
            <div class="text-danger">
                @error('judul_surat')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Tanggal Pergi</label> 
            <div> </div>
            <input type='date' name='tanggal_pergi' class="form-control" value="{{ old('tanggal_pergi') }}">
            <div class="text-danger">
                @error('tanggal_pergi')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Tanggal Pulang</label> 
            <div> </div>
            <input type='date' name='tanggal_pulang' class="form-control" value="{{ old('tanggal_pulang') }}">
            <div class="text-danger">
                @error('tanggal_pulang')
                {{ $message }}
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Lampiran Surat</label> 
            <div> </div>
            <input type='file' name='lampiran_undangan' class="form-control" value="{{ old('lampiran_undangan') }}">
            <div class="text-danger">
                @error('lampiran_undangan')
                {{ $message }}
                @enderror
            </div>
        </div>

        <!-- <div class="form-group">
            <label>Status Disposisi</label>
            <input name='status_disposisi' class="form-control" value="{{ old('status_disposisi') }}">
            <div class="text-danger">
                @error('status_disposisi')
                {{ $message }}
                @enderror
            </div>
        </div> -->
        
        <div class="form-group">
            <button class="btn btn-primary btn-sm">Simpan</button>
            
        </div>
    </div>

    </div>
</div>

</form>

<!-- End of Main Content -->
@endsection