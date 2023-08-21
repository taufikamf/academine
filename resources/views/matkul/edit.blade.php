@extends('layouts.layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Edit Data Matkul
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
      <form method="post" action="{{ route('matkul.update', $matkul->id ) }}">
          <div class="form-group">
              @csrf
              @method('PATCH')
              <label for="country_name">Nama :</label>
              <input type="text" class="form-control" name="nama" value="{{ $matkul->nama }}"/>
          </div>
          <div class="form-group">
              <label for="cases">Deskripsi :</label>
              <textarea type="text" class="form-control" name="deskripsi" value="{{ $matkul->deskripsi }}"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Update Matkul</button>
      </form>
  </div>
</div>
@endsection