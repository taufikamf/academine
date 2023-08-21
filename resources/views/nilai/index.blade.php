@extends('layouts.layout')
@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}  
    </div><br />
  @endif
  <div class="col-md-6">
    <div class="card mb-4">
      <div class="card-body">
        <div>
          <label for="defaultFormControlInput" class="form-label">Search Data</label>
          <div class="col d-flex">
            <form class="col d-flex" action="" method="get"> 
              <input type="text" class="form-control" id="defaultFormControlInput" name="search" placeholder="Search here..." aria-describedby="defaultFormControlHelp">
              <button type="button" class="btn btn-primary" type="submit" style="margin-left: 20px;">Search</button>
            </form>
          </div>  
        </div>
      </div>
    </div>
  </div>
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Nama Matkul</td>
          <td>Nama Mahasiswa</td>
          <td>Nilai</td>
          <td>Grade</td>
          @if(Auth::user()->role == 1)
          <td colspan="2 text-center">Action</td>
          @endif
        </tr>
    </thead>
    <tbody>
      @php
      $roles = ['', 'Administrator', 'Dosen', 'Mahasiswa'];
      @endphp
        @foreach($nilai_data as $key=>$nilais)
        <tr>
            <td>{{$nilais['id']}}</td>
            <td>{{$nilais['course']['name']}}</td>
            <td>{{$nilais['student']['fullname']}}</td>
            <td>{{$nilais['value']}}</td>
            <td>{{$nilais['grade']}}</td>
            @if(Auth::user()->role == 1)
            <td><a href="{{ route('nilai.edit', $nilais['id'])}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('nilai.destroy', $nilais['id'])}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
            @endif
        </tr>
        @endforeach
    </tbody>
  </table>
  <div class="d-flex justify-content-between">
    <a href="{{ route('nilai.create')}}" class="btn btn-primary">Create new Nilai</a>
    <a href="export-csv" target="_blank" class="btn btn-primary"><i class="menu-icon tf-icons bx bx-printer"></i>Export Nilai</a>
  </div>
<div>

@endsection