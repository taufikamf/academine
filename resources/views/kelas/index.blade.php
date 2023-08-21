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
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Kode</td>
          <td>Nama Kelas</td>
          <td>Mata Pelajaran</td>
          <td>Anggota Kelas</td>
          @if(Auth::user()->role == 1 )
          <td colspan="2 text-center">Action</td>
          @endif
        </tr>
    </thead>
    <tbody>
      @php
      $roles = ['', 'Administrator', 'Dosen', 'Mahasiswa'];
      @endphp
        @foreach($course as $key=>$c)
        <tr>
            <td>{{$c['id']}}</td>
            <td>{{$c['code']}}</td>
            <td>{{$c['class_type']}}</td>
            <td>
              <div class="btn-group">
                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  List Matkul
                </button>
                <ul class="dropdown-menu">
                  @foreach ($c['course'] as $k=>$cs)
                  <li><span class="dropdown-item-text">{{$cs['name']}}</span></li>
                  @endforeach
                </ul>
              </div>
            </td>
            <td>
              <div class="btn-group">
                <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  List Mahasiswa
                </button>
                <ul class="dropdown-menu">
                  @foreach ($c['user_class'] as $k=>$cs)
                  <li><span class="dropdown-item-text">{{$cs['name']}}</span></li>
                  @endforeach
                </ul>
              </div>
            </td>
            @if(Auth::user()->role == 1 )
            <td><a href="{{ route('kelas.edit', $c['id'])}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('kelas.destroy', $c['id'])}}" method="post">
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
  <a href="{{ route('kelas.create')}}" class="btn btn-primary">Create new Kelas</a>
<div>
@endsection
{{-- @foreach($kelas as $key => $k)
<option value="{{$k["id"]}}">{{$k["class_type"]}}</option>
@endforeach --}}