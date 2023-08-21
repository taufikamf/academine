@extends('layouts.layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Add New Assignment
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
      <form method="post" action="{{ route('assignment.store') }}">
          <div class="form-group">
              @csrf
              <label for="country_name">Nama Tugas :</label>
              <input type="text" class="form-control" name="nama"/>
          </div>
          <div class="form-group">
              @csrf
              <label for="country_name">Deskripsi Tugas :</label>
              <textarea type="number" class="form-control" name="deskripsi"></textarea>
          </div>
          <div class="form-group">
              @csrf
              <label for="country_name">Deadline Tugas :</label>
              <input type="datetime-local" class="form-control" name="deadline"></input>
          </div>
          <div class="form-group">
            <label for="formFileMultiple" class="form-label">Multiple files input example</label>
            <input class="form-control" type="file" id="formFileMultiple" multiple>
          </div>
          <div class="form-group">
            <label for="cases">Nama Matkul :</label>
            <select name="id_matkul" class="form-control" required>
              <option value="" selected disabled>Pilih Nama Matkul</option>
              @foreach($course as $key => $c)
              <option value="{{$c['id']}}">{{$c['name']}}</option>
              @endforeach
            </select>
          </div>
          <button type="submit" class="btn btn-primary mt-2">Add Kelas</button>
      </form>
  </div>
</div>
@endsection