@extends('layouts.layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="card uper">
  <div class="card-header">
    Add New Ujian
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
      <form method="post" action="{{ route('exam.store') }}">
          <div class="form-group">
              @csrf
              <label for="country_name">Nama Ujian :</label>
              <input type="text" class="form-control" name="nama"/>
          </div>
          <div class="form-group">
            <label for="cases">Matkul Ujian :</label>
            <select name="id_matkul" class="form-control" required>
              <option value="" selected disabled>Pilih Nama Matkul</option>
              @foreach($course as $key => $c)
              <option value="{{$c['id']}}">{{$c['name']}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="cases">Dosen Pembuat :</label>
            <select name="id_dosen" class="form-control" required>
              <option value="" selected disabled>Pilih Nama Dosen</option>
              @foreach($user as $key => $u)
              <option value="{{$u['id']}}">{{$u['fullname']}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
              @csrf
              <label for="country_name">Tanggal Mulai :</label>
              <input type="datetime-local" class="form-control" name="start_date"></input>
          </div>
          <div class="form-group">
              @csrf
              <label for="country_name">Tanggal Selesai :</label>
              <input type="datetime-local" class="form-control" name="end_date"></input>
          </div>
          <button type="submit" class="btn btn-primary mt-2">Add Exam</button>
      </form>
  </div>
</div>
@endsection