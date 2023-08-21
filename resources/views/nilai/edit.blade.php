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
      <form method="POST" action="{{ route('nilai.update', $nilai->id) }}">
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="country_name">Nilai :</label>
          <input type="number" class="form-control" name="nilai" value="{{$nilai->nilai}}"/>
      </div>
        <div class="form-group">
          <label for="cases">Nama Matkul :</label>
          <select name="id_matkul" class="form-control" required>
            <option value="" selected disabled>Pilih Nama Matkul</option>
            @foreach($matkul as $key => $nama)
            @if($nilai->id_matkul == $key)
              <option value="{{$key}}" selected>{{$nama}}</option>
              @else
              <option value="{{$key}}">{{$nama}}</option>
            @endif
              @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="cases">Nama Kriteria :</label>
          <select name="id_kriteria" class="form-control" required>
            <option value="" selected disabled>Pilih Nama Kriteria</option>
            @foreach($kriteria as $key => $nama)
            @if($nilai->id_kriteria == $key)
              <option value="{{$key}}" selected>{{$nama}}</option>
              @else
              <option value="{{$key}}">{{$nama}}</option>
            @endif
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="cases">Nama Mahassiwa :</label>
          <select name="id_user" class="form-control" required>
            <option value="" selected disabled>Pilih Nama Mahasiswa</option>
            @foreach($user as $key => $name)
              @if($nilai->id_user == $key)
                <option value="{{$key}}" selected>{{$name}}</option>
              @else
                <option value="{{$key}}">{{$name}}</option>
              @endif
            @endforeach
          </select>
        </div>
          <button type="submit" class="btn btn-primary">Update Data</button>
      </form>
  </div>
</div>
@endsection