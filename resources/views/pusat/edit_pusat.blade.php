@extends('layout.v_template')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Edit Data Surat Pusat') }}</h1>

<!-- Main Content goes here -->
<form action="/pusat/update/{{ $pusat->id }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="content">
    <div class="row"> 
    <div class="col-sm-6">
    <div class="form-group">
            <label>Lokasi</label> 
            <select name="lokasi_id" class="form-control @error('lokasi_id') is-invalid @enderror">
            <option value="">- Pilih -</option>
            @foreach($lokasi as $item)
            <option value="{{ $item->id }}" {{ old('lokasi_id', $pusat->lokasi_id) == $item->id ? 'selected' : null }}>{{ $item->nama_kota}}</option> 
            @endforeach
            </select>
            <div class="text-danger">
                @error('lokasi_id')
                {{ $message }}
                @enderror
            </div>
        </div>

        <!-- <div class="form-group">
            <label>User</label> 
            <select name="users_id" class="form-control @error('users_id') is-invalid @enderror">
            <option value="">- Pilih -</option>
            @foreach($users as $item)
            <option value="{{ $item->id }}" {{ old('users_id', $pusat->users_id) == $item->id ? 'selected' : null }}>{{ $item->role_user}}</option> 
            @endforeach
            </select>
            <div class="text-danger">
                @error('users_id')
                {{ $message }}
                @enderror
            </div>
        </div> -->

       

        <div class="form-group">
            <label>Nomor Surat</label>
            <input name="no_surat" class="form-control" value="{{ $pusat->no_surat }}">
            <div class="text-danger">
                @error('no_surat')
                {{ $message }}
                @enderror
            </div>

            <div class="form-group">
            <label>Judul Surat</label>
            <input name="judul_surat" class="form-control" value="{{ $pusat->judul_surat }}">
            <div class="text-danger">
                @error('judul_surat')
                {{ $message }}
                @enderror
            </div>

            <div class="form-group">
            <label>Tanggal Pergi</label>
            <input type ='date' name="tanggal_pergi" class="form-control" value="{{ $pusat->tanggal_pergi }}">
            <div class="text-danger">
                @error('tanggal_pergi')
                {{ $message }}
                @enderror
            </div>

            <div class="form-group">
            <label>Tanggal Pulang</label>
            <input type ='date' name="tanggal_pulang" class="form-control" value="{{ $pusat->tanggal_pulang }}">
            <div class="text-danger">
                @error('tanggal_pulang')
                {{ $message }}
                @enderror
            </div>

            <div class="form-group">
            <label>Lampiran Surat</label>
            <input type ='file' name="lampiran_undangan" class="form-control" value="{{ $pusat->lampiran_undangan }}">
            <div> 
            <a href="{{ asset('lampiran_undangan/'. $pusat->lampiran_undangan )}}" target="_blank" rel="noopener noreferrer"> {{$pusat->lampiran_undangan}} </a>  </div>
            <div class="text-danger">
                @error('lampiran_undangan')
                {{ $message }}
                @enderror
            </div>
            
            <!-- <div class="form-group">
            <label>Status</label>
            <input name='status_disposisi' class="form-control" value="{{ $pusat->status_disposisi }}">
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