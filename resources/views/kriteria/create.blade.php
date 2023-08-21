@extends('layouts.layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Add Kriteria Data
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
      <form method="post" action="{{ route('kriteria.store') }}">
          <div class="form-group">
              @csrf
              <label for="country_name">Nama Kriteria :</label>
              <input type="text" class="form-control" name="nama"/>
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
          <button type="submit" class="btn btn-primary">Add Data</button>
      </form>
  </div>
</div>
@endsection