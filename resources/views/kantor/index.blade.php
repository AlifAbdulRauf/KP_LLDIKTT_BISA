@extends('layout.v_template')

@section('main-content')

 <!-- Page Heading -->
 <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Data Surat Undangan dari Kantor') }}</h1>


	<div class="container">
 
		{{-- notifikasi form validasi --}}
		@if ($errors->has('file'))
		<span class="invalid-feedback" role="alert">
			<strong>{{ $errors->first('file') }}</strong>
		</span>
		@endif
 
		{{-- notifikasi sukses --}}
		@if ($sukses = Session::get('sukses'))
		<div class="alert alert-success alert-block">
			<button type="button" class="close" data-dismiss="alert"></button> 
			<strong>{{ $sukses }}</strong>
		</div>
		@endif
 
		<button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#importExcel">
			IMPORT EXCEL
		</button>
 
		<!-- Import Excel -->
		<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<form method="post" action="/kantor/import_excel" enctype="multipart/form-data">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
						</div>
						<div class="modal-body">
 
							{{ csrf_field() }}
 
							<label>Pilih file excel</label>
							<div class="form-group">
								<input type="file" name="file" required="required">
							</div>
 
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Import</button>
						</div>
					</div>
				</form>
			</div>
		</div>


        <a href="/kantor/add" class="btn btn-primary mb-3">Tambah Surat</a> 
        @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif

        <table id="table" class="table table-bordered table-stripped">
        <thead>
            <tr>
                <th>No</th>
                <th>Lokasi</th>
                <th>Karyawan</th>
                <th>Judul Surat</th>
                <th>Tanggal Pergi</th>
                <th>Tanggal Pulang</th>
                <th>Lampiran Surat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($kantors as $kantor)
                <tr>
                    <td scope="row">{{ $loop->iteration }}</td>
                    <td>{{ $kantor->nama_kota}}</td>
                    <td>
                        @foreach($kantor->karyawan as $detailkantor) 
                        <p>{{$detailkantor->nama}}</p>
                        @endforeach
                    </td>
                    <td>{{ $kantor->judul_surat}}</td>
                    <td>{{ $kantor->tanggal_pergi}}</td>    
                    <td>{{ $kantor->tanggal_pulang}}</td>
                    <td>
                        <a href="{{ asset('lampiran_surat/'. $kantor->lampiran_surat )}}" target="_blank" rel="noopener noreferrer"> {{$kantor->lampiran_surat}} </a>
                    </td>
                    
                   
                    <td>
                        <div class="d-flex">
                            <a href="/kantor/edit/{{ $kantor->id }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                            <a href="{{Route('kantor.destroy',[$kantor->id])}}" display="inline" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                            <!-- <form action="{{Route('pusat.destroy',[$kantor->id])}}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger show_confirm" data-toggle="tooltip" title='Delete'>Hapus</button> -->
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
<script type="text/javascript">
 
     $('.show_confirm').click(function(event) {
          var form =  $(this).closest("form");
          var name = $(this).data("name");
          event.preventDefault();
          swal({
            title: "Apakah Anda Yakin?",
            text: "Setelah dihapus, Anda tidak akan dapat memulihkan data ini!",
                icon: "warning",
                buttons: true,
                 dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              form.submit();
            }
          });
      });
  
</script>
@endpush
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

