@extends('layout.v_template')

@section('main-content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Edit Penginapan') }}</h1>

<!-- Main Content goes here -->
<form action="/penginapan/update/{{ $penginapan->id }}" method="POST" enctype="multipart/form-data">
@csrf
<div class="content">
    <div class="row"> 
    <div class="col-sm-6">
        <div class="form-group">
            <label>Nama Penginapan</label>
            <input name="nama_penginapan" class="form-control" value="{{ $penginapan->nama_penginapan }}">
            <div class="text-danger">
                @error('nama_penginapan')
                {{ $message }}
                @enderror
            </div>  </div>
            <div class="form-group">
            <label>Lokasi</label>
            <input name="lokasi" class="form-control" value="{{ $penginapan->lokasi }}">
            <div class="text-danger">
                @error('lokasi')
                {{ $message }}
                @enderror
            </div>  </div>
            
        
        <div class="form-group">
            <button class="btn btn-primary btn-sm">Simpan</button>
            
        </div>
    </div>

    </div>
</div>

</form>

<!-- End of Main Content -->

@endsection