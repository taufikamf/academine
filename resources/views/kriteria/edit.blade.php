@extends('layouts.layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit Data User
  </div>
  <div class="card-body">
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('kriteria.update', $kriteria->id ) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">Nama Kriteria :</label>
              <input type="text" class="form-control" name="nama" value="{{ $kriteria->nama }}"/>
          </div>
          <div class="form-group">
            <label for="cases">Nama Matkul :</label>
            <select name="id_matkul" class="form-control" required>
              <option value="" selected disabled>Pilih Nama matkul</option>
              @foreach($matkul as $key => $nama)
              @if($kriteria->id_matkul == $key)
                <option value="{{$key}}" selected>{{$nama}}</option>
                @else
                <option value="{{$key}}">{{$nama}}</option>
              @endif
              @endforeach
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Update Data</button>
      </form>
  </div>
</div>
@endsection