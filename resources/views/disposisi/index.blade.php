@extends('layout.v_template')

@section('main-content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Data Surat Undangan dari Pusat') }}</h1>
   
   @if (session('message'))
       <div class="alert alert-success">
           {{ session('message') }}
       </div>
   @endif

<table id="table" class="table table-bordered table-stripped">
       <thead>
           <tr>
               <th>No</th>
               <th>No Surat</th>
               <th>Judul Surat</th>
               <th>Lampiran Surat</th>
               <th>Status</th>
               <th>Aksi</th>
           </tr>
       </thead>
       <tbody>
       @foreach ($items as $item)
               <tr>
                   <td scope="row">{{ $loop->iteration }}</td>
                   <td>{{ $item->no_surat}}</td>
                   <td>{{ $item->judul_surat}}</td>
                   <td>
                       <a href="{{ asset('lampiran_undangan/'. $item->lampiran_undangan )}}" target="_blank" rel="noopener noreferrer"> {{$item->lampiran_undangan}} </a>
                   </td>
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
                   
                  
                   <td>
                       <div class="d-flex">
                           <a href="/disposisi/show/{{ $item->id }} " class="btn btn-sm btn-primary mr-2">Detail</a>
                           <!-- <a href=" " display="inline" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a> -->
                           <!-- <form action="{{Route('pusat.destroy',[$item->id])}}" method="post">
                               @csrf
                               @method('delete')
                               <button type="submit" class="btn btn-sm btn-danger show_confirm" data-toggle="tooltip" title='Delete'>Hapus</button> -->
                       </div>
                   </td>
               </tr>
           @endforeach
       </tbody>
</table>

@endsection

@push('js')
<script src="httitem://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
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

