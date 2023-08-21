@extends('layouts.layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Add Nilai Data
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
      <form method="post" action="{{ route('nilai.store') }}">
          <div class="form-group">
              @csrf
              <label for="country_name">Nilai :</label>
              <input type="number" class="form-control" name="nilai"/>
          </div>
          <div class="form-group">
            <label for="cases">Nama Matkul :</label>
            <select name="id_matkul" class="form-control" required>
              <option value="" selected disabled>Pilih Nama Matkul</option>
              @foreach($matkul as $key => $nama)
              <option value="{{$key}}">{{$nama}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="cases">Nama Mahassiwa :</label>
            <select name="id_user" class="form-control" required>
              <option value="" selected disabled>Pilih Nama Mahasiswa</option>
              @foreach($mahasiswa as $key => $name)
              <option value="{{$name['id']}}">{{$name['fullname']}}</option>
              @endforeach
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Add Data</button>
      </form>
  </div>
</div>
@endsection