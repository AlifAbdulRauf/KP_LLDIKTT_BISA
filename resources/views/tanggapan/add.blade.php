@extends('layout.v_template')


@section('main-content')

 <!-- Page Heading -->
 <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Disposisi') }}</h1>

 <!-- Main Content goes here -->
<form action="/tanggapan/store" method="POST" enctype="multipart/form-data">
@csrf
<div class="content">
    <div class="row"> 
    <div class="col-sm-6">
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
            <input type="hidden" value="{{$it->id}}" name="pusat_id">

            <div class="form-group">
            <label>Status</label> 
            <div> </div>
            <select name='status_disposisi' class="form-control" aria-label="Default select example" value="{{ old('status_disposisi') }}">
            <option selected>Pilih Status</option>
            <option value="Tolak">Tolak</option>
            <option value="Terima">Terima</option>
            </select>
            <div class="text-danger">
                @error('status_disposisi')
                {{ $message }}
                @enderror
            </div>
        </div>

            <label>Karyawan</label>
            <div class="input-group mb-3">
            <!-- <label>Karyawan</label> -->
            <select name="karyawan_id[]" class="form-control" >
            <option value="" >- Pilih -</option>
            @foreach ($karyawan as $item)
            <option value="{{ $item->id }}" >{{ $item->nama }}</option>
            @endforeach
            </select> 
            <button class="btn btn-outline-secondary add_karyawan" type="button" id="button-addon2">Add</button>
            </div>

            <div id="extra-karyawan"></div>

            
        
        <div class="form-group">
            <button class="btn btn-primary btn-sm">Simpan</button>
            
        </div>
    </div>

    </div>
</div>

</form>

<!-- End of Main Content -->
@endsection
@push('js')
<script>
    const add = document.querySelectorAll(".input-group .add_karyawan")
    add.forEach(function(e){
        e.addEventListener('click', function(){
            let element = this.parentElement
            console.log(element);
            let newElement = document.createElement('div')
                newElement.classList.add('input-group','mb-3')
                newElement.innerHTML=`<select name="karyawan_id[]" class="form-control" ><option value="" >- Pilih -</option>@foreach ($karyawan as $item)<option value="{{ $item->id }}" >{{ $item->nama }}</option>@endforeach</select> <button class="btn btn-outline-danger remove_karyawan" type="button" id="button-addon2">Remove</button>`
            document.getElementById('extra-karyawan').appendChild(newElement)

            document.querySelectorAll('.remove_karyawan').forEach(function(remove){
                remove.addEventListener('click',function(elmClick){
                    elmClick.target.parentElement.remove()
                })
            })
          })
    })
</script>
@endpush