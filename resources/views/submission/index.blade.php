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
          <td>Nama Tugas</td>
          <td>File Dikumpulkan</td>
          <td>Matkul Tugas</td>
          <td>Mahasiswa Pengumpul</td>
          @if(Auth::user()->role == 1 )
          <td colspan="2 text-center">Action</td>
          @endif
        </tr>
    </thead>
    <tbody>
        @foreach($submission as $key=>$s)
        <tr>
            <td>{{$s['id']}}</td>
            <td>{{$s['assignment']['name']}}</td>
            <td>{{$s['attachment']}}</td>
            <td>{{$s['assignment']['course']['name']}}</td>
            <td>{{$s['student']['fullname']}}</td>
            @if(Auth::user()->role == 1 )
            <td><a href="{{ route('kelas.edit', $s['id'])}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('kelas.destroy', $s['id'])}}" method="post">
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
  <a href="{{ route('kelas.create')}}" class="btn btn-primary">Create new Submission</a>
<div>
@endsection
{{-- @foreach($kelas as $key => $k)
<option value="{{$k["id"]}}">{{$k["class_type"]}}</option>
@endforeach --}}