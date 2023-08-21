@extends('layouts.layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Add Kelas Data
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
      <form method="post" action="{{ route('kelas.store') }}">
          <div class="form-group">
              @csrf
              <label for="country_name">Nama Kelas :</label>
              <input type="text" class="form-control" name="nama_kelas"/>
          </div>
          <div class="form-group">
              @csrf
              <label for="country_name">Deskripsi Kelas :</label>
              <textarea type="number" class="form-control" name="deskripsi"></textarea>
          </div>
          <button type="submit" class="btn btn-primary mt-2">Add Kelas</button>
      </form>
  </div>
</div>
@endsection