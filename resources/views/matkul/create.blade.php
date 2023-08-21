@extends('layouts.layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Add Matkul Data
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
      <form method="post" action="{{ route('matkul.store') }}">
          <div class="form-group">
              @csrf
              <label for="country_name">Nama :</label>
              <input type="text" class="form-control" name="nama"/>
          </div>
          <div class="form-group">
            <label for="cases">Nama Kelas :</label>
            <select name="id_kelas" class="form-control" required>
              <option value="" selected disabled>Pilih Nama Kelas</option>
              @foreach($kelas as $key => $k)
              <option value="{{$k["id"]}}">{{$k["class_type"]}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="cases">Nama Dosen :</label>
            <select name="id_dosen" class="form-control" required>
              <option value="" selected disabled>Pilih Nama Dosen</option>
              @foreach($user as $key => $u)
                <option value="{{$u["id"]}}">{{$u["fullname"]}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            @csrf
            <label for="country_name">SKS :</label>
            <input type="number" class="form-control" name="sks"/>
          </div>
          <div class="form-group">
            @csrf
            <label for="country_name">Date :</label>
            <input type="datetime-local" class="form-control" name="begin_time"/>
        </div>
          <div class="form-group">
              @csrf
              <label for="country_name">Deskripsi :</label>
              <textarea type="number" class="form-control" name="deskripsi"></textarea>
          </div>
          <button type="submit" class="btn btn-primary mt-2">Add Matkul</button>
      </form>
  </div>
</div>
@endsection