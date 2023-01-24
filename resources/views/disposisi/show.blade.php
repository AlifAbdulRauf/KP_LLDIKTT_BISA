@extends('layout.v_template')

@section('main-content')

<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800 text-center">{{ $title ?? __('Detail Disposisi') }}</h1>

<div class="w-full mb-8 overflow-hidden rounded-lg shadow-xs">
    <div class="w-full overflow-x-auto">
        @foreach($item->details as $ite)
        <div
          class="text-gray-800 text-sm font-semibold px-4 py-4 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800 dark:text-gray-400 ">

          <h5>No Surat : {{ $ite->no_surat }}</h5>
          <h5 class="mt-4">Judul Surat : {{ $ite->judul_surat }}</h5>
          <h5 class="mt-4">Lampiran Surat : <a href="{{ asset('lampiran_undangan/'. $ite->lampiran_undangan )}}" target="_blank" rel="noopener noreferrer"> {{$ite->lampiran_undangan}} </a></h5>
          <h5 class="mt-4">Tanggal Pergi : {{ $ite->tanggal_pergi }}</h5>
          <h5 class="mt-4">Tanggal Pulang : {{ $ite->tanggal_pulang }}</h5>
          <h5 class="mt-4">Status : 
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
          </h5>
        </div>
        @endforeach
    </div>
        <div>
        <div class="flex justify-center my-4">
        <a href="/tanggapan/show/{{ $ite->id }}" class= "btn btn-primary btn-center">Disposisi</a>
        </div>
        

        

    </div>
   
                  
</div>

@endsection