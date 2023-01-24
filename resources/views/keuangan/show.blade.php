@extends('layout.v_template')

@section('main-content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800 text-center">{{ $title ?? __('Menambahkan Data Keuangan') }}</h1>

<table class="table table-bordered table-stripped">
       <tr>
        <td style="font-weight: bold">No Surat</td>
        <td>{{$item->no_surat}}</td>
        <td style="font-weight: bold">Judul Surat</td>
        <td>{{$item->judul_surat}}</td>
       </tr>
       <tr>
        <td style="font-weight: bold">Nama Karyawan</td>
        <td>
                @foreach($item->karyawan as $detaildisposisi) 
                <p>{{$detaildisposisi->nama}}</p>
                @endforeach
        </td>
        <td style="font-weight: bold">Lokasi</td>
        <td>{{$item->nama_kota}}</td>
       </tr>
       <tr>
           <td style="font-weight: bold">Tanggal Pergi</td>
           <td>{{$item->tanggal_pergi}}</td>
           <td style="font-weight: bold">Tanggal Pulang</td>
           <td>{{$item->tanggal_pulang}}</td>
       </tr>
       <tr>
        <td style="font-weight: bold">Status Disposisi</td>
        @if($item->status_disposisi =='Pending')
             <td class="px-4 py-3 text-xs">
               <span
               class="badge-warning p-1 rounded-sm">
                 {{ $item->status_disposisi }}
               </span>
             </td>
             @elseif ($item->status_disposisi =='Terima')
             <td class="px-4 py-3 text-xs">
               <span
               class="badge-success p-1 rounded-sm">
                 {{ $item->status_disposisi }}
               </span>
             </td>
             @else ($item->status_disposisi =='Tolak')
             <td class="px-4 py-3 text-xs">
               <span
               class="badge-danger p-1 rounded-sm">
                 {{ $item->status_disposisi }}
               </span>
             </td>
             @endif
        <td style="font-weight: bold">Lampiran Surat</td>
           <td>
           <a href="{{ asset('lampiran_undangan/'. $item->lampiran_undangan )}}" target="_blank" rel="noopener noreferrer"> {{$item->lampiran_undangan}} </a>
           </td>
    </tr>
    </table>

    <div class="flex justify-center my-4">
        <a class= "btn btn-primary btn-center" data-toggle="modal" data-target="#exampleModal">Tambah Data Keuangan</a>
        </div>

        @if (session('message'))
      <div class="alert alert-success mb-2">
          {{ session('message') }}
      </div>
       @endif
        <table class="table table-bordered table-stripped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Transportasi</th>
                    <th>Penginapan</th>
                    <th>Lama (Hari)</th>
                    <th>Uang Transport</th>
                    <th>Uang Penginapan</th>  
                    <th>Lumpsum</th>
                    <th>Jumlah</th>
                    <th>Jumlah Akhir</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($dataa as $it)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $it->jenis_transportasi}}</td>
                    <td>{{ $it->nama_penginapan}}</td>
                    <td>
                        {{ $days }}
                    </td>
                    <td>
                    <?php
                    $transport = $data->uang_transport;
                    $besarantr = (2*$transport);    
                    echo 'Rp. '.number_format($besarantr,  0, ",", ".");
                    ?>
                    </td>    
                    <td>
                    <?php
                    $penginapan = $data->uang_penginapan;
                    $besaranpn = ($days * $penginapan); 
                    echo 'Rp. '.number_format($besaranpn,  0, ",", ".");
                    ?>
                    </td>
                    <td>
                    <?php
                    $lump = $data->besaran_lumpsum;
                    $besaranlm = ($days * $lump);
                    echo 'Rp. '.number_format($besaranlm,  0, ",", ".");
                    ?>
                    </td>
                    <td>
                    <?php
                    $jumlah = ($besarantr+$besaranpn+$besaranlm);
                    echo 'Rp. '.number_format($jumlah,  0, ",", ".");
                    ?>
                    </td> 
                    <td>
                    @foreach ($jmlh_data as $subjumlah)
                    @currency ($subjumlah->total * $jumlah)
                    @endforeach
                    </td> 

                </tr>
            @endforeach
        </tbody>
        </table>

        <div class="d-flex">
          <a href="/keuangan/cetak/{{ $item->id }}" class="btn btn-sm btn-primary mr-2">Cetak SPPD</a>


        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Tambah Data Keuangan</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <form action="/keuangan/store" method="POST">
                        @csrf
                        <input type="hidden" value="{{$item->id}}" name="disposisi_id">
                        <div class="form-group">
                          <label for="transportasi">Transportasi</label>
                          <select class="form-control @error('type') is-invalid @enderror" name="transportasi_id" id="transportasi_id" autocomplete="off" value="{{ old('transportasi_id') }}">
                            @foreach ($transportasi as $item)
                            <option value="{{$item->id}}">{{$item->jenis_transportasi}}</option>
                           
                            @endforeach
                          </select>
                          @error('jenis_transportasi')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
        
                        <div class="form-group">
                          <label for="penginapan">Penginapan</label>
                          <select class="form-control @error('type') is-invalid @enderror" name="penginapan_id" id="penginapan_id" autocomplete="off" value="{{ old('penginapan_id') }}">
                            @foreach ($pn as $it)
                            <option value="{{$it->id}}">{{$it->nama_penginapan}}</option>
                           
                            @endforeach
                          </select>
                          @error('nama_penginapan')
                            <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                        <div class="form-group">
                        <label>Uang Transportasi</label>
                        <input name="uang_transport" class="form-control" value="{{ old('uang_transport') }}">
                        <div class="text-danger">
                            @error('uang_transport')
                            {{ $message }}
                            @enderror
                        </div>

                        <div class="form-group">
                        <label>Uang Penginapan</label>
                        <input name="uang_penginapan" class="form-control" value="{{ old('uang_penginapan') }}">
                        <div class="text-danger">
                            @error('uang_penginapan')
                            {{ $message }}
                            @enderror
                        </div>
                        </div>  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary" name="submit" >Simpan</button>
                </div>
              </div>
            </div>
          </div>

@endsection
@push('notif')
    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
@endpush